<?php
require_once CORE_PATH . '/database.php';
require_once MODEL_PATH . '/catalog_model.php';

/* Compter le nombre total d'emprunts */
function get_rentals_count() {
    $query = "SELECT COUNT(*) as total FROM loans";
    $result = db_select_one($query);
    return $result['total'] ?? 0;
}

/* Compter les emprunts actifs et en attente */
function get_loans_count() {
    $query = "SELECT COUNT(*) as total FROM loans WHERE status IN ('active', 'pending_return')";
    $result = db_select_one($query);
    return $result['total'] ?? 0;
}

/* Création d'une nouvelle location (Côté Utilisateur) avec les nouvelles règles unifiées */
function create_rental($user_id, $item_id) {
    $parts = explode('_', $item_id);
    if (count($parts) != 2) {
        return ['success' => false, 'error' => 'Identifiant de média invalide.'];
    }
    
    $type = $parts[0];
    $pure_id = $parts[1];
    $media_type = ($type == 'book' || $type == 'livre') ? 'book' : (($type == 'film') ? 'movie' : 'video_game');
    $item = get_item_by_id($item_id);

    /* 1. Vérifier la disponibilité (Stock) */
    if (!$item || !isset($item['stock']) || $item['stock'] <= 0) {
        return ['success' => false, 'error' => 'Le média n\'est pas disponible.'];
    }
    
    /* 2. Vérifier les doublons (Média déjà emprunté) */
    $query = "SELECT COUNT(*) as count FROM loans WHERE user_id = ? AND media_id = ? AND media_type = ? AND status IN ('active', 'pending_return')";
    $result = db_select_one($query, [$user_id, $pure_id, $media_type]);
    if ((int)$result['count'] > 0) {
        return ['success' => false, 'error' => 'Vous avez déjà emprunté ce média. Veuillez le retourner avant de l\'emprunter à nouveau.'];
    }

    /* 3. Vérifier la limite stricte globale (3 médias maximum : actifs + en attente) */
    $limit_query = "SELECT COUNT(*) as count FROM loans WHERE user_id = ? AND status IN ('active', 'pending_return')";
    $limit_result = db_select_one($limit_query, [$user_id]);
    if ((int)$limit_result['count'] >= 3) {
        return ['success' => false, 'error' => 'Vous avez atteint la limite de 3 médias (en cours ou en attente de validation).'];
    }
    
    /* 4. Vérifier les retards */
    $overdue_query = "SELECT COUNT(*) as count FROM loans WHERE user_id = ? AND status = 'active' AND return_date < CURDATE()";
    $overdue_result = db_select_one($overdue_query, [$user_id]);
    if ((int)$overdue_result['count'] > 0) {
        return ['success' => false, 'error' => 'Vous avez des emprunts en retard. Veuillez les retourner avant d\'emprunter de nouveau.'];
    }
    
    db_begin_transaction();
    try {
        $loan_date = date('Y-m-d H:i:s');
        $return_date = date('Y-m-d', strtotime('+14 days', strtotime($loan_date)));
        
        $query = "INSERT INTO loans (user_id, media_id, media_type, loan_date, return_date, status) VALUES (?, ?, ?, ?, ?, 'active')";
        db_execute($query, [$user_id, $pure_id, $media_type, $loan_date, $return_date]);
        
        $table = ($media_type == 'book') ? 'books' : (($media_type == 'movie') ? 'movies' : 'video_games');
        db_execute("UPDATE $table SET stock = stock - 1 WHERE id = ? ", [$pure_id]);
        
        db_commit();
        return ['success' => true, 'error' => null, 'return_date' => $return_date];
    } catch (Exception $e) {
        db_rollback();
        return ['success' => false, 'error' => 'Erreur technique lors de l\'emprunt.'];
    }
}

/* Création d'une location (Côté Admin) */
function create_loan($user_id, $media_id, $media_type) {
    $stock_query = "SELECT stock FROM " . ($media_type == 'book' ? 'books' : ($media_type == 'movie' ? 'movies' : 'video_games')) . " WHERE id = ?";
    $stock = db_select_one($stock_query, [$media_id])['stock'] ?? 0;
    if ($stock < 1) return false;

    $loan_date = date('Y-m-d');
    $return_date = date('Y-m-d', strtotime('+14 days'));
    $query = "INSERT INTO loans (user_id, media_id, media_type, loan_date, return_date, status) VALUES (?, ?, ?, ?, ?, 'active')";
    if (db_execute($query, [$user_id, $media_id, $media_type, $loan_date, $return_date])) {
        $table = ($media_type == 'book') ? 'books' : (($media_type == 'movie') ? 'movies' : 'video_games');
        db_execute("UPDATE $table SET stock = stock - 1 WHERE id = ?", [$media_id]);
        return true;
    }
    return false;
}

/* Demander le retour d'un média (Utilisateur) */
function request_return($rental_id, $user_id) {
    $query = "UPDATE loans SET status = 'pending_return' WHERE id = ? AND user_id = ? AND status = 'active'";
    return db_execute($query, [$rental_id, $user_id]);
}

/* Confirmer le retour d'un média (Admin) */
function confirm_return($loan_id) {
    $loan = db_select_one("SELECT media_id, media_type FROM loans WHERE id = ? AND status IN ('active', 'pending_return')", [$loan_id]);
    if (!$loan) return false;

    db_begin_transaction();
    try {
        $query = "UPDATE loans SET status = 'returned', returned_at = NOW() WHERE id = ?";
        db_execute($query, [$loan_id]);
        $table = ($loan['media_type'] == 'book') ? 'books' : (($loan['media_type'] == 'movie') ? 'movies' : 'video_games');
        db_execute("UPDATE $table SET stock = stock + 1 WHERE id = ?", [$loan['media_id']]);
        db_commit();
        return true;
    } catch (Exception $e) {
        db_rollback();
        return false;
    }
}

/* Récupérer les locations d'un utilisateur selon le statut */
function get_user_rentals_by_status($user_id, $status = 'active') {
    $condition = ($status == 'active') ? "r.status IN ('active', 'pending_return')" : "r.status = 'returned'";
    $query = "SELECT r.id, r.media_id, r.loan_date AS rent_date, r.return_date, r.returned_at, r.status,
                     CASE 
                         WHEN r.media_type = 'book' THEN (SELECT title FROM books WHERE id = r.media_id)
                         WHEN r.media_type = 'movie' THEN (SELECT title FROM movies WHERE id = r.media_id)
                         WHEN r.media_type = 'video_game' THEN (SELECT title FROM video_games WHERE id = r.media_id)
                     END AS title,
                     r.media_type AS type, 
                     CASE 
                         WHEN r.media_type = 'book' THEN (SELECT image_url FROM books WHERE id = r.media_id)
                         WHEN r.media_type = 'movie' THEN (SELECT image_url FROM movies WHERE id = r.media_id)
                         WHEN r.media_type = 'video_game' THEN (SELECT image_url FROM video_games WHERE id = r.media_id)
                     END AS image_url
              FROM loans r 
              WHERE r.user_id = ? AND $condition
              ORDER BY r.loan_date DESC";
    return db_select($query, [$user_id]);
}


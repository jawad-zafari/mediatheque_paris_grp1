<?php
require_once CORE_PATH . '/database.php';
require_once MODEL_PATH . '/item_model.php';

/**
 * Compter le nombre total de locations
 */
function get_rentals_count() {
    $query = "SELECT COUNT(*) as total FROM loans";
    $result = db_select_one($query);
    return $result['total'] ?? 0;
}

/**
 * Création d'une nouvelle location
 */
function create_rental($user_id, $item_id) {
    $parts = explode('_', $item_id);
    if (count($parts) != 2) return false;
    $type = $parts[0];
    $pure_id = $parts[1];
    $media_type = ($type == 'book' || $type == 'livre') ? 'book' : (($type == 'film') ? 'movie' : 'video_game');
    $item = get_item_by_id($item_id);
    if (!$item || !$item['available']) return false;
    
    db_begin_transaction();
    try {
        $loan_date = date('Y-m-d');
        $return_date = date('Y-m-d', strtotime('+14 days', strtotime($loan_date)));
        $query = "INSERT INTO loans (user_id, media_id, media_type, loan_date, return_date) VALUES (?, ?, ?, ?, ?)";
        $result = db_execute($query, [$user_id, $pure_id, $media_type, $loan_date, $return_date]);
        update_item_availability($item_id, 0);
        db_commit();
        return $result;
    } catch (Exception $e) {
        db_rollback();
        return false;
    }
}

/**
 * Récupérer les locations de l'utilisateur
 */
function get_user_rentals($user_id) {
    $query = "SELECT r.id, r.user_id, r.media_id AS item_id, r.loan_date AS rent_date, r.return_date, r.returned_at,
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
              WHERE r.user_id = ? AND r.returned_at IS NULL 
              ORDER BY r.loan_date DESC";
    return db_select($query, [$user_id]);
}

/**
 * Retourner un item loué
 */
function return_rental($rental_id, $user_id) {
    $rental = db_select_one("SELECT * FROM loans WHERE id = ? AND user_id = ?", [$rental_id, $user_id]);
    if (!$rental || $rental['returned_at'] !== NULL) return false;
    
    db_begin_transaction();
    try {
        $query = "UPDATE loans SET returned_at = NOW() WHERE id = ?";
        db_execute($query, [$rental_id]);
        update_item_availability($rental['media_id'], 1);
        db_commit();
        return true;
    } catch (Exception $e) {
        db_rollback();
        return false;
    }
}
?>
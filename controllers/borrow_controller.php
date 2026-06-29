<?php
/* Changement du nom du modèle vers borrow_model.php */
require_once MODEL_PATH . '/borrow_model.php';
require_once INCLUDE_PATH . '/helpers.php';

/**
 * Gère l'emprunt d'un média par un utilisateur
 */
function borrow_rent($item_id) {
    if (!is_logged_in()) {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Vous devez vous connecter pour emprunter.']);
            exit;
        }
        set_flash('error', 'Vous devez vous connecter pour emprunter.');
        redirect('auth/login');
        return;
    }
    
    $user_id = current_user_id();

    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
        header('Content-Type: application/json');
        $result = create_rental($user_id, $item_id);
        
        if (is_array($result) && isset($result['success']) && $result['success'] === true) {
            $return_date = $result['return_date'] ?? date('Y-m-d', strtotime('+14 days'));
            echo json_encode([
                'success' => true,
                'message' => 'L\'emprunt a été enregistré avec succès. Date de retour : ' . format_date($return_date)
            ]);
        } else {
            $error_message = (is_array($result) && isset($result['error'])) ? $result['error'] : 'Erreur lors de l\'emprunt.';
            echo json_encode([
                'success' => false,
                'error' => $error_message
            ]);
        }
        exit;
    }

    $result = create_rental($user_id, $item_id);
    if (is_array($result) && isset($result['success']) && $result['success'] === true) {
        set_flash('success', 'L\'emprunt a été enregistré avec succès.');
    } else {
        set_flash('error', 'Erreur lors de l\'emprunt.');
    }
    redirect('borrow/index');
}

/**
 * Affiche la liste des emprunts de l'utilisateur
 */
/**
 * Affiche la liste des emprunts de l'utilisateur
 */
function borrow_index() {
    if (!is_logged_in()) {
        redirect('auth/login');
        return;
    }
    $user_id = current_user_id();
    
    $active_rentals = get_user_rentals_by_status($user_id, 'active');
    $returned_rentals = get_user_rentals_by_status($user_id, 'returned');

    /* Tri MVC propre : Actifs en premier, En attente en dernier, puis par date d'emprunt */
    if (!empty($active_rentals)) {
        usort($active_rentals, function($a, $b) {
            $statusA = (isset($a['status']) && $a['status'] === 'pending_return') ? 2 : 1;
            $statusB = (isset($b['status']) && $b['status'] === 'pending_return') ? 2 : 1;
            
            if ($statusA !== $statusB) {
                return $statusA - $statusB;
            }
            return strtotime($b['rent_date'] ?? 0) - strtotime($a['rent_date'] ?? 0);
        });
    }

    /* Tri MVC propre : Historique par date de retour la plus récente */
    if (!empty($returned_rentals)) {
        usort($returned_rentals, function($a, $b) {
            return strtotime($b['returned_at']) - strtotime($a['returned_at']);
        });
    }

    $data = [
        'title' => 'Mes Emprunts',
        'active_rentals' => $active_rentals,
        'returned_rentals' => $returned_rentals,
    ];
    
    load_view_with_layout('borrow/my_borrow', $data);
}

/**
 * Gère la demande de retour d'un média (Envoie en attente de confirmation)
 */
function borrow_return($rental_id) {
    if (!is_logged_in()) {
        redirect('auth/login');
        return;
    }
    $user_id = current_user_id();
    
    if (request_return($rental_id, $user_id)) {
        set_flash('success', 'Demande de retour envoyée ! En attente de validation de l\'administrateur.');
    } else {
        set_flash('error', 'Erreur lors de la demande de retour.');
    }
    
    /* Vérifier d'où vient la requête (MVC Dynamique) */
    if (isset($_GET['from']) && $_GET['from'] === 'profile') {
        redirect('home/profile?tab=mes-emprunts');
    } else {
        redirect('borrow/index');
    }
}
?>
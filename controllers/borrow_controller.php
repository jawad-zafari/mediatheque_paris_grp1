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


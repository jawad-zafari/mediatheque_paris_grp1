<?php
require_once MODEL_PATH . '/rental_model.php';
require_once INCLUDE_PATH . '/helpers.php';

/**
 * Gère la location d'un média par un utilisateur
 * @param string $item_id Identifiant du média à emprunter
 */
function rental_rent($item_id) {
    // Vérification de la connexion de l'utilisateur
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

    // Cas 1 : Traitement de la requête AJAX via JavaScript
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

    // Traitement classique si le JavaScript est désactivé
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {
            $result = create_rental($user_id, $item_id);
            if (is_array($result) && isset($result['success']) && $result['success'] === true) {
                set_flash('success', 'L\'emprunt a été enregistré avec succès.');
            } else {
                set_flash('error', 'Erreur lors de l\'emprunt.');
            }
            redirect('home/profile');
            return;
        } else {
            redirect('home/profile');
            return;
        }
    } else {
        $_SESSION['confirm_rental_item_id'] = $item_id;
        redirect('home/profile');
        return;
    }
}

/**
 * Affiche la liste des locations de l'utilisateur (actives et historiques)
 */
function rental_my_rentals() {
    if (!is_logged_in()) {
        redirect('auth/login');
        return; 
    }
    $user_id = current_user_id();
    // Prépare les données pour la vue avec locations actives et historiques
    $data = [
        'title' => 'Mes Emprunts',
        'active_rentals' => get_user_rentals_by_status($user_id, 'active'),
        'returned_rentals' => get_user_rentals_by_status($user_id, 'returned'),
    ];
    load_view_with_layout('rental/my_rentals', $data);
}

/**
*Gère le retour d'un média emprunté
 * param int $rental_id Identifiant de la location à retourner
 */
function rental_return($rental_id) {
    if (!is_logged_in()) {
        redirect('auth/login');
        return;
    }
    $user_id = current_user_id();
    // Marque la location comme retournée
    if (return_rental($rental_id, $user_id)) {
        set_flash('success', 'Retourné avec succès!');
    } else {
        set_flash('error', 'Erreur lors du retour.');
    }
    redirect('rental/my_rentals');
}
?>
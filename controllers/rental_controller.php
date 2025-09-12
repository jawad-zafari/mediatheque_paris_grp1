<?php
require_once MODEL_PATH . '/rental_model.php';
require_once INCLUDE_PATH . '/helpers.php';

/**
 * Gère la location d'un média par un utilisateur
 * @param string $item_id Identifiant du média à emprunter
 */
function rental_rent($item_id) {
    // Vérifie si l'utilisateur est connecté
    if (!is_logged_in()) {
        set_flash('error', 'Vous devez vous connecter pour emprunter.');
        redirect('auth/login');
        return; // Arrête l'exécution si l'utilisateur n'est pas connecté
    }
    $user_id = current_user_id();
    if (!$user_id) {
        set_flash('error', 'Erreur : utilisateur non identifié.');
        redirect('auth/login');
        return;
    }
    // Crée une nouvelle location
    if (create_rental($user_id, $item_id)) {
        set_flash('success', 'Emprunté avec succès !');
    } else {
        set_flash('error', 'Erreur lors de l\'emprunt.');
    }
    redirect('rental/my_rentals');
}

/**
 * Affiche la liste des locations de l'utilisateur
 */
function rental_my_rentals() {
    // Vérifie si l'utilisateur است connecté
    if (!is_logged_in()) {
        redirect('auth/login');
        return; // Arrête l'exécution si l'utilisateur ن'est pas connecté
    }
    $user_id = current_user_id();
    // Prépare les données pour la vue
    $data = ['title' => 'Mes Locations', 'rentals' => get_user_rentals($user_id)];
    load_view_with_layout('rental/my_rentals', $data);
}

/**
 * Gère le retour d'un média emprunté
 * @param int $rental_id Identifiant de la location à retourner
 */
function rental_return($rental_id) {
    // Vérifie si l'utilisateur است connecté
    if (!is_logged_in()) {
        redirect('auth/login');
        return; // Arrête l'exécution سی l'utilisateur ن'est pas connecté
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
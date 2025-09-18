<?php
require_once MODEL_PATH . '/rental_model.php';
require_once INCLUDE_PATH . '/helpers.php';

/**
 * Gère la location d'un média par un utilisateur
 * @param string $item_id Identifiant du média à emprunter
 */
function rental_rent($item_id)
{
    // Vérifie سی l'utilisateur است connecté
    if (!is_logged_in()) {
        set_flash('error', 'Vous devez vous connecter pour emprunter.');
        redirect('auth/login');
        return; // Arrête l'exécution سی l'utilisateur ن'est pas connecté
    }
    $user_id = current_user_id();
    if (!$user_id) {
        set_flash('error', 'Erreur : utilisateur non identifié.');
        redirect('auth/login');
        return;
    }
    // Crée une nouvelle location و vérifie le résultat
    $result = create_rental($user_id, $item_id);
    // Débogage : affiche le contenu de $result برای vérifier la structure
    error_log('rental_rent result: ' . print_r($result, true));
    if (is_array($result) && isset($result['success']) && $result['success'] === true) {
        set_flash('success', 'Emprunté avec succès !');
    } else {
        // Vérifie دقیق‌تر برای اطمینان از وجود پیام خطا
        $error_message = (is_array($result) && isset($result['error']) && !empty($result['error'])) ? $result['error'] : 'Erreur inconnue lors de l\'emprunt (vérifiez les logs pour plus de détails).';
        set_flash('error', $error_message);
    }
    redirect('rental/my_rentals');
}

/**
 * Affiche la liste des locations د'utilisateur (actives و historiques)
 */
function rental_my_rentals()
{
    // Vérifie سی l'utilisateur است connecté
    if (!is_logged_in()) {
        redirect('auth/login');
        return; // Arrête l'exécution سی l'utilisateur ن'est پاس connecté
    }
    $user_id = current_user_id();
    // Prépare les données برای la vue با locations actives و historiques
    $data = [
        'title' => 'Mes Locations',
        'active_rentals' => get_user_rentals_by_status($user_id, 'active'),
        'returned_rentals' => get_user_rentals_by_status($user_id, 'returned'),
        'hide_nav' => true  // Masquer la barre de navigation برای cette page
    ];
    load_view_with_layout('rental/my_rentals', $data);
}

/**
 * Gère le retour d'un média emprunté
 * @param int $rental_id Identifiant de la location à retourner
 */
function rental_return($rental_id)
{
    // Vérifie سی l'utilisateur است connecté
    if (!is_logged_in()) {
        redirect('auth/login');
        return; // Arrête l'exécution سی l'utilisateur ن'est پاس connecté
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

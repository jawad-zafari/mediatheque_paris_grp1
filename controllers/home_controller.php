<?php
/**
 * Contrôleur pour les pages statiques et la gestion du profil
 */

/* =========================================================
   PAGES STATIQUES
========================================================= */
function home_about() {
    $data = [
        'title' => 'À propos'
    ];
    load_view_with_layout('home/about', $data);
}

function home_contact() {
    $data = [
        'title' => 'Contact'
    ];
    load_view_with_layout('home/contact', $data);
}

/* =========================================================
   GESTION DU PROFIL UTILISATEUR
========================================================= */
function home_profile() {
    if (!is_logged_in()) {
        redirect('auth/login');
    }
    
    /* Appel du modèle et récupération des informations dans la couche contrôleur */
    require_once MODEL_PATH . '/borrow_model.php';
    $user_id = current_user_id();
    $active_rentals = get_user_rentals_by_status($user_id, 'active');
    
    $data = [
        'title' => 'Mon Profil',
        'active_rentals' => $active_rentals /* Envoyer la variable à la couche de vue */
    ];
    load_view_with_layout('home/profile', $data);
}


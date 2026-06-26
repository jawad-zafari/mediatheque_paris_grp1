<?php
/**
 * Contrôleur pour les pages statiques (À propos, Contact)
 */

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

function home_profile() {
    if (!is_logged_in()) {
        redirect('auth/login');
    }
    
    $data = [
        'title' => 'Mon Profil'
    ];
    load_view_with_layout('home/profile', $data);
}

?>
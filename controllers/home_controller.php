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

/**
 * Traitement du formulaire de mise à jour du profil (Architecture MVC)
 */
function home_update_profile() {
    if (!is_logged_in()) {
        redirect('auth/login');
    }

    if (!is_post()) {
        redirect('home/profile');
    }

    if (!verify_csrf_token(post('csrf_token', ''))) {
        set_flash('error', 'Token CSRF invalide.');
        redirect('home/profile');
        return;
    }

    require_once MODEL_PATH . '/user_model.php';

    $user_id = current_user_id();
    $name = mb_convert_case(clean_input(post('name')), MB_CASE_TITLE, 'UTF-8');
    $last_name = mb_convert_case(clean_input(post('last_name')), MB_CASE_TITLE, 'UTF-8');
    $email = clean_input(post('email'));
    
    $current_password = post('current_password');
    $new_password = post('new_password');
    $confirm_new_password = post('confirm_new_password');

    $errors = [];

    if (empty($name) || empty($last_name) || empty($email)) {
        $errors[] = 'Le nom, prénom et email sont obligatoires.';
    }
    if (!preg_match('/^[A-Za-zÀ-ÖØ-öø-ÿ\- ]{2,50}$/u', $name) || !preg_match('/^[A-Za-zÀ-ÖØ-öø-ÿ\- ]{2,50}$/u', $last_name)) {
        $errors[] = 'Le nom et prénom doivent contenir uniquement des lettres.';
    }
    if (!validate_email($email)) {
        $errors[] = 'Adresse email invalide.';
    }

    $existing_user = get_user_by_email($email);
    if ($existing_user && $existing_user['id'] != $user_id) {
        $errors[] = 'Cette adresse email est déjà utilisée par un autre compte.';
    }

    $hashed_password = null;
    
    /* Logique stricte de modification de mot de passe (MVC) */
    if (!empty($new_password)) {
        $user_db = get_user_by_id($user_id); // Récupérer l'utilisateur actuel
        
        if (empty($current_password) || !password_verify($current_password, $user_db['password'])) {
            $errors[] = 'Le mot de passe actuel est incorrect.';
        } elseif ($new_password !== $confirm_new_password) {
            $errors[] = 'Les nouveaux mots de passe ne correspondent pas.';
        } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $new_password)) {
            $errors[] = 'Le nouveau mot de passe doit contenir au moins 8 caractères avec 1 majuscule, 1 minuscule et 1 chiffre.';
        } else {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        }
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            set_flash('error', $error);
        }
        redirect('home/profile');
        return;
    }

    if (update_user_profile($user_id, $name, $last_name, $email, $hashed_password)) {
        $_SESSION['user']['name'] = $name;
        $_SESSION['user']['last_name'] = $last_name;
        $_SESSION['user']['email'] = $email;
        set_flash('success', 'Vos informations ont été mises à jour avec succès.');
    } else {
        set_flash('error', 'Erreur lors de la mise à jour du profil.');
    }

    redirect('home/profile');
}
?>
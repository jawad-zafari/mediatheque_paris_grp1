<?php
/**
 * Vérifie si l'utilisateur est admin
 */
function require_admin() {
    if (!is_logged_in() || $_SESSION['user']['role'] !== 'admin') {
        set_flash('error', 'Accès non autorisé');
        redirect('/');
    }
}

/**
 * Récupère tous les utilisateurs
 */
function get_all_users() {
    return db_select("SELECT id, name, last_name, email, role, created_at FROM users ORDER BY created_at DESC");
}

/**
 * Récupère un utilisateur par son ID
 */
function get_user_by_id($id) {
    return db_select_one("SELECT id, name, last_name, email, password, role, created_at FROM users WHERE id = ?", [$id]);
}

/**
 * Compte le nombre total d'utilisateurs
 */
function count_users() {
    $result = db_select_one("SELECT COUNT(*) as total FROM users");
    return $result['total'] ?? 0;
}

/**
 * Récupère un utilisateur par son email
 */
function get_user_by_email($email) {
    return db_select_one("SELECT id, name, last_name, email, password, role, created_at FROM users WHERE email = ? LIMIT 1", [$email]);
}

/**
 * Crée un nouvel utilisateur
 */
function create_user($name, $last_name, $email, $password, $role = 'user') {
    $db = db_connect();
    $hashed_password = hash_password($password);
    $query = "INSERT INTO users (name, last_name, email, password, role) VALUES (?, ?, ?, ?, ?)";
    return db_execute($query, [$name, $last_name, $email, $hashed_password, $role]);
}

/**
 * Met à jour un utilisateur
 */
function update_user($id, $name, $last_name, $email, $role) {
    $query = "UPDATE users SET name = ?, last_name = ?, email = ?, role = ? WHERE id = ?";
    return db_execute($query, [$name, $last_name, $email, $role, $id]);
}
?>
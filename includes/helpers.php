<?php
// Fonctions utilitaires

/**
 * Sécurise l'affichage d'une chaîne de caractères (protection XSS)
 */
function escape($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

/**
 * Affiche une chaîne sécurisée (échappée)
 */
function e($string) {
    echo escape($string);
}

/**
 * Retourne une chaîne sécurisée sans l'afficher
 */
function esc($string) {
    return escape($string);
}

/**
 * Génère une URL absolue
 */
function url($path = '') {
    $base_url = rtrim(BASE_URL, '/');
    $path = ltrim($path, '/');
    return $base_url . '/' . $path;
}

/**
 * Redirection HTTP
 */
function redirect($path = '') {
    $url = url($path);
    header("Location: $url");
    exit;
}

/**
 * Génère un token CSRF
 */
function csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Vérifie un token CSRF
 */
function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Définit un message flash
 */
function set_flash($type, $message) {
    $_SESSION['flash_messages'][$type][] = $message;
}

/**
 * Récupère et supprime les messages flash
 */
function get_flash_messages($type = null) {
    if (!isset($_SESSION['flash_messages'])) {
        return [];
    }

    if ($type) {
        $messages = $_SESSION['flash_messages'][$type] ?? [];
        unset($_SESSION['flash_messages'][$type]);
        return $messages;
    }

    $messages = $_SESSION['flash_messages'];
    unset($_SESSION['flash_messages']);
    return $messages;
}

/**
 * Vérifie s'il y a des messages flash
 */
function has_flash_messages($type = null) {
    if (!isset($_SESSION['flash_messages'])) {
        return false;
    }

    if ($type) {
        return !empty($_SESSION['flash_messages'][$type]);
    }

    return !empty($_SESSION['flash_messages']);
}

/**
 * Nettoie une entrée utilisateur
 */
function clean_input($input) {
    return trim(strip_tags($input));
}

/**
 * Valide une adresse email
 */
function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Génère un mot de passe aléatoire
 */
function generate_random_password($length = 12) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}

/**
 * Hache un mot de passe
 */
function hash_password($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

/**
 * Vérifie un mot de passe
 */
function verify_password($password, $hash) {
    return password_verify($password, $hash);
}

/**
 * Récupère le fuseau horaire de l'utilisateur à partir de son IP (stocké en session pour éviter les appels répétés)
 */
function get_user_timezone() {
    if (isset($_SESSION['user_timezone'])) {
        return $_SESSION['user_timezone'];
    }

    $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    // Éviter les appels API pour les adresses locales
    if ($ip === '127.0.0.1' || $ip === '::1') {
        $_SESSION['user_timezone'] = 'Europe/Paris';
        return 'Europe/Paris';
    }

    $url = "http://ip-api.com/json/{$ip}?fields=status,message,timezone";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);
    
    if (isset($data['status']) && $data['status'] === 'success' && isset($data['timezone'])) {
        $_SESSION['user_timezone'] = $data['timezone'];
        return $data['timezone'];
    }

    // Fallback à Europe/Paris si l'API échoue
    $_SESSION['user_timezone'] = 'Europe/Paris';
    return 'Europe/Paris';
}

/**
 * Formate une date selon le fuseau horaire local de l'utilisateur
 */
function format_date($date, $format = 'd/m/Y H:i:s') {
    $user_timezone = get_user_timezone();
    $dt = new DateTime($date, new DateTimeZone('UTC')); // Supposer que la date stockée est en UTC
    $dt->setTimezone(new DateTimeZone($user_timezone));
    return $dt->format($format);
}

/**
 * Vérifie si une requête است en POST
 */
function is_post() {
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

/**
 * Vérifie سی une requête است en GET
 */
function is_get() {
    return $_SERVER['REQUEST_METHOD'] === 'GET';
}

/**
 * Retourne la valeur د'un paramètre POST
 */
function post($key, $default = null) {
    return $_POST[$key] ?? $default;
}

/**
 * Retourne la valeur د'un paramètre GET
 */
function get($key, $default = null) {
    return $_GET[$key] ?? $default;
}

/**
 * Vérifie سی un utilisateur است connecté
 */
function is_logged_in() {
    return isset($_SESSION['user']) && !empty($_SESSION['user']['id']);
}

/**
 * Retourne l'ID de ل'utilisateur connecté
 */
function current_user_id() {
    return $_SESSION['user']['id'] ?? null;
}

/**
 * Déconnecte l'utilisateur
 */
function logout() {
    session_destroy();
    redirect('auth/login');
}

/**
 * Formate un nombre
 */
function format_number($number, $decimals = 2) {
    return number_format($number, $decimals, ',', ' ');
}

/**
 * Génère un slug à partir د'une chaîne
 */
function generate_slug($string) {
    $string = strtolower($string);
    $string = preg_replace('/[^a-z0-9\s-]/', '', $string);
    $string = preg_replace('/[\s-]+/', '-', $string);
    return trim($string, '-');
}

/**
 * Calcule le nombre de jours de retard pour un emprunt
 */
function calculate_days_late($return_date, $returned_at) {
    $return_date_timestamp = strtotime($return_date);
    if ($returned_at === null) {
        $now = time();
        return ($now > $return_date_timestamp) ? floor(($now - $return_date_timestamp) / 86400) : 0;
    }
    $returned_timestamp = strtotime($returned_at);
    return ($returned_timestamp > $return_date_timestamp) ? floor(($returned_timestamp - $return_date_timestamp) / 86400) : 0;
}

/**
 * Envoi un email de confirmation pour une location (optionnel, commenté par défaut)
 */
/*
function send_confirmation_email($user_id, $media_id, $media_type, $loan_date, $return_date) {
    $user = get_user_by_id($user_id);
    $media_title = '';
    switch ($media_type) {
        case 'book':
            $book = db_select_one("SELECT title FROM books WHERE id = ?", [$media_id]);
            $media_title = $book['title'];
            break;
        case 'movie':
            $movie = db_select_one("SELECT title FROM movies WHERE id = ?", [$media_id]);
            $media_title = $movie['title'];
            break;
        case 'video_game':
            $game = db_select_one("SELECT title FROM video_games WHERE id = ?", [$media_id]);
            $media_title = $game['title'];
            break;
    }
    if ($user && $media_title) {
        $to = $user['email'];
        $subject = 'Confirmation de votre emprunt';
        $message = "Bonjour {$user['name']},\n\nVous avez emprunté '{$media_title}' le {$loan_date}. La date de retour prévue est le {$return_date}.\n\nMerci!";
        $headers = 'From: no-reply@mediatheque.com';
        mail($to, $subject, $message, $headers);
    }
}
*/
?>
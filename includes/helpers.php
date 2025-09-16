<?php
// Fonctions utilitaires

function escape($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function e($string) {
    echo escape($string);
}

function esc($string) {
    return escape($string);
}

function url($path = '') {
    $base_url = rtrim(BASE_URL, '/');
    $path = ltrim($path, '/');
    return $base_url . '/' . $path;
}

function redirect($path = '') {
    $url = url($path);
    header("Location: $url");
    exit;
}

function csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

function set_flash($type, $message) {
    $_SESSION['flash_messages'][$type][] = $message;
}

function get_flash_messages($type = null) {
    if (!isset($_SESSION['flash_messages'])) return [];
    if ($type) {
        $messages = $_SESSION['flash_messages'][$type] ?? [];
        unset($_SESSION['flash_messages'][$type]);
        return $messages;
    }
    $messages = $_SESSION['flash_messages'];
    unset($_SESSION['flash_messages']);
    return $messages;
}

function has_flash_messages($type = null) {
    if (!isset($_SESSION['flash_messages'])) return false;
    return $type ? !empty($_SESSION['flash_messages'][$type]) : !empty($_SESSION['flash_messages']);
}

function clean_input($input) {
    return trim(strip_tags($input));
}

function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function generate_random_password($length = 12) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}

function hash_password($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

function verify_password($password, $hash) {
    return password_verify($password, $hash);
}

function format_date($date, $format = 'd/m/Y H:i') {
    return date($format, strtotime($date));
}

function is_post() {
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function is_get() {
    return $_SERVER['REQUEST_METHOD'] === 'GET';
}

function post($key, $default = null) {
    return $_POST[$key] ?? $default;
}

function get($key, $default = null) {
    return $_GET[$key] ?? $default;
}

function is_logged_in() {
    // ✅ ajout expiration session 2h
    if (!isset($_SESSION['user']) || empty($_SESSION['user']['id'])) return false;
    $max_inactive = 7200; // 2h
    $now = time();
    if (isset($_SESSION['user']['last_activity']) && ($now - $_SESSION['user']['last_activity']) > $max_inactive) {
        logout(true);
        return false;
    }
    $_SESSION['user']['last_activity'] = $now;
    return true;
}

function current_user_id() {
    return $_SESSION['user']['id'] ?? null;
}

function logout($silent = false) {
    if (!$silent) set_flash('success', 'Vous avez été déconnecté.');
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
    redirect('auth/login');
}

function format_number($number, $decimals = 2) {
    return number_format($number, $decimals, ',', ' ');
}

function generate_slug($string) {
    $string = strtolower($string);
    $string = preg_replace('/[^a-z0-9\s-]/', '', $string);
    $string = preg_replace('/[\s-]+/', '-', $string);
    return trim($string, '-');
}
?>

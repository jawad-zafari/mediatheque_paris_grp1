<?php
// Routeur principal de l'application
// Require view.php pour utiliser load_view_with_layout

require_once CORE_PATH . '/view.php';

/**
 * Routeur principal
 */
function route() {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = trim(str_replace(rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'), '', $uri), '/');
    $segments = explode('/', $uri);

    $controller = !empty($segments[0]) ? $segments[0] : 'home';
    $action = !empty($segments[1]) ? $segments[1] : 'index';
    $params = array_slice($segments, 2);

    // Mappage spécial pour les routes admin simples (media → media_list, etc.)
    if ($controller === 'admin') {
        $action_map = [
            'media' => 'media_list',
            'users' => 'users_list',
            'loans' => 'loans_list'
        ];
        if (isset($action_map[$action])) {
            $action = $action_map[$action];
        }
    }

    // Charger le contrôleur
    $controller_file = CONTROLLER_PATH . '/' . $controller . '_controller.php';
    if (file_exists($controller_file)) {
        require_once $controller_file;
        $function = $controller . '_' . $action;
        if (function_exists($function)) {
            call_user_func_array($function, $params);
        } else {
            http_response_code(404);
            load_view_with_layout('errors/404');
        }
    } else {
        http_response_code(404);
        load_view_with_layout('errors/404');
    }
}
?>
<?php 
$url_actuelle = $_GET['url'] ?? '';
$hide_banner_auto = false;

if (
    strpos($url_actuelle, 'catalog/detail') === 0 || 
    strpos($url_actuelle, 'borrow/my') === 0 || 
    strpos($url_actuelle, 'my_borrow') !== false ||
    strpos($url_actuelle, 'detail') !== false ||
    strpos($url_actuelle, 'profile') !== false ||
    (isset($title) && strpos($title, 'Détails') !== false) || 
    (isset($hide_banner) && $hide_banner)
) {
    $hide_banner_auto = true;
}

$active_loans_count = 0;
if (is_logged_in()) {
    require_once MODEL_PATH . '/borrow_model.php';
    $active_loans_count = count_active_loans(current_user_id());
}
?>

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
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? esc($title) . ' - ' . APP_NAME : APP_NAME; ?></title>
    
    <?php
        $cssPath = PUBLIC_PATH . '/assets/css/style.css';
        $ver = file_exists($cssPath) ? filemtime($cssPath) : (defined('APP_VERSION') ? APP_VERSION : time());
    ?>
    
    <link rel="stylesheet" href="<?php echo url('assets/css/banner.css') . '?v=' . $ver; ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/borrow.css') . '?v=' . $ver; ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/catalog.css') . '?v=' . $ver; ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/home.css') . '?v=' . $ver; ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/header.css') . '?v=' . $ver; ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/layout.css') . '?v=' . $ver; ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/style(@media).css') . '?v=' . $ver; ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/auth.css') . '?v=' . $ver; ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body data-logged-in="<?php echo is_logged_in() ? 'true' : 'false'; ?>">

    <?php if (!isset($hide_nav)): ?>
        <?php require_once VIEW_PATH . '/layouts/header.php'; ?>
        
        <?php 
        $afficher_banner = !$hide_banner_auto && !(strpos($url_actuelle, 'detail') !== false || strpos($url_actuelle, 'borrow') !== false || strpos($url_actuelle, 'auth') !== false || strpos($url_actuelle, 'profile') !== false);
        ?>
        
        <?php if ($afficher_banner): ?>
            <?php require_once VIEW_PATH . '/layouts/banner.php'; ?>
        <?php endif; ?>
    <?php endif; ?>

    <main class="main-content">
        <?php if (has_flash_messages()): ?>
            <div id="flash-data-public" data-flash="<?php echo htmlspecialchars(json_encode(get_flash_messages())); ?>"></div>
        <?php endif; ?>

        <?php echo $content ?? ''; ?>
    </main>

    <?php 
        /* Chargement du composant Footer de maniere dynamique */
        $footer_path = VIEW_PATH . '/layouts/footer.php';
        if(file_exists($footer_path)) {
            require_once $footer_path;
        }
    ?>

    <script src="<?php echo url('assets/js/borrow.js'); ?>"></script>   
    <script src="<?php echo url('assets/js/app.js'); ?>"></script>
    <script src="<?php echo url('assets/js/search.js'); ?>"></script>
    <script src="<?php echo url('assets/js/catalog.js'); ?>"></script>
</body>
</html>
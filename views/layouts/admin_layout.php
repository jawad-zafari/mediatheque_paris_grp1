<?php
$active_loans_count = 0;
if (is_logged_in()) {
    if (!function_exists('count_active_loans')) {
        require_once MODEL_PATH . '/borrow_model.php';
    }
    $active_loans_count = count_active_loans(current_user_id());
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? esc($title) . ' - Admin' : 'Admin Panel'; ?></title>
    
    <?php
        $cssPath = PUBLIC_PATH . '/assets/css/style.css';
        $ver = file_exists($cssPath) ? filemtime($cssPath) : (defined('APP_VERSION') ? APP_VERSION : time());
        
        $adminCss = PUBLIC_PATH . '/assets/css/admin.css';
        $adminVer = file_exists($adminCss) ? filemtime($adminCss) : $ver;
    ?>
    <link rel="stylesheet" href="<?php echo url('assets/css/header.css') . '?v=' . $ver; ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/admin.css') . '?v=' . $adminVer; ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body data-logged-in="<?php echo is_logged_in() ? 'true' : 'false'; ?>">

    <?php 
    $header_path = VIEW_PATH . '/layouts/header.php';
    if(file_exists($header_path)) {
        require_once $header_path;
    }
    ?>

    <div class="modern-admin-layout">
        
        <div class="sidebar-placeholder">
            <?php require_once VIEW_PATH . '/admin/sidebar.php'; ?>
        </div>

        <div class="modern-main-wrapper">
            <main class="modern-content-body">
                
                <?php if (has_flash_messages()): ?>
                    <div id="flash-data-admin" data-flash="<?php echo htmlspecialchars(json_encode(get_flash_messages())); ?>"></div>
                <?php endif; ?>
                
                <?php echo $content ?? ''; ?>
            </main>
        </div>

    </div>

    <script src="<?php echo url('assets/js/app.js'); ?>"></script>
    <script src="<?php echo url('assets/js/admin.js'); ?>"></script>
    <script src="<?php echo url('assets/js/header.js'); ?>"></script>
    <script src="<?php echo url('assets/js/search.js'); ?>"></script>
</body>
</html>
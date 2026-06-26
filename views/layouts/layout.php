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
    <link rel="stylesheet" href="<?php echo url('assets/css/style.css') . '?v=' . $ver; ?>">
    <?php if (!empty($is_admin)): ?>
        <?php
            $adminCss = PUBLIC_PATH . '/assets/css/admin.css';
            $adminVer = file_exists($adminCss) ? filemtime($adminCss) : $ver;
        ?>
        <link rel="stylesheet" href="<?php echo url('assets/css/admin.css') . '?v=' . $adminVer; ?>">
    <?php endif; ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php if (!isset($hide_nav)): ?>  <!-- Masquer le header si $hide_nav est défini -->
   <?php if (!isset($hide_nav)): ?>
<header class="header">
    <nav class="navbar">
        <div class="nav-brand"><a href="<?php echo url(); ?>"><?php echo APP_NAME; ?></a></div>
        <input type="checkbox" id="menu-toggle" class="menu-toggle">
        <label for="menu-toggle" class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </label>
        <ul class="nav-menu">
            <li><a class="nav-link" href="<?php echo url('rental/my_rentals'); ?>" target="rental_tab">Mes Emprunts</a></li>
            <li><a href="<?php echo url('home/about'); ?>">À propos</a></li>
            <li><a href="<?php echo url('home/contact'); ?>">Contact</a></li>
            
            <?php if (is_logged_in()): ?>
                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                    <li>
                        <a href="<?php echo url('admin/dashboard'); ?>" title="Administration">
                            <i class="fas fa-cog fa-2x"></i>
                        </a>
                    </li>
                <?php endif; ?>
                
                <li>
                    <a href="<?php echo url('home/profile'); ?>" title="Mon Profil">
                        <i class="fas fa-user-circle fa-2x"></i>
                    </a>
                </li>
            <?php else: ?>
                <li>
                    <a href="<?php echo url('auth/login'); ?>" title="Connexion">
                        <i class="far fa-user-circle fa-2x"></i>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<?php endif; ?>
    <?php endif; ?>

    <main class="main-content">
        <?php flash_messages(); ?>
        <?php echo $content ?? ''; ?>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <p>&copy; <?php echo date('Y'); ?> <?php echo APP_NAME; ?>. Tous droits réservés.</p>
            <p>Version <?php echo APP_VERSION; ?></p>
        </div>
    </footer>

    <script src="<?php echo url('assets/js/app.js'); ?>"></script>
</body>
</html>
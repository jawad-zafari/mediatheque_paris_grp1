<?php
$loans_badge_count = $active_loans_count ?? 0;
?>
<header class="header">
    <input type="checkbox" id="menu-toggle" class="menu-toggle">
    
    <nav class="navbar">
        <div class="nav-brand-wrapper">
            <label for="menu-toggle" class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </label>
            <div class="nav-brand">
                <a href="<?php echo url(); ?>"><?php echo APP_NAME ?? 'Médiathèque'; ?></a>
            </div>
        </div>

        <div class="header-search-container">
            <?php 
                $search_component_path = VIEW_PATH . '/layouts/search.php';
                if(file_exists($search_component_path)) {
                    require $search_component_path;
                }
            ?>
        </div>

        <div class="nav-icons-group">
            <a href="<?php echo is_logged_in() ? url('borrow/index') : url('auth/login'); ?>" class="nav-icon-link" title="Mes Emprunts">
                <i class="fas fa-book-reader"></i>
                <?php if (is_logged_in()): ?>
                    <span id="borrow-counter" class="nav-badge <?php echo $loans_badge_count > 0 ? 'visible' : 'hidden'; ?>">
                        <?php echo $loans_badge_count; ?>
                    </span>
                <?php endif; ?>
            </a>

            <?php if (is_logged_in() && isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                <a href="<?php echo url('admin/dashboard'); ?>" class="nav-icon-link admin-icon" title="Administration">
                    <i class="fas fa-user-shield"></i>
                </a>
            <?php endif; ?>
            
            <a href="<?php echo is_logged_in() ? url('home/profile') : url('auth/login'); ?>" class="nav-icon-link user-icon" title="Profil">
                <i class="fas fa-user"></i>
            </a>
        </div>
    </nav>

    <ul class="mobile-nav-menu">
        <li><a href="<?php echo url(); ?>"><i class="fas fa-home"></i> Accueil</a></li>
        <li><a href="<?php echo url('catalog/index'); ?>"><i class="fas fa-list"></i> Catalogue</a></li>
        <li><a href="<?php echo url('home/about'); ?>"><i class="fas fa-info-circle"></i> À propos</a></li>
        <li><a href="<?php echo url('home/contact'); ?>"><i class="fas fa-envelope"></i> Contact</a></li>
    </ul>
</header>
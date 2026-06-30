<?php 
$url_actuelle = $_GET['url'] ?? '';
$pending_validation_count = function_exists('get_pending_returns_count') ? get_pending_returns_count() : 0; 
?>
<aside class="modern-sidebar" id="adminSidebar">
    
    <div class="sidebar-brand">
        <button class="hamburger-btn" id="sidebarToggleBtn" title="Menu">
            <i class="fas fa-bars"></i>
        </button>
        <span class="brand-text">Admin Panel</span>
    </div>
    
    <nav class="sidebar-nav">
        <ul>
            <li>
                <a href="<?php echo url('admin/dashboard'); ?>" class="<?php echo ($url_actuelle === 'admin/dashboard' || $url_actuelle === 'admin') ? 'active' : ''; ?>">
                    <i class="fas fa-chart-pie"></i>
                    <span class="nav-text">Tableau de bord</span>
                </a>
            </li>
            <li>
                <a href="<?php echo url('admin/media'); ?>" class="<?php echo (strpos($url_actuelle, 'admin/media') === 0) ? 'active' : ''; ?>">
                    <i class="fas fa-film"></i>
                    <span class="nav-text">Gestion Médias</span>
                </a>
            </li>
            <li>
                <a href="<?php echo url('admin/users'); ?>" class="<?php echo (strpos($url_actuelle, 'admin/users') === 0 || strpos($url_actuelle, 'admin/user_detail') === 0) ? 'active' : ''; ?>">
                    <i class="fas fa-users"></i>
                    <span class="nav-text">Utilisateurs</span>
                </a>
            </li>
            <li>
                <a href="<?php echo url('admin/loans'); ?>" class="<?php echo (strpos($url_actuelle, 'admin/loans') === 0 || strpos($url_actuelle, 'admin/loan_edit') === 0) ? 'active' : ''; ?>">
                    <i class="fas fa-clock"></i>
                    <span class="nav-text">Gestion Emprunts</span>
                    <?php if ($pending_validation_count > 0): ?>
                        <span class="admin-loan-badge">
                            <?php echo $pending_validation_count; ?>
                        </span>
                    <?php endif; ?>
                </a>
            </li>
            <li class="sidebar-separator"></li>
            <li>
                <a href="<?php echo url('catalog/index'); ?>" class="back-to-site">
                    <i class="fas fa-arrow-left"></i>
                    <span class="nav-text">Retour au Site</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>
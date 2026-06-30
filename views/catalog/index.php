<?php
$build_url = function($type, $genre, $availability) {
    $params = [];
    if (!empty($type) && $type !== 'all') $params['type'] = $type;
    if (!empty($genre) && $genre !== 'all') $params['genre'] = $genre;
    if (!empty($availability) && $availability !== 'all') $params['availability'] = $availability;
    if (!empty($_GET['search_term'])) $params['search_term'] = $_GET['search_term'];
    $query = !empty($params) ? '?' . http_build_query($params) : '';
    return url('catalog/index') . $query;
};

$c_type = $search_type ?? 'all';
$c_genre = $search_genre ?? 'all';
$c_status = $search_availability ?? 'all';
$genres_disponibles = $genres_list ?? [];
$current_page = isset($current_page) ? (int)$current_page : (int)($_GET['page'] ?? 1);
$total_pages = isset($total_pages) ? (int)$total_pages : 1;
?>

<section class="container top-stats-wrapper">
    <div class="media-stats-container">
        <a href="<?php echo $build_url('book', 'all', 'all'); ?>" class="media-stats-box <?php echo $c_type === 'book' ? 'active-card' : ''; ?>">
            <div class="media-stats-content">
                <h3><i class="fas fa-book media-box-icon icon-book"></i> Livres</h3>
            </div>
        </a>

        <a href="<?php echo $build_url('film', 'all', 'all'); ?>" class="media-stats-box <?php echo $c_type === 'film' ? 'active-card' : ''; ?>">
            <div class="media-stats-content">
                <h3><i class="fas fa-film media-box-icon icon-film"></i> Films</h3>
            </div>
        </a>

        <a href="<?php echo $build_url('game', 'all', 'all'); ?>" class="media-stats-box <?php echo $c_type === 'game' ? 'active-card' : ''; ?>">
            <div class="media-stats-content">
                <h3><i class="fas fa-gamepad media-box-icon icon-game"></i> Jeux</h3>
            </div>
        </a>
    </div>
</section>

<section class="container catalog-header-section">
    <div class="catalog-section-header">
        <h2>
            <?php 
            if (!empty($_GET['search_term'])) {
                echo "Résultats de recherche";
            } elseif ($c_genre !== 'all') {
                echo "Genre : " . htmlspecialchars($c_genre);
            }
            ?>
        </h2>
    </div>
</section>

<section class="container catalog-unified-layout">
    
    <div class="sidebar-spacer" id="sidebarSpacer">
        <aside class="catalog-page-sidebar" id="catalogSidebar">
            
            <div class="sidebar-brand">
                <button class="hamburger-btn" id="catalogSidebarToggleBtn" title="Menu">
                    <div class="animated-hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </button>
                <span class="brand-text">Filtres</span>
            </div>
            
            <nav class="sidebar-nav">
                <ul>
                    <li>
                        <a href="<?php echo $build_url('all', 'all', $c_status); ?>" class="<?php echo $c_type === 'all' && $c_genre === 'all' ? 'active' : ''; ?>">
                            <i class="fas fa-layer-group"></i>
                            <span class="nav-text">Tout voir</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $build_url('book', $c_genre, $c_status); ?>" class="<?php echo $c_type === 'book' ? 'active' : ''; ?>">
                            <i class="fas fa-book"></i>
                            <span class="nav-text">Livres</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $build_url('film', $c_genre, $c_status); ?>" class="<?php echo $c_type === 'film' ? 'active' : ''; ?>">
                            <i class="fas fa-film"></i>
                            <span class="nav-text">Films</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $build_url('game', $c_genre, $c_status); ?>" class="<?php echo $c_type === 'game' ? 'active' : ''; ?>">
                            <i class="fas fa-gamepad"></i>
                            <span class="nav-text">Jeux Vidéo</span>
                        </a>
                    </li>
                    
                    <li class="sidebar-separator"></li>
                    
                    <li class="sidebar-genre-dropdown">
                        <div class="genre-dropdown-trigger <?php echo $c_genre !== 'all' ? 'active' : ''; ?>" id="catalogGenreToggle">
                            <i class="fas fa-tags"></i>
                            <span class="nav-text">Genres <i class="fas fa-chevron-down arrow-icon"></i></span>
                        </div>
                        <div class="genre-dropdown-content <?php echo $c_genre !== 'all' ? 'open' : ''; ?>" id="catalogGenreMenu">
                            <ul>
                                <li>
                                    <a href="<?php echo $build_url($c_type, 'all', $c_status); ?>" class="<?php echo $c_genre === 'all' ? 'active' : ''; ?>">
                                        <span class="nav-text">Tous les genres</span>
                                    </a>
                                </li>
                                <?php foreach ($genres_disponibles as $g): ?>
                                    <li>
                                        <a href="<?php echo $build_url($c_type, $g, $c_status); ?>" class="<?php echo $c_genre === $g ? 'active' : ''; ?>">
                                            <span class="nav-text"># <?php echo htmlspecialchars($g); ?></span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="sidebar-separator"></li>
                    
                    <li>
                        <a href="<?php echo $build_url($c_type, $c_genre, $c_status === 'true' ? 'all' : 'true'); ?>" class="stock-toggle-link <?php echo $c_status === 'true' ? 'active' : ''; ?>">
                            <i class="<?php echo $c_status === 'true' ? 'fas fa-check-square' : 'far fa-square'; ?>"></i>
                            <span class="nav-text">En Stock</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>
    </div>

    
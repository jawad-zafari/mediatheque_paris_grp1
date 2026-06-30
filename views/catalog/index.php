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

    <main class="catalog-main-content">
        <div class="grid-container">
            <?php if (empty($items)): ?>
                <p class="no-results">Aucun média trouvé.</p>
            <?php else: ?>
                <?php foreach ($items as $item): ?>
                    <div class="item">
                        <div class="card-img-wrapper">
                            <img src="<?php echo htmlspecialchars($item['image_url'] ?? 'https://via.placeholder.com/300'); ?>" alt="">
                            <div class="card-overlay">
                                <a href="<?php echo url('catalog/detail/' . $item['id']); ?>" class="card-icon-btn" title="Voir détails"><i class="fas fa-eye"></i></a>
                                <?php if (isset($item['stock']) && $item['stock'] > 0): ?>
                                    <a href="<?php echo url('borrow/rent/' . $item['id']); ?>" 
                                       class="card-icon-btn rent-btn btn-borrow" 
                                       title="Emprunter"
                                       data-login-url="<?php echo url('auth/login'); ?>">
                                        <i class="fas fa-book-reader"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-content-detailed">
                            <div class="card-header-meta">
                                <div class="card-status">
                                    <?php echo isset($item['stock']) && $item['stock'] > 0 ? '<span class="available">Disponible</span>' : '<span class="unavailable">Indisponible</span>'; ?>
                                </div>
                                
                                <?php if (($item['type'] ?? '') === 'book'): ?>
                                    <div class="card-type-icon type-book">
                                        <i class="fas fa-book" title="Livre"></i>
                                    </div>
                                <?php elseif (($item['type'] ?? '') === 'film'): ?>
                                    <div class="card-type-icon type-film">
                                        <i class="fas fa-film" title="Film"></i>
                                    </div>
                                <?php elseif (($item['type'] ?? '') === 'game'): ?>
                                    <div class="card-type-icon type-game">
                                        <i class="fas fa-gamepad" title="Jeu Vidéo"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <h3 class="card-title"><?php echo htmlspecialchars($item['title'] ?? 'Sans titre'); ?></h3>
                            <p class="card-author"><i class="fas fa-user-edit"></i> <?php echo htmlspecialchars($item['author_director_publisher'] ?? 'Inconnu'); ?></p>
                            <p class="card-year"><i class="fas fa-calendar-alt"></i> <?php echo htmlspecialchars($item['year'] ?? 'N/A'); ?></p>
                            <p class="card-desc"><?php echo htmlspecialchars($item['description'] ?? 'Aucune description disponible pour ce média.'); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="pagination-container-ajax">
            <?php if (isset($total_pages) && $total_pages > 1): ?>
                <div class="pagination">
                    <?php if ($current_page > 1): ?>
                        <a href="<?php echo url('catalog/index?page=' . ($current_page - 1) . '&type=' . $c_type . '&genre=' . $c_genre . '&availability=' . $c_status); ?>" class="btn-prev-page"><i class="fas fa-chevron-left"></i> Précédent</a>
                    <?php endif; ?>

                    <div class="page-numbers">
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <a href="<?php echo url('catalog/index?page=' . $i . '&type=' . $c_type . '&genre=' . $c_genre . '&availability=' . $c_status); ?>" class="page-number <?php echo $i == $current_page ? 'active' : ''; ?>"><?php echo $i; ?></a>
                        <?php endfor; ?>
                    </div>

                    <?php if ($current_page < $total_pages): ?>
                        <a href="<?php echo url('catalog/index?page=' . ($current_page + 1) . '&type=' . $c_type . '&genre=' . $c_genre . '&availability=' . $c_status); ?>" class="btn-next-page">Suivant <i class="fas fa-chevron-right"></i></a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>
</section>
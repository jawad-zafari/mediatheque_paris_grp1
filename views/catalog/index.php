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


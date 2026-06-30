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


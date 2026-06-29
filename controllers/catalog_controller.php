<?php
require_once MODEL_PATH . '/catalog_model.php';

function catalog_index() {
    $search_term = $_GET['search_term'] ?? '';
    $search_type = $_GET['type'] ?? 'all';
    $search_genre = $_GET['genre'] ?? 'all';
    $search_availability = $_GET['availability'] ?? 'all';

    $per_page = 20;
    $current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    
    $total_items = get_items_count_by_type($search_type, $search_term, $search_genre, $search_availability);
    $total_pages = max(1, ceil($total_items / $per_page));
    $current_page = max(1, min($current_page, $total_pages));
    $offset = ($current_page - 1) * $per_page;
    
    $items = get_items_by_type($search_type, $search_term, $search_genre, $search_availability, $per_page, $offset);
    
    $genres_list = get_all_genres();

    $data = [
        'title' => 'Catalogue',
        'items' => $items,
        'current_page' => $current_page,
        'total_pages' => $total_pages,
        'search_term' => $search_term,
        'search_type' => $search_type,
        'search_genre' => $search_genre,
        'search_availability' => $search_availability,
        'genres_list' => $genres_list 
    ];
    
    load_view_with_layout('catalog/index', $data);
}


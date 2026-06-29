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

function catalog_detail($id = null) {
    if (!$id) {
        header('Location: ' . url('catalog/index'));
        exit;
    }

    $item = get_item_by_id($id);

    if (!$item) {
        header('Location: ' . url('catalog/index'));
        exit;
    }

    // Fetch a small list of similar items of the same type
    // get_items_by_type($search_type, $search_term, $search_genre, $search_availability, $per_page, $offset)
    $similar_items = get_items_by_type($item['type'], '', 'all', 'all', 5, 0);

    $data = [
        'title' => 'Détails - ' . $item['title'],
        'item' => $item,
        'similar_items' => $similar_items
    ];
    
    load_view_with_layout('catalog/detail', $data);
}

function catalog_live_search() {
    $query = $_GET['q'] ?? '';
    
    if (strlen(trim($query)) < 2) {
        header('Content-Type: application/json');
        echo json_encode([]);
        exit;
    }

    $results = live_search_query($query);
    
    header('Content-Type: application/json');
    echo json_encode($results);
    exit;
}
?>
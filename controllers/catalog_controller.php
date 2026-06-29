<?php
require_once MODEL_PATH . '/catalog_model.php';

function catalog_index() {
    $search_term = $_GET['search_term'] ?? '';
    $search_type = $_GET['type'] ?? 'all';
    $search_genre = $_GET['genre'] ?? 'all';
    $search_availability = $_GET['availability'] ?? 'all';

    $per_page = 20;
    $current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    
   
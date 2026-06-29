<?php
require_once CORE_PATH . '/database.php';

function get_item_by_id($item_id) {
    $pdo = db_connect();
    $parts = explode('_', $item_id);
    if (count($parts) != 2) {
        error_log("Invalid item_id format: $item_id");
        return false;
    }
    $type = $parts[0];
    $pure_id = (int)$parts[1];

    if ($type == 'book') {
        $query = "SELECT CONCAT('book_', id) AS id, title, writer AS author_director_publisher, ISBN13 AS isbn_rating_platform, gender AS genre, page_number AS pages_duration_min_age, synopsis AS description, year, available, stock, image_url, 'book' AS type, upload_date 
                  FROM books WHERE id = ?";
    } elseif ($type == 'film') {
        $query = "SELECT CONCAT('film_', id) AS id, title, producer AS author_director_publisher, classification AS isbn_rating_platform, gender AS genre, duration AS pages_duration_min_age, synopsis AS description, year, available, stock, image_url, 'film' AS type, upload_date 
                  FROM movies WHERE id = ?";
    } elseif ($type == 'game') {
        $query = "SELECT CONCAT('game_', id) AS id, title, editor AS author_director_publisher, plateform AS isbn_rating_platform, gender AS genre, min_age AS pages_duration_min_age, description, year, available, stock, image_url, 'game' AS type, upload_date 
                  FROM video_games WHERE id = ?";
    } else {
        error_log("Invalid item type: $type");
        return false;
    }

    $stmt = $pdo->prepare($query);
    $stmt->execute([$pure_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ?: false;
}

function get_items_by_type($type, $search_term = '', $search_genre = 'all', $search_availability = 'all', $per_page = 20, $offset = 0) {
    $pdo = db_connect();
    $conditions = [];
    $params = [];

    if (!empty($search_term)) {
        $conditions[] = "LOWER(title) LIKE LOWER(?)";
        $params[] = "%" . trim($search_term) . "%";
    }

    if ($search_genre != 'all') {
        $conditions[] = "gender = ?";
        $params[] = $search_genre;
    }

    if ($search_availability != 'all') {
        if ($search_availability == 'true') {
            $conditions[] = "stock > 0";
        } else {
            $conditions[] = "stock = 0";
        }
    }

    $condition_str = !empty($conditions) ? " WHERE " . implode(" AND ", $conditions) : "";

    $queries = [];
    if ($type === 'book' || $type === 'all') {
        $queries[] = "SELECT CONCAT('book_', id) AS id, title, writer AS author_director_publisher, ISBN13 AS isbn_rating_platform, gender AS genre, page_number AS pages_duration_min_age, synopsis AS description, year, available, stock, image_url, 'book' AS type, upload_date FROM books" . $condition_str;
    }
    if ($type === 'film' || $type === 'all') {
        $queries[] = "SELECT CONCAT('film_', id) AS id, title, producer AS author_director_publisher, classification AS isbn_rating_platform, gender AS genre, duration AS pages_duration_min_age, synopsis AS description, year, available, stock, image_url, 'film' AS type, upload_date FROM movies" . $condition_str;
    }
    if ($type === 'game' || $type === 'all') {
        $queries[] = "SELECT CONCAT('game_', id) AS id, title, editor AS author_director_publisher, plateform AS isbn_rating_platform, gender AS genre, min_age AS pages_duration_min_age, description, year, available, stock, image_url, 'game' AS type, upload_date FROM video_games" . $condition_str;
    }

    $final_query = implode(" UNION ALL ", $queries) . " ORDER BY upload_date DESC LIMIT ? OFFSET ?";
    
    $final_params = [];
    foreach ($queries as $q) {
        foreach ($params as $p) {
            $final_params[] = $p;
        }
    }
    $final_params[] = (int)$per_page;
    $final_params[] = (int)$offset;

    $stmt = $pdo->prepare($final_query);
    foreach ($final_params as $index => $value) {
        $stmt->bindValue($index + 1, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
    }
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


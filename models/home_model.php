<?php

/**
 * -----------------------------
 * FONCTIONS POUR LE TABLEAU DE BORD
 * -----------------------------
 */



/**
 * Récupère le nombre total de médias par type
 */
function get_total_media_count() {
    $books = db_select_one("SELECT COUNT(*) AS total FROM books")['total'] ?? 0;
    $movies = db_select_one("SELECT COUNT(*) AS total FROM movies")['total'] ?? 0;
    $video_games = db_select_one("SELECT COUNT(*) AS total FROM video_games")['total'] ?? 0;

    return $books + $movies + $video_games;
}



/**
 * Récupère toutes les statistiques du tableau de bord
 */
function get_dashboard_stats() {
    $books = db_select_one("SELECT COUNT(*) AS total FROM books");
    $movies = db_select_one("SELECT COUNT(*) AS total FROM movies");
    $video_games = db_select_one("SELECT COUNT(*) AS total FROM video_games");

    return [
        'users_count' => count_users(),
        'media_count' => get_total_media_count(),
        'loans_count' => get_rentals_count(),
        'media_stats' => [
            'books' => isset($books['total']) ? $books['total'] : 0,
            'movies' => isset($movies['total']) ? $movies['total'] : 0,
            'video_games' => isset($video_games['total']) ? $video_games['total'] : 0,
        ],
    ];
}


/**
 * Récupère tous les médias
 */
function get_all_media($limit = null, $offset = 0) {
    $query = "
        SELECT id, title, 'book' AS media_type, gender AS genre, stock FROM books
        UNION ALL
        SELECT id, title, 'movie' AS media_type, gender AS genre, stock FROM movies
        UNION ALL
        SELECT id, title, 'video_game' AS media_type, gender AS genre, stock FROM video_games
        ORDER BY title ASC
    ";
    if ($limit !== null) {
        $query .= " LIMIT $offset, $limit";
    }
    return db_select($query);
}

/**
 * Récupère un média par son ID et son type
 */
function get_media_by_id($id, $type) {
    $db = db_connect();
    switch($type) {
        case 'book':
        case 'livre':
            $stmt = $db->prepare("SELECT * FROM books WHERE id = ?");
            break;
        case 'movie':
        case 'film':
            $stmt = $db->prepare("SELECT * FROM movies WHERE id = ?");
            break;
        case 'video_game':
        case 'jeu':
            $stmt = $db->prepare("SELECT * FROM video_games WHERE id = ?");
            break;
        default:
            return false;
    }
    $stmt->execute([$id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $result['media_type'] = $type === 'livre' ? 'book' : ($type === 'film' ? 'movie' : ($type === 'jeu' ? 'video_game' : $type));
        $result['genre'] = $result['gender'] ?? $result['genre']; // Fix: compatibilité gender/genre
    }
    return $result;
}

/**
 * Compte le nombre total de médias
 */
function get_media_count() {
    $db = db_connect();
    return $db->query("
        SELECT 
            (SELECT COUNT(*) FROM books) +
            (SELECT COUNT(*) FROM movies) +
            (SELECT COUNT(*) FROM video_games) AS total
    ")->fetchColumn();
}

/**
 * Crée un nouveau média
 */
function create_media($type, $data) {
    $db = db_connect();
    switch($type) {
        case 'book':
            $stmt = $db->prepare("INSERT INTO books (title, writer, ISBN13, gender, page_number, synopsis, year, stock, available, image_url, upload_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            return $stmt->execute([
                $data['title'], $data['writer'] ?? '', $data['ISBN13'] ?? '', $data['genre'] ?? '',
                $data['page_number'] ?? 0, $data['synopsis'] ?? '', $data['year'] ?? 0, $data['stock'] ?? 1, 
                1, $data['image_url'] ?? '', date('Y-m-d')
            ]);
        case 'movie':
            $stmt = $db->prepare("INSERT INTO movies (title, producer, year, gender, duration_m, synopsis, classification, stock, available, image_url, upload_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            return $stmt->execute([
                $data['title'], $data['producer'] ?? '', $data['year'] ?? 0, $data['genre'] ?? '',
                $data['duration_m'] ?? 0, $data['synopsis'] ?? '', $data['classification'] ?? '', $data['stock'] ?? 1,
                1, $data['image_url'] ?? '', date('Y-m-d')
            ]);
        case 'video_game':
            $stmt = $db->prepare("INSERT INTO video_games (title, editor, platform, gender, min_age, synopsis, year, stock, available, image_url, upload_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            return $stmt->execute([
                $data['title'], $data['editor'] ?? '', $data['platform'] ?? '', $data['genre'] ?? '',
                $data['min_age'] ?? 0, $data['synopsis'] ?? '', $data['year'] ?? 0, $data['stock'] ?? 1,
                1, $data['image_url'] ?? '', date('Y-m-d')
            ]);
        default:
            return false;
    }
}

/**
 * Met à jour un média
 */
function update_media($id, $type, $data) {
    $db = db_connect();
    switch($type) {
        case 'book':
        case 'livre':
            $stmt = $db->prepare("UPDATE books SET title = ?, writer = ?, ISBN13 = ?, gender = ?, page_number = ?, synopsis = ?, year = ?, stock = ?, image_url = ? WHERE id = ?");
            return $stmt->execute([
                $data['title'], $data['writer'] ?? '', $data['ISBN13'] ?? '', $data['genre'] ?? '',
                $data['page_number'] ?? 0, $data['synopsis'] ?? '', $data['year'] ?? 0, $data['stock'] ?? 1, 
                $data['image_url'] ?? '', $id
            ]);
        case 'movie':
        case 'film':
            $stmt = $db->prepare("UPDATE movies SET title = ?, producer = ?, year = ?, gender = ?, duration_m = ?, synopsis = ?, classification = ?, stock = ?, image_url = ? WHERE id = ?");
            return $stmt->execute([
                $data['title'], $data['producer'] ?? '', $data['year'] ?? 0, $data['genre'] ?? '',
                $data['duration_m'] ?? 0, $data['synopsis'] ?? '', $data['classification'] ?? '', $data['stock'] ?? 1, 
                $data['image_url'] ?? '', $id
            ]);
        case 'video_game':
        case 'jeu':
            $stmt = $db->prepare("UPDATE video_games SET title = ?, editor = ?, platform = ?, gender = ?, min_age = ?, synopsis = ?, year = ?, stock = ?, image_url = ? WHERE id = ?");
            return $stmt->execute([
                $data['title'], $data['editor'] ?? '', $data['platform'] ?? '', $data['genre'] ?? '',
                $data['min_age'] ?? 0, $data['synopsis'] ?? '', $data['year'] ?? 0, $data['stock'] ?? 1, 
                $data['image_url'] ?? '', $id
            ]);
        default:
            return false;
    }
}

/**
 * Supprime un média
 */
function delete_media($id, $type) {
    $db = db_connect();
    switch($type) {
        case 'book':
        case 'livre':
            $stmt = $db->prepare("DELETE FROM books WHERE id = ?");
            break;
        case 'movie':
        case 'film':
            $stmt = $db->prepare("DELETE FROM movies WHERE id = ?");
            break;
        case 'video_game':
        case 'jeu':
            $stmt = $db->prepare("DELETE FROM video_games WHERE id = ?");
            break;
        default:
            return false;
    }
    return $stmt->execute([$id]);
}


function media_upload_image($type, $data, $image) {
    $errors = [];
    $success = "";

    if (!$image || $image['error'] === UPLOAD_ERR_NO_FILE) {
        return ["errors" => $errors, "success" => $success];
    }

    if ($image['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "Erreur lors de l'upload de l'image.";
    }

    if ($image['size'] > 2097152) {
        $errors[] = "Le fichier est trop volumineux (max 2 Mo).";
    }

    $allowedExt = ['jpg','jpeg','png','gif'];
    $fileExt = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

    $dim = getimagesize($image['tmp_name']);
    if ($dim === false) {
        $errors[] = "Le fichier n'est pas une image valide.";
    } else {
        if ($dim[0] < 100 || $dim[1] < 100) {
            $errors[] = "L'image doit avoir au minimum 100x100 pixels.";
        }
        $mime = image_type_to_mime_type($dim[2]);
        if (!in_array($fileExt, $allowedExt) || !in_array($mime, ['image/jpeg','image/png','image/gif'])) {
            $errors[] = "Format non supporté. Formats acceptés : JPG, PNG, GIF.";
        }
    }

    if (empty($errors)) {
        $newName = uniqid("media_", true).".".$fileExt;
        $uploadDir = __DIR__ . "/../uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        if (move_uploaded_file($image['tmp_name'], $uploadDir.$newName)) {
            $success = $newName;
        } else {
            $errors[] = "Impossible d'enregistrer l'image.";
        }
    }

    return ["errors" => $errors, "success" => $success];
}

<?php

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
    switch ($type) {
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
    return $stmt->fetch(PDO::FETCH_ASSOC);
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
    switch ($type) {
        case 'book':
        case 'livre':
            $stmt = $db->prepare("INSERT INTO books 
                (title, writer, ISBN13, gender, page_number, synopsis, year, stock, available, image_url, upload_date) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            return $stmt->execute([
                $data['title'], $data['writer'] ?? '', $data['ISBN13'] ?? '', $data['genre'] ?? '',
                $data['page_number'] ?? 0, $data['synopsis'] ?? '', $data['year'] ?? 0,
                $data['stock'] ?? 1, 1, $data['image_url'] ?? '', date('Y-m-d')
            ]);
        case 'movie':
        case 'film':
            $stmt = $db->prepare("INSERT INTO movies 
                (title, producer, year, gender, duration_m, synopsis, classification, stock, available, image_url, upload_date) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            return $stmt->execute([
                $data['title'], $data['producer'] ?? '', $data['year'] ?? 0, $data['genre'] ?? '',
                $data['duration_m'] ?? 0, $data['synopsis'] ?? '', $data['classification'] ?? '',
                $data['stock'] ?? 1, 1, $data['image_url'] ?? '', date('Y-m-d')
            ]);
        case 'video_game':
        case 'jeu':
            $stmt = $db->prepare("INSERT INTO video_games 
                (title, editor, platform, gender, min_age, synopsis, year, stock, available, image_url, upload_date) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            return $stmt->execute([
                $data['title'], $data['editor'] ?? '', $data['platform'] ?? '', $data['genre'] ?? '',
                $data['min_age'] ?? 0, $data['synopsis'] ?? '', $data['year'] ?? 0,
                $data['stock'] ?? 1, 1, $data['image_url'] ?? '', date('Y-m-d')
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
    switch ($type) {
        case 'book':
        case 'livre':
            $stmt = $db->prepare("UPDATE books 
                SET title = ?, writer = ?, ISBN13 = ?, gender = ?, page_number = ?, synopsis = ?, year = ?, stock = ?, image_url = ? 
                WHERE id = ?");
            return $stmt->execute([
                $data['title'], $data['writer'] ?? '', $data['ISBN13'] ?? '', $data['genre'] ?? '',
                $data['page_number'] ?? 0, $data['synopsis'] ?? '', $data['year'] ?? 0,
                $data['stock'] ?? 1, $data['image_url'] ?? '', $id
            ]);
        case 'movie':
        case 'film':
            $stmt = $db->prepare("UPDATE movies 
                SET title = ?, producer = ?, year = ?, gender = ?, duration_m = ?, synopsis = ?, classification = ?, stock = ?, image_url = ? 
                WHERE id = ?");
            return $stmt->execute([
                $data['title'], $data['producer'] ?? '', $data['year'] ?? 0, $data['genre'] ?? '',
                $data['duration_m'] ?? 0, $data['synopsis'] ?? '', $data['classification'] ?? '',
                $data['stock'] ?? 1, $data['image_url'] ?? '', $id
            ]);
        case 'video_game':
        case 'jeu':
            $stmt = $db->prepare("UPDATE video_games 
                SET title = ?, editor = ?, platform = ?, gender = ?, min_age = ?, synopsis = ?, year = ?, stock = ?, image_url = ? 
                WHERE id = ?");
            return $stmt->execute([
                $data['title'], $data['editor'] ?? '', $data['platform'] ?? '', $data['genre'] ?? '',
                $data['min_age'] ?? 0, $data['synopsis'] ?? '', $data['year'] ?? 0,
                $data['stock'] ?? 1, $data['image_url'] ?? '', $id
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
    switch ($type) {
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

/**
 * Upload et redimensionne une image de couverture
 */
function upload_cover_image($file) {
    $allowed_ext = ['jpg','jpeg','png','gif'];
    $max_size = 2097152; // 2 Mo
    $min_width = 100;
    $min_height = 100;
    $max_width = 300;
    $max_height = 400;
    $upload_dir = PUBLIC_PATH . '/uploads/covers/';

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['errors' => ['Erreur lors de l’upload'], 'success' => ''];
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed_ext)) {
        return ['errors' => ['Extension non autorisée'], 'success' => ''];
    }

    if ($file['size'] > $max_size) {
        return ['errors' => ['Fichier trop volumineux (>2Mo)'], 'success' => ''];
    }

    [$width, $height] = getimagesize($file['tmp_name']);
    if ($width < $min_width || $height < $min_height) {
        return ['errors' => ['Dimensions trop petites'], 'success' => ''];
    }

    $src = imagecreatefromstring(file_get_contents($file['tmp_name']));
    $ratio = min($max_width / $width, $max_height / $height, 1);
    $new_width = (int)($width * $ratio);
    $new_height = (int)($height * $ratio);

    $dst = imagecreatetruecolor($new_width, $new_height);
    imagecopyresampled($dst, $src, 0,0,0,0, $new_width,$new_height, $width,$height);

    $new_name = uniqid('cover_') . '.' . $ext;
    $save_path = $upload_dir . $new_name;

    if ($ext === 'jpg' || $ext === 'jpeg') imagejpeg($dst, $save_path);
    elseif ($ext === 'png') imagepng($dst, $save_path);
    elseif ($ext === 'gif') imagegif($dst, $save_path);

    imagedestroy($src);
    imagedestroy($dst);

    return ['errors' => [], 'success' => $new_name];
}

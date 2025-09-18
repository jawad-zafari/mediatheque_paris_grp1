<?php
// Modèle pour le catalogue

/**
 * Récupère les 20 premiers livres
 * Commentaire: Simplification des colonnes pour éviter les erreurs, utilisation de gender
 */
function get_all_books() {
    $query = "SELECT CONCAT('book_', id) AS id, title, writer AS author_director_publisher, ISBN13 AS isbn_rating_platform, gender AS genre, page_number AS pages_duration_min_age, synopsis AS description, year, available, stock, image_url, 'book' AS type, upload_date 
              FROM books ORDER BY id DESC LIMIT 20";
    return db_select($query);
}

/**
 * Récupère les 20 premiers films
 * Commentaire: Simplification des colonnes pour éviter les erreurs, utilisation de gender
 */
function get_all_movies() {
    $query = "SELECT CONCAT('film_', id) AS id, title, producer AS author_director_publisher, classification AS isbn_rating_platform, gender AS genre, duration AS pages_duration_min_age, synopsis AS description, year, available, stock, image_url, 'film' AS type, upload_date 
              FROM movies ORDER BY id DESC LIMIT 20";
    return db_select($query);
}

/**
 * Récupère les 20 premiers jeux vidéo
 * Commentaire: Simplification des colonnes pour éviter les erreurs, utilisation de gender
 */
function get_all_video_games() {    
    $query = "SELECT CONCAT('game_', id) AS id, title, editor AS author_director_publisher, plateform AS isbn_rating_platform, gender AS genre, min_age AS pages_duration_min_age, description, year, available, stock, image_url, 'game' AS type, upload_date 
              FROM video_games ORDER BY id DESC LIMIT 20";
    return db_select($query);
}

/**
 * Récupère l'id des docs
 * Commentaire: Fonction non utilisée dans la vue actuelle, حفظ شده برای سازگاری
 */
function get_id(){
    $query = "SELECT id FROM movies, books, video_games";
    return db_select($query);
}

/**
 * Récupère les articles du catalogue en fonction du genre filtré
 * Commentaire: Fonction غیرفعال شده چون جست‌وجو حذف شده، اما برای سازگاری حفظ می‌شود
 */
function get_articles_by_gender($gender) {    
    $query = "SELECT CONCAT('book_', id) AS id, title, writer AS author_director_publisher, ISBN13 AS isbn_rating_platform, gender AS genre, page_number AS pages_duration_min_age, synopsis AS description, year, available, stock, image_url, 'book' AS type, upload_date 
              FROM books WHERE gender = :gender_filter 
              UNION
              SELECT CONCAT('film_', id) AS id, title, producer AS author_director_publisher, classification AS isbn_rating_platform, gender AS genre, duration AS pages_duration_min_age, synopsis AS description, year, available, stock, image_url, 'film' AS type, upload_date 
              FROM movies WHERE gender = :gender_filter
              UNION
              SELECT CONCAT('game_', id) AS id, title, editor AS author_director_publisher, plateform AS isbn_rating_platform, gender AS genre, min_age AS pages_duration_min_age, description, year, available, stock, image_url, 'game' AS type, upload_date 
              FROM video_games WHERE gender = :gender_filter";
    return db_select($query, [':gender_filter' => $gender]);
}

/**
 * Récupère les articles du catalogue selon le filtre "stock"
 * Commentaire: Fonction غیرفعال شده چون جست‌وجو حذف شده، اما برای سازگاری حفظ می‌شود
 */
function get_articles_by_stock_all() {
    $query = "SELECT CONCAT('book_', id) AS id, title, writer AS author_director_publisher, ISBN13 AS isbn_rating_platform, gender AS genre, page_number AS pages_duration_min_age, synopsis AS description, year, available, stock, image_url, 'book' AS type, upload_date FROM books
              UNION
              SELECT CONCAT('film_', id) AS id, title, producer AS author_director_publisher, classification AS isbn_rating_platform, gender AS genre, duration AS pages_duration_min_age, synopsis AS description, year, available, stock, image_url, 'film' AS type, upload_date FROM movies
              UNION
              SELECT CONCAT('game_', id) AS id, title, editor AS author_director_publisher, plateform AS isbn_rating_platform, gender AS genre, min_age AS pages_duration_min_age, description, year, available, stock, image_url, 'game' AS type, upload_date FROM video_games";
    return db_select($query);
}
function get_articles_by_stock_free() {
    $query = "SELECT CONCAT('book_', id) AS id, title, writer AS author_director_publisher, ISBN13 AS isbn_rating_platform, gender AS genre, page_number AS pages_duration_min_age, synopsis AS description, year, available, stock, image_url, 'book' AS type, upload_date FROM books WHERE stock > 0
              UNION
              SELECT CONCAT('film_', id) AS id, title, producer AS author_director_publisher, classification AS isbn_rating_platform, gender AS genre, duration AS pages_duration_min_age, synopsis AS description, year, available, stock, image_url, 'film' AS type, upload_date FROM movies WHERE stock > 0
              UNION
              SELECT CONCAT('game_', id) AS id, title, editor AS author_director_publisher, plateform AS isbn_rating_platform, gender AS genre, min_age AS pages_duration_min_age, description, year, available, stock, image_url, 'game' AS type, upload_date FROM video_games WHERE stock > 0";
    return db_select($query);
}
function get_articles_by_stock_loaned() {
    $query = "SELECT CONCAT('book_', id) AS id, title, writer AS author_director_publisher, ISBN13 AS isbn_rating_platform, gender AS genre, page_number AS pages_duration_min_age, synopsis AS description, year, available, stock, image_url, 'book' AS type, upload_date FROM books WHERE stock = 0
              UNION
              SELECT CONCAT('film_', id) AS id, title, producer AS author_director_publisher, classification AS isbn_rating_platform, gender AS genre, duration AS pages_duration_min_age, synopsis AS description, year, available, stock, image_url, 'film' AS type, upload_date FROM movies WHERE stock = 0
              UNION
              SELECT CONCAT('game_', id) AS id, title, editor AS author_director_publisher, plateform AS isbn_rating_platform, gender AS genre, min_age AS pages_duration_min_age, description, year, available, stock, image_url, 'game' AS type, upload_date FROM video_games WHERE stock = 0";
    return db_select($query);
}
?>
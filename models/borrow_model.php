<?php
require_once CORE_PATH . '/database.php';
require_once MODEL_PATH . '/catalog_model.php';

/* Compter le nombre total d'emprunts */
function get_rentals_count() {
    $query = "SELECT COUNT(*) as total FROM loans";
    $result = db_select_one($query);
    return $result['total'] ?? 0;
}


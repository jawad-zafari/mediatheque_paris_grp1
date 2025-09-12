<?php
// Point d'entrée principal de l'application
session_start();

// Require le bootstrap pour charger tout (configs, paths, models, controllers)
require_once __DIR__ . '/../bootstrap.php';

// Lancer le routeur
route();
?>
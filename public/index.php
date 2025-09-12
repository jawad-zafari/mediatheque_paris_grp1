<?php
/**
 * Point d'entrée principal de l'application PHP MVC
 * 
 * Ce fichier initialise l'application et lance le système de routing
 */

// Démarrer la session
session_start();

// Charger la configuration
require_once '../config/database.php';

// Vérifier et définir les constantes pour les chemins si non définies (pour éviter les redéfinitions)
if (!defined('CORE_PATH')) {
    define('CORE_PATH', __DIR__ . '/../core/');
}
if (!defined('INCLUDE_PATH')) {
    define('INCLUDE_PATH', __DIR__ . '/../includes/');
}
if (!defined('MODEL_PATH')) {
    define('MODEL_PATH', __DIR__ . '/../models/');
}
if (!defined('CONTROLLER_PATH')) {
    define('CONTROLLER_PATH', __DIR__ . '/../controllers/');
}
if (!defined('VIEW_PATH')) {
    define('VIEW_PATH', __DIR__ . '/../views/');
}
if (!defined('BASE_URL')) {
    define('BASE_URL', '/');
}

// Charger les fichiers core
require_once CORE_PATH . '/database.php';
require_once CORE_PATH . '/router.php';
require_once CORE_PATH . '/view.php';

// Charger les fichiers utilitaires
require_once INCLUDE_PATH . '/helpers.php';

// Activer l'affichage des erreurs en développement
// À désactiver en production
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Lancer le système de routing
dispatch();
?>
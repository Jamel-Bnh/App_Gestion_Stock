<?php
// Include error handler first
require_once __DIR__ . '/includes/error_handler.php';

// Activer l'affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configuration du logging
ini_set('log_errors', 1);
ini_set('error_log', '/var/log/php/error.log');

// Log de démarrage
browserLog('=== Chargement de config.php ===');

// Configuration de la base de données
$db_host = getenv('DB_HOST') ?: 'db';
$db_user = getenv('DB_USER') ?: 'user';  // Default from docker-compose
$db_pass = getenv('DB_PASSWORD') ?: 'password';  // Default from docker-compose
$db_name = getenv('DB_NAME') ?: 'app_stock';

// Log des variables d'environnement (sans les mots de passe)
browserLog('Configuration DB:', [
    'host' => $db_host,
    'user' => $db_user,
    'database' => $db_name
]);

// Tentative de connexion à la base de données
try {
    $link_db = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($link_db->connect_error) {
        throw new Exception("Erreur de connexion à la base de données: " . $link_db->connect_error);
    }

    // Configuration de l'encodage
    $link_db->set_charset("utf8mb4");
    
    browserLog("Connexion à la base de données réussie", 'info');
    error_log('MySQL Connected Successfully');
} catch (Exception $e) {
    browserLog("ERREUR: " . $e->getMessage(), "error");
    error_log('MySQL Connection Exception: ' . $e->getMessage());
    // Ne pas afficher l'erreur directement aux utilisateurs
    // Don't die here, let the application handle the error
    throw $e;
}
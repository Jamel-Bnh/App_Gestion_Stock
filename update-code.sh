#!/bin/bash

echo "🔄 Mise à jour du code..."

# Arrêt des conteneurs
echo "⏹️ Arrêt des conteneurs..."
docker-compose down

# Sauvegarde des fichiers de configuration
echo "💾 Sauvegarde des configurations..."
cp frontend-php/config.php frontend-php/config.php.bak
cp frontend-php/myheader.php frontend-php/myheader.php.bak

# Mise à jour des fichiers
echo "📝 Mise à jour des fichiers..."
cat > frontend-php/config.php << 'EOL'
<?php
// Afficher les erreurs en développement
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configuration des sessions AVANT le démarrage
if (session_status() === PHP_SESSION_NONE) {
    // Définir le chemin de sauvegarde des sessions
    ini_set('session.save_handler', 'files');
    ini_set('session.save_path', '/tmp');
    
    // Configuration de sécurité des sessions
    ini_set('session.gc_maxlifetime', 3600);
    ini_set('session.cookie_lifetime', 3600);
    ini_set('session.cookie_secure', 0);
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_strict_mode', 1);
    ini_set('session.use_cookies', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cache_limiter', 'nocache');
    
    session_start();
}

// Configuration de la base de données
define('DB_HOST', getenv('DB_HOST') ?: 'db');
define('DB_USER', getenv('DB_USER') ?: 'user');
define('DB_PASSWORD', getenv('DB_PASSWORD') ?: 'password');
define('DB_NAME', getenv('DB_NAME') ?: 'app_stock');

// Connexion à la base de données
$link_db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$link_db) {
    error_log("Erreur de connexion MySQL: " . mysqli_connect_error());
    die("Une erreur est survenue lors de la connexion à la base de données.");
}
mysqli_set_charset($link_db, "utf8");
EOL

cat > frontend-php/myheader.php << 'EOL'
<?php
require_once 'config.php';

// Vérification de l'authentification
if (!isset($_SESSION['matricule'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="header">
        <div class="thetitle"></div>
        <div class="user_info">
            <?php if (isset($_SESSION['user_name'])): ?>
                <span><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
            <?php endif; ?>
            <a href="logout.php" class="btn btn-danger btn-sm">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </a>
        </div>
    </div>
EOL

# Redémarrage des conteneurs
echo "🔄 Redémarrage des conteneurs..."
docker-compose up -d --build

echo "✅ Mise à jour terminée !"
echo "📝 Accédez à votre application sur : http://localhost:8080"
echo "🔍 Pour voir les logs : docker-compose logs -f"
@echo off
echo 🔄 Mise à jour du code...

:: Arrêt des conteneurs
echo ⏹️ Arrêt des conteneurs...
docker-compose down

:: Sauvegarde des fichiers de configuration
echo 💾 Sauvegarde des configurations...
copy frontend-php\config.php frontend-php\config.php.bak
copy frontend-php\myheader.php frontend-php\myheader.php.bak

:: Mise à jour des fichiers
echo 📝 Mise à jour des fichiers...

:: Création de config.php avec le nouveau contenu
(
echo ^<?php
echo // Afficher les erreurs en développement
echo ini_set^('display_errors', 1^);
echo ini_set^('display_startup_errors', 1^);
echo error_reporting^(E_ALL^);
echo.
echo // Configuration des sessions AVANT le démarrage
echo if ^(session_status^(^) === PHP_SESSION_NONE^) {
echo     ini_set^('session.save_handler', 'files'^);
echo     ini_set^('session.save_path', '/tmp'^);
echo     ini_set^('session.gc_maxlifetime', 3600^);
echo     ini_set^('session.cookie_lifetime', 3600^);
echo     ini_set^('session.cookie_secure', 0^);
echo     ini_set^('session.cookie_httponly', 1^);
echo     ini_set^('session.use_strict_mode', 1^);
echo     ini_set^('session.use_cookies', 1^);
echo     ini_set^('session.use_only_cookies', 1^);
echo     ini_set^('session.cache_limiter', 'nocache'^);
echo     session_start^(^);
echo }
echo.
echo // Configuration de la base de données
echo define^('DB_HOST', getenv^('DB_HOST'^) ?: 'db'^);
echo define^('DB_USER', getenv^('DB_USER'^) ?: 'user'^);
echo define^('DB_PASSWORD', getenv^('DB_PASSWORD'^) ?: 'password'^);
echo define^('DB_NAME', getenv^('DB_NAME'^) ?: 'app_stock'^);
echo.
echo // Connexion à la base de données
echo $link_db = mysqli_connect^(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME^);
echo if ^(!$link_db^) {
echo     error_log^("Erreur de connexion MySQL: " . mysqli_connect_error^(^)^);
echo     die^("Une erreur est survenue lors de la connexion à la base de données."^);
echo }
echo mysqli_set_charset^($link_db, "utf8"^);
) > frontend-php\config.php

:: Redémarrage des conteneurs
echo 🔄 Redémarrage des conteneurs...
docker-compose up -d --build

echo ✅ Mise à jour terminée !
echo 📝 Accédez à votre application sur : http://localhost:8080
echo 🔍 Pour voir les logs : docker-compose logs -f
pause
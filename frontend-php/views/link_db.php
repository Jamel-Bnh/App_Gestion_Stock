<?php
// Paramètres de connexion à la base de données
$host = getenv('DB_HOST') ?: 'db';
$user = getenv('DB_USER') ?: 'user';
$password = getenv('DB_PASSWORD') ?: 'password';
$database = getenv('DB_NAME') ?: 'app_stock';

// Connexion à la base de données
$link_db = mysqli_connect($host, $user, $password, $database);

// Vérifier si la connexion a réussi
if (!$link_db) {
    error_log("ERREUR: Pas de connexion à la base de données - " . mysqli_connect_error());
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

// Set character set to utf8mb4
mysqli_set_charset($link_db, 'utf8mb4');
?>

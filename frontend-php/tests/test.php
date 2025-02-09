<?php
require '../config.php';

echo "<h1>Test de connexion</h1>";

if (isset($link_db) && $link_db) {
    echo "<p style='color: green;'>✅ Connexion à la base de données réussie !</p>";
    
    // Test de la session
    echo "<p>Session ID: " . session_id() . "</p>";
    echo "<p>Role utilisateur: " . ($_SESSION['user_role'] ?? 'Non défini') . "</p>";
    
    // Test de requête simple
    $query = "SELECT VERSION()";
    $result = mysqli_query($link_db, $query);
    if ($result) {
        $version = mysqli_fetch_row($result)[0];
        echo "<p>Version MySQL: " . htmlspecialchars($version) . "</p>";
    }
} else {
    echo "<p style='color: red;'>❌ Erreur de connexion à la base de données</p>";
}
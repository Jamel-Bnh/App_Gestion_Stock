<?php
require_once 'config.php';

echo "<h2>Test des Sessions</h2>";

// Afficher toutes les variables de session
echo "<h3>Variables de session actuelles :</h3>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

// Tester l'écriture d'une session
$_SESSION['test'] = 'test_value_' . time();
echo "<h3>Test d'écriture de session :</h3>";
echo "Valeur écrite : " . $_SESSION['test'] . "<br>";

// Vérifier les permissions du dossier de session
echo "<h3>Permissions du dossier de session :</h3>";
$session_path = session_save_path();
echo "Chemin : " . $session_path . "<br>";
echo "Permissions : " . substr(sprintf('%o', fileperms($session_path)), -4) . "<br>";
echo "Propriétaire : " . posix_getpwuid(fileowner($session_path))['name'] . "<br>";

// Tester le fichier de session
$session_file = $session_path . '/sess_' . session_id();
echo "<h3>Fichier de session :</h3>";
echo "Chemin : " . $session_file . "<br>";
if (file_exists($session_file)) {
    echo "✅ Le fichier de session existe<br>";
    echo "Taille : " . filesize($session_file) . " octets<br>";
} else {
    echo "❌ Le fichier de session n'existe pas<br>";
}
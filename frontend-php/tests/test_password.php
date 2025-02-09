<?php
require_once 'config.php';

$test_password = 'password123';
$matricule = '71149';

// Récupérer le hash stocké
$query = "SELECT mdp FROM users_stock WHERE matricule = ?";
$stmt = mysqli_prepare($link_db, $query);
mysqli_stmt_bind_param($stmt, "s", $matricule);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if ($user) {
    echo "Hash stocké pour $matricule: " . $user['mdp'] . "<br>";
    echo "Test password_verify: " . (password_verify($test_password, $user['mdp']) ? "OK" : "ÉCHEC") . "<br>";
    
    // Créer un nouveau hash pour comparaison
    $new_hash = password_hash($test_password, PASSWORD_BCRYPT);
    echo "Nouveau hash de test: " . $new_hash . "<br>";
    echo "Vérification du nouveau hash: " . (password_verify($test_password, $new_hash) ? "OK" : "ÉCHEC");
} else {
    echo "Utilisateur non trouvé";
}
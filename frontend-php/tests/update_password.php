<?php
require_once 'config.php';

// Fonction pour mettre à jour le mot de passe
function updatePassword($matricule, $newPassword) {
    global $link_db;
    
    // Hachage du mot de passe avec bcrypt
    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
    
    // Mise à jour dans la base de données
    $query = "UPDATE users_stock SET mdp = ? WHERE matricule = ?";
    $stmt = mysqli_prepare($link_db, $query);
    mysqli_stmt_bind_param($stmt, "ss", $hashedPassword, $matricule);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "✅ Mot de passe mis à jour pour $matricule<br>";
        // Vérification immédiate
        if (password_verify($newPassword, $hashedPassword)) {
            echo "✅ Vérification réussie pour $matricule<br>";
        } else {
            echo "❌ Échec de la vérification pour $matricule<br>";
        }
    } else {
        echo "❌ Erreur pour $matricule: " . mysqli_error($link_db) . "<br>";
    }
}

// Liste des utilisateurs et leurs nouveaux mots de passe
$users = [
    '71149' => 'password123', // Chaieb Farid
    '62047' => 'password123', // Mizouni Mahdi
    '62418' => 'password123', // Laadhari Hatem
    '64923' => 'password123', // Smaoui Majdi
    '71136' => 'password123', // Bejaoui Hamed
    '71145' => 'password123', // Ben Abdallah Karim
    '71148' => 'password123'  // Laghmani Bacem
];

echo "<h2>Mise à jour des mots de passe</h2>";

// Mise à jour des mots de passe
foreach ($users as $matricule => $password) {
    updatePassword($matricule, $password);
}

echo "<h3>Vérification finale</h3>";
foreach ($users as $matricule => $password) {
    $query = "SELECT mdp FROM users_stock WHERE matricule = ?";
    $stmt = mysqli_prepare($link_db, $query);
    mysqli_stmt_bind_param($stmt, "s", $matricule);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    
    if (password_verify($password, $user['mdp'])) {
        echo "✅ Vérification finale OK pour $matricule<br>";
    } else {
        echo "❌ Échec de la vérification finale pour $matricule<br>";
    }
}

echo "<br>Mise à jour terminée!";
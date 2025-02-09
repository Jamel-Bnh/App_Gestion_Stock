<?php
// nouvel_utilisateur.php

// Inclure les fichiers nécessaires
require_once 'config.php';
require_once 'includes/error_handler.php';

// Logique pour afficher le formulaire de création d'un nouvel utilisateur
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouvel Utilisateur</title>
</head>
<body>
    <h1>Créer un Nouvel Utilisateur</h1>
    <form action="create_user.php" method="post">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Créer</button>
    </form>
</body>
</html>
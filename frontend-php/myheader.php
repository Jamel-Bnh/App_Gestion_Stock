<?php
// Check if session is not already started before starting it
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'config.php';

// Vérification de l'authentification
if (!isset($_SESSION['matricule'])) {
    header('Location: /login.php'); // Mise à jour du chemin
    exit();
}

// Définir le rôle de l'utilisateur si non défini
if (!isset($_SESSION['user_role'])) {
    $_SESSION['user_role'] = 'UXXX';
}

$user_role = $_SESSION['user_role'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APP_STOCK</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css"> <!-- Mise à jour du chemin -->
    <link rel="stylesheet" href="/assets/fonts/fontawesome-all.min.css"> <!-- Mise à jour du chemin -->
    <link rel="stylesheet" href="/assets/css/styles.css"> <!-- Mise à jour du chemin -->
</head>
<body>
    <div class="header">
        <div class="thetitle"></div>
        <div class="user_info">
            <?php if (isset($_SESSION['user_name'])): ?>
                <span><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
            <?php endif; ?>
            <a href="/logout" class="btn btn-danger btn-sm"> <!-- Mise à jour du chemin -->
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </a>
        </div>
    </div>

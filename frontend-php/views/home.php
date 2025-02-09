<?php
// Démarrage de la session si elle n'est pas déjà active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
if (!isset($_SESSION['username'])) {
    header('Location: /login');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Configuration de base -->
    <meta charset="utf-8">
    <!-- Configuration pour la responsivité mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>AppStock DMSP</title>
    <!-- Favicon du site -->
    <link rel="icon" type="image/x-icon" href="/public/assets/img/favicon.ico">

    <!-- Chargement des feuilles de style -->
    <!-- Bootstrap pour la mise en page responsive -->
    <link rel="stylesheet" href="/public/assets/bootstrap/css/bootstrap.min.css">
    <!-- Polices Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cairo">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <!-- Icônes et styles personnalisés -->
    <link rel="stylesheet" href="/public/assets/css/fontello.css">
    <link rel="stylesheet" href="/public/assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="/public/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="/public/assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="/public/assets/fonts/material-icons.min.css">
    <link rel="stylesheet" href="/public/assets/fonts/fontawesome5-overrides.min.css">
    <!-- Styles CSS personnalisés -->
    <link rel="stylesheet" href="/public/assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="/public/assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="/public/assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="/public/assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="/public/assets/css/Projects-Clean.css">
    <link rel="stylesheet" href="/public/assets/css/Projects-Horizontal.css">
    <link rel="stylesheet" href="/public/assets/css/Responsive-Form-1.css">
    <link rel="stylesheet" href="/public/assets/css/Responsive-Form.css">
    <link rel="stylesheet" href="/public/assets/css/styles.css">
</head>

<!-- Style pour l'effet de survol des éléments du menu déroulant -->
<style>
    .dropdown-item:hover {
        background: #0062cc;
        color: #ffffff;
        font-weight: bold;
    }
</style>

<body>
    <!-- Barre de navigation principale -->
    <nav class="navbar navbar-dark" style="background-color: #000839;">
        <div class="container-fluid px-4">
            <!-- Logo et titre de l'application -->
            <a class="navbar-brand" href="/" style="color: #ffa41b;font-weight: bold;">AppStock DMSP&nbsp;<i class="fa fa-podcast"></i></a>
            <!-- Informations utilisateur et bouton de déconnexion -->
            <div class="d-flex align-items-center" style="gap: 20px;">
                <!-- Affichage du nom d'utilisateur s'il est connecté -->
                <span style="color: #ffa41b;">Bienvenue<?php echo isset($_SESSION['username']) ? ', ' . htmlspecialchars($_SESSION['username']) : ''; ?></span>
                <!-- Affichage du code utilisateur -->
                <span style="color: #ffa41b;"><?php echo isset($_SESSION['code']) ? htmlspecialchars($_SESSION['code']) : ''; ?></span>
                <!-- Lien de déconnexion -->
                <a href="/logout" style="color: #ffa41b;text-decoration: none;">Déconnexion</a>
            </div>
        </div>
    </nav>

    <!-- Affichage des messages d'erreur -->
    <?php if (isset($error)): ?>
        <div style="background-color: #000839; color: #ffa41b; padding: 2px 20px; font-size: 0.9em;">
            Notice: <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <!-- Section principale avec les cartes de menu -->
    <div style="margin-top: 150px;">
        <div class="container">
            <!-- Rangée de cartes de menu -->
            <div class="row justify-content-center" style="margin-bottom: 25px;">
                <!-- Carte Gestion des Magasins -->
                <div class="col-md-3">
                    <div style="background-color: #000839;padding: 10px;padding-right: 0px;padding-left: 0px;">
                        <h1 class="text-center" style="color: rgb(255,164,32);margin-bottom: 5px;font-size: 2em;">
                            <i class="fa fa-building fa-lg"></i>
                        </h1>
                        <h4 class="text-center" style="color: rgb(255,164,32);margin-bottom: 10px;font-size: 1.2em;">
                            Gestion des Magasins
                        </h4>
                        <div style="width: 90%;margin-right: 5%;margin-left: 5%;margin-bottom: 5px;">
                            <a href="/magasin" class="btn" style="width: 100%;padding: 5px;background-color: #007bff;color: white;box-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                Gérer les magasins
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Carte Gestion des Utilisateurs -->
                <div class="col-md-3">
                    <div style="background-color: #000839;padding: 10px;padding-right: 0px;padding-left: 0px;">
                        <h1 class="text-center" style="color: rgb(255,164,32);margin-bottom: 5px;font-size: 2em;">
                            <i class="fa fa-users fa-lg"></i>
                        </h1>
                        <h4 class="text-center" style="color: rgb(255,164,32);margin-bottom: 10px;font-size: 1.2em;">
                            Utilisateurs
                        </h4>
                        <div style="width: 90%;margin-right: 5%;margin-left: 5%;margin-bottom: 5px;">
                            <a href="/users" class="btn" style="width: 100%;padding: 5px;background-color: #007bff;color: white;box-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                Gérer les utilisateurs
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Carte Gestion du Stock -->
                <div class="col-md-3">
                    <div style="background-color: #000839;padding: 10px;padding-right: 0px;padding-left: 0px;">
                        <h1 class="text-center" style="color: rgb(255,164,32);margin-bottom: 5px;font-size: 2em;">
                            <i class="fa fa-box fa-lg"></i>
                        </h1>
                        <h4 class="text-center" style="color: rgb(255,164,32);margin-bottom: 10px;font-size: 1.2em;">
                            Stock
                        </h4>
                        <div style="width: 90%;margin-right: 5%;margin-left: 5%;margin-bottom: 5px;">
                            <a href="/stock" class="btn" style="width: 100%;padding: 5px;background-color: #007bff;color: white;box-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                Gérer le stock
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Carte Rapports -->
                <div class="col-md-3">
                    <div style="background-color: #000839;padding: 10px;padding-right: 0px;padding-left: 0px;">
                        <h1 class="text-center" style="color: rgb(255,164,32);margin-bottom: 5px;font-size: 2em;">
                            <i class="fa fa-chart-bar fa-lg"></i>
                        </h1>
                        <h4 class="text-center" style="color: rgb(255,164,32);margin-bottom: 10px;font-size: 1.2em;">
                            Rapports
                        </h4>
                        <div style="width: 90%;margin-right: 5%;margin-left: 5%;margin-bottom: 5px;">
                            <a href="/reports" class="btn" style="width: 100%;padding: 5px;background-color: #007bff;color: white;box-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                Voir les rapports
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chargement des scripts JavaScript -->
    <script src="/public/assets/js/jquery.min.js"></script>
    <script src="/public/assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
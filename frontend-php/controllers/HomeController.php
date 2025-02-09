<?php
class HomeController {
    public function index() {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_role'])) {
            header('Location: /login');
            exit();
        }
        
        // Si connecté, afficher la page d'accueil
        include 'views/home.php';
    }
}
?>
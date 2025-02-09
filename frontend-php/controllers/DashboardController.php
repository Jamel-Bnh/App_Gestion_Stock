<?php
class DashboardController {
    public function index() {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_role'])) {
            header('Location: /login');
            exit();
        }

        // Afficher le tableau de bord
        include 'views/dashboard.php';
    }
}
?>
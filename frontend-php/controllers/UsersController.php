<?php
class UsersController {
    public function index() {
        // Vérifier l'authentification
        if (!isset($_SESSION['user_role'])) {
            header('Location: /login');
            exit();
        }

        // Charger la liste des utilisateurs depuis la base de données
        global $link_db;
        $users = [];
        
        try {
            $query = "SELECT id, username, role, created_at FROM users ORDER BY created_at DESC";
            $result = $link_db->query($query);
            
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $users[] = $row;
                }
            }
        } catch (Exception $e) {
            browserLog('Erreur lors de la récupération des utilisateurs: ' . $e->getMessage());
        }
        
        // Passer les données à la vue
        $data = [
            'users' => $users
        ];
        
        // Afficher la vue
        require_once __DIR__ . '/../views/users.php';
    }
}

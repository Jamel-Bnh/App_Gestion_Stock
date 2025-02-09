<?php
class ReportsController {
    public function index() {
        // Vérifier l'authentification
        if (!isset($_SESSION['user_role'])) {
            header('Location: /login');
            exit();
        }

        // Charger les données des rapports depuis la base de données
        global $link_db;
        $reports = [];
        
        try {
            // Récupérer les dernières transactions
            $query = "SELECT * FROM bon_in ORDER BY date_bon DESC LIMIT 10";
            $result = $link_db->query($query);
            
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $reports[] = $row;
                }
            }
        } catch (Exception $e) {
            browserLog('Erreur lors de la récupération des rapports: ' . $e->getMessage());
        }
        
        // Passer les données à la vue
        $data = [
            'reports' => $reports
        ];
        
        // Afficher la vue
        require_once __DIR__ . '/../views/reports.php';
    }
}

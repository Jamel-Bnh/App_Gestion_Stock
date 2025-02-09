<?php
class StockController {
    public function index() {
        // Vérifier l'authentification
        if (!isset($_SESSION['user_role'])) {
            header('Location: /login');
            exit();
        }

        // Charger les données du stock depuis la base de données
        global $link_db;
        $stock_items = [];
        
        try {
            $query = "SELECT p.*, q.qnt, m.nom_magasin, e.nom_emplacement 
                     FROM nw_produits p 
                     LEFT JOIN nw_quantite q ON p.id_pr = q.id_pr 
                     LEFT JOIN nw_magasins m ON p.mag = m.id_magasin
                     LEFT JOIN nw_emplacements e ON p.emp = e.id_emplacement
                     ORDER BY p.id DESC";
            $result = $link_db->query($query);
            
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $stock_items[] = [
                        'id_pr' => $row['id_pr'],
                        'designation' => $row['prd'],
                        'qnt' => $row['qnt'],
                        'location' => $row['nom_magasin'] . ' - ' . $row['nom_emplacement'],
                        'img_url' => '/public/' . $row['img_pr']
                    ];
                }
            }
        } catch (Exception $e) {
            browserLog('Erreur lors de la récupération du stock: ' . $e->getMessage());
        }
        
        // Passer les données à la vue
        $data = [
            'stock_items' => $stock_items
        ];
        
        // Afficher la vue
        require_once __DIR__ . '/../views/stock.php';
    }
}

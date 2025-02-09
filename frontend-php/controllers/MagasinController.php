<?php
class MagasinController {
    public function index() {
        if (!isset($_SESSION['user_role'])) {
            header('Location: /login');
            exit();
        }

        global $link_db;
        $magasins = [];
        
        try {
            // Vérifier si les tables existent
            $tables_exist = $this->checkTablesExist();
            
            if (!$tables_exist) {
                // Créer les tables
                $this->createTables();
                // Migrer les données existantes
                $this->migrateExistingData();
            }
            
            // Récupérer tous les magasins avec leurs emplacements
            $query = "SELECT m.id_magasin, m.nom_magasin, m.description, 
                            e.id_emplacement, e.nom_emplacement, e.description as emp_description
                     FROM nw_magasins m
                     LEFT JOIN nw_emplacements e ON m.id_magasin = e.id_magasin
                     ORDER BY m.nom_magasin, e.nom_emplacement";
            
            $result = $link_db->query($query);
            
            if ($result) {
                $current_magasin = null;
                while ($row = $result->fetch_assoc()) {
                    if ($current_magasin === null || $current_magasin['id_magasin'] !== $row['id_magasin']) {
                        if ($current_magasin !== null) {
                            $magasins[] = $current_magasin;
                        }
                        $current_magasin = [
                            'id_magasin' => $row['id_magasin'],
                            'nom_magasin' => $row['nom_magasin'],
                            'description' => $row['description'],
                            'emplacements' => []
                        ];
                    }
                    if ($row['id_emplacement']) {
                        $current_magasin['emplacements'][] = [
                            'id_emplacement' => $row['id_emplacement'],
                            'nom_emplacement' => $row['nom_emplacement'],
                            'description' => $row['emp_description']
                        ];
                    }
                }
                if ($current_magasin !== null) {
                    $magasins[] = $current_magasin;
                }
            }
        } catch (Exception $e) {
            browserLog('Erreur lors de la récupération des magasins: ' . $e->getMessage());
            $_SESSION['error_message'] = "Erreur lors de la récupération des magasins.";
        }

        require_once __DIR__ . '/../views/magasin_list.php';
    }

    public function create() {
        if (!isset($_SESSION['user_role'])) {
            header('Location: /login');
            exit();
        }

        require_once __DIR__ . '/../views/magasin_create.php';
    }

    public function store() {
        if (!isset($_SESSION['user_role'])) {
            header('Location: /login');
            exit();
        }

        global $link_db;
        
        try {
            $link_db->begin_transaction();

            // Insertion du magasin
            $query = "INSERT INTO nw_magasins (nom_magasin, description) VALUES (?, ?)";
            $stmt = $link_db->prepare($query);
            $stmt->bind_param('ss', $_POST['nom_magasin'], $_POST['description']);
            $stmt->execute();
            
            $id_magasin = $link_db->insert_id;

            // Insertion des emplacements si fournis
            if (!empty($_POST['emplacements'])) {
                $query_emp = "INSERT INTO nw_emplacements (id_magasin, nom_emplacement, description) VALUES (?, ?, ?)";
                $stmt_emp = $link_db->prepare($query_emp);

                foreach ($_POST['emplacements'] as $emplacement) {
                    $stmt_emp->bind_param('iss', $id_magasin, $emplacement['nom'], $emplacement['description']);
                    $stmt_emp->execute();
                }
            }

            $link_db->commit();
            $_SESSION['success_message'] = "Le magasin a été créé avec succès.";
            
        } catch (Exception $e) {
            $link_db->rollback();
            browserLog('Erreur lors de la création du magasin: ' . $e->getMessage());
            $_SESSION['error_message'] = "Erreur lors de la création du magasin.";
        }

        header('Location: /magasin');
        exit();
    }

    public function edit($id) {
        if (!isset($_SESSION['user_role'])) {
            header('Location: /login');
            exit();
        }

        global $link_db;
        $magasin = null;
        
        try {
            // Récupérer le magasin et ses emplacements
            $query = "SELECT m.*, e.id_emplacement, e.nom_emplacement, e.description as emp_description
                     FROM nw_magasins m
                     LEFT JOIN nw_emplacements e ON m.id_magasin = e.id_magasin
                     WHERE m.id_magasin = ?";
            
            $stmt = $link_db->prepare($query);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result && $result->num_rows > 0) {
                $first_row = $result->fetch_assoc();
                $magasin = [
                    'id_magasin' => $first_row['id_magasin'],
                    'nom_magasin' => $first_row['nom_magasin'],
                    'description' => $first_row['description'],
                    'emplacements' => []
                ];

                // Reset result pointer
                $result->data_seek(0);
                while ($row = $result->fetch_assoc()) {
                    if ($row['id_emplacement']) {
                        $magasin['emplacements'][] = [
                            'id_emplacement' => $row['id_emplacement'],
                            'nom_emplacement' => $row['nom_emplacement'],
                            'description' => $row['emp_description']
                        ];
                    }
                }
            }
        } catch (Exception $e) {
            browserLog('Erreur lors de la récupération du magasin: ' . $e->getMessage());
            $_SESSION['error_message'] = "Erreur lors de la récupération du magasin.";
            header('Location: /magasin');
            exit();
        }

        require_once __DIR__ . '/../views/magasin_edit.php';
    }

    public function update($id) {
        if (!isset($_SESSION['user_role'])) {
            header('Location: /login');
            exit();
        }

        global $link_db;
        
        try {
            $link_db->begin_transaction();

            // Mise à jour du magasin
            $query = "UPDATE nw_magasins SET nom_magasin = ?, description = ? WHERE id_magasin = ?";
            $stmt = $link_db->prepare($query);
            $stmt->bind_param('ssi', $_POST['nom_magasin'], $_POST['description'], $id);
            $stmt->execute();

            // Supprimer les anciens emplacements
            $query_delete = "DELETE FROM nw_emplacements WHERE id_magasin = ?";
            $stmt_delete = $link_db->prepare($query_delete);
            $stmt_delete->bind_param('i', $id);
            $stmt_delete->execute();

            // Ajouter les nouveaux emplacements
            if (!empty($_POST['emplacements'])) {
                $query_emp = "INSERT INTO nw_emplacements (id_magasin, nom_emplacement, description) VALUES (?, ?, ?)";
                $stmt_emp = $link_db->prepare($query_emp);

                foreach ($_POST['emplacements'] as $emplacement) {
                    $stmt_emp->bind_param('iss', $id, $emplacement['nom'], $emplacement['description']);
                    $stmt_emp->execute();
                }
            }

            $link_db->commit();
            $_SESSION['success_message'] = "Le magasin a été mis à jour avec succès.";
            
        } catch (Exception $e) {
            $link_db->rollback();
            browserLog('Erreur lors de la mise à jour du magasin: ' . $e->getMessage());
            $_SESSION['error_message'] = "Erreur lors de la mise à jour du magasin.";
        }

        header('Location: /magasin');
        exit();
    }

    public function delete($id) {
        if (!isset($_SESSION['user_role'])) {
            header('Location: /login');
            exit();
        }

        global $link_db;
        
        try {
            $link_db->begin_transaction();

            // Vérifier si des articles sont associés à ce magasin
            $query_check = "SELECT COUNT(*) as count FROM nw_produits WHERE mag = ?";
            $stmt_check = $link_db->prepare($query_check);
            $stmt_check->bind_param('i', $id);
            $stmt_check->execute();
            $result = $stmt_check->get_result();
            $row = $result->fetch_assoc();

            if ($row['count'] > 0) {
                throw new Exception("Ce magasin contient des articles et ne peut pas être supprimé.");
            }

            // Supprimer les emplacements
            $query_emp = "DELETE FROM nw_emplacements WHERE id_magasin = ?";
            $stmt_emp = $link_db->prepare($query_emp);
            $stmt_emp->bind_param('i', $id);
            $stmt_emp->execute();

            // Supprimer le magasin
            $query = "DELETE FROM nw_magasins WHERE id_magasin = ?";
            $stmt = $link_db->prepare($query);
            $stmt->bind_param('i', $id);
            $stmt->execute();

            $link_db->commit();
            $_SESSION['success_message'] = "Le magasin a été supprimé avec succès.";
            
        } catch (Exception $e) {
            $link_db->rollback();
            browserLog('Erreur lors de la suppression du magasin: ' . $e->getMessage());
            $_SESSION['error_message'] = $e->getMessage();
        }

        header('Location: /magasin');
        exit();
    }

    // Méthode pour récupérer la liste des magasins et emplacements pour les formulaires
    public function getMagasinsEmplacements() {
        global $link_db;
        $magasins = [];
        
        try {
            $query = "SELECT m.id_magasin, m.nom_magasin, 
                            e.id_emplacement, e.nom_emplacement
                     FROM nw_magasins m
                     LEFT JOIN nw_emplacements e ON m.id_magasin = e.id_magasin
                     ORDER BY m.nom_magasin, e.nom_emplacement";
            
            $result = $link_db->query($query);
            
            if ($result) {
                $current_magasin = null;
                while ($row = $result->fetch_assoc()) {
                    if ($current_magasin === null || $current_magasin['id_magasin'] !== $row['id_magasin']) {
                        if ($current_magasin !== null) {
                            $magasins[] = $current_magasin;
                        }
                        $current_magasin = [
                            'id_magasin' => $row['id_magasin'],
                            'nom_magasin' => $row['nom_magasin'],
                            'emplacements' => []
                        ];
                    }
                    if ($row['id_emplacement']) {
                        $current_magasin['emplacements'][] = [
                            'id_emplacement' => $row['id_emplacement'],
                            'nom_emplacement' => $row['nom_emplacement']
                        ];
                    }
                }
                if ($current_magasin !== null) {
                    $magasins[] = $current_magasin;
                }
            }
        } catch (Exception $e) {
            browserLog('Erreur lors de la récupération des magasins: ' . $e->getMessage());
        }

        return $magasins;
    }

    public function migrateExistingData() {
        global $link_db;
        
        try {
            // Début de la transaction
            $link_db->begin_transaction();
            
            // Récupérer les magasins et emplacements uniques de nw_produits
            $query = "SELECT DISTINCT mag, emp FROM nw_produits WHERE mag IS NOT NULL AND mag != ''";
            $result = $link_db->query($query);
            
            if (!$result) {
                throw new Exception("Erreur lors de la récupération des données: " . $link_db->error);
            }
            
            $magasins = [];
            while ($row = $result->fetch_assoc()) {
                if (!isset($magasins[$row['mag']])) {
                    $magasins[$row['mag']] = [];
                }
                if ($row['emp'] && !in_array($row['emp'], $magasins[$row['mag']])) {
                    $magasins[$row['mag']][] = $row['emp'];
                }
            }
            
            // Insérer les magasins et leurs emplacements
            foreach ($magasins as $nom_magasin => $emplacements) {
                // Insérer le magasin
                $query = "INSERT INTO nw_magasins (nom_magasin, description) VALUES (?, 'Magasin migré')";
                $stmt = $link_db->prepare($query);
                $stmt->bind_param('s', $nom_magasin);
                
                if (!$stmt->execute()) {
                    throw new Exception("Erreur lors de l'insertion du magasin: " . $link_db->error);
                }
                
                $id_magasin = $link_db->insert_id;
                
                // Insérer les emplacements
                foreach ($emplacements as $emplacement) {
                    $query = "INSERT INTO nw_emplacements (id_magasin, nom_emplacement, description) VALUES (?, ?, 'Emplacement migré')";
                    $stmt = $link_db->prepare($query);
                    $stmt->bind_param('is', $id_magasin, $emplacement);
                    
                    if (!$stmt->execute()) {
                        throw new Exception("Erreur lors de l'insertion de l'emplacement: " . $link_db->error);
                    }
                }
            }
            
            // Valider la transaction
            $link_db->commit();
            return true;
            
        } catch (Exception $e) {
            // En cas d'erreur, annuler la transaction
            $link_db->rollback();
            throw $e;
        }
    }

    private function checkTablesExist() {
        global $link_db;
        
        // Vérifier si les tables existent
        $query = "SHOW TABLES LIKE 'nw_magasins'";
        $result = $link_db->query($query);
        $magasins_exists = $result->num_rows > 0;
        
        $query = "SHOW TABLES LIKE 'nw_emplacements'";
        $result = $link_db->query($query);
        $emplacements_exists = $result->num_rows > 0;
        
        return $magasins_exists && $emplacements_exists;
    }

    private function createTables() {
        global $link_db;
        
        try {
            // Début de la transaction
            $link_db->begin_transaction();
            
            // Créer la table des magasins
            $query = "CREATE TABLE IF NOT EXISTS nw_magasins (
                id_magasin INT AUTO_INCREMENT PRIMARY KEY,
                nom_magasin VARCHAR(255) NOT NULL,
                description TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";
            
            if (!$link_db->query($query)) {
                throw new Exception("Erreur lors de la création de la table magasins: " . $link_db->error);
            }
            
            // Créer la table des emplacements
            $query = "CREATE TABLE IF NOT EXISTS nw_emplacements (
                id_emplacement INT AUTO_INCREMENT PRIMARY KEY,
                id_magasin INT NOT NULL,
                nom_emplacement VARCHAR(255) NOT NULL,
                description TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                FOREIGN KEY (id_magasin) REFERENCES nw_magasins(id_magasin) ON DELETE CASCADE
            )";
            
            if (!$link_db->query($query)) {
                throw new Exception("Erreur lors de la création de la table emplacements: " . $link_db->error);
            }
            
            // Valider la transaction
            $link_db->commit();
            return true;
            
        } catch (Exception $e) {
            // En cas d'erreur, annuler la transaction
            $link_db->rollback();
            throw $e;
        }
    }
}

<?php
class ArticleController {
    public function edit($id) {
        if (!isset($_SESSION['user_role'])) {
            header('Location: /login');
            exit();
        }

        global $link_db;
        $article = null;
        
        try {
            // Récupérer les informations de l'article
            $query = "SELECT p.*, q.qnt 
                     FROM nw_produits p 
                     LEFT JOIN nw_quantite q ON p.id_pr = q.id_pr 
                     WHERE p.id_pr = ?";
            
            $stmt = $link_db->prepare($query);
            $stmt->bind_param('s', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result && $result->num_rows > 0) {
                $article = $result->fetch_assoc();
            } else {
                // Article non trouvé
                header('Location: /stock');
                exit();
            }

            // Récupérer la liste des magasins et emplacements
            require_once __DIR__ . '/MagasinController.php';
            $magasinController = new MagasinController();
            $magasins = $magasinController->getMagasinsEmplacements();

        } catch (Exception $e) {
            browserLog('Erreur lors de la récupération de l\'article: ' . $e->getMessage());
            header('Location: /stock');
            exit();
        }

        // Passer les données à la vue
        require_once __DIR__ . '/../views/article_edit.php';
    }

    public function delete($id) {
        if (!isset($_SESSION['user_role'])) {
            header('Location: /login');
            exit();
        }

        global $link_db;
        
        try {
            // Supprimer l'article
            $query = "DELETE FROM nw_produits WHERE id_pr = ?";
            $stmt = $link_db->prepare($query);
            $stmt->bind_param('s', $id);
            
            if ($stmt->execute()) {
                // Rediriger vers la liste des articles avec un message de succès
                $_SESSION['success_message'] = "L'article a été supprimé avec succès.";
            } else {
                $_SESSION['error_message'] = "Erreur lors de la suppression de l'article.";
            }
        } catch (Exception $e) {
            browserLog('Erreur lors de la suppression de l\'article: ' . $e->getMessage());
            $_SESSION['error_message'] = "Erreur lors de la suppression de l'article.";
        }

        header('Location: /stock');
        exit();
    }

    public function update($id) {
        if (!isset($_SESSION['user_role'])) {
            header('Location: /login');
            exit();
        }

        global $link_db;
        
        try {
            // Début de la transaction
            $link_db->begin_transaction();

            // Mise à jour des informations de base de l'article
            $query = "UPDATE nw_produits SET 
                        prd = ?, 
                        ctg = ?, 
                        fbrq = ?, 
                        frnss = ?, 
                        mag = ?, 
                        emp = ?, 
                        prix_pr = ?, 
                        desc_pr = ?
                     WHERE id_pr = ?";
            
            $stmt = $link_db->prepare($query);
            $stmt->bind_param('ssssssdss', 
                $_POST['prd'],
                $_POST['ctg'],
                $_POST['fbrq'],
                $_POST['frnss'],
                $_POST['mag'],
                $_POST['emp'],
                $_POST['prix_pr'],
                $_POST['desc_pr'],
                $id
            );
            $stmt->execute();

            // Mise à jour de la quantité
            $query_qnt = "UPDATE nw_quantite SET qnt = ? WHERE id_pr = ?";
            $stmt_qnt = $link_db->prepare($query_qnt);
            $stmt_qnt->bind_param('is', $_POST['qnt'], $id);
            $stmt_qnt->execute();

            // Gestion de l'upload d'image
            if (isset($_FILES['new_image']) && $_FILES['new_image']['size'] > 0) {
                $target_dir = __DIR__ . '/../public/assets/img/';
                $file_extension = strtolower(pathinfo($_FILES['new_image']['name'], PATHINFO_EXTENSION));
                $new_filename = uniqid() . '.' . $file_extension;
                $target_file = $target_dir . $new_filename;

                if (move_uploaded_file($_FILES['new_image']['tmp_name'], $target_file)) {
                    $image_path = 'assets/img/' . $new_filename;
                    $query_img = "UPDATE nw_produits SET img_pr = ? WHERE id_pr = ?";
                    $stmt_img = $link_db->prepare($query_img);
                    $stmt_img->bind_param('ss', $image_path, $id);
                    $stmt_img->execute();
                }
            }

            // Gestion de l'upload de document
            if (isset($_FILES['new_document']) && $_FILES['new_document']['size'] > 0) {
                $target_dir = __DIR__ . '/../public/assets/doc/';
                $file_extension = strtolower(pathinfo($_FILES['new_document']['name'], PATHINFO_EXTENSION));
                $new_filename = uniqid() . '.' . $file_extension;
                $target_file = $target_dir . $new_filename;

                if (move_uploaded_file($_FILES['new_document']['tmp_name'], $target_file)) {
                    $doc_path = 'assets/doc/' . $new_filename;
                    $query_doc = "UPDATE nw_produits SET doc_pr = ? WHERE id_pr = ?";
                    $stmt_doc = $link_db->prepare($query_doc);
                    $stmt_doc->bind_param('ss', $doc_path, $id);
                    $stmt_doc->execute();
                }
            }

            // Validation de la transaction
            $link_db->commit();
            $_SESSION['success_message'] = "L'article a été mis à jour avec succès.";
            
        } catch (Exception $e) {
            // En cas d'erreur, annulation de la transaction
            $link_db->rollback();
            browserLog('Erreur lors de la mise à jour de l\'article: ' . $e->getMessage());
            $_SESSION['error_message'] = "Erreur lors de la mise à jour de l'article.";
        }

        header('Location: /stock');
        exit();
    }

    public function create() {
        if (!isset($_SESSION['user_role'])) {
            header('Location: /login');
            exit();
        }

        // Récupérer la liste des magasins et emplacements
        require_once __DIR__ . '/MagasinController.php';
        $magasinController = new MagasinController();
        $magasins = $magasinController->getMagasinsEmplacements();

        require_once __DIR__ . '/../views/article_create.php';
    }

    public function store() {
        if (!isset($_SESSION['user_role'])) {
            header('Location: /login');
            exit();
        }

        global $link_db;
        
        try {
            // Début de la transaction
            $link_db->begin_transaction();

            // Génération d'un nouvel ID unique
            $id_pr = uniqid('PR');

            // Insertion des informations de base de l'article
            $query = "INSERT INTO nw_produits (
                        id_pr, prd, ctg, fbrq, frnss, mag, emp, prix_pr, desc_pr
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $link_db->prepare($query);
            $stmt->bind_param('sssssssds', 
                $id_pr,
                $_POST['prd'],
                $_POST['ctg'],
                $_POST['fbrq'],
                $_POST['frnss'],
                $_POST['mag'],
                $_POST['emp'],
                $_POST['prix_pr'],
                $_POST['desc_pr']
            );
            $stmt->execute();

            // Insertion de la quantité
            $query_qnt = "INSERT INTO nw_quantite (id_pr, qnt) VALUES (?, ?)";
            $stmt_qnt = $link_db->prepare($query_qnt);
            $stmt_qnt->bind_param('si', $id_pr, $_POST['qnt']);
            $stmt_qnt->execute();

            // Gestion de l'upload d'image
            if (isset($_FILES['new_image']) && $_FILES['new_image']['size'] > 0) {
                $target_dir = __DIR__ . '/../public/assets/img/';
                $file_extension = strtolower(pathinfo($_FILES['new_image']['name'], PATHINFO_EXTENSION));
                $new_filename = uniqid() . '.' . $file_extension;
                $target_file = $target_dir . $new_filename;

                if (move_uploaded_file($_FILES['new_image']['tmp_name'], $target_file)) {
                    $image_path = 'assets/img/' . $new_filename;
                    $query_img = "UPDATE nw_produits SET img_pr = ? WHERE id_pr = ?";
                    $stmt_img = $link_db->prepare($query_img);
                    $stmt_img->bind_param('ss', $image_path, $id_pr);
                    $stmt_img->execute();
                }
            }

            // Gestion de l'upload de document
            if (isset($_FILES['new_document']) && $_FILES['new_document']['size'] > 0) {
                $target_dir = __DIR__ . '/../public/assets/doc/';
                $file_extension = strtolower(pathinfo($_FILES['new_document']['name'], PATHINFO_EXTENSION));
                $new_filename = uniqid() . '.' . $file_extension;
                $target_file = $target_dir . $new_filename;

                if (move_uploaded_file($_FILES['new_document']['tmp_name'], $target_file)) {
                    $doc_path = 'assets/doc/' . $new_filename;
                    $query_doc = "UPDATE nw_produits SET doc_pr = ? WHERE id_pr = ?";
                    $stmt_doc = $link_db->prepare($query_doc);
                    $stmt_doc->bind_param('ss', $doc_path, $id_pr);
                    $stmt_doc->execute();
                }
            }

            // Validation de la transaction
            $link_db->commit();
            $_SESSION['success_message'] = "L'article a été créé avec succès.";
            
        } catch (Exception $e) {
            // En cas d'erreur, annulation de la transaction
            $link_db->rollback();
            browserLog('Erreur lors de la création de l\'article: ' . $e->getMessage());
            $_SESSION['error_message'] = "Erreur lors de la création de l'article.";
        }

        header('Location: /stock');
        exit();
    }
}

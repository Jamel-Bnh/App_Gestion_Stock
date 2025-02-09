<?php
class LoginController {
    public function index() {
        browserLog('LoginController: Chargement de la page de connexion');
        browserLog('Méthode: ' . $_SERVER['REQUEST_METHOD']);
        
        // Si c'est une soumission de formulaire
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            browserLog('POST data reçu: ' . print_r($_POST, true));
            
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
            
            browserLog('Tentative de connexion pour: ' . $username);
            
            try {
                // Vérifier les identifiants
                if ($this->authenticate($username, $password)) {
                    $_SESSION['user_role'] = 'user';
                    $_SESSION['username'] = $username;
                    
                    browserLog('Connexion réussie pour: ' . $username);
                    browserLog('Session après connexion: ' . print_r($_SESSION, true));
                    
                    header('Location: /home');
                    exit();
                } else {
                    browserLog('Échec de connexion pour: ' . $username);
                    $error = "Identifiants invalides";
                }
            } catch (Exception $e) {
                browserLog('Erreur lors de la connexion: ' . $e->getMessage());
                $error = "Une erreur est survenue lors de la connexion";
            }
        }
        
        // Afficher la page de connexion
        require_once __DIR__ . '/../views/login.php';
    }
    
    private function authenticate($username, $password) {
        global $link_db;
        
        browserLog('Début authentification pour: ' . $username);
        browserLog('Mot de passe fourni (longueur): ' . strlen($password));
        
        // Test direct des identifiants hardcodés
        if ($username === '62418' && $password === 'password123') {
            browserLog('Test des identifiants hardcodés: correspondance trouvée');
            return true;
        }
        browserLog('Test des identifiants hardcodés: pas de correspondance');
        
        if (!$link_db) {
            browserLog('Erreur: Pas de connexion à la base de données');
            throw new Exception("Erreur de connexion à la base de données");
        }
        
        try {
            // Échapper les caractères spéciaux pour éviter les injections SQL
            $username = mysqli_real_escape_string($link_db, $username);
            
            // Requête pour récupérer l'utilisateur
            $query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
            browserLog('Exécution de la requête: ' . $query);
            
            $result = mysqli_query($link_db, $query);
            
            if (!$result) {
                browserLog('Erreur MySQL: ' . mysqli_error($link_db));
                throw new Exception('Erreur lors de la requête utilisateur');
            }
            
            if (mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                browserLog('Utilisateur trouvé dans la base de données');
                
                // Vérifier le mot de passe
                if (password_verify($password, $user['password'])) {
                    browserLog('Mot de passe vérifié avec succès');
                    return true;
                } else {
                    browserLog('Mot de passe incorrect');
                }
            } else {
                browserLog('Aucun utilisateur trouvé avec ce nom d\'utilisateur');
            }
            
            return false;
            
        } catch (Exception $e) {
            browserLog('Exception lors de l\'authentification: ' . $e->getMessage());
            error_log("Erreur d'authentification: " . $e->getMessage());
            throw $e;
        }
    }
}
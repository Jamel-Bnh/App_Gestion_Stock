<?php
header('Content-Type: application/json');
require_once 'config.php';

// Initialize response array
$response = array('success' => false, 'message' => '');

// Log the request
error_log("=== Début de la page auth.php ===");
error_log("POST data: " . print_r($_POST, true));

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if matricule and password are set
    if (isset($_POST['matricule']) && isset($_POST['password'])) {
        $matricule = $_POST['matricule'];
        $password = $_POST['password'];

        // Validate credentials (use prepared statements to prevent SQL injection)
        $stmt = $link_db->prepare("SELECT * FROM users WHERE matricule = ? AND password = ?");
        if ($stmt) {
            $stmt->bind_param("ss", $matricule, $password);
            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows == 1) {
                    $response['success'] = true;
                    $response['message'] = 'Connexion réussie';
                } else {
                    $response['message'] = 'Matricule ou mot de passe incorrect';
                }
            } else {
                error_log("Erreur d'exécution de la requête: " . $stmt->error);
                $response['message'] = 'Erreur interne du serveur: ' . $stmt->error;
            }

            $stmt->close();
        } else {
            error_log("Erreur de préparation de la requête: " . $link_db->error);
            $response['message'] = 'Erreur interne du serveur: ' . $link_db->error;
        }
    } else {
        $response['message'] = 'Veuillez remplir tous les champs';
    }
} else {
    $response['message'] = 'Méthode de requête non autorisée';
}

// Output the JSON response
echo json_encode($response);
?>

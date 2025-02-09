<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'config.php';

// Log session details
error_log("=== Début de la page login.php ===");
error_log("Session ID: " . session_id());
error_log("Session status: " . session_status());
error_log("Session data: " . print_r($_SESSION, true));

// Check database connection
if (isset($link_db)) {
    error_log("Connexion DB OK");
    $test_query = "SELECT COUNT(*) as count FROM users";
    $result = mysqli_query($link_db, $test_query);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        error_log("Nombre d'utilisateurs en base: " . $row['count']);
    } else {
        error_log("Erreur requête test: " . mysqli_error($link_db));
    }
} else {
    error_log("ERREUR: Pas de connexion à la base de données");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Connexion - AppStock DMSP</title>
    <link rel="stylesheet" href="/public/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cairo">
    <link rel="stylesheet" href="/public/assets/css/fontello.css">
    <link rel="stylesheet" href="/public/assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="/public/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="/public/assets/css/styles.css">
    <style>
        .login-clean {
            padding: 80px 0;
            background: #f1f7fc;
            min-height: 100vh;
        }
        .login-clean form {
            max-width: 400px;
            width: 90%;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 4px;
            color: #505e6c;
            box-shadow: 1px 1px 5px rgba(0,0,0,0.1);
        }
        .login-clean .illustration {
            text-align: center;
            padding: 0 0 20px;
            font-size: 100px;
            color: #f4476b;
        }
        .login-clean form .form-control {
            background: #f7f9fc;
            border: none;
            border-bottom: 1px solid #dfe7f1;
            border-radius: 0;
            box-shadow: none;
            outline: none;
            color: inherit;
            text-indent: 8px;
            height: 42px;
        }
        .login-clean form .btn-primary {
            background: #000839;
            border: none;
            border-radius: 4px;
            padding: 11px;
            box-shadow: none;
            margin-top: 26px;
            text-shadow: none;
            outline: none !important;
        }
        .login-clean form .btn-primary:hover,
        .login-clean form .btn-primary:active {
            background: #001c80;
        }
        .login-clean form .btn-primary:active {
            transform: translateY(1px);
        }
        .login-clean form .forgot {
            display: block;
            text-align: center;
            font-size: 12px;
            color: #6f7a85;
            opacity: 0.9;
            text-decoration: none;
        }
        .login-clean form .forgot:hover,
        .login-clean form .forgot:active {
            opacity: 1;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="login-clean">
        <form method="post" action="/login">
            <h2 class="text-center">AppStock DMSP</h2>
            <div class="illustration">
                <i class="fa fa-podcast" style="color: #000839;"></i>
            </div>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <input class="form-control" type="text" name="username" placeholder="Nom d'utilisateur" required>
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password" placeholder="Mot de passe" required>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Se connecter</button>
            </div>
        </form>
    </div>

    <script src="/public/assets/js/jquery.min.js"></script>
    <script src="/public/assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>

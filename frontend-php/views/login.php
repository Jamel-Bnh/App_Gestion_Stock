<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'config.php';

// Security headers
header("Content-Security-Policy: default-src 'self' https://fonts.googleapis.com https://fonts.gstatic.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com;");
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");
header("X-Content-Type-Security: nosniff");

// Logging with proper sanitization
error_log("=== Login Page Access ===");
error_log("Session ID: " . session_id());
error_log("Session Status: " . session_status());
error_log("Remote IP: " . filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP));

// Database connection check
if (isset($link_db)) {
    try {
        $stmt = $link_db->prepare("SELECT COUNT(*) as count FROM users");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        error_log("Total users in database: " . $row['count']);
    } catch (Exception $e) {
        error_log("Database query error: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Page de connexion AppStock DMSP">
    <title>Connexion - AppStock DMSP</title>
    
    <!-- External CSS -->
    <link rel="stylesheet" href="/public/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Allerta&family=Cairo:wght@400;600&display=swap">
    <link rel="stylesheet" href="/public/assets/css/fontello.css">
    <link rel="stylesheet" href="/public/assets/fonts/fontawesome-all.min.css">
    
    <style>
        :root {
            --primary-color: #000839;
            --accent-color: rgb(255, 164, 32);
            --background-color: #f1f7fc;
            --text-color: #333333;
            --shadow-color: rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Cairo', sans-serif;
            background-color: var(--background-color);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
        }

        .login-form {
            background-color: var(--primary-color);
            padding: 2.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px var(--shadow-color);
            color: white;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .logo-container {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .logo-container img {
            max-width: 120px;
            height: auto;
            transition: transform 0.3s ease;
        }

        .logo-container img:hover {
            transform: scale(1.05);
        }

        .app-title {
            color: var(--accent-color);
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 2rem;
            text-align: center;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 5px;
            padding: 0.8rem 1rem;
            margin-bottom: 1rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .form-control:focus {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-login {
            background-color: var(--accent-color);
            color: var(--primary-color);
            border: none;
            border-radius: 5px;
            padding: 0.8rem;
            font-weight: 600;
            width: 100%;
            margin-top: 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background-color: #ff8c00;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert {
            border-radius: 5px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .icon-container {
            text-align: center;
            margin-bottom: 2rem;
        }

        .icon-container i {
            font-size: 3rem;
            color: var(--accent-color);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form class="login-form" method="post" action="/login">
            <div class="logo-container">
                <img src="/public/assets/logo/sml_logo.png" alt="Logo AppStock DMSP">
            </div>

            <h1 class="app-title">
                STOCK MANAGEMENT
            </h1>

            <div class="icon-container">
                <i class="fa fa-podcast"></i>
            </div>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <input 
                    class="form-control" 
                    type="text" 
                    name="username" 
                    placeholder="Identifiant (ex: 62418)"
                    required
                    autocomplete="username"
                >
            </div>

            <div class="form-group">
                <input 
                    class="form-control" 
                    type="password" 
                    name="password" 
                    placeholder="Mot de passe"
                    required
                    autocomplete="current-password"
                >
            </div>

            <button type="submit" class="btn-login">
                Se connecter
                <i class="fas fa-sign-in-alt ml-2"></i>
            </button>
        </form>
    </div>

    <script src="/public/assets/js/jquery.min.js"></script>
    <script src="/public/assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
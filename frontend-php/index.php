<?php
// Démarrer la session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Activer l'affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Buffer output to prevent headers already sent errors
ob_start();

try {
    // Inclure le fichier de configuration et error handler
    require_once __DIR__ . '/includes/error_handler.php';
    require_once __DIR__ . '/config.php';
    
    // Récupérer l'URL demandée
    $request_uri = $_SERVER['REQUEST_URI'];
    $base_path = '/';
    
    // Nettoyer l'URL
    $url = trim(str_replace(['index.php', '.php'], '', $request_uri), '/');
    browserLog('URL brute: ' . $request_uri);
    browserLog('URL nettoyée: ' . $url);

    // Pages accessibles sans authentification
    $public_pages = ['login'];
    
    // Vérifier si la page est publique
    $is_public_page = in_array($url, $public_pages);
    browserLog('Page publique: ' . ($is_public_page ? 'oui' : 'non'));
    browserLog('Session user_role: ' . (isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 'non défini'));

    // Router les requêtes en fonction de l'URL
    switch ($url) {
        case '':
        case 'login':
            // Si déjà connecté, rediriger vers home
            if (isset($_SESSION['user_role'])) {
                browserLog('Redirection vers home (déjà authentifié)');
                header('Location: ' . $base_path . 'home');
                exit();
            }
            // Sinon afficher le login
            browserLog('Route: login');
            require_once __DIR__ . '/controllers/LoginController.php';
            $controller = new LoginController();
            $controller->index();
            break;

        case 'home':
            // Si non connecté, rediriger vers login
            if (!isset($_SESSION['user_role'])) {
                browserLog('Redirection vers login (non authentifié)');
                header('Location: ' . $base_path . 'login');
                exit();
            }
            browserLog('Route: home');
            require_once __DIR__ . '/views/home.php';
            break;

        case 'users':
            // Si non connecté, rediriger vers login
            if (!isset($_SESSION['user_role'])) {
                browserLog('Redirection vers login (non authentifié)');
                header('Location: ' . $base_path . 'login');
                exit();
            }
            browserLog('Route: users');
            require_once __DIR__ . '/controllers/UsersController.php';
            $controller = new UsersController();
            $controller->index();
            break;

        case 'stock':
            // Si non connecté, rediriger vers login
            if (!isset($_SESSION['user_role'])) {
                browserLog('Redirection vers login (non authentifié)');
                header('Location: ' . $base_path . 'login');
                exit();
            }
            browserLog('Route: stock');
            require_once __DIR__ . '/controllers/StockController.php';
            $controller = new StockController();
            $controller->index();
            break;

        case 'reports':
            // Si non connecté, rediriger vers login
            if (!isset($_SESSION['user_role'])) {
                browserLog('Redirection vers login (non authentifié)');
                header('Location: ' . $base_path . 'login');
                exit();
            }
            browserLog('Route: reports');
            require_once __DIR__ . '/controllers/ReportsController.php';
            $controller = new ReportsController();
            $controller->index();
            break;

        case 'magasin':
            if (!isset($_SESSION['user_role'])) {
                header('Location: ' . $base_path . 'login');
                exit();
            }
            browserLog('Route: magasin list');
            require_once __DIR__ . '/controllers/MagasinController.php';
            $controller = new MagasinController();
            $controller->index();
            break;

        case 'magasin/create':
            if (!isset($_SESSION['user_role'])) {
                header('Location: ' . $base_path . 'login');
                exit();
            }
            browserLog('Route: magasin create');
            require_once __DIR__ . '/controllers/MagasinController.php';
            $controller = new MagasinController();
            $controller->create();
            break;

        case 'magasin/store':
            if (!isset($_SESSION['user_role'])) {
                header('Location: ' . $base_path . 'login');
                exit();
            }
            browserLog('Route: magasin store');
            require_once __DIR__ . '/controllers/MagasinController.php';
            $controller = new MagasinController();
            $controller->store();
            break;

        case (preg_match('/^magasin\/edit\/(\d+)$/', $url, $matches) ? true : false):
            if (!isset($_SESSION['user_role'])) {
                header('Location: ' . $base_path . 'login');
                exit();
            }
            browserLog('Route: magasin edit');
            require_once __DIR__ . '/controllers/MagasinController.php';
            $controller = new MagasinController();
            $controller->edit($matches[1]);
            break;

        case (preg_match('/^magasin\/update\/(\d+)$/', $url, $matches) ? true : false):
            if (!isset($_SESSION['user_role'])) {
                header('Location: ' . $base_path . 'login');
                exit();
            }
            browserLog('Route: magasin update');
            require_once __DIR__ . '/controllers/MagasinController.php';
            $controller = new MagasinController();
            $controller->update($matches[1]);
            break;

        case (preg_match('/^magasin\/delete\/(\d+)$/', $url, $matches) ? true : false):
            if (!isset($_SESSION['user_role'])) {
                header('Location: ' . $base_path . 'login');
                exit();
            }
            browserLog('Route: magasin delete');
            require_once __DIR__ . '/controllers/MagasinController.php';
            $controller = new MagasinController();
            $controller->delete($matches[1]);
            break;

        case 'logout':
            // Détruire la session
            session_destroy();
            // Rediriger vers login
            header('Location: ' . $base_path . 'login');
            exit();
            break;

        case (preg_match('/^article\/edit\/([^\/]+)/', $url, $matches) ? true : false):
            if (!isset($_SESSION['user_role'])) {
                header('Location: ' . $base_path . 'login');
                exit();
            }
            browserLog('Route: article edit');
            require_once __DIR__ . '/controllers/ArticleController.php';
            $controller = new ArticleController();
            $controller->edit($matches[1]);
            break;

        case (preg_match('/^article\/update\/([^\/]+)/', $url, $matches) ? true : false):
            if (!isset($_SESSION['user_role'])) {
                header('Location: ' . $base_path . 'login');
                exit();
            }
            browserLog('Route: article update');
            require_once __DIR__ . '/controllers/ArticleController.php';
            $controller = new ArticleController();
            $controller->update($matches[1]);
            break;

        case (preg_match('/^article\/delete\/([^\/]+)/', $url, $matches) ? true : false):
            if (!isset($_SESSION['user_role'])) {
                header('Location: ' . $base_path . 'login');
                exit();
            }
            browserLog('Route: article delete');
            require_once __DIR__ . '/controllers/ArticleController.php';
            $controller = new ArticleController();
            $controller->delete($matches[1]);
            break;

        case 'article/create':
            if (!isset($_SESSION['user_role'])) {
                header('Location: ' . $base_path . 'login');
                exit();
            }
            browserLog('Route: article create');
            require_once __DIR__ . '/controllers/ArticleController.php';
            $controller = new ArticleController();
            $controller->create();
            break;

        case 'article/store':
            if (!isset($_SESSION['user_role'])) {
                header('Location: ' . $base_path . 'login');
                exit();
            }
            browserLog('Route: article store');
            require_once __DIR__ . '/controllers/ArticleController.php';
            $controller = new ArticleController();
            $controller->store();
            break;

        default:
            // Si non connecté et page non publique, rediriger vers login
            if (!isset($_SESSION['user_role']) && !$is_public_page) {
                browserLog('Redirection vers login (non authentifié)');
                header('Location: ' . $base_path . 'login');
                exit();
            }
            
            // Gérer les autres routes
            $controller_name = ucfirst($url) . 'Controller';
            $controller_file = __DIR__ . '/controllers/' . $controller_name . '.php';
            
            if (file_exists($controller_file)) {
                require_once $controller_file;
                $controller = new $controller_name();
                $controller->index();
            } else {
                browserLog('Route: 404 Not Found');
                header("HTTP/1.0 404 Not Found");
                require_once __DIR__ . '/views/404.php';
            }
            break;
    }
} catch (Exception $e) {
    browserLog('Erreur: ' . $e->getMessage());
    error_log($e->getMessage());
    header("HTTP/1.0 500 Internal Server Error");
    require_once __DIR__ . '/views/500.php';
}

// Flush output buffer
ob_end_flush();
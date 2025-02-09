<?php
// Buffer output
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>500 - Erreur Serveur - AppStock DMSP</title>
    <link rel="stylesheet" href="/public/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cairo">
    <link rel="stylesheet" href="/public/assets/css/fontello.css">
    <link rel="stylesheet" href="/public/assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="/public/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="/public/assets/css/styles.css">
</head>
<body>
    <div class="container" style="margin-top: 100px;">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h1 class="display-1">500</h1>
                <h2 class="mb-4">Erreur Serveur</h2>
                <p class="lead mb-5">Désolé, une erreur est survenue sur le serveur. Notre équipe technique a été notifiée.</p>
                <?php if (isset($_SESSION['debug']) && $_SESSION['debug']): ?>
                    <div class="alert alert-danger">
                        <?php echo htmlspecialchars($e->getMessage()); ?>
                    </div>
                <?php endif; ?>
                <a href="/home" class="btn btn-primary btn-lg">
                    <i class="fa fa-home"></i> Retour à l'accueil
                </a>
            </div>
        </div>
    </div>

    <script src="/public/assets/js/jquery.min.js"></script>
    <script src="/public/assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
<?php
ob_end_flush();
?>

<?php
if (!isset($_SESSION['user_role'])) {
    header('Location: /login');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Gestion des Magasins - AppStock DMSP</title>
    <link rel="stylesheet" href="/public/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cairo">
    <link rel="stylesheet" href="/public/assets/css/fontello.css">
    <link rel="stylesheet" href="/public/assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="/public/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="/public/assets/css/styles.css">
</head>
<body>
    <nav class="navbar navbar-dark" style="background-color: #000839;">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="/" style="color: #ffa41b;font-weight: bold;">AppStock DMSP&nbsp;<i class="fa fa-podcast"></i></a>
            <div class="d-flex align-items-center" style="gap: 20px;">
                <span style="color: #ffa41b;">Bienvenue<?php echo isset($_SESSION['username']) ? ', ' . htmlspecialchars($_SESSION['username']) : ''; ?></span>
                <span style="color: #ffa41b;"><?php echo isset($_SESSION['code']) ? htmlspecialchars($_SESSION['code']) : ''; ?></span>
                <a href="/logout" style="color: #ffa41b;text-decoration: none;">Déconnexion</a>
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top: 100px;">
        <div class="row">
            <div class="col-12">
                <h1>Gestion des Magasins</h1>
                <?php if (isset($_SESSION['success_message'])): ?>
                    <div class="alert alert-success">
                        <?php 
                        echo $_SESSION['success_message'];
                        unset($_SESSION['success_message']);
                        ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($_SESSION['error_message'])): ?>
                    <div class="alert alert-danger">
                        <?php 
                        echo $_SESSION['error_message'];
                        unset($_SESSION['error_message']);
                        ?>
                    </div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="mb-0">Liste des Magasins</h5>
                            </div>
                            <div class="col text-right">
                                <a href="/magasin/create" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> Nouveau Magasin
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($magasins)): ?>
                            <div class="accordion" id="magasinsAccordion">
                                <?php foreach ($magasins as $index => $magasin): ?>
                                    <div class="card">
                                        <div class="card-header" id="heading<?php echo $index; ?>">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h2 class="mb-0">
                                                        <button class="btn btn-link" type="button" data-toggle="collapse" 
                                                                data-target="#collapse<?php echo $index; ?>" 
                                                                aria-expanded="true" 
                                                                aria-controls="collapse<?php echo $index; ?>">
                                                            <?php echo htmlspecialchars($magasin['nom_magasin']); ?>
                                                        </button>
                                                    </h2>
                                                </div>
                                                <div class="col-auto">
                                                    <a href="/magasin/edit/<?php echo $magasin['id_magasin']; ?>" 
                                                       class="btn btn-sm btn-info">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="/magasin/delete/<?php echo $magasin['id_magasin']; ?>" 
                                                       class="btn btn-sm btn-danger"
                                                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce magasin ?');">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="collapse<?php echo $index; ?>" 
                                             class="collapse" 
                                             aria-labelledby="heading<?php echo $index; ?>" 
                                             data-parent="#magasinsAccordion">
                                            <div class="card-body">
                                                <p><strong>Description:</strong> 
                                                    <?php echo htmlspecialchars($magasin['description']); ?>
                                                </p>
                                                <h6>Emplacements:</h6>
                                                <?php if (!empty($magasin['emplacements'])): ?>
                                                    <ul class="list-group">
                                                        <?php foreach ($magasin['emplacements'] as $emplacement): ?>
                                                            <li class="list-group-item">
                                                                <strong><?php echo htmlspecialchars($emplacement['nom_emplacement']); ?></strong>
                                                                <?php if (!empty($emplacement['description'])): ?>
                                                                    <br>
                                                                    <small><?php echo htmlspecialchars($emplacement['description']); ?></small>
                                                                <?php endif; ?>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php else: ?>
                                                    <p class="text-muted">Aucun emplacement défini</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p class="text-center">Aucun magasin trouvé</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/public/assets/js/jquery.min.js"></script>
    <script src="/public/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="/public/assets/js/bs-init.js"></script>
</body>
</html>

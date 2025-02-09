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
    <title>Édition Magasin - AppStock DMSP</title>
    <link rel="stylesheet" href="/public/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cairo">
    <link rel="stylesheet" href="/public/assets/css/fontello.css">
    <link rel="stylesheet" href="/public/assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="/public/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="/public/assets/css/styles.css">
    <style>
        .emplacement-item {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
        }
        .remove-emplacement {
            color: #dc3545;
            cursor: pointer;
        }
    </style>
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
                <h1>Édition du Magasin</h1>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Modifier le Magasin</h5>
                    </div>
                    <div class="card-body">
                        <form action="/magasin/update/<?php echo htmlspecialchars($magasin['id_magasin']); ?>" method="POST" id="magasinForm">
                            <div class="form-group">
                                <label>Nom du Magasin</label>
                                <input type="text" class="form-control" name="nom_magasin" 
                                       value="<?php echo htmlspecialchars($magasin['nom_magasin']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" rows="3"><?php echo htmlspecialchars($magasin['description']); ?></textarea>
                            </div>

                            <h5 class="mt-4">Emplacements</h5>
                            <div id="emplacements-container">
                                <?php foreach ($magasin['emplacements'] as $index => $emplacement): ?>
                                    <div class="emplacement-item">
                                        <div class="row">
                                            <div class="col-11">
                                                <div class="form-group">
                                                    <label>Nom de l'Emplacement</label>
                                                    <input type="text" class="form-control" 
                                                           name="emplacements[<?php echo $index; ?>][nom]" 
                                                           value="<?php echo htmlspecialchars($emplacement['nom_emplacement']); ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Description de l'Emplacement</label>
                                                    <textarea class="form-control" 
                                                              name="emplacements[<?php echo $index; ?>][description]" 
                                                              rows="2"><?php echo htmlspecialchars($emplacement['description']); ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <i class="fa fa-times remove-emplacement" onclick="supprimerEmplacement(this)"></i>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <button type="button" class="btn btn-secondary mt-2" onclick="ajouterEmplacement()">
                                <i class="fa fa-plus"></i> Ajouter un Emplacement
                            </button>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Enregistrer les modifications
                                </button>
                                <a href="/magasin" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left"></i> Retour
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/public/assets/js/jquery.min.js"></script>
    <script src="/public/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="/public/assets/js/bs-init.js"></script>
    <script>
        let emplacementCount = <?php echo count($magasin['emplacements']); ?>;

        function ajouterEmplacement() {
            const container = document.getElementById('emplacements-container');
            const div = document.createElement('div');
            div.className = 'emplacement-item';
            div.innerHTML = `
                <div class="row">
                    <div class="col-11">
                        <div class="form-group">
                            <label>Nom de l'Emplacement</label>
                            <input type="text" class="form-control" name="emplacements[${emplacementCount}][nom]" required>
                        </div>
                        <div class="form-group">
                            <label>Description de l'Emplacement</label>
                            <textarea class="form-control" name="emplacements[${emplacementCount}][description]" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="col-1">
                        <i class="fa fa-times remove-emplacement" onclick="supprimerEmplacement(this)"></i>
                    </div>
                </div>
            `;
            container.appendChild(div);
            emplacementCount++;
        }

        function supprimerEmplacement(element) {
            element.closest('.emplacement-item').remove();
        }
    </script>
</body>
</html>

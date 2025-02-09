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
    <title>Édition Article - AppStock DMSP</title>
    <link rel="stylesheet" href="/public/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cairo">
    <link rel="stylesheet" href="/public/assets/css/fontello.css">
    <link rel="stylesheet" href="/public/assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="/public/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="/public/assets/css/styles.css">
</head>
<body>
    <nav class="navbar navbar-light navbar-expand-md fixed-top navigation-clean" style="background-color: #000839;">
        <div class="container-fluid">
            <a class="navbar-brand" href="/home" style="color: #ffa41b;">
                AppStock DMSP&nbsp;<i class="fa fa-podcast"></i>
            </a>
            <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon" style="background-color: #ffa41b;"></span>
            </button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <span class="nav-link" style="color: #ffa41b;">
                            Bienvenue, <?php echo htmlspecialchars($_SESSION['username']); ?>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout" style="color: #ffa41b;">
                            Déconnexion <i class="fa fa-sign-out"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top: 100px;">
        <div class="row">
            <div class="col-12">
                <h1>Édition de l'Article</h1>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Modifier l'Article</h5>
                    </div>
                    <div class="card-body">
                        <form action="/article/update/<?php echo htmlspecialchars($article['id_pr']); ?>" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ID Produit</label>
                                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($article['id_pr']); ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Désignation</label>
                                        <input type="text" class="form-control" name="prd" value="<?php echo htmlspecialchars($article['prd']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Catégorie</label>
                                        <input type="text" class="form-control" name="ctg" value="<?php echo htmlspecialchars($article['ctg']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Fabricant</label>
                                        <input type="text" class="form-control" name="fbrq" value="<?php echo htmlspecialchars($article['fbrq']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Fournisseur</label>
                                        <input type="text" class="form-control" name="frnss" value="<?php echo htmlspecialchars($article['frnss']); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Magasin</label>
                                        <select class="form-control" name="mag" id="magasin" required onchange="updateEmplacements()">
                                            <option value="">Sélectionnez un magasin</option>
                                            <?php foreach ($magasins as $magasin): ?>
                                                <option value="<?php echo htmlspecialchars($magasin['id_magasin']); ?>"
                                                        <?php echo ($magasin['id_magasin'] == $article['mag']) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($magasin['nom_magasin']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Emplacement</label>
                                        <select class="form-control" name="emp" id="emplacement" required>
                                            <option value="">Sélectionnez d'abord un magasin</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Prix</label>
                                        <input type="number" step="0.01" class="form-control" name="prix_pr" value="<?php echo htmlspecialchars($article['prix_pr']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Quantité</label>
                                        <input type="number" class="form-control" name="qnt" value="<?php echo htmlspecialchars($article['qnt']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" name="desc_pr" rows="3"><?php echo htmlspecialchars($article['desc_pr']); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Image actuelle</label>
                                        <?php if (!empty($article['img_pr'])): ?>
                                            <img src="/public/<?php echo htmlspecialchars($article['img_pr']); ?>" class="img-thumbnail" style="max-width: 200px;">
                                        <?php else: ?>
                                            <p>Aucune image</p>
                                        <?php endif; ?>
                                        <input type="file" class="form-control-file mt-2" name="new_image" accept="image/*">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Document actuel</label>
                                        <?php if (!empty($article['doc_pr'])): ?>
                                            <p>Document: <?php echo htmlspecialchars(basename($article['doc_pr'])); ?></p>
                                        <?php else: ?>
                                            <p>Aucun document</p>
                                        <?php endif; ?>
                                        <input type="file" class="form-control-file mt-2" name="new_document" accept=".pdf,.doc,.docx">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i> Enregistrer les modifications
                                    </button>
                                    <a href="/stock" class="btn btn-secondary">
                                        <i class="fa fa-arrow-left"></i> Retour
                                    </a>
                                </div>
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
        // Données des magasins et emplacements
        const magasinsData = <?php echo json_encode($magasins); ?>;
        const currentEmplacement = '<?php echo $article['emp']; ?>';

        function updateEmplacements() {
            const magasinSelect = document.getElementById('magasin');
            const emplacementSelect = document.getElementById('emplacement');
            const selectedMagasinId = magasinSelect.value;

            // Réinitialiser le select des emplacements
            emplacementSelect.innerHTML = '<option value="">Sélectionnez un emplacement</option>';
            emplacementSelect.disabled = true;

            if (selectedMagasinId) {
                // Trouver le magasin sélectionné
                const magasin = magasinsData.find(m => m.id_magasin === selectedMagasinId);
                if (magasin && magasin.emplacements.length > 0) {
                    // Ajouter les emplacements
                    magasin.emplacements.forEach(emp => {
                        const option = document.createElement('option');
                        option.value = emp.id_emplacement;
                        option.textContent = emp.nom_emplacement;
                        if (emp.id_emplacement === currentEmplacement) {
                            option.selected = true;
                        }
                        emplacementSelect.appendChild(option);
                    });
                    emplacementSelect.disabled = false;
                }
            }
        }

        // Initialiser les emplacements au chargement de la page
        document.addEventListener('DOMContentLoaded', function() {
            updateEmplacements();
        });
    </script>
</body>
</html>

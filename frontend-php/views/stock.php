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
    <title>Stock - AppStock DMSP</title>
    <link rel="stylesheet" href="/public/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cairo">
    <link rel="stylesheet" href="/public/assets/css/fontello.css">
    <link rel="stylesheet" href="/public/assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="/public/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="/public/assets/css/styles.css">
    <style>
        .product-name {
            position: relative;
            cursor: pointer;
        }
        .product-image {
            display: none;
            position: absolute;
            z-index: 1000;
            max-width: 200px;
            max-height: 200px;
            border: 2px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            background-color: white;
            padding: 5px;
            left: 100%;
            margin-left: 10px;
            top: 50%;
            transform: translateY(-50%);
        }
        .product-name:hover .product-image {
            display: block;
        }
        /* Pour les éléments près du bas de la page */
        tr:nth-last-child(-n+3) .product-image {
            bottom: 0;
            top: auto;
            transform: translateY(0);
        }
        /* Pour les éléments près du haut de la page */
        tr:nth-child(-n+3) .product-image {
            top: 0;
            transform: translateY(0);
        }
        /* Assurer que les conteneurs ne masquent pas les images flottantes */
        .table-responsive {
            overflow: visible !important;
        }
        .card {
            overflow: visible !important;
        }
        .card-body {
            overflow: visible !important;
        }
        /* Ajuster la position du conteneur principal pour éviter les problèmes de défilement */
        .container {
            overflow: visible !important;
            padding-bottom: 50px;
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
                <h1>Gestion du Stock</h1>
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="mb-0">Liste des Articles</h5>
                            </div>
                            <div class="col text-right">
                                <a href="/article/create" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> Nouvel Article
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Article</th>
                                        <th>Quantité</th>
                                        <th>Emplacement</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($stock_items)): ?>
                                        <?php foreach ($stock_items as $item): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($item['id_pr']); ?></td>
                                                <td class="product-name">
                                                    <?php echo htmlspecialchars($item['designation']); ?>
                                                    <?php if (!empty($item['img_url'])): ?>
                                                        <img src="<?php echo htmlspecialchars($item['img_url']); ?>" 
                                                             alt="<?php echo htmlspecialchars($item['designation']); ?>" 
                                                             class="product-image">
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo htmlspecialchars($item['qnt'] ?? 'N/A'); ?></td>
                                                <td><?php echo htmlspecialchars($item['location'] ?? 'N/A'); ?></td>
                                                <td>
                                                    <a href="/article/edit/<?php echo $item['id_pr']; ?>" class="btn btn-sm btn-info">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="/article/delete/<?php echo $item['id_pr']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center">Aucun article trouvé</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/public/assets/js/jquery.min.js"></script>
    <script src="/public/assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>

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
    <title>Inventaire - AppStock DMSP</title>
    <link rel="stylesheet" href="/public/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cairo">
    <link rel="stylesheet" href="/public/assets/css/fontello.css">
    <link rel="stylesheet" href="/public/assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="/public/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="/public/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
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
                <h1>Gestion de l'Inventaire</h1>
                
                <!-- Résumé des stocks -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h5 class="card-title">Total des Articles</h5>
                                <p class="card-text display-4">
                                    <?php echo $total_products; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h5 class="card-title">En Stock</h5>
                                <p class="card-text display-4">
                                    <?php echo $in_stock; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-white">
                            <div class="card-body">
                                <h5 class="card-title">Stock Faible</h5>
                                <p class="card-text display-4">
                                    <?php echo $low_stock; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-danger text-white">
                            <div class="card-body">
                                <h5 class="card-title">Rupture de Stock</h5>
                                <p class="card-text display-4">
                                    <?php echo $out_of_stock; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filtres -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form id="filterForm" class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Catégorie</label>
                                    <select class="form-control" name="category">
                                        <option value="">Toutes les catégories</option>
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?php echo $category['id']; ?>">
                                                <?php echo htmlspecialchars($category['name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>État du Stock</label>
                                    <select class="form-control" name="stock_status">
                                        <option value="">Tous les états</option>
                                        <option value="in_stock">En stock</option>
                                        <option value="low_stock">Stock faible</option>
                                        <option value="out_of_stock">Rupture de stock</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Recherche</label>
                                    <input type="text" class="form-control" name="search" placeholder="Rechercher...">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fa fa-search"></i> Filtrer
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Liste des produits -->
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="mb-0">État des Stocks</h5>
                            </div>
                            <div class="col text-right">
                                <button type="button" class="btn btn-success" onclick="exportInventory()">
                                    <i class="fa fa-file-excel-o"></i> Exporter
                                </button>
                                <button type="button" class="btn btn-info" onclick="printInventory()">
                                    <i class="fa fa-print"></i> Imprimer
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="inventoryTable">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Produit</th>
                                        <th>Catégorie</th>
                                        <th>Stock Actuel</th>
                                        <th>Stock Min</th>
                                        <th>Dernier Mouvement</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($inventory)): ?>
                                        <?php foreach ($inventory as $item): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($item['code']); ?></td>
                                                <td><?php echo htmlspecialchars($item['name']); ?></td>
                                                <td><?php echo htmlspecialchars($item['category']); ?></td>
                                                <td>
                                                    <span class="badge <?php echo getStockStatusClass($item['current_stock'], $item['min_stock']); ?>">
                                                        <?php echo htmlspecialchars($item['current_stock']); ?>
                                                    </span>
                                                </td>
                                                <td><?php echo htmlspecialchars($item['min_stock']); ?></td>
                                                <td><?php echo htmlspecialchars($item['last_movement']); ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-info" onclick="viewHistory(<?php echo $item['id']; ?>)">
                                                        <i class="fa fa-history"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-warning" onclick="adjustStock(<?php echo $item['id']; ?>)">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Historique -->
    <div class="modal fade" id="historyModal" tabindex="-1" role="dialog" aria-labelledby="historyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="historyModalLabel">Historique des Mouvements</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Quantité</th>
                                    <th>Utilisateur</th>
                                    <th>Note</th>
                                </tr>
                            </thead>
                            <tbody id="historyTableBody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ajustement Stock -->
    <div class="modal fade" id="adjustStockModal" tabindex="-1" role="dialog" aria-labelledby="adjustStockModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adjustStockModalLabel">Ajuster le Stock</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="adjustStockForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nouvelle Quantité</label>
                            <input type="number" class="form-control" name="new_quantity" required>
                        </div>
                        <div class="form-group">
                            <label>Raison de l'ajustement</label>
                            <textarea class="form-control" name="reason" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="/public/assets/js/jquery.min.js"></script>
    <script src="/public/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#inventoryTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json"
            },
            "order": [[3, "asc"]]
        });
    });

    function getStockStatusClass(currentStock, minStock) {
        if (currentStock <= 0) return 'badge-danger';
        if (currentStock <= minStock) return 'badge-warning';
        return 'badge-success';
    }

    function viewHistory(productId) {
        $.get('/inventory/history/' + productId, function(data) {
            $('#historyTableBody').html(data);
            $('#historyModal').modal('show');
        });
    }

    function adjustStock(productId) {
        $('#adjustStockForm').data('productId', productId);
        $('#adjustStockModal').modal('show');
    }

    function exportInventory() {
        window.location.href = '/inventory/export';
    }

    function printInventory() {
        window.print();
    }

    $('#adjustStockForm').submit(function(e) {
        e.preventDefault();
        var productId = $(this).data('productId');
        $.post('/inventory/adjust/' + productId, $(this).serialize(), function(response) {
            if (response.success) {
                location.reload();
            } else {
                alert('Erreur lors de l\'ajustement du stock: ' + response.message);
            }
        });
    });

    $('#filterForm').submit(function(e) {
        e.preventDefault();
        $('#inventoryTable').DataTable().ajax.reload();
    });
    </script>
</body>
</html>

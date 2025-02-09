<?php
require 'myheader.php';
?>
<title>Tableau de bord - APP_STOCK</title>

<div class="container">
    <div class="row">
        <div class="all_menu">
            <?php if (in_array($_SESSION['user_role'], ['UMXX', 'UMAX', 'UMAS'])): ?>
            <a class="menu_item" href="/bons"> <!-- Mise à jour du chemin -->
                <i class="fas fa-file-alt"></i>
                <div class="etq_item">Gestion des Bons</div>
            </a>
            <?php endif; ?>

            <?php if (in_array($_SESSION['user_role'], ['UXXX', 'UMXX'])): ?>
            <a class="menu_item" href="/stock"> <!-- Mise à jour du chemin -->
                <i class="fas fa-boxes"></i>
                <div class="etq_item">Stock</div>
            </a>
            <?php endif; ?>

            <?php if (in_array($_SESSION['user_role'], ['UXXX', 'UMXX', 'UMAX', 'UMAS'])): ?>
            <a class="menu_item" href="/administration"> <!-- Mise à jour du chemin -->
                <i class="fas fa-users-cog"></i>
                <div class="etq_item">Administration</div>
            </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require 'js_link.php'; ?>
<script>
    $(document).ready(function(){
        $('.thetitle').html('<i class="fas fa-tachometer-alt"></i> Tableau de bord');
    });
</script>
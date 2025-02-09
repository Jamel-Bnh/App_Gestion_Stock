<?php require 'myheader.php'; ?>
<title>Espace Magasinier</title>

<div class="container">
    <div class="row">
 
    <div class="all_menu">
             <a class="menu_item" href="ajout.php">
             <i class="fas fa-file-import"></i>
                 <div class="etq_item">Ajout au Stock</div>
             </a>
             <a class="menu_item" href="bons.php">
             <i class="far fa-file-alt"></i>
                 <div class="etq_item">Liste des Bons</div>
             </a>
             <a class="menu_item" href="magasins.php">
             <i class="far fa-building"></i>
                 <div class="etq_item">Gestion Magasin</div>
             </a>
             <a class="menu_item" href="produit.php">
             <i class="fas fa-cart-plus"></i>
                 <div class="etq_item">Nouveau Produit</div>
             </a>
             <a class="menu_item" href="categories.php">
             <i class="fas fa-cog"></i>
                 <div class="etq_item">  Catégorie</div>
             </a>
             <a class="menu_item" href="#">
             <i class="fas fa-tasks"></i>
                 <div class="etq_item">Inventaire</div>
             </a>
         </div>
    </div>
</div>





<?php require 'js_link.php'; ?>
<script>
     $('document').ready(function(){
        var cur_tit=$(this).attr('title');
        $('.thetitle').html(cur_tit);
    })
</script>
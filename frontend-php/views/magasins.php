<?php require 'myheader.php'; ?>

<title>Gestion Magasin</title>
<div class="container">
    <div class="row">
 
    <div class="all_menu">
             <a class="menu_item" href="magasin.php">
             <i class="fas fa-file-import"></i>
                 <div class="etq_item">Nouveau Magasin</div>
             </a>
             <a class="menu_item" href="emplacement.php">
             <i class="far fa-file-alt"></i>
                 <div class="etq_item">Emplacement</div>
             </a>
              
         </div>
    </div>
</div>


<div class="container" >

    <div class="row" >
        <a class="btn btn-primary" style="width: 200px;margin:auto;" href="javascript:history.go(-1)">Retour</a>
    </div>
</div>



<?php require 'js_link.php'; ?>
<script>
     $('document').ready(function(){
        var cur_tit=$(this).attr('title');
        $('.thetitle').html('<i class="far fa-building"></i> '+cur_tit);
    })
</script>
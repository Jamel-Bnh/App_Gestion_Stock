<?php require 'myheader.php'; ?>
<title>Administration</title>

<div class="container">
    <div class="row">
 
    <div class="all_menu">
             <a class="menu_item" href="historique.php">
             <i class="fas fa-history"></i>
                 <div class="etq_item"> Historique</div>
             </a>
              
             <a class="menu_item" href="niveau.php">
             <i class="fas fa-list-alt"></i>
                 <div class="etq_item">Niveaux SysLog</div>
             </a>

             <a class="menu_item" href="param.php">
             <i class="fas fa-cogs"></i>
                 <div class="etq_item">Paramètres</div>
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
        $('.thetitle').html('<i class="fas fa-users-cog"></i> '+cur_tit);
    })
</script>

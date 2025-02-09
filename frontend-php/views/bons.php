<?php require 'myheader.php'; ?>
<?php
if( $user_role==="UMXX" || $user_role==="UMAX" || $user_role==="UMAS" ){
    
}else{
    header('Location:page404.php');
}
?>
<title>Liste des Bons</title>
<div class="container">
    <div class="row">
 
    <div class="all_menu">
             <a class="menu_item" href="entree.php">
             <i class="fas fa-file-import"></i>
                 <div class="etq_item">Bon d'entrée</div>
             </a>
             <a class="menu_item" href="sortie.php">
             <i class="far fa-file-alt"></i>
                 <div class="etq_item">Bon de Sortie</div>
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
    //
$('.all_link').load("side_link.php .def_link");
    //
     $('document').ready(function(){
        var cur_tit=$(this).attr('title');
        $('.thetitle').html('<i class="fas fa-align-justify"></i> '+cur_tit);
    })
</script>
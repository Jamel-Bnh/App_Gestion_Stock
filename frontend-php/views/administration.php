<?php require 'myheader.php'; ?>
<?php

if($user_role ==="UXXX" || $user_role==="UMXX" || $user_role==="UMAX" || $user_role==="UMAS"){
  
}else{
    header('Location:page404.php');
}
?>
<title>Administration</title>

<div class="container">
    <div class="row">
 
    <div class="all_menu">
             <a class="menu_item" href="users.php">
             <i class="fas fa-users-cog"></i>
                 <div class="etq_item"> Gestion Utilisateurs</div>
             </a>
              
             <a class="menu_item" href="#">
             <i class="fas fa-chalkboard-teacher"></i>
                 <div class="etq_item">Gestion D'accées</div>
             </a>

             <a class="menu_item" href="division.php">
             <i class="fas fa-grip-horizontal"></i>
                 <div class="etq_item">Gestion Division</div>
             </a>

             <a class="menu_item" href="role.php">
             <i class="fas fa-user-nurse"></i>
                 <div class="etq_item">Gestion Role</div>
             </a>

             <a class="menu_item" href="categorie.php">
             <i class="fas fa-cog"></i>
                 <div class="etq_item"> Gestion Catégorie</div>
             </a>
             <a class="menu_item" href="menulog.php">
             <i class="fas fa-history"></i>
                 <div class="etq_item"> Historique</div>
             </a>
             
         </div>
    </div>
</div>

<?php require 'js_link.php'; ?>
<script>
       $('document').ready(function(){
        var cur_tit=$(this).attr('title');
        $('.thetitle').html('<i class="fas fa-users-cog"></i> '+cur_tit);
    })
</script>

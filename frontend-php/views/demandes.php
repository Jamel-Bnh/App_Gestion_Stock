<?php require 'myheader.php'; ?>
<?php
if($user_role ==="UXXX" || $user_role==="UMXX" || $user_role==="UMAX" || $user_role==="UMAS"){
  
}else{
    header('Location:page404.php');
}
?>
<title>Demandes</title>

<div class="container">
    <div class="row">
 
    <div class="all_menu">
    <a class="menu_item" href="enattente.php">
    <i class="fas fa-user-clock"></i>
                 <div class="d-flex w-100">

                 <div class="etq_item" style="margin-right: 10px;">Demandes en attente</div>
                 <div class="ntf_dem d-flex justify-content-end align-items-center">
                 <?php
                                $scan_dem=mysqli_query($link_db,"SELECT * from bon_out WHERE sts_out='w'");
                                if(mysqli_num_rows($scan_dem)>0){
                                    echo '<span style="margin-right: 10px;">';
                                    echo mysqli_num_rows($scan_dem);
                                    echo '</span>';
                                }
                            
                                ?>
                     </div>

                 </div>
             </a>
              
             <a class="menu_item" href="accepted.php">
             <i class="fas fa-user-check"></i>
                 <div class="etq_item">Demandes Acceptées</div>
             </a>

             <a class="menu_item" href="refused.php">
             <i class="fas fa-user-slash"></i>
                 <div class="etq_item">Demandes Refusés</div>
             </a>

             
             
         </div>
    </div>
</div>

<?php require 'js_link.php'; ?>
<script>
       $('document').ready(function(){
        var cur_tit=$(this).attr('title');
        $('.thetitle').html('<i class="fas fa-stream"></i> '+cur_tit);
    })
</script>

 
<?php require 'myheader.php'; ?>
<?php
if( $user_role==="UMXX" || $user_role==="UMAX" || $user_role==="UMAS" ){
    
}else{
    header('Location:page404.php');
}
?>
<title>Catégorie</title>


<div class="container">
    <div class="row">

         

        <div class="col">

        <table class="table table-striped">
            <thead class="th_info">
                <tr><th>Catégorie</th><th>Responsable</th><th></th></tr>
            </thead>
            <tbody class="tb_ctg">
                <?php
                $req_ctg=mysqli_query($link_db,"SELECT * from nw_ctg");
                while($ctg_rows=mysqli_fetch_array($req_ctg)){
                    echo "<tr><td>".$ctg_rows['categorie']."</td><td>".$ctg_rows['admin_ctg']."</td></tr>";
                }
                ?>
            </tbody>
        </table>

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
    $('document').ready(function() {
         var cur_tit = $(this).attr('title');
         $('.thetitle').html('<i class="fas fa-cog"></i> '+cur_tit);
     })
</script>
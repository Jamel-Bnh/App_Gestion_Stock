<?php require 'myheader.php'; ?>
<?php
if( $user_role==="UMXX" || $user_role==="UMAX" || $user_role==="UMAS"){
  
}else{
    header('Location:page404.php');
}
?>
<title>Bon De Sortie</title>
<style>
.bon_info {
    background: #0077c0;
    margin-bottom: 15px;
    padding: 10px;
    color: #ffffff;
}
</style>
<div class="container">
    <div class="row">
    <table class="table table-striped">
    <thead class="th_info">
        <th>ID Bon</th>
        <th>Demandeur</th>
        <th>Nombre de produits</th>
        <th>Date</th>
        <th>Date de sortie</th> <!-- Ajout de la colonne Date de sortie -->
        <th></th>
    </thead>

    <tbody>
        <?php
        $sts = "accepted";
        $scan_in = mysqli_query($link_db, "SELECT * from bon_out WHERE sts_out='$sts'");
        while ($rows_in = mysqli_fetch_array($scan_in)) {
            echo "<tr><td>" . $rows_in['id_out'] . "</td><td>" . $rows_in['user_out'] . "</td><td>" . $rows_in['nb_out'] . "</td><td>" . $rows_in['date_out'] . "</td><td><input type='text' name='date_sortie[]' value='" . $rows_in['date_out'] . "'></td><td><i class='far fa-eye text-success show_bon' style='cursor:pointer;margin-right:10px;' id=" . $rows_in['id_out'] . "></i><i id=" . $rows_in['id_out'] . " class='fas fa-print print_bon text-primary' style='cursor:pointer;'></i></td></tr>";
        }
        ?>
    </tbody>
</table>




    </div>
</div>

<div class="modal fade" id="modal_show_bon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-eye"></i> BON SORTIE DE STOCK</h5>

            </div>
            <div class="modal-body bd_bon">



            </div>

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
    $('.thetitle').html(cur_tit);
})

$('.show_bon').click(function() {
    var id_bon = this.id;
  
    $.ajax({
        url: "databin.php",
        method: "POST",
        data: {
            "btn_act": "showbonout",
            "id_bon": id_bon
        },
        success: function(resp_bon) {

            $('.bd_bon').html(resp_bon);
        }
    })
    $('#modal_show_bon').modal('show');
})

$('.print_bon').click(function() {
    window.open("print_s.php?id_bon=" + this.id);
})
</script>
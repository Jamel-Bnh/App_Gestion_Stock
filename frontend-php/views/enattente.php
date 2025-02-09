<?php require 'myheader.php'; ?>
<?php
if($user_role==="UMAX" || $user_role==="UMAS"){
  
}else{
    header('Location:page404.php');
}
?>
<title>Demandes en attente</title>
<style>
    .req_w i {
        cursor: pointer;
        font-size: 22px;
    }
</style>

<div class="container">
    <div class="row">

        <div class="req_w w-100">
            <table class="table table-striped w-100">
            <thead class="th_info">
                    <tr>
                        <th>ID Demande</th>
                        <th>Demandeur</th>
                        <th>N° produits</th>
                        <th>Division</th>
                        <th>Date</th>
                        <th></th>
                        <th></th>
                        <th></th>

                    </tr>

                </thead>
                <tbody>
                    <?php
                    $scan_wreq = mysqli_query($link_db, "SELECT * from bon_out WHERE sts_out='w'");
                    while ($rows_wreq = mysqli_fetch_array($scan_wreq)) {
                        $user_out = $rows_wreq['user_out'];
                        $cu_user = mysqli_query($link_db, "SELECT * from users_stock WHERE matricule='$user_out'");
                        $rows_cuser = mysqli_fetch_array($cu_user);
                        $user_n = $rows_cuser['user_name'];
                    ?>
                        <tr>
                            <td><?php echo $rows_wreq['id_out']; ?></td>
                            <td><?php echo $user_n; ?></td>
                            <td><?php echo $rows_wreq['nb_out']; ?></td>
                            <td><?php echo $rows_wreq['ctg_out']; ?></td>
                            <td><?php echo $rows_wreq['date_out']; ?></td>
                            <td><i class="fas fa-eye text-primary wreq_btn" id='<?php echo $rows_wreq['id_out']; ?>'></i></td>

                        </tr>

                    <?php
                    }


                    ?>
                </tbody>
            </table>
        </div>


    </div>
</div>

<div class="modal fade " id="modal_wreq" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-outdent"></i> Demande</h5>

            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead class="th_info">
                        <tr>
                            <th>ID Produit</th>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>N° serie</th>
                            <th>Disponibilité</th>
                            <th>Quantité Disponible</th>

                        </tr>
                    </thead>
                    <tbody id="tb_wreq">

                    </tbody>

                </table>

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
        $('.thetitle').html(' <i class="fas fa-user-clock"></i> '+cur_tit);
    })

    $('.wreq_btn').click(function() {
        var id_bon = this.id;
        $('#modal_wreq').modal('show');
        $.ajax({
            url: "dataget.php",
            method: "GET",
            data: {
                "btn_act": "bonout",
                "id_bon": id_bon
            },
            success: function(resp_wreq) {

                $('#tb_wreq').html(resp_wreq);
                // btn admin accept
                $('.acc_req').click(function() {
                    var id_acc = this.id;

                    $.ajax({
                        url: "dataget.php",
                        method: "GET",
                        data: {
                            "btn_act": "reqacc",
                            "id_acc": id_acc
                        },
                        success: function(res_acc) {
                            if(res_acc==="success"){
                                alert("Demande "+id_acc+" accepté")
                                location.reload();
                            }else{
                                alert(res_acc);
                            }
                           
                        }
                    })

// end accept
                })
                $('.ref_req').click(function() {
                    var id_ref = this.id;
                    $.ajax({
                        url: "dataget.php",
                        method: "GET",
                        data: {
                            "btn_act": "reqref",
                            "id_ref": id_ref
                        },
                        success: function(resp_ref) {
                            if(resp_ref==="success"){
                                alert("Demande "+id_ref+" refusé")
                                location.reload();
                            }else{
                                alert(resp_ref);
                            }

                        }
                    })
                })
            }

        })
    })
</script>
<?php

ob_start();
require 'myheader.php'; ?>
<?php
$ctg = $_GET['ctg'];

if ($ctg == "") {
    header('Location:menu.php');
}
?>
<title>Demande</title>

<div class="container">
    <div class="row">

        <div class="col-md-6">
            <input class="form-control" id="ctg_nw" style="width: 100%;text-align:center;color:#ffffff;background:#0077C0;margin-bottom:35px;border-radius:0;cursor:no-drop; box-shadow: 3px 3px 2px 0px #000000;height: 42px;" value='<?php echo $ctg; ?>' readOnly>
            <div class="inpfrom d-flex align-items-center">
                <input list="allprdslist" id="inpprd" name="inpprd" class="form-control" placeholder="chercher un article ..." autocomplete="off" />
                <div class="clrinp" style="margin-left: 5px;"><i class="far fa-trash-alt text-danger " style="cursor: pointer;"></i></div>
            </div>
            <datalist id="allprdslist">
                <?php
                $scan_prd = mysqli_query($link_db, "SELECT * from nw_produits WHERE ctg='$ctg'");
                while ($rows_ctg = mysqli_fetch_array($scan_prd)) {
                    echo  "<option>" . $rows_ctg['prd'] . "</option>";
                }
                ?>
            </datalist>
            <div style="margin-top: 25px;" class="prd_info d-flex flex-column align-items-center">
            </div>
        </div>
        <div class="col-md-6">
            <table class="table table-striped">
            <thead class="th_info">
                    <tr>
                        <th>ID Produit</th>
                        <th>Produit</th>
                        <th>Quantité </th>
                        <th>N° serie</th>
                    </tr>
                </thead>
                <tbody id="tb_panier">
                </tbody>
            </table>
            <textarea class="form-control" id="desc_out" style="margin-bottom: 10px;" placeholder="commentaire..."></textarea>
            <button class="btn btn-primary" id="v_req"><i class="fas fa-check" style="font-size: 20px;"></i> Valider Demande</button>
        </div>
    </div>
</div>

<?php require 'js_link.php'; ?>
<script>
    $('document').ready(function() {
        var cur_tit = $(this).attr('title');
        var ctg_nw=$('#ctg_nw').val();
        
      
        $('.thetitle').html('<i class="fas fa-file-import"></i> '+cur_tit);
        $.ajax({
            url: "dataget.php",
            method: "GET",
            data: {
                "btn_act": "first_pan",
                "ctg_nw":ctg_nw,
               

            },
            success: function(resp_pan_first) {
                $('#tb_panier').html(resp_pan_first);
            }
        })
    })

    $('.clrinp').click(function() {
        $('#inpprd').val('');
    })
    $('#inpprd').change(function() {
        var prd = $('#inpprd').val();
       
        $.ajax({
            url: "databin.php",
            method: "POST",
            data: {
                "btn_act": "demande",
                "prd": prd
            },
            success: function(resp_dem) {
                $('.prd_info').html(resp_dem);
                $('#frm_dem').submit(function(e) {
                    e.preventDefault();
                    var id_dem = $('#id_prd').val();
                    var nmsr_dem = $('#nmsr_dem').val();
                    var qnt_dem = $('#qnt_dem').val();
                    var ctg_nw = $('#ctg_nw').val();
                    $.ajax({
                        url: "dataget.php",
                        method: "GET",
                        data: {
                            "btn_act": "addpan",
                            "id_dem": id_dem,
                            "nmsr_dem": nmsr_dem,
                            "qnt_dem": qnt_dem,
                            "ctg_nw": ctg_nw
                        },
                        success: function(resp_pan) {
                            if (resp_pan === "success") {
                                var ctg_nw=$('#ctg_nw').val();
                                $.ajax({
                                    url: "dataget.php",
                                    method: "GET",
                                    data: {
                                        "btn_act": "first_pan",
                                        "ctg_nw":ctg_nw

                                    },
                                    success: function(resp_pan_sec) {
                                        $('#tb_panier').html(resp_pan_sec);
                                    }
                                })
                                $('#inpprd').val('');
                                $('.prd_info').html('');
                            } else {
                                alert(resp_pan);
                            }
                        }
                    })
                })
            }
        })
    })


    $('#v_req').click(function(){
        var ctg_req=$('#ctg_nw').val();
        var desc_out=$('#desc_out').val();
        $.ajax({
            url:"dataget.php",
            method:"GET",
           // dataType:"JSON",
            data:{"btn_act":"vreq","ctg_req":ctg_req,"desc_out":desc_out,},
            success:function(resp_vreq){
               alert(resp_vreq);
               if(resp_vreq==="success"){
                location.reload();
               }
            }
        })
    })
</script>

<?php ob_end_flush(); ?>
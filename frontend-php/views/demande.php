<?php require 'myheader.php'; ?>
<?php
if($user_role ==="UXXX" || $user_role==="UMXX" || $user_role==="UMAX" || $user_role==="UMAS"){
  
}else{
    header('Location:page404.php');
}
?>
<title>Demande</title>

<div class="container">
    <div class="row">

        <div class="col-md-6">
            <label class="form-label lblinp" for="allprds">Catégorie </label>
            <select class="form-select" id="slc_ctg">
                <option></option>
                <?php
                $scan_ctg = mysqli_query($link_db, "SELECT * from nw_ctg");
                while ($rows_ctg = mysqli_fetch_array($scan_ctg)) {
                    echo "<option>" . $rows_ctg['categorie'] . "</option>";
                }
                ?>
            </select>


            <label class="form-label lblinp" for="allprds">Demande </label>
            <div class="inpfrom d-flex align-items-center">
                <input list="allprdslist" id="inpprd" name="inpprd" class="form-control" placeholder="chercher un article ..." autocomplete="off" />
                <div class="clrinp" style="margin-left: 5px;"><i class="far fa-trash-alt text-danger " style="cursor: pointer;"></i></div>
            </div>
            <datalist id="allprdslist">

            </datalist>

            <div style="margin-top: 25px;" class="prd_info d-flex flex-column align-items-center">







            </div>


        </div>

        <div class="col-md-6">
            <table class="table table-striped">
                <thead>
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
        </div>




    </div>
</div>





<?php require 'js_link.php'; ?>
<script>
    $('document').ready(function() {
        var cur_tit = $(this).attr('title');
        $('.thetitle').html('<i class="fas fa-file-import"></i> '+cur_tit);
        $.ajax({
            url: "databin.php",
            method: "POST",
            data: {
                "btn_act": "first_pan",

            },
            success: function(resp_pan) {
                $('#tb_panier').html(resp_pan);
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
                    var slc_ctg=$('#slc_ctg').val();

                    $.ajax({
                        url: "databin.php",
                        method: "POST",
                        data: {
                            "btn_act": "addpan",
                            "id_dem": id_dem,
                            "nmsr_dem": nmsr_dem,
                            "qnt_dem": qnt_dem
                        },
                        success: function(resp_pan) {
                            $('#tb_panier').html(resp_pan);
                        }
                    })
                })
            }
        })
    })

    $('#inpprd, #slc_ctg').change(function() {
    var prd = $('#inpprd').val();
    var ctg = $('#slc_ctg').val();
    
    $.ajax({
        url: "databin.php",
        method: "POST",
        data: {
            "btn_act": "demande",
            "prd": prd,
            "ctg": ctg  // Ajout de la catégorie dans les données à envoyer
        },
        success: function(resp_dem) {
            $('.prd_info').html(resp_dem);

            }
        })
    })
</script>
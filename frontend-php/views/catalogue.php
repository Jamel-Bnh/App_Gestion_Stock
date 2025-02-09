<?php require 'myheader.php'; ?>
<title>Catalogue</title>
<?php
if( $user_role==="UMXX" || $user_role==="UMAX" || $user_role==="UMAS" || $user_role==="UXXX" ){
    
}else{
    header('Location:page404.php');
}
?>
<div class="container">
    <div class="row">
        <div class="navsearch d-flex align-items-center "
            style="width: 100%;background:#0077c0;height:50px;border-bottom: 3px solid;">
            <select class="form-select w-25 m-2" id="sea_mag" style="height: 35px;">
                <option>magasin</option>
                <?php
                            $scan_mag = mysqli_query($link_db, "SELECT * from nw_magasin");
                            while ($rows_mag = mysqli_fetch_array($scan_mag)) {
                                echo "<option>" . $rows_mag['magasin'] . "</option>";
                            }
                            ?>
            </select>
            <select class="form-select w-25 m-2" id="sea_emp" style="height: 35px;">
                <option></option>
            </select>
            <select class="form-select w-25 m-2" id="sea_ctg" style="height: 35px;">
                <option>categorie</option>
                <?php
                            $scan_ctg = mysqli_query($link_db, "SELECT * from nw_ctg");
                            while ($rows_ctg = mysqli_fetch_array($scan_ctg)) {
                                echo "<option>" . $rows_ctg['categorie'] . "</option>";
                            }
                            ?>
            </select>
            <div class="d-flex align-items-end w-50 justify-content-end">
                <div class="w-50 d-flex justify-content-center align-items-center">
                    <div><b><i class="fas fa-chevron-left text-white" id="gtl" style="cursor: pointer;"></i></b></div>
                    <input type="text" class="form-control w-25 text-center bg-transparent border-0 text-white"
                        value="1" min="1" id="frst_idx">
                    <span class="text-white"><b>-</b></span>
                    <input type="text" class="form-control w-25 text-center bg-transparent border-0 text-white"
                        id="end_idx">
                    <div><i class="fas fa-chevron-right text-white " id="gtr" style="cursor: pointer;"></i></div>

                </div>
            </div>


        </div>

        <table class="table table-striped">
            <thead>
                <th>ID Produit</th>
                <th>Produit</th>
                <th>Catégorie</th>
                <th>Fabriquant</th>
                <th>Emplacement</th>
               
                <th>Image</th>
                <th>Document</th>
                <th>Quantité</th>
            </thead>
            <tbody id="tb_cata">
            </tbody>
        </table>





    </div>
</div>


<div class="container">
    <div class="row">
        <a class="btn btn-primary" href="javascript:history.go(-1)">Retour</a>
    </div>
</div>

<?php require 'js_link.php'; ?>
<script>
     $('document').ready(function(){
        var cur_tit=$(this).attr('title');
        $('.thetitle').html('<i class="fas fa-book-open"></i> '+cur_tit);
    })
$('document').ready(function() {
    var frst_idx = $('#frst_idx').val();
    $.ajax({
        url: "databin.php",
        method: "POST",
        dataType: "HTML",
        data: {
            "btn_act": "getallitem",
            "frst_idx": frst_idx
        },
        success: function(resp_all) {
            var rslt = JSON.parse(resp_all);
            $('#end_idx').val(rslt['nb_pg']);
            $('#tb_cata').html(rslt['ctlg']);

        }
    })
});

$('#gtl').click(function() {
    var cur_idx = $('#frst_idx').val();
    if (parseInt(cur_idx) == 1) {} else {
        $('#frst_idx').val(parseInt(cur_idx) - 1);
        $('#frst_idx').change();
    }
})
$('#gtr').click(function() {
    var end_idx = $('#end_idx').val();
    var cur_idx = $('#frst_idx').val();
    if (cur_idx == end_idx) {

    } else {
        $('#frst_idx').val(parseInt(cur_idx) + 1);
        $('#frst_idx').change();
    }
});
$('#frst_idx').change(function() {
    var frst_idx = $('#frst_idx').val();
    $.ajax({
        url: "databin.php",
        method: "POST",
        dataType: "HTML",
        data: {
            "btn_act": "getallitem",
            "frst_idx": frst_idx
        },
        success: function(resp_all) {
            var rslt = JSON.parse(resp_all);
            $('#end_idx').val(rslt['nb_pg']);
            $('#tb_cata').html(rslt['ctlg']);
        }
    })
});


$('#sea_mag').change(function() {
    var mag = $('#sea_mag').val();
    $.ajax({
        url: "databin.php",
        method: "POST",
        dataType: "HTML",
        data: {
            "btn_act": "getemp",
            "mag": mag
        },
        success: function(emp_list) {
            $('#sea_emp').html(emp_list)
        }
    })
})

$('#sea_emp').change(function(){
    var cur_emp=$('#sea_emp').val();
    $.ajax({
        url: "databin.php",
        method: "POST",
        dataType: "HTML",
        data: {
            "btn_act": "getempp",
            "sea_emp": cur_emp
        },
        success: function(empp_list) {
            $('#tb_cata').html(empp_list);
            
        }
    })
})

$('#sea_ctg').change(function(){
    var cur_ctg=$('#sea_ctg').val();
    $.ajax({
        url: "databin.php",
        method: "POST",
        dataType: "HTML",
        data: {
            "btn_act": "getctgpr",
            "cur_ctg": cur_ctg
        },
        success: function(empp_list) {
            $('#tb_cata').html(empp_list);
            
        }
    })
})
</script>

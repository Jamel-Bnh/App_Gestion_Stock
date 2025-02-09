<?php
if (isset($_POST['qnt'])) {
    require "config.php"; // Mise à jour du fichier de configuration
    $arr = array();
    $prd = $_POST['prd_out'];
    $qnt = $_POST['qnt'];
    $id_pr = $_POST['id_pr'];
    $ins_qnt = mysqli_query($link_db, "INSERT INTO nw_quantite(id_pr,qnt)VALUE('" . $id_pr . "','" . $qnt . "')");
    if ($ins_qnt) {
        $arr['a'] = "success OK";
    } else {
        $arr['a'] = "failed";
    }

    exit(json_encode($arr));
}
?>

<?php require 'myheader.php'; ?>
<?php
if ($_SESSION['user_role'] === "UMXX" || $_SESSION['user_role'] === "UMAS") {
    // Accès autorisé
} else {
    header('Location: /404'); // Mise à jour du chemin
    exit();
}
?>

<title>Ajout au Stock</title>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="dv_info">AJOUT AU STOCK</div>
            <form method="POST" id="frm_qnt">
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label" for="frnss">Produit</label>
                            <input list="produits" id="prd_out" name="prd_out" class="form-control" autocomplete="off" required>
                            <datalist id="produits">
                                <?php
                                $scan_allprds = mysqli_query($link_db, "SELECT * from nw_produits");
                                while ($rows_allprds = mysqli_fetch_array($scan_allprds)) {
                                    echo "<option>" . $rows_allprds['prd'] . "</option>";
                                }
                                ?>
                            </datalist>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-outline d-flex flex-column align-items-center">
                            <div class="img_rep"></div>
                            <input id="id_pr" name="id_pr" class="form-control text-center bg-white border-0" autocomplete="off" required readonly>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label" for="qnt_pr">Quantité</label>
                            <input id="qnt_pr" type="number" name="qnt_pr" class="form-control" autocomplete="off" required min="1">
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label" for="nmsr_pr">Numéro de serie</label>
                            <input id="nmsr_pr" type="text" name="nmsr_pr" class="form-control" autocomplete="off">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">AJOUTER</button>
            </form>
        </div>
        <div class="col-md-6">
            <div class="dv_info">Bon</div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>N° Serie</th>
                    </tr>
                </thead>
                <tbody id="cont_in">
                    <?php
                    $scan_tmp_in = mysqli_query($link_db, "SELECT * from tmp_in WHERE user_in='$user_connected'");
                    while ($rows_tmp_in = mysqli_fetch_array($scan_tmp_in)) {
                    ?>
                        <tr class="ligne_produit">
                            <td><?php echo $rows_tmp_in['id_pr']; ?></td>
                            <td><?php echo $rows_tmp_in['prd']; ?></td>
                            <td><?php echo $rows_tmp_in['qnt_pr']; ?></td>
                            <td><?php echo $rows_tmp_in['nmsr_pr']; ?></td>
                            <td>
                                <i class="fas fa-user-minus m-2 text-danger del_prd" id='<?php echo $rows_tmp_in['id_pr']; ?>'></i>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <button class="btn btn-primary" id="vald_bon">Valider Bon</button>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <a class="btn btn-primary" style="width: 200px;margin:auto;" href="javascript:history.go(-1)">Retour</a>
    </div>
</div>

<div class="modal fade" id="prd_delt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <div class="prd_n">Supprimer le produit</div>
                </h5>
            </div>
            <div class="modal-body">
                <p> Voulez-vous supprimer ce produit </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary dlt_prd">Confirmer</button>
                <button class="btn btn-danger ann_btn">Annuler</button>
            </div>
        </div>
    </div>
</div>

<?php require 'js_link.php'; ?>
<script>
    $('document').ready(function() {
        var cur_tit = $(this).attr('title');
        $('.thetitle').html('<i class="fas fa-file-import"></i> ' + cur_tit);
    });

    $('#frm_qnt').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "/ajout", // Mise à jour du chemin
            method: "POST",
            data: $(this).serialize(),
            dataType: "JSON",
            success: function(resp_add) {
                if (resp_add['a'] === "success OK") {
                    alert("Article ajouté avec succès.");
                } else if (resp_add['a'] === "failed") {
                    alert("Article déjà ajouté au bon.");
                } else {
                    alert("Numéro de série dupliqué.");
                }
            }
        });
    });

    $('#prd_out').change(function() {
        var prd = $('#prd_out').val();
        $.ajax({
            url: "/databin", // Mise à jour du chemin
            method: "POST",
            data: { "btn_act": "getidpr", "prd": prd },
            dataType: "HTML",
            success: function(resp_id) {
                var arr_pr = JSON.parse(resp_id);
                var img_rep = arr_pr['img_pr'];
                var mag = arr_pr['mag'];
                var emp = arr_pr['emp'];
                var chnsr = arr_pr['chnsr'];
                $('#id_pr').val(arr_pr['id_pr']);
                $('.img_rep').html('<img style="width:180px" src=' + img_rep + ' />');
                $('.emp_mag').html("<b>Magasin</b> : " + mag + " <b>Emplacement : </b>" + emp);
                if (chnsr == "oui") {
                    $("#qnt_pr").val(1);
                    $('#qnt_pr').attr('readonly', true);
                    $('#nmsr_pr').attr('required', true);
                    $('#nmsr_pr').attr('readonly', false);
                    $('#nmsr_pr').val('');
                } else if (chnsr == "non") {
                    $('#qnt_pr').attr('readonly', false);
                    $('#nmsr_pr').attr('readonly', true);
                    $('#nmsr_pr').val('N/A');
                }
            }
        });
    });

    $('#frm_qnt').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "/databin", // Mise à jour du chemin
            method: "POST",
            dataType: "html",
            data: $(this).serialize() + "&btn_act=add_tb",
            success: function(resp_tb) {
                if (resp_tb === "failed") {
                    alert("Article Deja ajouté");
                } else if (resp_tb === "failed0") {
                    alert("Numéro de serie dupliqué");
                } else {
                    $('#cont_in').html(resp_tb);
                    $('#prd_out').val("");
                }
            }
        });
    });

    $('#vald_bon').click(function() {
        $.ajax({
            url: "/databin", // Mise à jour du chemin
            method: "POST",
            data: { "btn_act": "valdbon" },
            success: function(resp_bon) {
                if (resp_bon === "success") {
                    location.reload();
                }
            }
        });
    });

    $('#sea_mag').change(function() {
        var mag = $('#sea_mag').val();
        $.ajax({
            url: "/databin", // Mise à jour du chemin
            method: "POST",
            dataType: "HTML",
            data: { "btn_act": "getemp", "mag": mag },
            success: function(emp_list) {
                $('#sea_emp').html(emp_list);
            }
        });
    });

    $('#sea_emp').change(function() {
        var cur_emp = $('#sea_emp').val();
        $.ajax({
            url: "/databin", // Mise à jour du chemin
            method: "POST",
            dataType: "HTML",
            data: { "btn_act": "getempp", "sea_emp": cur_emp },
            success: function(empp_list) {
                $('#tb_cata').html(empp_list);
            }
        });
    });

    $('.del_prd').click(function() {
        var del_prd = this.id;
        $('.dlt_prd').attr('id', del_prd);
        $('#prd_delt').modal('show');
    });

    $('.dlt_prd').click(function() {
        var del_prd = this.id;
        $.ajax({
            url: "/databin", // Mise à jour du chemin
            method: "POST",
            data: { "btn_act": "delprd", "del_prd": del_prd },
            success: function(resp_dprd) {
                if (resp_dprd === "success") {
                    alert(resp_dprd);
                    location.reload();
                } else {
                    alert(resp_dprd);
                }
            }
        });
    });
</script>
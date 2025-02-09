<?php require 'myheader.php'; ?>
<?php
if( $user_role==="UMAS"){
  
}else{
    header('Location:page404.php');
}
?>
<title>Gestion Division</title>
<div class="container">
    <div class="row">
        <button class="btn btn-success w-25" id="add_div"> <i class="fas fa-grip-horizontal"></i> Nouvelle
            Division</button>


        <table class="table table-striped mt-3">
            <thead class="th_info">
                <th>Division</th>
                <th>Administrateur</th>
                <th>NOM ET PRENOM</th>

                <th> </th>



            </thead>
            <tbody class="tb_users">
                <?php
                $scan_user = mysqli_query($link_db, "SELECT * from nw_division");
                while ($rows_users = mysqli_fetch_array($scan_user)) {
                ?>
                <tr>
                    <td><?php echo $rows_users['division']; ?></td>
                    <td><?php echo $rows_users['admindvs']; ?></td>
                    <td>
                    <?php
$admin_id = $rows_users['admindvs'];
$query_admin_info = mysqli_query($link_db, "SELECT user_name FROM users_stock WHERE matricule = $admin_id");

if ($query_admin_info) {
    $admin_info = mysqli_fetch_assoc($query_admin_info);
   
    if ($admin_info) {
        // L'administrateur existe dans la base de données, affichez son nom et prénom
        echo $admin_info['user_name'];
    } else {
        // L'administrateur n'existe pas, affichez un message d'erreur
        echo "Administrateur introuvable";
    }
} else {
    // Une erreur MySQL s'est produite, affichez le message d'erreur
    echo "Erreur MySQL : " . mysqli_error($link_db);
 
}
?>

                </td>
                <td></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>


    </div>
</div>
<form id="frm_dvs" method="POST">
    <div class="modal fade" id="modal_add_div" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-grip-horizontal"></i> Nouvelle
                        Division</h5>
                </div>
                <div class="modal-body">
                    <!-- Vos champs de formulaire ici -->
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="dvs_name">Division</label>
                                <input type="text" id="dvs_name" name="dvs_name" class="form-control" autocomplete="off"
                                    required />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="dvs_admin">Administrateur</label>
                                <select class='form-select admin_ctg' id="<?php echo $ctg_rows['categorie']; ?>">
                                    <?php
                                    echo "<option class='bg-danger text-light'>" . $ctg_rows['admin_ctg'] . "</option>";
                                    $scan_users = mysqli_query($link_db, "SELECT * from users_stock");
                                    while ($rows_users = mysqli_fetch_array($scan_users)) {
                                        echo "<option>" . $rows_users['matricule'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="dvs_desc">Description</label>
                                <textarea class="form-control" id="dvs_desc" name="dvs_desc"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- Bouton Annuler pour réinitialiser le formulaire -->
                    <button type="reset" class="btn btn-secondary" id="cancel_btn">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </div>
        </div>
    </div>
</form>





<div class="container" >

    <div class="row" >
        <a class="btn btn-primary" style="width: 200px;margin:auto;" href="javascript:history.go(-1)">Retour</a>
    </div>
</div>


<?php require 'js_link.php'; ?>
<script>
 
$('document').ready(function() {
    var cur_tit = $(this).attr('title');
    $('.thetitle').html('  <i class="fas fa-grip-horizontal"></i> '+cur_tit);
})
$('#add_div').click(function() {
    $('#modal_add_div').modal('show');
})

$('#frm_dvs').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: "databin.php",
        method: "POST",
        data: $(this).serialize() + "&btn_act=adddvs",
        success: function(resp_dvs) {
            if (resp_dvs == "success") {
                
                location.reload();
            }
        }


    })

})
</script>
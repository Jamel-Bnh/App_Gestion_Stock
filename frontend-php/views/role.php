<?php require 'myheader.php'; ?>
<?php
if(  $user_role==="UMAS"){
  
}else{
    header('Location:page404.php');
}
?>

<title>Gestion Role</title>
<div class="container">
    <div class="row">
        <button class="btn btn-success w-25" id="add_div"><i class="fas fa-user-nurse"></i> Nouvelle Role</button>


        <table class="table table-striped mt-3">
    <thead class="th_info">
        <th>Role</th>
        <th>Description</th>
        <th>Actions</th>
    </thead>
    <tbody class="tb_roles">
        <?php
        $scan_role = mysqli_query($link_db, "SELECT * from nw_role");
        while ($rows_roles = mysqli_fetch_array($scan_role)) {
            ?>
            <tr>
                <td><?php echo $rows_roles['role_name']; ?></td>
                <td><?php echo $rows_roles['desc_r']; ?></td>
                <td>
                <i class="fas fa-user-minus m-2 text-danger del_role" id='<?php echo $rows_roles['role_name']; ?>'></i>
                 <i class="fas fa-user-edit m-2 text-primary edt_role" id='<?php echo $rows_roles['role_name']; ?>'></i>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>


    </div>
</div>

<div class="modal fade" id="modal_add_div" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="submit" id="frm_rle">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nouvelle Role</h5>
        
      </div>
      <div class="modal-body">
      <div class="row mb-3">
                <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="rle">Role</label>
                        <input type="text" id="rle" name="rle" class="form-control" autocomplete="off"
                            required />

                    </div>
                </div>
              
            </div>
       
            <div class="row mb-3">
                <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="prix_pr">Description</label>
                       <textarea class="form-control" id="rle_desc" name="rle_desc" required></textarea>

                    </div>
                </div>
                
            </div>
      </div>
      <div class="modal-footer">
       
      <button type="reset" class="btn btn-secondary" id="cancel_btn">Annuler</button>
        <button type="submit" class="btn btn-primary">Ajouter</button>
        
      </div>
    </div>
  </div>
  </form>
</div>



<div class="container" >

    <div class="row" >
        <a class="btn btn-primary" style="width: 200px;margin:auto;" href="javascript:history.go(-1)">Retour</a>
    </div>
</div>

<!-- modal delete role-->

<div class="modal fade" id="role_delt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <div class="role_n">Supprimer un role</div>
                </h5>



            </div>
            <div class="modal-body">

                <p> Voulez-vous supprimer cet role </p>



            </div>
            <div class="modal-footer">
                <button class="btn btn-primary dlt_role">Confirmer</button>
                <button class="btn btn-danger ann_btn">Annuler</button>



            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="erole_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <div class="role_n"></div>
                </h5>



            </div>
            <div class="modal-body">

                <form method="POST" id="frm_erole">
                    <div class="row mb-3">

                       
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="role_rol">Role </label>
                                <input type="text" id="role_rol" name="role_rol" class="form-control" autocomplete="off"
                            required />


                            </div>

                        </div>
                        <div class="col">
                        <div class="form-outline">
                                <label class="form-label" for="role_des">description </label>
                                <input type="text" id="role_des" name="role_des" class="form-control" autocomplete="off"
                            required />


                            </div>

                        


                    </div>

                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
                </div>
            <div class="modal-footer">




            </div>
        </div>

<?php require 'js_link.php'; ?>



<script>
      //
 


//
       $('document').ready(function(){
        var cur_tit=$(this).attr('title');
        $('.thetitle').html('<i class="fas fa-user-nurse"></i> '+cur_tit);
    })
    $('#add_div').click(function(){
        $('#modal_add_div').modal('show');
    })

    $('#frm_rle').submit(function(e){
        e.preventDefault();
        $.ajax({
            url:"databin.php",
            method:"POST",
            data:$(this).serialize()+"&btn_act=addrle",
            success:function(resp_rle){
                if(resp_rle=="success"){
                    location.reload();
                }
            }
        })
        
    })


    $('.del_role').click(function() {
        var del_role = this.id;
        $('.dlt_role').attr('id', del_role);
        $('#role_delt').modal('show');

      
    })

$('.dlt_role').click(function(){
        var del_role = this.id;
        $.ajax({
              url: "databin.php",
              method: "POST",
              data: {
                  "btn_act": "delrole",
                  "del_role": del_role
              },
              success: function(resp_drole) {
                  if (resp_drole === "success") {
                      alert(resp_drole);
                      location.reload();
                  } else {
                      alert(resp_drole);
                  }
              }
          })

    })

    $('.edt_role').click(function() {
        var edt_role = this.id;
        $.ajax({
            url: "databin.php",
            method: "POST",
            data: {
                "btn_act": "edtrole",
                "edt_role": edt_role
            },
            success: function(resp_erole) {

                var jsroles_info = JSON.parse(resp_erole);

                $('.role_n').html("<b>" + jsroles_info['role_name'] + "</b>");
                $('#erole_modal').modal('show');

                $('#frm_erole').submit(function(e) {
                    e.preventDefault();
                    
                    var role_rol = $('#role_rol').val();
                    var role_des = $('#role_des').val();
                    $.ajax({
                        url: "databin.php",
                        method: "POST",
                        data: {
                            "btn_act": "edrole",
                            
                            "role_rol": role_rol,
                            "role_des": role_des,

                            "role_id": edt_role
                        },
                        success: function(role_edit) {
                            if (role_edit === "success") {
                                alert(role_edit);
                                location.reload();
                            } else {
                                alert(role_edit);
                            }

                        }
                    })


                })

            }
        })

    })

</script>
<?php require 'myheader.php'; ?>
<title>Mon Compte</title>


<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form method="POST" id="frm_info">
                <div class="dv_info">Mon Compte</div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-outline">
                            <?php
                            $current_user = $_SESSION['user_connected'];
                            $scan_user = mysqli_query($link_db, "SELECT * from users_stock WHERE matricule='$current_user'");
                            $rows_users = mysqli_fetch_array($scan_user);
                            $user_name = $rows_users['user_name'];


                            ?>
                            <label class="form-label" for="nw_mat">Matricule</label>
                            <input type="text" id="nw_mat" name="nw_mat" class="form-control" value='<?php echo $rows_users['matricule']; ?>' autocomplete="off" readOnly />

                        </div>
                    </div>

                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label" for="nw_name">Nom & Prénom</label>
                            <input type="text" id="nw_name" name="nw_name" class="form-control" autocomplete="off" value='<?php echo $rows_users['user_name']; ?>' required />

                        </div>
                    </div>

                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label" for="nw_mail">Email</label>
                            <input type="text" id="nw_mail" name="nw_mail" class="form-control" autocomplete="off" value='<?php echo $rows_users['user_email']; ?>' required />

                        </div>
                    </div>

                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label" for="nw_tel">Télephone</label>
                            <input type="text" id="nw_tel" name="nw_tel" class="form-control" autocomplete="off" value='<?php echo $rows_users['user_phone']; ?>' required />

                        </div>
                    </div>

                </div>
                <button class="btn btn-primary" type="submit">Sauvegarder</button>
            </form>
        </div>
        <div class="col-md-6">
            <form method="POST" id="frm_psw">
                <div class="dv_info">Mot de Passe</div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label" for="old_psw">Mot de passe actuel</label>
                            <input type="password" id="old_psw" name="old_psw" class="form-control" autocomplete="off" required />

                        </div>
                    </div>

                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label" for="nw_psw">Nouvelle mot de passe</label>
                            <input type="password" id="nw_psw" name="nw_psw" class="form-control" autocomplete="off" required />

                        </div>
                    </div>

                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label" for="cf_psw">Confirmer </label>
                            <input type="password" id="cf_psw" name="cf_psw" class="form-control" autocomplete="off" required />

                        </div>
                    </div>

                </div>
                <button class="btn btn-primary" type="submit">Sauvegarder</button>
            </form>
        </div>



    </div>
</div>





<?php require 'js_link.php'; ?>
<script>
        $('document').ready(function() {
        var cur_tit = $(this).attr('title');
        $('.thetitle').html(cur_tit);
    })

    $('#frm_info').submit(function(e) {
        e.preventDefault();
         $.ajax({
            url: "databin.php",
            method: "POST",
            data: $(this).serialize() + "&btn_act=editinfo",
            success: function(resp_edit) {
                alert(resp_edit);
            }

        }) 
       
    })

    $('#frm_psw').submit(function(e) {
        e.preventDefault();
         $.ajax({
            url: "databin.php",
            method: "POST",
            data: $(this).serialize() + "&btn_act=editpsw",
            success: function(resp_psw) {
                alert(resp_psw);
            }

        }) 
       
    })
</script>



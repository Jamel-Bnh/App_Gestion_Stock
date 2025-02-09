<?php require 'myheader.php'; ?>

<?php
if ($user_role !== "UMAX" && $user_role !== "UMAS") {
    header('Location: page404.php');
    exit; 
}
?>

<title>Paramètres</title>

<div class="container">
    <div class="row">
  

        <div class="col-md-4">
            <div class="dv_info">Nouvelle Notification</div>
            <form method="POST" id="frm_log">
                <div class="mb-3">
                    <label for="tp_log" class="form-label">Type</label>
                    <input type="text" id="tp_log" name="tp_log" class="form-control" autocomplete="off" required>
                </div>
                    </div>

                </div>

                <div class="row mb-3">
                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label" for="act_log">Action</label>
                            <input type="text" id="act_log" name="act_log" class="form-control" autocomplete="off" required />

                        </div>
                    </div>

                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label" for="sts_log">Status</label>

                            <select class="form-select" id="sts_log" name="sts_log" required>
                                <option>

                                </option>
                                <option>réussi</option>
                                <option>erreur</option>

                            </select>
                        </div>
                    </div>

                </div>

                <div class="form-outline">
                    <label class="form-label" for="nv_log">Niveau </label>
                    <select class="form-select" id="nv_log" name="nv_log" required>
                        <option>

                        </option>
                        <?php
                        $scan_log = mysqli_query($link_db, "SELECT * from log_niveau");
                        while ($rows_log = mysqli_fetch_array($scan_log)) {
                            echo "<option>" . $rows_log['level'] . "</option>";
                        }
                        ?>
                    </select>

                </div>

                <button class="btn btn-primary mt-3" type="submit">Ajouter</button>
            </form>
        </div>

        <div class="col-md-8">
            <div class="dv_info">Liste des notifications</div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Action</th>
                        <th>Status</th>
                        <th>Niveau</th>
                    </tr>
                </thead>
                <tbody class="tb_ntfc">
                 
                </tbody>
            </table>
        </div>
    </div>


<div class="container" >

    <div class="row" >
        <a class="btn btn-primary" style="width: 200px;margin:auto;" href="javascript:history.go(-1)">Retour</a>
    </div>
</div>
<?php require 'js_link.php'; ?>
<script>
    $(document).ready(function() {
        var cur_tit = $(this).attr('title');
        $('.thetitle').html(cur_tit);

        function updateNotificationsTable() {
            $.ajax({
                url: "databin.php",
                method: "POST",
                data: { "btn_act": "getntfc" },
                success: function(resp_tbntfc) {
                    $('.tb_ntfc').html(resp_tbntfc);
                }
            });
        }

   
        updateNotificationsTable();

        $('#frm_log').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "databin.php",
                method: "POST",
                data: $(this).serialize() + "&btn_act=addntfc",
                success: function(resp_ntfc) {
                    if (resp_ntfc === "success") {
                        updateNotificationsTable();
                    } else {
                        alert(resp_ntfc);
                    }
                }
            });
        });
    });
</script>
<?php
if (isset($_POST['desc_emp'])) {
    $mag_p = $_POST['mag_p'];
    $type_emp = $_POST['type_emp'];
    $emp_name = $_POST['emp_name'];
    $nb_etg = $_POST['nb_etg'];
    $desc_emp = $_POST['desc_emp'];

    $sts = "OK";
    $ins_emp_mag = true;
    require "link_db.php";
    for ($i = 1; $i <= $nb_etg; $i++) {
        $current_etq = $emp_name . "E" . $i;
        $ins_emp = "INSERT INTO nw_location(location_mag,type_emp,emp,desp,sts)VALUES('" . $mag_p . "','" . $type_emp . "','" . $current_etq . "','" . $desc_emp . "','" . $sts . "')";
        $req_emp = mysqli_query($link_db, $ins_emp);
        if ($req_emp) {
        } else {
            $ins_emp_mag = false;
        }
    }
    $arr = array();
    require 'link_db.php';
    if ($ins_emp_mag) {
        $arr['rslt'] = true;

        exit(json_encode($arr));
    } else {
        $arr['rslt'] = false;
        exit(json_encode($arr));
    }
}


?>
<?php require 'myheader.php'; ?>
<?php
if(   $user_role==="UMXX"  || $user_role==="UMAS"){
  
}else{
    header('Location:page404.php');
}
?>
<title>Gestion Division</title>
<div class="container">
    <div class="row">

        <div class="col-md-6">
            <div class="dv_info">Nouvelle Emplacement</div>

            <div class="row">
                <div class="col">

                    <form method="POST" id="frm_emp">
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-outline">
                                    <label class="form-label" for="mag_p">Magasin</label>
                                    <select class="form-select" id="mag_p" name="mag_p" required>
                                        <option></option>
                                        <?php
                                        $scan_mags = mysqli_query($link_db, "SELECT * from nw_magasin");
                                        while ($rows_mags = mysqli_fetch_array($scan_mags)) {
                                            echo "<option>" . $rows_mags['magasin'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row mb-3">
    <div class="col">
        <div class="form-outline">
            <label class="form-label" for="type_emp">Type D'emplacement</label>
            <select class="form-select" id="type_emp" name="type_emp" required>
                <option></option>
                <option>Armoire</option>
                <option>Etagaire</option>                    
                <option>Section</option> 
                <option>abri</option> 
                <option>distant</option> 
                <option>Sur site</option> 
                <option>local entier</option> 
            </select>
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col">
        <div class="form-outline">
            <label class="form-label" for="emp_name">Etiquette Emplacement</label>
            <input type="text" id="emp_name" name="emp_name" class="form-control" autocomplete="off" required min="1" />
        </div>
    </div>
</div>

<script>
    // Obtenez une référence à l'élément de sélection
    var typeEmpSelect = document.getElementById("type_emp");
    
    // Obtenez une référence à l'élément de saisie de texte
    var empNameInput = document.getElementById("emp_name");

    // Écoutez le changement de sélection
    typeEmpSelect.addEventListener("change", function () {
        // Mettez à jour la valeur de l'élément de saisie de texte avec la valeur sélectionnée
        empNameInput.value = typeEmpSelect.value;
    });
</script>

                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-outline">
                                    <label class="form-label" for="nb_etg">Nombre D'étages</label>
                                    <input type="number" id="nb_etg" name="nb_etg" class="form-control" autocomplete="off"  />

                                </div>
                            </div>

                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-outline">
                                    <label class="form-label" for="desc_emp">Description</label>
                                    <textarea class="form-control" id="desc_emp" name="desc_emp" ></textarea>

                                </div>
                            </div>

                        </div>

                        <button class="btn btn-primary" type="submit"><i class="fas fa-check"></i> Ajouter</button>

                    </form>
                </div>
            </div>

        </div>


        <div class="col-md-6">
            <div class="dv_info">Liste Des Emplacements</div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Magasin</th>
                        <th>Type</th>
                        <th>Etiquette</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $scan_mag = mysqli_query($link_db, "SELECT * from nw_location");
                    while ($mag_rows = mysqli_fetch_array($scan_mag)) {
                        echo "<tr><td>" . $mag_rows['location_mag'] . "</td><td>" . $mag_rows['type_emp'] . "</td><td>" . $mag_rows['emp'] . "</td><td>" . $mag_rows['sts'] . "</td><td><i class='fa fa-times-circle text-danger del_emp' id=" . $mag_rows['id'] . " style='cursor:pointer;'></i></td></tr>";
                    }
                    ?>

                </tbody>

            </table>
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
    var cur_tit = $(this).attr('title');
    $('.thetitle').html('<i class="far fa-file-alt"></i> ' + cur_tit);
    $('#frm_emp').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "emplacement.php",
            method: "POST",
            dataType: "html",
            data: $(this).serialize(),
            success: function(resp_mag) {
                location.reload();


            }
        })
    });

    $('.del_emp').click(function() {
        var del_emp = this.id;
        $.ajax({
            url: "databin.php",
            method: "POST",
            data: {
                "btn_act": "delemp",
                "del_emp": del_emp
            },
            success: function(del_resp) {
                location.reload();

            }
        })

    })
</script>
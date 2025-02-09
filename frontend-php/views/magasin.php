<?php

if(isset($_POST['nw_mag'])){
    $nw_mag=$_POST['nw_mag'];
    $emp_mag=$_POST['emp_mag'];
    $desc_mag=$_POST['desc_mag'];
    $arr=array();
    $sts="OK";
    require 'link_db.php';
     $ins_mag=mysqli_query($link_db,"INSERT INTO nw_magasin(magasin,location,descp,sts)VALUES('".$nw_mag."','".$emp_mag."','".$desc_mag."','".$sts."')");
    if($ins_mag){
        $arr['rslt']=true;
         
        exit(json_encode($arr));
        
    }else{
        $arr['rslt']=false;
        exit(json_encode($arr));
    }  
}

 
?>
<?php require 'myheader.php'; ?>
<?php
if(  $user_role==="UMXX"  || $user_role==="UMAS"){
  
}else{
    header('Location:page404.php');
}
?>
<title>Gestion Magasin</title>
<div class="container">
    <div class="row">

    <div class="col-md-6">
        <div class="dv_info">Nouveau Magasin</div>

    <div class="row">
        <div class="col">

        <form method="POST" id="frm_mag">
        <div class="row mb-3">
                <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="nw_mag">Magasin</label>
                        <input type="text" id="nw_mag" name="nw_mag" class="form-control" autocomplete="off" required />

                    </div>
                </div>

            </div>
            <div class="row mb-3">
                <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="emp_mag">Emplacement</label>
                        <input type="text" id="emp_mag" name="emp_mag" class="form-control" autocomplete="off"  />

                    </div>
                </div>

            </div>
         
            <div class="row mb-3">
                <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="desc_mag">Description</label>
                        <textarea class="form-control" id="desc_mag" name="desc_mag" ></textarea>

                    </div>
                </div>

            </div>

            <button class="btn btn-primary" type="submit"><i class="fas fa-check"></i> Ajouter</button>

        </form>
        </div>
    </div>

    </div>


    <div class="col-md-6">
        <div class="dv_info">Liste Des Magasins</div>
        <table class="table table-striped">
            <thead>
                <tr><th>Magasin</th><th>Emplacement</th><th>Status</th><th></th></tr>
            </thead>
            <tbody>
                <?php
                $scan_mag=mysqli_query($link_db,"SELECT * from nw_magasin");
                while($mag_rows=mysqli_fetch_array($scan_mag)){
                    echo "<tr><td>".$mag_rows['magasin']."</td><td>".$mag_rows['location']."</td><td>".$mag_rows['sts']."</td><td><i class='fa fa-times-circle text-danger del_mag' id=".$mag_rows['id']." style='cursor:pointer;'></i></td></tr>";
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
     $('document').ready(function() {
        var cur_tit = $(this).attr('title');
        $('.thetitle').html('<i class="fas fa-file-import"></i> '+cur_tit);
    })
    $('#frm_mag').submit(function(e){
        e.preventDefault();
        $.ajax({
            url:"magasin.php",
            method:"POST",
            dataType:"JSON",
            data:$(this).serialize(),
            success:function(resp_mag){
                location.reload();
            }
        })

    });

    $('.del_mag').click(function(){
        var del_mag=this.id;
        $.ajax({
            url:"databin.php",
            method:"POST",
            data:{"btn_act":"delmag","del_mag":del_mag},
            success:function(delmag_resp){
                location.reload();
                
            }
        })
    })
</script>
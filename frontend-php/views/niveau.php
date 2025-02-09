<?php require 'myheader.php'; ?>
<title>Niveaux SysLog</title>


<div class="container">
    <div class="row">

    <table class="table table-striped ">
        <thead class="th_info">
            <th>N°</th>
            <th>Niveau</th>
            <th>Description</th>
            <th>Couleur</th>
        </thead>
        <tbody>
            <?php

            $scan_niveau=mysqli_query($link_db,"SELECT * from log_niveau");
            while($rows_niveau=mysqli_fetch_array($scan_niveau)){
                echo "<tr><td>".$rows_niveau['num']."</td><td>".$rows_niveau['level']."</td><td>".$rows_niveau['desc_n']."</td>";
                echo "<td><input type='color' class='form-control clr_n'  id=".$rows_niveau['num']." value=".$rows_niveau['clr_n']."></td></tr>";

            }
             ?>
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
       $('document').ready(function(){
        var cur_tit=$(this).attr('title');
        $('.thetitle').html(cur_tit);
    })

    $('.clr_n').change(function(){
        clr_id=this.id;
        clr_nw=$(this).val();
        $.ajax({
            url:"databin.php",
            method:"POST",
            data:{"btn_act":"clrset","clr_id":clr_id,"clr_nw":clr_nw},
            success:function(resp_clr){
                alert(resp_clr)
            }

        })
    })
</script>
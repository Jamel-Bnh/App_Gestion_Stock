<?php require 'myheader.php'; ?>
<?php
if(  $user_role==="UMAS"){
  
}else{
    header('Location:page404.php');
}
?>
<title>Historique</title>


<div class="container">
    <div class="row">

    <table class="table table-striped">
        <thead class="th_info">
            <tr>           
                <th>Matricule</th>
                <th>Utilisateur</th>
                <th>Type</th>
                <th>Action</th>
                <th>Status</th>
                <th>Date</th>
                <th>Niveau</th>
                <th>Adresse IP</th>
            </tr>
        </thead>
        <tbody style="font-size: 13px;">
            <?php
            $scan_log=mysqli_query($link_db,"SELECT * from tblog ORDER BY date_log DESC");
            while($rows_log=mysqli_fetch_array($scan_log)){
                $matricule=$rows_log['matricule'];
                $scan_user = mysqli_query($link_db, "SELECT * from users_stock WHERE matricule='$matricule'");
                $rows_users = mysqli_fetch_array($scan_user);
                $user_name = $rows_users['user_name'];
                $lvl=$rows_log['niveau'];
                $clrlog=mysqli_query($link_db,"SELECT * from log_niveau WHERE level='$lvl'");
                $rows_clrlog=mysqli_fetch_array($clrlog);
                $clr=$rows_clrlog['clr_n'];
                ?>
                <tr>

                    <td><?php echo $rows_log['matricule']; ?></td>
                    <td><?php echo $user_name;?></td>
                    <td><?php echo $rows_log['type_log'];?></td>
                    <td><?php echo $rows_log['action_log'];?></td>
                    <td><?php echo $rows_log['status_log'];?></td>
                    <td><?php echo $rows_log['date_log'];?></td>
                    <td style="background:<?php echo $clr;?> ;"><?php echo $rows_log['niveau'];?></td>
                    <td><?php echo $rows_log['user_ip']; ?></td>
                    
                </tr>

                <?php
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
</script>
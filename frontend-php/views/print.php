<?php
$id_bon=$_GET['id_bon'];
require "link_db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/Navbar-Right-Links-Dark.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>Imprimer</title>
    <style>
      @page { size: 21cm 29.7cm; margin: 2cm }
     
      
    </style>
</head>
<body>
<center><img src="assets/logo/interlogo.png" style="width:290px;"></center>
<center><div style="font-size: 20px;">Direction Pilotage Système Gaz</div></center>
<center><div style="font-size: 18px;margin-bottom:20px">Département Maintenance Système de Pilotage</div></center>
<center><div>BON D'ENTRÉE DE STOCK </div></center>
<center><div><b><?php echo $id_bon;?></b></div></center>
<table class='table table-bordered' style="width: 100%;margin-top:20px;text-align:left;"> 
    <thead > 
        <tr >
            <th>ID Produit</th>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Numéro de serie</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $scan_bon = mysqli_query($link_db, "SELECT * from bon_in WHERE id_bon='$id_bon'");
        $rows_bon=mysqli_fetch_array($scan_bon);
    
        $all_prd=(array)json_decode($rows_bon['all_prd']);
        $all_qnt=(array)json_decode($rows_bon['all_qnt']);
        $all_nmsr=(array)json_decode($rows_bon['all_nmsr']);
        $nb_prd=$rows_bon['nb_prd'];
        $user_in=$rows_bon['user_in'];
    
        $scan_mag=mysqli_query($link_db,"SELECT * from users_stock WHERE matricule='$user_in'");
        $rows_users=mysqli_fetch_array($scan_mag);
        $user_name=$rows_users['user_name'];

        for ($i=1; $i <=$nb_prd; $i++) { 

            $rows_prd=mysqli_fetch_array(mysqli_query($link_db,"SELECT * from nw_produits WHERE id_pr='$all_prd[$i]'"));
            $prd_name=$rows_prd['prd'];

            echo "<tr><td>".$all_prd[$i]."</td><td>".$prd_name."</td><td>".$all_qnt[$i]."</td><td>".$all_nmsr[$i]."</td></tr>";
        }
        ?>
    </tbody>
</table>
<div class='sign_mag' style='position:fixed;bottom:80px;left:80px;'>
<div><b>Magasinier</b></div>
<div><?php echo $user_name;?></div>

</div>
<div class='sign_app' style='position:fixed;bottom:90px;right:80px;'><b>Approbation</b></div>
    
<script src="assets/js/jquery.min.js"></script>
    
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
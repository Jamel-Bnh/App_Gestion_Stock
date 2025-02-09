<?php

session_start();
$id_bon = $_GET['id_bon'];
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
        @page {
            size: 21cm 29.7cm;
            margin: 2cm
        }
    </style>
</head>

<body>
<center><img src="assets/logo/interlogo.png" style="width:290px;"></center>
    <center>
        <div style="font-size: 20px;">Direction Pilotage Système Gaz</div>
    </center>
    <center>
        <div style="font-size: 18px;margin-bottom:20px">Département Maintenance Système de Pilotage</div>
    </center>
    <center>
        <div>BON SORTIE DE STOCK </div>
    </center>
    <center>
        <div><b><?php echo $id_bon; ?></b></div>
    </center>
    <table class='table table-bordered' style="width: 100%;margin-top:20px;text-align:left;">
        <thead>
            <tr>
                <th>ID Produit</th>
                <th>Produit</th>
                <th>Quantité</th>
                <th>N° serie</th>
                <th>Magasin</th>
                <th>Emplacement</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $scan_bon = mysqli_query($link_db, "SELECT * from bon_out WHERE id_out='$id_bon'");
            $rows_bon = mysqli_fetch_array($scan_bon);

            $all_prd = (array)json_decode($rows_bon['prd_out']);
            $all_qnt = (array)json_decode($rows_bon['qnt_out']);
            $all_nmsr = (array)json_decode($rows_bon['nmsr_out']);
            $nb_prd = $rows_bon['nb_out'];
            $user_out = $rows_bon['user_out'];
            $admin_out = $rows_bon['actby'];
            $mag_out = $_SESSION['user_connected'];

            $scan_user = mysqli_query($link_db, "SELECT * from users_stock WHERE matricule='$user_out'");
            $rows_users = mysqli_fetch_array($scan_user);
            $user_name = $rows_users['user_name'];

            $scan_admin = mysqli_query($link_db, "SELECT * from users_stock WHERE matricule='$admin_out'");
            $rows_admin = mysqli_fetch_array($scan_admin);
            $admin_name = $rows_admin['user_name'];

            $scan_mag = mysqli_query($link_db, "SELECT * from users_stock WHERE matricule='$mag_out'");
            $rows_mag = mysqli_fetch_array($scan_mag);
            $mag_name = $rows_mag['user_name'];

            for ($i = 1; $i <= $nb_prd; $i++) {

                $rows_prd = mysqli_fetch_array(mysqli_query($link_db, "SELECT * from nw_produits WHERE id_pr='$all_prd[$i]'"));
                $prd_name = $rows_prd['prd'];
                $prd_mag=$rows_prd['mag'];
                $prd_emp=$rows_prd['emp'];

                echo "<tr><td>" . $all_prd[$i] . "</td><td>" . $prd_name . "</td><td>" . $all_qnt[$i] . "</td><td>" . $all_nmsr[$i] . "</td><td>" . $prd_mag . "</td><td>" . $prd_emp . "</td></tr>";
            }
            ?>
        </tbody>
    </table>


    <table style="width: 100%;text-align:center;position:fixed;bottom:50px;">
        <tr>
            <td>Demandeur</td>
            <td>Magasinier</td>
            <td>Approbation</td>
        </tr>
        <tr>
            <td><?php echo $user_name; ?></td>
            <td><?php echo $mag_name; ?></td>
            <td><?php echo $admin_name; ?></td>

        </tr>
    </table>

    <script src="assets/js/jquery.min.js"></script>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
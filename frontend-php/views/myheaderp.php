<?php
session_start();
if ($_SESSION['user_connected'] == "") {
    header('Location:login.php');
} else {
    $link_db = mysqli_connect('127.0.0.1', 'root', '', 'app_stock');
    $user_connected = $_SESSION['user_connected'];
    $user_info = mysqli_query($link_db, "select * from users_stock WHERE matricule='$user_connected'");
    $rows_info = mysqli_fetch_array($user_info);
    $user_name = $rows_info['user_name'];
    $user_role = $rows_info['role'];
    $user_div = $rows_info['division'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/Navbar-Right-Links-Dark.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-3" style="padding: 0px;height:100vh;background:#0077C0;">
                <div
                    style="width: 100%;text-align: center;font-size: 25px;height: 63px;background: #212529;color: rgb(255,255,255);">
                    <img style="width: 55px;" src="assets/logo/sml_logo.png" />

                    <span style="margin-top: 1px;line-height:63px;"><a href="index.php"
                            style="text-decoration:none;color:#ffffff;"><i
                                class="fas fa-tools"></i>&nbsp;APP_STOCK</span></a>

                </div>
                <div class="all_lk mt-3">

                    <a class="lk_nav d-flex" href="#">
                    <i class="fas fa-check"></i>
                        <div class="">Nouveau Produit</div>
                        
                    </a>
                </div>


            </div>

            <div class="col-md-9" style="padding: 0px;">

                <nav class="navbar navbar-dark navbar-expand-md bg-dark py-3"
                    style="height: 63px;background: rgb(13,110,253);border-color: rgb(13,110,253);">
                    <div class="container"><button data-bs-toggle="collapse" class="navbar-toggler"
                            data-bs-target="#navcol-5"><span class="visually-hidden">Toggle navigation</span><span
                                class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navcol-5">

                            <ul class="navbar-nav ms-auto">

                                <li class="nav-item"><a class="nav-link active" href="#"><i
                                            class="fas fa-info-circle"></i> A propos</a></li>

                                <li class="nav-item"></li>
                                <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="false"
                                        data-bs-toggle="dropdown" href="#"><i
                                            class="fas fa-user"></i>&nbsp;<?php echo $user_name; ?></a>
                                    <div class="dropdown-menu"><a class="dropdown-item" href="profil.php">Mon
                                            compte</a><a class="dropdown-item" href="kill_ses.php">Déconnexion</a></div>
                                </li>
                                <li class="nav-item"><i id="sh_mypanier" class="fas fa-shopping-cart text-warning"></i>
                                    <div class="text-center text-primary"
                                        style="width: 22px;height:22px;background:#ffffff;border-radius:50%;line-height:22px;">
                                        <b>
                                            <?php
                                            echo $nb_art = mysqli_num_rows(mysqli_query($link_db, "SELECT * from fr_panier WHERE pa_user='$user_connected'"));
                                            ?>
                                        </b>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="w-100 d-flex justify-content-center mt-2">
                    <!--  <img src="assets/logo/interlogo.png" style="width:290px ;"> -->
                    <hr>
                </div>
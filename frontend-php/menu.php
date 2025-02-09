<?php require 'myheader.php'; ?>

<title>Demande</title>
<div class="container">
    <div class="row">

    <?php
                            
        $current_user = $_SESSION['matricule']; // Mise à jour de la variable de session
        $scan_user = mysqli_query($link_db, "SELECT division FROM users_stock WHERE matricule =  '$current_user'");
        $rows_users = mysqli_fetch_array($scan_user);
        $user_division = $rows_users['division'];
        
        if ($_SESSION['user_role'] === "UXXX" || $_SESSION['user_role'] === "UMXX" || $_SESSION['user_role'] === "UMAX") {
            echo '<a class="menu_item" href="/' . strtolower($rows_users["division"]) . '?ctg=' . $rows_users["division"] . '"> <!-- Mise à jour du chemin -->
            <i class="fas fa-file-import"></i>
                <div class="etq_item">' . $rows_users["division"] . '</div>
            </a>';
        } else {
            $scan_ctg = mysqli_query($link_db, "SELECT * from nw_ctg");
            while ($rows_ctg = mysqli_fetch_array($scan_ctg)) {
                echo '<a class="menu_item" href="/' . strtolower($rows_ctg["categorie"]) . '?ctg=' . $rows_ctg["categorie"] . '"> <!-- Mise à jour du chemin -->
                <i class="fas fa-file-import"></i>
                    <div class="etq_item">' . $rows_ctg["categorie"] . '</div>
                </a>';
            }
        }
    ?>

    </div>
</div>

<?php require 'js_link.php'; ?>
<script>
    $('document').ready(function() {
        var cur_tit = $(this).attr('title');
        $('.thetitle').html('<i class="fas fa-file-import"></i> ' + cur_tit);
    });
</script>
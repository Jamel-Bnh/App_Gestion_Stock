<?php
session_start();
require "link_db.php";

$btn_act = $_GET['btn_act'];


if ($btn_act === "addpan") {
    $current_user = $_SESSION['user_connected'];
    $id_dem = $_GET['id_dem'];
    $nmsr_dem = $_GET['nmsr_dem'];
    $qnt_dem = $_GET['qnt_dem'];
    $ctg_nw = $_GET['ctg_nw'];

    $check_qnt = mysqli_query($link_db, "SELECT * from nw_quantite WHERE id_pr='$id_dem'");
    $rows_check_qnt = mysqli_fetch_array($check_qnt);
    $qnt_disp = $rows_check_qnt['qnt'];

    if ($nmsr_dem <> "N/A") {
        $check_nmsr = mysqli_query($link_db, "SELECT * from nw_nmsr WHERE nmsr='$nmsr_dem'");
        $rows_check_nmsr = mysqli_fetch_array($check_nmsr);
        $dispo_nmsr = $rows_check_nmsr['dispo'];
    } else {
        $dispo_nmsr = 1;
    }


    if ($qnt_dem > $qnt_disp) {
        echo "Quantité insuffisante";
    } else {

        if ($dispo_nmsr == 0) {
            echo "Numéro de serie non disponible";
        } else {

            // request body
            if ($nmsr_dem === "N/A") {
                $check_panier = mysqli_query($link_db, "SELECT * from nw_panier WHERE id_dem='$id_dem' AND user_in='$current_user'");
                $nb_check = mysqli_num_rows($check_panier);
                if ($nb_check == 0) {
                    $check_pan = true;
                } else {
                    $check_pan = false;
                }
            } else {
                $check_panier = mysqli_query($link_db, "SELECT * from nw_panier WHERE id_dem='$id_dem' AND user_in='$current_user' AND nmsr_dem='$nmsr_dem'");
                $nb_check = mysqli_num_rows($check_panier);
                if ($nb_check == 0) {
                    $check_pan = true;
                } else {
                    $check_pan = false;
                }
            }

            if ($check_pan) {
                $ins_prd = mysqli_query($link_db, "INSERT INTO nw_panier(user_in,id_dem,qnt_dem,nmsr_dem,ctg)VALUES('" . $current_user . "','" . $id_dem . "','" . $qnt_dem . "','" . $nmsr_dem . "','" . $ctg_nw . "')");
                if ($ins_prd) {
                    echo "success";
                } else {
                    echo "failed";
                }
            } else {
                echo "Article Déja Ajoutée";
            }
            // end req body
        }
    }
}

if ($btn_act == "first_pan") {
    $ctg_nw = $_GET['ctg_nw'];
    $tb_panier = "";
    $current_user = $_SESSION['user_connected'];
    $scan_panier = mysqli_query($link_db, "SELECT * from nw_panier WHERE user_in='$current_user' AND ctg='$ctg_nw'");
    while ($rows_panier = mysqli_fetch_array($scan_panier)) {
        $id_pr = $rows_panier['id_dem'];
        $prd = mysqli_fetch_array(mysqli_query($link_db, "SELECT * from nw_produits WHERE id_pr='$id_pr'  "));
        $tb_panier .= "<tr><td>" . $rows_panier['id_dem'] . "</td><td>" . $prd['prd'] . "</td><td>" . $rows_panier['qnt_dem'] . "</td><td>" . $rows_panier['nmsr_dem'] . "</td></tr>";
    }

    echo $tb_panier;
}


if ($btn_act === "vreq") {
    $ctg_req = $_GET['ctg_req']; // 8
    $desc_out = $_GET['desc_out']; //11
    $current_user = $_SESSION['user_connected']; // 3

    $prd_out = array();
    $qnt_out = array();
    $nmsr_out = array();

    $check_panier = mysqli_query($link_db, "SELECT * from nw_panier WHERE user_in='$current_user' AND ctg='$ctg_req' ");
    $nb_check = mysqli_num_rows($check_panier); //7

    if ($nb_check == 0) {
        echo "Panier Vide";
    } else {
        // req body
        $i = 1;

        while ($rows_panier = mysqli_fetch_array($check_panier)) {
            $prd_out[$i] = $rows_panier['id_dem'];
            $qnt_out[$i] = $rows_panier['qnt_dem'];
            $nmsr_out[$i] = $rows_panier['nmsr_dem'];
            $i++;
        }

        $prd_jsn = json_encode($prd_out); // 4
        $qnt_jsn = json_encode($qnt_out); // 5
        $nmsr_jsn = json_encode($nmsr_out); // 6

        $n = 10;
        function getRandomString($n)
        {
            $characters = '0123456789';
            $randomString = '';
            for ($i = 0; $i < $n; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }
            return $randomString;
        }
        $id_bon = "DE" . getRandomString($n); // 2
        $def_sts = "w"; //10
        $date_out = date('Y-m-d'); // 9
        $actby="00000";
        $act_date=$date_out;
        $ins_out = "INSERT INTO bon_out(id_out,user_out,prd_out,qnt_out,nmsr_out,nb_out,ctg_out,date_out,sts_out,desc_out,actby,act_date)VALUES('" . $id_bon . "','" . $current_user . "','" . $prd_jsn . "','" . $qnt_jsn . "','" . $nmsr_jsn . "','" . $nb_check . "','" . $ctg_req . "','" . $date_out . "','" . $def_sts . "','" . $desc_out . "','".$actby."','".$act_date."')";
        $req_ins = mysqli_query($link_db, $ins_out);
        if ($req_ins) {
            $vide_panier = mysqli_query($link_db, "DELETE from nw_panier WHERE user_in='$current_user' AND ctg='$ctg_req'");
            if ($vide_panier) {
                echo "success";
            }
        } else {
            echo "failed";
        }





        // end req
    }
}

if ($btn_act === "bonout") {
    $id_bon = $_GET['id_bon'];

    $scan_bon = mysqli_query($link_db, "SELECT * from bon_out WHERE id_out='$id_bon'");
    $rows_bon = mysqli_fetch_array($scan_bon);
    $prd_out = (array)json_decode($rows_bon['prd_out']);
    $qnt_out = (array)json_decode($rows_bon['qnt_out']);
    $nmsr_out = (array)json_decode($rows_bon['nmsr_out']);
    $nb_out = $rows_bon['nb_out'];
    $tb_out = "";
    $check_bon = true;
    for ($i = 1; $i <= $nb_out; $i++) {
        $current_prd = $prd_out[$i];
        $current_qnt = $qnt_out[$i];
        $current_nmsr = $nmsr_out[$i];
        $scan_prd = mysqli_query($link_db, "SELECT * from nw_produits WHERE id_pr='$current_prd'");
        $rows_prd = mysqli_fetch_array($scan_prd);
        $prd_name = $rows_prd['prd'];
        $scan_disp = mysqli_query($link_db, "SELECT * from nw_quantite WHERE id_pr='$current_prd'");
        $rows_disp = mysqli_fetch_array($scan_disp);
        $prd_qnt = $rows_disp['qnt'];

        if ($current_nmsr === "N/A") {
            if ($current_qnt <= $prd_qnt) {
                $tb_out .= "<tr><td>" . $prd_out[$i] . "</td><td>" . $prd_name . "</td><td>" . $qnt_out[$i] . "</td><td>" . $nmsr_out[$i] . "</td><td style='background:green;color:#ffffff'> DISPONIBLE</td><td>" . $prd_qnt . "</td></tr>";
            } else {
                $check_bon = false;
                $tb_out .= "<tr><td>" . $prd_out[$i] . "</td><td>" . $prd_name . "</td><td>" . $qnt_out[$i] . "</td><td>" . $nmsr_out[$i] . "</td><td style='background:red;'>NON DISPONIBLE</td><td>" . $prd_qnt . "</td></tr>";
            }
        } else {
            $ch_nmsr = mysqli_query($link_db, "SELECT * from nw_nmsr WHERE id_pr='$current_prd' AND nmsr='$current_nmsr'");
            $rows_chnmsr = mysqli_fetch_array($ch_nmsr);
            $disp_nmsr = $rows_chnmsr['dispo'];
            if ($current_qnt <= $prd_qnt && $disp_nmsr) {
                $tb_out .= "<tr><td>" . $prd_out[$i] . "</td><td>" . $prd_name . "</td><td>" . $qnt_out[$i] . "</td><td>" . $nmsr_out[$i] . "</td><td style='background:green;color:#ffffff'> DISPONIBLE</td><td>" . $prd_qnt . "</td></tr>";
            } else {
                $check_bon = false;
                $tb_out .= "<tr><td>" . $prd_out[$i] . "</td><td>" . $prd_name . "</td><td>" . $qnt_out[$i] . "</td><td>" . $nmsr_out[$i] . "</td><td style='background:red;'>NON DISPONIBLE</td><td>" . $prd_qnt . "</td></tr>";
            }
        }
    }

    if ($check_bon) {
        $tb_out .= "<tr><td></td><td></td><td><button class='btn btn-primary acc_req' id='" . $id_bon . "'>VALIDER</button></td><td><button class='btn btn-danger ref_req' id='" . $id_bon . "'>Refuser</button></td><td></td><td></td></tr>";
    } else {
        $tb_out .= "<tr><td></td><td></td><td><button class='btn btn-primary acc_req' id='" . $id_bon . "' DISABLED>VALIDER</button></td><td><button class='btn btn-danger ref_req' id='" . $id_bon . "'>Refuser</button></td><td></td><td></td></tr>";
    }



    echo $tb_out;
}

if ($btn_act === "reqacc") {
    $id_acc = $_GET['id_acc'];
    $scan_bon = mysqli_query($link_db, "SELECT * from bon_out WHERE id_out='$id_acc'");
    $rows_bon = mysqli_fetch_array($scan_bon);
    $prd_out = (array)json_decode($rows_bon['prd_out']);
    $qnt_out = (array)json_decode($rows_bon['qnt_out']);
    $nmsr_out = (array)json_decode($rows_bon['nmsr_out']);
    $nb_out = $rows_bon['nb_out'];
    $reslt=true;
    for ($i=1; $i <= $nb_out ; $i++) { 
        if($nmsr_out[$i]==="N/A"){
            $id_prd=$prd_out[$i];
            $nw_qnt=(int)$qnt_out[$i];
            $up_qnt=mysqli_query($link_db,"UPDATE nw_quantite SET qnt=qnt-'$nw_qnt' WHERE id_pr='$id_prd'");
            if($up_qnt){
                $reslt=true;
            }else{
                $reslt=false;
            }          
        }else{
            $nmsr_prd=$nmsr_out[$i];
            $id_prd=$prd_out[$i];
            $nw_qnt=(int)$qnt_out[$i];
            $up_qnt=mysqli_query($link_db,"UPDATE nw_quantite SET qnt=qnt-'$nw_qnt' WHERE id_pr='$id_prd'");
            $up_nmsr=mysqli_query($link_db,"UPDATE nw_nmsr SET dispo=0 WHERE id_pr='$id_prd' AND nmsr='$nmsr_prd'");
            if($up_qnt){
                $reslt=true;
            }else{
                $reslt=false;
            }     
             

        }
    }

    if($reslt){
        $current_user=$_SESSION['user_connected'];
        $nw_sts="accepted";
        $actdate=date('Y-m-d');
        $up_sts=mysqli_query($link_db,"UPDATE bon_out SET sts_out='$nw_sts',actby='$current_user',act_date='$actdate' WHERE id_out='$id_acc'");
         
        if($up_sts){
            echo "success";
        }else{
            echo "failed";
        }
    }else{
        echo "failed update stock";
    }
    

     
}

if($btn_act==="reqref"){
    $id_ref=$_GET['id_ref'];
    $actdate=date('Y-m-d');
    $current_user=$_SESSION['user_connected'];
    $nw_sts="refused";
        $up_sts=mysqli_query($link_db,"UPDATE bon_out SET sts_out='$nw_sts',actby='$current_user',act_date='$actdate' WHERE id_out='$id_ref'");
        if($up_sts){
            echo "success";
        }else{
            echo "failed";
        }

         

}

if($btn_act==="accptreq"){
    $id_bon = $_GET['id_bon'];

    $scan_bon = mysqli_query($link_db, "SELECT * from bon_out WHERE id_out='$id_bon'");
    $rows_bon = mysqli_fetch_array($scan_bon);
    $prd_out = (array)json_decode($rows_bon['prd_out']);
    $qnt_out = (array)json_decode($rows_bon['qnt_out']);
    $nmsr_out = (array)json_decode($rows_bon['nmsr_out']);
    $nb_out = $rows_bon['nb_out'];
    $tb_out = "";
    $check_bon = true;
    for ($i = 1; $i <= $nb_out; $i++) {
        $current_prd = $prd_out[$i];
        $current_qnt = $qnt_out[$i];
        $current_nmsr = $nmsr_out[$i];
        $scan_prd = mysqli_query($link_db, "SELECT * from nw_produits WHERE id_pr='$current_prd'");
        $rows_prd = mysqli_fetch_array($scan_prd);
        $prd_name = $rows_prd['prd'];
        $scan_disp = mysqli_query($link_db, "SELECT * from nw_quantite WHERE id_pr='$current_prd'");
        $rows_disp = mysqli_fetch_array($scan_disp);
        $prd_qnt = $rows_disp['qnt'];

        if ($current_nmsr === "N/A") {
            if ($current_qnt <= $prd_qnt) {
                $tb_out .= "<tr><td>" . $prd_out[$i] . "</td><td>" . $prd_name . "</td><td>" . $qnt_out[$i] . "</td><td>" . $nmsr_out[$i] . "</td></tr>";
            } else {
                $check_bon = false;
                $tb_out .= "<tr><td>" . $prd_out[$i] . "</td><td>" . $prd_name . "</td><td>" . $qnt_out[$i] . "</td><td>" . $nmsr_out[$i] . "</td></tr>";
            }
        } else {
            $ch_nmsr = mysqli_query($link_db, "SELECT * from nw_nmsr WHERE id_pr='$current_prd' AND nmsr='$current_nmsr'");
            $rows_chnmsr = mysqli_fetch_array($ch_nmsr);
            $disp_nmsr = $rows_chnmsr['dispo'];
            if ($current_qnt <= $prd_qnt && $disp_nmsr) {
                $tb_out .= "<tr><td>" . $prd_out[$i] . "</td><td>" . $prd_name . "</td><td>" . $qnt_out[$i] . "</td><td>" . $nmsr_out[$i] . "</td></tr>";
            } else {
                $check_bon = false;
                $tb_out .= "<tr><td>" . $prd_out[$i] . "</td><td>" . $prd_name . "</td><td>" . $qnt_out[$i] . "</td><td>" . $nmsr_out[$i] . "</td></tr>";
            }
        }
    }

    echo $tb_out;
}

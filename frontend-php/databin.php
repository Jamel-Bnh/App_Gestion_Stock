<?php

session_start();
require "alllog.php";
require "link_db.php";
$btn_act = $_POST['btn_act'];
if ($btn_act === "delctg") {
    $del_id = $_POST['del_id'];
    $del_ctg = mysqli_query($link_db, "DELETE from nw_ctg WHERE id='$del_id'");
    if ($del_ctg) {
        echo "success";
    }
}
if ($btn_act === "delmag") {
    $del_id = $_POST['del_mag'];
    $del_mag = mysqli_query($link_db, "DELETE from nw_magasin WHERE id='$del_id'");
    if ($del_mag) {
        echo "success";
    }
}
if ($btn_act === "delemp") {
    $del_id = $_POST['del_emp'];
    $del_emp = mysqli_query($link_db, "DELETE from nw_location WHERE id='$del_id'");
    if ($del_emp) {
        echo "success";
    }
}
if ($btn_act === "getemp") {
    $mag = $_POST['mag'];

    if ($mag <> "") {
        $emp_list = "<option></option>";
        $scan_mag = mysqli_query($link_db, "SELECT * from nw_location WHERE location_mag='$mag'");
        while ($rows_emp = mysqli_fetch_array($scan_mag)) {
            $emp_list .= "<option>" . $rows_emp['emp'] . "</option>";
        }
        echo $emp_list;
    }
}
if ($btn_act === "getidpr") {
    $prd = $_POST['prd'];
    $scan_produits = mysqli_query($link_db, "SELECT * from nw_produits WHERE prd='$prd'");
    $rows_pr = mysqli_fetch_array($scan_produits);
    $arr = array();
    $arr['id_pr'] = $id_pr = $rows_pr['id_pr'];
    $arr['ctg'] = $ctg = $rows_pr['ctg'];
    $arr['mag'] = $mag = $rows_pr['mag'];
    $arr['emp'] = $emp = $rows_pr['emp'];
    $arr['img_pr'] = $img_pr = $rows_pr['img_pr'];
    $arr['chnsr'] = $chnsr = $rows_pr['chnsr'];
    echo json_encode($arr);
}
if ($btn_act === "add_tb") {
    $id_pr = $_POST['id_pr'];
    $prd_out = $_POST['prd_out'];
    $qnt_pr = $_POST['qnt_pr'];
    $nmsr_pr = $_POST['nmsr_pr'];
    $user_in = $_SESSION['user_connected'];

    $check_nmsr_prd = mysqli_query($link_db, "SELECT * from nw_nmsr WHERE id_pr='$id_pr' AND nmsr='$nmsr_pr' AND dispo=1");

    if (mysqli_num_rows($check_nmsr_prd) > 0) {
        echo "failed0";
    } else {
        $check_pr = mysqli_query($link_db, "SELECT * from tmp_in WHERE id_pr='$id_pr' AND user_in='$user_in' AND nmsr_pr='$nmsr_pr'");
        if (mysqli_num_rows($check_pr) > 0) {
            echo "failed";
        } else {
            $ins_tmp_in = "INSERT INTO tmp_in(id_pr,prd,qnt_pr,nmsr_pr,user_in)VALUES('" . $id_pr . "','" . $prd_out . "','" . $qnt_pr . "','" . $nmsr_pr . "','" . $user_in . "')";
            $req_tmp_in = mysqli_query($link_db, $ins_tmp_in);

            if ($req_tmp_in) {
                $cont_in = "";
                $scan_tmpp = mysqli_query($link_db, "SELECT * from tmp_in WHERE user_in='$user_in'");
                while ($rows_tmp_in = mysqli_fetch_array($scan_tmpp)) {
                    $cont_in .= "<tr><td>" . $rows_tmp_in['id_pr'] . "</td><td>" . $rows_tmp_in['prd'] . "</td><td>" . $rows_tmp_in['qnt_pr'] . "</td><td>" . $rows_tmp_in['nmsr_pr'] . "</td></tr>";
                }
                echo $cont_in;
            }
        }
    }
}

if ($btn_act === "getallitem") {
    $bg_idx = $_POST['frst_idx'];
    $arr_ctlg = array();
    $nb_pr = mysqli_query($link_db, "SELECT * from nw_produits");
    $nb = mysqli_num_rows($nb_pr); // nbr total articles
    $nb_pg = ceil($nb / 6); // nombre pg

    $tb = "";
    $bg_ps = ($bg_idx - 1) * (6 + 1);
    $end_ps = $bg_ps + 6;

    $scan_prd = mysqli_query($link_db, "SELECT * from nw_produits LIMIT $bg_ps,$end_ps");
    while ($rows_prd = mysqli_fetch_array($scan_prd)) {
        $id_cpr = $rows_prd['id_pr'];
        $scan_qnt = mysqli_query($link_db, "SELECT * from nw_quantite WHERE id_pr='$id_cpr'");
        $rows_qnt = mysqli_fetch_array($scan_qnt);

        $tb .= " <tr>";
        $tb .= "<td style='line-height: 33.33px;width:12.5%;'>" . $rows_prd['id_pr'] . "</td>";
        $tb .= "<td style='line-height: 33.33px;width:12.5%;'>" . $rows_prd['prd'] . "</td>";
        $tb .= "<td style='line-height: 33.33px;width:12.5%;'>" . $rows_prd['ctg'] . "</td>";
        $tb .= "<td style='line-height: 33.33px;width:12.5%;'>" . $rows_prd['fbrq'] . "</td>";

        $tb .= " <td style='line-height: 33.33px;width:12.5%;'>" . $rows_prd['mag'] . " " . $rows_prd['emp'] . "</td>";
        // $tb .= " <td style='line-height: 33.33px;width:12.5%;'>" . $rows_prd['qnt_pr'] . "</td>";
        $tb .= "<td style='line-height: 33.33px;width:12.5%;'><img style='width: 100px;height:100px;' src='" . $rows_prd['img_pr'] . "'/></td>";
        $tb .= " <td style='line-height: 33.33px;width:12.5%;' class='text-center'>";
        $tb .= "   <a class='text-dark' style='text-align:center;line-height:100px;font-size:28px;width:12.5%;' href='" . $rows_prd['doc_pr'] . "'><i class='fas fa-download'></i></a>";

        $tb .= "  </td>";
        $tb .= "<td class='text-center'>" . $rows_qnt['qnt'] . "</td>";

        $tb .= "  </tr>";
    }

    $arr_ctlg['nb_pg'] = $nb_pg;
    $arr_ctlg['ctlg'] = $tb;

    echo json_encode($arr_ctlg);
}

if ($btn_act === "getempp") {
    $tb = "";
    $sea_emp = $_POST['sea_emp'];
    $scan_prd = mysqli_query($link_db, "SELECT * from nw_produits WHERE emp='$sea_emp'");
    while ($rows_prd = mysqli_fetch_array($scan_prd)) {
        $id_cpr = $rows_prd['id_pr'];
        $scan_qnt = mysqli_query($link_db, "SELECT * from nw_quantite WHERE id_pr='$id_cpr'");
        $rows_qnt = mysqli_fetch_array($scan_qnt);
        $tb .= " <tr>";
        $tb .= "<td style='line-height: 33.33px;width:12.5%;'>" . $rows_prd['id_pr'] . "</td>";
        $tb .= "<td style='line-height: 33.33px;width:12.5%;'>" . $rows_prd['prd'] . "</td>";
        $tb .= "<td style='line-height: 33.33px;width:12.5%;'>" . $rows_prd['ctg'] . "</td>";
        $tb .= "<td style='line-height: 33.33px;width:12.5%;'>" . $rows_prd['fbrq'] . "</td>";

        $tb .= " <td style='line-height: 33.33px;width:12.5%;'>" . $rows_prd['mag'] . " " . $rows_prd['emp'] . "</td>";
        // $tb .= " <td style='line-height: 33.33px;width:12.5%;'>" . $rows_prd['qnt_pr'] . "</td>";
        $tb .= "<td style='line-height: 33.33px;width:12.5%;'><img style='width: 100px;height:100px;' src='" . $rows_prd['img_pr'] . "'/></td>";
        $tb .= " <td style='line-height: 33.33px;width:12.5%;' class='text-center'>";
        $tb .= "   <a class='text-dark' style='text-align:center;line-height:100px;font-size:28px;width:12.5%;' href='" . $rows_prd['doc_pr'] . "'><i class='fas fa-download'></i></a>";

        $tb .= "  </td>";
        $tb .= "<td class='text-center'>" . $rows_qnt['qnt'] . "</td>";

        $tb .= "  </tr>";
    }
    echo ($tb);
}

if ($btn_act === "getctgpr") {
    $tb = "";
    $cur_ctg = $_POST['cur_ctg'];
    $scan_prd = mysqli_query($link_db, "SELECT * from nw_produits WHERE ctg='$cur_ctg'");
    while ($rows_prd = mysqli_fetch_array($scan_prd)) {
        $id_cpr = $rows_prd['id_pr'];
        $scan_qnt = mysqli_query($link_db, "SELECT * from nw_quantite WHERE id_pr='$id_cpr'");
        $rows_qnt = mysqli_fetch_array($scan_qnt);
        $tb .= " <tr>";
        $tb .= "<td style='line-height: 33.33px;width:12.5%;'>" . $rows_prd['id_pr'] . "</td>";
        $tb .= "<td style='line-height: 33.33px;width:12.5%;'>" . $rows_prd['prd'] . "</td>";
        $tb .= "<td style='line-height: 33.33px;width:12.5%;'>" . $rows_prd['ctg'] . "</td>";
        $tb .= "<td style='line-height: 33.33px;width:12.5%;'>" . $rows_prd['fbrq'] . "</td>";

        $tb .= " <td style='line-height: 33.33px;width:12.5%;'>" . $rows_prd['mag'] . " " . $rows_prd['emp'] . "</td>";
        // $tb .= " <td style='line-height: 33.33px;width:12.5%;'>" . $rows_prd['qnt_pr'] . "</td>";
        $tb .= "<td style='line-height: 33.33px;width:12.5%;'><img style='width: 100px;height:100px;' src='" . $rows_prd['img_pr'] . "'/></td>";
        $tb .= " <td style='line-height: 33.33px;width:12.5%;' class='text-center'>";
        $tb .= "  <a class='text-dark' style='text-align:center;line-height:100px;font-size:28px;width:12.5%;' href='" . $rows_prd['doc_pr'] . "'><i class='fas fa-download'></i></a>";

        $tb .= " </td>";
        $tb .= "<td class='text-center'>" . $rows_qnt['qnt'] . "</td>";

        $tb .= "  </tr>";
    }
    echo ($tb);
}

if ($btn_act === "adddvs") {
    $dvs_name = $_POST['dvs_name'];
    $dvs_admin = $_POST['dvs_admin'];
    $dvs_desc = $_POST['dvs_desc'];

    $ins_dvs = mysqli_query($link_db, "INSERT INTO nw_division(division,admindvs,descdvs)VALUES('" . $dvs_name . "','" . $dvs_admin . "','" . $dvs_desc . "')");
    if ($ins_dvs) {
        echo "success";
    } else {
        echo "Erreur D'insertion";
    }
}

if ($btn_act === "addrle") {
    $rle = $_POST['rle'];
    $desc_rle = $_POST['rle_desc'];
    $ins_rle = mysqli_query($link_db, "INSERT INTO nw_role(role_name,desc_r)VALUES('" . $rle . "','" . $desc_rle . "')");
    if ($ins_rle) {
        echo "success";
    } else {
        echo "Erreur D'insertion";
    }
}

if ($btn_act === "adduser") {
    $matuser = $_POST['matuser'];
    $nameuser = $_POST['nameuser'];
    $user_dvs = $_POST['user_dvs'];
    $user_rle = $_POST['user_rle'];

    $def_mdp = password_hash("12345", PASSWORD_DEFAULT);
    $na = "N/A";

    $ins_user = mysqli_query($link_db, "INSERT INTO users_stock(matricule,user_name,role,division,mdp,user_email,user_phone)VALUES('" . $matuser . "','" . $nameuser . "','" . $user_rle . "','" . $user_dvs . "','" . $def_mdp . "','" . $na . "','" . $na . "')");
    if ($ins_user) {
        echo "success";
    } else {
        echo "failed";
    }
}
if ($btn_act === "valdbon") {
    $all_prd = array();
    $all_qnt = array();
    $all_nmsr = array();
    $current_user = $_SESSION['user_connected'];
    $scan_tmpin = mysqli_query($link_db, "SELECT * from tmp_in WHERE user_in='$current_user'");
    $nb_prd = mysqli_num_rows($scan_tmpin);
    $i = 1;
    $dispo = true;
    while ($rows_prd = mysqli_fetch_array($scan_tmpin)) {
        $id_pr = $rows_prd['id_pr'];
        $qnt_pr = $rows_prd['qnt_pr'];
        $nmsr_pr = $rows_prd['nmsr_pr'];
        $all_prd[$i] = $id_pr;
        $all_qnt[$i] = $qnt_pr;
        $all_nmsr[$i] = $nmsr_pr;
        $i++;

        if ($nmsr_pr === "N/A") {
        } else {
            $check_find_nmsr = mysqli_query($link_db, "SELECT * from nw_nmsr WHERE id_pr='$id_pr' AND nmsr='$nmsr_pr'");
            if (mysqli_num_rows($check_find_nmsr) > 0) {
                $up_dispo = mysqli_query($link_db, "UPDATE nw_nmsr SET dispo=1 WHERE id_pr='$id_pr' AND nmsr='$nmsr_pr'");
            } else {
                $ins_nmsr = "INSERT INTO nw_nmsr(id_pr,nmsr,dispo)VALUES('" . $id_pr . "','" . $nmsr_pr . "','" . $dispo . "')";
                $req_nmsr = mysqli_query($link_db, $ins_nmsr);
            }
        }
    }
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
    $id_bon = "IN" . getRandomString($n);

    $date_bon = date('Y-m-d');
    $json_prd = json_encode($all_prd);
    $json_qnt = json_encode($all_qnt);
    $json_nmsr = json_encode($all_nmsr);

    $ins_bon = "INSERT INTO bon_in(id_bon,user_in,nb_prd,all_prd,all_qnt,all_nmsr,date_bon)VALUES('" . $id_bon . "','" . $current_user . "','" . $nb_prd . "','" . $json_prd . "','" . $json_qnt . "','" . $json_nmsr . "','" . $date_bon . "')";
    $req_bon = mysqli_query($link_db, $ins_bon);
    if ($req_bon) {


        $req_up = true;
        $scan_tmpin = mysqli_query($link_db, "SELECT * from tmp_in WHERE user_in='$current_user'");
        while ($rows_prd = mysqli_fetch_array($scan_tmpin)) {
            $id_pr = $rows_prd['id_pr'];
            $qnt_pr = (int)$rows_prd['qnt_pr'];




            $up_qnt = "UPDATE nw_quantite SET qnt=qnt+'$qnt_pr' WHERE id_pr='$id_pr'";
            $req_upd = mysqli_query($link_db, $up_qnt);
            if ($req_upd) {
            } else {
                $req_up = false;
            }
        }

        if ($req_up) {
            echo "success";
            $vide_tb = mysqli_query($link_db, "DELETE from tmp_in WHERE user_in='$current_user'");
        } else {
            echo "erreur de création de bon ";
        }
    } else {
        echo "erreur de création BON";
    }
}


if ($btn_act === "showbon") {
    $id_bon = $_POST['id_bon'];

    $tb = "";

    $scan_bon = mysqli_query($link_db, "SELECT * from bon_in WHERE id_bon='$id_bon'");
    $rows_bon = mysqli_fetch_array($scan_bon);

    $all_prd = (array)json_decode($rows_bon['all_prd']);
    $all_qnt = (array)json_decode($rows_bon['all_qnt']);
    $all_nmsr = (array)json_decode($rows_bon['all_nmsr']);
    $nb_prd = $rows_bon['nb_prd'];
    $user_in = $rows_bon['user_in'];

    $scan_mag = mysqli_query($link_db, "SELECT * from users_stock WHERE matricule='$user_in'");
    $rows_users = mysqli_fetch_array($scan_mag);
    $user_name = $rows_users['user_name'];

    $tb .= "<div class='bon_info'><div class='id_bon'><b>ID BON : </b>" . $rows_bon['id_bon'] . "</div>";
    $tb .= "<div class='id_bon'><b>Magasinier : </b>" . $user_name . "</div>";
    $tb .= "<div class='id_bon'><b>Date : </b>" . $rows_bon['date_bon'] . "</div></div>";
    $tb .= "<table class='table table-striped'><thead><th>Id Produit</th><th>Produit</th><th>Quantité</th><th>N° Serie</th></thead><tbody>";

    for ($i = 1; $i <= $nb_prd; $i++) {
        $rows_prd = mysqli_fetch_array(mysqli_query($link_db, "SELECT * from nw_produits WHERE id_pr='$all_prd[$i]'"));
        $prd_name = $rows_prd['prd'];
        $tb .= "<tr><td>" . $all_prd[$i] . "</td><td>" . $prd_name . "</td><td>" . $all_qnt[$i] . "</td><td>" . $all_nmsr[$i] . "</td></tr>";
    }
    $tb .= "</tbody></table>";


    echo $tb;
}

if ($btn_act === "showbonout") {
    $id_bon = $_POST['id_bon'];

    $tb = "";

    $scan_bon = mysqli_query($link_db, "SELECT * from bon_out WHERE id_out='$id_bon'");
    $rows_bon = mysqli_fetch_array($scan_bon);

    $all_prd = (array)json_decode($rows_bon['prd_out']);
    $all_qnt = (array)json_decode($rows_bon['qnt_out']);
    $all_nmsr = (array)json_decode($rows_bon['nmsr_out']);
    $nb_prd = $rows_bon['nb_out'];
    $user_out = $rows_bon['user_out'];
    $admin_out = $rows_bon['actby'];

    $scan_user = mysqli_query($link_db, "SELECT * from users_stock WHERE matricule='$user_out'");
    $rows_users = mysqli_fetch_array($scan_user);
    $user_name = $rows_users['user_name'];

    $scan_admin = mysqli_query($link_db, "SELECT * from users_stock WHERE matricule='$admin_out'");
    $rows_admin = mysqli_fetch_array($scan_admin);
    $admin_name = $rows_admin['user_name'];

    $tb .= "<div class='bon_info'><div class='id_bon'><b>ID BON : </b>" . $rows_bon['id_out'] . "</div>";
    $tb .= "<div class='id_bon'><b>Demandeur : </b>" . $user_name . "</div>";
    $tb .= "<div class='id_bon'><b>Date : </b>" . $rows_bon['date_out'] . "</div>";
    $tb .= "<div class='id_bon'><b>Approuvé par  : </b>" . $admin_name . "</div></div>";
    $tb .= "<table class='table table-striped'><thead><th>Id Produit</th><th>Produit</th><th>Quantité</th><th>N° Serie</th></thead><tbody>";

    for ($i = 1; $i <= $nb_prd; $i++) {
        $rows_prd = mysqli_fetch_array(mysqli_query($link_db, "SELECT * from nw_produits WHERE id_pr='$all_prd[$i]'"));
        $prd_name = $rows_prd['prd'];
        $tb .= "<tr><td>" . $all_prd[$i] . "</td><td>" . $prd_name . "</td><td>" . $all_qnt[$i] . "</td><td>" . $all_nmsr[$i] . "</td></tr>";
    }
    $tb .= "</tbody></table>";


    echo $tb;
}


if ($btn_act === "demande") {
    $prd = $_POST['prd'];
    $tb_info = "";
    $scan_prd = mysqli_query($link_db, "SELECT * from nw_produits WHERE prd='$prd'");
    $rows_prd = mysqli_fetch_array($scan_prd);
    $id_pr = $rows_prd['id_pr'];
    $scan_prd_qnt = mysqli_query($link_db, "SELECT * from nw_quantite WHERE id_pr='$id_pr'");
    $rows_prd_qnt = mysqli_fetch_array($scan_prd_qnt);

    $scan_nmsr = mysqli_query($link_db, "SELECT * from nw_nmsr WHERE id_pr='$id_pr' AND dispo=1");



    $tb_info .= "<img style='width:200px;margin-bottom:15px;'src='" . $rows_prd['img_pr'] . "'/>";
    $tb_info .= "<table class='table table-striped' style='width:100%;'>";
    $tb_info .= "<tr><td>Id Produit</td><td><div ><input id='id_prd' value=" . $rows_prd['id_pr'] . " readOnly></div></td></tr>";
    $tb_info .= "<tr><td>Produit</td><td><div class='prd'>" . $rows_prd['prd'] . "</div></td></tr>";
    $tb_info .= "<tr><td>Magasin</td><td><div class='mag'>" . $rows_prd['mag'] . "</div></td></tr>";
    $tb_info .= "<tr><td>Emplacement</td><td><div class='emp'>" . $rows_prd['emp'] . "</div></td></tr>";
    $tb_info .= "<tr><td>Quantité</td><td><div class='qnt_prd'>" . $rows_prd_qnt['qnt'] . "</div></td></tr>";

    $check_nmsr = mysqli_query($link_db, "SELECT * from nw_produits WHERE id_pr='$id_pr'");
    $check_rows = mysqli_fetch_array($check_nmsr);
    $chnsr = $check_rows['chnsr'];
    if ($chnsr === "oui") {
        $tb_info .= "<tr><td>N° serie Disponible</td><td>";
        $tb_info .= "<select class='form-select ' id='nmsr_dem'>";
        while ($rows_nmsr = mysqli_fetch_array($scan_nmsr)) {
            $tb_info .= "<option>" . $rows_nmsr['nmsr'] . "</option>";
        }
        $tb_info .= "</select>";
        $tb_info .= "</td></tr>";
    } else if ($chnsr === "non") {
        $tb_info .= "<tr><td>N° serie Disponible</td><td>";
        $tb_info .= "<select class='form-select ' id='nmsr_dem' readOnly>";

        $tb_info .= "<option>N/A</option>";

        $tb_info .= "</select>";
        $tb_info .= "</td></tr>";
    }

    $tb_info .= "</table>";
    if ($chnsr === "oui") {
        $tb_info .= '<div class="qnt_dem">
    <form method="GET" id="frm_dem" class="d-flex justify-content-evenly align-items-center">
         <span><b>Quantité</b></span>
        <input id="qnt_dem" name="qnt_dem" class="form-control w-25" placeholder="quantité" autocomplete="off" readonly value="1" />
        <button class="btn btn-primary w-25" type="submit" id="btn_add">Ajouter</button>
    </form>
</div>';
    } else if ($chnsr === "non") {
        $tb_info .= '<div class="qnt_dem">
        <form method="GET" id="frm_dem" class="d-flex justify-content-evenly align-items-center">
             <span><b>Quantité</b></span>
            <input type="number" id="qnt_dem" name="qnt_dem" class="form-control w-25" placeholder="quantité" autocomplete="off"  value="1" min="1" required/>
            <button class="btn btn-primary w-25" type="submit" id="btn_add">Ajouter</button>
        </form>
    </div>';
    }



    echo $tb_info;
}

if ($btn_act === "ctgadmin") {
    $ctg_id = $_POST['ctg_id'];
    $ctg_admin = $_POST['ctg_admin'];

    $up_admin = mysqli_query($link_db, "UPDATE nw_ctg SET admin_ctg='$ctg_admin' WHERE categorie='$ctg_id'");
    $scan_users = mysqli_query($link_db, "SELECT * from users_stock WHERE matricule='$ctg_admin'");
    $rows_users = mysqli_fetch_array($scan_users);
    $nw_admin = $rows_users['user_name'];
    if ($up_admin) {
        echo "Responsable " . $ctg_id . " : " . $nw_admin;
    }
}

if ($btn_act === "ctgname") {
    $ctg_id = $_POST['ctg_id'];
    $categorie = $_POST['categorie'];

    // Assurez-vous de la connexion à la base de données ($link_db doit être défini)

    $up_name = mysqli_query($link_db, "UPDATE nw_ctg SET categorie='$categorie' WHERE categorie='$ctg_id'");

    if ($up_name) {
        // La mise à jour a réussi
        echo "Mise à jour réussie.";
    } else {
        // La mise à jour a échoué, affichez un message d'erreur
        echo "Erreur lors de la mise à jour : " . mysqli_error($link_db);
    }
}




if ($btn_act === "editinfo") {
    $nw_mat = $_POST['nw_mat'];
    $nw_name = $_POST['nw_name'];
    $nw_mail = $_POST['nw_mail'];
    $nw_tel = $_POST['nw_tel'];

    $up_user = "UPDATE users_stock SET user_name='$nw_name',user_email='$nw_mail',user_phone='$nw_tel' WHERE matricule='$nw_mat'";
    $req_upuser = mysqli_query($link_db, $up_user);
    if ($req_upuser) {
        echo "success";
    } else {
        echo "failed";
    }
}

if ($btn_act === "editpsw") {
    $old_psw = $_POST['old_psw'];
    $nw_psw = $_POST['nw_psw'];
    $cf_psw = $_POST['cf_psw'];

    $current_user = $_SESSION['user_connected'];

    $scan_users = mysqli_query($link_db, "SELECT * from users_stock WHERE matricule='$current_user'");
    $rows_users = mysqli_fetch_array($scan_users);
    $psw_now = $rows_users['mdp'];

    if (password_verify($old_psw, $psw_now)) {
        if ($nw_psw == $cf_psw) {

            $nw_hash = password_hash($nw_psw, PASSWORD_DEFAULT);

            $up_psw = mysqli_query($link_db, "UPDATE users_stock SET mdp='$nw_hash' WHERE matricule='$current_user'");
            if ($up_psw) {
                one_log($current_user,"LOG76621");
                echo "Mot de passe modifié";

            } else {
                echo "failed";
            }
        } else {
            one_log($current_user,"LOG50305");
            echo "les mots de passe saisis ne sont pas identiques";
            
        }
    } else {
        one_log($current_user,"LOG50305");
        echo "Mot de passe actuel incorrect";
    }


    /*$up_user="UPDATE users_stock SET user_name='$nw_name',user_email='$nw_mail',user_phone='$nw_tel' WHERE matricule='$nw_mat'";
    $req_upuser=mysqli_query($link_db,$up_user);
    if($req_upuser){
        echo "success";
    }else{
        echo "failed";
    }*/
}

if ($btn_act === "gtl") {
    $current_user = $_SESSION['user_connected'];
    $bg_idx = $_POST['idx'];
    $arr_ctlg = array();
    $nb_pr = mysqli_query($link_db, "SELECT * from bon_out WHERE user_out='$current_user'");
    $nb = mysqli_num_rows($nb_pr); // nbr total articles
    $nb_pg = ceil($nb / 6); // nombre pg
    $tb = "";
    $bg_ps = ($bg_idx - 1) * (6 + 1);
    $end_ps = $bg_ps + 6;

    $scan_prd = mysqli_query($link_db, "SELECT * from bon_out WHERE user_out='$current_user'  LIMIT $bg_ps,$end_ps");
    while ($rows_prd = mysqli_fetch_array($scan_prd)) {
        $id_b = $rows_prd['id_out'];
        $tb .= " <tr class='trshow' style='cursor:pointer' id='$id_b'>";
        $tb .= "<td style='line-height: 33.33px;width:12.5%;'>" . $rows_prd['id_out'] . "</td>";
        $tb .= "<td style='line-height: 33.33px;width:12.5%;'>" . $rows_prd['date_out'] . "</td>";
        if ($rows_prd['sts_out'] === "w") {
            $sts_nw = "En attente";
        } else if ($rows_prd['sts_out'] === "accepted") {
            $sts_nw = "Accepté";
        } else if ($rows_prd['sts_out'] === "refused") {
            $sts_nw = "Refusé";
        }

        $tb .= "<td style='line-height: 33.33px;width:12.5%;'>" . $sts_nw . "</td>";

        $user_out = $rows_prd['actby'];
        $cu_user = mysqli_query($link_db, "SELECT * from users_stock WHERE matricule='$user_out'");
        $rows_cuser = mysqli_fetch_array($cu_user);
        $user_n = $rows_cuser['user_name'];

        $tb .= "<td style='line-height: 33.33px;width:12.5%;'>" . $user_n . "</td>";

        $tb .= "  </tr>";
    }

    $arr_ctlg['nb_pg'] = $nb_pg;
    $arr_ctlg['ctlg'] = $tb;

    echo json_encode($arr_ctlg);
}

if ($btn_act === "trshow") {
    $id_bon = $_POST['id_bon'];
    $scan_bon = mysqli_query($link_db, "SELECT * from bon_out WHERE id_out='$id_bon'");
    $tbshow = "";
    $rows_bon = mysqli_fetch_array($scan_bon);

    $all_prd = (array)json_decode($rows_bon['prd_out']);
    $all_qnt = (array)json_decode($rows_bon['qnt_out']);
    $all_nmsr = (array)json_decode($rows_bon['nmsr_out']);

    $nb_out = $rows_bon['nb_out'];

    for ($i = 1; $i <= $nb_out; $i++) {
        $tbshow .= "<tr><td>" . $all_prd[$i] . "</td><td>" . $all_qnt[$i] . "</td></tr>";
    }

    echo $tbshow;
}
if ($btn_act === "clrset") {
    $clr_id = $_POST['clr_id'];
    $clr_nw = $_POST['clr_nw'];
    $up_clr = mysqli_query($link_db, "UPDATE log_niveau SET clr_n='$clr_nw' WHERE num='$clr_id'");
    if ($up_clr) {
        echo "Couleur Modifié ";
    } else {
        echo "failed";
    }
}

if ($btn_act === "addntfc") {


    $n = 5;
    $characters = '0123456789';
    $randomString = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
    $id_log = "LOG" . $randomString;

    $scan_idlog=mysqli_query($link_db,"SELECT * from log_info WHERE log_id='$id_log'");
    if(mysqli_num_rows($scan_idlog)>0){

        echo "failed0";

    }else{

        $tp_log = $_POST['tp_log'];
        $act_log = $_POST['act_log'];
        $sts_log = $_POST['sts_log'];
        $nv_log = $_POST['nv_log'];
    
        $ins_ntfc = mysqli_query($link_db, "INSERT INTO log_info(log_id,lg_type,lg_action,lg_status,lg_niveau)VALUES('" . $id_log . "','" . $tp_log . "','" . $act_log . "','" . $sts_log . "','" . $nv_log . "')");
        if ($ins_ntfc) {
            echo ("success");
        } else {
            echo "failed";
        }
    }


   
}

if ($btn_act === "getntfc") {
    $tb_ntfc = "";

    $scan_ntfc = mysqli_query($link_db, "SELECT * from log_info");
    while ($rows_ntfc = mysqli_fetch_array($scan_ntfc)) {
        $tb_ntfc .= "<tr><td>" . $rows_ntfc['log_id'] . "</td><td>" . $rows_ntfc['lg_type'] . "</td><td>" . $rows_ntfc['lg_action'] . "</td><td>" . $rows_ntfc['lg_status'] . "</td><td>" . $rows_ntfc['lg_niveau'] . "</td></tr>";
    }
    echo $tb_ntfc;
}

if($btn_act==="delrole"){
    $del_role=$_POST['del_role'];

    $del_req1=mysqli_query($link_db,"DELETE  from nw_role WHERE role_name='$del_role'");
    if($del_req1){
        echo "success";
    }else{
        echo "failed";
    }
}




if($btn_act==="deluser"){
    $del_user=$_POST['del_user'];

    $del_req=mysqli_query($link_db,"DELETE  from users_stock WHERE matricule='$del_user'");
    if($del_req){
        echo "success";
    }else{
        echo "failed";
    }
}

if($btn_act==="delprd"){
    $del_prd=$_POST['del_prd'];

    $del_req2=mysqli_query($link_db,"DELETE  from tmp_in WHERE id_pr='$del_prd'");
    if($del_req2){
        echo "success";
    }else{
        echo "failed";
    }
}




if($btn_act==="edtrole"){
    $roles_info=array();
    $edt_role=$_POST['edt_role'];
    $scan_roles=mysqli_query($link_db,"SELECT * from nw_role WHERE role_name='$edt_role'");
    $rows_roles=mysqli_fetch_array($scan_roles);
    $roles_info['role_name']=$rows_roles['role_name'];
    $roles_info['desc_r']=$rows_roles['desc_r'];

    echo json_encode($roles_info);
}

if($btn_act==="edrole"){
    $role_rol=$_POST['role_rol'];
    $role_des=$_POST['role_des'];
    $role_id=$_POST['role_id'];

    $up_role=mysqli_query($link_db,"UPDATE nw_role SET role_name='$role_rol',desc_r='$role_des' WHERE role_name='$role_id'");
    if($up_role){
        echo "success";
    }else{
        echo "failed";
    }

}
if($btn_act==="edtuser"){
    $users_info=array();
    $edt_user=$_POST['edt_user'];
    $scan_users=mysqli_query($link_db,"SELECT * from users_stock WHERE matricule='$edt_user'");
    $rows_users=mysqli_fetch_array($scan_users);
    $users_info['matricule']=$rows_users['matricule'];
    $users_info['user_name']=$rows_users['user_name'];
    $users_info['divison']=$rows_users['division'];
    $users_info['role']=$rows_users['role'];

    echo json_encode($users_info);
}
if($btn_act==="eduser"){
    $user_dv=$_POST['user_dv'];
    $user_rol=$_POST['user_rol'];
    $user_id=$_POST['user_id'];

    $up_user=mysqli_query($link_db,"UPDATE users_stock SET division='$user_dv',role='$user_rol' WHERE matricule='$user_id'");
    if($up_user){
        echo "success";
    }else{
        echo "failed";
    }

}

if($btn_act==="rstuser"){

    $rst_user=$_POST['rst_user'];

    $nw_psw = password_hash("12345", PASSWORD_DEFAULT);

    $up_psw_user=mysqli_query($link_db,"UPDATE users_stock SET mdp='$nw_psw' WHERE matricule='$rst_user'");
    if($up_psw_user){
        echo "success";
    }

}

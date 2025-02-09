<?php
 
function one_log($matricule,$log_id){
    $idlh=$log_id;

    require "link_db.php";

    $scan_logid=mysqli_query($link_db,"SELECT * from log_info WHERE log_id='$log_id'");
    $rows_logid=mysqli_fetch_array($scan_logid);

    function get_ip(){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        
        return $ip;
    }
    $date_log = date('Y-m-d h:i:s');
    $type_log=$rows_logid['lg_type'];
    $action_log=$rows_logid['lg_action'];
    $status_log=$rows_logid['lg_status'];
    $niveau=$rows_logid['lg_niveau'];
    $user_log = $matricule;
    $ip_log=get_ip();    
    $ins_log = mysqli_query($link_db, "INSERT INTO tblog(matricule,id_log,type_log,action_log,status_log,date_log,niveau,user_ip)VALUES('" . $user_log . "','" . $idlh . "','" . $type_log . "','" . $action_log . "','" . $status_log. "','" . $date_log . "','" . $niveau . "','" . $ip_log . "')");

}







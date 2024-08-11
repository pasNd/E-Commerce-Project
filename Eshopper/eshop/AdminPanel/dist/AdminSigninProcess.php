<?php

session_start();
include "connection.php";

if(isset($_POST["avcode"])){

    $v = $_POST["avcode"];

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `verification_code`='".$v."'");
    $admin_num= $admin_rs->num_rows;

    if($admin_num == 1){

        $admin_data = $admin_rs->fetch_assoc();
        $_SESSION["admin"] = $admin_data;
        
        echo("success");

    }else{
        echo ("Invalid verification code");
    }

}else{
    echo ("Please provide your verification code");
}

?>
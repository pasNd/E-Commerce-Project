<?php

include "connection.php";

$email = $_POST["e"];
$vcode = $_POST["v"];
$newPw = $_POST["n"];
$conPw = $_POST["c"];

if(empty($newPw)){
    echo ("Please provide your new password.");
}else if (empty($conPw)){
    echo ("Please re-type your new password.");
}else if($newPw != $conPw){
    echo("Password does not match.Please try again.");
}else {
    
    $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' AND `verification_code` = '".$vcode."'");
    $num = $rs->num_rows;

    if($num == 1){

        Database::iud("UPDATE `user` SET `password` = '".$conPw."' WHERE `email`='".$email."'");
        echo ("success");
    }else {
        echo ("Invalid verification code.Please check the email and try again.");
    }
}

?>
<?php

include "connection.php";

$fname = $_POST["f"];
$lname = $_POST["l"];
$email = $_POST["e"];
$mobile = $_POST["m"];
$password = $_POST["p"];

if(empty($fname)){
    echo ("Please provide your first name.");
}else if(strlen($fname) > 45){
    echo ("Keep the first name under 50 characters.");
}else if(empty($lname)){
    echo ("Please provide your last name.");
}else if(empty($email)){
    echo ("Please provide your email.");
}else if(strlen($email) > 100){
    echo ("Keep the email under 100 characters.");
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo ("The email address entered is invalid.");
}else if(empty($password)){
    echo ("Please provide your password.");
}else if(strlen($password) < 5 || strlen($password) > 20){
    echo ("Keep the password between 5-20 characters.");
}else if(empty($mobile)){
    echo("Please provide your mobile number.");
}else if(strlen($mobile) != 10){
    echo ("The mobile number must contain 10 characters.");
}else if(!preg_match("/07[0,1,2,3,4,5,6,7,8]{1}[0-9]{7}/",$mobile)){
    echo ("The mobile number entered is invalid.");
}else {

    $rs = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."' OR
     `mobile` = '".$mobile."'");
    $n = $rs->num_rows;

    if($n > 0){
        echo ("Email or mobile number already exists. Select a different one");
    }else{

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `user`
        (`fname`,`lname`,`email`,`password`,`mobile`,`joined_date`,`status_satatus_id`) VALUES 
        ('".$fname."','".$lname."','".$email."','".$password."','".$mobile."','".$date."','1')");

        echo("successfully registered.");
    }
}

?>
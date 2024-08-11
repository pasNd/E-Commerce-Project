<?php
session_start();
include "connection.php";

$email = $_POST["e"];
$password = $_POST["p"];
$rememberme = $_POST["r"];

if(empty($email)){
    echo("Please provide your email.");
}else if(empty($password)){
    echo("Please provide your password.");
}else{

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' AND `password`='".$password."' AND `status_satatus_id`='1'");
    $n = $rs->num_rows;
   
    if($n == 1){

        echo("login success");
        $d = $rs->fetch_assoc();
        $_SESSION["user"] = $d;

        if($rememberme == "true"){
            setcookie("email",$email,time()+(60*60*60*24*30));
            setcookie("password",$password,time()+(60*60*60*24*30));

            }else{

            setcookie("email","",-1);
            setcookie("password","",-1); 

            }

    }else {

        echo("We couldn't verify your login information. Please check your email and password");

    }

}
?>
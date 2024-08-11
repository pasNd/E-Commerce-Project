<?php

session_start();

if(isset($_SESSION["user"])){

    $_SESSION["user"] = null;
    session_destroy();

    echo ("success");
    
}else{
    echo("session cannot be destroy.");
}

?>
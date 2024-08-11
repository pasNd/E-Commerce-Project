<?php
session_start();
include "connection.php";

if(isset($_SESSION["user"])){
    if(isset($_GET["id"])){

        $email = $_SESSION["user"]["email"];
        $pid = $_GET["id"];

        $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='".$email."' AND 
        `product_product_id`='".$pid."'");
        $watchlist_num = $watchlist_rs->num_rows;

        if($watchlist_num == 1){

            $watchlist_data = $watchlist_rs->fetch_assoc();
            $list_id = $watchlist_data["w_id"];

            Database::iud("DELETE FROM `watchlist` WHERE `w_id`='".$list_id."'");
            echo ("removed");

        }else{

            Database::iud("INSERT INTO `watchlist`(`user_email`,`product_product_id`) VALUES ('".$email."','".$pid."')");
            echo ("added");
            
        }

    }else{
        echo("Something went wrong.Please try again later");
    }

}else{
    echo ("Please login and try again");
}

?>
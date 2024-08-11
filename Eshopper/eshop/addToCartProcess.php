<?php
session_start();
include "connection.php";

if(isset($_SESSION["user"])){
    if(isset($_GET["id"])){

        $pid = $_GET["id"];
        $user = $_SESSION["user"]["email"];

        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `product_product_id`='".$pid."' AND `user_email`='".$user."'");
        $cart_num = $cart_rs->num_rows;

        $product_rs = Database::search("SELECT * FROM `product` WHERE `product_id`='".$pid."'");
        $product_data = $product_rs->fetch_assoc();

        $product_qty = $product_data["qty"];

        if($cart_num == 1){

            $cart_data = $cart_rs->fetch_assoc();
            $current_qty = $cart_data["qty"];
            $new_qty = (int)$current_qty + 1;

            if($product_qty >= $new_qty){
                Database::iud("UPDATE `cart` SET `qty`='".$new_qty."' WHERE `cart_id`='".$cart_data["cart_id"]."'");
                echo ("Cart updated");
            }else{
                echo ("Invalid Quantity");
            }

        }else{
            Database::iud("INSERT INTO `cart`(`qty`,`product_product_id`,`user_email`) VALUES ('1','".$pid."','".$user."')");
            echo ("This Product is added to the cart.");
        }

    }else{
        echo ("Someting Went Wrong.");
    }
}else{
    echo ("Please Signin or Signup first.");
}


?>
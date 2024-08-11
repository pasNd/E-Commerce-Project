<?php
include "connection.php";

if(isset($_GET["id"])){
    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT * FROM `product` WHERE `product_id`='".$pid."'");
    $product_num = $product_rs->num_rows;

    if($product_num == 1){
        $product_data = $product_rs->fetch_assoc();
            
        if($product_data["status_satatus_id"] == 1){
            Database::iud("UPDATE `product` SET `status_satatus_id`='2' WHERE `product_id`='".$pid."'");
            echo ($product_data["title"]." has been Deactivated.");
        }else if($product_data["status_satatus_id"] == 2){
            Database::iud("UPDATE `product` SET `status_satatus_id`='1' WHERE `product_id`='".$pid."'");
            echo ($product_data["title"]." has been Activated.");
        }
    }else{
        echo ("Cannot find the product. Please try again later.");
    }
}else{
    echo ("Something went wrong.");
}
?>
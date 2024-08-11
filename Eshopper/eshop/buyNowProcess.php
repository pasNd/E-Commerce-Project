<?php
session_start();
include "connection.php";

if(isset($_SESSION["user"])){

    $pid = $_GET["id"];
    $qty = $_GET["qty"];
    $umail = $_SESSION["user"]["email"];

    $array;

    $order_id = uniqid();

    $product_rs = Database::search("SELECT * FROM `product` WHERE `product_id`='".$pid."'");
    $product_data = $product_rs->fetch_assoc();

    $city_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='".$umail."'");
    $city_num = $city_rs->num_rows;

    if($city_num == 1){

        $city_data = $city_rs->fetch_assoc();

        $city_name = $city_data["city"];
        $address = $city_data["line1"].", ".$city_data["line2"];

        $delivery = "0";
        $delivery = $product_data["dilivery_fee"];

        $item = $product_data["title"];
        $amount = ((int)$product_data["price"] * (int)$qty) + (int)$delivery;

        $fname = $_SESSION["user"]["fname"];
        $lname = $_SESSION["user"]["lname"];
        $mobile = $_SESSION["user"]["mobile"];
        $uaddress = $address;
        $city = $city_name;

        $merchant_id = "1225670";
        $merchant_secret = "NDE5MjY5NTk1MjEzMDIwOTc2MDMyNzk1MDA2OTAyMzAzODA4NTQ4OQ==";
        $currency = "LKR";

        $hash = strtoupper(
            md5(
                $merchant_id . 
                $order_id . 
                number_format($amount, 2, '.', '') . 
                $currency .  
                strtoupper(md5($merchant_secret)) 
            ) 
        );

        $array["id"] = $order_id;
        $array["item"] = $item;
        $array["amount"] = $amount;
        $array["fname"] = $fname;
        $array["lname"] = $lname;
        $array["mobile"] = $mobile;
        $array["address"] = $uaddress;
        $array["city"] = $city;
        $array["umail"] = $umail;
        $array["mid"] = $merchant_id;
        $array["msecret"] = $merchant_secret;
        $array["currency"] = $currency;
        $array["hash"] = $hash;

        echo json_encode($array);

    }else{
         echo ("2"); //address error
    }

}else{
    echo ("1");
}

?>
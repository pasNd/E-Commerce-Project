<?php

session_start();
include "connection.php";

$category = $_POST["ca"];
$brand = $_POST["b"];
$clr = $_POST["col"];
$model = $_POST["m"];
$qty = $_POST["q"];

$title = $_POST["t"];
$cost = $_POST["co"];
$dcost = $_POST["dcost"];
$des = $_POST["de"];

if (empty($category)) {
    echo ("Please select product category.");
} else if (empty($brand)) {
    echo ("Please select product brand.");
} else if (empty($clr)) {
    echo ("Please select product colour.");
} else if (empty($model)) {
    echo ("Please provide product model.");
} else if (empty($qty)) {
    echo ("Please provide product quantity.");
} else if (strlen($qty) < 1) {
    echo ("Product quantity should be one or more");
} else if (empty($title)) {
    echo ("Please provide product title.");
} else if (empty($cost)) {
    echo ("Please provide product price.");
} else if (!filter_var($dcost, FILTER_VALIDATE_INT)) {
    echo ("Invalid price.");
} else if (empty($dcost)) {
    echo ("Please provide product dilivery price.");
} else if (empty($des)) {
    echo ("Please provide product description.");
} else if (strlen($des) < 50) {
    echo ("Product description should be more than 50 characters.");
} else {

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $status = 1;

    if (!empty($brand)) {
        Database::iud("INSERT INTO `model` (`model_name`,`brand_brand_id`) VALUES ('" . $model . "','" . $brand . "');");
    } else {
        echo ("Please provide product brand");
    }

    $modelid_rs = Database::search("SELECT * FROM `model` WHERE `model_name` = '".$model."' ORDER BY `model_id` DESC ");
    $modelid_data = $modelid_rs->fetch_assoc();
    $modelid = $modelid_data["model_id"];

    Database::iud("INSERT INTO `product`(`title`,`price`,`qty`,`description`,`dilivery_fee`,`datetime_added`,
    `category_cat_id`,`status_satatus_id`,`brand_brand_id`,`model_model_id`) VALUES ('" . $title . "','" . $cost . "','" . $qty . "','" . $des . "','" . $dcost . "','" . $date . "',
    '" . $category . "','" . $status . "','" . $brand . "','".$modelid."')");

    $pro_rs = Database::search("SELECT * FROM `product` ORDER BY `product_id` DESC LIMIT 1");
    $pro_data = $pro_rs->fetch_assoc();

    $pro_id = $pro_data["product_id"];

    
    if (!empty($clr)) {
        Database::iud("INSERT INTO `product_has_color` (`product_product_id`,`color_clr_id`) VALUES ('" . $pro_id . "','" . $clr . "')");
    } else {
        echo ("Please provide product colour");
    }


    $product_id = Database::$connection->insert_id;

    $length = sizeof($_FILES);

    if ($length <= 3 && $length > 0) {

        $allowed_image_extensions = array("image/jpeg", "image/png", "image/svg+xml", "image/webp");

        for ($x = 0; $x < $length; $x++) {
            if (isset($_FILES["image".$x])) {

                $image_file = $_FILES["image" . $x];
                $file_extension = $image_file["type"];

                if (in_array($file_extension, $allowed_image_extensions)) {

                    $new_img_extension;

                    if ($file_extension == "image/jpeg") {
                        $new_img_extension = ".jpeg";
                    } else if ($file_extension == "image/png") {
                        $new_img_extension = ".png";
                    } else if ($file_extension == "image/svg+xml") {
                        $new_img_extension = ".svg";
                    } else if ($file_extension == "image/webp") {
                        $new_img_extension = ".webp";
                    }

                    $file_name = "resources//products//".$title."_".$x."_".uniqid().$new_img_extension; //file path
                    move_uploaded_file($image_file["tmp_name"], $file_name);

                    $name = "AdminPanel//dist//";
                    $img_path = $name . $file_name;

                    Database::iud("INSERT INTO `product_img` (`img_path`, `product_product_id`)
                    VALUES ('".$img_path."','".$product_id."')");
                } else {
                    echo ("Inavid image type.");
                }
            }
        }

        echo ("success");
    } else {
        echo ("Invalid Image Count.");
    }
}

<?php

session_start();
include "connection.php";

$email = $_SESSION["user"]["email"];

$fname = $_POST["f"];
$lname = $_POST["l"];
$mobile = $_POST["m"];
$line1 = $_POST["l1"];
$line2 = $_POST["l2"];
$provine = $_POST["p"];
$district = $_POST["d"];
$city = $_POST["c"];
$pcode = $_POST["pc"];

$user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'");

if ($user_rs->num_rows == 1) {

    Database::iud("UPDATE `user` SET `fname`='" . $fname . "',`lname`='" . $lname . "',`mobile`='" . $mobile . "',`fname`='" . $fname . "' 
    WHERE `email`='" . $email . "'");

    $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $email . "'");

    if ($address_rs->num_rows == 1) {

        Database::iud("UPDATE `user_has_address` SET `district_district_id`='" . $district . "',`postal_code`='" . $pcode . "',
        `line1`='" . $line1 . "',`line2`='" . $line2 . "',`city`='" . $city . "'");
    } else {
        Database::iud("INSERT INTO `user_has_address`(`district_district_id`,`user_email`,`postal_code`,`line1`,`line2`,`city`) VALUES
        ('" . $district . "','" . $email . "','" . $pcode . "','" . $line1 . "','" . $line2 . "','" . $city . "')");
    }

    if (sizeof($_FILES) == 1) {
        $image = $_FILES["i"];
        $image_extension = $image["type"];

        $allowed_image_extensions = array("image/jpeg", "image/png", "image/svg+xml");

        if (in_array($image_extension, $allowed_image_extensions)) {
            $new_img_extension;

            if ($image_extension == "image/jpeg") {
                $new_img_extension = ".jpeg";
            } else if ($image_extension == "image/png") {
                $new_img_extension = ".png";
            } else if ($image_extension == "image/svg+xml") {
                $new_img_extension = ".svg";
            }

            $file_name = "AdminPanel//dist//resources//profile_images//" . $fname . "_" . uniqid() . $new_img_extension;
            move_uploaded_file($image["tmp_name"], $file_name);

            $profile_img_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $email . "'");

            if ($profile_img_rs->num_rows == 1) {

                Database::iud("UPDATE `profile_img` SET `img_path`='" . $file_name . "' WHERE `user_email`='" . $email . "'");
                echo ("updated");
            } else {

                Database::iud("INSERT INTO `profile_img`(`img_path`,`user_email`) VALUES ('" . $file_name . "','" . $email . "')");
                echo ("saved");
            }
        }
    } else if (sizeof($_FILES) == 0) {

        echo ("Please provide a image to update your profile picture.");
    } else {
        echo ("You can select only one profile image at once.");
    }
} else {
    echo ("Invalid user.");
}

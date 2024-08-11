<?php
session_start();
include "connection.php";

$ncategory = $_POST["nca"];
$nbrand = $_POST["nb"];
$nclr = $_POST["ncol"];
$success = false; // Flag to track successful addition

if (!empty($ncategory) || !empty($nbrand) || !empty($nclr)) {

    if (!empty($ncategory)) {
        $cat_rs = Database::search("SELECT * FROM `category` WHERE LOWER(`cat_name`) = '" . $ncategory . "'");
        if ($cat_rs->num_rows == 0) {
            Database::iud("INSERT INTO `category`(`cat_name`) VALUES ('" . $ncategory . "')");
            $success = true;
        } else {
            echo ("Category already exist.");
        }
    }

    if (!empty($nbrand)) {
        $brand_rs = Database::search("SELECT * FROM `brand` WHERE LOWER(`brand_name`) = '" . $nbrand . "'");
        if ($brand_rs->num_rows == 0) {
            Database::iud("INSERT INTO `brand`(`brand_name`) VALUES ('" . $nbrand . "')");
            $success = true;
        } else {
            echo ("Brand already exist.");
        }
    }

    if (!empty($nclr)) {
        $clr_rs = Database::search("SELECT * FROM `color` WHERE LOWER(`name`) = '" . $nclr . "'");
        if ($clr_rs->num_rows == 0) {
            Database::iud("INSERT INTO `color`(`name`) VALUES ('" . $nclr . "')");
            $success = true;
        } else {
            echo ("Colour already exist.");
        }
    }

    if ($success) {
        echo "Saved";

    } else {
    }
} else {
    echo ("Please provide Category, Brand, or Color.");
}

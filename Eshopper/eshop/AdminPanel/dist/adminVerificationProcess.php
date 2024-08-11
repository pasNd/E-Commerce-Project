<?php

include "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST["ae"])) {

    $email = $_POST["ae"];

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email` = '" . $email . "'");
    $admin_num = $admin_rs->num_rows;

    if ($admin_num > 0) {

        $code = uniqid();

        Database::iud("UPDATE `admin` SET `verification_code`='" . $code . "' WHERE `email` = '" . $email . "'");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'lakshanpasi143@gmail.com';
        $mail->Password = 'ydmy qvja wqlv opqt';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('lakshanpasi143@gmail.com', 'Reset Password');
        $mail->addReplyTo('lakshanpasi143@gmail.com', 'Reset Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'TechTrove admin login verification code';
        $bodyContent = '<h2 style="color:red;">Your Admin Verification Code is ' . $code . '</h2>';
        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo 'Verification code sending failed!';
        } else {
            echo 'Success';
        }
    } else {
        echo ("You are not a valid user.");
    }
    
} else {
    echo ("Please provide your email address.");
}

<?php

include "connection.php";

include "SMTP.php";
include "PHPMailer.php";
include "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_GET["e"])){

    $email = $_GET["e"];

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."'");
    $n = $rs->num_rows;

    if($n == 1){

        $code = uniqid();
        Database::iud("UPDATE `user` SET `verification_code`='".$code."' WHERE `email`='".$email."'");

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
        $mail->Subject = 'TechTrove Forgot password Verification Code';
        $bodyContent = '<h2> Your Verification Code is </h2></br>
        <span style = "color:#ff4157;font-size:33px;">'.$code.'</span>';
        $mail->Body    = $bodyContent;

        if(!$mail->send()){
            echo 'Verification code sending failed.';
        }else{
            echo 'success';
        }

    }else{
        echo ("We couldn't verify your email. Please check your email again");
    }
    
}else{
    echo ("Please provide your email first.");
}

?>
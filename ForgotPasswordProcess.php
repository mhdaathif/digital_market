<?php

require "connection.php";

require "Exception.php";
require "PHPMailer.php";
require "SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_GET["email"])){

    $email = $_GET["email"];

    if(empty($email)){

        echo "Please enter an valid Email";

    } else {

        $rs = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."' ");
        if($rs->num_rows == 1){

            $cord = mt_rand(100000, 999999);
            Database::iud("UPDATE `user` SET `verification_code` = '".$cord."' WHERE `email` = '".$email."' ");

             // email code
             $mail = new PHPMailer;
             $mail->IsSMTP();
             $mail->Host = 'smtp.gmail.com';
             $mail->SMTPAuth = true;
             $mail->Username = 'aatzan30@gmail.com';
             $mail->Password = 'eaefbqpqnyjitvfm';
             $mail->SMTPSecure = 'ssl';
             $mail->Port = 465;
             $mail->setFrom('aatzan30@gmail.com', 'Smart');
             $mail->addReplyTo('aatzan30@gmail.com', 'Smart');
             $mail->addAddress($email);
             $mail->isHTML(true);
             $mail->Subject = 'Smart Forgot Password Verification Code.';
             $bodyContent = '<h1 style= "color : red;"> Your Verification code is : '.$cord.'</h1> ';
             $mail->Body    = $bodyContent;

             if(!$mail->send()){
                 echo "Verification code sending failed";
             }else{
                 echo "Success";
             }


        }else{
            echo "Email Address not found";
        }

    }

}else{
    echo "Please enter your Email Address";
}


?>
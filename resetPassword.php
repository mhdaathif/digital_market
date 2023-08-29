<?php

    require "connection.php";

    $email = $_POST["email"];
    $newPassword = $_POST["newPassword"];
    $repeatNewPassword = $_POST["repeatNewPassword"];
    $verificationCode = $_POST["verificationCode"];

    if(empty($email)){
        echo "Missing Email Address";
    }else if(empty($newPassword)){
        echo "Please enter your new password";
    }else if(strlen($newPassword) < 5 || strlen($newPassword) >= 25){
        echo "Password Length should be btween 5 ot 25";
    }else if(empty($repeatNewPassword)){
        echo "Please re-enter your new password";
    }else if($newPassword != $repeatNewPassword){
        echo "Password & Re-type password does not match.";
    }else if(empty($verificationCode)){
        echo "Please enter your verification code";
    }else{
        // echo "success";

        $rs = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."' AND `verification_code` = '".$verificationCode."' ");

        if($rs->num_rows == 1){

            Database::iud("UPDATE `user` SET `password` = '".$newPassword."' WHERE `email` = '".$email."' ");
            echo "success";

        } else {
            echo "Password reset failed";
        }

    }

    // echo $email;
    // echo "<br/>";
    // echo $newPassword;
    // echo "<br/>";
    // echo $repeatNewPassword;
    // echo "<br/>";
    // echo $verificationCode;

?>
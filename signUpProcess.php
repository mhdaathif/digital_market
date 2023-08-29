<?php

    require "connection.php";

    $username = $_POST["username"];
    $mobile = $_POST["mobile"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $gender = $_POST["gender"];

    if(empty($username)){
        echo "Please Enter Your Username";
    }else if(strlen($username) > 50){
        echo "Username must be less than 50 characters.";
    }else if(empty($mobile)){
        echo "Please Enter Your Mobile";
    }else if(strlen($mobile) < 10 || strlen($mobile) > 12) {
        echo "Mobile Length Should be between 10 to 12.";
    }else if(!preg_match("/[0|94|+94][7][0|1|2|4|5|6|7|8][0-9]{7}$/",$mobile)){
        echo "Invalid Mobile";
    }else if(empty($email)){
        echo "Please Enter Your Email";
    }else if(strlen($email) >= 100){
        echo "Email must be less than 100 characters.";
    }else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        echo "Invalid Email Address";
    }else if(empty($password)){
        echo "Please Enter Your Password";
    }else if(strlen($password) < 5 || strlen($password) > 25){
        echo "Password Length Should be between 5 to 25.";
    }else{
        
        $r = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."' AND `mobile` = '".$mobile."' ");
        $n = $r->num_rows;

        if($n > 0){
            echo "User with the same Email address or Phone Number already exists.";
        }else{

            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format("Y-m-d H:i:s");

            Database::iud("INSERT INTO `user` (`email`, `username`, `mobile`, `password`, `gender`, `register_date`) 
            VALUES ('".$email."', '".$username."', '".$mobile."', '".$password."', '".$gender."', '".$date."') ");

            echo "success";

        }

    }

    // echo $username;
    // echo $mobile;
    // echo $email;
    // echo $password;
    // echo $gender;

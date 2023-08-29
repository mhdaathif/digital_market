<?php

session_start();
require "connection.php";

$email = $_POST["email"];
$password = $_POST["password"];

    if(empty($email)) {
    echo "Please Enter Your Email Adderss";
} else if(empty($password)){
    echo "Please Enter Your Password";
}else{
    // echo "ok";
    $resultset = Database::search("SELECT * FROM `admin` WHERE `email` = '".$email."' AND `password` = '".$password."' ");
    $count = $resultset->num_rows;

    if($count == 1){  
        $data = $resultset->fetch_assoc();
        $_SESSION["admin"] = $data;

        echo "OK";

    }else{
        echo "Invalid Email or Password";
    }

}

?>
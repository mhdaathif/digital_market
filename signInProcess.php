<?php

    session_start();

    require "connection.php";

    $email = $_POST["email"];
    $password = $_POST["password"];
    $remberMe = $_POST["remberMe"];

    if(empty($email)) {
    echo "Please Enter Your Email Adderss";
    } else if(empty($password)){
        echo "Please Enter Your Password";
    }else{

        $resultset = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."' AND `password` = '".$password."' ");
        $count = $resultset->num_rows;

        if($count == 1){
            echo "OK";

            $data = $resultset->fetch_assoc();
            
            $_SESSION["username"] = $data;

            if($remberMe == "true"){

                setcookie("email", $email, time()+(60*60*24*30*3));
                setcookie("password", $password, time()+(60*60*24*30*3));

            }else {

                setcookie("email", "", -1);
                setcookie("password", "", -1);

            }

        }else{
            echo "Invalid Email or Password";
        }
        
    }
    

    // echo $email;
    // echo "<br/>";
    // echo $password;

?>
<?php

// echo "Hello";

require "connection.php";

session_start();

if (isset($_SESSION["username"])) {

    $Uname = $_POST["u"];
    $mobile = $_POST["m"];
    $addline1 = $_POST["a1"];
    $addline2 = $_POST["a2"];
    $city = $_POST["c"]; 

    if (isset($_FILES["i"])) {
        $img = $_FILES["i"];
    }

    if (isset($img)) {

        $allowedImageExtention = array("image/jpg", "image/jpeg", "image/png", "image/svg");
        $fileex = $img["type"];
        echo $fileex;

        if (!in_array($fileex, $allowedImageExtention)) {
            echo "Please select a valied image.";
        } else {

            $newimageextention;
            if ($fileex == "image/jpg") {
                $newimageextention = ".jpg";
            } else if ($fileex == "image/jpeg") {
                $newimageextention = ".jpeg";
            } else if ($fileex == "image/png") {
                $newimageextention = ".png";
            } else if ($fileex == "image/svg") {
                $newimageextention = ".svg";
            }

            $fileName = "images//profile//" . uniqid() . $newimageextention;

            move_uploaded_file($img["tmp_name"], $fileName);

            $profile = Database::search("SELECT * FROM `profile_img` WHERE `user_email` = '" . $_SESSION["username"]["email"] . "' ");
            $profilers = $profile->num_rows;

            if ($profilers == 1) {

                Database::iud("UPDATE `profile_img` SET `code` = '" . $fileName . "' WHERE `user_email` = '" . $_SESSION["username"]["email"] . "' ");
                echo "Profile Image Updated Successfully.";
            } else {

                Database::iud("INSERT INTO `profile_img` (code, user_email) VALUE ('" . $fileName . "', '" . $_SESSION["username"]["email"] . "') ");
                echo "New Profile imaged saved successfully";
            }
        }
    } else {

        Database::iud("UPDATE `user` SET `username` = '" . $Uname . "', `mobile` = '" . $mobile . "' WHERE `email` = '" . $_SESSION["username"]["email"] . "' ");
        echo "User has been Updated";

        $address = Database::search("SELECT * FROM user_has_adderss WHERE user_email = '" . $_SESSION["username"]["email"] . "' ");
        $addressrs = $address->num_rows;

        if ($addressrs == 1) {

            Database::iud("UPDATE `user_has_adderss` SET `line_1` = '".$addline1."', `line_2` = '".$addline2."', `city_id` = '".$city."' WHERE `user_email` = '".$_SESSION["username"]["email"]."' ");
            echo "Address Updated Successfully.";

        } else {

            Database::iud("INSERT INTO user_has_adderss (user_email, line_1, line_2, city_id) VALUES ('".$_SESSION["username"]["email"]."', '".$addline1."', '".$addline2."', '".$city."') ");
            echo "New Address Updated Successfully.";
            
        }
    }
} else {
    echo "Error";
}

?>
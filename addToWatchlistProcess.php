<?php

session_start();

require "connection.php";

if(isset($_SESSION["username"])){

    $id = $_GET["id"];
    $usermail = $_SESSION["username"]["email"];

    $watchlistrs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='".$id."'
    AND `user_email`='".$usermail."'");

    if($watchlistrs->num_rows == 1){
        
        Database::iud("DELETE FROM `watchlist` WHERE `product_id`='".$id."' AND `user_email`='".$usermail."'");
        echo "success2";

    }else{
        Database::iud("INSERT INTO `watchlist` (`product_id`,`user_email`) VALUES('".$id."','".$usermail."')");
        echo "Success";
    }

}else{
    echo "You have to Sign In first.";
}




?>
<?php

session_start();
require "connection.php";

if(isset($_SESSION["username"])){

    $useremail = $_SESSION["username"]["email"];
    $productid = $_GET["id"];

    $cartProducts = Database::search("SELECT * FROM `cart` WHERE `user_email`='".$useremail."' AND `product_id`='".$productid."' ");
    $cartProducNum = $cartProducts->num_rows;

    $productqtyrs = Database::search("SELECT `qty` FROM `product` WHERE `id`='".$productid."' ");
    $qtyrows = $productqtyrs->fetch_assoc();

    $prodQty = $qtyrows["qty"];

    if($cartProducNum == 1){
        $cartRows = $cartProducts->fetch_assoc();
        $currentqty = $cartRows["qty"];
        $newqty = (int)$currentqty +1;

        if($prodQty>=$newqty){

            Database::iud("UPDATE `cart` SET `qty`='".$newqty."' WHERE `user_email`='".$useremail."' AND `product_id`='".$productid."' ");
            echo "Product quantity Updated.";

        }else{
            echo "Invalid product quantity.";
            // you reached maximum quantity
        }
    }else{

        Database::iud("INSERT INTO `cart`(`product_id`,`user_email`,`qty`) VALUES ('".$productid."','".$useremail."','1') ");
        echo "New product has been added to your cart.";
    }
    
}else{
    echo "Please sign in first.";
}

$pid = $_GET["id"];



?>
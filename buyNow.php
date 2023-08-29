<?php

require "connection.php";
session_start();

$id = $_GET["id"];
$qty = $_GET["qty"];


if (isset($_SESSION["username"])) {
    $buy = Database::search("SELECT * FROM `product` WHERE `id` = '" . $id . "' ");
    $buyNum = $buy->num_rows;

    if($buyNum == 1){

        $d = $buy->fetch_assoc();
        $pname = $d["title"];
        $ppprice = $d["price"];
        $pdel = $d["delivery_fee_other"];

        $pprice = $ppprice * $qty;

        $price = $pprice  + $pdel;

        $user = $_SESSION["username"];
        $username = $user["username"];
        $mobile = $user["mobile"];
        $email = $user["email"];


        $j = '{"pn":"'.$pname.'", "pp":"'.$price.'", "un":"'.$username.'", "um": "'.$mobile.'", "ue": "'.$email.'"}';

        echo $j;

    }else{
        echo "2";
    }

}else{
    echo "3";
}

?>
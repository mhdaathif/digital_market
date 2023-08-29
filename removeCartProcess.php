<?php

require "connection.php";

$productid = $_GET["id"];


$cartrs = Database::search("SELECT * FROM `cart` WHERE `id`='".$productid."' ");
$cart = $cartrs->fetch_assoc();

$id = $cart["product_id"];
$user_mail = $cart["user_email"];

Database::iud("INSERT INTO recent (`product_id`,`user_email`) VALUES('".$id."','".$user_mail."')");

Database::iud("DELETE FROM `cart` WHERE `id`='".$productid."' ");

echo "success";

?>
<?php

session_start();
require "connection.php";

$pid = $_GET["id"];
$qty = $_GET["qty"];

$usermail = $_SESSION["username"]["email"];


$order_id = mt_rand(100000, 999999);

$p_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "' ");
$p_data = $p_rs->fetch_assoc();

$unit_price = $p_data["price"];
$total = $unit_price * $qty;

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

Database::iud("INSERT INTO `invoice` (`order_id`,`product_id`,`user_email`,`date`,`total`,`qty`)
VALUES('" . $order_id . "','" . $pid . "','" . $usermail . "','" . $date . "','" . $total . "','" . $qty . "')");

Database::iud("UPDATE `product` SET `qty`='" . $p_data["qty"] - $qty . "' WHERE `id`='" . $pid . "' ");

echo $order_id;


?>
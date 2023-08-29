<?php

require "connection.php";

$email = $_POST["e"];
$feedback = $_POST["f"];
$pid = $_POST["i"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

Database::iud("INSERT INTO `feedback` (`user_email`,`product_id`,`feed`,`date`) 
VALUES('".$email."','".$pid."','".$feedback."','".$date."')");

echo "success";

?>
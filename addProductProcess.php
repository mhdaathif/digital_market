<?php

// echo "Hello";

session_start();

require "connection.php";

$category = $_POST["ca"];
$brand = $_POST["br"];
$model = $_POST["mo"];
$title = $_POST["ti"];
$condition = $_POST["con"];
$color = $_POST["col"];
$qty = $_POST["qty"];

if (isset($_FILES["img"])) {
    $imagefile = $_FILES["img"];
}

$price = $_POST["pri"];
$dwc = $_POST["dwc"];
$doc = $_POST["doc"];
$description = $_POST["desc"];

$da = new DateTime();
$timeZone = new DateTimeZone("Asia/Colombo");
$da->setTimezone($timeZone);
$date = $da->format("Y-m-d H:i:s");

$status = 1;
$usermail = $_SESSION["username"]["email"];

if ($category == "0") {
    echo "Please select a cetegory";
} else if ($brand == "0") {
    echo "Please select a brand";
} else if ($model == "0") {
    echo "Please select a model";
} else if (empty($title)) {
    echo "Please Add a title to your Product";
} else if (strlen($title) > 100) {
    echo "Please enter a title contains 100 characters or lower.";
} else if (empty($qty)) {
    echo "Quantity field must not be empty.";
} else if ($qty == "0" || $qty == "e" || $qty < 0) {
    echo "Please enter a valid quantity.";
} else if (empty($price)) {
    echo "Please enter a price to your product.";
} else if (is_int($price)) {
    echo "Please enter a valid price to your product.";
} else if (empty($dwc)) {
    echo "Please enter the delivery cost inside colombo.";
} else if (is_int($dwc)) {
    echo "Please enter a valid price for delivery inside colombo.";
} else if (empty($doc)) {
    echo "Please enter the delivery cost outside colombo.";
} else if (is_int($doc)) {
    echo "Please enter a valid price for delivery outside colombo.";
} else if (empty($description)) {
    echo "Please enter a description to your product.";
} else {
    $model_has_brand = Database::search("SELECT `id` FROM `model_has_brand` WHERE `brand_id` = '" . $brand . "' AND `model_id` = '" . $model . "' ");

    if ($model_has_brand->num_rows == 0) {
        echo "This Product does Not exists.";
    } else {

        $mhb = $model_has_brand->fetch_assoc();
        $model_has_brand = $mhb["id"];

        Database::iud("INSERT INTO product (category, model_has_brand, colour_id, price, qty, `description`, title, condition_id, status_id, user_email, date_time_added, delivery_fee_colombo, delivery_fee_other) VALUES 
        ('" . $category . "', '" . $model_has_brand . "', '" . $color . "', '" . $price . "', '" . $qty . "', '" . $description . "', '" . $title . "', '" . $condition . "', '" . $status . "', '" . $usermail . "', '" . $date . "', '" . $dwc . "', '" . $doc . "')");

        // echo "Product Add Sucess";

        $last_id = Database::$connection->insert_id;

        $allowedImageExtention = array("image/jpg", "image/jpeg", "image/png", "image/svg");

        if (isset($_FILES["img"])) {
            $image = $_FILES["img"];
        }

        if (isset($image)) {
            $fileExtention = $image["type"];

            if (in_array($fileExtention, $allowedImageExtention)) {

                $fileName = "images//products//" . uniqid() . $image["name"];
                move_uploaded_file($image["tmp_name"], $fileName);

                Database::iud("INSERT INTO `images` (`code`, `product_id`) VALUES ('" . $fileName . "', '" . $last_id . "') ");
            } else {
                echo "Please select a Valid Image.";
            }
        } else {
            echo "Please select an Image";
        }
    }

    echo "success";
}

?>
<?php

require "connection.php";

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Digital Market | Watch List</title>

    <link rel="icon" href="images/dm_logo.png">

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" /> -->
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php
            require "header.php";
            if (isset($_SESSION["username"])) {

                $mail = $_SESSION["username"]["email"];
            ?>

                <div class="col-12">
                    <div class="row">
                        <div class="col-12 border border-1 border-secondary rounded mb-3 mt-3 pe-3 ps-3">
                            <div class="row">

                                <div class="col-12">
                                    <h2 class="form-label text-center fs-1 fw-bold">Watchlist</h2>
                                </div>

                                <div class="col-12 bg-white border rounded">
                                    <div class="row mt-3">
                                        <div class="offset-0 offset-lg-2 col-12 col-lg-6 mb-3">
                                            <input type="text" class="form-control" placeholder="Search in watchlist..." id="name" />
                                        </div>
                                        <div class="col-12 col-lg-2 d-grid mb-3">
                                            <button class="btn btn-primary" onclick="search11(0);">Search</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="hr-break-1">
                                </div>

                                <div class="col-11 col-lg-2 border border-start-0 border-top-0 border-bottom-0 border-end border-primary bg-dark">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb mt-3">
                                            <li class="breadcrumb-item active fs-4 text-dark" aria-current="page">Watchlist</li>
                                        </ol>
                                    </nav>
                                    <nav class="nav nav-pills flex-column">
                                        <a class="nav-link" href="watchList.php">My watchlist</a>
                                        <a class="nav-link" href="cart.php">My cart</a>
                                        <!-- <a class="nav-link disabled">Recently View</a> -->
                                    </nav>
                                </div>

                                <?php

                                $products = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $mail . "' ");
                                $productCount = $products->num_rows;

                                if ($productCount == 0) {

                                ?>

                                    <!-- no items -->

                                    <div class="col-12 col-lg-9">
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <label class="form-label fs-1 fw-bolder mb-3">
                                                    You Have no items in Watchlist.
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- no items -->
                                <?php
                                } else {

                                ?>

                                    <div class="col-12 offset-lg-1 col-lg-9">
                                        <div class="row g-2">
                                            <?php
                                            for ($x = 0; $x < $productCount; $x++) {
                                                $product = $products->fetch_assoc();
                                                $prod_id = $product["product_id"];
                                                $prod_details = Database::search("SELECT * FROM `product` WHERE `id`='" . $prod_id . "'");
                                                $pn = $prod_details->num_rows;
                                                // for ($y = 0; $y < $pn; $y++) {
                                                if ($pn == 1) {
                                                    $pf = $prod_details->fetch_assoc();
                                                    $pid = $pf["id"];
                                            ?>
                                                    <div class="col-12 ms-3 me-3 col-lg-5">
                                                        <div class="row">



                                                            <div class="card mb-3 mx-0 mx-lg-2 col-12">
                                                                <?php

                                                                $pimgrs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $prod_id . "' ");
                                                                $pimg = $pimgrs->fetch_assoc();

                                                                ?>
                                                                <img src="<?php echo $pimg["code"]; ?>" class="card-img-top" style="width: 150px;">
                                                                <div class="card-body">
                                                                    <h5 class="card-title fw-bold"><?php echo $pf["title"]; ?></h5>

                                                                    <?php

                                                                    $condition = Database::search("SELECT * FROM `condition` WHERE `id`='" . $pf["condition_id"] . "' ");
                                                                    $cf = $condition->fetch_assoc();

                                                                    ?>

                                                                    <span class="fw-bold text-dark">Condition : <?php echo $cf["name"]; ?></span><br />
                                                                    <span class="fw-bold text-dark fs-5">Price : <?php echo $pf["price"]; ?> .00</span>&nbsp;
                                                                    <span class="fw-bold text-dark fs-5"></span><br />

                                                                    <?php

                                                                    $user = Database::search("SELECT * FROM `user` WHERE `email`='" . $mail . "' ");
                                                                    $uf = $user->fetch_assoc();

                                                                    ?>

                                                                    <span class="fw-bold text-dark fs-5">Seller :</span>&nbsp;
                                                                    <br />
                                                                    <span class="fw-bold text-dark fs-5"><?php echo $uf["username"]; ?></span>&nbsp;
                                                                    <br />
                                                                    <span class="fw-bold text-dark fs-5"><?php echo $uf["email"]; ?></span>&nbsp;
                                                                    <div class="col-12 mt-4">
                                                                        <div class="row">
                                                                            <div class="card-body d-grid">
                                                                                <div class="row">
                                                                                    <a href="<?php echo "singleProductView.php?id=" . ($pf["id"]) ?>" class="col-12 col-lg-6 btn btn-outline-success mb-2">Buy now</a>
                                                                                    <a href="#" class="col-12 col-lg-6 btn btn-outline-danger mb-2" onclick="deleteFromWatchlist(<?php echo $product['id']; ?>);">Remove</a>
                                                                                    <!-- <a href="#" class="col-12 btn btn-outline-danger mb-2">Remove</a> -->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                            <?php
                                                }
                                            }

                                            ?>


                                        </div>
                                    </div>

                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>



        </div>
    </div>

    <?php
                require "footer.php";
    ?>
</body>

</html>
<?php

            } else {
                echo "You have to Sign in first";
            }

?>
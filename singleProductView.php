<?php

require "connection.php";

if (isset($_GET["id"])) {

    $productid = $_GET["id"];

    $productrs = Database::search("SELECT product.id,product.category,product.model_has_brand,product.title,
    product.colour_id,product.price,product.qty,product.description,product.condition_id,product.status_id,
    product.user_email,product.date_time_added,product.delivery_fee_colombo,product.delivery_fee_other,model.name AS `mname`,
    brand.name AS `bname` FROM product INNER JOIN model_has_brand ON model_has_brand.id=product.model_has_brand 
    INNER JOIN brand ON brand.id=model_has_brand.brand_id INNER JOIN model ON model_has_brand.model_id=model.id WHERE
    product.id='" . $productid . "' ");

    $productnum = $productrs->num_rows;

    if ($productnum == 1) {

        $pd = $productrs->fetch_assoc();

?>

        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <title>Digital Market | Single Product View</title>

            <link rel="icon" href="images/dm_logo.png">

            <link rel="stylesheet" href="bootstrap.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
            <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
        </head>

        <body>

            <div class="container-fluid">
                <div class="row">

                    <?php
                    require "header.php";
                    ?>
                    <div class="col-12">
                        <div class="row">
                            <h2 class="h2 text-center fw-bold text-white">Single Product View</h2>
                        </div>
                    </div>

                    <div class="col-12 mt-0 singleproduct">
                        <div class="row">

                            <div class="bg-white" style="padding: 11px;">
                                <div class="row">

                                    <div class="col-lg-8 order-1">
                                        <div class="row">

                                            <div class="col-12">

                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fs-4 fw-bold mt-0">
                                                            <?php echo $pd["title"];
                                                            ?>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <span class="badge">
                                                        <i class="fa fa-star mt-1 text-warning fs-6"></i>
                                                        <i class="fa fa-star mt-1 text-warning fs-6"></i>
                                                        <i class="fa fa-star mt-1 text-warning fs-6"></i>
                                                        <i class="fa fa-star mt-1 text-warning fs-6"></i>
                                                        <i class="fa fa-star-half mt-1 text-warning fs-6"></i>
                                                        <label class="text-dark fs-6"> 4.5 Stars</label>
                                                        <label class="text-dark fs-6"> 35 | 35 Ratings & Reviews</label>
                                                    </span>
                                                </div>

                                                <div class="col-12 d-inline-block">
                                                    <label class="fw-bold fs-4 mt-1">Rs. <?php echo $pd["price"];
                                                                                            ?> .00</label>&nbsp;&nbsp;
                                                    <label class="fw-bold fs-6 mt-1 text-danger"><del>Rs. <?php $p = $pd["price"];
                                                                                                            $n = ($pd["price"] / 100) * 10;
                                                                                                            $newval = $p + $n;
                                                                                                            echo $newval;
                                                                                                            ?>.00</del></label>
                                                </div>

                                                <hr class="hr-break-1" />

                                                <div class="col-12">
                                                    <label class="text-primary fs-6 fw-bold">Warrenty : 06 months warrenty</label><br />
                                                    <label class="text-primary fs-6"><b>Return Policy</b> : 01 month return policy</label><br />
                                                    <label class="text-primary fs-6"><b class="text-primary">In Stock</b> : <?php echo $pd["qty"]; ?> Items Left</label>
                                                </div>

                                                <hr class="hr-break-1" />

                                                <?php

                                                $userrs = Database::search("SELECT * FROM user WHERE `email`='" . $pd["user_email"] . "' ");
                                                $userrd = $userrs->fetch_assoc();

                                                ?>

                                                <div class="col-12 col-lg-6">

                                                    <label class="text-dark fs-3 fw-bold mb-3">Seller's Details</label><br />
                                                    <label class="text-success fs-6 fw-bold">Seller's Name : <?php echo $userrd["username"]; ?></label><br />
                                                    <label class="text-success fs-6 fw-bold">Seller's Email : <?php echo $userrd["email"]; ?></label><br />
                                                    <label class="text-success fs-6 fw-bold">Seller's Mobile : <?php echo $userrd["mobile"]; ?></label>
                                                </div>

                                                <hr class="hr-break-1" />

                                                <div class="col-12 mx-3">
                                                    <div class="row">
                                                        <div class="col-lg-8 rounded border border-1 border-primary mt-1 pt-2">
                                                            <div class="row">
                                                                <div class="col-md-3 col-sm-3 col-lg-1">
                                                                    <img src="..." height="70%" />
                                                                </div>
                                                                <div class="col-md-9 col-sm-9 mt-1 pe-4 col-lg-11">
                                                                    <label class="mt-2">Stand a chance to get instant 5% discount by using VISA.</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr class="hr-break-1" />

                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-6" style="margin-top: 15px;">
                                                            <div class="row">
                                                                <div class="border border-1 border-secondary mx-3 rounded overflow-hidden float-start mt-1 position-relative product_qty">
                                                                    <div class="col-12">
                                                                        <span>Qty :</span>
                                                                        <input id="qtyinput" type="text" class="border-0 fs-6 fw-bold text-start" style="outline: none;" pattern="[0-9]" value="1" min="0" onkeyup='check_val(qty);' />
                                                                        <div class="position-absolute qty_buttons">
                                                                            <div class="d-flex flex-column align-items-center border border-1 border-secondary qty_inc">
                                                                                <i class="fas fa-chevron-up" onclick='qty_inc(qty);'></i>
                                                                            </div>
                                                                            <div class="d-flex flex-column align-items-center border border-1 border-secondary qty_dec">
                                                                                <i class="fas fa-chevron-down" onclick='qty_dec(qty);'></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 mt-3">
                                                                    <div class="row">

                                                                        <div class="col-4 col-lg-5 d-grid">
                                                                            <button class="btn btn-danger" onclick="addToCart(<?php echo $pd['id'] ?>);">Add To Cart</button>
                                                                        </div>
                                                                        <div class="col-4 col-lg-5 d-grid">
                                                                            <button class="btn btn-success" onclick="buyNow(<?php echo $pd['id'] ?>);">Buy Now</button>
                                                                        </div>
                                                                        <div class="col-4 col-lg-2 d-grid">
                                                                            <!-- <button class="btn btn-secondary"><i class="fas fa-heart fs-4 mt-1"></i></button> -->
                                                                            <?php

                                                                            $watchrs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $pd["id"] . "'
                                                                            AND `user_email`='" . $userrd["email"] . "'");

                                                                            if ($watchrs->num_rows == 1) {
                                                                            ?>

                                                                                <button onclick='addToWatchlist(<?php echo $pd["id"]; ?>);' class="btn btn-secondary mb-2"><i class="bi bi-heart-fill fs-5 text-danger" id="heart"></i></button>

                                                                            <?php
                                                                            } else {

                                                                            ?>

                                                                                <button onclick='addToWatchlist(<?php echo $pd["id"]; ?>);' class="btn btn-secondary mb-2"><i class="bi bi-heart-fill fs-5" id="heart"></i></button>

                                                                            <?php
                                                                            }

                                                                            ?>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4 order-3 order-lg-2 mt-3 mt-lg-0">
                                        <div class="align-items-center border border-1 border-secondary">

                                            <?php

                                            $Img = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $pd["id"] . "'");
                                            $d = $Img->fetch_assoc();
                                            ?>

                                            <div style="background-image:url('<?php echo $d["code"]; ?>'); background-repeat: no-repeat; background-size: contain; height: 300px; position: relative; margin-top: auto; margin-bottom: auto;">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 bg-white">
                                <div class="row d-block me-0 mt-4 mb-3 border border-1 border-start-0 border-end-0 border-top-0 border-primary">
                                    <div class="col-md-6">
                                        <span class="fs-3 fw-bold">Product Details</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 bg-white">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-2">
                                                <label class="form-label fw-bold">Brand</label>
                                            </div>
                                            <div class="col-10">
                                                <label class="form-label fw-bold"><?php echo $pd["bname"]; ?></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                                <label class="form-label fw-bold">Model</label>
                                            </div>
                                            <div class="col-10">
                                                <label class="form-label fw-bold"><?php echo $pd["mname"]; ?></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                                <label class="form-label fw-bold">Description</label>
                                            </div>
                                            <div class="col-10">
                                                <textarea class="form-label" cols="60" rows="10" disabled>
                                            <?php echo $pd["description"]; ?>
                                        </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 bg-white">
                                <div class="row d-block me-0 mt-4 mb-3 border border-1 border-start-0 border-end-0 border-top-0 border-primary">
                                    <div class="col-md-6">
                                        <span class="fs-3 fw-bold">Feedback Details</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-3 mb-3">
                                <div class="row">
                                    <div class="col-12 col-lg-6 border border-1 border-secondary">


                                        <div class="col-12 mt-3">
                                            <div class="row">
                                                <div class="col-3">
                                                    <label class="form-label text-white">Customer's Email</label>
                                                </div>
                                                <div class="col-8">
                                                    <input id="e" type="email" class="form-control" value="" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <div class="row">
                                                <div class="col-3">
                                                    <label class="form-label fw-bold text-white">Customer's Feedback</label>
                                                </div>
                                                <div class="col-8">
                                                    <textarea id="f" cols="30" rows="8" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="offset-lg-3 col-lg-8 col-12 d-grid mt-2 mb-2">
                                            <button class="btn-outline-primary" onclick="saveFeed(<?php echo $pd['id']; ?>);">Send Feedback</button>
                                        </div>

                                    </div>

                                    <?php

                                    $feedback_rs = Database::search("SELECT * FROM `feedback` WHERE `product_id`='" . $pd['id'] . "'");
                                    $feedback_num = $feedback_rs->num_rows;

                                    for ($x = 0; $x < $feedback_num; $x++) {
                                        $feedback_data = $feedback_rs->fetch_assoc();

                                        $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $feedback_data["user_email"] . "'");
                                        $user_data = $user_rs->fetch_assoc();

                                    ?>

                                        <div class="col-12 col-lg-6 border border-1 border-secondary">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <label class="form-label fw-bold text-white"><?php echo $user_data["username"]; ?></label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-10">
                                                        <label class="form-label text-white"><?php echo $feedback_data["feed"]; ?></label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 text-end">
                                                        <label class="form-label text-end text-white"><?php echo $feedback_data["date"]; ?></label>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr />

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
            <script src="script.js"></script>
            <script src="bootstrap.js"></script>
            <script src="bootstrap.bundle.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
        </body>

        </html>

<?php
    }
} else {
}

?>
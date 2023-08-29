<?php

require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Digital Market | Home</title>

    <link rel="icon" href="images/dm_logo.png">

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>

<body style="background-color: #fff">

    <div class="container-fluid">
        <div class="row">

            <?php
            require "header.php";
            ?>

            <hr class="hr-break-1">

            <div class="col-12 col-lg-10 offset-lg-1 mb-3">
                <div class="row border border-primary bd">
                    <div class="col-12">
                        <div class="row justify-content-center">

                            <div class="col-12 col-lg-6 align-self-center">
                                <!-- boostrep -->
                                <div class="input-group input-group-lg mt-3 mb-3">
                                    <input type="text" class="form-control" aria-label="Text input with dropdown button" id="basic_search_txt">

                                    <select class="btn btn-outline-primary" id="basic_search_select">
                                        <option value="0" readonly>Select category</option>
                                        <?php

                                        $rs = Database::search("SELECT * FROM `category`");
                                        $n = $rs->num_rows;

                                        for ($x = 0; $x < $n; $x++) {
                                            $fa = $rs->fetch_assoc();
                                        ?>

                                            <option value="<?php echo $fa["id"]; ?>"><?php echo $fa["name"]; ?></option>


                                        <?php
                                        }

                                        ?>
                                    </select>

                                </div>

                                <div class="col-12 d-grid gap-2">
                                    <button class="btn btn-primary mt-3 search-btn" onclick="basicSearch(0);">Search</button>
                                    <!-- <button class="btn btn-primary mt-3" onclick="b();">ABC</button> -->
                                </div>

                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="card align-content-end" style="width: 30rem;">
                                    <img src="images/Development.png" class="card-img-top">
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12" id="basicSearchResult">

                <div class="row">
                    <div class="col-12">

                        <?php

                        $rs = Database::search("SELECT * FROM `category`");
                        $n = $rs->num_rows;

                        for ($x = 0; $x < $n; $x++) {

                            $cat = $rs->fetch_assoc();

                        ?>

                            <!-- Category name -->
                            <div class="col-12">
                                <a href="#" class="link-dark link-2"><?php echo $cat["name"]; ?></a>&nbsp;&nbsp;
                                <a href="#" class="link-dark link-3">See All&nbsp; &rarr;</a>
                            </div>
                            <!-- Category name -->

                            <?php

                            $resultset = Database::search("SELECT * FROM `product` WHERE `category` = '" . $cat["id"] . "' ORDER BY  `date_time_added` DESC LIMIT 4 OFFSET 0");
                            $norows = $resultset->num_rows;

                            ?>

                            <!-- Products -->
                            <div class="col-12 mb-3">

                                <div class="row border border-primary bd">

                                    <div class="col-12 col-lg-12">

                                        <div class="row justify-content-center gap-2">
                                            <?php

                                            for ($y = 0; $y < $norows; $y++) {

                                                $product = $resultset->fetch_assoc();

                                            ?>

                                                <div class="card col-6 col-lg-2 mt-2 mb-2" style="width: 18rem;">

                                                    <?php

                                                    $pimage = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $product["id"] . "' ");
                                                    $img = $pimage->fetch_assoc();

                                                    ?>

                                                    <img src="<?php echo $img["code"]; ?>" class="card-img-top card-img-top" style="width: 150px;">
                                                    <div class="card-body text-center ms-0 m-0">

                                                        <!-- <div class="col-lg-4 col-md-5 col-12">
                                                <div class="card">
                                                    <img src="img1.png" class="card-img-top">
                                                    <div class="card-body text-center">
                                                        <h5 class="card-title">Turmeric-$2</h5>
                                                        <a href="#" class="btn signin">Add To Cart</a>
                                                    </div>
                                                </div>
                                            </div> -->

                                                        <h5 class="card-title"><?php echo $product["title"]; ?><span class="badge bg-info">New</span></h5>
                                                        <span class="card-text text-primary"><?php echo $product["price"]; ?> .00</span>
                                                        <br />

                                                        <?php

                                                        if ($product["qty"] > 0) {
                                                        ?>

                                                            <span class="card-text text-warning"><b>In Stock</b></span>
                                                            <br />
                                                            <span class="card-text text-success"><b><?php echo $product["qty"]; ?> Items Available</b></span>
                                                            <a href="<?php echo "singleProductView.php?id=" . ($product["id"]) ?>" class="btn btn-success col-12">Buy Now</a>
                                                            <a href="cart.php" class="btn btn-danger col-12 mt-1" onclick="addToCart(<?php echo $product['id'] ?>);">Add to Cart</a>

                                                        <?php


                                                        } else {
                                                        ?>

                                                            <span class="card-text text-danger"><b>Out of Stock</b></span>
                                                            <br />
                                                            <span class="card-text text-danger fw-bold"><b>0 Items Available</b></span>
                                                            <a href="#" class="btn btn-success col-12 disabled">Buy Now</a>
                                                            <a href="#" class="btn btn-danger col-12 mt-1 disabled">Add to Cart</a>

                                                        <?php
                                                        }

                                                        ?>


                                                        <!-- <a href="#" class="btn btn-secondary col-12 mt-1"><i class="bi bi-heart-fill fs-5"></i></a> -->
                                                    </div>
                                                </div>

                                            <?php

                                            }

                                            ?>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        <?php

                        }

                        ?>
                    </div>
                </div>

            </div>
            <!-- <button class="btn btn-primary mt-3" onclick="b();">ABC</button> -->

            <!-- Products -->



        </div>
    </div>

    <?php

    require "footer.php";

    ?>

    <script src="script.js"></script>

</body>

</html>
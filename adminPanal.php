<?php

session_start();
require "connection.php";

if (isset($_SESSION["admin"])) {

?>

    <!DOCTYPE html>

    <html>

    <head>

        <title>Digital Market | Admin Panel</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="images/dm_logo.png" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

    </head>

    <body>

        <div class="container-fluid">
            <div class="row" id="mainrow">

                <div class="col-12">
                    <div class="row">

                        <!-- nav -->
                        <div class="col-12 col-lg-2 my-4 rounded border border-primary bg-dark">
                            <div class="row">

                                <div class="col-12 mt-3 fs-5">
                                    <div class="row">

                                        <div class="col-12 mt-5">
                                            <h4 class="text-white"><?php echo $_SESSION["admin"]["fname"] . " " . $_SESSION["admin"]["lname"] ?></h4>
                                            <hr class="border border-1 border-white" />
                                        </div>

                                        <div class="nav flex-column nav-pills me-3 mt-3" role="tablist" aria-orientation="vertical">
                                            <nav class="nav flex-column">
                                                <a class="nav-link text-white active fs-5" href="adminPanal.php">Dashboard</a>
                                                <a class="nav-link text-white fs-5" href="manageUsers.php">Manage Users</a>
                                                <a class="nav-link text-white fs-5" aria-current="page" href="manageProducts.php">Manage Products</a>
                                                <a class="nav-link fs-5 text-white" href="adminSignin.php">Log Out</a>
                                            </nav>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- nav -->


                        <div class="col-12 col-lg-10 my-4">
                            <div class="row">

                                <div class="col-12 text-white fw-bold mb-3 mt-2">
                                    <h2 class="fw-bold">Dashboard</h2>
                                </div>

                                <div class="col-12">
                                    <hr />
                                </div>

                                <div class="col-12">
                                    <div class="row g-1">

                                        <!-- 1 -->
                                        <div class="col-6 col-lg-4 px-1">
                                            <div class="row g-1">
                                                <div class="col-12 bg-primary text-white text-center rounded" style="height: 100px;">
                                                    <br />

                                                    <?php

                                                    $today = date("Y-m-d");
                                                    $this_month = date("m");
                                                    $this_year = date("Y");

                                                    $a = "0";
                                                    $b = "0";
                                                    $c = "0";
                                                    $d = "0";
                                                    $e = "0";

                                                    $invoice_rs = Database::search("SELECT * FROM `invoice`");
                                                    $invoice_num = $invoice_rs->num_rows;

                                                    for ($x = 0; $x < $invoice_num; $x++) {

                                                        $invoice_data = $invoice_rs->fetch_assoc();

                                                        $e = $e + $invoice_data["qty"];
                                                        $f = $invoice_data["date"];
                                                        $split_date = explode(" ", $f);
                                                        $pdate = $split_date[0];

                                                        if ($pdate == $today) {
                                                            $a = $a + $invoice_data["total"];
                                                            $c = $c + $invoice_data["qty"];
                                                        }
                                                        $split_result = explode("-", $pdate);
                                                        $pyear = $split_result[0];
                                                        $pmonth = $split_result[1];

                                                        if ($pyear == $this_year) {
                                                            if ($pmonth == $this_month) {
                                                                $b = $b + $invoice_data["total"];
                                                                $d = $d + $invoice_data["qty"];
                                                            }
                                                        }
                                                    }

                                                    ?>

                                                    <span class="fs-4 fw-bold text-white">Daily Earnings</span>
                                                    <br />
                                                    <span class="fs-5 text-white">Rs. <?php echo $a; ?>.00</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- 1 -->

                                        <!-- 2 -->
                                        <div class="col-6 col-lg-4 px-1">
                                            <div class="row g-1">
                                                <div class="col-12 bg-warning text-white text-center rounded" style="height: 100px;">
                                                    <br />
                                                    <span class="fs-4 fw-bold text-white">Monthly Earnings</span>
                                                    <br />
                                                    <span class="fs-5 text-white">Rs. <?php echo $b; ?> .00</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- 2 -->

                                        <!-- 3 -->
                                        <div class="col-6 col-lg-4 px-1">
                                            <div class="row g-1">
                                                <div class="col-12 bg-secondary text-white text-center rounded" style="height: 100px;">
                                                    <br />
                                                    <span class="fs-4 fw-bold text-white">Today Sellings</span>
                                                    <br />
                                                    <span class="fs-5 text-white"><?php echo $c; ?> Items</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- 3 -->

                                        <!-- 4 -->
                                        <div class="col-6 col-lg-4 px-1">
                                            <div class="row g-1">
                                                <div class="col-12 bg-success text-white text-center rounded" style="height: 100px;">
                                                    <br />
                                                    <span class="fs-4 fw-bold text-white">Monthly Sellings</span>
                                                    <br />
                                                    <span class="fs-5 text-white"><?php echo $d; ?> Items</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- 4 -->

                                        <!-- 5 -->
                                        <div class="col-6 col-lg-4 px-1">
                                            <div class="row g-1">
                                                <div class="col-12 bg-info text-white text-center rounded" style="height: 100px;">
                                                    <br />
                                                    <span class="fs-4 fw-bold text-white">Total Sellings</span>
                                                    <br />
                                                    <span class="fs-5 text-white"><?php echo $e; ?> Items</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- 5 -->

                                        <!-- 6 -->
                                        <div class="col-6 col-lg-4 px-1">
                                            <div class="row g-1">
                                                <div class="col-12 bg-danger text-white text-center rounded" style="height: 100px;">
                                                    <br />
                                                    <span class="fs-4 fw-bold text-white">Total Engagements</span>
                                                    <br />
                                                    <span class="fs-5 text-white"><?php echo $e; ?> Members</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- 6 -->

                                        <hr>

                                        <div class="offset-1 col-10 col-lg-4 mt-3 mb-3 rounded bg-dark">
                                            <div class="row g-1">

                                                <div class="col-12 text-center">
                                                    <label class="form-label fs-3 text-white mt-2 fw-bold">Today Date & Time</label>
                                                </div>
                                                <div class="col-12 text-center">
                                                    <img src="images/clock.png" class="img-fluid rounded-top" style="height: 250px;" />
                                                    <hr />
                                                </div>

                                                <?php

                                                $d = new DateTime();
                                                $tz = new DateTimeZone("Asia/Colombo");
                                                $d->setTimezone($tz);
                                                $date = $d->format("Y - m - d");
                                                $date_t = $d->format("H : i : s");

                                                ?>

                                                <div class="col-12 text-center">
                                                    <br />
                                                    <span class="fs-4 text-white fw-bold"><?php echo $date ?></span>
                                                    <br />
                                                    <span class="fs-4 text-white fw-bold"><?php echo $date_t ?></span>
                                                </div>

                                                <div class="col-12">
                                                    <div class="first_place"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="offset-1 col-10 col-lg-4 mt-3 mb-3 rounded bg-light">
                                            <div class="row g-1">
                                                <div class="col-12 text-center">
                                                    <label class="form-label fs-4 mt-2 fw-bold">Mostly Slod Item</label>
                                                </div>
                                                <?php
                                                $freq_rs = Database::search("SELECT `product_id`, COUNT(`product_id`) AS `value_occurence`
                                                FROM `invoice` GROUP BY `product_id` ORDER BY `value_occurence`
                                                DESC LIMIT 1");
                                                $freq_num = $freq_rs->num_rows;

                                                if ($freq_num > 0) {

                                                    $freq_data = $freq_rs->fetch_assoc();

                                                    $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `images` ON 
                                                    product.id=images.product_id WHERE `id`='" . $freq_data["product_id"] . "'");

                                                    $product_data = $product_rs->fetch_assoc();

                                                    $qty_rs = Database::search("SELECT SUM(`qty`) AS total FROM `invoice` WHERE 
                                                    `product_id`='" . $freq_data["product_id"] . "' AND `date` LIKE '%" . $today . "%'");

                                                    $qty_data = $qty_rs->fetch_assoc();
                                                ?>
                                                    <div class="col-12 text-center">
                                                        <img src="<?php echo $product_data["code"]; ?>" class="img-fluid rounded-top" style="height: 250px;" />
                                                        <hr />
                                                    </div>
                                                    <div class="col-12 text-center">
                                                        <span class="fs-5 fw-bold"><?php echo $product_data["title"]; ?></span>
                                                        <br />
                                                        <span class="fs-6"><?php echo $qty_data["total"]; ?> Items</span>
                                                        <br />
                                                        <span class="fs-6">Rs. <?php echo $product_data["price"]; ?>.00</span>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                                <div class="col-12">
                                                    <div class="first_place"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 offset-lg-1 col-lg-9">
                                            <div class="row">
                                                <div class="card mb-3 mx-0 col-12 signUpBox">
                                                    <div class="row g-0">
                                                        <?php
                                                        $seller_rs = Database::search("SELECT * FROM `user` INNER JOIN `profile_img` ON
                                                        user.email=profile_img.user_email WHERE `email`='" . $product_data["user_email"] . "'");

                                                        $seller_data = $seller_rs->fetch_assoc();
                                                        ?>

                                                        <div class="col-md-4">
                                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="" title="Product Description">
                                                                <img src="<?php echo $seller_data["code"]; ?>" class="img-fluid rounded-start" style="height: 250px;">
                                                            </span>
                                                        </div>
                                                        <div class="col-md-5 align-self-center">
                                                            <div class="card-body">
                                                                <div class="col-12 text-center">
                                                                    <label class="form-label fs-4 mt-2 fw-bold">Most Famous Seller</label>
                                                                </div>
                                                                <span class="fw-bold text-dark fs-5">Name : <?php echo $seller_data["username"]; ?></span><br>
                                                                <span class="fw-bold text-dark fs-5">Email : <?php echo $seller_data["email"]; ?></span><br>
                                                                <span class="fw-bold text-dark fs-5">Mobile : <?php echo $seller_data["mobile"]; ?></span>&nbsp;
                                                                <span class="fw-bold text-dark fs-5"></span>
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
                    </div>
                </div>
            </div>
        </div>

        <script src="script.js"></script>
    </body>

    </html>

<?php
} else {
?>

    <script>
        alert("Please Sign In First");
        Window.location = "adminSignIn.php";
    </script>

<?php
}

?>
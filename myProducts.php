<?php

require "connection.php";
session_start();

if (isset($_SESSION["username"])) {

    $user = $_SESSION["username"];
    $pageno;
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Digital Market | My Products</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

        <link rel="icon" href="images/dm_logo.png" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
    </head>

    <body>

        <div class="container-fluid">
            <div class="row">

                <!-- Header -->
                <div class="col-12 bg-dark border rounded">
                    <div class="row">

                        <div class="col-4">
                            <div class="row">

                                <div class="col-12 mt-1 text-center">
                                    <span class="fw-bold text-white"><?php echo $user["username"]; ?></span>
                                </div>

                                <div class="col-12 mt-1 text-center">
                                    <span class="text-white"><?php echo $user["email"]; ?></span>
                                </div>
                                <div class="col-12 mt-1 text-center">
                                    <a class="text-white" href="http://localhost/digital_market/home.php">Home</a>
                                </div>

                            </div>
                        </div>

                        <div class="col-8">
                            <div class="row">
                                <div class="col-12 text-center mt-5 my-lg-3">
                                    <h1 class="fw-bold text-white fs-1">My Products</h1>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <!-- Header -->
                <!-- body -->

                <div class="col-12">
                    <div class="row">
                        <!-- filter -->

                        <div class="col-11 col-lg-2 bg-dark mx-3 my-3 rounded border border-primary">
                            <div class="row">

                                <div class="col-12 mt-3 fs-5">
                                    <div class="row">

                                        <div class="col-12">
                                            <label class="form-label text-white fs-3 fw-bold">Sort Products</label>
                                        </div>

                                        <div class="col-11">
                                            <div class="row">
                                                <div class="col-10">
                                                    <input type="text" class="form-control text-white" placeholder="Search..." id="s" />
                                                </div>
                                                <div class="col-1 p1">
                                                    <label class="form-label text-white bi bi-search fs-3"></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label text-white fw-bold">Active Time</label>
                                        </div>
                                        <div class="col-12">
                                            <hr width="80%" />
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="n">
                                                <label class="form-check-label text-white" for="n">
                                                    Newer to Oldest
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="o">
                                                <label class="form-check-label text-white" for="o">
                                                    Older to Newest
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold text-white">By Quantity</label>
                                        </div>
                                        <div class="col-12">
                                            <hr width="80%" />
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault1" id="l">
                                                <label class="form-check-label text-white" for="l">
                                                    High to Low
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault1" id="h">
                                                <label class="form-check-label text-white" for="h">
                                                    Low to High
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold text-white">By Condition</label>
                                        </div>
                                        <div class="col-12">
                                            <hr width="80%" />
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault2" id="b">
                                                <label class="form-check-label text-white" for="b">
                                                    BrandNew
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault2" id="u">
                                                <label class="form-check-label text-white" for="u">
                                                    Used
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 text-center mt-3 mb-3">
                                            <button class="btn btn-success text-white fw-bold">Sort</button>
                                            <button class="btn btn-primary text-white">Clear Filters</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- filter -->

                        <!-- products -->

                        <div class="col-12 col-lg-9 mt-3 mb-3 bg-dark border rounded">
                            <div class="row">
                                <div class="col-10 offset-1 text-center" id="sort">
                                    <div class="row justify-content-center">

                                        <?php

                                        if (isset($_GET["page"])) {
                                            $pageno = $_GET["page"];
                                        } else {
                                            $pageno = 1;
                                        }

                                        $products = Database::search("SELECT * FROM `product` WHERE 
                                        `user_email`='" . $user["email"] . "'");
                                        $nProducts = $products->num_rows;
                                        $userProducts = $products->fetch_assoc();

                                        $results_per_page = 6;
                                        $number_of_pages = ceil($nProducts / $results_per_page);

                                        $page_first_result = ($pageno - 1) * $results_per_page;
                                        $selectedrs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "'
                                        LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "");
                                        $srn = $selectedrs->num_rows;

                                        for ($x = 0; $x < $srn; $x++) {
                                            $p = $selectedrs->fetch_assoc();

                                        ?>

                                            <!--  -->
                                            <div class="card mb-3 mt-3 col-12 col-lg-6">
                                                <div class="row">
                                                    <div class="col-md-4 mt-4">

                                                        <?php

                                                        $pimgrs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $p["id"] . "'");
                                                        $pir = $pimgrs->fetch_assoc();

                                                        ?>

                                                        <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start" style="height: 15vh;" />
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">

                                                            <h5 class="card-title fw-bold"><?php echo $p["title"]; ?></h5>
                                                            <span class="card-text text-primary fw-bold">Rs. <?php echo $p["price"]; ?>.00</span>
                                                            <br />
                                                            <span class="card-text text-success fw-bold"><?php echo $p["qty"]; ?> Items Left</span>
                                                            <br />
                                                            <div class="row ">
                                                                <div class="col-12">
                                                                    <div class="row g-1">

                                                                        <div class="col-12 col-lg-6 d-grid">
                                                                            <a href="#" class="btn btn-success" onclick="sendId(<?php echo $p['id']; ?>);">Update</a>
                                                                        </div>
                                                                        <div class="col-12 col-lg-6 d-grid">
                                                                            <a href="#" class="btn btn-danger">Delete</a>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--  -->
                                        <?php
                                        }


                                        ?>

                                    </div>

                                </div>

                                <!-- page -->
                                <div class="col-8 col-lg-4 offset-2 offset-lg-4 text-center mb-3">
                                    <div class="pagination">
                                        <a href="
                                        <?php

                                        if ($pageno <= 1) {
                                            echo "#";
                                        } else {
                                            echo "?page=" . ($pageno - 1);
                                        }
                                        ?> ">&laquo;</a>

                                        <?php

                                        for ($page = 1; $page <= $number_of_pages; $page++) {

                                            if ($page == $pageno) {

                                        ?>
                                                <a href="<?php echo "?page=" . ($page) ?>" class="active"><?php echo $page; ?></a>

                                            <?php

                                            } else {
                                            ?>
                                                <a href="<?php echo "?page=" . ($page) ?>"><?php echo $page; ?></a>
                                        <?php
                                            }
                                        }

                                        ?>

                                        <a href="
                                        <?php

                                        if ($pageno >= $number_of_pages) {
                                            echo "#";
                                        } else {
                                            echo "?page=" . ($pageno + 1);
                                        }
                                        ?>
                                        ">&raquo;</a>
                                    </div>
                                </div>
                                <!-- page -->
                            </div>
                        </div>

                        <!-- products -->

                    </div>
                </div>

            </div>
        </div>
        <?php

        require "footer.php";

        ?>

        <!-- body -->
        <script src="bootstrap.js"></script>
        <script src="script.js"></script>
    </body>

    </html>
<?php
} else {
?>
    <script>
        alert("You have to Sign In or Sign Up first");
        window.location = "index.php";
    </script>

<?php
}
?>
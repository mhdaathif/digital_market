<?php

session_start();
require "connection.php";

if (isset($_SESSION["username"])) {

?>


    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Digital Market | Transaction History</title>

        <link rel="icon" href="images/dm_logo.png">

        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="style.css">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
    </head>

    <body>

        <div class="container-fluid">
            <div class="row">

                <?php
                //require "header.php";
                ?>

                <hr class="hr-break-1">

                <div class="col-12 col-lg-11 mx-auto bg-white border-3 rounded-2 text-center mb-3">
                    <span class="fs-1 fw-bold text-dark">Transaction History</span>
                </div>

                <!-- table head -->
                <div class="col-12 d-none d-lg-block">
                    <div class="row">

                        <div class="col-1 bg-dark">
                            <label class="form-label text-white fw-bold">#</label>
                        </div>

                        <div class="col-3 bg-dark">
                            <label class="form-label text-white fw-bold">Order Details</label>
                        </div>

                        <div class="col-1 bg-dark text-end">
                            <label class="form-label text-white fw-bold">Quantity</label>
                        </div>

                        <div class="col-2 bg-dark text-end">
                            <label class="form-label text-white fw-bold">Amount</label>
                        </div>

                        <div class="col-2 bg-dark text-end">
                            <label class="form-label text-white fw-bold">Purchase Date & Time</label>
                        </div>

                        <div class="col-3 bg-dark"></div>
                        <div class="col-12">
                            <hr>
                        </div>

                    </div>
                </div>
                <!-- table head -->

                <?php

                $abc = Database::search("SELECT * FROM invoice INNER JOIN product ON product.id = invoice.product_id INNER JOIN user ON product.user_email = user.email INNER JOIN images ON product.id = images.product_id");

                $abc_num = $abc->num_rows;

                for ($x = 0; $x < $abc_num; $x++) {

                    $abc_data = $abc->fetch_assoc();

                ?>

                    <!-- table body -->

                    <div class="col-12">
                        <div class="row">

                            <div class="col-12 col-lg-1 bg-dark text-center text-lg-start">
                                <label class="form-label text-white fs-4 py-5"><?php echo $abc_data["order_id"]; ?></label>
                            </div>

                            <div class="col-12 bg-dark col-lg-3">
                                <div class="row g-2">

                                    <div class="card mx-0 my-3" style="max-width: 540px;">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <img src="<?php echo $abc_data["code"]; ?>" class="img-fluid rounded-start">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo $abc_data["title"]; ?></h5>
                                                    <p class="card-text"><b>Seller :</b> <?php echo $abc_data["username"]; ?></p>
                                                    <p class="card-text"><b>Price :</b> Rs. <?php echo $abc_data["price"]; ?>.00</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 col-lg-1 bg-dark text-center">
                                <label class="form-label text-white fs-4 pt-5"><?php echo $abc_data["qty"]; ?></label>
                            </div>

                            <div class="col-12 col-lg-2 bg-dark text-center text-lg-end">
                                <label class="form-label fs-5 fw-bold py-5 text-white">Rs. <?php echo $abc_data["total"]; ?>.00</label>
                            </div>

                            <div class="col-12 col-lg-2 bg-dark text-center text-lg-end">
                                <label class="form-label text-white fs-5 fw-bold px-3 py-5"><?php echo $abc_data["date"]; ?></label>
                            </div>

                            <div class="col-12 col-lg-3 bg-dark">
                                <div class="row">
                                    <div class="col-6 d-grid">
                                        <button class="btn btn-warning rounded border border-1 border-primary mt-5 fs-5">
                                            <i class="bi bi-info-circle-fill"></i> Feedback</button>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- table body -->
                <?php
                }
                ?>
            </div>
        </div>

        <div class="col-12">
            <hr>
        </div>

        </div>
        </div>

        <?php
        require "footer.php";
        ?>

        <script src="script.js"></script>

    </body>

    </html>

<?php
} else {
?>

    <script>
        alert("Please Sign In First");
        Window.location = "index.php";
    </script>

<?php
}

?>
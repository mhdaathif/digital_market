<?php

session_start();
require "connection.php";

if (isset($_SESSION["admin"])) {

?>

    <!DOCTYPE html>
    <html>

    <head>

        <title>Digital Market | Manage Users</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="images/dm_logo.png" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

    </head>

    <body>

        <div class="container-fluid">
            <div class="row">

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
                                                <a class="nav-link text-white fs-5" href="adminPanal.php">Dashboard</a>
                                                <a class="nav-link text-white active fs-5" aria-current="page" href="manageUsers.php">Manage Users</a>
                                                <a class="nav-link text-white fs-5" href="manageProducts.php">Manage Products</a>
                                                <a class="nav-link text-white fs-5" href="adminSignin.php">Log Out</a>
                                            </nav>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- nav -->

                        <!-- products -->
                        <div class="col-12 col-lg-10 my-4">
                            <div class="row">

                                <div class="col-11 mx-auto offset-1 text-white text-center fw-bold mb-3 mt-2 abc">
                                    <h2 class="text-dark mt-4 fw-bold">Manage All Users</h2>

                                    <div class="col-12 mt-3">
                                        <div class="row">
                                            <div class="col-12 col-lg-7 mx-auto mb-3 mt-3">
                                                <div class="row">
                                                    <div class="col-9">
                                                        <input type="text" class="form-control" />
                                                    </div>
                                                    <div class="col-3 d-grid">
                                                        <button class="btn btn-warning">Search User</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-11 mx-auto mt-3">
                                        <div class="row">
                                            <div class="col-2 col-lg-1 bg-dark py-2 text-end">
                                                <span class="fs-6 fw-bold text-white">#</span>
                                            </div>
                                            <div class="col-2 col-lg-1  bg-dark py-2 d-none d-lg-block">
                                                <span class="fs-6 fw-bold text-white">Profile</span>
                                            </div>
                                            <div class="col-3 col-lg-2 bg-dark py-2">
                                                <span class="fs-6 fw-bold text-white">User Name</span>
                                            </div>
                                            <div class="col-3 col-lg-2 bg-dark py-2 d-lg-block">
                                                <span class="fs-6 fw-bold text-white">Email</span>
                                            </div>
                                            <div class="col-2 bg-dark py-2 d-none d-lg-block">
                                                <span class="fs-6 fw-bold text-light">Mobile</span>
                                            </div>
                                            <div class="col-2 bg-dark py-2 d-none d-lg-block">
                                                <span class="fs-6 fw-bold text-white">Registered Date</span>
                                            </div>
                                            <div class="col-4 col-lg-2 bg-dark"></div>
                                        </div>
                                    </div>

                                    <?php

                                    $page_no;

                                    if (isset($_GET["page"])) {
                                        $page_no = $_GET["page"];
                                    } else {
                                        $page_no = 1;
                                    }

                                    $user_rs = Database::search("SELECT * FROM `user`");
                                    $user_num = $user_rs->num_rows;

                                    $results_per_page = 10;
                                    $number_of_pages = ceil($user_num / $results_per_page);

                                    $page_first_result = ((int)$page_no - 1) * $results_per_page;
                                    $view_user_rs = Database::search("SELECT * FROM `user` LIMIT " . $results_per_page . " OFFSET " . $page_first_result . " ");

                                    $view_results_num = $view_user_rs->num_rows;

                                    $c = 0;

                                    ?>

                                    <?php

                                    while ($user_data = $view_user_rs->fetch_assoc()) {
                                        $c = $c + 1;

                                    ?>

                                        <div class="col-11 mx-auto">
                                            <div class="row">
                                                <div class="col-2 col-lg-1 bg-dark py-2 text-end">
                                                    <span class="fs-6 fw-bold text-white"><?php echo $c; ?></span>
                                                </div>

                                                <?php

                                                $image_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $user_data["email"] . "'");
                                                $image_data = $image_rs->fetch_assoc();

                                                ?>

                                                <div class="col-2 col-lg-1 bg-dark py-2 d-none d-lg-block">
                                                    <img src="<?php echo $image_data["code"]; ?>" style="height: 40px;" />
                                                </div>
                                                <div class="col-3 col-lg-2 bg-dark py-2">
                                                    <span class="fs-6 fw-bold text-white"><?php echo $user_data["username"]; ?></span>
                                                </div>
                                                <div class="col-3 col-lg-2 bg-dark py-2 d-lg-block">
                                                    <span class="fs-6 fw-bold text-white"><?php echo $user_data["email"]; ?></span>
                                                </div>
                                                <div class="col-2 bg-dark py-2 d-none d-lg-block">
                                                    <span class="fs-6 fw-bold text-white"><?php echo $user_data["mobile"]; ?></span>
                                                </div>
                                                <div class="col-2 bg-dark py-2 d-none d-lg-block">
                                                    <span class="fs-6 fw-bold text-white">
                                                        <?php $row = $user_data["register_date"];
                                                        $splited = explode(" ", $row);
                                                        echo $splited[0]; ?></span>
                                                    </span>
                                                </div>
                                                <div class="col-4 col-lg-2 bg-dark py-2 d-grid">
                                                    <?php

                                                    $s = $user_data["status_id"];
                                                    if ($s == "1") {
                                                    ?>
                                                        <button class="btn btn-danger" onclick="userBlock('<?php echo $user_data['email']; ?>');">Block</button>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <button class="btn btn-success" onclick="userBlock('<?php echo $user_data['email']; ?>');">Unblock</button>
                                                    <?php
                                                    }

                                                    ?>
                                                </div>
                                            </div>
                                        </div>

                                    <?php

                                    }
                                    ?>

                                    <!-- page -->
                                    <div class="col-12 text-center mt-3">
                                        <div class="pagination">
                                            <a href="<?php if ($page_no <= 1) {
                                                            echo "#";
                                                        } else {
                                                            echo "?page=" . ($page_no - 1);
                                                        } ?>">&laquo;</a>

                                            <?php

                                            for ($page = 1; $page <= $number_of_pages; $page++) {
                                                if ($page == $page_no) {
                                            ?>
                                                    <a href="<?php echo "?page=" . ($page); ?>" class="active"><?php echo $page; ?></a>
                                                <?php
                                                } else {
                                                ?>
                                                    <a href="<?php echo "?page=" . ($page); ?>"><?php echo $page; ?></a>
                                            <?php
                                                }
                                            }

                                            ?>
                                            <a href="<?php if ($page_no >= $number_of_pages) {
                                                            echo "#";
                                                        } else {
                                                            echo "?page=" . ($page_no + 1);
                                                        } ?>">&raquo;</a>
                                        </div>
                                    </div>
                                    <!-- page -->

                                </div>

                            </div>
                        </div>
                        <!-- products -->

                    </div>
                </div>

            </div>
        </div>


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
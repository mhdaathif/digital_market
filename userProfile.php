<?php

session_start();

require "connection.php";

if (isset($_SESSION["username"])) {

?>

    <!DOCTYPE html>

    <html>

    <head>
        <title>Digital Market | UserProfile</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="images/dm_logo.png">

        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="style.css">
    </head>

    <body class="bg-dark">
        <div class="container-fluid bg-body rounded mt-4 mb-4">
            <div class="row">

                <div class="col-md-2">
                    <div class="d-flex flex-column align-items-center py-3 p-2">

                        <?php

                        $profileImg = Database::search("SELECT * FROM `profile_img` WHERE `user_email` = '" . $_SESSION["username"]["email"] . "'");
                        $profileNum = $profileImg->num_rows;

                        if ($profileNum == 1) {
                            $profile = $profileImg->fetch_assoc();
                        ?>
                            <img class="rounded offset-md-1" width="150px" src="<?php echo $profile["code"]; ?>" id="prev1">
                        <?php

                        } else {
                        ?>
                            <img class="rounded offset-md-1" width="150px" src="images/Profiles/user.png" id="prev1">
                        <?php
                        }


                        ?>


                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex flex-column align-items-md-start align-items-center py-md-5 p-md-3">
                        <span class="fw-bold offset-md-0"> <?php echo $_SESSION["username"]["username"] ?></span>
                        <span class="text-black-50 offset-md-0"><?php echo $_SESSION["username"]["email"] ?></span>
                        <input type="file" class="d-none" id="profileimg" accept="img/*">
                        <label class="btn btn-primary mt-3" for="profileimg" onclick="changeImg();">Update Profile Image</label>
                    </div>
                </div>
            </div>

            <hr class="hr-break-1">

            <div class="row">
                <div class="col-md-6 border-end">
                    <div class="py-5 p-3">

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4>Profile Settings</h4>
                        </div>

                        <div class="row mt-3">

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Username</label>
                                <input class="form-control" id="username" placeholder="Enter Your Username" id="uname" type="text" value="<?php echo $_SESSION["username"]["username"]; ?>" />
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Mobile No.</label>
                                <input class="form-control" id="mobile" placeholder="Enter Your Mobile Number" type="text" value="<?php echo $_SESSION["username"]["mobile"]; ?>" />
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Password</label>
                                <div class="row">
                                    <div class="col-md-8">
                                        <input class="form-control" placeholder="Password" type="password" readonly value="<?php echo $_SESSION["username"]["password"]; ?>" />
                                    </div>
                                    <div class="col-md-4 d-grid">
                                        <button class=" btn btn-primary">Show Password</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Email Address</label>
                                <input class="form-control" placeholder="Enter Your Email Address" type="text" readonly value="<?php echo $_SESSION["username"]["email"]; ?>" />
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Registered Date</label>
                                <input class="form-control" placeholder="Enter Your Registered Date" type="text" readonly value="<?php echo $_SESSION["username"]["register_date"]; ?>" />
                            </div>

                            <?php

                            $usreemail = $_SESSION["username"]["email"];
                            $address = Database::search("SELECT * FROM `user_has_adderss` WHERE `user_email` = '" . $usreemail . "' ");
                            $n = $address->num_rows;

                            if ($n > 0) {
                                $d = $address->fetch_assoc();

                                $city = Database::search("SELECT * FROM city WHERE `id` = '" . $d["city_id"] . "' ");
                                $cityfe = $city->fetch_assoc();

                                $district = Database::search("SELECT * FROM district WHERE `id` = '" . $cityfe["district_id"] . "' ");
                                $districtfe = $district->fetch_assoc();

                                $provicce = Database::search("SELECT * FROM province WHERE `id` = '" . $districtfe["province_id"] . "' ");
                                $proviccefe = $provicce->fetch_assoc();
                            ?>


                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address Line 01</label>
                                    <input class="form-control" id="addline1" placeholder="Enter Your Address Line 01" type="text" value="<?php echo $d["line_1"] ?>" />
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address Line 02</label>
                                    <input class="form-control" id="addline2" placeholder="Enter Your Address Line 02" type="text" value="<?php echo $d["line_2"] ?>" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Province</label>
                                    <select class="form-select" disabled>
                                        <option value="<?php echo $proviccefe["id"] ?>"><?php echo $proviccefe["name"] ?></option>

                                        <?php

                                        $pall = Database::search("SELECT * FROM `province` WHERE `name` != '" . $proviccefe["name"] . "' ");
                                        $num1 = $pall->num_rows;

                                        for ($x = 1; $x <= $num1; $x++) {
                                            $row1 = $pall->fetch_assoc();

                                        ?>

                                            <option value="<?php echo $row1["id"] ?>"><?php echo $row1["name"] ?></option>

                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">District</label>
                                    <select class="form-select" disabled>
                                        <!-- <option>Select Your District</option> -->
                                        <option value="<?php echo $districtfe["id"] ?>"><?php echo $districtfe["name"] ?></option>

                                        <?php

                                        $pall = Database::search("SELECT * FROM `district` WHERE `name` != '" . $districtfe["name"] . "' ");
                                        $num1 = $pall->num_rows;

                                        for ($x = 1; $x <= $num1; $x++) {
                                            $row1 = $pall->fetch_assoc();

                                        ?>

                                            <option value="<?php echo $row1["id"] ?>"><?php echo $row1["name"] ?></option>

                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">City</label>
                                    <select class="form-select" id="usercity">
                                        <option value="<?php echo $cityfe["id"] ?>"><?php echo $cityfe["name"] ?></option>

                                        <?php

                                        $pall = Database::search("SELECT * FROM `city` WHERE `name` != '" . $cityfe["name"] . "' ");
                                        $num1 = $pall->num_rows;

                                        for ($x = 1; $x <= $num1; $x++) {
                                            $row1 = $pall->fetch_assoc();

                                        ?>

                                            <option value="<?php echo $row1["id"] ?>"><?php echo $row1["name"] ?></option>

                                        <?php
                                        }
                                        ?>


                                    </select>
                                </div>

                                <div class="mt-3 text-center">
                                    <button class="btn btn-primary" onclick="updateprofile();">Update Profile</button>
                                </div>

                            <?php

                            } else {

                            ?>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address Line 01</label>
                                    <input class="form-control" id="addline1" placeholder="Enter Your Address Line 01" type="text" />
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address Line 02</label>
                                    <input class="form-control" id="addline2" placeholder="Enter Your Address Line 02" type="text" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Province</label>
                                    <select class="form-select" disabled>
                                        <option>Select Your Province</option>

                                        <?php
                                        $pall = Database::search("SELECT * FROM `province`");
                                        $num1 = $pall->num_rows;

                                        for ($x = 1; $x <= $num1; $x++) {
                                            $row1 = $pall->fetch_assoc();

                                        ?>

                                            <option value="<?php echo $row1["id"] ?>"><?php echo $row1["name"] ?></option>

                                        <?php

                                        }

                                        ?>

                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">District</label>
                                    <select class="form-select" disabled>
                                        <option>Select Your District</option>

                                        <?php

                                        $pall = Database::search("SELECT * FROM `district`");
                                        $num1 = $pall->num_rows;

                                        for ($y = 0; $y <= $num1; $y++) {
                                            $row1 = $pall->fetch_assoc();
                                        ?>

                                            <option value="<?php echo $row1["id"] ?>"><?php echo $row1["name"] ?></option>

                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">City</label>
                                    <select class="form-select" id="usercity">
                                        <option>Select Your City</option>

                                        <?php

                                        $pall = Database::search("SELECT * FROM `city`");
                                        $num1 = $pall->num_rows;

                                        for ($z = 0; $z <= $num1; $z++) {
                                            $row1 = $pall->fetch_assoc();
                                        ?>

                                            <option value="<?php echo $row1["id"] ?>"><?php echo $row1["name"] ?></option>

                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>



                                <div class="mt-3 text-center">
                                    <button class="btn btn-primary" onclick="updateprofile();">Update Profile</button>
                                </div>

                            <?php
                            }
                            ?>

                        </div>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 py-5">
                        <div class="col-md-12">
                            <span class="header">User Rating</span>
                            <span class="fa fa-star fs-4 text-warning"></span>
                            <span class="fa fa-star fs-4 text-warning"></span>
                            <span class="fa fa-star fs-4 text-warning"></span>
                            <span class="fa fa-star fs-4 text-warning"></span>
                            <span class="fa fa-star fs-4 text-warning"></span>

                            <p>4.1average based on 254 reviews.</p>

                            <hr class="hr-break-1">

                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 side">
                                    <span class="">5 Star</span>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 60%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <span>150</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 side">
                                    <span class="">4 Star</span>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 45%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <span>63</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 side">
                                    <span class="">3 Star</span>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 20%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <span>15</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 side">
                                    <span class="">2 Star</span>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 10%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <span>6</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 side">
                                    <span class="">1 Star</span>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 30%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <span>20</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <?php

                require "footer.php";

                ?>

            </div>
        </div>

        <script src="script.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    </body>

    </html>

<?php

} else {

?>

    <script>
        window.location = "index.php"
    </script>

<?php

}

?>
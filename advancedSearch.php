<?php

require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Digital Market | Advanced Search</title>

    <link rel="icon" href="images/dm_logo.png">

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
</head>

<body style="background-color: #92e395">

    <div class="container-fluid">
        <div class="row">

            <?php
            require "header.php";
            ?>

            <hr class="hr-break-1">

            <div class="col-12 mt-3 mb-3 bg-dark">
                <div class="row">
                    <label class="text-white fw-bold fs-2 text-center mt-4 mb-2">Advanced Search</label>
                </div>
            </div>

            <div class="col-12 col-lg-11 mx-auto bg-dark mt-3 mb-3 rounded">
                <div class="row">

                    <div class="mx-auto col-12 col-lg-11">
                        <div class="row">

                            <div class="col-12 offset-lg-1 col-lg-7 mt-3 mb-2">
                                <input type="text" class="form-control fw-bold" id="s1" placeholder="Type keyword to search...">
                            </div>
                            <div class="col-12 col-lg-3 mt-3 mb-2 d-grid">
                                <button class="btn btn-primary search-btn1" onclick="advancedSearch(0);">Search</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <hr class="border border-primary border-3" />
                    </div>
                </div>

                <div class="offset-0 offset-lg-1 col-12 col-lg-10">
                    <div class="row">

                        <div class="col-12">
                            <div class="row">

                                <div class="col-12 col-lg-4 mb-3">
                                    <select class="form-select" id="ca1" onchange="advancedSearch(0);">
                                        <option value="0">Select Category</option>
                                        <?php
                                        $rs1 = Database::search("SELECT * FROM category");
                                        $n1 = $rs1->num_rows;

                                        for ($x = 0; $x < $n1; $x++) {
                                            $fa1 = $rs1->fetch_assoc();
                                        ?>

                                            <option value="<?php echo $fa1["id"]; ?>"><?php echo $fa1["name"]; ?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-12 col-lg-4 mb-3">
                                    <select class="form-select" id="br1" onchange="advancedSearch(0);">
                                        <option value="0">Select Brand</option>

                                        <?php
                                        $rs1 = Database::search("SELECT * FROM brand");
                                        $n1 = $rs1->num_rows;

                                        for ($x = 0; $x < $n1; $x++) {
                                            $fa1 = $rs1->fetch_assoc();
                                        ?>

                                            <option value="<?php echo $fa1["id"]; ?>"><?php echo $fa1["name"]; ?></option>

                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="col-12 col-lg-4 mb-3">
                                    <select class="form-select" id="mo1" onchange="advancedSearch(0);">
                                        <option value="0">Select Model</option>

                                        <?php
                                        $rs1 = Database::search("SELECT * FROM model");
                                        $n1 = $rs1->num_rows;

                                        for ($x = 0; $x < $n1; $x++) {
                                            $fa1 = $rs1->fetch_assoc();
                                        ?>

                                            <option value="<?php echo $fa1["id"]; ?>"><?php echo $fa1["name"]; ?></option>

                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-6 mb-3">
                                    <select class="form-select" id="co1" onchange="advancedSearch(0);">
                                        <option value="0">Select Condition</option>

                                        <?php
                                        $rs1 = Database::search("SELECT * FROM `condition`");
                                        $n1 = $rs1->num_rows;

                                        for ($x = 0; $x < $n1; $x++) {
                                            $fa1 = $rs1->fetch_assoc();
                                        ?>

                                            <option value="<?php echo $fa1["id"]; ?>"><?php echo $fa1["name"]; ?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <select class="form-select" id="col1" onchange="advancedSearch(0);">
                                        <option value="0">Select Colour</option>

                                        <?php
                                        $rs1 = Database::search("SELECT * FROM colour");
                                        $n1 = $rs1->num_rows;

                                        for ($x = 0; $x < $n1; $x++) {
                                            $fa1 = $rs1->fetch_assoc();
                                        ?>

                                            <option value="<?php echo $fa1["id"]; ?>"><?php echo $fa1["name"]; ?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-6 mb-3">
                                    <input type="text" class="form-control" placeholder="Price From" id="pf1" onkeyup="advancedSearch(0);" />
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <input type="text" class="form-control" placeholder="Price To" id="pt1" onkeyup="advancedSearch(0);" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 offset-lg-6 col-lg-6 mb-3">
                                    <select class="form-select border-0 border-bottom border-primary border-3" id="sort" onchange="advancedSearch(0);">
                                        <option value="0">SORT BY</option>
                                        <option value="1">PRICE LOW TO HIGH</option>
                                        <option value="2">PRICE HIGH TO LOW</option>
                                        <option value="3">QUANTITY LOW TO HIGH</option>
                                        <option value="4">QUANTITY HIGH TO LOW</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mx-auto col-lg-11 rounded bg-dark mb-3" id="results">
                <div class="row">
                    <div class="col-12 mx-auto col-lg-10 text-center">
                        <div class="row">

                            <div class="offset-5 col-2 mt-5">
                                <span class="text-white fw-bold h1"><i class="bi bi-search fs-1"></i></span>
                            </div>
                            <div class="offset-2 col-8 mt-3 mb-3">
                                <span class="h1 text-white">No Items Searched Yet.</span>
                            </div>

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

</body>

</html>
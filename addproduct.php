<?php
require "connection.php";
session_start();
if (isset($_SESSION["username"])) {

?>

    <!DOCTYPE html>

    <html>

    <head>
        <title>Digital Market | Add Product</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="images/dm_logo.png" />

        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="style.css">

    </head>

    <body>

        <div class="container-fluid">
            <div class="row gy-3">

                <div class="col-12">
                    <div class="col-12 mb-2">
                        <h3 class="h2 text-center text-success">Product Listing</h3>
                    </div>

                    <div class="col-lg-12">
                        <div class="row">

                            <span class="text-danger h5"></span>
                            <span class="text-danger h5"></span>

                            <div class="col-12 col-lg-4">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label lbl1">Select Product Category</label>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <select class="form-select" id="category">
                                            <option value="0">Select Category</option>
                                            <?php

                                            $rs = Database::search("SELECT * FROM `category`");
                                            $n = $rs->num_rows;
                                            for ($x = 0; $x < $n; $x++) {
                                                $d = $rs->fetch_assoc();

                                            ?>
                                                <option value="<?php echo $d["id"]; ?>"><?php echo $d["name"] ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label lbl1">Select Product Brand</label>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <select class="form-select" id="brand">
                                            <option value="0">Select Brand</option>
                                            <?php

                                            $rs = Database::search("SELECT * FROM `brand`");
                                            $n = $rs->num_rows;

                                            for ($x = 0; $x < $n; $x++) {
                                                $d = $rs->fetch_assoc();

                                            ?>
                                                <option value="<?php echo $d["id"]; ?>"><?php echo $d["name"] ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label lbl1">Select Product Model</label>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <select class="form-select" id="model">
                                            <option value="0">Select Model</option>
                                            <?php

                                            $rs = Database::search("SELECT * FROM `model`");
                                            $n = $rs->num_rows;

                                            for ($x = 0; $x < $n; $x++) {
                                                $d = $rs->fetch_assoc();

                                            ?>
                                                <option value="<?php echo $d["id"]; ?>"><?php echo $d["name"] ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr class="hr-break-1" />

                            <div class="col-12 mb-3">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label lbl1">Add a Title to Your Product</label>
                                    </div>
                                    <div class="offset-lg-2 col-12 col-lg-8">
                                        <input type="text" class="form-control" id="title" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="hr-break-1" />

                        <div class="col-12">
                            <div class="row">

                                <div class="col-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label lbl1">Select Product Condition</label>
                                        </div>

                                        <div class="offset-1 col-11 col-lg-3 ms-5 form-check">
                                            <input type="radio" class="form-check-input" name="flexRadioDefault" id="brandNew" checked />
                                            <label class="form-check-label" for="brandNew">
                                                Brandnew
                                            </label>
                                        </div>

                                        <div class="offset-1 col-11 col-lg-3 ms-5 form-check">
                                            <input type="radio" class="form-check-input" name="flexRadioDefault" id="used" />
                                            <label class="form-check-label" for="used">
                                                Used
                                            </label>
                                        </div>

                                        <div class="col-12 mt-5">
                                            <label class="form-label lbl1">Select Product Colour</label>
                                        </div>

                                        <div class="col-12">
                                            <div class="row">

                                                <div class="offset-1 offset-lg-0 col-5 col-lg-3 form-check">
                                                    <input class="form-check-input" type="radio" name="clrRadio" id="colour1" checked/>
                                                    <label class="form-check-label" for="colour1">
                                                        Gold
                                                    </label>
                                                </div>

                                                <div class="offset-1 offset-lg-0 col-5 col-lg-3 form-check">
                                                    <input class="form-check-input" type="radio" name="clrRadio" id="colour2" />
                                                    <label class="form-check-label" for="colour2">
                                                        Silver
                                                    </label>
                                                </div>

                                                <div class="offset-1 offset-lg-0 col-5 col-lg-3 form-check">
                                                    <input class="form-check-input" type="radio" name="clrRadio" id="colour3" />
                                                    <label class="form-check-label" for="colour3">
                                                        Graphite
                                                    </label>
                                                </div>

                                                <div class="offset-1 offset-lg-0 col-5 col-lg-3 form-check">
                                                    <input class="form-check-input" type="radio" name="clrRadio" id="colour4" />
                                                    <label class="form-check-label" for="colour4">
                                                        Pasific Blue
                                                    </label>
                                                </div>

                                                <div class="offset-1 offset-lg-0 col-5 col-lg-3 form-check">
                                                    <input class="form-check-input" type="radio" name="clrRadio" id="colour5" />
                                                    <label class="form-check-label" for="colour5">
                                                        Jac Black
                                                    </label>
                                                </div>

                                                <div class="offset-1 offset-lg-0 col-5 col-lg-3 form-check">
                                                    <input class="form-check-input" type="radio" name="clrRadio" id="colour6" />
                                                    <label class="form-check-label" for="colour6">
                                                        Rose Gold
                                                    </label>
                                                </div>

                                                <div class="offset-1 offset-lg-0 col-5 col-lg-3 form-check">
                                                    <input class="form-check-input" type="radio" name="clrRadio" id="colour7" />
                                                    <label class="form-check-label" for="colour7">
                                                        white
                                                    </label>
                                                </div>

                                                <div class="offset-1 offset-lg-0 col-5 col-lg-3 form-check">
                                                    <input class="form-check-input" type="radio" name="clrRadio" id="colour8" />
                                                    <label class="form-check-label" for="colour8">
                                                        Gray
                                                    </label>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="mt-5">
                                            <label class="form-label lbl1">Add Product Quantity</label>
                                            <input type="number" class="form-control" id="qty" value="0" min="0">
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="row">

                                        <div class="col-12"> 
                                            <label class="form-label lbl1">Add Product Image</label>
                                        </div>

                                        <div class="col-12 col-lg-12">
                                            <img src="images/addproductimg.svg" class="col-8 col-lg-4 ms-2 img-thumbnail" id="prev">
                                        </div>

                                        <div class="col-12 col-lg-8 mt-2 ms-4">
                                            <input type="file" class="d-none" accept="img/*" id="imageUploader" />
                                            <label for="imageUploader" class="col-8 col-lg-6 btn btn-primary" onclick="changeProductImg();">Upload</label>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <hr class="hr-break-1" />

                        <div class="col-12">
                            <div class="row">

                                <div class="col-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label lbl1">Cost Per Item</label>
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rs.</span>
                                            <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="cost">
                                            <span class="input-group-text">.00</span>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <label class="form-label lbl1">Approved Payment Methods</label>
                                            </div>

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="offset-2 col-2 pm1"></div>
                                                    <div class="col-2 pm2"></div>
                                                    <div class="col-2 pm3"></div>
                                                    <div class="col-2 pm4"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <hr class="hr-break-1" />

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label lbl1">Delivery Costs</label>
                                        </div>
                                        <div class="col-12 col-lg-3 offset-lg-1">
                                            <label class="form-label">Delivery Cost within Colombo</label>
                                        </div>

                                        <div class="col-12 col-lg-7">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Rs.</span>
                                                <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="dwc" />
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="row mt-lg-4">
                                        <div class="col-12"></div>

                                        <div class="col-12 col-lg-3 offset-lg-1 mt-lg-3">
                                            <label class="form-label">Delivery Cost outof Colombo</label>
                                        </div>

                                        <div class="col-12 col-lg-7 mt-lg-3">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Rs.</span>
                                                <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="doc" />
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="hr-break-1" />

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Product Description</label>
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control" cols="30" rows="20" id="desc"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <hr class="hr-break-1" />

                <div class="col-12">
                    <label class="form-label lbl1">Notice...</label>
                    <br />
                    <label class="form-label">We are taking 5% of the product from price from every
                        product as a service charge.</label>
                </div>

                <div class="col-12 col-lg-4 offset-lg-4 d-grid mb-2">
                    <button class="btn btn-success search-btn mt-1" onclick="addProduct();">Add product</button>
                </div>

                <?php

                require "footer.php";

                ?>

            </div>
        </div>

        <script src="script.js"></script>

    </body>

    </html>

<?php

} else {

?>
    <script>
        alert("You have Sing In or Register First");
        window.location = "index.php";
    </script>
<?php

}

?>
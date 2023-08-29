<!DOCTYPE html>

<html>

<head>
    <title>Digital Market | Single Product View</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="images/dm_logo.png" />

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />

</head>

<body class="main-body">

    <div class="container-fluid justify-content-center" style="margin-top: 45px;">
        <div class="row align-content-center">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 logo"></div>

                    <div class="col-12">
                        <p class="text-center title01">Hi, Welcome to New Teach Admins.</p>
                        <!-- <h1 class="text-center text-danger" style="font-family: ;">Hello</h1> -->
                    </div>
                </div>
            </div>

            <div class="col-12 p-5">
                <div class="row">

                    <div class="col-12 col-lg-6 offset-lg-3 d-block background">
                        <div class="row g-3">

                            <div class="col-12">
                                <p class="title02">Sign In To Your Account</p>
                                <span class="text-dark" id="msg"></span>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control shadow" id="e" />
                            </div>

                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control shadow" id="p" />
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary" onclick="adminSignIn();">Log In</button>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-danger" onclick="customerLogin();">Back to Customer to Log In</button>
                            </div>

                            <div class="mt-5"></div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 d-none d-lg-block fixed-bottom text-center">
                <p class="fw-bold text-black-50">&copy; 2022 Digital Market.lk All Rights Reserved.</p>
            </div>

        </div>
    </div>

    <script src="script.js"></script>

</body>
</html>
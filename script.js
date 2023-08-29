function changveiw() {
    var singInBox = document.getElementById("singInBox");
    var singUpBox = document.getElementById("singUpBox");

    singInBox.classList.toggle("d-none");
    singUpBox.classList.toggle("d-none");

}

function signUp() {

    var username = document.getElementById("username");
    var mobile = document.getElementById("mobile");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var gender = document.getElementById("gender");

    var r = new XMLHttpRequest();

    var form = new FormData();
    form.append("username", username.value);
    form.append("mobile", mobile.value);
    form.append("email", email.value);
    form.append("password", password.value);
    form.append("gender", gender.value);

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            // alert(text);
            if (text == "success") {
                username.value = "";
                mobile.value = "";
                email.value = "";
                password.value = "";
                document.getElementById("msg").innerHTML = "";
                changveiw();

            } else {

                document.getElementById("msg").innerHTML = text;

            }

        }
    };

    r.open("POST", "signUpProcess.php", true);
    r.send(form);

    // alert(username.value);
    // alert(mobile.value);
    // alert(email.value);
    // alert(password.value);
    // alert(gender.value);

}

function signIn() {

    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var remberMe = document.getElementById("remberMe");

    var r = new XMLHttpRequest();

    var form = new FormData();
    form.append("email", email.value);
    form.append("password", password.value);
    form.append("remberMe", remberMe.checked);

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            // alert(text);
            if (text == "OK") {

                window.location = "home.php";

            } else {

                document.getElementById("msg2").innerHTML = text;

            }

        }
    };

    r.open("POST", "signInProcess.php", true);
    r.send(form);

}

var bootstrapModal;

function forgotPassword() {

    var email = document.getElementById("email2");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);
            if (t == "Success") {

                alert("Verification Code Send to your Email. Please Check the inbox");
                var Window = document.getElementById("forgotPasswordWindow");
                bootstrapModal = new bootstrap.Modal(Window);
                bootstrapModal.show();

            } else {

                alert(t);

            }
        }
    };

    r.open("GET", "ForgotPasswordProcess.php?email=" + email.value, true);
    r.send();

}

function showPasswordNew() {
    // alert("ok")

    var newPassword = document.getElementById("newPassword");
    var newPasswordButton = document.getElementById("newPasswordButton");

    if (newPasswordButton.innerHTML == "Show") {

        newPassword.type = "text";
        newPasswordButton.innerHTML = "Hide";

    } else {

        newPassword.type = "password";
        newPasswordButton.innerHTML = "Show";

    }
}

function showPasswordComfirm() {
    // alert("ok")

    var repeatNewPassword = document.getElementById("repeatNewPassword");
    var repeatNewPasswordButton = document.getElementById("repeatNewPasswordButton");

    if (repeatNewPasswordButton.innerHTML == "Show") {

        repeatNewPassword.type = "text";
        repeatNewPasswordButton.innerHTML = "Hide";

    } else {

        repeatNewPassword.type = "password";
        repeatNewPasswordButton.innerHTML = "Show";

    }
}

function changePassword() {

    var email = document.getElementById("email2");
    var newPassword = document.getElementById("newPassword");
    var repeatNewPassword = document.getElementById("repeatNewPassword");
    var verificationCode = document.getElementById("verificationCode");

    var form = new FormData();
    form.append("email", email.value);
    form.append("newPassword", newPassword.value);
    form.append("repeatNewPassword", repeatNewPassword.value);
    form.append("verificationCode", verificationCode.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            // alert(text);
            if (text == "success") {
                alert("Password reset success");
                bootstrapModal.hide();
            } else {
                alert(text);
            }
        }
    };

    r.open("POST", "resetPassword.php", true);
    r.send(form);

}

function signOut() {

    // alert("ok");
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Success") {
                window.location = "home.php";
            }

        }
    };

    r.open("GET", "signOutProcess.php", true);
    r.send();

}

function changeProductImg() {

    var image = document.getElementById("imageUploader");
    var view = document.getElementById("prev");
    // var view2 = document.getElementById("prev2");

    image.onchange = function() {
        var file = this.files[0];

        var url = window.URL.createObjectURL(file);

        view.src = url;

    }
}



function addProduct() {

    // alert("ok");

    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");
    var title = document.getElementById("title");

    var condition = 0;

    if (document.getElementById("brandNew").checked) {
        condition = 1;
    } else if (document.getElementById("used").checked) {
        condition = 2;
    }

    var color = 0;

    if (document.getElementById("colour1").checked) {
        color = 1;
    } else if (document.getElementById("colour2").checked) {
        color = 2;
    } else if (document.getElementById("colour3").checked) {
        color = 3;
    } else if (document.getElementById("colour4").checked) {
        color = 4;
    } else if (document.getElementById("colour5").checked) {
        color = 5;
    } else if (document.getElementById("colour6").checked) {
        color = 6;
    } else if (document.getElementById("colour7").checked) {
        color = 7;
    } else if (document.getElementById("colour8").checked) {
        color = 8;
    }

    var qty = document.getElementById("qty");
    var image = document.getElementById("imageUploader");
    var price = document.getElementById("cost");
    var delivery_within_colombo = document.getElementById("dwc");
    var delivery_outof_colombo = document.getElementById("doc");
    var description = document.getElementById("desc");

    // alert(category);

    var f = new FormData();
    f.append("ca", category.value);
    f.append("br", brand.value);
    f.append("mo", model.value);
    f.append("ti", title.value);
    f.append("con", condition);
    f.append("col", color);
    f.append("qty", qty.value);
    f.append("img", image.files[0]);
    f.append("pri", price.value);
    f.append("dwc", delivery_within_colombo.value);
    f.append("doc", delivery_outof_colombo.value);
    f.append("desc", description.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            alert(text);

            if (text == "success") {
                window.location = "addproduct.php";
            } else {
                document.getElementById("msg").innerHTML = text;
            }
        }
    };

    r.open("POST", "addProductProcess.php", true);
    r.send(f);

}

function changeImg() {

    var image = document.getElementById("profileimg");
    var prev = document.getElementById("prev1");

    image.onchange = function() {

        var file0 = this.files[0];
        var url0 = window.URL.createObjectURL(file0);
        prev.src = url0;
    }

}

function updateprofile() {
    // var

    var name = document.getElementById("username");
    var mobile = document.getElementById("mobile");
    var addressline1 = document.getElementById("addline1");
    var addressline2 = document.getElementById("addline2");
    var city = document.getElementById("usercity");
    var image = document.getElementById("profileimg");

    var form = new FormData();
    form.append("u", name.value);
    form.append("m", mobile.value);
    form.append("a1", addressline1.value);
    form.append("a2", addressline2.value);
    form.append("c", city.value);
    form.append("i", image.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            alert(text);
        }
    }

    r.open("POST", "updateProfileProcess.php", true);
    r.send(form);

}

function b() {
    alert("on");
}

function basicSearch(x) {

    var searchText = document.getElementById("basic_search_txt").value;
    var searchSelect = document.getElementById("basic_search_select").value;

    var form = new FormData();
    form.append("st", searchText);
    form.append("ss", searchSelect);
    form.append("page", x);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("basicSearchResult").innerHTML = t;
            // alert(t);
        }
    };
    r.open("POST", "basicSearchProcess.php", true);
    r.send(form);

}

function sendId(id) {

    var id1 = id;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);
            if (t == "success") {
                window.location = "updateProduct.php";
            }
        }
    };
    r.open("GET", "sendProductProcess.php?id=" + id1, true);
    r.send();

}

function updateProduct() {

    // alert("ok");
    var title = document.getElementById("tit");
    var qty = document.getElementById("qty");
    var image = document.getElementById("imageUploader");
    var cost = document.getElementById("cost");
    var delivery_within_colombo = document.getElementById("dwc");
    var delivery_outof_colombo = document.getElementById("doc");
    var description = document.getElementById("desc");

    var form = new FormData();
    form.append("t", title.value);
    form.append("qty", qty.value);
    form.append("i", image.files[0]);
    form.append("c", cost.value);
    form.append("dwc", delivery_within_colombo.value);
    form.append("doc", delivery_outof_colombo.value);
    form.append("desc", description.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    };
    r.open("POST", "updateProcess.php", true);
    r.send(form);
}

function advancedSearch(x) {

    var searchtxt = document.getElementById("s1");
    var category = document.getElementById("ca1");
    var barnd = document.getElementById("br1");
    var model = document.getElementById("mo1");
    var condition = document.getElementById("co1");
    var colour = document.getElementById("col1");
    var priceFrom = document.getElementById("pf1");
    var priceTo = document.getElementById("pt1");
    var sort = document.getElementById("sort");

    var form = new FormData();
    form.append("page", x);
    form.append("s", searchtxt.value);
    form.append("ca", category.value);
    form.append("b", barnd.value);
    form.append("m", model.value);
    form.append("con", condition.value);
    form.append("col", colour.value);
    form.append("pf", priceFrom.value);
    form.append("pt", priceTo.value);
    form.append("sort", sort.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);
            document.getElementById("results").innerHTML = t;
        }
    }

    r.open("POST", "advancedSearchProcess.php", true);
    r.send(form);

}

function adminSignIn() {

    var email = document.getElementById("e");
    var password = document.getElementById("p");

    var r = new XMLHttpRequest();

    var form = new FormData();
    form.append("email", email.value);
    form.append("password", password.value);

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            // alert(text);
            if (text == "OK") {

                window.location = "adminPanal.php";

            } else {

                document.getElementById("msg").innerHTML = text;

            }

        }
    };

    r.open("POST", "adminprocess.php", true);
    r.send(form);

}

function customerLogin() {
    window.location = "index.php";
}

function productBlock(id) {
    alert(id);
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            window.location = "manageproducts.php";
        }
    };
    r.open("GET", "productBlockProcess.php?id=" + id, true);
    r.send();

}

function userBlock(email) {
    alert(email);
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            window.location = "manageusers.php";
        }
    };
    r.open("GET", "userBlockProcess.php?email=" + email, true);
    r.send();
}

function addToCart(id) {
    // alert(id);
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);
            if (t == "Please sign in first.") {
                alert(t);
                window.location = "index.php";
            } else {
                alert(t);
            }

        }
    }
    r.open("GET", "addToCartProcess.php?id=" + id, true);
    r.send();
}

function deleteFromCart(id) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);
            if (t == "success") {
                alert("Product removed from the cart successfully.");
                window.location = "cart.php";
            }
        }
    }
    r.open("GET", "removeCartProcess.php?id=" + id, true);
    r.send();
}

function addToWatchlist(id) {

    // alert(id);

    var wid = id;

    var icon = document.getElementById("heart");
    icon.style.color = "red";

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            window.location.reload();
            alert(t);
        }
    }

    r.open("GET", "addToWatchlistProcess.php?id=" + wid, true);
    r.send();
}

function deleteFromWatchlist(id) {

    var pid = id;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                alert("WatchList removed from successfully.");
                window.location = "watchlist.php";
            } else {
                alert(t);
            }
        }
    }
    r.open("GET", "deleteWatchlistProcess.php?id=" + pid, true);
    r.send();
}

function buyNow(id) {
    // alert("ok");
    var pid = id;
    var qut = document.getElementById("qtyinput");
    // alert(id);
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);
            if (t == "2") {
                alert("Invalid Product")
            } else if (t == "3") {
                // alert(t);
                alert("sign In First");
                window.location = "index.php";
            } else {

                // alert(t);
                var j = JSON.parse(t);
                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    setTimeout(buynowprocess(id), 100);
                    // alert("Payment completed. OrderID");
                    // Note: validate the payment and show success or failure page to the customer
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    alert("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    alert("Error");
                };
                // alert("ok");
                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1221420", // Replace your Merchant ID
                    "return_url": undefined, // Important
                    "cancel_url": undefined, // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": id,
                    "items": j.pn,
                    "amount": j.pp,
                    "currency": "LKR",
                    "first_name": j.un,
                    "last_name": "",
                    "email": j.ue,
                    "phone": j.um,
                    "address": "",
                    "city": "",
                    "country": "",
                    "delivery_address": "",
                    "delivery_city": "",
                    "delivery_country": "",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                payhere.startPayment(payment);


            }
        }
    }
    r.open("GET", "buyNow.php?id=" + pid + "&qty=" + qut.value, true);
    r.send();

}

function buynowprocess(id) {

    var id = id;
    var qty = document.getElementById("qtyinput");

    var f = new FormData();
    f.append("id", id);
    f.append("qty", qty.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            window.location = "invoice.php?order_id=" + t;
            // alert(t);
        }
    }
    r.open("GET", "buyNowProcess.php?id=" + id + "&qty=" + qty.value, true);
    r.send();

}

function saveFeed(id) {

    // alert("ok");

    var email = document.getElementById("e").value;
    var feedback = document.getElementById("f").value;

    var pid = id;

    var f = new FormData();
    f.append("e", email);
    f.append("f", feedback);
    f.append("i", pid);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "singleProductView.php?id=" + pid;
            }
            alert(t);
        }
    }
    r.open("POST", "saveFeedbackProcess.php", true);
    r.send(f);
}

function printInvoice() {

    var restorePage = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorePage;
}
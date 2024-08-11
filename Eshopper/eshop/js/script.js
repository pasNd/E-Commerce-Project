function signup() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var mobile = document.getElementById("mobile");
    var password = document.getElementById("password");

    var form = new FormData();
    form.append("f", fname.value);
    form.append("l", lname.value);
    form.append("e", email.value);
    form.append("m", mobile.value);
    form.append("p", password.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;

            if (response == "successfully registered.") {

                alert("Your Registration is Successfull.");

            } else {
                alert(response);

            }
        }
    }

    request.open("POST", "signUpProcess.php", true);
    request.send(form);
}

function showPassword() {
    var password = document.getElementById("password");
    var icon = document.getElementById("togglePassword");

    if (password.type === "password") {
        password.type = "text";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
    } else {
        password.type = "password";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
    }
}
function showPassword2() {
    var password = document.getElementById("password2");
    var icon = document.getElementById("togglePassword");

    if (password.type === "password") {
        password.type = "text";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
    } else {
        password.type = "password";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
    }

}
function signIn() {

    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var rememberme = document.getElementById("flexCheckDefault");

    var form = new FormData();
    form.append("e", email.value);
    form.append("p", password.value);
    form.append("r", rememberme.checked);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;

            if (response == "login success") {
                window.location = "index.php";
            } else {
                alert(response);
            }
        }
    }

    request.open("POST", "loginProcess.php", true);
    request.send(form);
}

function logout() {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "logOutProcess.php", true);
    request.send();


}

var forgotPasswordModal;

function forgotPassword() {

    var email = document.getElementById("email2");

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "success") {
                alert("The verification code has been sent successfully. Please check your email.");
                var loginBox = document.getElementById("loginBox");
                var forgotModal = document.getElementById("forgot-Modal");

                loginBox.classList.toggle("d-none");
                forgotModal.classList.toggle("d-none");
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
    request.send();

}

function showNewPassword() {
    var password = document.getElementById("passwordNew");
    var icon = document.getElementById("togglePassword");

    if (password.type === "password") {
        password.type = "text";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
    } else {
        password.type = "password";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
    }

}
function showConPassword() {
    var password2 = document.getElementById("passwordCon");
    var icon = document.getElementById("togglePasswordCon");

    if (password2.type === "password") {
        password2.type = "text";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
    } else {
        password2.type = "password";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
    }

}

function resetPassword() {

    var email = document.getElementById("email2");
    var verification = document.getElementById("vcode");
    var newPassword = document.getElementById("passwordNew");
    var conPassword = document.getElementById("passwordCon");

    var form = new FormData();

    form.append("e", email.value);
    form.append("v", verification.value);
    form.append("n", newPassword.value);
    form.append("c", conPassword.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                alert("Your password reset successfully.")
                window.location = "login.php"
            } else {
                alert(response);
                window.reload();
            }
        }
    }

    request.open("POST", "passwordResetProcess.php", true);
    request.send(form);
}

function changeProfileImg() {
    var img = document.getElementById("profileimage");

    img.onchange = function () {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);

        document.getElementById("img").src = url;
    }
}

function updateProfile() {

    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var province = document.getElementById("province");
    var district = document.getElementById("district");
    var city = document.getElementById("city");
    var pcode = document.getElementById("pcode");
    var image = document.getElementById("profileimage");

    var form = new FormData();

    form.append("f", fname.value);
    form.append("l", lname.value);
    form.append("m", mobile.value);
    form.append("l1", line1.value);
    form.append("l2", line2.value);
    form.append("p", province.value);
    form.append("d", district.value);
    form.append("c", city.value);
    form.append("pc", pcode.value);
    form.append("i", image.files[0]);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "updated" || response == "saved") {
                window.location.reload();
            } else if (response == "You have not selected any image.") {
                alert("You have not selected any image to update your profile.");
                window.location.reload();
            } else {
                alert(response);
            }

        }
    }

    request.open("POST", "updateProfileProcess.php", true);
    request.send(form);

}

function basicSearch(x) {


    var txt = document.getElementById("basic_search_txt");
    var select = document.getElementById("basic_search_select");


    var form = new FormData();
    form.append("t", txt.value);
    form.append("s", select.value);
    form.append("page", x);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            document.getElementById("basicSearchResult").innerHTML = response;

            document.getElementById("sort_header").classList.add("d-none");
            document.getElementById("hide1").classList.add("d-none");
            document.getElementById("hide2").classList.add("d-none");
            document.getElementById("hide3").classList.add("d-none");
            document.getElementById("hide4").classList.add("d-none");
            document.getElementById("hide5").classList.add("d-none");

        }

    }

    request.open("POST", "basicSearchProcess.php", true);
    request.send(form);
}

function catSearch(cid, x) {
    var form = new FormData();
    form.append("cid", cid);
    form.append("page", x);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            document.getElementById("basicSearchResult").innerHTML = response;

            document.getElementById("sort_header").classList.add("d-none");
            document.getElementById("hide1").classList.add("d-none");
            document.getElementById("hide2").classList.add("d-none");
            document.getElementById("hide3").classList.add("d-none");
            document.getElementById("hide4").classList.add("d-none");
            document.getElementById("hide5").classList.add("d-none");
            document.getElementById("hide6").classList.add("d-none");
        }
    }

    request.open("POST", "catSearchProcess.php", true);
    request.send(form);
}

function sort1(x) {

    var search = document.getElementById("s");
    var time = "0";

    if (document.getElementById("n").checked) {
        time = "1";
    } else if (document.getElementById("o").checked) {
        time = "2";
    }

    var qty = "0";

    if (document.getElementById("h").checked) {
        qty = "1";
    } else if (document.getElementById("l").checked) {
        qty = "2";
    }

    var condition = "0";

    if (document.getElementById("b").checked) {
        condition = "1";
    } else if (document.getElementById("u").checked) {
        condition = "2";
    }

    var form = new FormData();
    form.append("s", search.value);
    form.append("t", time);
    form.append("q", qty);
    form.append("c", condition);
    form.append("page", x);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            document.getElementById("sort").innerHTML = response;
        }
    }

    request.open("POST", "sortProcess.php", true);
    request.send(form);
}



function loadMainImg(id) {

    var sample_img = document.getElementById("productImg" + id).src;
    var main_img = document.getElementById("mainImg");

    main_img.src = sample_img;


}
function check_value(qty) {

    var input = document.getElementById("qty_input");

    if (input.value <= 0) {
        alert("Quantity should be one or more.");
    } else if (input.value > qty) {
        alert("Insufficent Quantity");
        input.value = qty;
    }

}
function qty_inc(qty) {
    var input = document.getElementById("qty_input");

    if (input.value < qty) {
        var newValue = parseInt(input.value) + 1;
        input.value = newValue;
    } else {
        alert("Maximum quantity has achieved.");
        input.value = qty;
    }
}

function qty_dec(qty) {
    var input = document.getElementById("qty_input");

    if (input.value > 1) {
        var newValue = parseInt(input.value) - 1;
        input.value = newValue;
    } else {
        alert("Minimum quantity has achieved.");
        input.value = 1;
    }
}

function addToWatchlist(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "added") {
                document.getElementById("heart" + id).style.className = "bi bi-suit-heart-fill";
                window.location.reload();
            } else if (response == "removed") {
                document.getElementById("heart" + id).style.className = "bi bi-suit-heart";
                window.location.reload();
            } else {
                alert(response);
            }

        }
    }

    request.open("GET", "addToWatchlistProcess.php?id=" + id, true);
    request.send();

}

function removeFromWatchlist(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "removeWatchlistProcess.php?id=" + id, true);
    request.send();

}


function addToCart(id) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            alert(response);
        }
    }

    request.open("GET", "addToCartProcess.php?id=" + id, true);
    request.send();

}
function deleteFromCart(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "Removed") {
                alert("Product removed from your cart.");
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "deleteFromCartProcess.php?id=" + id, true);
    request.send();

}

function changeQTY(id) {
    var qty = document.getElementById("qty_num").value;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "Updated") {
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "cartQtyUpdateProcess.php?qty=" + qty + "&id=" + id, true);
    request.send();

}

function payNow(pid) {

    var qty = document.getElementById("qty_input").value;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            var obj = JSON.parse(response);

            var mail = obj["umail"];
            var amount = obj["amount"];

            if (response == 1) {
                alert("Please Login and try again");
                window.location = "login.php";
            } else if (response == 2) {
                alert("Please update your profile.");
                window.location = "userProfile.php";
            } else {

                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);

                    alert("Your Payment is Successful.OrderID:" + orderId);
                    saveInvoice(orderId, pid, mail, amount, qty);

                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": obj["mid"],    // Replace your Merchant ID
                    "return_url": "http://localhost/Eshopper/eshop/singleProductView.php?id=" + pid,    // Important
                    "cancel_url": "http://localhost/Eshopper/eshop/singleProductView.php?id=" + pid,     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount + ".00",
                    "currency": "LKR",
                    "hash": obj["hash"], // *Replace with generated hash retrieved from backend
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function (e) {
                payhere.startPayment(payment);
                // };

            }

        }
    }

    request.open("GET", "buyNowProcess.php?id=" + pid + "&qty=" + qty, true);
    request.send();
}

function saveInvoice(orderId, pid, mail, amount, qty) {

    var form = new FormData();
    form.append("o", orderId);
    form.append("i", pid);
    form.append("m", mail);
    form.append("a", amount);
    form.append("q", qty);


    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "success") {
                alert("Download your receipt here.")
                window.location = "invoice.php?id=" + orderId;
            } else {
                alert(response);
            }
        }
    }

    request.open("POST", "saveInvoiceProcess.php", true);
    request.send(form);

}

function printInvoice() {

    var restorePage = document.body.innerHTML;
    var page = document.getElementById("invoice").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorePage;

}

function filterBy(x) {

    var category = document.getElementById("cat");
    var brand = document.getElementById("b");
    var color = document.getElementById("clr");
    var sort = document.getElementById("s");

    var form = new FormData();
    form.append("cat", category.value);
    form.append("b", brand.value);
    form.append("col", color.value);
    form.append("s", sort.value);
    form.append("page", x);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            document.getElementById("searchView").innerHTML = response;
        }
    }

    request.open("POST", "advancedSearchProcess.php", true);
    request.send(form)


}



<?php
include "connection.php";
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='copyright' content=''>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title Tag  -->
    <title>User Profile</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="images/logo-icon.png">
    <!-- Web Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <!-- StyleSheet -->

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="css/magnific-popup.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Fancybox -->
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <!-- Themify Icons -->
    <link rel="stylesheet" href="css/themify-icons.css">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="css/niceselect.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- Flex Slider CSS -->
    <link rel="stylesheet" href="css/flex-slider.min.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="css/owl-carousel.css">
    <!-- Slicknav -->
    <link rel="stylesheet" href="css/slicknav.min.css">

    <!-- Eshop StyleSheet -->
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Bootstrap icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="userprofile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="js">

    <!-- Preloader -->
    <!-- <div class="preloader">
		<div class="preloader-inner">
			<div class="preloader-icon">
				<span></span>
				<span></span>
			</div>
		</div>
	</div> -->
    <!-- End Preloader -->



    <!-- Header -->
    <header class="header shop loginHeader" id="loginHeader">
        <!-- Topbar -->
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-12">
                        <!-- Top Left -->
                        <?php
                        session_start();

                        if (isset($_SESSION["user"])) {
                            $data = $_SESSION["user"];

                        ?>
                            <div class="top-left">
                                <p>Hey <span style="color: #ff4157;"><?php echo $data["fname"]; ?></span></p>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="top-left">
                                <p><span style="color: #ff4157;"> TechTrove</span></p>
                            </div>
                        <?php
                        }
                        ?>

                        <!--/ End Top Left -->
                    </div>
                    <div class="col-lg-8 col-md-12 col-12">
                        <!-- Top Right -->
                        <div class="right-content">
                            <ul class="list-main">
                                <li><i class="ti-heart"></i> <a href="#">Wish-list</a></li>
                                <li><i class="ti-user"></i> <a href="#">My account</a></li>
                                <?php
                                if (isset($_SESSION["user"])) {
                                ?>
                                    <li><i class="ti-power-off"></i><a href="index.php" onclick="logOut();">Log out</a></li>

                                <?php

                                } else {
                                ?>
                                    <li><i class="ti-power-off"></i><a href="login.php">Login</a></li>
                                <?php
                                }

                                ?>

                            </ul>
                        </div>
                        <!-- End Top Right -->
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </header>
    <!--/ End Header -->
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="index.php">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="blog-single.html">Account settings</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start profile update -->
    <section class="shop checkout section">
        <div class="container mb-5">
            <?php

            if (isset($_SESSION["user"])) {

                $email = $_SESSION["user"]["email"];

                $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'");

                $img_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $email . "'");

                $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `district` ON district.district_id = user_has_address.district_district_id
                INNER JOIN province ON province.province_id = district.province_province_id WHERE 
                `user_email`='" . $email . "'");

                $user_data = $user_rs->fetch_assoc();
                $img_data = $img_rs->fetch_assoc();
                $address_data = $address_rs->fetch_assoc();

            ?>
                <div class="row">
                    <div class="col-lg-4 col-12">

                        <div class="border">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5">

                            <?php
                            if(empty($img_data["img_path"])) {
                                ?>
                                   <img src="AdminPanel/dist/resources/profile_images/new_user.png" class="rounded rounded-circle mt-5 " style="width: 150px;" id="img" />
                                <?php

                            }else{
                                ?>
                                    <img src="<?php echo $img_data["img_path"]; ?>" class="rounded mt-5 rounded-circle" width="220px" id="img" />
                                <?php
                            }
                            ?>

                                <p class="fw-bold mt-3"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></p>


                                <input type="file" class="d-none" id="profileimage" />
                                <label for="profileimage" class=" userPro-btn mt-3" onclick="changeProfileImg();">ulpoad</label>

                            </div>
                        </div>

                    </div>
                    <div class="col-lg-8 col-12">
                        <div class="checkout-form">
                            <h2>Make Your Profile Changes Here</h2>
                            <p>Ensure a smoother and quicker checkout process.</p>
                            <!-- Form -->
                            <form class="form" method="post" action="#">
                                <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>First Name<span>*</span></label>
                                            <input type="text" name="name" placeholder="" required="required" id="fname" value="<?php echo $user_data["fname"];?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Last Name<span>*</span></label>
                                            <input type="text" name="name" placeholder="" required="required" id="lname" value="<?php echo $user_data["lname"];?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Email Address<span>*</span></label>
                                            <input type="email" name="email" required="required" aria-label="Disabled input example" disabled readonly value="<?php echo $user_data["email"]; ?>" id="email">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Phone Number<span>*</span></label>
                                            <input type="text" name="number" placeholder="" required="required" aria-label="Disabled input example" value="<?php echo $user_data["mobile"];?>" id="mobile">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Registered Date<span>*</span></label>
                                            <input type="text" name="name" placeholder="" required="required" aria-label="Disabled input example" disabled readonly value="<?php echo $user_data["joined_date"];?>" id="joined_date">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12">
                                        <?php

                                        $province_rs = Database::search("SELECT * FROM `province`");
                                        $province_num = $province_rs->num_rows;

                                        ?>
                                        <div class="form-group">
                                            <label>Province<span>*</span></label>
                                            <select name="country_name" id="province">
                                                <option value="0">Select Your Province</option>
                                                <?php
                                                for ($x = 0; $x < $province_num; $x++) {
                                                    $province_data = $province_rs->fetch_assoc();

                                                ?>
                                                    <option value="<?php echo $province_data["province_id"]; ?>" <?php
                                                                                                                    if (!empty($address_data["province_id"])) {
                                                                                                                        if ($province_data["province_id"] == $address_data["province_id"]) {
                                                                                                                    ?> selected <?php
                                                                                                                            }
                                                                                                                        }
                                                                                                                                ?>>

                                                    <?php echo $province_data["province_name"]; ?> </option>
                                                <?php
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">

                                        <?php

                                        $district_rs = Database::search("SELECT * FROM `district` INNER JOIN `province` ON district.province_province_id = province.province_id");
                                        $district_num = $district_rs->num_rows;

                                        ?>
                                        <div class="form-group">
                                            <label>District<span>*</span></label>
                                            <select name="country_name" id="district">
                                                <option value="0">Select Your District</option>
                                                <?php
                                                for ($x = 0; $x < $district_num; $x++) {
                                                    $district_data = $district_rs->fetch_assoc();

                                                ?>
                                                    <option value="<?php echo $district_data["district_id"] ?>" <?php
                                                                                                                    if (!empty($address_data["district_id"])) {
                                                                                                                        if ($district_data["district_id"] == $address_data["district_id"]) {
                                                                                                                    ?> selected <?php
                                                                                                                            }
                                                                                                                        }
                                                                                                                                ?>>

                                                        <?php echo $district_data["district_name"]; ?> </option>
                                                <?php
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                                <?php
                                                $address_num = $address_rs->num_rows;
                                                ?>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <?php
                                        if ($address_num == 1){
                                            ?>
                                            <div class="form-group">
                                            <label>City<span>*</span></label>
                                            <input type="text" name="name" placeholder="" required="required" id="city" value="<?php echo $address_data["city"];?>">
                                        </div>
                                            <?php
                                        }else{
                                            ?>
                                            <div class="form-group">
                                            <label>City<span>*</span></label>
                                            <input type="text" name="name" placeholder="City" required="required" id="city">
                                        </div>
                                            <?php
                                        }
                                        ?>
                                        
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <?php
                                        if ($address_num == 1){
                                            ?>
                                             <div class="form-group">
                                            <label>Address Line 1<span>*</span></label>
                                            <input type="text" name="address" placeholder="" required="required" id="line1" value="<?php echo $address_data["line1"];?>">
                                        </div>
                                            <?php
                                        }else{
                                            ?>
                                             <div class="form-group">
                                            <label>Address Line 1<span>*</span></label>
                                            <input type="text" name="address" placeholder="Line1" required="required" id="line1">
                                        </div>
                                            <?php
                                        }
                                        ?>
                                       
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <?php
                                        if($address_num == 1){
                                            ?>
                                            <div class="form-group">
                                            <label>Address Line 2<span>*</span></label>
                                            <input type="text" name="address" placeholder="" required="required" id="line2" value="<?php echo $address_data["line2"];?>">
                                        </div>
                                            <?php
                                        }else{
                                            ?>
                                            <div class="form-group">
                                            <label>Address Line 2<span>*</span></label>
                                            <input type="text" name="address" placeholder="Line2" required="required" id="line2">
                                        </div>
                                            <?php
                                        }
                                        ?>
                                      
                                    </div>
                                    <div class="col-12">
                                        <?php
                                        if ($address_num == 1){
                                            ?>
                                             <div class="form-group">
                                            <label>Postal Code<span>*</span></label>
                                            <input type="text" name="post" placeholder="" required="required" id="pcode" value="<?php echo $address_data["postal_code"];?>">
                                        </div>
                                            <?php
                                        }else{
                                            ?>
                                             <div class="form-group">
                                            <label>Postal Code<span>*</span></label>
                                            <input type="text" name="post" placeholder="Postal Code" required="required" id="pcode">
                                        </div>
                                            <?php
                                        }
                                        ?>
                                       
                                    </div>

                                    <div class="col-12">
                                        <button for="profileimage" class=" userPro-btn col-12" style="width: 100%;" onclick="updateProfile();">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                            <!--/ End Form -->
                        </div>
                    </div>

                </div>
            <?php

            } else {
            ?>
                <script>
                    window.location = "login.php";
                </script>
            <?php
            }
            ?>

        </div>

        <?php
        include "footer.php";
        ?>
    </section>
    <!--/ End Checkout -->
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">

    </script>



    <!-- /start of Footer Area -->

    <!-- /End Footer Area -->

    <!-- Jquery -->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.0.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <!-- Popper JS -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Color JS -->
    <script src="js/colors.js"></script>
    <!-- Slicknav JS -->
    <script src="js/slicknav.min.js"></script>
    <!-- Owl Carousel JS -->
    <script src="js/owl-carousel.js"></script>
    <!-- Magnific Popup JS -->
    <script src="js/magnific-popup.js"></script>
    <!-- Fancybox JS -->
    <script src="js/facnybox.min.js"></script>
    <!-- Waypoints JS -->
    <script src="js/waypoints.min.js"></script>
    <!-- Jquery Counterup JS -->
    <script src="js/jquery-counterup.min.js"></script>
    <!-- Countdown JS -->
    <script src="js/finalcountdown.min.js"></script>
    <!-- Nice Select JS -->
    <script src="js/nicesellect.js"></script>
    <!-- Ytplayer JS -->
    <script src="js/ytplayer.min.js"></script>
    <!-- Flex Slider JS -->
    <script src="js/flex-slider.js"></script>
    <!-- ScrollUp JS -->
    <script src="js/scrollup.js"></script>
    <!-- Onepage Nav JS -->
    <script src="js/onepage-nav.min.js"></script>
    <!-- Easing JS -->
    <script src="js/easing.js"></script>
    <!-- Google Map JS -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnhgNBg6jrSuqhTeKKEFDWI0_5fZLx0vM"></script>
    <script src="js/gmap.min.js"></script>
    <script src="js/map-script.js"></script>
    <!-- Active JS -->
    <script src="js/active.js"></script>
    <!-- backend programming js -->
    <script src="js/script.js"></script>
</body>

</html>
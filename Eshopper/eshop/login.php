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
	<title>Eshop - eCommerce HTML5 Template.</title>
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

	<!-- Start login -->
	<section id="loginBox" class="contact-us section">
		<div class="container">
			<div class="contact-head">
				<div class="row justify-content-center">
					<div class="col-lg-8 col-12">
						<div class="form-main">
							<div class="title">
								<h3>Login</h3>
								<h4 class="mt-2">Let the shopping adventure begin!</h4>

							</div>
							<form class="form">
								<div class="row">
									<div class="col-12" id="msgdiv">
										<p class="err_mg d-block " style="color: #ff4157;" id="error_mg">

										</p>
									</div>

									<div class="col-lg-6 col-12">
										<div class="form-group">
											<label>Email Address<span>*</span></label>
											<input name="email" type="email" placeholder="exapmle@gmail.com" id="email2">
										</div>
									</div>
									<div class="col-lg-6 col-12">
										<div class="form-group position-relative">
											<label>Password<span>*</span></label>
											<input type="password" placeholder="Characters (5-20)" id="password2">
											<i class="bi bi-eye-slash" style="font-size: 18px;" id="togglePassword" onclick="showPassword2();"></i>
										</div>
									</div>
									<div class="col-12 d-flex justify-content-between">
										<div class="form-check ">
											<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
											<label class="form-check-label" for="flexCheckDefault">
												Remember me
											</label>
										</div>

										<a class="forgot" href="#" onclick="forgotPassword();">Forgot Password</a>
									</div>


									<div class="col-12 mt-3">
										<div class="form-group button">
											<button type="submit" class="btn col-12" onclick="signIn();">Login</button>
										</div>
									</div>
									<div class="col-12 mt-5">
										<p class="text-center">New to TechTrove <span style="color: #ff4157;"><a href="signUp.php">Register here</a></span></p>>
									</div>

								</div>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>
	<!--/ End login -->

	<!-- forgot password -->
	<section id="forgot-Modal" class="contact-us section d-none">
		<div class="container">
			<div class="contact-head">
				<div class="row justify-content-center">
					<div class="col-lg-6 col-12">
						<div class="form-main" style="border-top:solid #ff4157 9px;">
							<div class="title">
								<h3>Forgot Password ?</h3>
								<hr>
								<p>Check your email for a verification code. Enter the code to securely reset your password and enhance your account security.</p>

							</div>
							<form class="form">
								<div class="row">
									<div class="col-12" id="msgdiv">
										<p class="err_mg d-block " style="color: #ff4157;" id="error_mg">

										</p>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label>Verification code<span>*</span></label>
											<input type="text" id="vcode">
										</div>
									</div>
									<div class="col-lg-6 col-12">
										<div class="form-group position-relative">
											<label>New Password<span>*</span></label>
											<input type="password" placeholder="Characters (5-20)" id="passwordNew">
											<i class="bi bi-eye-slash" style="font-size: 18px;" id="togglePassword" onclick="showNewPassword();"></i>
										</div>
									</div>
									<div class="col-lg-6 col-12">
										<div class="form-group position-relative">
											<label>Confirm Password<span>*</span></label>
											<input type="password" placeholder="Characters (5-20)" id="passwordCon">
											<i class="bi bi-eye-slash" style="font-size: 18px;" id="togglePasswordCon" onclick="showConPassword();"></i>
										</div>
									</div>

									<div class="col-12 mt-3">
										<div class="form-group button">
											<button type="submit" class="btn login-btn col-12" onclick="resetPassword();">Reset Password</button>
										</div>
									</div>
									<div class="col-12 mt-5">
										<p class="text-center">Click here to<span style="color: #ff4157;"><a href="login.php"> go back</a></span></p>
									</div>

								</div>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>
	<!-- forgot password -->

	<!-- /start of Footer Area -->
	<?php
	include "footer.php";
	?>
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
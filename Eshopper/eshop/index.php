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
	<title>techTrove - Home Page</title>
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/logo-icon.png">
	<!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

	<!-- StyleSheet -->

	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.css">
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
	<header class="header shop">
		<!-- Topbar -->
		<?php

		include "header.php";


		?>
		<!-- End Topbar -->
		<div class="middle-inner">
			<div class="container">
				<div class="row">
					<?php
					include "basicsearchPart.php";
					?>
				</div>
			</div>
		</div>
		<!-- Header Inner -->
		<div class="header-inner" id="sort_header">
			<div class="container">
				<div class="cat-nav-head">
					<div class="row">
						<div class="col-lg-3">
							<div class="all-category">
								<h3 class="cat-heading"><i class="fa fa-bars" aria-hidden="true"></i>CATEGORIES</h3>
								<ul class="main-category">
									<li class="main-mega"><a href="#">New Arrivals<i class="fa fa-angle-right" aria-hidden="true"></i></a>

										<ul class="mega-menu">

											<?php

											$product_rs = Database::search("SELECT * FROM `product` ORDER BY product.product_id DESC LIMIT 3
											OFFSET 0");

											$product_num = $product_rs->num_rows;


											for ($x = 0; $x < $product_num; $x++) {

												$product_data = $product_rs->fetch_assoc();

												$product_id = $product_data["product_id"];

												$img_rs = Database::search("SELECT * FROM `product` INNER JOIN product_img ON product.product_id = product_img.product_product_id
												WHERE `product_id` = '" . $product_id . "'");

												$img_data = $img_rs->fetch_assoc();


											?>
												<li class="single-menu">
													<p href="#" class="title-link"><?php echo $product_data["title"]; ?></p>
													<div class="image m-5 d-flex justify-content-center">
														<img src="<?php echo $img_data["img_path"]; ?>" alt="#">
													</div>
												</li>
											<?php
											}
											?>

										</ul>
									</li>
									<?php
									$category_rs = Database::search("SELECT * FROM `category`");
									$category_num = $category_rs->num_rows;

									for ($x = 0; $x < $category_num; $x++) {
										$category_data = $category_rs->fetch_assoc();
									?>
										<li onclick='catSearch(<?php echo $category_data["cat_id"]; ?>,0);'><a href="#" id="<?php echo $category_data["cat_id"]; ?>" value="<?php echo $category_data["cat_id"]; ?>"><?php echo $category_data["cat_name"]; ?> </a></li>

									<?php
									}
									?>
								</ul>
							</div>
						</div>
						<div class="col-lg-9 col-12">
							<div class="menu-area">
								<!-- Main Menu -->
								<nav class="navbar navbar-expand-lg">
									<div class="navbar-collapse">
										<div class="nav-inner">
											<ul class="nav main-menu menu navbar-nav">
												<li class="active"><a href="#">Home</a></li>
												<li><a href="products.php">Products</a></li>
												<li><a href="wishlist.php">Wishlist</a></li>
												<li><a href="addToCart.php">Shopping Cart</a></li>
												<li><a href="#">About Us</a></li>
											</ul>
										</div>
									</div>
								</nav>
								<!--/ End Main Menu -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Header Inner -->
	</header>
	<!--/ End Header -->
	<section id="basicSearchResult">

	</section>
	<!-- Slider Area -->
	<section class="hero-slider mt-4" id="hide1">

		<!-- Single Slider -->
		<?php

		$banner_rs = Database::search("SELECT * FROM `main_banner` ORDER BY main_banner.date_time_added DESC LIMIT 1 ");
		$banner_num = $banner_rs->num_rows;
		$banner_data = $banner_rs->fetch_assoc();

		?>
		<?php

		?>
		<div class="single-slider d-none d-lg-block w-100" style="background-image:url('<?php echo $banner_data["img_path"]; ?>');">

		</div>
		<div class="single-slider d-block d-lg-none" style="background-image:url('banners/bannermobile.png');">

		</div>

		<!--/ End Single Slider -->

	</section>
	<!--/ End Slider Area -->

	<!-- Start Small Banner  -->
	<section class="small-banner section" id="hide2">
		<div class="container-fluid">

			<div class="row">
				<?php

				$collection_rs = Database::search("SELECT * FROM `collections` INNER JOIN `category` ON category.cat_id= collections.category_cat_id
				ORDER BY collections.date_time_added DESC LIMIT 3 OFFSET 0");
				$collection_num = $collection_rs->num_rows;

				for ($x = 0; $x < $collection_num; $x++) {
					$collection_data = $collection_rs->fetch_assoc();
					$category_data = $collection_data
				?>
					<!-- Single Banner  -->
					<div class="col-lg-4 col-md-6 col-12">
						<div class="single-banner">
							<img src="<?php echo $category_data["img_path"]; ?>" width="600px" height="270px">
							<div class="content">
								<h3><?php echo $category_data["cat_name"]; ?><br> collection</h3>
								<a onclick='catSearch(<?php echo $category_data["cat_id"]; ?>,0);' style="cursor: pointer;">Discover Now</a>
							</div>
						</div>
					</div>
					<!-- /End Single Banner  -->
				<?php
				}
				?>

			</div>
		</div>
	</section>
	<!-- End Small Banner -->

	<!-- Start Product Area -->
	<div class="product-area section" id="hide3">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>New Arrivals</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="product-info">

						<div class="nav-main">
							<ul class="nav nav-tabs" id="myTab" role="tablist">

								<?php

								$newarrival_rs = Database::search("SELECT * FROM `product` ORDER BY product.datetime_added DESC
														LIMIT 4 OFFSET 0 ");
								$newarrival_num = $newarrival_rs->num_rows;

								for ($x = 0; $x < $newarrival_num; $x++) {
									$newarrival_data = $newarrival_rs->fetch_assoc();
									$product_id2 = $newarrival_data["product_id"];

									$cat_rs = Database::search("SELECT * FROM `product` INNER JOIN category ON product.category_cat_id = category.cat_id
									WHERE `product_id` = '" . $product_id2 . "'");

									$cat_data = $cat_rs->fetch_assoc();

								?>
									<!-- Tab Nav -->
									<li value="" class="nav-item mb-4"><a class="nav-link active" data-toggle="tab" href="#man" role="tab"><?php echo $cat_data["cat_name"]; ?></a></li>
									<!--/ End Tab Nav -->
								<?php

								}

								?>
							</ul>
						</div>
						<div class="tab-content" id="myTabContent">
							<!-- Start Single Tab -->
							<div class="tab-pane fade show active" id="man" role="tabpanel">
								<div class="tab-single">
									<div class="row">

										<?php

										$newarrival_rs = Database::search("SELECT DISTINCT product.product_id, product.datetime_added
										FROM `product`
										INNER JOIN `product_img` ON product.product_id = product_img.product_product_id
										INNER JOIN `category` ON product.category_cat_id = category.cat_id
										ORDER BY product.datetime_added DESC
										LIMIT 8 OFFSET 0");

										$newarrival_num = $newarrival_rs->num_rows;

										for ($x = 0; $x < $newarrival_num; $x++) {
											$newarrival_data = $newarrival_rs->fetch_assoc();

											$newpro_id = $newarrival_data["product_id"];

											$nimg_rs = Database::search("SELECT * FROM `product` INNER JOIN product_img ON product.product_id = product_img.product_product_id
												WHERE `product_id` = '" . $newpro_id . "'");

											$nimg_data = $nimg_rs->fetch_assoc();

										?>
											<!-- product-->
											<div class="col-xl-3 col-lg-4 col-md-4 col-12">
												<div class="single-product border m-3">
													<div class="product-img ">
														<div class="justify-content-center m-4">
															<a href='<?php echo "singleProductView.php?id=" . ($newarrival_data["product_id"]); ?>'>
																<img class="default-img" src="<?php echo $nimg_data["img_path"]; ?>" alt="#">
																<img class="hover-img" src="<?php echo $nimg_data["img_path"]; ?>" alt="#">
															</a>
														</div>

														<div class="button-head">
															<div class="product-action m-2">

																<?php
																if (isset($_SESSION["user"])) {

																	$watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $_SESSION["user"]["email"] . "' 
                                                            											AND `product_product_id`='" . $newpro_id . "'");
																	$watchlist_num = $watchlist_rs->num_rows;

																	if ($watchlist_num == 1) {
																?>
																		<a title="Wishlist"><i class="bi bi-suit-heart-fill" id="heart<?php echo  $newarrival_data["product_id"]; ?>" onclick='addToWatchlist(<?php echo $newarrival_data["product_id"]; ?>);'></i><span>Already Added</span></a>

																	<?php
																	} else {
																	?>
																		<a title="Wishlist"><i class="bi bi-suit-heart" id="heart<?php echo  $newarrival_data["product_id"]; ?>" onclick='addToWatchlist(<?php echo $newarrival_data["product_id"]; ?>);'></i><span>Add to Wishlist</span></a>
																	<?php
																	}
																} else {
																	?>
																	<a href="login.php" title="Wishlist"><i class="bi bi-suit-heart"></i><span>Add to wishlist</span></a>
																<?php

																}


																?>

																<a onclick='addToCart(<?php echo $newarrival_data["product_id"]; ?>);' title="Cart" href="#"><i class="ti-shopping-cart"></i><span>Add to Cart</span></a>
															</div>

															<?php
															$stock_rs = Database::search("SELECT * FROM `product` WHERE `product_id` = '" . $newpro_id . "'");
															$stock_data = $stock_rs->fetch_assoc();

															?>
															<div class="product-action-2 m-2">
																<?php
																if ($stock_data["qty"] == 0) {
																?>
																	<a class="text-success" title="Out stock" href="#">Out Stock</a>
																<?php
																} else {
																?>
																	<a title="By now" href='<?php echo "singleProductView.php?id=" . ($newarrival_data["product_id"]); ?>'>Buy Now</a>
																<?php
																}
																?>

															</div>
														</div>
													</div>
													<div class="product-content m-2">
														<div class="product-price">
															<span class="text-danger">Rs.<?php echo $nimg_data["price"]; ?>.00</span>
														</div>
														<p><?php $nimg_data["title"]; ?></p>
													</div>
												</div>
											</div>
											<!--/ product -->
										<?php

										}

										?>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" style="margin-top: 80px;">
		<div class="carousel-inner">
			<div class="carousel-item active">
			<img src="AdminPanel/dist/resources/banner_1704425013843a4d42330d97624d785c0f6e5c085e.jpeg" class="d-block w-100" alt="...">
			</div>
			<div class="carousel-item">
			<img src="AdminPanel/dist/resources/banner_1715216332201510cd3cff0239d11b14bc49e60688.jpeg" class="d-block w-100" alt="...">
			</div>
			<div class="carousel-item">
			<img src="AdminPanel/dist/resources/banner_1715836681c2953dc3d6c853aebcacd9d1e349e61d.jpeg" class="d-block w-100" alt="...">
			</div>
		</div>
	</div>

	</div>
	<!-- End Product Area -->
	<!-- Start Most Popular -->
	<div class="product-area most-popular section" id="hide4" style="padding-top: 0px;">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>Our Best Brands</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="owl-carousel popular-slider">
						<!-- Start Single Product -->
						<div class="single-product">
							<div class="product-img">
								<a href="product-details.html">
									<img class="default-img" src="AdminPanel/dist/resources/msi.png" alt="#">
									<img class="hover-img" src="AdminPanel/dist/resources/msi.png" alt="#">
								</a>
							</div>
						</div>
						<!-- End Single Product -->
						<!-- Start Single Product -->
						<div class="single-product">
							<div class="product-img">
								<a href="product-details.html">
									<img class="default-img" src="AdminPanel/dist/resources/apple.png" alt="#">
									<img class="hover-img" src="AdminPanel/dist/resources/apple.png" alt="#">
								</a>
							</div>
						</div>
						<!-- End Single Product -->
						<!-- Start Single Product -->
						<div class="single-product">
							<div class="product-img">
								<a href="product-details.html">
									<img class="default-img" src="AdminPanel/dist/resources/Asus.png" alt="#">
									<img class="hover-img" src="AdminPanel/dist/resources/Asus.png" alt="#">
								</a>
							</div>
						</div>
						<!-- End Single Product -->
						<!-- Start Single Product -->
						<div class="single-product">
							<div class="product-img">
								<a href="product-details.html">
									<img class="default-img" src="AdminPanel/dist/resources/samsung.png" alt="#">
									<img class="hover-img" src="AdminPanel/dist/resources/samsung.png" alt="#">
								</a>
							</div>
						</div>
						<!-- End Single Product -->
						<!-- Start Single Product -->
						<div class="single-product">
							<div class="product-img">
								<a href="product-details.html">
									<img class="default-img" src="AdminPanel/dist/resources/dgi.png" alt="#">
									<img class="hover-img" src="AdminPanel/dist/resources/dgi.png" alt="#">
								</a>
							</div>
						</div>
						<!-- End Single Product -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Most Popular Area -->


	<!-- Start Shop Services Area -->
	<section class="shop-services section home">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-rocket"></i>
						<h4>Free dilivery</h4>
						<p>Orders over Rs.100000</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-reload"></i>
						<h4>Free Return</h4>
						<p>Within 15 days returns</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-lock"></i>
						<h4>Sucure Payment</h4>
						<p>100% secure payment</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-tag"></i>
						<h4>Best Peice</h4>
						<p>Guaranteed price</p>
					</div>
					<!-- End Single Service -->
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Services Area -->



	<!-- Start Footer Area -->
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
	<!-- Waypoints JS -->
	<script src="js/waypoints.min.js"></script>
	<!-- Countdown JS -->
	<script src="js/finalcountdown.min.js"></script>
	<!-- Nice Select JS -->
	<script src="js/nicesellect.js"></script>
	<!-- Flex Slider JS -->
	<script src="js/flex-slider.js"></script>
	<!-- ScrollUp JS -->
	<script src="js/scrollup.js"></script>
	<!-- Onepage Nav JS -->
	<script src="js/onepage-nav.min.js"></script>
	<!-- Easing JS -->
	<script src="js/easing.js"></script>
	<!-- Active JS -->
	<script src="js/active.js"></script>
	<!-- backend programming js -->
	<script src="js/script.js"></script>
	<script src="js/bootstrap.bundle.js"></script>
</body>

</html>
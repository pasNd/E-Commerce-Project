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
	<title>TechTrove - Products Page</title>
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/logo-icon.png">
	<!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

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
	<!-- Jquery Ui -->
	<link rel="stylesheet" href="css/jquery-ui.css">
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

		<!--/ End Header Inner -->
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
							<li class="active"><a href="blog-single.html">Products</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->

	<!-- Product Style -->
	<section class="product-area shop-sidebar shop section ">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-4 col-12">
					<div class="shop-sidebar">
						<!-- Single Widget -->
						<div class="single-widget category">
							<h3 class="title">Categories</h3>
							<ul class="categor-list">

								<?php
								$category_rs = Database::search("SELECT * FROM `category`");
								$category_num = $category_rs->num_rows;

								for ($x = 0; $x < $category_num; $x++) {
									$category_data = $category_rs->fetch_assoc();
								?>
									<li value="<?php echo $category_data["cat_id"]; ?>"><a href=""><?php echo $category_data["cat_name"]; ?></a></li>
								<?php
								}
								?>

							</ul>
						</div>
						<!--/ End Single Widget -->
						<!-- Shop By Price -->
						<div class="single-widget range">
							<h3 class="title">Shop by Price</h3>
							<div class="price-filter">
								<div class="price-filter-inner">
									<div id="slider-range"></div>
									<div class="price_slider_amount">
										<div class="label-input">
											<span>Range:</span><input type="text" id="amount" name="price" placeholder="Add Your Price" />
										</div>
									</div>
								</div>
							</div>
							<ul class="check-box-list">
								<li>
									<label class="checkbox-inline" for="1"><input name="news" id="1" type="checkbox">$20 - $50<span class="count">(3)</span></label>
								</li>
								<li>
									<label class="checkbox-inline" for="2"><input name="news" id="2" type="checkbox">$50 - $100<span class="count">(5)</span></label>
								</li>
								<li>
									<label class="checkbox-inline" for="3"><input name="news" id="3" type="checkbox">$100 - $250<span class="count">(8)</span></label>
								</li>
							</ul>
						</div>
						<!--/ End Shop By Price -->
						<!-- Single Widget -->
						<div class="single-widget category">
							<h3 class="title">Manufacturers</h3>
							<ul class="categor-list">

								<?php

								$brand_rs = Database::search("SELECT * FROM `brand` ");
								$brand_num = $brand_rs->num_rows;

								for ($x = 0; $x < $brand_num; $x++) {
									$brand_data = $brand_rs->fetch_assoc();

								?>
									<li> <a class="dropdown-item" value="<?php echo $brand_data["brand_id"]; ?>">
											<?php echo $brand_data["brand_name"]; ?></a>
									</li>

								<?php
								}

								?>
							</ul>
						</div>
						<!--/ End Single Widget -->
					</div>
				</div>
				<div class="col-lg-9 col-md-8 col-12">
					<div class="row">
						<div class="col-12">
							<!-- Shop Top -->
							<div class="shop-top">
								<div class="shop-shorter">
									<div class="single-shorter">
										<label>Show :</label>
										<select>
											<option selected="selected">Newest</option>
											<option>Oldest</option>
										</select>
									</div>
									<div class="single-shorter">
										<label>Sort By :</label>
										<select>
											<option selected="selected"></option>

											<?php

											$brand_rs = Database::search("SELECT * FROM `brand` ");
											$brand_num = $brand_rs->num_rows;

											for ($x = 0; $x < $brand_num; $x++) {
												$brand_data = $brand_rs->fetch_assoc();

											?>
												<option value="<?php echo $brand_data["brand_id"]; ?>">
													<?php echo $brand_data["brand_name"]; ?>
												</option>

											<?php
											}

											?>
										</select>
									</div>
								</div>

							</div>
							<!--/ End Shop Top -->
						</div>
					</div>
					<div class="row" id="productList">

						<?php

						$product_rs = Database::search("SELECT * FROM `product` ORDER BY product.product_id DESC");

						$product_num = $product_rs->num_rows;

						for ($x = 0; $x < $product_num; $x++) {
							$product_data = $product_rs->fetch_assoc();

							$product_id = $product_data["product_id"];

							$img_rs = Database::search("SELECT * FROM `product` INNER JOIN product_img ON product.product_id = product_img.product_product_id
												WHERE `product_id` = '" . $product_id . "'");

							$img_data = $img_rs->fetch_assoc();

						?>

							<div class="col-lg-4 col-md-6 col-12">
								<div class="d-flex justify-content-center m-3">
									<div class="single-product border m-1">
										<div class="product-img" >
											<div class="justify-content-center m-4">
												<a href="product-details.html">
													<img class="default-img" src="<?php echo ($img_data["img_path"]); ?>" alt="#">
													<img class="hover-img" src="<?php echo ($img_data["img_path"]); ?>" alt="#">
												</a>
											</div>

											<div class="button-head">
												<div class="product-action m-2">
													<!-- <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a> -->
													<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
													<a title="cart" href="#"><i class="ti-shopping-cart"></i><span>Add to cart</span></a>
												</div>
												<div class="product-action-2 m-2">
													<a title="Buy Now" href="#">Buy Now</a>
												</div>
											</div>
										</div>
										<div class="product-content m-2">
											<h3><a href="product-details.html"><?php echo ($product_data["title"]); ?></a></h3>
											<div class="product-price">
												<span class="text-danger">Rs. <?php echo ($product_data["price"]); ?></span>
											</div>
										</div>
									</div>
								</div>
							</div>


						<?php
						}

						?>

					</div>

					<nav aria-label="Page navigation example">
						<ul class="pagination">
							<li class="page-item"><a class="page-link" href="#">Previous</a></li>
							<li class="page-item"><a class="page-link" href="#">1</a></li>
							<li class="page-item active"><a class="page-link" href="#">2</a></li>
							<li class="page-item"><a class="page-link" href="#">3</a></li>
							<li class="page-item"><a class="page-link" href="#">Next</a></li>
						</ul>
					</nav>
				</div>


			</div>
	</section>
	<section>

	</section>

	<!--/ End Product Style 1  -->

	<!-- Start Shop Newsletter  -->
	<section class="shop-newsletter section">
		<div class="container">
			<div class="inner-top">
				<div class="row">
					<div class="col-lg-8 offset-lg-2 col-12">
						<!-- Start Newsletter Inner -->
						<div class="inner">
							<h4>Newsletter</h4>
							<p> Subscribe to our newsletter and get <span>10%</span> off your first purchase</p>
							<form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
								<input name="EMAIL" placeholder="Your email address" required="" type="email">
								<button class="btn">Subscribe</button>
							</form>
						</div>
						<!-- End Newsletter Inner -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Newsletter -->


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
	<!-- Fancybox JS -->
	<script src="js/facnybox.min.js"></script>
	<!-- Waypoints JS -->
	<script src="js/waypoints.min.js"></script>
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
	<!-- Active JS -->
	<script src="js/active.js"></script>
	<!-- backend programming js -->
	<script src="js/script.js"></script>
</body>

</html>
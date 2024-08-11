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
		<div class="header-inner">
			<div class="container">
				<div class="cat-nav-head">
					<div class="row">
						<div class="col-12">
							<div class="menu-area">
								<!-- Main Menu -->
								<nav class="navbar navbar-expand-lg">
									<div class="navbar-collapse">
										<div class="nav-inner">
											<ul class="nav main-menu menu navbar-nav">
												<li ><a href="index.php">Home</a></li>
												<li class="active"><a href="products.php">Products</a></li>
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

	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="index.php">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="products.php">Products</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->

	<!-- Product Style -->
	<section class="product-area shop-sidebar shop section" id="searchView">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-4 col-12 ">
					<div class="shop-sidebar">
						<style>
							.single-widget.range {
								text-align: center;
							}

							.select-container {
								display: inline-block;
								text-align: left;
							}

							select {
								width: 100%;
							}
						</style>

						<div class="single-widget range mt-0">
							<h3 class="title">Categories</h3>
							<div class="select-container">
								<select id="cat">
									<option value="0" selected="selected">Select Category</option>
									<?php
									$category_rs = Database::search("SELECT * FROM `category`");
									$category_num = $category_rs->num_rows;

									for ($x = 0; $x < $category_num; $x++) {
										$category_data = $category_rs->fetch_assoc();
									?>
										<option value="<?php echo $category_data["cat_id"]; ?>">
											<?php echo $category_data["cat_name"]; ?>
										</option>
									<?php
									}
									?>
								</select>
							</div>
						</div>

						<div class="single-widget range">
							<h3 class="title">Brands</h3>
							<div class="select-container">
								<select id="b">
									<option class="" value="0" selected="selected">Select Brand</option>
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

						<div class="single-widget range">
							<h3 class="title">Colours</h3>
							<div class="select-container">
								<select id="clr">
									<option class="" value="0" selected="selected">Select Colour</option>

									<?php
									$clr_rs = Database::search("SELECT * FROM `color`");
									$clr_num = $clr_rs->num_rows;

									for ($x = 0; $x < $clr_num; $x++) {
										$clr_data = $clr_rs->fetch_assoc();
									?>
										<option value="<?php echo $clr_data["clr_id"]; ?>">
											<?php echo $clr_data["name"]; ?>
										</option>

									<?php
									}
									?>
								</select>
							</div>
						</div>

						<div class="single-widget range">
							<h3 class="title">Sort By</h3>
							<div class="select-container">
								<select id="s">
									<option class="" value="1" selected="selected">Price High to Low</option>
									<option value="2">
										Price Low to High
									</option>
									<option value="3">
										Quantity High to Low
									</option>
									<option value="4">
										Quantity Low to High
									</option>
								</select>
							</div>
						</div>


						<div class="mt-5">
							<button style="height: 68px;" class="col-12 btn btn-danger fs-6" onclick="filterBy(0);"> Filter</button>
						</div>
					</div>
				</div>
				<div class="col-lg-9 col-md-8 col-12">
					<div class="row ">

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
									<div class="single-product border border-light m-1">
										<div class="product-img">
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
											<h3><a href="#"><?php echo ($product_data["title"]); ?></a></h3>
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


					<!-- <section class="mb-5">
						<style>
							.pagination {
								display: flex;
								justify-content: center;
							}

							.pagination .page-item {
								list-style: none;
								margin: 0 5px;
								color: #ff4157;
							}
						</style>

						<div aria-label="Page navigation example">
							<ul class="pagination">
								<li class="page-item">
									<a class="page-link" href="#" aria-label="Previous">
										<span aria-hidden="true">&laquo;</span>
									</a>
								</li>
								<li class="page-item"><a class="page-link" href="#">1</a></li>
								<li class="page-item"><a class="page-link" href="#">2</a></li>
								<li class="page-item"><a class="page-link" href="#">3</a></li>
								<li class="page-item">
									<a class="page-link" href="#" aria-label="Next">
										<span aria-hidden="true">&raquo;</span>
									</a>
								</li>
							</ul>
						</div>
					</section> -->


				</div>
			</div>

	</section>

	<!--/ End Product Style 1  -->


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
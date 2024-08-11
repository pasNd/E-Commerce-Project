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
	<title>techTrove - Shopping Cart </title>
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
												<li><a href="index.php">Home</a></li>
												<li><a href="products.php">Products</a></li>
												<li><a href="wishlist.php">Wishlist</a></li>
												<li class="active"><a href="addToCart.php">Shopping Cart</a></li>
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
							<li class="active"><a href="addToCart.php">Shopping-cart</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->

	<?php

	if (isset($_SESSION["user"])) {
		$user = $_SESSION["user"]["email"];

		$total = 0;
		$subtotal = 0;
		$dilivery = 0;

		$cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $user . "' ORDER BY `cart_id` DESC ");
		$cart_num = $cart_rs->num_rows;

		if ($cart_num == 0) {

	?>
			<!-- Empty Shopping Cart -->
			<div class="shopping-cart section" style="background-color: white;">
				<div class="container">
					<div class="row  justify-content-center d-flex">
						<div class="col-8 col-lg-12 text-center">
							<h5 class="text-center mb-4">Your Cart is Currently <span class="text-danger">Empty!</span></h5>
						</div>
						<div class="col-12 justify-content-center d-flex" style="border-top:2px #ff4157 solid;">
							<div class="col-10 col-lg-6"><img class="" src="AdminPanel/dist/resources/empty-cart.png" alt=""></div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Shopping Cart -->
		<?php
		} else {

		?>

			<!-- Shopping Cart -->
			<div class="shopping-cart section">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<!-- Shopping Summery -->
							<table class="table shopping-summery">
								<thead>
									<tr class="main-hading">
										<th>PRODUCT</th>
										<th>NAME</th>
										<th class="text-center">UNIT PRICE</th>
										<th class="text-center">QUANTITY</th>
										<th class="text-center">TOTAL</th>
										<th class="text-center"><i class="ti-trash remove-icon"></i></th>
									</tr>
								</thead>
								<tbody>
									<?php


									for ($x = 0; $x < $cart_num; $x++) {

										$cart_data = $cart_rs->fetch_assoc();

										$product_rs = Database::search("SELECT *,color.name AS `cname` FROM `product` INNER JOIN `product_img` ON product_img.product_product_id = product.product_id INNER JOIN `product_has_color` ON product_has_color.product_product_id = product.product_id
										INNER JOIN `color` ON product_has_color.color_clr_id = color.clr_id 
										INNER JOIN `brand` ON product.brand_brand_id = brand.brand_id
										INNER JOIN `status` ON product.status_satatus_id = status.satatus_id
										WHERE product.product_id = '" . $cart_data["product_product_id"] . "'");
										$product_data = $product_rs->fetch_assoc();

										$total = $total + ($product_data["price"] * $cart_data["qty"]);
										$dilivery = $dilivery + ($product_data["dilivery_fee"]);




									?>

										<tr>
											<!-- <a  data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a> -->
											<td data-toggle="modal" class="image" data-title="No"><img src="<?php echo $product_data["img_path"]; ?>" alt="#"></td>
											<td class="product-des" data-title="Description">
												<p class="product-name"><a href="#"><?php echo $product_data["title"]; ?></a></p>
												<p class="product-des">Brand: <span style="color: black;"><?php echo $product_data["brand_name"]; ?></span></p>
												<p class="product-des">In Stock: <span style="color: black;"><?php echo $product_data["qty"]; ?> Items</span></p>
												<p class="product-des text-primary">Dilivery Price: <span class="text-primary">Rs. <?php echo $product_data["dilivery_fee"]; ?></span></p>


											</td>
											<td class="price" data-title="Price"><span class="text-success">Rs. <?php echo $product_data["price"]; ?> </span></td>

											<td class="qty" data-title="Qty"><!-- Input Order -->
												<div class="input-group">
													<input type="number" class="mt-3 border  border-secondary fs-4 fw-bold px-3 cardqtytext" value="<?php echo $cart_data["qty"];

																																					?>" onchange="changeQTY(<?php echo $cart_data['cart_id']; ?>);" id="qty_num" onchange="incdes(<?php $cart_data['qty']; ?>);">
												</div>
												<!--/ End Input Order -->
											</td>
											<td class="total-amount" data-title="Total"><span>Rs. <?php echo ($product_data["price"] * $cart_data["qty"] + $product_data["dilivery_fee"]); ?></span></td>
											<td onclick="deleteFromCart(<?php echo $cart_data['cart_id']; ?>);" class="action" data-title="Remove"><a href="#"><i class="ti-trash remove-icon"></i></a></td>
										</tr>
									<?php


									}

									?>
								</tbody>
							</table>
							<!--/ End Shopping Summery -->
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<!-- Total Amount -->
							<?php

							// $dilivery_rs = Database::search("S")
							?>
							<div class="total-amount">
								<div class="row">
									<div class="col-lg-7 col-md-5 col-12">
										<div class="left">
											<div class="coupon">
												<form action="#" target="_blank">


												</form>
											</div>
											<div class="checkbox">

											</div>
										</div>
									</div>
									<div class="col-lg-5 col-md-7 col-12">
										<div class="right">
											<ul>
												<li>Items<span>(<?php echo $cart_num; ?>)</span></li>
												<li>Sub Total<span>Rs. <?php echo $total; ?></span></li>
												<li>Dilivery <span>Rs. <?php echo $dilivery; ?></span></li>
												<li class="last">Total<span class="text-danger">Rs. <?php echo ($total + $dilivery); ?></span></li>
											</ul>
											<div class="button5">
												<a href="#" class="btn">Checkout</a>
												<a href="index.php" class="btn">Continue shopping</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--/ End Total Amount -->
						</div>
					</div>
				</div>
			</div>
			<!--/ End Shopping Cart -->

		<?php
		}

		?>
	<?php

	} else {
	?>
		<script>
			window.location = "login.php";
		</script>
	<?php
	}

	?>

	<!-- Start Shop Services Area  -->
	<section class="shop-services section mb-5">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-rocket"></i>
						<h4>Free shiping</h4>
						<p>Orders over $100</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-reload"></i>
						<h4>Free Return</h4>
						<p>Within 30 days returns</p>
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
		<br></br>
	</section>
	<!-- End Shop Newsletter -->


	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
				</div>
				<div class="modal-body">
					<div class="row no-gutters">
						<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
							<!-- Product Slider -->
							<div class="product-gallery">
								<div class="quickview-slider-active">
									<div class="single-slider">
										<img src="images/modal1.jpg" alt="#">
									</div>
									<div class="single-slider">
										<img src="images/modal2.jpg" alt="#">
									</div>
									<div class="single-slider">
										<img src="images/modal3.jpg" alt="#">
									</div>
									<div class="single-slider">
										<img src="images/modal4.jpg" alt="#">
									</div>
								</div>
							</div>
							<!-- End Product slider -->
						</div>
						<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
							<div class="quickview-content">
								<h2>Flared Shift Dress</h2>
								<div class="quickview-ratting-review">
									<div class="quickview-ratting-wrap">
										<div class="quickview-ratting">
											<i class="yellow fa fa-star"></i>
											<i class="yellow fa fa-star"></i>
											<i class="yellow fa fa-star"></i>
											<i class="yellow fa fa-star"></i>
											<i class="fa fa-star"></i>
										</div>
										<a href="#"> (1 customer review)</a>
									</div>
									<div class="quickview-stock">
										<span><i class="fa fa-check-circle-o"></i> in stock</span>
									</div>
								</div>
								<h3>$29.00</h3>
								<div class="quickview-peragraph">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia iste laborum
										ad impedit pariatur esse optio tempora sint ullam autem deleniti nam in quos qui
										nemo ipsum numquam.</p>
								</div>
								<div class="size">
									<div class="row">
										<div class="col-lg-6 col-12">
											<h5 class="title">Size</h5>
											<select>
												<option selected="selected">s</option>
												<option>m</option>
												<option>l</option>
												<option>xl</option>
											</select>
										</div>
										<div class="col-lg-6 col-12">
											<h5 class="title">Color</h5>
											<select>
												<option selected="selected">orange</option>
												<option>purple</option>
												<option>black</option>
												<option>pink</option>
											</select>
										</div>
									</div>
								</div>
								<div class="quantity">
									<!-- Input Order -->
									<div class="input-group">
										<div class="button minus">
											<button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
												<i class="ti-minus"></i>
											</button>
										</div>
										<input type="text" name="quant[1]" class="input-number" data-min="1" data-max="1000" value="1">
										<div class="button plus">
											<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
												<i class="ti-plus"></i>
											</button>
										</div>
									</div>
									<!--/ End Input Order -->
								</div>
								<div class="add-to-cart">
									<a href="#" class="btn">Add to cart</a>
									<a href="#" class="btn min"><i class="ti-heart"></i></a>
									<a href="#" class="btn min"><i class="fa fa-compress"></i></a>
								</div>
								<div class="default-social">
									<h4 class="share-now">Share:</h4>
									<ul>
										<li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
										<li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
										<li><a class="youtube" href="#"><i class="fa fa-pinterest-p"></i></a></li>
										<li><a class="dribbble" href="#"><i class="fa fa-google-plus"></i></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal end -->

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
	<script src="js/script.js"></script>
</body>

</html>
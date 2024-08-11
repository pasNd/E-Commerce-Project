<?php
include "connection.php";

if (isset($_GET["id"])) {
	$pid = $_GET["id"];

	$product_rs = Database::search("SELECT product.product_id,product.title,product.price,product.qty,
	product.description,product.dilivery_fee,product.category_cat_id,category.cat_name,product.status_satatus_id,brand.brand_name 
	AS bname FROM `product` INNER JOIN `category` ON product.category_cat_id = category.cat_id 
	INNER JOIN `status` ON product.status_satatus_id = status.satatus_id 
	INNER JOIN `brand` ON product.brand_brand_id = brand.brand_id 
	WHERE `product_id` = '" . $pid . "';");

	$product_num = $product_rs->num_rows;
	if ($product_num == 1) {
		$product_data = $product_rs->fetch_assoc();

?>

		<!DOCTYPE html>
		<html lang="en">

		<head>
			<!-- Meta Tag -->
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name='copyright' content=''>
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<!-- Title Tag  -->
			<title>techTrove - ProdcutDetails Page</title>
			<!-- Favicon -->
			<link rel="icon" type="image/png" href="images/logo-icon.png">
			<!-- Web Font -->
			<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

			<!-- StyleSheet -->
			<link rel="stylesheet" href="productdetail.css">

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

		<body>

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
									<li class="active"><a href="singleProductView.php">Product Details</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Breadcrumbs -->
			<section class="py-5">
				<div class="container">
					<div class="row gx-5">
						<aside class="col-lg-6">
							<?php
							$eimage_rs = Database::search("SELECT * FROM `product_img` WHERE `product_product_id`='" . $pid . "'");
							$eimage_num = $eimage_rs->num_rows;
							$eimg_data = $eimage_rs->fetch_assoc();

							?>
							<div class="border mb-3 d-flex justify-content-center">
								<img class="mainImg " id="mainImg" src="<?php echo $eimg_data["img_path"]; ?>" alt="" style="transition: opacity 1s ease-in-out;">
							</div>

							<div class="d-flex justify-content-center mb-3">

								<?php

								$image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_product_id`='" . $pid . "'");
								$image_num = $image_rs->num_rows;
								$img = array();

								if ($image_num != 0) {
									for ($x = 0; $x < $image_num; $x++) {
										$image_data = $image_rs->fetch_assoc();
										$img[$x] = $image_data["img_path"];

								?>
										<a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" class="item-thumb">
											<img width="65" height="65" src="<?php echo $img[$x]; ?>" class="img-thumbnail m-0" id="productImg<?php echo $x; ?>" onclick="loadMainImg(<?php echo $x; ?>);" />
										</a>
									<?php
									}
								} else {

									?>
									<a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" class="item-thumb">
										<img width="65" height="65" class="rounded-2" src="AdminPanel/dist/resources/empty.jpg" />
									</a>
									<a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" class="item-thumb">
										<img width="65" height="65" class="rounded-2" src="AdminPanel/dist/resources/empty.jpg" />
									</a>
									<a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" class="item-thumb">
										<img width="65" height="65" class="rounded-2" src="AdminPanel/dist/resources/empty.jpg" />
									</a>
								<?php
								}
								?>

							</div>
							<!-- thumbs-wrap.// -->
							<!-- gallery-wrap .end// -->
						</aside>
						<main class="col-lg-6">
							<div class="ps-lg-3">
								<h4 class="title text-dark">
									<?php echo $product_data["title"]; ?>
								</h4>
								<div class="d-flex flex-row my-3">
									<div class="text-warning mb-1 me-2">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fas fa-star-half-alt"></i>
										<span class="ms-1">
											4.5
										</span>
									</div>
									<span class="text-success ms-2 mx-2">In stock</span>

								</div>

								<div class="mb-3">
									<span class="h5 text-danger">Rs. <?php echo $product_data["price"]; ?> .00</span>

								</div>

								<div class="row g-2 mt-5 mb-3">
									<div class="col-2">
										<img width="40" src="AdminPanel/dist/resources/206680_master_method_card_payment_icon.png" alt="">
									</div>
									<div class="col-2">
										<img width="40" src="AdminPanel/dist/resources/206684_visa_method_card_payment_icon.png" alt="">
									</div>
									<div class="col-2">
										<img width="40" src="AdminPanel/dist/resources/206675_paypal_method_payment_icon.png" alt="">
									</div>
									<div class="col-2">
										<img width="40" src="AdminPanel/dist/resources/206682_american_express_method_card_payment_icon.png" alt="">
									</div>
								</div>
								<?php
								$price = $product_data["price"];
								$discount = ($price / 100) * 5;
								$new_price = $price - $discount;

								$new_price_rounded = ceil($new_price);
								$discount_rounded = ceil($discount);
								?>
								<a class="text-muted mt-3">
									Stand a chance to get 5% discount by using VISA or MASTER
									<p class="ms-2">You can save <span class="text-danger">Rs. <?php echo ($discount_rounded); ?> </span>
										and get this product to <span class="text-danger">Rs. <?php echo ($new_price_rounded); ?></span></p>
								</a>

								<div class="row mt-4">
									<dt class="col-3">Brand:</dt>
									<dd class="col-8"><?php echo $product_data["bname"]; ?></dd>

									<?php
									$clr_rs = Database::search("SELECT * FROM `color` INNER JOIN `product_has_color` ON color.clr_id = product_has_color.color_clr_id
									WHERE product_has_color.product_product_id = '" . $product_data["product_id"] . "'");

									$clr_data = $clr_rs->fetch_assoc();

									?>

									<dt class="col-3">Colour:</dt>
									<dd class="col-8"><?php echo $clr_data["name"]; ?></dd>
									<dt class="col-3">Quantity:</dt>
									<dd class="col-8"><?php echo $product_data["qty"]; ?> Items Available</dd>

								</div>

								<hr />

								<div class="row mb-4">
									<!-- col.// -->
									<div class="col-md-4 col-lg-6 col-6 mb-3">
										<label class="mb-2 d-block">Quantity</label>
										<div class="input-group mb-3">
											<input class="text-center" onkeyup='check_value(<?php echo $product_data["qty"]; ?>);' min="1" value="1" id="qty_input" type="text" class="form-control text-center" placeholder="1" aria-label="Example text with button addon" aria-describedby="button-addon1" style="border:1px #ff4157 solid;border-right: 0px; border-radius: 0px;" />
											<div class="justify-content-center d-flex flex-column align-items-center qty-inc">
												<i style="border:1px #ff4157 solid; border-left: 0px; border-right: 0px;" class="ti-angle-up text-danger fs-6 p-3" onclick='qty_inc(<?php echo $product_data["qty"]; ?>);'></i>
											</div>
											<div class="justify-content-center d-flex flex-column align-items-center qty-dec">
												<i style="border:1px #ff4157 solid;border-left: 0px;" class="ti-angle-down text-danger fs-6 p-3" onclick="qty_dec();"></i>
											</div>

										</div>

									</div>
								</div>
								<button type="submit" id="payhere-payment" onclick="payNow(<?php echo $pid; ?>);" href="#" class="col-12 btn btn-warning text-white text-center" style="background-color: #ff4157;">
									Buy now </button>
								<a onclick='addToCart(<?php echo $product_data["product_id"]; ?>);' href="#" class=" col-12 btn btn-border-warning text-white mt-3 text-center"> <i class="ti-shopping-cart mx-2 "></i>Add to cart </a>

							</div>
						</main>
					</div>
				</div>
			</section>
			<!-- content -->

			<section class=" border-top py-4">
				<div class="container">
					<div class="row gx-4">
						<div class="col-lg-8 mb-4">
							<div class="border rounded-2 px-3 py-2 bg-white">
								<!-- Pills navs -->
								<ul class="nav nav-pills nav-justified mb-3 mt-3 m-3" id="ex1" role="tablist">
									<li class="nav-item d-flex" role="presentation">
										<h5 class="text-center">Specifications</h5>
									</li>
								</ul>
								<!-- Pills navs -->

								<!-- Pills content -->
								<div class="tab-content" id="ex1-content">

									<div class="col-12 mb-3">
										<textarea class="bg-white p-4" cols="60" rows="19" class="form-control" readonly>
										<?php echo $product_data["description"]; ?>
                                     </textarea>
									</div>
								</div>
								<!-- Pills content -->
							</div>
						</div>
						<div class="col-lg-4">
							<div class="px-0 border rounded-2 shadow-0">
								<div class="card">
									<div class="card-body">
										<h5 class="card-title">Related items</h5>

										<?php

										$related_rs = Database::search("SELECT * FROM `product` INNER JOIN category ON product.category_cat_id= category.cat_id
										INNER JOIN brand ON product.brand_brand_id = brand.brand_id WHERE brand.brand_name = '" . $product_data["bname"] . "' OR 
										category.cat_name = '" . $product_data["cat_name"] . "' LIMIT 4");

										$related_num = $related_rs->num_rows;

										for ($x = 0; $x < $related_num; $x++) {
											$related_data = $related_rs->fetch_assoc();

										?>

											<?php
											$rimg_rs = Database::search("SELECT * FROM `product_img` WHERE 
										`product_product_id`='" . $related_data["product_id"] . "'");

											$rimg_data = $rimg_rs->fetch_assoc();
											?>
											<div class="d-flex mb-3">
												<a href='<?php echo "singleProductView.php?id=" . ($related_data["product_id"]); ?>' class="me-3">
													<img width="50" src="<?php echo $rimg_data["img_path"]; ?>" style="min-width: 96px; height: 96px;" class="img-md img-thumbnail" />
												</a>
												<div class="info">
													<a href="#" class="nav-link mb-1">
														<?php echo $related_data["title"]; ?><br />
													</a>
													<strong class="text-dark mx-3 ">Rs. <?php echo $related_data["price"]; ?></strong>
												</div>
											</div>
										<?php
										}

										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- Start Footer Area -->
			<!-- Start Shop Services Area  -->
			<section class="shop-services section" style="margin-bottom: 70px;">
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
			</section>
			<!-- End Shop Newsletter -->
			<?php

			include "footer.php";

			?>
			<!-- /End Footer Area -->

			<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="	sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

			<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
			<script src="js/script.js"></script>
			<script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>	
		</body>

		</html>

<?php


	} else {
		echo ("Sorry for the inconvenience.Please try again later.");
	}
} else {
	echo ("Something went wrong.");
}

?>
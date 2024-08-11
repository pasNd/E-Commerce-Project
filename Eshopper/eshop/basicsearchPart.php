<div class="col-lg-2 col-md-2 col-12">
						<!-- Logo -->
						<div class="logo">
							<a href="index.php"><img src="images/logo-dark.png" alt="logo" style="height:30px;"></a>
						</div>
						<!--/ End Logo -->
						<!-- Search Form -->
						<div class="search-top">
							<div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
							<!-- Search Form -->
							<div class="search-top">
								<form class="search-form">
									<input type="text" placeholder="Search here..." name="search">
									<button value="search" type="submit"><i class="ti-search"></i></button>
								</form>
							</div>
							<!--/ End Search Form -->
						</div>
						<!--/ End Search Form -->
						<div class="mobile-nav"></div>
					</div>
					<div class="col-lg-8 col-md-7 col-12">
						<div class="search-bar-top">
							<div class="search-bar">
								<select id="basic_search_select">
									<option value="0" selected="selected">All Category</option>

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
								<div>
									<input name="search" placeholder="Search Products Here....." type="text" id="basic_search_txt">
									<button type="submit" onclick="basicSearch(0);" class="btnn"><i class="ti-search"></i></button>
									
                                   
								</div>
								<!-- <button type="submit" class=" px-3" onclick="basicSearch(0);">search</button> -->
                                
							</div>

						</div>
					</div>

                    <div class="col-lg-2 col-md-3 col-12">
						<div class="right-bar">
							<!-- Search Form -->
							<div class="sinlge-bar">
								<a href="wishlist.php" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
							</div>
							<div class="sinlge-bar">
								<a href="userProfile.php" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
							</div>
							<div class="sinlge-bar shopping">


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
										<a href="addToCart.php" class="single-icon"><i class="ti-bag"></i></a>
										<!--Empty Shopping Item -->
										<div class="shopping-item d-none">
											<div class="dropdown-cart-header">
												<span>2 Items</span>
												<a href="#">View Cart</a>
											</div>
											<ul class="shopping-list">
												<li>
													<a href="#" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
													<a class="cart-img" href="#"><img src="https://via.placeholder.com/70x70" alt="#"></a>
													<h4><a href="#">Woman Ring</a></h4>
													<p class="quantity">1x - <span class="amount">$99.00</span></p>
												</li>
												<li>
													<a href="#" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
													<a class="cart-img" href="#"><img src="https://via.placeholder.com/70x70" alt="#"></a>
													<h4><a href="#">Woman Necklace</a></h4>
													<p class="quantity">1x - <span class="amount">$35.00</span></p>
												</li>
											</ul>
											<div class="bottom">
												<div class="total">
													<span>Total</span>
													<span class="total-amount">$134.00</span>
												</div>
												<a href="checkout.html" class="btn animate">Checkout</a>
											</div>
										</div>
										<!--/ End Shopping Item -->
									<?php
									} else {
									?>
										<a href="addToCart.php" class="single-icon"><i class="ti-bag"></i> <span class="total-count"><?php echo $cart_num; ?></span></a>
										<!-- Shopping Item -->
										<div class="shopping-item">
											<div class="dropdown-cart-header">
												<span><?php echo $cart_num; ?> Items</span>
												<a href="addToCart.php">View Cart</a>
											</div>
											<ul class="shopping-list">
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
													<li>
														<a href="#" class="remove" title="Remove this item"><i class="fa fa-remove" onclick="deleteFromCart(<?php echo $cart_data['cart_id']; ?>);"></i></a>
														<a class="cart-img" href="addToCart.php"><img src="<?php echo $product_data["img_path"]; ?>" alt="#"></a>
														<h4><a href="#"><?php echo $product_data["title"]; ?></a></h4>
														<p class="quantity">1x - <span class="amount">Rs. <?php echo $product_data["price"]; ?></span></p>
													</li>
												<?php
												}
												?>

											</ul>
											<div class="bottom">
												<div class="total">
													<span>Total</span>
													<span class="total-amount">Rs. <?php echo ($total + $dilivery); ?></span>
												</div>
												<a href="addToCart.php" class="btn animate">Checkout</a>
											</div>
										</div>
										<!--/ End Shopping Item -->

								<?php
									}
								}
								?>
							</div>
						</div>
					</div>
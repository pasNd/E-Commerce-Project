<?php
session_start();

?>
		<!-- Topbar -->
		<div class="topbar">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-12 col-12">
						<!-- Top Left -->
						<?php

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
								<p><span style="color: #ff4157;">TechTrove</span></p>
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
								<li><i class="ti-heart"></i> <a href="wishlist.php">Wish-list</a></li>
								<li><i class="ti-user"></i> <a href="userProfile.php">My account</a></li>
								<?php
								if (isset($_SESSION["user"])) {
								?>
									<li><i class="ti-power-off"></i><a href="" onclick="logout();">Log out</a></li>

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
		</div>
		<!-- End Topbar --
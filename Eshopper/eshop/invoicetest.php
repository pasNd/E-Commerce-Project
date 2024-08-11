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
    <link rel="stylesheet" href="invoice.css">



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
    </header>
    <!--/ End Header -->
    <hr>
    <div class="container border border-1 col-12 mt-4">
        <div>
            <div class="card-body">
                <div id="invoice">
                    <div class="toolbar hidden-print">
                        <div class="text-end">
                            <button type="button" class="btn btn-dark"><i class="fa fa-print"></i> Print</button>
                            <button type="button" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
                        </div>
                        <hr>
                    </div>
                    <div class="invoice overflow-auto">
                        <div style="min-width: 600px">
                            <header>
                                <div class="row">
                                    <div class="col">
                                        <a href="javascript:;">
                                            <img src="images/logo-dark.png" width="250" alt="">
                                        </a>
                                    </div>
                                    <div class="col-12 company-details">
                                        <h2 class="name">
                                            <a target="_blank" href="javascript:;">
                                                TechTrove
                                            </a>
                                        </h2>
                                        <div> Colombo 07, Sri Lanka</div>
                                        <div>+94 76 419 5230</div>
                                        <div>techtrove@gmail.com</div>
                                    </div>
                                </div>
                            </header>
                            <main>

                                <div class="row contacts">
                                    <div class="col invoice-to">
                                        <div class="text-gray-light">INVOICE TO:</div>
                                        <h2 class="to">Pasindu</h2>
                                        <div class="address">Boossa</div>
                                        <div class="email"><a href="mailto:john@example.com">pasindulak831@gmail.com</a>
                                        </div>
                                    </div>
                                    <?php

                                    $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "'");
                                    $invoice_data = $invoice_rs->fetch_assoc();
                                    ?>
                                    <div class="col invoice-details">
                                        <h1 class="invoice-id">INVOICE <?php echo $invoice_data["invoice_id"]; ?></h1>
                                        <div class="date">Date/time of Invoice: <?php $invoice_data["date"]; ?></div>
                                    </div>
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>#NO</th>
                                            <th class="text-left">TITLE</th>
                                            <th class="text-right">UNIT PRICE</th>
                                            <th class="text-right">QUANTITY</th>
                                            <th class="text-right">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="no"><?php echo $invoice_data["invoice_id"]; ?></td>
                                            <?php
                                            $product_rs = Database::search("SELECT * FROM `product` WHERE `product_id` = '" . $invoice_data["product_product_id"] . "'");
                                            $product_data = $product_rs->fetch_assoc();

                                            ?>
                                            <td class="text-left">
                                                <h3><?php echo $product_data["title"]; ?></h3>
                                            </td>
                                            <td class="unit">Rs. <?php echo $product_data["price"]; ?> .00</td>
                                            <td class="qty"><?php echo $invoice_data["qty"]; ?></td>
                                            <td class="total">Rs. <?php echo $invoice_data["total"]; ?> .00</td>
                                        </tr>

                                    </tbody>

                                    <?php
                                    $delivery = $product_data["dilivery_fee"];

                                    $t = $invoice_data["total"];
                                    $g = $t - $delivery;
                                    ?>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">SUBTOTAL</td>
                                            <td>Rs. <?php echo $g; ?> .00/td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">Delivery Fee</td>
                                            <td>Rs. <?php echo $delivery; ?> .00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">GRAND TOTAL</td>
                                            <td>Rs. <?php echo $g; ?> .00</td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="thanks">Thank you!</div>
                                <div class="notices">
                                    <div>NOTICE:</div>
                                    <div class="notice">Purchased products can return befor <span class="fw-bold">7 Days</span> of Delivery.</div>
                                </div>
                            </main>
                            <footer>Invoice was created on a computer and is valid without the signature and seal.</footer>
                        </div>

                        <div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Shop Newsletter -->
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
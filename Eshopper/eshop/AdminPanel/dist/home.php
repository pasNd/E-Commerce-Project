<?php

session_start();
include "connection.php";

if (isset($_SESSION["admin"])) {

?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Panel</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>

  <body>
    <div class="container-scroller">

      <!-- partial:partials/_navbar.html -->
      <?php

      include "navbar.php";
      ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php
        include "sidebar.php";
        ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon text-white me-2" style="background-color: #ff4157;box-shadow: 2px 3px 5px black;">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle text-danger"></i>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="row">

              <?php

              $today = date("Y-m-d");
              $thismonth = date("m");
              $thisyear = date("Y");

              $a = "0";
              $b = "0";
              $c = "0";
              $e = "0";
              $f = "0";

              $invoice_rs = Database::search("SELECT * FROM `invoice`");
              $invoice_num = $invoice_rs->num_rows;

              for ($x = 0; $x < $invoice_num; $x++) {
                $invoice_data = $invoice_rs->fetch_assoc();

                $f = $f + $invoice_data["qty"];

                $d = $invoice_data["date"];
                $splitDate = explode(" ", $d);
                $pdate = $splitDate["0"];

                if ($pdate == $today) {
                  $a = $a + $invoice_data["total"];
                  $c = $c + $invoice_data["qty"];
                }

                $splitMonth = explode("-", $pdate);
                $pyear = $splitMonth["0"];
                $pmonth = $splitMonth["1"];

                if ($pyear == $thisyear) {
                  if ($pmonth == $thismonth) {
                    $b = $b + $invoice_data["total"];
                    $e = $e + $invoice_data["qty"];
                  }
                }
              }

              ?>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Daily Sales <i class="mdi mdi-chart-line mdi-24px float-end"></i>
                    </h4>
                    <?php
                    if ($a == 0) {
                    ?>
                      <h2 class="mb-5">No Sales Today</h2>
                    <?php
                    } else {
                    ?>
                      <h2 class="card-text">Rs. <?php echo $a; ?> .00</h2>
                    <?php
                    }
                    ?>

                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Monthly Sales<i class="mdi mdi-bookmark-outline mdi-24px float-end"></i>
                    </h4>
                    <?php
                    if ($b == 0) {
                    ?>
                      <h2 class="mb-5">No Sales Today</h2>
                    <?php
                    } else {
                    ?>
                      <h2 class="card-text">Rs. <?php echo $b; ?> .00</h2>
                    <?php
                    }
                    ?>

                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Monthly Orders <i class="mdi mdi-diamond mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5"><?php echo $e; ?></h2>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <?php
              $mp_rs = Database::search("SELECT `product_product_id`,COUNT(`product_product_id`) AS `value_occurence` FROM `invoice`
               WHERE `date` LIKE '%" . $today . "%' GROUP BY `product_product_id` ORDER BY `value_occurence` DESC LIMIT 1");

              $mp_num = $mp_rs->num_rows;

              if ($mp_num > 0) {

                $mp_data = $mp_rs->fetch_assoc();

                $product_rs = Database::search("SELECT * FROM `product` WHERE `product_id`='" . $mp_data["product_product_id"] . "'");
                $product_data = $product_rs->fetch_assoc();

                $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_product_id`='" . $mp_data["product_product_id"] . "'");
                $image_data = $image_rs->fetch_assoc();

                $clr_rs = Database::search("SELECT * FROM `color` INNER JOIN `product_has_color` ON color.clr_id=product_has_color.color_clr_id 
                WHERE product_has_color.product_product_id='" . $mp_data["product_product_id"] . "'");

                $clr_data = $clr_rs->fetch_assoc();


              ?>

                <div class="col-md-7 grid-margin stretch-card ">
                  <div class="card">
                    <div class="d-flex justify-content-center mt-2">
                      <h4 class="card-title mb-4 mt-4">Product Details</h4>
                    </div>
                    <ul>
                      <li class="d-flex justify-content-start text-dark fw-bold px-4">
                        Title : <?php echo $product_data["title"]; ?>
                      </li>
                      <li class="d-flex justify-content-start px-4">
                        Colour : <?php echo $clr_data["name"]; ?>
                      </li>
                      <li class="d-flex justify-content-start px-4">
                        Price : <?php echo $product_data["price"]; ?>
                      </li>
                      <div class="mb-3 px-4">
                        <label for="exampleFormControlTextarea1" class="form-label">Product Description</label>
                        <textarea class="form-control" readonly id="exampleFormControlTextarea1" rows="10"> <?php echo $product_data["description"]; ?></textarea>
                      </div>
                    </ul>

                  </div>
                </div>
                <div class="col-md-5 grid-margin stretch-card">
                  <div class="card">
                    <div class="d-flex justify-content-center mt-2">
                      <h4 class="card-title mb-4 mt-4">Most Sold Product</h4>
                    </div>
                    <div class=" d-flex justify-content-center mt-4 pb-4">
                      <?php

                      $product_img_path = $image_data["img_path"];

                      $clean_img_path = str_replace("AdminPanel//dist//", "", $product_img_path);

                      ?>
                      <img width="70%" height="100%" src="<?php echo $clean_img_path; ?>" alt="">
                    </div>
                  </div>
                </div>
              <?php

              } else {
              ?>
                <div class="col-md-7 grid-margin stretch-card d-none">
                  <div class="card">
                    <div class="d-flex justify-content-center mt-2">
                      <h4 class="card-title mb-4 mt-4">Product Details</h4>
                    </div>


                  </div>
                </div>
                <div class="col-md-12 grid-margin stretch-card d-none">
                  <div class="card">
                    <div class="d-flex justify-content-center mt-2">
                      <h4 class="card-title mb-4 mt-4">Most Sold Product</h4>
                    </div>
                    <div class=" d-flex justify-content-center">
                      <img width="70%" height="100%" src="resources/products/ASUS X515E VIVOBOOK_0_6657e1909fe56.jpeg" alt="">
                    </div>
                  </div>
                </div>
              <?php
              }
              ?>
            </div>
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Recent Customers</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> Name </th>
                            <th> Date/Time </th>
                            <th> Product Name </th>
                            <th> Order ID </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $rcus_rs = Database::search("SELECT * FROM `invoice` INNER JOIN `product` ON invoice.product_product_id=product.product_id
                          INNER JOIN `user` ON invoice.user_email= user.email ORDER BY invoice.date DESC LIMIT 5");
                          $rcus_num = $rcus_rs->num_rows;

                          for ($x = 0; $x < $rcus_num; $x++) {
                            $rcus_data = $rcus_rs->fetch_assoc();

                            $cus_mail = $rcus_data["user_email"];
                            $pid = $rcus_data["product_product_id"];

                            $pimg_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $cus_mail . "'");
                            $pimg_data = $pimg_rs->fetch_assoc();

                            $profile_img_path = $pimg_data["img_path"];

                            $clean_path = str_replace("AdminPanel//dist//", "", $profile_img_path);

                          ?>
                            <tr>
                              <td class="fw-bold" style="color: #ff4157;">
                                <img src="<?php echo $clean_path; ?>" class="me-2" alt="image"> <?php echo $rcus_data["fname"] . " " . $rcus_data["lname"]; ?>
                              </td>
                              <td> <?php echo $rcus_data["date"]; ?></td>
                              <td class="text-success fw-bold"> <?php echo $rcus_data["title"]; ?> </td>
                              <td> <?php echo $rcus_data["order_id"]; ?> </td>
                            </tr>
                          <?php
                          }
                          ?>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <?php
          include "footer.php";
          ?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/chart.umd.js"></script>
    <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <script src="assets/js/jquery.cookie.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
    <!-- Code injected by live-server -->
    <script>
      // <![CDATA[  <-- For SVG support
      if ('WebSocket' in window) {
        (function() {
          function refreshCSS() {
            var sheets = [].slice.call(document.getElementsByTagName("link"));
            var head = document.getElementsByTagName("head")[0];
            for (var i = 0; i < sheets.length; ++i) {
              var elem = sheets[i];
              var parent = elem.parentElement || head;
              parent.removeChild(elem);
              var rel = elem.rel;
              if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
                var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
                elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
              }
              parent.appendChild(elem);
            }
          }
          var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
          var address = protocol + window.location.host + window.location.pathname + '/ws';
          var socket = new WebSocket(address);
          socket.onmessage = function(msg) {
            if (msg.data == 'reload') window.location.reload();
            else if (msg.data == 'refreshcss') refreshCSS();
          };
          if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
            console.log('Live reload enabled.');
            sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
          }
        })();
      } else {
        console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
      }
      // ]]>
    </script>
  </body>

  </html>

<?php

} else {
  header("Location:pages/samples/error-500.html");
  exit();
}

?>
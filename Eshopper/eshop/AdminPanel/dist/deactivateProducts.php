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
              <h3 class="page-title">Deactivate Products</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="addProducts.php">Add Products</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Deactivate Products </li>
                </ol>
              </nav>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <p class="card-description">Please check product before apply deactivation. </p>
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th> Product </th>
                          <th> Title </th>
                          <th> Price </th>
                          <th> Quantity </th>
                          <th> Registerd Date </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                        $product_rs = Database::search("SELECT * FROM `product`");
                        $product_num = $product_rs->num_rows;


                        for ($x = 0; $x < $product_num; $x++) {
                          $product_data = $product_rs->fetch_assoc();
                          $pid = $product_data["product_id"];

                          $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_product_id`='" . $pid . "'");
                          $img_data = $img_rs->fetch_assoc();

                          $pimg_path = $img_data["img_path"];

                          $clean_path = str_replace("AdminPanel//dist//", "", $pimg_path);

                        ?>
                          <tr>
                            <td class="py-1">
                              <img style="border-radius: 0%;" src="<?php echo $clean_path; ?>" alt="image" />
                            </td>
                            <td> <?php echo $product_data["title"]; ?> </td>
                            <td style="color: #ff4157;">Rs. <?php echo $product_data["price"]; ?> .00 </td>
                            <td> <?php echo $product_data["qty"]; ?></td>
                            <?php
                            $d = $product_data["datetime_added"];
                            $splitDate = explode(" ", $d);
                            $pdate = $splitDate["0"];
                            ?>
                            <td><?php echo $pdate; ?>
                            </td>
                            <?php
                            if ($product_data["status_satatus_id"] == 1) {
                            ?>
                              <td style="padding-left: 0px;" class="pt-3"><button onclick="blockProduct('<?php echo $pid; ?>');" class="btn btn-danger" id="pb<?php echo $pid; ?>">Block</button></td>
                            <?php
                            } else {
                            ?>
                              <td style="padding-left: 0px;" class="pt-3"><button onclick="blockProduct('<?php echo $pid; ?>');" class="btn btn-success" id="pb<?php echo $pid; ?>">Active</button></td>
                            <?php
                            }
                            ?>

                          </tr>


                        <?php
                        }
                        ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-center">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024 <a href="https://www.bootstrapdash.com/" target="_blank">Techtrove</a>. All rights reserved.</span>

            </div>
          </footer>
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
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
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
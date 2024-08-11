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
            <h3 class="page-title">Add Products</h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Products Adding </li>
              </ol>
            </nav>
          </div>
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body ">
                  <h4 class="card-title">Read steps below,</h4>
                  <ol>
                    <li class="text-danger"> If there is an new category, brand or colour in your product.Please provide them first.</li>
                    <li class="text-muted"> Next, Click Save Details Button</li>
                    <li class="text-muted"> Next, Select details you provided.</li>
                    <li class="text-muted"> Next, Provide other details of the product.</li>
                    <li class="text-danger"> finally, Click Save Product Button.</li>
                  </ol>
                  <div class="row template-demo mt-4">
                    <div class="col-12 col-lg-4">
                      <input type="text" class="form-control border border-success mt-2" id="ncategory" placeholder="Add New Category">
                    </div>
                    <div class="col-12 col-lg-4">
                      <input type="text" class="form-control border border-primary mt-2" id="nbrand" placeholder="Add New Brand">
                    </div>
                    <div class="col-12 col-lg-4">
                      <input type="text" class="form-control border border-warning mt-2" id="nclr" placeholder="Add New Colour">
                    </div>
                    <div class="col-12 mt-5">
                        <label class="col-12 btn btn-danger" onclick="addDetails();">SAVE DETAILS</label>
                      </div>
                  </div>
                </div>

                <div class="card-body ">
                  <h4 class="card-title">Provide Product Details</h4>
                  <p class="card-description"> Select Product Category, Brand, Colour</p>
                  <div class="row template-demo">
                    <div class="col-12 col-lg-4 mt-2">
                      <select class="form-select border-danger rounded-0" aria-label="Default select example" id="category">
                        <option value="0" selected>Select Category</option>
                        <?php

                        $category_rs = Database::search("SELECT * FROM `category`");
                        $category_num = $category_rs->num_rows;

                        for ($x = 0; $x < $category_num; $x++) {
                          $category_data = $category_rs->fetch_assoc();

                        ?>
                          <option class="dropdown-item" value="<?php echo $category_data["cat_id"]; ?>">
                            <?php echo $category_data["cat_name"]; ?>
                          </option>

                        <?php
                        }

                        ?>
                      </select>
                    </div>
                    <div class="col-12 col-lg-4 mt-2">
                      <select class="form-select border-primary rounded-0" aria-label="Default select example" id="brand">
                        <option value="0" selected>Select Brand</option>
                        <?php

                        $brand_rs = Database::search("SELECT * FROM `brand` ");
                        $brand_num = $brand_rs->num_rows;

                        for ($x = 0; $x < $brand_num; $x++) {
                          $brand_data = $brand_rs->fetch_assoc();

                        ?>
                          <option class="dropdown-item" value="<?php echo $brand_data["brand_id"]; ?>">
                            <?php echo $brand_data["brand_name"]; ?>
                          </option>

                        <?php
                        }

                        ?>
                      </select>
                    </div>
                    <div class="col-12 col-lg-4 mt-2">
                    <select class="form-select border-success rounded-0" aria-label="Default select example" id="color">
                        <option value="0" selected>Select Colour</option>
                        <?php

                        $color_rs = Database::search("SELECT * FROM `color` ");
                        $color_num = $color_rs->num_rows;

                        for ($x = 0; $x < $color_num; $x++) {
                          $color_data = $color_rs->fetch_assoc();

                        ?>
                          <option class="dropdown-item" value="<?php echo $color_data["clr_id"]; ?>">
                            <?php echo $color_data["name"]; ?>
                          </option>

                        <?php
                        }

                        ?>
                      </select>
                    </div>
                  </div>
                  
                </div>

                <div class="card-body ">
                  <h4 class="card-title">Product Model | Product Quantity</h4>
                  <p class="card-description">
                    Provide Product Model and Quantity.
                  </p>
                  <div class="row template-demo">
                  <div class="col-12 col-lg-6 mt-2">
                      <input type="text" class="form-control border border-success" id="model" placeholder="Provide Product Model">
                    </div>
                    <div class="col-12 col-lg-6 mt-2">
                      <input type="number" class="form-control border-secondary" id="qty" placeholder="Quantity" min="1">
                    </div>
                  </div>

                </div>
                <div class="card-body">
                  <div class="template-demo">
                    <h4 for="">Product Title</h4>
                    <div class="dropdown col-12 col-lg-8 offset-lg-2">

                      <input type="text" class="form-control" id="title" placeholder="Give title for the product" style="border: 1px salmon solid;">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Cost Per Item</h4>
                  <div class="template-demo">
                    <div class="col-12 col-lg-12 mt-4">
                      <div class="input-group mb-2 mt-2">
                        <span class="input-group-text">Rs.</span>
                        <input type="text" class="form-control" id="cost" />
                        <span class="input-group-text">.00</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Delivery Cost</h4>
                  <div class="template-demo">
                    <div class="col-12 col-lg-12 mt-4">
                      <div class="input-group mb-2 mt-2">
                        <span class="input-group-text">Rs.</span>
                        <input type="text" class="form-control" id="dcost" />
                        <span class="input-group-text">.00</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Approved Payment Methods</h4>
                  <div class="row">
                    <div class="col-12">
                      <div class="template-demo d-flex justify-content-center ">
                        <div class="dropdown">
                          <img src="resources/206675_paypal_method_payment_icon.png" alt="" width="130px">
                        </div>
                        <div class="dropdown">
                          <img src="resources/206680_master_method_card_payment_icon.png" alt="" width="130px">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="template-demo d-flex justify-content-center ">
                        <div class="dropdown">
                          <img src="resources/206682_american_express_method_card_payment_icon.png" alt="" width="130px">
                        </div>
                        <div class="dropdown">
                          <img src="resources/206684_visa_method_card_payment_icon.png" alt="" width="130px">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Product Description</h4>
                  <p class="card-description">
                    Brief description about product.
                  </p>
                  <div class="row">
                    <div class="col-12">
                      <div class="col-12">
                        <textarea cols="30" rows="18" class="form-control" id="desc"></textarea>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Product Images</h4>
                  <p class="card-description">
                    Should be added more than one.(PNG,JPEG,WEBP)
                  </p>
                  <div class="row">
                    <div class="col-12">
                      <div class="offset-lg-3 col-12 col-lg-6">
                        <div class="row g-3">
                          <div class="col-4 border border-success rounded">
                            <img src="resources/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i0" />
                          </div>
                          <div class="col-4 border border-success rounded">
                            <img src="resources/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i1" />
                          </div>
                          <div class="col-4 border border-success rounded">
                            <img src="resources/addproductimg.svg " class="img-fluid" style="width: 250px;" id="i2" />
                          </div>
                        </div>
                      </div>
                      <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                        <input type="file" class="d-none" multiple id="imageuploader" />
                        <label for="imageuploader" class="col-12 btn btn-success" onclick="changeProductImage();">Upload</label>
                      </div>
                      <div class="col-12 mt-5">
                        <label class="col-12 btn btn-danger" onclick="addProduct();">SAVE PRODUCT</label>
                      </div>
                    </div>
                  </div>

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
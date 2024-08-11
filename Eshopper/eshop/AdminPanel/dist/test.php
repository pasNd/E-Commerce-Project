<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../../assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <img src="../../assets/images/logo-dark.png">
                </div>
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <form class="pt-3">
                  <div class="form-group">
                    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Verification Code">
                  </div>
                  <div class="mt-3 d-grid gap-2">
                    <a class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" style="background: #ff4157;" href="../../index.html">SIGN IN</a>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">   
                  </div>
                 
                  <!-- <div class="text-center mt-4 font-weight-light"> Don't have an account? <a href="register.html" class="text-primary">Create</a>
                  </div> -->
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>
    <script src="../../assets/js/jquery.cookie.js"></script>
    <!-- endinject -->
  </body>
</html>


<div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="avcode" placeholder="Verification Code">
                  </div>








                  <div class="col-lg-12 grid-margin">
                <div class="card">
                  <div class="card-body ">
                    
                    <h4 class="card-title">Main Factors</h4>
                    <p class="card-description">
                      Select Product Category , Brand , Model & Colour
                    </p>
                    <div class="template-demo">
                      <div class="dropdown col-12 col-lg-4">
                        <button class="btn btn-primary dropdown-toggle col-12" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Category </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" id="category">

                          <?php

                          $category_rs = Database::search("SELECT * FROM `category`");
                          $category_num = $category_rs->num_rows;

                          for ($x = 0; $x < $category_num; $x++) {
                            $category_data = $category_rs->fetch_assoc();

                          ?>
                            <a class="dropdown-item" value="<?php echo $category_data["cat_id"]; ?>">
                              <?php echo $category_data["cat_name"]; ?>
                            </a>

                          <?php
                          }

                          ?>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item text-primary" href="#">Add new category</a>
                        </div>
                      </div>

                      <div class="dropdown col-12 col-lg-4">
                        <button class="btn btn-danger dropdown-toggle col-12" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Brand </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3" id="brand">
                          <?php

                          $brand_rs = Database::search("SELECT * FROM `brand` ");
                          $brand_num = $brand_rs->num_rows;

                          for ($x = 0; $x < $brand_num; $x++) {
                            $brand_data = $brand_rs->fetch_assoc();

                          ?>
                            <a class="dropdown-item" value="<?php echo $brand_data["brand_id"]; ?>">
                              <?php echo $brand_data["brand_name"]; ?>
                            </a>

                          <?php
                          }

                          ?>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item text-danger" href="#">Add new brand</a>
                        </div>
                      </div>
                      <div class="dropdown col-12 col-lg-3">
                        <button class="btn btn-warning dropdown-toggle col-12" type="button" id="dropdownMenuButton4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Model </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4" id="model">
                          <?php

                          $model_rs = Database::search("SELECT * FROM `model` ");
                          $model_num = $model_rs->num_rows;

                          for ($x = 0; $x < $model_num; $x++) {
                            $model_data = $model_rs->fetch_assoc();

                          ?>
                            <a class="dropdown-item" value="<?php echo $model_data["model_id"]; ?>">
                              <?php echo $model_data["model_name"]; ?>
                            </a>

                          <?php
                          }

                          ?>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item text-warning" href="#">Add new model</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body ">
                  <h4 class="card-title">Product Colour | Product Quantity</h4>
                    <p class="card-description">
                      Select Product Colour and Quantity.
                    </p>
                    <div class="template-demo">
                    <div class="dropdown col-12 col-lg-8">
                        <button class="btn btn-outline-danger dropdown-toggle col-12" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Colours </button>
                        <div class="dropdown-menu " aria-labelledby="dropdownMenuButton1" id="color">
                          <?php

                          $color_rs = Database::search("SELECT * FROM `color` ");
                          $color_num = $color_rs->num_rows;

                          for ($x = 0; $x < $color_num; $x++) {
                            $color_data = $color_rs->fetch_assoc();

                          ?>
                            <a class="dropdown-item" value="<?php echo $color_data["clr_id"]; ?>">
                              <?php echo $color_data["name"]; ?>
                            </a>

                          <?php
                          }

                          ?>
                        </div>
                      </div>
                      <div class="dropdown col-12 col-lg-3">
                        <input type="number" class="form-control" id="qty" placeholder="Quantity" style="border: 1px salmon solid;" value="0" min="0">
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
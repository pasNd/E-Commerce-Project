

<nav class="sidebar sidebar-offcanvas" id="sidebar">

  <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="nav-profile-image">
          <img src="assets/images/faces/new_user.png" alt="profile" />
          <span class="login-status online"></span>
          <!--change to offline or busy as needed-->
        </div>
        <div class="nav-profile-text d-flex flex-column">
        <?php
            if(isset($_SESSION["admin"])){
              $amail = $_SESSION["admin"]["email"];

              $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='".$amail."'");
              $admin_data = $admin_rs->fetch_assoc();
            }
           
            ?>
          <span class="font-weight-bold mb-2"><?php echo $admin_data["fname"] . " " . $admin_data["lname"]; ?></span>
        </div>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="home.php" style="color: #ff4157;">
        <span class="menu-title fw-bold" style="color: #ff4157;">Dashboard</span>
        <i class="mdi mdi-home menu-icon" style="color: #ff4157;"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
        <span class="menu-title" style="color: black;">Manage Products</span>
        <i class="mdi mdi-gift-outline menu-icon" style="color: black;"></i>
      </a>
      <div class="collapse" id="icons">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link text-dark" href="addProducts.php">Add Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="deactivateProducts.php">Deactive Products</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="manageusers.php" style="color: #ff4157;">
        <span class="menu-title" style="color: black">Manage Users</span>
        <i class="mdi mdi-account-plus menu-icon" style="color: black;"></i>
      </a>
    </li>
    <!-- <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="manageusers.php" aria-expanded="false" aria-controls="forms">
        <span class="menu-title">Manage Users</span>
        <i class="mdi mdi-account-plus menu-icon"></i>
      </a>
    </li> -->
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#forms" aria-expanded="false" aria-controls="forms">
        <span class="menu-title" style="color: black;">Selling History</span>
        <i class="mdi mdi-seal-variant menu-icon" style="color: black;"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#forms" aria-expanded="false" aria-controls="forms">
        <span class="menu-title" style="color: black;">Manage Home Page</span>
        <i class="mdi mdi-home-plus-outline menu-icon" style="color: black;"></i>
      </a>
    </li>
  </ul>
</nav>
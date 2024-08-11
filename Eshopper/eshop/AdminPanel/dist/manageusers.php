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
                        <div class="row">
                            <div class="col-12 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Manage Users</h4>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th> Name </th>
                                                        <th> Email </th>
                                                        <th> Mobile </th>
                                                        <th> Registered Date </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = "SELECT * FROM `user` INNER JOIN `profile_img` ON user.email = profile_img.user_email";
                                                    $pageno;

                                                    if (isset($GET_page["page"])) {
                                                        $pageno = $GET["page"];
                                                    } else {
                                                        $pageno = 1;
                                                    }

                                                    $user_rs = Database::search($query);
                                                    $user_num = $user_rs->num_rows;

                                                    $results_per_page = 20;
                                                    $number_of_pages = ceil($user_num / $results_per_page);

                                                    $page_results = ($pageno - 1) * $results_per_page;
                                                    $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                                                    $selected_num = $selected_rs->num_rows;

                                                    for ($x = 0; $x < $selected_num; $x++) {
                                                        $selected_data = $selected_rs->fetch_assoc();

                                                        $profile_img_path = $selected_data["img_path"];

                                                        $clean_path = str_replace("AdminPanel//dist//", "", $profile_img_path);


                                                        $d = $selected_data["joined_date"];
                                                        $splitDate = explode(" ", $d);
                                                        $pdate = $splitDate["0"];
                                                    ?>
                                                        <tr>
                                                            <td class="fw-bold" style="color: #ff4157;">
                                                                <img src="<?php echo $clean_path; ?>" class="me-2" alt="image"> <?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?>
                                                            </td>
                                                            <td> <?php echo $selected_data["email"]; ?></td>
                                                            <td class="text-success fw-bold"> <?php echo $selected_data["mobile"]; ?> </td>
                                                            <td><?php echo $pdate; ?> </td>
                                                            <?php
                                                            if ($selected_data["status_satatus_id"] == 1) {
                                                            ?>
                                                                <td style="padding-left: 0px;" class="pt-3"><button onclick="blockUser('<?php echo $selected_data['email']; ?>');" class="btn btn-danger col-12">Block</button></td>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <td style="padding-left: 0px;" class="pt-3"><button onclick="blockUser('<?php echo $selected_data['email']; ?>');" class="btn btn-success col-12">Unblock</button></td>
                                                            <?php
                                                            }
                                                            ?>
                                                        </tr>
                                                    <?php

                                                    }

                                                    ?>

                                                </tbody>
                                            </table>
                                        </div>
                                        <!--  -->
                                        <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3 mt-5">
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination pagination-sm justify-content-center border-0">
                                                    <li class="page-item">
                                                        <a class="page-link" href="<?php if ($pageno <= 1) {
                                                                                        echo ("#");
                                                                                    } else {
                                                                                        echo "?page=" . ($pageno - 1);
                                                                                    } ?>" aria-label="Previous">
                                                            <span style="color: #ff4157;" aria-hidden="true">&laquo;</span>
                                                        </a>
                                                    </li>
                                                    <?php
                                                    for ($x = 1; $x <= $number_of_pages; $x++) {
                                                        if ($x == $pageno) {
                                                    ?>
                                                            <li class="page-item active">
                                                                <a style="background-color: #ff4157; border-color:#ff4157" class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                                            </li>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <li class="page-item">
                                                                <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                                            </li>
                                                    <?php
                                                        }
                                                    }
                                                    ?>

                                                    <li class="page-item">
                                                        <a class="page-link" href="<?php if ($pageno >= $number_of_pages) {
                                                                                        echo ("#");
                                                                                    } else {
                                                                                        echo "?page=" . ($pageno + 1);
                                                                                    } ?>" aria-label="Next">
                                                            <span style="color: #ff4157;" aria-hidden="true">&raquo;</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>

                                        <!--  -->
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
        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
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
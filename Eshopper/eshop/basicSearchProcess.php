<?php
include "connection.php";

$txt = $_POST["t"];
$select = $_POST["s"];


$query = "SELECT * FROM `product` ";


if (!empty($txt) && $select == 0) {
    $query .= "WHERE `title` LIKE '%" . $txt . "%'";
} else if (empty($txt) && $select != 0) {
    $query .= "WHERE `category_cat_id` = '" . $select . "'";
} else if (!empty($txt) && $select != 0) {
    $query .= "WHERE `title` LIKE '%" . $txt . "%' AND `category_cat_id`='" . $select . "'";
}

?>

<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="index.php">Home<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="products.php">Products</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->

<!-- Product Style -->
<section class="product-area shop-sidebar shop section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-12 ">
                <div class="shop-sidebar">
                    <style>
                        .single-widget.range {
                            text-align: center;
                        }

                        .select-container {
                            display: inline-block;
                            text-align: left;
                        }

                        select {
                            width: 100%;
                        }
                    </style>

                    <div class="single-widget range mt-0">
                        <h3 class="title">Categories</h3>
                        <div class="select-container">
                            <select id="cat">
                                <option value="0" selected="selected">Select Category</option>
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
                        </div>
                    </div>

                    <div class="single-widget range">
                        <h3 class="title">Brands</h3>
                        <div class="select-container">
                            <select id="b">
                                <option class="" value="0" selected="selected">Select Brand</option>
                                <?php
                                $brand_rs = Database::search("SELECT * FROM `brand` ");
                                $brand_num = $brand_rs->num_rows;


                                for ($x = 0; $x < $brand_num; $x++) {
                                    $brand_data = $brand_rs->fetch_assoc();
                                ?>
                                    <option id="<?php echo $brand_data["brand_id"]; ?>">
                                        <?php echo $brand_data["brand_name"]; ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="single-widget range">
                        <h3 class="title">Colours</h3>
                        <div class="select-container">
                            <select id="clr">
                                <option class="" value="0" selected="selected">Select Colour</option>

                                <?php
                                $clr_rs = Database::search("SELECT * FROM `color`");
                                $clr_num = $clr_rs->num_rows;

                                for ($x = 0; $x < $clr_num; $x++) {
                                    $clr_data = $clr_rs->fetch_assoc();
                                ?>
                                    <option id="<?php echo $clr_data["clr_id"]; ?>" value="<?php echo $clr_data["clr_id"]; ?>">
                                        <?php echo $clr_data["name"]; ?>
                                    </option>

                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="single-widget range">
                        <h3 class="title">Sort By</h3>
                        <div class="select-container">
                            <select id="s">
                                <option class="" value="1" selected="selected">Price High to Low</option>
                                <option value="2">
                                    Price Low to High
                                </option>
                                <option value="3">
                                    Quantity High to Low
                                </option>
                                <option value="4">
                                    Quantity Low to High
                                </option>
                            </select>
                        </div>
                    </div>


                    <div class="mt-5">
                        <button style="height: 68px;" class="col-12 btn btn-danger fs-6" onclick="filterBy(0);"> Filter</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-8 col-12">

                <div class="row">

                    <?php

                    $pageno;

                    if ("0" != ($_POST["page"])) {
                        $pageno = $_POST["page"];
                    } else {
                        $pageno = 1;
                    }

                    $product_rs = Database::search($query);

                    $product_num = $product_rs->num_rows;

                    $results_per_page = 6;
                    $number_of_pages = ceil($product_num / $results_per_page);

                    $page_results = ($pageno - 1) * $results_per_page;
                    $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                    $selected_num = $selected_rs->num_rows;
                    for ($x = 0; $x < $selected_num; $x++) {
                        $selected_data = $selected_rs->fetch_assoc();

                    ?>

                        <div class="col-lg-4 col-md-6 col-12">

                            <?php
                            $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_product_id` = '" . $selected_data["product_id"] . "'");

                            $img_data = $img_rs->fetch_assoc();


                            ?>
                            <div class="d-flex justify-content-center m-3">
                                <div class="single-product border border-light m-1">
                                    <div class="product-img">
                                        <div class="justify-content-center m-4">
                                            <a href="product-details.html">
                                                <img class="default-img" src="<?php echo ($img_data["img_path"]); ?>" alt="#">
                                                <img class="hover-img" src="<?php echo ($img_data["img_path"]); ?>" alt="#">
                                            </a>
                                        </div>
                                        <div class="button-head">
                                            <div class="product-action m-2">
                                                <!-- <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a> -->
                                                <a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
                                                <a title="cart" href="#"><i class="ti-shopping-cart"></i><span>Add to cart</span></a>
                                            </div>
                                            <div class="product-action-2 m-2">
                                                <a title="Buy Now" href="#">Buy Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-content mt-2">
                                        <h3><a href="#"><?php echo ($selected_data["title"]); ?></a></h3>
                                        <div class="product-price">
                                            <span class="text-danger">Rs. <?php echo ($selected_data["price"]); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                    <?php
                    }

                    ?>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row no-gutters">

                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                            <!-- Product Slider -->
                                            <div class="product-gallery">
                                                <div class="quickview-slider-active">

                                                    <div class="single-slider">
                                                        <img src="<?php echo ($img_data2["img_path"]); ?>" alt="#">
                                                        </div?>

                                                    </div>
                                                </div>
                                                <!-- End Product slider -->
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                                <div class="quickview-content">
                                                    <h2><?php echo $img_data["title"]; ?></h2>
                                                    <div class="quickview-ratting-review">
                                                        <div class="quickview-ratting-wrap">
                                                            <div class="quickview-ratting">
                                                                <i class="yellow fa fa-star"></i>
                                                                <i class="yellow fa fa-star"></i>
                                                                <i class="yellow fa fa-star"></i>
                                                                <i class="yellow fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                            </div>
                                                            <a href="#"> (1 customer review)</a>
                                                        </div>
                                                        <div class="quickview-stock">
                                                            <span><i class="fa fa-check-circle-o"></i> in stock</span>
                                                        </div>
                                                    </div>
                                                    <h3>$29.00</h3>
                                                    <div class="quickview-peragraph">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia iste laborum ad impedit pariatur esse optio tempora sint ullam autem deleniti nam in quos qui nemo ipsum numquam.</p>
                                                    </div>
                                                    <div class="size">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-12">
                                                                <h5 class="title">Size</h5>
                                                                <select>
                                                                    <option selected="selected">s</option>
                                                                    <option>m</option>
                                                                    <option>l</option>
                                                                    <option>xl</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-6 col-12">
                                                                <h5 class="title">Color</h5>
                                                                <select>
                                                                    <option selected="selected">orange</option>
                                                                    <option>purple</option>
                                                                    <option>black</option>
                                                                    <option>pink</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="quantity">
                                                        <!-- Input Order -->
                                                        <div class="input-group">
                                                            <div class="button minus">
                                                                <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                                                                    <i class="ti-minus"></i>
                                                                </button>
                                                            </div>
                                                            <input type="text" name="quant[1]" class="input-number" data-min="1" data-max="1000" value="1">
                                                            <div class="button plus">
                                                                <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
                                                                    <i class="ti-plus"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <!--/ End Input Order -->
                                                    </div>
                                                    <div class="add-to-cart">
                                                        <a href="#" class="btn">Add to cart</a>
                                                        <a href="#" class="btn min"><i class="ti-heart"></i></a>
                                                        <a href="#" class="btn min"><i class="fa fa-compress"></i></a>
                                                    </div>
                                                    <div class="default-social">
                                                        <h4 class="share-now">Share:</h4>
                                                        <ul>
                                                            <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                                            <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                                            <li><a class="youtube" href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                                            <li><a class="dribbble" href="#"><i class="fa fa-google-plus"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Quick View -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal end -->

                    </div>
                </div>
            </div>
        </div>
        <section class="mb-5">
            <style>
                .pagination-container {
                    position: fixed;
                    bottom: 0;
                    left: 0;
                    width: 100%;
                    background-color: white;
                    /* Change background color as needed */
                    z-index: 999;
                    /* Ensure it's above other content */
                }

                .pagination {
                    display: flex;
                    justify-content: center;
                }

                .pagination .page-item {
                    list-style: none;
                    margin: 0 5px;
                    color: #ff4157;
                }
            </style>

            <div aria-label="Page navigation example ">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" <?php if ($pageno <= 1) {
                                                    echo ("#");
                                                } else {
                                                ?> onclick="basicSearch(<?php echo ($pageno - 1); ?>);" ; <?php
                                                                                                        } ?> aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php
                    for ($x = 1; $x <= $number_of_pages; $x++) {
                        if ($x == $pageno) {
                    ?>
                            <li class="page-item active">
                                <a  style="background-color: #ff4157; border-color:#ff4157" class="page-link" onclick="basicSearch(<?php echo ($x); ?>);"><?php echo $x; ?></a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="page-item">
                                <a class="page-link" onclick="basicSearch(<?php echo ($x); ?>);"><?php echo $x; ?></a>
                            </li>
                    <?php
                        }
                    }
                    ?>

                    <li class="page-item">
                        <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                    echo ("#");
                                                } else {
                                                ?> onclick="basicSearch(<?php echo ($pageno + 1); ?>);" ; <?php
                                                                                                        } ?> aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </div>
        </section>
    </div>
</section>
<!--/ End Product Style 1  -->


<?php

?>
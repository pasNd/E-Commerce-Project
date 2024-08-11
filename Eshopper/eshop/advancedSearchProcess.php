<?php
include "connection.php";

$category = $_POST["cat"];
$brand = $_POST["b"];
$color = $_POST["col"];
$sort = $_POST["s"];

$query = "SELECT * FROM `product`";
$status = 0;

if ($sort == 1) {

    if ($category != 0) {
        $query .= " WHERE `category_cat_id` = '" . $category . "'";
    }

    if ($brand != 0) {
        $bid_rs = Database::search("SELECT * FROM `brand` WHERE `brand_id` = '" . $brand . "'");
        $bid_data = $bid_rs->fetch_assoc();
        $bid = $bid_data["brand_id"];
        if ($category != 0) {
            $query .= " AND";
        } else {
            $query .= " WHERE";
        }
        $query .= " `brand_brand_id` = '" . $bid . "'";
    }

    if ($color != 0) {
        $clr_rs = Database::search("SELECT * FROM `product_has_color` WHERE `color_clr_id`='" . $color . "'");
        $clr_data = $clr_rs->fetch_assoc();
        $cid = $clr_data["product_product_id"];

        if ($category != 0 || $brand != 0) {
            $query .= " AND";
        } else {
            $query .= " WHERE";
        }
        $query .= " `product_id` = '" . $cid . "'";
    }

    $query .= " ORDER BY `price` DESC";
} else if ($sort == 2) {

    if ($category != 0) {
        $query .= " WHERE `category_cat_id` = '" . $category . "'";
    }

    if ($brand != 0) {
        $bid_rs = Database::search("SELECT * FROM `brand` WHERE `brand_id` = '" . $brand . "'");
        $bid_data = $bid_rs->fetch_assoc();
        $bid = $bid_data["brand_id"];
        if ($category != 0) {
            $query .= " AND";
        } else {
            $query .= " WHERE";
        }
        $query .= " `brand_brand_id` = '" . $bid . "'";
    }

    if ($color != 0) {
        $clr_rs = Database::search("SELECT * FROM `product_has_color` WHERE `color_clr_id`='" . $color . "'");
        $clr_data = $clr_rs->fetch_assoc();
        $cid = $clr_data["product_product_id"];

        if ($category != 0 || $brand != 0) {
            $query .= " AND";
        } else {
            $query .= " WHERE";
        }
        $query .= " `product_id` = '" . $cid . "'";
    }

    $query .= " ORDER BY `price` ASC";
}else if ($sort == 3) {

    if ($category != 0) {
        $query .= " WHERE `category_cat_id` = '" . $category . "'";
    }

    if ($brand != 0) {
        $bid_rs = Database::search("SELECT * FROM `brand` WHERE `brand_id` = '" . $brand . "'");
        $bid_data = $bid_rs->fetch_assoc();
        $bid = $bid_data["brand_id"];
        if ($category != 0) {
            $query .= " AND";
        } else {
            $query .= " WHERE";
        }
        $query .= " `brand_brand_id` = '" . $bid . "'";
    }

    if ($color != 0) {
        $clr_rs = Database::search("SELECT * FROM `product_has_color` WHERE `color_clr_id`='" . $color . "'");
        $clr_data = $clr_rs->fetch_assoc();
        $cid = $clr_data["product_product_id"];

        if ($category != 0 || $brand != 0) {
            $query .= " AND";
        } else {
            $query .= " WHERE";
        }
        $query .= " `product_id` = '" . $cid . "'";
    }

    $query .= " ORDER BY `qty` DESC";
} else if ($sort == 4) {

    if ($category != 0) {
        $query .= " WHERE `category_cat_id` = '" . $category . "'";
    }

    if ($brand != 0) {
        $bid_rs = Database::search("SELECT * FROM `brand` WHERE `brand_id` = '" . $brand . "'");
        $bid_data = $bid_rs->fetch_assoc();
        $bid = $bid_data["brand_id"];
        if ($category != 0) {
            $query .= " AND";
        } else {
            $query .= " WHERE";
        }
        $query .= " `brand_brand_id` = '" . $bid . "'";
    }

    if ($color != 0) {
        $clr_rs = Database::search("SELECT * FROM `product_has_color` WHERE `color_clr_id`='" . $color . "'");
        $clr_data = $clr_rs->fetch_assoc();
        $cid = $clr_data["product_product_id"];

        if ($category != 0 || $brand != 0) {
            $query .= " AND";
        } else {
            $query .= " WHERE";
        }
        $query .= " `product_id` = '" . $cid . "'";
    }

    $query .= " ORDER BY `qty` ASC";
}

?>

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
                                <option value="<?php echo $brand_data["brand_id"]; ?>">
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
                                <option value="<?php echo $clr_data["clr_id"]; ?>">
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
            <div class="row ">

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

                    $product_id = $selected_data["product_id"];

                    $img_rs = Database::search("SELECT * FROM `product` INNER JOIN product_img ON product.product_id = product_img.product_product_id
												WHERE `product_id` = '" . $product_id . "'");

                    $img_data = $img_rs->fetch_assoc();

                ?>

                    <div class="col-lg-4 col-md-6 col-12">
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
                                <div class="product-content m-2">
                                    <h3><a href="product-details.html"><?php echo ($selected_data["title"]); ?></a></h3>
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



            </div>
        </div>
    </div>

    <section class="mb-5">
        <style>
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
                                            ?> onclick="filterBy(<?php echo ($pageno - 1); ?>);" ; <?php
                                                                                                        } ?> aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php
                for ($x = 1; $x <= $number_of_pages; $x++) {
                    if ($x == $pageno) {
                ?>
                        <li class="page-item active">
                            <a class="page-link" onclick="filterBy(<?php echo ($x); ?>);"><?php echo $x; ?></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item">
                            <a class="page-link" onclick="filterBy(<?php echo ($x); ?>);"><?php echo $x; ?></a>
                        </li>
                <?php
                    }
                }
                ?>

                <li class="page-item">
                    <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="filterBy(<?php echo ($pageno + 1); ?>);" ; <?php
                                                                                                        } ?> aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </div>
    </section>
</div>

<?php




?>
<?php
require_once('../sql_connection/config.php');

?>
<!DOCTYPE html>
<html class="no-js" lang="en-US">

<head>
    <meta charset="UTF-8">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ZIG CUSTOMIZED</title>
    <!-- Standard Favicon -->
    <link src="../assets/images/favicon/favicon.ico" rel="shortcut icon">
    <!-- Base Google Font for Web-app -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <!-- Google Fonts for Banners only -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,800" rel="stylesheet">
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Font Awesome 5 -->
    <link rel="stylesheet" href="../assets/css/fontawesome.min.css">
    <!-- Ion-Icons 4 -->
    <link rel="stylesheet" href="../assets/css/ionicons.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <!-- Owl-Carousel -->
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <!-- Jquery-Ui-Range-Slider -->
    <link rel="stylesheet" href="../assets/css/jquery-ui-range-slider.min.css">
    <!-- Utility -->
    <link rel="stylesheet" href="../assets/css/utility.css">
    <!-- Main -->
    <link rel="stylesheet" href="../assets/css/bundle.css">
</head>

<body>

<!-- app -->
<div id="app">
    <!-- Header -->
    <?php include("../include/header.php"); ?>
    <!-- Header /- -->
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>New Arrivals</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="../index.html">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="./custom-deal-page.php">New Arrivals</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->

    <!-- Custom-Deal-Page -->

    <?php

    // Get sorting parameters from URL
    $sortBy = $_GET['sort'] ?? 'created_at';
    $sortOrder = $_GET['order'] ?? 'DESC';
    $itemsPerPage = $_GET['show'] ?? 8;
    $currentPage = $_GET['page'] ?? 1;

    // Validate sorting parameters
    $allowedSortColumns = ['created_at', 'price', 'name', 'discount'];
    $sortBy = in_array($sortBy, $allowedSortColumns) ? $sortBy : 'created_at';
    $sortOrder = strtoupper($sortOrder) === 'ASC' ? 'ASC' : 'DESC';
    $itemsPerPage = in_array($itemsPerPage, [8, 16, 28]) ? $itemsPerPage : 8;
    $currentPage = max(1, (int)$currentPage);

    // Function to get newest products with sorting and pagination
    function getNewProducts($pdo, $sortBy, $sortOrder, $limit, $offset) {
        $twoWeeksAgo = date('Y-m-d H:i:s', strtotime('-2 weeks'));
        
        // Special case for discount sorting
        if ($sortBy === 'discount') {
            $query = "SELECT *, 
                    CASE WHEN original_price > 0 
                        THEN ROUND(((original_price - price) / original_price) * 100, 2) 
                        ELSE 0 
                    END AS discount_percent
                    FROM products 
                    WHERE created_at >= :twoWeeksAgo
                    ORDER BY discount_percent $sortOrder
                    LIMIT :limit OFFSET :offset";
        } else {
            $query = "SELECT * FROM products 
                    WHERE created_at >= :twoWeeksAgo
                    ORDER BY $sortBy $sortOrder
                    LIMIT :limit OFFSET :offset";
        }
        
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':twoWeeksAgo', $twoWeeksAgo);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Function to count total new products
    function countNewProducts($pdo) {
        $twoWeeksAgo = date('Y-m-d H:i:s', strtotime('-2 weeks'));
        
        $query = "SELECT COUNT(*) FROM products WHERE created_at >= :twoWeeksAgo";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':twoWeeksAgo', $twoWeeksAgo);
        $stmt->execute();
        
        return $stmt->fetchColumn();
    }

    // Calculate pagination values
    $totalProducts = countNewProducts($pdo);
    $totalPages = ceil($totalProducts / $itemsPerPage);
    $offset = ($currentPage - 1) * $itemsPerPage;

    // Get products for current page
    $newProducts = getNewProducts($pdo, $sortBy, $sortOrder, $itemsPerPage, $offset);

    // Function to generate sorting URL
        function getSortUrl($sortField, $order = null) {
        global $sortBy, $sortOrder, $itemsPerPage;
        
        // Fix the ternary operator with proper parentheses
        $order = $order ? $order : 
                (($sortBy === $sortField && $sortOrder === 'DESC') ? 'ASC' : 'DESC');
        
        $params = [
            'sort' => $sortField,
            'order' => $order,
            'show' => $itemsPerPage,
            'page' => 1 // Reset to first page when changing sort
        ];
        
        return '?' . http_build_query($params);
    }
    ?>

    <div class="page-deal u-s-p-t-80">
        <div class="container">
            <div class="deal-page-wrapper">
                <h1 class="deal-heading">New Arrivals</h1>
                <h6 class="deal-has-total-items"><?= $totalProducts ?> Items</h6>
            </div>
            
            <!-- Page-Bar -->
            <div class="page-bar clearfix">
                <div class="shop-settings">
                    <a id="list-anchor">
                        <i class="fas fa-th-list"></i>
                    </a>
                    <a id="grid-anchor" class="active">
                        <i class="fas fa-th"></i>
                    </a>
                </div>
                
                <!-- Toolbar Sorter 1 -->
                <div class="toolbar-sorter">
                    <div class="select-box-wrapper">
                        <label class="sr-only" for="sort-by">Sort By</label>
                        <select class="select-box" id="sort-by" onchange="window.location.href=this.value">
                            <option value="<?= getSortUrl('created_at') ?>" 
                                <?= $sortBy === 'created_at' ? 'selected' : '' ?>>
                                Sort By: <?= $sortBy === 'created_at' ? ($sortOrder === 'DESC' ? 'Newest' : 'Oldest') : 'Newest' ?>
                            </option>
                            <option value="<?= getSortUrl('price', 'ASC') ?>" 
                                <?= $sortBy === 'price' && $sortOrder === 'ASC' ? 'selected' : '' ?>>
                                Sort By: Lowest Price
                            </option>
                            <option value="<?= getSortUrl('price', 'DESC') ?>" 
                                <?= $sortBy === 'price' && $sortOrder === 'DESC' ? 'selected' : '' ?>>
                                Sort By: Highest Price
                            </option>
                            <option value="<?= getSortUrl('discount', 'DESC') ?>" 
                                <?= $sortBy === 'discount' ? 'selected' : '' ?>>
                                Sort By: Best Discount
                            </option>
                            <option value="<?= getSortUrl('name', 'ASC') ?>" 
                                <?= $sortBy === 'name' ? 'selected' : '' ?>>
                                Sort By: Name (A-Z)
                            </option>
                        </select>
                    </div>
                </div>
                
                <!-- Toolbar Sorter 2 -->
                <div class="toolbar-sorter-2">
                    <div class="select-box-wrapper">
                        <label class="sr-only" for="show-records">Show Records Per Page</label>
                        <select class="select-box" id="show-records" onchange="updateItemsPerPage(this.value)">
                            <option value="8" <?= $itemsPerPage == 8 ? 'selected' : '' ?>>Show: 8</option>
                            <option value="16" <?= $itemsPerPage == 16 ? 'selected' : '' ?>>Show: 16</option>
                            <option value="28" <?= $itemsPerPage == 28 ? 'selected' : '' ?>>Show: 28</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- Page-Bar /- -->
            
            <!-- Row-of-Product-Container -->
            <div class="row product-container grid-style">
                <?php foreach ($newProducts as $product): 
                    // Get the first image if there are multiple
                    $images = explode(',', $product['image_path']);
                    $mainImage = $images[0];
                    $thumbnail = $product['thumbnail_path'];
                    
                    // Format price display
                    $price = number_format($product['price'], 2);
                    $originalPrice = $product['original_price'] ? number_format($product['original_price'], 2) : null;

                    // Calculate discount percentage
                    $discountPercent = 0;
                    if ($product['original_price'] > 0 && $product['price'] < $product['original_price']) {
                        $discountPercent = round((($product['original_price'] - $product['price']) / $product['original_price']) * 100);
                    }
                ?>
                    <div class="product-item col-6 col-lg-3 mb-3">
                        <div class="item">
                            <div class="image-container">
                                <a class="item-img-wrapper-link" href="./single-product.php?id=<?= $product['id'] ?>">
                                    <img class="img-fluid" src="<?= $mainImage ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                                </a>
                                <div class="item-action-behaviors">
                                    <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look</a>
                                    <a class="item-mail" href="javascript:void(0)">Mail</a>
                                    <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                    <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                </div>
                            </div>
                            <div class="item-content">
                                <div class="what-product-is">
                                    <ul class="bread-crumb">
                                        <li class="has-separator">
                                            <a href="?category=<?= urlencode($product['category']) ?>">
                                                <?= htmlspecialchars($product['category']) ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="?subcategory=<?= urlencode($product['sub_category']) ?>">
                                                <?= htmlspecialchars($product['sub_category']) ?>
                                            </a>
                                        </li>
                                    </ul>
                                    <h6 class="item-title">
                                        <a href="./single-product.php?id=<?= $product['id'] ?>">
                                            <?= htmlspecialchars($product['name']) ?>
                                        </a>
                                    </h6>
                                    <div class="item-description">
                                        <p><?= htmlspecialchars(substr($product['description'], 0, 150)) ?>...</p>
                                    </div>
                                    <div class="item-stars">
                                        <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                            <span style='width:67px'></span>
                                        </div>
                                        <span>(23)</span>
                                    </div>
                                </div>
                                <div class="price-template">
                                    <div class="item-new-price">
                                        $<?= $price ?>
                                    </div>
                                    <?php if ($originalPrice): ?>
                                        <div class="item-old-price">
                                            $<?= $originalPrice ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if ($discountPercent > 0): ?>
                                <div class="tag discount">
                                    <span>-<?= $discountPercent ?>%</span>
                                </div>
                            <?php endif; ?>
                            <div class="tag new">
                                <span>NEW</span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- Row-of-Product-Container /- -->
            
            <!-- Shop-Pagination -->
            <div class="pagination-area">
                <div class="pagination-number">
                    <ul>
                        <!-- Previous Page Link -->
                        <li <?= $currentPage == 1 ? 'style="display:none"' : '' ?>>
                            <a href="<?= getSortUrl($sortBy, $sortOrder, $currentPage - 1) ?>" title="Previous">
                                <i class="fa fa-angle-left"></i>
                            </a>
                        </li>
                        
                        <!-- Page Numbers -->
                        <?php 
                        $startPage = max(1, $currentPage - 2);
                        $endPage = min($totalPages, $currentPage + 2);
                        
                        if ($startPage > 1): ?>
                            <li>
                                <a href="<?= getSortUrl($sortBy, $sortOrder, 1) ?>">1</a>
                            </li>
                            <?php if ($startPage > 2): ?>
                                <li>
                                    <a href="javascript:void(0)">...</a>
                                </li>
                            <?php endif;
                        endif;
                        
                        for ($i = $startPage; $i <= $endPage; $i++): ?>
                            <li class="<?= $i == $currentPage ? 'active' : '' ?>">
                                <a href="<?= getSortUrl($sortBy, $sortOrder, $i) ?>"><?= $i ?></a>
                            </li>
                        <?php endfor;
                        
                        if ($endPage < $totalPages): ?>
                            <?php if ($endPage < $totalPages - 1): ?>
                                <li>
                                    <a href="javascript:void(0)">...</a>
                                </li>
                            <?php endif; ?>
                            <li>
                                <a href="<?= getSortUrl($sortBy, $sortOrder, $totalPages) ?>"><?= $totalPages ?></a>
                            </li>
                        <?php endif; ?>
                        
                        <!-- Next Page Link -->
                        <li <?= $currentPage == $totalPages ? 'style="display:none"' : '' ?>>
                            <a href="<?= getSortUrl($sortBy, $sortOrder, $currentPage + 1) ?>" title="Next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Shop-Pagination /- -->
        </div>
    </div>

    <script>
    function updateItemsPerPage(value) {
        const url = new URL(window.location.href);
        url.searchParams.set('show', value);
        url.searchParams.set('page', 1); // Reset to first page
        window.location.href = url.toString();
    }
    </script>
    
    <!-- Custom-Deal-Page -->

    <!-- Footer -->
    <?php include("../include/footer.php"); ?>
    <!-- Footer /- -->
    <!-- Dummy Selectbox -->
    <div class="select-dummy-wrapper">
        <select id="compute-select">
            <option id="compute-option">All</option>
        </select>
    </div>
    <!-- Dummy Selectbox /- -->
    <!-- Responsive-Search -->
    <div class="responsive-search-wrapper">
        <button type="button" class="button ion ion-md-close" id="responsive-search-close-button"></button>
        <div class="responsive-search-container">
            <div class="container">
                <p>Start typing and press Enter to search</p>
                <form class="responsive-search-form">
                    <label class="sr-only" for="search-text">Search</label>
                    <input id="search-text" type="text" class="responsive-search-field" placeholder="PLEASE SEARCH">
                    <i class="fas fa-search"></i>
                </form>
            </div>
        </div>
    </div>
    <!-- Responsive-Search /- -->
    <!-- Quick-view-Modal -->
    <div id="quick-view" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="button dismiss-button ion ion-ios-close" data-dismiss="modal"></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <!-- Product-zoom-area -->
                            <div class="zoom-area">
                                <img id="zoom-pro-quick-view" class="img-fluid" src="../assets/images/product/product@4x.jpg" data-zoom-image="images/product/product@4x.jpg" alt="Zoom Image">
                                <div id="gallery-quick-view" class="u-s-m-t-10">
                                    <a class="active" data-image="images/product/product@4x.jpg" data-zoom-image="images/product/product@4x.jpg">
                                        <img src="../assets/images/product/product@2x.jpg" alt="Product">
                                    </a>
                                    <a data-image="images/product/product@4x.jpg" data-zoom-image="images/product/product@4x.jpg">
                                        <img src="../assets/images/product/product@2x.jpg" alt="Product">
                                    </a>
                                    <a data-image="images/product/product@4x.jpg" data-zoom-image="images/product/product@4x.jpg">
                                        <img src="../assets/images/product/product@2x.jpg" alt="Product">
                                    </a>
                                    <a data-image="images/product/product@4x.jpg" data-zoom-image="images/product/product@4x.jpg">
                                        <img src="../assets/images/product/product@2x.jpg" alt="Product">
                                    </a>
                                    <a data-image="images/product/product@4x.jpg" data-zoom-image="images/product/product@4x.jpg">
                                        <img src="../assets/images/product/product@2x.jpg" alt="Product">
                                    </a>
                                    <a data-image="images/product/product@4x.jpg" data-zoom-image="images/product/product@4x.jpg">
                                        <img src="../assets/images/product/product@2x.jpg" alt="Product">
                                    </a>
                                </div>
                            </div>
                            <!-- Product-zoom-area /- -->
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <!-- Product-details -->
                            <div class="all-information-wrapper">
                                <div class="section-1-title-breadcrumb-rating">
                                    <div class="product-title">
                                        <h1>
                                            <a href="./single-product.php">Casual Hoodie Full Cotton</a>
                                        </h1>
                                    </div>
                                    <ul class="bread-crumb">
                                        <li class="has-separator">
                                            <a href="../index.html">Home</a>
                                        </li>
                                        <li class="has-separator">
                                            <a href="./shop-v1-root-category.php">Men's Clothing</a>
                                        </li>
                                        <li class="has-separator">
                                            <a href="./shop-v2-sub-category.php">Tops</a>
                                        </li>
                                        <li class="is-marked">
                                            <a href="./shop-v3-sub-sub-category.php">Hoodies</a>
                                        </li>
                                    </ul>
                                    <div class="product-rating">
                                        <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                            <span style='width:67px'></span>
                                        </div>
                                        <span>(23)</span>
                                    </div>
                                </div>
                                <div class="section-2-short-description u-s-p-y-14">
                                    <h6 class="information-heading u-s-m-b-8">Description:</h6>
                                    <p>This hoodie is full cotton. It includes a muff sewn onto the lower front, and (usually) a drawstring to adjust the hood opening. Throughout the U.S., it is common for middle-school, high-school, and college students to wear this sweatshirts—with or without hoods—that display their respective school names or mascots across the chest, either as part of a uniform or personal preference.
                                    </p>
                                </div>
                                <div class="section-3-price-original-discount u-s-p-y-14">
                                    <div class="price">
                                        <h4>$55.00</h4>
                                    </div>
                                    <div class="original-price">
                                        <span>Original Price:</span>
                                        <span>$60.00</span>
                                    </div>
                                    <div class="discount-price">
                                        <span>Discount:</span>
                                        <span>8%</span>
                                    </div>
                                    <div class="total-save">
                                        <span>Save:</span>
                                        <span>$5</span>
                                    </div>
                                </div>
                                <div class="section-4-sku-information u-s-p-y-14">
                                    <h6 class="information-heading u-s-m-b-8">Sku Information:</h6>
                                    <div class="availability">
                                        <span>Availability:</span>
                                        <span>In Stock</span>
                                    </div>
                                    <div class="left">
                                        <span>Only:</span>
                                        <span>50 left</span>
                                    </div>
                                </div>
                                <div class="section-5-product-variants u-s-p-y-14">
                                    <h6 class="information-heading u-s-m-b-8">Product Variants:</h6>
                                    <div class="color u-s-m-b-11">
                                        <span>Available Color:</span>
                                        <div class="color-variant select-box-wrapper">
                                            <select class="select-box product-color">
                                                <option value="1">Heather Grey</option>
                                                <option value="3">Black</option>
                                                <option value="5">White</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="sizes u-s-m-b-11">
                                        <span>Available Size:</span>
                                        <div class="size-variant select-box-wrapper">
                                            <select class="select-box product-size">
                                                <option value="">Male 2XL</option>
                                                <option value="">Male 3XL</option>
                                                <option value="">Kids 4</option>
                                                <option value="">Kids 6</option>
                                                <option value="">Kids 8</option>
                                                <option value="">Kids 10</option>
                                                <option value="">Kids 12</option>
                                                <option value="">Female Small</option>
                                                <option value="">Male Small</option>
                                                <option value="">Female Medium</option>
                                                <option value="">Male Medium</option>
                                                <option value="">Female Large</option>
                                                <option value="">Male Large</option>
                                                <option value="">Female XL</option>
                                                <option value="">Male XL</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="section-6-social-media-quantity-actions u-s-p-y-14">
                                    <form action="#" class="post-form">
                                        <div class="quick-social-media-wrapper u-s-m-b-22">
                                            <span>Share:</span>
                                            <ul class="social-media-list">
                                                <li>
                                                    <a href="#">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="fab fa-google-plus-g"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="fas fa-rss"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="fab fa-pinterest"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="quantity-wrapper u-s-m-b-22">
                                            <span>Quantity:</span>
                                            <div class="quantity">
                                                <input type="text" class="quantity-text-field" value="1">
                                                <a class="plus-a" data-max="1000">&#43;</a>
                                                <a class="minus-a" data-min="1">&#45;</a>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="button button-outline-secondary" type="submit">Add to cart</button>
                                            <button class="button button-outline-secondary far fa-heart u-s-m-l-6"></button>
                                            <button class="button button-outline-secondary far fa-envelope u-s-m-l-6"></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Product-details /- -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quick-view-Modal /- -->
</div>
<!-- app /- -->
<!--[if lte IE 9]>
<div class="app-issue">
    <div class="vertical-center">
        <div class="text-center">
            <h1>You are using an outdated browser.</h1>
            <span>This web app is not compatible with following browser. Please upgrade your browser to improve your security and experience.</span>
        </div>
    </div>
</div>
<style> #app {
    display: none;
} </style>
<![endif]-->
<!-- NoScript -->
<noscript>
    <div class="app-issue">
        <div class="vertical-center">
            <div class="text-center">
                <h1>JavaScript is disabled in your browser.</h1>
                <span>Please enable JavaScript in your browser or upgrade to a JavaScript-capable browser to register for Groover.</span>
            </div>
        </div>
    </div>
    <style>
    #app {
        display: none;
    }
    </style>
</noscript>
<!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
<script>
window.ga = function() {
    ga.q.push(arguments)
};
ga.q = [];
ga.l = +new Date;
ga('create', 'UA-XXXXX-Y', 'auto');
ga('send', 'pageview')
</script>
<script src="https://www.google-analytics.com/analytics.js" async defer></script>
<!-- Modernizr-JS -->
<script type="text/javascript" href="../assets/js/vendor/modernizr-custom.min.js"></script>
<!-- NProgress -->
<script type="text/javascript" href="../assets/js/nprogress.min.js"></script>
<!-- jQuery -->
<script type="text/javascript" href="../assets/js/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script type="text/javascript" href="../assets/js/bootstrap.min.js"></script>
<!-- Popper -->
<script type="text/javascript" href="../assets/js/popper.min.js"></script>
<!-- ScrollUp -->
<script type="text/javascript" href="../assets/js/jquery.scrollUp.min.js"></script>
<!-- Elevate Zoom -->
<script type="text/javascript" href="../assets/js/jquery.elevatezoom.min.js"></script>
<!-- jquery-ui-range-slider -->
<script type="text/javascript" href="../assets/js/jquery-ui.range-slider.min.js"></script>
<!-- jQuery Slim-Scroll -->
<script type="text/javascript" href="../assets/js/jquery.slimscroll.min.js"></script>
<!-- jQuery Resize-Select -->
<script type="text/javascript" href="../assets/js/jquery.resize-select.min.js"></script>
<!-- jQuery Custom Mega Menu -->
<script type="text/javascript" href="../assets/js/jquery.custom-megamenu.min.js"></script>
<!-- jQuery Countdown -->
<script type="text/javascript" href="../assets/js/jquery.custom-countdown.min.js"></script>
<!-- Owl Carousel -->
<script type="text/javascript" href="../assets/js/owl.carousel.min.js"></script>
<!-- Main -->
<script type="text/javascript" href="../assets/js/app.js"></script>
</body>
</html>

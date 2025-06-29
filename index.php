<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);

include("./sql_connection/config.php");

// Check if user is logged in and get role
$isLoggedIn = isset($_SESSION['user_id']);
$userRole = $isLoggedIn ? $_SESSION['role'] : null;

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
    <link href="./assets/images/favicon/favicon.ico" rel="shortcut icon">
    <!-- Base Google Font for Web-app -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <!-- Google Fonts for Banners only -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,800" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Font Awesome 5 -->
    <link rel="stylesheet" href="./assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/./assets/css/all.min.css">
    <!-- Ion-Icons 4 -->
    <link rel="stylesheet" href="./assets/css/ionicons.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="./assets/css/animate.min.css">
    <!-- Owl-Carousel -->
    <link rel="stylesheet" href="./assets/css/owl.carousel.min.css">
    <!-- Jquery-Ui-Range-Slider -->
    <link rel="stylesheet" href="./assets/css/jquery-ui-range-slider.min.css">
    <!-- Utility -->
    <link rel="stylesheet" href="./assets/css/utility.css">
    <!-- Main -->
    <link rel="stylesheet" href="./assets/css/bundle.css">
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</head>

<body>

<!-- app -->
<div id="app">
    <!-- Header -->
    <header>
        <!-- Top-Header -->
        <div class="full-layer-outer-header">
            <div class="container clearfix">
                    <nav>
                        <ul class="primary-nav g-nav">
                            <li>
                                <a href="tel:+231555711018">
                                    <i class="fas fa-phone u-c-brand u-s-m-r-9"></i>
                                    Telephone:+231555711018 / +231772878894</a>
                            </li>
                            <li>
                                <a href="mailto:ziggroupofcompanies231@gmail.com ">
                                    <i class="fas fa-envelope u-c-brand u-s-m-r-9"></i>
                                    E-mail: ziggroupofcompanies231@gmail.com 
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <nav>
                        <ul class="secondary-nav g-nav">
                            <li>
                                <a>My Account
                                    <i class="fas fa-chevron-down u-s-m-l-9"></i>
                                </a>
                                <ul class="g-dropdown" style="width:200px">
                                    <?php if ($isLoggedIn): ?>
                                        <!-- Show these when logged in -->
                                        <?php if ($userRole === 'Client'): ?>
                                        <li>
                                            <a href="../user/dashboard/viewprofile.php">
                                                <i class="fas fa-user"></i>
                                                Profile</a>
                                        </li>

                                            <!-- Show these only for clients -->
                                            <li>
                                                <a href="./user/dashboard/cart.php">
                                                    <i class="fas fa-cog u-s-m-r-9"></i>
                                                    My Cart</a>
                                            </li>
                                            <li>
                                                <a href="./user/dashboard/checkout.php">
                                                    <i class="far fa-check-circle u-s-m-r-9"></i>
                                                    Checkout</a>
                                            </li>
                                        <?php endif; ?>

                                        <li>
                                            <a href="./user/logout.php">
                                                <i class="fas fa-sign-out-alt"></i> 
                                                Logout</a>
                                        </li>
                                    <?php else: ?>
                                        <!-- Show these when not logged in -->
                                        <li>
                                            <a href="./pages/login.php">
                                                <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                                                Login / Signup</a>
                                        </li> 
                                    <?php endif; ?>
                                </ul>
                            </li>
                            <li>
                                <a>USD
                                    <i class="fas fa-chevron-down u-s-m-l-9"></i>
                                </a>
                                <ul class="g-dropdown" style="width:90px">
                                    <li>
                                        <a href="#" class="u-c-brand">($) USD</a>
                                    </li>
                                    <li>
                                        <a href="#">($) LRD</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a>ENG
                                    <i class="fas fa-chevron-down u-s-m-l-9"></i>
                                </a>
                                <ul class="g-dropdown" style="width:70px">
                                    <li>
                                        <a href="#" class="u-c-brand">ENG</a>
                                    </li>
                                </ul>
                            </li>

                            <?php if ($isLoggedIn && ($userRole === 'Admin' || $userRole === 'Products Admin')): ?>
                                <!-- Show Admin Dashboard button only for admins -->
                                <li>
                                    <a href="./admin/dashboard/dashboard.php">
                                        <button class="btn-dark"><strong>ADMIN DASHBOARD</strong></button>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        <!-- Top-Header /- -->
        <!-- Mid-Header -->
        <div class="full-layer-mid-header">
            <div class="container">
            <style>
@media screen and (max-width: 768px) {
    #mobile-header {
        flex-direction: row;
        justify-content: space-between;
    }

    #mobile-header .brand-logo {
        text-align: left !important;
    }

    #mobile-header nav {
        text-align: right !important;
        width: 100%;
    }

    #mobile-header .col-lg-6 {
        display: none !important; /* Hide search bar on mobile */
    }
}
</style>
            
                <div class="row clearfix align-items-center" id="mobile-header" style="display: flex; flex-wrap: wrap; align-items: center;">
                    <div class="col-lg-3 col-md-9 col-sm-6" style="flex: 1;">
                        <div class="brand-logo" style="text-align: left;">
                            <a href="index.php">
                                <img src="./assets/images/main-logo/ZIG.png" alt="ZIG CUSTOMIZED " class="app-brand-logo">
                            </a>
                        </div>
                    </div>

                    <?php
                        // Process search if form submitted
                        $searchResults = [];
                        $searchTerm = '';
                        $searchCategory = '';

                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
                            $searchTerm = trim($_POST['search']);
                            $searchCategory = $_POST['category'] ?? '';
                            
                            if (!empty($searchTerm)) {
                                try {
                                    // Base query
                                    $query = "SELECT p.* FROM products p WHERE p.name LIKE :search OR p.description LIKE :search";
                                    $params = [':search' => "%$searchTerm%"];
                                    
                                    // Add category filter if selected
                                    if (!empty($searchCategory) && $searchCategory !== 'all') {
                                        $query .= " AND (p.category = :category OR p.sub_category = :category)";
                                        $params[':category'] = $searchCategory;
                                    }
                                    
                                    // Add services search if selected
                                    if ($searchCategory === 'services') {
                                        $query = "SELECT * FROM services WHERE name LIKE :search OR description LIKE :search";
                                    }
                                    
                                    $stmt = $pdo->prepare($query);
                                    $stmt->execute($params);
                                    $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    
                                } catch (PDOException $e) {
                                    die("Search error: " . $e->getMessage());
                                }
                            }
                        }
                    ?>

                    <!-- Your existing search form with enhancements -->
                    <div class="col-lg-6 u-d-none-lg">
                        <form class="form-searchbox" method="post" action="search-results.php">
                            <label class="sr-only" for="search-landscape">Search</label>
                            <input id="search-landscape" name="search" type="text" class="text-field" 
                                placeholder="Search everything" value="<?= htmlspecialchars($searchTerm) ?>">
                            
                            <div class="select-box-position">
                                <div class="select-box-wrapper select-hide">
                                    <label class="sr-only" for="select-category">Choose category for search</label>
                                    <select class="select-box" id="select-category" name="category">
                                        <option value="all" <?= empty($searchCategory) || $searchCategory === 'all' ? 'selected' : '' ?>>All</option>
                                        
                                        <?php
                                        try {
                                            $productcategories = $pdo->query("SELECT * FROM productcategory")->fetchAll();
                                        } catch (PDOException $e) {
                                            die("Error fetching categories: " . $e->getMessage());
                                        }
                                        
                                        foreach ($productcategories as $productcategory): ?>
                                        <option value="<?= htmlspecialchars($productcategory['categoryname']) ?>"
                                            <?= $searchCategory === $productcategory['categoryname'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars(strtoupper($productcategory['categoryname'])) ?>
                                        </option>
                                        <?php endforeach; ?>
                                        
                                        <option value="services" <?= $searchCategory === 'services' ? 'selected' : '' ?>>Services</option>
                                    </select>
                                </div>
                            </div>
                            <button id="btn-search" type="submit" class="button button-primary fas fa-search"></button>
                        </form>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-6" style="flex: 1;">
                        <nav style="text-align: right;">
                            <ul class="mid-nav g-nav" style="margin: 0;">
                                <li class="u-d-none-lg">
                                    <a href="index.html">
                                        <i class="ion ion-md-home u-c-brand"></i>
                                    </a>
                                </li>
                                <li class="u-d-none-lg">
                                    <a href="./pages/wishlist.php">
                                        <i class="far fa-heart"></i>
                                    </a>
                                </li>
                                <li>
                                    <a id="mini-cart-trigger">
                                        <i class="ion ion-md-basket"></i>
                                        <span class="item-counter">0</span>
                                        <span class="item-price">$0.00</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mid-Header /- -->
        <!-- Responsive-Buttons -->
        <div class="fixed-responsive-container">
            <div class="fixed-responsive-wrapper">
                <button type="button" class="button fas fa-search" id="responsive-search"></button>
            </div>
            <div class="fixed-responsive-wrapper">
                <a href="./pages/wishlist.php">
                    <i class="far fa-heart"></i>
                    <span class="fixed-item-counter">0</span>
                </a>
            </div>
        </div>
        <!-- Responsive-Buttons /- -->
        <!-- Mini Cart -->
        <div class="mini-cart-wrapper">
            <div class="mini-cart">
                <div class="mini-cart-header">
                    YOUR CART
                    <button type="button" class="button ion ion-md-close" id="mini-cart-close"></button>
                </div>
                <ul class="mini-cart-list">
                    <li class="clearfix">
                        <a href="./pages/single-product.php">
                            <img src="./assets/images/product/product@1x.jpg" alt="Product">
                            <span class="mini-item-name">Casual Hoodie Full Cotton</span>
                            <span class="mini-item-price">$55.00</span>
                            <span class="mini-item-quantity"> x 1 </span>
                        </a>
                    </li>
                    <li class="clearfix">
                        <a href="./pages/single-product.php">
                            <img src="./assets/images/product/product@1x.jpg" alt="Product">
                            <span class="mini-item-name">Black Rock Dress with High Jewelery Necklace</span>
                            <span class="mini-item-price">$55.00</span>
                            <span class="mini-item-quantity"> x 1 </span>
                        </a>
                    </li>
                    <li class="clearfix">
                        <a href="./pages/single-product.php">
                            <img src="./assets/images/product/product@1x.jpg" alt="Product">
                            <span class="mini-item-name">Xiaomi Note 2 Black Color</span>
                            <span class="mini-item-price">$55.00</span>
                            <span class="mini-item-quantity"> x 1 </span>
                        </a>
                    </li>
                    <li class="clearfix">
                        <a href="./pages/single-product.php">
                            <img src="./assets/images/product/product@1x.jpg" alt="Product">
                            <span class="mini-item-name">Dell Inspiron 15</span>
                            <span class="mini-item-price">$55.00</span>
                            <span class="mini-item-quantity"> x 1 </span>
                        </a>
                    </li>
                </ul>
                <div class="mini-shop-total clearfix">
                    <span class="mini-total-heading float-left">Total:</span>
                    <span class="mini-total-price float-right">$220.00</span>
                </div>
                <div class="mini-action-anchors">
                    <a href="./pages/cart.php" class="cart-anchor">View Cart</a>
                    <a href="./pages/checkout.php" class="checkout-anchor">Checkout</a>
                </div>
            </div>
        </div>
        <!-- Mini Cart /- -->
        <style>
        .v-wrapper {
            display: none;
        }
        </style>
        <!-- Bottom-Header -->
        <div class="full-layer-bottom-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3">
                        <div class="v-menu">
                            <span class="v-title">
                                <i class="ion ion-md-menu"></i>
                                All Categories
                                <i class="fas fa-angle-down"></i>
                            </span>
                            <nav>
                                <div class="v-wrapper">
                                    <ul class="v-list animated fadeIn">
                                        <?php
                                        try {
                                            $productcategories = $pdo->query("SELECT * FROM productcategory")->fetchAll();
                                        } catch (PDOException $e) {
                                            die("Error fetching categories: " . $e->getMessage());
                                        }
                                        
                                        foreach ($productcategories as $productcategory): ?>
                                        <li class="js-backdrop v-none" style="display: none">
                                            <a href="./pages/shop-v1-root-category.php">
                                                <?= htmlspecialchars(strtoupper($productcategory['categoryname'])) ?>
                                            </a>
                                            <button class="v-button ion ion-md-add"></button>
                                        </li>
                                        <?php endforeach; ?>
                                        
                                        <!-- Optional static items (like SERVICES) -->
                                        <li class="v-none" style="display: none">
                                            <a href="./pages/about.php">
                                                SERVICES
                                            </a>
                                        </li>
                                        
                                        <!-- View More/Less toggle -->
                                        <li>
                                            <a class="v-more">
                                                <i class="ion ion-md-add"></i>
                                                <span>View More</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <ul class="bottom-nav g-nav u-d-none-lg">
                            <li>
                                <a href="./pages/new-arrivals.php">New Arrivals
                                    <span class="superscript-label-new">NEW</span>
                                </a>
                            </li>
                            <li>
                                <a href="./pages/custom-deal-page.php">Exclusive Deals
                                    <span class="superscript-label-hot">HOT</span>
                                </a>
                            </li>
                            <li>
                                <a href="./pages/custom-deal-page.php">Flash Deals
                                </a>
                            </li>
<li class="mega-position">
                                <a>Pages
                                    <i class="fas fa-chevron-down u-s-m-l-9"></i>
                                </a>
                                <div class="mega-menu mega-3-colm">
                                    <ul>
                                        <li class="menu-title">Home</li>
                                        <li>
                                            <a href="index.html" class="u-c-brand">Home</a>
                                        </li>
                                        <li>
                                            <a href="../pages/about.php">About</a>
                                        </li>
                                        <li>
                                            <a ref="./pages/contact.php">Contact</a>
                                        </li>
                                        <li>
                                            <a href="../pages/faq.php">FAQ</a>
                                        </li>
                                        <!-- <li>
                                            <a ref="./pages/store-directory.php">Store Directory</a>
                                        </li> -->
                                        <li>
                                            <a href="../pages/terms-and-conditions.php">Terms & Conditions</a>
                                        </li>
                                        <!-- <li>
                                            <a href="../pages/404.php">404</a>
                                        </li> -->
                                        <!-- <li class="menu-title">Single Product Page</li> -->
                                        <!-- <li>
                                            <a href="../pages/single-product.php">Single Product Fullwidth</a>
                                        </li> -->
                                        <li class="menu-title">Blog</li>
                                        <li>
                                            <a href="blog.php">Zig Updates </a>
                                        </li>
                                        <!-- <li>
                                            <a href="../pages/blog-detail.php">Blog Details</a>
                                        </li> -->
                                    </ul>
                                    <ul>
                                        <li class="menu-title">Shop</li>
                                        <li>
                                            <a href="../pages/shop-v2-sub-category.php">Shop</a>
                                        </li>
                                        <li>
                                            <a href="../pages/cart.php">Cart</a>
                                        </li>
                                        <li>
                                            <a href="../pages/checkout.php">Checkout</a>
                                        </li>
                                        <li>
                                            <a href="../pages/account.php">My Account</a>
                                        </li>
                                        <li>
                                            <a href="../pages/wishlist.php">Wishlist</a>
                                        </li>
                                        <li>
                                            <a href="../pages/track-order.php">Track your Order</a>
                                        </li>
                                        <!-- <li class="menu-title">Cart Variations</li> -->
                                        <!-- <li>
                                            <a href="../pages/cart-empty.php">Cart Ver 1 Empty</a>
                                        </li> -->
                                        <!-- <li>
                                            <a href="../pages/cart.php">Cart</a>
                                        </li> -->
                                        <li class="menu-title">Wishlist</li>
                                        <!-- <li>
                                            <a href="../pages/wishlist-empty.php">Wishlist Ver 1 Empty</a>
                                        </li> -->
                                        <li>
                                            <a href="../pages/wishlist.php">Wishlist</a>
                                        </li>
                                    </ul>
                                    <ul>
                                        <!-- <li class="menu-title">Shop Variations</li>
                                        <li> -->
                                            <!-- <a href="../pages/shop-v1-root-category.php">Shop Ver 1 Root Category</a>
                                        </li>
                                        <li>
                                            <a href="../pages/shop-v2-sub-category.php">Shop Ver 2 Sub Category</a>
                                        </li>
                                        <li>
                                            <a href="../pages/shop-v3-sub-sub-category.php">Shop Ver 3 Sub Sub Category</a>
                                        </li>
                                        <li>
                                            <a href="../pages/shop-v4-filter-as-category.php">Shop Ver 4 Filter as Category</a>
                                        </li>
                                        <li>
                                            <a href="../pages/shop-v5-product-not-found.php">Shop Ver 5 Product Not Found</a>
                                        </li>
                                        <li>
                                            <a href="../pages/shop-v6-search-results.php">Shop Ver 6 Search Results</a>
                                        </li> -->
                                        <li class="menu-title">Account</li>
                                        <li>
                                            <a href="../pages/lost-password.php">Lost Your Password ?</a>
                                        </li>
                                        <!-- <li class="menu-title">Checkout Variation</li>
                                        <li>
                                            <a href="../pages/confirmation.php">Checkout Confirmation</a>
                                        </li> -->
                                        <li class="menu-title">Custom Deals</li>
                                        <li>
                                            <a href="../pages/custom-deal-page.php">Custom Deal Page</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="./pages/custom-deal-page.php">Super Sale
                                    <span class="superscript-label-discount">-15%</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bottom-Header /- -->
    </header>
    <!-- Header /- -->
    
        <!--Search Results-->
        <!-- Search results display (can be on same page or separate page) -->
        <?php if (!empty($searchResults)): ?>
        <div class="search-results-container">
            <h3>Search Results for "<?= htmlspecialchars($searchTerm) ?>"</h3>
            <div class="row product-container grid-style">
                <?php foreach ($searchResults as $product): ?>
                <div class="product-item col-lg-3 col-md-6 col-sm-6">
                    <div class="item">
                        <div class="image-container">
                            <a class="item-img-wrapper-link" href="./single-product.php?id=<?= $product['id'] ?>">
                                <?php 
                                $images = explode(',', $product['image_path']);
                                $mainImage = $images[0];
                                ?>
                                <img class="img-fluid" src="<?= $mainImage ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                            </a>
                        </div>
                        <div class="item-content">
                            <h6 class="item-title">
                                <a href="./single-product.php?id=<?= $product['id'] ?>">
                                    <?= htmlspecialchars($product['name']) ?>
                                </a>
                            </h6>
                            <div class="price-template">
                                <div class="item-new-price">
                                    $<?= number_format($product['price'], 2) ?>
                                </div>
                                <?php if (!empty($product['original_price'])): ?>
                                <div class="item-old-price">
                                    $<?= number_format($product['original_price'], 2) ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <div class="search-results-container">
            <p>No results found for "<?= htmlspecialchars($searchTerm) ?>"</p>
        </div>
        <?php endif; ?>
        <!--End of Search Results-->

    <!-- Main-Slider -->
<div id="carousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="2000">
      <img src="./assets/images/main-slider/Home_bg.jpg" class="d-block w-100" alt="...">
	            <div class="slide-content slide-animation">
                    <h1>Adding the Extra to Ordinary.</h1>
                </div>
    </div>
    <div class="carousel-item" data-bs-interval="2000">
      <img src="./assets/images/main-slider/home_bg2.jpg" class="d-block w-100" alt="...">
	            <div class="slide-content slide-animation">
                    <h1 style="color:#000966">Adding the Extra to Ordinary.</h1>
                </div>
    </div>
    <div class="carousel-item" data-bs-interval="2000">
      <img src="./assets/images/main-slider/home_bg3.jpg" class="d-block w-100" alt="...">
	            <div class="slide-content slide-animation">
                    <h1>Adding the Extra to Ordinary.</h1>
                </div>
    </div>
    <div class="carousel-item" data-bs-interval="2000">
      <img src="./assets/images/main-slider/home_bg4.jpg" class="d-block w-100" alt="...">
	            <div class="slide-content slide-animation">
                    <h1 style="color:#000966">Adding the Extra to Ordinary.</h1>
                </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
    <!-- Main-Slider /- -->
    <!-- Banner-Layer -->
    <div class="banner-layer">
        <div class="container">
            <div class="image-banner">
                <a href="./pages/shop-v1-root-category.php" class="mx-auto banner-hover effect-dark-opacity">
                    <img class="img-fluid" src="./assets/images/banners/head_bg.jpg" alt="Banner">
                </a>
            </div>
        </div>
    </div>
    <!-- Banner-Layer /- -->
    <!-- Men-Clothing -->
   <section class="section-maker">
    <div class="container">
            <div class="sec-maker-header text-center">
                <h3 class="sec-maker-h3">SHOP</h3>
                <ul class="nav tab-nav-style-1-a justify-content-center">
                    <?php
                        try {
                        $productCategories = $pdo->query("SELECT * FROM productcategory")->fetchAll();
                    foreach ($productCategories as $index => $category): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $index === 0 ? 'active' : '' ?>" 
                               data-bs-toggle="tab" 
                               href="#<?= htmlspecialchars($category['tag']) ?>">
                                <?= htmlspecialchars($category['categoryname']) ?>
                            </a>
                        </li>
                    <?php endforeach; 
                    
                    } catch (PDOException $e) {
                        die("Error fetching categories: " . $e->getMessage());
                    }
                    
                    ?>
                </ul>
            </div>
            
            <div class="tab-content mt-4">
                
                <?php
                try {
                    // Get all unique tags first to organize products
                    $tagsStmt = $pdo->query("SELECT DISTINCT tag FROM products WHERE tag IS NOT NULL AND tag != ''");
                    $uniqueTags = $tagsStmt->fetchAll(PDO::FETCH_COLUMN);
                    
                    foreach ($uniqueTags as $index => $tag):
                        $active_class = ($index === 0) ? 'active show' : '';
                
                        // Get products for this specific tag
                        $productsStmt = $pdo->prepare("SELECT * FROM products WHERE tag = :tag");
                        $productsStmt->execute([':tag' => $tag]);
                        $products = $productsStmt->fetchAll();
                ?>
                    <div class="tab-pane fade row <?= $active_class ?>" id="<?= htmlspecialchars($tag) ?>">
                
                        <div id="carouselExample_<?= $index ?>" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php
                                // Split products into chunks of 4
                                $chunks = array_chunk($products, 4);
                                foreach ($chunks as $i => $chunk):
                                ?>
                                    <div class="carousel-item <?= ($i === 0) ? 'active' : '' ?>">
                                        <div class="row">
                                            <?php foreach ($chunk as $product): ?>
                                                <div class="col-6 col-lg-3 mb-3">
                                                    <div class="image-container">
                                                        <a class="item-img-wrapper-link" href="./pages/single-product.php?id=<?= $product['id'] ?>">
                                                            <img class="img-fluid" src="<?= 
                                                                !empty($product['thumbnail_path']) 
                                                                ? htmlspecialchars(explode(',', $product['thumbnail_path'])[0]) 
                                                                : './assets/images/product/product@3x.jpg' 
                                                            ?>" alt="<?= htmlspecialchars($product['name']) ?>">
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
                                                                    <a href="./pages/shop-v1-root-category.php?category=<?= urlencode($product['category']) ?>">
                                                                        <?= htmlspecialchars($product['category']) ?>
                                                                    </a>
                                                                </li>
                                                                <?php if (!empty($product['sub_category'])): ?>
                                                                <li class="has-separator">
                                                                    <a href="./pages/shop-v2-sub-category.php?subcategory=<?= urlencode($product['sub_category']) ?>">
                                                                        <?= htmlspecialchars($product['sub_category']) ?>
                                                                    </a>
                                                                </li>
                                                                <?php endif; ?>
                                                                <?php if (!empty($product['color_options'])): ?>
                                                                    <?php $colors = explode(',', $product['color_options']); ?>
                                                                    <li class="has-separator">
                                                                        <a href="./pages/shop-v2-sub-category.php?color=<?= urlencode(trim($colors[0])) ?>">
                                                                            <?= htmlspecialchars(trim($colors[0])) ?>
                                                                        </a>
                                                                    </li>
                                                                <?php endif; ?>
                                                            </ul>
                                                            <h6 class="item-title">
                                                                <a href="./pages/single-product.php?id=<?= $product['id'] ?>">
                                                                    <?= htmlspecialchars($product['name']) ?>
                                                                </a>
                                                            </h6>
                                                            <div class="item-stars">
                                                                <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                                                    <span style='width:67px'></span>
                                                                </div>
                                                                <span>(23)</span>
                                                            </div>
                                                        </div>
                                                        <div class="price-template">
                                                            <div class="item-new-price">
                                                                $<?= number_format($product['price'], 2) ?>
                                                            </div>
                                                            <?php if (!empty($product['original_price']) && $product['original_price'] > $product['price']): ?>
                                                            <div class="item-old-price">
                                                                $<?= number_format($product['original_price'], 2) ?>
                                                            </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <?php if (!empty($product['discount']) && $product['discount'] > 0): ?>
                                                    <div class="tag <?= ($product['original_price'] > $product['price']) ? 'sale' : 'discount' ?>">
                                                        <span><?= ($product['original_price'] > $product['price']) ? 'SALE' : '-'.htmlspecialchars($product['discount']).'%' ?></span>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample_<?= $index ?>" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample_<?= $index ?>" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                <?php endforeach;
                } catch (PDOException $e) {
                    die("Error fetching products: " . $e->getMessage());
                }
                ?>
            </div>
        </div>
    </section>
    
     
    <!-- Banner-Image & View-more -->
    <div class="banner-image-view-more">
        <div class="container">
            <div class="image-banner u-s-m-y-40">
                <a href="./pages/shop-v1-root-category.php" class="mx-auto banner-hover effect-dark-opacity">
                    <img class="img-fluid" src="./assets/images/banners/shop_now_banner.jpg" alt="Banner Image">
                </a>
            </div>
            <div class="redirect-link-wrapper text-center u-s-p-t-25 u-s-p-b-80">
                <a class="redirect-link" href="./pages/shop-v1-root-category.php">
                    <span>View more on this category</span>
                </a>
            </div>
        </div>
    </div>
    
    <!-- View Products in Each Category -->
        <?php
        $pdo->exec("SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");
        
        // Get all unique categories from products table
        $categoriesQuery = "SELECT DISTINCT category FROM products";
        $categories = $pdo->query($categoriesQuery)->fetchAll(PDO::FETCH_COLUMN);
        
        $index = 0; // unique index for each carousel
        
        foreach ($categories as $category) {
            // Fetch products for this category
            $productsQuery = "SELECT 
                                id, name, description, price, original_price, 
                                discount, category, sub_category, sku, stock_quantity,
                                color_options, size_options, image_path, thumbnail_path,
                                created_at
                              FROM products
                              WHERE category = :categoryName
                              ORDER BY created_at DESC
                              LIMIT 8";
            
            $stmt = $pdo->prepare($productsQuery);
            $stmt->execute([':categoryName' => $category]);
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($products)) {
            echo "<!-- No products found for category: $category -->";
        }
        
        
            if (count($products) > 0) {
                $categoryTag = strtolower(str_replace([' ', "'"], ['-', ''], $category));
                ?>
                <section class="section-maker" id="<?= htmlspecialchars($categoryTag) ?>-shop">
                    <div class="container">
                        <div class="sec-maker-header text-center">
                            <h3 class="sec-maker-h3"><?= htmlspecialchars(strtoupper($category)) ?></h3>
                        </div>
        
                        <div class="row" id="<?= htmlspecialchars($categoryTag) ?>-latest-products">
                            <div id="carouselExample_<?= $index ?>" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?php
                                    $chunks = array_chunk($products, 4);
                                    foreach ($chunks as $i => $chunk):
                                    ?>
                                        <div class="carousel-item <?= ($i === 0) ? 'active' : '' ?>">
                                            <div class="row">
                                                <?php foreach ($chunk as $product): ?>
                                                    <div class="col-6 col-lg-3 mb-3">
                                                        <div class="image-container">
                                                            <a class="item-img-wrapper-link" href="./pages/single-product.php?id=<?= $product['id'] ?>">
                                                                <img class="img-fluid" src="<?= 
                                                                    !empty($product['image_path']) 
                                                                    ? htmlspecialchars(explode(',', $product['image_path'])[0]) 
                                                                    : './assets/images/product/product@3x.jpg' ?>" 
                                                                    alt="<?= htmlspecialchars($product['name']) ?>">
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
                                                                        <a href="./pages/shop-v1-root-category.php?category=<?= urlencode($product['category']) ?>">
                                                                            <?= htmlspecialchars($product['category']) ?>
                                                                        </a>
                                                                    </li>
                                                                    <?php if (!empty($product['sub_category'])): ?>
                                                                        <li>
                                                                            <a href="./pages/shop-v2-sub-category.php?subcategory=<?= urlencode($product['sub_category']) ?>">
                                                                                <?= htmlspecialchars($product['sub_category']) ?>
                                                                            </a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                </ul>
                                                                <h6 class="item-title">
                                                                    <a href="./pages/single-product.php?id=<?= $product['id'] ?>">
                                                                        <?= htmlspecialchars($product['name']) ?>
                                                                    </a>
                                                                </h6>
                                                                <div class="item-description">
                                                                    <?= htmlspecialchars(substr($product['description'], 0, 100)) ?>...
                                                                </div>
                                                                <div class="item-stars">
                                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                                        <span style='width:0'></span>
                                                                    </div>
                                                                    <span>(0)</span>
                                                                </div>
                                                            </div>
                                                            <div class="price-template">
                                                                <div class="item-new-price">
                                                                    $<?= number_format($product['price'], 2) ?>
                                                                </div>
                                                                <?php if (!empty($product['original_price']) && $product['original_price'] != $product['price']): ?>
                                                                    <div class="item-old-price">
                                                                        $<?= number_format($product['original_price'], 2) ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                            <?php if (!empty($product['color_options']) || !empty($product['size_options'])): ?>
                                                                <div class="product-options">
                                                                    <?php if (!empty($product['color_options'])): ?>
                                                                        <span class="color-option"><?= htmlspecialchars($product['color_options']) ?></span>
                                                                    <?php endif; ?>
                                                                    <?php if (!empty($product['size_options'])): ?>
                                                                        <span class="size-option"><?= htmlspecialchars($product['size_options']) ?></span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <?php 
                                                        if (!empty($product['discount']) && $product['discount'] > 0): ?>
                                                            <div class="tag discount">
                                                                <span>-<?= $product['discount'] ?>%</span>
                                                            </div>
                                                        <?php elseif (strtotime($product['created_at']) > strtotime('-30 days')): ?>
                                                            <div class="tag new">
                                                                <span>NEW</span>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
        
                                <!-- Controls -->
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample_<?= $index ?>" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample_<?= $index ?>" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
        
                        <div class="redirect-link-wrapper text-center u-s-p-t-25 u-s-p-b-80">
                            <a class="redirect-link" href="./pages/shop-v1-root-category.php?category=<?= urlencode($category) ?>">
                                <span>View more <?= htmlspecialchars($category) ?> products</span>
                            </a>
                        </div>
                    </div>
                </section>
                <?php
                $index++; // Increment index for next carousel
            }
        }
    ?>

    <!--End of View Products in Each Category-->

<!--    <div class="continue-link-wrapper u-s-p-b-80">
        <a class="continue-link" href="./pages/shop-v1-root-category.php" title="View all products on site">
            <i class="ion ion-ios-more"></i>
        </a>
    </div>-->
    <!-- Continue-Link /- -->
<style>
.brand-slider {
    overflow: hidden;
    position: relative;
    width: 100%;
    background: #fff;
    padding: 20px 0;
}

.brand-track {
    display: flex;
    width: calc(250px * 14); /* width = logo width * total logos (2x for loop) */
    animation: scroll-left 30s linear infinite;
}

.brand-pic {
    flex: 0 0 auto;
    width: 250px;
    padding: 0 15px;
    text-align: center;
}

.brand-pic img {
    max-height: 60px;
    width: auto;
    object-fit: contain;
}

@keyframes scroll-left {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); } /* scroll halfway (since logos are duplicated) */
}
</style>

<!-- Continuous Brand Logo Slider -->
<div class="brand-slider u-s-p-b-80">
    <div class="brand-track">
        <!-- Repeat logos twice for infinite effect -->
        <div class="brand-pic"><img src="./assets/images/brand-logos/1.jpg" alt="Brand 1"></div>
        <div class="brand-pic"><img src="./assets/images/brand-logos/2.jpg" alt="Brand 2"></div>
        <div class="brand-pic"><img src="./assets/images/brand-logos/3.jpg" alt="Brand 3"></div>
        <div class="brand-pic"><img src="./assets/images/brand-logos/4.jpg" alt="Brand 4"></div>
        <div class="brand-pic"><img src="./assets/images/brand-logos/5.jpg" alt="Brand 5"></div>
        <div class="brand-pic"><img src="./assets/images/brand-logos/6.png" alt="Brand 6"></div>

        <!-- Duplicate for seamless infinite scroll -->
        <div class="brand-pic"><img src="./assets/images/brand-logos/1.jpg" alt="Brand 1"></div>
        <div class="brand-pic"><img src="./assets/images/brand-logos/2.jpg" alt="Brand 2"></div>
        <div class="brand-pic"><img src="./assets/images/brand-logos/3.jpg" alt="Brand 3"></div>
        <div class="brand-pic"><img src="./assets/images/brand-logos/4.jpg" alt="Brand 4"></div>
        <div class="brand-pic"><img src="./assets/images/brand-logos/5.jpg" alt="Brand 5"></div>
        <div class="brand-pic"><img src="./assets/images/brand-logos/6.png" alt="Brand 6"></div>
    </div>
</div>
    <!-- Brand-Slider /- -->
    <!-- Site-Priorities -->
<section class="app-priority py-5 ">
  <div class="container">
    <div class="row text-center">
      <div class="col-6 mb-4">
        <div class="single-item-wrapper">
          <div class="single-item-icon mb-2">
            <i class="ion ion-md-star fs-1"></i>
          </div>
          <h5>Great Value</h5>
          <p class="mb-0">We offer competitive prices on our 100 million plus product range</p>
        </div>
      </div>
      <div class="col-6 mb-4">
        <div class="single-item-wrapper">
          <div class="single-item-icon mb-2">
            <i class="ion ion-md-cash fs-1"></i>
          </div>
          <h5>Shop with Confidence</h5>
          <p class="mb-0">Our Protection covers your purchase from click to delivery</p>
        </div>
      </div>
      <div class="col-6 mb-4">
        <div class="single-item-wrapper">
          <div class="single-item-icon mb-2">
            <i class="ion ion-ios-card fs-1"></i>
          </div>
          <h5>Safe Payment</h5>
          <p class="mb-0">Pay with the world’s most popular and secure payment methods</p>
        </div>
      </div>
      <div class="col-6 mb-4">
        <div class="single-item-wrapper">
          <div class="single-item-icon mb-2">
            <i class="ion ion-md-contacts fs-1"></i>
          </div>
          <h5>24/7 Help Center</h5>
          <p class="mb-0">Round-the-clock assistance for a smooth shopping experience</p>
        </div>
      </div>
    </div>
  </div>
</section>
    <!-- Site-Priorities /- -->
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <!-- Outer-Footer -->
            <div class="outer-footer-wrapper u-s-p-y-80">
                <h6>
                    For special offers and other discount information
                </h6>
                <h1>
                    Subscribe to our Newsletter
                </h1>
                <p>
                    Subscribe to the mailing list to receive updates on promotions, new arrivals, discount and coupons.
                </p>
                <form class="newsletter-form">
                    <label class="sr-only" for="newsletter-field">Enter your Email</label>
                    <input type="text" id="newsletter-field" placeholder="Your Email Address">
                    <button type="submit" class="button">SUBMIT</button>
                </form>
            </div>
            <!-- Outer-Footer /- -->
<!-- Mid-Footer -->
<div class="mid-footer-wrapper u-s-p-b-80">
    <div class="row justify-content-center">
        <div class="col-lg-3 col-md-3 col-6 text-center">
            <div class="footer-list">
                <h6>CUSTOMER SERVICE</h6>
                <ul>
                    <li><a href="./pages/faq.php">FAQs</a></li>
                    <li><a href="./pages/track-order.php">Track Order</a></li>
                    <li><a href="./pages/terms-and-conditions.php">Terms & Conditions</a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-6 text-center">
            <div class="footer-list">
                <h6>COMPANY</h6>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="./pages/about.php">About</a></li>
                    <li><a href="./pages/contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-6 text-center">
            <div class="footer-list">
                <h6>INFORMATION</h6>
                <ul>
                    <li><a href="./pages/store-directory.php">Categories Directory</a></li>
                    <li><a href="./pages/wishlist.php">My Wishlist</a></li>
                    <li><a href="./pages/cart.php">My Cart</a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-6 text-center">
            <div class="footer-list">
                <h6>Address</h6>
                <ul>
                    <li><i class=""></i><span>Gurley Street, Monrovia, Liberia</span></li>
                    <li><a href="tel:+231555711018"><i class=""></i><span>+231555711018 / +231772878894</span></a></li>
                    <li><a href="mailto:ziggroupofcompanies231@gmail.com"><i class=""></i><span>zig_customized@gmail.com</span></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Mid-Footer /- -->
<style>
  .bottom-footer-wrapper::before {
    all: unset !important;
  }
</style>
            <!-- Bottom-Footer -->
            <div class="bottom-footer-wrapper">
            <img src="./assets/images/payment/payment.jpg" alt="Payment Options" style="display: block; margin: 0 auto 14px; height: 23px; width: auto; max-width: 100%;">
                <div class="social-media-wrapper">
                    <ul class="social-media-list">
                        <li>
                            <a href="https://www.facebook.com/share/1F255sv7xp/?mibextid=wwXIfr">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/share/1F255sv7xp/?mibextid=wwXIfr">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.tiktok.com/@zig_customized?_t=ZM-8th9TmJk7l7&_r=1">
                                <i class="fab fa-tiktok"></i>
                            </a>
                        </li>
                        <!-- <li>
                            <a href="#">
                                <i class="fas fa-rss"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li> -->
                    </ul>
                </div>
                    <p class="copyright-text" >Copyright &copy; and &reg; <script>document.write(new Date().getFullYear());</script></span> Under<a href="index.html">ZIG CUSTOMIZED</a></p>
                    <p class="copyright-text">Designed by <a href="https://www.easytechsolutionz.com/">Easy.Tech Solutions</a></p>
            </div>
        </div>
        <!-- Bottom-Footer /- -->
    </footer>
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
     <!-- Responsive-Search -->
     <style>
     @media (max-width: 576px) {
  #newsletter-modal .modal-dialog {
    max-width: 90% !important;
    margin: 1.75rem auto;
  }

  #newsletter-modal .newsletter-wrapper h1 {
    font-size: 20px;
    line-height: 1.3;
  }

  #newsletter-modal .newsletter-wrapper h5,
  #newsletter-modal .newsletter-wrapper h6 {
    font-size: 14px;
  }

  #newsletter-modal .newsletter-image img {
  width: 100%;
  max-width: none;
  max-height: 100px;
  object-fit: cover;
  display: block;
  margin: 0 auto;
  transform: scale(1.0);
  }

  #newsletter-modal .newsletter-textfield {
  font-size: 14px;
  padding: 10px;
  border-radius: 8px;       /* Rounded corners */
  width: 100%;              /* Full width */
  max-width: 250px;         /* Optional: limit width */
  margin: 0 auto;           /* Center horizontally */
  display: block;           /* Make it block for centering */
  box-sizing: border-box;   /* Ensure padding doesn’t overflow */
    
  }

  #newsletter-modal .button-primary {
  padding: 10px;
  font-size: 14px;
  border-radius: 8px;        /* Rounded corners */
  width: 100%;               /* Full width */
  max-width: 250px;          /* Optional: limit width */
  margin: 0 auto;            /* Center horizontally */
  display: block;            /* Ensure it's treated as a block for centering */
  text-align: center;        /* Center text inside */
  }
  
  #newsletter-modal .dismiss-button {
  font-size: 40px;      /* Increase icon size */
  width: 40px;          /* Bigger click area */
  height: 40px;
  top: 5px;            /* Adjust positioning if needed */
  right: 5px;
  position: absolute;
  z-index: 10;
  background: none;
  border: none;
  cursor: pointer;
  color: #333;
  line-height: 1;
  background-color: White;
}
}

     </style>
    <!-- Newsletter-Modal -->
    <div id="newsletter-modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="button dismiss-button ion ion-ios-close" data-bs-dismiss="modal"></button>
                <div class="modal-body u-s-p-x-0">
                    <div class="row align-items-center u-s-m-x-0">
                        <div class="col-lg-6 col-md-6 col-sm-12 u-s-p-x-0">
                            <div class="newsletter-image">
                                <a href="./pages/shop-v1-root-category.php" class="banner-hover effect-dark-opacity">
                                    <img class="img-fluid" src="./assets/images/banners/bag_banner.jpg" alt="Newsletter Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="newsletter-wrapper">
                                <h1>New to
                                    <span>ZIG CUSTOMIZED</span> ?
                                    <br>Subscribe Newsletter</h1>
                                <h5>Get latest product update...</h5>
                                <form>
                                    <div class="u-s-m-b-35">
                                        <input type="text" class="newsletter-textfield" placeholder="Enter Your Email">
                                    </div>
                                    <div class="u-s-m-b-35">
                                        <button type="button" id="subscribe-btn" class="button button-primary d-block w-100">Subscribe</button>
                                    </div>
                                </form>
                                <h6>Be the first for getting special deals and offers, Send directly to your inbox.</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Newsletter-Modal /- -->
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
                                <img id="zoom-pro-quick-view" class="img-fluid" src="./assets/images/product/product@4x.jpg" data-zoom-image="images/product/product@4x.jpg" alt="Zoom Image">
                                <div id="gallery-quick-view" class="u-s-m-t-10">
                                    <a class="active" data-image="images/product/product@4x.jpg" data-zoom-image="images/product/product@4x.jpg">
                                        <img src="./assets/images/product/product@2x.jpg" alt="Product">
                                    </a>
                                    <a data-image="images/product/product@4x.jpg" data-zoom-image="images/product/product@4x.jpg">
                                        <img src="./assets/images/product/product@2x.jpg" alt="Product">
                                    </a>
                                    <a data-image="images/product/product@4x.jpg" data-zoom-image="images/product/product@4x.jpg">
                                        <img src="./assets/images/product/product@2x.jpg" alt="Product">
                                    </a>
                                    <a data-image="images/product/product@4x.jpg" data-zoom-image="images/product/product@4x.jpg">
                                        <img src="./assets/images/product/product@2x.jpg" alt="Product">
                                    </a>
                                    <a data-image="images/product/product@4x.jpg" data-zoom-image="images/product/product@4x.jpg">
                                        <img src="./assets/images/product/product@2x.jpg" alt="Product">
                                    </a>
                                    <a data-image="images/product/product@4x.jpg" data-zoom-image="images/product/product@4x.jpg">
                                        <img src="./assets/images/product/product@2x.jpg" alt="Product">
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
                                            <a href="./pages/single-product.php">Casual Hoodie Full Cotton</a>
                                        </h1>
                                    </div>
                                    <ul class="bread-crumb">
                                        <li class="has-separator">
                                            <a href="index.php">Home</a>
                                        </li>
                                        <li class="has-separator">
                                            <a href="./pages/shop-v1-root-category.php">Men's Clothing</a>
                                        </li>
                                        <li class="has-separator">
                                            <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                        </li>
                                        <li class="is-marked">
                                            <a href="./pages/shop-v3-sub-sub-category.php">Hoodies</a>
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://www.google-analytics.com/analytics.js" async defer></script>
<!-- Modernizr-JS -->
<script type="text/javascript" src="./assets/js/vendor/modernizr-custom.min.js"></script>
<!-- NProgress -->
<script type="text/javascript" src="./assets/js/nprogress.min.js"></script>
<!-- jQuery -->
<script type="text/javascript" src="./assets/js/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script type="text/javascript" src="./assets/js/bootstrap.min.js"></script>
<!-- Popper -->
<script type="text/javascript" src="./assets/js/popper.min.js"></script>
<!-- ScrollUp -->
<script type="text/javascript" src="./assets/js/jquery.scrollUp.min.js"></script>
<!-- Elevate Zoom -->
<script type="text/javascript" src="./assets/js/jquery.elevatezoom.min.js"></script>
<!-- jquery-ui-range-slider -->
<script type="text/javascript" src="./assets/js/jquery-ui.range-slider.min.js"></script>
<!-- jQuery Slim-Scroll -->
<script type="text/javascript" src="./assets/js/jquery.slimscroll.min.js"></script>
<!-- jQuery Resize-Select -->
<script type="text/javascript" src="./assets/js/jquery.resize-select.min.js"></script>
<!-- jQuery Custom Mega Menu -->
<script type="text/javascript" src="./assets/js/jquery.custom-megamenu.min.js"></script>
<!-- jQuery Countdown -->
<script type="text/javascript" src="./assets/js/jquery.custom-countdown.min.js"></script>
<!-- Owl Carousel -->
<script type="text/javascript" src="./assets/js/owl.carousel.min.js"></script>
<!-- Main -->
<script type="text/javascript" src="./assets/js/app.js"></script>
</body>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const vTitle = document.querySelector('.v-title');
    const vWrapper = document.querySelector('.v-wrapper');
    const arrowIcon = vTitle.querySelector('.fas');

    vTitle.addEventListener('click', function () {
        if (vWrapper.style.display === "none" || vWrapper.style.display === "") {
            vWrapper.style.display = "block";
            arrowIcon.classList.remove('fa-angle-down');
            arrowIcon.classList.add('fa-angle-up');
        } else {
            vWrapper.style.display = "none";
            arrowIcon.classList.remove('fa-angle-up');
            arrowIcon.classList.add('fa-angle-down');
        }
    });
});
</script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    // Delay modal check to avoid race condition
    setTimeout(function () {
      if (!localStorage.getItem("newsletterSubscribed")) {
        $('#newsletter-modal').modal('show');
      }
    }, 300); // Slight delay for stability
  });

  // Handle Subscribe button
  document.getElementById("subscribe-btn").addEventListener("click", function () {
    localStorage.setItem("newsletterSubscribed", "true");
    $('#newsletter-modal').modal('hide');
  });

  // Handle Close (X) button
  document.querySelector(".dismiss-button").addEventListener("click", function () {
    localStorage.setItem("newsletterSubscribed", "true");
  });
</script>


</html>

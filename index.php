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
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
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
                <div class="row clearfix align-items-center">
                    <div class="col-lg-3 col-md-9 col-sm-6">
                        <div class="brand-logo text-lg-center">
                            <a href="index.html">
                                <img src="./assets/images/main-logo/ZIG.png" alt="Groover Brand Logo" class="app-brand-logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 u-d-none-lg">
                        <form class="form-searchbox">
                            <label class="sr-only" for="search-landscape">Search</label>
                            <input id="search-landscape" type="text" class="text-field" placeholder="Search everything">
                            <div class="select-box-position">
                                <div class="select-box-wrapper select-hide">
                                    <label class="sr-only" for="select-category">Choose category for search</label>
                                    <select class="select-box" id="select-category">
                                        <option selected="selected" value="">
                                            All
                                        </option>
                                        <option value="">Tops</option>
                                        <option value="">Bottoms
                                        </option>
                                        <option value="">Headwear
                                        </option>
                                        <option value="">Bags
                                        </option>
                                        <option value="">Accessories
                                        </option>
                                       <option value="">Services
                                        </option>
                                         <!-- <option value="">Services
                                        </option> -->
                                        <!-- <option value="">Furniture Home & Office
                                        </option> -->
                                    </select>
                                </div>
                            </div>
                            <button id="btn-search" type="submit" class="button button-primary fas fa-search"></button>
                        </form>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <nav>
                            <ul class="mid-nav g-nav">
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
                                        <span class="item-counter">4</span>
                                        <span class="item-price">$220.00</span>
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
                    <span class="fixed-item-counter">4</span>
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
                                        <li class="js-backdrop">
                                            <a href="./pages/shop-v1-root-category.php">
                                                <!-- <i class="ion ion-md-shirt"></i> -->
                                                TOPS
                                                <!-- <i class="ion ion-ios-arrow-forward"></i> -->
                                            </a>
                                            <button class="v-button ion ion-md-add"></button>
                                            
                                        </li>
                                        <li class="js-backdrop">
                                            <a href="./pages/shop-v1-root-category.php">
                                                <!-- <i class="fi fi-ss-hat-beach"></i> -->
                                              BOTTOMS
                                                <!-- <i class="ion ion-ios-arrow-forward"></i> -->
                                            </a>
                                            <button class="v-button ion ion-md-add"></button>
                                    
                                        </li>
                                        <li class="js-backdrop">
                                            <a href="./pages/shop-v1-root-category.php">
                                                <!-- <i class="ion ion-ios-shirt"></i> -->
                                                HEADWEAR
                                                <!-- <i class="ion ion-ios-arrow-forward"></i> -->
                                            </a>
                                            <button class="v-button ion ion-md-add"></button>
                                            <div class="v-drop" style="width: 700px;">
                                                
                                            </div>
                                        </li>
                                        <li class="v-none" style="display: none">
                                            <a href="./pages/shop-v1-root-category.php">
                                                <!-- <i class="ion ion-md-phone-portrait"></i> -->
                                                BAGS
                                            </a>
                                        </li>
                                        <li class="v-none" style="display: none">
                                            <a href="./pages/shop-v1-root-category.php">
                                                <!-- <i class="ion ion-md-tv"></i> -->
                                                ACCESSORIES
                                            </a>
                                        </li>
                                        <!-- <li>
                                            <a href="./pages/shop-v1-root-category.php">
                                                <i class="ion ion-ios-book"></i>
                                                ACCESSORIES
                                            </a>
                                        </li> -->
                                        <!-- <li>
                                            <a href="./pages/shop-v1-root-category.php">
                                                <i class="ion ion-md-heart"></i>
                                                Beauty & Health
                                            </a>
                                        </li> -->
                                        <li class="v-none" style="display: none">
                                            <a href="./pages/about.php">
                                                <!-- <i class="ion ion-md-easel"></i> -->
                                                SERVICES
                                            </a>
                                        </li>
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
                                <a href="./pages/custom-deal-page.php">New Arrivals
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
                                            <a href="./pages/about.php">About</a>
                                        </li>
                                        <li>
                                            <a ref="./pages/contact.php">Contact</a>
                                        </li>
                                        <li>
                                            <a href="./pages/faq.php">FAQ</a>
                                        </li>
                                        <!-- <li>
                                            <a ref="./pages/store-directory.php">Store Directory</a>
                                        </li> -->
                                        <li>
                                            <a href="./pages/terms-and-conditions.php">Terms & Conditions</a>
                                        </li>
                                        <!-- <li>
                                            <a href="./pages/404.php">404</a>
                                        </li> -->
                                        <!-- <li class="menu-title">Single Product Page</li> -->
                                        <!-- <li>
                                            <a href="./pages/single-product.php">Single Product Fullwidth</a>
                                        </li> -->
                                        <li class="menu-title">Blog</li>
                                        <li>
                                            <a href="blog.php">Zig Updates </a>
                                        </li>
                                        <!-- <li>
                                            <a href="./pages/blog-detail.php">Blog Details</a>
                                        </li> -->
                                    </ul>
                                    <ul>
                                        <li class="menu-title">Shop</li>
                                        <li>
                                            <a href="./pages/shop-v2-sub-category.php">Shop</a>
                                        </li>
                                        <li>
                                            <a href="./pages/cart.php">Cart</a>
                                        </li>
                                        <li>
                                            <a href="./pages/checkout.php">Checkout</a>
                                        </li>
                                        <li>
                                            <a href="./pages/account.php">My Account</a>
                                        </li>
                                        <li>
                                            <a href="./pages/wishlist.php">Wishlist</a>
                                        </li>
                                        <li>
                                            <a href="./pages/track-order.php">Track your Order</a>
                                        </li>
                                        <!-- <li class="menu-title">Cart Variations</li> -->
                                        <!-- <li>
                                            <a href="./pages/cart-empty.php">Cart Ver 1 Empty</a>
                                        </li> -->
                                        <!-- <li>
                                            <a href="./pages/cart.php">Cart</a>
                                        </li> -->
                                        <li class="menu-title">Wishlist</li>
                                        <!-- <li>
                                            <a href="./pages/wishlist-empty.php">Wishlist Ver 1 Empty</a>
                                        </li> -->
                                        <li>
                                            <a href="./pages/wishlist.php">Wishlist</a>
                                        </li>
                                    </ul>
                                    <ul>
                                        <!-- <li class="menu-title">Shop Variations</li>
                                        <li> -->
                                            <!-- <a href="./pages/shop-v1-root-category.php">Shop Ver 1 Root Category</a>
                                        </li>
                                        <li>
                                            <a href="./pages/shop-v2-sub-category.php">Shop Ver 2 Sub Category</a>
                                        </li>
                                        <li>
                                            <a href="./pages/shop-v3-sub-sub-category.php">Shop Ver 3 Sub Sub Category</a>
                                        </li>
                                        <li>
                                            <a href="./pages/shop-v4-filter-as-category.php">Shop Ver 4 Filter as Category</a>
                                        </li>
                                        <li>
                                            <a href="./pages/shop-v5-product-not-found.php">Shop Ver 5 Product Not Found</a>
                                        </li>
                                        <li>
                                            <a href="./pages/shop-v6-search-results.php">Shop Ver 6 Search Results</a>
                                        </li> -->
                                        <li class="menu-title">Account</li>
                                        <li>
                                            <a href="./pages/lost-password.php">Lost Your Password ?</a>
                                        </li>
                                        <!-- <li class="menu-title">Checkout Variation</li>
                                        <li>
                                            <a href="./pages/confirmation.php">Checkout Confirmation</a>
                                        </li> -->
                                        <li class="menu-title">Custom Deals</li>
                                        <li>
                                            <a href="./pages/custom-deal-page.php">Custom Deal Page</a>
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
    <!-- Main-Slider -->
    <div class="default-height ph-item">
        <div class="slider-main owl-carousel">
            <div class="bg-image one">
                <div class="slide-content slide-animation">
                    <h1>Adding the Extra to Ordinary.</h1>
                    <!-- <h2>lifestyle / clothing / hype</h2> -->
                </div>
            </div>
            <div class="bg-image two">
                <div class="slide-content slide-animation">
                    <h1 style="color:#000966">Adding the Extra to Ordinary.</h1>
                    <!-- <h2>lifestyle / clothing / hype</h2> -->
                </div>
            </div>
            <div class="bg-image three">
                <div class="slide-content slide-animation">
                    <h1>Adding the Extra to Ordinary.</h1>
                    <!-- <h2 style="color:#333"></h2> -->
                </div>
            </div>
        </div>
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
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#top-shop">Tops</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#bottom-shop">Bottom</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#headwear-shop">Headwear</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#bags-shop">Bags</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#accessories-shop">Accessories</a>
                    </li>
                </ul>
            </div>
            <div class="wrapper-content">
                <div class="outer-area-tab">
                    <div class="tab-content">

                        <!-- top  -->
                        <div class="tab-pane active show fade" id="top-shop">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                            <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                            </a>
                                            <a class="item-mail" href="javascript:void(0)">Mail</a>
                                            <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                            <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <li class="has-separator">
                                                    <a href="./pages/shop-v1-root-category.php">Tops</a>
                                                </li>
                                                <li class="has-separator">
                                                    <a href="./pages/shop-v2-sub-category.php">T-Shirts</a>
                                                </li>
                                                <li class="has-separator">
                                                    <a href="./pages/shop-v2-sub-category.php">Red</a>
                                                </li>
                                            </ul>
                                            <h6 class="item-title">
                                                <a href="./pages/single-product.php">15 Tribes one people</a>
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
                                                $15.00
                                            </div>
                                            <div class="item-old-price">
                                                $17.00
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tag sale">
                                        <span>SALE</span>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                            <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                            </a>
                                            <a class="item-mail" href="javascript:void(0)">Mail</a>
                                            <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                            <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <li class="has-separator">
                                                    <a href="./pages/shop-v1-root-category.php">Tops</a>
                                                </li>
                                                <li class="has-separator">
                                                    <a href="./pages/shop-v2-sub-category.php">Crop Top</a>
                                                </li>
                                                <li class="has-separator">
                                                    <a href="./pages/shop-v2-sub-category.php">Blue</a>
                                                </li>
                                            </ul>
                                            <h6 class="item-title">
                                                <a href="./pages/single-product.php">Bodycon Crop Top</a>
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
                                                $12.00
                                            </div>
                                            <div class="item-old-price">
                                                $15.00
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                            <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                            </a>
                                            <a class="item-mail" href="javascript:void(0)">Mail</a>
                                            <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                            <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <li class="has-separator">
                                                    <a href="./pages/shop-v1-root-category.php">Tops</a>
                                                </li>
                                                <li class="has-separator">
                                                    <a href="./pages/shop-v2-sub-category.php">Hoodies</a>
                                                </li>
                                                <li class="has-separator">
                                                    <a href="./pages/shop-v2-sub-category.php">Black</a>
                                                </li>
                                            </ul>
                                            <h6 class="item-title">
                                                <a href="./pages/single-product.php">Cotton hoddie</a>
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
                                                $20.00
                                            </div>
                                            <div class="item-old-price">
                                                $25.00
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                            <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                            </a>
                                            <a class="item-mail" href="javascript:void(0)">Mail</a>
                                            <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                            <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <li class="has-separator">
                                                    <a href="./pages/shop-v1-root-category.php">Tops</a>
                                                </li>
                                                <li class="has-separator">
                                                    <a href="./pages/shop-v2-sub-category.php">Sweatshirts</a>
                                                </li>
                                                <li class="has-separator">
                                                    <a href="./pages/shop-v2-sub-category.php">White</a>
                                                </li>
                                            </ul>
                                            <h6 class="item-title">
                                                <a href="./pages/single-product.php">Zig Classic 
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
                                                $20.00
                                            </div>
                                            <div class="item-old-price">
                                                $25.00
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tag discount">
                                        <span>-15%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <!-- top end -->
                        <!-- buttom -->
                        <didiv class="tab-pane fade" id="bottom-shop">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Bottoms</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Pants</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Red</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Zig Sweatpants</a>
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
                                                    $15.00
                                                </div>
                                                <div class="item-old-price">
                                                    $17.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag sale">
                                            <span>SALE</span>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Bottoms</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Pants</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Blue</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Zig pants</a>
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
                                                    $15.00
                                                </div>
                                                <div class="item-old-price">
                                                    $17.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Bottoms</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Shorts</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Blue</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Jersey shorts</a>
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
                                                    $15.00
                                                </div>
                                                <div class="item-old-price">
                                                    $17.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Bottoms</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Pants</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">White</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Cotton shorts
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
                                                    $15.00
                                                </div>
                                                <div class="item-old-price">
                                                    $17.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag discount">
                                            <span>-15%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </didiv>
                        <!-- buttom ends-->
                        

                        <!-- Product Not Found -->
                             <!-- Headwear -->
                             <div class="tab-pane fade" id="headwear-shop">
                             <div class="slider-fouc">
                                 <div class="products-slider owl-carousel" data-item="4">
                                     <div class="item">
                                         <div class="image-container">
                                             <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                 <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                             </a>
                                             <div class="item-action-behaviors">
                                                 <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                 </a>
                                                 <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                 <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                 <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                             </div>
                                         </div>
                                         <div class="item-content">
                                             <div class="what-product-is">
                                                 <ul class="bread-crumb">
                                                     <li class="has-separator">
                                                         <a href="./pages/shop-v1-root-category.php">Headwear</a>
                                                     </li>
                                                     <li class="has-separator">
                                                         <a href="./pages/shop-v2-sub-category.php">Face cap</a>
                                                     </li>
                                                     <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Red</a>
                                                    </li>
                                                 </ul>
                                                 <h6 class="item-title">
                                                     <a href="./pages/single-product.php">Zig face cap</a>
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
                                                     $12.00
                                                 </div>
                                                 <div class="item-old-price">
                                                     $15.00
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="tag sale">
                                             <span>SALE</span>
                                         </div>
                                     </div>
                                     <div class="item">
                                         <div class="image-container">
                                             <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                 <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                             </a>
                                             <div class="item-action-behaviors">
                                                 <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                 </a>
                                                 <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                 <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                 <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                             </div>
                                         </div>
                                         <div class="item-content">
                                             <div class="what-product-is">
                                                 <ul class="bread-crumb">
                                                     <li class="has-separator">
                                                         <a href="./pages/shop-v1-root-category.php">Headwear</a>
                                                     </li>
                                                     <li class="has-separator">
                                                         <a href="./pages/shop-v2-sub-category.php">Bucket hat</a>
                                                     </li>
                                                     <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Blue</a>
                                                    </li>
                                                 </ul>
                                                 <h6 class="item-title">
                                                     <a href="./pages/single-product.php">Zig cotton hat</a>
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
                                                     $12.00
                                                 </div>
                                                 <div class="item-old-price">
                                                     $15.00
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="item">
                                         <div class="image-container">
                                             <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                 <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                             </a>
                                             <div class="item-action-behaviors">
                                                 <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                 </a>
                                                 <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                 <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                 <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                             </div>
                                         </div>
                                         <div class="item-content">
                                             <div class="what-product-is">
                                                 <ul class="bread-crumb">
                                                     <li class="has-separator">
                                                         <a href="./pages/shop-v1-root-category.php">Headwear</a>
                                                     </li>
                                                     <li class="has-separator">
                                                         <a href="./pages/shop-v2-sub-category.php">Face cap</a>
                                                     </li>
                                                     <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Black</a>
                                                    </li>
                                                 </ul>
                                                 <h6 class="item-title">
                                                     <a href="./pages/single-product.php">Zig face cap</a>
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
                                                     $12.00
                                                 </div>
                                                 <div class="item-old-price">
                                                     $15.00
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="item">
                                         <div class="image-container">
                                             <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                 <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                             </a>
                                             <div class="item-action-behaviors">
                                                 <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                 </a>
                                                 <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                 <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                 <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                             </div>
                                         </div>
                                         <div class="item-content">
                                             <div class="what-product-is">
                                                 <ul class="bread-crumb">
                                                     <li class="has-separator">
                                                         <a href="./pages/shop-v1-root-category.php">Headwear</a>
                                                     </li>
                                                     <li class="has-separator">
                                                         <a href="./pages/shop-v2-sub-category.php">Pants</a>
                                                     </li>
                                                     <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">White</a>
                                                    </li>
                                                 </ul>
                                                 <h6 class="item-title">
                                                     <a href="./pages/single-product.php">Zig cotton hat
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
                                                     $12.00
                                                 </div>
                                                 <div class="item-old-price">
                                                     $15.00
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="tag discount">
                                             <span>-15%</span>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                        <!-- Product Not Found /- -->
                             <!-- Bags -->
                        <div class="tab-pane fade" id="bags-shop">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Bags</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tote bag</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Red</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Tribal Tote bag</a>
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
                                                    $9.00
                                                </div>
                                                <div class="item-old-price">
                                                    $12.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag sale">
                                            <span>SALE</span>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Bags</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tote bag</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Blue</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Face card Tote bag</a>
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
                                                    $9.00
                                                </div>
                                                <div class="item-old-price">
                                                    $12.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Bags</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tote Bags</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Black</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Zig Val Tote Bag</a>
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
                                                    $9.00
                                                </div>
                                                <div class="item-old-price">
                                                    $12.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Bags</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Hand Bag</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">White</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">ZIG NEW
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
                                                    $9.00
                                                </div>
                                                <div class="item-old-price">
                                                    $12.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag discount">
                                            <span>-15%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Bag ends -->

                            <!-- Product Not Found -->
                             <!-- ACCESSORIES -->
                            <div class="tab-pane fade" id="accessories-shop">
                                <div class="slider-fouc">
                                    <div class="products-slider owl-carousel" data-item="4">
                                        <div class="item">
                                            <div class="image-container">
                                                <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                    <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                                </a>
                                                <div class="item-action-behaviors">
                                                    <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                    </a>
                                                    <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                    <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                    <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                                </div>
                                            </div>
                                            <div class="item-content">
                                                <div class="what-product-is">
                                                    <ul class="bread-crumb">
                                                        <li class="has-separator">
                                                            <a href="./pages/shop-v1-root-category.php">Accessories</a>
                                                        </li>
                                                        <li class="has-separator">
                                                            <a href="./pages/shop-v2-sub-category.php">Photocard</a>
                                                        </li>
                                                    </ul>
                                                    <h6 class="item-title">
                                                        <a href="./pages/single-product.php">Printed photo card</a>
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
                                                        $15.00
                                                    </div>
                                                    <div class="item-old-price">
                                                        $12.00
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tag sale">
                                                <span>SALE</span>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="image-container">
                                                <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                    <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                                </a>
                                                <div class="item-action-behaviors">
                                                    <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                    </a>
                                                    <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                    <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                    <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                                </div>
                                            </div>
                                            <div class="item-content">
                                                <div class="what-product-is">
                                                    <ul class="bread-crumb">
                                                        <li class="has-separator">
                                                            <a href="./pages/shop-v1-root-category.php">Accessories</a>
                                                        </li>
                                                        <li class="has-separator">
                                                            <a href="./pages/shop-v2-sub-category.php">Banner</a>
                                                        </li>
                                                    </ul>
                                                    <h6 class="item-title">
                                                        <a href="./pages/single-product.php">Customized banner</a>
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
                                                        $23.00
                                                    </div>
                                                    <div class="item-old-price">
                                                        $23.00
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="image-container">
                                                <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                    <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                                </a>
                                                <div class="item-action-behaviors">
                                                    <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                    </a>
                                                    <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                    <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                    <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                                </div>
                                            </div>
                                            <div class="item-content">
                                                <div class="what-product-is">
                                                    <ul class="bread-crumb">
                                                        <li class="has-separator">
                                                            <a href="./pages/shop-v1-root-category.php">Accessories</a>
                                                        </li>
                                                        <li class="has-separator">
                                                            <a href="./pages/shop-v2-sub-category.php">Essentials</a>
                                                        </li>
                                                    </ul>
                                                    <h6 class="item-title">
                                                        <a href="./pages/single-product.php">Customized Essentials</a>
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
                                                        $12.00
                                                    </div>
                                                    <div class="item-old-price">
                                                        $15.00
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="image-container">
                                                <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                    <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                                </a>
                                                <div class="item-action-behaviors">
                                                    <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                    </a>
                                                    <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                    <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                    <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                                </div>
                                            </div>
                                            <div class="item-content">
                                                <div class="what-product-is">
                                                    <ul class="bread-crumb">
                                                        <li class="has-separator">
                                                            <a href="./pages/shop-v1-root-category.php">Accessories</a>
                                                        </li>
                                                        <li class="has-separator">
                                                            <a href="./pages/shop-v2-sub-category.php">Posters</a>
                                                        </li>
                                                    </ul>
                                                    <h6 class="item-title">
                                                        <a href="./pages/single-product.php">Customized posters
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
                                                        $12.00
                                                    </div>
                                                    <div class="item-old-price">
                                                        $15.00
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tag discount">
                                                <span>-15%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         <!-- Product Not Found /- -->
                          <!-- Accessories ends -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Men-Clothing-Timing-Section -->
    <section class="section-maker">
        <div class="container">
            <div class="sec-maker-header text-center">
                <span class="sec-maker-span-text"></span>
                <h3 class="sec-maker-h3 u-s-m-b-22">Hot Deals</h3>
                <span class="sec-maker-span-text">Ends in</span>
                <!-- Timing-Box -->
                <div class="section-timing-wrapper dynamic">
                    <span class="fictitious-seconds" style="display:none;">18000</span>
                    <div class="section-box-wrapper box-days">
                        <div class="section-box">
                            <span class="section-key">120</span>
                            <span class="section-value">Days</span>
                        </div>
                    </div>
                    <div class="section-box-wrapper box-hrs">
                        <div class="section-box">
                            <span class="section-key">54</span>
                            <span class="section-value">HRS</span>
                        </div>
                    </div>
                    <div class="section-box-wrapper box-mins">
                        <div class="section-box">
                            <span class="section-key">3</span>
                            <span class="section-value">MINS</span>
                        </div>
                    </div>
                    <div class="section-box-wrapper box-secs">
                        <div class="section-box">
                            <span class="section-key">32</span>
                            <span class="section-value">SEC</span>
                        </div>
                    </div>
                </div>
                <!-- Timing-Box /- -->
            </div>
            <!-- Carousel -->
            <div class="slider-fouc">
                <div class="products-slider owl-carousel" data-item="4">
                    <div class="item">
                        <div class="image-container">
                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
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
                                        <a href="./pages/shop-v1-root-category.php">Men's</a>
                                    </li>
                                    <li class="has-separator">
                                        <a href="./pages/shop-v2-sub-category.php">Outwear</a>
                                    </li>
                                    <li>
                                        <a href="./pages/shop-v3-sub-sub-category.php">Jackets</a>
                                    </li>
                                </ul>
                                <h6 class="item-title">
                                    <a href="./pages/single-product.php">Maire Battlefield Jeep Men's Jacket</a>
                                </h6>
                                <div class="item-stars">
                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                        <span style='width:0'></span>
                                    </div>
                                    <span>(0)</span>
                                </div>
                            </div>
                            <div class="price-template">
                                <div class="item-new-price">
                                    $55.00
                                </div>
                                <div class="item-old-price">
                                    $60.00
                                </div>
                            </div>
                        </div>
                        <div class="tag hot">
                            <span>HOT</span>
                        </div>
                    </div>
                    <div class="item">
                        <div class="image-container">
                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
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
                                        <a href="./pages/shop-v1-root-category.php">Men's</a>
                                    </li>
                                    <li class="has-separator">
                                        <a href="./pages/shop-v2-sub-category.php">Outwear</a>
                                    </li>
                                    <li>
                                        <a href="./pages/shop-v3-sub-sub-category.php">Jackets</a>
                                    </li>
                                </ul>
                                <h6 class="item-title">
                                    <a href="./pages/single-product.php">Fern Green Men's Jacket</a>
                                </h6>
                                <div class="item-stars">
                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                        <span style='width:0'></span>
                                    </div>
                                    <span>(0)</span>
                                </div>
                            </div>
                            <div class="price-template">
                                <div class="item-new-price">
                                    $55.00
                                </div>
                                <div class="item-old-price">
                                    $60.00
                                </div>
                            </div>
                        </div>
                        <div class="tag hot">
                            <span>HOT</span>
                        </div>
                    </div>
                    <div class="item">
                        <div class="image-container">
                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
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
                                        <a href="./pages/shop-v1-root-category.php">Men's</a>
                                    </li>
                                    <li class="has-separator">
                                        <a href="./pages/shop-v2-sub-category.php">Sunglasses</a>
                                    </li>
                                    <li>
                                        <a href="./pages/shop-v3-sub-sub-category.php">Round</a>
                                    </li>
                                </ul>
                                <h6 class="item-title">
                                    <a href="./pages/single-product.php">Brown Dark Tan Round Double Bridge Sunglasses</a>
                                </h6>
                                <div class="item-stars">
                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                        <span style='width:0'></span>
                                    </div>
                                    <span>(0)</span>
                                </div>
                            </div>
                            <div class="price-template">
                                <div class="item-new-price">
                                    $55.00
                                </div>
                                <div class="item-old-price">
                                    $60.00
                                </div>
                            </div>
                        </div>
                        <div class="tag hot">
                            <span>HOT</span>
                        </div>
                    </div>
                    <div class="item">
                        <div class="image-container">
                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
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
                                        <a href="./pages/shop-v1-root-category.php">Men's</a>
                                    </li>
                                    <li class="has-separator">
                                        <a href="./pages/shop-v2-sub-category.php">Sunglasses</a>
                                    </li>
                                    <li>
                                        <a href="./pages/shop-v3-sub-sub-category.php">Round</a>
                                    </li>
                                </ul>
                                <h6 class="item-title">
                                    <a href="./pages/single-product.php">Black Round Double Bridge Sunglasses</a>
                                </h6>
                                <div class="item-stars">
                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                        <span style='width:0'></span>
                                    </div>
                                    <span>(0)</span>
                                </div>
                            </div>
                            <div class="price-template">
                                <div class="item-new-price">
                                    $55.00
                                </div>
                                <div class="item-old-price">
                                    $60.00
                                </div>
                            </div>
                        </div>
                        <div class="tag hot">
                            <span>HOT</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Carousel /- -->
        </div>
    </section>
    <!-- Men-Clothing-Timing-Section /- -->
    <!-- Banner-Image & View-more -->
    <div class="banner-image-view-more">
        <div class="container">
            <div class="image-banner u-s-m-y-40">
                <a href="./pages/shop-v1-root-category.php" class="mx-auto banner-hover effect-dark-opacity">
                    <img class="img-fluid" src="./assets/images/banners/shop_now_banner.jpg" alt="Banner Image">
                </a>
            </div>
            <div class="redirect-link-wrapper text-center u-s-p-t-25 u-s-p-b-80">
                <a class="redirect-link" ref="./pages/store-directory.php">
                    <span>View more on this category</span>
                </a>
            </div>
        </div>
    </div>
    <!-- Banner-Image & View-more /- -->
    <!-- Men-Clothing /- -->
    <!-- Women-Clothing -->
    <section class="section-maker" id="tops-shop">
        <div class="container">
            <div class="sec-maker-header text-center">
                <h3 class="sec-maker-h3">TOPS</h3>
                <!-- <ul class="nav tab-nav-style-1-a justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#women-latest-products">Latest Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#women-best-selling-products">Best Selling</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#women-top-rating-products">Top Rating</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#women-featured-products">Featured Products</a>
                    </li>
                </ul> -->
            </div>
            <div class="wrapper-content">
                <div class="outer-area-tab">
                    <div class="tab-content">
                        <div class="tab-pane active show fade" id="women-latest-products">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">White Solitude Dress with mid heel & Bag
                                                    </a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag new">
                                            <span>NEW</span>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Black Rock Dress with High Jewelery Necklace
                                                    </a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Haiti Full Dress with Boots & Jacket</a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Black & White Wrap Dress with High Jewelery Necklace</a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag new">
                                            <span>NEW</span>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Grey Nickel Special Occasion Dress</a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag sale">
                                            <span>SALE</span>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Red Carmine Winter Special Occasion Dress
                                                    </a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Bottoms</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Shoes</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Wax Flower with Corn Silk Heel
                                                    </a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Intimates</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Bras</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Red Wild Bra
                                                    </a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag discount">
                                            <span>-15%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="women-best-selling-products">
                            <!-- Product Not Found -->
                            <div class="product-not-found">
                                <div class="not-found">
                                    <h2>SORRY!</h2>
                                    <h6>There is not any product in specific catalogue.</h6>
                                </div>
                            </div>
                            <!-- Product Not Found /- -->
                        </div>
                        <div class="tab-pane fade" id="women-top-rating-products">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Grey Nickel Special Occasion Dress</a>
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
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag sale">
                                            <span>SALE</span>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Red Carmine Winter Special Occasion Dress
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
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Bottoms</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Shoes</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Wax Flower with Corn Silk Heel</a>
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
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Intimates</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Bras</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Red Wild Bra</a>
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
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag discount">
                                            <span>-15%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="women-featured-products">
                            <!-- Product Not Found -->
                            <div class="product-not-found">
                                <div class="not-found">
                                    <h2>SORRY!</h2>
                                    <h6>There is not any product in specific catalogue.</h6>
                                </div>
                            </div>
                            <!-- Product Not Found /- -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="redirect-link-wrapper text-center u-s-p-t-25 u-s-p-b-80">
                <a class="redirect-link" ref="./pages/store-directory.php">
                    <span>View more on this category</span>
                </a>
            </div>
        </div>
    </section>
    <!-- Women-Clothing /- -->
    <!-- Toys-Hobbies-&-Robots -->
    <section class="section-maker">
        <div class="container">
            <div class="sec-maker-header text-center">
                <h3 class="sec-maker-h3">BOTTOMS</h3>
                <!-- <ul class="nav tab-nav-style-1-a justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#women-latest-products">Latest Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#women-best-selling-products">Best Selling</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#women-top-rating-products">Top Rating</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#women-featured-products">Featured Products</a>
                    </li>
                </ul> -->
            </div>
            <div class="wrapper-content">
                <div class="outer-area-tab">
                    <div class="tab-content">
                        <div class="tab-pane active show fade" id="women-latest-products">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">White Solitude Dress with mid heel & Bag
                                                    </a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag new">
                                            <span>NEW</span>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Black Rock Dress with High Jewelery Necklace
                                                    </a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Haiti Full Dress with Boots & Jacket</a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Black & White Wrap Dress with High Jewelery Necklace</a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag new">
                                            <span>NEW</span>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Grey Nickel Special Occasion Dress</a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag sale">
                                            <span>SALE</span>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Red Carmine Winter Special Occasion Dress
                                                    </a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Bottoms</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Shoes</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Wax Flower with Corn Silk Heel
                                                    </a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Intimates</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Bras</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Red Wild Bra
                                                    </a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag discount">
                                            <span>-15%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="women-best-selling-products">
                            <!-- Product Not Found -->
                            <div class="product-not-found">
                                <div class="not-found">
                                    <h2>SORRY!</h2>
                                    <h6>There is not any product in specific catalogue.</h6>
                                </div>
                            </div>
                            <!-- Product Not Found /- -->
                        </div>
                        <div class="tab-pane fade" id="women-top-rating-products">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Grey Nickel Special Occasion Dress</a>
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
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag sale">
                                            <span>SALE</span>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Red Carmine Winter Special Occasion Dress
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
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Bottoms</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Shoes</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Wax Flower with Corn Silk Heel</a>
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
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Intimates</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Bras</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Red Wild Bra</a>
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
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag discount">
                                            <span>-15%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="women-featured-products">
                            <!-- Product Not Found -->
                            <div class="product-not-found">
                                <div class="not-found">
                                    <h2>SORRY!</h2>
                                    <h6>There is not any product in specific catalogue.</h6>
                                </div>
                            </div>
                            <!-- Product Not Found /- -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="redirect-link-wrapper text-center u-s-p-t-25 u-s-p-b-80">
                <a class="redirect-link" ref="./pages/store-directory.php">
                    <span>View more on this category</span>
                </a>
            </div>
        </div>
    </section>
    <!-- Toys-Hobbies-&-Robots /- -->
    <!-- Mobiles-&-Tablets -->
    <section class="section-maker">
        <div class="container">
            <div class="sec-maker-header text-center">
                <h3 class="sec-maker-h3">HEADWEARS</h3>
                <!-- <ul class="nav tab-nav-style-1-a justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#women-latest-products">Latest Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#women-best-selling-products">Best Selling</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#women-top-rating-products">Top Rating</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#women-featured-products">Featured Products</a>
                    </li>
                </ul> -->
            </div>
            <div class="wrapper-content">
                <div class="outer-area-tab">
                    <div class="tab-content">
                        <div class="tab-pane active show fade" id="women-latest-products">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">White Solitude Dress with mid heel & Bag
                                                    </a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag new">
                                            <span>NEW</span>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Black Rock Dress with High Jewelery Necklace
                                                    </a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Haiti Full Dress with Boots & Jacket</a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Black & White Wrap Dress with High Jewelery Necklace</a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag new">
                                            <span>NEW</span>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Grey Nickel Special Occasion Dress</a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag sale">
                                            <span>SALE</span>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Red Carmine Winter Special Occasion Dress
                                                    </a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Bottoms</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Shoes</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Wax Flower with Corn Silk Heel
                                                    </a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Intimates</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Bras</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Red Wild Bra
                                                    </a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag discount">
                                            <span>-15%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="women-best-selling-products">
                            <!-- Product Not Found -->
                            <div class="product-not-found">
                                <div class="not-found">
                                    <h2>SORRY!</h2>
                                    <h6>There is not any product in specific catalogue.</h6>
                                </div>
                            </div>
                            <!-- Product Not Found /- -->
                        </div>
                        <div class="tab-pane fade" id="women-top-rating-products">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Grey Nickel Special Occasion Dress</a>
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
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag sale">
                                            <span>SALE</span>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Red Carmine Winter Special Occasion Dress
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
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Bottoms</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Shoes</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Wax Flower with Corn Silk Heel</a>
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
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Intimates</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Bras</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Red Wild Bra</a>
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
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag discount">
                                            <span>-15%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="women-featured-products">
                            <!-- Product Not Found -->
                            <div class="product-not-found">
                                <div class="not-found">
                                    <h2>SORRY!</h2>
                                    <h6>There is not any product in specific catalogue.</h6>
                                </div>
                            </div>
                            <!-- Product Not Found /- -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="redirect-link-wrapper text-center u-s-p-t-25 u-s-p-b-80">
                <a class="redirect-link" ref="./pages/store-directory.php">
                    <span>View more on this category</span>
                </a>
            </div>
        </div>
    </section>
    <!-- Mobiles-&-Tablets /- -->
    <!-- Consumer-Electronics -->
    <section class="section-maker">
        <div class="container">
            <div class="sec-maker-header text-center">
                <h3 class="sec-maker-h3">BAGS</h3>
                <!-- <ul class="nav tab-nav-style-1-a justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#women-latest-products">Latest Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#women-best-selling-products">Best Selling</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#women-top-rating-products">Top Rating</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#women-featured-products">Featured Products</a>
                    </li>
                </ul> -->
            </div>
            <div class="wrapper-content">
                <div class="outer-area-tab">
                    <div class="tab-content">
                        <div class="tab-pane active show fade" id="women-latest-products">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">White Solitude Dress with mid heel & Bag
                                                    </a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag new">
                                            <span>NEW</span>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Black Rock Dress with High Jewelery Necklace
                                                    </a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Haiti Full Dress with Boots & Jacket</a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Black & White Wrap Dress with High Jewelery Necklace</a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag new">
                                            <span>NEW</span>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Grey Nickel Special Occasion Dress</a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag sale">
                                            <span>SALE</span>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Red Carmine Winter Special Occasion Dress
                                                    </a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Bottoms</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Shoes</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Wax Flower with Corn Silk Heel
                                                    </a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Intimates</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Bras</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Red Wild Bra
                                                    </a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag discount">
                                            <span>-15%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="women-best-selling-products">
                            <!-- Product Not Found -->
                            <div class="product-not-found">
                                <div class="not-found">
                                    <h2>SORRY!</h2>
                                    <h6>There is not any product in specific catalogue.</h6>
                                </div>
                            </div>
                            <!-- Product Not Found /- -->
                        </div>
                        <div class="tab-pane fade" id="women-top-rating-products">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Grey Nickel Special Occasion Dress</a>
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
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag sale">
                                            <span>SALE</span>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Red Carmine Winter Special Occasion Dress
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
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Bottoms</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Shoes</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Wax Flower with Corn Silk Heel</a>
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
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Intimates</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Bras</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Red Wild Bra</a>
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
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag discount">
                                            <span>-15%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="women-featured-products">
                            <!-- Product Not Found -->
                            <div class="product-not-found">
                                <div class="not-found">
                                    <h2>SORRY!</h2>
                                    <h6>There is not any product in specific catalogue.</h6>
                                </div>
                            </div>
                            <!-- Product Not Found /- -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="redirect-link-wrapper text-center u-s-p-t-25 u-s-p-b-80">
                <a class="redirect-link" ref="./pages/store-directory.php">
                    <span>View more on this category</span>
                </a>
            </div>
        </div>
    </section>
    <!-- Consumer-Electronics /- -->
    <!-- Books-&-Audible -->
    <section class="section-maker">
        <div class="container">
            <div class="sec-maker-header text-center">
                <h3 class="sec-maker-h3">ACCESSORIES</h3>
                <!-- <ul class="nav tab-nav-style-1-a justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#women-latest-products">Latest Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#women-best-selling-products">Best Selling</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#women-top-rating-products">Top Rating</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#women-featured-products">Featured Products</a>
                    </li>
                </ul> -->
            </div>
            <div class="wrapper-content">
                <div class="outer-area-tab">
                    <div class="tab-content">
                        <div class="tab-pane active show fade" id="women-latest-products">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">White Solitude Dress with mid heel & Bag
                                                    </a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag new">
                                            <span>NEW</span>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Black Rock Dress with High Jewelery Necklace
                                                    </a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Haiti Full Dress with Boots & Jacket</a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Black & White Wrap Dress with High Jewelery Necklace</a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag new">
                                            <span>NEW</span>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Grey Nickel Special Occasion Dress</a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag sale">
                                            <span>SALE</span>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Red Carmine Winter Special Occasion Dress
                                                    </a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Bottoms</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Shoes</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Wax Flower with Corn Silk Heel
                                                    </a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Intimates</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Bras</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Red Wild Bra
                                                    </a>
                                                </h6>
                                                <div class="item-stars">
                                                    <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag discount">
                                            <span>-15%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="women-best-selling-products">
                            <!-- Product Not Found -->
                            <div class="product-not-found">
                                <div class="not-found">
                                    <h2>SORRY!</h2>
                                    <h6>There is not any product in specific catalogue.</h6>
                                </div>
                            </div>
                            <!-- Product Not Found /- -->
                        </div>
                        <div class="tab-pane fade" id="women-top-rating-products">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Grey Nickel Special Occasion Dress</a>
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
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag sale">
                                            <span>SALE</span>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Tops</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Dresses</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Red Carmine Winter Special Occasion Dress
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
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Bottoms</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Shoes</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Wax Flower with Corn Silk Heel</a>
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
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="./pages/single-product.php">
                                                <img class="img-fluid" src="./assets/images/product/product@3x.jpg" alt="Product">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v1-root-category.php">Women's</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="./pages/shop-v2-sub-category.php">Intimates</a>
                                                    </li>
                                                    <li>
                                                        <a href="./pages/shop-v3-sub-sub-category.php">Bras</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="./pages/single-product.php">Red Wild Bra</a>
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
                                                    $55.00
                                                </div>
                                                <div class="item-old-price">
                                                    $60.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag discount">
                                            <span>-15%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="women-featured-products">
                            <!-- Product Not Found -->
                            <div class="product-not-found">
                                <div class="not-found">
                                    <h2>SORRY!</h2>
                                    <h6>There is not any product in specific catalogue.</h6>
                                </div>
                            </div>
                            <!-- Product Not Found /- -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="redirect-link-wrapper text-center u-s-p-t-25 u-s-p-b-80">
                <a class="redirect-link" ref="./pages/store-directory.php">
                    <span>View more on this category</span>
                </a>
            </div>
        </div>
    </section>
    <!-- Books-&-Audible /- -->
    <!-- Continue-Link -->
    <div class="continue-link-wrapper u-s-p-b-80">
        <a class="continue-link" ref="./pages/store-directory.php" title="View all products on site">
            <i class="ion ion-ios-more"></i>
        </a>
    </div>
    <!-- Continue-Link /- -->
    <!-- Brand-Slider -->
    <div class="brand-slider u-s-p-b-80">
        <div class="container">
            <div class="brand-slider-content owl-carousel" data-item="5">
                <div class="brand-pic">
                    <a href="#">
                        <img src="./assets/images/brand-logos/b1.png" alt="Brand Logo 1">
                    </a>
                </div>
                <div class="brand-pic">
                    <a href="#">
                        <img src="./assets/images/brand-logos/b1.png" alt="Brand Logo 2">
                    </a>
                </div>
                <div class="brand-pic">
                    <a href="#">
                        <img src="./assets/images/brand-logos/b1.png" alt="Brand Logo 3">
                    </a>
                </div>
                <div class="brand-pic">
                    <a href="#">
                        <img src="./assets/images/brand-logos/b1.png" alt="Brand Logo 5">
                    </a>
                </div>
                <div class="brand-pic">
                    <a href="#">
                        <img src="./assets/images/brand-logos/b1.png" alt="Brand Logo 6">
                    </a>
                </div>
                <div class="brand-pic">
                    <a href="#">
                        <img src="./assets/images/brand-logos/b1.png" alt="Brand Logo 7">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Brand-Slider /- -->
    <!-- Site-Priorities -->
    <section class="app-priority">
        <div class="container">
            <div class="priority-wrapper u-s-p-b-80">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="single-item-wrapper">
                            <div class="single-item-icon">
                                <i class="ion ion-md-star"></i>
                            </div>
                            <h2>
                                Great Value
                            </h2>
                            <p>We offer competitive prices on our 100 million plus product range</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="single-item-wrapper">
                            <div class="single-item-icon">
                                <i class="ion ion-md-cash"></i>
                            </div>
                            <h2>
                                Shop with Confidence
                            </h2>
                            <p>Our Protection covers your purchase from click to delivery</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="single-item-wrapper">
                            <div class="single-item-icon">
                                <i class="ion ion-ios-card"></i>
                            </div>
                            <h2>
                                Safe Payment
                            </h2>
                            <p>Pay with the world’s most popular and secure payment methods</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="single-item-wrapper">
                            <div class="single-item-icon">
                                <i class="ion ion-md-contacts"></i>
                            </div>
                            <h2>
                                24/7 Help Center
                            </h2>
                            <p>Round-the-clock assistance for a smooth shopping experience</p>
                        </div>
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
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="footer-list">
                            <h6>CUSTOMER SERVICE</h6>
                            <ul>
                                <li>
                                    <a href="./pages/faq.php">FAQs</a>
                                </li>
                                <li>
                                    <a href="./pages/track-order.php">Track Order</a>
                                </li>
                                <li>
                                    <a href="./pages/terms-and-conditions.php">Terms & Conditions</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="footer-list">
                            <h6>COMPANY</h6>
                            <ul>
                                <li>
                                    <a href="index.html">Home</a>
                                </li>
                                <li>
                                    <a href="./pages/about.php">About</a>
                                </li>
                                <li>
                                    <a ref="./pages/contact.php">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="footer-list">
                            <h6>INFORMATION</h6>
                            <ul>
                                <li>
                                    <a ref="./pages/store-directory.php">Categories Directory</a>
                                </li>
                                <li>
                                    <a href="./pages/wishlist.php">My Wishlist</a>
                                </li>
                                <li>
                                    <a href="./pages/cart.php">My Cart</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="footer-list">
                            <h6>Address</h6>
                            <ul>
                                <li>
                                    <i class="fas fa-location-arrow u-s-m-r-9"></i>
                                    <span>Gurley Street, Monrovia, Liberia</span>
                                </li>
                                <li>
                                    <a href="tel:+231555711018">
                                        <i class="fas fa-phone u-s-m-r-9"></i>
                                        <span>+231555711018 / +231772878894</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="mailto:ziggroupofcompanies231@gmail.com">
                                        <i class="fas fa-envelope u-s-m-r-9"></i>
                                        <span>
                                            Ziggroupofcompanies231@gmail.com</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mid-Footer /- -->
            <!-- Bottom-Footer -->
            <div class="bottom-footer-wrapper">
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
    <!-- Responsive-Search /- -->
    <!-- Newsletter-Modal -->
    <div id="newsletter-modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="button dismiss-button ion ion-ios-close" data-dismiss="modal"></button>
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
                                        <button class="button button-primary d-block w-100">Subscribe</button>
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
                                            <a href="index.html">Home</a>
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
</html>

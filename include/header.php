<?php 
    $isLoggedIn = isLoggedIn();
    $userRole = isset($_SESSION['role']) ? $_SESSION['role'] : '';
?>
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
                                                <a href="../user/dashboard/cart.php">
                                                    <i class="fas fa-cog u-s-m-r-9"></i>
                                                    My Cart</a>
                                            </li>
                                            <li>
                                                <a href="../user/dashboard/checkout.php">
                                                    <i class="far fa-check-circle u-s-m-r-9"></i>
                                                    Checkout</a>
                                            </li>
                                        <?php endif; ?>

                                        <li>
                                            <a href="../user/logout.php">
                                                <i class="fas fa-sign-out-alt"></i> 
                                                Logout</a>
                                        </li>
                                    <?php else: ?>
                                        <!-- Show these when not logged in -->
                                        <li>
                                            <a href="../pages/login.php">
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
                                    <a href="../admin/dashboard/dashboard.php">
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
                            <a href="../index.php">
                                <img src="../assets/images/main-logo/ZIG.png" alt="Groover Brand Logo" class="app-brand-logo">
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
                                        
                                        <?php
                                        try {
                                            $productcategories = $pdo->query("SELECT * FROM productcategory")->fetchAll();
                                        } catch (PDOException $e) {
                                            die("Error fetching categories: " . $e->getMessage());
                                        }
                                        
                                        foreach ($productcategories as $productcategory): ?>
                                        
                                        <option value=""><?= htmlspecialchars(strtoupper($productcategory['categoryname'])) ?></option>
                    
                                        <?php endforeach; ?>
                                        
                                       <option value="">Services
                                        </option>
                                        
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
                                    <a href="../pages/wishlist.php">
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
                <a href="../pages/wishlist.php">
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
                        <a href="../pages/single-product.php">
                            <img src="../assets/images/product/product@1x.jpg" alt="Product">
                            <span class="mini-item-name">Casual Hoodie Full Cotton</span>
                            <span class="mini-item-price">$55.00</span>
                            <span class="mini-item-quantity"> x 1 </span>
                        </a>
                    </li>
                    <li class="clearfix">
                        <a href="../pages/single-product.php">
                            <img src="../assets/images/product/product@1x.jpg" alt="Product">
                            <span class="mini-item-name">Black Rock Dress with High Jewelery Necklace</span>
                            <span class="mini-item-price">$55.00</span>
                            <span class="mini-item-quantity"> x 1 </span>
                        </a>
                    </li>
                    <li class="clearfix">
                        <a href="../pages/single-product.php">
                            <img src="../assets/images/product/product@1x.jpg" alt="Product">
                            <span class="mini-item-name">Xiaomi Note 2 Black Color</span>
                            <span class="mini-item-price">$55.00</span>
                            <span class="mini-item-quantity"> x 1 </span>
                        </a>
                    </li>
                    <li class="clearfix">
                        <a href="../pages/single-product.php">
                            <img src="../assets/images/product/product@1x.jpg" alt="Product">
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
                    <a href="../pages/cart.php" class="cart-anchor">View Cart</a>
                    <a href="../pages/checkout.php" class="checkout-anchor">Checkout</a>
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
                                        <?php
                                        try {
                                            $productcategories = $pdo->query("SELECT * FROM productcategory")->fetchAll();
                                        } catch (PDOException $e) {
                                            die("Error fetching categories: " . $e->getMessage());
                                        }
                                        
                                        foreach ($productcategories as $productcategory): ?>
                                        <li class="js-backdrop v-none" style="display: none">
                                            <a href="../pages/shop-v1-root-category.php">
                                                <?= htmlspecialchars(strtoupper($productcategory['categoryname'])) ?>
                                            </a>
                                            <button class="v-button ion ion-md-add"></button>
                                        </li>
                                        <?php endforeach; ?>
                                        
                                        <!-- Optional static items (like SERVICES) -->
                                        <li class="v-none" style="display: none">
                                            <a href="../pages/about.php">
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
                                <a href="../pages/custom-deal-page.php">New Arrivals
                                    <span class="superscript-label-new">NEW</span>
                                </a>
                            </li>
                            <li>
                                <a href="../pages/custom-deal-page.php">Exclusive Deals
                                    <span class="superscript-label-hot">HOT</span>
                                </a>
                            </li>
                            <li>
                                <a href="../pages/custom-deal-page.php">Flash Deals
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
                                <a href="../pages/custom-deal-page.php">Super Sale
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
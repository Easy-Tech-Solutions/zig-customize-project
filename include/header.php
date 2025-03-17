<header>
<?php
session_start();
?>
        
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

                            <?php  if(isset($_SESSION['login_user']))
								{ ?>
                                    <li>
                                        <a href="./pages/profile.php">
                                            <i class="fas fa-user"></i>
                                        Profile</a>
                                    </li>

                                    <li>
                                        <a href="./pages/cart.php">
                                            <i class="fas fa-cog u-s-m-r-9"></i>
                                            My Cart</a>
                                    </li>
                                    <li>
                                        <a href="./pages/checkout.php">
                                            <i class="far fa-check-circle u-s-m-r-9"></i>
                                            Checkout</a>
                                    </li>

                                    <li>
                                        <a href="./user/logout.php">
                                            <i class="fas fa-sign-out-alt"></i> 
                                            Logout</a>
                                    </li>

                                    <?php } else { ?>
                                    <li>
                                        <a href="./pages/account.php">
                                            <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                                            Login / Signup</a>
                                    </li> <?php } ?>
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
                                <!-- <li>
                                    <a href="#">ARB</a>
                                </li> -->
                            </ul>
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
                                    <a href="../index.php">
                                        <i class="ion ion-md-home u-c-brand"></i>
                                    </a>
                                </li>
                                <li class="u-d-none-lg">
                                    <a href="./wishlist.php">
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
                <a href="./wishlist.php">
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
                        <a href="./single-product.php">
                            <img src="../assets/images/product/product@1x.jpg" alt="Product">
                            <span class="mini-item-name">Casual Hoodie Full Cotton</span>
                            <span class="mini-item-price">$55.00</span>
                            <span class="mini-item-quantity"> x 1 </span>
                        </a>
                    </li>
                    <li class="clearfix">
                        <a href="./single-product.php">
                            <img src="../assets/images/product/product@1x.jpg" alt="Product">
                            <span class="mini-item-name">Black Rock Dress with High Jewelery Necklace</span>
                            <span class="mini-item-price">$55.00</span>
                            <span class="mini-item-quantity"> x 1 </span>
                        </a>
                    </li>
                    <li class="clearfix">
                        <a href="./single-product.php">
                            <img src="../assets/images/product/product@1x.jpg" alt="Product">
                            <span class="mini-item-name">Xiaomi Note 2 Black Color</span>
                            <span class="mini-item-price">$55.00</span>
                            <span class="mini-item-quantity"> x 1 </span>
                        </a>
                    </li>
                    <li class="clearfix">
                        <a href="./single-product.php">
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
                    <a href="./cart.php" class="cart-anchor">View Cart</a>
                    <a href="./checkout.php" class="checkout-anchor">Checkout</a>
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
                                            <a href="./shop-v1-root-category.php">
                                                <!-- <i class="ion ion-md-shirt"></i> -->
                                                TOPS
                                                <!-- <i class="ion ion-ios-arrow-forward"></i> -->
                                            </a>
                                            <button class="v-button ion ion-md-add"></button>
                                            <!-- <div class="v-drop-right" style="width: 700px;">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <ul class="v-level-2">
                                                            <li>
                                                                <a href="./shop-v2-sub-category.php">Tops</a>
                                                                <ul>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">T-Shirts</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Hoodies</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Suits</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v4-filter-as-category.php">Black Bean T-Shirt
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <ul class="v-level-2">
                                                            <li>
                                                                <a href="./shop-v2-sub-category.php">Outwear</a>
                                                                <ul>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Jackets</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Trench</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Parkas</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Sweaters</a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <ul class="v-level-2">
                                                            <li>
                                                                <a href="./shop-v1-root-category.php">Accessories</a>
                                                                <ul>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Watches</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Ties</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Scarves</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Belts</a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <ul class="v-level-2">
                                                            <li>
                                                                <a href="./shop-v2-sub-category.php">Bottoms</a>
                                                                <ul>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Casual Pants
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Shoes</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Jeans</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Shorts</a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <ul class="v-level-2">
                                                            <li>
                                                                <a href="./shop-v2-sub-category.php">Underwear</a>
                                                                <ul>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Boxers</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Briefs</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Robes</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Socks</a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <ul class="v-level-2">
                                                            <li>
                                                                <a href="./shop-v2-sub-category.php">Sunglasses</a>
                                                                <ul>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Pilot</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Wayfarer</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Square</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Round</a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </li>
                                        <li class="js-backdrop">
                                            <a href="./shop-v1-root-category.php">
                                                <!-- <i class="fi fi-ss-hat-beach"></i> -->
                                              BOTTOMS
                                                <!-- <i class="ion ion-ios-arrow-forward"></i> -->
                                            </a>
                                            <button class="v-button ion ion-md-add"></button>
                                            <!-- <div class="v-drop-right" style="width: 700px;">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <ul class="v-level-2">
                                                            <li>
                                                                <a href="./shop-v2-sub-category.php">Tops</a>
                                                                <ul>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Dresses</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Blouses & Shirts
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">T-shirts</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Sweater</a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <ul class="v-level-2">
                                                            <li>
                                                                <a href="./shop-v2-sub-category.php">Intimates</a>
                                                                <ul>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Bras</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Brief Sets
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Bustiers & Corsets
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Panties</a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <ul class="v-level-2">
                                                            <li>
                                                                <a href="./shop-v2-sub-category.php">Wedding & Events
                                                                </a>
                                                                <ul>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Wedding Dresses
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v2-sub-category.php">Evening Dresses
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Prom Dresses
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Flower Dresses
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <ul class="v-level-2">
                                                            <li>
                                                                <a href="./shop-v2-sub-category.php">Bottoms</a>
                                                                <ul>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Skirts</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Shoes</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Leggings</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Jeans</a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <ul class="v-level-2">
                                                            <li>
                                                                <a href="./shop-v2-sub-category.php">Outwear & Jackets
                                                                </a>
                                                                <ul>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Blazers</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Basics Jackets
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Trench</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Leather & Suede
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <ul class="v-level-2">
                                                            <li>
                                                                <a href="./shop-v2-sub-category.php">Accessories</a>
                                                                <ul>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Sunglasses</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Headwear</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Baseball Caps
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Belts</a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </li>
                                        <li class="js-backdrop">
                                            <a href="./shop-v1-root-category.php">
                                                <!-- <i class="ion ion-ios-shirt"></i> -->
                                                HEADWEAR
                                                <!-- <i class="ion ion-ios-arrow-forward"></i> -->
                                            </a>
                                            <button class="v-button ion ion-md-add"></button>
                                            <div class="v-drop" style="width: 700px;">
                                                <!-- <div class="row">
                                                     <div class="col-lg-4">
                                                        <ul class="v-level-2">
                                                            <li>
                                                                <a href="./shop-v2-sub-category.php">RC Toys & Hobbies
                                                                </a>
                                                                <ul>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">RC Helicopter
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">RC Lego Robots
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">RC Drone
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">RC Car
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">RC Boat
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">RC Robot
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Multi Rotor Parts
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">FPV System
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Radios & Receiver
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Battery & Charger
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div> 
                                                    <div class="col-lg-4">
                                                        <ul class="v-level-2">
                                                            <li>
                                                                <a href="./shop-v2-sub-category.php">Solar Energy
                                                                </a>
                                                                <ul>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Solar Powered Toy
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="./shop-v3-sub-sub-category.php">Solar Powered System
                                                                        </a>
                                                                    </li>
                                                                    <li class="view-more-flag">
                                                                        <a href="./store-directory.php">View More
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div> -->
                                                <!-- Remember layer image should be place on empty space and its not overlap your list items because user could not read your list items. -->
                                                <!-- <div class="v-image" style="bottom: 0;right: -25px">
                                                    <a href="#" class="d-block">
                                                        <img src="../assets/images/banners/mega-3.png" class="img-fluid" alt="Product">
                                                    </a>
                                                </div> -->
                                            </div>
                                        </li>
                                        <li class="v-none" style="display: none">
                                            <a href="./shop-v1-root-category.php">
                                                <!-- <i class="ion ion-md-phone-portrait"></i> -->
                                                BAGS
                                            </a>
                                        </li>
                                        <li class="v-none" style="display: none">
                                            <a href="./shop-v1-root-category.php">
                                                <!-- <i class="ion ion-md-tv"></i> -->
                                                ACCESSORIES
                                            </a>
                                        </li>
                                        <!-- <li>
                                            <a href="./shop-v1-root-category.php">
                                                <i class="ion ion-ios-book"></i>
                                                ACCESSORIES
                                            </a>
                                        </li> -->
                                        <!-- <li>
                                            <a href="./shop-v1-root-category.php">
                                                <i class="ion ion-md-heart"></i>
                                                Beauty & Health
                                            </a>
                                        </li> -->
                                        <li class="v-none" style="display: none">
                                            <a href="./about.php">
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
                                <a href="./custom-deal-page.php">New Arrivals
                                    <span class="superscript-label-new">NEW</span>
                                </a>
                            </li>
                            <li>
                                <a href="./custom-deal-page.php">Exclusive Deals
                                    <span class="superscript-label-hot">HOT</span>
                                </a>
                            </li>
                            <li>
                                <a href="./custom-deal-page.php">Flash Deals
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
                                            <a href="../index.php" class="u-c-brand">Home</a>
                                        </li>
                                        <li>
                                            <a href="./about.php">About</a>
                                        </li>
                                        <li>
                                            <a href="./contact.php">Contact</a>
                                        </li>
                                        <li>
                                            <a href="./faq.php">FAQ</a>
                                        </li>
                                        <!-- <li>
                                            <a href="./store-directory.php">Store Directory</a>
                                        </li> -->
                                        <li>
                                            <a href="./terms-and-conditions.php">Terms & Conditions</a>
                                        </li>
                                        <!-- <li>
                                            <a href="./404.php">404</a>
                                        </li> -->
                                        <!-- <li class="menu-title">Single Product Page</li> -->
                                        <!-- <li>
                                            <a href="./single-product.php">Single Product Fullwidth</a>
                                        </li> -->
                                        <li class="menu-title">Blog</li>
                                        <li>
                                            <a href="./blog.php">Zig Updates </a>
                                        </li>
                                        <!-- <li>
                                            <a href="./blog-detail.php">Blog Details</a>
                                        </li> -->
                                    </ul>
                                    <ul>
                                        <li class="menu-title">Shop</li>
                                        <li>
                                            <a href="./shop-v2-sub-category.php">Shop</a>
                                        </li>
                                        <li>
                                            <a href="./cart.php">Cart</a>
                                        </li>
                                        <li>
                                            <a href="./checkout.php">Checkout</a>
                                        </li>
                                        <li>
                                            <a href="./account.php">My Account</a>
                                        </li>
                                        <li>
                                            <a href="./wishlist.php">Wishlist</a>
                                        </li>
                                        <li>
                                            <a href="./track-order.php">Track your Order</a>
                                        </li>
                                        <!-- <li class="menu-title">Cart Variations</li> -->
                                        <!-- <li>
                                            <a href="./cart-empty.php">Cart Ver 1 Empty</a>
                                        </li> -->
                                        <!-- <li>
                                            <a href="./cart.php">Cart</a>
                                        </li> -->
                                        <li class="menu-title">Wishlist</li>
                                        <!-- <li>
                                            <a href="./wishlist-empty.php">Wishlist Ver 1 Empty</a>
                                        </li> -->
                                        <li>
                                            <a href="./wishlist.php">Wishlist</a>
                                        </li>
                                    </ul>
                                    <ul>
                                        <!-- <li class="menu-title">Shop Variations</li>
                                        <li> -->
                                            <!-- <a href="./shop-v1-root-category.php">Shop Ver 1 Root Category</a>
                                        </li>
                                        <li>
                                            <a href="./shop-v2-sub-category.php">Shop Ver 2 Sub Category</a>
                                        </li>
                                        <li>
                                            <a href="./shop-v3-sub-sub-category.php">Shop Ver 3 Sub Sub Category</a>
                                        </li>
                                        <li>
                                            <a href="./shop-v4-filter-as-category.php">Shop Ver 4 Filter as Category</a>
                                        </li>
                                        <li>
                                            <a href="./shop-v5-product-not-found.php">Shop Ver 5 Product Not Found</a>
                                        </li>
                                        <li>
                                            <a href="./shop-v6-search-results.php">Shop Ver 6 Search Results</a>
                                        </li> -->
                                        <li class="menu-title">Account</li>
                                        <li>
                                            <a href="./lost-password.php">Lost Your Password ?</a>
                                        </li>
                                        <!-- <li class="menu-title">Checkout Variation</li>
                                        <li>
                                            <a href="./confirmation.php">Checkout Confirmation</a>
                                        </li> -->
                                        <li class="menu-title">Custom Deals</li>
                                        <li>
                                            <a href="./custom-deal-page.php">Custom Deal Page</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="./custom-deal-page.php">Super Sale
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
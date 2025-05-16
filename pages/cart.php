<?php
include('../sql_connection/config.php');
requireLogin();

try {
    // Get cart items for the current user
    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("
        SELECT c.id as cart_id, p.id as product_id, p.name, p.price, p.image_path, c.quantity 
        FROM cart c 
        JOIN products p ON c.product_id = p.id 
        WHERE c.user_id = ?
    ");
    $stmt->execute([$user_id]);
    $cart_items = $stmt->fetchAll();
    
    $total = 0;
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
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
        <link href="../assets/images/favicon/favicon.ico" rel="shortcut icon">
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
            
            <!-- Page Introduction Wrapper -->
            <div class="page-style-a">
                <div class="container">
                    <div class="page-intro">
                        <h2>Cart</h2>
                        <ul class="bread-crumb">
                            <li class="has-separator">
                                <i class="ion ion-md-home"></i>
                                <a href="../index.php">Home</a>
                            </li>
                            <li class="is-marked">
                                <a href="./cart.php">Cart</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Cart-Page -->
            <div class="page-cart u-s-p-t-80">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="update-cart.php" method="post">
                                <!-- Products-List-Wrapper -->
                                <div class="table-wrapper u-s-m-b-60">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Subtotal</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($cart_items as $item): 
                                                $subtotal = $item['price'] * $item['quantity'];
                                                $total += $subtotal;
                                            ?>
                                            <tr>
                                                <td>
                                                    <div class="cart-anchor-image">
                                                        <a href="./single-product.php?id=<?= $item['product_id'] ?>">
                                                            <img src="<?= $item['image_path'] ? '../assets/images/product/' . $item['image_path'] : '../assets/images/product/product@1x.jpg' ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                                                            <h6><?= htmlspecialchars($item['name']) ?></h6>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="cart-price">
                                                        $<?= number_format($item['price'], 2) ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="cart-quantity">
                                                        <div class="quantity">
                                                            <input type="number" name="quantity[<?= $item['cart_id'] ?>]" class="quantity-text-field" value="<?= $item['quantity'] ?>" min="1">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="cart-price">
                                                        $<?= number_format($subtotal, 2) ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="action-wrapper">
                                                        <button type="submit" name="update" class="button button-outline-secondary fas fa-sync"></button>
                                                        <a href="remove-from-cart.php?id=<?= $item['cart_id'] ?>" class="button button-outline-secondary fas fa-trash"></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            
                                            <?php if (empty($cart_items)): ?>
                                            <tr>
                                                <td colspan="5" class="text-center">Your cart is empty</td>
                                            </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <?php if (!empty($cart_items)): ?>
                                <div class="coupon-continue-checkout u-s-m-b-60">
                                    <div class="button-area">
                                        <button type="submit" name="update_all" class="button">Update Cart</button>
                                        <a href="./shop.php" class="continue">Continue Shopping</a>
                                        <a href="./checkout.php" class="checkout">Proceed to Checkout</a>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </form>
                            
                            <!-- Billing -->
                            <?php if (!empty($cart_items)): ?>
                            <div class="calculation u-s-m-b-60">
                                <div class="table-wrapper-2">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th colspan="2">Cart Totals</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <h3 class="calc-h3 u-s-m-b-0">Subtotal</h3>
                                                </td>
                                                <td>
                                                    <span class="calc-text">$<?= number_format($total, 2) ?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h3 class="calc-h3 u-s-m-b-8">Shipping</h3>
                                                    <div class="calc-choice-text u-s-m-b-4">Flat Rate: Not Available</div>
                                                    <div class="calc-choice-text u-s-m-b-4">Free Shipping: Not Available</div>
                                                </td>
                                                <td>
                                                    <span class="calc-text">$0.00</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h3 class="calc-h3 u-s-m-b-0">Total</h3>
                                                </td>
                                                <td>
                                                    <span class="calc-text">$<?= number_format($total, 2) ?></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <?php include("../include/footer.php"); ?>
        </div>
        
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
</div>

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
    <script type="text/javascript" src="../assets/js/vendor/modernizr-custom.min.js"></script>
    <!-- NProgress -->
    <script type="text/javascript" src="../assets/js/nprogress.min.js"></script>
    <!-- jQuery -->
    <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <!-- Popper -->
    <script type="text/javascript" src="../assets/js/popper.min.js"></script>
    <!-- ScrollUp -->
    <script type="text/javascript" src="../assets/js/jquery.scrollUp.min.js"></script>
    <!-- Elevate Zoom -->
    <script type="text/javascript" src="../assets/js/jquery.elevatezoom.min.js"></script>
    <!-- jquery-ui-range-slider -->
    <script type="text/javascript" src="../assets/js/jquery-ui.range-slider.min.js"></script>
    <!-- jQuery Slim-Scroll -->
    <script type="text/javascript" src="../assets/js/jquery.slimscroll.min.js"></script>
    <!-- jQuery Resize-Select -->
    <script type="text/javascript" src="../assets/js/jquery.resize-select.min.js"></script>
    <!-- jQuery Custom Mega Menu -->
    <script type="text/javascript" src="../assets/js/jquery.custom-megamenu.min.js"></script>
    <!-- jQuery Countdown -->
    <script type="text/javascript" src="../assets/js/jquery.custom-countdown.min.js"></script>
    <!-- Owl Carousel -->
    <script type="text/javascript" src="../assets/js/owl.carousel.min.js"></script>
    <!-- Main -->
    <script type="text/javascript" src="../assets/js/app.js"></script>

    </body>
</html>
<?php
session_start();

// Include your database connection if needed
include('../sql_connection/config.php');

// Get product ID from URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch product details
$product_query = "SELECT p.*, b.name as brand_name, c.categoryname as category_name 
                 FROM products p 
                 LEFT JOIN brands b ON p.brand_id = b.id 
                 LEFT JOIN productcategory c ON p.category_id = c.id 
                 WHERE p.id = ?";
$product_stmt = $pdo->prepare($product_query);
$product_stmt->execute([$product_id]);
$product = $product_stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die("Product not found");
}

// Fetch product images
$images_query = "SELECT * FROM product_thumbnails WHERE product_id = ?";
$images_stmt = $pdo->prepare($images_query);
$images_stmt->execute([$product_id]);
$images = $images_stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch product colors
$colors_query = "SELECT c.* FROM colors c 
                JOIN product_colors pc ON c.id = pc.color_id 
                WHERE pc.product_id = ?";
$colors_stmt = $pdo->prepare($colors_query);
$colors_stmt->execute([$product_id]);
$colors = $colors_stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch product sizes
$sizes_query = "SELECT s.* FROM sizes s 
               JOIN product_sizes ps ON s.id = ps.size_id 
               WHERE ps.product_id = ?";
$sizes_stmt = $pdo->prepare($sizes_query);
$sizes_stmt->execute([$product_id]);
$sizes = $sizes_stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculate discount percentage if sale price exists
$discount = 0;
if ($product['sale_price'] > 0 && $product['price'] > $product['sale_price']) {
    $discount = round((($product['price'] - $product['sale_price']) / $product['price']) * 100);
}

// Handle review submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_review'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $rating = intval($_POST['rating']);
    $title = $_POST['title'];
    $review = $_POST['review'];
    
    // Insert review into database
    $insert_review = "INSERT INTO reviews (product_id, user_id, rating, title, comment, created_at) 
                     VALUES (?, NULL, ?, ?, ?, NOW())";
    $review_stmt = $pdo->prepare($insert_review);
    $review_stmt->execute([$product_id, $rating, $title, $review]);
    
    // Redirect to avoid form resubmission
    header("Location: product.php?id=$product_id");
    exit();
}

// Fetch reviews for this product
$reviews_query = "SELECT * FROM reviews WHERE product_id = ? ORDER BY created_at DESC";
$reviews_stmt = $pdo->prepare($reviews_query);
$reviews_stmt->execute([$product_id]);
$reviews = $reviews_stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculate average rating
$avg_rating = 0;
if (count($reviews) > 0) {
    $total_ratings = array_sum(array_column($reviews, 'rating'));
    $avg_rating = $total_ratings / count($reviews);
}

// Calculate star distribution
$star_counts = [0, 0, 0, 0, 0]; // 1-5 stars
foreach ($reviews as $review) {
    if ($review['rating'] >= 1 && $review['rating'] <= 5) {
        $star_counts[5 - $review['rating']]++;
    }
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
    <!-- Header /- -->
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Detail</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="../index.html">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="./single-product.php">Detail</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
	
	<div class="page-detail u-s-p-t-80">
		<div class="container">
        <!-- Product-Detail -->
			<div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <!-- Product-zoom-area -->
                <div class="zoom-area">
                    <?php if (!empty($images)): ?>
                        <img id="zoom-pro" class="img-fluid" src="<?php echo htmlspecialchars($images[0]['src']); ?>" 
                             data-zoom-image="<?php echo htmlspecialchars($images[0]['src']); ?>" alt="Zoom Image">
                        <div id="gallery" class="u-s-m-t-10">
                            <?php foreach ($images as $image): ?>
                                <a data-image="<?php echo htmlspecialchars($image['src']); ?>" 
                                   data-zoom-image="<?php echo htmlspecialchars($image['src']); ?>">
                                    <img src="<?php echo htmlspecialchars($image['src']); ?>" alt="Product">
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <img id="zoom-pro" class="img-fluid" src="../assets/images/product/product@4x.jpg" 
                             data-zoom-image="../assets/images/product/product@4x.jpg" alt="Zoom Image">
                    <?php endif; ?>
                </div>
                <!-- Product-zoom-area /- -->
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <!-- Product-details -->
                <div class="all-information-wrapper">
                    <div class="section-1-title-breadcrumb-rating">
                        <div class="product-title">
                            <h1>
                                <a href="#"><?php echo htmlspecialchars($product['name']); ?></a>
                            </h1>
                        </div>
                        <ul class="bread-crumb">
                            <li class="has-separator">
                                <a href="../index.html">Home</a>
                            </li>
                            <li class="has-separator">
                                <a href="#"><?php echo htmlspecialchars($product['category_name']); ?></a>
                            </li>
                            <li class="is-marked">
                                <a href="#"><?php echo htmlspecialchars($product['brand_name']); ?></a>
                            </li>
                        </ul>
                        <div class="product-rating">
                            <div class='star' title="<?php echo $avg_rating; ?> out of 5 - based on <?php echo count($reviews); ?> Reviews">
                                <span style='width:<?php echo ($avg_rating / 5) * 100; ?>px'></span>
                            </div>
                            <span>(<?php echo count($reviews); ?>)</span>
                        </div>
                    </div>
                    <div class="section-2-short-description u-s-p-y-14">
                        <h6 class="information-heading u-s-m-b-8">Description:</h6>
                        <p><?php echo htmlspecialchars($product['description']); ?></p>
                    </div>
                    <div class="section-3-price-original-discount u-s-p-y-14">
                        <div class="price">
                            <h4>$<?php echo number_format($product['sale_price'] > 0 ? $product['sale_price'] : $product['price'], 2); ?></h4>
                        </div>
                        <?php if ($product['sale_price'] > 0): ?>
                            <div class="original-price">
                                <span>Original Price:</span>
                                <span>$<?php echo number_format($product['price'], 2); ?></span>
                            </div>
                            <div class="discount-price">
                                <span>Discount:</span>
                                <span><?php echo $discount; ?>%</span>
                            </div>
                            <div class="total-save">
                                <span>Save:</span>
                                <span>$<?php echo number_format($product['price'] - $product['sale_price'], 2); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="section-4-sku-information u-s-p-y-14">
                        <h6 class="information-heading u-s-m-b-8">Sku Information:</h6>
                        <div class="availability">
                            <span>Availability:</span>
                            <span><?php echo $product['quantity'] > 0 ? 'In Stock' : 'Out of Stock'; ?></span>
                        </div>
                        <div class="left">
                            <span>Only:</span>
                            <span><?php echo $product['quantity']; ?> left</span>
                        </div>
                    </div>
                    <div class="section-5-product-variants u-s-p-y-14">
                        <h6 class="information-heading u-s-m-b-8">Product Variants:</h6>
                        <?php if (!empty($colors)): ?>
                            <div class="color u-s-m-b-11">
                                <span>Available Color:</span>
                                <div class="color-variant select-box-wrapper">
                                    <select class="select-box product-color">
                                        <?php foreach ($colors as $color): ?>
                                            <option value="<?php echo $color['id']; ?>"><?php echo htmlspecialchars($color['name']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($sizes)): ?>
                            <div class="sizes u-s-m-b-11">
                                <span>Available Size:</span>
                                <div class="size-variant select-box-wrapper">
                                    <select class="select-box product-size">
                                        <?php foreach ($sizes as $size): ?>
                                            <option value="<?php echo $size['id']; ?>"><?php echo htmlspecialchars($size['name']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="section-6-social-media-quantity-actions u-s-p-y-14">
                        <form action="cart.php" method="post" class="post-form">
                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
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
                                    <input type="number" name="quantity" class="quantity-text-field" value="1" min="1" max="<?php echo $product['quantity']; ?>">
                                </div>
                            </div>
                            <div>
                                <button class="button button-outline-secondary" type="submit" name="add_to_cart">Add to cart</button>
                                <button class="button button-outline-secondary far fa-heart u-s-m-l-6" type="button"></button>
                                <button class="button button-outline-secondary far fa-envelope u-s-m-l-6" type="button"></button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Product-details /- -->
            </div>
        </div>
        <!-- Product-Detail /- -->
        <!-- Detail-Tabs -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="detail-tabs-wrapper u-s-p-t-80">
                    <div class="detail-nav-wrapper u-s-m-b-30">
                        <ul class="nav single-product-nav justify-content-center">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#description">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#specification">Specifications</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#review">Reviews (<?php echo count($reviews); ?>)</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <!-- Description-Tab -->
                        <div class="tab-pane fade active show" id="description">
                            <div class="description-whole-container">
                                <p class="desc-p u-s-m-b-26"><?php echo htmlspecialchars($product['description']); ?></p>
                                <?php if (!empty($images)): ?>
                                    <img class="desc-img img-fluid u-s-m-b-26" src="<?php echo htmlspecialchars($images[0]['src']); ?>" alt="Product">
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- Description-Tab /- -->
                        <!-- Specifications-Tab -->
                        <div class="tab-pane fade" id="specification">
                            <div class="specification-whole-container">
                                <div class="spec-table u-s-m-b-50">
                                    <h4 class="spec-heading">General Information</h4>
                                    <table>
                                        <tr>
                                            <td>Sku</td>
                                            <td><?php echo htmlspecialchars($product['code']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Brand</td>
                                            <td><?php echo htmlspecialchars($product['brand_name']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Category</td>
                                            <td><?php echo htmlspecialchars($product['category_name']); ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="spec-table u-s-m-b-50">
                                    <h4 class="spec-heading">Product Information</h4>
                                    <table>
                                        <?php if (!empty($colors)): ?>
                                            <tr>
                                                <td>Color</td>
                                                <td><?php echo implode(', ', array_column($colors, 'name')); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if (!empty($sizes)): ?>
                                            <tr>
                                                <td>Size</td>
                                                <td><?php echo implode(', ', array_column($sizes, 'name')); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Specifications-Tab /- -->
                        <!-- Reviews-Tab -->
                        <div class="tab-pane fade" id="review">
                            <div class="review-whole-container">
                                <div class="row r-1 u-s-m-b-26 u-s-p-b-22">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="total-score-wrapper">
                                            <h6 class="review-h6">Average Rating</h6>
                                            <div class="circle-wrapper">
                                                <h1><?php echo number_format($avg_rating, 1); ?></h1>
                                            </div>
                                            <h6 class="review-h6">Based on <?php echo count($reviews); ?> Reviews</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="total-star-meter">
                                            <?php for ($i = 5; $i >= 1; $i--): ?>
                                                <div class="star-wrapper">
                                                    <span><?php echo $i; ?> Stars</span>
                                                    <div class="star">
                                                        <span style='width:<?php echo count($reviews) > 0 ? ($star_counts[5-$i] / count($reviews)) * 100 : 0; ?>px'></span>
                                                    </div>
                                                    <span>(<?php echo $star_counts[5-$i]; ?>)</span>
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row r-2 u-s-m-b-26 u-s-p-b-22">
                                    <div class="col-lg-12">
                                        <div class="your-rating-wrapper">
                                            <h6 class="review-h6">Your Review is matter.</h6>
                                            <h6 class="review-h6">Have you used this product before?</h6>
                                            <form method="post">
                                                <div class="star-wrapper u-s-m-b-8">
                                                    <div class="star">
                                                        <span id="your-stars" style='width:0'></span>
                                                    </div>
                                                    <input type="hidden" id="your-rating-value" name="rating" value="0">
                                                    <span id="star-comment"></span>
                                                </div>
                                                <label for="your-name">Name
                                                    <span class="astk"> *</span>
                                                </label>
                                                <input id="your-name" type="text" name="name" class="text-field" placeholder="Your Name" required>
                                                <label for="your-email">Email
                                                    <span class="astk"> *</span>
                                                </label>
                                                <input id="your-email" type="email" name="email" class="text-field" placeholder="Your Email" required>
                                                <label for="review-title">Review Title
                                                    <span class="astk"> *</span>
                                                </label>
                                                <input id="review-title" type="text" name="title" class="text-field" placeholder="Review Title" required>
                                                <label for="review-text-area">Review
                                                    <span class="astk"> *</span>
                                                </label>
                                                <textarea class="text-area u-s-m-b-8" id="review-text-area" name="review" placeholder="Review" required></textarea>
                                                <button class="button button-outline-secondary" type="submit" name="submit_review">Submit Review</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Get-Reviews -->
                                <div class="get-reviews u-s-p-b-22">
                                    <!-- Review-Options -->
                                    <div class="review-options u-s-m-b-16">
                                        <div class="review-option-heading">
                                            <h6>Reviews
                                                <span> (<?php echo count($reviews); ?>) </span>
                                            </h6>
                                        </div>
                                        <div class="review-option-box">
                                            <div class="select-box-wrapper">
                                                <label class="sr-only" for="review-sort">Review Sorter</label>
                                                <select class="select-box" id="review-sort">
                                                    <option value="newest">Sort by: Newest</option>
                                                    <option value="highest">Sort by: Highest Rating</option>
                                                    <option value="lowest">Sort by: Lowest Rating</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Review-Options /- -->
                                    <!-- All-Reviews -->
                                    <div class="reviewers">
                                        <?php foreach ($reviews as $review): ?>
                                            <div class="review-data">
                                                <div class="reviewer-name-and-date">
                                                    <h6 class="reviewer-name"><?php echo htmlspecialchars($review['name']); ?></h6>
                                                    <h6 class="review-posted-date"><?php echo date('d M Y', strtotime($review['created_at'])); ?></h6>
                                                </div>
                                                <div class="reviewer-stars-title-body">
                                                    <div class="reviewer-stars">
                                                        <div class="star">
                                                            <span style='width:<?php echo ($review['rating'] / 5) * 100; ?>px'></span>
                                                        </div>
                                                        <span class="review-title"><?php echo htmlspecialchars($review['title']); ?></span>
                                                    </div>
                                                    <p class="review-body">
                                                        <?php echo htmlspecialchars($review['comment']); ?>
                                                    </p>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <!-- All-Reviews /- -->
                                    <!-- Pagination-Review -->
                                    <div class="pagination-review-area">
                                        <!-- You can implement pagination here if needed -->
                                    </div>
                                    <!-- Pagination-Review /- -->
                                </div>
                                <!-- Get-Reviews /- -->
                            </div>
                        </div>
                        <!-- Reviews-Tab /- -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Detail-Tabs /- -->
    </div>
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
	// JavaScript for star rating input
	document.addEventListener('DOMContentLoaded', function() {
		const starContainer = document.querySelector('.star-wrapper .star');
		const ratingInput = document.getElementById('your-rating-value');
		const starComment = document.getElementById('star-comment');
		
		const comments = [
			"Very Poor",
			"Poor",
			"Average",
			"Good",
			"Excellent"
		];
		
		starContainer.addEventListener('click', function(e) {
			const rect = starContainer.getBoundingClientRect();
			const pos = (e.clientX - rect.left) / rect.width;
			const rating = Math.min(5, Math.max(1, Math.ceil(pos * 5)));
			
			ratingInput.value = rating;
			starContainer.querySelector('span').style.width = (rating / 5) * 100 + 'px';
			starComment.textContent = comments[rating - 1];
		});
		
		// Sort reviews when dropdown changes
		document.getElementById('review-sort').addEventListener('change', function() {
			// You can implement AJAX sorting here if needed
		});
	});

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

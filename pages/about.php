<?php
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
    <link href="./https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <!-- Google Fonts for Banners only -->
    <link href="./https://fonts.googleapis.com/css?family=Raleway:400,800" rel="stylesheet">
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
                <h2>About</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="../index.html">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="./about.php">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- About-Page -->
    <div class="page-about u-s-p-t-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="about-me-info u-s-m-b-30">
                        <h1>Welcome to
                            <span style="color: #00537B;">ZIG CUSTOMIZED</span>
                        </h1>
                        <p> ZIG Customized is a leading fashion brand that specializes in bespoke clothing. 
                            Our designs seamlessly blend elegance, sophistication, and superior craftsmanship to create unique 
                            and high-quality pieces. 
                            
                        </p>
                        <P>Rooted in the rich cultural heritage of the 16 tribes of Liberia, we celebrate 
                            diversity and tradition through our unique designs. We pride ourselves on innovation, authenticity, 
                            and delivering high-quality fashion pieces tailored to individual customer preferences. Our goal is to 
                            provide a distinguished and personalized shopping experience for our customers worldwide. 
                        </P>

                        <H3> SERVICES</H3>
                        <ol>
                            <li>Retail & Sales</li>
                            <span><ul><li>Selling apparel and accessories (T-shirts, hoodies, tote bags, etc.)</li></ul></span>
                            <br/>
                            <li>Custom Printing Services</li>
                            <span><ul><li>Heat transfer vinyl (HTV) printing.</li></ul></span>
                            <br/>
                            <li>Bulk Orders & Wholesale</li>
                            <span><ul><li>Custom bulk printing for businesses, events, or brands.</li></ul></span>
                            <span><ul><li>Wholesale pricing for large orders.</li></ul></span>
                            <br/>
                            <li>Branding & Merchandise Solutions</li>
                            <span><ul><li>Printing for businesses, schools, teams, and events</li></ul></span>
                            <span><ul><li>Custom-branded merchandise for influencers or brands</li></ul></span>
                        </ol>


                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="about-me-image u-s-m-b-30">
                        <div class="banner-hover effect-border-scaling-gray">
                            <img class="img-fluid" src="../assets/images/about/About-banner.jpg" alt="About Picture">
                        </div>
                    </div>
                    <div class="about-social text-center u-s-m-b-30">
                        <ul class="social-media-list">
                            <!-- <li>
                                <a href="#">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-tiktok"></i>
                                </a>
                            </li> -->
                            <!-- <li>
                                <a href="#">
                                    <i class="fas fa-rss"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-pinterest"></i>
                                </a>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About-Page /- -->
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

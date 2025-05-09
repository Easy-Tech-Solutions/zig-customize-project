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
     
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Login or Create Account</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="../index.php">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="./account.php">Account</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Account-Page -->
    <div class="page-account u-s-p-t-80">
        <div class="container">
            <div class="row">
                <!-- Login -->
                <div class="col-lg-6">
                    <div class="login-wrapper">
                        <h2 class="account-h2 u-s-m-b-20">Login</h2>
                        <h6 class="account-h6 u-s-m-b-30">Welcome back! Sign in to your account.</h6>
                        <form action = "../user/user_login.php" method="post">
                            <div class="u-s-m-b-30">
                                <label for="user-name-email">Username or Email
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" name="Username" id="user-name-email" class="text-field" placeholder="Username / Email" required>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="login-password">Password
                                    <span class="astk">*</span>
                                </label>
                                <input type="password" name="Password" id="login-password" class="text-field" placeholder="Password" required>
                                <input type="checkbox" id="showPassword"> Show Password<br><br>
                            </div>
                            <div class="group-inline u-s-m-b-30">
                                <div class="group-1">
                                    <input type="checkbox" class="check-box" id="remember-me-token">
                                    <label class="label-text" for="remember-me-token">Remember me</label>
                                </div>
                                <div class="group-2 text-right">
                                    <div class="page-anchor">
                                        <a href="./lost-password.php">
                                            <i class="fas fa-circle-o-notch u-s-m-r-9"></i>Lost your password?</a>
                                    </div>
                                </div>
                            </div>
                            <div class="m-b-45">
                                <button type="submit" name="userlog" value="userlog" class="button button-outline-secondary w-100">Login</button>
                            </div>
                            <div class="group-inline u-s-m-b-30 pt-5 mt-5">
                                <div class="group-1">
                                    <input type="checkbox" class="check-box" id="remember-me-token">
                                    <label class="label-text" for="remember-me-token">Administrator?</label>
                                </div>
                                <div class="group-2 text-right">
                                    <div class="page-anchor">
                                        <a href="../admin/admin_login.php">
                                            <i class="fas fa-circle-o-notch u-s-m-r-9"></i>Log in as Admin</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Login /- -->
                <!-- Register -->
                <div class="col-lg-6">
                    <div class="reg-wrapper">
                        <h2 class="account-h2 u-s-m-b-20">Register</h2>
                        <h6 class="account-h6 u-s-m-b-30">Registering for this site allows you to access your order status and history.</h6>
                        <form action = "../user/user_registration.php" class="form" method="post">
                            <div class="u-s-m-b-30">
                                <label for="fullname">Full Name
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" name="Fullname" id="fullname" class="text-field" placeholder="Fullname" required>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="user-name">Username
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" name="Username" id="user-name" class="text-field" placeholder="Username" required>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="email">Email
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" name="Email" id="email" class="text-field" placeholder="Email" required>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="phone">Phone Number
                                    <span class="astk">*</span>
                                </label>
                                <input type="tel" name="Phone" id="phone" class="text-field" placeholder="Phone" required>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="password">Password
                                    <span class="astk">*</span>
                                </label>
                                <input type="password" name="Password" id="password" class="text-field" placeholder="Password" required>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="password">Confirm Password
                                    <span class="astk">*</span>
                                    <span id="password_error" style="color: red;"></span>
                                </label>
                                <input type="password" name="ConfirmPassword" id="confirm_password" class="text-field" placeholder="Confirm Password" required>
                            </div>
                            <div class="u-s-m-b-30">
                                <span id="password_error" style="color: red;"></span>
                            </div>
                            <div class="u-s-m-b-30">
                                <input type="checkbox" class="check-box" id="accept" name="accept" required>
                                <label class="label-text no-color" for="accept">I’ve read and accept the
                                    <a href="./terms-and-conditions.php" class="u-c-brand">terms & conditions</a>
                                </label>
                            </div>
                            <div class="u-s-m-b-45">
                                <button type="submit" name="userreg" value="userlog" class="button button-primary w-100" id="registerbtn">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Register /- -->
            </div>
        </div>
    </div>
    <!-- Account-Page /- -->
    <!-- Footer -->
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
<!--Registration -->
<script type="text/javascript" src="../assets/js/registration.js"></script>
</body>
</html>

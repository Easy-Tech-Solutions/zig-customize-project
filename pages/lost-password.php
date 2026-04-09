<?php
require_once(__DIR__ . '/../sql_connection/config.php');

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset_email'])) {
    $email = trim($_POST['email'] ?? '');
    
    if (empty($email)) {
        $message = "Please enter your email address";
        $messageType = "error";
    } else {
        // Check if email exists
        $stmt = $pdo->prepare("SELECT ID FROM user WHERE customer_mail = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            // TODO: Implement actual password reset email functionality
            // For now, just show a success message
            $message = "If an account exists with this email, a password reset link will be sent to it shortly.";
            $messageType = "success";
        } else {
            // Security: Don't reveal if email exists
            $message = "If an account exists with this email, a password reset link will be sent to it shortly.";
            $messageType = "success";
        }
    }
}
?>

<!DOCTYPE html>
<html class="no-js" lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Reset Password - ZIG CUSTOMIZED</title>
    <link href="../assets/images/favicon/favicon.ico" rel="shortcut icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,800" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="../assets/css/ionicons.min.css">
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <link rel="stylesheet" href="../assets/css/bundle.css">
    <style>
        .reset-wrapper {
            max-width: 500px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .message {
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .message.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .message.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>

<body>
<div id="app">
    <?php include("../include/header.php"); ?>
    
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Reset Password</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="../index.php">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="lost-password.php">Reset Password</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="page-account u-s-p-t-80">
        <div class="container pb-5 mb-5">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="reset-wrapper">
                        <h2 class="account-h2 u-s-m-b-20">Password Reset</h2>
                        <h6 class="account-h6 u-s-m-b-30">Enter your email address to receive a password reset link.</h6>
                        
                        <?php if ($message): ?>
                            <div class="message <?php echo $messageType; ?>">
                                <?php echo htmlspecialchars($message); ?>
                            </div>
                        <?php endif; ?>
                        
                        <form method="POST" action="">
                            <div class="u-s-m-b-30">
                                <label for="email">Email Address <span class="astk">*</span></label>
                                <input type="email" id="email" name="email" class="text-field" placeholder="Enter your email address" required>
                            </div>
                            
                            <div class="u-s-m-b-30">
                                <button type="submit" name="reset_email" value="1" class="button button-outline-secondary w-100">Send Reset Link</button>
                            </div>
                            
                            <div class="text-center">
                                <a href="login.php" class="u-c-brand">Back to Login</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>
    </div>

    <?php include("../include/footer.php"); ?>
</div>
</body>
</html>
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Lost Password</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="../index.html">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="./lost-password.php">Lost Password</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Lost-password-Page -->
    <div class="page-lost-password u-s-p-t-80">
        <div class="container">
            <div class="page-lostpassword">
                <h2 class="account-h2 u-s-m-b-20">Forgot Password ?</h2>
                <h6 class="account-h6 u-s-m-b-30">Enter your email or username below and we will send you a link to reset your password.</h6>
                <form>
                    <div class="w-50">
                        <div class="u-s-m-b-13">
                            <label for="user-name-email">Username or Email
                                <span class="astk">*</span>
                            </label>
                            <input type="text" id="user-name-email" class="text-field" placeholder="Username / Email">
                        </div>
                        <div class="group-2 text-right">
                            <div class="page-anchor">
                                <a href="./lost-username.php">
                                    <i class="fas fa-circle-o-notch u-s-m-r-9"></i>Forgot Username?
                                </a>
                            </div>
                        </div>
                        <div class="u-s-m-b-13">
                            <button class="button button-outline-secondary">Get Reset Link</button>
                        </div>
                    </div>
                    <div class="page-anchor">
                        <a href="./account.html">
                            <i class="fas fa-long-arrow-alt-left u-s-m-r-9"></i>Back to Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Lost-Password-Page /- -->
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

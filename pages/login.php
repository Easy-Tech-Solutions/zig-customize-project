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
    <title>ZIG CUSTOMIZED - Admin Login</title>
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
    <style>
        .error-message {
            color: #dc3545;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }
        .success-message {
            color: #28a745;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>

<body>

<!-- app -->
<div id="app">
     
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Login as Administrator</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="../index.php">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="./admin_login.php">Admin Account</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Account-Page -->
    <div class="page-account u-s-p-t-80">
        <div class="container pb-5 mb-5">
            <div class="row">
                <!-- Login -->
                <div class="col-lg-4"></div>

                <div class="col-lg-4">
                    <div class="login-wrapper">
                        <h2 class="account-h2 u-s-m-b-20">Login</h2>
                        <h6 class="account-h6 u-s-m-b-30">Welcome back! Sign in to your account.</h6>
                        
                        <?php
                        include('../sql_connection/config.php');
                        
                        // Display registration success message if exists
                        if (isset($_SESSION['registration_success'])) {
                            echo '<div class="success-message">Registration successful! Please log in.</div>';
                            unset($_SESSION['registration_success']);
                        }
                        
                        // Handle login form submission
                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userlog'])) {
                            $username = trim($_POST['Username']);
                            $password = trim($_POST['Password']);
                            
                            try {
                                // Prepare SQL to get user with role information
                                $sql = "SELECT u.*, r.role_name 
                                        FROM users u 
                                        JOIN roles r ON u.role_id = r.role_id 
                                        WHERE username = ? OR email = ?";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute([$username, $username]);
                                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                        
                                // Verify user exists and password is correct
                                if ($user && password_verify($password, $user['password'])) {
                                    // Regenerate session ID to prevent session fixation
                                    session_regenerate_id(true);
                                    
                                    // Set session variables
                                    $_SESSION['user_id'] = $user['user_id'];
                                    $_SESSION['username'] = $user['username'];
                                    $_SESSION['email'] = $user['email'];
                                    $_SESSION['role'] = $user['role_name'];
                                    $_SESSION['first_name'] = $user['first_name'];
                                    $_SESSION['last_name'] = $user['last_name'];
                                    $_SESSION['profile_image'] = $user['profile_image'];
                                    
                                    // Update last login time
                                    $updateSql = "UPDATE users SET last_login = NOW() WHERE user_id = ?";
                                    $updateStmt = $pdo->prepare($updateSql);
                                    $updateStmt->execute([$user['user_id']]);
                                    
                                    // Redirect based on role
                                    if ($user['role_name'] === 'Client') {
                                        header("Location:  /public_html/index.php");
                                    } else {
                                        header("Location:  /public_html/admin/dashboard/dashboard.php");
                                    }
                                    exit();
                                } else {
                                    $error = "Invalid username or password";
                                }
                            } catch (PDOException $e) {
                                error_log("Login error: " . $e->getMessage());
                                $error = "A database error occurred. Please try again.";
                            }
                        }
                        ?>
                        
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
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
                                    <input type="checkbox" class="check-box" id="remember-me-token" name="remember_me">
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

                            <div class="group-inline u-s-m-b-30">
                                <div class="group-1">
                                    <input type="checkbox" class="check-box" id="remember-me-token" name="remember_me">
                                    <label class="label-text" for="remember-me-token">Don't have account?</label>
                                </div>
                                <div class="group-2 text-right">
                                    <div class="page-anchor">
                                        <a href="./registration.php">
                                            <i class="fas fa-circle-o-notch u-s-m-r-9"></i>Signup</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4"></div>
                <!-- Login /- -->
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
<!-- Modernizr-JS -->
<script type="text/javascript" src="../assets/js/vendor/modernizr-custom.min.js"></script>
<!-- jQuery -->
<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // Show/hide password functionality
    $('#showPassword').change(function() {
        var passwordField = $('#login-password');
        if(this.checked) {
            passwordField.attr('type', 'text');
        } else {
            passwordField.attr('type', 'password');
        }
    });
    
    // Remember me functionality (requires cookies)
    if(localStorage.getItem("remember_me") === "true" && localStorage.getItem("username")) {
        $('#remember-me-token').prop('checked', true);
        $('#user-name-email').val(localStorage.getItem("username"));
    }
    
    $('form').submit(function() {
        if($('#remember-me-token').is(':checked')) {
            localStorage.setItem("remember_me", "true");
            localStorage.setItem("username", $('#user-name-email').val());
        } else {
            localStorage.removeItem("remember_me");
            localStorage.removeItem("username");
        }
    });
});
</script>
</body>
</html>
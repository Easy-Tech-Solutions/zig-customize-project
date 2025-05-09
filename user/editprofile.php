<?php
session_start();
include("../sql_connection/config.php");
if (!isset($_SESSION['login_user'])) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI']; // Store the current page URL
    header("Location: /pages/account.php"); // Redirect to login page
    exit();
}
?>


<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <meta charset="utf-8">
    <title>Zig Customized User Dashboard</title>
    <meta name="keywords" content="HTML, CSS, JavaScript, Bootstrap">
    <meta name="description" content="Real Estate HTML Template">

    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

   <!-- font -->
   <link rel="stylesheet" href="../assets/fonts/fonts.css">
   <!-- Icons -->
   <link rel="stylesheet" href="../assets/fonts/font-icons.css">
   <link rel="stylesheet" href="../assets/other/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="../assets/other/jqueryui.min.css"/>

   <link rel="stylesheet" type="text/css" href="../assets/other/styles.css"/>

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="../assets/images/other/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/images/other/favicon.png">

</head>

<body class="body bg-surface">

    <!-- RTL -->
   <!-- <a href="./javascript:void(0);" id="toggle-rtl" class="tf-btn primary">RTL</a> -->
   <!-- /RTL  --> 

    <!-- preload -->
    <div class="preload preload-container">
        <div class="preload-logo">
            <div class="spinner"></div>
            <span class="icon icon-villa-fill"></span>
        </div>
    </div>
    <!-- /preload -->

    <div id="wrapper">
        <div id="page" class="clearfix">
            <div class="layout-wrap">
                <!-- header -->
                <header class="main-header header-dashboard">
                    <!-- Header Lower -->
                    <div class="header-lower">
                        <div class="row">                      
                            <div class="col-lg-12">         
                                <div class="inner-header">
                                    <div class="inner-header-left">
                                        <div class="logo-box d-flex">
                                            <div class="logo"><a href="../index.html"><img src="../assets/images/other/logo@2x.png" alt="logo" width="174" height="44"></a></div>
                                            <div class="button-show-hide">
                                                <span class="icon icon-categories"></span>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    
                                    <div class="mobile-nav-toggler mobile-button"><span></span></div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Header Lower -->
                
                    <!-- Mobile Menu  -->
                    <div class="close-btn"><span class="icon flaticon-cancel-1"></span></div>    
                    <div class="mobile-menu">
                        <div class="menu-backdrop"></div>                            
                        <nav class="menu-box">
                            <div class="nav-logo"><a href="../index.html"><img src="../assets/images/other/logo@2x.png" alt="nav-logo" width="174" height="44"></a></div>
                            <div class="bottom-canvas">
                                <ul class="navigation clearfix">
                                    <li class="home"><a href="#">Dashboard</a>
                                    </li>
                                    <li><a href="#">Profile</a>
                                    </li>
                                    <li><a href="#">Preview</a>
                                    </li>
                                    <li><a href="#">My Properties</a>
                                    </li>
                                    <li><a href="#">My Favorite</a>
                                    </li>
                                    <li><a href="#">Message</a>
                                    </li>
                                    <li><a href="#">Add Property</a>
                                    </li>
                                     <li><a href="./logout.php">Logout</a>
                                    </li>
                        
                                </ul>
                            </div>
                        </nav>                
                    </div>
                    <!-- End Mobile Menu -->
                
                </header>
                <!-- end header -->
                <!-- sidebar dashboard -->
                <?php include("../include/sidebar.php"); ?>
                <!-- end sidebar dashboard -->

                <div class="main-content">
                    <div class="main-content-inner wrap-dashboard-content-2">
                        <div class="button-show-hide show-mb">
                            <span class="body-1">Show Dashboard</span>
                        </div>
                        <div class="widget-box-2">
                            <div class="box">
                                <h5 class="title">Avatar</h5>
                                <div class="box-agent-avt">
                                    <div class="avatar">
                                        <img src="../assets/images/other/account.jpg" alt="avatar" loading="lazy" width="128" height="128">
                                    </div>
                                    <div class="content uploadfile">
                                        <p>Upload a new avatar</p>
                                        <div class="box-ip">
                                            <input type="file" class="ip-file">
                                        </div>
                                        <p>JPEG 100x100</p>
                                    </div>
                                </div>
                            </div>
                            
                            <h5 class="title">Information</h5>
                            <div class="box box-fieldset">
                                <label>Full name:<span>*</span></label>
                                <input type="text" value="Demo Agent" class="form-control style-1">
                            </div>
                            <div class="box box-fieldset">
                                <label>Description:<span>*</span></label>
                                <textarea>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</textarea>
                            </div>
                            <div class="box grid-4 gap-30">
                                <div class="box-fieldset">
                                    <label>Your Company:<span>*</span></label>
                                    <input type="text" value="Your Company" class="form-control style-1">
                                </div>
                                <div class="box-fieldset">
                                    <label>Position:<span>*</span></label>
                                    <input type="text" value="Your Company" class="form-control style-1">
                                </div>
                                <div class="box-fieldset">
                                    <label>Office Number:<span>*</span></label>
                                    <input type="number" value="1332565894" class="form-control style-1">
                                </div>
                                <div class="box-fieldset">
                                    <label>Office Address:<span>*</span></label>
                                    <input type="text" value="10 Bringhurst St, Houston, TX" class="form-control style-1">
                                </div>
                            </div>
                            <div class="box grid-4 gap-30 box-info-2">
                                <div class="box-fieldset">
                                    <label>Job:<span>*</span></label>
                                    <input type="text" value="Realter" class="form-control style-1">
                                </div>
                                <div class="box-fieldset">
                                    <label>Email address:<span>*</span></label>
                                    <input type="text" value="themeflat@gmail.com" class="form-control style-1">
                                </div>
                                <div class="box-fieldset">
                                    <label>Your Phone:<span>*</span></label>
                                    <input type="number" value="1332565894" class="form-control style-1">
                                </div>
                            </div>
                            <div class="box box-fieldset">
                                <label>Location:<span>*</span></label>
                                <input type="text" value="634 E 236th St, Bronx, NY 10466" class="form-control style-1">
                            </div>
                            <div class="box box-fieldset">
                                <label>Facebook:<span>*</span></label>
                                <input type="text" value="#" class="form-control style-1">
                            </div>
                            <div class="box box-fieldset">
                                <label>Twitter:<span>*</span></label>
                                <input type="text" value="#" class="form-control style-1">
                            </div>
                            <div class="box box-fieldset">
                                <label>Linkedin:<span>*</span></label>
                                <input type="text" value="#" class="form-control style-1">
                            </div>
                            <div class="box">
                                <a href="#" class="tf-btn primary">Save & Update</a>
                            </div>
                            <h5 class="title">Change password</h5>
                            <div class="box grid-3 gap-30">
                                <div class="box-fieldset">
                                    <label>Old Password:<span>*</span></label>
                                    <div class="box-password">
                                        <input type="password" class="form-contact style-1 password-field" placeholder="Password">
                                        <span class="show-pass">
                                            <i class="icon-pass icon-eye"></i>
                                            <i class="icon-pass icon-eye-off"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="box-fieldset">
                                    <label>New Password:<span>*</span></label>
                                    <div class="box-password">
                                        <input type="password" class="form-contact style-1 password-field2" placeholder="Password">
                                        <span class="show-pass2">
                                            <i class="icon-pass icon-eye"></i>
                                            <i class="icon-pass icon-eye-off"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="box-fieldset">
                                    <label>Confirm Password:<span>*</span></label>
                                    <div class="box-password">
                                        <input type="password" class="form-contact style-1 password-field3" placeholder="Password">
                                        <span class="show-pass3">
                                            <i class="icon-pass icon-eye"></i>
                                            <i class="icon-pass icon-eye-off"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="box">
                                <a href="#" class="tf-btn primary">Update Password</a>
                            </div>
                        </div>
                    </div>
                    <div class="footer-dashboard">
                        <p>Copyright © 2024 Home Lengo</p>
                    </div>
                </div>

                <div class="overlay-dashboard"></div>

            </div>
        </div>
        <!-- /#page -->

    </div>
    <!-- go top -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 286.138;"></path>
        </svg>
    </div>

    <!-- Javascript -->
    
    <script type="text/javascript" src="../assets/js/other/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/other/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/other/plugin.js"></script>
    <script type="text/javascript" src="../assets/js/other/jqueryui.min.js"></script>
    <script type="text/javascript" src="../assets/js/other/jquery.nice-select.min.js"></script>
    <script type="text/javascript" src="../assets/js/other/shortcodes.js"></script>
    <script type="text/javascript" src="../assets/js/other/main.js"></script>
   
</body>

</html>
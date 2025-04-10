<?php
session_start();
include("../sql_connection/config.php");

// Debugging: Check if session contains user ID
if (!isset($_SESSION['login_user']) || empty($_SESSION['login_user'])) {
    die("Error: Unauthorized to view this resource.");
}

$user_id = $_SESSION['login_user'];

// Debugging: Print session user ID
var_dump($user_id);

// Verify database connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch user details from the database
$stmt = $conn->prepare("SELECT customer_name, username, customer_mail, customer_phone, profile_image FROM user WHERE username = ?");
$stmt->bind_param("s", $user_id);

if (!$stmt->execute()) {
    die("SQL Error: " . $stmt->error);
}

$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $customer_name = htmlspecialchars($user['customer_name']);
    $username = htmlspecialchars($user['username']);
    $customer_email = htmlspecialchars($user['customer_mail']);
    $customer_phone = htmlspecialchars($user['customer_phone']);
    $profile_image = !empty($user['profile_image']) ? "../assets/images/uploads/userprofiles/" . $user['profile_image'] : "../assets/images/other/account.jpg";
} else {
    die("Error: User not found in database. User ID: " . $user_id);
}

$stmt->close();
$conn->close();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Zig Customized User Dashboard</title>
    <meta name="keywords" content="HTML, CSS, JavaScript, Bootstrap">
    <meta name="description" content="Real Estate HTML Template">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Font & Icons -->
    <link rel="stylesheet" href="../assets/fonts/fonts.css">
    <link rel="stylesheet" href="../assets/fonts/font-icons.css">
    <link rel="stylesheet" href="../assets/other/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/other/jqueryui.min.css"/>
    <link rel="stylesheet" type="text/css" href="../assets/other/styles.css"/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/images/other/favicon.png">
</head>

<body class="body bg-surface">
    <div id="wrapper">
        <div id="page" class="clearfix">
            <div class="layout-wrap">
                <!-- Header -->
                <header class="main-header header-dashboard">
                    <div class="header-lower">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="inner-header">
                                    <div class="inner-header-left">
                                        <div class="logo-box d-flex">
                                            <div class="logo">
                                                <a href="../index.html">
                                                    <img src="../assets/images/other/logo@2x.png" alt="logo" width="174" height="44">
                                                </a>
                                            </div>
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
                </header>
                <!-- End Header -->

                <!-- Sidebar -->
                <?php include("../include/sidebar.php"); ?>
                <!-- End Sidebar -->

                <div class="main-content">
                    <div class="main-content-inner wrap-dashboard-content-2">
                        <div class="widget-box-2">
                            <div class="box">
                                <h5 class="title"><?php echo $customer_name; ?></h5>
                                <div class="box-agent-avt">
                                    <div class="avatar">
                                        <img src="<?php echo $profile_image; ?>" alt="avatar" loading="lazy" width="128" height="128">
                                    </div>
                                    <div class="content uploadfile">
                                        <p>Upload a new photo</p>
                                        <div class="box-ip">
                                            <input type="file" class="ip-file">
                                        </div>
                                        <p>JPEG 100x100</p>
                                    </div>
                                </div>
                                <div>
                                    <p><strong>Username:</strong> <?php echo $username; ?></p>
                                    <p><strong>Email:</strong> <?php echo $customer_email; ?></p>
                                    <p><strong>Phone:</strong> <?php echo $customer_phone; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overlay-dashboard"></div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script type="text/javascript" src="../assets/js/other/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/other/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/other/plugin.js"></script>
    <script type="text/javascript" src="../assets/js/other/jqueryui.min.js"></script>
    <script type="text/javascript" src="../assets/js/other/jquery.nice-select.min.js"></script>
    <script type="text/javascript" src="../assets/js/other/shortcodes.js"></script>
    <script type="text/javascript" src="../assets/js/other/main.js"></script>
</body>

</html>

<?php
session_start();
require_once('../sql_connection/config.php');

// Require logged-in user by either new or old session key.
if (!isset($_SESSION['user_id']) && !isset($_SESSION['login_user'])) {
    header('Location: /pages/login.php');
    exit();
}

$userId = $_SESSION['user_id'] ?? null;
$username = $_SESSION['login_user'] ?? $_SESSION['username'] ?? null;

if (!$userId && !$username) {
    die('Error: Unauthorized to view this resource.');
}

// Fetch user details from the database
if ($userId) {
    $stmt = $pdo->prepare('SELECT first_name, username, email, phone, role_id FROM users WHERE user_id = ?');
    $stmt->execute([$userId]);
} else {
    $stmt = $pdo->prepare('SELECT first_name, username, email, phone, role_id FROM users WHERE username = ?');
    $stmt->execute([$username]);
}

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die('Error: User not found in database.');
}

$customer_name = htmlspecialchars($user['first_name'] ?: $user['username']);
$display_username = htmlspecialchars($user['username']);
$customer_email = htmlspecialchars($user['email'] ?: '');
$customer_phone = htmlspecialchars($user['phone'] ?: '');
$roleLabel = $user['role_id'] == 1 ? 'Admin' : 'Customer';
$profile_image = '../assets/images/other/account.jpg';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Zig Customized User Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="../assets/other/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/other/styles.css" />
</head>
<body class="body bg-surface">
    <div id="wrapper"><div id="page" class="clearfix"><div class="layout-wrap">
        <header class="main-header header-dashboard">
            <div class="header-lower"><div class="row"><div class="col-lg-12">
                <div class="inner-header"><div class="inner-header-left">
                    <div class="logo-box d-flex"><div class="logo"><a href="../index.php"><img src="../assets/images/other/logo@2x.png" alt="logo" width="174" height="44"></a></div></div>
                </div></div>
            </div></div></div></div>
        </header>

        <?php include('../include/sidebar.php'); ?>

        <div class="main-content"><div class="main-content-inner wrap-dashboard-content-2">
            <div class="widget-box-2"><div class="box">
                <h5 class="title"><?php echo $customer_name; ?></h5>
                <div class="box-agent-avt"><div class="avatar"><img src="<?php echo $profile_image; ?>" alt="avatar" width="128" height="128" /></div></div>
                <div style="margin-top: 20px;">
                    <p><strong>Username:</strong> <?php echo $display_username; ?></p>
                    <p><strong>Email:</strong> <?php echo $customer_email; ?></p>
                    <p><strong>Phone:</strong> <?php echo $customer_phone; ?></p>
                    <p><strong>Role:</strong> <?php echo $roleLabel; ?></p>
                </div>
                <a href="editprofile.php" class="btn btn-primary">Edit Profile</a>
            </div></div>
        </div>

        <div class="overlay-dashboard"></div>
    </div></div></div></div>

    <script src="../assets/js/other/jquery.min.js"></script>
    <script src="../assets/js/other/bootstrap.min.js"></script>
</body>
</html>

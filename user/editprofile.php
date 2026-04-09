<?php
session_start();
require_once('../sql_connection/config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: /pages/login.php');
    exit();
}

$userId = $_SESSION['user_id'];
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = trim($_POST['first_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirmPassword = trim($_POST['confirm_password'] ?? '');

    if (empty($firstName) || empty($email)) {
        $error = 'Name and email are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email address.';
    } elseif (!empty($password) && $password !== $confirmPassword) {
        $error = 'Passwords do not match.';
    } else {
        try {
            if (!empty($password)) {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare('UPDATE users SET first_name = ?, email = ?, phone = ?, password = ?, updated_at = NOW() WHERE user_id = ?');
                $stmt->execute([$firstName, $email, $phone, $passwordHash, $userId]);
            } else {
                $stmt = $pdo->prepare('UPDATE users SET first_name = ?, email = ?, phone = ?, updated_at = NOW() WHERE user_id = ?');
                $stmt->execute([$firstName, $email, $phone, $userId]);
            }
            $message = 'Profile updated successfully.';
            $_SESSION['username'] = $firstName;
            $_SESSION['email'] = $email;
        } catch (PDOException $ex) {
            $error = 'Error saving profile: ' . $ex->getMessage();
        }
    }
}

$stmt = $pdo->prepare('SELECT first_name, username, email, phone FROM users WHERE user_id = ?');
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die('User not found.');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Edit Profile</title>
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
                <h5 class="title">Edit Profile</h5>
                <?php if ($message): ?>
                    <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
                <?php endif; ?>
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label>Full Name</label>
                        <input type="text" name="first_name" class="form-control" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($user['phone']); ?>">
                    </div>
                    <div class="mb-3">
                        <label>New Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Leave empty to keep current">
                    </div>
                    <div class="mb-3">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" placeholder="Repeat new password">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="viewprofile.php" class="btn btn-secondary">View Profile</a>
                </form>
            </div></div>
        </div>
        <div class="overlay-dashboard"></div>
    </div></div></div></div>
    <script src="../assets/js/other/jquery.min.js"></script>
    <script src="../assets/js/other/bootstrap.min.js"></script>
</body>
</html>

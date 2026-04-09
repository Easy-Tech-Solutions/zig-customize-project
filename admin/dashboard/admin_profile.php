<?php
require_once('../../sql_connection/config.php');
requireRole('Admin');

$adminId = $_SESSION['user_id'] ?? null;
if (!$adminId) {
    header('Location: /pages/login.php');
    exit();
}

$stmt = $pdo->prepare('SELECT user_id, first_name, username, email, phone, role_id, created_at, updated_at FROM users WHERE user_id = ?');
$stmt->execute([$adminId]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$admin) {
    header('Location: manage_users.php?error=Admin+profile+not+found');
    exit();
}

$profileImage = '../assets/images/profile/profile-image.png';
if (!empty($admin['profile_image'])) {
    $profileImage = '../../Uploads/Profiles/' . htmlspecialchars($admin['profile_image']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Profile - Admin Panel</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
</head>
<body>
    <?php include("../include/sidebarnav.php"); ?>
    <main class="main-wrapper">
        <?php include("../include/header.php"); ?>

        <section class="section">
            <div class="container-fluid">
                <div class="title-wrapper pt-30">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2>My Profile</h2>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="admin_editprofile.php" class="btn btn-primary">Edit Profile</a>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <div class="profile-image-section">
                                    <img src="<?php echo $profileImage; ?>" alt="Profile" class="img-fluid rounded" style="max-width: 200px; margin-bottom: 15px;">
                                    <br>
                                    <a href="admin_editprofile.php" class="btn btn-sm btn-secondary">Change Photo</a>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <p><strong>Full Name:</strong> <?php echo htmlspecialchars($admin['first_name']); ?></p>
                                <p><strong>Username:</strong> <?php echo htmlspecialchars($admin['username']); ?></p>
                                <p><strong>Email:</strong> <?php echo htmlspecialchars($admin['email']); ?></p>
                                <p><strong>Phone:</strong> <?php echo htmlspecialchars($admin['phone'] ?? 'N/A'); ?></p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <p><strong>Role:</strong> <?php echo $admin['role_id'] == 1 ? 'Admin' : 'Customer'; ?></p>
                            </div>
                            <div class="col-md-3">
                                <p><strong>Created At:</strong> <?php echo date('M d, Y', strtotime($admin['created_at'])); ?></p>
                            </div>
                            <div class="col-md-3">
                                <p><strong>Updated At:</strong> <?php echo date('M d, Y', strtotime($admin['updated_at'])); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

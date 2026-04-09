<?php
require_once('../../sql_connection/config.php');
requireRole('Admin');

$adminId = $_SESSION['user_id'] ?? null;
if (!$adminId) {
    header('Location: /pages/login.php');
    exit();
}

$message = '';
$error = '';

// Load existing admin record
$stmt = $pdo->prepare('SELECT user_id, first_name, username, email, phone, profile_image FROM users WHERE user_id = ?');
$stmt->execute([$adminId]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$admin) {
    header('Location: admin_profile.php?error=Admin+not+found');
    exit();
}

$profileImage = '../assets/images/profile/profile-image.png';
if (!empty($admin['profile_image'])) {
    $profileImage = '../../Uploads/Profiles/' . htmlspecialchars($admin['profile_image']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $new_password = trim($_POST['password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');
    $uploadedImage = null;

    // Handle file upload
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
        $fileTmp = $_FILES['profile_photo']['tmp_name'];
        $fileName = $_FILES['profile_photo']['name'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        if (in_array($fileExt, ['jpg', 'jpeg', 'png', 'gif'])) {
            $uploadDir = '../../Uploads/Profiles/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $newFileName = 'admin_' . $adminId . '_' . time() . '.' . $fileExt;
            if (move_uploaded_file($fileTmp, $uploadDir . $newFileName)) {
                $uploadedImage = $newFileName;
            } else {
                $error = 'Failed to upload image.';
            }
        } else {
            $error = 'Invalid image format. Only JPG, JPEG, PNG, GIF allowed.';
        }
    }

    if (!$error) {
        if ($first_name === '' || $email === '') {
            $error = 'Name and email are required.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Invalid email address.';
        } elseif ($new_password !== '' && $new_password !== $confirm_password) {
            $error = 'Passwords do not match.';
        } else {
            try {
                if ($new_password !== '') {
                    $passwordHash = password_hash($new_password, PASSWORD_DEFAULT);
                    if ($uploadedImage) {
                        $updateStmt = $pdo->prepare('UPDATE users SET first_name = ?, email = ?, phone = ?, password = ?, profile_image = ?, updated_at = NOW() WHERE user_id = ?');
                        $updateStmt->execute([$first_name, $email, $phone, $passwordHash, $uploadedImage, $adminId]);
                    } else {
                        $updateStmt = $pdo->prepare('UPDATE users SET first_name = ?, email = ?, phone = ?, password = ?, updated_at = NOW() WHERE user_id = ?');
                        $updateStmt->execute([$first_name, $email, $phone, $passwordHash, $adminId]);
                    }
                } else {
                    if ($uploadedImage) {
                        $updateStmt = $pdo->prepare('UPDATE users SET first_name = ?, email = ?, phone = ?, profile_image = ?, updated_at = NOW() WHERE user_id = ?');
                        $updateStmt->execute([$first_name, $email, $phone, $uploadedImage, $adminId]);
                    } else {
                        $updateStmt = $pdo->prepare('UPDATE users SET first_name = ?, email = ?, phone = ?, updated_at = NOW() WHERE user_id = ?');
                        $updateStmt->execute([$first_name, $email, $phone, $adminId]);
                    }
                }

                // Store success flag to be used by JavaScript on redirect
                $successMsg = 'Profile updated successfully! Redirecting...';
                // We'll use JavaScript to set sessionStorage and redirect
                echo '<script>
                    sessionStorage.setItem("adminProfileUpdated", "true");
                    window.location.href = "admin_profile.php?success=1";
                </script>';
                exit();
            } catch (PDOException $ex) {
                $error = 'Error updating profile: ' . $ex->getMessage();
            }
        }
    }

    // reload admin data on form error
    $stmt = $pdo->prepare('SELECT user_id, first_name, username, email, phone, profile_image FROM users WHERE user_id = ?');
    $stmt->execute([$adminId]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Admin Profile - Admin Panel</title>
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
                    <h2>Edit Admin Profile</h2>
                </div>

                <?php if ($message): ?>
                    <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
                <?php endif; ?>
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <div class="card mt-3">
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <p><strong>Profile Photo</strong></p>
                                    <img id="profilePreview" src="<?php echo $profileImage; ?>" alt="Profile" class="img-fluid rounded" style="max-width: 150px; margin-bottom: 15px;">
                                    <br>
                                    <div class="mb-3">
                                        <label for="profile_photo" class="form-label">Upload Photo</label>
                                        <input type="file" name="profile_photo" id="profile_photo" class="form-control" accept="image/*">
                                        <small class="text-muted">JPG, PNG, GIF (max 5MB)</small>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" name="first_name" class="form-control" value="<?php echo htmlspecialchars($admin['first_name']); ?>" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($admin['email']); ?>" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Phone</label>
                                            <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($admin['phone']); ?>">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Username</label>
                                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($admin['username']); ?>" disabled>
                                            <small class="text-muted">Cannot be changed</small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">New Password</label>
                                            <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Confirm Password</label>
                                            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm new password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                <a href="admin_profile.php" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script>
        // Preview image before upload
        document.getElementById('profile_photo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('profilePreview').src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>

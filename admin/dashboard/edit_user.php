<?php
require_once('../../sql_connection/config.php');
requireRole('Admin');

$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$message = '';

if ($user_id == 0) {
    header("Location: manage_users.php");
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$user) {
        header("Location: manage_users.php?error=User+not+found");
        exit();
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $first_name = trim($_POST['first_name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $role_id = intval($_POST['role_id'] ?? 2);
        
        $update_stmt = $pdo->prepare("
            UPDATE users 
            SET first_name = ?, email = ?, phone = ?, role_id = ?
            WHERE user_id = ?
        ");
        
        if ($update_stmt->execute([$first_name, $email, $phone, $role_id, $user_id])) {
            $message = '<div class="alert alert-success">User updated successfully!</div>';
            // Refresh user data
            $stmt->execute([$user_id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
} catch (Exception $e) {
    $error = "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit User - Admin Panel</title>
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
                    <h2>Edit User</h2>
                </div>
                
                <?php echo $message; ?>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                
                <div class="card">
                    <div class="card-body">
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="first_name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" 
                                           value="<?php echo htmlspecialchars($user['first_name'] ?? ''); ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" 
                                           value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="role_id" class="form-label">Role</label>
                                    <select class="form-select" id="role_id" name="role_id">
                                        <option value="1" <?php echo $user['role_id'] == 1 ? 'selected' : ''; ?>>Admin</option>
                                        <option value="2" <?php echo $user['role_id'] == 2 ? 'selected' : ''; ?>>Customer</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['username'] ?? ''); ?>" disabled>
                                    <small class="text-muted">Cannot be changed</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Joined Date</label>
                                    <input type="text" class="form-control" value="<?php echo date('M d, Y', strtotime($user['created_at'])); ?>" disabled>
                                </div>
                            </div>
                            
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                <a href="manage_users.php" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

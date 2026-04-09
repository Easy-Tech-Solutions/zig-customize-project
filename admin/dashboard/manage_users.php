<?php
require_once('../../sql_connection/config.php');
requireRole('Admin');

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$role_filter = isset($_GET['role']) ? $_GET['role'] : '';

try {
    $sql = "SELECT * FROM users WHERE 1=1";
    $params = [];
    
    if (!empty($search)) {
        $sql .= " AND (first_name LIKE ? OR username LIKE ? OR email LIKE ?)";
        $params = ["%$search%", "%$search%", "%$search%"];
    }
    
    if (!empty($role_filter)) {
        $sql .= " AND role_id = ?";
        $params[] = $role_filter;
    }
    
    $sql .= " ORDER BY user_id DESC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $error = "Error fetching users: " . $e->getMessage();
    $users = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Users - Admin Panel</title>
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
                    <h2>Manage Users</h2>
                </div>
                
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <form method="GET" class="d-flex gap-2">
                                    <input type="text" name="search" class="form-control" placeholder="Search by name, username, or email" 
                                           value="<?php echo htmlspecialchars($search); ?>">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    <a href="manage_users.php" class="btn btn-secondary">Clear</a>
                                </form>
                            </div>
                            <div class="col-md-3">
                                <form method="GET" class="d-flex gap-2">
                                    <select name="role" class="form-select" onchange="this.form.submit()">
                                        <option value="">All Roles</option>
                                        <option value="1" <?php echo $role_filter == 1 ? 'selected' : ''; ?>>Admin</option>
                                        <option value="2" <?php echo $role_filter == 2 ? 'selected' : ''; ?>>Customer</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                        
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Joined</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($users)): ?>
                                    <?php foreach ($users as $user): ?>
                                        <tr>
                                            <td><?php echo $user['user_id']; ?></td>
                                            <td><?php echo htmlspecialchars($user['first_name'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                                            <td><?php echo htmlspecialchars($user['phone'] ?? ''); ?></td>
                                            <td>
                                                <span class="badge <?php echo $user['role_id'] == 1 ? 'bg-danger' : 'bg-info'; ?>">
                                                    <?php echo $user['role_id'] == 1 ? 'Admin' : 'Customer'; ?>
                                                </span>
                                            </td>
                                            <td><?php echo date('M d, Y', strtotime($user['created_at'] ?? 'now')); ?></td>
                                            <td>
                                                <a href="edit_user.php?id=<?php echo $user['user_id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                                <a href="delete_user.php?id=<?php echo $user['user_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center">No users found</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

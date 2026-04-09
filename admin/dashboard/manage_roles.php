<?php
require_once('../../sql_connection/config.php');
requireRole('Admin');

$roles = [
    ['id' => 1, 'name' => 'Admin', 'description' => 'Full system access', 'permissions' => 'All permissions'],
    ['id' => 2, 'name' => 'Customer', 'description' => 'Customer account access', 'permissions' => 'Browse products, place orders']
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Roles - Admin Panel</title>
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
                            <h2>Manage Roles</h2>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="add_role.php" class="btn btn-primary">+ Add New Role</a>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Role ID</th>
                                    <th>Role Name</th>
                                    <th>Description</th>
                                    <th>Permissions</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($roles as $role): ?>
                                    <tr>
                                        <td><?php echo $role['id']; ?></td>
                                        <td><strong><?php echo $role['name']; ?></strong></td>
                                        <td><?php echo $role['description']; ?></td>
                                        <td><?php echo $role['permissions']; ?></td>
                                        <td>
                                            <a href="edit_role.php?id=<?php echo $role['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                            <?php if ($role['id'] > 2): ?>
                                                <a href="delete_role.php?id=<?php echo $role['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
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

<?php
require_once('../../sql_connection/config.php');
requireRole('Admin');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Role - Admin Panel</title>
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
                    <h2>Add New Role</h2>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        <p class="text-muted mb-4">Note: System roles (Admin, Customer) cannot be modified. You can only create custom roles.</p>
                        
                        <form method="POST">
                            <div class="mb-3">
                                <label for="role_name" class="form-label">Role Name</label>
                                <input type="text" class="form-control" id="role_name" name="role_name" 
                                       placeholder="e.g., Moderator, Support Staff" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" 
                                          placeholder="Describe what this role is for"></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Permissions</label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="perm_view_orders" name="permissions[]" value="view_orders">
                                    <label class="form-check-label" for="perm_view_orders">View Orders</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="perm_manage_users" name="permissions[]" value="manage_users">
                                    <label class="form-check-label" for="perm_manage_users">Manage Users</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="perm_manage_inventory" name="permissions[]" value="manage_inventory">
                                    <label class="form-check-label" for="perm_manage_inventory">Manage Inventory</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="perm_view_reports" name="permissions[]" value="view_reports">
                                    <label class="form-check-label" for="perm_view_reports">View Reports</label>
                                </div>
                            </div>
                            
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Create Role</button>
                                <a href="manage_roles.php" class="btn btn-secondary">Cancel</a>
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

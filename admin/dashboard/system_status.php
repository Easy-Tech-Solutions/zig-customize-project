<?php
require_once('../../sql_connection/config.php');
requireRole('Admin');

// Check all critical features
$status = [
    'database' => ['status' => 'ok', 'message' => 'Connected'],
    'tables' => [],
    'sample_data' => []
];

$tables = ['users', 'products', 'orders', 'coupons', 'invoices', 'shipments', 'warehouse_inventory'];

try {
    // Check tables
    foreach ($tables as $table) {
        $stmt = $pdo->prepare("SHOW TABLES LIKE ?");
        $stmt->execute([$table]);
        
        if ($stmt->rowCount() > 0) {
            // Count records
            $count_stmt = $pdo->prepare("SELECT COUNT(*) as cnt FROM $table");
            $count_stmt->execute();
            $count = $count_stmt->fetch(PDO::FETCH_ASSOC)['cnt'];
            
            $status['tables'][$table] = [
                'exists' => true,
                'count' => $count,
                'status' => 'ok'
            ];
        } else {
            $status['tables'][$table] = [
                'exists' => false,
                'count' => 0,
                'status' => 'error'
            ];
        }
    }
} catch (Exception $e) {
    $status['database'] = ['status' => 'error', 'message' => $e->getMessage()];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin System Status - Admin Panel</title>
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
                    <h2>System Status & Configuration</h2>
                </div>
                
                <div class="row">
                    <!-- Database Status -->
                    <div class="col-lg-6 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h5>Database Connection</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Status:</span>
                                    <span class="badge bg-success">✓ Connected</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <span>Host:</span>
                                    <span>localhost</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <span>Database:</span>
                                    <span>zigdb</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="col-lg-6 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h5>Quick Statistics</h5>
                            </div>
                            <div class="card-body">
                                <?php
                                try {
                                    $users_stmt = $pdo->prepare("SELECT COUNT(*) as cnt FROM users");
                                    $users_stmt->execute();
                                    $user_count = $users_stmt->fetch()['cnt'];
                                    
                                    $orders_stmt = $pdo->prepare("SELECT COUNT(*) as cnt FROM orders");
                                    $orders_stmt->execute();
                                    $order_count = $orders_stmt->fetch()['cnt'];
                                    
                                    $products_stmt = $pdo->prepare("SELECT COUNT(*) as cnt FROM products");
                                    $products_stmt->execute();
                                    $product_count = $products_stmt->fetch()['cnt'];
                                ?>
                                    <div class="d-flex justify-content-between mt-2">
                                        <span>Total Users:</span>
                                        <strong><?php echo $user_count; ?></strong>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <span>Total Orders:</span>
                                        <strong><?php echo $order_count; ?></strong>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <span>Total Products:</span>
                                        <strong><?php echo $product_count; ?></strong>
                                    </div>
                                <?php } catch (Exception $e) { ?>
                                    <div class="alert alert-danger">Error loading statistics</div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tables Status -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Database Tables Status</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Table Name</th>
                                    <th>Status</th>
                                    <th>Records</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($status['tables'] as $table => $info): ?>
                                    <tr>
                                        <td><code><?php echo htmlspecialchars($table); ?></code></td>
                                        <td>
                                            <?php if ($info['exists']): ?>
                                                <span class="badge bg-success">✓ Exists</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">✗ Missing</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $info['count']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Admin Pages Navigation -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Quick Links to Admin Pages</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Business Management</h6>
                                <ul class="list-unstyled">
                                    <li><a href="manage_orders.php">📦 Orders</a></li>
                                    <li><a href="manage_invoices.php">💰 Invoices</a></li>
                                    <li><a href="manage_warehouse.php">📊 Warehouse/Inventory</a></li>
                                    <li><a href="manage_coupons.php">🎟️ Coupons & Promotions</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6>System Management</h6>
                                <ul class="list-unstyled">
                                    <li><a href="manage_users.php">👥 Users</a></li>
                                    <li><a href="manage_roles.php">🔐 Roles</a></li>
                                    <li><a href="manage_deals.php">🎯 Deals & Promotions</a></li>
                                    <li><a href="manage_security.php">🔒 Security & Privacy</a></li>
                                </ul>
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

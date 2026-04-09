<?php
require_once('../../sql_connection/config.php');
requireRole('Admin');

$status = isset($_GET['status']) ? $_GET['status'] : '';

try {
    $sql = "SELECT o.*, u.first_name, u.email FROM orders o
            LEFT JOIN users u ON o.user_id = u.user_id
            WHERE 1=1";
    
    if (!empty($status)) {
        $sql .= " AND o.order_status = ?";
        $orders_result = $pdo->prepare($sql);
        $orders_result->execute([$status]);
    } else {
        $orders_result = $pdo->prepare($sql);
        $orders_result->execute();
    }
    
    $purchases = $orders_result->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $error = "Error fetching purchases: " . $e->getMessage();
    $purchases = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Purchases - Admin Panel</title>
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
                    <h2>Purchase Orders</h2>
                </div>
                
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="btn-group" role="group">
                                    <a href="manage_purchases.php" class="btn btn-outline-secondary <?php echo empty($status) ? 'active' : ''; ?>">All Orders</a>
                                    <a href="manage_purchases.php?status=pending" class="btn btn-outline-secondary <?php echo $status == 'pending' ? 'active' : ''; ?>">Pending</a>
                                    <a href="manage_purchases.php?status=confirmed" class="btn btn-outline-secondary <?php echo $status == 'confirmed' ? 'active' : ''; ?>">Confirmed</a>
                                    <a href="manage_purchases.php?status=processing" class="btn btn-outline-secondary <?php echo $status == 'processing' ? 'active' : ''; ?>">Processing</a>
                                    <a href="manage_purchases.php?status=shipped" class="btn btn-outline-secondary <?php echo $status == 'shipped' ? 'active' : ''; ?>">Shipped</a>
                                </div>
                            </div>
                        </div>
                        
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Customer</th>
                                    <th>Email</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Order Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($purchases)): ?>
                                    <?php foreach ($purchases as $purchase): ?>
                                        <tr>
                                            <td><strong><?php echo htmlspecialchars($purchase['order_number']); ?></strong></td>
                                            <td><?php echo htmlspecialchars($purchase['first_name'] ?? 'N/A'); ?></td>
                                            <td><?php echo htmlspecialchars($purchase['email'] ?? 'N/A'); ?></td>
                                            <td>$<?php echo number_format($purchase['final_amount'], 2); ?></td>
                                            <td>
                                                <span class="badge bg-info"><?php echo ucfirst($purchase['order_status']); ?></span>
                                            </td>
                                            <td><?php echo date('M d, Y', strtotime($purchase['order_date'])); ?></td>
                                            <td>
                                                <a href="view_order.php?id=<?php echo $purchase['order_id']; ?>" class="btn btn-sm btn-info">View</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No orders found</td>
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

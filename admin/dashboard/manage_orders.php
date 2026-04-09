<?php
require_once(__DIR__ . '/../../sql_connection/config.php');
requireRole('Admin');

// Handle order status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_status') {
    $order_id = intval($_POST['order_id']);
    $order_status = htmlspecialchars($_POST['order_status']);
    
    $pdo->prepare("UPDATE orders SET order_status = ? WHERE order_id = ?")->execute([$order_status, $order_id]);
    $_SESSION['success_message'] = "Order status updated successfully";
}

// Get filter parameters
$status_filter = $_GET['status'] ?? '';
$search = $_GET['search'] ?? '';

// Build query
$query = "SELECT o.*, u.first_name, u.email FROM orders o
          JOIN users u ON o.user_id = u.user_id
          WHERE 1=1";
$params = [];

if (!empty($status_filter)) {
    $query .= " AND o.order_status = ?";
    $params[] = $status_filter;
}

if (!empty($search)) {
    $query .= " AND (o.order_number LIKE ? OR u.first_name LIKE ? OR u.email LIKE ?)";
    $search_term = "%$search%";
    $params = array_merge($params, [$search_term, $search_term, $search_term]);
}

$query .= " ORDER BY o.created_at DESC";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Orders - Admin Panel</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
</head>
<body>
    <?php include(__DIR__ . '/../include/sidebarnav.php'); ?>
    <main class="main-wrapper">
        <?php include(__DIR__ . '/../include/header.php'); ?>
        
        <section class="section">
            <div class="container-fluid mt-4 mb-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Order Management</h2>

            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['success_message']; ?>
                    <?php unset($_SESSION['success_message']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- Filters -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" class="row g-3">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="search" placeholder="Search by Order #, Name, or Email" value="<?php echo htmlspecialchars($search); ?>">
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" name="status">
                                <option value="">All Statuses</option>
                                <option value="pending" <?php echo $status_filter === 'pending' ? 'selected' : ''; ?>>Pending</option>
                                <option value="confirmed" <?php echo $status_filter === 'confirmed' ? 'selected' : ''; ?>>Confirmed</option>
                                <option value="processing" <?php echo $status_filter === 'processing' ? 'selected' : ''; ?>>Processing</option>
                                <option value="shipped" <?php echo $status_filter === 'shipped' ? 'selected' : ''; ?>>Shipped</option>
                                <option value="delivered" <?php echo $status_filter === 'delivered' ? 'selected' : ''; ?>>Delivered</option>
                                <option value="cancelled" <?php echo $status_filter === 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Order #</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><strong><?php echo htmlspecialchars($order['order_number']); ?></strong></td>
                                <td>
                                    <?php echo htmlspecialchars($order['first_name']); ?><br>
                                    <small><?php echo htmlspecialchars($order['email']); ?></small>
                                </td>
                                <td><?php echo date('M d, Y', strtotime($order['order_date'])); ?></td>
                                <td><strong>$<?php echo number_format($order['final_amount'], 2); ?></strong></td>
                                <td>
                                    <span class="badge bg-<?php 
                                        echo match($order['order_status']) {
                                            'pending' => 'warning',
                                            'confirmed' => 'info',
                                            'processing' => 'primary',
                                            'shipped' => 'secondary',
                                            'delivered' => 'success',
                                            'cancelled' => 'danger',
                                            default => 'secondary'
                                        };
                                    ?>">
                                        <?php echo ucfirst($order['order_status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-<?php echo $order['payment_status'] === 'completed' ? 'success' : 'warning'; ?>">
                                        <?php echo ucfirst($order['payment_status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="view_order.php?order_id=<?php echo $order['order_id']; ?>" class="btn btn-sm btn-info">View</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if (empty($orders)): ?>
                    <div class="alert alert-info text-center">No orders found</div>
                <?php endif; ?>
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

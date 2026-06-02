<?php
require_once(__DIR__ . '/../../sql_connection/config.php');

requireRole('Admin');

if (!isset($_GET['order_id'])) {
    header("Location: manage_orders.php");
    exit();
}

$order_id = intval($_GET['order_id']);

// Get order details
$stmt = $pdo->prepare("
    SELECT o.*, u.first_name, u.email, u.phone
    FROM orders o
    JOIN users u ON o.user_id = u.user_id
    WHERE o.order_id = ?
");
$stmt->execute([$order_id]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    die("Order not found");
}

// Get order items
$stmt = $pdo->prepare("
    SELECT oi.*, p.id AS product_id, p.name AS product_name, p.image_path
    FROM order_items oi
    LEFT JOIN products p ON oi.product_id = p.id
    WHERE oi.order_id = ?
");
$stmt->execute([$order_id]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get invoice
$stmt = $pdo->prepare("SELECT * FROM invoices WHERE order_id = ?");
$stmt->execute([$order_id]);
$invoice = $stmt->fetch(PDO::FETCH_ASSOC);

// Get shipment
$stmt = $pdo->prepare("SELECT *, status AS shipment_status, shipping_date AS shipped_date, expected_delivery AS estimated_delivery FROM shipments WHERE order_id = ?");
$stmt->execute([$order_id]);
$shipment = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle status update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_status = htmlspecialchars($_POST['order_status']);
    $pdo->prepare("UPDATE orders SET order_status = ? WHERE order_id = ?")->execute([$order_status, $order_id]);
    
    // If updating to shipped, update shipment status too
    if ($order_status === 'shipped') {
        $pdo->prepare("UPDATE shipments SET status = 'in_transit', shipping_date = NOW() WHERE order_id = ?")->execute([$order_id]);
    }
    
    $_SESSION['success_message'] = "Order updated successfully";
    header("Location: view_order.php?order_id=" . $order_id);
    exit();
}
?>

<div class="container-fluid mt-4 mb-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Order Details: <?php echo htmlspecialchars($order['order_number']); ?></h2>

            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['success_message']; ?>
                    <?php unset($_SESSION['success_message']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="row">
                <!-- Order Info -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-dark text-white">
                            <h5>Order Information</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Order Date:</strong> <?php echo date('M d, Y H:i', strtotime($order['order_date'])); ?></p>
                            <p><strong>Order Status:</strong>
                                <span class="badge bg-<?php echo match($order['order_status']) {
                                    'pending' => 'warning',
                                    'confirmed' => 'info',
                                    'processing' => 'primary',
                                    'shipped' => 'secondary',
                                    'delivered' => 'success',
                                    'cancelled' => 'danger',
                                    default => 'secondary'
                                }; ?>">
                                    <?php echo ucfirst($order['order_status']); ?>
                                </span>
                            </p>
                            <p><strong>Payment Status:</strong>
                                <span class="badge bg-<?php echo $order['payment_status'] === 'completed' ? 'success' : 'warning'; ?>">
                                    <?php echo ucfirst($order['payment_status']); ?>
                                </span>
                            </p>
                            <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($order['payment_method']); ?></p>

                            <hr>

                            <h6>Customer Information</h6>
                            <p>
                                <strong><?php echo htmlspecialchars($order['first_name']); ?></strong><br>
                                <?php echo htmlspecialchars($order['email']); ?><br>
                                <?php echo htmlspecialchars($order['phone']); ?>
                            </p>

                            <hr>

                            <h6>Billing Address</h6>
                            <p><?php echo nl2br(htmlspecialchars($order['billing_address'])); ?></p>

                            <hr>

                            <h6>Shipping Address</h6>
                            <p><?php echo nl2br(htmlspecialchars($order['shipping_address'])); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-dark text-white">
                            <h5>Order Summary</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm">
                                <tr>
                                    <td>Subtotal:</td>
                                    <td class="text-end"><strong>$<?php echo number_format($order['total_amount'], 2); ?></strong></td>
                                </tr>
                                <?php if ($order['discount_amount'] > 0): ?>
                                    <tr>
                                        <td>Discount <?php echo $order['coupon_code'] ? '(' . htmlspecialchars($order['coupon_code']) . ')' : ''; ?>:</td>
                                        <td class="text-end"><strong>-$<?php echo number_format($order['discount_amount'], 2); ?></strong></td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <td>Shipping:</td>
                                    <td class="text-end"><strong>$<?php echo number_format($order['shipping_cost'], 2); ?></strong></td>
                                </tr>
                                <tr class="table-dark">
                                    <td><strong>Total:</strong></td>
                                    <td class="text-end"><strong>$<?php echo number_format($order['final_amount'], 2); ?></strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <?php if ($shipment): ?>
                        <div class="card mb-4">
                            <div class="card-header bg-dark text-white">
                                <h5>Shipment Information</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Status:</strong> 
                                    <span class="badge bg-info"><?php echo ucfirst(str_replace('_', ' ', $shipment['shipment_status'])); ?></span>
                                </p>
                                <?php if ($shipment['tracking_number']): ?>
                                    <p><strong>Tracking #:</strong> <?php echo htmlspecialchars($shipment['tracking_number']); ?></p>
                                <?php endif; ?>
                                <?php if ($shipment['carrier']): ?>
                                    <p><strong>Carrier:</strong> <?php echo htmlspecialchars($shipment['carrier']); ?></p>
                                <?php endif; ?>
                                <?php if ($shipment['shipped_date']): ?>
                                    <p><strong>Shipped Date:</strong> <?php echo date('M d, Y', strtotime($shipment['shipped_date'])); ?></p>
                                <?php endif; ?>
                                <?php if ($shipment['estimated_delivery']): ?>
                                    <p><strong>Est. Delivery:</strong> <?php echo date('M d, Y', strtotime($shipment['estimated_delivery'])); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Order Items -->
            <div class="card mb-4">
                <div class="card-header bg-dark text-white">
                    <h5>Order Items</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($items as $item): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                                        <td><?php echo $item['quantity']; ?></td>
                                        <td>$<?php echo number_format($item['unit_price'], 2); ?></td>
                                        <td>$<?php echo number_format($item['total_price'], 2); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Update Status -->
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h5>Update Order Status</h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Order Status</label>
                                <select class="form-select" name="order_status" required>
                                    <option value="pending" <?php echo $order['order_status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                                    <option value="confirmed" <?php echo $order['order_status'] === 'confirmed' ? 'selected' : ''; ?>>Confirmed</option>
                                    <option value="processing" <?php echo $order['order_status'] === 'processing' ? 'selected' : ''; ?>>Processing</option>
                                    <option value="shipped" <?php echo $order['order_status'] === 'shipped' ? 'selected' : ''; ?>>Shipped</option>
                                    <option value="delivered" <?php echo $order['order_status'] === 'delivered' ? 'selected' : ''; ?>>Delivered</option>
                                    <option value="cancelled" <?php echo $order['order_status'] === 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>&nbsp;</label>
                                <button type="submit" class="btn btn-primary w-100">Update Status</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-4">
                <a href="manage_orders.php" class="btn btn-secondary">Back to Orders</a>
                <a href="manage_invoices.php?order_id=<?php echo $order_id; ?>" class="btn btn-info">View Invoice</a>
            </div>
        </div>
    </div>
            </div>
        </section>
    </main>
    
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

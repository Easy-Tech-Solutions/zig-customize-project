<?php
require_once(__DIR__ . '/../../sql_connection/config.php');

requireRole('Admin');

if (!isset($_GET['invoice_id'])) {
    header("Location: manage_invoices.php");
    exit();
}

$invoice_id = intval($_GET['invoice_id']);

// Get invoice details
$stmt = $pdo->prepare("
    SELECT i.*, o.order_number, o.final_amount, o.order_date, o.total_amount, o.discount_amount, o.shipping_cost, o.coupon_code,
           u.first_name, u.email, u.phone
    FROM invoices i
    JOIN orders o ON i.order_id = o.order_id
    JOIN users u ON o.user_id = u.user_id
    WHERE i.invoice_id = ?
");
$stmt->execute([$invoice_id]);
$invoice = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$invoice) {
    die("Invoice not found");
}

// Get order items
$stmt = $pdo->prepare("
    SELECT oi.*, p.name AS product_name
    FROM order_items oi
    LEFT JOIN products p ON oi.product_id = p.id
    WHERE oi.order_id = ?
    ORDER BY oi.order_item_id
");
$stmt->execute([$invoice['order_id']]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle status update - disabled until column exists in database
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $status = htmlspecialchars($_POST['invoice_status']);
//     $pdo->prepare("UPDATE invoices SET status = ? WHERE invoice_id = ?")->execute([$status, $invoice_id]);
//     $_SESSION['success_message'] = "Invoice status updated successfully";
//     header("Location: view_invoice.php?invoice_id=" . $invoice_id);
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoice View - Admin Panel</title>
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
            <h2 class="mb-4">Invoice: <?php echo htmlspecialchars($invoice['invoice_number']); ?></h2>

            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['success_message']; ?>
                    <?php unset($_SESSION['success_message']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- Invoice Preview -->
            <div class="card mb-4 invoice-preview">
                <div class="card-body p-4" style="border: 1px solid #ddd;">
                    <!-- Invoice Header -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h3><strong>INVOICE</strong></h3>
                            <p class="text-muted">Invoice #: <?php echo htmlspecialchars($invoice['invoice_number']); ?></p>
                            <p class="text-muted">Order #: <?php echo htmlspecialchars($invoice['order_number']); ?></p>
                        </div>
                        <div class="col-md-6 text-end">
                            <p><strong>Invoice Date:</strong> <?php echo date('M d, Y', strtotime($invoice['invoice_date'])); ?></p>
                            <p><strong>Due Date:</strong> <?php echo $invoice['due_date'] ? date('M d, Y', strtotime($invoice['due_date'])) : 'N/A'; ?></p>
                            <p><strong>Status:</strong> 
                                <?php if (isset($invoice['status'])): ?>
                                <span class="badge bg-<?php 
                                    echo match($invoice['status']) {
                                        'draft' => 'secondary',
                                        'sent' => 'info',
                                        'paid' => 'success',
                                        'overdue' => 'danger',
                                        'cancelled' => 'dark',
                                        default => 'secondary'
                                    };
                                ?>">
                                    <?php echo ucfirst($invoice['status']); ?>
                                </span>
                                <?php else: ?>
                                <span class="badge bg-secondary">Pending</span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>

                    <hr>

                    <!-- From/To -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6><strong>Bill To:</strong></h6>
                            <p>
                                <?php echo htmlspecialchars($invoice['first_name']); ?><br>
                                <?php echo htmlspecialchars($invoice['email']); ?><br>
                                <?php echo htmlspecialchars($invoice['phone'] ?? 'N/A'); ?>
                            </p>
                        </div>
                    </div>

                    <hr>

                    <!-- Items Table -->
                    <table class="table table-striped mb-4">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th style="text-align: center;">Quantity</th>
                                <th style="text-align: right;">Unit Price</th>
                                <th style="text-align: right;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                                    <td style="text-align: center;"><?php echo $item['quantity']; ?></td>
                                    <td style="text-align: right;">$<?php echo number_format($item['unit_price'], 2); ?></td>
                                    <td style="text-align: right;">$<?php echo number_format($item['total_price'], 2); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <hr>

                    <!-- Summary -->
                    <div class="row mb-4">
                        <div class="col-md-6 offset-md-6">
                            <table class="table table-sm">
                                <tr>
                                    <td><strong>Subtotal:</strong></td>
                                    <td style="text-align: right;">$<?php echo number_format($invoice['total_amount'], 2); ?></td>
                                </tr>
                                <?php if ($invoice['discount_amount'] > 0): ?>
                                    <tr>
                                        <td><strong>Discount <?php echo $invoice['coupon_code'] ? '(' . htmlspecialchars($invoice['coupon_code']) . ')' : ''; ?>:</strong></td>
                                        <td style="text-align: right;">-$<?php echo number_format($invoice['discount_amount'], 2); ?></td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <td><strong>Shipping:</strong></td>
                                    <td style="text-align: right;">$<?php echo number_format($invoice['shipping_cost'], 2); ?></td>
                                </tr>
                                <tr class="table-dark">
                                    <td><strong>Total Due:</strong></td>
                                    <td style="text-align: right;"><strong>$<?php echo number_format($invoice['final_amount'], 2); ?></strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <?php if ($invoice['notes']): ?>
                        <hr>
                        <p><strong>Notes:</strong></p>
                        <p><?php echo nl2br(htmlspecialchars($invoice['notes'])); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Update Status -->
            <div class="card mb-4">
                <div class="card-header bg-dark text-white">
                    <h5>Update Invoice Status</h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Invoice Status</label>
                                <select class="form-select" name="invoice_status" required>
                                    <option value="draft" <?php echo $invoice['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
                                    <option value="sent" <?php echo $invoice['status'] === 'sent' ? 'selected' : ''; ?>>Sent</option>
                                    <option value="paid" <?php echo $invoice['status'] === 'paid' ? 'selected' : ''; ?>>Paid</option>
                                    <option value="overdue" <?php echo $invoice['status'] === 'overdue' ? 'selected' : ''; ?>>Overdue</option>
                                    <option value="cancelled" <?php echo $invoice['status'] === 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
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
                <a href="manage_invoices.php" class="btn btn-secondary">Back to Invoices</a>
                <a href="view_order.php?order_id=<?php echo $invoice['order_id']; ?>" class="btn btn-info">View Order</a>
                <button onclick="window.print()" class="btn btn-outline-primary">Print Invoice</button>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        .btn { display: none; }
        .card-header { display: none; }
        body { background-color: white; }
    }
</style>

            </div>
        </section>
    </main>
    
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

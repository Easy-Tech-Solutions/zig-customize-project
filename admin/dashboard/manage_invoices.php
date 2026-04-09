<?php
require_once(__DIR__ . '/../../sql_connection/config.php');
requireRole('Admin');

// Handle invoice status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $invoice_id = intval($_POST['invoice_id']);
    
    if ($_POST['action'] === 'update_status') {
        $status = htmlspecialchars($_POST['invoice_status']);
        $pdo->prepare("UPDATE invoices SET status = ? WHERE invoice_id = ?")->execute([$status, $invoice_id]);
        $_SESSION['success_message'] = "Invoice status updated successfully";
    }
}

// Get filter parameters
$status_filter = $_GET['status'] ?? '';
$search = $_GET['search'] ?? '';

// Build query
$query = "SELECT i.*, o.order_number, o.final_amount, o.order_date, u.first_name, u.email
          FROM invoices i
          JOIN orders o ON i.order_id = o.order_id
          JOIN users u ON o.user_id = u.user_id
          WHERE 1=1";
$params = [];

// Note: Status filter commented out - column may not exist in current database
// if (!empty($status_filter)) {
//     $query .= " AND i.status = ?";
//     $params[] = $status_filter;
// }

if (!empty($search)) {
    $query .= " AND (i.invoice_number LIKE ? OR o.order_number LIKE ? OR u.first_name LIKE ?)";
    $search_term = "%$search%";
    $params = array_merge($params, [$search_term, $search_term, $search_term]);
}

$query .= " ORDER BY i.invoice_date DESC";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$invoices = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoice Management - Admin Panel</title>
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
            <h2 class="mb-4">Invoice Management</h2>

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
                            <input type="text" class="form-control" name="search" placeholder="Search by Invoice #, Order #, or Name" value="<?php echo htmlspecialchars($search); ?>">
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" name="status">
                                <option value="">All Statuses</option>
                                <option value="draft" <?php echo $status_filter === 'draft' ? 'selected' : ''; ?>>Draft</option>
                                <option value="sent" <?php echo $status_filter === 'sent' ? 'selected' : ''; ?>>Sent</option>
                                <option value="paid" <?php echo $status_filter === 'paid' ? 'selected' : ''; ?>>Paid</option>
                                <option value="overdue" <?php echo $status_filter === 'overdue' ? 'selected' : ''; ?>>Overdue</option>
                                <option value="cancelled" <?php echo $status_filter === 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Invoices Table -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Invoice #</th>
                            <th>Order #</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Invoice Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($invoices as $invoice): ?>
                            <tr>
                                <td><strong><?php echo htmlspecialchars($invoice['invoice_number']); ?></strong></td>
                                <td><?php echo htmlspecialchars($invoice['order_number']); ?></td>
                                <td>
                                    <?php echo htmlspecialchars($invoice['first_name']); ?><br>
                                    <small><?php echo htmlspecialchars($invoice['email']); ?></small>
                                </td>
                                <td><strong>$<?php echo number_format($invoice['final_amount'], 2); ?></strong></td>
                                <td><?php echo date('M d, Y', strtotime($invoice['invoice_date'])); ?></td>
                                <td>
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
                                </td>
                                <td>
                                    <a href="view_invoice.php?invoice_id=<?php echo $invoice['invoice_id']; ?>" class="btn btn-sm btn-info">View</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if (empty($invoices)): ?>
                    <div class="alert alert-info text-center">No invoices found</div>
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

</body>
</html>

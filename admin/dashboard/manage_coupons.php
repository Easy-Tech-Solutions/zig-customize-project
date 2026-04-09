<?php
require_once(__DIR__ . '/../../sql_connection/config.php');
requireRole('Admin');

// Handle coupon actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add_coupon') {
            $coupon_code = htmlspecialchars($_POST['coupon_code']);
            $discount_type = htmlspecialchars($_POST['discount_type']);
            $discount_value = floatval($_POST['discount_value']);
            $usage_limit = intval($_POST['max_uses']) ?? null;
            $valid_from = htmlspecialchars($_POST['valid_from']);
            $valid_until = htmlspecialchars($_POST['valid_until']);

            try {
                $stmt = $pdo->prepare("
                    INSERT INTO coupons (coupon_code, discount_type, discount_value, usage_limit, valid_from, valid_until)
                    VALUES (?, ?, ?, ?, ?, ?)
                ");
                $stmt->execute([$coupon_code, $discount_type, $discount_value, $usage_limit, $valid_from, $valid_until]);
                $_SESSION['success_message'] = "Coupon created successfully";
            } catch (Exception $e) {
                $_SESSION['error_message'] = "Error creating coupon: " . $e->getMessage();
            }
        } elseif ($_POST['action'] === 'toggle_coupon') {
            $coupon_id = intval($_POST['coupon_id']);
            $stmt = $pdo->prepare("SELECT status FROM coupons WHERE coupon_id = ?");
            $stmt->execute([$coupon_id]);
            $coupon = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $currentStatus = strtolower($coupon['status'] ?? 'active');
            $new_status = ($currentStatus === 'active') ? 'inactive' : 'active';
            $is_active_flag = ($new_status === 'active') ? 1 : 0;
            $pdo->prepare("UPDATE coupons SET status = ?, is_active = ? WHERE coupon_id = ?")->execute([$new_status, $is_active_flag, $coupon_id]);
            $_SESSION['success_message'] = "Coupon status updated";
        }
        header("Location: manage_coupons.php");
        exit();
    }
}

// Get all coupons
$stmt = $pdo->prepare("
    SELECT * FROM coupons
    ORDER BY created_at DESC
");
$stmt->execute();
$coupons = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Coupon Management - Admin Panel</title>
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
            <h2 class="mb-4">Coupon Management</h2>

            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['success_message']; ?>
                    <?php unset($_SESSION['success_message']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error_message'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['error_message']; ?>
                    <?php unset($_SESSION['error_message']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <!-- Add New Coupon Form -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header bg-dark text-white">
                    <h5>Create New Coupon</h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <input type="hidden" name="action" value="add_coupon">

                        <div class="mb-3">
                            <label class="form-label">Coupon Code</label>
                            <input type="text" class="form-control" name="coupon_code" placeholder="e.g., SUMMER20" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Discount Type</label>
                            <select class="form-select" name="discount_type" required>
                                <option value="percentage">Percentage (%)</option>
                                <option value="fixed">Fixed Amount ($)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Discount Value</label>
                            <input type="number" class="form-control" name="discount_value" placeholder="10" min="0" step="0.01" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Max Uses (leave blank for unlimited)</label>
                            <input type="number" class="form-control" name="max_uses" placeholder="100" min="0">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Valid From</label>
                            <input type="date" class="form-control" name="valid_from" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Valid Until</label>
                            <input type="date" class="form-control" name="valid_until" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Create Coupon</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Coupons List -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h5>Active Coupons</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Code</th>
                                <th>Discount</th>
                                <th>Valid From</th>
                                <th>Valid Until</th>
                                <th>Uses</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($coupons as $coupon): ?>
                                <tr>
                                    <td><strong><?php echo htmlspecialchars($coupon['coupon_code']); ?></strong></td>
                                    <td>
                                        <?php echo $coupon['discount_value']; ?>
                                        <?php echo ($coupon['discount_type'] ?? 'percentage') === 'percentage' ? '%' : '$'; ?>
                                    </td>
                                    <td><?php echo isset($coupon['valid_from']) ? date('M d, Y', strtotime($coupon['valid_from'])) : 'N/A'; ?></td>
                                    <td><?php echo isset($coupon['valid_until']) ? date('M d, Y', strtotime($coupon['valid_until'])) : 'N/A'; ?></td>
                                    <td>
                                        <?php if (isset($coupon['usage_limit']) && $coupon['usage_limit']): ?>
                                            <?php echo ($coupon['usage_count'] ?? 0); ?> / <?php echo $coupon['usage_limit']; ?>
                                        <?php else: ?>
                                            <?php echo ($coupon['usage_count'] ?? 0); ?> / Unlimited
                                        <?php endif; ?>
                                    </td>
                                    <?php $currentCouponStatus = strtolower($coupon['status'] ?? 'active'); ?>
                                    <td>
                                        <span class="badge bg-<?php echo ($currentCouponStatus === 'active') ? 'success' : 'danger'; ?>">
                                            <?php echo ucfirst($currentCouponStatus); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <form method="POST" style="display:inline;">
                                            <input type="hidden" name="action" value="toggle_coupon">
                                            <input type="hidden" name="coupon_id" value="<?php echo $coupon['coupon_id']; ?>">
                                            <button type="submit" class="btn btn-sm <?php echo ($currentCouponStatus === 'active') ? 'btn-warning' : 'btn-success'; ?>">
                                                <?php echo ($currentCouponStatus === 'active') ? 'Disable' : 'Enable'; ?>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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

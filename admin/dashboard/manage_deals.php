<?php
require_once('../../sql_connection/config.php');
requireRole('Admin');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    try {
        $couponId = intval($_POST['coupon_id'] ?? 0);
        if ($couponId > 0) {
            if ($_POST['action'] === 'toggle_deal') {
                $stmt = $pdo->prepare('SELECT status FROM coupons WHERE coupon_id = ?');
                $stmt->execute([$couponId]);
                $deal = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($deal) {
                    $newStatus = (strtolower($deal['status'] ?? 'active') === 'active') ? 'inactive' : 'active';
                    $isActive = ($newStatus === 'active') ? 1 : 0;
                    $update = $pdo->prepare('UPDATE coupons SET status = ?, is_active = ? WHERE coupon_id = ?');
                    $update->execute([$newStatus, $isActive, $couponId]);
                }
            } elseif ($_POST['action'] === 'delete_deal') {
                $delete = $pdo->prepare('DELETE FROM coupons WHERE coupon_id = ?');
                $delete->execute([$couponId]);
            }
        }
    } catch (Exception $e) {
        $error = 'Error updating deal: ' . $e->getMessage();
    }
    header('Location: manage_deals.php');
    exit();
}

try {
    $sql = "SELECT * FROM coupons ORDER BY coupon_id DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $deals = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $error = "Error fetching deals: " . $e->getMessage();
    $deals = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Deals and Promotions - Admin Panel</title>
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
                            <h2>Deals and Promotions</h2>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="manage_coupons.php" class="btn btn-primary">+ Create Deal</a>
                        </div>
                    </div>
                </div>
                
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Coupon Code</th>
                                    <th>Discount</th>
                                    <th>Type</th>
                                    <th>Expiry Date</th>
                                    <th>Max Uses</th>
                                    <th>Used</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($deals)): ?>
                                    <?php foreach ($deals as $deal): ?>
                                        <tr>
                                            <td><strong><?php echo htmlspecialchars($deal['coupon_code']); ?></strong></td>
                                            <td>
                                                <?php echo ($deal['discount_type'] ?? 'percentage') === 'percentage' ? ($deal['discount_value'] . '%') : ('$' . number_format($deal['discount_value'], 2)); ?>
                                            </td>
                                            <td><?php echo ucfirst($deal['discount_type'] ?? 'percentage'); ?></td>
                                            <td>
                                                <?php echo !empty($deal['valid_until']) ? date('M d, Y', strtotime($deal['valid_until'])) : 'No expiry'; ?>
                                            </td>
                                            <td><?php echo (!empty($deal['usage_limit']) ? $deal['usage_limit'] : 'Unlimited'); ?></td>
                                            <td><?php echo ($deal['usage_count'] ?? 0); ?></td>
                                            <td>
                                                <?php $dealStatus = strtolower($deal['status'] ?? 'active'); ?>
                                                <span class="badge <?php echo ($dealStatus === 'active') ? 'bg-success' : 'bg-danger'; ?>">
                                                    <?php echo ucfirst($dealStatus); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <form method="POST" style="display:inline;">
                                                    <input type="hidden" name="action" value="toggle_deal">
                                                    <input type="hidden" name="coupon_id" value="<?php echo $deal['coupon_id']; ?>">
                                                    <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                        <?php echo ($deal['status'] ?? 'active') === 'active' ? 'Disable' : 'Enable'; ?>
                                                    </button>
                                                </form>
                                                <form method="POST" style="display:inline; margin-left: 5px;">
                                                    <input type="hidden" name="action" value="delete_deal">
                                                    <input type="hidden" name="coupon_id" value="<?php echo $deal['coupon_id']; ?>">
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this deal?');">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center">No deals found</td>
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

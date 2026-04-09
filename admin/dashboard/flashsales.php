<?php
require_once '../../sql_connection/config.php';
requireRole('Admin');

try {
    $stmt = $pdo->prepare('SELECT * FROM flash_sales ORDER BY created_at DESC');
    $stmt->execute();
    $flashSales = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $error = 'Unable to load flash sales: ' . $e->getMessage();
    $flashSales = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flash Sales - Admin</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
</head>
<body>
    <?php include('../include/sidebarnav.php'); ?>
    <main class="main-wrapper">
        <?php include('../include/header.php'); ?>
        <section class="section">
            <div class="container-fluid">
                <div class="title-wrapper pt-30">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2>Flash Sales</h2>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="addproducttodeals.php" class="btn btn-primary">Add Product to Deals</a>
                        </div>
                    </div>
                </div>

                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product ID</th>
                                        <th>Name</th>
                                        <th>Original Price</th>
                                        <th>Sale Price</th>
                                        <th>Discount</th>
                                        <th>Start</th>
                                        <th>End</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($flashSales)): ?>
                                        <?php foreach ($flashSales as $sale): ?>
                                            <tr>
                                                <td><?php echo $sale['id']; ?></td>
                                                <td><?php echo $sale['product_id']; ?></td>
                                                <td><?php echo htmlspecialchars($sale['name']); ?></td>
                                                <td>$<?php echo number_format($sale['original_price'], 2); ?></td>
                                                <td>$<?php echo number_format($sale['price'], 2); ?></td>
                                                <td><?php echo number_format($sale['discount'], 2); ?>%</td>
                                                <td><?php echo $sale['start_date'] ? date('M d, Y', strtotime($sale['start_date'])) : 'N/A'; ?></td>
                                                <td><?php echo $sale['end_date'] ? date('M d, Y', strtotime($sale['end_date'])) : 'N/A'; ?></td>
                                                <td>
                                                    <a href="addproducttodeals.php" class="btn btn-sm btn-secondary">Edit</a>
                                                    <a href="#" class="btn btn-sm btn-danger">Remove</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="9" class="text-center">No flash sales available.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

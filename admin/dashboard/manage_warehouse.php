<?php
require_once(__DIR__ . '/../../sql_connection/config.php');
requireRole('Admin');

function getExistingColumn(PDO $pdo, string $table, array $candidates): ?string {
    try {
        $stmt = $pdo->query("SHOW COLUMNS FROM {$table}");
        $columns = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'Field');
        foreach ($candidates as $candidate) {
            if (in_array($candidate, $columns, true)) {
                return $candidate;
            }
        }
    } catch (Exception $e) {
        return null;
    }
    return null;
}

$productIdColumn = getExistingColumn($pdo, 'products', ['product_id', 'id']);
$productNameColumn = getExistingColumn($pdo, 'products', ['product_name', 'name']);
$productPriceColumn = getExistingColumn($pdo, 'products', ['product_price', 'price']);
$productCategoryColumn = getExistingColumn($pdo, 'products', ['product_category', 'category']);
$productSkuColumn = getExistingColumn($pdo, 'products', ['sku', 'product_sku']);
$stockQuantityColumn = getExistingColumn($pdo, 'products', ['stock_quantity', 'quantity']);

if (!$productIdColumn || !$stockQuantityColumn) {
    die('Warehouse page cannot determine product ID or stock quantity column.');
}

$productNameColumn = $productNameColumn ?? 'name';
$productPriceColumn = $productPriceColumn ?? 'price';
$productCategoryColumn = $productCategoryColumn ?? 'category';
$productSkuColumn = $productSkuColumn ?? 'sku';
$productIdColumn = $productIdColumn ?? 'id';
$stockQuantityColumn = $stockQuantityColumn ?? 'stock_quantity';

// Handle inventory update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_stock') {
    $product_id = intval($_POST['product_id']);
    $new_quantity = intval($_POST['quantity']);
    $notes = htmlspecialchars($_POST['notes'] ?? '');

    $stmt = $pdo->prepare("SELECT {$stockQuantityColumn} FROM products WHERE {$productIdColumn} = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        $old_quantity = $product[$stockQuantityColumn] ?? 0;
        $pdo->prepare("UPDATE products SET {$stockQuantityColumn} = ? WHERE {$productIdColumn} = ?")->execute([$new_quantity, $product_id]);

        $quantity_change = $new_quantity - $old_quantity;
        $pdo->prepare("INSERT INTO stock_movements (product_id, movement_type, quantity, notes) VALUES (?, 'adjustment', ?, ?)")->execute([$product_id, $quantity_change, $notes]);

        $_SESSION['success_message'] = 'Inventory updated successfully';
        header('Location: manage_warehouse.php');
        exit;
    }
}

// Get filter parameters
$search = $_GET['search'] ?? '';
$low_stock = isset($_GET['low_stock']);

// Build query - select only from products since warehouse_inventory is just a reference
$query = "SELECT * FROM products WHERE 1=1";
$params = [];

if (!empty($search)) {
    $query .= " AND {$productNameColumn} LIKE ?";
    $params[] = "%$search%";
}

if ($low_stock) {
    $query .= " AND {$stockQuantityColumn} <= 10";
}

$query .= " ORDER BY {$stockQuantityColumn} ASC";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get warehouse statistics
$stmt = $pdo->prepare("
    SELECT 
        COUNT(*) as total_products,
        SUM({$stockQuantityColumn}) as total_stock,
        COUNT(CASE WHEN {$stockQuantityColumn} = 0 THEN 1 END) as out_of_stock,
        COUNT(CASE WHEN {$stockQuantityColumn} > 0 AND {$stockQuantityColumn} <= 10 THEN 1 END) as low_stock
    FROM products
");
$stmt->execute();
$stats = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Warehouse Management - Admin Panel</title>
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
            <h2 class="mb-4">Warehouse & Inventory Management</h2>

            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['success_message']; ?>
                    <?php unset($_SESSION['success_message']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- Warehouse Statistics -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h3><?php echo $stats['total_products']; ?></h3>
                            <p class="text-muted">Total Products</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h3><?php echo $stats['total_stock']; ?></h3>
                            <p class="text-muted">Total Stock Items</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center bg-danger text-white">
                        <div class="card-body">
                            <h3><?php echo $stats['out_of_stock']; ?></h3>
                            <p>Out of Stock</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center bg-warning">
                        <div class="card-body">
                            <h3><?php echo $stats['low_stock']; ?></h3>
                            <p>Low Stock Items</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" class="row g-3">
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="search" placeholder="Search products..." value="<?php echo htmlspecialchars($search); ?>">
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="low_stock" id="lowStockCheck" <?php echo $low_stock ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="lowStockCheck">
                                    Show only low stock items
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Inventory Table -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Current Stock</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td>
                                    <strong><?php echo htmlspecialchars($product[$productNameColumn] ?? $product['name'] ?? 'N/A'); ?></strong><br>
                                    <small class="text-muted">SKU: <?php echo htmlspecialchars($product[$productSkuColumn] ?? $product['sku'] ?? 'N/A'); ?></small>
                                </td>
                                <td><?php echo htmlspecialchars($product[$productCategoryColumn] ?? $product['category'] ?? 'N/A'); ?></td>
                                <td>$<?php echo number_format($product[$productPriceColumn] ?? $product['price'] ?? 0, 2); ?></td>
                                <td>
                                    <strong class="<?php echo ($product['stock_quantity'] ?? 0) == 0 ? 'text-danger' : (($product['stock_quantity'] ?? 0) <= 10 ? 'text-warning' : 'text-success'); ?>">
                                        <?php echo ($product['stock_quantity'] ?? 0); ?>
                                    </strong>
                                </td>
                                <td>
                                    <?php if (($product['stock_quantity'] ?? 0) == 0): ?>
                                        <span class="badge bg-danger">Out of Stock</span>
                                    <?php elseif (($product['stock_quantity'] ?? 0) <= 10): ?>
                                        <span class="badge bg-warning">Low Stock</span>
                                    <?php else: ?>
                                        <span class="badge bg-success">In Stock</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#updateModal<?php echo $product[$productIdColumn] ?? $product['id'] ?? '0'; ?>">Update Stock</button>
                                </td>
                            </tr>

                            <!-- Update Stock Modal -->
                            <div class="modal fade" id="updateModal<?php echo $product[$productIdColumn] ?? $product['id'] ?? '0'; ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Update Stock - <?php echo htmlspecialchars($product[$productNameColumn] ?? $product['name'] ?? 'Product'); ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form method="POST">
                                            <div class="modal-body">
                                                <input type="hidden" name="action" value="update_stock">
                                                <input type="hidden" name="product_id" value="<?php echo $product[$productIdColumn] ?? $product['id'] ?? '0'; ?>">
                                                
                                                <div class="mb-3">
                                                    <label class="form-label">Current Stock</label>
                                                    <input type="number" class="form-control" value="<?php echo ($product['stock_quantity'] ?? 0); ?>" readonly>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">New Stock Quantity</label>
                                                    <input type="number" class="form-control" name="quantity" value="<?php echo ($product['stock_quantity'] ?? 0); ?>" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Notes/Reason for Change</label>
                                                    <textarea class="form-control" name="notes" rows="3" placeholder="e.g., Received shipment, Inventory count, etc."></textarea>
                                                </div>
                            </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Update Stock</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if (empty($products)): ?>
                    <div class="alert alert-info text-center">No products found</div>
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

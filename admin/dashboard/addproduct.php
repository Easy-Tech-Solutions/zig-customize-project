<?php
require_once('../../sql_connection/config.php');
requireRole('Admin'); // Only clients can access this page

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Validate inputs
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = floatval($_POST['price']);
        $original_price = isset($_POST['original_price']) ? floatval($_POST['original_price']) : null;
        $discount = isset($_POST['discount']) ? floatval($_POST['discount']) : null;
        $category = $_POST['category'];
        $sub_category = $_POST['sub_category'];
        $sku = $_POST['sku'];
        $stock_quantity = intval($_POST['stock_quantity']);
        $color_options = $_POST['color_options'];
        $size_options = $_POST['size_options'];
        
        // Handle file uploads
        $image_path = '';
        $thumbnail_path = '';
        
        if (isset($_FILES['product_image'])) {
            $target_dir = "../../Uploads/Products/";
            $image_name = basename($_FILES['product_image']['name']);
            $target_file = $target_dir . $image_name;
            
            // Check if image file is valid
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
            
            if (in_array($imageFileType, $allowed_types)) {
                if (move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file)) {
                    $image_path = "images/product/" . $image_name;
                    
                    // Create thumbnail (simplified - in production you'd use GD or Imagick)
                    $thumbnail_name = 'thumb_' . $image_name;
                    copy($target_file, $target_dir . $thumbnail_name);
                    $thumbnail_path = "images/product/" . $thumbnail_name;
                }
            }
        }
        
        // Insert into database using PDO
        $query = "INSERT INTO products (name, description, price, original_price, discount, category, sub_category, sku, stock_quantity, color_options, size_options, image_path, thumbnail_path) 
                  VALUES (:name, :description, :price, :original_price, :discount, :category, :sub_category, :sku, :stock_quantity, :color_options, :size_options, :image_path, :thumbnail_path)";
        
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':name' => $name,
            ':description' => $description,
            ':price' => $price,
            ':original_price' => $original_price,
            ':discount' => $discount,
            ':category' => $category,
            ':sub_category' => $sub_category,
            ':sku' => $sku,
            ':stock_quantity' => $stock_quantity,
            ':color_options' => $color_options,
            ':size_options' => $size_options,
            ':image_path' => $image_path,
            ':thumbnail_path' => $thumbnail_path
        ]);
        
        $success = "Product added successfully!";
    } catch (PDOException $e) {
        $error = "Error adding product: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../assets/images/favicon/favicon.ico" type="image/x-icon" />
    <title>Zig Customized</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/lineicons.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

    <!-- ======== sidebar-nav start =========== -->
    <?php include("../include/sidebarnav.php"); ?>
    <!-- ======== sidebar-nav end =========== -->

    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
      <!-- ========== header start ========== -->
      <?php include("../include/header.php"); ?>
      <!-- ========== header end ========== -->

    <div class="container">
        <div class="form-container">
            <h2 class="mb-4">Add New Product</h2>
            
            <?php if (isset($success)): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category" required>
                            <option value="">Select Category</option>
                            <option value="Tops">Tops</option>
                            <option value="Hardware">Hardware</option>
                            <option value="Bottoms">Bottoms</option>
                            <option value="Bags">Bags</option>
                            <option value="Accessories">Accessories</option>

                        </select>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="sub_category" class="form-label">Sub Category</label>
                        <input type="text" class="form-control" id="sub_category" name="sub_category" required>
                    </div>
                    <div class="col-md-6">
                        <label for="sku" class="form-label">SKU</label>
                        <input type="text" class="form-control" id="sku" name="sku">
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="price" class="form-label">Price ($)</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="col-md-4">
                        <label for="original_price" class="form-label">Original Price ($)</label>
                        <input type="number" step="0.01" class="form-control" id="original_price" name="original_price">
                    </div>
                    <div class="col-md-4">
                        <label for="discount" class="form-label">Discount (%)</label>
                        <input type="number" step="0.01" class="form-control" id="discount" name="discount">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="stock_quantity" class="form-label">Stock Quantity</label>
                        <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" required>
                    </div>
                    <div class="col-md-6">
                        <label for="product_image" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="product_image" name="product_image" required accept="image/*">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="color_options" class="form-label">Available Colors (comma separated)</label>
                        <input type="text" class="form-control" id="color_options" name="color_options" placeholder="e.g., Red, Blue, Green">
                    </div>
                    <div class="col-md-6">
                        <label for="size_options" class="form-label">Available Sizes (comma separated)</label>
                        <input type="text" class="form-control" id="size_options" name="size_options" placeholder="e.g., S, M, L, XL">
                    </div>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Add Product</button>
                    <a href="dashboard.php" name="addproduct" value="addproduct" class="btn btn-secondary">Back to Dashboard</a>
                </div>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
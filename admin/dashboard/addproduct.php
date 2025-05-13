<?php
require_once('../../sql_connection/config.php');
requireRole('Admin'); // Only admins can access this page

// Initialize variables
$success = $error = '';
$productData = [
    'name' => '',
    'description' => '',
    'price' => '',
    'original_price' => '',
    'discount' => '',
    'category' => '',
    'sub_category' => '',
    'sku' => '',
    'stock_quantity' => '',
    'color_options' => '',
    'size_options' => ''
];

// Fetch categories and subcategories
try {
    $stmt = $pdo->query("SELECT * FROM productcategory");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $stmt = $pdo->query("SELECT * FROM productsubcategory");
    $subcategories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching categories: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Validate required fields
        $required = ['name', 'description', 'price', 'category', 'sub_category', 'stock_quantity'];
        foreach ($required as $field) {
            if (empty($_POST[$field])) {
                throw new Exception("Required field '$field' is missing");
            }
        }

        // Check if at least one image was uploaded
        if (empty($_FILES['product_images']['name'][0])) {
            throw new Exception("At least one product image is required");
        }

        // Sanitize and validate inputs
        $productData['name'] = trim($_POST['name']);
        $productData['description'] = trim($_POST['description']);
        $productData['price'] = floatval($_POST['price']);
        $productData['original_price'] = !empty($_POST['original_price']) ? floatval($_POST['original_price']) : null;
        $productData['discount'] = !empty($_POST['discount']) ? floatval($_POST['discount']) : null;
        $productData['category'] = trim($_POST['category']);
        $productData['sub_category'] = trim($_POST['sub_category']);
        $productData['sku'] = !empty($_POST['sku']) ? trim($_POST['sku']) : null;
        $productData['stock_quantity'] = intval($_POST['stock_quantity']);
        $productData['color_options'] = !empty($_POST['color_options']) ? trim($_POST['color_options']) : null;
        $productData['size_options'] = !empty($_POST['size_options']) ? trim($_POST['size_options']) : null;
        
        // Generate tag from category (lowercase, no spaces)
        $tag = strtolower(str_replace(' ', '', $productData['category']));
        $tag = preg_replace('/[^a-z0-9]/', '', $tag);

        // Handle file uploads
        $image_paths = [];
        $thumbnail_paths = [];
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        $target_dir = "../../Uploads/Products/";
        
        // Process each uploaded file
        foreach ($_FILES['product_images']['tmp_name'] as $key => $tmp_name) {
            if ($_FILES['product_images']['error'][$key] !== UPLOAD_ERR_OK) {
                continue; // Skip files with upload errors
            }
            
            $original_name = basename($_FILES['product_images']['name'][$key]);
            $image_name = uniqid() . '_' . $original_name;
            $target_file = $target_dir . $image_name;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            
            // Validate image type
            if (!in_array($imageFileType, $allowed_types)) {
                continue; // Skip invalid file types
            }
            
            if (move_uploaded_file($tmp_name, $target_file)) {
                $image_paths[] = "../../Uploads/Products/" . $image_name;
                
                // Create thumbnail (simplified - consider using GD/Imagick in production)
                $thumbnail_name = 'thumb_' . $image_name;
                if (copy($target_file, $target_dir . $thumbnail_name)) {
                    $thumbnail_paths[] = "../../Uploads/Products/" . $thumbnail_name;
                }
            }
            
            // Limit to 7 images
            if (count($image_paths) >= 7) {
                break;
            }
        }
        
        // Ensure at least one image was uploaded successfully
        if (empty($image_paths)) {
            throw new Exception("At least one valid image is required");
        }

        // Convert arrays to comma-separated strings for database storage
        $image_paths_str = implode(',', $image_paths);
        $thumbnail_paths_str = implode(',', $thumbnail_paths);

        // Insert into database
        $query = "INSERT INTO products (
            name, description, price, original_price, discount, 
            category, sub_category, tag, sku, stock_quantity, 
            color_options, size_options, image_path, thumbnail_path
        ) VALUES (
            :name, :description, :price, :original_price, :discount, 
            :category, :sub_category, :tag, :sku, :stock_quantity, 
            :color_options, :size_options, :image_path, :thumbnail_path
        )";
        
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':name' => $productData['name'],
            ':description' => $productData['description'],
            ':price' => $productData['price'],
            ':original_price' => $productData['original_price'],
            ':discount' => $productData['discount'],
            ':category' => $productData['category'],
            ':sub_category' => $productData['sub_category'],
            ':tag' => $tag,
            ':sku' => $productData['sku'],
            ':stock_quantity' => $productData['stock_quantity'],
            ':color_options' => $productData['color_options'],
            ':size_options' => $productData['size_options'],
            ':image_path' => $image_paths_str,
            ':thumbnail_path' => $thumbnail_paths_str
        ]);
        
        $success = "Product added successfully with " . count($image_paths) . " images!";
        // Reset form data after successful submission
        $productData = array_fill_keys(array_keys($productData), '');
        
    } catch (Exception $e) {
        $error = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../assets/images/favicon/favicon.ico" type="image/x-icon" />
    <title>Add New Product | Zig Customized</title>

    <!-- CSS links -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/lineicons.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />
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
        .required-field::after {
            content: " *";
            color: red;
        }
        .image-preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }
        .image-preview {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 1px solid #ddd;
            border-radius: 4px;
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
                
                <?php if (!empty($success)): ?>
                    <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
                <?php endif; ?>
                
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label required-field">Product Name</label>
                            <input type="text" class="form-control" id="name" name="name" required 
                                   value="<?php echo htmlspecialchars($productData['name']); ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="category" class="form-label required-field">Category</label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="">Select a category</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?php echo htmlspecialchars($cat['categoryname']); ?>"
                                        <?php echo ($productData['category'] == $cat['categoryname']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($cat['categoryname']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="sub_category" class="form-label required-field">Sub Category</label>
                            <select class="form-select" id="sub_category" name="sub_category" required>
                                <option value="">Select a sub-category</option>
                                <?php foreach ($subcategories as $subcat): ?>
                                    <option value="<?php echo htmlspecialchars($subcat['subcategoryname']); ?>"
                                        <?php echo ($productData['sub_category'] == $subcat['subcategoryname']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($subcat['subcategoryname']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="sku" class="form-label">SKU</label>
                            <input type="text" class="form-control" id="sku" name="sku" 
                                   value="<?php echo htmlspecialchars($productData['sku']); ?>">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label required-field">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required><?php 
                            echo htmlspecialchars($productData['description']); 
                        ?></textarea>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="price" class="form-label required-field">Price ($)</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" required 
                                   value="<?php echo htmlspecialchars($productData['price']); ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="original_price" class="form-label">Original Price ($)</label>
                            <input type="number" step="0.01" class="form-control" id="original_price" name="original_price"
                                   value="<?php echo htmlspecialchars($productData['original_price']); ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="discount" class="form-label">Discount (%)</label>
                            <input type="number" step="0.01" class="form-control" id="discount" name="discount"
                                   value="<?php echo htmlspecialchars($productData['discount']); ?>">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="stock_quantity" class="form-label required-field">Stock Quantity</label>
                            <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" required 
                                   value="<?php echo htmlspecialchars($productData['stock_quantity']); ?>">
                        </div>
                        <div class="col-6">
                            <label for="product_images" class="form-label required-field">Product Images (1-7 images)</label>
                            <input type="file" class="form-control" id="product_images" name="product_images[]" 
                                   multiple accept="image/*" onchange="previewImages(this)">
                            <small class="text-muted">Upload Images</small>
                            <div class="image-preview-container" id="imagePreviewContainer"></div>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="color_options" class="form-label">Available Colors (comma separated)</label>
                            <input type="text" class="form-control" id="color_options" name="color_options" 
                                   placeholder="e.g., Red, Blue, Green"
                                   value="<?php echo htmlspecialchars($productData['color_options']); ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="size_options" class="form-label">Available Sizes (comma separated)</label>
                            <input type="text" class="form-control" id="size_options" name="size_options" 
                                   placeholder="e.g., S, M, L, XL"
                                   value="<?php echo htmlspecialchars($productData['size_options']); ?>">
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-info">Add Product</button>
                        <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
                    </div>
                </form>
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            function previewImages(input) {
                const previewContainer = document.getElementById('imagePreviewContainer');
                previewContainer.innerHTML = '';
                
                if (input.files && input.files.length > 0) {
                    // Limit to 7 images
                    const files = Array.from(input.files).slice(0, 7);
                    
                    files.forEach(file => {
                        if (file.type.match('image.*')) {
                            const reader = new FileReader();
                            
                            reader.onload = function(e) {
                                const img = document.createElement('img');
                                img.src = e.target.result;
                                img.className = 'image-preview';
                                previewContainer.appendChild(img);
                            }
                            
                            reader.readAsDataURL(file);
                        }
                    });
                }
            }
        </script>
    </main>
</body>
</html>
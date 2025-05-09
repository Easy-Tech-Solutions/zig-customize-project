<?php
require_once('../../sql_connection/config.php');
requireRole('Admin'); // Only clients can access this page

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Validate inputs
        $categoryname = $_POST['categoryname'];
        $description = $_POST['description'];
        $tag = $_POST['tag'];
        
        // Insert into database using PDO
        $query = "INSERT INTO productcategory (categoryname, description, tag) 
                  VALUES (:categoryname, :description, :tag,)";
        
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':categoryname' => $categoryname,
            ':description' => $description,
            ':tag' => $tag
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
            <h2 class="mb-4">Create a Product Category</h2>
            
            <?php if (isset($success)): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="categoryname" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="categoryname" name="categoryname" required>
                    </div>

                    <div class="col-md-6">
                        <label for="tag" class="form-label">Tag</label>
                        <input type="text" class="form-control" id="tag" name="tag">
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Add Product</button>
                    <a href="dashboard.php" name="addcategory" value="addcategory" class="btn btn-secondary">Back to Dashboard</a>
                </div>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
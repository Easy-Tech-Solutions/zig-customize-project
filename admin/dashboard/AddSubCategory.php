<?php
require_once('../../sql_connection/config.php');
requireRole('Admin'); // Only clients can access this page

// In your form processing code:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $subcategoryname = $_POST['subcategoryname'];
        $parentcategory = $_POST['parentcategory']; // Get from select
        $description = $_POST['description'];
        
        // Check for duplicates
        $stmt = $pdo->prepare("SELECT id FROM productsubcategory WHERE subcategoryname = ?");
        $stmt->execute([$subcategoryname]);
        
        if($stmt->fetch()) {
            $_SESSION['error'] = "Sub-category already exists!";
            header("Location: AddSubCategory.php");
            exit();
        }
        
        // First get the ID of the parent category
        $stmt = $pdo->prepare("SELECT id FROM productcategory WHERE categoryname = ?");
        $stmt->execute([$parentcategory]);
        $parent = $stmt->fetch();
        
        if (!$parent) {
            $_SESSION['error'] = "Parent category not found!";
            header("Location: AddSubCategory.php");
            exit();
        }
        
        // Then insert with the ID
        $query = "INSERT INTO productsubcategory 
                 (subcategoryname, parentcategory, parentcategory_id, description) 
                 VALUES (?, ?, ?, ?)";

$stmt = $pdo->prepare($query);
$stmt->execute([$subcategoryname, $parentcategory, $parent['id'], $description]);
        
        $_SESSION['success'] = "Sub-category added successfully!";
        header("Location: AddSubCategory.php");
        exit();
        
    } catch (PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        $_SESSION['error'] = "Error saving sub-category. Please try again.";
        header("Location: AddSubCategory.php");
        exit();
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
            <h2 class="mb-4">Create a Product Sub-Category</h2>
            
            <!-- Success Message -->
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success">
                        <?php echo htmlspecialchars($_SESSION['success']); ?>
                        <?php unset($_SESSION['success']); ?>
                    </div>
                <?php endif; ?>
                
                <!-- Error Message -->
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger">
                        <?php echo htmlspecialchars($_SESSION['error']); ?>
                        <?php unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>
            
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="subcategoryname" class="form-label">Sub-Category Name</label>
                        <input type="text" class="form-control" id="subcategoryname" name="subcategoryname" required>
                    </div>

                    <div class="col-md-6">
                        <label for="parentcategory" class="form-label">Parent Category</label>
                        <select class="form-select" id="parentcategory" name="parentcategory" required>
                            <option value="">Select Parent Category</option>
                            <?php 
                            $categories = $pdo->query("SELECT categoryname FROM productcategory")->fetchAll();
                            foreach ($categories as $category): ?>
                                <option value="<?= htmlspecialchars($category['categoryname']) ?>">
                                    <?= htmlspecialchars($category['categoryname']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-info">Add Product Sub-Category</button>
                    <a href="dashboard.php" name="addsubcategory" value="addsubcategory" class="btn btn-secondary">Back to Dashboard</a>
                </div>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
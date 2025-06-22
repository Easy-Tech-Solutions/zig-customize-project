<?php
require_once('../../sql_connection/config.php');
requireRole('Admin'); // Only admins can access this page

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../assets/images/favicon/favicon.ico" type="image/x-icon" />
    <title>Add to Exclusive Deals | Zig Customized</title>

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

        <!-- admin/add-to-special-groups.php -->
        <div class="admin-container row text-center mx-1">
            <h2>Add Products to Special Groups</h2>
            
            <div class="special-group-form col-lg-6 col-md-6 col-sm-12 mb-2">
                <h3>Add to Exclusive Deals</h3>
                <form action="handle_addproducttodeals.php" method="post">
                    <input type="hidden" name="group_type" value="exclusive_deals">
                    
                    <div class="form-group mt-1">
                        <label>Product ID:</label>
                        <input type="number" name="product_id" class="form-control" required>
                    </div>
                    
                    <div class="form-group mt-1">
                        <label>Start Date:</label>
                        <input type="datetime-local" name="start_date" class="form-control" required>
                    </div>
                    
                    <div class="form-group mt-1">
                        <label>End Date:</label>
                        <input type="datetime-local" name="end_date" class="form-control" required>
                    </div>
                    
                    <button type="submit" class="btn btn-info mt-2">Add to Exclusive Deals</button>
                </form>
            </div>
            
            <div class="special-group-form col-lg-6 col-md-6 col-sm-12">
                <h3>Add to Flash Sales</h3>
                <form action="handle_addproducttodeals.php" method="post">
                    <input type="hidden" name="group_type" value="flash_sales">
                    
                    <div class="form-group mt-1">
                        <label>Product ID:</label>
                        <input type="number" name="product_id" class="form-control" required>
                    </div>
                    
                    <div class="form-group mt-1">
                        <label>Start Date:</label>
                        <input type="datetime-local" name="start_date" class="form-control" required>
                    </div>
                    
                    <div class="form-group mt-1">
                        <label>End Date:</label>
                        <input type="datetime-local" name="end_date" class="form-control" required>
                    </div>
                    
                    <button type="submit" class="btn btn-info mt-2">Add to Flash Sales</button>
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
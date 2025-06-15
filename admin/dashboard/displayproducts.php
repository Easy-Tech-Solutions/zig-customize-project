<?php

require_once('../../sql_connection/config.php');
requireRole('Admin'); // Only clients can access this page

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../../assets/images/favicon/favicon.ico" type="image/x-icon" />
    <title>Display Products</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/lineicons.css" />
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  </head>
  <body>
    <!-- ======== Preloader =========== -->
    <div id="preloader">
      <div class="spinner"></div>
    </div>
    <!-- ======== Preloader =========== -->

    <!-- ======== sidebar-nav start =========== -->
    <?php include("../include/sidebarnav.php"); ?>
    <!-- ======== sidebar-nav end =========== -->

    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
      <!-- ========== header start ========== -->

      <!-- ========== header start ========== -->
      <?php include("../include/header.php"); ?>
      <!-- ========== header end ========== -->

  
      <!-- ========== table components start ========== -->
      <section class="table-components">
        <div class="container-fluid">

          <!-- ========== tables-wrapper start ========== -->
          <div class="tables-wrapper">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-style mb-30">
                  <button type="button" class="btn btn-info text-white"><a href="addproduct.php">Add a New Product</a></button>
                  <p class="text-sm mb-20">
                    
                  </p>
                  <div class="table-wrapper table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th class="lead-info">
                            <h6>ID</h6>
                          </th>
                          <th class="lead-email">
                            <h6>Name</h6>
                          </th>
                          <th class="lead-email">
                            <h6>Description</h6>
                          </th>
                          <th class="lead-phone">
                            <h6>Price</h6>
                          </th>
                          <th class="lead-info">
                            <h6>Original Price</h6>
                          </th>
                          <th class="lead-email">
                            <h6>Discount</h6>
                          </th>
                          <th class="lead-email">
                            <h6>Category</h6>
                          </th>
                          <th class="lead-phone">
                            <h6>Sub-Category</h6>
                          </th>
                          <th class="lead-info">
                            <h6>SKU</h6>
                          </th>
                          <th class="lead-email">
                            <h6>Stock Quantity</h6>
                          </th>
                          <th class="lead-email">
                            <h6>Color</h6>
                          </th>
                          <th class="lead-phone">
                            <h6>Size</h6>
                          </th>
                          <th class="lead-phone">
                            <h6>Created At</h6>
                          </th>
                          <th class="lead-phone">
                            <h6>Updated</h6>
                          </th>
                        </tr>
                        <!-- end table row-->
                      </thead>
                      
                         <tbody>
                             
                            <?php
                            
                            try {
                                    $productinfo = $pdo->query("SELECT * FROM products")->fetchAll();
                                } catch (PDOException $e) {
                                    die("Error fetching subcategories: " . $e->getMessage());
                                }
                                
                            foreach ($productinfo as $productinfo): ?>
                            
                            <tr>
                                <td class="min-width">
                                    <div class="lead">
                                        <div class="lead-text">
                                            <p><?= htmlspecialchars($productinfo['id']) ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="min-width">
                                    <p><a href="#0"><?= htmlspecialchars($productinfo['name']) ?></a></p>
                                </td>
                                <td class="min-width">
                                    <p><a href="#0"><?= htmlspecialchars($productinfo['description']) ?></a></p>
                                </td>
                                <td class="min-width">
                                    <p><?= htmlspecialchars($productinfo['price']) ?></p>
                                </td>
                                <td class="min-width">
                                    <p><?= htmlspecialchars($productinfo['original_price']) ?></p>
                                </td>
                                <td class="min-width">
                                    <p><a href="#0"><?= htmlspecialchars($productinfo['discount']) ?></a></p>
                                </td>
                                <td class="min-width">
                                    <p><a href="#0"><?= htmlspecialchars($productinfo['category']) ?></a></p>
                                </td>
                                <td class="min-width">
                                    <p><?= htmlspecialchars($productinfo['sub_category']) ?></p>
                                </td>
                                <td class="min-width">
                                    <p><?= htmlspecialchars($productinfo['sku']) ?></p>
                                </td>
                                <td class="min-width">
                                    <p><a href="#0"><?= htmlspecialchars($productinfo['stock_quantity']) ?></a></p>
                                </td>
                                <td class="min-width">
                                    <p><a href="#0"><?= htmlspecialchars($productinfo['color_options']) ?></a></p>
                                </td>
                                <td class="min-width">
                                    <p><?= htmlspecialchars($productinfo['size_options']) ?></p>
                                </td>
                                <td class="min-width">
                                    <p><a href="#0"><?= htmlspecialchars($productinfo['created_at']) ?></a></p>
                                </td>
                                <td class="min-width">
                                    <p><?= htmlspecialchars($productinfo['updated_at']) ?></p>
                                </td>
                                <td>
                                    <div class="action">
                                      <button class="text-danger delete-product" data-product-id="<?php echo $productinfo['id']; ?>">
                                          <i class="lni lni-trash-can"></i>
                                      </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>

                      
                    </table>
                    <!-- end table -->
                  </div>
                </div>
                <!-- end card -->
              </div>
              <!-- end col -->
            </div>
            <!-- end row -->
          </div>
          <!-- ========== tables-wrapper end ========== -->
        </div>
        <!-- end container -->
      </section>
      <!-- ========== table components end ========== -->

      <!-- ========== footer start =========== -->
      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <!-- end col-->
            <div class="col-md-6">
              <div class="terms d-flex justify-content-center justify-content-md-end">
                <a href="#0" class="text-sm">Term & Conditions</a>
                <a href="#0" class="text-sm ml-15">Privacy & Policy</a>
              </div>
            </div>
          </div>
          <!-- end row -->
        </div>
        <!-- end container -->
      </footer>
      <!-- ========== footer end =========== -->
    </main>
    <!-- ======== main-wrapper end =========== -->

    <!-- ========= All Javascript files linkup ======== -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/Chart.min.js"></script>
    <script src="assets/js/dynamic-pie-chart.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/fullcalendar.js"></script>
    <script src="assets/js/jvectormap.min.js"></script>
    <script src="assets/js/world-merc.js"></script>
    <script src="assets/js/polyfill.js"></script>
    <script src="assets/js/main.js"></script>

  </body>
</html>

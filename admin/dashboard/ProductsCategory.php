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
    <title>Product Category</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/lineicons.css" />
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
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
                  <button type="button" class="btn btn-info text-white"><a href="AddProductCategory.php">Add Category</a></button>
                  <p class="text-sm mb-20">
                    
                  </p>
                  <div class="table-wrapper table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th class="lead-info">
                            <h6>No.</h6>
                          </th>
                          <th class="lead-email">
                            <h6>Category</h6>
                          </th>
                          <th class="lead-phone">
                            <h6>Description</h6>
                          </th>
                          <th class="lead-phone">
                            <h6>Tag</h6>
                          </th>
                        </tr>
                        <!-- end table row-->
                      </thead>
                      
                         <tbody>
                            <?php
                            $categories = $pdo->query("SELECT * FROM productcategory")->fetchAll();
                            foreach ($categories as $category): ?>
                            <tr>
                                <td class="min-width">
                                    <div class="lead">
                                        <div class="lead-text">
                                            <p><?= htmlspecialchars($category['id']) ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="min-width">
                                    <p><a href="#0"><?= htmlspecialchars($category['categoryname']) ?></a></p>
                                </td>
                                <td class="min-width">
                                    <p><?= htmlspecialchars($category['description']) ?></p>
                                </td>
                                <td class="min-width">
                                    <p><?= htmlspecialchars($category['tag']) ?></p>
                                </td>
                                <td>
                                    <div class="action">
                                        <button class="text-danger">
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
            <div class="col-md-6 order-last order-md-first">
              <div class="copyright text-center text-md-start">
                <p class="text-sm">
                  Designed and Developed by
                  <a href="https://plainadmin.com" rel="nofollow" target="_blank">
                    PlainAdmin
                  </a>
                </p>
              </div>
            </div>
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

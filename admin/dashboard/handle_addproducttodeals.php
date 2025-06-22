<!-- admin/process-special-group.php -->
<?php
require_once '../../sql_connection/config.php';
require_once '../include/function_addtodeals.php'; // Our new functions

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = (int)$_POST['id'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $groupType = $_POST['group_type'];
    
    try {
        if ($groupType === 'exclusive_deals') {
            $success = addToExclusiveDeals($pdo, $productId, $startDate, $endDate);
            $message = $success ? 'Product added to Exclusive Deals!' : 'Product already in Exclusive Deals or invalid product ID';
        } elseif ($groupType === 'flash_sales') {
            $success = addToFlashSales($pdo, $productId, $startDate, $endDate);
            $message = $success ? 'Product added to Flash Sales!' : 'Product already in Flash Sales or invalid product ID';
        } else {
            throw new Exception('Invalid group type');
        }
        
        $_SESSION['flash_message'] = $message;
        header('Location: addproducttodeals.php');
        exit();
    } catch (Exception $e) {
        $_SESSION['flash_message'] = 'Error: ' . $e->getMessage();
        header('Location: addproducttodeals.php');
        exit();
    }
}
?>
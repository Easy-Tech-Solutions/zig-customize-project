<?php
session_start();
require_once '../../sql_connection/config.php';
require_once '../include/function_addtodeals.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Store form data in session in case of errors
    $_SESSION['form_data'] = $_POST;
    
    try {
        $productId = (int)$_POST['product_id'];
        $startDate = $_POST['start_date'];
        $endDate = $_POST['end_date'];
        $groupType = $_POST['group_type'];
        
        // Basic validation
        if (empty($productId)) {
            throw new Exception('Product ID is required');
        }
        
        if (empty($startDate)) {
            throw new Exception('Start date is required');
        }
        
        if (empty($endDate)) {
            throw new Exception('End date is required');
        }
        
        if (strtotime($startDate) > strtotime($endDate)) {
            throw new Exception('End date must be after start date');
        }
        
        if ($groupType === 'exclusive_deals') {
            $success = addToExclusiveDeals($pdo, $productId, $startDate, $endDate);
            if (!$success) {
                throw new Exception('Product already in Exclusive Deals or invalid product ID');
            }
            $_SESSION['flash_message'] = 'Product added to Exclusive Deals!';
            $_SESSION['flash_status'] = 'success';
        } 
        elseif ($groupType === 'flash_sales') {
            $success = addToFlashSales($pdo, $productId, $startDate, $endDate);
            if (!$success) {
                throw new Exception('Product already in Flash Sales or invalid product ID');
            }
            $_SESSION['flash_message'] = 'Product added to Flash Sales!';
            $_SESSION['flash_status'] = 'success';
        } 
        else {
            throw new Exception('Invalid group type');
        }
        
        // Clear form data on success
        unset($_SESSION['form_data']);
        
    } catch (Exception $e) {
        $_SESSION['flash_message'] = $e->getMessage();
        $_SESSION['flash_status'] = 'danger';
    }
    
    header('Location: addproducttodeals.php');
    exit();
}
?>
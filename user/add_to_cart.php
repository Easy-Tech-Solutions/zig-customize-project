<?php
include('../sql_connection/config.php');
requireLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = (int)$_POST['product_id'];
    $user_id = $_SESSION['user_id'];
    
    try {
        // Check if product exists
        $stmt = $pdo->prepare("SELECT id FROM products WHERE id = ?");
        $stmt->execute([$product_id]);
        
        if ($stmt->rowCount() > 0) {
            // Check if product already in cart
            $stmt = $pdo->prepare("SELECT id, quantity FROM cart WHERE user_id = ? AND product_id = ?");
            $stmt->execute([$user_id, $product_id]);
            
            if ($row = $stmt->fetch()) {
                // Update quantity if already in cart
                $new_quantity = $row['quantity'] + 1;
                $stmt = $pdo->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
                $stmt->execute([$new_quantity, $row['id']]);
            } else {
                // Add new item to cart
                $stmt = $pdo->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1)");
                $stmt->execute([$user_id, $product_id]);
            }
            
            header("Location: ../pages/cart.php");
            exit();
        } else {
            // Product doesn't exist
            header("Location: ../index.php?error=invalid_product");
            exit();
        }
    } catch (PDOException $e) {
        // Handle database errors
        die("Database error: " . $e->getMessage());
    }
} else {
    // Invalid request
    header("Location: ../index.php");
    exit();
}
?>
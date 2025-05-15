<?php
include('../sql_connection/config.php');
requireLogin();

if (isset($_GET['id'])) {
    $cart_id = (int)$_GET['id'];
    $user_id = $_SESSION['user_id'];
    
    try {
        // Verify the cart item belongs to the current user
        $stmt = $pdo->prepare("DELETE FROM cart WHERE id = ? AND user_id = ?");
        $stmt->execute([$cart_id, $user_id]);
        
        header("Location: ../pages/cart.php");
        exit();
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
} else {
    header("Location: ../pages/cart.php");
    exit();
}
?>
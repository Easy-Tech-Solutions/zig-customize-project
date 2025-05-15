<?php
include('../sql_connection/config.php');
requireLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    
    try {
        if (isset($_POST['update_all'])) {
            // Update all quantities
            if (isset($_POST['quantity']) && is_array($_POST['quantity'])) {
                foreach ($_POST['quantity'] as $cart_id => $quantity) {
                    $cart_id = (int)$cart_id;
                    $quantity = (int)$quantity;
                    
                    if ($quantity > 0) {
                        $stmt = $pdo->prepare("UPDATE cart SET quantity = ? WHERE id = ? AND user_id = ?");
                        $stmt->execute([$quantity, $cart_id, $user_id]);
                    }
                }
            }
        } elseif (isset($_POST['update'])) {
            // Update single item
            $cart_id = (int)key($_POST['quantity']);
            $quantity = (int)$_POST['quantity'][$cart_id];
            
            if ($quantity > 0) {
                $stmt = $pdo->prepare("UPDATE cart SET quantity = ? WHERE id = ? AND user_id = ?");
                $stmt->execute([$quantity, $cart_id, $user_id]);
            }
        }
        
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
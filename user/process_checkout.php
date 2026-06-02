<?php
session_start();
require_once(__DIR__ . '/../sql_connection/config.php');
require_once(__DIR__ . '/../admin/include/function_addtodeals.php');

// Require login
requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo->beginTransaction();

        $user_id = $_SESSION['user_id'];
        
        // Collect billing address fields
        $first_name = htmlspecialchars($_POST['first_name'] ?? '');
        $last_name = htmlspecialchars($_POST['last_name'] ?? '');
        $billing_street = htmlspecialchars($_POST['billing_street'] ?? '');
        $billing_street2 = htmlspecialchars($_POST['billing_street2'] ?? '');
        $billing_city = htmlspecialchars($_POST['billing_city'] ?? '');
        $billing_state = htmlspecialchars($_POST['billing_state'] ?? '');
        $billing_zipcode = htmlspecialchars($_POST['billing_zipcode'] ?? '');
        $country = htmlspecialchars($_POST['country'] ?? '');
        
        // Build billing address
        $billing_address = "$first_name $last_name\n$billing_street";
        if (!empty($billing_street2)) {
            $billing_address .= "\n$billing_street2";
        }
        $billing_address .= "\n$billing_city, $billing_state $billing_zipcode\n$country";
        
        // Collect shipping address fields
        $ship_different = isset($_POST['ship_different']);
        if ($ship_different) {
            $shipping_first_name = htmlspecialchars($_POST['shipping_first_name'] ?? '');
            $shipping_last_name = htmlspecialchars($_POST['shipping_last_name'] ?? '');
            $shipping_street = htmlspecialchars($_POST['shipping_street'] ?? '');
            $shipping_street2 = htmlspecialchars($_POST['shipping_street2'] ?? '');
            $shipping_city = htmlspecialchars($_POST['shipping_city'] ?? '');
            $shipping_state = htmlspecialchars($_POST['shipping_state'] ?? '');
            $shipping_zipcode = htmlspecialchars($_POST['shipping_zipcode'] ?? '');
            
            $shipping_address = "$shipping_first_name $shipping_last_name\n$shipping_street";
            if (!empty($shipping_street2)) {
                $shipping_address .= "\n$shipping_street2";
            }
            $shipping_address .= "\n$shipping_city, $shipping_state $shipping_zipcode\n$country";
        } else {
            $shipping_address = $billing_address;
        }
        
        $coupon_code = htmlspecialchars($_POST['coupon_code'] ?? '');
        $payment_method = htmlspecialchars($_POST['payment_method'] ?? 'credit_card');
        $order_notes = htmlspecialchars($_POST['order_notes'] ?? '');

        if (empty($billing_address)) {
            throw new Exception("Billing address is required");
        }

        if (empty($shipping_address) && !$ship_different) {
            throw new Exception("Shipping address is required");
        }

        // Get cart items
        $stmt = $pdo->prepare("
    SELECT 
        c.id,
        c.product_id,
        c.quantity,
        p.name AS product_name,
        p.price AS product_price
    FROM cart c
    JOIN products p ON c.product_id = p.id
    WHERE c.user_id = ?
");
        $stmt->execute([$user_id]);
        $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($cartItems)) {
            throw new Exception("Your cart is empty");
        }

        // Calculate totals
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['product_price'] * $item['quantity'];
        }

        // Apply coupon if provided
        $discount_amount = 0;
        if (!empty($coupon_code)) {
            $stmt = $pdo->prepare("
                SELECT coupon_id, discount_type, discount_value, valid_from, valid_until, max_uses, uses
                FROM coupons
                WHERE coupon_code = ? AND is_active = 1
            ");
            $stmt->execute([$coupon_code]);
            $coupon = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$coupon) {
                throw new Exception("Invalid coupon code");
            }

            // Check if coupon is still valid
            $today = date('Y-m-d');
            if ($today < $coupon['valid_from'] || $today > $coupon['valid_until']) {
                throw new Exception("Coupon has expired");
            }

            // Check max uses
            if ($coupon['max_uses'] && $coupon['uses'] >= $coupon['max_uses']) {
                throw new Exception("Coupon has reached maximum uses");
            }

            // Calculate discount
            if ($coupon['discount_type'] == 'percentage') {
                $discount_amount = ($subtotal * $coupon['discount_value']) / 100;
            } else {
                $discount_amount = $coupon['discount_value'];
            }
        }

        $shipping_cost = 5.00; // Fixed shipping cost, can be dynamic
        $final_amount = $subtotal - $discount_amount + $shipping_cost;

        // Generate order number
        $order_number = 'ORD-' . date('YmdHis') . '-' . rand(1000, 9999);

        // Create order
        $stmt = $pdo->prepare("
            INSERT INTO orders (
                user_id, order_number, total_amount, discount_amount, final_amount,
                order_status, payment_status, payment_method, billing_address,
                shipping_address, shipping_cost, coupon_code, notes
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $user_id,
            $order_number,
            $subtotal,
            $discount_amount,
            $final_amount,
            'pending',
            'pending',
            $payment_method,
            $billing_address,
            $shipping_address,
            $shipping_cost,
            $coupon_code,
            $order_notes
        ]);

        $order_id = $pdo->lastInsertId();

        // Add order items
        foreach ($cartItems as $item) {
            $stmt = $pdo->prepare("
                INSERT INTO order_items (
                    order_id, product_id, quantity, unit_price, total_price
                ) VALUES (?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $order_id,
                $item['product_id'],
                $item['quantity'],
                $item['product_price'],
                $item['product_price'] * $item['quantity']
            ]);

            // Update stock
            $stmt = $pdo->prepare("
                UPDATE products SET stock_quantity = stock_quantity - ?
                WHERE id = ?
            ");
            $stmt->execute([$item['quantity'], $item['product_id']]);

            // Record stock movement
            $stmt = $pdo->prepare("
                INSERT INTO stock_movements (product_id, movement_type, quantity, notes)
                VALUES (?, 'sale', ?, ?)
            ");
            $stmt->execute([
                $item['product_id'],
                $item['quantity'],
                'Sold via Order #' . $order_number
            ]);
        }

        // Create invoice
        $invoice_number = 'INV-' . date('YmdHis') . '-' . rand(1000, 9999);
        $stmt = $pdo->prepare("
            INSERT INTO invoices (order_id, invoice_number, invoice_status)
            VALUES (?, ?, 'draft')
        ");
        $stmt->execute([$order_id, $invoice_number]);

        // Create shipment record
        $stmt = $pdo->prepare("
            INSERT INTO shipments (order_id, status, shipping_date)
            VALUES (?, 'pending', NOW())
        ");
        $stmt->execute([$order_id]);

        // Clear cart
        $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = ?");
        $stmt->execute([$user_id]);

        // Update coupon uses if applied
        if (!empty($coupon_code)) {
            $stmt = $pdo->prepare("
                UPDATE coupons SET uses = uses + 1
                WHERE coupon_code = ?
            ");
            $stmt->execute([$coupon_code]);
        }

$payment_status = 'completed';
        $transaction_id = null;

        if ($payment_method === 'tipme') {
            $authResult = tipmeAuthenticate();
            if (!isset($authResult['status']) || $authResult['status'] !== '1') {
                throw new Exception('TipMe authentication failed: ' . ($authResult['msg'] ?? 'Unknown error'));
            }

            if (empty($authResult['auth_token'])) {
                throw new Exception('TipMe did not return an auth token');
            }

            $balanceResult = tipmeCheckBalance($authResult['auth_token']);
            if (!isset($balanceResult['status']) || $balanceResult['status'] !== '1') {
                throw new Exception('TipMe balance check failed: ' . ($balanceResult['msg'] ?? 'Unknown error'));
            }

            $transaction_id = 'TIPME-' . substr(hash('sha256', uniqid('', true)), 0, 16);
        }

        $stmt = $pdo->prepare(" 
            INSERT INTO payments (order_id, payment_amount, payment_method, payment_status, transaction_id)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([$order_id, $final_amount, $payment_method, $payment_status, $transaction_id]);

        if ($payment_status === 'completed') {
            $stmt = $pdo->prepare(" 
                UPDATE orders SET payment_status = 'completed' WHERE order_id = ?
            ");
            $stmt->execute([$order_id]);
        }

        $pdo->commit();

        // Redirect to confirmation page using a relative path from /user/process_checkout.php
        header("Location: ../pages/confirmation.php?order_id=" . $order_id);
        exit();

    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['error_message'] = $e->getMessage();
        header("Location: ../pages/checkout.php");
        exit();
    }
} else {
    header("Location: ../pages/checkout.php");
    exit();
}
?>

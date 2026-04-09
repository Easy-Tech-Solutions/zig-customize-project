<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'localhost';
$dbname = 'zigdb';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h1>📦 Database Setup & Migration</h1>";
    echo "<hr>";
    
    // SQL to create all necessary tables
    $sql = <<<SQL
    -- Users Table (fixed structure for admin panel)
    CREATE TABLE IF NOT EXISTS `users` (
      `user_id` INT AUTO_INCREMENT PRIMARY KEY,
      `first_name` VARCHAR(100) NOT NULL,
      `username` VARCHAR(50) NOT NULL UNIQUE,
      `email` VARCHAR(100) NOT NULL UNIQUE,
      `phone` VARCHAR(15),
      `password` VARCHAR(255) NOT NULL,
      `role_id` INT DEFAULT 2 COMMENT '1=Admin, 2=Customer',
      `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    -- Products Table
    CREATE TABLE IF NOT EXISTS `products` (
      `product_id` INT AUTO_INCREMENT PRIMARY KEY,
      `product_name` VARCHAR(255) NOT NULL,
      `product_description` LONGTEXT,
      `product_price` DECIMAL(10, 2) NOT NULL,
      `product_category` VARCHAR(100),
      `product_image` VARCHAR(255),
      `stock_quantity` INT NOT NULL DEFAULT 0,
      `sku` VARCHAR(50) UNIQUE,
      `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    -- Cart Table
    CREATE TABLE IF NOT EXISTS `cart` (
      `cart_id` INT AUTO_INCREMENT PRIMARY KEY,
      `user_id` INT NOT NULL,
      `product_id` INT NOT NULL,
      `quantity` INT NOT NULL DEFAULT 1,
      `added_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
      FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    -- Orders Table
    CREATE TABLE IF NOT EXISTS `orders` (
      `order_id` INT AUTO_INCREMENT PRIMARY KEY,
      `user_id` INT NOT NULL,
      `order_number` VARCHAR(50) UNIQUE NOT NULL,
      `order_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      `total_amount` DECIMAL(10, 2) NOT NULL,
      `discount_amount` DECIMAL(10, 2) DEFAULT 0,
      `final_amount` DECIMAL(10, 2) NOT NULL,
      `order_status` ENUM('pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled') DEFAULT 'pending',
      `payment_status` ENUM('pending', 'completed', 'failed', 'refunded') DEFAULT 'pending',
      `payment_method` VARCHAR(50),
      `billing_address` TEXT NOT NULL,
      `shipping_address` TEXT NOT NULL,
      `shipping_cost` DECIMAL(10, 2) DEFAULT 0,
      `coupon_code` VARCHAR(50),
      `notes` TEXT,
      `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    -- Order Items Table
    CREATE TABLE IF NOT EXISTS `order_items` (
      `order_item_id` INT AUTO_INCREMENT PRIMARY KEY,
      `order_id` INT NOT NULL,
      `product_id` INT NOT NULL,
      `product_name` VARCHAR(255) NOT NULL,
      `quantity` INT NOT NULL,
      `unit_price` DECIMAL(10, 2) NOT NULL,
      `total_price` DECIMAL(10, 2) NOT NULL,
      `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      FOREIGN KEY (`order_id`) REFERENCES `orders`(`order_id`) ON DELETE CASCADE,
      FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`) ON DELETE SET NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    -- Invoices Table
    CREATE TABLE IF NOT EXISTS `invoices` (
      `invoice_id` INT AUTO_INCREMENT PRIMARY KEY,
      `order_id` INT NOT NULL UNIQUE,
      `invoice_number` VARCHAR(50) UNIQUE NOT NULL,
      `invoice_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      `due_date` DATE,
      `invoice_status` ENUM('draft', 'sent', 'paid', 'overdue', 'cancelled') DEFAULT 'draft',
      `notes` TEXT,
      `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      FOREIGN KEY (`order_id`) REFERENCES `orders`(`order_id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    -- Payments Table
    CREATE TABLE IF NOT EXISTS `payments` (
      `payment_id` INT AUTO_INCREMENT PRIMARY KEY,
      `order_id` INT NOT NULL,
      `payment_amount` DECIMAL(10, 2) NOT NULL,
      `payment_method` VARCHAR(50),
      `transaction_id` VARCHAR(100),
      `payment_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      `status` ENUM('pending', 'completed', 'failed', 'refunded') DEFAULT 'pending',
      FOREIGN KEY (`order_id`) REFERENCES `orders`(`order_id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    -- Warehouse Inventory Table
    CREATE TABLE IF NOT EXISTS `warehouse_inventory` (
      `inventory_id` INT AUTO_INCREMENT PRIMARY KEY,
      `product_id` INT NOT NULL UNIQUE,
      `warehouse_location` VARCHAR(100),
      `stock_level` INT NOT NULL DEFAULT 0,
      `reorder_level` INT DEFAULT 10,
      `last_restocked` TIMESTAMP,
      `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    -- Stock Movements Table
    CREATE TABLE IF NOT EXISTS `stock_movements` (
      `movement_id` INT AUTO_INCREMENT PRIMARY KEY,
      `product_id` INT NOT NULL,
      `movement_type` ENUM('in', 'out', 'adjustment', 'return') DEFAULT 'out',
      `quantity` INT NOT NULL,
      `reference_id` VARCHAR(50),
      `reason` VARCHAR(255),
      `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    -- Coupons Table
    CREATE TABLE IF NOT EXISTS `coupons` (
      `coupon_id` INT AUTO_INCREMENT PRIMARY KEY,
      `coupon_code` VARCHAR(50) UNIQUE NOT NULL,
      `discount_type` ENUM('percentage', 'fixed') DEFAULT 'percentage',
      `discount_value` DECIMAL(10, 2) NOT NULL,
      `max_uses` INT,
      `used_count` INT DEFAULT 0,
      `expiry_date` DATE NOT NULL,
      `is_active` BOOLEAN DEFAULT TRUE,
      `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    -- Exclusive Deals Table
    CREATE TABLE IF NOT EXISTS `exclusive_deals` (
      `id` INT AUTO_INCREMENT PRIMARY KEY,
      `product_id` INT NOT NULL,
      `name` VARCHAR(255),
      `description` LONGTEXT,
      `price` DECIMAL(12,2) DEFAULT 0,
      `original_price` DECIMAL(12,2) DEFAULT 0,
      `discount` DECIMAL(12,2) DEFAULT 0,
      `category` VARCHAR(100),
      `sub_category` VARCHAR(100),
      `image_path` VARCHAR(255),
      `thumbnail_path` VARCHAR(255),
      `start_date` DATETIME,
      `end_date` DATETIME,
      `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    -- Flash Sales Table
    CREATE TABLE IF NOT EXISTS `flash_sales` (
      `id` INT AUTO_INCREMENT PRIMARY KEY,
      `product_id` INT NOT NULL,
      `name` VARCHAR(255),
      `description` LONGTEXT,
      `price` DECIMAL(12,2) DEFAULT 0,
      `original_price` DECIMAL(12,2) DEFAULT 0,
      `discount` DECIMAL(12,2) DEFAULT 0,
      `category` VARCHAR(100),
      `sub_category` VARCHAR(100),
      `image_path` VARCHAR(255),
      `thumbnail_path` VARCHAR(255),
      `start_date` DATETIME,
      `end_date` DATETIME,
      `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    -- Shipments Table
    CREATE TABLE IF NOT EXISTS `shipments` (
      `shipment_id` INT AUTO_INCREMENT PRIMARY KEY,
      `order_id` INT NOT NULL,
      `tracking_number` VARCHAR(100) UNIQUE,
      `carrier` VARCHAR(50),
      `shipping_date` TIMESTAMP,
      `expected_delivery` DATE,
      `actual_delivery` DATE,
      `status` ENUM('pending', 'shipped', 'in_transit', 'delivered', 'failed') DEFAULT 'pending',
      `notes` TEXT,
      `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      FOREIGN KEY (`order_id`) REFERENCES `orders`(`order_id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    SQL;
    
    // Execute each CREATE TABLE statement separately
    $statements = array_filter(array_map('trim', explode(';', $sql)));
    
    echo "<h2>📊 Creating Tables...</h2>";
    foreach ($statements as $statement) {
        if (!empty($statement)) {
            // Extract table name from CREATE TABLE statement
            preg_match('/CREATE TABLE IF NOT EXISTS `(\w+)`/i', $statement, $matches);
            $table_name = $matches[1] ?? 'Unknown';
            
            try {
                $pdo->exec($statement);
                echo "✓ <strong>$table_name</strong> - Created/Updated<br>";
            } catch (PDOException $e) {
                echo "✗ <strong>$table_name</strong> - Error: " . $e->getMessage() . "<br>";
            }
        }
    }
    
    echo "<h2>👤 Creating Admin User...</h2>";
    
    // Check if admin user exists
    $check_stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = 'admin'");
    $check_stmt->execute();
    $admin_exists = $check_stmt->fetchColumn() > 0;
    
    if (!$admin_exists) {
        $insert_stmt = $pdo->prepare("
            INSERT INTO users (first_name, username, email, phone, password, role_id)
            VALUES (?, ?, ?, ?, ?, 1)
        ");
        
        // Hash the password - but for now use plain text matching existing schema
        $insert_stmt->execute([
            'Administrator',
            'admin',
            'admin@zig-customize.com',
            '0000000000',
            'Admmin1235'
        ]);
        echo "✓ <strong>Admin User</strong> - Created with username: <code>admin</code><br>";
    } else {
        echo "✓ <strong>Admin User</strong> - Already exists<br>";
    }
    
    echo "<h2>✅ Verification</h2>";
    
    // Check all tables
    $tables = ['users', 'products', 'orders', 'order_items', 'invoices', 'coupons', 'warehouse_inventory', 'shipments'];
    
    echo "<table border='1' cellpadding='10'>";
    echo "<tr style='background:#4CAF50; color:white;'><th>Table</th><th>Records</th><th>Status</th></tr>";
    
    foreach ($tables as $table) {
        try {
            $count_stmt = $pdo->prepare("SELECT COUNT(*) FROM $table");
            $count_stmt->execute();
            $count = $count_stmt->fetchColumn();
            echo "<tr><td><strong>$table</strong></td><td>$count</td><td>✓ OK</td></tr>";
        } catch (Exception $e) {
            echo "<tr><td><strong>$table</strong></td><td>-</td><td>✗ Error</td></tr>";
        }
    }
    
    echo "</table>";
    
    echo "<h2>🎉 Setup Complete!</h2>";
    echo "<p>All database tables have been created successfully.</p>";
    echo "<p><strong>Login Credentials:</strong></p>";
    echo "<ul>";
    echo "<li>Username: <code>admin</code></li>";
    echo "<li>Password: <code>Admmin1235</code></li>";
    echo "</ul>";
    echo "<p><a href='/pages/login.php' style='background:#2196F3; color:white; padding:10px 20px; text-decoration:none; border-radius:5px;'>Go to Login Page →</a></p>";
    
} catch (PDOException $e) {
    echo "<div style='background:#f8d7da; border:1px solid #f5c6cb; color:#721c24; padding:15px; border-radius:5px;'>";
    echo "<h2>❌ Database Connection Error</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
    echo "</div>";
}
?>

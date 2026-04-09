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
    
    echo "<h1>Creating Missing Tables</h1>";
    echo "<hr>";
    
    // Disable foreign key checks temporarily
    $pdo->exec("SET FOREIGN_KEY_CHECKS=0");
    
    // Create users table first (foundational)
    $pdo->exec("
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
    ");
    echo "✓ users table ensured<br>";
    
    // Create products table first (if not exists)
    $pdo->exec("
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
    ");
    echo "✓ products table ensured<br>";
    
    // Create orders table first (if not exists) - needed for foreign keys
    $pdo->exec("
    CREATE TABLE IF NOT EXISTS `orders` (
      `order_id` INT AUTO_INCREMENT PRIMARY KEY,
      `user_id` INT NOT NULL,
      `order_number` VARCHAR(50) NOT NULL UNIQUE,
      `order_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `final_amount` DECIMAL(10, 2) NOT NULL,
      `order_status` VARCHAR(50) DEFAULT 'pending',
      `payment_status` VARCHAR(50) DEFAULT 'pending',
      `shipping_address` TEXT,
      `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");
    echo "✓ orders table ensured<br>";
    
    // Create warehouse_inventory table
    $pdo->exec("
    CREATE TABLE IF NOT EXISTS `warehouse_inventory` (
      `inventory_id` INT AUTO_INCREMENT PRIMARY KEY,
      `product_id` INT NOT NULL,
      `warehouse_location` VARCHAR(100),
      `quantity_available` INT DEFAULT 0,
      `quantity_reserved` INT DEFAULT 0,
      `reorder_level` INT DEFAULT 10,
      `last_updated` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");
    echo "✓ warehouse_inventory table created<br>";
    
    // Create stock_movements table
    $pdo->exec("
    CREATE TABLE IF NOT EXISTS `stock_movements` (
      `movement_id` INT AUTO_INCREMENT PRIMARY KEY,
      `product_id` INT NOT NULL,
      `movement_type` ENUM('in', 'out', 'adjustment'),
      `quantity` INT NOT NULL,
      `notes` TEXT,
      `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");
    echo "✓ stock_movements table created<br>";
    
    // Create shipments table
    $pdo->exec("
    CREATE TABLE IF NOT EXISTS `shipments` (
      `shipment_id` INT AUTO_INCREMENT PRIMARY KEY,
      `order_id` INT NOT NULL,
      `tracking_number` VARCHAR(100),
      `carrier` VARCHAR(100),
      `shipped_date` DATETIME,
      `delivered_date` DATETIME,
      `status` VARCHAR(50) DEFAULT 'pending',
      `notes` TEXT,
      `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");
    echo "✓ shipments table created<br>";
    
    // Create payments table
    $pdo->exec("
    CREATE TABLE IF NOT EXISTS `payments` (
      `payment_id` INT AUTO_INCREMENT PRIMARY KEY,
      `order_id` INT NOT NULL,
      `amount` DECIMAL(10, 2) NOT NULL,
      `payment_method` VARCHAR(100),
      `transaction_id` VARCHAR(100),
      `status` VARCHAR(50) DEFAULT 'pending',
      `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");
    echo "✓ payments table created<br>";
    
    // Create order_items table
    $pdo->exec("
    CREATE TABLE IF NOT EXISTS `order_items` (
      `order_item_id` INT AUTO_INCREMENT PRIMARY KEY,
      `order_id` INT NOT NULL,
      `product_id` INT NOT NULL,
      `quantity` INT NOT NULL,
      `unit_price` DECIMAL(10, 2) NOT NULL,
      `total_price` DECIMAL(10, 2) NOT NULL,
      `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");
    echo "✓ order_items table created<br>";
    
    // Create invoices table
    $pdo->exec("
    CREATE TABLE IF NOT EXISTS `invoices` (
      `invoice_id` INT AUTO_INCREMENT PRIMARY KEY,
      `order_id` INT NOT NULL,
      `invoice_number` VARCHAR(50) NOT NULL UNIQUE,
      `invoice_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `due_date` DATETIME,
      `total_amount` DECIMAL(10, 2) NOT NULL,
      `tax_amount` DECIMAL(10, 2) DEFAULT 0,
      `status` VARCHAR(50) DEFAULT 'pending',
      `notes` TEXT,
      `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");
    echo "✓ invoices table created<br>";
    
    // Create stock_movements table
    $pdo->exec("
    CREATE TABLE IF NOT EXISTS `stock_movements` (
      `movement_id` INT AUTO_INCREMENT PRIMARY KEY,
      `product_id` INT NOT NULL,
      `movement_type` ENUM('in', 'out', 'adjustment'),
      `quantity` INT NOT NULL,
      `notes` TEXT,
      `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");
    echo "✓ stock_movements table created<br>";
    
    // Create shipments table
    $pdo->exec("
    CREATE TABLE IF NOT EXISTS `shipments` (
      `shipment_id` INT AUTO_INCREMENT PRIMARY KEY,
      `order_id` INT NOT NULL,
      `tracking_number` VARCHAR(100),
      `carrier` VARCHAR(100),
      `shipped_date` DATETIME,
      `delivered_date` DATETIME,
      `status` VARCHAR(50) DEFAULT 'pending',
      `notes` TEXT,
      `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");
    echo "✓ shipments table created<br>";
    
    // Create payments table
    $pdo->exec("
    CREATE TABLE IF NOT EXISTS `payments` (
      `payment_id` INT AUTO_INCREMENT PRIMARY KEY,
      `order_id` INT NOT NULL,
      `amount` DECIMAL(10, 2) NOT NULL,
      `payment_method` VARCHAR(100),
      `transaction_id` VARCHAR(100),
      `status` VARCHAR(50) DEFAULT 'pending',
      `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");
    echo "✓ payments table created<br>";
    
    // Create coupons table if not exists
    $pdo->exec("
    CREATE TABLE IF NOT EXISTS `coupons` (
      `coupon_id` INT AUTO_INCREMENT PRIMARY KEY,
      `coupon_code` VARCHAR(50) NOT NULL UNIQUE,
      `description` TEXT,
      `discount_type` ENUM('percentage', 'fixed') DEFAULT 'percentage',
      `discount_value` DECIMAL(10, 2) NOT NULL,
      `usage_limit` INT,
      `usage_count` INT DEFAULT 0,
      `valid_from` DATETIME,
      `valid_until` DATETIME,
      `status` VARCHAR(20) DEFAULT 'active',
      `is_active` BOOLEAN DEFAULT TRUE,
      `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");
    echo "✓ coupons table created<br>";
    
    // Create exclusive_deals table
    $pdo->exec("
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
      `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");
    echo "✓ exclusive_deals table created<br>";

    // Create flash_sales table
    $pdo->exec("
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
      `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");
    echo "✓ flash_sales table created<br>";

    // Create cart table
    $pdo->exec("
    CREATE TABLE IF NOT EXISTS `cart` (
      `cart_id` INT AUTO_INCREMENT PRIMARY KEY,
      `user_id` INT NOT NULL,
      `product_id` INT NOT NULL,
      `quantity` INT DEFAULT 1,
      `added_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");
    echo "✓ cart table created<br>";
    
    // Create admin user if not exists
    $admin_check = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = 'admin'");
    $admin_check->execute();
    if ($admin_check->fetchColumn() == 0) {
        $admin_password = password_hash('Admmin1235', PASSWORD_DEFAULT);
        $insert_admin = $pdo->prepare("
            INSERT INTO users (first_name, username, email, phone, password, role_id)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $insert_admin->execute(['Admin', 'admin', 'admin@dashboard.local', '0000000000', $admin_password, 1]);
        echo "✓ Admin user created (username: admin, password: Admmin1235)<br>";
    } else {
        echo "✓ Admin user already exists<br>";
    }
    
    // Re-enable foreign key checks
    $pdo->exec("SET FOREIGN_KEY_CHECKS=1");
    
    // Verify all critical tables exist
    echo "<hr>";
    echo "<h3>Verifying All Tables</h3>";
    
    $result = $pdo->query("SHOW TABLES IN zigdb");
    $tables = $result->fetchAll(PDO::FETCH_COLUMN);
    
    $required_tables = ['users', 'products', 'orders', 'order_items', 'invoices', 'cart', 
                        'warehouse_inventory', 'stock_movements', 'shipments', 'payments', 'coupons'];
    
    foreach ($required_tables as $table) {
        if (in_array($table, $tables)) {
            echo "✓ <strong>$table</strong> exists<br>";
        } else {
            echo "✗ <strong style='color:red'>$table</strong> MISSING<br>";
        }
    }
    
    echo "<hr>";
    echo "<h2 style='color:green'>✓ Database Setup Complete!</h2>";
    echo "<p>You can now use the admin panel. <a href='index.php'>Go to Admin Dashboard</a></p>";
    
} catch (PDOException $e) {
    echo "<h2 style='color:red'>✗ Error: " . $e->getMessage() . "</h2>";
}
?>

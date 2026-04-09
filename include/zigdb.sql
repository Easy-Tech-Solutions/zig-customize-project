-- Users Table
CREATE TABLE `user` (
  `ID` INT AUTO_INCREMENT PRIMARY KEY,
  `customer_name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL UNIQUE,
  `customer_mail` varchar(100) NOT NULL UNIQUE,
  `customer_phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` TEXT,
  `city` varchar(50),
  `state` varchar(50),
  `zipcode` varchar(10),
  `country` varchar(50),
  `role` ENUM('customer', 'admin') DEFAULT 'customer',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Products Table
CREATE TABLE `products` (
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
CREATE TABLE `cart` (
  `cart_id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  `quantity` INT NOT NULL DEFAULT 1,
  `added_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `user`(`ID`) ON DELETE CASCADE,
  FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Orders Table
CREATE TABLE `orders` (
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
  FOREIGN KEY (`user_id`) REFERENCES `user`(`ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Order Items Table
CREATE TABLE `order_items` (
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
CREATE TABLE `invoices` (
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
CREATE TABLE `payments` (
  `payment_id` INT AUTO_INCREMENT PRIMARY KEY,
  `order_id` INT NOT NULL,
  `payment_amount` DECIMAL(10, 2) NOT NULL,
  `payment_method` VARCHAR(50),
  `transaction_id` VARCHAR(100),
  `payment_status` ENUM('pending', 'completed', 'failed', 'refunded') DEFAULT 'pending',
  `payment_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`order_id`) REFERENCES `orders`(`order_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Warehouse/Inventory Table
CREATE TABLE `warehouse_inventory` (
  `inventory_id` INT AUTO_INCREMENT PRIMARY KEY,
  `product_id` INT NOT NULL UNIQUE,
  `warehouse_location` VARCHAR(100),
  `stock_quantity` INT NOT NULL DEFAULT 0,
  `reorder_level` INT DEFAULT 10,
  `last_restocked` TIMESTAMP,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Stock Movements Table (for audit trail)
CREATE TABLE `stock_movements` (
  `movement_id` INT AUTO_INCREMENT PRIMARY KEY,
  `product_id` INT NOT NULL,
  `movement_type` ENUM('purchase', 'sale', 'return', 'adjustment') NOT NULL,
  `quantity` INT NOT NULL,
  `reference_id` INT,
  `notes` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Coupons Table
CREATE TABLE `coupons` (
  `coupon_id` INT AUTO_INCREMENT PRIMARY KEY,
  `coupon_code` VARCHAR(50) UNIQUE NOT NULL,
  `discount_type` ENUM('percentage', 'fixed') DEFAULT 'percentage',
  `discount_value` DECIMAL(10, 2) NOT NULL,
  `max_uses` INT,
  `uses` INT DEFAULT 0,
  `valid_from` DATE NOT NULL,
  `valid_until` DATE NOT NULL,
  `is_active` BOOLEAN DEFAULT TRUE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Shipments Table
CREATE TABLE `shipments` (
  `shipment_id` INT AUTO_INCREMENT PRIMARY KEY,
  `order_id` INT NOT NULL,
  `tracking_number` VARCHAR(100),
  `carrier` VARCHAR(50),
  `shipment_status` ENUM('pending', 'in_transit', 'delivered', 'returned') DEFAULT 'pending',
  `shipped_date` TIMESTAMP,
  `estimated_delivery` DATE,
  `actual_delivery` DATE,
  `shipping_address` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`order_id`) REFERENCES `orders`(`order_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
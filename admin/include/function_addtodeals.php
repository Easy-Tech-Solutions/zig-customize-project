<?php
// Function to add product to exclusive deals
function addToExclusiveDeals($pdo, $productId, $startDate, $endDate) {
    // Get product data
    $product = getProductById($pdo, $productId);
    
    if (!$product) {
        return false;
    }
    
    // Check if product already exists in exclusive deals
    $stmt = $pdo->prepare("SELECT id FROM exclusive_deals WHERE product_id = ?");
    $stmt->execute([$productId]);
    
    if ($stmt->rowCount() > 0) {
        return false; // Product already in exclusive deals
    }
    
    // Insert into exclusive deals
    $stmt = $pdo->prepare("
        INSERT INTO exclusive_deals (
            product_id, name, description, price, original_price, discount,
            category, sub_category, image_path, thumbnail_path, start_date, end_date
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    
    return $stmt->execute([
        $productId,
        $product['name'],
        $product['description'],
        $product['price'],
        $product['original_price'],
        $product['discount'],
        $product['category'],
        $product['sub_category'],
        $product['image_path'],
        $product['thumbnail_path'],
        $startDate,
        $endDate
    ]);
}

// Function to add product to flash sales
function addToFlashSales($pdo, $productId, $startDate, $endDate) {
    // Get product data
    $product = getProductById($pdo, $productId);
    
    if (!$product) {
        return false;
    }
    
    // Check if product already exists in flash sales
    $stmt = $pdo->prepare("SELECT id FROM flash_sales WHERE product_id = ?");
    $stmt->execute([$productId]);
    
    if ($stmt->rowCount() > 0) {
        return false; // Product already in flash sales
    }
    
    // Insert into flash sales
    $stmt = $pdo->prepare("
        INSERT INTO flash_sales (
            product_id, name, description, price, original_price, discount,
            category, sub_category, image_path, thumbnail_path, start_date, end_date
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    
    return $stmt->execute([
        $productId,
        $product['name'],
        $product['description'],
        $product['price'],
        $product['original_price'],
        $product['discount'],
        $product['category'],
        $product['sub_category'],
        $product['image_path'],
        $product['thumbnail_path'],
        $startDate,
        $endDate
    ]);
}

// Helper function to get product by ID
function getProductById($pdo, $productId) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$productId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
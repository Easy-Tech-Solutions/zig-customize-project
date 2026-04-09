<?php
require_once(__DIR__ . '/sql_connection/config.php');

echo "<h1>Coupons Table Structure Check</h1>";
echo "<hr>";

try {
    // Check coupons table structure
    $result = $pdo->query("DESCRIBE coupons");
    $columns = $result->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h2>Coupons Table Columns:</h2>";
    echo "<pre>";
    foreach ($columns as $col) {
        echo "- " . $col['Field'] . " (" . $col['Type'] . ")\n";
    }
    echo "</pre>";
    
    // Show a sample row
    echo "<h2>Sample Coupon Data:</h2>";
    $stmt = $pdo->query("SELECT * FROM coupons LIMIT 1");
    $sample = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<pre>";
    print_r($sample);
    echo "</pre>";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
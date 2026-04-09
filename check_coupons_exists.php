<?php
require_once(__DIR__ . '/sql_connection/config.php');

echo "<h1>Database Tables Check</h1>";
echo "<hr>";

try {
    // Check if coupons table exists
    $result = $pdo->query("SHOW TABLES LIKE 'coupons'");
    $exists = $result->fetchColumn();
    
    if ($exists) {
        echo "<h2 style='color:green'>✓ Coupons table exists</h2>";
        
        // Check columns
        $result = $pdo->query("DESCRIBE coupons");
        $columns = $result->fetchAll(PDO::FETCH_ASSOC);
        
        echo "<h3>Columns:</h3>";
        echo "<ul>";
        foreach ($columns as $col) {
            echo "<li><strong>" . $col['Field'] . "</strong> (" . $col['Type'] . ")</li>";
        }
        echo "</ul>";
        
        // Check if valid_until column exists
        $has_valid_until = false;
        foreach ($columns as $col) {
            if ($col['Field'] === 'valid_until') {
                $has_valid_until = true;
                break;
            }
        }
        
        if ($has_valid_until) {
            echo "<h3 style='color:green'>✓ valid_until column exists</h3>";
        } else {
            echo "<h3 style='color:red'>✗ valid_until column missing</h3>";
        }
        
    } else {
        echo "<h2 style='color:red'>✗ Coupons table does not exist</h2>";
    }
    
} catch (Exception $e) {
    echo "<h2 style='color:red'>Error: " . $e->getMessage() . "</h2>";
}
?>
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
    
    echo "<h2>Users Table Structure</h2>";
    $result = $pdo->query("DESCRIBE users");
    $columns = $result->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>Column</th><th>Type</th><th>Primary Key</th></tr>";
    foreach ($columns as $col) {
        $isPK = ($col['Key'] === 'PRI') ? '✓ YES' : 'NO';
        echo "<tr><td><strong>{$col['Field']}</strong></td><td>{$col['Type']}</td><td>$isPK</td></tr>";
    }
    echo "</table>";
    
    echo "<h2>Admin User Data</h2>";
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = 'admin'");
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($admin) {
        echo "<pre>";
        print_r($admin);
        echo "</pre>";
    } else {
        echo "No admin user found!";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

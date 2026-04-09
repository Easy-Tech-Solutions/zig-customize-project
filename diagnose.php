<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$host = 'localhost';
$dbname = 'zigdb';
$username = 'root';
$password = '';

echo "<h2>Database Diagnostic Report</h2>";

// 1. Check connection
echo "<h3>1. Database Connection</h3>";
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✓ Connected successfully to $dbname<br>";
} catch (PDOException $e) {
    echo "✗ Connection failed: " . $e->getMessage() . "<br>";
    exit;
}

// 2. Check if users table exists
echo "<h3>2. Check Users Table</h3>";
try {
    $stmt = $pdo->prepare("DESCRIBE users");
    $stmt->execute();
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($columns)) {
        echo "✓ Users table exists<br>";
        echo "<table border='1' cellpadding='5'>";
        echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th></tr>";
        foreach ($columns as $col) {
            echo "<tr><td>{$col['Field']}</td><td>{$col['Type']}</td><td>{$col['Null']}</td><td>{$col['Key']}</td></tr>";
        }
        echo "</table>";
    }
} catch (PDOException $e) {
    echo "✗ Users table does not exist: " . $e->getMessage() . "<br>";
}

// 3. Check admin user
echo "<h3>3. Check for Admin User</h3>";
try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = 'admin'");
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($admin) {
        echo "✓ Admin user found:<br>";
        echo "<pre>";
        print_r($admin);
        echo "</pre>";
    } else {
        echo "✗ No admin user found<br>";
    }
} catch (PDOException $e) {
    echo "✗ Query failed: " . $e->getMessage() . "<br>";
}

// 4. Count all users
echo "<h3>4. Count All Users</h3>";
try {
    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM users");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Total users: " . $result['count'] . "<br>";
} catch (PDOException $e) {
    echo "✗ Query failed: " . $e->getMessage() . "<br>";
}

// 5. List all users
echo "<h3>5. All Users in Database</h3>";
try {
    $stmt = $pdo->prepare("SELECT * FROM users LIMIT 10");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($users)) {
        echo "<table border='1' cellpadding='5'>";
        echo "<tr>";
        foreach (array_keys($users[0]) as $key) {
            echo "<th>$key</th>";
        }
        echo "</tr>";
        foreach ($users as $user) {
            echo "<tr>";
            foreach ($user as $value) {
                echo "<td>" . htmlspecialchars($value) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No users found<br>";
    }
} catch (PDOException $e) {
    echo "✗ Query failed: " . $e->getMessage() . "<br>";
}
?>

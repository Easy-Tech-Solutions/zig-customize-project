<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$host = 'localhost';
$dbname = 'zigdb';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Step 1: Show users table structure
echo "<h2>Users Table Structure</h2>";
try {
    $stmt = $pdo->prepare("DESCRIBE users");
    $stmt->execute();
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<table border='1' cellpadding='8'>";
    echo "<tr><th>Column Name</th><th>Type</th></tr>";
    foreach ($columns as $col) {
        echo "<tr><td>{$col['Field']}</td><td>{$col['Type']}</td></tr>";
    }
    echo "</table>";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Step 2: Delete any existing admin user
echo "<h2>Cleanup Existing Admin User</h2>";
try {
    $stmt = $pdo->prepare("DELETE FROM users WHERE username = 'admin'");
    $stmt->execute();
    echo "✓ Deleted any existing admin user<br>";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Step 3: Create new admin user
echo "<h2>Creating New Admin User</h2>";
try {
    $stmt = $pdo->prepare("
        INSERT INTO users (first_name, username, email, phone, password, role_id) 
        VALUES (?, ?, ?, ?, ?, 1)
    ");
    
    $result = $stmt->execute([
        'Administrator',
        'admin',
        'admin@zig-customize.com',
        '0000000000',
        'Admmin1235'
    ]);
    
    if ($result) {
        echo "✓ Admin user created successfully!<br>";
    } else {
        echo "✗ Failed to create admin user";
    }
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage();
}

// Step 4: Verify the admin user was created
echo "<h2>Verification</h2>";
try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = 'admin'");
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($admin) {
        echo "✓ Admin user found:<br>";
        echo "<pre>";
        print_r($admin);
        echo "</pre>";
        echo "<br><strong>Login Credentials:</strong><br>";
        echo "Username: <strong>admin</strong><br>";
        echo "Password: <strong>Admmin1235</strong><br>";
        echo "<br><a href='./pages/login.php' style='font-size: 18px; padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px;'>📝 Go to Login Page</a>";
    } else {
        echo "✗ Admin user was not created!";
    }
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage();
}
?>

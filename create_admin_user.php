<?php
require_once(__DIR__ . '/sql_connection/config.php');

// Remove any existing admin user with same username
$stmt = $pdo->prepare("DELETE FROM users WHERE username = 'admin'");
$stmt->execute();

// Create new admin user
try {
    $stmt = $pdo->prepare("
        INSERT INTO users (
            first_name,
            username, 
            email,
            phone,
            password, 
            role_id
        ) VALUES (?, ?, ?, ?, ?, 1)
    ");
    
    $result = $stmt->execute([
        'Administrator',
        'admin',
        'admin@zig-customize.local',
        '0000000000',
        'Admmin1235'
    ]);
    
    if ($result) {
        echo "✓ SUCCESS! Admin user created successfully!<br><br>";
        echo "Login Credentials:<br>";
        echo "Username: <strong>admin</strong><br>";
        echo "Password: <strong>Admmin1235</strong><br><br>";
        echo "<a href='./pages/login.php'>Go to Login Page</a>";
    } else {
        echo "✗ Failed to create admin user";
    }
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage();
}
?>

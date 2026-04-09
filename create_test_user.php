<?php
require_once(__DIR__ . '/sql_connection/config.php');

// Create a test customer user for checkout testing
try {
    // Check if test user already exists
    $stmt = $pdo->prepare("SELECT user_id FROM users WHERE username = ?");
    $stmt->execute(['testuser']);
    $existing_user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing_user) {
        echo "✓ Test user already exists!<br><br>";
    } else {
        // Create test customer user
        $stmt = $pdo->prepare("
            INSERT INTO users (
                first_name,
                username,
                email,
                phone,
                password,
                role_id
            ) VALUES (?, ?, ?, ?, ?, 2)
        ");

        $result = $stmt->execute([
            'Test Customer',
            'testuser',
            'test@zig-customize.local',
            '1234567890',
            'Test1234'  // Plain text password as per existing schema
        ]);

        if ($result) {
            echo "✓ SUCCESS! Test customer user created successfully!<br><br>";
        } else {
            echo "✗ Failed to create test user<br><br>";
        }
    }

    echo "Login Credentials:<br>";
    echo "Username: <strong>testuser</strong><br>";
    echo "Password: <strong>Test1234</strong><br><br>";
    echo "<a href='./pages/login.php'>Go to Login Page</a><br><br>";
    echo "<small>Note: After logging in, add items to cart before going to checkout</small>";

} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage();
}
?>
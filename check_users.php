<?php
require_once('sql_connection/config.php');

try {
    $stmt = $pdo->query('SELECT user_id, first_name, username, email, role_id FROM users');
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "Current users in database:\n\n";
    if (empty($users)) {
        echo "No users found.\n";
    } else {
        foreach ($users as $user) {
            echo "ID: {$user['user_id']}, Name: {$user['first_name']}, Username: {$user['username']}, Email: {$user['email']}, Role: {$user['role_id']}\n";
        }
    }

    echo "\nCreating test user...\n";

    // Check if test user exists
    $stmt = $pdo->prepare("SELECT user_id FROM users WHERE username = ?");
    $stmt->execute(['testuser']);
    $existing = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing) {
        echo "✓ Test user 'testuser' already exists!\n";
    } else {
        // Create test user
        $stmt = $pdo->prepare("
            INSERT INTO users (first_name, username, email, phone, password, role_id)
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        $result = $stmt->execute([
            'Test Customer',
            'testuser',
            'test@zig-customize.local',
            '1234567890',
            'Test1234',
            2  // Customer role
        ]);

        if ($result) {
            echo "✓ Test user 'testuser' created successfully!\n";
        } else {
            echo "✗ Failed to create test user\n";
        }
    }

    echo "\nLogin Credentials:\n";
    echo "Username: testuser\n";
    echo "Password: Test1234\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
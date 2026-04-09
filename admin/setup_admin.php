<?php
require_once(__DIR__ . '/../sql_connection/config.php');

// Check if admin user already exists
$stmt = $pdo->prepare("SELECT ID FROM user WHERE username = ? AND role = 'admin'");
$stmt->execute(['admin']);
$admin_exists = $stmt->fetch(PDO::FETCH_ASSOC);

if ($admin_exists) {
    $message = "Admin user already exists!";
    $admin_password = "Not displayed (already set)";
} else {
    // Create admin user
    $admin_username = 'admin';
    $admin_email = 'admin@zig-customized.com';
    $admin_password = 'Admin@123';
    $admin_name = 'Administrator';
    
    try {
        $stmt = $pdo->prepare("
            INSERT INTO user (
                customer_name, username, customer_mail, customer_phone, 
                password, role, created_at, updated_at
            ) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())
        ");
        
        $result = $stmt->execute([
            $admin_name,
            $admin_username,
            $admin_email,
            '0000000000',
            $admin_password,  // Stored as plain text as per existing schema
            'admin'
        ]);
        
        if ($result) {
            $message = "✓ Admin user created successfully!";
        } else {
            $message = "✗ Failed to create admin user";
            $admin_password = "Error";
        }
    } catch (Exception $e) {
        $message = "✗ Error: " . $e->getMessage();
        $admin_password = "Error";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Setup</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
            background: #f5f5f5;
        }
        .setup-container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-info {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
        .credentials {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 4px;
            margin: 20px 0;
            border-left: 4px solid #667eea;
        }
        .credentials p {
            margin: 10px 0;
            font-family: monospace;
        }
        .credentials strong {
            color: #333;
            display: block;
            margin-bottom: 5px;
        }
        .button-group {
            text-align: center;
            margin-top: 20px;
        }
        .button-group a {
            display: inline-block;
            padding: 10px 30px;
            margin: 5px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .button-group a:hover {
            background: #764ba2;
        }
    </style>
</head>
<body>
    <div class="setup-container">
        <h1>Admin Setup</h1>
        <hr>
        
        <div class="alert alert-success">
            <?php echo $message; ?>
        </div>
        
        <?php if (!$admin_exists): ?>
            <div class="alert alert-info">
                <strong>✓ Admin Account Created</strong>
            </div>
            
            <div class="credentials">
                <strong>Login Credentials:</strong>
                <p><strong>Username:</strong> admin</p>
                <p><strong>Email:</strong> admin@zig-customized.com</p>
                <p><strong>Password:</strong> Admin@123</p>
            </div>
            
            <div class="alert alert-info">
                <strong>⚠️ Important:</strong> Save these credentials in a secure location. You can change the password after logging in.
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                <strong>ℹ️ Admin user already exists.</strong>
            </div>
        <?php endif; ?>
        
        <div class="button-group">
            <a href="/admin/admin_login.php">Go to Admin Login</a>
            <a href="/">Back to Home</a>
        </div>
    </div>
</body>
</html>

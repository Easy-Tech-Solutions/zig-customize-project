<?php
require_once(__DIR__ . '/../sql_connection/config.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Access Denied</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Open Sans', sans-serif;
        }
        .error-container {
            background: white;
            padding: 40px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            max-width: 500px;
        }
        .error-container h1 {
            color: #dc3545;
            font-size: 48px;
            margin: 20px 0;
        }
        .error-container p {
            color: #666;
            margin: 10px 0;
            font-size: 16px;
        }
        .button-group {
            margin-top: 30px;
        }
        .button-group a {
            display: inline-block;
            padding: 10px 30px;
            margin: 5px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .button-group a:hover {
            background: #764ba2;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>⛔ Access Denied</h1>
        <p>You do not have permission to access this page.</p>
        <p>If you believe this is an error, please contact the administrator.</p>
        
        <div class="button-group">
            <?php if (isLoggedIn()): ?>
                <?php if (isAdmin()): ?>
                    <a href="/admin/dashboard/dashboard.php">Go to Admin Dashboard</a>
                <?php else: ?>
                    <a href="/">Go to Home</a>
                <?php endif; ?>
            <?php else: ?>
                <a href="/pages/login.php">Go to Login</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
</html>
<?php
require_once(__DIR__ . '/../sql_connection/config.php');

// If already logged in, redirect to dashboard
if (isLoggedIn() && $_SESSION['role'] === 'admin') {
    header("Location: /admin/dashboard/dashboard.php");
    exit();
}

$error = '';
$success = '';

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    
    if (empty($username) || empty($password)) {
        $error = "Username and password are required";
    } else {
        try {
            // Check user in database
            $stmt = $pdo->prepare("SELECT * FROM users WHERE (username = ? OR email = ?) LIMIT 1");
            $stmt->execute([$username, $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user && ($password === $user['password'] || password_verify($password, $user['password']))) {
                // Check if user is admin
                if ($user['role'] !== 'admin') {
                    $error = "You do not have admin access";
                } else {
                    // Set session variables
                    session_regenerate_id(true);
                    $_SESSION['user_id'] = $user['ID'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['role'] = $user['role'];
                    $_SESSION['logged_in'] = true;
                    
                    header("Location: /admin/dashboard/dashboard.php");
                    exit();
                }
            } else {
                $error = "Invalid username or password";
            }
        } catch (Exception $e) {
            error_log("Login error: " . $e->getMessage());
            $error = "A database error occurred. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html class="no-js" lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="ZIG Customized - Admin Login">
    <meta name="author" content="">
    <title>ZIG Customized - Admin Login</title>
    <link href="../assets/images/favicon/favicon.ico" rel="shortcut icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,800" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="../assets/css/ionicons.min.css">
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <link rel="stylesheet" href="../assets/css/bundle.css">
    <style>
        .admin-login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .admin-login-card {
            width: 100%;
            max-width: 400px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            padding: 40px;
        }
        .admin-login-card h2 {
            text-align: center;
            margin-bottom: 10px;
            color: #333;
        }
        .admin-login-card .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }
        .error-message {
            color: #dc3545;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 4px;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            font-size: 14px;
        }
        .success-message {
            color: #28a745;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 4px;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
            font-size: 14px;
        }
        .form-group input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        .login-button {
            width: 100%;
            padding: 10px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .login-button:hover {
            transform: translateY(-2px);
        }
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0;
            font-size: 14px;
        }
        .form-options a {
            color: #667eea;
            text-decoration: none;
        }
        .form-options a:hover {
            text-decoration: underline;
        }
        .remember-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .remember-group input {
            width: auto;
            margin: 0;
        }
    </style>
</head>
<body class="admin-login-page">
    <div class="admin-login-card">
        <h2>Admin Login</h2>
        <p class="subtitle">Welcome back! Sign in to your account.</p>
        
        <?php if ($error): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="success-message"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username or Email <span style="color: red;">*</span></label>
                <input type="text" id="username" name="username" placeholder="Enter your username or email" required autofocus>
            </div>
            
            <div class="form-group">
                <label for="password">Password <span style="color: red;">*</span></label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            
            <div class="form-options">
                <div class="remember-group">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember" style="margin: 0;">Remember me</label>
                </div>
                <a href="/pages/lost-password.php">Forgot password?</a>
            </div>
            
            <button type="submit" name="login" value="1" class="login-button">Login</button>
        </form>
        
        <div style="text-align: center; margin-top: 20px; color: #666; font-size: 14px;">
            <p style="margin: 0;">
                <a href="/" style="color: #667eea; text-decoration: none;">← Back to Home</a>
            </p>
        </div>
    </div>

    <script>
        // Show/Hide password functionality
        const passwordField = document.getElementById('password');
        const toggleBtn = document.createElement('a');
        toggleBtn.href = '#';
        toggleBtn.style.color = '#667eea';
        toggleBtn.style.cursor = 'pointer';
        toggleBtn.style.fontSize = '12px';
        toggleBtn.textContent = 'Show';
        
        (passwordField.parentElement).appendChild(toggleBtn);
        
        toggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleBtn.textContent = 'Hide';
            } else {
                passwordField.type = 'password';
                toggleBtn.textContent = 'Show';
            }
        });
    </script>
</body>
</html>

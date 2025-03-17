<?php
session_start();
include('../sql_connection/config.php');  

// If user is already logged in, prevent auto-login
if (isset($_SESSION['login_user'])) {
    header("Location: /ZIG-CUSTOMIZE-PROJECT/index.php");
    exit();
}

if (isset($_POST['userlog'])) {
    $usernameOrEmail = $_POST['Username'];  // The input can be username or email
    $password = $_POST['Password'];  

    // Prevent SQL injection  
    $usernameOrEmail = mysqli_real_escape_string($conn, stripslashes($usernameOrEmail));  

    // Check if the input is an email or username and perform the query accordingly
    if (filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL)) {
        // Input is an email, query by email
        $sql = "SELECT * FROM user WHERE customer_mail = ?";
    } else {
        // Input is a username, query by username
        $sql = "SELECT * FROM user WHERE username = ?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usernameOrEmail);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $db_hashed_password = $row['password']; // Get stored hashed password

        // Verify hashed password
        if (password_verify($password, $db_hashed_password)) { 
            $_SESSION['login_user'] = $row['username']; // Log the user in

            // Handle Remember Me functionality
            if (isset($_POST['rememberme'])) {
                // Create a unique token
                $remember_token = bin2hex(random_bytes(16)); // 32 characters long

                // Set a cookie with the token (expires in 30 days)
                setcookie('rememberme', $remember_token, time() + 30 * 24 * 60 * 60, '/', '', false, true);

                // Store the token in the database (associated with the user)
                $sql_update_token = "UPDATE user SET remember_token = ? WHERE username = ?";
                $stmt_update = $conn->prepare($sql_update_token);
                $stmt_update->bind_param("ss", $remember_token, $row['username']);
                $stmt_update->execute();
            }

            // Redirect to the last visited page or home if none is set
            $redirect_url = isset($_SESSION['redirect_url']) ? $_SESSION['redirect_url'] : '/ZIG-CUSTOMIZE-PROJECT/index.php';
            unset($_SESSION['redirect_url']); // Clear session variable

            echo "<script> alert('Login successful'); window.location = '$redirect_url'; </script>";
        } else {
            echo "<script> alert('Invalid password.'); window.location ='/ZIG-CUSTOMIZE-PROJECT/pages/account.php'; </script>";
        }
    } else {  
        echo "<script> alert('Login failed. Invalid username/email or password.'); window.location ='/ZIG-CUSTOMIZE-PROJECT/pages/account.php'; </script>";  
    } 

    $stmt->close();
    $conn->close();
}
?>

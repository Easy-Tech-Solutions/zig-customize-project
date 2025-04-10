<?php
if(isset($_POST['userreg'])){
    include('../sql_connection/config.php');  // This should contain your PDO connection

    // Validate and sanitize inputs
    $firstname = trim($_POST['FirstName']);  
    $lastname = trim($_POST['LastName']); 
    $username = trim($_POST['Username']); 
    $mail = filter_var(trim($_POST['Email']), FILTER_VALIDATE_EMAIL);
    $phone = trim($_POST['Phone']);
    $address = trim($_POST['Address']);
    $city = trim($_POST['City']);
    $region = trim($_POST['Region']);
    $password = trim($_POST['Password']);
    $confirmPassword = trim($_POST['ConfirmPassword']);
    $role_id = 2; // Changed to integer since it's likely an ID
    $default_avatar = 'account.jpg';
    
    // Check if Terms & Conditions checkbox is checked
    if(!isset($_POST['accept'])) {
        header("Location: /ZIG-CUSTOMIZE-PROJECT/pages/registration.php?error=terms");
        exit();
    }

    // Validate email
    if (!$mail) {
        header("Location: /ZIG-CUSTOMIZE-PROJECT/pages/registration.php?error=email");
        exit();
    }

    // Password requirements
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
        header("Location: /ZIG-CUSTOMIZE-PROJECT/pages/registration.php?error=password");
        exit();
    }

    // Check if passwords match
    if ($password !== $confirmPassword) {
        header("Location: /ZIG-CUSTOMIZE-PROJECT/pages/registration.php?error=password_match");
        exit();
    }

    try {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if the username or email already exists
        $sql = "SELECT COUNT(*) FROM users WHERE username = ? OR email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $mail]);
        
        if($stmt->fetchColumn() > 0) {
            header("Location: /ZIG-CUSTOMIZE-PROJECT/pages/registration.php?error=exists");
            exit();
        }

        // Insert user data
        $sql = "INSERT INTO users (first_name, last_name, username, email, phone, address, city, region, password, role_id, profile_image) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$firstname, $lastname, $username, $mail, $phone, $address, $city, $region, $hashed_password, $role_id, $default_avatar]);

        // Start session and log user in automatically if desired
        session_start();
        $_SESSION['registration_success'] = true;
        header("Location: /ZIG-CUSTOMIZE-PROJECT/pages/login.php");
        exit();

    } catch (PDOException $e) {
        // Log the error (in a real application, you would log to a file)
        error_log("Registration error: " . $e->getMessage());
        
        // Redirect with generic error
        header("Location: /ZIG-CUSTOMIZE-PROJECT/pages/registration.php?error=database");
        exit();
    }
}
?>
<?php   
if(isset($_POST['userreg'])){
    include('../sql_connection/config.php');  

    $fullname = trim($_POST['Fullname']);  
    $username = trim($_POST['Username']); 
    $mail = trim($_POST['Email']);
    $phone = trim($_POST['Phone']);
    $password = trim($_POST['Password']);
    $confirmPassword = trim($_POST['ConfirmPassword']);
    
    // Check if Terms & Conditions checkbox is checked
    if(!isset($_POST['accept'])) {
        echo "<script>alert('You must accept the Terms and Conditions to register.');
        window.location = '/ZIG-CUSTOMIZE-PROJECT/pages/account.php';</script>";
        exit();
    }

    // Password requirements
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
        die("<script>alert('Password must be at least 8 characters long, including uppercase, lowercase, number, and special character.'); 
        window.location = '/ZIG-CUSTOMIZE-PROJECT/pages/account.php';</script>");
    }

    // Check if passwords match
    if ($password !== $confirmPassword) {
        die("<script>alert('Passwords do not match!'); 
        window.location = '/ZIG-CUSTOMIZE-PROJECT/pages/account.php';</script>");
    }

    // Hash the password correctly
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the username or email already exists
    $sql = "SELECT * FROM user WHERE username = ? OR customer_mail = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $mail);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0) {
        echo "<script>alert('User already exists. Choose a different username or email.');
        window.location = '/ZIG-CUSTOMIZE-PROJECT/pages/account.php';</script>";
    } else {
        // Insert user data (remove confirmPassword from the database)
        $sql = "INSERT INTO user (customer_name, username, customer_mail, customer_phone, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $fullname, $username, $mail, $phone, $hashed_password);

        if(mysqli_stmt_execute($stmt)){ 
            echo "<script>alert('Registration successful!'); 
            window.location = '/ZIG-CUSTOMIZE-PROJECT/pages/account.php';</script>";
        } else {  
            echo "Error: " . mysqli_error($conn);
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

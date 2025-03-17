<?php
session_start();

if (isset($_POST['submit_reset'])) {
    include('../sql_connection/config.php');
    $code_entered = $_POST['code'];  // User-entered code
    $new_password = $_POST['new_password'];

    // Verify the code entered by the user
    if ($code_entered == $_SESSION['reset_code']) {
        // Code matches, proceed with password reset
        $username = $_SESSION['reset_username'];
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the password in the database
        $sql = "UPDATE user SET password = ? WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $hashed_password, $username);
        $stmt->execute();

        echo "<script>alert('Password has been successfully reset.'); window.location = '/ZIG-CUSTOMIZE-PROJECT/pages/account.php';</script>";
    } else {
        echo "<script>alert('Invalid reset code.'); window.location = '/ZIG-CUSTOMIZE-PROJECT/pages/account.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

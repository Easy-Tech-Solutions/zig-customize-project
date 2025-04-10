<?php
if (isset($_POST['submit_username'])) {
    include('../sql_connection/config.php');
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Check if the email exists in the database
    $sql = "SELECT username FROM user WHERE customer_mail = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email exists, fetch username
        $row = $result->fetch_assoc();
        $username = $row['username'];

        // Email settings
        $to = $email;
        $subject = "Your Username";
        $message = "Hello,<br><br>Your username is: <b>$username</b><br><br>Thank you!";
        $headers = "From: testmail@gtechconsolidated.com\r\n";
        $headers .= "Reply-To: testmail@gtechconsolidated.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        // Send the email
        if (mail($to, $subject, $message, $headers)) {
            echo "<script>alert('Your username has been sent to your email.'); window.location = '/ZIG-CUSTOMIZE-PROJECT/pages/account.php';</script>";
        } else {
            echo "<script>alert('Failed to send email. Check your SMTP settings.'); window.location = '/ZIG-CUSTOMIZE-PROJECT/pages/account.php';</script>";
        }
    } else {
        echo "<script>alert('No user found with this email.'); window.location = '/ZIG-CUSTOMIZE-PROJECT/pages/account.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

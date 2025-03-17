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
        // Email exists, send username
        $row = $result->fetch_assoc();
        $username = $row['username'];

        // Send the username to the user's email
        mail($email, "Your Username", "Your username is: $username");

        echo "<script>alert('Your username has been sent to your email.'); window.location = '/ZIG-CUSTOMIZE-PROJECT/pages/account.php';</script>";
    } else {
        echo "<script>alert('No user found with this email.'); window.location = '/ZIG-CUSTOMIZE-PROJECT/pages/account.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

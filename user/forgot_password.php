<?php

require_once 'vendor/autoload.php'; // Autoload the Twilio SDK

use Twilio\Rest\Client;

if (isset($_POST['submit_password'])) {
    include('../sql_connection/config.php');
    $usernameOrEmail = mysqli_real_escape_string($conn, $_POST['username_or_email']);
    $method = $_POST['method'];  // 'email' or 'sms'

    // Check if the input is an email or username
    if (filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL)) {
        // Query by email
        $sql = "SELECT username, customer_mail, customer_phone FROM user WHERE customer_mail = ?";
    } else {
        // Query by username
        $sql = "SELECT username, customer_mail, customer_phone FROM user WHERE username = ?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usernameOrEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found, generate a one-time code
        $row = $result->fetch_assoc();
        $username = $row['username'];
        $email = $row['customer_mail'];
        $phone = $row['customer_phone'];

        // Generate a random 6-digit code
        $code = rand(100000, 999999);

        // Store the code in session for verification later
        $_SESSION['reset_code'] = $code;
        $_SESSION['reset_username'] = $username;

        // Send the code via email or SMS
        if ($method == 'email') {
            // Send the code to the user's email
            mail($email, "Password Reset Code", "Your password reset code is: $code");

            echo "<script>alert('A password reset code has been sent to your email.'); window.location = '/pages/account.php';</script>";
        } elseif ($method == 'sms') {
            // Send the code via SMS using Twilio
            $twilio_sid = 'your_twilio_sid';
            $twilio_token = 'your_twilio_auth_token';
            $twilio_phone = 'your_twilio_phone_number';

            // Initialize Twilio Client
            $client = new Twilio\Rest\Client($twilio_sid, $twilio_token);

            $client->messages->create(
                $phone, // To phone number
                [
                    'from' => $twilio_phone,
                    'body' => "Your password reset code is: $code"
                ]
            );

            echo "<script>alert('A password reset code has been sent to your phone.'); window.location = '/pages/account.php';</script>";
        }
    } else {
        echo "<script>alert('No user found with this username/email.'); window.location = '/pages/account.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

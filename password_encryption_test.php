<?php
$password = "P@ssw0rd"; // Enter the password used for registration
$hashed_password = "$2y$10$ftMXSQW8t2oCO"; // Example hash

// Test password verification
echo password_verify($password, $hashed_password) ? "Match" : "No match";
?>

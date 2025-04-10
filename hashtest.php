<?php
$password = "root";  // The password to hash
$hashed_password = password_hash($password, PASSWORD_DEFAULT); // Generate the hash
echo $hashed_password;  // Print the hashed password
?>

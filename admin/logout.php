<?php
// Destroy session
session_start();
session_unset();
session_destroy();

// Clear any related cookies
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Redirect to login or home
header("Location: /pages/login.php");
exit();
?>
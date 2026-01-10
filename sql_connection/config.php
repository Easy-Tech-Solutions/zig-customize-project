<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Database connection
$host = 'localhost';
$dbname = 'zigdb';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Provide a legacy mysqli connection for older scripts that still use $conn / mysqli
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    // If PDO succeeded but mysqli failed, prefer PDO but log error
    error_log('MySQLi connection failed: ' . $conn->connect_error);
} else {
    $conn->set_charset('utf8mb4');
}

// Authentication check function
function checkAuth() {
    if (!isset($_SESSION['user_id']) && !isset($_SESSION['login_user'])) {
        header("Location: /index.php");
        exit();
    }
}

// Authentication functions
function isLoggedIn() {
    return isset($_SESSION['user_id']) || isset($_SESSION['login_user']) || isset($_SESSION['username']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: /pages/login.php");
        exit();
    }
}

function requireRole($role) {
    requireLogin();
    if ($_SESSION['role'] !== $role) {
        header("Location: /user/unauthorized.php"); // Create this page
        exit();
    }
}

// Role check functions
function isAdmin() {
    return isset($_SESSION['role']) && ($_SESSION['role'] === 'Admin' || $_SESSION['role'] === 'Products Admin');
}

function isClient() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'Client';
}

function isProductsAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'Products Admin';
}

function isFullAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'Admin';
}
?>

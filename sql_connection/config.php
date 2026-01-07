<?php
// If there's an active session, destroy it
if (session_status() == PHP_SESSION_ACTIVE) {
    session_unset();  // Clear all session variables
    session_destroy();  // Destroy the session
}

// Start a new session
session_start();


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

// Authentication check function
function checkAuth() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: /index.php");
        exit();
    }
}

// Authentication functions
function isLoggedIn() {
    return isset($_SESSION['user_id']);
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

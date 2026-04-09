<?php
// Start a new session only if one doesn't exist
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// TipMe payment API configuration
// Replace these values with your TipMe staging/live credentials before testing.
define('TIPME_BASE_URL', 'https://api.tipme.com');
define('TIPME_MERCHANT_ID', 'CID1000000');
define('TIPME_AUTHORIZE_KEY', 'YOUR_AUTHORIZE_KEY');

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
function tipmeApiRequest(string $endpoint, array $postData = []): array {
    $url = rtrim(TIPME_BASE_URL, '/') . '/' . ltrim($endpoint, '/');

    $headers = [
        'Content-Type: application/x-www-form-urlencoded',
        'authorizekey: ' . TIPME_AUTHORIZE_KEY,
    ];

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($postData),
        CURLOPT_HTTPHEADER => $headers,
    ]);

    $response = curl_exec($curl);
    $error = curl_error($curl);
    curl_close($curl);

    if ($error) {
        return ['status' => '0', 'msg' => 'TipMe API connection error: ' . $error];
    }

    $decoded = json_decode($response, true);
    if (!is_array($decoded) || !isset($decoded['data'])) {
        return ['status' => '0', 'msg' => 'Invalid TipMe API response'];
    }

    return $decoded['data'];
}

function tipmeAuthenticate(): array {
    return tipmeApiRequest('/Business_api/authenticate', ['merchant_id' => TIPME_MERCHANT_ID]);
}

function tipmeCheckBalance(string $authToken): array {
    return tipmeApiRequest('/Business_api/check_balance', [
        'merchant_id' => TIPME_MERCHANT_ID,
        'auth_token' => $authToken,
    ]);
}

function checkAuth() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: /index.php");
        exit();
    }
}

// Get user by ID
function getUserById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Authentication functions
function isLoggedIn() {
    return isset($_SESSION['user_id']) && isset($_SESSION['role_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: /pages/login.php");
        exit();
    }
}

function requireRole($roleId) {
    requireLogin();
    // Convert role name to ID if string is passed
    $roleMap = ['Admin' => 1, 'Customer' => 2, 'admin' => 1, 'customer' => 2];
    $requiredId = is_numeric($roleId) ? $roleId : ($roleMap[$roleId] ?? null);
    
    if (!$requiredId || $_SESSION['role_id'] != $requiredId) {
        header("Location: /user/unauthorized.php");
        exit();
    }
}

// Role check functions
function isAdmin() {
    return isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1;
}

function isCustomer() {
    return isset($_SESSION['role_id']) && $_SESSION['role_id'] == 2;
}

function isProductsAdmin() {
    return isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1;
}

function isFullAdmin() {
    return isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1;
}
?>

<?php
require_once('../../sql_connection/config.php');
requireRole('Admin');

$adminId = $_SESSION['user_id'] ?? null;

if (!$adminId) {
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit();
}

try {
    $stmt = $pdo->prepare('SELECT first_name, email, profile_image FROM users WHERE user_id = ?');
    $stmt->execute([$adminId]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$admin) {
        http_response_code(404);
        echo json_encode(['success' => false, 'error' => 'Admin not found']);
        exit();
    }

    $profileImage = 'assets/images/profile/profile-image.png';
    if (!empty($admin['profile_image'])) {
        $profileImage = '../../Uploads/Profiles/' . htmlspecialchars($admin['profile_image']);
    }

    echo json_encode([
        'success' => true,
        'first_name' => $admin['first_name'],
        'email' => $admin['email'],
        'profile_image' => $profileImage
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Server error']);
}
?>

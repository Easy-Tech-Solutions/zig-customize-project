<?php
require_once('../../sql_connection/config.php');
requireRole('Admin');

$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($user_id == 0) {
    header("Location: manage_users.php?error=Invalid+user+ID");
    exit();
}

try {
    // Prevent deleting yourself
    if ($user_id == $_SESSION['user_id']) {
        header("Location: manage_users.php?error=Cannot+delete+your+own+account");
        exit();
    }
    
    $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
    if ($stmt->execute([$user_id])) {
        header("Location: manage_users.php?success=User+deleted+successfully");
    } else {
        header("Location: manage_users.php?error=Failed+to+delete+user");
    }
} catch (Exception $e) {
    header("Location: manage_users.php?error=" . urlencode($e->getMessage()));
}
exit();
?>
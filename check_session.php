<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['role_id'])) {
    echo "<h2>✓ Session Variables Set</h2>";
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
    
    echo "<br><strong>Role ID:</strong> " . $_SESSION['role_id'] . "<br>";
    
    if ($_SESSION['role_id'] == 1) {
        echo "✓ Admin user detected<br>";
        echo "<a href='/dashboard/zig-customize-project/admin/dashboard/dashboard.php'>Click here to go to Admin Dashboard</a>";
    } else {
        echo "Customer user detected<br>";
    }
} else {
    echo "✗ No session found. You are not logged in.<br>";
    echo "<a href='/pages/login.php'>Go to Login</a>";
}
?>

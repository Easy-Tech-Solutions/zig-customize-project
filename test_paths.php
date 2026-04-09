<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Path and File Check</h2>";

// Check if files exist
$files_to_check = [
    'sql_connection/config.php' => __DIR__ . '/sql_connection/config.php',
    'admin/include/header.php' => __DIR__ . '/admin/include/header.php',
    'admin/include/sidebarnav.php' => __DIR__ . '/admin/include/sidebarnav.php',
    'admin/dashboard/dashboard.php' => __DIR__ . '/admin/dashboard/dashboard.php',
];

echo "<table border='1' cellpadding='10'>";
echo "<tr><th>File</th><th>Path</th><th>Exists</th></tr>";

foreach ($files_to_check as $label => $path) {
    $exists = file_exists($path) ? '✓ YES' : '✗ NO';
    echo "<tr>";
    echo "<td><strong>$label</strong></td>";
    echo "<td><small>$path</small></td>";
    echo "<td>$exists</td>";
    echo "</tr>";
}

echo "</table>";

echo "<h2>Admin Dashboard Test Link</h2>";
echo '<a href="/dashboard/zig-customize-project/admin/dashboard/dashboard.php" target="_blank">Go to Admin Dashboard</a>';
?>

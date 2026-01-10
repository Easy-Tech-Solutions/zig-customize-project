<?php
require_once __DIR__ . '/../sql_connection/config.php';

/*
 * Script: create_missing_image_placeholders.php
 * Purpose: when product records reference files that do not exist on disk,
 * this helper creates small placeholder PNGs so requests no longer 404.
 * Created and run 2026-01-09 during debugging of missing images.
 *
 * Note: placeholders are minimal 64x64 PNGs encoded inline below. Replace
 * them with real images when available.
 */

$webRoot = realpath(__DIR__ . '/../../..') . DIRECTORY_SEPARATOR; // points to c:\xampp\htdocs\dashboard
$uploadsDir = $webRoot . 'Uploads' . DIRECTORY_SEPARATOR . 'Products' . DIRECTORY_SEPARATOR;
if (!is_dir($uploadsDir)) {
    if (!mkdir($uploadsDir, 0755, true)) {
        echo "Failed to create uploads dir: $uploadsDir\n";
        exit(1);
    }
}

$placeholderBase64 = 'iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAABJklEQVR4nO3RMQ0AAAjAMP6fNDoHBhQJv4kq2Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt27Zt3+gA7h7r3wAAACV0RVh0ZGF0ZTpjcmVhdGUAMjAyNi0wMS0xOVQxNTozMDozNSswMDowMJ+I1Y8AAAAldEVYdGRhdGU6bW9kaWZ5ADIwMjYtMDEtMTlUMTU6MzA6MzUrMDA6MDDp7i1bAAAAAElFTkSuQmCC';
$placeholderData = base64_decode($placeholderBase64);

try {
    $stmt = $pdo->query("SELECT image_path, thumbnail_path FROM products");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $missing = 0;
    foreach ($rows as $r) {
        foreach (['image_path','thumbnail_path'] as $col) {
            if (empty($r[$col])) continue;
            $parts = explode(',', $r[$col]);
            foreach ($parts as $p) {
                $p = trim($p);
                if ($p === '') continue;
                // normalize to filename
                $filename = basename($p);
                $dest = $uploadsDir . $filename;
                if (!file_exists($dest)) {
                    file_put_contents($dest, $placeholderData);
                    chmod($dest, 0644);
                    $missing++;
                    echo "Created placeholder: $dest\n";
                }
            }
        }
    }
    echo "Done. Placeholders created: $missing\n";
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    exit(1);
}

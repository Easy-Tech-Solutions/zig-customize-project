<?php
require_once __DIR__ . '/../sql_connection/config.php';

/*
 * Script: check_products_images.php
 * Purpose: quick developer helper created 2026-01-09
 * - Lists the most recent `image_path` and `thumbnail_path` values from `products` table
 * - Used to confirm what paths are stored in the DB (helpful when debugging 404s)
 *
 * This file was added during the debugging session; it is safe to keep or remove.
 */

try {
    $stmt = $pdo->query("SELECT id, image_path, thumbnail_path FROM products ORDER BY id DESC LIMIT 10");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (empty($rows)) {
        echo "No product records found.\n";
        exit(0);
    }
    foreach ($rows as $r) {
        echo $r['id'] . " | " . ($r['image_path'] ?? '') . " | " . ($r['thumbnail_path'] ?? '') . "\n";
    }
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}

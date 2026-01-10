<?php
require_once __DIR__ . '/../sql_connection/config.php';

/*
 * Script: update_image_paths.php
 * Purpose: migrate stored DB paths from "../Uploads/Products/..." to
 * "../../Uploads/Products/..." so pages referencing images resolve correctly.
 * Created/used 2026-01-09 while debugging missing image 404s.
 *
 * Use: run once to update DB rows; it echoes number of affected rows and
 * then prints a sample of recent records for verification.
 */

try {
    $sql = "UPDATE products
            SET image_path = REPLACE(image_path, '../Uploads/Products/', '../../Uploads/Products/'),
                thumbnail_path = REPLACE(thumbnail_path, '../Uploads/Products/', '../../Uploads/Products/')
            WHERE image_path LIKE '../Uploads/Products/%' OR thumbnail_path LIKE '../Uploads/Products/%'";

    $affected = $pdo->exec($sql);
    echo "Updated rows: " . ($affected === false ? 0 : $affected) . "\n";

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
    exit(1);
}

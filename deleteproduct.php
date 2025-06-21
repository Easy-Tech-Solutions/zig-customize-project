<?php
require_once('../../sql_connection/config.php');
requireRole('Admin'); // Only admins can access this

header('Content-Type: application/json');

try {
    // Validate input
    if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
        throw new Exception("Invalid product ID");
    }

    $id = intval($_POST['id']);

    // First get image paths to delete files
    $stmt = $pdo->prepare("SELECT image_path, thumbnail_path FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        throw new Exception("Product not found");
    }

    // Delete from database
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);

    // Delete associated images
    if (!empty($product['image_path'])) {
        $image_paths = explode(',', $product['image_path']);
        $thumbnail_paths = explode(',', $product['thumbnail_path']);

        foreach (array_merge($image_paths, $thumbnail_paths) as $path) {
            if (file_exists($path)) {
                unlink($path);
            }
        }
    }

    echo json_encode(['success' => true, 'message' => 'Product deleted successfully']);
    
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
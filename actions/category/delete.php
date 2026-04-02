<?php
require_once __DIR__ . '/../../system/database.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("DELETE FROM categories WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: " . DB_URL . "page/dashboard.php?view=master/category/index&success=Category berhasil dihapus");
        exit;
    } else {
        die("Error hapus category: " . $conn->error);
    }
}

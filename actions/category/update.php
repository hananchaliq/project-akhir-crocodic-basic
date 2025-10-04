<?php
require_once __DIR__ . '/../../system/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id   = intval($_POST['id']);
    $name = trim($_POST['name']);

    $stmt = $conn->prepare("UPDATE categories SET name=? WHERE id=?");
    $stmt->bind_param("si", $name, $id);

    if ($stmt->execute()) {
        header("Location: ../../page/dashboard.php?view=master/category/index&success=Category berhasil diperbarui");
        exit;
    } else {
        die("Error update category: " . $conn->error);
    }
}

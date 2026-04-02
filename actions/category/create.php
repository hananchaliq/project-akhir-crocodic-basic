<?php
require_once __DIR__ . '/../../system/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    if ($name === '') {
        header("Location: " . DB_URL . "page/dashboard.php?view=master/category/create&error=Nama wajib diisi");
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
    $stmt->bind_param("s", $name);

    if ($stmt->execute()) {
        header("Location: " . DB_URL . "page/dashboard.php?view=master/category/index&success=Kategori berhasil ditambahkan");
        exit;
    } else {
        die("Error: " . $conn->error);
    }
} else {
    header("Location: " . DB_URL . "page/dashboard.php?view=master/category/index");
    exit;
}

<?php
require_once __DIR__ . '/../../system/database.php';

$name       = $_POST['name'];
$categoryId = $_POST['category_id'];
$price      = $_POST['price'];
$stock      = $_POST['stock'];

$imagePath = null;
if (!empty($_FILES['image']['name'])) {
    $uploadDir = __DIR__ . '/../../uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $filename = time() . '_' . basename($_FILES['image']['name']);
    $target   = $uploadDir . $filename;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $imagePath = 'uploads/' . $filename;
    }
}

$stmt = $conn->prepare("INSERT INTO products (name, category_id, price, stock, image, is_active) VALUES (?, ?, ?, ?, ?, 1)");
$stmt->bind_param("sdiis", $name, $categoryId, $price, $stock, $imagePath);
$stmt->execute();

header("Location: ../../page/dashboard.php?view=master/product/index&success=Produk berhasil ditambahkan");
exit;

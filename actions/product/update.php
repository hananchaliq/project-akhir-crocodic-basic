<?php
require_once __DIR__ . '/../../system/database.php';

$id         = $_POST['id'];
$name       = $_POST['name'];
$categoryId = $_POST['category_id'];
$price      = $_POST['price'];
$stock      = $_POST['stock'];

// Ambil data lama
$res = $conn->prepare("SELECT * FROM products WHERE id=?");
$res->bind_param("i", $id);
$res->execute();
$old = $res->get_result()->fetch_assoc();

if (!$old) {
    die("Produk tidak ditemukan");
}

$imagePath = $old['image']; // default: gambar lama
if (!empty($_FILES['image']['name'])) {
    $uploadDir = __DIR__ . '/../../uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $filename = time() . '_' . basename($_FILES['image']['name']);
    $target   = $uploadDir . $filename;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        // Hapus gambar lama kalau ada
        if ($old['image'] && file_exists(__DIR__ . '/../../' . $old['image'])) {
            unlink(__DIR__ . '/../../' . $old['image']);
        }
        $imagePath = 'uploads/' . $filename;
    }
}

// Update produk
$stmt = $conn->prepare("UPDATE products SET name=?, category_id=?, price=?, stock=?, image=? WHERE id=?");
$stmt->bind_param("sdiisi", $name, $categoryId, $price, $stock, $imagePath, $id);
$stmt->execute();

header("Location: " . DB_URL . "page/dashboard.php?view=master/product/index&success=Produk berhasil diupdate");
exit;
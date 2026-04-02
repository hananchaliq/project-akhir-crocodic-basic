<?php
require_once __DIR__ . '/../../system/database.php';

$id = $_GET['id'] ?? null;

if ($id) {
    // cek apakah produk sudah pernah dipakai di order
    $check = $conn->prepare("SELECT COUNT(*) as cnt FROM order_products WHERE product_id=?");
    $check->bind_param("i", $id);
    $check->execute();
    $res = $check->get_result()->fetch_assoc();

    if ($res['cnt'] > 0) {
        header("Location: " . DB_URL . "page/dashboard.php?view=master/product/index&error=Produk tidak bisa dihapus karena sudah ada di transaksi");
        exit;
    }

    // kalau belum pernah dipakai → hapus
    $stmt = $conn->prepare("DELETE FROM products WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: " . DB_URL . "page/dashboard.php?view=master/product/index&success=Produk berhasil dihapus");
exit;

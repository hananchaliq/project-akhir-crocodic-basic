<?php
require_once __DIR__ . '/../../system/database.php';


$customer_id = $_POST['customer_id'] ?? null;
$quantities  = $_POST['quantity'] ?? [];
$admin_id    = $_SESSION['admin_id'] ?? 1;

$total_product = 0;
$total_payment = 0;

// Validasi produk & hitung total
foreach ($quantities as $product_id => $qty) {
    if ($qty > 0) {
        $result = $conn->query("SELECT * FROM products WHERE id=$product_id");
        $product = $result->fetch_assoc();

        if (!$product) {
            header("Location: ../../page/dashboard.php?view=transaksi&error=Produk tidak ditemukan");
            exit;
        }

        if ($qty > $product['stock']) {
            header("Location: ../../page/dashboard.php?view=transaksi&error=Stok produk {$product['name']} tidak mencukupi");
            exit;
        }

        $total_product += $qty;
        $total_payment += $product['price'] * $qty;
    }
}

if ($total_product == 0) {
    header("Location: ../../page/dashboard.php?view=transaksi&error=Tidak ada produk yang dipilih");
    exit;
}

// Simpan order
$conn->query("INSERT INTO orders (admin_id, customer_id, total_product, total_payment) 
              VALUES ('$admin_id', '$customer_id', '$total_product', '$total_payment')");

$order_id = $conn->insert_id;

// Simpan detail & update stok
foreach ($quantities as $product_id => $qty) {
    if ($qty > 0) {
        $result = $conn->query("SELECT * FROM products WHERE id=$product_id");
        $product = $result->fetch_assoc();
        $total_price = $product['price'] * $qty;

        $conn->query("INSERT INTO order_products (order_id, product_id, quantity, total_price) 
                      VALUES ('$order_id', '$product_id', '$qty', '$total_price')");

        $conn->query("UPDATE products SET stock = stock - $qty WHERE id=$product_id");
    }
}

header("Location: ../../page/dashboard.php?view=transaksi&success=Transaksi berhasil disimpan&printStruk=" . $order_id);
exit;
<?php
require_once __DIR__ . '/../system/database.php';

$order_id = $_GET['id'] ?? 0;
if (!$order_id) die("Order ID tidak valid");

// Ambil data order
$order_query = $conn->prepare("
    SELECT o.*, c.name as customer_name, a.name as admin_name 
    FROM orders o
    LEFT JOIN customers c ON o.customer_id = c.id
    LEFT JOIN admins a ON o.admin_id = a.id
    WHERE o.id = ?
");
$order_query->bind_param("i", $order_id);
$order_query->execute();
$order = $order_query->get_result()->fetch_assoc();

// Ambil items
$items_query = $conn->prepare("
    SELECT op.*, p.name as product_name, p.price as product_price
    FROM order_products op
    LEFT JOIN products p ON op.product_id = p.id
    WHERE op.order_id = ?
    ORDER BY op.id
");
$items_query->bind_param("i", $order_id);
$items_query->execute();
$items = $items_query->get_result();

// Info toko
$shop_name = "Halalood";
$shop_address = "Jl. Ende-Bajawa, Anaraja, NTT, Nggorea, Nangapanda, Kabupaten Ende, Nusa Tenggara Timur";
$shop_phone = "0821-4602-0022";
$shop_slogan = "Laptop premium, stok terbatas, cepat sebelum habis!";
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Struk Halalood</title>
<style>
    body {
        font-family: monospace;
        margin:0;
        padding:20px;
        background:#f3f3f3;
        display:flex;
        justify-content:center;
    }
    .container {
        width: 80mm;
        background:white;
        padding:10px;
        border:1px solid #00C851;
        border-radius:8px;
    }
    .center { text-align:center; }
    .line { border-bottom:1px dashed #000; margin:4px 0; }
    .flex { display:flex; justify-content:space-between; }
    .logo { font-weight:bold; font-size:20px; color:#00C851; margin-bottom:2px; }
    .buttons { display:flex; justify-content:space-between; margin-bottom:10px; }
    .buttons button {
        padding:6px 12px;
        border:none;
        border-radius:4px;
        font-weight:bold;
        cursor:pointer;
        font-size:12px;
    }
    .btn-print { background:#00C851; color:white; }
    .btn-back { background:#ccc; color:black; }
    @media print {
        .buttons { display:none; }
        body { background:white; display:block; }
        .container { border:none; width:80mm; }
    }
</style>
</head>
<body>

<div class="container">
    <!-- Tombol -->
    <div class="buttons">
        <button class="btn-print" onclick="window.print()">Cetak Struk</button>
        <button class="btn-back" onclick="window.close()">Kembali</button>
    </div>

    <div class="center">
        <!-- Logo -->
        <div class="logo">H</div>
        <strong><?= $shop_name ?></strong><br>
        <?= $shop_address ?><br>
        Telp: <?= $shop_phone ?><br>
        <em><?= $shop_slogan ?></em><br><br>

        Tanggal: <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?><br>
        Kasir: <?= $order['admin_name'] ?><br>
        <?php if(!empty($order['customer_name'])): ?>
            Customer: <?= $order['customer_name'] ?><br>
        <?php endif; ?>
    </div>

    <div class="line"></div>

    <?php while($item = $items->fetch_assoc()): ?>
    <div class="flex">
        <span><?= $item['product_name'] ?></span>
        <span>x<?= $item['quantity'] ?></span>
    </div>
    <div class="flex">
        <span></span>
        <span>Rp <?= number_format($item['total_price'],0,',','.') ?></span>
    </div>
    <?php endwhile; ?>

    <div class="line"></div>

    <div class="flex">
        <span>Total Item:</span>
        <span><?= $order['total_product'] ?> pcs</span>
    </div>
    <div class="flex">
        <strong>Total Bayar:</strong>
        <strong>Rp <?= number_format($order['total_payment'],0,',','.') ?></strong>
    </div>

    <div class="line"></div>

    <div class="center">
        Terima kasih telah berbelanja di Halalood<br>
        <strong>⚡ Stok terbatas, jangan sampai kehabisan!</strong>
    </div>
</div>

</body>
</html>

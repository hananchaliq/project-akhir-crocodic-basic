<?php
require_once __DIR__ . '/../../../system/database.php';

$order_id = $_GET['id'] ?? 0;

// Ambil data order
$order = $conn->query("
    SELECT o.*, a.name as admin_name, c.name as customer_name, c.phone, c.address
    FROM orders o
    LEFT JOIN admins a ON o.admin_id = a.id
    LEFT JOIN customers c ON o.customer_id = c.id
    WHERE o.id=$order_id
")->fetch_assoc();

// Ambil produk yang dibeli
$details = $conn->query("
    SELECT op.*, p.name as product_name, p.price as unit_price
    FROM order_products op
    LEFT JOIN products p ON op.product_id = p.id
    WHERE op.order_id=$order_id
");

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halalood</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-6">Detail Transaksi #<?= $order_id ?></h2>

        <!-- Info Transaksi -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h3 class="font-semibold text-lg mb-3">Informasi Transaksi</h3>
                    <div class="space-y-2">
                        <p><span class="font-medium">ID Transaksi:</span> #<?= $order_id ?></p>
                        <p><span class="font-medium">Tanggal:</span> <?= date('d/m/Y H:i:s', strtotime($order['created_at'])) ?></p>
                        <p><span class="font-medium">Kasir:</span> <?= $order['admin_name'] ?></p>
                        <p><span class="font-medium">Total Item:</span> <?= $order['total_product'] ?> item</p>
                        <p><span class="font-medium">Total Bayar:</span> Rp <?= number_format($order['total_payment'], 0, ',', '.') ?></p>
                    </div>
                </div>
                
                <div>
                    <h3 class="font-semibold text-lg mb-3">Informasi Customer</h3>
                    <div class="space-y-2">
                        <p><span class="font-medium">Nama:</span> <?= $order['customer_name'] ?></p>
                        <p><span class="font-medium">Telepon:</span> <?= $order['phone'] ?? '-' ?></p>
                        <p><span class="font-medium">Alamat:</span> <?= $order['address'] ?? '-' ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Produk -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="font-semibold text-lg mb-4">Produk yang Dibeli</h3>
            <table class="w-full border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 border text-left">Produk</th>
                        <th class="p-3 border text-center">Qty</th>
                        <th class="p-3 border text-right">Harga Satuan</th>
                        <th class="p-3 border text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($d = $details->fetch_assoc()): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="p-3 border"><?= $d['product_name'] ?></td>
                        <td class="p-3 border text-center"><?= $d['quantity'] ?></td>
                        <td class="p-3 border text-right">Rp <?= number_format($d['unit_price'], 0, ',', '.') ?></td>
                        <td class="p-3 border text-right">Rp <?= number_format($d['total_price'], 0, ',', '.') ?></td>
                    </tr>
                    <?php endwhile; ?>
                    
                    <!-- Total -->
                    <tr class="bg-gray-50 font-semibold">
                        <td colspan="3" class="p-3 border text-right">Total</td>
                        <td class="p-3 border text-right">Rp <?= number_format($order['total_payment'], 0, ',', '.') ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Tombol Aksi -->
        <div class="mt-6 flex space-x-3">
            <a href="<?= DB_URL ?>page/dashboard.php?view=master/laporan/index"
               class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
               ⬅ Kembali ke Laporan
            </a>
            <a href="struk.php?id=<?= $order_id ?>" 
               target="_blank"
               class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
               Cetak Struk
            </a>
        </div>
    </div>
</body>
</html>
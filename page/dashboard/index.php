<?php
require_once dirname(__DIR__, 2) . '/system/app.php';
require_once dirname(__DIR__, 2) . '/system/database.php';

$pdo = $GLOBALS['pdo'] ?? connection();

// Ambil data summary
$totalCustomer = $pdo->query("SELECT COUNT(*) AS total FROM customers")->fetch()['total'] ?? 0;
$totalProduct = $pdo->query("SELECT COUNT(*) AS total FROM products")->fetch()['total'] ?? 0;
$totalOrder = $pdo->query("SELECT COUNT(*) AS total FROM orders")->fetch()['total'] ?? 0;

// Ambil transaksi terbaru
$stmt = $pdo->query("
    SELECT o.*, c.name AS customer_name 
    FROM orders o
    LEFT JOIN customers c ON o.customer_id = c.id
    ORDER BY o.id DESC LIMIT 5
");
$orders = $stmt->fetchAll();
?>
<head>
   <?php include __DIR__ . '/../assets/fontawesome.php'; ?>
</head>
<div class="space-y-6">
   <!-- Header -->
   <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
      <div class="flex items-center justify-between">
         <div>
            <h1 class="text-3xl font-bold text-black mb-2"><i class="fa-solid fa-chart-pie"></i> Dashboard</h1>
            <p class="text-gray-600">Selamat datang di sistem Halalood</p>
         </div>
         <div class="hidden md:flex items-center space-x-4">
            <div class="text-right">
               <p class="text-sm text-gray-500">Tanggal</p>
               <p class="font-semibold text-black"><?= date('d M Y') ?></p>
            </div>
         </div>
      </div>
   </div>

   <!-- Content -->
   <div class="space-y-6">
      <!-- Atur kartunya -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
         <!-- Total Transaksi -->
         <a href="dashboard.php?view=transaksi"
            class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-bright-green transition-all duration-200 cursor-pointer group">
            <div class="flex items-center justify-between">
               <div>
                  <p class="text-gray-500 text-sm font-medium">Total Transaksi</p>
                  <p class="text-3xl font-bold text-bright-green mt-2 group-hover:text-green-dark">
                     <?= htmlspecialchars($totalOrder) ?></p>
               </div>
               <div
                  class="w-12 h-12 bg-green-bg rounded-lg flex items-center justify-center group-hover:bg-bright-green group-hover:text-white transition-colors duration-200">
                  <span class="text-2xl"><i class="fa-solid fa-cart-shopping"></i></span>
               </div>
            </div>
         </a>

         <!-- Total Customer -->
         <a href="dashboard.php?view=master/customer/index"
            class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-bright-green transition-all duration-200 cursor-pointer group">
            <div class="flex items-center justify-between">
               <div>
                  <p class="text-gray-500 text-sm font-medium">Total Customer</p>
                  <p class="text-3xl font-bold text-bright-green mt-2 group-hover:text-green-dark">
                     <?= htmlspecialchars($totalCustomer) ?></p>
               </div>
               <div
                  class="w-12 h-12 bg-green-bg rounded-lg flex items-center justify-center group-hover:bg-bright-green group-hover:text-white transition-colors duration-200">
                  <span class="text-2xl"><i class="fa-solid fa-users"></i></span>
               </div>
            </div>
         </a>

         <!-- Total Produk -->
         <a href="dashboard.php?view=master/product/index"
            class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-bright-green transition-all duration-200 cursor-pointer group sm:col-span-2 lg:col-span-1">
            <div class="flex items-center justify-between">
               <div>
                  <p class="text-gray-500 text-sm font-medium">Total Produk</p>
                  <p class="text-3xl font-bold text-bright-green mt-2 group-hover:text-green-dark">
                     <?= htmlspecialchars($totalProduct) ?></p>
               </div>
               <div
                  class="w-12 h-12 bg-green-bg rounded-lg flex items-center justify-center group-hover:bg-bright-green group-hover:text-white transition-colors duration-200">
                  <span class="text-2xl"><i class="fa-solid fa-boxes-packing"></i></span>
               </div>
            </div>
         </a>
      </div>

      <!-- Riwayat Transaksi -->
      <div
         class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col max-h-[calc(100vh-200px)]">
         <div class="bg-bright-green p-6 flex-shrink-0">
            <h2 class="text-xl font-semibold text-white"><i class="fa-solid fa-cart-shopping"></i> Transaksi Terbaru</h2>
            <p class="text-green-100 text-sm mt-1">Riwayat transaksi terbaru</p>
         </div>
         <div class="flex-1 overflow-y-auto p-6">
            <div class="overflow-x-auto">
               <table class="w-full">
                  <thead>
                     <tr class="border-b border-gray-200">
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">ID</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Customer</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Total Produk</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Total Bayar</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php if ($orders): ?>
                        <?php foreach ($orders as $o): ?>
                           <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors duration-200">
                              <td class="py-4 px-4">
                                 <span class="bg-bright-green text-white px-3 py-1 rounded-full text-xs font-semibold">
                                    #<?= htmlspecialchars($o['id']) ?>
                                 </span>
                              </td>
                              <td class="py-4 px-4 font-medium text-black"><?= htmlspecialchars($o['customer_name']) ?></td>
                              <td class="py-4 px-4 text-gray-600"><?= htmlspecialchars($o['total_product']) ?></td>
                              <td class="py-4 px-4 font-semibold text-bright-green">Rp
                                 <?= number_format($o['total_payment'], 0, ',', '.') ?></td>
                              <td class="py-4 px-4 text-gray-600 text-sm"><?= htmlspecialchars($o['created_at']) ?></td>
                           </tr>
                        <?php endforeach; ?>
                     <?php else: ?>
                        <tr>
                           <td colspan="5" class="py-8 text-center text-gray-500">
                              <div class="flex flex-col items-center">
                                 <span class="text-4xl mb-2">📋</span>
                                 <p>Belum ada transaksi</p>
                              </div>
                           </td>
                        </tr>
                     <?php endif; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
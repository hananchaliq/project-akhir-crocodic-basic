<?php
require_once __DIR__ . '/../../../system/database.php';

// Ambil semua order
$result = $conn->query("
    SELECT o.id, o.total_product, o.total_payment, o.created_at, 
           a.name AS admin_name, c.name AS customer_name
    FROM orders o
    LEFT JOIN admins a ON o.admin_id = a.id
    LEFT JOIN customers c ON o.customer_id = c.id
    ORDER BY o.created_at DESC
");
?>

<div class="space-y-6">
   <!-- Content -->
   <div
      class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col max-h-[calc(100vh-50px)]"">
      <!-- Header -->
      <div class=" bg-bright-green p-6 flex-shrink-0">
      <div class="flex items-center justify-between">
         <div>
            <h1 class="text-xl font-semibold text-white"><i class="fa-solid fa-chart-simple"></i> Laporan Transaksi</h1>
            <p class="text-green-100 text-sm mt-1">Riwayat dan detail transaksi</p>
         </div>
         <div class="hidden md:flex items-center space-x-4">
            <a href="<?= DB_URL ?>actions/laporan/delete.php"
               class="bg-red-500 text-bright-white px-6 py-3 rounded-lg font-semibold hover:bg-red-600 transition-colors duration-200 shadow-md hover:shadow-lg flex items-center justify-center">
               <span class="flex items-center">
                  <span class="mr-2"><i class="fa-solid fa-minus"></i></span>
                  <span class="">Hapus Transaksi</span>
               </span>
            </a>
         </div>
      </div>
   </div>
   <!-- Transaction Report Table -->
   <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
      <div class="overflow-x-auto">
         <table class="w-full">
            <thead class="bg-gray-50">
               <tr class="border-b border-gray-200">
                  <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">ID</th>
                  <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                  <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">Kasir</th>
                  <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">Customer</th>
                  <th class="py-4 px-6 text-center text-sm font-semibold text-gray-700">Total Item</th>
                  <th class="py-4 px-6 text-right text-sm font-semibold text-gray-700">Total Bayar</th>
                  <th class="py-4 px-6 text-center text-sm font-semibold text-gray-700">Aksi</th>
               </tr>
            </thead>
            <tbody>
               <?php if ($result->num_rows > 0): ?>
                  <?php while ($row = $result->fetch_assoc()): ?>
                     <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors duration-200">
                        <td class="py-4 px-6">
                           <span class="bg-bright-green text-white px-3 py-1 rounded-full text-xs font-semibold">
                              #<?= $row['id'] ?>
                           </span>
                        </td>
                        <td class="py-4 px-6 text-gray-600"><?= date('d/m/Y H:i', strtotime($row['created_at'])) ?></td>
                        <td class="py-4 px-6 font-medium text-black"><?= htmlspecialchars($row['admin_name']) ?></td>
                        <td class="py-4 px-6 font-medium text-black"><?= htmlspecialchars($row['customer_name']) ?></td>
                        <td class="py-4 px-6 text-center text-gray-600"><?= $row['total_product'] ?></td>
                        <td class="py-4 px-6 text-right font-semibold text-bright-green">Rp
                           <?= number_format($row['total_payment'], 0, ',', '.') ?>
                        </td>
                        <td class="py-4 px-6 text-center">
                           <a href="<?= DB_URL ?>page/dashboard.php?view=master/laporan/detail&id=<?= $row['id'] ?>"
                              class="bg-blue-50 text-blue-600 py-2 px-3 rounded-lg text-sm font-medium hover:bg-blue-100 transition-colors duration-200">
                              📋 Detail
                           </a>
                        </td>
                     </tr>
                  <?php endwhile; ?>
               <?php else: ?>
                  <tr>
                     <td colspan="7" class="py-8 text-center text-gray-500">
                        <div class="flex flex-col items-center">
                           <span class="text-4xl mb-2">📊</span>
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
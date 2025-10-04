<?php
require_once __DIR__ . '/../../system/database.php'; // koneksi database

try {
   // 1. Hapus semua data di tabel anak dulu
   $conn->query("DELETE FROM order_products");

   // 2. Hapus semua data di tabel orders
   $conn->query("DELETE FROM orders");

   // 3. Reset AUTO_INCREMENT supaya ID mulai dari 1
   $conn->query("ALTER TABLE orders AUTO_INCREMENT = 1");
   $conn->query("ALTER TABLE order_products AUTO_INCREMENT = 1");

   // 4. Cek jalanin di browser atau terminal
   if (php_sapi_name() === 'cli') {
   } else {
      echo "<script>
                    alert('Transaksi berhasil dihapus!✔️');
                    window.location.href='../../page/dashboard.php?view=master/laporan/index';
            </script>";
      exit;
   }

} catch (Exception $e) {
   $error = $conn->error;
   if (php_sapi_name() === 'cli') {
   } else {
      echo "<script>
                    alert('Transaksi Gagal dihapus!❌');
                    window.location.href='../../page/dashboard.php?view=master/laporan/index';
            </script>";
      exit;
   }
}


?>
<?php
require_once __DIR__ . '/../../system/database.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // cek admin punya transaksi tidak
    $stmt = $conn->prepare("SELECT COUNT(*) FROM orders WHERE admin_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($orderCount);
    $stmt->fetch();
    $stmt->close();

    if ($orderCount > 0) {
        echo "<script>
                alert('Admin tidak bisa dihapus karena sudah memiliki transaksi!');
                window.location.href='../../page/dashboard.php?view=master/admin/index';
              </script>";
        exit;
    }

    // kalau tra ada transaksi, hapus admin
    $stmt = $conn->prepare("DELETE FROM admins WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>
                alert('Admin berhasil dihapus!');
                window.location.href='../../page/dashboard.php?view=master/admin/index';
              </script>";
    } else {
        echo "<script>
                alert('Gagal hapus admin: " . addslashes($conn->error) . "');
                window.location.href='../../page/dashboard.php?view=master/admin/index';
              </script>";
    }
} else {
    echo "<script>
            alert('ID tidak ditemukan!');
            window.location.href='../../page/dashboard.php?view=master/admin/index';
          </script>";
}

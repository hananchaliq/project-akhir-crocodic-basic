    <?php
    require_once __DIR__ . '/../../system/database.php';

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);

        // Cek apakah customer punya orders
        $stmt = $conn->prepare("SELECT COUNT(*) FROM orders WHERE customer_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($orderCount);
        $stmt->fetch();
        $stmt->close();

        if ($orderCount > 0) {
            // Kalau ada transaksi
            echo "<script>
                    alert('Customer tidak bisa dihapus karena sudah memiliki transaksi!');
                    window.location.href='" . DB_URL . "page/dashboard.php?view=master/customer/index';
                </script>";
            exit;
        }

        // Kalau tidak ada transaksi, hapus customer
        $stmt = $conn->prepare("DELETE FROM customers WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Customer berhasil dihapus!');
                    window.location.href='" . DB_URL . "page/dashboard.php?view=master/customer/index';
                </script>";
            exit;
        } else {
            echo "<script>
                    alert('Gagal hapus customer: " . addslashes($conn->error) . "');
                    window.location.href='" . DB_URL . "page/dashboard.php?view=master/customer/index';
                </script>";
            exit;
        }
    } else {
        echo "<script>
                alert('ID tidak ditemukan!');
                window.location.href='" . DB_URL . "page/dashboard.php?view=master/customer/index';
            </script>";
        exit;
    }

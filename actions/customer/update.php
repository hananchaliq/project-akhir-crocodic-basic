<?php
require_once __DIR__ . '/../../system/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $id      = intval($_POST['id']);
    $name    = trim($_POST['name']);
    $phone   = trim($_POST['phone']);
    $address = trim($_POST['address']);

    $stmt = $conn->prepare("UPDATE customers SET name=?, phone=?, address=? WHERE id=?");
    $stmt->bind_param("sssi", $name, $phone, $address, $id);

    if ($stmt->execute()) {
        header("Location: " . DB_URL . "page/dashboard.php?view=master/customer/index&success=Customer berhasil diperbarui");
        exit;
    } else {
        die("Error update customer: " . $conn->error);
    }
}

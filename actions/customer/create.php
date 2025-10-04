<?php
require_once __DIR__ . '/../../system/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name']);
    $phone   = trim($_POST['phone']);
    $address = trim($_POST['address']);

    $stmt = $conn->prepare("INSERT INTO customers (name, phone, address) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $phone, $address);


    if ($stmt->execute()) {
        header("Location: ../../page/dashboard.php?view=master/customer/index&success=Customer berhasil ditambahkan");
        exit;
    } else {
        die("Error simpan customer: " . $conn->error);
    }
}

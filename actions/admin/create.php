<?php
require_once __DIR__ . '/../../system/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($name === '' || $email === '' || $password === '') {
        header("Location: ../../page/dashboard.php?view=master/admin/create&error=Semua field wajib diisi");
        exit;
    }

    $passwordHash = md5($password);

    $stmt = $conn->prepare("INSERT INTO admins (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $passwordHash);

    if ($stmt->execute()) {
        header("Location: ../../page/dashboard.php?view=master/admin/index&success=Admin berhasil ditambahkan");
        exit;
    } else {
        die("Error simpan admin: " . $conn->error);
    }
} else {
    header("Location: ../../page/dashboard.php?view=master/admin/index");
    exit;
}

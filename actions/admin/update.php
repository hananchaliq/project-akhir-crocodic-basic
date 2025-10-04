<?php
require_once __DIR__ . '/../../system/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id       = intval($_POST['id']);
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($name === '' || $email === '') {
        header("Location: ../../page/dashboard.php?view=master/admin/update&id=$id&error=Nama dan email wajib diisi");
        exit;
    }

    if ($password !== '') {
        // ✅ Hash password dengan bcrypt
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE admins SET name=?, email=?, password=? WHERE id=?");
        $stmt->bind_param("sssi", $name, $email, $passwordHash, $id);
    } else {
        $stmt = $conn->prepare("UPDATE admins SET name=?, email=? WHERE id=?");
        $stmt->bind_param("ssi", $name, $email, $id);
    }

    if ($stmt->execute()) {
        header("Location: ../../page/dashboard.php?view=master/admin/index&success=Admin berhasil diperbarui");
        exit;
    } else {
        die("Error update admin: " . $conn->error);
    }
} else {
    header("Location: ../../page/dashboard.php?view=master/admin/index");
    exit;
}

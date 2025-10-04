<?php
// ../actions/login.php
include __DIR__ . '/../system/database.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // cek apakah email ada di database
    $stmt = $conn->prepare("SELECT id, name, password FROM admins WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // verifikasi password hash
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_name'] = $row['name'];
            
            header("Location: /halalood/page/dashboard.php");
            exit;
        } else {
            header("Location: /halalood/page/login.php?error=Password salah");
            exit;
        }

    } else {
        // email ga ketemu
        header("Location: ../page/login.php?error=Email tidak ditemukan");
        exit;
    }
} else {
    header("Location: ../page/login.php");
    exit;
}

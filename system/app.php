<?php
require_once __DIR__ . '/config.php';

function url($path) {
    return DB_URL . $path;
}

function render($view) {
    $basepage = "page";
    $render = @include "$basepage/$view.php";
    if (!$render) {
        @include "$basepage/$view/index.php";
    }
}

function redirect($path) {
    $url = url($path);
    header("Location: $url");
    exit;
}

function connection() {
    try {
        $server = DB_HOST;
        $database = DB_NAME;
        $username = DB_USER;
        $password = DB_PASS;
        
        $pdo = new PDO(
            "mysql:host={$server};dbname={$database}",
            $username,
            $password,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        return $pdo;
    } catch (Exception $e) {
        die("Gagal koneksi => " . $e->getMessage());
    }
}

/** ✅ Tambahkan ini */
function app_path($path = '') {
    return __DIR__ . '/../' . ltrim($path, '/');
}

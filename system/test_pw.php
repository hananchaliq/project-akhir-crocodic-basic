<?php
$password = '12345';

// Generate bcrypt (default cost)
$hash = password_hash($password, PASSWORD_BCRYPT);
echo "Bcrypt hash: " . $hash . PHP_EOL;

// Verifikasi
$input = '12345';
if (password_verify($input, $hash)) {
    echo "Password cocok\n";
} else {
    echo "Password salah\n";
}

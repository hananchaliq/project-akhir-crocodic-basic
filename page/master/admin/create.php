<?php
require_once __DIR__ . '/../../../system/database.php';
?>

<h2 class="text-2xl font-bold mb-4">Tambah Admin</h2>

<form action="halalood/actions/admin/create.php" method="POST" class="space-y-4 max-w-md">
    <div>
        <label class="block font-medium">Nama</label>
        <input type="text" name="name" required class="w-full border rounded-lg p-2">
    </div>
    <div>
        <label class="block font-medium">Email</label>
        <input type="email" name="email" required class="w-full border rounded-lg p-2">
    </div>
    <div>
        <label class="block font-medium">Password</label>
        <input type="password" name="password" required class="w-full border rounded-lg p-2">
    </div>
    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg shadow hover:bg-green-700">
        Simpan
    </button>
</form>

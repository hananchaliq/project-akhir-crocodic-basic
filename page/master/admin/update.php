<?php
require_once __DIR__ . '/../../../system/database.php';

$id = $_GET['id'] ?? 0;
$stmt = $conn->prepare("SELECT * FROM admins WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$admin = $stmt->get_result()->fetch_assoc();
?>

<h2 class="text-2xl font-bold mb-4">Edit Admin</h2>

<form action="/halalood/actions/admin/update.php" method="POST" class="space-y-4 max-w-md">
    <input type="hidden" name="id" value="<?= $admin['id'] ?>">
    <div>
        <label class="block font-medium">Nama</label>
        <input type="text" name="name" value="<?= $admin['name'] ?>" required class="w-full border rounded-lg p-2">
    </div>
    <div>
        <label class="block font-medium">Email</label>
        <input type="email" name="email" value="<?= $admin['email'] ?>" required class="w-full border rounded-lg p-2">
    </div>
    <div>
        <label class="block font-medium">Password (kosongkan jika tidak diubah)</label>
        <input type="password" name="password" class="w-full border rounded-lg p-2">
    </div>
    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-700">
        Update
    </button>
</form>

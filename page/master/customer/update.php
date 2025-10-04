<?php
require_once __DIR__ . '/../../../system/database.php';

$id = $_GET['id'] ?? 0;
$stmt = $conn->prepare("SELECT * FROM customers WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$customer = $stmt->get_result()->fetch_assoc();
?>

<h2 class="text-2xl font-bold mb-4">✏️ Edit Customer</h2>

<form action="/halalood/actions/customer/update.php" method="POST" class="space-y-4 max-w-md">
    <input type="hidden" name="id" value="<?= $customer['id'] ?>">
    <div>
        <label class="block font-medium">Nama</label>
        <input type="text" name="name" value="<?= $customer['name'] ?>" required class="w-full border rounded-lg p-2">
    </div>
    <div>
        <label class="block font-medium">Telepon</label>
        <input type="text" name="phone" value="<?= $customer['phone'] ?>" required class="w-full border rounded-lg p-2">
    </div>
    <div>
        <label class="block font-medium">Alamat</label>
        <textarea name="address" required class="w-full border rounded-lg p-2"><?= $customer['address'] ?></textarea>
    </div>
    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-700">
        Update
    </button>
</form>

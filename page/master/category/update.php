<?php
require_once __DIR__ . '/../../../system/database.php';

$id = $_GET['id'] ?? 0;
$stmt = $conn->prepare("SELECT * FROM categories WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$category = $stmt->get_result()->fetch_assoc();
?>

<h2 class="text-2xl font-bold mb-4">Edit Category</h2>

<form action="/halalood/actions/category/update.php" method="POST" class="space-y-4 max-w-md">
    <input type="hidden" name="id" value="<?= $category['id'] ?>">
    <div>
        <label class="block font-medium">Nama Category</label>
        <input type="text" name="name" value="<?= $category['name'] ?>" required class="w-full border rounded-lg p-2">
    </div>
    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-700">
        Update
    </button>
</form>

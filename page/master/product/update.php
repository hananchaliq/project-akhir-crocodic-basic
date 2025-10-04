<?php
require_once __DIR__ . '/../../../system/database.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID produk tidak ditemukan");
}

$result = $conn->prepare("SELECT * FROM products WHERE id=?");
$result->bind_param("i", $id);
$result->execute();
$product = $result->get_result()->fetch_assoc();

if (!$product) {
    die("Produk tidak ditemukan");
}
?>

<h2 class="text-2xl font-bold mb-4">Edit Product</h2>

<form action="/halalood/actions/product/update.php" method="POST" enctype="multipart/form-data" class="space-y-4">
    <input type="hidden" name="id" value="<?= $product['id'] ?>">

    <div>
        <label class="block font-medium">Nama Produk</label>
        <input type="text" name="name" value="<?= $product['name'] ?>" required class="w-full border rounded p-2">
    </div>

    <div>
        <label class="block font-medium">Kategori</label>
        <select name="category_id" required class="w-full border rounded p-2">
            <?php
            $cats = $conn->query("SELECT * FROM categories ORDER BY name ASC");
            while ($c = $cats->fetch_assoc()):
                $selected = $c['id'] == $product['category_id'] ? "selected" : "";
                echo "<option value='{$c['id']}' $selected>{$c['name']}</option>";
            endwhile;
            ?>
        </select>
    </div>

    <div>
        <label class="block font-medium">Harga</label>
        <input type="number" name="price" value="<?= $product['price'] ?>" required class="w-full border rounded p-2">
    </div>

    <div>
        <label class="block font-medium">Stok</label>
        <input type="number" name="stock" value="<?= $product['stock'] ?>" required class="w-full border rounded p-2">
    </div>

    <div>
        <label class="block font-medium">Gambar Produk</label><br>
        <?php if ($product['image']): ?>
            <img src="<?= DB_URL . '/' . $product['image'] ?>" class="h-20 w-20 object-cover rounded mb-2">
        <?php endif; ?>
        <input type="file" name="image" accept="image/*" class="w-full border rounded p-2">
        <p class="text-sm text-gray-500">Kosongkan jika tidak ingin mengganti gambar.</p>
    </div>

    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
</form>

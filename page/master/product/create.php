<?php
require_once __DIR__ . '/../../../system/database.php';
?>

<h2 class="text-2xl font-bold mb-4"> Tambah Produk</h2>

<form action="halalood/actions/product/create.php" method="POST" enctype="multipart/form-data" class="space-y-4">
    <div>
        <label class="block font-medium">Nama Produk</label>
        <input type="text" name="name" required class="w-full border rounded p-2">
    </div>

    <div>
        <label class="block font-medium">Kategori</label>
        <select name="category_id" required class="w-full border rounded p-2">
            <option value="">-- Pilih Kategori --</option>
            <?php
            $cats = $conn->query("SELECT * FROM categories ORDER BY name ASC");
            while ($c = $cats->fetch_assoc()) {
                echo "<option value='{$c['id']}'>{$c['name']}</option>";
            }
            ?>
        </select>
    </div>

    <div>
        <label class="block font-medium">Harga</label>
        <input type="number" name="price" required class="w-full border rounded p-2">
    </div>

    <div>
        <label class="block font-medium">Stok</label>
        <input type="number" name="stock" required class="w-full border rounded p-2">
    </div>

    <div>
        <label class="block font-medium">Gambar Produk</label>
        <input type="file" name="image" accept="image/*" class="w-full border rounded p-2">
    </div>

    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
</form>


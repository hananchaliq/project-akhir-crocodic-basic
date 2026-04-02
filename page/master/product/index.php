<?php
require_once __DIR__ . '/../../../system/database.php';
?>

<div class="space-y-6">
    <!-- Content -->
    <div>
        <!-- Products Container -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col max-h-[calc(100vh-50px)]">
            <!-- Header -->
            <div class="bg-bright-green p-6 flex-shrink-0 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-white"><i class="fa-solid fa-boxes-packing"></i> Daftar Produk</h2>
                    <p class="text-green-100 text-sm mt-1">Kelola produk dan inventori</p>
                </div>
                <a href="<?= DB_URL ?>page/dashboard.php?view=master/product/create" 
                   class="bg-white text-bright-green px-6 py-3 rounded-lg font-semibold hover:bg-gray-50 transition-colors duration-200 shadow-md hover:shadow-lg flex items-center justify-center">
                    <span class="mr-2"><i class="fa-solid fa-plus"></i></span>
                    <span>Tambah Produk</span>
                </a>
            </div>
            <div class="flex-1 overflow-y-auto p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Gambar</th>
                                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Nama Produk</th>
                                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Kategori</th>
                                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Harga</th>
                                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Stok</th>
                                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = $conn->query("SELECT p.*, c.name AS category_name 
                                                    FROM products p 
                                                    LEFT JOIN categories c ON p.category_id = c.id 
                                                    WHERE p.is_active=1 ORDER BY p.id DESC");
                            while ($row = $result->fetch_assoc()):
                            ?>
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors duration-200">
                                <td class="py-4 px-4">
                                    <div class="w-16 h-16 overflow-hidden bg-gray-100 rounded-lg">
                                        <?php if ($row['image']): ?>
                                            <img src="<?= DB_URL . '/' . $row['image'] ?>" 
                                                 alt="<?= htmlspecialchars($row['name']) ?>" 
                                                 class="w-full h-full object-cover">
                                        <?php else: ?>
                                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                <span class="text-2xl">📦</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="font-medium text-black"><?= htmlspecialchars($row['name']) ?></div>
                                </td>
                                <td class="py-4 px-4">
                                    <span class="bg-green-bg text-bright-green px-3 py-1 rounded-full text-xs font-semibold">
                                        <?= htmlspecialchars($row['category_name']) ?>
                                    </span>
                                </td>
                                <td class="py-4 px-4 font-semibold text-bright-green">Rp <?= number_format($row['price'], 0, ',', '.') ?></td>
                                <td class="py-4 px-4">
                                    <span class="font-semibold <?= $row['stock'] > 0 ? 'text-green-600' : 'text-red-600' ?>">
                                        <?= $row['stock'] ?>
                                    </span>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="flex space-x-2">
                                        <a href="<?= DB_URL ?>page/dashboard.php?view=master/product/update&id=<?= $row['id'] ?>" 
                                           class="bg-blue-50 text-blue-600 py-2 px-3 rounded-lg text-center text-sm font-medium hover:bg-blue-100 transition-colors duration-200">
                                            <i class="fa-solid fa-pen"></i> Edit
                                        </a>
                                        <a href="<?= DB_URL ?>actions/product/delete.php?id=<?= $row['id'] ?>" 
                                           class="bg-red-50 text-red-600 py-2 px-3 rounded-lg text-center text-sm font-medium hover:bg-red-100 transition-colors duration-200"
                                           onclick="return confirm('Yakin hapus produk ini?')">
                                            <i class="fa-solid fa-trash"></i> Hapus
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Empty State -->
                <?php if ($result->num_rows === 0): ?>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                    <span class="text-6xl mb-4 block">📦</span>
                    <h3 class="text-xl font-semibold text-black mb-2">Belum ada produk</h3>
                    <p class="text-gray-600 mb-6">Mulai dengan menambahkan produk pertama Anda</p>
                    <a href="<?= DB_URL ?>page/dashboard.php?view=master/product/create" 
                       class="bg-bright-green text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-dark transition-colors duration-200 shadow-md hover:shadow-lg">
                        Tambah Produk Pertama
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

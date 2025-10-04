<?php
require_once __DIR__ . '/../../../system/database.php';
?>

<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-black mb-2"><i class="fa-solid fa-user-tie"></i> Daftar Admin</h1>
                <p class="text-gray-600">Kelola data administrator</p>
            </div>
            <a href="dashboard.php?view=master/admin/create" 
               class="mt-4 sm:mt-0 bg-bright-green text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-dark transition-colors duration-200 shadow-md hover:shadow-lg">
                <span class="flex items-center">
                    <span class="mr-2"><i class="fa-solid fa-plus"></i></span>
                    Tambah Admin
                </span>
            </a>
        </div>
    </div>

    <!-- Content -->
    <div>
        <!-- Admin Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr class="border-b border-gray-200">
                    <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">ID</th>
                    <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">Nama</th>
                    <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">Email</th>
                    <th class="py-4 px-6 text-center text-sm font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM admins ORDER BY id DESC");
                if ($result->num_rows > 0):
                    while ($row = $result->fetch_assoc()):
                ?>
                <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors duration-200">
                    <td class="py-4 px-6">
                        <span class="bg-bright-green text-white px-3 py-1 rounded-full text-xs font-semibold">
                            #<?= $row['id'] ?>
                        </span>
                    </td>
                    <td class="py-4 px-6 font-medium text-black"><?= htmlspecialchars($row['name']) ?></td>
                    <td class="py-4 px-6 text-gray-600"><?= htmlspecialchars($row['email']) ?></td>
                    <td class="py-4 px-6 text-center">
                        <div class="flex justify-center space-x-2">
                            <a href="dashboard.php?view=master/admin/update&id=<?= $row['id'] ?>" 
                               class="bg-blue-50 text-blue-600 py-2 px-3 rounded-lg text-sm font-medium hover:bg-blue-100 transition-colors duration-200">
                                <i class="fa-solid fa-pen"></i> Edit
                            </a>
                            <a href="/halalood/actions/admin/delete.php?id=<?= $row['id'] ?>" 
                               class="bg-red-50 text-red-600 py-2 px-3 rounded-lg text-sm font-medium hover:bg-red-100 transition-colors duration-200"
                               onclick="return confirm('Yakin hapus admin?')">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </a>
                        </div>
                    </td>
                </tr>
                <?php 
                    endwhile;
                else:
                ?>
                <tr>
                    <td colspan="4" class="py-8 text-center text-gray-500">
                        <div class="flex flex-col items-center">
                            <span class="text-4xl mb-2">👨‍💼</span>
                            <p>Belum ada admin</p>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
        </div>
    </div>
</div>

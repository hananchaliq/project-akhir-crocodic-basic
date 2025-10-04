<?php
require_once __DIR__ . '/../../../system/database.php';
?>

<div class="space-y-6">
   <!-- Content -->
   <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col max-h-[calc(100vh-50px)]">
      <!-- Header -->
      <div class="bg-bright-green p-6 flex-shrink-0">
         <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
               <h1 class="text-xl font-semibold text-white"><i class="fa-solid fa-users"></i> Daftar Customer</h1>
               <p class="text-green-100 text-sm mt-1">Kelola data pelanggan</p>
            </div>
            <a href="dashboard.php?view=master/customer/create"
               class="bg-white text-bright-green px-6 py-3 rounded-lg font-semibold hover:bg-gray-50 transition-colors duration-200 shadow-md hover:shadow-lg flex items-center justify-center">
               <span class="flex items-center">
                  <span class="mr-2"><i class="fa-solid fa-plus"></i></span>
                  <span>Tambah Customer</span>
               </span>
            </a>
         </div>
      </div>
      <!-- Customer Table -->
      <div class="overflow-y-auto flex-1">
         <div class="overflow-x-auto">
            <table class="w-full">
               <thead class="bg-gray-50">
                  <tr class="border-b border-gray-200">
                     <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">ID</th>
                     <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">Nama</th>
                     <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">Telepon</th>
                     <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">Alamat</th>
                     <th class="py-4 px-6 text-center text-sm font-semibold text-gray-700">Aksi</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  $result = $conn->query("SELECT * FROM customers ORDER BY id DESC");
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
                           <td class="py-4 px-6 text-gray-600"><?= htmlspecialchars($row['phone']) ?></td>
                           <td class="py-4 px-6 text-gray-600"><?= htmlspecialchars($row['address']) ?></td>
                           <td class="py-4 px-6 text-center">
                              <div class="flex justify-center space-x-2">
                                 <a href="dashboard.php?view=master/customer/update&id=<?= $row['id'] ?>"
                                    class="bg-blue-50 text-blue-600 py-2 px-3 rounded-lg text-sm font-medium hover:bg-blue-100 transition-colors duration-200">
                                    <i class="fa-solid fa-pen"></i> Edit
                                 </a>
                                 <a href="/pj/actions/customer/delete.php?id=<?= $row['id'] ?>"
                                    class="bg-red-50 text-red-600 py-2 px-3 rounded-lg text-sm font-medium hover:bg-red-100 transition-colors duration-200"
                                    onclick="return confirm('Yakin hapus customer?')">
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
                        <td colspan="5" class="py-8 text-center text-gray-500">
                           <div class="flex flex-col items-center">
                              <span class="text-4xl mb-2">👥</span>
                              <p>Belum ada customer</p>
                           </div>
                        </td>
                     </tr>
                  <?php endif; ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
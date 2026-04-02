<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
   header("Location: /halalood/page/login.php");
   exit;
}


$view = $_GET['view'] ?? 'dashboard/index';
$file = __DIR__ . '/' . $view . '.php';

if (!file_exists($file)) {
   $file = __DIR__ . '/../' . $view . '.php';
}

error_log("Mencari file: $file");
error_log("File exists: " . (file_exists($file) ? 'YES' : 'NO'));
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Halalood - Dashboard</title>
   <script src="https://cdn.tailwindcss.com"></script>
   <?php include __DIR__ . '/assets/fontawesome.php'; ?>
   <script>
      tailwind.config = {
         theme: {
            extend: {
               colors: {
                  'bright-green': '#00C851',
                  'green-dark': '#00A041',
                  'green-light': '#4CAF50',
                  'green-bg': '#F1F8E9'
               }
            }
         }
      }
   </script>
   <style>
      .mobile-menu {
         display: none;
      }

      .desktop-sidebar {
         position: fixed !important;
         top: 0;
         left: 0;
         height: 100vh !important;
         z-index: 50;
      }

      @media (max-width: 1024px) {
         .mobile-menu {
            display: block;
         }

         .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 40;
         }
      }

      @media (min-width: 1025px) {
         .main-content {
            margin-left: 256px;
            /* 64 * 4 = 256px for w-64 */
         }
      }
   </style>
</head>

<body class="bg-gray-50">
   <!-- Mobile Menu Button -->
   <div class="mobile-menu xl:hidden fixed top-4 left-4 z-50">
      <button onclick="toggleSidebar()" class="bg-bright-green text-white p-3 rounded-lg shadow-lg">
         <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
         </svg>
      </button>
   </div>

   <!-- Sidebar Overlay for Mobile -->
   <div id="sidebarOverlay" class="sidebar-overlay hidden" onclick="toggleSidebar()"></div>

   <!-- Sidebar -->
   <aside id="sidebar"class="desktop-sidebar w-64 bg-gradient-to-br from-bright-green via-green-light to-green-dark shadow-xl border-r border-gray-200 transform -translate-x-full xl:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col">
      <div class="p-4">
         <div class="flex items-center justify-between mb-8">
            <div class="flex items-center">
               <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center mr-3">
                  <span class="text-bright-green font-bold text-lg">H</span>
               </div>
               <h2 class="text-xl font-bold text-white">Halalood</h2>
            </div>
            <button onclick="toggleSidebar()" class="xl:hidden text-white">
               <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
               </svg>
            </button>
         </div>
      </div>
      <nav class="flex-1 px-4 pb-4 space-y-2">
         <a href="<?= DB_URL ?>page/dashboard.php?view=dashboard/index"
            class="flex items-center px-4 py-3 rounded-lg text-white hover:bg-white hover:bg-opacity-20 hover:text-white transition-colors duration-200">
            <span class="mr-3"><i class="fa-solid fa-chart-pie"></i></span> Dashboard
         </a>
         <a href="<?= DB_URL ?>page/dashboard.php?view=transaksi"
            class="flex items-center px-4 py-3 rounded-lg text-white hover:bg-white hover:bg-opacity-20 hover:text-white transition-colors duration-200">
            <span class="mr-3"><i class="fa-solid fa-cart-shopping"></i></span> Transaksi
         </a>
         <a href="<?= DB_URL ?>page/dashboard.php?view=master/customer/index"
            class="flex items-center px-4 py-3 rounded-lg text-white hover:bg-white hover:bg-opacity-20 hover:text-white transition-colors duration-200">
            <span class="mr-3"><i class="fa-solid fa-users"></i></span> Customer
         </a>
         <a href="<?= DB_URL ?>page/dashboard.php?view=master/category/index"
            class="flex items-center px-4 py-3 rounded-lg text-white hover:bg-white hover:bg-opacity-20 hover:text-white transition-colors duration-200">
            <span class="mr-3"><i class="fa-solid fa-layer-group"></i></span> Category
         </a>
         <a href="<?= DB_URL ?>page/dashboard.php?view=master/product/index"
            class="flex items-center px-4 py-3 rounded-lg text-white hover:bg-white hover:bg-opacity-20 hover:text-white transition-colors duration-200">
            <span class="mr-3"><i class="fa-solid fa-boxes-packing"></i></span> Product
         </a>
         <a href="<?= DB_URL ?>page/dashboard.php?view=master/admin/index"
            class="flex items-center px-4 py-3 rounded-lg text-white hover:bg-white hover:bg-opacity-20 hover:text-white transition-colors duration-200">
            <span class="mr-3"><i class="fa-solid fa-user-tie"></i></span> Admin
         </a>
         <a href="<?= DB_URL ?>page/dashboard.php?view=master/laporan/index"
            class="flex items-center px-4 py-3 rounded-lg text-white hover:bg-white hover:bg-opacity-20 hover:text-white transition-colors duration-200">
            <span class="mr-3"><i class="fa-solid fa-database"></i></span> Laporan
         </a>
         <div class="border-t border-white border-opacity-30 my-4"></div>
         <a href="<?= DB_URL ?>actions/logout.php"
            class="flex items-center px-4 py-3 rounded-lg text-white hover:bg-red-500 hover:bg-opacity-20 hover:text-white transition-colors duration-200">
            <span class="mr-3"><i class="fa-solid fa-arrow-right-from-bracket"></i></span> Logout
         </a>
      </nav>
   </aside>

   <!-- Content -->
   <main class="main-content min-h-screen p-4 lg:p-6">
      <?php
      // DEBUG INFO
      echo "<!-- Mencari file: $file -->";
      echo "<!-- File exists: " . (file_exists($file) ? 'YES' : 'NO') . " -->";

      if (file_exists($file)) {
         include $file;
      } else {
         echo "<div class='bg-red-100 border border-red-400 text-red-700 p-4 rounded'>";
         echo "<h3 class='font-bold'>Error 404 - Halaman Tidak Ditemukan</h3>";
         echo "<p>File: " . htmlspecialchars($file) . "</p>";
         echo "<p class='text-sm'>Pastikan file ada di folder page/</p>";
         echo "</div>";
      }
      ?>
   </main>

   <script>
      function toggleSidebar() {
         const sidebar = document.getElementById('sidebar');
         const overlay = document.getElementById('sidebarOverlay');

         if (sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
         } else {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
         }
      }

      // Close sidebar when clicking outside on mobile
      document.addEventListener('click', function (event) {
         const sidebar = document.getElementById('sidebar');
         const mobileMenu = document.querySelector('.mobile-menu');

         if (window.innerWidth <= 1024 &&
            !sidebar.contains(event.target) &&
            !mobileMenu.contains(event.target) &&
            !sidebar.classList.contains('-translate-x-full')) {
            toggleSidebar();
         }
      });
   </script>
</body>

</html>
<?php
session_start();
if (isset($_SESSION['admin_id'])) {
   header("Location: /../halalood/page/dashboard.php");
   exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Halalood - Login</title>
   <script src="https://cdn.tailwindcss.com"></script>
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
      body {
         background: linear-gradient(-45deg, #ff9a9e, #fad0c4, #a1c4fd, #c2e9fb);
         background-size: 400% 400%;
         animation: gradientBG 15s ease infinite;
      }

      @keyframes gradientBG {
         0% {
            background-position: 0% 50%;
         }

         50% {
            background-position: 100% 50%;
         }

         100% {
            background-position: 0% 50%;
         }
      }
   </style>
</head>

<body
   class="min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
   <!-- Background Pattern -->
   <div class="absolute inset-0 bg-black bg-opacity-10"></div>
   <div class="absolute top-0 left-0 w-full h-full">
      <div class="absolute top-20 left-20 w-32 h-32 bg-white bg-opacity-10 rounded-full blur-xl"></div>
      <div class="absolute bottom-20 right-20 w-48 h-48 bg-white bg-opacity-10 rounded-full blur-xl"></div>
      <div
         class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-white bg-opacity-5 rounded-full blur-2xl">
      </div>
   </div>

   <div
      class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-md border border-gray-200 relative z-10 backdrop-blur-sm bg-opacity-95">
      <!-- Logo/Header -->
      <div class="text-center mb-8">
         <div class="w-16 h-16 bg-bright-green rounded-xl mx-auto mb-4 flex items-center justify-center">
            <span class="text-white font-bold text-2xl">H</span>
         </div>
         <h2 class="text-3xl font-bold text-black mb-2">Halalood</h2>
         <p class="text-gray-600 text-sm">Sistem Kasir Modern</p>
      </div>

      <?php if (isset($_GET['error'])): ?>
         <div class="bg-red-50 border-l-4 border-red-400 text-red-700 px-4 py-3 rounded mb-6 flex items-center">
            <span class="text-xl mr-2">⚠️</span>
            <span class="text-sm"><?= htmlspecialchars($_GET['error']) ?></span>
         </div>
      <?php endif; ?>

      <form action="/../halalood/actions/login.php" method="POST" class="space-y-6">
         <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700">Email</label>
            <div class="relative">
               <input type="email" name="email" required
                  class="w-full border-2 border-gray-200 rounded-lg p-4 pl-12 focus:border-bright-green focus:ring-2 focus:ring-bright-green focus:ring-opacity-20 transition-all duration-200"
                  placeholder="admin@example.com">
               <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">📧</span>
            </div>
         </div>

         <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700">Password</label>
            <div class="relative">
               <input type="password" name="password" required
                  class="w-full border-2 border-gray-200 rounded-lg p-4 pl-12 focus:border-bright-green focus:ring-2 focus:ring-bright-green focus:ring-opacity-20 transition-all duration-200"
                  placeholder="Masukkan password">
               <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">🔒</span>
            </div>
         </div>

         <button type="submit"
            class="w-full bg-bright-green text-white py-4 rounded-lg font-semibold hover:bg-green-dark transition-colors duration-200 shadow-md hover:shadow-lg">
            <span class="flex items-center justify-center">
               <span class="mr-2">🚀</span>
               Masuk ke Dashboard
            </span>
         </button>
      </form>

      <!-- Footer -->
      <div class="mt-8 text-center">
         <p class="text-xs text-gray-500">© 2024 Halalood System</p>
      </div>
   </div>
</body>

</html>
<?php
require_once __DIR__ . '/../system/database.php';

// Auto print struk setelah transaksi
if (isset($_GET['printStruk']) && !empty($_GET['printStruk'])) {
   $order_id = $_GET['printStruk'];
   echo "<script>
        window.open('../struk.php?id={$order_id}&autoPrint=1', '_blank');
    </script>";
}

if (!isset($_SESSION['admin_id'])) {
   header("Location: login.php");
   exit;
}

$products = $conn->query("SELECT p.*, c.name as category_name 
                          FROM products p 
                          LEFT JOIN categories c ON p.category_id = c.id 
                          WHERE p.is_active=1 ORDER BY p.id DESC");

// Ambil customer
$customers = $conn->query("SELECT * FROM customers ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Halalood - Transaksi</title>
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
      .fixed-cart {
         position: sticky;
         top: 24px;
         height: calc(100vh - 200px);
      }

      .product-container {
         height: calc(100vh - 200px);
      }

      @media (max-width: 1024px) {
         .fixed-cart {
            position: relative;
            top: auto;
            height: auto;
         }

         .product-container {
            height: auto;
         }
      }
   </style>
</head>

<body class="bg-gray-50">
   <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col max-h-[calc(100vh-50px)]"">
      <div class="">
         <!-- Header -->
         <div class="bg-bright-green p-6 flex-shrink-0">
            <h1 class="text-3xl font-semibold text-white"><i class="fa-solid fa-cart-shopping"></i> Transaksi</h1>
            <p class="text-green-100 text-sm mt-1">Pilih produk dan lakukan transaksi</p>
         </div>

         <!-- Notifikasi Success/Error -->
         <?php if (isset($_GET['success'])): ?>
            <div class="bg-green-50 border-l-4 border-green-400 text-green-700 px-4 py-3 flex items-center">
               <span class="text-xl mr-2">✅</span>
               <span class="text-sm"><?= htmlspecialchars($_GET['success']) ?></span>
            </div>
         <?php endif; ?>

         <?php if (isset($_GET['error'])): ?>
            <div class="bg-red-50 border-l-4 border-red-400 text-red-700 px-4 py-3 rounded flex items-center">
               <span class="text-xl mr-2">⚠️</span>
               <span class="text-sm"><?= htmlspecialchars($_GET['error']) ?></span>
            </div>
         <?php endif; ?>

         <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Produk -->
            <div class="lg:col-span-2">
               <div
                  class="bg-white shadow-sm border overflow-hidden flex flex-col product-container">
                  <div class="p-6 border-b flex-shrink-0">
                     <h2 class="text-xl font-semibold text-black"><i class="fa-solid fa-boxes-packing"></i> Daftar
                        Produk</h2>
                  </div>
                  <div class="p-6 overflow-y-auto flex-1">
                     <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
                        <?php while ($row = $products->fetch_assoc()): ?>
                           <div
                              class="bg-gray-50 rounded-lg p-4 hover:shadow-md transition-all duration-200 borde group">
                              <div class="aspect-square mb-3 overflow-hidden rounded-lg">
                                 <?php if ($row['image']): ?>
                                    <img src="<?= DB_URL . '/' . $row['image'] ?>" alt="<?= htmlspecialchars($row['name']) ?>"
                                       class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200">
                                 <?php else: ?>
                                    <div
                                       class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-500 rounded-lg">
                                       <span class="text-2xl">📦</span>
                                    </div>
                                 <?php endif; ?>
                              </div>

                              <h3 class="font-semibold text-sm text-black mb-1 line-clamp-2"><?= $row['name'] ?></h3>
                              <p class="text-bright-green font-bold text-sm mb-1">Rp
                                 <?= number_format($row['price'], 0, ',', '.') ?></p>
                              <p class="text-xs text-gray-500 mb-3">Stok: <?= $row['stock'] ?></p>

                              <button
                                 onclick="addToCart(<?= $row['id'] ?>, '<?= htmlspecialchars($row['name']) ?>', <?= $row['price'] ?>)"
                                 class="w-full bg-bright-green text-white py-2 px-3 rounded-lg text-sm font-medium hover:bg-green-dark transition-colors duration-200 shadow-sm">
                                 + Tambah ke Keranjang
                              </button>
                           </div>
                        <?php endwhile; ?>
                     </div>
                  </div>
               </div>
            </div>

            <!-- Keranjang -->
            <div class="lg:col-span-1">
               <div
                  class="bg-white shadow-sm border overflow-hidden fixed-cart flex flex-col">
                  <!-- Fixed Header -->
                  <div class="p-6 border-b  flex-shrink-0">
                     <h2 class="text-xl font-semibold text-black"><i class="fa-solid fa-basket-shopping"></i> Keranjang
                     </h2>
                  </div>

                  <!-- Fixed Customer Selection -->
                  <div class="p-6 border-b  flex-shrink-0">
                     <label class="block text-sm font-semibold text-gray-700 mb-2">Customer</label>
                     <select id="customerSelect"
                        class="w-full border-2 rounded-lg p-3 focus:border-bright-green focus:ring-2 focus:ring-bright-green focus:ring-opacity-20 transition-all duration-200"
                        required>
                        <?php while ($c = $customers->fetch_assoc()): ?>
                           <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                        <?php endwhile; ?>
                     </select>
                  </div>

                  <!-- Scrollable Cart Items + Form -->
                  <form action="<?= DB_URL ?>ctions/transaksi/save.php" method="POST" id="cartForm" class="flex-1 flex flex-col">
                     <input type="hidden" name="customer_id" id="formCustomer">
                     <div id="cartItemsContainer" class="p-6 flex-1 overflow-y-auto">
                        <div class="text-center text-gray-500 py-8">
                           <span class="text-4xl mb-2 block"><i
                                 class="fa-duotone fa-solid fa-basket-shopping"></i></span>
                           <p>Keranjang kosong</p>
                        </div>
                     </div>

                     <!-- Fixed Total Section -->
                     <div class="p-6 border-t border-gray-200 flex-shrink-0">
                        <div class="flex justify-between items-center mb-4">
                           <span class="text-lg font-semibold text-black">Total:</span>
                           <span id="cartTotal" class="text-2xl font-bold text-bright-green">Rp 0</span>
                        </div>

                        <button type="submit"
                           class="w-full bg-bright-green text-white py-4 rounded-lg font-semibold hover:bg-green-dark transition-colors duration-200 shadow-md hover:shadow-lg">
                           <span class="flex items-center justify-center">
                              <span class="mr-2">💾</span>
                              Simpan Transaksi
                           </span>
                        </button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>

   <script>
      let cart = {};

      function addToCart(id, name, price) {
         if (!cart[id]) {
            cart[id] = { name, price, qty: 1 };
         } else {
            cart[id].qty++;
         }
         renderCart();
      }

      function removeFromCart(id) {
         if (cart[id]) {
            cart[id].qty--;
            if (cart[id].qty <= 0) {
               delete cart[id];
            }
         }
         renderCart();
      }

      function renderCart() {
         const cartItemsContainer = document.getElementById('cartItemsContainer');
         const cartTotal = document.getElementById('cartTotal');
         const customerSelect = document.getElementById('customerSelect');
         document.getElementById('formCustomer').value = customerSelect.value;

         cartItemsContainer.innerHTML = '';
         let total = 0;

         for (let id in cart) {
            let item = cart[id];
            let subtotal = item.price * item.qty;
            total += subtotal;

            cartItemsContainer.innerHTML += `
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 mb-2 flex justify-between items-center">
                        <div>
                            <h4 class="font-semibold text-black text-sm">${item.name}</h4>
                            <p class="text-xs text-gray-600">Rp ${item.price.toLocaleString()}</p>
                            <p class="text-sm font-bold text-bright-green">Rp ${subtotal.toLocaleString()}</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button type="button" onclick="removeFromCart(${id})" class="w-8 h-8 bg-red-500 text-white rounded-lg flex items-center justify-center hover:bg-red-600 transition-colors duration-200">-</button>
                            <span class="px-3 py-1 bg-white rounded-lg border border-gray-200 text-sm font-medium">${item.qty}</span>
                            <button type="button" onclick="addToCart(${id}, '${item.name}', ${item.price})" class="w-8 h-8 bg-bright-green text-white rounded-lg flex items-center justify-center hover:bg-green-dark transition-colors duration-200">+</button>
                        </div>
                        <input type="hidden" name="quantity[${id}]" value="${item.qty}">
                    </div>
                `;
         }

         if (Object.keys(cart).length === 0) {
            cartItemsContainer.innerHTML = `<div class="text-center text-gray-500 py-8"><span class="text-4xl mb-2 block"><i class="fa-duotone fa-solid fa-basket-shopping"></i></span><p>Keranjang kosong</p></div>`;
         }

         cartTotal.innerText = 'Rp ' + total.toLocaleString();
      }
   </script>
</body>

</html>
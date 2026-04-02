-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20250822.d5a75bc81e
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 17, 2025 at 01:49 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'hanan', 'hananxpplg@gmail.com', '$2y$10$JJorr/xyIqXTH34e5QtYPeip4xPyb0VDiEHmsJdpzTpjCiDNowxp6', '2025-09-06 03:09:19');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(1, 'Xiaomi', '2025-09-09 03:38:05'),
(2, 'Asus', '2025-09-09 12:51:34'),
(3, 'HP', '2025-09-13 14:55:48'),
(4, 'Lenovo', '2025-09-13 15:11:53'),
(6, 'Acer', '2025-09-14 14:43:03'),
(7, 'Advan', '2025-09-14 14:43:16'),
(8, 'Axioo', '2025-09-14 14:43:38'),
(9, 'MSI', '2025-09-14 14:43:50'),
(10, 'Tecno', '2025-09-14 14:44:04'),
(11, 'Macbook', '2025-09-16 12:28:44');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `address`, `created_at`) VALUES
(1, 'Ibadurrahman Hasan', '081257658987', 'Jln. Ende-Bajawa KM. 21, Anaraja, Nangapanda, Ende', '2025-09-09 03:37:54'),
(2, 'Dwita sri Wahyuni', '085576835421', 'Jln. Ende-Bajawa KM. 21, Anaraja, Nangapanda, Ende', '2025-09-09 04:44:33'),
(3, 'Oruzgan Marangka', '081277658952', 'Jln. Ende-Bajawa KM. 21, Anaraja, Nangapanda, Ende', '2025-09-09 06:17:45'),
(4, 'Alifya Alfatih Pakro', '081237651223', 'Jln. Ende-Bajawa KM. 21, Anaraja, Nangapanda, Ende', '2025-09-09 10:36:33'),
(5, 'Ibrahimmovic Hasan', '082156734584', 'Jln. Ende-Bajawa KM. 21, Anaraja, Nangapanda, Ende', '2025-09-09 13:32:58'),
(8, 'Uztadzah Hellfitri', '082189653443', 'Jln. Ende-Bajawa KM. 21, Anaraja, Nangapanda, Ende', '2025-09-14 15:30:51'),
(9, 'Ustadzah Ismi', '082234678871', 'Jln. Ende-Bajawa KM. 21, Anaraja, Nangapanda, Ende', '2025-09-15 01:15:34'),
(10, 'Ustadzah Nadia', '082234645543', 'Jln. Ende-Bajawa KM. 21, Anaraja, Nangapanda, Ende', '2025-09-15 01:16:08'),
(11, 'Ustad Aldy', '081244536765', 'Jln. Ende-Bajawa KM. 21, Anaraja, Nangapanda, Ende', '2025-09-16 12:34:03'),
(12, 'Alfira Flaxia', '082144546576', 'Kota Pontianak, Kalimantan Barat', '2025-09-16 12:34:32'),
(13, 'Hanan Chaliq', '082144567654', 'Jln. Ende-Bajawa KM. 21, Anaraja, Nangapanda, Ende', '2025-09-16 13:22:15'),
(14, 'Ariful Fahmi', '081237764149', 'Jln. Ende-Bajawa KM. 21, Anaraja, Nangapanda, Ende', '2025-09-17 13:03:03');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `admin_id` int DEFAULT NULL,
  `customer_id` int DEFAULT NULL,
  `total_product` int NOT NULL,
  `total_payment` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `admin_id`, `customer_id`, `total_product`, `total_payment`, `created_at`) VALUES
(1, 1, 14, 1, 7000000.00, '2025-09-17 13:03:28'),
(2, 1, 4, 5, 35000000.00, '2025-09-17 13:03:54'),
(3, 1, 10, 1, 7000000.00, '2025-09-17 13:26:56'),
(4, 1, 3, 1, 6700000.00, '2025-09-17 13:27:02'),
(5, 1, 1, 1, 6900000.00, '2025-09-17 13:27:09'),
(6, 1, 13, 1, 6900000.00, '2025-09-17 13:27:18'),
(7, 1, 14, 1, 7000000.00, '2025-09-17 13:27:27'),
(8, 1, 11, 2, 13800000.00, '2025-09-17 13:27:42'),
(9, 1, 12, 1, 5500000.00, '2025-09-17 13:28:01'),
(10, 1, 14, 1, 6500000.00, '2025-09-17 13:28:17');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `product_id`, `quantity`, `total_price`) VALUES
(1, 1, 15, 1, 7000000.00),
(2, 2, 18, 5, 35000000.00),
(3, 3, 18, 1, 7000000.00),
(4, 4, 7, 1, 6700000.00),
(5, 5, 5, 1, 6900000.00),
(6, 6, 10, 1, 6900000.00),
(7, 7, 2, 1, 7000000.00),
(8, 8, 20, 2, 13800000.00),
(9, 9, 21, 1, 5500000.00),
(10, 10, 3, 1, 6500000.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `category_id` int DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `price`, `stock`, `image`, `created_at`, `is_active`) VALUES
(2, 6, 'Advan PIXWAR x Transformers (Intel Core i5, 8GB RAM, 512GB SSD)', 7000000.00, 19, 'uploads/1757862255_images.jpg', '2025-09-09 03:38:54', 1),
(3, 6, 'Acer Aspire Lite AL14-31P-C6DD (Intel N100, 8GB LPDDR5 RAM, 256GB SSD)', 6500000.00, 23, 'uploads/1757862119_c6235071-64e8-49f2-bb74-e07f999f97dd.jpg', '2025-09-09 05:55:14', 1),
(4, 4, 'Lenovo IdeaPad D330 Slim (Intel Celeron N4020, 4/8GB RAM, 128GB eMMC)', 5900000.00, 13, 'uploads/1757862061_5bbc6106-da05-4d75-918d-030738379d73.jpg', '2025-09-09 05:58:52', 1),
(5, 3, 'HP Laptop 14s-dk1507AU (AMD Ryzen 3, 8GB RAM, 256/512GB SSD)', 6900000.00, 19, 'uploads/1757861974_id-11134207-7rasa-m41abamwzqgqae@resize_w900_nl.webp', '2025-09-09 06:02:12', 1),
(6, 2, 'Asus VivoBook E410 (Intel Celeron/Pentium, 4/8GB RAM, 256/512GB SSD)', 6000000.00, 11, 'uploads/1757861887_w800.png', '2025-09-09 12:55:59', 1),
(7, 1, 'Xiaomi RedmiBook 15 (Intel Core i3/i5, 8GB RAM, 256/512GB SSD)', 6700000.00, 14, 'uploads/1757861808_specs-header.png', '2025-09-09 13:37:47', 1),
(8, 4, 'Lenovo IdeaPad Flex 3i (Intel Celeron N4500, 4/8GB RAM, 128/256GB SSD)', 6500000.00, 10, 'uploads/1757898759_lenovo-ideapad-flex-3i-chromebook-resmi-rilis-dibekali-layar-122-inchi-dan-ketahanan-baterai-12-jam-221222l.webp', '2025-09-14 03:03:52', 1),
(9, 3, 'HP 14s EM00332AU (AMD Ryzen 3 7320U, 8GB LPDDR5 RAM, 512GB SSD)', 6800000.00, 15, 'uploads/1757862364_id-11134207-7r98w-lo9o91hup6y9b2@resize_w900_nl.webp', '2025-09-14 15:06:04', 1),
(10, 7, 'Advan Workplus (Core i5-12600H, 8GB RAM, 512GB SSD)', 6900000.00, 16, 'uploads/1757862441_Advan-Work-Plus-3.png', '2025-09-14 15:07:21', 1),
(11, 2, 'ASUS VivoBook Go 14 E1404FA (AMD Ryzen 3, 8GB RAM, 256/512GB SSD)', 6500000.00, 9, 'uploads/1757862503_E1404FA-4.png', '2025-09-14 15:08:23', 1),
(12, 6, 'Acer Aspire Lite AL14 (Core i5-1334, 8GB RAM, 512GB SSD)', 7000000.00, 19, 'uploads/1757862573_AL14-31P.png', '2025-09-14 15:09:33', 1),
(13, 8, 'AXIOO Hype 5 G12 (Core i5-1235U, 8GB RAM, 512GB SSD)', 6500000.00, 7, 'uploads/1757862658_MyBook-Hype-10-3.png', '2025-09-14 15:10:58', 1),
(14, 4, 'Lenovo V14 G3 (Core i3-1215U, 8GB RAM, 256/512GB SSD)', 7000000.00, 8, 'uploads/1757862747_jefjrjrj.png', '2025-09-14 15:12:27', 1),
(15, 2, 'ASUS VivoBook 14 A1404VA (Core i3, 8GB RAM, 512GB SSD)', 7000000.00, 15, 'uploads/1757862831_images (1).jpg', '2025-09-14 15:13:51', 1),
(16, 4, 'Lenovo Ideapad Slim 3i (Core i3, 8GB RAM, 512GB SSD)', 6500000.00, 22, 'uploads/1757862918_Lenovo-IdeaPad-Slim-3-Abyss-Blue-2.png', '2025-09-14 15:15:18', 1),
(17, 9, 'MSI Modern 14 C12MO 1287ID (Core i3, 8GB RAM, 512GB SSD)', 7000000.00, 10, 'uploads/1757862991_MSI-Modern-14-C5M.png', '2025-09-14 15:16:31', 1),
(18, 10, 'Tecno Megabook T1 14 (Core i5, 8/16GB RAM, 512GB SSD)', 7000000.00, 4, 'uploads/1757863060_tecno_tecno-megabook-t1-14-i5-13420h-16gb-512gb-w11_full01.jpg', '2025-09-14 15:17:40', 1),
(19, 6, 'Acer Aspire 5 A514-56P (Core i5, 8GB RAM, 512GB SSD)', 7000000.00, 6, 'uploads/1757863130_A514-56M.png', '2025-09-14 15:18:40', 1),
(20, 2, 'Asus Vivobook Go 15 OLED E1504FA (AMD Ryzen 3, 8GB RAM, 256GB SSD)', 6900000.00, 6, 'uploads/1757863195_images (2).jpg', '2025-09-14 15:19:55', 1),
(21, 4, 'Lenovo ThinkPad X13 Gen 2 (Intel Core i5-1145G7, 8GB RAM, 256GB SSD)', 5500000.00, 0, 'uploads/1757863450_20wlsbbe00-eec986c78b06d5317716969629724931-480-0.jpg', '2025-09-14 15:24:10', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `order_products_ibfk_2` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

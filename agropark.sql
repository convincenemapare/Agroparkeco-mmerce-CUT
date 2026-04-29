-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2026 at 07:46 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agropark`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Processing','Shipped','Delivered','Cancelled') DEFAULT 'Pending',
  `payment_method` varchar(50) DEFAULT 'Unpaid',
  `payment_status` enum('Pending','Success','Failed') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `email`, `phone`, `address`, `total`, `order_date`, `status`, `payment_method`, `payment_status`) VALUES
(1, 'Arnold Shereni', 'arnoldshereni@gmail.com', '0717260536', 'harare', 1.50, '2025-10-15 11:49:41', 'Pending', 'Unpaid', 'Pending'),
(2, 'Tatenda Shereni', 'tatendas684@gmail.com', '0772773436', 'chinhoyi', 2.50, '2025-10-15 11:58:42', 'Pending', 'Unpaid', 'Pending'),
(3, 'mellisa shereni', 'mellisa@gmail.com', '0786455464564', 'Bindura', 458.50, '2025-10-15 12:14:34', 'Delivered', 'Unpaid', 'Pending'),
(4, 'acn', 'john', '0717260536', 'chiredzi', 35.00, '2025-10-15 19:21:28', 'Delivered', 'PayPal', 'Success'),
(5, 'John Moyo', 'john@example.com', '0771111111', 'Chinhoyi', 250.00, '2025-09-05 08:00:00', 'Delivered', 'PayPal', 'Success'),
(6, 'Tariro Nyoni', 'tariro@example.com', '0772222222', 'Harare', 80.00, '2025-09-10 07:45:00', 'Delivered', 'EcoCash', 'Success'),
(7, 'Blessing Dube', 'blessing@example.com', '0773333333', 'Bulawayo', 120.00, '2025-09-18 13:30:00', 'Pending', 'OneMoney', 'Failed'),
(8, 'Chipo Ncube', 'chipo@example.com', 'chipo@example.com', 'Mutare', 95.00, '2025-10-01 09:10:00', 'Delivered', 'PayPal', 'Success'),
(9, 'Tawanda Moyo', 'tawanda@example.com', '0774444444', 'Karoi', 150.00, '2025-10-11 11:50:00', 'Pending', 'EcoCash', 'Success'),
(10, 'shaw', 'shaw@gmail.com', '078653235', '143 urct mhangura', 2146.00, '2025-10-15 22:33:07', 'Shipped', 'EcoCash', 'Success'),
(11, 'tino', 'tinosi@gmail.com', '0717260536', 'Bindura', 450.00, '2025-10-16 07:02:56', 'Pending', 'OneMoney', 'Success'),
(12, 'tino', 'tinosi@gmail.com', '0717260536', 'harare', 400.00, '2025-10-16 17:55:09', 'Pending', 'EcoCash', 'Success'),
(13, 'tino', 'tinosi@gmail.com', '0717260536', 'Bindura', 9.00, '2025-10-16 18:16:04', 'Pending', 'PayPal', 'Success'),
(14, 'tino', 'tinosi@gmail.com', '0717260536', 'harare', 35.00, '2025-10-16 18:31:14', 'Pending', 'PayPal', 'Success'),
(15, 'Tafadzwa', 'tafadzwa@gmail.com', '0717260536', 'Chinhoyi', 12.00, '2025-10-17 08:53:06', 'Pending', 'EcoCash', 'Success'),
(16, 'Tafadzwa', 'tafadzwa@gmail.com', '0717260536', '143 urct mhangura', 120.00, '2025-10-17 10:23:40', 'Delivered', 'PayPal', 'Success'),
(17, 'win', 'win@gmail.com', '0771193628', 'harare', 1.00, '2025-10-17 12:37:44', 'Pending', 'EcoCash', 'Success'),
(18, '', '', '', '', 5.00, '2025-10-18 20:37:58', 'Pending', 'PayPal', 'Success'),
(19, 'Wesley', 'wes@gmail.com', '0717260536', 'muzarabani', 516.00, '2025-12-22 14:23:25', 'Pending', 'EcoCash', 'Success'),
(20, 'Susan Nyika', 'nyika@gmail.com', '0717260536', 'muzarabani', 101.00, '2026-02-06 23:44:23', 'Pending', 'EcoCash', 'Success');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_name`, `quantity`, `price`) VALUES
(1, 1, 'Yoghurt', 1, 1.50),
(2, 2, 'Yoghurt', 1, 2.50),
(3, 3, 'Urea Fertilizer', 1, 35.00),
(4, 3, 'Maize Seeds', 1, 12.00),
(5, 3, 'Yoghurt', 1, 2.50),
(6, 3, 'Mashona Cattle', 1, 400.00),
(7, 3, 'Bean Seeds', 1, 9.00),
(8, 4, 'Urea Fertilizer', 1, 35.00),
(11, 10, 'Maize Seeds', 10, 12.00),
(12, 10, 'Bean Seeds', 4, 9.00),
(13, 11, 'Tuli', 1, 450.00),
(14, 12, 'Mashona Cattle', 1, 400.00),
(15, 13, 'Bean Seeds', 1, 9.00),
(16, 14, 'Urea Fertilizer', 1, 35.00),
(17, 15, 'Maize Seeds', 1, 12.00),
(18, 16, 'traditional maize seeds', 12, 10.00),
(19, 17, 'Yoghurt', 1, 1.50),
(20, 18, 'fork', 1, 5.00),
(21, 19, 'wheat', 1, 15.00),
(22, 19, 'wheelbarrow', 1, 65.00),
(23, 19, 'Yoghurt', 1, 1.50),
(24, 19, 'Urea Fertilizer', 1, 35.00),
(25, 19, 'Mashona Cattle', 1, 400.00),
(26, 20, 'wheelbarrow', 1, 65.00),
(27, 20, 'Yoghurt', 1, 1.50),
(28, 20, 'Urea Fertilizer', 1, 35.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `image`, `description`) VALUES
(1, 'Maize Seeds', 'seeds', 12.00, 'assets/SeedCo.webp', 'High-yield maize hybrid seeds'),
(2, 'Urea Fertilizer', 'fertilizers', 35.00, 'assets/urea.jpg', 'Nitrogen-based fertilizer for soil'),
(5, 'Mashona Cattle', 'cattle', 400.00, 'assets/mashona.webp', 'Hardy Mashona breed cattle'),
(6, 'Bean Seeds', 'seeds', 9.00, 'assets/beans.jpg', 'Quality bean seeds'),
(7, 'Tuli', 'cattle', 450.00, 'assets/tuli.jpg', 'Healthy animal'),
(9, 'Yoghurt', 'processed', 1.50, 'assets/yoghurt.webp', 'Delicious creamy yoghurt'),
(10, 'wheat', 'seeds', 15.00, 'assets/wheat1.jpeg', 'Whole quality wheat'),
(11, 'wheelbarrow', 'tools', 65.00, 'assets/wheelbarrow.webp', 'Quality wheelbarrow at affordable price'),
(14, 'fork', 'tools', 5.00, 'assets/fork.webp', 'Quality forks');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','customer') DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `email`, `password`, `role`) VALUES
(2, 'Terry', 'terry', 'terry@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'customer'),
(3, 'Shamiso Chiranndu', 'shamiso', 'shamiso2@gmail.com', '$2y$10$UpdX9gqi2UrqfcPN.e7PEe/Va/lpAJ9IIWtmu9XeuyiY2hHM3.xYm', 'customer'),
(4, 'Tinotenda Sino', 'tino', 'tinosi@gmail.com', '$2y$10$XwZDSCrAImA5DsCBZFoaO.eGOdfhF4M76s0kpFRk8Y8FeGJZA3mha', 'customer'),
(5, 'Administrator', 'admin', 'admin@agropark.com', '$2y$10$x7cUpBVvyzlbk6OtQBO52eTwN55yKQwYZXIt9hT2YJwUXxk2rbvFi', 'admin'),
(6, 'Tafadzwa', 'tafa', 'tafadzwa@gmail.com', '$2y$10$G4DpwU90WeEdeedERS73yeqW/FucsE4iOFbGeDfd9KC/2ajkJ6bzq', 'customer'),
(7, 'Tafadzwa', 'tafadzwa', 'taf@gmail.com', '$2y$10$s5lGWcI6yqnrgg/6js4ecOkVhgEyhH3zU4GcuCYRoecqCWaGAquvu', 'customer'),
(8, 'win', 'win', 'win@gmail.com', '$2y$10$JhuYF6dxnsQ6JAFyPY9DcOcPE8Dsgq1Ewl8g2Io7sQgXrA2ADn1fu', 'customer'),
(9, 'q', 'q', 'q@gmail.com', '$2y$10$Kh.Lf3XxF2sJVChWrrZgUOZWp7TRNQauOeij1QttbXleFZv2yfj22', 'customer'),
(10, 'Wesley Chimo', 'wes', 'wes@gmail.com', '$2y$10$PPlPOuZfMR/sOsEs37t0g.pEa81.lFuNnRZVB49pjMoZJKb3pYb.m', 'customer'),
(11, 'Susan Nyika', 'SNyika', 'nyika@gmail.com', '$2y$10$tk9geYsFOPhAI8PS5vk3/O8cAePLl7vBgXABZ7DE3f1eVmhZaqpte', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2020 at 10:47 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marketpos`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `discount` int(11) DEFAULT 0,
  `total` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `phone` varchar(128) NOT NULL,
  `address` text NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `name`, `gender`, `phone`, `address`, `created`, `updated`) VALUES
(1, 'Budi Sutoyo', 'L', '08127029899', 'Jl. Belimbing No. 53', '2020-09-07 20:27:49', '2020-09-07 15:35:34'),
(2, 'Siti Marsitoh', 'P', '08999338570', 'Jl. Jambu No. 90', '2020-09-07 20:27:49', NULL),
(3, 'Muhammad Yamin', 'L', '08999234212', 'Jl. Mangga Besar No. 66', '2020-09-07 20:34:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produk_category`
--

CREATE TABLE `produk_category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk_category`
--

INSERT INTO `produk_category` (`category_id`, `name`, `created`, `updated`) VALUES
(1, 'Makanan', '2020-09-08 20:12:09', NULL),
(2, 'Minuman', '2020-09-08 20:12:17', NULL),
(3, 'Sembako', '2020-09-08 21:12:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produk_item`
--

CREATE TABLE `produk_item` (
  `item_id` int(11) NOT NULL,
  `barcode` varchar(128) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `stock` int(10) NOT NULL DEFAULT 0,
  `image` varchar(128) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk_item`
--

INSERT INTO `produk_item` (`item_id`, `barcode`, `name`, `category_id`, `unit_id`, `price`, `stock`, `image`, `created`, `updated`) VALUES
(1, 'A001', 'Beras Pulen', 3, 3, 90000, 56, 'item-200909-55818baf93.jpg', '2020-09-08 20:12:41', '2020-09-09 09:00:48'),
(2, 'A002', 'Minyak Goreng', 3, 3, 10000, 0, 'item-200909-1414c98af4.jpg', '2020-09-08 21:22:25', '2020-09-09 09:01:50'),
(5, 'A003', 'Permen', 1, 2, 1000, 30, 'item-200909-430fa4ff62.jpg', '2020-09-09 13:16:11', '2020-09-09 09:01:28'),
(8, 'A004', 'Coca Cola', 2, 2, 5000, 0, 'item-200910-0bd6929069.jpeg', '2020-09-10 19:27:40', '2020-09-10 14:29:09'),
(10, 'A005', 'Tepung Segitiga Biru', 3, 1, 14500, 2, 'item-200912-e70e879dfb.jpg', '2020-09-12 12:42:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produk_unit`
--

CREATE TABLE `produk_unit` (
  `unit_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk_unit`
--

INSERT INTO `produk_unit` (`unit_id`, `name`, `created`, `updated`) VALUES
(1, 'Kilogram', '2020-09-08 20:12:23', NULL),
(2, 'Buah', '2020-09-08 20:12:29', NULL),
(3, 'Liter', '2020-09-08 21:12:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `phone` varchar(128) NOT NULL,
  `address` text NOT NULL,
  `description` text DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `name`, `phone`, `address`, `description`, `created`, `updated`) VALUES
(2, 'Toko Sembako', '0899955342', 'Jl. Pejaten Timur No.21', 'Toko beras, tepung, gula, dll.', '2020-09-07 13:07:56', '2020-09-07 14:31:01'),
(4, 'Toko Makanan', '0899923521', 'Jl. Bintara No. 11', 'Makanan ringan dan snack', '2020-09-07 20:37:02', NULL),
(5, 'Toko Kelontong', '0899934214', 'Jl. Mangga Tiga No. 44', 'Toko makanan, minuman, sembako, dll', '2020-09-11 10:56:01', NULL),
(7, 'Toko Minuman', '0812904324', 'Jl. Super Megah No. 51', 'Soft drink, soda, juice, dll', '2020-09-11 11:05:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_sale`
--

CREATE TABLE `transaction_sale` (
  `sale_id` int(11) NOT NULL,
  `invoice` varchar(128) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `total_price` int(11) NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `final_price` int(11) NOT NULL,
  `cash` int(11) NOT NULL,
  `remaining` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_sale`
--

INSERT INTO `transaction_sale` (`sale_id`, `invoice`, `customer_id`, `total_price`, `discount`, `final_price`, `cash`, `remaining`, `note`, `date`, `user_id`, `created`) VALUES
(3, 'MP2009260001', 0, 1000, 0, 1000, 2000, 1000, '', '2020-09-26', 1, '2020-09-26 15:59:05'),
(5, 'MP2009260002', 0, 90000, 0, 90000, 100000, 10000, 'Uang kembali', '2020-09-26', 1, '2020-09-26 16:02:37'),
(10, 'PM2009280001', 0, 90000, 0, 90000, 100000, 10000, 'Diantar', '2020-09-28', 1, '2020-09-28 11:49:39'),
(11, 'PM2009280002', 0, 5000, 0, 5000, 5000, 0, '', '2020-09-28', 1, '2020-09-28 12:28:34'),
(12, 'PM2009280003', 0, 104500, 0, 104500, 105000, 500, 'beli', '2020-09-28', 1, '2020-09-28 14:21:19'),
(13, 'PM2009280004', 2, 27550, 0, 27550, 30000, 2450, '', '2020-09-28', 1, '2020-09-28 17:23:40');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_sale_detail`
--

CREATE TABLE `transaction_sale_detail` (
  `detail_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_sale_detail`
--

INSERT INTO `transaction_sale_detail` (`detail_id`, `sale_id`, `item_id`, `price`, `qty`, `discount`, `total`) VALUES
(3, 3, 5, 1000, 1, 0, 1000),
(5, 5, 1, 90000, 1, 0, 90000),
(11, 10, 1, 90000, 1, 0, 90000),
(12, 11, 5, 1000, 5, 0, 5000),
(13, 12, 1, 90000, 1, 0, 90000),
(14, 12, 10, 14500, 1, 0, 14500),
(15, 13, 10, 14500, 2, 5, 27550);

--
-- Triggers `transaction_sale_detail`
--
DELIMITER $$
CREATE TRIGGER `stock_min` AFTER INSERT ON `transaction_sale_detail` FOR EACH ROW BEGIN
	UPDATE produk_item SET stock = stock - 		NEW.qty
    WHERE item_id = NEW.item_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_stock`
--

CREATE TABLE `transaction_stock` (
  `stock_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `type` enum('in','out') NOT NULL,
  `detail` varchar(255) NOT NULL,
  `info` varchar(128) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `qty` int(10) NOT NULL,
  `date` date NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_stock`
--

INSERT INTO `transaction_stock` (`stock_id`, `item_id`, `type`, `detail`, `info`, `supplier_id`, `qty`, `date`, `created`, `user_id`) VALUES
(1, 1, 'in', 'kulakan', '', 2, 20, '2020-09-10', '2020-09-10 21:20:33', 1),
(11, 10, 'in', 'kulakan', '', 5, 10, '2020-09-12', '2020-09-12 13:14:43', 1),
(12, 5, 'out', '', 'kadaluarsa', NULL, 5, '2020-09-12', '2020-09-12 13:17:04', 1),
(13, 5, 'in', 'kulakan', '', 5, 50, '2020-09-12', '2020-09-12 13:18:02', 1),
(14, 1, 'in', 'tambahan', '', 2, 50, '2020-09-26', '2020-09-26 17:16:20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(128) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `image` varchar(128) NOT NULL,
  `level` int(1) NOT NULL COMMENT 'Admin, Kasir'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `address`, `image`, `level`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Timo Werner', 'Jl. Nangka No.30', 'Timo_Werner.jpg', 1),
(2, 'kasir1', '874c0ac75f323057fe3b7fb3f5a8a41df2b94b1d', 'Mohammad Salah', 'Jl. Limau No.11', 'Mohamed_Salah_2018.jpg', 2),
(3, 'kasir2', '08dfc5f04f9704943a423ea5732b98d3567cbd49', 'Tammy Abraham', 'Jl. Ketapang No.9', 'tammy-abraham.jpg', 2),
(6, 'admin2', '315f166c5aca63a157f7d41007675cb44a948b33', 'Sherdan Xhaqiri', 'Jl. Makassar No. 26', 'Xherdan_Shaqiri_2018.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `cart_ibfk_1` (`item_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `produk_category`
--
ALTER TABLE `produk_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `produk_item`
--
ALTER TABLE `produk_item`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `barcode` (`barcode`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `produk_unit`
--
ALTER TABLE `produk_unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `transaction_sale`
--
ALTER TABLE `transaction_sale`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `transaction_sale_detail`
--
ALTER TABLE `transaction_sale_detail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `transaction_stock`
--
ALTER TABLE `transaction_stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `produk_category`
--
ALTER TABLE `produk_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produk_item`
--
ALTER TABLE `produk_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `produk_unit`
--
ALTER TABLE `produk_unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transaction_sale`
--
ALTER TABLE `transaction_sale`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `transaction_sale_detail`
--
ALTER TABLE `transaction_sale_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `transaction_stock`
--
ALTER TABLE `transaction_stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `produk_item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk_item`
--
ALTER TABLE `produk_item`
  ADD CONSTRAINT `produk_item_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `produk_category` (`category_id`),
  ADD CONSTRAINT `produk_item_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `produk_unit` (`unit_id`);

--
-- Constraints for table `transaction_sale_detail`
--
ALTER TABLE `transaction_sale_detail`
  ADD CONSTRAINT `transaction_sale_detail_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `transaction_sale` (`sale_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_sale_detail_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `produk_item` (`item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transaction_stock`
--
ALTER TABLE `transaction_stock`
  ADD CONSTRAINT `transaction_stock_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `produk_item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_stock_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`),
  ADD CONSTRAINT `transaction_stock_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

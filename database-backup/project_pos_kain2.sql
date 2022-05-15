-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2022 at 08:12 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_pos_kain`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_models`
--

CREATE TABLE `category_models` (
  `category_model_id` int(11) NOT NULL,
  `category_model_name` varchar(255) NOT NULL,
  `category_model_code` varchar(32) NOT NULL,
  `category_name_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_models`
--

INSERT INTO `category_models` (`category_model_id`, `category_model_name`, `category_model_code`, `category_name_id`, `unit_id`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'Merah', 'knjrsy-mnks-mrh-kgs', 2, 1, '2022-03-17 22:42:04', '2022-03-17 22:42:04', 0),
(2, 'Merah', 'knjrsy-mnks-mrh-yd', 2, 10, '2022-03-17 22:45:05', '2022-03-17 22:45:05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category_names`
--

CREATE TABLE `category_names` (
  `category_name_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_name_code` varchar(32) NOT NULL,
  `category_root_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_names`
--

INSERT INTO `category_names` (`category_name_id`, `category_name`, `category_name_code`, `category_root_id`, `created_at`, `updated_at`, `is_deleted`) VALUES
(2, 'Monaks', 'knjrsy-mnks', 1, '2022-03-17 22:41:50', '2022-03-17 22:41:50', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category_roots`
--

CREATE TABLE `category_roots` (
  `category_root_id` int(11) NOT NULL,
  `category_root_name` varchar(255) NOT NULL,
  `category_root_code` varchar(32) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_roots`
--

INSERT INTO `category_roots` (`category_root_id`, `category_root_name`, `category_root_code`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'Kain Jersey', 'knjrsy', '2022-03-17 22:41:10', '2022-03-17 15:41:10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_NIK` varchar(32) DEFAULT NULL,
  `customer_name` varchar(128) NOT NULL,
  `address` text NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_NIK`, `customer_name`, `address`, `no_hp`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, '1111111111111111', 'Iqbalddc', 'Selakau1', '22221', '2021-12-21 23:00:59', '2021-12-21 23:00:59', 0),
(2, '1111111111111111', 'POP', '2', '22221', '2021-12-21 23:17:17', '2021-12-21 23:17:17', 0),
(3, '23', 'Bambang', '23', '222213', '2021-12-21 23:17:31', '2021-12-21 23:17:31', 0),
(4, '1', 'ANGGA PUJA RESTU PRAKASA', 'Jl. Papanggungan', '5555r', '2021-12-21 23:33:00', '2021-12-21 23:33:00', 0),
(5, '13', 'ANGGA PUJA RESTU PRAKASA', 'Jl. Papanggungan', 'e', '2022-01-22 14:48:35', '2022-01-22 14:48:35', 0),
(6, '134', 'ANGGA PUJA RESTU PRAKASA', 'Jl. Papanggungan', 'e', '2022-01-22 14:48:36', '2022-01-22 14:48:36', 0),
(7, '145', 'ANGGA PUJA RESTU PRAKASA', 'Jl. Papanggungan', 'e', '2022-01-22 14:48:54', '2022-01-22 14:48:54', 1),
(8, '67', '', '', '', '2022-01-22 14:50:33', '2022-01-22 14:50:33', 1),
(9, '166', 'ANGGA PUJA RESTU PRAKASA', 'Jl. Papanggungan', 'a', '2022-03-02 10:44:24', '2022-03-02 10:44:24', 0),
(10, '1114222222222222', 'Bambang', 'Bambang', '00988', '2022-03-02 13:54:34', '2022-03-02 13:54:34', 0),
(11, '1234567887456321', 'Aditya', 'Sekeloa Utara 123 ', '08967845212', '2022-03-04 14:57:43', '2022-03-04 14:57:43', 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `invoice_id` int(11) NOT NULL,
  `invoice_code` varchar(64) NOT NULL,
  `total_capital` int(11) NOT NULL,
  `total_payment` int(11) NOT NULL,
  `total_profit` int(11) NOT NULL,
  `type_payment` enum('cash','transfer') NOT NULL DEFAULT 'cash',
  `customer_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `date_invoice` datetime NOT NULL DEFAULT current_timestamp(),
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`invoice_id`, `invoice_code`, `total_capital`, `total_payment`, `total_profit`, `type_payment`, `customer_id`, `user_id`, `date_invoice`, `is_deleted`) VALUES
(1, 'INV/2022/03/17/OUT/1', 100000, 200000, 100000, 'transfer', NULL, 1, '2022-03-17 22:43:16', 0),
(2, 'INV/2022/03/17/OUT/2', 150000, 300000, 150000, 'cash', NULL, 1, '2022-03-17 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `log_activity`
--

CREATE TABLE `log_activity` (
  `log_id` int(11) NOT NULL,
  `log_name` varchar(64) NOT NULL,
  `log_description` text NOT NULL,
  `log_tr_collor` varchar(16) NOT NULL,
  `log_date` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_activity`
--

INSERT INTO `log_activity` (`log_id`, `log_name`, `log_description`, `log_tr_collor`, `log_date`, `user_id`) VALUES
(1, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-03-17 22:39:40', 1),
(2, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root Kain Jersey BERHASIL', 'success', '2022-03-17 22:41:10', 1),
(3, 'Aktifitas Tambah Category Name GAGAL', 'Tambah Data Category Name Monaks GAGAL', 'danger', '2022-03-17 22:41:44', 1),
(4, 'Aktifitas Tambah Category Name BERHASIL', 'Tambah Data Category Name Monaks BERHASIL', 'success', '2022-03-17 22:41:50', 1),
(5, 'Aktifitas Tambah Category Model BERHASIL', 'Tambah Data Category Model Merah BERHASIL', 'success', '2022-03-17 22:42:04', 1),
(6, 'Aktifitas Tambah Roll BERHASIL', 'Tambah Roll BERHASIL dilakukan. Kode Roll : knjrsy-mnks-mrh-kgs-rll1, Nama Roll :  Roll 1', 'success', '2022-03-17 22:42:41', 1),
(7, 'Aktifitas Tambah Transaksi Roll BERHASIL', 'Transaksi Roll :  knjrsy-mnks-mrh-kgs-rll1 BERHASIL dilakukan dengan jumlah 200', 'success', '2022-03-17 22:42:41', 1),
(8, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-17 22:43:16', 1),
(9, 'Aktifitas Tambah Category Model BERHASIL', 'Tambah Data Category Model Monaks BERHASIL', 'success', '2022-03-17 22:45:05', 1),
(10, 'Aktifitas Update Category Model BERHASIL', 'Update Data Category Model Merah BERHASIL', 'success', '2022-03-17 22:45:14', 1),
(11, 'Aktifitas Tambah Roll BERHASIL', 'Tambah Roll BERHASIL dilakukan. Kode Roll : knjrsy-mnks-mrh-yd-rll2, Nama Roll :  Roll 2', 'success', '2022-03-17 22:45:45', 1),
(12, 'Aktifitas Tambah Transaksi Roll BERHASIL', 'Transaksi Roll :  knjrsy-mnks-mrh-yd-rll2 BERHASIL dilakukan dengan jumlah 200', 'success', '2022-03-17 22:45:45', 1),
(13, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-17 22:46:22', 1),
(14, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-03-17 22:58:16', 1),
(15, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-03-18 10:56:45', 1),
(16, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-03-18 13:30:39', 1),
(17, 'Aktifitas Update Data Satuan BERHASIL', 'Update data satuan menjadi Kilograms BERHASIL', 'success', '2022-03-18 14:04:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rolls`
--

CREATE TABLE `rolls` (
  `roll_id` int(11) NOT NULL,
  `roll_code` varchar(64) NOT NULL,
  `barcode_code` varchar(32) DEFAULT NULL,
  `roll_name` varchar(512) NOT NULL,
  `unit_quantity` int(11) NOT NULL,
  `roll_quantity` int(11) NOT NULL,
  `basic_price` int(11) NOT NULL,
  `selling_price` int(11) NOT NULL,
  `category_model_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `barcode_image` varchar(512) DEFAULT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rolls`
--

INSERT INTO `rolls` (`roll_id`, `roll_code`, `barcode_code`, `roll_name`, `unit_quantity`, `roll_quantity`, `basic_price`, `selling_price`, `category_model_id`, `created_at`, `updated_at`, `barcode_image`, `is_deleted`) VALUES
(1, 'knjrsy-mnks-mrh-kgs-rll1', 'LT2aYmvk', 'Roll 1', 2, 195, 50000, 100000, 1, '2022-03-17 22:42:41', '2022-03-17 22:42:41', 'barcode/LT2aYmvk.jpg', 0),
(2, 'knjrsy-mnks-mrh-yd-rll2', 'asputerf', 'Roll 2', 2, 200, 40000, 60000, 2, '2022-03-17 22:45:45', '2022-03-17 22:45:45', 'barcode/asputerf.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `roll_transactions`
--

CREATE TABLE `roll_transactions` (
  `transaction_id` int(11) NOT NULL,
  `roll_id` int(11) NOT NULL,
  `transaction_type` tinyint(1) NOT NULL,
  `transaction_quantity` int(11) NOT NULL,
  `sub_capital` int(32) NOT NULL DEFAULT 0,
  `sub_total` int(32) DEFAULT 0,
  `sub_profit` int(32) NOT NULL DEFAULT 0,
  `type_payment` enum('cash','transfer') NOT NULL DEFAULT 'cash',
  `transaction_date` datetime NOT NULL DEFAULT current_timestamp(),
  `invoice_id` int(11) DEFAULT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roll_transactions`
--

INSERT INTO `roll_transactions` (`transaction_id`, `roll_id`, `transaction_type`, `transaction_quantity`, `sub_capital`, `sub_total`, `sub_profit`, `type_payment`, `transaction_date`, `invoice_id`, `is_deleted`) VALUES
(1, 1, 0, 200, 0, 10000000, 0, 'cash', '2022-03-17 22:42:41', NULL, 0),
(2, 1, 1, 2, 100000, 200000, 100000, 'cash', '2022-03-17 22:43:16', 1, 0),
(3, 2, 0, 200, 0, 8000000, 0, 'cash', '2022-03-17 22:45:45', NULL, 0),
(6, 1, 1, 3, 150000, 300000, 150000, 'cash', '2022-03-17 22:58:16', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `type_products`
--

CREATE TABLE `type_products` (
  `type_id` int(11) NOT NULL,
  `type_code` varchar(32) NOT NULL,
  `category_model_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type_products`
--

INSERT INTO `type_products` (`type_id`, `type_code`, `category_model_id`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'JK-s-Y', 1, '2021-12-21 23:46:58', '2021-12-21 23:46:58', 0),
(2, 'JK-s99-K', 1, '2021-12-22 21:55:29', '2021-12-22 21:55:29', 0),
(3, 'JK-s1-k', 1, '2021-12-22 21:55:36', '2021-12-22 21:55:36', 0),
(4, 'JK-s2-k', 1, '2021-12-22 21:58:20', '2021-12-22 21:58:20', 0),
(5, 'JK-s3-k', 1, '2021-12-22 21:59:36', '2021-12-22 21:59:36', 0),
(6, 'JK-S4-k', 1, '2021-12-25 12:02:03', '2021-12-25 12:02:03', 0),
(7, 'JK-s5-y', 1, '2021-12-25 12:02:28', '2021-12-25 12:02:28', 0),
(8, 'JK-s6-k', 1, '2021-12-25 14:59:15', '2021-12-25 14:59:15', 0),
(9, 'JK-s7-y', 1, '2021-12-25 15:03:08', '2021-12-25 15:03:08', 0),
(10, 'JK-s8-y', 1, '2021-12-25 15:47:54', '2021-12-25 15:47:54', 0),
(11, 'JK-s9-y', 1, '2021-12-25 15:48:01', '2021-12-25 15:48:01', 0),
(22, 'JK-s10-y', 1, '2021-12-25 15:57:48', '2021-12-25 15:57:48', 0),
(25, 'JK-krp-K', 1, '2022-01-19 20:12:35', '2022-01-19 20:12:35', 0),
(26, 'JK-d-M', 1, '2022-01-22 12:58:47', '2022-01-22 12:58:47', 0),
(28, 'JK-POPpp-Y', 1, '2022-01-22 13:04:22', '2022-01-22 13:04:22', 0),
(29, 'JK-M100-Y', 1, '2022-01-23 17:05:22', '2022-01-23 17:05:22', 0),
(30, 'JK-RYNP-M1-Y', 1, '2022-01-24 10:48:52', '2022-01-24 10:48:52', 0),
(31, 'JK-RYNP-K1-Y', 1, '2022-01-24 10:51:01', '2022-01-24 10:51:01', 0),
(32, 'JK-JRSM-K', 1, '2022-01-24 11:12:01', '2022-01-24 11:12:01', 0),
(33, 'JK-RYNP-M5-Y', 1, '2022-01-24 11:21:34', '2022-01-24 11:21:34', 0),
(34, 'JK-RYNP-M71-Y', 1, '2022-01-24 11:22:02', '2022-01-24 11:22:02', 0),
(35, 'JK-MRSC-10-Y', 1, '2022-01-24 11:31:02', '2022-01-24 11:31:02', 0),
(36, 'JK-RYNP-M10-Y', 1, '2022-01-24 14:25:50', '2022-01-24 14:25:50', 0),
(37, 'JK-Rynp-I-Y', 1, '2022-01-24 14:54:07', '2022-01-24 14:54:07', 0),
(38, 'JK-dxx-Y', 1, '2022-02-25 16:29:41', '2022-02-25 16:29:41', 0),
(40, 'JK--K', 1, '2022-02-25 16:33:48', '2022-02-25 16:33:48', 0);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(64) NOT NULL,
  `unit_code` varchar(8) NOT NULL,
  `is_deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unit_id`, `unit_name`, `unit_code`, `is_deleted`) VALUES
(1, 'Kilograms', 'kgsc', 0),
(10, 'Yard', 'yd', 0),
(11, 'Ton', 'ton', 0),
(12, 'Ons', 'ons', 0),
(13, 'Gram', 'gr', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(128) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(512) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `username`, `password`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'Superadmin', 'admin', 'admin', '2021-12-19 12:05:05', '2021-12-19 12:05:05', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_models`
--
ALTER TABLE `category_models`
  ADD PRIMARY KEY (`category_model_id`),
  ADD KEY `category_name_id` (`category_name_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `category_names`
--
ALTER TABLE `category_names`
  ADD PRIMARY KEY (`category_name_id`),
  ADD KEY `category_root_id` (`category_root_id`);

--
-- Indexes for table `category_roots`
--
ALTER TABLE `category_roots`
  ADD PRIMARY KEY (`category_root_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `invoice_ibfk_1` (`user_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `log_activity`
--
ALTER TABLE `log_activity`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rolls`
--
ALTER TABLE `rolls`
  ADD PRIMARY KEY (`roll_id`),
  ADD UNIQUE KEY `roll_code` (`roll_code`),
  ADD UNIQUE KEY `barcode_code` (`barcode_code`),
  ADD KEY `category_model_id` (`category_model_id`);

--
-- Indexes for table `roll_transactions`
--
ALTER TABLE `roll_transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `roll_id` (`roll_id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indexes for table `type_products`
--
ALTER TABLE `type_products`
  ADD PRIMARY KEY (`type_id`),
  ADD UNIQUE KEY `type_code` (`type_code`),
  ADD KEY `category_model_id` (`category_model_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_id`),
  ADD UNIQUE KEY `unit_code` (`unit_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_models`
--
ALTER TABLE `category_models`
  MODIFY `category_model_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category_names`
--
ALTER TABLE `category_names`
  MODIFY `category_name_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category_roots`
--
ALTER TABLE `category_roots`
  MODIFY `category_root_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `log_activity`
--
ALTER TABLE `log_activity`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `rolls`
--
ALTER TABLE `rolls`
  MODIFY `roll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roll_transactions`
--
ALTER TABLE `roll_transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `type_products`
--
ALTER TABLE `type_products`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_models`
--
ALTER TABLE `category_models`
  ADD CONSTRAINT `category_models_ibfk_1` FOREIGN KEY (`category_name_id`) REFERENCES `category_names` (`category_name_id`),
  ADD CONSTRAINT `category_models_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `units` (`unit_id`);

--
-- Constraints for table `category_names`
--
ALTER TABLE `category_names`
  ADD CONSTRAINT `category_names_ibfk_1` FOREIGN KEY (`category_root_id`) REFERENCES `category_roots` (`category_root_id`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `invoices_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Constraints for table `log_activity`
--
ALTER TABLE `log_activity`
  ADD CONSTRAINT `log_activity_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `rolls`
--
ALTER TABLE `rolls`
  ADD CONSTRAINT `rolls_ibfk_2` FOREIGN KEY (`category_model_id`) REFERENCES `category_models` (`category_model_id`);

--
-- Constraints for table `roll_transactions`
--
ALTER TABLE `roll_transactions`
  ADD CONSTRAINT `roll_transactions_ibfk_1` FOREIGN KEY (`roll_id`) REFERENCES `rolls` (`roll_id`),
  ADD CONSTRAINT `roll_transactions_ibfk_2` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`invoice_id`);

--
-- Constraints for table `type_products`
--
ALTER TABLE `type_products`
  ADD CONSTRAINT `type_products_ibfk_1` FOREIGN KEY (`category_model_id`) REFERENCES `category_models` (`category_model_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

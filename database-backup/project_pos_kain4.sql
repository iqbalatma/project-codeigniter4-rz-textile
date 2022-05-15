-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2022 at 06:27 PM
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
(1, '1111111111111111', 'Iqbalddc', 'Selakau1', '22221', '2021-12-21 23:00:59', '2021-12-21 23:00:59', 1),
(2, '1111111111111111', 'POP', '2', '22221', '2021-12-21 23:17:17', '2021-12-21 23:17:17', 1),
(3, '23', 'Bambang', '23', '222213', '2021-12-21 23:17:31', '2021-12-21 23:17:31', 1),
(4, '1', 'ANGGA PUJA RESTU PRAKASA', 'Jl. Papanggungan', '5555r', '2021-12-21 23:33:00', '2021-12-21 23:33:00', 1),
(5, '6101071602990002', 'Iqbal Atma Muliawan', 'Jalan Dago Barat Apartemen 44 Pak Ahe', '0895351172040', '2022-01-22 14:48:35', '2022-01-22 14:48:35', 0),
(6, '134', 'ANGGA PUJA RESTU PRAKASA', 'Jl. Papanggungan', 'e', '2022-01-22 14:48:36', '2022-01-22 14:48:36', 1),
(7, '145', 'ANGGA PUJA RESTU PRAKASA', 'Jl. Papanggungan', 'e', '2022-01-22 14:48:54', '2022-01-22 14:48:54', 1),
(8, '67', '', '', '', '2022-01-22 14:50:33', '2022-01-22 14:50:33', 1),
(9, '166', 'ANGGA PUJA RESTU PRAKASA', 'Jl. Papanggungan', 'a', '2022-03-02 10:44:24', '2022-03-02 10:44:24', 1),
(10, '1114222222222222', 'Bambang', 'Bambang', '00988', '2022-03-02 13:54:34', '2022-03-02 13:54:34', 1),
(11, '1234567887456321', 'Aditya', 'Sekeloa Utara 123 ', '08967845212', '2022-03-04 14:57:43', '2022-03-04 14:57:43', 1),
(12, '6101071602990003', 'Bambang', 'Selakau', '08953511720', '2022-04-03 10:31:34', '2022-04-03 10:31:34', 1),
(13, '1234567887456321', 'Ag Jaya', 'Tuparev', '089678425333', '2022-04-06 08:29:39', '2022-04-06 08:29:39', 0);

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
(1, 'INV/2022/04/02/OUT/1', 25000, 33500, 8500, 'cash', 5, 1, '2022-04-02 10:13:24', 0),
(3, 'INV/2022/04/02/OUT/2', 20100, 25150, 5050, 'cash', NULL, 1, '2022-04-02 19:08:59', 0),
(4, 'INV/2022/04/03/OUT/3', 1400000, 1750000, 350000, 'cash', 5, 1, '2022-04-03 13:37:11', 0),
(5, 'INV/2022/04/03/OUT/4', 1120000, 1400000, 280000, 'cash', NULL, 1, '2022-04-03 13:41:25', 0),
(6, 'INV/2022/04/06/OUT/5', 21000000, 26250000, 5250000, 'cash', 13, 1, '2022-04-08 23:04:16', 0),
(7, 'INV/2022/04/06/OUT/6', 145000000, 175000000, 30000000, 'cash', 13, 1, '2022-04-08 23:45:01', 0);

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
(1, 'Aktifitas Login GAGAL', 'Terdapat upaya login dengan username admin', 'danger', '2022-03-23 14:04:16', NULL),
(2, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-03-23 14:04:37', 1),
(3, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root Rayon BERHASIL', 'success', '2022-03-23 14:05:58', 1),
(4, 'Aktifitas Tambah Category Name GAGAL', 'Tambah Data Category Name Polos  GAGAL', 'danger', '2022-03-23 14:06:13', 1),
(5, 'Aktifitas Tambah Category Name BERHASIL', 'Tambah Data Category Name Polos KBI BERHASIL', 'success', '2022-03-23 14:06:31', 1),
(6, 'Aktifitas Tambah Category Model BERHASIL', 'Tambah Data Category Model Merah 2213 BERHASIL', 'success', '2022-03-23 14:07:32', 1),
(7, 'Aktifitas Tambah Roll BERHASIL', 'Tambah Roll BERHASIL dilakukan. Kode Roll : ryn-plskb-mrh2213-yd-rynplskbmrh2213100, Nama Roll :  Rayon Polos KBI Merah 2213 100', 'success', '2022-03-23 14:26:45', 1),
(8, 'Aktifitas Tambah Transaksi Roll BERHASIL', 'Transaksi Roll :  ryn-plskb-mrh2213-yd-rynplskbmrh2213100 BERHASIL dilakukan dengan jumlah 10', 'success', '2022-03-23 14:26:45', 1),
(9, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-23 14:27:23', 1),
(10, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-03-23 14:53:23', 1),
(11, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-03-23 19:15:40', 1),
(12, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root testok BERHASIL', 'success', '2022-03-23 19:16:42', 1),
(13, 'Aktifitas Logout', 'admin BERHASIL logout', 'success', '2022-03-23 19:17:13', 1),
(14, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-03-23 19:17:15', 1),
(15, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-23 19:31:21', 1),
(16, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-03-23 19:31:37', 1),
(17, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-03-23 20:37:08', 1),
(18, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-03-23 20:37:27', 1),
(19, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-03-23 20:45:56', 1),
(20, 'Aktifitas Update Roll BERHASIL', 'Update Roll BERHASIL dilakukan. Kode Roll : ryn-plskb-mrh2213-yd-rynplskbmrh2213, Nama Roll :  Rayon Polos KBI Merah 2213 ', 'success', '2022-03-23 22:01:38', 1),
(21, 'Aktifitas Update Roll BERHASIL', 'Update Roll BERHASIL dilakukan. Kode Roll : ryn-plskb-mrh2213-yd-rynpls, Nama Roll :  Rayon Polos ', 'success', '2022-03-23 22:02:31', 1),
(22, 'Aktifitas Update Roll BERHASIL', 'Update Roll BERHASIL dilakukan. Kode Roll : ryn-plskb-mrh2213-yd-rynpls, Nama Roll :  Rayon Polos ', 'success', '2022-03-23 22:04:52', 1),
(23, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-23 22:07:06', 1),
(24, 'Aktifitas Tambah Roll BERHASIL', 'Tambah Roll BERHASIL dilakukan. Kode Roll : ryn-plskb-mrh2213-yd-rll1, Nama Roll :  roll1', 'success', '2022-03-23 22:11:33', 1),
(25, 'Aktifitas Tambah Transaksi Roll BERHASIL', 'Transaksi Roll :  ryn-plskb-mrh2213-yd-rll1 BERHASIL dilakukan dengan jumlah 2', 'success', '2022-03-23 22:11:33', 1),
(26, 'Aktifitas Tambah Roll BERHASIL', 'Tambah Roll BERHASIL dilakukan. Kode Roll : ryn-plskb-mrh2213-yd-rll2, Nama Roll :  roll2', 'success', '2022-03-23 22:31:38', 1),
(27, 'Aktifitas Tambah Transaksi Roll BERHASIL', 'Transaksi Roll :  ryn-plskb-mrh2213-yd-rll2 BERHASIL dilakukan dengan jumlah 2', 'success', '2022-03-23 22:31:38', 1),
(28, 'Aktifitas Tambah Roll BERHASIL', 'Tambah Roll BERHASIL dilakukan. Kode Roll : ryn-plskb-mrh2213-yd-, Nama Roll :  e', 'success', '2022-03-23 22:32:45', 1),
(29, 'Aktifitas Tambah Transaksi Roll BERHASIL', 'Transaksi Roll :  ryn-plskb-mrh2213-yd- BERHASIL dilakukan dengan jumlah 2', 'success', '2022-03-23 22:32:45', 1),
(30, 'Aktifitas Update Roll BERHASIL', 'Update Roll BERHASIL dilakukan. Kode Roll : ryn-plskb-mrh2213-yd-rl, Nama Roll :  erol', 'success', '2022-03-23 22:32:56', 1),
(31, 'Aktifitas Update Roll BERHASIL', 'Update Roll BERHASIL dilakukan. Kode Roll : ryn-plskb-mrh2213-yd-rl, Nama Roll :  erol', 'success', '2022-03-23 22:34:17', 1),
(32, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-03-24 09:21:57', 1),
(33, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-24 09:43:12', 1),
(34, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-24 09:44:51', 1),
(35, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-24 09:52:40', 1),
(38, 'Aktifitas Tambah Category Model BERHASIL', 'Tambah Data Category Model Bunga 2x BERHASIL', 'success', '2022-03-24 10:22:31', 1),
(39, 'Aktifitas Tambah Roll BERHASIL', 'Tambah Roll BERHASIL dilakukan. Kode Roll : ryn-plskb-mrh2213-yd- kgsc-rllnt, Nama Roll :  rollunit', 'success', '2022-03-24 10:56:51', 1),
(40, 'Aktifitas Tambah Transaksi Roll BERHASIL', 'Transaksi Roll :  ryn-plskb-mrh2213-yd- kgsc-rllnt BERHASIL dilakukan dengan jumlah 2', 'success', '2022-03-24 10:56:51', 1),
(41, 'Aktifitas Tambah Roll BERHASIL', 'Tambah Roll BERHASIL dilakukan. Kode Roll : ryn-plskb-mrh2213-yd- kgsc-tstrkhr, Nama Roll :  testerakhir', 'success', '2022-03-24 11:20:33', 1),
(42, 'Aktifitas Tambah Transaksi Roll BERHASIL', 'Transaksi Roll :  ryn-plskb-mrh2213-yd- kgsc-tstrkhr BERHASIL dilakukan dengan jumlah 1', 'success', '2022-03-24 11:20:33', 1),
(43, 'Aktifitas Hapus Roll BERHASIL', 'Hapus Roll BERHASIL dilakukan. Kode Roll : ryn-plskb-mrh2213-yd-rll1, Nama Roll :  roll1', 'success', '2022-03-24 11:20:46', 1),
(44, 'Aktifitas Hapus Roll BERHASIL', 'Hapus Roll BERHASIL dilakukan. Kode Roll : ryn-plskb-mrh2213-yd-rll2, Nama Roll :  roll2', 'success', '2022-03-24 11:20:49', 1),
(45, 'Aktifitas Hapus Roll BERHASIL', 'Hapus Roll BERHASIL dilakukan. Kode Roll : ryn-plskb-mrh2213-yd- kgsc-rllnt, Nama Roll :  rollunit', 'success', '2022-03-24 11:20:52', 1),
(46, 'Aktifitas Hapus Roll BERHASIL', 'Hapus Roll BERHASIL dilakukan. Kode Roll : ryn-plskb-mrh2213-yd- kgsc-tstrkhr, Nama Roll :  testerakhir', 'success', '2022-03-24 11:20:55', 1),
(47, 'Aktifitas Update Roll BERHASIL', 'Update Roll BERHASIL dilakukan. Kode Roll : ryn-plskb-mrh2213-yd-rls, Nama Roll :  erols', 'success', '2022-03-24 11:21:02', 1),
(48, 'Aktifitas Tambah Roll BERHASIL', 'Tambah Roll BERHASIL dilakukan. Kode Roll : ryn-plskb-bng2x-yd- kgsc-rlltk, Nama Roll :  rolltok', 'success', '2022-03-24 11:26:48', 1),
(49, 'Aktifitas Tambah Transaksi Roll BERHASIL', 'Transaksi Roll :  ryn-plskb-bng2x-yd- kgsc-rlltk BERHASIL dilakukan dengan jumlah 2', 'success', '2022-03-24 11:26:48', 1),
(50, 'Aktifitas Update Roll BERHASIL', 'Update Roll BERHASIL dilakukan. Kode Roll : ryn-plskb-bng2x-yd-rlltkx, Nama Roll :  rolltokx', 'success', '2022-03-24 11:26:56', 1),
(51, 'Aktifitas Tambah Roll BERHASIL', 'Tambah Roll BERHASIL dilakukan. Kode Roll : ryn-plskb-mrh2213-yd- kgsc-nb, Nama Roll :  nb', 'success', '2022-03-24 11:28:40', 1),
(52, 'Aktifitas Tambah Transaksi Roll BERHASIL', 'Transaksi Roll :  ryn-plskb-mrh2213-yd- kgsc-nb BERHASIL dilakukan dengan jumlah 2', 'success', '2022-03-24 11:28:40', 1),
(53, 'Aktifitas Hapus Roll BERHASIL', 'Hapus Roll BERHASIL dilakukan. Kode Roll : ryn-plskb-mrh2213-yd- kgsc-nb, Nama Roll :  nb', 'success', '2022-03-24 11:28:44', 1),
(54, 'Aktifitas Hapus Roll BERHASIL', 'Hapus Roll BERHASIL dilakukan. Kode Roll : ryn-plskb-bng2x-yd-rlltkx, Nama Roll :  rolltokx', 'success', '2022-03-24 11:28:48', 1),
(55, 'Aktifitas Tambah Category Model BERHASIL', 'Tambah Data Category Model asdcx BERHASIL', 'success', '2022-03-24 11:32:34', 1),
(56, 'Aktifitas Update Category Model BERHASIL', 'Update Data Category Model Merah 2213x BERHASIL', 'success', '2022-03-24 11:34:00', 1),
(57, 'Aktifitas Update Category Model BERHASIL', 'Update Data Category Model Merah 2213xx BERHASIL', 'success', '2022-03-24 11:43:13', 1),
(58, 'Aktifitas Tambah Category Model BERHASIL', 'Tambah Data Category Model sx BERHASIL', 'success', '2022-03-24 11:44:39', 1),
(59, 'Aktifitas Update Category Model BERHASIL', 'Update Data Category Model Merah 2213xxx BERHASIL', 'success', '2022-03-24 11:50:36', 1),
(60, 'Aktifitas Update Category Model BERHASIL', 'Update Data Category Model Bunga 2xza BERHASIL', 'success', '2022-03-24 11:50:44', 1),
(61, 'Aktifitas Tambah Category Model BERHASIL', 'Tambah Data Category Model s BERHASIL', 'success', '2022-03-24 11:51:08', 1),
(62, 'Aktifitas Tambah Category Model BERHASIL', 'Tambah Data Category Model xz BERHASIL', 'success', '2022-03-24 11:51:16', 1),
(63, 'Aktifitas Tambah Category Model BERHASIL', 'Tambah Data Category Model Buah2 BERHASIL', 'success', '2022-03-24 11:53:53', 1),
(64, 'Aktifitas Tambah Category Model BERHASIL', 'Tambah Data Category Model ddaa1s BERHASIL', 'success', '2022-03-24 11:55:08', 1),
(65, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-24 12:01:37', 1),
(66, 'Aktifitas Tambah Roll BERHASIL', 'Tambah Roll BERHASIL dilakukan. Kode Roll : ryn-plskb-dd1s- yd-scx, Nama Roll :  scax', 'success', '2022-03-24 13:19:46', 1),
(67, 'Aktifitas Tambah Transaksi Roll BERHASIL', 'Transaksi Roll :  ryn-plskb-dd1s- yd-scx BERHASIL dilakukan dengan jumlah 2', 'success', '2022-03-24 13:19:46', 1),
(68, 'Aktifitas Tambah Roll BERHASIL', 'Tambah Roll BERHASIL dilakukan. Kode Roll : ryn-plskb-mrh2213- kgsc-rll1, Nama Roll :  Roll 1', 'success', '2022-03-24 13:29:28', 1),
(69, 'Aktifitas Tambah Transaksi Roll BERHASIL', 'Transaksi Roll :  ryn-plskb-mrh2213- kgsc-rll1 BERHASIL dilakukan dengan jumlah 90', 'success', '2022-03-24 13:29:28', 1),
(70, 'Aktifitas Tambah Roll BERHASIL', 'Tambah Roll BERHASIL dilakukan. Kode Roll : ryn-plskb-bng2x- kgsc-rl2, Nama Roll :  rol2', 'success', '2022-03-24 13:32:59', 1),
(71, 'Aktifitas Tambah Transaksi Roll BERHASIL', 'Transaksi Roll :  ryn-plskb-bng2x- kgsc-rl2 BERHASIL dilakukan dengan jumlah 70', 'success', '2022-03-24 13:32:59', 1),
(72, 'Aktifitas Tambah Roll BERHASIL', 'Tambah Roll BERHASIL dilakukan. Kode Roll : ryn-plskb-bh2-kgsc-brngrll2, Nama Roll :  Barang Roll 2', 'success', '2022-03-24 13:34:06', 1),
(73, 'Aktifitas Tambah Transaksi Roll BERHASIL', 'Transaksi Roll :  ryn-plskb-bh2-kgsc-brngrll2 BERHASIL dilakukan dengan jumlah 70', 'success', '2022-03-24 13:34:06', 1),
(74, 'Aktifitas Hapus Roll BERHASIL', 'Hapus Roll BERHASIL dilakukan. Kode Roll : ryn-plskb-mrh2213- kgsc-rll1, Nama Roll :  Roll 1', 'success', '2022-03-24 13:34:16', 1),
(75, 'Aktifitas Hapus Roll BERHASIL', 'Hapus Roll BERHASIL dilakukan. Kode Roll : ryn-plskb-bng2x- kgsc-rl2, Nama Roll :  rol2', 'success', '2022-03-24 13:34:18', 1),
(76, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-24 13:43:02', 1),
(77, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-24 14:07:57', 1),
(78, 'Aktifitas Tambah Roll BERHASIL', 'Tambah Roll BERHASIL dilakukan. Kode Roll : ryn-plskb-bh2-yd-fgg, Nama Roll :  fgg', 'success', '2022-03-24 14:45:20', 1),
(79, 'Aktifitas Tambah Transaksi Roll BERHASIL', 'Transaksi Roll :  ryn-plskb-bh2-yd-fgg BERHASIL dilakukan dengan jumlah 3', 'success', '2022-03-24 14:45:20', 1),
(80, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-24 14:45:35', 1),
(81, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-03-24 19:18:08', 1),
(82, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-03-24 23:28:58', 1),
(83, 'Aktifitas Tambah Roll BERHASIL', 'Tambah Roll BERHASIL dilakukan. Kode Roll : sd-kgsc, Nama Roll :  asd', 'success', '2022-03-25 00:10:47', 1),
(84, 'Aktifitas Tambah Transaksi Roll BERHASIL', 'Transaksi Roll :  sd-kgsc BERHASIL dilakukan dengan jumlah 2', 'success', '2022-03-25 00:10:47', 1),
(85, 'Aktifitas Update Roll BERHASIL', 'Update Roll BERHASIL dilakukan. Kode Roll : brng-kgsc, Nama Roll :  Barang ', 'success', '2022-03-25 00:13:43', 1),
(86, 'Aktifitas Hapus Roll BERHASIL', 'Hapus Roll BERHASIL dilakukan. Kode Roll : sd-kgsc, Nama Roll :  asd', 'success', '2022-03-25 00:13:52', 1),
(87, 'Aktifitas Tambah Roll BERHASIL', 'Tambah Roll BERHASIL dilakukan. Kode Roll : rll2-kgsc, Nama Roll :  Roll2', 'success', '2022-03-25 00:18:33', 1),
(88, 'Aktifitas Tambah Transaksi Roll BERHASIL', 'Transaksi Roll :  rll2-kgsc BERHASIL dilakukan dengan jumlah 4', 'success', '2022-03-25 00:18:33', 1),
(89, 'Aktifitas Transaksi Roll Berhasil', 'Transaksi masuk ryn-plskb-bh2-yd-fgg sejumlah 9 Roll Berhasil dilakukan', '', '2022-03-25 00:29:19', 1),
(90, 'Aktifitas Transaksi Roll Berhasil', 'Transaksi masuk ryn-plskb-bh2-yd-fgg sejumlah 9 Roll Berhasil dilakukan', '', '2022-03-25 00:29:42', 1),
(91, 'Aktifitas Transaksi Roll Berhasil', 'Transaksi masuk ryn-plskb-bh2-yd-fgg sejumlah 5 Roll Berhasil dilakukan', '', '2022-03-25 00:30:22', 1),
(92, 'Aktifitas Transaksi Roll Berhasil', 'Transaksi masuk ryn-plskb-bh2-yd-fgg sejumlah 25 Roll Berhasil dilakukan', '', '2022-03-25 00:30:44', 1),
(93, 'Aktifitas Transaksi Roll Berhasil', 'Transaksi masuk ryn-plskb-bh2-yd-fgg sejumlah 5 Roll Berhasil dilakukan', '', '2022-03-25 00:31:39', 1),
(94, 'Aktifitas Update Data Satuan BERHASIL', 'Update data satuan menjadi Kilogram BERHASIL', 'success', '2022-03-25 00:57:46', 1),
(95, 'Aktifitas Update Data Satuan BERHASIL', 'Update data satuan menjadi Yards BERHASIL', 'success', '2022-03-25 01:05:18', 1),
(96, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-03-25 19:47:41', 1),
(97, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-03-26 00:40:30', 1),
(98, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-26 01:14:54', 1),
(99, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-03-26 14:14:44', 1),
(100, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-03-26 14:20:22', 1),
(101, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-03-26 14:42:13', 1),
(102, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-03-26 14:44:25', 1),
(103, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-03-26 14:45:30', 1),
(104, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-26 14:58:36', 1),
(105, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-03-26 15:01:57', 1),
(106, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-26 15:03:23', 1),
(107, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-03-26 15:04:53', 1),
(108, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-03-26 15:07:18', 1),
(109, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-03-26 20:41:32', 1),
(110, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-03-26 20:43:19', 1),
(111, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-26 20:47:11', 1),
(112, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-26 21:57:24', 1),
(113, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-26 22:01:24', 1),
(114, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-26 22:13:17', 1),
(115, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-26 22:13:17', 1),
(116, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-26 22:13:59', 1),
(117, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-26 22:14:42', 1),
(118, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-26 22:16:24', 1),
(119, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-26 22:16:58', 1),
(120, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-26 22:17:36', 1),
(121, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-26 22:18:14', 1),
(122, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-26 22:21:10', 1),
(123, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-26 22:22:16', 1),
(124, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-26 22:23:02', 1),
(125, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-26 22:24:21', 1),
(126, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-26 22:25:56', 1),
(127, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-26 22:30:55', 1),
(128, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-03-27 12:58:06', 1),
(129, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-27 12:58:23', 1),
(130, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-27 13:02:27', 1),
(131, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-27 13:05:56', 1),
(132, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-27 13:10:02', 1),
(133, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-27 13:10:30', 1),
(134, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-27 13:10:45', 1),
(135, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-27 13:12:41', 1),
(136, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-27 13:14:44', 1),
(137, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-27 13:15:09', 1),
(138, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-03-27 13:34:50', 1),
(139, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-03-27 13:36:05', 1),
(140, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-03-27 13:41:24', 1),
(141, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-03-27 13:43:41', 1),
(142, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-03-27 13:44:13', 1),
(143, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-03-27 13:45:02', 1),
(144, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-03-27 13:47:22', 1),
(145, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-03-27 13:49:03', 1),
(146, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-03-27 13:50:31', 1),
(147, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-03-27 13:52:09', 1),
(148, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-03-27 13:53:04', 1),
(149, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-03-27 13:53:46', 1),
(150, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-03-27 18:19:53', 1),
(151, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-27 19:45:12', 1),
(152, 'Aktifitas hapus customer BERHASIL', 'Customer Iqbalddc BERHASIL dihapus', '', '2022-03-27 20:55:35', 1),
(153, 'Aktifitas hapus customer BERHASIL', 'Customer POP BERHASIL dihapus', '', '2022-03-27 20:56:15', 1),
(154, 'Aktifitas hapus customer BERHASIL', 'Customer Bambang BERHASIL dihapus', '', '2022-03-27 20:56:19', 1),
(155, 'Aktifitas hapus customer BERHASIL', 'Customer ANGGA PUJA RESTU PRAKASA BERHASIL dihapus', '', '2022-03-27 20:56:24', 1),
(156, 'Aktifitas hapus customer BERHASIL', 'Customer ANGGA PUJA RESTU PRAKASA BERHASIL dihapus', '', '2022-03-27 20:56:28', 1),
(157, 'Aktifitas hapus customer BERHASIL', 'Customer Aditya BERHASIL dihapus', '', '2022-03-27 20:56:33', 1),
(158, 'Aktifitas hapus customer BERHASIL', 'Customer Bambang BERHASIL dihapus', '', '2022-03-27 20:56:36', 1),
(159, 'Aktifitas Update Data Satuan BERHASIL', 'Update data satuan menjadi Kilogram BERHASIL', 'success', '2022-03-27 21:40:24', 1),
(160, 'Aktifitas Transaksi Roll Berhasil', 'Transaksi masuk brng-kgsc sejumlah 9 Roll Berhasil dilakukan', '', '2022-03-27 21:42:13', 1),
(161, 'Aktifitas Tambah Roll BERHASIL', 'Tambah Roll BERHASIL dilakukan. Kode Roll : rll99-kgs, Nama Roll :  Roll99', 'success', '2022-03-27 21:42:52', 1),
(162, 'Aktifitas Tambah Transaksi Roll BERHASIL', 'Transaksi Roll :  rll99-kgs BERHASIL dilakukan dengan jumlah 4', 'success', '2022-03-27 21:42:52', 1),
(163, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-03-28 20:57:21', 1),
(164, 'Aktifitas Tambah Roll BERHASIL', 'Tambah Roll BERHASIL dilakukan. Kode Roll : rll89-kgs, Nama Roll :  ROll89', 'success', '2022-03-28 23:24:37', 1),
(165, 'Aktifitas Tambah Transaksi Roll BERHASIL', 'Transaksi Roll :  rll89-kgs BERHASIL dilakukan dengan jumlah 2', 'success', '2022-03-28 23:24:37', 1),
(166, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-03-30 17:10:10', 1),
(167, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-03-30 22:41:32', 1),
(168, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-04-01 00:10:59', 1),
(169, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-04-02 07:46:32', 1),
(170, 'Aktifitas Tambah Roll BERHASIL', 'Tambah Roll BERHASIL dilakukan. Kode Roll : rll1-kgs, Nama Roll :  Roll 1', 'success', '2022-04-02 10:12:20', 1),
(171, 'Aktifitas Tambah Transaksi Roll BERHASIL', 'Transaksi Roll :  rll1-kgs BERHASIL dilakukan dengan jumlah 10', 'success', '2022-04-02 10:12:20', 1),
(172, 'Aktifitas Tambah Roll BERHASIL', 'Tambah Roll BERHASIL dilakukan. Kode Roll : rll2-yd, Nama Roll :  Roll 2', 'success', '2022-04-02 10:12:57', 1),
(173, 'Aktifitas Tambah Transaksi Roll BERHASIL', 'Transaksi Roll :  rll2-yd BERHASIL dilakukan dengan jumlah 10', 'success', '2022-04-02 10:12:57', 1),
(174, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-04-02 10:13:24', 1),
(175, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-04-02 10:13:50', 1),
(176, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-04-02 10:14:58', 1),
(177, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-04-02 10:15:48', 1),
(178, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-04-02 10:16:29', 1),
(179, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-04-02 16:51:27', 1),
(180, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-04-02 19:08:59', 1),
(181, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-04-02 22:01:49', 1),
(182, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-04-03 03:37:20', 1),
(183, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-04-03 10:29:01', 1),
(184, 'Aktifitas hapus customer BERHASIL', 'Customer ANGGA PUJA RESTU PRAKASA BERHASIL dihapus', 'success', '2022-04-03 10:29:15', 1),
(185, 'Aktifitas update customer BERHASIL', 'Customer Iqbal Atma Muliawan BERHASIL diperbaharui', 'success', '2022-04-03 10:29:50', 1),
(186, 'Aktifitas Tambah User BERHASIL', 'Customer Bambang BERHASIL ditambahkan', 'success', '2022-04-03 10:31:34', 1),
(187, 'Aktifitas Tambah Satuan BERHASIL', 'Tambah data satuan Kiloton BERHASIL', 'success', '2022-04-03 10:51:13', 1),
(188, 'Aktifitas Update Data Satuan BERHASIL', 'Update data satuan menjadi Kiloton BERHASIL', 'success', '2022-04-03 10:51:31', 1),
(189, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-04-03 13:27:43', 1),
(190, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-04-03 13:28:47', 1),
(191, 'Aktifitas Tambah Roll BERHASIL', 'Tambah Roll BERHASIL dilakukan. Kode Roll : rynplsmrhd32101-yd, Nama Roll :  Rayon Polos Merah D32101', 'success', '2022-04-03 13:31:22', 1),
(192, 'Aktifitas Tambah Transaksi Roll BERHASIL', 'Transaksi Roll :  rynplsmrhd32101-yd BERHASIL dilakukan dengan jumlah 100', 'success', '2022-04-03 13:31:22', 1),
(193, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-04-03 13:37:11', 1),
(194, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-04-03 13:41:25', 1),
(195, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-04-06 08:17:58', 1),
(196, 'Aktifitas Tambah Roll BERHASIL', 'Tambah Roll BERHASIL dilakukan. Kode Roll : krnklmrh1231-yd, Nama Roll :  Krinkel Merah 1231', 'success', '2022-04-06 08:18:52', 1),
(197, 'Aktifitas Tambah Transaksi Roll BERHASIL', 'Transaksi Roll :  krnklmrh1231-yd BERHASIL dilakukan dengan jumlah 100', 'success', '2022-04-06 08:18:52', 1),
(198, 'Aktifitas Tambah Roll BERHASIL', 'Tambah Roll BERHASIL dilakukan. Kode Roll : krnklrng3321-yd, Nama Roll :  Krinkel Orange 3321', 'success', '2022-04-06 08:19:33', 1),
(199, 'Aktifitas Tambah Transaksi Roll BERHASIL', 'Transaksi Roll :  krnklrng3321-yd BERHASIL dilakukan dengan jumlah 50', 'success', '2022-04-06 08:19:33', 1),
(200, 'Aktifitas Transaksi Roll Berhasil', 'Transaksi masuk krnklmrh1231-yd sejumlah 50 Roll Berhasil dilakukan', '', '2022-04-06 08:21:25', 1),
(201, 'Aktifitas Update Data Satuan BERHASIL', 'Update data satuan menjadi Kilogram BERHASIL', 'success', '2022-04-06 08:23:32', 1),
(202, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-04-06 08:27:01', 1),
(203, 'Aktifitas Tambah User BERHASIL', 'Customer Ag Jaya BERHASIL ditambahkan', 'success', '2022-04-06 08:29:39', 1),
(204, 'Aktifitas update customer BERHASIL', 'Customer Ag Jaya BERHASIL diperbaharui', 'success', '2022-04-06 08:29:55', 1),
(205, 'Aktifitas hapus customer BERHASIL', 'Customer Bambang BERHASIL dihapus', 'success', '2022-04-06 08:30:03', 1),
(206, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-04-06 08:31:27', 1),
(207, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-04-06 08:35:20', 1),
(208, 'Aktifitas Tambah Roll BERHASIL', 'Tambah Roll BERHASIL dilakukan. Kode Roll : krnklb-b8823-yd, Nama Roll :  Krinkel Abu-Abu 8823', 'success', '2022-04-06 08:39:47', 1),
(209, 'Aktifitas Tambah Transaksi Roll BERHASIL', 'Transaksi Roll :  krnklb-b8823-yd BERHASIL dilakukan dengan jumlah 10', 'success', '2022-04-06 08:39:47', 1),
(210, 'Aktifitas Tambah Roll BERHASIL', 'Tambah Roll BERHASIL dilakukan. Kode Roll : rynplsmc2231-yd, Nama Roll :  Rayon Polos Moca 2231', 'success', '2022-04-06 08:40:50', 1),
(211, 'Aktifitas Tambah Transaksi Roll BERHASIL', 'Transaksi Roll :  rynplsmc2231-yd BERHASIL dilakukan dengan jumlah 100', 'success', '2022-04-06 08:40:50', 1),
(212, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-04-06 08:47:14', 1),
(213, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-04-06 08:54:20', 1),
(214, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-04-06 08:54:30', 1),
(215, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-04-08 00:04:54', 1),
(216, 'Aktifitas Tambah Roll BERHASIL', 'Tambah Roll BERHASIL dilakukan. Kode Roll : brngrll23-Kg, Nama Roll :  Barang Roll 23', 'success', '2022-04-08 00:11:43', 1),
(217, 'Aktifitas Tambah Transaksi Roll BERHASIL', 'Transaksi Roll :  brngrll23-Kg BERHASIL dilakukan dengan jumlah 2', 'success', '2022-04-08 00:11:43', 1),
(218, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-04-08 20:44:31', 1),
(219, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-04-08 23:04:16', 1),
(220, 'Aktifitas Refund Barang Berhasil', 'Invoice BERHASIL diperbaharui', 'success', '2022-04-08 23:45:01', 1),
(221, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-04-09 03:04:02', 1);

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
  `all_quantity` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `basic_price` int(11) NOT NULL,
  `selling_price` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `barcode_image` varchar(512) DEFAULT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rolls`
--

INSERT INTO `rolls` (`roll_id`, `roll_code`, `barcode_code`, `roll_name`, `unit_quantity`, `roll_quantity`, `all_quantity`, `unit_id`, `basic_price`, `selling_price`, `created_at`, `updated_at`, `barcode_image`, `is_deleted`) VALUES
(1, 'rll1-kgs', '1ccH9KW0', 'Roll 1', 0, 5, 809, 1, 100, 150, '2022-04-02 10:12:20', '2022-04-02 10:12:20', 'barcode/1ccH9KW0.jpg', 0),
(2, 'rll2-yd', '9tXbbc3J', 'Roll 2', 0, 5, 720, 10, 200, 250, '2022-04-02 10:12:57', '2022-04-02 10:12:57', 'barcode/9tXbbc3J.jpg', 0),
(3, 'rynplsmrhd32101-yd', 'ENE9fu3y', 'Rayon Polos Merah D32101', 0, 85, 330, 10, 14000, 17500, '2022-04-03 13:31:22', '2022-04-03 13:31:22', 'barcode/ENE9fu3y.jpg', 0),
(4, 'krnklmrh1231-yd', 'SP4HCs13', 'Krinkel Merah 1231', 0, 150, 1580, 10, 15000, 17500, '2022-04-06 08:18:52', '2022-04-06 08:18:52', 'barcode/SP4HCs13.jpg', 0),
(5, 'krnklrng3321-yd', 'XKs4Pg8w', 'Krinkel Orange 3321', 0, 40, 488, 10, 14000, 17500, '2022-04-06 08:19:33', '2022-04-06 08:19:33', 'barcode/XKs4Pg8w.jpg', 0),
(6, 'krnklb-b8823-yd', 'Ew86sar8', 'Krinkel Abu-Abu 8823', 0, 10, 1080, 10, 14500, 17000, '2022-04-06 08:39:47', '2022-04-06 08:39:47', 'barcode/Ew86sar8.jpg', 0),
(7, 'rynplsmc2231-yd', '7V82odfx', 'Rayon Polos Moca 2231', 0, 88, 80, 10, 14500, 17500, '2022-04-06 08:40:50', '2022-04-06 08:40:50', 'barcode/7V82odfx.jpg', 0),
(8, 'brngrll23-Kg', '2n2flbuQ', 'Barang Roll 23', 0, 2, 20, 1, 50, 80, '2022-04-08 00:11:43', '2022-04-08 00:11:43', 'barcode/2n2flbuQ.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `roll_transactions`
--

CREATE TABLE `roll_transactions` (
  `transaction_id` int(11) NOT NULL,
  `roll_id` int(11) NOT NULL,
  `transaction_type` tinyint(1) NOT NULL,
  `transaction_quantity` int(11) NOT NULL,
  `transaction_quantity_total` int(11) NOT NULL,
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

INSERT INTO `roll_transactions` (`transaction_id`, `roll_id`, `transaction_type`, `transaction_quantity`, `transaction_quantity_total`, `sub_capital`, `sub_total`, `sub_profit`, `type_payment`, `transaction_date`, `invoice_id`, `is_deleted`) VALUES
(1, 1, 0, 10, 900, 0, 90000, 0, 'cash', '2022-04-02 10:12:20', NULL, 0),
(2, 2, 0, 10, 900, 0, 180000, 0, 'cash', '2022-04-02 10:12:57', NULL, 0),
(3, 1, 1, 4, 90, 9000, 13500, 4500, 'cash', '2022-04-02 10:13:24', 1, 0),
(4, 2, 1, 3, 80, 16000, 20000, 4000, 'cash', '2022-04-02 10:13:24', 1, 0),
(10, 1, 1, 1, 1, 100, 150, 50, 'cash', '2022-04-02 19:08:59', 3, 0),
(11, 2, 1, 2, 100, 20000, 25000, 5000, 'cash', '2022-04-02 19:08:59', 3, 0),
(12, 3, 0, 100, 1010, 0, 14140000, 0, 'cash', '2022-04-03 13:31:22', NULL, 0),
(13, 3, 1, 5, 100, 1400000, 1750000, 350000, 'cash', '2022-04-03 13:37:11', 4, 0),
(14, 3, 1, 5, 80, 1120000, 1400000, 280000, 'cash', '2022-04-03 13:41:25', 5, 0),
(15, 4, 0, 100, 1080, 0, 16200000, 0, 'cash', '2022-04-06 08:18:52', NULL, 0),
(16, 5, 0, 50, 512, 0, 7168000, 0, 'cash', '2022-04-06 08:19:33', NULL, 0),
(17, 4, 0, 50, 500, 0, NULL, 0, 'cash', '2022-04-06 08:21:25', NULL, 0),
(22, 6, 0, 10, 1080, 0, 15660000, 0, 'cash', '2022-04-06 08:39:47', NULL, 0),
(23, 7, 0, 100, 10080, 0, 146160000, 0, 'cash', '2022-04-06 08:40:50', NULL, 0),
(25, 8, 0, 2, 20, 0, 1000, 0, 'cash', '2022-04-08 00:11:43', NULL, 0),
(26, 3, 1, 5, 500, 7000000, 8750000, 1750000, 'cash', '2022-04-08 23:04:16', 6, 0),
(27, 5, 1, 10, 1000, 14000000, 17500000, 3500000, 'cash', '2022-04-08 23:04:16', 6, 0),
(28, 7, 1, 12, 10000, 145000000, 175000000, 30000000, 'cash', '2022-04-08 23:45:01', 7, 0);

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
(1, 'Kilogram', 'Kg', 0),
(10, 'Yards', 'yd', 0),
(11, 'Ton', 'ton', 0),
(12, 'Ons', 'ons', 0),
(13, 'Gram', 'gr', 0),
(14, 'Kiloton', 'ktn1', 0);

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
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `roll_transactions`
--
ALTER TABLE `roll_transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `roll_id` (`roll_id`),
  ADD KEY `invoice_id` (`invoice_id`);

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
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `log_activity`
--
ALTER TABLE `log_activity`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT for table `rolls`
--
ALTER TABLE `rolls`
  MODIFY `roll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roll_transactions`
--
ALTER TABLE `roll_transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

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
  ADD CONSTRAINT `rolls_ibfk_3` FOREIGN KEY (`unit_id`) REFERENCES `units` (`unit_id`);

--
-- Constraints for table `roll_transactions`
--
ALTER TABLE `roll_transactions`
  ADD CONSTRAINT `roll_transactions_ibfk_1` FOREIGN KEY (`roll_id`) REFERENCES `rolls` (`roll_id`),
  ADD CONSTRAINT `roll_transactions_ibfk_2` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`invoice_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

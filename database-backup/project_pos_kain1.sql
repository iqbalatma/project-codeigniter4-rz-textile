-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2022 at 08:51 AM
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
(1, 'Bunga 2ps', 'ryn-pls4-bng2ps-kgs', 5, 1, '2022-02-28 00:01:38', '2022-02-28 00:01:38', 0),
(2, 'Bunga', 'knjrsy9-mstkzx-bng-yd', 1, 10, '2022-02-28 19:46:13', '2022-02-28 19:46:13', 0),
(3, 'Abstrak2', 'knjrsy9-mstkzx-bstrk2-yd', 1, 10, '2022-02-28 19:46:13', '2022-02-28 19:46:13', 0),
(4, 'Buah1', 'kntcrp-hygtxp-bh1-kgs', 2, 1, '2022-02-28 19:46:45', '2022-02-28 19:46:45', 0),
(5, 'Hewan2', 'kntcrp-hygtxp-hwn2-kgs', 2, 1, '2022-02-28 19:46:45', '2022-02-28 19:46:45', 0),
(6, 'Buah 2', 'kntcrp-hygtxp-bh2-kgs', 2, 1, '2022-02-28 19:48:13', '2022-02-28 19:48:13', 0),
(7, 'Polos Merah', 'knmrh2-pls-plsmrh-kgs', 3, 1, '2022-02-28 19:48:13', '2022-02-28 19:48:13', 0),
(8, 'Hewan9', 'kntcrp-htx-hwn9-yd', 2, 10, '2022-03-01 14:45:15', '2022-03-01 14:45:15', 0),
(9, 'Hewan', 'kntcrp-hygtxp-hwn-kgs', 2, 1, '2022-03-01 14:45:46', '2022-03-01 14:45:46', 0),
(10, 'Merah', 'knktn-pls-mrh-kgs', 11, 1, '2022-03-04 14:37:24', '2022-03-04 14:37:24', 0),
(11, 'Merah 0100', 'kntcrp-tcrpbstrk-mrh0100-yd', 13, 10, '2022-03-04 14:53:00', '2022-03-04 14:53:00', 0),
(12, 'Kembang 1827', 'knhygt-kmbng-kmbng1827-kgs', 15, 1, '2022-03-04 15:09:07', '2022-03-04 15:09:07', 0),
(13, '108', 'ryn-pls-108-yd', 17, 10, '2022-03-04 15:24:41', '2022-03-04 15:24:41', 0),
(14, 'Merah 181', 'knryn-rynpls-mrh181-yd', 18, 10, '2022-03-05 12:31:28', '2022-03-05 12:31:28', 0),
(15, 'Bunga212', 'knspr-mtf-bng212-yd', 19, 10, '2022-03-05 12:35:22', '2022-03-05 12:35:22', 0),
(16, 'POPTESMODEL', 'kntcrp-pls3-pptsmdl-kgs', 7, 1, '2022-03-07 00:35:59', '2022-03-07 00:35:59', 0);

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
(1, 'Moistekpp', 'knjrsytsdt-mstkpp', 1, '2022-02-27 23:45:52', '2022-02-27 23:45:52', 0),
(2, 'Hitex', 'kntcrp-htx', 2, '2022-02-28 19:24:06', '2022-02-28 19:24:06', 0),
(3, 'Polos', 'knmrh2-pls', 5, '2022-02-28 19:24:58', '2022-02-28 19:24:58', 0),
(4, 'Motif', 'mtf', 2, '2022-02-28 19:24:58', '2022-02-28 19:24:58', 0),
(5, 'Polos4', 'ryn-pls4', 3, '2022-02-28 19:25:10', '2022-02-28 19:25:10', 0),
(6, 'Polos2', 'kntcrp-pls2', 2, '2022-02-28 23:31:53', '2022-02-28 23:31:53', 0),
(7, 'Polos3', 'kntcrp-pls3', 2, '2022-02-28 23:32:08', '2022-02-28 23:32:08', 0),
(8, 'polos', 'knjrsy9pls', 1, '2022-02-28 23:47:46', '2022-02-28 23:47:46', 0),
(9, 'Moistek', 'kntcrp-mstk', 2, '2022-03-01 10:41:38', '2022-03-01 10:41:38', 0),
(10, 'Moistek', 'knmrhddd-mstk', 4, '2022-03-01 10:58:25', '2022-03-01 10:58:25', 0),
(11, ' Polos', 'knktn-pls', 8, '2022-03-04 14:36:09', '2022-03-04 14:36:09', 0),
(12, 'Kain IT Creepe Buah', 'kntcrp-kntcrpbh', 2, '2022-03-04 14:50:23', '2022-03-04 14:50:23', 0),
(13, 'IT Creepe Abstrak', 'kntcrp-tcrpbstrk', 2, '2022-03-04 14:52:24', '2022-03-04 14:52:24', 0),
(14, 'Buah 1', 'knhygt-bh1', 10, '2022-03-04 15:07:06', '2022-03-04 15:07:06', 0),
(15, 'Kembang', 'knhygt-kmbng', 10, '2022-03-04 15:08:28', '2022-03-04 15:08:28', 0),
(16, 'Polos5', 'ryn-pls5', 3, '2022-03-04 15:23:23', '2022-03-04 15:23:23', 0),
(17, 'Polos', 'ryn-pls', 3, '2022-03-04 15:24:12', '2022-03-04 15:24:12', 0),
(18, 'Rayon Polos', 'knryn-rynpls', 11, '2022-03-05 12:30:51', '2022-03-05 12:30:51', 0),
(19, 'Motif', 'knspr-mtf', 12, '2022-03-05 12:34:43', '2022-03-05 12:34:43', 0),
(20, 'pop', 'knknng-pp', 5, '2022-03-06 22:08:02', '2022-03-06 22:08:02', 0),
(21, 'gccg', 'knpnk-gccg', 6, '2022-03-06 22:08:39', '2022-03-06 22:08:39', 0),
(22, 'Moistek', 'knpnk-mstk', 6, '2022-03-06 22:08:44', '2022-03-06 22:08:44', 0),
(23, 'polk', 'knknng-plk', 5, '2022-03-06 22:40:17', '2022-03-06 22:40:17', 0),
(24, 'kuy99', 'rynplss-ky99', 7, '2022-03-07 01:42:26', '2022-03-07 01:42:26', 0),
(25, 'kuy98', 'knknng-ky98', 5, '2022-03-07 01:43:15', '2022-03-07 01:43:15', 0);

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
(1, 'Kain Jersey Tes Edit', 'knjrsytsdt', '2022-02-28 00:13:59', '2022-02-27 17:13:59', 0),
(2, 'Kain IT Creepe', 'kntcrp', '2022-02-28 19:11:59', '2022-02-28 12:11:59', 0),
(3, 'Kain Rayon', 'ryn', '2022-02-28 19:12:16', '2022-02-28 12:12:16', 0),
(4, 'Kain Merah', 'knmrh', '2022-02-28 21:08:48', '2022-02-28 14:08:48', 0),
(5, 'Kain Kuning', 'knknng', '2022-02-28 21:09:09', '2022-02-28 14:09:09', 0),
(6, 'Kain Pink', 'knpnk', '2022-02-28 21:11:29', '2022-02-28 14:11:29', 0),
(7, 'Rayon Poloss', 'rynplss', '2022-03-04 14:34:00', '2022-03-04 07:34:00', 0),
(8, 'Kain Katun', 'knktn', '2022-03-04 14:35:18', '2022-03-04 07:35:18', 0),
(9, 'rootpotp', 'rtptp', '2022-03-04 14:40:46', '2022-03-04 07:40:46', 0),
(10, 'Kain Hyget', 'knhygt', '2022-03-04 15:05:54', '2022-03-04 08:05:54', 0),
(11, 'Kain Rayon', 'knryn', '2022-03-05 12:30:22', '2022-03-05 05:30:22', 0),
(12, 'Kain Sprei', 'knspr', '2022-03-05 12:33:55', '2022-03-05 05:33:55', 0),
(13, 'Akar', 'kr', '2022-03-06 14:54:20', '2022-03-06 07:54:20', 0),
(14, 'Iqbal Tes', 'qblts', '2022-03-06 21:45:30', '2022-03-06 14:45:30', 0),
(15, 'POPasd', 'ppsd', '2022-03-06 21:46:00', '2022-03-06 14:46:00', 0),
(16, 'asd', 'sd', '2022-03-06 21:46:07', '2022-03-06 14:46:07', 0),
(17, 'asdhb', 'sdhb', '2022-03-06 21:46:12', '2022-03-06 14:46:12', 0),
(18, 'asdoqiw', 'sdqw', '2022-03-06 21:46:17', '2022-03-06 14:46:17', 0),
(19, 'Kain Jersey Warna Warni', 'knjrsywrnwrn', '2022-03-06 21:46:37', '2022-03-06 14:46:37', 0),
(20, 'CEK ROOT', 'ckrt', '2022-03-06 22:41:20', '2022-03-06 15:41:20', 0),
(21, 'yok', 'yk', '2022-03-06 22:58:48', '2022-03-06 15:58:48', 0),
(22, 'yok2', 'yk2', '2022-03-07 01:14:41', '2022-03-06 18:14:41', 0),
(23, 'yok3', 'yk3', '2022-03-07 01:20:58', '2022-03-06 18:20:58', 0);

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
(1, 'INV/2022/03/05/OUT/1', 100000, 500000, 400000, 'cash', NULL, 1, '2022-03-05 14:23:06', 0),
(3, 'INV/2022/03/05/OUT/2', 50000, 500000, 450000, 'cash', NULL, 1, '2022-03-05 14:53:40', 0),
(4, 'INV/2022/03/05/OUT/3', 50000, 1, -49999, 'cash', NULL, 1, '2022-03-05 14:58:26', 0),
(5, 'INV/2022/03/05/OUT/4', 50000, 160299, 110299, 'cash', NULL, 1, '2022-03-05 14:59:19', 0),
(6, 'INV/2022/03/05/OUT/5', 50000, 1, -49999, 'cash', NULL, 1, '2022-03-05 15:04:14', 0),
(7, 'INV/2022/03/05/OUT/6', 50000, 1, -49999, 'cash', NULL, 1, '2022-03-05 15:04:47', 0),
(8, 'INV/2022/03/05/OUT/7', 50000, 1, -49999, 'cash', NULL, 1, '2022-03-05 15:06:21', 0),
(9, 'INV/2022/03/05/OUT/8', 50000, 1, -49999, 'cash', NULL, 1, '2022-03-05 15:07:11', 0),
(10, 'INV/2022/03/05/OUT/9', 50000, 1, -49999, 'cash', NULL, 1, '2022-03-05 15:07:41', 0),
(11, 'INV/2022/03/05/OUT/10', 50000, 500000, 450000, 'cash', NULL, 1, '2022-03-05 15:08:06', 0),
(12, 'INV/2022/03/05/OUT/11', 50000, 500000, 450000, 'cash', NULL, 1, '2022-03-05 15:09:21', 0),
(13, 'INV/2022/03/05/OUT/12', 0, 0, 0, 'cash', NULL, 1, '2022-03-05 15:12:23', 0),
(14, 'INV/2022/03/05/OUT/13', 0, 0, 0, 'cash', NULL, 1, '2022-03-05 15:12:38', 0),
(15, 'INV/2022/03/05/OUT/14', 0, 0, 0, 'cash', NULL, 1, '2022-03-05 15:13:05', 0),
(16, 'INV/2022/03/05/OUT/15', 0, 0, 0, 'cash', NULL, 1, '2022-03-05 15:14:32', 0),
(17, 'INV/2022/03/05/OUT/16', 50000, 500000, 450000, 'cash', NULL, 1, '2022-03-05 15:39:32', 0),
(18, 'INV/2022/03/05/OUT/17', 50000, 500000, 450000, 'cash', NULL, 1, '2022-03-05 15:44:49', 0),
(19, 'INV/2022/03/05/OUT/18', 0, 0, 0, 'cash', NULL, 1, '2022-03-05 15:51:48', 0),
(20, 'INV/2022/03/05/OUT/19', 50000, 500000, 450000, 'cash', NULL, 1, '2022-03-05 15:52:09', 0),
(21, 'INV/2022/03/05/OUT/20', 0, 0, 0, 'cash', NULL, 1, '2022-03-05 15:52:49', 0),
(22, 'INV/2022/03/05/OUT/21', 0, 0, 0, 'cash', NULL, 1, '2022-03-05 15:53:43', 0),
(23, 'INV/2022/03/05/OUT/22', 0, 0, 0, 'cash', NULL, 1, '2022-03-05 15:58:48', 0),
(24, 'INV/2022/03/05/OUT/23', 50000, 500000, 450000, 'cash', NULL, 1, '2022-03-05 16:02:23', 0),
(25, 'INV/2022/03/05/OUT/24', 50000, 500000, 450000, 'cash', NULL, 1, '2022-03-05 16:03:44', 0),
(26, 'INV/2022/03/05/OUT/25', 50000, 500000, 450000, 'cash', NULL, 1, '2022-03-05 16:09:03', 0),
(27, 'INV/2022/03/05/OUT/26', 50000, 500000, 450000, 'cash', NULL, 1, '2022-03-05 16:11:10', 0),
(28, 'INV/2022/03/05/OUT/27', 0, 0, 0, 'cash', NULL, 1, '2022-03-05 16:12:40', 0),
(29, 'INV/2022/03/05/OUT/28', 0, 0, 0, 'cash', NULL, 1, '2022-03-05 16:13:05', 0),
(30, 'INV/2022/03/05/OUT/29', 0, 0, 0, 'cash', NULL, 1, '2022-03-05 16:14:24', 0),
(31, 'INV/2022/03/05/OUT/30', 100000, 160000, 60000, 'cash', NULL, 1, '2022-03-05 16:20:53', 0),
(32, 'INV/2022/03/05/OUT/31', 100000, 1000000, 900000, 'cash', NULL, 1, '2022-03-05 21:22:01', 0),
(33, 'INV/2022/03/05/OUT/32', 100000, 1000000, 900000, 'cash', NULL, 1, '2022-03-05 21:22:50', 0),
(34, 'INV/2022/03/05/OUT/33', 420000, 4200000, 3780000, 'cash', NULL, 1, '2022-03-05 21:23:36', 0),
(35, 'INV/2022/03/06/OUT/34', 100000, 1000000, 900000, 'cash', NULL, 1, '2022-03-06 11:38:32', 0),
(36, 'INV/2022/03/06/OUT/35', 50000, 500000, 450000, 'transfer', NULL, 1, '2022-03-06 12:21:00', 0);

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
(1, 'Aktifitas Tambah Roll BERHASIL', 'Tambah Roll BERHASIL dilakukan. Kode Roll : knhygt-kmbng-kmbng1827-kgs-rllmrh, Nama Roll :  Roll Merah', 'success', '2022-03-05 14:22:45', 1),
(2, 'Aktifitas Tambah Transaksi Roll BERHASIL', 'Transaksi Roll :  knhygt-kmbng-kmbng1827-kgs-rllmrh BERHASIL dilakukan dengan jumlah 2', 'success', '2022-03-05 14:22:45', 1),
(3, 'Aktifitas Transaksi Roll Berhasil', 'Transaksi masuk knhygt-kmbng-kmbng1827-kgs-rllmrh sejumlah 100 Roll Berhasil dilakukan', '', '2022-03-05 14:38:57', 1),
(4, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-05 16:11:10', 1),
(5, 'Transaksi penjualan GAGAL', 'Transaksi penjualan GAGAL', 'success', '2022-03-05 16:12:40', 1),
(6, 'Transaksi penjualan GAGAL', 'Transaksi penjualan GAGAL', 'success', '2022-03-05 16:13:05', 1),
(7, 'Transaksi penjualan GAGAL', 'Transaksi penjualan GAGAL', 'success', '2022-03-05 16:14:24', 1),
(8, 'Aktifitas Tambah Roll BERHASIL', 'Tambah Roll BERHASIL dilakukan. Kode Roll : kntcrp-hygtxp-hwn2-yd-brngrllqbl, Nama Roll :  Barang Roll Iqbal', 'success', '2022-03-05 16:17:08', 1),
(9, 'Aktifitas Tambah Transaksi Roll BERHASIL', 'Transaksi Roll :  kntcrp-hygtxp-hwn2-yd-brngrllqbl BERHASIL dilakukan dengan jumlah 5', 'success', '2022-03-05 16:17:08', 1),
(10, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-05 16:20:53', 1),
(11, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-03-05 19:04:48', 1),
(12, 'Aktifitas Tambah Roll BERHASIL', 'Tambah Roll BERHASIL dilakukan. Kode Roll : knhygt-kmbng-kmbng1827-kgs-tsdlt, Nama Roll :  Tes Delete', 'success', '2022-03-05 21:02:29', 1),
(13, 'Aktifitas Tambah Transaksi Roll BERHASIL', 'Transaksi Roll :  knhygt-kmbng-kmbng1827-kgs-tsdlt BERHASIL dilakukan dengan jumlah 3', 'success', '2022-03-05 21:02:29', 1),
(14, 'Aktifitas Hapus Roll GAGAL', 'Hapus Roll GAGAL dilakukan. Kode Roll : knhygt-kmbng-kmbng1827-kgs-tsdlt, Nama Roll :  Tes Delete', 'success', '2022-03-05 21:12:07', 1),
(15, 'Aktifitas Hapus Roll BERHASIL', 'Hapus Roll BERHASIL dilakukan. Kode Roll : knhygt-kmbng-kmbng1827-kgs-tsdlt, Nama Roll :  Tes Delete', 'success', '2022-03-05 21:14:12', 1),
(16, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-05 21:22:01', 1),
(17, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-05 21:22:50', 1),
(18, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-05 21:23:37', 1),
(19, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-03-06 11:38:07', 1),
(20, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-06 11:38:32', 1),
(21, 'Transaksi penjualan BERHASIL', 'Transaksi penjualan BERHASIL', 'success', '2022-03-06 12:21:00', 1),
(22, 'Aktifitas Tambah Category Root GAGAL', 'Tambah Data Category Root  GAGAL', 'danger', '2022-03-06 13:40:11', NULL),
(23, 'Aktifitas Tambah Category Root GAGAL', 'Tambah Data Category Root  GAGAL', 'danger', '2022-03-06 13:40:42', NULL),
(24, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root  BERHASIL', 'success', '2022-03-06 13:41:13', NULL),
(25, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root  BERHASIL', 'success', '2022-03-06 13:41:45', NULL),
(26, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root  BERHASIL', 'success', '2022-03-06 13:42:12', NULL),
(27, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root ajsdk BERHASIL', 'success', '2022-03-06 13:42:43', 1),
(28, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root skjfjkas BERHASIL', 'success', '2022-03-06 13:43:57', NULL),
(29, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root skjfjkas BERHASIL', 'success', '2022-03-06 13:48:04', NULL),
(30, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root skjfjkas BERHASIL', 'success', '2022-03-06 13:49:19', NULL),
(31, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root pop BERHASIL', 'success', '2022-03-06 13:56:47', 1),
(32, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root pop BERHASIL', 'success', '2022-03-06 14:02:58', 1),
(33, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root pop BERHASIL', 'success', '2022-03-06 14:03:01', 1),
(34, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root popd BERHASIL', 'success', '2022-03-06 14:03:07', 1),
(35, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root pop BERHASIL', 'success', '2022-03-06 14:04:50', 1),
(36, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root popd BERHASIL', 'success', '2022-03-06 14:04:55', 1),
(37, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root popd BERHASIL', 'success', '2022-03-06 14:04:58', 1),
(38, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root popd BERHASIL', 'success', '2022-03-06 14:05:01', 1),
(39, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root asd BERHASIL', 'success', '2022-03-06 14:13:15', 1),
(40, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root d BERHASIL', 'success', '2022-03-06 14:17:19', 1),
(41, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root dp BERHASIL', 'success', '2022-03-06 14:17:23', 1),
(42, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root d BERHASIL', 'success', '2022-03-06 14:28:38', 1),
(43, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root tes BERHASIL', 'success', '2022-03-06 14:30:19', 1),
(44, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root asd BERHASIL', 'success', '2022-03-06 14:31:20', 1),
(45, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root asd BERHASIL', 'success', '2022-03-06 14:32:03', 1),
(46, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root asd BERHASIL', 'success', '2022-03-06 14:35:05', 1),
(47, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root asdp BERHASIL', 'success', '2022-03-06 14:35:13', 1),
(48, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root asdp BERHASIL', 'success', '2022-03-06 14:35:23', 1),
(49, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root l BERHASIL', 'success', '2022-03-06 14:36:20', 1),
(50, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root p BERHASIL', 'success', '2022-03-06 14:36:34', 1),
(51, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root d BERHASIL', 'success', '2022-03-06 14:38:30', 1),
(52, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root d BERHASIL', 'success', '2022-03-06 14:39:00', 1),
(53, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root d BERHASIL', 'success', '2022-03-06 14:40:06', 1),
(54, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root d BERHASIL', 'success', '2022-03-06 14:40:11', 1),
(55, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root d BERHASIL', 'success', '2022-03-06 14:40:18', 1),
(56, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root s BERHASIL', 'success', '2022-03-06 14:41:27', 1),
(57, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root s BERHASIL', 'success', '2022-03-06 14:41:30', 1),
(58, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root p BERHASIL', 'success', '2022-03-06 14:41:45', 1),
(59, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root s BERHASIL', 'success', '2022-03-06 14:42:07', 1),
(60, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root s BERHASIL', 'success', '2022-03-06 14:42:17', 1),
(61, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root s BERHASIL', 'success', '2022-03-06 14:49:04', 1),
(62, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root l BERHASIL', 'success', '2022-03-06 14:50:54', 1),
(63, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root j BERHASIL', 'success', '2022-03-06 14:51:29', 1),
(64, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root po BERHASIL', 'success', '2022-03-06 14:51:35', 1),
(65, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root ias BERHASIL', 'success', '2022-03-06 14:51:50', 1),
(66, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root d BERHASIL', 'success', '2022-03-06 14:51:58', 1),
(67, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root s BERHASIL', 'success', '2022-03-06 14:52:16', 1),
(68, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root j BERHASIL', 'success', '2022-03-06 14:53:25', 1),
(69, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root p BERHASIL', 'success', '2022-03-06 14:53:47', 1),
(70, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root jg BERHASIL', 'success', '2022-03-06 14:53:50', 1),
(71, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root Akar BERHASIL', 'success', '2022-03-06 14:54:20', 1),
(72, 'Aktifitas Update Category Root BERHASIL', 'Update Data Category Root Kain Jerseyp BERHASIL', 'success', '2022-03-06 15:19:18', 1),
(73, 'Aktifitas Update Category Root BERHASIL', 'Update Data Category Root Kain Jerseyp BERHASIL', 'success', '2022-03-06 15:20:49', 1),
(74, 'Aktifitas Update Category Root BERHASIL', 'Update Data Category Root Kain Jerseyp BERHASIL', 'success', '2022-03-06 15:21:08', 1),
(75, 'Aktifitas Update Category Root BERHASIL', 'Update Data Category Root Kain Jersey Tes Edit BERHASIL', 'success', '2022-03-06 15:22:38', 1),
(76, 'Aktifitas Update Category Root BERHASIL', 'Update Data Category Root Rayon Poloss BERHASIL', 'success', '2022-03-06 19:09:02', NULL),
(77, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-03-06 19:12:52', 1),
(78, 'Aktifitas Update Category Name BERHASIL', 'Update Data Category Name Moistek1 BERHASIL', 'success', '2022-03-06 19:19:42', 1),
(79, 'Aktifitas Update Category Name GAGAL', 'Update Data Category Name Moistek1 GAGAL', 'danger', '2022-03-06 19:19:42', 1),
(80, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root Iqbal Tes BERHASIL', 'success', '2022-03-06 21:45:30', 1),
(81, 'Aktifitas Update Category Model BERHASIL', 'Update Data Category Model Hewan9 BERHASIL', 'success', '2022-03-06 21:45:46', 1),
(82, 'Aktifitas Update Category Model GAGAL', 'Update Data Category Model Hewan9 GAGAL', 'danger', '2022-03-06 21:45:46', 1),
(83, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root POPasd BERHASIL', 'success', '2022-03-06 21:46:00', 1),
(84, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root asd BERHASIL', 'success', '2022-03-06 21:46:07', 1),
(85, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root asdhb BERHASIL', 'success', '2022-03-06 21:46:12', 1),
(86, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root asdoqiw BERHASIL', 'success', '2022-03-06 21:46:17', 1),
(87, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root Kain Jersey Warna Warni BERHASIL', 'success', '2022-03-06 21:46:37', 1),
(88, 'Aktifitas Tambah Category Name GAGAL', 'Tambah Data Category Name  GAGAL', 'danger', '2022-03-06 22:01:01', 1),
(89, 'Aktifitas Tambah Category Name GAGAL', 'Tambah Data Category Name  GAGAL', 'danger', '2022-03-06 22:01:30', 1),
(90, 'Aktifitas Tambah Category Name BERHASIL', 'Tambah Data Category Name  BERHASIL', 'success', '2022-03-06 22:02:07', 1),
(91, 'Aktifitas Tambah Category Name BERHASIL', 'Tambah Data Category Name  BERHASIL', 'success', '2022-03-06 22:02:35', 1),
(92, 'Aktifitas Tambah Category Name BERHASIL', 'Tambah Data Category Name  BERHASIL', 'success', '2022-03-06 22:03:33', 1),
(93, 'Aktifitas Tambah Category Name BERHASIL', 'Tambah Data Category Name h BERHASIL', 'success', '2022-03-06 22:05:31', 1),
(94, 'Aktifitas Tambah Category Name BERHASIL', 'Tambah Data Category Name  BERHASIL', 'success', '2022-03-06 22:05:37', 1),
(95, 'Aktifitas Tambah Category Name BERHASIL', 'Tambah Data Category Name asd BERHASIL', 'success', '2022-03-06 22:06:06', 1),
(96, 'Aktifitas Tambah Category Name BERHASIL', 'Tambah Data Category Name  BERHASIL', 'success', '2022-03-06 22:06:12', 1),
(97, 'Aktifitas Tambah Category Name BERHASIL', 'Tambah Data Category Name pop BERHASIL', 'success', '2022-03-06 22:08:02', 1),
(98, 'Aktifitas Tambah Category Name BERHASIL', 'Tambah Data Category Name gccg BERHASIL', 'success', '2022-03-06 22:08:39', 1),
(99, 'Aktifitas Tambah Category Name BERHASIL', 'Tambah Data Category Name Moistek BERHASIL', 'success', '2022-03-06 22:08:44', 1),
(100, 'Aktifitas Update Category Name BERHASIL', 'Update Data Category Name Moistek12 BERHASIL', 'success', '2022-03-06 22:36:25', 1),
(101, 'Aktifitas Update Category Name BERHASIL', 'Update Data Category Name Moistek12x BERHASIL', 'success', '2022-03-06 22:36:37', 1),
(102, 'Aktifitas Update Category Name BERHASIL', 'Update Data Category Name Moistek12xs BERHASIL', 'success', '2022-03-06 22:37:42', 1),
(103, 'Aktifitas Update Category Name BERHASIL', 'Update Data Category Name Moistek BERHASIL', 'success', '2022-03-06 22:38:20', 1),
(104, 'Aktifitas Update Category Name BERHASIL', 'Update Data Category Name Moistekp BERHASIL', 'success', '2022-03-06 22:40:01', 1),
(105, 'Aktifitas Tambah Category Name BERHASIL', 'Tambah Data Category Name polk BERHASIL', 'success', '2022-03-06 22:40:17', 1),
(106, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root CEK ROOT BERHASIL', 'success', '2022-03-06 22:41:20', 1),
(107, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root yok BERHASIL', 'success', '2022-03-06 22:58:48', 1),
(108, 'Aktifitas Tambah Category Model BERHASIL', 'Tambah Data Category Model asd BERHASIL', 'success', '2022-03-07 00:22:20', 1),
(109, 'Aktifitas Tambah Category Model BERHASIL', 'Tambah Data Category Model asd BERHASIL', 'success', '2022-03-07 00:22:42', 1),
(110, 'Aktifitas Update Category Model BERHASIL', 'Update Data Category Model asd BERHASIL', 'success', '2022-03-07 00:31:46', 1),
(111, 'Aktifitas Update Category Name BERHASIL', 'Update Data Category Name Moistekpp BERHASIL', 'success', '2022-03-07 00:32:50', 1),
(112, 'Aktifitas Update Category Model BERHASIL', 'Update Data Category Model Bunga 2p BERHASIL', 'success', '2022-03-07 00:32:56', 1),
(113, 'Aktifitas Update Category Model BERHASIL', 'Update Data Category Model Bunga 2p BERHASIL', 'success', '2022-03-07 00:33:47', 1),
(114, 'Aktifitas Tambah Category Model BERHASIL', 'Tambah Data Category Model POPTESMODEL BERHASIL', 'success', '2022-03-07 00:35:59', 1),
(115, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root yok2 BERHASIL', 'success', '2022-03-07 01:14:41', 1),
(116, 'Aktifitas Tambah Category Root BERHASIL', 'Tambah Data Category Root yok3 BERHASIL', 'success', '2022-03-07 01:20:58', 1),
(117, 'Aktifitas Update Category Model BERHASIL', 'Update Data Category Model Bunga 2ps BERHASIL', 'success', '2022-03-07 01:41:32', 1),
(118, 'Aktifitas Tambah Category Name BERHASIL', 'Tambah Data Category Name kuy99 BERHASIL', 'success', '2022-03-07 01:42:26', 1),
(119, 'Aktifitas Tambah Category Name BERHASIL', 'Tambah Data Category Name kuy98 BERHASIL', 'success', '2022-03-07 01:43:15', 1),
(120, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-03-07 17:42:27', 1),
(121, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-03-07 23:36:16', 1),
(122, 'Aktifitas Update Roll BERHASIL', 'Update Roll BERHASIL dilakukan. Kode Roll : kntcrp-htx-hwn9-yd-brngrllqbl, Nama Roll :  Barang Roll Iqbal', 'success', '2022-03-08 00:38:00', 1),
(123, 'Aktifitas Update Roll BERHASIL', 'Update Roll BERHASIL dilakukan. Kode Roll : knhygt-kmbng-kmbng1827-kgs-brngrllqbl, Nama Roll :  Barang Roll Iqbal', 'success', '2022-03-08 00:38:46', 1),
(124, 'Aktifitas Login BERHASIL', 'admin BERHASIL melakukan login', 'success', '2022-03-08 23:04:07', 1);

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
(1, 'knhygt-kmbng-kmbng1827-kgs-rllmrh', 'qJzhIf50', 'Roll Merah', 2, 63, 50000, 500000, 12, '2022-03-05 14:22:45', '2022-03-05 14:22:45', 'barcode/qJzhIf50.jpg', 0),
(2, 'knhygt-kmbng-kmbng1827-kgs-brngrllqbl', '2i9T8O9L', 'Barang Roll Iqbal', 1, 2, 90000, 900000, 12, '2022-03-05 16:17:08', '2022-03-05 16:17:08', 'barcode/knhygt-kmbng-kmbng1827-kgs-brngrllqbl.jpg', 0);

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
(1, 1, 0, 2, 0, 100000, 0, 'cash', '2022-03-05 14:22:45', NULL, 0),
(2, 1, 1, 2, 0, 500, 0, 'cash', '2022-03-05 14:23:06', 1, 0),
(3, 1, 0, 100, 0, NULL, 0, 'cash', '2022-03-05 14:38:57', NULL, 0),
(4, 1, 1, 1, 0, 500, 0, 'cash', '2022-03-05 14:53:40', 3, 0),
(5, 1, 1, 1, 0, 500, 0, 'cash', '2022-03-05 14:58:26', 4, 0),
(6, 1, 1, 1, 0, 500, 0, 'cash', '2022-03-05 14:59:19', 5, 0),
(7, 1, 1, 1, 0, 1, 0, 'cash', '2022-03-05 15:04:14', 6, 0),
(8, 1, 1, 1, 0, 1, 0, 'cash', '2022-03-05 15:04:47', 7, 0),
(9, 1, 1, 1, 0, 1, 0, 'cash', '2022-03-05 15:06:21', 8, 0),
(10, 1, 1, 1, 0, 1, 0, 'cash', '2022-03-05 15:07:11', 9, 0),
(11, 1, 1, 1, 0, 1, 0, 'cash', '2022-03-05 15:07:41', 10, 0),
(12, 1, 1, 1, 0, 500000, 0, 'cash', '2022-03-05 15:08:06', 11, 0),
(13, 1, 1, 1, 0, 500000, 0, 'cash', '2022-03-05 15:09:21', 12, 0),
(14, 1, 1, 1, 0, 500000, 0, 'cash', '2022-03-05 15:12:23', 13, 0),
(15, 1, 1, 1, 0, 500000, 0, 'cash', '2022-03-05 15:12:38', 14, 0),
(16, 1, 1, 1, 0, 500000, 0, 'cash', '2022-03-05 15:13:05', 15, 0),
(17, 1, 1, 1, 0, 500000, 0, 'cash', '2022-03-05 15:14:32', 16, 0),
(18, 1, 1, 1, 0, 500000, 0, 'cash', '2022-03-05 15:39:32', 17, 0),
(19, 1, 1, 1, 0, 500000, 0, 'cash', '2022-03-05 15:44:49', 18, 0),
(20, 1, 1, 1, 0, 500000, 0, 'cash', '2022-03-05 15:52:09', 20, 0),
(21, 1, 1, 1, 0, 500000, 0, 'cash', '2022-03-05 15:52:49', 21, 0),
(22, 1, 1, 2, 0, 1000000, 0, 'cash', '2022-03-05 15:53:43', 22, 0),
(23, 1, 1, 1, 0, 500000, 0, 'cash', '2022-03-05 15:58:48', 23, 0),
(24, 1, 1, 1, 0, 500000, 0, 'cash', '2022-03-05 16:02:23', 24, 0),
(25, 1, 1, 1, 0, 500000, 0, 'cash', '2022-03-05 16:03:44', 25, 0),
(26, 1, 1, 1, 0, 500000, 0, 'cash', '2022-03-05 16:09:03', 26, 0),
(27, 1, 1, 1, 0, 500000, 0, 'cash', '2022-03-05 16:11:10', 27, 0),
(28, 2, 0, 5, 0, 450000, 0, 'cash', '2022-03-05 16:17:08', NULL, 0),
(29, 1, 1, 2, 0, 160000, 0, 'cash', '2022-03-05 16:20:53', 31, 0),
(31, 1, 1, 2, 0, 1000000, 0, 'cash', '2022-03-05 21:22:01', 32, 0),
(32, 1, 1, 2, 0, 1000000, 900000, 'cash', '2022-03-05 21:22:50', 33, 0),
(33, 1, 1, 3, 0, 1500000, 1350000, 'cash', '2022-03-05 21:23:36', 34, 0),
(34, 2, 1, 3, 0, 2700000, 2430000, 'cash', '2022-03-05 21:23:37', 34, 0),
(35, 1, 1, 2, 100000, 1000000, 900000, 'cash', '2022-03-06 11:38:32', 35, 0),
(36, 1, 1, 1, 50000, 500000, 450000, 'cash', '2022-03-06 12:21:00', 36, 0);

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
(1, 'Kilogram', 'kgs', 0),
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
  MODIFY `category_model_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `category_names`
--
ALTER TABLE `category_names`
  MODIFY `category_name_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `category_roots`
--
ALTER TABLE `category_roots`
  MODIFY `category_root_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `log_activity`
--
ALTER TABLE `log_activity`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `rolls`
--
ALTER TABLE `rolls`
  MODIFY `roll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roll_transactions`
--
ALTER TABLE `roll_transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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

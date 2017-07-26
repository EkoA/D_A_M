-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2017 at 09:10 AM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_manager`
--
CREATE DATABASE IF NOT EXISTS `inventory_manager` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `inventory_manager`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `classifications`
--

DROP TABLE IF EXISTS `classifications`;
CREATE TABLE IF NOT EXISTS `classifications` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(255) NOT NULL,
  `short_code` varchar(2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `short_code` (`short_code`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classifications`
--

INSERT INTO `classifications` (`id`, `class_name`, `short_code`, `description`, `created_at`, `updated_at`) VALUES
(2, 'Furniture & Fittings', 'FF', 'This consists of Furniture and Fittings', '2017-03-23 12:50:33', '2017-03-23 12:50:33'),
(4, 'Office Stuff', 'FT', 'This consists of Furniture and Fittings', '2017-03-23 12:51:16', '2017-03-23 12:51:16');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(100) NOT NULL,
  `short_code` varchar(2) NOT NULL,
  `created_by` varchar(140) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `dept_name`, `short_code`, `created_by`, `created_at`, `updated_at`) VALUES
(5, 'TECHNOLOGY', 'TN', 'Donald Trumpp', '2017-04-04 11:56:35', '2017-04-04 11:56:35'),
(6, 'MD DIRECTORATE', 'MD', 'Donald Trumpp', '2017-04-04 12:23:03', '2017-04-04 12:23:03'),
(7, 'LEGAL', 'LG', 'Donald Trumpp', '2017-04-04 12:31:15', '2017-04-04 12:31:15'),
(8, 'OPERATIONS / BUSSINESS DEVELOPMENT', 'OB', 'Donald Trumpp', '2017-04-04 12:35:59', '2017-04-04 12:35:59'),
(9, 'HUMAN CAPITAL', 'HR', 'Donald Trumpp', '2017-04-04 12:41:45', '2017-04-04 12:41:45'),
(10, 'TREASURY / INVESTOR RELATIONS', 'TR', 'Donald Trumpp', '2017-04-04 12:49:26', '2017-04-04 12:49:26'),
(12, 'FINANCE', 'FN', 'Donald Trumpp', '2017-04-04 12:58:16', '2017-04-04 12:58:16');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `asset_number` varchar(15) NOT NULL,
  `serialno` varchar(140) NOT NULL,
  `invoice_number` varchar(20) NOT NULL,
  `item` varchar(20) NOT NULL,
  `department` varchar(30) NOT NULL,
  `location` varchar(150) NOT NULL,
  `classification` varchar(100) NOT NULL,
  `supplier_details` varchar(140) NOT NULL,
  `description` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `economiclife` int(32) NOT NULL,
  `isdepreciate` varchar(5) NOT NULL,
  `depreciationformula` varchar(140) NOT NULL,
  `current_value` decimal(10,2) NOT NULL,
  `purchase_date` varchar(140) NOT NULL,
  `asset_approval` varchar(30) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `disposal_status` varchar(30) NOT NULL,
  `disposal_date` varchar(140) NOT NULL,
  `sales_invoice` varchar(50) NOT NULL,
  `agreed_price` decimal(10,2) NOT NULL,
  `further_info` varchar(140) NOT NULL,
  `updated_at` varchar(20) NOT NULL,
  `created_at` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `serial_number` (`asset_number`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `asset_number`, `serialno`, `invoice_number`, `item`, `department`, `location`, `classification`, `supplier_details`, `description`, `amount`, `economiclife`, `isdepreciate`, `depreciationformula`, `current_value`, `purchase_date`, `asset_approval`, `created_by`, `disposal_status`, `disposal_date`, `sales_invoice`, `agreed_price`, `further_info`, `updated_at`, `created_at`) VALUES
(8, 'DM/OE/LG/008', '', 'CN10009', 'HeadPhones', 'Legal', 'Lawyer''s office', 'Office Equipment', 'Mr Gbade', '', '5000.00', 0, '', '', '0.00', '2016-10-02', '', '', '', '', '', '0.00', '', '2016-10-24 11:30:52', '2016-10-05 15:38:40'),
(9, 'DM/PM/OB/009', '', 'CN10009', 'Phone', 'Operations', 'Akin''s office', 'Plant & Machinery', 'Computer village', 'For Testing apps', '500000.00', 0, '', '', '0.00', '', '', '', '', '', '', '0.00', '', '2016-10-24 11:40:08', '2016-10-06 05:20:50'),
(12, 'DM/PM/OB/012', '', 'CN10009', 'Laptop', 'Operations', 'MD''s Office', 'Plant & Machinery', 'Mr Gbade', 'core i 5', '20000.00', 0, '', '', '0.00', '', '', '', '', '', '', '0.00', '', '2016-11-03 15:14:33', '2016-10-06 10:07:56'),
(13, 'DM/PM/OB/013', '', 'CN10009', 'Keyboard', 'Operations', 'CTO''s office', 'Plant & Machinery', 'Mr Gbade', 'Black and grey', '500.00', 0, '', '', '0.00', '', '', '', '', '', '', '0.00', '', '2016-11-03 15:11:01', '2016-10-07 15:00:28'),
(14, 'DM/PM/OB/014', '', 'CN10009', 'Chair', 'Operations', 'rgtgt', 'Plant & Machinery', 'ctgt', 'For sitting', '-9.00', 0, '', '', '0.00', '2016-10-13', '', '', '', '', '', '0.00', '', '2016-10-24 11:37:38', '2016-10-13 15:23:29'),
(15, 'DM/PM/OB/015', '', 'fgvfsf', 'Chair', 'Operations', 'efdfvd', 'Plant & Machinery', 'rfdvfdsvf', 'joidiojisd', '1.00', 0, '', '', '0.00', '2017-01-04', '', '', '', '', '', '0.00', '', '2017-01-05 13:37:11', '2017-01-05 13:26:12'),
(16, 'DM/PM/OB/016', '', 'CN000', 'Cups', 'Operations', 'Kitchen', 'Plant & Machinery', 'Mr Tayo', 'Cups for drinks', '100.00', 0, '', '', '0.00', '5/8/12', '', '', '', '', '', '0.00', '', '2017-01-11 11:20:37', '2017-01-11 11:18:35'),
(17, 'DM/OE/TN/017', '', 'CN10009', 'Laptop', 'Technology', 'Tech cluster', 'Office Equipment', 'Shinko laptop', 'Lenovo Laptop', '10000.00', 0, '', '', '0.00', '2017-03-22', '', '', '', '', '', '0.00', '', '2017-03-22 09:12:56', '2017-03-22 09:12:35'),
(18, 'DM/OE/OO/018', '', 'CN10009', 'Laptop', 'Operations', 'du9hwiue', 'Plant & Machinery', 'qwiuui', 'efhiweh', '1.00', 0, '', '', '0.00', '2017-03-21', '', '', '', '', '', '0.00', '', '2017-03-22 09:14:19', '2017-03-22 09:14:19'),
(20, 'DM/OE/OO/020', '', 'CN10009', 'Laptop', 'Operations', 'tyhtujrt', 'Plant & Machinery', 'ejrts5ryj', 'refgrhg', '1.00', 0, '', '', '0.00', '2017-03-21', '', '', '', '', '', '0.00', '', '2017-03-22 09:19:14', '2017-03-22 09:19:14'),
(23, 'DM/PM/OB/023', '', 'CN10009', 'Laptop', 'Operations', 'ytyctktky', 'Plant & Machinery', 'jtardytdyut', 'Lghcgcgcgh', '1.00', 0, '', '', '0.00', '2017-03-15', '', '', '', '', '', '0.00', '', '2017-03-22 09:37:28', '2017-03-22 09:37:28'),
(24, 'DM//FN/024', '', 'CN10009', 'Chair', 'Finance', 'bwegergb', '', 'werbef', 'Hello', '1.00', 0, '', '', '0.00', '2017-03-22', '', '', '', '', '', '0.00', '', '2017-03-23 16:05:41', '2017-03-23 16:05:41'),
(25, 'None', '', 'CN10009', 'Chair', 'Finance', 'bwegergb', '', 'werbef', 'Hello', '1.00', 0, '', '', '0.00', '2017-03-22', '', '', '', '', '', '0.00', '', '2017-03-23 16:11:45', '2017-03-23 16:11:45'),
(27, 'wefrere', '', 'CN10009', 'Chair', 'Finance', 'bwegergb', '', 'werbef', 'Hello', '1.00', 0, '', '', '0.00', '2017-03-22', '', '', '', '', '', '0.00', '', '2017-03-23 16:12:40', '2017-03-23 16:12:40'),
(30, 'frfd', '', 'CN10009', 'Chair', 'Finance', 'bwegergb', '', 'werbef', 'Hello', '1.00', 0, '', '', '0.00', '2017-03-22', '', '', '', '', '', '0.00', '', '2017-03-23 16:13:32', '2017-03-23 16:13:32'),
(31, 'DM/FT/FN/031', '', 'CN10009', 'Chair', 'Finance', 'bwegergb', '', 'werbef', 'Hello', '1.00', 0, '', '', '0.00', '2017-03-22', '', '', '', '', '', '0.00', '', '2017-03-23 16:14:28', '2017-03-23 16:14:28'),
(32, 'DM/FT/TR/032', '', 'CN10009', 'Table', 'Treasury', 'General office', 'Office Stuff', 'Mr Tayo', 'Coffee Table ', '100.00', 0, '', '', '0.00', '2017-03-22', '', '', '', '', '', '0.00', '', '2017-03-24 08:32:37', '2017-03-24 08:32:37'),
(33, 'DM/FT/OB/033', '', 'CN10009', 'Cup', 'Operations', 'rfhtrth', 'Office Stuff', 'ertt', 'qefreg', '300.00', 0, '', '', '0.00', '2017-03-22', '', '', '', '', '', '0.00', '', '2017-03-24 11:05:11', '2017-03-24 11:05:11'),
(34, 'DM/FF/OB/034', 'DF1290348', 'CN10009', 'Chair', 'Operations', 'Office', 'Furniture & Fittings', 'Mr Akan', 'biriuhiudfoir', '10000.00', 1, 'No', 'None', '0.00', '2017-04-02', '', '', '', '', '', '0.00', '', '2017-04-02 09:03:10', '2017-04-02 09:03:10'),
(35, 'DM/FF/TN/035', 'Cjsl1030398', 'CN10009', 'Laptop', 'Technology', 'fffvfff', 'Furniture & Fittings', 'kjbcdjncndi', 'Hello', '190.00', 12, 'Yes', 'SLM', '0.00', '2017-04-01', '', '', 'AVAILABLE', '', '', '0.00', '', '2017-04-02 09:21:05', '2017-04-02 09:21:05'),
(36, 'DM/FF/OB/036', 'Cjsl1030398', 'CN10009', 'Laptop', 'Operations', 'MD''s office', 'Furniture & Fittings', 'Mr Tayo', 'Hello', '190.00', 12, 'No', 'STRAIGHT LINE METHOD', '190.00', '2017-04-01', 'APPROVED', 'Ice Prince', 'AVAILABLE', '2017-04-05', 'Cnooo11', '300.00', '3w4hsg4', '2017-04-07 17:01:12', '2017-04-02 09:23:59');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order_item` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `quantity` int(5) NOT NULL,
  `admin_approval` varchar(10) NOT NULL,
  `finance_approval` varchar(10) NOT NULL,
  `hod_approval` varchar(10) NOT NULL,
  `department` varchar(140) NOT NULL,
  `made_by` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `created_at` varchar(20) NOT NULL,
  `updated_at` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_item`, `description`, `quantity`, `admin_approval`, `finance_approval`, `hod_approval`, `department`, `made_by`, `comment`, `created_at`, `updated_at`) VALUES
(1, 'Projector', 'A projector to display information during company events.', 3, 'APPROVED', 'APPROVED', 'APPROVED', 'Software Development', '', '', '2016-09-15 07:48:22', '2016-09-20 09:25:41'),
(2, 'Chair', 'A plastic chair with lumbar support for visitors', 2, 'PENDING', 'APPROVED', 'APPROVED', '', '', '', '2016-09-15 07:48:22', '2016-09-26 16:24:21'),
(4, 'Laptop', 'A core i5 or higher laptop for software development', 3, 'APPROVED', 'APPROVED', 'APPROVED', 'Software Development', '', '', '2016-09-20 14:32:59', '2016-09-20 14:34:28'),
(8, 'A Television', 'A TV to entertain guests in the reception', 1, 'PENDING', 'APPROVED', 'APPROVED', 'Human Capital', 'Tester Person', '', '2016-09-28 15:06:04', '2016-10-04 16:22:11'),
(9, 'Ak 47', 'Something you can use to take someone down during a drive by.', 1, 'PENDING', 'PENDING', 'PENDING', 'Technology', 'Tayo', '', '2016-10-13 13:56:50', '2016-10-13 13:56:50'),
(55, 'Television', 'For Entertainment', 1, 'PENDING', 'PENDING', 'PENDING', 'Technology', 'Eko Adetolani', '', '2016-11-14 11:00:15', '2016-11-14 11:00:15'),
(56, 'Chair', '', 1, 'PENDING', 'PENDING', 'PENDING', 'Operations', 'Toks', '', '2017-01-09 13:38:33', '2017-01-09 13:38:33'),
(57, 'Ak 47', 'Something you can use to take someone down during a drive by.', 1, 'PENDING', 'PENDING', 'PENDING', 'Operations', 'Toks', '', '2017-01-09 13:47:30', '2017-01-09 13:47:30');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `staffid` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `department` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `account_activated` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `staffid`, `name`, `email`, `password`, `department`, `role_id`, `account_activated`, `remember_token`, `created_at`, `updated_at`, `last_login`) VALUES
(1, 'DM000', 'Admin', 'a.eko@dreammesh.ng', '$2y$10$NXSnIpKTun4KyjbM4C9sXe62HmWUcf6vCaUWSGmkCfUY6S5NHL1vC', 'General', 'ADMIN', 'YES', '6jBda00xiY824h9XfejylOPac2S687kxQ4WJ09fjXhuceNTg62GDthAviO3i', '2016-09-19 08:47:25', '2017-01-11 10:30:44', '2017-01-11 10:22:25'),
(14, '', 'Eko Adetolani', 'Eko@dream-mesh.ng', '$2y$10$gf8VvbKmb2u370RY9Teye.UkFEjooKOvjxxHeCEYGuOk5v1DVGvZ6', 'Technology', 'ADMIN', 'YES', 'jCCRrINtcjI9QnxhGVl5gGzr2erebzywargjgBHRti6tQjIZmikfeNodV4hQ', '2016-09-27 10:58:54', '2016-10-04 14:31:25', '0000-00-00 00:00:00'),
(15, '', 'Tolu', 'Tolu@dreammesh.ng', '$2y$10$KRqRzlfjIF20cRLAAeI/Texoo.O36rB/mJcnYI610kU7MiunfEU9i', 'Technology', 'ADMIN', 'YES', 'E3SEp628mm9CPqXxwcmXb8vpcack9BwF8omoKGxElATVSlQB3nL77joqyXO6', '2016-09-27 14:16:36', '2016-10-04 12:50:47', '0000-00-00 00:00:00'),
(16, '', 'Tester Person', 'tester@dreammesh.ng', '$2y$10$dBZS9FN4u.PQbQ/SdFEqoeVYZiazVrBb9hq0ocgsCx/1R.biSawMa', 'Human Capital', 'BASIC', 'YES', 'VHZiIFm86Hy3JCOQUg5TmXvYeTqYH9I1HN2pj5WEc13zNubtlZlduPagboPN', '2016-09-28 10:04:14', '2016-10-05 09:25:47', '0000-00-00 00:00:00'),
(17, 'DM017', 'uche', 'uche@dreammesh.ng', '$2y$10$wvj20E/xh86uVLQpQI7BZ.AB03Wj.R./ry8Zb7YW56GFlXAaPmZg.', 'Treasury', 'BASIC', 'YES', 'qsb1fWZsW7hfCDP7gqBhG1Q6tSRWcspqZZKDvQUp0JuumPJ7durWa4GeBazW', '2016-09-29 07:04:10', '2016-12-20 11:33:52', '2016-12-20 11:28:31'),
(18, 'DM001', 'Eko Adetolani', 'a.eko@dreammesh.ngr', '$2y$10$db0S6wF1FQpIvb.2eTjSLuxxyLznC3a.mU40xARXk1AgCJ/TT1gzm', 'Operations', 'HOD', 'YES', 'gdaNxBxDhKiVgetIBygX1nknBePd2fVfpSclcGOaAedGHmL4jevZYCqTcgJQ', '2016-10-05 09:47:41', '2017-04-03 15:26:36', '2017-04-03 13:30:14'),
(19, 'DM002', 'Ice Prince', 'bjbjji@dreammesh.ng', '$2y$10$pT4n33vckKT5pd3FJ2shAuyMqlKUjMSSJIGrr0kC6G.IxSCL1z4re', 'Finance', 'HOF', 'YES', 'bbPglSlkmWOKyODhdRUWEXcTsAXUpEcIys8xBpaJK8T42kIrN4hZzIGdg5p2', '2016-10-05 10:09:10', '2017-04-12 07:34:41', '2017-04-12 07:34:41'),
(20, 'DM003', 'Donald Trumpp', 'donaldtrump@dreammesh.ng', '$2y$10$8lLF72tz0VD8ZZWl3jURdO4TzuEbP82D.0L1vSISHkFNMk2IdY6oS', 'Operations', 'ADMIN', 'YES', 'ycF6EWm8WkUbiDtStA5ppbeZYvS6AWptocKtJviOz6KFqFOIDOojjkFney6s', '2016-10-05 10:26:14', '2017-04-07 11:48:23', '2017-04-07 06:17:55'),
(21, 'DM0009', 'Toks', 'Toks@dreammesh.ng', '$2y$10$FxoKeiUjezV4CcwHGuX0qer8z8AOrTNtI/BW0iTrdURlsPGPwKDqi', 'Operations', 'BASIC', 'YES', 'RQ8j1ttEaWHkJ3VDwMwBSRCs2io84ngsUGeJso8lVW7BLtVBaAcJfUTxmO2w', '2016-10-06 12:20:50', '2017-01-09 09:39:20', '2017-01-09 09:39:20'),
(22, 'D9897', 'Tayo', 'Tayo@dreammesh.ng', '$2y$10$5ijqGY1pz67shqcpk5wEi.6M6qe6tAXFbfURmli0N.ZKfhFAN9jE.', 'Technology', 'BASIC', 'YES', 'NJ6jfU959ZXCViXRKPv0rErdOJGcBZEkBJysTWchGQB5pUkXJIPqsQBypoDp', '2016-10-07 08:39:30', '2017-01-06 12:21:59', '2017-01-06 12:21:59'),
(51, 'hyuigudw', 'Kola', 'a.eko@dreammesh.ngwr', '$2y$10$n15uN225As6s2n8lWk6G.u1BAmUOIrOV.lq.W5cjvTAHpPa6CgxxW', 'Operations', 'ADMIN', 'NO', NULL, '2017-01-06 12:18:58', '2017-01-06 12:18:58', NULL),
(58, 'D000', 'Eko', 'adetolanieko@gmail.com', '$2y$10$mfkDi61H9FOAYF88livrle32PRbqpfPDV5CC2.2WzZV/cWe0XZcdW', 'Operations', 'ADMIN', 'NO', NULL, '2017-01-09 14:39:52', '2017-01-09 14:39:52', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

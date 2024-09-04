-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2024 at 07:03 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_commerce_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Thời điểm tạo',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Thời điểm cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cart_id`, `customer_id`, `status`, `created_at`, `updated_at`) VALUES
(12, 21, 1, '2024-03-11 09:36:47', '2024-03-11 09:36:47'),
(13, 22, 1, '2024-03-11 09:36:47', '2024-03-11 09:36:47'),
(14, 23, 1, '2024-03-11 09:36:47', '2024-03-11 09:36:47'),
(15, 24, 1, '2024-03-11 09:36:47', '2024-03-11 09:36:47'),
(16, 25, 1, '2024-03-11 09:36:47', '2024-03-11 09:36:47'),
(17, 26, 1, '2024-03-11 09:36:47', '2024-03-11 09:36:47'),
(18, 27, 1, '2024-03-11 09:36:47', '2024-03-11 09:36:47'),
(19, 28, 1, '2024-03-11 09:36:47', '2024-03-11 09:36:47'),
(20, 29, 1, '2024-03-11 09:36:47', '2024-03-11 09:36:47'),
(21, 30, 1, '2024-03-11 09:36:47', '2024-03-11 09:36:47'),
(24, 56, 1, '2024-04-22 08:03:22', '2024-04-22 08:03:22'),
(25, 57, 1, '2024-05-07 03:21:31', '2024-05-07 03:21:31'),
(27, 58, 1, '2024-05-07 09:39:08', '2024-05-07 09:39:08'),
(28, 59, 1, '2024-08-29 03:02:49', '2024-08-29 03:02:49');

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `cart_detail_id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Thời điểm tạo',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Thời điểm cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_details`
--

INSERT INTO `cart_details` (`cart_detail_id`, `cart_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(20, 17, 4, 1, '2024-03-13 10:41:16', '2024-03-13 10:41:16'),
(21, 17, 6, 1, '2024-03-13 10:50:24', '2024-03-13 10:50:24'),
(50, 24, 10, 1, '2024-04-22 08:20:46', '2024-04-22 08:20:46'),
(77, 25, 10, 1, '2024-05-07 03:23:21', '2024-05-07 03:23:21'),
(78, 25, 14, 2, '2024-05-07 03:23:36', '2024-05-07 03:23:36'),
(79, 24, 12, 2, '2024-05-07 03:39:35', '2024-05-07 03:39:35'),
(80, 24, 20, 1, '2024-05-07 08:39:01', '2024-05-07 08:39:01'),
(81, 24, 14, 2, '2024-05-07 08:39:08', '2024-05-07 08:39:08'),
(86, 27, 21, 3, '2024-05-09 09:14:53', '2024-05-09 09:14:53'),
(87, 27, 20, 4, '2024-05-09 09:14:55', '2024-05-09 09:14:55'),
(88, 27, 11, 3, '2024-05-09 09:16:54', '2024-05-09 09:16:54');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Thời điểm tạo',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Thời điểm cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `category_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Iphone', 1, '2024-03-09 14:40:16', '2024-03-09 14:40:16'),
(2, 'Huawei', 1, '2024-03-09 14:40:35', '2024-03-09 14:40:35'),
(3, 'Samsung', 1, '2024-03-09 14:40:45', '2024-03-09 14:40:45'),
(4, 'Xiaomi', 1, '2024-03-09 14:40:54', '2024-03-09 14:40:54'),
(5, 'Oppo', 1, '2024-03-09 14:41:01', '2024-03-09 14:41:01'),
(6, 'Realmi', 1, '2024-03-09 14:41:11', '2024-03-09 14:41:11'),
(7, 'Vivo', 1, '2024-03-09 14:41:20', '2024-03-09 14:41:20'),
(25, 'dmeo', 0, '2024-08-18 04:23:56', '2024-08-18 04:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `customer_id`, `status`, `created_at`, `updated_at`) VALUES
(19, NULL, 0, '2024-05-06 15:11:43', '2024-05-06 15:11:43'),
(27, 56, 0, '2024-05-06 15:54:47', '2024-05-06 15:54:47'),
(30, 57, 0, '2024-05-07 03:22:20', '2024-05-07 03:22:20'),
(32, 58, 0, '2024-05-07 09:39:42', '2024-05-07 09:39:42'),
(33, NULL, 0, '2024-05-09 09:17:02', '2024-05-09 09:17:02'),
(34, NULL, 0, '2024-08-20 02:58:47', '2024-08-20 02:58:47'),
(35, 59, 0, '2024-08-29 06:40:02', '2024-08-29 06:40:02');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birthday` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `customer_points` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Thời điểm tạo',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Thời điểm cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `email`, `password`, `birthday`, `address`, `phone`, `customer_points`, `status`, `created_at`, `updated_at`) VALUES
(21, 'Miss Thalia Prosacco', 'jbradtke@example.org', '$2y$12$lQiLwamyZP0EbdBn3BtR0ub.INJoofeBkpFEqyX/J8wH2gzucFqB6', '2003-12-27', '488 Ernesto Forks Suite 942\nDixietown, FL 37568', '229.914.1209', 0, 0, '2024-03-11 09:36:05', '2024-03-11 09:36:05'),
(22, 'Nathanial Bins', 'jack.lubowitz@example.org', '$2y$12$YmsovUdrTEaw6ILEy5cd0utdWmwCZ5.5ldSgjFP1fTETei7MX.AI.', '1974-08-20', '517 Celestine Centers\nPort Salvatore, NJ 77211', '+1-279-940-7519', 0, 0, '2024-03-11 09:36:05', '2024-03-11 09:36:05'),
(23, 'Prof. Keagan Jerde', 'estrella.hodkiewicz@example.org', '$2y$12$xpnSOekiSRoiA4R/UFlsYec5oF/G.O5y4wxm8VZwVFTWILYYF5cu.', '2006-12-10', '7050 Yesenia Branch Suite 363\nPort Leo, DE 58605-5413', '(917) 568-1354', 0, 0, '2024-03-11 09:36:06', '2024-03-11 09:36:06'),
(24, 'Ms. Katrina Roberts', 'rosemary59@example.org', '$2y$12$boUfWz.bq0vsOc4El5KNB.T9YbtqBPVSIxGku/ikZQztxffspIFUm', '1992-06-14', '9319 Littel Station\nPort Percival, VT 49275-0332', '740.576.5045', 0, 0, '2024-03-11 09:36:06', '2024-03-11 09:36:06'),
(25, 'Aurelia Berge', 'berge.virginia@example.com', '$2y$12$t4ejxKCfvtoICxsZTAk4/eOXqROIYAbnsk6kNEjUsB.wKM.f3HlmG', '2015-11-11', '91164 Oberbrunner Parkways\nEast Abdullah, AL 98847-9991', '818-381-1987', 0, 0, '2024-03-11 09:36:06', '2024-03-11 09:36:06'),
(26, 'Julie West', 'udamore@example.com', '$2y$12$lQJ7g/TW5Cbp9vFYGaVjQurgHPQDWe8pfkrzDW0ve4JGxusk4175u', '1998-01-03', '58228 Jaiden Place Apt. 177\nPort Bertville, FL 76666-1428', '+1 (870) 432-4190', 0, 1, '2024-03-11 09:36:07', '2024-03-11 09:36:07'),
(27, 'Dr. Bryana Medhurst', 'bulah47@example.org', '$2y$12$p22Mh7Zsw300tWUNX7qmbOo7cTZYvY90AcFSQJr/06bs2l25fi0Rq', '1984-03-05', '483 Dare Port\nMedhurstburgh, IA 84099-1647', '+1-979-452-7321', 0, 1, '2024-03-11 09:36:07', '2024-03-11 09:36:07'),
(28, 'Emmitt Lind', 'einar.emard@example.net', '$2y$12$j9Uk5RWfTmE6OAWZmL4nJ.tNFznMF2k3erJncN./aDt3RpD.JipAu', '2004-12-25', '53797 Toy Lights Apt. 176\nAlejandrinside, VT 36633-6235', '+12342434002', 0, 1, '2024-03-11 09:36:08', '2024-03-11 09:36:08'),
(29, 'Ricardo Luettgen', 'metz.johnson@example.org', '$2y$12$/jrDtETCCXV78DKzqkT./uG/4Lle7FL/X6O/fz90wyjZtlHhe6Sva', '1987-04-14', '39683 Dagmar Stravenue\nNew Damionfort, OH 31316-3281', '928.281.6641', 0, 1, '2024-03-11 09:36:08', '2024-03-11 09:36:08'),
(30, 'Melany Nolan MD', 'wolff.doyle@example.net', '$2y$12$p2VJRdLkGczNfaWu90lGT.EQmkiHCtlhB6eoJ9/2V3hLWHadNBM6C', '1987-05-28', '185 Veronica Land\nEast Malcolmshire, UT 64096-2139', '1-445-607-3874', 0, 1, '2024-03-11 09:36:09', '2024-03-11 09:36:09'),
(56, 'Nguyễn Văn An', 'annv@gmail.com', '$2y$10$moyo4yzP3KtNilPaADV2FeM7EKe3n/O/wS7MQvPx92VQp04hhMWDW', '2024-04-04', 'Disney, Australia', '0739485930', 0, 1, '2024-04-22 08:03:22', '2024-04-22 08:30:53'),
(57, 'Nguyễn Văn Teò', 'teonv@gmail.com', '$2y$10$fmsQyz5lxXLI1vzHBztfxeLd7PfXo9K8Af4BKkS4gTxC4kfEjOiSC', NULL, NULL, NULL, 0, 1, '2024-05-07 03:21:31', '2024-05-07 03:21:31'),
(58, 'Tuan pham ', 'tuan@gmail.com', '$2y$10$MvytQ0LQcPSS95BHww54uOdiM8XxJz1xavHtrXLLe/hAV8akTtC6e', NULL, NULL, NULL, 0, 1, '2024-05-07 09:39:08', '2024-05-07 09:39:08'),
(59, 'Vũ Đức Tiến', 'vuductien@gmail.com', '$2y$10$JfgnCNEh49tb8pR1XVcHu.fhDWXC2jOi5PYYXwfdTzQ1dukt1BwY.', NULL, NULL, NULL, 0, 1, '2024-08-29 03:02:49', '2024-08-29 03:02:49');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) NOT NULL,
  `cvs_id` bigint(20) UNSIGNED NOT NULL,
  `content` longtext DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `sender_type` varchar(15) NOT NULL DEFAULT 'customer',
  `receiver_type` varchar(15) NOT NULL DEFAULT 'admin',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `cvs_id`, `content`, `status`, `sender_type`, `receiver_type`, `created_at`, `updated_at`) VALUES
(21, 19, 'xin chào', 1, 'customer', 'admin', '2024-05-06 15:11:57', '2024-05-06 15:11:57'),
(22, 19, 'Hi! how can i help you', 1, 'admin', 'customer', '2024-05-06 15:11:57', '2024-05-06 15:11:57'),
(23, 19, 'Chào bạn chúng tôi có thể giúp gì cho bạn?', 1, 'admin', 'customer', '2024-05-06 15:14:02', '2024-05-06 15:14:02'),
(24, 19, '- Fill \"shop\" to get into shop page.      - Fill \"cart\" to get into cart page.     - Fill \"blog\" to get into cart blog.     - Fill \"contact\" to get into contact page..                                                     - Fill \"products\" to see a best product.', 1, 'admin', 'customer', '2024-05-06 15:14:27', '2024-05-06 15:14:27'),
(25, 19, 'help', 1, 'customer', 'admin', '2024-05-06 15:14:27', '2024-05-06 15:14:27'),
(26, 19, 'sản phẩm bán chạy', 1, 'customer', 'admin', '2024-05-06 15:17:55', '2024-05-06 15:17:55'),
(27, 19, 'sản', 1, 'admin', 'customer', '2024-05-06 15:17:55', '2024-05-06 15:17:55'),
(28, 19, 'help', 1, 'customer', 'admin', '2024-05-06 15:18:17', '2024-05-06 15:18:17'),
(29, 19, '- Fill \"shop\" to get into shop page.      - Fill \"cart\" to get into cart page.     - Fill \"blog\" to get into cart blog.     - Fill \"contact\" to get into contact page..                                                     - Fill \"products\" to see a best product.', 1, 'admin', 'customer', '2024-05-06 15:18:17', '2024-05-06 15:18:17'),
(30, 19, 'products', 1, 'customer', 'admin', '2024-05-06 15:18:23', '2024-05-06 15:18:23'),
(31, 19, 'IPhone 15 Promax, IP 14 Promax, IP 15 500GB', 1, 'admin', 'customer', '2024-05-06 15:18:23', '2024-05-06 15:18:23'),
(32, 19, 'shop', 1, 'customer', 'admin', '2024-05-06 15:25:28', '2024-05-06 15:25:28'),
(33, 19, 'use this url  \"http://localhost/phone-ecommerce-chat/customer/shop\" to access to shop page', 1, 'admin', 'customer', '2024-05-06 15:25:29', '2024-05-06 15:25:29'),
(38, 27, 'xin chào', 1, 'customer', 'admin', '2024-05-07 02:44:33', '2024-05-07 02:44:33'),
(39, 27, 'Hi! how can i help you', 1, 'admin', 'customer', '2024-05-07 02:44:33', '2024-05-07 02:44:33'),
(40, 27, 'help', 1, 'customer', 'admin', '2024-05-07 02:45:22', '2024-05-07 02:45:22'),
(41, 27, '- Fill \"shop\" to get into shop page.      - Fill \"cart\" to get into cart page.     - Fill \"blog\" to get into cart blog.     - Fill \"contact\" to get into contact page..                                                     - Fill \"products\" to see a best product.', 1, 'admin', 'customer', '2024-05-07 02:45:23', '2024-05-07 02:45:23'),
(42, 27, 'products', 1, 'customer', 'admin', '2024-05-07 02:45:42', '2024-05-07 02:45:42'),
(43, 27, 'IPhone 15 Promax, IP 14 Promax, IP 15 500GB', 1, 'admin', 'customer', '2024-05-07 02:45:42', '2024-05-07 02:45:42'),
(44, 27, 'can tro giup', 1, 'customer', 'admin', '2024-05-07 02:46:33', '2024-05-07 02:46:33'),
(45, 27, 'Chào bạn bạn có thể cung cấp sđt và địa chỉ được không?', 1, 'admin', 'customer', '2024-05-07 02:48:33', '2024-05-07 02:48:33'),
(46, 27, 'sđt: 0706802119, địa chỉ: sài gòn quận nhất', 1, 'customer', 'admin', '2024-05-07 02:49:19', '2024-05-07 02:49:19'),
(47, 27, ': sài gòn quận nhất', 1, 'admin', 'customer', '2024-05-07 02:49:20', '2024-05-07 02:49:20'),
(48, 27, 'Cám ơn bạn đã cung cấp thông tin', 1, 'admin', 'customer', '2024-05-07 02:50:00', '2024-05-07 02:50:00'),
(49, 27, 'Chúng tôi sẽ liên hệ trong thời gian sớm nhất', 1, 'admin', 'customer', '2024-05-07 02:52:02', '2024-05-07 02:52:02'),
(50, 27, 'oke nào liên hệ gọi lại tôi', 1, 'customer', 'admin', '2024-05-07 02:52:20', '2024-05-07 02:52:20'),
(51, 19, 'xin chào', 1, 'customer', 'admin', '2024-05-07 02:54:19', '2024-05-07 02:54:19'),
(52, 19, 'Hi! how can i help you', 1, 'admin', 'customer', '2024-05-07 02:54:19', '2024-05-07 02:54:19'),
(53, 19, 'cần trợ giúp chính sách bảo hành', 1, 'customer', 'admin', '2024-05-07 02:54:28', '2024-05-07 02:54:28'),
(54, 19, 'cần trợ', 1, 'admin', 'customer', '2024-05-07 02:54:28', '2024-05-07 02:54:28'),
(58, 19, 'chính sách bảo hành?', 1, 'customer', 'admin', '2024-05-07 03:00:38', '2024-05-07 03:00:38'),
(60, 19, 'chính sách bảo hành?', 1, 'customer', 'admin', '2024-05-07 03:05:46', '2024-05-07 03:05:46'),
(61, 19, 'Xin lỗi, Tôi không hiểu bạn cần gì, Tôi sẽ chuyển tin nhắn của bạn đến cho Quản trị viên,vui lòng trở lại trang web sau khoảng 1h để nhận thông báo mới, Bạn có thể nhập trợ giúp để tìm hiểu các lệnh', 1, 'admin', 'customer', '2024-05-07 03:05:47', '2024-05-07 03:05:47'),
(62, 27, 'Chào bạn chúng tôi đã liên hệ lại cho bạn', 1, 'admin', 'customer', '2024-05-07 03:07:36', '2024-05-07 03:07:36'),
(73, 30, 'xin chào', 1, 'customer', 'admin', '2024-05-07 03:36:56', '2024-05-07 03:36:56'),
(74, 30, 'Hi! how can i help you', 1, 'admin', 'customer', '2024-05-07 03:36:56', '2024-05-07 03:36:56'),
(75, 30, 'bạn có thể giúp gì cho tôi?', 1, 'customer', 'admin', '2024-05-07 03:37:12', '2024-05-07 03:37:12'),
(76, 30, 'bạn có', 1, 'admin', 'customer', '2024-05-07 03:37:12', '2024-05-07 03:37:12'),
(77, 30, 'Chào bạn bạn cần giúp gì', 1, 'admin', 'customer', '2024-05-07 03:37:33', '2024-05-07 03:37:33'),
(78, 30, 'tui cần hỗ trợ trong việc mua hàng', 1, 'customer', 'admin', '2024-05-07 03:37:47', '2024-05-07 03:37:47'),
(79, 30, 'tui', 1, 'admin', 'customer', '2024-05-07 03:37:47', '2024-05-07 03:37:47'),
(80, 30, 'Bạn muốn mua những sản phẩm nào', 1, 'admin', 'customer', '2024-05-07 03:38:07', '2024-05-07 03:38:07'),
(81, 19, 'có trả lời chưa bạn?', 1, 'customer', 'admin', '2024-05-07 03:38:32', '2024-05-07 03:38:32'),
(82, 19, 'có', 1, 'admin', 'customer', '2024-05-07 03:38:32', '2024-05-07 03:38:32'),
(83, 19, 'Chào bạn mình là người bên shop để tiến hành hỗ trợ bạn!', 1, 'admin', 'customer', '2024-05-07 03:38:55', '2024-05-07 03:38:55'),
(84, 27, 'tui cần hỗ trợ mua sản phẩm bạn ơi!!!', 1, 'customer', 'admin', '2024-05-07 03:39:18', '2024-05-07 03:39:18'),
(97, 32, 'xin chaof', 1, 'customer', 'admin', '2024-05-07 09:40:03', '2024-05-07 09:40:03'),
(98, 32, 'Hi! how can i help you', 1, 'admin', 'customer', '2024-05-07 09:40:03', '2024-05-07 09:40:03'),
(99, 32, 'ban can giup gi', 1, 'admin', 'customer', '2024-05-07 09:40:26', '2024-05-07 09:40:26'),
(100, 32, 'tui can mua san pham tu cua hang cua ban', 1, 'customer', 'admin', '2024-05-07 09:41:09', '2024-05-07 09:41:09'),
(102, 32, 'bạn muốn sản phẩm như thế nào ạ?', 1, 'admin', 'customer', '2024-05-09 09:11:33', '2024-05-09 09:11:33'),
(103, 32, 'tôi muốn mua iphone', 1, 'customer', 'admin', '2024-05-09 09:17:18', '2024-05-09 09:17:18'),
(105, 32, 'Iphone bên em có \"Iphone 15 Promax\" , \"Iphone 14 Promax\"', 1, 'admin', 'customer', '2024-05-09 09:18:05', '2024-05-09 09:18:05'),
(106, 32, 'tôi muốn mua iphone 15', 1, 'customer', 'admin', '2024-05-09 09:19:04', '2024-05-09 09:19:04'),
(108, 33, 'xin chào', 1, 'customer', 'admin', '2024-05-09 09:20:12', '2024-05-09 09:20:12'),
(109, 33, 'Hi! how can i help you', 1, 'admin', 'customer', '2024-05-09 09:20:13', '2024-05-09 09:20:13'),
(110, 33, 'wdd', 1, 'admin', 'customer', '2024-08-18 04:18:47', '2024-08-18 04:18:47'),
(111, 34, 'xin chào', 1, 'customer', 'admin', '2024-08-20 02:58:57', '2024-08-20 02:58:57'),
(112, 34, 'Xin chào, em có thể giúp được gì cho anh/chị ạ?', 1, 'admin', 'customer', '2024-08-20 02:58:57', '2024-08-20 02:58:57');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `promotion_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name_receiver` varchar(255) NOT NULL,
  `phone_receiver` varchar(255) NOT NULL,
  `address_receiver` mediumtext NOT NULL,
  `notes` mediumtext DEFAULT NULL,
  `total_price` double NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'đang chờ',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Thời điểm tạo',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Thời điểm cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `promotion_id`, `name_receiver`, `phone_receiver`, `address_receiver`, `notes`, `total_price`, `status`, `created_at`, `updated_at`) VALUES
(51, 59, NULL, 'Vũ Đức Tiến', '0333669832', 'TP HCM', 'Giao nhanh', 30750000, 'đã giao', '2024-09-04 03:54:22', '2024-09-04 03:54:22');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_detail_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Thời điểm tạo',
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Thời điểm cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_detail_id`, `order_id`, `product_id`, `quantity`, `price`, `create_at`, `update_at`) VALUES
(27, 51, 21, 3, 10250000, '2024-09-04 03:54:22', '2024-09-04 03:54:22');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Thời điểm tạo',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Thời điểm cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `cat_id`, `product_name`, `price`, `quantity`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Iphone 12', 12000000, 1378, 'Trong những tháng cuối năm 2020, Apple đã chính thức giới thiệu đến người dùng cũng như iFan thế hệ iPhone 12 series mới với hàng loạt tính năng bứt phá, thiết kế được lột xác hoàn toàn, hiệu năng đầy mạnh mẽ và một trong số đó chính là iPhone 12 64GB.\r\nHiệu năng vượt xa mọi giới hạn\r\nApple đã trang bị con chip mới nhất của hãng (tính đến 11/2020) cho iPhone 12 đó là A14 Bionic, được sản xuất trên tiến trình 5 nm với hiệu suất ổn định hơn so với chip A13 được trang bị trên phiên bản tiền nhiệm iPhone 11.Với CPU Apple A14 Bionic, bạn có thể dễ dàng trải nghiệm mọi tựa game với những pha chuyển cảnh mượt mà hay hàng loạt hiệu ứng đồ họa tuyệt đẹp ở mức đồ họa cao mà không lo tình trạng giật lag.Chưa hết, Apple còn gây bất ngờ đến người dùng với hệ thống 5G lần đầu tiên được trang bị trên những chiếc iPhone, cho tốc độ truyền tải dữ liệu nhanh hơn, ổn định hơn.iPhone 12 sẽ chạy trên hệ điều hành iOS 15 (12/2021) với nhiều tính năng hấp dẫn như hỗ trợ Widget cũng như những nâng cấp tối ưu phần mềm đáng kể mang lại những trải nghiệm thú vị mới lạ đến người dùng.Cụm camera không ngừng cải tiến\r\niPhone 12 được trang bị hệ thống camera kép bao gồm camera góc rộng và camera siêu rộng có cùng độ phân giải là 12 MP, chế độ ban đêm (Night Mode) trên bộ đôi camera này cũng đã được nâng cấp về phần cứng lẫn thuật toán xử lý, khi chụp những bức ảnh thiếu sáng bạn sẽ nhận được kết quả ấn tượng với màu sắc, độ chi tiết rõ nét đáng kinh ngạc.', 'product_images/ZKLtSNvkCzGAl64K9Jt3Ew1y2gR429bDyEAFM3wJ.jpg', 1, '2024-03-09 14:43:29', '2024-03-09 14:43:29'),
(2, 1, 'Iphone 13', 15000000, 1235, 'Trong khi sức hút đến từ bộ 4 phiên bản iPhone 12 vẫn chưa nguội đi, thì hãng điện thoại Apple đã mang đến cho người dùng một siêu phẩm mới iPhone 13 với nhiều cải tiến thú vị sẽ mang lại những trải nghiệm hấp dẫn nhất cho người dùng.\r\nHiệu năng vượt trội nhờ chip Apple A15 Bionic\r\nCon chip Apple A15 Bionic siêu mạnh được sản xuất trên quy trình 5 nm giúp iPhone 13 đạt hiệu năng ấn tượng, với CPU nhanh hơn 50%, GPU nhanh hơn 30% so với các đối thủ trong cùng phân khúc.Nhờ hiệu năng được cải tiến, người dùng có được những trải nghiệm tốt hơn trên điện thoại khi dùng các ứng dụng chỉnh sửa ảnh hay chiến các tựa game đồ họa cao mượt mà.iPhone 13 trang bị bộ nhớ trong 128 GB dung lượng lý tưởng cho phép bạn thỏa thích lưu trữ mọi nội dung theo ý muốn mà không lo nhanh đầy bộ nhớ.Tốc độ 5G tốt hơn \r\nMạng 5G được cải thiện chất lượng với nhiều băng tần hơn, với 5G giúp điện thoại xem trực tuyến hay tải xuống các ứng dụng và tài liệu đều đạt tốc độ nhanh chóng. Không chỉ vậy, siêu phẩm mới này còn có chế độ dữ liệu thông minh, tự động phát hiện và giảm tải tốc độ mạng để tiết kiệm năng lượng khi không cần dùng tốc độ cao.', 'product_images/aMsPz4XdS3vpotucgNrCN2mMUNb4n0X6awzLQB15.jpg', 1, '2024-03-09 14:44:38', '2024-03-09 14:44:38'),
(3, 1, 'Iphone 14 Promax 128GB', 27300000, 123, 'Thông tin sản phẩm\r\niPhone 14 Pro Max một siêu phẩm trong giới smartphone được nhà Táo tung ra thị trường vào tháng 09/2022. Máy trang bị con chip Apple A16 Bionic vô cùng mạnh mẽ, đi kèm theo đó là thiết kế màn hình mới, hứa hẹn mang lại những trải nghiệm đầy mới mẻ cho người dùng iPhone.\r\nThiết kế cao cấp bền bỉ\r\niPhone năm nay sẽ được thừa hưởng nét đặc trưng từ người anh iPhone 13 Pro Max, vẫn sẽ là khung thép không gỉ và mặt lưng kính cường lực kết hợp với tạo hình vuông vức hiện đại thông qua cách tạo hình phẳng ở các cạnh và phần mặt lưng.Nổi bật với thiết kế màn hình mới\r\nĐiểm ấn tượng nhất trên điện thoại iPhone năm nay nằm ở thiết kế màn hình, có thể dễ dàng nhận thấy được là hãng cũng đã loại bỏ cụm tai thỏ truyền thống qua bao đời iPhone bằng một hình dáng mới vô cùng lạ mắt.So với cụm tai thỏ hình notch năm nay đã có phần tiết kiệm diện tích tương đối tốt, nhưng khi so với các kiểu màn hình dạng “nốt ruồi” thì đây vẫn chưa thực sự là một điều quá tối ưu cho phần màn hình. Thế nhưng Apple lại rất biết cách tận dụng những nhược điểm để biến chúng trở thành ưu điểm một cách ngoạn mục bằng cách phát minh nhiều hiệu ứng thú vị.Để làm cho chúng trở nên bắt mắt hơn Apple cũng đã giới thiệu nhiều hiệu ứng chuyển động nhằm làm tăng sự thích thú cho người dùng, điều này được kích hoạt trong lúc mình ấn giữ phần hình notch khi đang dùng các phần mềm hỗ trợ như: Nghe nhạc, đồng hồ hẹn giờ, ghi âm,...', 'product_images/QNDgIHUWLR7RgvLmxk7KFyGnfjpooo0HSwXvZEh5.jpg', 1, '2024-03-09 14:45:55', '2024-03-09 14:45:55'),
(4, 1, 'iPhone 15 Pro Max 1TB', 44000000, 50, 'Trong thế giới công nghệ ngày càng phát triển, iPhone 15 Pro Max 1 TB nổi bật như một điện thoại thông minh hoàn hảo, kết hợp sự mạnh mẽ của công nghệ và sự sáng tạo không giới hạn. Chiếc điện thoại này không chỉ đem lại hiệu năng vượt trội mà còn mang đến khả năng chụp ảnh xuất sắc, tạo nên một trải nghiệm hoàn hảo cho người dùng.\r\nDiện mạo sang trọng, cứng cáp\r\niPhone 15 Pro Max 1 TB vẫn duy trì thiết kế vuông vắn và đẳng cấp đã làm nên tên tuổi của dòng sản phẩm này. Việc giữ nguyên dáng vẻ truyền thống không chỉ thể hiện sự sang trọng, thanh lịch mà còn giúp người dùng nhận ra ngay lập tức rằng đây là một chiếc iPhone.\r\n \r\nLà một sự thay đổi quan trọng, iPhone 15 Pro Max 1 TB đã từ bỏ chất liệu khung thép không gỉ quen thuộc để chuyển sang sử dụng khung Titanium. Điều này không chỉ làm cho chiếc điện thoại trở nên cứng cáp hơn mà còn giúp giảm khối lượng tổng thể, mang lại sự thoải mái hơn khi sử dụng trong thời gian dài.Mặt lưng của iPhone 15 Pro Max 1 TB được làm từ kính cường lực cao cấp và chế tạo theo kiểu nhám, tạo nên một vẻ đẹp độc đáo và tạo điểm nhấn cho thiết kế tổng thể. Đồng thời, vật liệu này cũng làm cho chiếc điện thoại trở nên kháng trầy xước và hạn chế bám vân tay tốt hơn.\r\n\r\nDynamic Island là một tính năng độc đáo trên iPhone 15 Pro Max 1 TB. Đây là tính năng hoạt động trên phần hình notch dạng viên thuốc của màn hình, cho phép người dùng truy cập nhanh các ứng dụng và chức năng thông qua các biểu tượng động. Điều này giúp tối ưu hóa sự tiện lợi và tăng hiệu suất của người dùng.', 'product_images/HJeLayOJAEwUOhTMpdMUx5ByJxrKA5nqVTSiiPVi.jpg', 1, '2024-03-09 14:46:59', '2024-03-09 14:46:59'),
(5, 1, 'iPhone 13 Pro Max 128GB', 17999000, 100, 'Thông tin sản phẩm\r\nTrong khi sức hút đến từ bộ 4 phiên bản iPhone 12 vẫn chưa nguội đi, thì hãng điện thoại Apple đã mang đến cho người dùng một siêu phẩm mới iPhone 13 với nhiều cải tiến thú vị sẽ mang lại những trải nghiệm hấp dẫn nhất cho người dùng.\r\nHiệu năng vượt trội nhờ chip Apple A15 Bionic\r\nCon chip Apple A15 Bionic siêu mạnh được sản xuất trên quy trình 5 nm giúp iPhone 13 đạt hiệu năng ấn tượng, với CPU nhanh hơn 50%, GPU nhanh hơn 30% so với các đối thủ trong cùng phân khúc.Tốc độ 5G tốt hơn \r\nMạng 5G được cải thiện chất lượng với nhiều băng tần hơn, với 5G giúp điện thoại xem trực tuyến hay tải xuống các ứng dụng và tài liệu đều đạt tốc độ nhanh chóng. Không chỉ vậy, siêu phẩm mới này còn có chế độ dữ liệu thông minh, tự động phát hiện và giảm tải tốc độ mạng để tiết kiệm năng lượng khi không cần dùng tốc độ cao.\r\nMàn hình Super Retina XDR độ sáng cao, tiết kiệm pin\r\niPhone 13 sử dụng tấm nền OLED với kích thước màn hình 6.1 inch cho chất lượng màu sắc và chi tiết hình ảnh sắc nét, sống động, độ phân giải đạt 1170 x 2532 Pixels.', 'product_images/UEB31MP5b7Fu1O923rCWYM0GuCMNvzYrplIrDBlX.jpg', 1, '2024-03-09 14:48:27', '2024-03-09 14:48:27'),
(6, 2, 'Huawei P30 blue', 18000000, 0, 'Huawei P30 là chiếc smartphone cao cấp vừa được Huawei giới thiệu với thiết kế tuyệt đẹp, hiệu năng mạnh mẽ và thiết lập camera ấn tượng.\r\nCamera siêu ấn tượng\r\nĐiện thoại dòng P của Huawei luôn cho ra mắt những công nghệ camera mới và P30 cũng không ngoại lệ.Huawei P30 có 3 camera trên mặt lưng bao gồm ống kính chính SuperSpectrum 40 MP, khẩu độ f / 1.8 + ống kính góc cực rộng 16 MP + ống kính tele 8 MP với khả năng zoom quang 3X và khẩu độ f / 2.4.SuperSpectrum là tên của Huawei cho bộ lọc màu RYYB, loại bỏ các yếu tố màu xanh lá cây khỏi bộ lọc RGGB và thay thế chúng bằng màu vàng.\r\nHuawei nói rằng việc chuyển từ màu xanh lục sang màu vàng sẽ giúp cảm biến hấp thụ nhiều ánh sáng hơn.Màu vàng cũng hấp thụ thêm ánh sáng xanh lá và đỏ, giúp cải thiện chất lượng hình ảnh trong bất cứ điều kiện nào, đặc biệt là trong điều kiện ánh sáng yếu.\r\nNgoài ra còn có một tính năng AI mới gọi là AI HDR, giúp điều chỉnh ánh sáng trên tấm ảnh dựa trên nguồn sáng từ đó đem lại cho người dùng những bức ảnh chất lượng hơn.Huawei P30 có 3 camera trên mặt lưng bao gồm ống kính chính SuperSpectrum 40 MP, khẩu độ f / 1.8 + ống kính góc cực rộng 16 MP + ống kính tele 8 MP với khả năng zoom quang 3X và khẩu độ f / 2.4.', 'product_images/zXxZj7CYYIYMBiKUTtVxtlfNX8Ue5IIxdHfNmBIU.jpg', 1, '2024-03-09 14:51:14', '2024-03-09 14:51:14'),
(8, 2, 'Huawei Nova 5T blue', 10000000, 403, 'Huawei P30 là chiếc smartphone cao cấp vừa được Huawei giới thiệu với thiết kế tuyệt đẹp, hiệu năng mạnh mẽ và thiết lập camera ấn tượng.\r\nCamera siêu ấn tượng\r\nĐiện thoại dòng P của Huawei luôn cho ra mắt những công nghệ camera mới và P30 cũng không ngoại lệ.Huawei P30 có 3 camera trên mặt lưng bao gồm ống kính chính SuperSpectrum 40 MP, khẩu độ f / 1.8 + ống kính góc cực rộng 16 MP + ống kính tele 8 MP với khả năng zoom quang 3X và khẩu độ f / 2.4.SuperSpectrum là tên của Huawei cho bộ lọc màu RYYB, loại bỏ các yếu tố màu xanh lá cây khỏi bộ lọc RGGB và thay thế chúng bằng màu vàng.\r\nHuawei nói rằng việc chuyển từ màu xanh lục sang màu vàng sẽ giúp cảm biến hấp thụ nhiều ánh sáng hơn.Màu vàng cũng hấp thụ thêm ánh sáng xanh lá và đỏ, giúp cải thiện chất lượng hình ảnh trong bất cứ điều kiện nào, đặc biệt là trong điều kiện ánh sáng yếu.\r\nNgoài ra còn có một tính năng AI mới gọi là AI HDR, giúp điều chỉnh ánh sáng trên tấm ảnh dựa trên nguồn sáng từ đó đem lại cho người dùng những bức ảnh chất lượng hơn.Huawei P30 có 3 camera trên mặt lưng bao gồm ống kính chính SuperSpectrum 40 MP, khẩu độ f / 1.8 + ống kính góc cực rộng 16 MP + ống kính tele 8 MP với khả năng zoom quang 3X và khẩu độ f / 2.4.', 'product_images/966EClTWziiiiOvoT74jbAoQ1jIzi7aKObDrjWBl.jpg', 1, '2024-03-09 14:51:51', '2024-03-09 14:51:51'),
(9, 2, 'Huawei Mate 30', 25000000, 100, 'Huawei P30 là chiếc smartphone cao cấp vừa được Huawei giới thiệu với thiết kế tuyệt đẹp, hiệu năng mạnh mẽ và thiết lập camera ấn tượng.\r\nCamera siêu ấn tượng\r\nĐiện thoại dòng P của Huawei luôn cho ra mắt những công nghệ camera mới và P30 cũng không ngoại lệ.Huawei P30 có 3 camera trên mặt lưng bao gồm ống kính chính SuperSpectrum 40 MP, khẩu độ f / 1.8 + ống kính góc cực rộng 16 MP + ống kính tele 8 MP với khả năng zoom quang 3X và khẩu độ f / 2.4.SuperSpectrum là tên của Huawei cho bộ lọc màu RYYB, loại bỏ các yếu tố màu xanh lá cây khỏi bộ lọc RGGB và thay thế chúng bằng màu vàng.\r\nHuawei nói rằng việc chuyển từ màu xanh lục sang màu vàng sẽ giúp cảm biến hấp thụ nhiều ánh sáng hơn.Màu vàng cũng hấp thụ thêm ánh sáng xanh lá và đỏ, giúp cải thiện chất lượng hình ảnh trong bất cứ điều kiện nào, đặc biệt là trong điều kiện ánh sáng yếu.\r\nNgoài ra còn có một tính năng AI mới gọi là AI HDR, giúp điều chỉnh ánh sáng trên tấm ảnh dựa trên nguồn sáng từ đó đem lại cho người dùng những bức ảnh chất lượng hơn.Huawei P30 có 3 camera trên mặt lưng bao gồm ống kính chính SuperSpectrum 40 MP, khẩu độ f / 1.8 + ống kính góc cực rộng 16 MP + ống kính tele 8 MP với khả năng zoom quang 3X và khẩu độ f / 2.4.', 'product_images/LK8BM73YA2yxt680u8KtniclzvFPRFZgtI5rw9a9.jpg', 0, '2024-03-09 14:52:19', '2024-03-09 14:52:19'),
(10, 2, 'Huawei Nova 7I', 7500000, 93, 'Huawei P30 là chiếc smartphone cao cấp vừa được Huawei giới thiệu với thiết kế tuyệt đẹp, hiệu năng mạnh mẽ và thiết lập camera ấn tượng.\r\nCamera siêu ấn tượng\r\nĐiện thoại dòng P của Huawei luôn cho ra mắt những công nghệ camera mới và P30 cũng không ngoại lệ.Huawei P30 có 3 camera trên mặt lưng bao gồm ống kính chính SuperSpectrum 40 MP, khẩu độ f / 1.8 + ống kính góc cực rộng 16 MP + ống kính tele 8 MP với khả năng zoom quang 3X và khẩu độ f / 2.4.SuperSpectrum là tên của Huawei cho bộ lọc màu RYYB, loại bỏ các yếu tố màu xanh lá cây khỏi bộ lọc RGGB và thay thế chúng bằng màu vàng.\r\nHuawei nói rằng việc chuyển từ màu xanh lục sang màu vàng sẽ giúp cảm biến hấp thụ nhiều ánh sáng hơn.Màu vàng cũng hấp thụ thêm ánh sáng xanh lá và đỏ, giúp cải thiện chất lượng hình ảnh trong bất cứ điều kiện nào, đặc biệt là trong điều kiện ánh sáng yếu.\r\nNgoài ra còn có một tính năng AI mới gọi là AI HDR, giúp điều chỉnh ánh sáng trên tấm ảnh dựa trên nguồn sáng từ đó đem lại cho người dùng những bức ảnh chất lượng hơn.Huawei P30 có 3 camera trên mặt lưng bao gồm ống kính chính SuperSpectrum 40 MP, khẩu độ f / 1.8 + ống kính góc cực rộng 16 MP + ống kính tele 8 MP với khả năng zoom quang 3X và khẩu độ f / 2.4.', 'product_images/RJI0XpqRzpXf6sBwL4A3dYpOGDXzY0vlzugAIooI.jpg', 1, '2024-03-09 14:53:13', '2024-03-09 14:53:13'),
(11, 2, 'Huawei Nova 8I', 9200000, 99, 'Huawei P30 là chiếc smartphone cao cấp vừa được Huawei giới thiệu với thiết kế tuyệt đẹp, hiệu năng mạnh mẽ và thiết lập camera ấn tượng.\r\nCamera siêu ấn tượng\r\nĐiện thoại dòng P của Huawei luôn cho ra mắt những công nghệ camera mới và P30 cũng không ngoại lệ.Huawei P30 có 3 camera trên mặt lưng bao gồm ống kính chính SuperSpectrum 40 MP, khẩu độ f / 1.8 + ống kính góc cực rộng 16 MP + ống kính tele 8 MP với khả năng zoom quang 3X và khẩu độ f / 2.4.SuperSpectrum là tên của Huawei cho bộ lọc màu RYYB, loại bỏ các yếu tố màu xanh lá cây khỏi bộ lọc RGGB và thay thế chúng bằng màu vàng.\r\nHuawei nói rằng việc chuyển từ màu xanh lục sang màu vàng sẽ giúp cảm biến hấp thụ nhiều ánh sáng hơn.Màu vàng cũng hấp thụ thêm ánh sáng xanh lá và đỏ, giúp cải thiện chất lượng hình ảnh trong bất cứ điều kiện nào, đặc biệt là trong điều kiện ánh sáng yếu.\r\nNgoài ra còn có một tính năng AI mới gọi là AI HDR, giúp điều chỉnh ánh sáng trên tấm ảnh dựa trên nguồn sáng từ đó đem lại cho người dùng những bức ảnh chất lượng hơn.Huawei P30 có 3 camera trên mặt lưng bao gồm ống kính chính SuperSpectrum 40 MP, khẩu độ f / 1.8 + ống kính góc cực rộng 16 MP + ống kính tele 8 MP với khả năng zoom quang 3X và khẩu độ f / 2.4.', 'product_images/fmMbn2tOaxytB7q9dkhuHfzMya6pd3L7183RdBGz.jpg', 1, '2024-03-09 14:53:44', '2024-03-09 14:53:44'),
(12, 3, 'Samsung galaxy s24 grey', 25000000, 90, 'Thông tin sản phẩm\r\nTrong sự kiện Unpacked 2024 diễn ra vào ngày 18/01, Samsung đã chính thức ra mắt chiếc điện thoại Samsung Galaxy S24. Sản phẩm này mang đến nhiều cải tiến độc đáo, bao gồm việc sử dụng chip mới của Samsung, tích hợp nhiều tính năng thông minh sử dụng trí tuệ nhân tạo và cải thiện đáng kể hiệu suất chụp ảnh từ hệ thống camera.\r\nThiết kế vuông hơn, thời thượng hơn\r\nVề phần thiết kế, Samsung vẫn tiếp tục sử dụng kiểu dáng vuông vức và cách bố trí cụm camera quen thuộc so với Samsung Galaxy S23. Đáng khen là hãng có ghi nhận những góp ý từ đời trước nên cũng đã tối ưu nhẹ ở một vài điểm như: Các góc làm vuông hơn, viền màn hình mỏng hơn và cuối cùng là dải loa được làm theo dạng rảnh.Galaxy S24 có phần khung được làm từ chất liệu nhôm kết hợp cùng mặt lưng kính cường lực. Mình cảm giác máy cực kỳ chắc chắn, cảm giác cầm máy cũng khá là chặt tay. Bởi năm nay cả mặt lưng và khung viền đều được làm nhám, khác với Galaxy S23 có khung viền làm theo kiểu bóng.Cụm camera ở mặt sau vẫn giữ nguyên với cấu trúc 3 camera xếp dọc, không có sự thay đổi đáng kể về bố trí. Có lẽ Samsung vẫn đang cố gắng duy trì sự tối giản về thiết kế trong những sản phẩm của mình, điều mà hãng hướng tới khi người dùng đang có xu hướng yêu thích những thứ không có quá nhiều hoạ tiết, sự đơn giản.', 'product_images/ZllM8Hb9CKaBZifcbHPLpdnlINPFwwnAEfZdFkLR.jpg', 1, '2024-03-09 14:55:05', '2024-03-09 14:55:05'),
(13, 3, 'Samsung galaxy s24 Plus violet', 28000000, 90, 'Thông tin sản phẩm\r\nTrong sự kiện Unpacked 2024 diễn ra vào ngày 18/01, Samsung đã chính thức ra mắt chiếc điện thoại Samsung Galaxy S24. Sản phẩm này mang đến nhiều cải tiến độc đáo, bao gồm việc sử dụng chip mới của Samsung, tích hợp nhiều tính năng thông minh sử dụng trí tuệ nhân tạo và cải thiện đáng kể hiệu suất chụp ảnh từ hệ thống camera.\r\nThiết kế vuông hơn, thời thượng hơn\r\nVề phần thiết kế, Samsung vẫn tiếp tục sử dụng kiểu dáng vuông vức và cách bố trí cụm camera quen thuộc so với Samsung Galaxy S23. Đáng khen là hãng có ghi nhận những góp ý từ đời trước nên cũng đã tối ưu nhẹ ở một vài điểm như: Các góc làm vuông hơn, viền màn hình mỏng hơn và cuối cùng là dải loa được làm theo dạng rảnh.Galaxy S24 có phần khung được làm từ chất liệu nhôm kết hợp cùng mặt lưng kính cường lực. Mình cảm giác máy cực kỳ chắc chắn, cảm giác cầm máy cũng khá là chặt tay. Bởi năm nay cả mặt lưng và khung viền đều được làm nhám, khác với Galaxy S23 có khung viền làm theo kiểu bóng.Cụm camera ở mặt sau vẫn giữ nguyên với cấu trúc 3 camera xếp dọc, không có sự thay đổi đáng kể về bố trí. Có lẽ Samsung vẫn đang cố gắng duy trì sự tối giản về thiết kế trong những sản phẩm của mình, điều mà hãng hướng tới khi người dùng đang có xu hướng yêu thích những thứ không có quá nhiều hoạ tiết, sự đơn giản.', 'product_images/AkzXaD4vbktjuSk7jGXioL0Juw2Di3L67wFi1R2Z.jpg', 0, '2024-03-09 14:55:32', '2024-03-09 14:55:32'),
(14, 3, 'Samsung galaxy s24 Ultra grey', 32000000, 266, 'Thông tin sản phẩm\r\nTrong sự kiện Unpacked 2024 diễn ra vào ngày 18/01, Samsung đã chính thức ra mắt chiếc điện thoại Samsung Galaxy S24. Sản phẩm này mang đến nhiều cải tiến độc đáo, bao gồm việc sử dụng chip mới của Samsung, tích hợp nhiều tính năng thông minh sử dụng trí tuệ nhân tạo và cải thiện đáng kể hiệu suất chụp ảnh từ hệ thống camera.\r\nThiết kế vuông hơn, thời thượng hơn\r\nVề phần thiết kế, Samsung vẫn tiếp tục sử dụng kiểu dáng vuông vức và cách bố trí cụm camera quen thuộc so với Samsung Galaxy S23. Đáng khen là hãng có ghi nhận những góp ý từ đời trước nên cũng đã tối ưu nhẹ ở một vài điểm như: Các góc làm vuông hơn, viền màn hình mỏng hơn và cuối cùng là dải loa được làm theo dạng rảnh.Galaxy S24 có phần khung được làm từ chất liệu nhôm kết hợp cùng mặt lưng kính cường lực. Mình cảm giác máy cực kỳ chắc chắn, cảm giác cầm máy cũng khá là chặt tay. Bởi năm nay cả mặt lưng và khung viền đều được làm nhám, khác với Galaxy S23 có khung viền làm theo kiểu bóng.Cụm camera ở mặt sau vẫn giữ nguyên với cấu trúc 3 camera xếp dọc, không có sự thay đổi đáng kể về bố trí. Có lẽ Samsung vẫn đang cố gắng duy trì sự tối giản về thiết kế trong những sản phẩm của mình, điều mà hãng hướng tới khi người dùng đang có xu hướng yêu thích những thứ không có quá nhiều hoạ tiết, sự đơn giản.', 'product_images/W4gfJr20aICYBEfyqZV0iQQ0B1YokodHOQdnGkZe.jpg', 1, '2024-03-09 14:56:01', '2024-03-09 14:56:01'),
(15, 3, 'Samsung galaxy z fold 5 kem', 40260000, 20, 'Thông tin sản phẩm\r\nTrong sự kiện Unpacked 2024 diễn ra vào ngày 18/01, Samsung đã chính thức ra mắt chiếc điện thoại Samsung Galaxy S24. Sản phẩm này mang đến nhiều cải tiến độc đáo, bao gồm việc sử dụng chip mới của Samsung, tích hợp nhiều tính năng thông minh sử dụng trí tuệ nhân tạo và cải thiện đáng kể hiệu suất chụp ảnh từ hệ thống camera.\r\nThiết kế vuông hơn, thời thượng hơn\r\nVề phần thiết kế, Samsung vẫn tiếp tục sử dụng kiểu dáng vuông vức và cách bố trí cụm camera quen thuộc so với Samsung Galaxy S23. Đáng khen là hãng có ghi nhận những góp ý từ đời trước nên cũng đã tối ưu nhẹ ở một vài điểm như: Các góc làm vuông hơn, viền màn hình mỏng hơn và cuối cùng là dải loa được làm theo dạng rảnh.Galaxy S24 có phần khung được làm từ chất liệu nhôm kết hợp cùng mặt lưng kính cường lực. Mình cảm giác máy cực kỳ chắc chắn, cảm giác cầm máy cũng khá là chặt tay. Bởi năm nay cả mặt lưng và khung viền đều được làm nhám, khác với Galaxy S23 có khung viền làm theo kiểu bóng.Cụm camera ở mặt sau vẫn giữ nguyên với cấu trúc 3 camera xếp dọc, không có sự thay đổi đáng kể về bố trí. Có lẽ Samsung vẫn đang cố gắng duy trì sự tối giản về thiết kế trong những sản phẩm của mình, điều mà hãng hướng tới khi người dùng đang có xu hướng yêu thích những thứ không có quá nhiều hoạ tiết, sự đơn giản.', 'product_images/pmtBWpCNxsdpT1Wjh9exUGQM3OLvvYNzgRXS3aWM.jpg', 0, '2024-03-09 14:56:35', '2024-03-09 14:56:35'),
(16, 4, 'Xiaomi redmi note 12 pro 4g den', 14250000, 258, 'Sự bùng nổ của công nghệ di động trong những năm gần đây đã mang đến cho người dùng vô số lựa chọn smartphone đa dạng. Trong phân khúc tầm trung, Xiaomi Redmi Note 13 Pro 128GB nổi lên như một ứng cử viên sáng giá với những ưu điểm vượt trội về thiết kế, hiệu năng nhờ chip Helio G99-Ultra, camera 200 MP và kết hợp sạc nhanh 67 W.\r\nThiết kế đẹp mắt và hỗ trợ chuẩn IP54\r\nĐiện thoại có vẻ ngoài hiện đại và sang trọng, với khung viền vuông vức giúp tạo điểm nhấn cho thiết kế khi mang lại cảm giác mạnh mẽ, nam tính lúc cầm nắm. Đi cùng với đó là mặt lưng và khung nhựa nhẹ được làm bóng, Redmi Note 13 Pro mang đến vẻ đẹp sang trọng, bóng bẩy, thu hút mọi ánh nhìn.Ở vị trí giao nhau giữa khung viền vuông và hai mặt trước sau, máy được làm cong nhẹ để tạo ra một cảm giác cầm nắm thoải mái và tự nhiên. Điều này giúp người dùng dễ dàng sử dụng thiết bị trong thời gian dài mà không gặp phải cảm giác mệt mỏi hay không thoải mái.Xiaomi Redmi Note 13 Pro không chỉ nổi bật với thiết kế, mà còn có sự đa dạng trong màu sắc, phù hợp với sở thích cá nhân của mỗi người dùng. Tùy chọn màu sắc gồm có xanh lá, đen và tím, giúp người dùng có thêm lựa chọn để thể hiện phong cách riêng của mình.\r\n\r\nVới viền dưới mỏng chỉ với 2.25 mm, Redmi Note 13 Pro mang lại trải nghiệm sử dụng mượt mà và còn tạo điểm nhấn cho thiết kế tổng thể của sản phẩm. Đặc biệt, việc đạt được tiêu chuẩn kháng nước và bụi IP54 cũng là điểm nhấn giúp bảo vệ thiết bị khỏi những tác động từ môi trường bên ngoài, gia tăng tuổi thọ và độ bền cho sản phẩm.Xiaomi Redmi Note 13 Pro thu hút sự chú ý như là một trung tâm giải trí di động với tích hợp loa kép đi kèm công nghệ âm thanh Dolby Atmos, từ đó mang lại trải nghiệm âm thanh sống động, chi tiết và mạnh mẽ, làm cho việc xem phim, nghe nhạc trở nên thú vị hơn bao giờ hết.', 'product_images/w8kWrLMf5L8sFQ1vjpCflkKJOHdKvW5fPbLz3xae.jpg', 1, '2024-03-09 14:58:02', '2024-03-09 14:58:02'),
(17, 4, 'Xiaomi 14 white', 14250000, 258, 'Sự bùng nổ của công nghệ di động trong những năm gần đây đã mang đến cho người dùng vô số lựa chọn smartphone đa dạng. Trong phân khúc tầm trung, Xiaomi Redmi Note 13 Pro 128GB nổi lên như một ứng cử viên sáng giá với những ưu điểm vượt trội về thiết kế, hiệu năng nhờ chip Helio G99-Ultra, camera 200 MP và kết hợp sạc nhanh 67 W.\r\nThiết kế đẹp mắt và hỗ trợ chuẩn IP54\r\nĐiện thoại có vẻ ngoài hiện đại và sang trọng, với khung viền vuông vức giúp tạo điểm nhấn cho thiết kế khi mang lại cảm giác mạnh mẽ, nam tính lúc cầm nắm. Đi cùng với đó là mặt lưng và khung nhựa nhẹ được làm bóng, Redmi Note 13 Pro mang đến vẻ đẹp sang trọng, bóng bẩy, thu hút mọi ánh nhìn.Ở vị trí giao nhau giữa khung viền vuông và hai mặt trước sau, máy được làm cong nhẹ để tạo ra một cảm giác cầm nắm thoải mái và tự nhiên. Điều này giúp người dùng dễ dàng sử dụng thiết bị trong thời gian dài mà không gặp phải cảm giác mệt mỏi hay không thoải mái.Xiaomi Redmi Note 13 Pro không chỉ nổi bật với thiết kế, mà còn có sự đa dạng trong màu sắc, phù hợp với sở thích cá nhân của mỗi người dùng. Tùy chọn màu sắc gồm có xanh lá, đen và tím, giúp người dùng có thêm lựa chọn để thể hiện phong cách riêng của mình.\r\n\r\nVới viền dưới mỏng chỉ với 2.25 mm, Redmi Note 13 Pro mang lại trải nghiệm sử dụng mượt mà và còn tạo điểm nhấn cho thiết kế tổng thể của sản phẩm. Đặc biệt, việc đạt được tiêu chuẩn kháng nước và bụi IP54 cũng là điểm nhấn giúp bảo vệ thiết bị khỏi những tác động từ môi trường bên ngoài, gia tăng tuổi thọ và độ bền cho sản phẩm.Xiaomi Redmi Note 13 Pro thu hút sự chú ý như là một trung tâm giải trí di động với tích hợp loa kép đi kèm công nghệ âm thanh Dolby Atmos, từ đó mang lại trải nghiệm âm thanh sống động, chi tiết và mạnh mẽ, làm cho việc xem phim, nghe nhạc trở nên thú vị hơn bao giờ hết.', 'product_images/3SUzBRm5yuoUjQxCgbPlZz2cmMQPogO0jyyOfVYT.jpg', 0, '2024-03-09 14:58:25', '2024-03-09 14:58:25'),
(18, 6, 'Readlmi C35 white', 5500000, 378, 'realme Note 50 64GB tiếp tục thu hút sự chú ý nhờ vào mức giá nổi bật và hấp dẫn của mình. Mặc dù nằm trong phân khúc giá thấp, sản phẩm này vẫn mang đến nhiều công nghệ ấn tượng, tạo nên sự đáng chú ý khi trang bị màn hình lớn 6.74 inch, pin 5000 mAh và đạt chuẩn IP54.\r\nThiết kế vuông vức hiện đại\r\nVới hình dạng vuông vức, realme Note 50 trở nên nổi bật giữa các sản phẩm giá rẻ khác nhờ vẻ hiện đại. Mặt lưng và khung viền được làm từ chất liệu nhựa, không chỉ giúp giảm giá thành mà còn tối ưu hóa khối lượng, tạo ra trải nghiệm cầm nắm nhẹ nhàng.\r\n\r\nVới độ mỏng chỉ 7.99 mm, realme Note 50 thực sự tạo ấn tượng bởi đây được xem là một chiếc máy giá rẻ trang bị pin 5000 mAh nhưng được. tối ưu độ mỏng tốt như vậy. Với độ dày này, người dùng có cơ hội trải nghiệm cảm giác sử dụng mỏng nhẹ cũng như sở hữu được một chiếc máy đẹp có tạo hình đẳng cấp và phong cách hiện đại.\r\n\r\n\r\n\r\nrealme Note 50 không chỉ nổi bật với thiết kế đẹp mắt mà còn chinh phục người dùng bằng tính linh hoạt với cổng sạc Type-C. Công nghệ này giúp tăng cường hiệu suất khi cung cấp tốc độ truyền dữ liệu, đồng thời tạo ra sự thuận lợi với khả năng kết nối hai chiều.\r\n\r\nNgoài ra, với chuẩn kháng nước và bụi IP54, chiếc điện thoại realme này tự tin đối mặt với mọi thách thức môi trường. Bạn không cần phải lo lắng khi sử dụng điện thoại dưới mưa nhỏ hoặc trong môi trường bụi bặm. realme Note 50 giúp bảo vệ thiết bị khỏi những yếu tố gây hại, mang lại sự an tâm và thoải mái khi sử dụng hằng ngày.\r\n\r\nTích hợp vân tay cạnh viền, realme Note 50 giúp trải nghiệm mở khóa trở nên tối ưu hơn. Không chỉ nhanh chóng và hiệu quả, mà còn tăng cường đáng kể về mức độ bảo mật. Việc đặt cảm biến vân tay ở cạnh viền, một vị trí thuận tiện giúp người dùng truy cập thiết bị một cách tự nhiên và nhanh chóng.\r\n\r\n\r\n\r\nMàn hình lớn sử dụng tấm nền IPS LCD\r\nrealme Note 50 được trang bị công nghệ màn hình IPS LCD, một chuẩn khá phổ biến trên các dòng điện thoại giá rẻ - tầm trung. Tấm nền này ngoài ưu điểm về giá còn giúp mang lại chất lượng hình ảnh tốt, độ sáng cao, góc nhìn rộng và màu sắc trung thực.\r\n\r\nVới độ phân giải HD+ (720 x 1600 Pixels), màn hình điện thoại vẫn đảm bảo hình ảnh rõ ràng và chi tiết, làm cho mọi trải nghiệm giải trí trở nên trung thực và sống động. Với kích thước màn hình lên đến 6.74 inch, realme Note 50 đưa người dùng vào một thế giới mở rộng, nơi mọi chi tiết trên màn hình được hiển thị một cách to rõ và dễ nhìn.\r\n\r\n\r\n\r\nMàn hình có độ sáng 560 nits, một mức khá ổn trên một chiếc điện thoại giá rẻ, đủ để người dùng xem được các nội dung cơ bản như tin nhắn, bản đồ hay xem trước ảnh chụp mà ít khi gặp khó khăn. Tuy nhiên, để phục vụ nhu cầu giải trí như xem phim hay chơi game được tốt khi ở môi trường có độ sáng cao, có lẽ bạn nên quan tâm đến các sản phẩm thuộc phân khúc cao hơn.\r\n\r\nNgoài ra, điện thoại còn được trang bị kính cường lực Panda ở phần mặt trước, công nghệ này giúp bảo vệ màn hình tốt hơn trước những vật dụng gây dễ xước, tình trạng hư hại nặng khi va đập cũng được giảm thiểu phần nào nhờ lớp kính cường lực này.\r\n\r\n\r\n\r\nCamera đủ để đáp ứng tốt các nhu cầu quay chụp cơ bản\r\nrealme Note 50 được trang bị camera chính 13 MP, đảm bảo việc bắt gọn mọi khoảnh khắc của cuộc sống. Từ cảnh đẹp tự nhiên đến chụp ảnh gia đình, chiếc điện thoại này là bạn đồng hành đáng tin cậy, cung cấp hình ảnh sắc nét và chi tiết tốt trong tầm giá.\r\n\r\nVới camera phụ 0.08 MP tích hợp, realme Note 50 mang đến khả năng chụp ảnh với hiệu ứng xóa phông tinh tế, từ đó giúp tạo ra những bức ảnh nghệ thuật, nổi bật với sự tập trung vào đối tượng chính, trong khi phông nền được làm mịn màng và ấn tượng.\r\n\r\n\r\n\r\nỞ mặt trước, realme Note 50 sở hữu camera selfie 5 MP, với khả năng xóa phông và nhiều tính năng làm đẹp. Bạn sẽ luôn tự tin khi chụp ảnh tự sướng hay thậm chí là khi tham gia các cuộc họp trực tuyến, với chất lượng ảnh rõ nét và hiệu ứng làm đẹp tự nhiên.\r\n\r\nHiệu năng ổn và hỗ trợ mở rộng bộ nhớ lên đến 2 TB\r\nrealme Note 50 sử dụng chip Unisoc Tiger T612, một sự kết hợp tinh tế giữa hiệu năng và chi phí, chip này đảm bảo rằng chiếc điện thoại có thể chạy mượt mà, từ các ứng dụng hằng ngày đến những trải nghiệm giải trí đa phương tiện cơ bản.\r\n\r\nVì đây là mẫu điện thoại RAM 4 GB, vậy nên những tác vụ đa nhiệm nhiều ứng dụng cùng lúc vẫn sẽ gây đôi chút khó khăn dành cho máy, các hiện tượng như khựng hay đơ máy tạm thời có thể sẽ xảy ra. Tuy nhiên, để khắc phục điều này người dùng nên hạn chế mở nhiều ứng dụng không cần thiết để tối ưu RAM có trên máy.\r\n\r\n\r\n\r\nVới bộ nhớ trong 64 GB có sẵn, realme Note 50 cho phép bạn lưu trữ nhiều dữ liệu, ảnh, video và ứng dụng mà không lo lắng về không gian. Để đảm bảo không gian lưu trữ không bao giờ là vấn đề, điện thoại hỗ trợ mở rộng dung lượng qua thẻ MicroSD lên đến 2 TB, giúp cung cấp cho bạn sự linh hoạt theo nhu cầu của mình.\r\n\r\nPin 5000 mAh đảm bảo trải nghiệm dài lâu mà không cần sạc\r\nVới pin lớn 5000 mAh, realme Note 50 là chiếc điện thoại đồng hành lý tưởng cho những người dùng yêu cầu cao về thời lượng pin. Không còn lo lắng về việc sạc điện thoại liên tục, bạn có thể thoải mái sử dụng nhiều tính năng và trải nghiệm giải trí suốt cả ngày mà không cần phải nghĩ đến việc sạc pin nhiều lần trong ngày.\r\n\r\nMặc dù không phải là sạc nhanh, nhưng sạc 10 W của realme Note 50 lại giúp điện thoại nạp năng lượng một cách từ tốn và an toàn. Với tốc độ này, việc sạc điện thoại vào lúc đi ngủ là một lựa chọn thông minh, bởi cách này giúp tránh tình trạng phải chờ đợi khi bạn thức dậy.\r\n\r\n\r\n\r\nTổng kết, realme Note 50 là một sự chọn lựa hoàn hảo cho những người đang tìm kiếm một chiếc điện thoại nổi bật với mức giá phải chăng. Không đặt quá nhiều trọng tâm vào hiệu năng và chất lượng camera, chiếc điện thoại này đáp ứng nhu cầu sử dụng hằng ngày chủ yếu như lướt web, xem phim và thực hiện cuộc gọi hay nhắn tin.realme Note 50 không chỉ nổi bật với thiết kế đẹp mắt mà còn chinh phục người dùng bằng tính linh hoạt với cổng sạc Type-C. Công nghệ này giúp tăng cường hiệu suất khi cung cấp tốc độ truyền dữ liệu, đồng thời tạo ra sự thuận lợi với khả năng kết nối hai chiều.\r\n\r\nNgoài ra, với chuẩn kháng nước và bụi IP54, chiếc điện thoại realme này tự tin đối mặt với mọi thách thức môi trường. Bạn không cần phải lo lắng khi sử dụng điện thoại dưới mưa nhỏ hoặc trong môi trường bụi bặm. realme Note 50 giúp bảo vệ thiết bị khỏi những yếu tố gây hại, mang lại sự an tâm và thoải mái khi sử dụng hằng ngày.\r\n\r\nTích hợp vân tay cạnh viền, realme Note 50 giúp trải nghiệm mở khóa trở nên tối ưu hơn. Không chỉ nhanh chóng và hiệu quả, mà còn tăng cường đáng kể về mức độ bảo mật. Việc đặt cảm biến vân tay ở cạnh viền, một vị trí thuận tiện giúp người dùng truy cập thiết bị một cách tự nhiên và nhanh chóng.Màn hình lớn sử dụng tấm nền IPS LCD\r\nrealme Note 50 được trang bị công nghệ màn hình IPS LCD, một chuẩn khá phổ biến trên các dòng điện thoại giá rẻ - tầm trung. Tấm nền này ngoài ưu điểm về giá còn giúp mang lại chất lượng hình ảnh tốt, độ sáng cao, góc nhìn rộng và màu sắc trung thực.\r\n\r\nVới độ phân giải HD+ (720 x 1600 Pixels), màn hình điện thoại vẫn đảm bảo hình ảnh rõ ràng và chi tiết, làm cho mọi trải nghiệm giải trí trở nên trung thực và sống động. Với kích thước màn hình lên đến 6.74 inch, realme Note 50 đưa người dùng vào một thế giới mở rộng, nơi mọi chi tiết trên màn hình được hiển thị một cách to rõ và dễ nhìn.', 'product_images/5QjPxIMLzF0DiuPzsFz2BdctMQVxf2v5DpNjZb8N.jpg', 1, '2024-03-09 14:59:49', '2024-03-09 14:59:49'),
(19, 6, 'Readlmi C67 Xanh', 3400000, 376, 'realme Note 50 64GB tiếp tục thu hút sự chú ý nhờ vào mức giá nổi bật và hấp dẫn của mình. Mặc dù nằm trong phân khúc giá thấp, sản phẩm này vẫn mang đến nhiều công nghệ ấn tượng, tạo nên sự đáng chú ý khi trang bị màn hình lớn 6.74 inch, pin 5000 mAh và đạt chuẩn IP54.\r\nThiết kế vuông vức hiện đại\r\nVới hình dạng vuông vức, realme Note 50 trở nên nổi bật giữa các sản phẩm giá rẻ khác nhờ vẻ hiện đại. Mặt lưng và khung viền được làm từ chất liệu nhựa, không chỉ giúp giảm giá thành mà còn tối ưu hóa khối lượng, tạo ra trải nghiệm cầm nắm nhẹ nhàng.\r\n\r\nVới độ mỏng chỉ 7.99 mm, realme Note 50 thực sự tạo ấn tượng bởi đây được xem là một chiếc máy giá rẻ trang bị pin 5000 mAh nhưng được. tối ưu độ mỏng tốt như vậy. Với độ dày này, người dùng có cơ hội trải nghiệm cảm giác sử dụng mỏng nhẹ cũng như sở hữu được một chiếc máy đẹp có tạo hình đẳng cấp và phong cách hiện đại.\r\n\r\n\r\n\r\nrealme Note 50 không chỉ nổi bật với thiết kế đẹp mắt mà còn chinh phục người dùng bằng tính linh hoạt với cổng sạc Type-C. Công nghệ này giúp tăng cường hiệu suất khi cung cấp tốc độ truyền dữ liệu, đồng thời tạo ra sự thuận lợi với khả năng kết nối hai chiều.\r\n\r\nNgoài ra, với chuẩn kháng nước và bụi IP54, chiếc điện thoại realme này tự tin đối mặt với mọi thách thức môi trường. Bạn không cần phải lo lắng khi sử dụng điện thoại dưới mưa nhỏ hoặc trong môi trường bụi bặm. realme Note 50 giúp bảo vệ thiết bị khỏi những yếu tố gây hại, mang lại sự an tâm và thoải mái khi sử dụng hằng ngày.\r\n\r\nTích hợp vân tay cạnh viền, realme Note 50 giúp trải nghiệm mở khóa trở nên tối ưu hơn. Không chỉ nhanh chóng và hiệu quả, mà còn tăng cường đáng kể về mức độ bảo mật. Việc đặt cảm biến vân tay ở cạnh viền, một vị trí thuận tiện giúp người dùng truy cập thiết bị một cách tự nhiên và nhanh chóng.\r\n\r\n\r\n\r\nMàn hình lớn sử dụng tấm nền IPS LCD\r\nrealme Note 50 được trang bị công nghệ màn hình IPS LCD, một chuẩn khá phổ biến trên các dòng điện thoại giá rẻ - tầm trung. Tấm nền này ngoài ưu điểm về giá còn giúp mang lại chất lượng hình ảnh tốt, độ sáng cao, góc nhìn rộng và màu sắc trung thực.\r\n\r\nVới độ phân giải HD+ (720 x 1600 Pixels), màn hình điện thoại vẫn đảm bảo hình ảnh rõ ràng và chi tiết, làm cho mọi trải nghiệm giải trí trở nên trung thực và sống động. Với kích thước màn hình lên đến 6.74 inch, realme Note 50 đưa người dùng vào một thế giới mở rộng, nơi mọi chi tiết trên màn hình được hiển thị một cách to rõ và dễ nhìn.\r\n\r\n\r\n\r\nMàn hình có độ sáng 560 nits, một mức khá ổn trên một chiếc điện thoại giá rẻ, đủ để người dùng xem được các nội dung cơ bản như tin nhắn, bản đồ hay xem trước ảnh chụp mà ít khi gặp khó khăn. Tuy nhiên, để phục vụ nhu cầu giải trí như xem phim hay chơi game được tốt khi ở môi trường có độ sáng cao, có lẽ bạn nên quan tâm đến các sản phẩm thuộc phân khúc cao hơn.\r\n\r\nNgoài ra, điện thoại còn được trang bị kính cường lực Panda ở phần mặt trước, công nghệ này giúp bảo vệ màn hình tốt hơn trước những vật dụng gây dễ xước, tình trạng hư hại nặng khi va đập cũng được giảm thiểu phần nào nhờ lớp kính cường lực này.\r\n\r\n\r\n\r\nCamera đủ để đáp ứng tốt các nhu cầu quay chụp cơ bản\r\nrealme Note 50 được trang bị camera chính 13 MP, đảm bảo việc bắt gọn mọi khoảnh khắc của cuộc sống. Từ cảnh đẹp tự nhiên đến chụp ảnh gia đình, chiếc điện thoại này là bạn đồng hành đáng tin cậy, cung cấp hình ảnh sắc nét và chi tiết tốt trong tầm giá.\r\n\r\nVới camera phụ 0.08 MP tích hợp, realme Note 50 mang đến khả năng chụp ảnh với hiệu ứng xóa phông tinh tế, từ đó giúp tạo ra những bức ảnh nghệ thuật, nổi bật với sự tập trung vào đối tượng chính, trong khi phông nền được làm mịn màng và ấn tượng.\r\n\r\n\r\n\r\nỞ mặt trước, realme Note 50 sở hữu camera selfie 5 MP, với khả năng xóa phông và nhiều tính năng làm đẹp. Bạn sẽ luôn tự tin khi chụp ảnh tự sướng hay thậm chí là khi tham gia các cuộc họp trực tuyến, với chất lượng ảnh rõ nét và hiệu ứng làm đẹp tự nhiên.\r\n\r\nHiệu năng ổn và hỗ trợ mở rộng bộ nhớ lên đến 2 TB\r\nrealme Note 50 sử dụng chip Unisoc Tiger T612, một sự kết hợp tinh tế giữa hiệu năng và chi phí, chip này đảm bảo rằng chiếc điện thoại có thể chạy mượt mà, từ các ứng dụng hằng ngày đến những trải nghiệm giải trí đa phương tiện cơ bản.\r\n\r\nVì đây là mẫu điện thoại RAM 4 GB, vậy nên những tác vụ đa nhiệm nhiều ứng dụng cùng lúc vẫn sẽ gây đôi chút khó khăn dành cho máy, các hiện tượng như khựng hay đơ máy tạm thời có thể sẽ xảy ra. Tuy nhiên, để khắc phục điều này người dùng nên hạn chế mở nhiều ứng dụng không cần thiết để tối ưu RAM có trên máy.\r\n\r\n\r\n\r\nVới bộ nhớ trong 64 GB có sẵn, realme Note 50 cho phép bạn lưu trữ nhiều dữ liệu, ảnh, video và ứng dụng mà không lo lắng về không gian. Để đảm bảo không gian lưu trữ không bao giờ là vấn đề, điện thoại hỗ trợ mở rộng dung lượng qua thẻ MicroSD lên đến 2 TB, giúp cung cấp cho bạn sự linh hoạt theo nhu cầu của mình.\r\n\r\nPin 5000 mAh đảm bảo trải nghiệm dài lâu mà không cần sạc\r\nVới pin lớn 5000 mAh, realme Note 50 là chiếc điện thoại đồng hành lý tưởng cho những người dùng yêu cầu cao về thời lượng pin. Không còn lo lắng về việc sạc điện thoại liên tục, bạn có thể thoải mái sử dụng nhiều tính năng và trải nghiệm giải trí suốt cả ngày mà không cần phải nghĩ đến việc sạc pin nhiều lần trong ngày.\r\n\r\nMặc dù không phải là sạc nhanh, nhưng sạc 10 W của realme Note 50 lại giúp điện thoại nạp năng lượng một cách từ tốn và an toàn. Với tốc độ này, việc sạc điện thoại vào lúc đi ngủ là một lựa chọn thông minh, bởi cách này giúp tránh tình trạng phải chờ đợi khi bạn thức dậy.\r\n\r\n\r\n\r\nTổng kết, realme Note 50 là một sự chọn lựa hoàn hảo cho những người đang tìm kiếm một chiếc điện thoại nổi bật với mức giá phải chăng. Không đặt quá nhiều trọng tâm vào hiệu năng và chất lượng camera, chiếc điện thoại này đáp ứng nhu cầu sử dụng hằng ngày chủ yếu như lướt web, xem phim và thực hiện cuộc gọi hay nhắn tin.realme Note 50 không chỉ nổi bật với thiết kế đẹp mắt mà còn chinh phục người dùng bằng tính linh hoạt với cổng sạc Type-C. Công nghệ này giúp tăng cường hiệu suất khi cung cấp tốc độ truyền dữ liệu, đồng thời tạo ra sự thuận lợi với khả năng kết nối hai chiều.\r\n\r\nNgoài ra, với chuẩn kháng nước và bụi IP54, chiếc điện thoại realme này tự tin đối mặt với mọi thách thức môi trường. Bạn không cần phải lo lắng khi sử dụng điện thoại dưới mưa nhỏ hoặc trong môi trường bụi bặm. realme Note 50 giúp bảo vệ thiết bị khỏi những yếu tố gây hại, mang lại sự an tâm và thoải mái khi sử dụng hằng ngày.\r\n\r\nTích hợp vân tay cạnh viền, realme Note 50 giúp trải nghiệm mở khóa trở nên tối ưu hơn. Không chỉ nhanh chóng và hiệu quả, mà còn tăng cường đáng kể về mức độ bảo mật. Việc đặt cảm biến vân tay ở cạnh viền, một vị trí thuận tiện giúp người dùng truy cập thiết bị một cách tự nhiên và nhanh chóng.Màn hình lớn sử dụng tấm nền IPS LCD\r\nrealme Note 50 được trang bị công nghệ màn hình IPS LCD, một chuẩn khá phổ biến trên các dòng điện thoại giá rẻ - tầm trung. Tấm nền này ngoài ưu điểm về giá còn giúp mang lại chất lượng hình ảnh tốt, độ sáng cao, góc nhìn rộng và màu sắc trung thực.\r\n\r\nVới độ phân giải HD+ (720 x 1600 Pixels), màn hình điện thoại vẫn đảm bảo hình ảnh rõ ràng và chi tiết, làm cho mọi trải nghiệm giải trí trở nên trung thực và sống động. Với kích thước màn hình lên đến 6.74 inch, realme Note 50 đưa người dùng vào một thế giới mở rộng, nơi mọi chi tiết trên màn hình được hiển thị một cách to rõ và dễ nhìn.', 'product_images/jugZ5U1Z75DGQGcD7NEoFSHXn8cxGHijhlBiosmK.jpg', 0, '2024-03-09 15:00:38', '2024-03-09 15:00:38'),
(20, 5, 'Oppo reno 11 pro xam', 13700000, 351, 'Thông tin sản phẩm\r\nOPPO Reno11 5G tiếp tục mang đến sự hấp dẫn cho người dùng, lấy cảm hứng từ những thành công trước đó. Điểm độc đáo của chiếc điện thoại nằm ở thiết kế thu hút, cấu hình mạnh mẽ và khả năng chụp ảnh ấn tượng. Được tạo ra để đáp ứng một loạt các nhu cầu từ giải trí, nhiếp ảnh đến công việc đòi hỏi hiệu năng cao.\r\nNổi bật nhờ thiết kế lấy cảm hứng từ thiên nhiên\r\nChắc chắn bạn sẽ thấy Reno11 5G ấn tượng ngay từ cái nhìn đầu tiên. Phiên bản này có hai màu sắc độc đáo: xanh lá nhạt và xám. Mặt lưng xanh lá nhạt được phủ lớp vân sáng, lấy cảm hứng từ biển xanh, tạo nên hiệu ứng chuyển sắc lấp lánh giống như sóng biển, làm cho chiếc điện thoại luôn nổi bật và thu hút. Trong khi đó, màu xám mang lại vẻ đẹp tinh tế và tối giản, phản ánh một phong cách sang trọng và lịch lãm.Một đặc điểm nổi bật khác của chiếc điện thoại OPPO này là cụm camera được thiết kế theo hình dáng bầu dục độc đáo, tạo điểm nhấn đặc biệt cho tổng thể thiết kế. Viền xung quanh camera được chế tác một cách tinh tế, tạo nên sự hài hòa và sang trọng, làm tăng thêm vẻ đẹp thẩm mỹ của chiếc điện thoại và khiến nó trở nên thú vị và cuốn hút hơn.Loa kép với công nghệ âm thanh tiên tiến cũng là một điểm mạnh của Reno11 5G. Âm thanh sống động, rõ ràng và mạnh mẽ mang lại trải nghiệm giải trí tuyệt vời. Mình thực sự thích chất âm mà máy mang lại, mọi thứ được tái hiện lại to rõ và trong trẻo, kể cả khi nghe ở mức âm lượng lớn cũng không có hiện tượng bị rè.Ngoài ra, Reno11 5G không chỉ là một chiếc điện thoại đẹp mắt, mà còn là một trợ thủ đáng tin cậy trong mọi hoàn cảnh. Khả năng chống nước, bụi IPX4 giúp bảo vệ thiết bị khỏi những rủi ro ngoài ý muốn, đảm bảo được độ bền để mình có thể an tâm sử dụng trong mọi hoàn cảnh như đi mưa hay vướng bụi nơi công trường, đường phố.', 'product_images/ZpK6MaV8yvqnsEvEh8ksVeYj5066bqEd1CrmGztI.jpg', 1, '2024-03-09 15:01:50', '2024-03-09 15:01:50'),
(21, 5, 'Oppo reno 10 pro grey', 10250000, 1251, 'Thông tin sản phẩm\r\nOPPO Reno11 5G tiếp tục mang đến sự hấp dẫn cho người dùng, lấy cảm hứng từ những thành công trước đó. Điểm độc đáo của chiếc điện thoại nằm ở thiết kế thu hút, cấu hình mạnh mẽ và khả năng chụp ảnh ấn tượng. Được tạo ra để đáp ứng một loạt các nhu cầu từ giải trí, nhiếp ảnh đến công việc đòi hỏi hiệu năng cao.\r\nNổi bật nhờ thiết kế lấy cảm hứng từ thiên nhiên\r\nChắc chắn bạn sẽ thấy Reno11 5G ấn tượng ngay từ cái nhìn đầu tiên. Phiên bản này có hai màu sắc độc đáo: xanh lá nhạt và xám. Mặt lưng xanh lá nhạt được phủ lớp vân sáng, lấy cảm hứng từ biển xanh, tạo nên hiệu ứng chuyển sắc lấp lánh giống như sóng biển, làm cho chiếc điện thoại luôn nổi bật và thu hút. Trong khi đó, màu xám mang lại vẻ đẹp tinh tế và tối giản, phản ánh một phong cách sang trọng và lịch lãm.Một đặc điểm nổi bật khác của chiếc điện thoại OPPO này là cụm camera được thiết kế theo hình dáng bầu dục độc đáo, tạo điểm nhấn đặc biệt cho tổng thể thiết kế. Viền xung quanh camera được chế tác một cách tinh tế, tạo nên sự hài hòa và sang trọng, làm tăng thêm vẻ đẹp thẩm mỹ của chiếc điện thoại và khiến nó trở nên thú vị và cuốn hút hơn.Loa kép với công nghệ âm thanh tiên tiến cũng là một điểm mạnh của Reno11 5G. Âm thanh sống động, rõ ràng và mạnh mẽ mang lại trải nghiệm giải trí tuyệt vời. Mình thực sự thích chất âm mà máy mang lại, mọi thứ được tái hiện lại to rõ và trong trẻo, kể cả khi nghe ở mức âm lượng lớn cũng không có hiện tượng bị rè.Ngoài ra, Reno11 5G không chỉ là một chiếc điện thoại đẹp mắt, mà còn là một trợ thủ đáng tin cậy trong mọi hoàn cảnh. Khả năng chống nước, bụi IPX4 giúp bảo vệ thiết bị khỏi những rủi ro ngoài ý muốn, đảm bảo được độ bền để mình có thể an tâm sử dụng trong mọi hoàn cảnh như đi mưa hay vướng bụi nơi công trường, đường phố.', 'product_images/WfRHUIeutyU6iJ9IWNvh7RJqiec2vmH35BlLiwhk.jpg', 1, '2024-03-09 15:02:24', '2024-03-09 15:02:24'),
(23, 5, 'Oppo reno 10 pro blue', 10250000, 357, 'Thông tin sản phẩm\r\nOPPO Reno11 5G tiếp tục mang đến sự hấp dẫn cho người dùng, lấy cảm hứng từ những thành công trước đó. Điểm độc đáo của chiếc điện thoại nằm ở thiết kế thu hút, cấu hình mạnh mẽ và khả năng chụp ảnh ấn tượng. Được tạo ra để đáp ứng một loạt các nhu cầu từ giải trí, nhiếp ảnh đến công việc đòi hỏi hiệu năng cao.\r\nNổi bật nhờ thiết kế lấy cảm hứng từ thiên nhiên\r\nChắc chắn bạn sẽ thấy Reno11 5G ấn tượng ngay từ cái nhìn đầu tiên. Phiên bản này có hai màu sắc độc đáo: xanh lá nhạt và xám. Mặt lưng xanh lá nhạt được phủ lớp vân sáng, lấy cảm hứng từ biển xanh, tạo nên hiệu ứng chuyển sắc lấp lánh giống như sóng biển, làm cho chiếc điện thoại luôn nổi bật và thu hút. Trong khi đó, màu xám mang lại vẻ đẹp tinh tế và tối giản, phản ánh một phong cách sang trọng và lịch lãm.Một đặc điểm nổi bật khác của chiếc điện thoại OPPO này là cụm camera được thiết kế theo hình dáng bầu dục độc đáo, tạo điểm nhấn đặc biệt cho tổng thể thiết kế. Viền xung quanh camera được chế tác một cách tinh tế, tạo nên sự hài hòa và sang trọng, làm tăng thêm vẻ đẹp thẩm mỹ của chiếc điện thoại và khiến nó trở nên thú vị và cuốn hút hơn.Loa kép với công nghệ âm thanh tiên tiến cũng là một điểm mạnh của Reno11 5G. Âm thanh sống động, rõ ràng và mạnh mẽ mang lại trải nghiệm giải trí tuyệt vời. Mình thực sự thích chất âm mà máy mang lại, mọi thứ được tái hiện lại to rõ và trong trẻo, kể cả khi nghe ở mức âm lượng lớn cũng không có hiện tượng bị rè.Ngoài ra, Reno11 5G không chỉ là một chiếc điện thoại đẹp mắt, mà còn là một trợ thủ đáng tin cậy trong mọi hoàn cảnh. Khả năng chống nước, bụi IPX4 giúp bảo vệ thiết bị khỏi những rủi ro ngoài ý muốn, đảm bảo được độ bền để mình có thể an tâm sử dụng trong mọi hoàn cảnh như đi mưa hay vướng bụi nơi công trường, đường phố.', 'product_images/NacK4YIRcTiarLotD1gEEkh86JUACx0cuc29ofJq.jpg', 0, '2024-03-09 15:03:32', '2024-03-09 15:03:32'),
(24, 7, 'Oppo reno 8 pro đen 256GB', 6830000, 122, 'Thông tin sản phẩm\r\nOPPO Reno11 5G tiếp tục mang đến sự hấp dẫn cho người dùng, lấy cảm hứng từ những thành công trước đó. Điểm độc đáo của chiếc điện thoại nằm ở thiết kế thu hút, cấu hình mạnh mẽ và khả năng chụp ảnh ấn tượng. Được tạo ra để đáp ứng một loạt các nhu cầu từ giải trí, nhiếp ảnh đến công việc đòi hỏi hiệu năng cao.\r\nNổi bật nhờ thiết kế lấy cảm hứng từ thiên nhiên\r\nChắc chắn bạn sẽ thấy Reno11 5G ấn tượng ngay từ cái nhìn đầu tiên. Phiên bản này có hai màu sắc độc đáo: xanh lá nhạt và xám. Mặt lưng xanh lá nhạt được phủ lớp vân sáng, lấy cảm hứng từ biển xanh, tạo nên hiệu ứng chuyển sắc lấp lánh giống như sóng biển, làm cho chiếc điện thoại luôn nổi bật và thu hút. Trong khi đó, màu xám mang lại vẻ đẹp tinh tế và tối giản, phản ánh một phong cách sang trọng và lịch lãm.Một đặc điểm nổi bật khác của chiếc điện thoại OPPO này là cụm camera được thiết kế theo hình dáng bầu dục độc đáo, tạo điểm nhấn đặc biệt cho tổng thể thiết kế. Viền xung quanh camera được chế tác một cách tinh tế, tạo nên sự hài hòa và sang trọng, làm tăng thêm vẻ đẹp thẩm mỹ của chiếc điện thoại và khiến nó trở nên thú vị và cuốn hút hơn.Loa kép với công nghệ âm thanh tiên tiến cũng là một điểm mạnh của Reno11 5G. Âm thanh sống động, rõ ràng và mạnh mẽ mang lại trải nghiệm giải trí tuyệt vời. Mình thực sự thích chất âm mà máy mang lại, mọi thứ được tái hiện lại to rõ và trong trẻo, kể cả khi nghe ở mức âm lượng lớn cũng không có hiện tượng bị rè.Ngoài ra, Reno11 5G không chỉ là một chiếc điện thoại đẹp mắt, mà còn là một trợ thủ đáng tin cậy trong mọi hoàn cảnh. Khả năng chống nước, bụi IPX4 giúp bảo vệ thiết bị khỏi những rủi ro ngoài ý muốn, đảm bảo được độ bền để mình có thể an tâm sử dụng trong mọi hoàn cảnh như đi mưa hay vướng bụi nơi công trường, đường phố.', 'product_images/vs7dlsZMIlqFHC0ehU4W6UJnkUDMMq8CxcfwvoTs.jpg', 0, '2024-03-09 15:03:57', '2024-04-22 07:31:28'),
(47, 6, 'IPHONE XXX update', 135789, 13567, 'IPHONE XXX chưa ra', 'product_images/a963a55ae5346200564ea06e002bd802derick-anies-hDJT_ERrB-w-unsplash.jpg', 0, '2024-04-03 08:29:13', '2024-04-03 10:08:38');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `product_review_id` bigint(20) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `rate` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`product_review_id`, `product_id`, `email`, `content`, `rate`, `status`, `created_at`, `updated_at`) VALUES
(1, 20, 'vuductien@gmail.com', 'Sản phẩm tệ', 3, 1, '2024-09-04 04:41:53', '2024-09-04 04:41:53'),
(2, 9, 'demo@gmail.com', 'sản phẩm tốt', 5, 1, '2024-09-04 04:54:15', '2024-09-04 04:54:15');

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `promotion_id` bigint(20) UNSIGNED NOT NULL,
  `promotion_code` varchar(250) NOT NULL,
  `promotion_name` varchar(250) NOT NULL,
  `value` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT 1,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Thời điểm tạo',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Thời điểm cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `image`, `email`, `password`, `address`, `phone`, `gender`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'users_images/eb8a2d4755e2a40199734c1d150beba0tomas-stanislavsky-9PRQ44avKik-unsplash.jpg', 'admin@admin.com', '$2y$10$ZR5v8ErSmARLbbj51tGMNOCB9pbM4gp5zGMBP6zvedq8Z0qKdYL7G', 'An adminstrator with experience have been trained in difficult enviroment .', '04758275026', 1, 'admin', '2024-03-09 13:59:15', '2024-04-22 07:25:33'),
(3, 'Nỡ phạm thị', 'users_images/c78a039f04487c3ce2b9bccec4c2fa8dtomas-stanislavsky-9PRQ44avKik-unsplash.jpg', 'npt@gmail.com', '$2y$10$o0lplGBq7RChpbDZudMIrue19Y4aLTBV9dpmdbt5ne7dUdbq2BcoK', 'Cần Thơ Viêt Nam', '1234567890', 0, 'user', '2024-04-04 05:26:08', '2024-04-22 07:13:39'),
(8, 'pham tuan', 'users_images/7ef697e3d49b9674e0e891ddb45be240thought-catalog-505eectW54k-unsplash.jpg', 'tuan@gmail.com', '$2y$10$pQhfBQ1qXR7XXgWDCDA98ukLaSBFZu3tdVA.ePnIdkD9ojZ3Yifjm', 'TP Hcm', '0985748573', 1, 'admin', '2024-05-09 09:01:33', '2024-05-09 09:01:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `carts_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`cart_detail_id`),
  ADD KEY `cart_details_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_details_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conversation.customer` (`customer_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message.conversation` (`cvs_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`),
  ADD KEY `promotion_id` (`promotion_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `products_cat_id_foreign` (`cat_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`product_review_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`promotion_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `cart_detail_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_detail_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `product_review_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `promotion_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Constraints for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD CONSTRAINT `cart_details_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`cart_id`),
  ADD CONSTRAINT `cart_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `conversation.customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `message.conversation` FOREIGN KEY (`cvs_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`promotion_id`) REFERENCES `promotions` (`promotion_id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_id`);

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

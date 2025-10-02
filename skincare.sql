-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 02, 2025 at 11:03 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skincare`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@example.com', '$2y$12$C1PTh0N//YwcnsgO0oS6SOGhVztXnylVqNTQ9zqesvQOdDfZ3SCES', NULL, '2025-10-02 10:40:30', '2025-10-02 10:40:30');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'acne', 'This category is for Acne', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(2, 'hyperpigmentation', 'This category is for Hyperpigmentation', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(3, 'brightening', 'This category is for Brightening', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(4, 'cleanser & makeup remover', 'This category is for Cleanser & Makeup Remover', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(5, 'moisturizer', 'This category is for Moisturizer', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(6, 'makeup', 'This category is for Makeup', '2025-10-02 10:40:31', '2025-10-02 10:40:31');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_23_152155_create_categories_table', 1),
(5, '2025_09_23_152229_create_admins_table', 1),
(6, '2025_09_23_152249_create_orders_table', 1),
(7, '2025_09_23_152310_create_payments_table', 1),
(8, '2025_09_23_152519_create_products_table', 1),
(9, '2025_09_23_152542_create_reviews_table', 1),
(10, '2025_09_23_152602_create_order_items_table', 1),
(11, '2025_09_23_152620_add_street_and_city_to_users_table', 1),
(12, '2025_09_23_152704_add_brand_to_products_table', 1),
(13, '2025_09_23_162650_add_two_factor_columns_to_users_table', 1),
(14, '2025_09_29_093306_create_personal_access_tokens_table', 1),
(15, '2025_10_02_065507_create_favourites_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `totalamount` decimal(10,2) NOT NULL,
  `orderdate` datetime NOT NULL DEFAULT '2025-10-02 16:10:29',
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `totalamount`, `orderdate`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 1488.81, '2016-04-18 08:11:00', 'cancelled', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(2, 6, 2449.85, '2018-05-02 22:36:22', 'pending', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(3, 6, 282.58, '2016-04-20 04:46:38', 'completed', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(4, 6, 2130.02, '2023-10-31 01:11:46', 'pending', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(5, 6, 605.69, '1992-03-15 17:38:47', 'completed', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(6, 6, 995.40, '2000-01-09 07:14:28', 'completed', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(7, 6, 3062.42, '1974-05-25 08:52:40', 'completed', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(8, 6, 1450.74, '1999-01-19 14:34:03', 'cancelled', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(9, 6, 550.94, '1999-04-10 12:13:29', 'completed', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(10, 6, 2423.33, '2001-05-18 08:51:46', 'completed', '2025-10-02 10:40:31', '2025-10-02 10:40:31');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 20, 3, 496.27, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(2, 2, 2, 2, 133.70, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(3, 2, 2, 4, 469.42, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(4, 2, 2, 1, 304.77, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(5, 3, 29, 1, 282.58, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(6, 4, 22, 1, 121.82, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(7, 4, 22, 5, 352.46, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(8, 4, 22, 1, 245.90, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(9, 5, 18, 2, 51.07, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(10, 5, 18, 1, 76.71, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(11, 5, 18, 4, 106.71, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(12, 6, 15, 4, 248.85, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(13, 7, 30, 4, 13.19, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(14, 7, 30, 5, 285.90, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(15, 7, 30, 4, 395.04, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(16, 8, 18, 4, 101.09, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(17, 8, 18, 2, 453.79, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(18, 8, 18, 5, 27.76, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(19, 9, 17, 5, 97.80, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(20, 9, 17, 2, 30.97, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(21, 10, 3, 1, 369.19, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(22, 10, 3, 1, 489.34, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(23, 10, 3, 4, 391.20, '2025-10-02 10:40:31', '2025-10-02 10:40:31');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending',
  `payment_date` datetime NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `payment_method`, `payment_status`, `payment_date`, `payment_amount`, `created_at`, `updated_at`) VALUES
(1, 1, 'cash', 'failed', '2022-10-06 05:31:31', 1488.81, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(2, 2, 'cash', 'paid', '2021-01-08 18:26:59', 2449.85, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(3, 3, 'cash', 'failed', '2005-04-01 11:26:34', 282.58, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(4, 4, 'card', 'pending', '1991-11-30 06:38:44', 2130.02, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(5, 5, 'cash', 'paid', '2016-05-27 19:37:24', 605.69, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(6, 6, 'card', 'paid', '1997-08-30 11:16:08', 995.40, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(7, 7, 'cash', 'pending', '2009-07-18 14:55:08', 3062.42, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(8, 8, 'cash', 'paid', '1983-01-08 14:55:38', 1450.74, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(9, 9, 'cash', 'pending', '2003-04-23 08:33:09', 550.94, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(10, 10, 'card', 'pending', '2005-02-17 05:16:11', 2423.33, '2025-10-02 10:40:31', '2025-10-02 10:40:31');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `brand`, `description`, `price`, `stock`, `image`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Acne Product', 'Haag, Corkery and Langworth', 'Default description', 100.00, 0, 'img/products/acne1.jpg', 1, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(2, 'Acne Product', 'Reichert PLC', 'Default description', 100.00, 0, 'img/products/acne2.jpg', 1, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(3, 'Acne Product', 'Brekke, Cole and Renner', 'Default description', 100.00, 0, 'img/products/acne3.jpg', 1, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(4, 'Acne Product', 'Quitzon-Heidenreich', 'Default description', 100.00, 0, 'img/products/acne4.jpg', 1, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(5, 'Acne Product', 'Ruecker Inc', 'Default description', 100.00, 0, 'img/products/acne5.jpg', 1, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(6, 'Hyperpigmentation Product', 'Mueller-Upton', 'Default description', 100.00, 0, 'img/products/hype1.jpg', 2, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(7, 'Hyperpigmentation Product', 'Hauck, Konopelski and Zemlak', 'Default description', 100.00, 0, 'img/products/hype2.jpg', 2, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(8, 'Hyperpigmentation Product', 'Botsford, Schneider and Davis', 'Default description', 100.00, 0, 'img/products/hype3.jpg', 2, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(9, 'Hyperpigmentation Product', 'Price, Goyette and Hintz', 'Default description', 100.00, 0, 'img/products/hype4.jpg', 2, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(10, 'Hyperpigmentation Product', 'Crist, Feest and Greenholt', 'Default description', 100.00, 0, 'img/products/hype5.jpg', 2, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(11, 'Brightening Product', 'Pfeffer Group', 'Default description', 100.00, 0, 'img/products/bri1.jpg', 3, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(12, 'Brightening Product', 'Lemke Group', 'Default description', 100.00, 0, 'img/products/bri2.jpg', 3, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(13, 'Brightening Product', 'Grimes-Gulgowski', 'Default description', 100.00, 0, 'img/products/bri3.jpg', 3, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(14, 'Brightening Product', 'Langosh, Streich and Batz', 'Default description', 100.00, 0, 'img/products/bri4.jpg', 3, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(15, 'Brightening Product', 'Ledner-Rodriguez', 'Default description', 100.00, 0, 'img/products/bri5.jpg', 3, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(16, 'Cleanser & Makeup Remover Product', 'Hegmann Ltd', 'Default description', 100.00, 0, 'img/products/cl1.jpg', 4, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(17, 'Cleanser & Makeup Remover Product', 'Lubowitz, Schoen and Grimes', 'Default description', 100.00, 0, 'img/products/cl2.jpg', 4, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(18, 'Cleanser & Makeup Remover Product', 'Schaden-Jerde', 'Default description', 100.00, 0, 'img/products/cl3.jpg', 4, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(19, 'Cleanser & Makeup Remover Product', 'Goyette, Ondricka and Littel', 'Default description', 100.00, 0, 'img/products/cl4.jpg', 4, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(20, 'Cleanser & Makeup Remover Product', 'Mohr Ltd', 'Default description', 100.00, 0, 'img/products/cl5.jpg', 4, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(21, 'Moisturizer Product', 'Willms LLC', 'Default description', 100.00, 0, 'img/products/m1.jpg', 5, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(22, 'Moisturizer Product', 'Leffler, Lowe and Towne', 'Default description', 100.00, 0, 'img/products/m2.jpg', 5, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(23, 'Moisturizer Product', 'Marvin-Ortiz', 'Default description', 100.00, 0, 'img/products/m3.jpg', 5, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(24, 'Moisturizer Product', 'Cartwright-Senger', 'Default description', 100.00, 0, 'img/products/m4.jpg', 5, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(25, 'Moisturizer Product', 'Brekke-Hammes', 'Default description', 100.00, 0, 'img/products/m5.jpg', 5, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(26, 'Makeup Product', 'Howe-Frami', 'Default description', 100.00, 0, 'img/products/mk1.jpg', 6, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(27, 'Makeup Product', 'Hayes Inc', 'Default description', 100.00, 0, 'img/products/mk2.jpg', 6, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(28, 'Makeup Product', 'Torphy, Wiegand and Jerde', 'Default description', 100.00, 0, 'img/products/mk3.jpg', 6, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(29, 'Makeup Product', 'Bashirian-Waters', 'Default description', 100.00, 0, 'img/products/mk4.jpg', 6, '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(30, 'Makeup Product', 'Tremblay, Waelchi and Boyle', 'Default description', 100.00, 0, 'img/products/mk5.jpg', 6, '2025-10-02 10:40:31', '2025-10-02 10:40:31');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(4) NOT NULL DEFAULT 5,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `order_id`, `product_id`, `user_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 2, 2, 'Autem aperiam et id sunt nobis quo.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(2, NULL, 1, 3, 2, 'Incidunt eveniet quis quis.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(3, NULL, 1, 4, 5, 'Tempora atque aspernatur quasi et omnis aut.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(4, NULL, 1, 8, 1, 'Autem totam et beatae laborum.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(5, NULL, 1, 6, 3, 'Minima voluptatem perspiciatis id incidunt hic.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(6, NULL, 2, 6, 1, 'Deserunt ad veniam excepturi est placeat.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(7, NULL, 2, 2, 2, 'Corporis voluptate neque distinctio sed voluptatem eius.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(8, NULL, 2, 10, 1, 'Id dolorem debitis quia natus.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(9, NULL, 3, 4, 5, 'Et tempore voluptatem in ut sit non.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(10, NULL, 3, 7, 5, 'Sed non distinctio qui veritatis aut.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(11, NULL, 3, 6, 2, 'Dicta qui ex dolores eligendi quibusdam molestias amet.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(12, NULL, 4, 1, 5, 'Deleniti amet assumenda architecto praesentium minus reiciendis nam.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(13, NULL, 4, 2, 1, 'Illum quo laborum dolores ut culpa nesciunt est voluptas.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(14, NULL, 4, 10, 1, 'Reprehenderit sint fuga repellat sit voluptas.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(15, NULL, 4, 10, 1, 'Ut veniam consequuntur dolorem possimus et.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(16, NULL, 5, 6, 4, 'Quia unde qui cum ut rerum cum.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(17, NULL, 5, 8, 5, 'Laudantium consequatur omnis provident similique laudantium itaque molestias.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(18, NULL, 5, 8, 4, 'Aut nam molestiae quam porro pariatur.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(19, NULL, 5, 7, 4, 'Saepe inventore aspernatur dolores ut quidem sint.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(20, NULL, 6, 2, 4, 'Molestiae vel illum porro eius sint quis.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(21, NULL, 7, 9, 2, 'Aut autem tenetur sit rerum commodi aut eos.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(22, NULL, 7, 3, 2, 'Aliquid repellendus nihil consectetur consequatur.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(23, NULL, 7, 1, 5, 'Quibusdam vel aut pariatur fuga eum quo.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(24, NULL, 7, 6, 2, 'Veritatis molestias aliquid quia soluta ducimus.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(25, NULL, 7, 5, 4, 'Ducimus qui saepe dolores corporis.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(26, NULL, 8, 3, 1, 'Omnis necessitatibus nihil molestiae natus dolor.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(27, NULL, 8, 10, 4, 'Dolorem consequatur veniam et tenetur esse non nisi.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(28, NULL, 8, 2, 2, 'Molestiae omnis et sunt architecto velit a voluptates ut.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(29, NULL, 9, 2, 4, 'Omnis ut aut doloremque eos.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(30, NULL, 9, 2, 3, 'Asperiores at voluptatem et dignissimos necessitatibus.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(31, NULL, 9, 4, 5, 'Repellat et ipsum nostrum voluptatum doloribus aut.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(32, NULL, 9, 7, 4, 'Impedit quis rerum sed debitis deleniti nesciunt inventore.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(33, NULL, 10, 2, 2, 'Doloremque quia a enim.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(34, NULL, 10, 7, 1, 'Praesentium fugit hic occaecati veritatis autem temporibus aut.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(35, NULL, 10, 8, 4, 'Consectetur laborum est repellendus doloribus excepturi sint dolores autem.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(36, NULL, 11, 8, 5, 'Nobis et vitae aut enim voluptatem beatae.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(37, NULL, 11, 6, 2, 'Magnam fugit necessitatibus laboriosam atque aut repudiandae.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(38, NULL, 11, 10, 4, 'Dolores blanditiis sed numquam totam.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(39, NULL, 12, 4, 5, 'Aliquid maxime facilis aut similique.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(40, NULL, 12, 3, 4, 'Dolorem dolorem provident ipsam fugiat et.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(41, NULL, 12, 5, 2, 'Dolorum et enim magnam et qui aut.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(42, NULL, 12, 9, 2, 'Voluptatem molestias minima non ut.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(43, NULL, 13, 2, 3, 'Quisquam ut aut natus sunt adipisci dolorem hic.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(44, NULL, 13, 8, 3, 'Error sint corporis quo aliquam est modi.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(45, NULL, 13, 8, 2, 'Rerum maxime omnis maxime nobis incidunt officiis dolores ex.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(46, NULL, 13, 10, 2, 'Earum consectetur consectetur qui accusantium beatae cupiditate.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(47, NULL, 13, 9, 4, 'Et sit rem assumenda adipisci eius rerum porro aliquid.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(48, NULL, 14, 7, 1, 'Pariatur omnis quam minus nihil sint.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(49, NULL, 14, 4, 5, 'Quam ducimus ea omnis sed.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(50, NULL, 14, 8, 3, 'Distinctio dolorem deleniti asperiores reprehenderit error exercitationem.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(51, NULL, 14, 6, 2, 'Eligendi sit consequatur animi excepturi fugiat autem minus dolorem.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(52, NULL, 15, 7, 4, 'Deleniti doloribus sit id sunt.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(53, NULL, 15, 9, 4, 'Aut provident impedit iure veniam non officiis.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(54, NULL, 16, 10, 4, 'Sunt accusamus illum laboriosam ut ipsa.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(55, NULL, 16, 8, 5, 'Voluptas ipsum rerum ea qui quisquam.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(56, NULL, 16, 1, 1, 'Amet voluptas laborum accusantium voluptatibus.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(57, NULL, 16, 8, 4, 'Nisi iure quia ut quia eum.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(58, NULL, 16, 8, 5, 'Quia corporis eveniet ut aut quidem nihil.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(59, NULL, 17, 8, 3, 'Quibusdam et aut sunt magnam deleniti saepe sequi.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(60, NULL, 17, 7, 2, 'Soluta animi excepturi architecto in animi.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(61, NULL, 17, 5, 4, 'Eos consequatur earum laudantium quo sunt porro aut.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(62, NULL, 17, 9, 5, 'Sit aut culpa fugit maiores dicta quia asperiores quam.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(63, NULL, 18, 4, 3, 'Molestiae corporis nihil recusandae consequatur perferendis.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(64, NULL, 18, 2, 1, 'Laboriosam dolores veritatis et minima numquam atque provident laudantium.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(65, NULL, 18, 1, 5, 'Voluptatem doloremque sit recusandae labore explicabo.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(66, NULL, 18, 1, 4, 'Omnis dicta occaecati soluta aliquam fugiat.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(67, NULL, 18, 3, 2, 'Ut laudantium alias magnam asperiores.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(68, NULL, 19, 5, 1, 'Error quia aliquid nobis recusandae non corporis est.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(69, NULL, 19, 6, 4, 'Quae dolores et illum et.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(70, NULL, 19, 1, 4, 'Recusandae aut qui mollitia neque.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(71, NULL, 19, 2, 1, 'Nam eius sit harum natus non.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(72, NULL, 19, 2, 4, 'Voluptas quia vero rerum dolorem ea.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(73, NULL, 20, 5, 4, 'Ut sit distinctio earum sed perferendis.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(74, NULL, 20, 2, 3, 'Eos quos sit nostrum magnam quaerat ut consectetur.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(75, NULL, 20, 7, 5, 'Voluptas non a suscipit aut dignissimos accusamus.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(76, NULL, 20, 4, 2, 'Qui cumque corporis eveniet blanditiis quia repudiandae.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(77, NULL, 20, 1, 2, 'Placeat aperiam numquam et quia voluptas.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(78, NULL, 21, 3, 5, 'Aspernatur consequatur et asperiores ratione explicabo non.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(79, NULL, 21, 8, 2, 'Tempora nemo sit aspernatur qui beatae.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(80, NULL, 21, 9, 3, 'Provident fuga ad magnam illum voluptatem aspernatur.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(81, NULL, 22, 10, 1, 'Et labore ut labore numquam aliquid quia.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(82, NULL, 23, 6, 2, 'Voluptatem repellendus repudiandae delectus possimus.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(83, NULL, 23, 3, 5, 'Magnam molestias libero vero commodi expedita numquam.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(84, NULL, 24, 5, 4, 'Iure iure facere et aut.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(85, NULL, 24, 7, 3, 'Provident et officiis sit quae magni.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(86, NULL, 24, 8, 5, 'Iure blanditiis optio dolorum velit.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(87, NULL, 24, 7, 1, 'Vel quia ut fugiat cumque eligendi.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(88, NULL, 25, 7, 5, 'Reiciendis amet quis officiis.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(89, NULL, 25, 1, 2, 'Tempore vitae architecto sint sed asperiores voluptates.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(90, NULL, 25, 3, 1, 'Reiciendis atque odit quo unde earum.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(91, NULL, 25, 10, 3, 'Sit minima dolorem voluptatem.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(92, NULL, 25, 8, 1, 'Est deserunt sed reprehenderit a sint aliquam.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(93, NULL, 26, 10, 1, 'Et rem pariatur voluptas est.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(94, NULL, 26, 9, 5, 'Alias sunt dolor qui ut corrupti non.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(95, NULL, 26, 3, 2, 'Omnis qui rerum vero vitae tempora voluptatem doloremque ullam.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(96, NULL, 27, 3, 5, 'Quam earum alias quo dolor rerum excepturi velit.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(97, NULL, 27, 3, 1, 'Et enim et reiciendis saepe temporibus a consectetur.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(98, NULL, 27, 4, 3, 'Velit est incidunt tempore repellat unde.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(99, NULL, 28, 5, 5, 'Esse odit fuga est repellat rerum.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(100, NULL, 28, 10, 4, 'Est qui autem esse omnis ipsa magni ut.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(101, NULL, 28, 1, 2, 'Quasi quos vitae ut autem eius.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(102, NULL, 29, 5, 1, 'Nam et natus quia ullam ut voluptatem.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(103, NULL, 29, 2, 4, 'Laboriosam accusamus ipsa ratione sed.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(104, NULL, 30, 1, 4, 'Voluptatem quia at ex exercitationem ullam nostrum.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(105, NULL, 30, 3, 3, 'Ipsum aut ad vel natus quia ut.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(106, NULL, 30, 7, 2, 'Est eius error unde aliquam consequatur voluptate consequatur.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(107, NULL, 30, 2, 1, 'Qui ad laudantium soluta dolorem omnis dicta blanditiis omnis.', '2025-10-02 10:40:31', '2025-10-02 10:40:31'),
(108, NULL, 1, 10, 2, 'Quisquam quo nulla tempore rem sapiente suscipit.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(109, NULL, 1, 7, 4, 'In magni qui commodi qui provident.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(110, NULL, 1, 2, 5, 'Non at qui eos numquam illo.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(111, NULL, 2, 2, 3, 'Accusamus eligendi dolorem laudantium similique cum dolores quo laudantium.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(112, NULL, 2, 9, 5, 'Animi qui dolores enim veritatis alias dolorem.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(113, NULL, 2, 1, 4, 'Quia repellat earum sint ut ut modi quod quaerat.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(114, NULL, 2, 9, 4, 'Aperiam magni amet nulla ratione voluptas.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(115, NULL, 3, 2, 3, 'Enim dolorum minima et vel blanditiis.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(116, NULL, 3, 9, 5, 'Laudantium qui aut rerum.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(117, NULL, 3, 3, 4, 'Molestiae dolorem quam et ut sequi distinctio.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(118, NULL, 3, 8, 5, 'Sint sit aut unde dicta porro.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(119, NULL, 4, 3, 1, 'Ad dicta adipisci est ab sequi iure non.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(120, NULL, 4, 9, 5, 'Beatae sed consequatur consectetur totam iusto quidem.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(121, NULL, 4, 5, 4, 'Qui rerum eos odio id est.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(122, NULL, 4, 7, 5, 'Quia ut eum provident dolores saepe culpa temporibus.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(123, NULL, 4, 10, 1, 'Quis ratione corrupti et.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(124, NULL, 5, 10, 1, 'Non nisi vitae eaque veritatis magnam numquam et.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(125, NULL, 5, 5, 2, 'Qui qui itaque voluptatum eum itaque magni error amet.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(126, NULL, 5, 2, 1, 'Voluptate sapiente dolor magni deserunt odio inventore aperiam quis.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(127, NULL, 5, 3, 1, 'Iure commodi eos veniam aspernatur.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(128, NULL, 6, 10, 1, 'Saepe qui dolorem voluptatem impedit sapiente quia fugiat.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(129, NULL, 6, 6, 5, 'Occaecati quod sequi et.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(130, NULL, 7, 10, 3, 'Est omnis vel quasi commodi eveniet ipsa.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(131, NULL, 7, 7, 1, 'Laborum cumque non eum corporis.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(132, NULL, 7, 1, 1, 'At architecto vitae distinctio.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(133, NULL, 8, 7, 3, 'Eveniet soluta et ipsa illum vel eos.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(134, NULL, 8, 10, 1, 'Ut nostrum ut eum est.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(135, NULL, 8, 4, 1, 'Id reprehenderit tempore velit commodi dolores autem.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(136, NULL, 8, 3, 4, 'Quia facilis consequatur consequatur consequuntur nulla officia quod.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(137, NULL, 9, 3, 3, 'Inventore beatae consectetur deserunt sit qui.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(138, NULL, 9, 2, 4, 'Et laboriosam occaecati qui repellat.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(139, NULL, 9, 5, 5, 'Nemo consequatur voluptatem voluptatem.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(140, NULL, 9, 9, 2, 'Enim veniam neque id voluptatum unde.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(141, NULL, 10, 4, 1, 'Dicta sint id laborum commodi.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(142, NULL, 11, 7, 3, 'Sint nisi et ad.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(143, NULL, 12, 10, 1, 'Nam voluptatibus esse aut expedita.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(144, NULL, 12, 2, 5, 'Fugit nostrum delectus vel aliquid alias.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(145, NULL, 12, 3, 1, 'Provident quaerat qui omnis et aliquid.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(146, NULL, 12, 7, 5, 'Quia officiis iusto veritatis distinctio dolores illo qui.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(147, NULL, 12, 2, 2, 'Repudiandae aut sit enim voluptates sit vel perferendis.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(148, NULL, 13, 4, 1, 'Magni ut alias repudiandae tempora repellat similique qui harum.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(149, NULL, 13, 4, 5, 'Qui est debitis sapiente ullam ut.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(150, NULL, 14, 9, 3, 'Qui enim est ea sed aut est sed.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(151, NULL, 14, 5, 1, 'Soluta amet omnis a.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(152, NULL, 14, 7, 2, 'Ea laborum fugiat quia sit delectus pariatur.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(153, NULL, 15, 10, 4, 'Perferendis voluptatem qui maiores vitae et sunt.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(154, NULL, 15, 10, 5, 'Qui ad quisquam accusamus voluptatem vel.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(155, NULL, 15, 5, 3, 'Nisi at corrupti omnis impedit voluptatem quos eos.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(156, NULL, 15, 3, 3, 'Tenetur quam reprehenderit consequatur.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(157, NULL, 16, 9, 5, 'Quod et et eos ullam.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(158, NULL, 16, 4, 2, 'Laboriosam repellat nihil nulla quos.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(159, NULL, 16, 9, 2, 'Sed nemo reiciendis qui et odit autem.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(160, NULL, 16, 2, 3, 'Laudantium tempora labore voluptas odit quas voluptatem.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(161, NULL, 16, 1, 3, 'Nam doloremque fuga aut esse esse maxime necessitatibus.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(162, NULL, 17, 4, 1, 'Ut quo voluptatem est sit doloribus iusto suscipit est.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(163, NULL, 17, 6, 1, 'Qui sint qui at provident at voluptatum.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(164, NULL, 17, 7, 3, 'Qui dolore ducimus aliquam aut itaque vel.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(165, NULL, 17, 9, 5, 'Rerum in voluptatem aut.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(166, NULL, 17, 8, 4, 'Unde eum esse beatae possimus.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(167, NULL, 18, 3, 3, 'Sint minus magni ratione magni delectus.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(168, NULL, 18, 7, 3, 'Numquam neque est sed dignissimos eius qui.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(169, NULL, 18, 7, 2, 'Esse ut repellat labore labore numquam velit rem.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(170, NULL, 19, 5, 3, 'Voluptatem officiis quam in maxime.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(171, NULL, 19, 6, 3, 'Adipisci omnis sunt et doloribus.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(172, NULL, 20, 9, 4, 'Et quia tempore optio et iusto.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(173, NULL, 20, 7, 5, 'Possimus fuga aliquid molestiae voluptas.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(174, NULL, 20, 10, 1, 'Ut ad non dolorum corrupti non totam totam.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(175, NULL, 20, 1, 4, 'Ab minus quo omnis quia.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(176, NULL, 20, 5, 1, 'Rem praesentium ex ea incidunt accusamus dicta saepe.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(177, NULL, 21, 7, 5, 'Voluptate asperiores cupiditate earum qui aliquam quasi facilis debitis.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(178, NULL, 21, 2, 5, 'Aut architecto cumque eveniet reiciendis.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(179, NULL, 21, 3, 3, 'Velit iure ea est amet ut dolorum qui ullam.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(180, NULL, 21, 10, 1, 'Libero qui voluptas occaecati dolores soluta temporibus iusto.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(181, NULL, 22, 7, 5, 'Dolor vel non vitae sed sequi facere.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(182, NULL, 22, 7, 4, 'Sapiente accusantium sit velit non architecto ex.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(183, NULL, 22, 2, 2, 'Sequi dicta velit voluptatum dignissimos ut.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(184, NULL, 22, 8, 1, 'Architecto ut fugit sint cupiditate at qui sequi.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(185, NULL, 22, 10, 3, 'Doloribus quo neque quisquam quo hic possimus.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(186, NULL, 23, 10, 1, 'Aperiam voluptatem qui eligendi amet animi.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(187, NULL, 23, 6, 5, 'Assumenda enim consequatur et autem minus.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(188, NULL, 23, 8, 2, 'Consequatur est dicta sunt nisi ullam labore quas.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(189, NULL, 23, 4, 1, 'Facilis distinctio qui vitae dicta iste.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(190, NULL, 24, 7, 4, 'Maxime modi quis excepturi recusandae.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(191, NULL, 24, 6, 4, 'Nihil repellat numquam quisquam molestiae pariatur voluptatem cumque.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(192, NULL, 25, 1, 3, 'Nostrum voluptates iste fugit ea ipsam quis dolorem.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(193, NULL, 25, 10, 2, 'Et officia eum suscipit.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(194, NULL, 25, 4, 4, 'Voluptatem velit dolor quos voluptatem cumque impedit.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(195, NULL, 25, 9, 3, 'Non omnis quia facere laborum ipsum possimus aspernatur perferendis.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(196, NULL, 25, 4, 4, 'Laboriosam doloremque quas qui vitae et perferendis quibusdam.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(197, NULL, 26, 10, 4, 'Rerum culpa aut ipsum voluptatem voluptas possimus.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(198, NULL, 26, 4, 4, 'Dolor qui ipsa impedit maxime.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(199, NULL, 26, 9, 2, 'Quis modi sint est tempora voluptas ducimus dicta nostrum.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(200, NULL, 26, 5, 1, 'Recusandae rerum et consequatur reprehenderit deserunt.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(201, NULL, 26, 4, 1, 'Ut sed rem itaque debitis voluptates.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(202, NULL, 27, 10, 2, 'Amet accusantium sequi ut sed expedita.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(203, NULL, 27, 2, 5, 'Quaerat eum dolores adipisci temporibus sunt cupiditate voluptatem.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(204, NULL, 27, 2, 1, 'Quidem doloremque quo dolorem ut quis aspernatur ad vel.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(205, NULL, 28, 8, 3, 'Quaerat necessitatibus corporis maiores eos occaecati.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(206, NULL, 28, 9, 2, 'Eligendi optio sint molestiae vel modi iusto quidem.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(207, NULL, 28, 2, 3, 'Molestiae est laboriosam in saepe et optio dolor.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(208, NULL, 29, 3, 1, 'Ducimus asperiores optio cumque veniam aut vitae.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(209, NULL, 29, 1, 4, 'Qui et est consectetur.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(210, NULL, 29, 8, 3, 'Facilis et sunt reprehenderit placeat autem.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(211, NULL, 29, 7, 2, 'Eum deleniti necessitatibus consectetur.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(212, NULL, 30, 8, 4, 'Minus perspiciatis odio est ea.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(213, NULL, 30, 2, 5, 'Eos consequatur qui ad corrupti nulla adipisci autem.', '2025-10-02 10:41:04', '2025-10-02 10:41:04'),
(214, NULL, 30, 4, 4, 'Omnis similique ducimus alias velit.', '2025-10-02 10:41:04', '2025-10-02 10:41:04');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('01krFjbTrm8ComlUJQWWMxvPT96YZbCRWKZKICdu', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSk9obFpoRWM0enNqZnpIeTBMeG9tOFlEeGlYbVpIZjNKbjFwRzd1aSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NDoiaHR0cDovLzEyNy4wLjAuMTo4MDAzL2NhdGVnb3JpZXMvbW9pc3R1cml6ZXIiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAzIjt9fQ==', 1759435382),
('EPXZLnSMcL0v3sw6BQF2DTOcFEdqgGiR8eoW17g5', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYVh1WnpQcXdBZjJKZXoxN1lFWURqbzBXQTlLVVJZYWtpOVcxeklVciI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1759428407);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `street`, `city`) VALUES
(1, 'Akeem Hahn DDS', 'borer.eugenia@example.org', '2025-10-02 10:40:30', '$2y$12$i8HhfBTdrfh.mPBtJiPVdOEv0u3fybRzh0sp0IQwaDPRnHzewmLnm', NULL, NULL, NULL, 'wVIvrm4XfV', NULL, NULL, '2025-10-02 10:40:31', '2025-10-02 10:40:31', NULL, NULL),
(2, 'Loyce VonRueden', 'mireya.okeefe@example.com', '2025-10-02 10:40:31', '$2y$12$i8HhfBTdrfh.mPBtJiPVdOEv0u3fybRzh0sp0IQwaDPRnHzewmLnm', NULL, NULL, NULL, 'XGv28Xuitl', NULL, NULL, '2025-10-02 10:40:31', '2025-10-02 10:40:31', NULL, NULL),
(3, 'Odessa Cremin', 'reed01@example.org', '2025-10-02 10:40:31', '$2y$12$i8HhfBTdrfh.mPBtJiPVdOEv0u3fybRzh0sp0IQwaDPRnHzewmLnm', NULL, NULL, NULL, 'jBOdeVtZOh', NULL, NULL, '2025-10-02 10:40:31', '2025-10-02 10:40:31', NULL, NULL),
(4, 'Dr. Oswald Strosin IV', 'thompson.jermey@example.com', '2025-10-02 10:40:31', '$2y$12$i8HhfBTdrfh.mPBtJiPVdOEv0u3fybRzh0sp0IQwaDPRnHzewmLnm', NULL, NULL, NULL, 'fNxlTbeLxg', NULL, NULL, '2025-10-02 10:40:31', '2025-10-02 10:40:31', NULL, NULL),
(5, 'Carmel Harber', 'hauck.meta@example.org', '2025-10-02 10:40:31', '$2y$12$i8HhfBTdrfh.mPBtJiPVdOEv0u3fybRzh0sp0IQwaDPRnHzewmLnm', NULL, NULL, NULL, 'w5D03qCTq7', NULL, NULL, '2025-10-02 10:40:31', '2025-10-02 10:40:31', NULL, NULL),
(6, 'Davion Watsica', 'nframi@example.com', '2025-10-02 10:40:31', '$2y$12$i8HhfBTdrfh.mPBtJiPVdOEv0u3fybRzh0sp0IQwaDPRnHzewmLnm', NULL, NULL, NULL, 'fzSDziYAH0', NULL, NULL, '2025-10-02 10:40:31', '2025-10-02 10:40:31', NULL, NULL),
(7, 'Esperanza Denesik', 'hilpert.nathan@example.com', '2025-10-02 10:40:31', '$2y$12$i8HhfBTdrfh.mPBtJiPVdOEv0u3fybRzh0sp0IQwaDPRnHzewmLnm', NULL, NULL, NULL, 'CT5akbhtXq', NULL, NULL, '2025-10-02 10:40:31', '2025-10-02 10:40:31', NULL, NULL),
(8, 'Marge Smith DVM', 'perry12@example.net', '2025-10-02 10:40:31', '$2y$12$i8HhfBTdrfh.mPBtJiPVdOEv0u3fybRzh0sp0IQwaDPRnHzewmLnm', NULL, NULL, NULL, 'UZsmDqLpKR', NULL, NULL, '2025-10-02 10:40:31', '2025-10-02 10:40:31', NULL, NULL),
(9, 'Mathilde O\'Reilly', 'gisselle46@example.net', '2025-10-02 10:40:31', '$2y$12$i8HhfBTdrfh.mPBtJiPVdOEv0u3fybRzh0sp0IQwaDPRnHzewmLnm', NULL, NULL, NULL, '6jWYzzRorM', NULL, NULL, '2025-10-02 10:40:31', '2025-10-02 10:40:31', NULL, NULL),
(10, 'Abbey Mueller', 'hintz.eleazar@example.org', '2025-10-02 10:40:31', '$2y$12$i8HhfBTdrfh.mPBtJiPVdOEv0u3fybRzh0sp0IQwaDPRnHzewmLnm', NULL, NULL, NULL, '1oqTSMKWpR', NULL, NULL, '2025-10-02 10:40:31', '2025-10-02 10:40:31', NULL, NULL),
(11, 'prabuddhi', 'prabuddhinperea@gmail.com', NULL, '$2y$12$eMBD5q.sIZ.FIypN0xf7j.YsETAxB5XBcSKxPA/1BHIJTJ06BSXFa', NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-02 13:39:59', '2025-10-02 13:39:59', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favourites_user_id_foreign` (`user_id`),
  ADD KEY `favourites_product_id_foreign` (`product_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_foreign` (`order_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_order_id_foreign` (`order_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `favourites_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favourites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

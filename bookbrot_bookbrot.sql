-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 11, 2021 at 09:12 AM
-- Server version: 10.3.29-MariaDB-cll-lve
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookbrot_bookbrot`
--

-- --------------------------------------------------------

--
-- Table structure for table `addtickets`
--

CREATE TABLE `addtickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `call_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `notes` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `internal_notes` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_archived` int(11) NOT NULL DEFAULT 0,
  `open` int(11) DEFAULT NULL,
  `close` int(11) DEFAULT NULL,
  `assign` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addtickets`
--

INSERT INTO `addtickets` (`id`, `ticket_number`, `order_number`, `user_id`, `call_type`, `product_id`, `customer_name`, `phone`, `email`, `subject`, `department_id`, `notes`, `internal_notes`, `is_archived`, `open`, `close`, `assign`, `status`, `created_at`, `updated_at`) VALUES
(1, 'TIC6610220', 'SDLC098712', 1, 'technical issue', 2, 'Chetan Sharma', '(123) 123-1231', '19chetan87sharma@gmail.com', 'This is new ticket', NULL, 'My new interaction on this ticket', 'My new interaction on this ticket internal notes', 0, 0, 0, 1, 'assign', '2021-06-10 05:01:31', '2021-06-10 10:28:27'),
(2, 'TIC9002534', 'SDLC098712', 18, 'technical issue', 1, 'sdfsdf', '(543) 423-4324', 'sdfsdfsdfe@example.net', 'fsdfsdfsdf', NULL, 'sdfsdf', 'sdfsdf', 0, 1, 0, 0, 'open', '2021-06-10 10:07:18', '2021-06-10 10:07:18');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Technical', 'Technical', NULL, NULL),
(2, 'Physical', 'Physical', NULL, NULL),
(3, 'Testte', NULL, '2021-05-29 10:06:39', '2021-05-29 10:06:39'),
(4, 'Dummy', NULL, '2021-05-29 10:06:59', '2021-05-29 10:06:59'),
(5, 'DummyDepartment', NULL, '2021-05-29 10:11:22', '2021-05-29 10:11:22'),
(6, 'Test', NULL, '2021-05-29 10:14:03', '2021-05-29 10:14:03');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `intractions`
--

CREATE TABLE `intractions` (
  `id` int(11) NOT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `ticket_number` varchar(255) DEFAULT NULL,
  `notes` text NOT NULL,
  `internal_notes` text DEFAULT NULL,
  `assignedTo` int(11) DEFAULT NULL,
  `assignedBy` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `intractions`
--

INSERT INTO `intractions` (`id`, `agent_id`, `ticket_number`, `notes`, `internal_notes`, `assignedTo`, `assignedBy`, `created_at`, `updated_at`) VALUES
(1, 1, 'TIC6610220', 'This is first interaction on this ticket.', 'This is first interaction on this ticket for internal notes.', NULL, NULL, '2021-06-10 05:01:31', '2021-06-10 05:01:31'),
(2, 1, 'TIC6610220', 'This is my another interaction on this ticket.', 'This is my another interaction on this ticket for internal notes.', NULL, NULL, '2021-06-10 05:12:50', '2021-06-10 05:12:50'),
(3, 1, 'TIC6610220', 'I am assign this ticket to agent because of I am not able to resolve this.', 'Internal notes: I am assign this ticket to agent because of I am not able to resolve this.', 18, 1, '2021-06-10 05:34:17', '2021-06-10 05:34:17'),
(4, 18, 'TIC9002534', 'sdfsdf', 'sdfsdf', NULL, NULL, '2021-06-10 10:07:18', '2021-06-10 10:07:18'),
(5, 18, 'TIC6610220', 'My new interaction on this ticket', 'My new interaction on this ticket internal notes', NULL, NULL, '2021-06-10 10:28:27', '2021-06-10 10:28:27');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_05_27_053216_create_addtickets_table', 2),
(5, '2021_05_27_073612_create_departments_table', 3),
(6, '2021_05_27_073647_create_products_table', 3),
(7, '2021_06_05_091825_create_permission_tables', 4);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_spec_sheet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `sku`, `brand_name`, `url`, `product_image`, `product_spec_sheet`, `created_at`, `updated_at`) VALUES
(1, 'Product 1', 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs.', 'sku1233', NULL, NULL, NULL, NULL, '2021-05-28 08:18:28', NULL),
(2, 'Product 2', 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs.', 'sku9341', NULL, NULL, NULL, NULL, '2021-05-28 08:18:28', NULL),
(3, 'Product 3', 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs.', 'sku3456', NULL, NULL, NULL, NULL, '2021-05-28 08:18:28', NULL),
(4, 'Product 5', 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs.', 'sku8233', NULL, NULL, NULL, NULL, '2021-05-28 08:18:28', NULL),
(5, 'Product 4', 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs.', 'sku4233', NULL, NULL, NULL, NULL, '2021-05-28 08:18:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_attachments`
--

CREATE TABLE `ticket_attachments` (
  `id` int(11) NOT NULL,
  `intraction_id` int(11) DEFAULT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `ticket_number` varchar(255) DEFAULT NULL,
  `file` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket_attachments`
--

INSERT INTO `ticket_attachments` (`id`, `intraction_id`, `agent_id`, `ticket_number`, `file`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'TIC6610220', '[\"uploads\\/1623308491_715dyh0HKyL._SL1500_.jpg\",\"uploads\\/1623308491_717Gf2ie2wL._SL1500_.jpg\"]', '2021-06-10 05:01:31', '2021-06-10 05:01:31'),
(2, 2, 1, 'TIC6610220', '[\"uploads\\/1623309170_6b3000a1-a3d3-42c7-9299-39a4dd2daf3a.__CR0,0,970,600_PT0_SX970_V1___.jpg\"]', '2021-06-10 05:12:50', '2021-06-10 05:12:50'),
(3, 3, 1, 'TIC6610220', '[\"uploads\\/1623310457_81lx6BSUjQL._SL1500_.jpg\"]', '2021-06-10 05:34:17', '2021-06-10 05:34:17'),
(4, 4, 18, 'TIC9002534', '[\"uploads\\/1623326838_717Gf2ie2wL._SL1500_.jpg\"]', '2021-06-10 10:07:18', '2021-06-10 10:07:18'),
(5, 5, 18, 'TIC6610220', '[\"uploads\\/1623328107_715dyh0HKyL._SL1500_.jpg\"]', '2021-06-10 10:28:27', '2021-06-10 10:28:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Prof. Oran Schowalter I', 'agent1@bb.org', '2021-05-31 08:47:42', '$2y$10$3u.7CvBuSIWfNgHgJY7QYe0qumNZ4R5X5JJAXY2WXhiyHSrAZG8oe', 'oPayYfJi9C', 'agent', '2021-05-31 08:47:42', '2021-05-31 08:47:42'),
(2, 'Sydnie Stroman II', 'berge.gregg@example.net', '2021-05-31 08:47:42', '$2y$10$3u.7CvBuSIWfNgHgJY7QYe0qumNZ4R5X5JJAXY2WXhiyHSrAZG8oe', 'NUGQUN1Oi7', 'agent', '2021-05-31 08:47:42', '2021-05-31 08:47:42'),
(3, 'Sonny Jacobi Jr.', 'parisian.tod@example.org', '2021-05-31 08:47:42', '$2y$10$3u.7CvBuSIWfNgHgJY7QYe0qumNZ4R5X5JJAXY2WXhiyHSrAZG8oe', 's3K7sWSpLP', 'agent', '2021-05-31 08:47:42', '2021-05-31 08:47:42'),
(4, 'Mrs. Avis Oberbrunner', 'anabelle59@example.com', '2021-05-31 08:47:42', '$2y$10$3u.7CvBuSIWfNgHgJY7QYe0qumNZ4R5X5JJAXY2WXhiyHSrAZG8oe', '89QBsjb6aA', 'agent', '2021-05-31 08:47:42', '2021-05-31 08:47:42'),
(5, 'Polly Haag', 'ogorczany@example.net', '2021-05-31 08:47:42', '$2y$10$3u.7CvBuSIWfNgHgJY7QYe0qumNZ4R5X5JJAXY2WXhiyHSrAZG8oe', '3luwjabMrR', 'agent', '2021-05-31 08:47:42', '2021-05-31 08:47:42'),
(6, 'Dante Pfeffer', 'rozella05@example.org', '2021-05-31 08:47:42', '$2y$10$3u.7CvBuSIWfNgHgJY7QYe0qumNZ4R5X5JJAXY2WXhiyHSrAZG8oe', 'QZ5OEhvs5S', 'agent', '2021-05-31 08:47:42', '2021-05-31 08:47:42'),
(7, 'Dr. Ebony Corwin', 'zhayes@example.net', '2021-05-31 08:47:42', '$2y$10$3u.7CvBuSIWfNgHgJY7QYe0qumNZ4R5X5JJAXY2WXhiyHSrAZG8oe', '7xqxcZdFhR', 'agent', '2021-05-31 08:47:42', '2021-05-31 08:47:42'),
(8, 'Torrey Veum Sr.', 'margarita96@example.net', '2021-05-31 08:47:42', '$2y$10$3u.7CvBuSIWfNgHgJY7QYe0qumNZ4R5X5JJAXY2WXhiyHSrAZG8oe', 'mDmw91zHHt', 'agent', '2021-05-31 08:47:42', '2021-05-31 08:47:42'),
(9, 'Mrs. Christa Torp V', 'rosella01@example.com', '2021-05-31 08:47:42', '$2y$10$3u.7CvBuSIWfNgHgJY7QYe0qumNZ4R5X5JJAXY2WXhiyHSrAZG8oe', 'a7D0CIIMFN', 'agent', '2021-05-31 08:47:42', '2021-05-31 08:47:42'),
(10, 'Linda Pouros', 'kobe.doyle@example.net', '2021-05-31 08:47:42', '$2y$10$3u.7CvBuSIWfNgHgJY7QYe0qumNZ4R5X5JJAXY2WXhiyHSrAZG8oe', 'At0zHiyIBY', 'agent', '2021-05-31 08:47:42', '2021-05-31 08:47:42'),
(11, 'Mr. Gilberto Howell DVM', 'flo.mertz@example.org', '2021-05-31 08:47:42', '$2y$10$3u.7CvBuSIWfNgHgJY7QYe0qumNZ4R5X5JJAXY2WXhiyHSrAZG8oe', 'NleoZsVsiI', 'agent', '2021-05-31 08:47:42', '2021-05-31 08:47:42'),
(12, 'Dr. Keyshawn Wilkinson', 'richmond.murazik@example.com', '2021-05-31 08:47:42', '$2y$10$3u.7CvBuSIWfNgHgJY7QYe0qumNZ4R5X5JJAXY2WXhiyHSrAZG8oe', 'iPA2bpWnL8', 'agent', '2021-05-31 08:47:42', '2021-05-31 08:47:42'),
(13, 'Alexander Hoeger', 'qankunding@example.org', '2021-05-31 08:47:42', '$2y$10$3u.7CvBuSIWfNgHgJY7QYe0qumNZ4R5X5JJAXY2WXhiyHSrAZG8oe', 'dsUnNMZdpV', 'agent', '2021-05-31 08:47:42', '2021-05-31 08:47:42'),
(14, 'Vada Schroeder', 'rau.icie@example.net', '2021-05-31 08:47:42', '$2y$10$3u.7CvBuSIWfNgHgJY7QYe0qumNZ4R5X5JJAXY2WXhiyHSrAZG8oe', 'cMOpaYrOfs', 'agent', '2021-05-31 08:47:42', '2021-05-31 08:47:42'),
(15, 'Milton Cole', 'xdonnelly@example.com', '2021-05-31 08:47:42', '$2y$10$3u.7CvBuSIWfNgHgJY7QYe0qumNZ4R5X5JJAXY2WXhiyHSrAZG8oe', 'loSpZtEp6N', 'agent', '2021-05-31 08:47:42', '2021-05-31 08:47:42'),
(16, 'Ahmad Bruen', 'verdie.nader@example.org', '2021-05-31 08:47:42', '$2y$10$3u.7CvBuSIWfNgHgJY7QYe0qumNZ4R5X5JJAXY2WXhiyHSrAZG8oe', 'aZXhEFkQAE', 'agent', '2021-05-31 08:47:42', '2021-05-31 08:47:42'),
(17, 'Frieda Torphy', 'jacobs.clay@example.org', '2021-05-31 08:47:42', '$2y$10$3u.7CvBuSIWfNgHgJY7QYe0qumNZ4R5X5JJAXY2WXhiyHSrAZG8oe', 'Cyjgv9Ey80', 'agent', '2021-05-31 08:47:42', '2021-05-31 08:47:42'),
(18, 'Prof. Jasper Crona', 'ygaylord@example.org', '2021-05-31 08:47:42', '$2y$10$3u.7CvBuSIWfNgHgJY7QYe0qumNZ4R5X5JJAXY2WXhiyHSrAZG8oe', 'ENHdSOFiY6', 'agent', '2021-05-31 08:47:42', '2021-05-31 08:47:42'),
(19, 'Miss Stephanie Bartoletti', 'nborer@example.com', '2021-05-31 08:47:42', '$2y$10$3u.7CvBuSIWfNgHgJY7QYe0qumNZ4R5X5JJAXY2WXhiyHSrAZG8oe', 'npgXB5L90R', 'agent', '2021-05-31 08:47:42', '2021-05-31 08:47:42'),
(20, 'Mr. Keagan Jacobi', 'monserrat.roberts@example.org', '2021-05-31 08:47:42', '$2y$10$3u.7CvBuSIWfNgHgJY7QYe0qumNZ4R5X5JJAXY2WXhiyHSrAZG8oe', '0vlqqL0e7p', 'agent', '2021-05-31 08:47:42', '2021-05-31 08:47:42'),
(21, 'Chetan', '19chetan87sharma@gmail.com', NULL, '$2y$10$3u.7CvBuSIWfNgHgJY7QYe0qumNZ4R5X5JJAXY2WXhiyHSrAZG8oe', NULL, 'agent', '2021-06-03 07:00:24', '2021-06-03 07:00:24'),
(22, 'Admin', 'sharmamanoj78@gmail.com', NULL, '$2y$10$3u.7CvBuSIWfNgHgJY7QYe0qumNZ4R5X5JJAXY2WXhiyHSrAZG8oe', NULL, 'admin', '2021-05-24 12:56:56', '2021-05-24 12:56:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addtickets`
--
ALTER TABLE `addtickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `intractions`
--
ALTER TABLE `intractions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `ticket_attachments`
--
ALTER TABLE `ticket_attachments`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `addtickets`
--
ALTER TABLE `addtickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `intractions`
--
ALTER TABLE `intractions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_attachments`
--
ALTER TABLE `ticket_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

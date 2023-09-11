-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2023 at 11:57 AM
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
-- Database: `promotion_admin_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `publisher_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `ratio` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`id`, `publisher_id`, `name`, `ratio`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Campaign 1', '0.4', 'active', '2023-08-24 06:38:32', '2023-08-24 06:38:32'),
(2, 1, 'Campaign 2', '1', 'active', '2023-08-24 08:26:07', '2023-08-24 08:26:07');

-- --------------------------------------------------------

--
-- Table structure for table `campaign_details`
--

CREATE TABLE `campaign_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `campaign_id` bigint(20) UNSIGNED NOT NULL,
  `operator_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campaign_details`
--

INSERT INTO `campaign_details` (`id`, `campaign_id`, `operator_id`, `service_id`, `url`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'http://127.0.0.1:8000/traffic/1/1/GP/01923988380', '2023-08-24 06:38:32', '2023-08-24 06:38:32'),
(2, 1, 2, 2, 'http://127.0.0.1:8000/traffic/1/2/Robi/01323174104', '2023-08-24 06:38:32', '2023-08-24 06:38:32'),
(3, 2, 1, 1, 'http://127.0.0.1/traffic/2/1/GP/{clickedID}/', '2023-08-24 08:26:07', '2023-08-24 08:26:07');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'United States', 'active', '2023-08-24 06:38:32', '2023-08-24 06:38:32'),
(2, 'United Kingdom', 'active', '2023-08-24 06:38:32', '2023-08-24 06:38:32'),
(3, 'Canada', 'active', '2023-08-24 06:38:32', '2023-08-24 06:38:32'),
(4, 'Australia', 'active', '2023-08-24 06:38:32', '2023-08-24 06:38:32'),
(5, 'New Zealand', 'active', '2023-08-24 06:38:32', '2023-08-24 06:38:32'),
(6, 'Bangladesh', 'active', '2023-08-24 06:38:32', '2023-08-24 06:38:32'),
(7, 'India', 'active', '2023-08-24 06:38:32', '2023-08-24 06:38:32'),
(8, 'Pakistan', 'active', '2023-08-24 06:38:32', '2023-08-24 06:38:32');

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
(1, '2013_10_12_000000_create_permission_tables', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_08_07_102347_create_countries_table', 1),
(7, '2023_08_07_102348_create_services_table', 1),
(8, '2023_08_07_102349_create_operators_table', 1),
(9, '2023_08_07_102350_create_publishers_table', 1),
(10, '2023_08_07_102351_create_campaigns_table', 1),
(11, '2023_08_07_102352_create_campaign_details_table', 1),
(12, '2023_08_07_102353_create_traffic_table', 1),
(13, '2023_08_07_102453_create_post_back_received_logs_table', 1),
(14, '2023_08_13_114434_create_post_back_sent_logs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2),
(1, 'App\\Models\\User', 3),
(1, 'App\\Models\\User', 4),
(1, 'App\\Models\\User', 5),
(1, 'App\\Models\\User', 6),
(1, 'App\\Models\\User', 7),
(1, 'App\\Models\\User', 8),
(1, 'App\\Models\\User', 9),
(1, 'App\\Models\\User', 10),
(1, 'App\\Models\\User', 11),
(1, 'App\\Models\\User', 12),
(1, 'App\\Models\\User', 13),
(1, 'App\\Models\\User', 14),
(1, 'App\\Models\\User', 15),
(1, 'App\\Models\\User', 16),
(1, 'App\\Models\\User', 17),
(1, 'App\\Models\\User', 18),
(1, 'App\\Models\\User', 19),
(1, 'App\\Models\\User', 20),
(1, 'App\\Models\\User', 21),
(1, 'App\\Models\\User', 22),
(2, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 8),
(3, 'App\\Models\\User', 9),
(3, 'App\\Models\\User', 10),
(3, 'App\\Models\\User', 11),
(3, 'App\\Models\\User', 12),
(3, 'App\\Models\\User', 13),
(3, 'App\\Models\\User', 14),
(3, 'App\\Models\\User', 15),
(3, 'App\\Models\\User', 16),
(3, 'App\\Models\\User', 17),
(3, 'App\\Models\\User', 18),
(3, 'App\\Models\\User', 19),
(3, 'App\\Models\\User', 20),
(3, 'App\\Models\\User', 21),
(3, 'App\\Models\\User', 22),
(4, 'App\\Models\\User', 1),
(4, 'App\\Models\\User', 2),
(4, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 5),
(4, 'App\\Models\\User', 6),
(4, 'App\\Models\\User', 7),
(4, 'App\\Models\\User', 8),
(4, 'App\\Models\\User', 9),
(4, 'App\\Models\\User', 10),
(4, 'App\\Models\\User', 11),
(4, 'App\\Models\\User', 12),
(4, 'App\\Models\\User', 13),
(4, 'App\\Models\\User', 14),
(4, 'App\\Models\\User', 15),
(4, 'App\\Models\\User', 16),
(4, 'App\\Models\\User', 17),
(4, 'App\\Models\\User', 18),
(4, 'App\\Models\\User', 19),
(4, 'App\\Models\\User', 20),
(4, 'App\\Models\\User', 21),
(4, 'App\\Models\\User', 22),
(5, 'App\\Models\\User', 1),
(6, 'App\\Models\\User', 1),
(7, 'App\\Models\\User', 1),
(8, 'App\\Models\\User', 1),
(9, 'App\\Models\\User', 1),
(10, 'App\\Models\\User', 1),
(11, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 7),
(2, 'App\\Models\\User', 8),
(2, 'App\\Models\\User', 9),
(2, 'App\\Models\\User', 10),
(2, 'App\\Models\\User', 11),
(2, 'App\\Models\\User', 12),
(2, 'App\\Models\\User', 13),
(2, 'App\\Models\\User', 14),
(2, 'App\\Models\\User', 15),
(2, 'App\\Models\\User', 16),
(2, 'App\\Models\\User', 17),
(2, 'App\\Models\\User', 18),
(2, 'App\\Models\\User', 19),
(2, 'App\\Models\\User', 20),
(2, 'App\\Models\\User', 21),
(2, 'App\\Models\\User', 22);

-- --------------------------------------------------------

--
-- Table structure for table `operators`
--

CREATE TABLE `operators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `operators`
--

INSERT INTO `operators` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'GP', 'active', '2023-08-24 06:38:31', '2023-08-24 06:38:31'),
(2, 'Robi', 'active', '2023-08-24 06:38:31', '2023-08-24 06:38:31'),
(3, 'Airtel', 'active', '2023-08-24 06:38:31', '2023-08-24 06:38:31'),
(4, 'B-link', 'active', '2023-08-24 06:38:32', '2023-08-24 06:38:32'),
(5, 'T-talk', 'active', '2023-08-24 06:38:32', '2023-08-24 06:38:32');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard', 'web', '2023-08-24 06:38:24', '2023-08-24 06:38:24'),
(2, 'user', 'web', '2023-08-24 06:38:24', '2023-08-24 06:38:24'),
(3, 'campaign', 'web', '2023-08-24 06:38:24', '2023-08-24 06:38:24'),
(4, 'traffic', 'web', '2023-08-24 06:38:24', '2023-08-24 06:38:24'),
(5, 'operator', 'web', '2023-08-24 06:38:24', '2023-08-24 06:38:24'),
(6, 'country', 'web', '2023-08-24 06:38:24', '2023-08-24 06:38:24'),
(7, 'service', 'web', '2023-08-24 06:38:24', '2023-08-24 06:38:24'),
(8, 'publisher', 'web', '2023-08-24 06:38:24', '2023-08-24 06:38:24'),
(9, 'send-logs', 'web', '2023-08-24 06:38:24', '2023-08-24 06:38:24'),
(10, 'receive-logs', 'web', '2023-08-24 06:38:24', '2023-08-24 06:38:24'),
(11, 'campaign-report', 'web', '2023-08-24 06:38:24', '2023-08-24 06:38:24');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_back_received_logs`
--

CREATE TABLE `post_back_received_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `operator_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `channel` varchar(255) NOT NULL,
  `clicked_id` varchar(255) NOT NULL,
  `others` varchar(255) DEFAULT NULL,
  `received_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_back_received_logs`
--

INSERT INTO `post_back_received_logs` (`id`, `operator_id`, `service_id`, `channel`, `clicked_id`, `others`, `received_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'marvel', '01923988380', NULL, '2023-08-24 12:39:14', '2023-08-24 06:39:14', '2023-08-24 06:39:14'),
(2, 1, 1, 'marvel', '01923988380', NULL, '2023-08-24 12:56:27', '2023-08-24 06:56:27', '2023-08-24 06:56:27');

-- --------------------------------------------------------

--
-- Table structure for table `post_back_sent_logs`
--

CREATE TABLE `post_back_sent_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `operator_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `channel` varchar(255) NOT NULL,
  `clicked_id` varchar(255) NOT NULL,
  `others` varchar(255) DEFAULT NULL,
  `sent_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_back_sent_logs`
--

INSERT INTO `post_back_sent_logs` (`id`, `operator_id`, `service_id`, `channel`, `clicked_id`, `others`, `sent_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'marvel', '01923988380', '[]', '2023-08-24 12:39:14', '2023-08-24 06:39:14', '2023-08-24 06:39:14'),
(2, 1, 1, 'marvel', '01923988380', '[]', '2023-08-24 12:56:27', '2023-08-24 06:56:27', '2023-08-24 06:56:27');

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_name` varchar(255) NOT NULL,
  `post_back_url` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`id`, `name`, `short_name`, `post_back_url`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Marvel', 'marvel', 'https://www.marvel.com/', 'active', '2023-08-24 06:38:32', '2023-08-24 06:38:32');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2023-08-24 06:38:24', '2023-08-24 06:38:24'),
(2, 'user', 'web', '2023-08-24 06:38:24', '2023-08-24 06:38:24');

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
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('daily','weekly') NOT NULL DEFAULT 'daily',
  `traffic_redirect_url` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `type`, `traffic_redirect_url`, `status`, `created_at`, `updated_at`) VALUES
(1, 'MFC', 'daily', 'http://mfc.b2mwap.com/index.php/home/home', 'active', '2023-08-24 06:38:32', '2023-08-24 06:38:32'),
(2, 'CFC', 'daily', 'http://cfc.b2mwap.com/', 'active', '2023-08-24 06:38:32', '2023-08-24 06:38:32'),
(3, 'Chayachobi', 'daily', 'http://chayachobi.co/', 'active', '2023-08-24 06:38:32', '2023-08-24 06:38:32');

-- --------------------------------------------------------

--
-- Table structure for table `traffic`
--

CREATE TABLE `traffic` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `campaign_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `operator_id` bigint(20) UNSIGNED NOT NULL,
  `clicked_id` varchar(255) DEFAULT NULL,
  `others` varchar(255) DEFAULT NULL,
  `received_at` datetime NOT NULL,
  `callback_received_status` varchar(255) NOT NULL DEFAULT '0' COMMENT '0 = failed, 1 = success',
  `callback_sent_status` varchar(255) NOT NULL DEFAULT '0' COMMENT '0 = unsent, 1 = sent',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `traffic`
--

INSERT INTO `traffic` (`id`, `campaign_id`, `service_id`, `operator_id`, `clicked_id`, `others`, `received_at`, `callback_received_status`, `callback_sent_status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '01923988380', '[]', '2023-08-24 12:39:07', '1', '1', '2023-08-24 06:39:07', '2023-08-24 06:39:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@example.com', 'active', NULL, '$2y$10$SjaKrsqF9P4TEPqcBRGpUeoWBGRBXaCr27ASYukAYvDuZMfJn9R92', NULL, '2023-08-24 06:38:24', '2023-08-24 06:38:24'),
(2, 'user', 'user@example.com', 'active', NULL, '$2y$10$knvEQA01LjecPTAkjKs2e.kvqUu2JCVBfF6Xoh8YRbYFt4C6ZtZW6', NULL, '2023-08-24 06:38:25', '2023-08-24 06:38:25'),
(3, 'user0', 'user_0@gmail.com', 'active', NULL, '$2y$10$znY2VB0rf1ahH9Sozy9pje59Mc2BfPa6HL/vrPEmC.36Ia9v70d2O', NULL, '2023-08-24 06:38:26', '2023-08-24 06:38:26'),
(4, 'user1', 'user_1@gmail.com', 'active', NULL, '$2y$10$aEvJ9UiGcTG0AI593pv2PukizysXDVWDLgXZ.NHcE9ev4Lu67yo6i', NULL, '2023-08-24 06:38:26', '2023-08-24 06:38:26'),
(5, 'user2', 'user_2@gmail.com', 'active', NULL, '$2y$10$vKhfEgRdwyYae3Z.4uoCtOt7XnJ6pwJcAU5ykIvdW.FKqVhKmfjLm', NULL, '2023-08-24 06:38:26', '2023-08-24 06:38:26'),
(6, 'user3', 'user_3@gmail.com', 'active', NULL, '$2y$10$APnASNdpnurSc5Fq7L4mNOKtSphQH1V8NNxQityc9q60ekInNw0vy', NULL, '2023-08-24 06:38:27', '2023-08-24 06:38:27'),
(7, 'user4', 'user_4@gmail.com', 'active', NULL, '$2y$10$fYwYg2UKXwi3HbflekxpKOFRj5aJ97IHDT1YQ54.t0H0r.GSYiyYu', NULL, '2023-08-24 06:38:27', '2023-08-24 06:38:27'),
(8, 'user5', 'user_5@gmail.com', 'active', NULL, '$2y$10$lXpweG.wU2FmYWfrtNAtze75nlKdcDO.4Za5LeAG1OJzq8X9hLQLW', NULL, '2023-08-24 06:38:28', '2023-08-24 06:38:28'),
(9, 'user6', 'user_6@gmail.com', 'active', NULL, '$2y$10$kmaGjF6yCeYy699mHiMBDuh4MhI.MiVI0h.3eWSq1jPBogHWuN/vi', NULL, '2023-08-24 06:38:28', '2023-08-24 06:38:28'),
(10, 'user7', 'user_7@gmail.com', 'active', NULL, '$2y$10$wAGOzmF7IXDodFzg9Q82feManpZ4USOwtvE8sV2ohjJkqH7xPaizm', NULL, '2023-08-24 06:38:28', '2023-08-24 06:38:28'),
(11, 'user8', 'user_8@gmail.com', 'active', NULL, '$2y$10$WK5kf88rbD/chsWo42FTR.J/bB4nja3dBQ41Dxx7CnTjaXfrDo6LG', NULL, '2023-08-24 06:38:29', '2023-08-24 06:38:29'),
(12, 'user9', 'user_9@gmail.com', 'active', NULL, '$2y$10$fA/mOCzeG7sFCctshg5FY.tS530g48AfetnkjWGxCd3ir4MYUQbtu', NULL, '2023-08-24 06:38:29', '2023-08-24 06:38:29'),
(13, 'user10', 'user_10@gmail.com', 'active', NULL, '$2y$10$V60eQz4yKF5hVK5g9If1NeWGof6sgR0Gjwxmz34CQMX3/HC4XTsoi', NULL, '2023-08-24 06:38:29', '2023-08-24 06:38:29'),
(14, 'user11', 'user_11@gmail.com', 'active', NULL, '$2y$10$UpKy8nKDUI2iI27mSlr9Ae6dIZflWWNuH.PNmgbIBZyjRsbIPEH8O', NULL, '2023-08-24 06:38:29', '2023-08-24 06:38:29'),
(15, 'user12', 'user_12@gmail.com', 'active', NULL, '$2y$10$ybKiPaiCKFzifgYyMmq9duHtC9iXgJ/CftOrgSAgo1SGRJJiIBzci', NULL, '2023-08-24 06:38:29', '2023-08-24 06:38:29'),
(16, 'user13', 'user_13@gmail.com', 'active', NULL, '$2y$10$4oUch.2Y84HQuuB.bn5WaufQzyuSfE.Xdybl0sfN1Qd.b93rayHvS', NULL, '2023-08-24 06:38:30', '2023-08-24 06:38:30'),
(17, 'user14', 'user_14@gmail.com', 'active', NULL, '$2y$10$iMIno7pCGnLtBvzFW5RSyurupXPZjxqaPN2ektlp.XFwRUXbme4eC', NULL, '2023-08-24 06:38:30', '2023-08-24 06:38:30'),
(18, 'user15', 'user_15@gmail.com', 'active', NULL, '$2y$10$i9xoaALw/hfgi1IeTAo.kemNGgJ2T/gnz6tdO1uOj0/95th5DKgq.', NULL, '2023-08-24 06:38:30', '2023-08-24 06:38:30'),
(19, 'user16', 'user_16@gmail.com', 'active', NULL, '$2y$10$GjNhqXr4IXQdzPmvX8zctejaeMOOm5WSpOmcp9Y2hq5UP77o090w.', NULL, '2023-08-24 06:38:30', '2023-08-24 06:38:30'),
(20, 'user17', 'user_17@gmail.com', 'active', NULL, '$2y$10$M50oknZc2oWwzoEa2zWKX.PsM9w/PftXFF/CMcks.sp9aMdhd6k1.', NULL, '2023-08-24 06:38:31', '2023-08-24 06:38:31'),
(21, 'user18', 'user_18@gmail.com', 'active', NULL, '$2y$10$dDufwSUScvmn93PvFVaPleosR5wAgA37040m.en.CisgcUkgHTc8.', NULL, '2023-08-24 06:38:31', '2023-08-24 06:38:31'),
(22, 'user19', 'user_19@gmail.com', 'active', NULL, '$2y$10$M/BqD2mVWfkBPmjzsE1L3OPktRxLdW4ijgU2mvblBx0F30nwo/dJq', NULL, '2023-08-24 06:38:31', '2023-08-24 06:38:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `campaigns_name_unique` (`name`),
  ADD KEY `campaigns_publisher_id_foreign` (`publisher_id`);

--
-- Indexes for table `campaign_details`
--
ALTER TABLE `campaign_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaign_details_campaign_id_foreign` (`campaign_id`),
  ADD KEY `campaign_details_operator_id_foreign` (`operator_id`),
  ADD KEY `campaign_details_service_id_foreign` (`service_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `operators`
--
ALTER TABLE `operators`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `post_back_received_logs`
--
ALTER TABLE `post_back_received_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_back_received_logs_operator_id_foreign` (`operator_id`),
  ADD KEY `post_back_received_logs_service_id_foreign` (`service_id`);

--
-- Indexes for table `post_back_sent_logs`
--
ALTER TABLE `post_back_sent_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_back_sent_logs_operator_id_foreign` (`operator_id`),
  ADD KEY `post_back_sent_logs_service_id_foreign` (`service_id`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `publishers_short_name_unique` (`short_name`);

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
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `traffic`
--
ALTER TABLE `traffic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `traffic_campaign_id_foreign` (`campaign_id`),
  ADD KEY `traffic_service_id_foreign` (`service_id`),
  ADD KEY `traffic_operator_id_foreign` (`operator_id`);

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
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `campaign_details`
--
ALTER TABLE `campaign_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `operators`
--
ALTER TABLE `operators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_back_received_logs`
--
ALTER TABLE `post_back_received_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post_back_sent_logs`
--
ALTER TABLE `post_back_sent_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `traffic`
--
ALTER TABLE `traffic`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD CONSTRAINT `campaigns_publisher_id_foreign` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `campaign_details`
--
ALTER TABLE `campaign_details`
  ADD CONSTRAINT `campaign_details_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `campaign_details_operator_id_foreign` FOREIGN KEY (`operator_id`) REFERENCES `operators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `campaign_details_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `post_back_received_logs`
--
ALTER TABLE `post_back_received_logs`
  ADD CONSTRAINT `post_back_received_logs_operator_id_foreign` FOREIGN KEY (`operator_id`) REFERENCES `operators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_back_received_logs_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_back_sent_logs`
--
ALTER TABLE `post_back_sent_logs`
  ADD CONSTRAINT `post_back_sent_logs_operator_id_foreign` FOREIGN KEY (`operator_id`) REFERENCES `operators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_back_sent_logs_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `traffic`
--
ALTER TABLE `traffic`
  ADD CONSTRAINT `traffic_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `traffic_operator_id_foreign` FOREIGN KEY (`operator_id`) REFERENCES `operators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `traffic_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

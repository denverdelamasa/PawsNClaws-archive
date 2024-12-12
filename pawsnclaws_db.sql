-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2024 at 02:47 PM
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
-- Database: `pawsnclaws_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `adoption_applications`
--

CREATE TABLE `adoption_applications` (
  `application_id` bigint(20) UNSIGNED NOT NULL,
  `adoption_id` varchar(20) DEFAULT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `adopter_name` varchar(255) NOT NULL,
  `contact_info` varchar(255) NOT NULL,
  `adopt_type` enum('individual','organization','shelter') NOT NULL,
  `employment_status` enum('student','employed','volunteer') NOT NULL,
  `socmed` varchar(255) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `experience` text NOT NULL,
  `reason` text NOT NULL,
  `current_pets` int(10) UNSIGNED NOT NULL,
  `gov_id` varchar(255) NOT NULL,
  `status` enum('Pending','Ongoing','Complete','Failed') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adoption_applications`
--

INSERT INTO `adoption_applications` (`application_id`, `adoption_id`, `receiver_id`, `sender_id`, `post_id`, `adopter_name`, `contact_info`, `adopt_type`, `employment_status`, `socmed`, `location`, `experience`, `reason`, `current_pets`, `gov_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'A-1-1533-1212', 4, 7, 15, 'asd', 'asd', 'individual', 'student', 'asdasd', 'asdas', 'asdasd', 'asdasd', 12, 'asd', '', '2024-12-12 07:32:40', '2024-12-12 07:32:40'),
(2, 'A-2-1538-1212', 5, 2, 15, 'Alexandre Justin Repia', '09123563651', 'individual', 'student', NULL, 'asjdajkdsjka', 'askdkasjdlkasjd', 'aaskdaskdj', 3, 'gov_ids/orFfdk5TZD3FegmEzFQqrYj35oQUNRt0YwUBhszc.jpg', 'Pending', '2024-12-11 23:38:06', '2024-12-11 23:38:06'),
(3, 'A-3-1907-1212', 2, 5, 5, 'asd', 'asd', 'individual', 'student', 'asd', 'asd', 'asd', 'asd', 2, 'asd', 'Pending', NULL, NULL);

--
-- Triggers `adoption_applications`
--
DELIMITER $$
CREATE TRIGGER `generate_application_id` BEFORE INSERT ON `adoption_applications` FOR EACH ROW BEGIN
    DECLARE next_id INT;

    -- Get the next auto-increment value
    SELECT AUTO_INCREMENT INTO next_id
    FROM information_schema.tables
    WHERE table_name = 'adoption_applications'
    AND table_schema = DATABASE();

    -- Generate the custom application_id
    SET NEW.adoption_id = CONCAT(
        'A-', 
        next_id, 
        '-', 
        DATE_FORMAT(NOW(), '%H%i'),  -- Time in 24-hour format
        '-', 
        DATE_FORMAT(NOW(), '%m%d')  -- Month and day
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `announcement_id` bigint(20) UNSIGNED NOT NULL,
  `shelter_id` bigint(20) UNSIGNED NOT NULL,
  `announcement_title` varchar(255) NOT NULL,
  `announcement_description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('rainsigma@gmail.com|127.0.0.1', 'i:1;', 1733825619),
('rainsigma@gmail.com|127.0.0.1:timer', 'i:1733825619;', 1733825619);

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
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_comment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `event_comment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `announcement_comment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `post_comment_id`, `event_comment_id`, `announcement_comment_id`, `comment`, `created_at`, `updated_at`) VALUES
(16, 2, 6, NULL, NULL, 'Hello', '2024-12-09 20:08:37', '2024-12-09 20:08:37'),
(20, 9, 5, NULL, NULL, 'don\'t say bitch to that beautiful creature! you imbecile!!!', '2024-12-09 23:08:59', '2024-12-09 23:08:59'),
(27, 2, 5, NULL, NULL, 'Don\'t say bitch omg! you are a horrible person huhu', '2024-12-10 03:11:10', '2024-12-10 03:11:10'),
(28, 2, 13, NULL, NULL, 'asdadsssa', '2024-12-10 03:13:24', '2024-12-10 03:13:24'),
(29, 2, 13, NULL, NULL, 'asddasd', '2024-12-10 03:14:37', '2024-12-10 03:14:37'),
(30, 2, 13, NULL, NULL, 'asdasdads', '2024-12-10 03:15:17', '2024-12-10 03:15:17'),
(39, 3, 16, NULL, NULL, 'asd', '2024-12-10 07:12:12', '2024-12-10 07:12:12'),
(40, 3, 16, NULL, NULL, 'asd', '2024-12-10 07:14:24', '2024-12-10 07:14:24'),
(41, 4, 15, NULL, NULL, 'asdasd', '2024-12-11 05:01:45', '2024-12-11 05:01:45'),
(42, 2, 15, NULL, NULL, 'Wow!', '2024-12-12 03:50:01', '2024-12-12 03:50:01');

-- --------------------------------------------------------

--
-- Table structure for table `comment_replies`
--

CREATE TABLE `comment_replies` (
  `reply_id` int(11) NOT NULL,
  `comment_id` bigint(10) UNSIGNED NOT NULL,
  `reply_to_comment_id` bigint(10) UNSIGNED NOT NULL,
  `user_id` bigint(10) UNSIGNED NOT NULL,
  `reply_content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `done_adoption_forms`
--

CREATE TABLE `done_adoption_forms` (
  `done_id` bigint(20) UNSIGNED NOT NULL,
  `done_user_id` bigint(20) UNSIGNED NOT NULL,
  `done_post_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `done_adoption_forms`
--

INSERT INTO `done_adoption_forms` (`done_id`, `done_user_id`, `done_post_id`, `created_at`, `updated_at`) VALUES
(12, 2, 15, '2024-12-11 23:38:06', '2024-12-11 23:38:06');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `shelter_id` bigint(20) UNSIGNED NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_description` text NOT NULL,
  `event_date` datetime NOT NULL,
  `event_location` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `fosters`
--

CREATE TABLE `fosters` (
  `foster_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL,
  `application_data` text NOT NULL,
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
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` bigint(20) UNSIGNED NOT NULL,
  `posts_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `posts_id`, `user_id`, `created_at`, `updated_at`) VALUES
(5, 4, 5, '2024-12-10 03:18:42', '2024-12-10 03:18:42'),
(6, 3, 5, '2024-12-10 03:18:43', '2024-12-10 03:18:43'),
(8, 16, 2, '2024-12-10 07:40:34', '2024-12-10 07:40:34'),
(11, 15, 2, '2024-12-11 02:31:04', '2024-12-11 02:31:04');

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
(4, '2024_12_05_140600_add_profile_picture_to_users_table', 2),
(5, '2024_12_05_152025_create_roles_table', 3),
(6, '2024_12_05_152729_create_posts_table', 4),
(7, '2024_12_05_153512_create_events_table', 5),
(8, '2024_12_05_154344_create_announcements_table', 6),
(9, '2024_12_05_154553_create_comments_table', 7),
(10, '2024_12_05_161359_create_fosters_table', 8),
(11, '2024_12_06_032330_create_notifications_table', 9),
(12, '2024_12_08_083659_add_reports_table', 10),
(13, '2024_12_08_092550_add_is_adoptable_to_posts_table', 11),
(14, '2024_12_08_122317_create_adoption_applications_table', 12),
(15, '2024_12_08_152740_create_done_adoption_forms_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `liked_by_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `comment_by_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `liked_by_user_id`, `comment_by_user_id`, `post_id`, `type`, `read_at`, `created_at`, `updated_at`) VALUES
(3, 2, NULL, 3, 16, 'commented on your post', '2024-12-10 07:19:39', '2024-12-10 07:14:24', '2024-12-10 07:19:39'),
(4, 5, 2, NULL, 15, 'liked your post', NULL, '2024-12-11 02:31:04', '2024-12-11 02:31:04'),
(5, 5, NULL, 4, 15, 'commented on your post', '2024-12-12 03:47:25', '2024-12-11 05:01:45', '2024-12-12 03:47:25'),
(6, 5, NULL, 2, 15, 'commented on your post', '2024-12-12 03:51:37', '2024-12-12 03:50:01', '2024-12-12 03:51:37');

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
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `caption` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `status` enum('uploaded','down','warning','') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_adoptable` tinyint(1) NOT NULL DEFAULT 0,
  `post_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `caption`, `user_id`, `image_path`, `status`, `created_at`, `updated_at`, `is_adoptable`, `post_path`) VALUES
(3, 'Post Path', 2, NULL, 'uploaded', '2024-12-09 06:37:59', '2024-12-09 06:37:59', 0, 'zlDagpdAuTtUsSN'),
(4, 'Dog', 2, 'images/posts/vLR63qzFPeD3NhLNTXKjoZYPiBkB0bPnUCoq5nLV.jpg', 'uploaded', '2024-12-09 06:42:24', '2024-12-09 06:42:24', 0, '9FkZCFUTmNIgiTX'),
(5, 'Adopt this bithc', 2, 'images/posts/jn3G5wQYeDrhw3OJcps0LaANAdvCj2WrooCBplLw.jpg', 'uploaded', '2024-12-09 06:58:42', '2024-12-09 06:58:42', 1, '3DnbBuAn8Kdlzwi'),
(6, 'Test', 7, NULL, 'uploaded', '2024-12-09 07:38:03', '2024-12-09 07:38:03', 0, 'gGu99V7TNlHE0Ec'),
(13, 'Tets', 3, NULL, 'uploaded', '2024-12-10 02:26:11', '2024-12-10 02:26:11', 1, 'HCfWoTy7Kxfwbj8'),
(15, 'Please adopt this Bengal Cat! It needs to be re-home asap, send me your adoption form so I can see who\'s worthy of owning such beauty.', 5, 'images/posts/BuLd876X56MVHfKyEmHh4EXqwoH6mLNX2pBqnXjJ.jpg', 'uploaded', '2024-12-10 03:20:00', '2024-12-10 03:20:00', 1, 'LtfFyuIJ9VNTu1r'),
(16, 'Hello iniscam ako neto roblox ang pangalan nya sa bloxfruit ay rain calayag sigma', 2, 'images/posts/mT4XCTY4LD8DpiF5SIoWdvrYQdWEZwrhP4FpAa3Y.png', 'uploaded', '2024-12-10 05:10:56', '2024-12-11 02:52:16', 0, '6ceXAZJh3N0w1GJ');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` bigint(20) UNSIGNED NOT NULL,
  `reporter_id` bigint(20) UNSIGNED NOT NULL,
  `report_post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `report_comment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reason` varchar(255) NOT NULL,
  `details` text DEFAULT NULL,
  `type` enum('Post','Comment') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `reporter_id`, `report_post_id`, `report_comment_id`, `reason`, `details`, `type`, `created_at`, `updated_at`) VALUES
(28, 4, 15, NULL, 'Troll', NULL, 'Post', '2024-12-11 05:05:15', '2024-12-11 05:05:15'),
(29, 4, NULL, 28, 'Spam', NULL, 'Comment', '2024-12-11 05:05:38', '2024-12-11 05:05:38'),
(30, 4, NULL, 20, 'Troll', NULL, 'Comment', '2024-12-11 07:30:31', '2024-12-11 07:30:31'),
(31, 4, 16, NULL, 'Troll', NULL, 'Post', '2024-12-11 08:04:51', '2024-12-11 08:04:51'),
(32, 4, NULL, 20, 'Spam', NULL, 'Comment', '2024-12-11 08:20:25', '2024-12-11 08:20:25');

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
('bkjsztMq1zvn8sG9po9QbU2Lu8s9gmOU4lmBymgI', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic21FNGJFdHhNUEwxbnVWYWo2ZldJN3NHUlVlbjFmUTZOZzk5NzllOSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1734008729);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'User',
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `is_online` tinyint(4) NOT NULL DEFAULT 0,
  `last_online` timestamp NOT NULL DEFAULT current_timestamp(),
  `suspended_until` datetime DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `profile_picture`, `bio`, `email`, `email_verified_at`, `password`, `role`, `status`, `is_online`, `last_online`, `suspended_until`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Dog Cat', 'DogLover02', 'images/profile_pictures/RrPhwn4c38iKMUaW5FSjDsxWwsWbT0aKAORb0pH2.jpg', NULL, 'jobert@gmail.com', NULL, '$2y$12$P7xngYzmJFQHDepe/hmzpu4hQMh4vSUKMvLX9bohm30c5agtPvf32', 'User', 'Active', 1, '2024-12-11 06:37:16', NULL, NULL, '2024-12-05 06:27:32', '2024-12-12 04:24:25'),
(3, 'Jopay De Guzman', 'Yapoj', 'images/profile_pictures/DtpkrFOogxnFaFas8pZG2BxBnxm3wmJhB11g4fRs.jpg', NULL, 'jopay@gmail.com', NULL, '$2y$12$zRIpIEqBUketefA.ST53EO0tHYm3Dcer9vd7LssT/lLicJhb6oKlu', 'User', 'Active', 0, '2024-12-11 06:37:16', NULL, NULL, '2024-12-05 20:16:11', '2024-12-12 03:54:21'),
(4, 'Admin Dela Cruz', 'Admin', 'images/profile_pictures/HKULuuGWGYWro6D9Sai7J95cC8iWxARz9wyMZR9X.jpg', NULL, 'admin@gmail.com', NULL, '$2y$12$I153K9htAygAshpDEIDUGe93RF06rTAg2N410TJA6AxiV58/9R3uG', 'Admin', 'Active', 0, '2024-12-11 06:37:16', NULL, NULL, '2024-12-05 20:20:44', '2024-12-12 04:23:54'),
(5, 'Kitty Cat', 'catperson', 'images/profile_pictures/Cd9CJmpS2BZiCHE9uGnsONUSwOSEKrvfBfQO4nDo.jpg', NULL, 'catperson@gmail.com', NULL, '$2y$12$J7FecznPE1UZ9lWv4cVQqOpRBsjwoVxlJdSLVNNLX9ASmkbbE.JdO', 'User', 'Active', 0, '2024-12-11 06:37:16', NULL, NULL, '2024-12-07 07:46:45', '2024-12-12 03:48:05'),
(7, 'Aj Waquiz', 'ajwaquiz', 'images/defaultpics/default-profile.png', NULL, 'alexwaquiz11@gmail.com', NULL, '$2y$12$GH0xPhKBRqLIzOCGUiYNROelb4zzy5gdskdsKijut3uwCMu3QxhLK', 'User', 'Active', 0, '2024-12-11 06:37:16', NULL, NULL, '2024-12-09 07:33:21', '2024-12-11 03:23:09'),
(9, 'personcat', 'personofcat', 'images/defaultpics/default-profile.png', NULL, 'personcat@gmail.com', NULL, '$2y$12$GBH.5CFM98CPqHy4d6V4V.vWAIk9pRI49FlPuFb6Qt584RHz2Ya.6', 'User', 'Active', 0, '2024-12-11 06:37:16', NULL, NULL, '2024-12-09 23:08:30', '2024-12-09 23:08:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adoption_applications`
--
ALTER TABLE `adoption_applications`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `adoption_applications_user_id_foreign` (`receiver_id`),
  ADD KEY `adoption_applications_post_id_foreign` (`post_id`),
  ADD KEY `adopter_id` (`adopter_name`),
  ADD KEY `sender_id` (`sender_id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`announcement_id`),
  ADD KEY `announcements_shelter_id_foreign` (`shelter_id`);

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
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_post_comment_id_foreign` (`post_comment_id`),
  ADD KEY `comments_event_comment_id_foreign` (`event_comment_id`),
  ADD KEY `comments_announcement_comment_id_foreign` (`announcement_comment_id`);

--
-- Indexes for table `comment_replies`
--
ALTER TABLE `comment_replies`
  ADD PRIMARY KEY (`reply_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `comment_replies_ibfk_2` (`comment_id`),
  ADD KEY `reply_to_comment_id` (`reply_to_comment_id`);

--
-- Indexes for table `done_adoption_forms`
--
ALTER TABLE `done_adoption_forms`
  ADD PRIMARY KEY (`done_id`),
  ADD KEY `done_adoption_forms_user_id_foreign` (`done_user_id`),
  ADD KEY `done_adoption_forms_post_id_foreign` (`done_post_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `events_shelter_id_foreign` (`shelter_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fosters`
--
ALTER TABLE `fosters`
  ADD PRIMARY KEY (`foster_id`),
  ADD KEY `fosters_user_id_foreign` (`user_id`);

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
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `likes_ibfk_1` (`posts_id`),
  ADD KEY `likes_ibfk_2` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`),
  ADD KEY `notifications_fk_liked_by_user_id` (`liked_by_user_id`) USING BTREE,
  ADD KEY `post_id` (`post_id`),
  ADD KEY `comment_by_user_id` (`comment_by_user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `reports_user_id_foreign` (`reporter_id`),
  ADD KEY `reports_post_id_foreign` (`report_post_id`),
  ADD KEY `reports_comment_id_foreign` (`report_comment_id`);

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
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adoption_applications`
--
ALTER TABLE `adoption_applications`
  MODIFY `application_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `announcement_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `comment_replies`
--
ALTER TABLE `comment_replies`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `done_adoption_forms`
--
ALTER TABLE `done_adoption_forms`
  MODIFY `done_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fosters`
--
ALTER TABLE `fosters`
  MODIFY `foster_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adoption_applications`
--
ALTER TABLE `adoption_applications`
  ADD CONSTRAINT `adoption_applications_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `adoption_applications_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `adoption_applications_user_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_shelter_id_foreign` FOREIGN KEY (`shelter_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_announcement_comment_id_foreign` FOREIGN KEY (`announcement_comment_id`) REFERENCES `announcements` (`announcement_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_event_comment_id_foreign` FOREIGN KEY (`event_comment_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_post_comment_id_foreign` FOREIGN KEY (`post_comment_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `comment_replies`
--
ALTER TABLE `comment_replies`
  ADD CONSTRAINT `comment_replies_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_replies_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`comment_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_replies_ibfk_3` FOREIGN KEY (`reply_to_comment_id`) REFERENCES `comments` (`comment_id`);

--
-- Constraints for table `done_adoption_forms`
--
ALTER TABLE `done_adoption_forms`
  ADD CONSTRAINT `done_adoption_forms_post_id_foreign` FOREIGN KEY (`done_post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `done_adoption_forms_user_id_foreign` FOREIGN KEY (`done_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_shelter_id_foreign` FOREIGN KEY (`shelter_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `fosters`
--
ALTER TABLE `fosters`
  ADD CONSTRAINT `fosters_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`posts_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`liked_by_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `notifications_ibfk_3` FOREIGN KEY (`comment_by_user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_comment_id_foreign` FOREIGN KEY (`report_comment_id`) REFERENCES `comments` (`comment_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reports_post_id_foreign` FOREIGN KEY (`report_post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reports_user_id_foreign` FOREIGN KEY (`reporter_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

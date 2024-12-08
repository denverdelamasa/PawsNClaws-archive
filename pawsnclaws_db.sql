-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2024 at 06:04 PM
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
  `user_id` bigint(20) UNSIGNED NOT NULL,
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adoption_applications`
--

INSERT INTO `adoption_applications` (`application_id`, `user_id`, `post_id`, `adopter_name`, `contact_info`, `adopt_type`, `employment_status`, `socmed`, `location`, `experience`, `reason`, `current_pets`, `gov_id`, `created_at`, `updated_at`) VALUES
(1, 5, 29, 'asdasd', 'asdasd', 'individual', 'employed', 'https://github.com/AlexandreJustinRepia/PNC/tree/front-end/resources', 'asdasd', 'asdasd', 'asdasd', 2, 'uploads/qTDStFM7jPWze6DktmTk9Vn3H0DaCw6gyzCS47Pm.jpg', '2024-12-08 07:08:42', '2024-12-08 07:08:42'),
(2, 5, 29, 'Hello', '09552188735', 'individual', 'student', 'https://github.com/AlexandreJustinRepia/PNC/tree/front-end/resources', 'asdasd', 'asdasd', 'asdasd', 2, 'uploads/n9MyvY318h9aVUdJTXWOsHxRBHlwqcGtM0aBUL3f.jpg', '2024-12-08 07:18:09', '2024-12-08 07:18:09'),
(3, 5, 30, 'asdasd', 'asdasd', 'individual', 'student', 'https://github.com/AlexandreJustinRepia/PNC/tree/front-end/resources', 'asdasd', 'asdasdasd', 'asdasdas', 3, 'uploads/Uez76XlFaSTIe4rf4Mkm1CYlWb03jD1AAMZ4MssF.jpg', '2024-12-08 07:41:19', '2024-12-08 07:41:19'),
(4, 5, 30, 'Alexandre Justin Repia', '09123563651', 'individual', 'student', 'https://web.facebook.com/aj.waquiz.5', 'Secret', 'Wala', 'Wala', 0, 'uploads/9H6U0oUXBllJ7LuXBPfs7uItV9am0TpFUEjikqOy.jpg', '2024-12-08 08:59:53', '2024-12-08 08:59:53'),
(5, 5, 30, 'Alexandre Justin Repia', '09123563651', 'individual', 'student', 'https://web.facebook.com/aj.waquiz.5', 'Secret', 'Wala', 'Wala', 0, 'uploads/b1Z6iMcBuzeGDQ4i1eJsL2orf6RWewTYPggrjIWr.jpg', '2024-12-08 08:59:55', '2024-12-08 08:59:55'),
(6, 5, 30, 'Alexandre Justin Repia', '09123563651', 'individual', 'student', 'https://web.facebook.com/aj.waquiz.5', 'Secret', 'Wala', 'Wala', 0, 'uploads/gI1RUn1pyXg26Al9fKPVq6ByA1LhbaHteEHwRClv.jpg', '2024-12-08 09:00:52', '2024-12-08 09:00:52'),
(7, 5, 30, 'Alexandre Justin Repia', '09123563651', 'individual', 'student', 'https://web.facebook.com/aj.waquiz.5', 'Secret', 'Wala', 'Wala', 0, 'uploads/cEaAU3MjRdflu5IlfrYHp5Im2dmHtWOJrLp3ZQ03.jpg', '2024-12-08 09:01:36', '2024-12-08 09:01:36');

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
(3, 2, 6, NULL, NULL, 'OMG OO NGA', '2024-12-06 16:00:00', '2024-12-07 08:43:52'),
(4, 2, 6, NULL, NULL, 'hjasdhashd', '2024-12-07 08:46:39', '2024-12-07 08:46:39'),
(5, 2, 6, NULL, NULL, 'asdasdasd', '2024-12-07 09:13:15', '2024-12-07 09:13:15'),
(6, 2, 6, NULL, NULL, 'asdads', '2024-12-07 09:13:22', '2024-12-07 09:13:22'),
(8, 5, 6, NULL, NULL, 'Location po?', '2024-12-07 18:38:55', '2024-12-07 18:38:55'),
(9, 5, 5, NULL, NULL, 'Hala, Saan po to?', '2024-12-07 18:39:43', '2024-12-07 18:39:43'),
(10, 3, 5, NULL, NULL, 'sa barangay kupang po kami', '2024-12-07 18:41:16', '2024-12-07 18:41:16'),
(11, 2, 6, NULL, NULL, 'HALA JUSKO', '2024-12-07 18:42:56', '2024-12-07 18:42:56'),
(12, 5, 4, NULL, NULL, 'kawawa naman yan, ang taba taba pa naman huhu', '2024-12-07 18:44:43', '2024-12-07 18:44:43'),
(14, 5, 6, NULL, NULL, 'ok', '2024-12-07 18:49:26', '2024-12-07 18:49:26'),
(15, 3, 9, NULL, NULL, 'meron po kaso ikaw yung kakain ng cat food', '2024-12-07 19:18:59', '2024-12-07 19:18:59'),
(16, 5, 9, NULL, NULL, 'bastos!', '2024-12-07 19:21:20', '2024-12-07 19:21:20'),
(17, 5, 3, NULL, NULL, 'omg ang cute!  persian po yan im sure!!', '2024-12-07 19:26:13', '2024-12-07 19:26:13'),
(18, 5, 3, NULL, NULL, 'MINE!! *nag submit ng adoption form', '2024-12-07 19:26:37', '2024-12-07 19:26:37'),
(19, 2, 9, NULL, NULL, 'pusa', '2024-12-07 19:42:21', '2024-12-07 19:42:21'),
(20, 5, 12, NULL, NULL, 'fake news po to wag po kayo mainiwala dito sa tao na ito jusko tigil na!!!!', '2024-12-07 19:51:07', '2024-12-07 19:51:07'),
(21, 5, 12, NULL, NULL, 'asdasd', '2024-12-07 21:32:44', '2024-12-07 21:32:44'),
(22, 5, 17, NULL, NULL, '123123', '2024-12-07 22:24:49', '2024-12-07 22:24:49'),
(23, 5, 25, NULL, NULL, 'asan', '2024-12-08 03:32:16', '2024-12-08 03:32:16');

-- --------------------------------------------------------

--
-- Table structure for table `done_adoption_forms`
--

CREATE TABLE `done_adoption_forms` (
  `done_id` bigint(20) UNSIGNED NOT NULL,
  `done_user_id` bigint(20) UNSIGNED NOT NULL,
  `done_post_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `done_adoption_forms`
--

INSERT INTO `done_adoption_forms` (`done_id`, `done_user_id`, `done_post_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 30, 'Done', '2024-12-08 07:41:19', '2024-12-08 07:41:19'),
(2, 5, 30, 'Done', '2024-12-08 09:01:36', '2024-12-08 09:01:36');

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
(9, 4, 3, '2024-12-07 07:43:04', '2024-12-07 07:43:04'),
(10, 3, 3, '2024-12-07 07:43:06', '2024-12-07 07:43:06'),
(11, 6, 5, '2024-12-07 07:47:29', '2024-12-07 07:47:29'),
(12, 5, 5, '2024-12-07 07:47:31', '2024-12-07 07:47:31'),
(13, 4, 5, '2024-12-07 07:47:33', '2024-12-07 07:47:33'),
(14, 3, 5, '2024-12-07 07:47:35', '2024-12-07 07:47:35'),
(22, 9, 3, '2024-12-07 19:18:42', '2024-12-07 19:18:42'),
(29, 5, 2, '2024-12-07 23:26:16', '2024-12-07 23:26:16'),
(30, 6, 2, '2024-12-07 23:26:18', '2024-12-07 23:26:18'),
(31, 15, 3, '2024-12-07 23:28:32', '2024-12-07 23:28:32'),
(32, 14, 3, '2024-12-07 23:28:33', '2024-12-07 23:28:33'),
(36, 20, 2, '2024-12-07 23:43:19', '2024-12-07 23:43:19');

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
  `type` varchar(255) NOT NULL,
  `liked_by` varchar(255) DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `type`, `liked_by`, `read_at`, `created_at`, `updated_at`) VALUES
(1, 3, 'like', 'Longganisabu', '2024-12-07 18:41:54', '2024-12-07 06:27:05', '2024-12-07 18:41:54'),
(2, 3, 'like', 'Longganisabu', '2024-12-07 18:41:56', '2024-12-07 06:33:22', '2024-12-07 18:41:56'),
(3, 3, 'like', 'Longganisabu', '2024-12-07 18:41:58', '2024-12-07 06:34:26', '2024-12-07 18:41:58'),
(4, 3, 'like', 'Longganisabu', '2024-12-07 18:41:57', '2024-12-07 06:35:59', '2024-12-07 18:41:57'),
(5, 2, 'like', 'Jopay', '2024-12-07 07:42:42', '2024-12-07 06:39:49', '2024-12-07 07:42:42'),
(6, 3, 'like', 'Longganisabu', '2024-12-07 18:42:01', '2024-12-07 07:39:00', '2024-12-07 18:42:01'),
(7, 2, 'like', 'Jopay', '2024-12-07 19:22:50', '2024-12-07 07:43:04', '2024-12-07 19:22:50'),
(8, 2, 'like', 'Jopay', '2024-12-07 19:22:48', '2024-12-07 07:43:06', '2024-12-07 19:22:48'),
(9, 3, 'like', 'catperson', '2024-12-07 18:42:02', '2024-12-07 07:47:29', '2024-12-07 18:42:02'),
(10, 3, 'like', 'catperson', '2024-12-07 18:42:03', '2024-12-07 07:47:31', '2024-12-07 18:42:03'),
(11, 2, 'like', 'catperson', '2024-12-07 07:48:17', '2024-12-07 07:47:33', '2024-12-07 07:48:17'),
(12, 2, 'like', 'catperson', '2024-12-07 07:48:15', '2024-12-07 07:47:35', '2024-12-07 07:48:15'),
(13, 3, 'like', 'Longganisabu', '2024-12-07 18:42:04', '2024-12-07 07:48:47', '2024-12-07 18:42:04'),
(14, 3, 'like', 'Longganisabu', '2024-12-07 18:42:05', '2024-12-07 07:48:49', '2024-12-07 18:42:05'),
(15, 3, 'like', 'catperson', '2024-12-07 19:29:21', '2024-12-07 18:46:20', '2024-12-07 19:29:21'),
(16, 5, 'like', 'Jopay', '2024-12-07 19:29:03', '2024-12-07 19:18:42', '2024-12-07 19:29:03'),
(17, 5, 'like', 'Longganisabu', '2024-12-07 19:29:02', '2024-12-07 19:22:45', '2024-12-07 19:29:02'),
(18, 5, 'like', 'DogLover02', '2024-12-07 23:29:19', '2024-12-07 23:24:41', '2024-12-07 23:29:19'),
(19, 5, 'like', 'DogLover02', '2024-12-07 23:29:18', '2024-12-07 23:24:44', '2024-12-07 23:29:18'),
(20, 5, 'like', 'DogLover02', '2024-12-07 23:29:18', '2024-12-07 23:24:49', '2024-12-07 23:29:18'),
(21, 3, 'like', 'DogLover02', '2024-12-07 23:28:06', '2024-12-07 23:26:16', '2024-12-07 23:28:06'),
(22, 3, 'like', 'DogLover02', '2024-12-07 23:28:05', '2024-12-07 23:26:18', '2024-12-07 23:28:05'),
(23, 5, 'like', 'Jopay', '2024-12-07 23:29:16', '2024-12-07 23:28:32', '2024-12-07 23:29:16'),
(24, 5, 'like', 'Jopay', '2024-12-07 23:29:15', '2024-12-07 23:28:33', '2024-12-07 23:29:15'),
(25, 5, 'like', 'DogLover02', '2024-12-08 00:47:45', '2024-12-07 23:43:19', '2024-12-08 00:47:45');

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
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `caption` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_adoptable` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `image_path`, `caption`, `created_at`, `updated_at`, `is_adoptable`) VALUES
(3, 2, 'images/posts/f8yRcH7wzXmdAaB0ry6qmWJFr4neCN9W3UBAzBM6.jpg', 'May Stray kitten po dito sa Barangay Taal, pakikuha po pls nakakaawa huhu T.T', '2024-12-07 07:42:04', '2024-12-07 07:42:04', 9),
(4, 2, 'images/posts/597LzvQo7GFAPn40s5BxZ3uQgAQnw6Jjz2RuODxi.jpg', 'May stray cat po dito sa barangay pag asa, pakikuha jusko huhu', '2024-12-07 07:42:33', '2024-12-07 07:42:33', 0),
(5, 3, 'images/posts/XzDWyzIBZNkMhXEf7z2iYJmzdFl7Ej4IrsQL8lQl.jpg', 'Nakakaawa yung aso grabe huhu, pakikuha po pls', '2024-12-07 07:44:27', '2024-12-07 07:44:27', 0),
(6, 3, 'images/posts/NOGMrWs6wl3ChzbHnfvUbYEuBNaUjijf2eEv9xzp.jpg', 'KAWAWA NAMAN TO JUSKO HUHU KUNIN NYO NA OMG', '2024-12-07 07:44:45', '2024-12-07 07:44:45', 0),
(9, 5, NULL, 'Baka po meron kayong may breed dyan na ipapa adopt? never pa po kasi akong nagkaroon ng pet na may breed hehe, just hoping lang po na meron.', '2024-12-07 19:11:57', '2024-12-07 19:21:41', 0),
(12, 2, 'images/posts/0yw1UNgE7FvCNmvsQkd0yzf0KOWCm3zRlS2idbpl.png', 'ito po si kuya alex nangkakain nang pusa hidden po profile niya kasi takot siya mahuli watch out po kay kuya alex para ligtas ang pusa niyo!!!', '2024-12-07 19:45:58', '2024-12-07 19:45:58', 0),
(14, 5, NULL, 'asdasd', '2024-12-07 21:52:43', '2024-12-07 21:52:43', 0),
(15, 5, NULL, 'asdasd', '2024-12-07 21:52:44', '2024-12-07 21:52:44', 0),
(16, 5, NULL, 'asdas', '2024-12-07 21:52:58', '2024-12-07 21:52:58', 0),
(17, 5, NULL, 'Mag p posr ako', '2024-12-07 21:53:12', '2024-12-07 21:53:12', 0),
(18, 2, NULL, 'asddsa', '2024-12-07 23:11:22', '2024-12-07 23:11:22', 0),
(19, 2, NULL, 'BUBU', '2024-12-07 23:11:28', '2024-12-07 23:11:28', 0),
(20, 5, NULL, 'lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsumasdas', '2024-12-07 23:32:34', '2024-12-07 23:41:24', 0),
(21, 5, NULL, 'test', '2024-12-08 01:39:53', '2024-12-08 01:39:53', 0),
(22, 5, 'images/posts/RoxzqvNOgqUD9mGST2RpkZZTCPfOztSiLvGLyh2L.jpg', 'I just saw this kitten outside of our house but we don\'t have space so plsss adopt this cat', '2024-12-08 01:50:57', '2024-12-08 01:50:57', 1),
(23, 5, 'images/posts/YXClEC0Ci0UbaXSIMz3x3YeIHC60mktETwr1drsf.jpg', 'cute sya but need ko na ipa adopt kasi wala na me source of funds huehue', '2024-12-08 01:52:03', '2024-12-08 01:52:03', 1),
(24, 5, 'images/posts/s85XZ2kRftI2Yw41yMyDY05GMfJOucwU31OBwrbu.jpg', 'asdasdasdas', '2024-12-08 01:52:18', '2024-12-08 01:52:18', 0),
(25, 5, NULL, 'adopt nyo na to', '2024-12-08 03:31:57', '2024-12-08 03:31:57', 1),
(26, 5, NULL, 'asdasdd', '2024-12-08 04:14:01', '2024-12-08 04:14:01', 0),
(27, 5, NULL, 'asdad', '2024-12-08 04:14:08', '2024-12-08 04:14:08', 1),
(28, 5, NULL, 'Not Adoption', '2024-12-08 06:04:11', '2024-12-08 06:04:11', 0),
(29, 5, NULL, 'For Adoption', '2024-12-08 06:04:25', '2024-12-08 06:04:25', 1),
(30, 5, NULL, 'Adopt nyo to o tatapon ko to', '2024-12-08 07:19:41', '2024-12-08 07:19:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `comment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reason` varchar(255) NOT NULL,
  `details` text DEFAULT NULL,
  `type` enum('post','comment') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `user_id`, `post_id`, `comment_id`, `reason`, `details`, `type`, `created_at`, `updated_at`) VALUES
(1, 5, 19, NULL, 'Troll', NULL, 'post', '2024-12-08 00:59:04', '2024-12-08 00:59:04'),
(2, 5, 19, NULL, 'Troll', NULL, 'post', '2024-12-08 01:07:58', '2024-12-08 01:07:58'),
(3, 5, 19, NULL, 'Troll', NULL, 'post', '2024-12-08 01:09:08', '2024-12-08 01:09:08'),
(4, 5, 18, NULL, 'Troll', NULL, 'post', '2024-12-08 01:14:37', '2024-12-08 01:14:37'),
(5, 5, 19, NULL, 'Other', 'asda', 'post', '2024-12-08 04:37:03', '2024-12-08 04:37:03');

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
('PchUDw43L3vEKzA7s7d84gBgNbi3ZdWAUoTZDFOZ', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMmRxblYwanFDYUdqWGdqZG05Q0xuZHdMNnJwVHR3WXZYTWdZRFpUWCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1733677296);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'User',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `profile_picture`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'DogLover02', 'images/profile_pictures/wmExpMEhYVydDhN7BrkaXR3KvibAS9o0SCOEA1xl.jpg', 'jobert@gmail.com', NULL, '$2y$12$P7xngYzmJFQHDepe/hmzpu4hQMh4vSUKMvLX9bohm30c5agtPvf32', 'User', NULL, '2024-12-05 06:27:32', '2024-12-07 19:31:43'),
(3, 'Jopay', 'images/defaultpics/default-profile.png', 'jopay@gmail.com', NULL, '$2y$12$zRIpIEqBUketefA.ST53EO0tHYm3Dcer9vd7LssT/lLicJhb6oKlu', 'User', NULL, '2024-12-05 20:16:11', '2024-12-05 20:16:11'),
(4, 'Admin', 'images/profile_pictures/HKULuuGWGYWro6D9Sai7J95cC8iWxARz9wyMZR9X.jpg', 'admin@gmail.com', NULL, '$2y$12$I153K9htAygAshpDEIDUGe93RF06rTAg2N410TJA6AxiV58/9R3uG', 'Admin', NULL, '2024-12-05 20:20:44', '2024-12-05 22:32:41'),
(5, 'catperson', 'images/profile_pictures/Cd9CJmpS2BZiCHE9uGnsONUSwOSEKrvfBfQO4nDo.jpg', 'catperson@gmail.com', NULL, '$2y$12$J7FecznPE1UZ9lWv4cVQqOpRBsjwoVxlJdSLVNNLX9ASmkbbE.JdO', 'User', NULL, '2024-12-07 07:46:45', '2024-12-07 07:47:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adoption_applications`
--
ALTER TABLE `adoption_applications`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `adoption_applications_user_id_foreign` (`user_id`),
  ADD KEY `adoption_applications_post_id_foreign` (`post_id`);

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
  ADD KEY `notifications_user_id_foreign` (`user_id`);

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
  ADD KEY `reports_user_id_foreign` (`user_id`),
  ADD KEY `reports_post_id_foreign` (`post_id`),
  ADD KEY `reports_comment_id_foreign` (`comment_id`);

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
  MODIFY `application_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `announcement_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `done_adoption_forms`
--
ALTER TABLE `done_adoption_forms`
  MODIFY `done_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `like_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adoption_applications`
--
ALTER TABLE `adoption_applications`
  ADD CONSTRAINT `adoption_applications_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `adoption_applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `reports_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`comment_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reports_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

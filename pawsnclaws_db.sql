-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2025 at 09:29 AM
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
  `status` enum('Reject','Pending','Ongoing','Complete','Failed') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adoption_applications`
--

INSERT INTO `adoption_applications` (`application_id`, `adoption_id`, `receiver_id`, `sender_id`, `post_id`, `adopter_name`, `contact_info`, `adopt_type`, `employment_status`, `socmed`, `location`, `experience`, `reason`, `current_pets`, `gov_id`, `status`, `created_at`, `updated_at`) VALUES
(2, 'A-2-0858-0211', 1, 4, 50, 'Aj', '09552188735', 'individual', 'student', NULL, '123456789', 'Wala', 'Tae', 0, 'gov_ids/h3vf0ErlleAqZ7FEKhGPwzWVE6gZiC0nmA6gPXRq.jpg', 'Complete', '2025-02-10 16:58:51', '2025-02-10 17:42:52'),
(3, 'A-3-1025-0211', 1, 4, 51, 'Aj to', '231123123', 'individual', 'student', NULL, 'asjdkhaskdha', 'wala', 'tae', 0, 'gov_ids/qR9avc9cZZVxLol09iqwJr0n1leClACkYxbA0268.jpg', 'Complete', '2025-02-10 18:25:36', '2025-02-10 18:26:23'),
(4, 'A-4-1144-0211', 1, 5, 52, 'asdasd', 'asdasd', 'individual', 'student', NULL, 'asdasd', 'sadasdas', 'asdasdasd', 0, 'gov_ids/EnLzNkBUrmaCgYHql0Yzvdj593GoO8x7lkJkpafP.pdf', 'Reject', '2025-02-10 19:44:25', '2025-02-10 20:00:05'),
(6, 'A-6-1443-0211', 5, 1, 54, 'hjkdasjdjasdj', 'ajsdkkjashdjas', 'individual', 'student', NULL, 'asdasdasd', 'asdasda', 'sasdasdasd', 0, 'gov_ids/Dq3BUM2liDHGsw09bP4l30aAAC3GcFRkdd7BTM0I.pdf', 'Reject', '2025-02-10 22:43:43', '2025-02-11 00:13:25'),
(7, 'A-7-1445-0211', 1, 5, 57, 'asdasd', 'asdasdasd', 'individual', 'student', NULL, 'asdasdasdasd', 'asdasdasdasdas', 'asdasdasdas', 0, 'gov_ids/zzr61Kxsrv1Zp8hLJkuOfZpetedspCzzerprYdhQ.pdf', 'Pending', '2025-02-10 22:45:29', '2025-02-10 22:45:29');

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
  `thumbnail` text DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`announcement_id`, `shelter_id`, `thumbnail`, `title`, `description`, `created_at`, `updated_at`) VALUES
(5, 1, NULL, 'LOLO', 'LOLO', '2024-01-01 08:09:17', '2024-01-01 08:09:17'),
(6, 1, 'images/posts/CHuZ3cAtJnqjA0heee9n4WQ9iR9BFCTB8VzzN4c2.jpg', 'Hello', 'taE taE TAE TAET AETTADs', '2025-01-26 22:59:24', '2025-01-26 22:59:24'),
(7, 1, NULL, 'Tae', 'TEa', '2025-01-30 16:33:11', '2025-01-30 16:33:11'),
(8, 1, NULL, 'TEA', 'TAE', '2025-02-06 17:59:56', '2025-02-06 17:59:56'),
(9, 1, NULL, 'tae', 'BUBU kayo', '2025-02-06 21:10:02', '2025-02-06 21:10:02'),
(10, 1, NULL, 'PINK STAR AGLAONEMA', 'OMG SO PRETTY!!!', '2025-02-06 21:28:30', '2025-02-06 21:28:30');

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
('alexwaquiz11@gmail.com|127.0.0.1', 'i:1;', 1736140415),
('alexwaquiz11@gmail.com|127.0.0.1:timer', 'i:1736140415;', 1736140415),
('asjdjasd@gmail.com|127.0.0.1', 'i:1;', 1734938081),
('asjdjasd@gmail.com|127.0.0.1:timer', 'i:1734938081;', 1734938081),
('catperson@gmail.com|127.0.0.1', 'i:1;', 1734078867),
('catperson@gmail.com|127.0.0.1:timer', 'i:1734078867;', 1734078867),
('rainsigma@gmail.com|127.0.0.1', 'i:1;', 1733825619),
('rainsigma@gmail.com|127.0.0.1:timer', 'i:1733825619;', 1733825619),
('user@gmail.com|127.0.0.1:timer', 'i:1739234932;', 1739234932);

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
(6, 1, 32, NULL, NULL, 'tae', '2025-02-02 23:07:01', '2025-02-02 23:07:01'),
(8, 1, 32, NULL, NULL, 'asd', '2025-02-02 23:07:43', '2025-02-02 23:07:43'),
(9, 1, 32, NULL, NULL, 'asd', '2025-02-02 23:08:28', '2025-02-02 23:08:28'),
(10, 1, 32, NULL, NULL, 'asdsad', '2025-02-03 00:36:20', '2025-02-03 00:36:20'),
(11, 1, 32, NULL, NULL, 'asd', '2025-02-03 00:36:34', '2025-02-03 00:36:34'),
(14, 1, 48, NULL, NULL, 'awsdasd1', '2025-02-05 23:23:28', '2025-02-05 23:24:24'),
(15, 1, 48, NULL, NULL, 'tae', '2025-02-05 23:23:34', '2025-02-05 23:23:34'),
(16, 1, 48, NULL, NULL, 'asd', '2025-02-05 23:25:00', '2025-02-05 23:25:00'),
(17, 1, 49, NULL, NULL, 'ASD', '2025-02-06 22:57:56', '2025-02-06 22:57:56'),
(18, 1, 49, NULL, NULL, 'asd', '2025-02-06 22:58:58', '2025-02-06 22:58:58'),
(19, 1, 48, NULL, NULL, '1212', '2025-02-06 22:59:35', '2025-02-06 22:59:35');

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
(2, 4, 50, '2025-02-10 16:58:51', '2025-02-10 16:58:51'),
(3, 4, 51, '2025-02-10 18:25:36', '2025-02-10 18:25:36'),
(4, 5, 52, '2025-02-10 19:44:25', '2025-02-10 19:44:25'),
(6, 1, 54, '2025-02-10 22:43:43', '2025-02-10 22:43:43'),
(7, 5, 57, '2025-02-10 22:45:29', '2025-02-10 22:45:29');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `shelter_id` bigint(20) UNSIGNED NOT NULL,
  `event_title` varchar(255) NOT NULL,
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
  `posts_id` bigint(20) UNSIGNED DEFAULT NULL,
  `announcement_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `posts_id`, `announcement_id`, `user_id`, `created_at`, `updated_at`) VALUES
(46, 54, NULL, 5, '2025-02-11 00:04:13', '2025-02-11 00:04:13');

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
  `notif_from_receiver` bigint(20) UNSIGNED DEFAULT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `liked_by_user_id`, `comment_by_user_id`, `notif_from_receiver`, `post_id`, `type`, `read_at`, `created_at`, `updated_at`) VALUES
(7, 1, NULL, NULL, 4, 50, 'submitted an adoption application', '2025-02-10 16:59:32', '2025-02-10 16:58:51', '2025-02-10 16:59:32'),
(8, 4, NULL, NULL, 1, NULL, 'confirmed your adoption request form', '2025-02-10 18:11:38', '2025-02-10 16:59:27', '2025-02-10 18:11:38'),
(9, 4, NULL, NULL, 1, NULL, 'your adoption request is completed', '2025-02-10 18:11:35', '2025-02-10 17:42:52', '2025-02-10 18:11:35'),
(10, 1, NULL, NULL, 4, 51, 'submitted an adoption application', '2025-02-10 18:25:58', '2025-02-10 18:25:36', '2025-02-10 18:25:58'),
(11, 4, NULL, NULL, 1, NULL, 'confirmed your adoption request form', NULL, '2025-02-10 18:26:20', '2025-02-10 18:26:20'),
(12, 4, NULL, NULL, 1, NULL, 'your adoption request is completed', NULL, '2025-02-10 18:26:23', '2025-02-10 18:26:23'),
(13, 1, NULL, NULL, 5, 52, 'submitted an adoption application', '2025-02-10 19:49:57', '2025-02-10 19:44:25', '2025-02-10 19:49:57'),
(14, 5, NULL, NULL, 1, NULL, 'rejected your adoption request form', '2025-02-10 21:34:17', '2025-02-10 20:00:05', '2025-02-10 21:34:17'),
(15, 1, 5, NULL, NULL, 52, 'liked your post', '2025-02-10 22:32:50', '2025-02-10 21:40:39', '2025-02-10 22:32:50'),
(17, 5, NULL, NULL, 1, 54, 'submitted an adoption application', '2025-02-10 22:47:48', '2025-02-10 22:43:43', '2025-02-10 22:47:48'),
(18, 1, NULL, NULL, 5, 57, 'submitted an adoption application', NULL, '2025-02-10 22:45:29', '2025-02-10 22:45:29'),
(19, 1, 5, NULL, NULL, 57, 'liked your post', NULL, '2025-02-10 22:47:55', '2025-02-10 22:47:55'),
(20, 1, NULL, NULL, 5, NULL, 'rejected your adoption request form', NULL, '2025-02-11 00:13:25', '2025-02-11 00:13:25');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', '$2y$12$2HkOP2CWRhWkLDA2S.05F.P6oxE5SVcAJHp6y73.nnMPgn9aDE8xy', '2024-12-16 22:51:08'),
('alexwaquiz11@gmail.com', '$2y$12$MgUpK/BP4wilYe14r7uq5.YX6xxx5bU01FAzfsrAc5gGtxwdhrMB6', '2024-12-16 22:51:36');

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
(26, 'asd', 1, '\"[\\\"images\\\\\\/posts\\\\\\/ZDjs9yvmhT59tqyNKEGo67W0sFMQJ4wMXxT8w69d.jpg\\\",\\\"images\\\\\\/posts\\\\\\/6JPNhKBNbeYsc5zBxnCxsXzS25gGbSRYVghiBqsF.jpg\\\",\\\"images\\\\\\/posts\\\\\\/iWuc9zmMjTtvpQ5V5rJfmWUpOE1JZNfWdlXpRkCF.jpg\\\"]\"', 'uploaded', '2025-01-30 18:03:42', '2025-01-30 18:03:42', 0, 'nSbcTgJS5r1smHs'),
(27, 'asdasd', 1, '\"[]\"', 'uploaded', '2025-01-30 20:20:34', '2025-01-30 20:20:34', 1, 'VodQ5BAsXFWXkem'),
(28, 'asdas', 1, '\"[]\"', 'uploaded', '2025-01-30 23:40:44', '2025-01-30 23:40:44', 0, 'UgVsQgN0LE1Ntxq'),
(29, '1212312', 1, '\"[]\"', 'uploaded', '2025-01-30 23:40:50', '2025-01-30 23:40:50', 0, 'GxQpOGYR5CGBEER'),
(30, 'tae to', 1, '\"[\\\"images\\\\\\/posts\\\\\\/4kwFkTpRevhb9lJpyUdDlMSE0yMvbEcIjvjerAkc.jpg\\\",\\\"images\\\\\\/posts\\\\\\/6o5gswaNGDgopCyQkocq9DLXSGDwZnoo9KKbbFaN.jpg\\\"]\"', 'uploaded', '2025-01-30 23:42:19', '2025-01-30 23:42:19', 1, 'AJ5YO1eOYQeEZsX'),
(31, 'asd', 1, '\"[\\\"images\\\\\\/posts\\\\\\/nkUZuh8mCY4VYYBd2Q8L3cLQGo1zUTPwxhnTb3OZ.jpg\\\"]\"', 'uploaded', '2025-01-30 23:43:52', '2025-01-31 00:12:59', 0, 'Dm4cyIzPf1sh7h6'),
(32, 'JHADSGJSADASDHGDSAHGASDASDGHAHSDASHASDJHADSGJSADASDHGDSAHGASDASDGHAHSDASHASDJHADSGJSADASDHGDSAHGASDASDGHAHSDASHASDJHADSGJSADASDHGDSAHGASDASDGHAHSDASHASDJHADSGJSADASDHGDSAHGASDASDGHAHSDASHASDJHADSGJSADASDHGDS3232323AHGASDASDGHAHSDASHASDJHADSGJSADASDHGDSAHGASDASDGHAHSDASHASDJHADSGJSADASDHGDSAHGASDASDGHAHSDASHASD', 1, '\"[]\"', 'uploaded', '2025-01-31 00:19:34', '2025-01-31 00:26:25', 0, 'LdGIgpMW5mi670R'),
(37, 'asdasd', 1, '\"[]\"', 'uploaded', '2025-02-03 18:05:47', '2025-02-03 18:05:47', 0, 'rHzMqjcVVDaFb2c'),
(38, '12', 1, '\"[]\"', 'uploaded', '2025-02-03 18:06:14', '2025-02-03 18:06:14', 0, 'S3YKyqJW0BcBQzD'),
(39, 'asd', 1, '\"[]\"', 'uploaded', '2025-02-03 18:07:15', '2025-02-03 18:07:15', 0, 'AubzOBD41qm1njI'),
(40, '2', 1, '\"[]\"', 'uploaded', '2025-02-03 18:12:40', '2025-02-03 18:12:40', 0, 'GO7axcVoEoUitLi'),
(41, '12123', 1, '\"[]\"', 'uploaded', '2025-02-03 18:14:37', '2025-02-03 18:14:37', 0, 'ffYQXPZhMZgbFbQ'),
(42, 'asdasd', 1, '\"[]\"', 'uploaded', '2025-02-03 18:14:42', '2025-02-03 18:14:42', 0, 'Zl5qUJ9fQSoct9B'),
(43, 'tae', 1, '\"[]\"', 'uploaded', '2025-02-03 18:14:47', '2025-02-03 18:14:47', 0, 'khDq7gkkpe8d3aa'),
(44, 'pwety', 1, '\"[]\"', 'uploaded', '2025-02-03 18:14:56', '2025-02-03 18:14:56', 0, 'sCQ2wFvodJv5cmg'),
(45, 'TAE', 1, '\"[]\"', 'uploaded', '2025-02-03 22:27:07', '2025-02-03 22:27:07', 0, 'NpQhefTnhVhBg9G'),
(46, 'asd', 1, '\"[]\"', 'uploaded', '2025-02-03 22:27:40', '2025-02-03 22:27:40', 0, '8DtC8exOAaXTFpv'),
(47, '12', 1, '\"[]\"', 'uploaded', '2025-02-03 22:27:45', '2025-02-03 22:27:45', 0, 'JpM4TIYWiG2Yxyy'),
(48, 'hello po12', 1, '\"[]\"', 'uploaded', '2025-02-03 22:35:22', '2025-02-06 21:37:49', 0, 'wCqjwRuLi2aQ8Bv'),
(49, '12', 1, '\"[]\"', 'uploaded', '2025-02-06 21:06:56', '2025-02-06 21:35:56', 0, 'nHyx7ocsk7rWOxo'),
(50, 'Adopt nyo na to o tatapon ko to 11', 1, '\"[\\\"images\\\\\\/posts\\\\\\/J2WwykIlFtCbjal0fb49LwhU9iYh1VU7E7XZHXYv.jpg\\\"]\"', 'uploaded', '2025-02-10 16:39:14', '2025-02-10 17:01:17', 2, 'KTwqvqcjleeOPeZ'),
(51, 'Eto naman cutiee patotie', 1, '\"[\\\"images\\\\\\/posts\\\\\\/HpBKlZFQ5ZvNJQPDST105ztG0c7Cfql07HJGVTj3.jpg\\\",\\\"images\\\\\\/posts\\\\\\/T72EKZRC65KUuJuL3NWxI2H9mWMG0mv88LxENoUe.jpg\\\"]\"', 'uploaded', '2025-02-10 18:24:02', '2025-02-10 18:26:23', 2, 'u5vtSHcLm3fuU0k'),
(52, 'reject', 1, '\"[\\\"images\\\\\\/posts\\\\\\/4kyqqr4YK2uM0PO5ObcTRXOxkkbjmivGtkr9KEda.jpg\\\"]\"', 'uploaded', '2025-02-10 19:43:04', '2025-02-10 19:43:04', 1, 'h0VriLj6s93magr'),
(54, 'adoption asjdasdasd', 5, '\"[\\\"images\\\\\\/posts\\\\\\/Ljh23EPtDe55vUcMvqmRxdGVdMBdl6qzbWf3V4XI.jpg\\\",\\\"images\\\\\\/posts\\\\\\/vapYpMOOpEDzy233ACCfDi0ylmlyVcR296vJY8dC.jpg\\\"]\"', 'uploaded', '2025-02-10 22:42:48', '2025-02-10 22:42:48', 1, 'iRTF7BzzvHEQNrH'),
(55, 'asdasdasd', 1, '\"[]\"', 'uploaded', '2025-02-10 22:44:45', '2025-02-10 22:44:45', 1, 'e96sTkHNvKTrmEL'),
(56, 'asdasdasdasd', 1, '\"[]\"', 'uploaded', '2025-02-10 22:44:50', '2025-02-10 22:44:50', 1, 'RpAtGwhUdzZuCIq'),
(57, '123123123123', 1, '\"[]\"', 'uploaded', '2025-02-10 22:44:54', '2025-02-10 22:44:54', 1, 'UM6TIhJamS6FuKU');

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
('Y1hKUe7Li2UdDCeJ9q8gVPF640Q8ghVF7hCUHscO', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQ1RMdzJDYzBPWnVCMXRVV3A3NmJpbnpkU01hUk1pTVdFYUVYOWhRUyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wYWdlcy9wcm9maWxlIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTt9', 1739262455);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) NOT NULL DEFAULT '/images/defaultpics/default-profile.png',
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
(1, 'Alex', 'admin', 'images/defaultpics/default-profile.png', NULL, 'admin@gmail.com', NULL, '$2y$12$fy3sVE1nde4QtB/3JoOnf.RmuasRfkgSV9cqwqjTlTeYf2lMt0pce', 'Admin', 'Active', 0, '2025-02-10 22:44:56', NULL, NULL, '2024-12-19 16:37:21', '2025-02-10 22:44:57'),
(2, 'tae', 'tae', 'images/defaultpics/default-profile.png', NULL, 'tae@gmail.com', NULL, '$2y$12$HuHMBVaC6FJ9kCokadE6/.aie1g1kMmlc3jVdrY7HCsSNyo6vEZFO', 'User', 'Active', 0, '2025-01-28 00:18:12', NULL, NULL, '2025-01-27 21:54:47', '2025-01-28 00:18:15'),
(4, 'Aj', 'aj', 'images/defaultpics/default-profile.png', NULL, 'aj@gmail.com', NULL, '$2y$12$XYl0dF/V4DgW1//hShR.HeDxyHBnq0BJMUSHpIvYsDAHyH2gS3cO2', 'User', 'Active', 0, '2025-02-10 18:30:07', NULL, NULL, '2025-02-10 16:56:53', '2025-02-10 18:30:10'),
(5, 'Jm', 'jm18', 'images/defaultpics/default-profile.png', NULL, 'jm@gmail.com', NULL, '$2y$12$j/1J.G7GPT6uqb8hPHCCxuJWmQuz3l//L.PrtkAZrTHmxrbIY0Fgq', 'User', 'Active', 1, '2025-02-11 00:27:35', NULL, NULL, '2025-02-10 18:30:53', '2025-02-11 00:27:35');

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
  ADD KEY `likes_ibfk_2` (`user_id`),
  ADD KEY `announcement_id` (`announcement_id`);

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
  ADD KEY `comment_by_user_id` (`comment_by_user_id`),
  ADD KEY `notif_from_receiver` (`notif_from_receiver`);

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
  MODIFY `application_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `announcement_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `comment_replies`
--
ALTER TABLE `comment_replies`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `done_adoption_forms`
--
ALTER TABLE `done_adoption_forms`
  MODIFY `done_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `like_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_3` FOREIGN KEY (`announcement_id`) REFERENCES `announcements` (`announcement_id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`liked_by_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_3` FOREIGN KEY (`comment_by_user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `notifications_ibfk_4` FOREIGN KEY (`notif_from_receiver`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
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

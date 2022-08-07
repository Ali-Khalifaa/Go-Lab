-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2022 at 04:38 PM
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
-- Database: `golab`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_types`
--

CREATE TABLE `activity_types` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `title_en` varchar(191) NOT NULL,
  `img` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activity_types`
--

INSERT INTO `activity_types` (`id`, `title`, `title_en`, `img`, `created_at`, `updated_at`) VALUES
(1, 'صيدليات', 'Pharmacies', 'activity-type-62938ba93e6ae.svg', '2022-03-06 13:32:33', '2022-05-29 21:05:13'),
(2, 'معامل تحاليل', ' Laboratories', 'activity-type-6226191c79502.svg', '2022-03-07 21:39:24', '2022-03-07 21:39:39'),
(3, 'عيادات', 'Clinics', 'activity-type-62261a3510e35.svg', '2022-03-07 21:44:05', '2022-03-07 22:31:19');

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `img` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `img`, `created_at`, `updated_at`) VALUES
(1, 'ads-62937c8c6ce3c.jpg', '2022-05-29 20:00:44', '2022-05-29 20:00:44'),
(2, 'ads-62dbc56343578.jpeg', '2022-05-29 20:01:28', '2022-07-23 15:54:43'),
(3, 'ads-62937cd7daf43.png', '2022-05-29 20:01:59', '2022-05-29 20:01:59');

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_en` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_hidden` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `name_en`, `image`, `is_hidden`, `created_at`, `updated_at`) VALUES
(1, 'كيماويات/CHEMICALS', 'كيماويات/CHEMICALS', '1_image.jpg', 0, '2022-05-29 19:20:54', '2022-06-13 20:59:25'),
(2, 'اجهزه', 'اجهزه', '2_image.jpeg', 1, '2022-06-12 01:48:58', '2022-07-31 15:45:51'),
(3, 'مسلتزمات طبيه / MEDICAL SUPPLIES', 'مسلتزمات طبيه / MEDICAL SUPPLIES', '3_image.jpeg', 0, '2022-06-12 01:59:03', '2022-06-12 01:59:03'),
(4, 'كروت تحاليل / CARDS', 'كروت تحاليل / CARDS', '4_image.jpeg', 0, '2022-06-12 02:03:23', '2022-06-12 02:03:23'),
(5, 'مسلتزمات الحمايه من فيروس كورونا / CORONA VIRUS', 'مسلتزمات الحمايه من فيروس كورونا / CORONA VIRUS', '5_image.jpeg', 0, '2022-06-12 02:12:39', '2022-06-12 02:13:41'),
(6, 'ميديا', 'MEDIA', '6_image.png', 0, '2022-06-22 16:14:08', '2022-06-25 17:14:23');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_en` varchar(100) NOT NULL,
  `discount_status` tinyint(1) NOT NULL DEFAULT 0,
  `percentage` decimal(8,2) NOT NULL DEFAULT 0.00,
  `image` varchar(255) DEFAULT NULL,
  `is_hidden` tinyint(1) NOT NULL DEFAULT 0,
  `category_id` bigint(20) NOT NULL,
  `company_field` varchar(191) DEFAULT NULL,
  `company_field_en` varchar(191) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `name_en`, `discount_status`, `percentage`, `image`, `is_hidden`, `category_id`, `company_field`, `company_field_en`, `created_at`, `updated_at`) VALUES
(1, 'بيوميد/BIOMED', 'بيوميد/BIOMED', 1, '1.50', '1_image.jpeg', 0, 1, 'كيماويات /CHEMICALS', 'كيماويات /CHEMICALS', '2022-05-29 19:22:57', '2022-08-07 01:03:29'),
(2, 'اسبين /SPINREACT', 'اسبين /SPINREACT', 1, '10.00', '2_image.jpeg', 0, 1, 'كيماويات /CHEMICALS', 'كيماويات /CHEMICALS', '2022-06-09 02:18:47', '2022-08-07 01:03:40'),
(3, 'اسبكترام/SPECTRUM', 'اسبكترام/SPECTRUM', 0, '0.00', '3_image.jpg', 0, 1, 'كيماويات /CHEMICALS', 'كيماويات /CHEMICALS', '2022-06-09 02:23:35', '2022-06-22 15:20:42'),
(4, 'دياموند', 'DIAMOND', 0, '0.00', '4_image.jpg', 0, 1, 'CHEMICALS', 'CHEMICALS', '2022-06-22 15:17:16', '2022-06-22 15:17:16'),
(5, 'بيوسيستم', 'BIOSYSTEMS', 0, '0.00', '5_image.png', 0, 1, 'CHEMICALS', 'CHEMICALS', '2022-06-22 15:37:07', '2022-06-22 15:37:07'),
(6, 'فيترو', 'VITRO', 0, '0.00', '6_image.jpeg', 0, 1, 'كيماويات', 'CHEMICALS', '2022-06-22 15:38:27', '2022-06-22 15:38:27'),
(7, 'راندوكس', 'RANDOX', 0, '0.00', '7_image.png', 0, 1, 'CHEMICALS', 'CHEMICALS', '2022-06-22 15:40:30', '2022-06-22 15:41:32'),
(8, 'ابون', 'ABON', 0, '0.00', '8_image.png', 0, 4, 'RAPID TEST', 'RAPID TEST', '2022-06-22 15:45:31', '2022-06-22 15:45:31'),
(9, 'انتيك', 'INTEC', 0, '0.00', '9_image.jpg', 0, 4, 'RAPID TEST', 'RAPID TEST', '2022-06-22 15:56:50', '2022-06-22 15:56:50'),
(10, 'اكيوريت', 'ACCURATE', 0, '0.00', '10_image.jpg', 0, 4, 'RAPID TEST', 'RAPID TEST', '2022-06-22 16:00:45', '2022-06-23 01:22:20'),
(11, 'رايت سين', 'RIGHTSIGN', 0, '0.00', '11_image.jpg', 0, 4, 'RAPID TEST', 'RAPID TEST', '2022-06-22 16:03:43', '2022-06-23 01:22:51'),
(12, 'سى تى ك', 'CTK', 0, '0.00', '12_image.png', 0, 4, 'RAPID TEST', 'CHEMICALS', '2022-06-22 16:05:47', '2022-06-23 01:23:09'),
(13, 'هوتجن', 'HOTGEN', 0, '0.00', '13_image.jpg', 0, 5, 'COVED 19', 'COVED 19', '2022-06-22 16:09:29', '2022-06-22 16:09:29'),
(14, 'mtbi', 'mtbi', 0, '0.00', '14_image.jpeg', 0, 4, 'كروت تحاليل', 'rapid test', '2022-06-25 01:27:22', '2022-06-25 01:27:22'),
(15, 'شرايط بول', 'urine strips', 0, '0.00', '15_image.jpeg', 0, 3, 'يستخدم فى تحليل اليورن', 'يستخدم فى تحليل اليورن', '2022-06-25 16:21:37', '2022-06-25 16:21:37'),
(16, 'مستلزمات', 'SUPPLIES', 0, '0.00', '16_image.jpeg', 0, 3, 'جميع مستلزمات تبس بتري دش ابندورف شرايح بلاستر', 'جميع مستلزمات تبس بتري دش ابندورف شرايح بلاستر', '2022-06-25 17:49:10', '2022-06-25 17:49:10'),
(17, 'سالكس', 'SALIX', 0, '0.00', '17_image.jpeg', 0, 6, 'تقوم بتصنع الميديا الجاهزه للاستخدام', 'تقوم بتصنع الميديا الجاهزه للاستخدام', '2022-07-23 18:16:42', '2022-07-23 18:16:42');

-- --------------------------------------------------------

--
-- Table structure for table `company_subcategory`
--

CREATE TABLE `company_subcategory` (
  `id` int(11) NOT NULL,
  `company_id` varchar(255) DEFAULT NULL,
  `subcategory_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `complaintproducts`
--

CREATE TABLE `complaintproducts` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `complaintproducts`
--

INSERT INTO `complaintproducts` (`id`, `user_id`, `product_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, '1277364554', '2', '01277364554', '2022-06-07 12:11:44', '2022-06-07 12:11:44'),
(2, '1277364554', '4', '01277364554', '2022-06-07 12:12:31', '2022-06-07 12:12:31'),
(3, '1277364554', '4', '01277364554', '2022-06-07 12:12:46', '2022-06-07 12:12:46'),
(4, '1277364554', '1', 'teeeeesssssssstttttt', '2022-06-08 11:42:20', '2022-06-08 11:42:20'),
(5, '1119684897', '5', 'مرحبا بكم في اينوفيشن', '2022-06-08 18:09:51', '2022-06-08 18:09:51'),
(6, '1119684897', '5', 'منتج كويس جدا', '2022-07-29 00:10:39', '2022-07-29 00:10:39');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `complaint_type_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `complaint_types`
--

CREATE TABLE `complaint_types` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `name_en` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `complaint_types`
--

INSERT INTO `complaint_types` (`id`, `name`, `name_en`, `created_at`, `updated_at`) VALUES
(1, 'اقتراح سعر منتج معين.', 'Suggest Product Name', '2022-03-27 01:03:11', '2022-04-11 14:32:15'),
(2, 'نقص منتج معين', 'Suggest Product Shortage', '2022-04-11 14:33:17', '2022-04-11 14:33:17'),
(3, 'تعليق على مستوى التواصل', 'Comment On Customer Service Satisfaction', '2022-04-11 14:33:57', '2022-04-11 14:33:57'),
(4, 'تعليق على البرنامج', 'Comment On The App', '2022-04-11 14:34:36', '2022-04-11 14:34:36'),
(5, 'اقتراحات اخرى', 'Another Suggestions', '2022-04-11 14:35:06', '2022-04-11 14:35:06');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `is_whats` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `phone`, `is_whats`, `created_at`, `updated_at`) VALUES
(1, '01003713723', 1, '2022-05-29 20:05:16', '2022-06-14 21:10:42'),
(2, '01004974049', 0, '2022-05-29 20:05:27', '2022-06-14 21:10:54');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `contact_type` varchar(191) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `contact_type`, `message`, `created_at`, `updated_at`) VALUES
(1, 'ahmed', '01000095985', 'ahmed tharwat', '2022-06-17 05:55:08', '2022-06-17 05:55:08');

-- --------------------------------------------------------

--
-- Table structure for table `coupones`
--

CREATE TABLE `coupones` (
  `id` int(11) NOT NULL,
  `title` varchar(191) NOT NULL,
  `title_en` varchar(191) DEFAULT NULL,
  `code` varchar(191) NOT NULL,
  `percentage` int(11) NOT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coupones`
--

INSERT INTO `coupones` (`id`, `title`, `title_en`, `code`, `percentage`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 'عيد', '3eed', '121212', 10, '2022-08-30', '2022-06-08 03:13:18', '2022-07-31 15:34:36'),
(2, 'عيد', 'aid', '121212', 10, '2022-11-11', '2022-06-26 01:12:24', '2022-06-26 01:12:24');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_user`
--

CREATE TABLE `coupon_user` (
  `id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `user_id` int(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coupon_user`
--

INSERT INTO `coupon_user` (`id`, `coupon_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1119684897, 1, '2022-06-08 10:52:41', '2022-06-08 10:52:41'),
(2, 1119684897, 1, '2022-06-08 19:38:51', '2022-06-08 19:38:51');

-- --------------------------------------------------------

--
-- Table structure for table `defult_mongez`
--

CREATE TABLE `defult_mongez` (
  `id` int(11) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `time` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `defult_mongez`
--

INSERT INTO `defult_mongez` (`id`, `price`, `time`, `created_at`, `updated_at`) VALUES
(1, '0.50', 24, '2022-05-11 08:34:07', '2022-06-08 16:04:18');

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mandob_id` int(11) NOT NULL,
  `stage` int(11) NOT NULL,
  `date` date NOT NULL,
  `order_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `depts`
--

CREATE TABLE `depts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `total` int(11) NOT NULL,
  `paid` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `directions`
--

CREATE TABLE `directions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `direction` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `directions`
--

INSERT INTO `directions` (`id`, `direction`, `place_id`, `created_at`, `updated_at`) VALUES
(1, 'اتجاه القاهرة الكبرى', 1, '2022-05-29 19:47:15', '2022-05-29 19:47:15');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `discount` double(8,2) NOT NULL DEFAULT 0.00,
  `end_discount` double(8,2) NOT NULL DEFAULT 0.00,
  `to_date` date DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `discount_type_id` bigint(20) DEFAULT NULL,
  `order_id` bigint(20) NOT NULL,
  `immediately` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `discount`, `end_discount`, `to_date`, `user_id`, `discount_type_id`, `order_id`, `immediately`, `created_at`, `updated_at`) VALUES
(2, 10.58, 10.58, '2022-07-01', 1277364554, 3, 5, 0, '2022-05-31 22:20:57', '2022-06-08 16:52:41'),
(3, 21.42, 21.42, '2022-06-08', 1119684897, 3, 5, 1, '2022-06-08 16:52:41', '2022-06-08 16:52:41'),
(6, 11.54, 0.00, '2022-07-08', 1119684897, 3, 0, 0, '2022-06-09 01:38:51', '2022-06-09 01:38:51'),
(7, 25.95, 25.95, '2022-07-20', 1004974049, 3, 10, 1, '2022-07-20 18:01:39', '2022-07-20 18:01:39'),
(8, 12.71, 0.00, '2022-08-20', 1004974049, 3, 0, 0, '2022-07-20 18:01:39', '2022-07-20 18:01:39');

-- --------------------------------------------------------

--
-- Table structure for table `discount_types`
--

CREATE TABLE `discount_types` (
  `id` int(11) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `name_en` varchar(191) DEFAULT NULL,
  `from` int(11) NOT NULL DEFAULT 0,
  `to` int(11) NOT NULL DEFAULT 0,
  `immediately` double(8,2) NOT NULL DEFAULT 0.00,
  `postponed` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `discount_types`
--

INSERT INTO `discount_types` (`id`, `name`, `name_en`, `from`, `to`, `immediately`, `postponed`, `created_at`, `updated_at`) VALUES
(1, 'خصم فورى', 'Immediately Discount', 100, 500, 10.00, 0.00, '2022-04-11 22:12:35', '2022-04-11 22:29:25'),
(2, 'خصم مؤجل بالكامل', 'Postponed Discounts', 500, 1000, 0.00, 5.00, '2022-04-11 22:13:14', '2022-04-11 22:28:56'),
(3, 'خصم مدمج', 'Hybrid Discount', 1000, 2000, 2.00, 1.00, '2022-04-11 22:14:58', '2022-04-11 22:29:37');

-- --------------------------------------------------------

--
-- Table structure for table `edited__order__units`
--

CREATE TABLE `edited__order__units` (
  `id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `order_unit_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `owner_id` bigint(20) NOT NULL,
  `store_id` bigint(20) NOT NULL,
  `quantity_unit_after` int(11) NOT NULL DEFAULT 0,
  `quantity_unit_before` int(11) NOT NULL DEFAULT 0,
  `quantity_total_after` int(11) NOT NULL DEFAULT 0,
  `quantity_total_before` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `examinations`
--

CREATE TABLE `examinations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_of_examination` date NOT NULL,
  `total` float NOT NULL DEFAULT 0,
  `delivery_price` float NOT NULL DEFAULT 0,
  `additional_price` float NOT NULL DEFAULT 0,
  `paid` float DEFAULT 0,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `manager_id` bigint(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_received` tinyint(1) NOT NULL DEFAULT 0,
  `is_received_keeper` tinyint(1) NOT NULL DEFAULT 0,
  `keeper_id` bigint(20) NOT NULL DEFAULT 0,
  `is_paid` tinyint(1) NOT NULL DEFAULT 0,
  `who_paid` bigint(20) NOT NULL DEFAULT 0,
  `who_received` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `examinations`
--

INSERT INTO `examinations` (`id`, `date_of_examination`, `total`, `delivery_price`, `additional_price`, `paid`, `store_id`, `supplier_id`, `manager_id`, `is_received`, `is_received_keeper`, `keeper_id`, `is_paid`, `who_paid`, `who_received`, `created_at`, `updated_at`) VALUES
(1, '2022-05-29', 1000, 0, 0, 1000, 1, 1, 1, 0, 1, 1, 1, 1, 0, '2022-05-29 19:56:36', '2022-05-29 19:59:05'),
(2, '2022-06-07', 1000, 0, 0, 1000, 1, 1, 1, 0, 1, 1, 1, 1, 0, '2022-06-08 04:12:40', '2022-06-08 04:12:59'),
(3, '2022-06-08', 1000, 0, 0, 1000, 1, 1, 1, 0, 1, 1, 1, 1, 0, '2022-06-08 17:51:56', '2022-06-08 17:52:14'),
(4, '2022-06-14', 1000, 0, 0, NULL, 1, 8, 1, 0, 1, 1, 1, 1, 0, '2022-06-14 22:49:32', '2022-06-14 22:49:49'),
(5, '2022-06-22', 6000, 0, 0, NULL, 1, 1, 1, 0, 1, 1, 1, 1, 0, '2022-06-23 03:43:28', '2022-06-23 03:43:42'),
(6, '2022-07-20', 11011, 0, 0, NULL, 1, 1, 1, 0, 1, 1, 1, 1, 0, '2022-07-20 17:40:39', '2022-07-20 17:47:43'),
(7, '2022-07-24', 1, 0, 0, NULL, 1, 1, 1, 0, 1, 1, 1, 1, 0, '2022-07-24 15:09:47', '2022-07-24 15:09:57');

-- --------------------------------------------------------

--
-- Table structure for table `examination_units`
--

CREATE TABLE `examination_units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `receive` int(11) NOT NULL,
  `recall` int(11) NOT NULL DEFAULT 0,
  `total_price` float NOT NULL DEFAULT 0,
  `quantity_before` int(11) NOT NULL,
  `quantity_after` int(11) NOT NULL,
  `production_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `is_confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `receipt_status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `return_reason_id` bigint(20) UNSIGNED DEFAULT NULL,
  `store_keeper_id` int(11) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `examination_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `examination_units`
--

INSERT INTO `examination_units` (`id`, `receive`, `recall`, `total_price`, `quantity_before`, `quantity_after`, `production_date`, `expiry_date`, `is_confirmed`, `receipt_status_id`, `return_reason_id`, `store_keeper_id`, `product_id`, `examination_id`, `created_at`, `updated_at`) VALUES
(1, 100, 0, 200, 0, 100, '2022-05-03', '2022-07-09', 0, 1, NULL, NULL, 1, 1, '2022-05-29 19:56:36', '2022-05-29 19:56:36'),
(2, 100, 0, 200, 0, 100, '2022-05-01', '2022-08-31', 0, 1, NULL, NULL, 2, 1, '2022-05-29 19:56:36', '2022-05-29 19:56:36'),
(3, 100, 0, 200, 0, 100, '2022-05-01', '2022-11-30', 0, 1, NULL, NULL, 3, 1, '2022-05-29 19:56:36', '2022-05-29 19:56:36'),
(4, 100, 0, 200, 0, 100, '2022-05-22', '2023-01-31', 0, 1, NULL, NULL, 4, 1, '2022-05-29 19:56:36', '2022-05-29 19:56:36'),
(5, 100, 0, 200, 0, 100, '2022-05-08', '2022-12-27', 0, 1, NULL, NULL, 5, 1, '2022-05-29 19:56:36', '2022-05-29 19:56:36'),
(6, 100, 0, 1000, 0, 100, '2022-05-01', '2022-07-30', 0, 1, NULL, NULL, 5, 2, '2022-06-08 04:12:40', '2022-06-08 04:12:40'),
(7, 100, 0, 1000, 100, 200, '2022-02-08', '2022-10-29', 0, 1, NULL, NULL, 1, 3, '2022-06-08 17:51:56', '2022-06-08 17:51:56'),
(8, 100, 0, 1000, 0, 100, '2022-12-11', '2023-12-11', 0, 1, NULL, NULL, 1, 4, '2022-06-14 22:49:32', '2022-06-14 22:49:32'),
(9, 1000, 0, 6, 0, 1000, '2023-10-10', '2021-10-10', 0, 1, NULL, NULL, 98, 5, '2022-06-23 03:43:28', '2022-06-23 03:43:28'),
(10, 100, 0, 1000, 61, 161, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 1, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(11, 100, 0, 2000, 0, 100, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 2, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(12, 110, 0, 2500, 0, 110, '2021-10-10', '2022-10-10', 0, 1, NULL, NULL, 3, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(13, 100, 0, 1000, 0, 100, '2021-10-10', '2022-10-10', 0, 1, NULL, NULL, 4, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(14, 10, 0, 1000, 0, 10, '2021-10-10', '2022-10-10', 0, 1, NULL, NULL, 5, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(15, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 6, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(16, 10, 0, 1000, 0, 10, '2021-10-10', '2022-10-10', 0, 1, NULL, NULL, 7, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(17, 10, 0, 1000, 0, 10, '2021-10-10', '2022-10-01', 0, 1, NULL, NULL, 8, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(18, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 9, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(19, 15, 0, 1000, 0, 15, '2021-10-10', '2022-10-10', 0, 1, NULL, NULL, 10, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(20, 10, 0, 1000, 0, 10, '2021-10-10', '2022-10-10', 0, 1, NULL, NULL, 11, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(21, 10, 0, 1000, 0, 10, '2021-11-11', '2022-11-11', 0, 1, NULL, NULL, 12, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(22, 10, 0, 1000, 0, 10, '2021-10-10', '2022-10-10', 0, 1, NULL, NULL, 13, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(23, 10, 0, 1000, 0, 10, '2021-10-10', '2022-10-10', 0, 1, NULL, NULL, 14, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(24, 15, 0, 1500, 0, 15, '2021-11-11', '2022-11-11', 0, 1, NULL, NULL, 15, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(25, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 16, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(26, 10, 0, 1000, 0, 10, '2021-11-11', '2022-11-11', 0, 1, NULL, NULL, 17, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(27, 10, 0, 1000, 0, 10, '2020-10-10', '2022-10-10', 0, 1, NULL, NULL, 18, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(28, 10, 0, 100, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 19, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(29, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 20, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(30, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 21, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(31, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 22, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(32, 10, 0, 1000, 0, 10, '2020-11-11', '2020-11-11', 0, 1, NULL, NULL, 23, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(33, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 24, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(34, 10, 0, 1500, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 25, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(35, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 26, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(36, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 27, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(37, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 28, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(38, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 29, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(39, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 30, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(40, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 31, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(41, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 32, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(42, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 33, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(43, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 34, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(44, 10, 0, 1100, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 35, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(45, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 36, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(46, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 37, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(47, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 38, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(48, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 39, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(49, 15, 0, 1000, 0, 15, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 40, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(50, 15, 0, 1000, 0, 15, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 41, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(51, 10, 0, 1000, 0, 10, '2020-10-10', '2022-11-11', 0, 1, NULL, NULL, 42, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(52, 10, 0, 1000, 0, 10, '2020-10-10', '2022-10-10', 0, 1, NULL, NULL, 43, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(53, 10, 0, 1000, 0, 10, '2020-10-10', '2022-10-10', 0, 1, NULL, NULL, 44, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(54, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 45, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(55, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 46, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(56, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 47, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(57, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 48, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(58, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 49, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(59, 15, 0, 1000, 0, 15, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 50, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(60, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 51, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(61, 10, 0, 1000, 0, 10, '2020-10-11', '2022-10-11', 0, 1, NULL, NULL, 52, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(62, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 53, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(63, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 54, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(64, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 55, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(65, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 56, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(66, 10, 0, 1100, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 57, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(67, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 58, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(68, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 59, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(69, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 60, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(70, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 61, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(71, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 62, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(72, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 63, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(73, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 64, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(74, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 65, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(75, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 66, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(76, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 67, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(77, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 68, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(78, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 69, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(79, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 70, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(80, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 71, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(81, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 72, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(82, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 73, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(83, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 74, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(84, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 75, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(85, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 76, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(86, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 77, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(87, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 78, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(88, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 79, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(89, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 80, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(90, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 81, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(91, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 82, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(92, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 83, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(93, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 84, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(94, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 85, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(95, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 86, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(96, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 87, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(97, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 88, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(98, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 89, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(99, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 90, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(100, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 91, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(101, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 92, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(102, 10, 0, 100, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 93, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(103, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 94, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(104, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 95, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(105, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 96, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(106, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 97, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(107, 10, 0, 1000, 0, 10, '2020-11-11', '2022-11-11', 0, 1, NULL, NULL, 123, 6, '2022-07-20 17:40:39', '2022-07-20 17:40:39'),
(108, 15, 0, 3000, 0, 15, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 167, 7, '2022-07-24 15:09:47', '2022-07-24 15:09:47'),
(109, 15, 0, 1500, 0, 15, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 168, 7, '2022-07-24 15:09:47', '2022-07-24 15:09:47'),
(110, 15, 0, 1500, 0, 15, '2023-11-11', '2023-11-11', 0, 1, NULL, NULL, 169, 7, '2022-07-24 15:09:47', '2022-07-24 15:09:47'),
(111, 20, 0, 2000, 0, 20, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 170, 7, '2022-07-24 15:09:47', '2022-07-24 15:09:47'),
(112, 20, 0, 2000, 0, 20, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 171, 7, '2022-07-24 15:09:47', '2022-07-24 15:09:47'),
(113, 20, 0, 2000, 0, 20, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 172, 7, '2022-07-24 15:09:47', '2022-07-24 15:09:47'),
(114, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 173, 7, '2022-07-24 15:09:47', '2022-07-24 15:09:47'),
(115, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 174, 7, '2022-07-24 15:09:47', '2022-07-24 15:09:47'),
(116, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 175, 7, '2022-07-24 15:09:47', '2022-07-24 15:09:47'),
(117, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 177, 7, '2022-07-24 15:09:47', '2022-07-24 15:09:47'),
(118, 10, 0, 10000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 178, 7, '2022-07-24 15:09:47', '2022-07-24 15:09:47'),
(119, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 179, 7, '2022-07-24 15:09:47', '2022-07-24 15:09:47'),
(120, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 180, 7, '2022-07-24 15:09:47', '2022-07-24 15:09:47'),
(121, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 181, 7, '2022-07-24 15:09:47', '2022-07-24 15:09:47'),
(122, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 182, 7, '2022-07-24 15:09:47', '2022-07-24 15:09:47'),
(123, 150, 0, 2500, 0, 150, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 183, 7, '2022-07-24 15:09:47', '2022-07-24 15:09:47'),
(124, 80, 0, 2000, 0, 80, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 184, 7, '2022-07-24 15:09:47', '2022-07-24 15:09:47'),
(125, 50, 0, 1000, 0, 50, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 185, 7, '2022-07-24 15:09:47', '2022-07-24 15:09:47'),
(126, 50, 0, 2000, 0, 50, '2021-11-11', '2023-11-12', 0, 1, NULL, NULL, 186, 7, '2022-07-24 15:09:47', '2022-07-24 15:09:47'),
(127, 50, 0, 2000, 0, 50, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 187, 7, '2022-07-24 15:09:47', '2022-07-24 15:09:47'),
(128, 50, 0, 1000, 0, 50, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 188, 7, '2022-07-24 15:09:47', '2022-07-24 15:09:47'),
(129, 150, 0, 2000, 0, 150, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 189, 7, '2022-07-24 15:09:47', '2022-07-24 15:09:47'),
(130, 80, 0, 1500, 0, 80, '2021-11-12', '2023-11-11', 0, 1, NULL, NULL, 190, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(131, 150, 0, 1500, 0, 150, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 191, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(132, 500, 0, 1000, 0, 500, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 192, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(133, 1000, 0, 750, 0, 1000, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 193, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(134, 2000, 0, 2000, 0, 2000, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 194, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(135, 2000, 0, 2000, 0, 2000, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 195, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(136, 70, 0, 1000, 0, 70, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 196, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(137, 100, 0, 1000, 0, 100, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 197, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(138, 70, 0, 2000, 0, 70, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 198, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(139, 130, 0, 1000, 0, 130, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 199, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(140, 110, 0, 1000, 0, 110, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 200, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(141, 50, 0, 1000, 0, 50, '2021-11-12', '2023-11-11', 0, 1, NULL, NULL, 201, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(142, 70, 0, 1000, 0, 70, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 202, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(143, 80, 0, 1000, 0, 80, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 203, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(144, 40, 0, 5000, 0, 40, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 204, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(145, 20, 0, 2500, 0, 20, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 205, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(146, 20, 0, 2000, 0, 20, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 206, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(147, 500, 0, 50000, 0, 500, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 207, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(148, 300, 0, 3000, 0, 300, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 208, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(149, 1500, 0, 2000, 0, 1500, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 209, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(150, 200, 0, 1000, 0, 200, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 210, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(151, 250, 0, 2500, 0, 250, '2021-11-12', '2023-11-11', 0, 1, NULL, NULL, 211, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(152, 80, 0, 100, 0, 80, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 212, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(153, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 213, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(154, 180, 0, 2000, 0, 180, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 214, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(155, 180, 0, 2000, 0, 180, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 215, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(156, 190, 0, 1000, 0, 190, '0201-11-11', '2023-11-11', 0, 1, NULL, NULL, 216, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(157, 20, 0, 1500, 0, 20, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 217, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(158, 100, 0, 1000, 0, 100, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 218, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(159, 100, 0, 1000, 0, 100, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 219, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(160, 10, 0, 100, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 220, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(161, 100, 0, 1500, 0, 100, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 221, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(162, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 222, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(163, 100, 0, 100, 0, 100, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 223, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(164, 100, 0, 1500, 0, 100, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 224, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(165, 1000, 0, 1000, 0, 1000, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 225, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(166, 1000, 0, 1000, 0, 1000, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 226, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(167, 500, 0, 500, 0, 500, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 227, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(168, 50, 0, 500, 0, 50, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 228, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(169, 15, 0, 1000, 0, 15, '2021-11-11', '2023-11-12', 0, 1, NULL, NULL, 229, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(170, 15, 0, 1000, 0, 15, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 230, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(171, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 231, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(172, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 232, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(173, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 233, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(174, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 234, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(175, 50, 0, 1000, 0, 50, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 235, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(176, 10, 0, 100, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 236, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(177, 40, 0, 100, 0, 40, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 237, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(178, 100, 0, 1000, 0, 100, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 238, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(179, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 239, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(180, 10, 0, 1000, 0, 10, '2023-11-11', '2023-11-11', 0, 1, NULL, NULL, 240, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(181, 200, 0, 1000, 0, 200, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 242, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(182, 100, 0, 1000, 0, 100, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 243, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(183, 20, 0, 1000, 0, 20, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 244, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(184, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 245, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(185, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 246, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(186, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 247, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(187, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 248, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(188, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 249, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(189, 10, 0, 1000, 0, 10, '2021-11-12', '2023-11-11', 0, 1, NULL, NULL, 250, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(190, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 251, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(191, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 252, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(192, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 253, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(193, 10, 0, 1000, 0, 10, '2021-11-12', '2023-11-11', 0, 1, NULL, NULL, 254, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(194, 100, 0, 1000, 0, 100, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 255, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(195, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 256, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(196, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 257, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(197, 10, 0, 100, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 258, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(198, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 259, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(199, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 260, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(200, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 261, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(201, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 262, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(202, 10, 0, 1000, 0, 10, '0201-11-11', '2023-11-11', 0, 1, NULL, NULL, 263, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(203, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-12', 0, 1, NULL, NULL, 264, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(204, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 265, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(205, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 266, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(206, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 267, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(207, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 268, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(208, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-12', 0, 1, NULL, NULL, 269, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48'),
(209, 10, 0, 1000, 0, 10, '2021-11-11', '2023-11-11', 0, 1, NULL, NULL, 270, 7, '2022-07-24 15:09:48', '2022-07-24 15:09:48');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) NOT NULL,
  `foreign_id` bigint(20) NOT NULL,
  `price` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `finance_shifts`
--

CREATE TABLE `finance_shifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `is_confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `from_user_id` int(10) UNSIGNED NOT NULL,
  `to_user_id` int(10) UNSIGNED NOT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `finance_shifts`
--

INSERT INTO `finance_shifts` (`id`, `start_date`, `end_date`, `is_confirmed`, `from_user_id`, `to_user_id`, `store_id`, `created_at`, `updated_at`) VALUES
(1, '2022-05-29 13:48:05', NULL, 1, 1, 1, 1, '2022-05-29 19:48:05', '2022-05-29 19:48:05');

-- --------------------------------------------------------

--
-- Table structure for table `infos`
--

CREATE TABLE `infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `quantity_unit` int(11) NOT NULL DEFAULT 0,
  `lower_limit` int(11) NOT NULL DEFAULT 0,
  `max_limit` int(11) NOT NULL DEFAULT 0,
  `first_period` int(11) NOT NULL DEFAULT 0,
  `reorder_limit` int(11) NOT NULL DEFAULT 0,
  `buy_price` double(8,2) DEFAULT 0.00,
  `sp_unit_percentage` double(8,2) NOT NULL DEFAULT 0.00,
  `sp_total_percentage` double(8,2) NOT NULL DEFAULT 0.00,
  `sell_unit_original` double NOT NULL DEFAULT 0,
  `sell_total` double NOT NULL DEFAULT 0,
  `sp_unit_LE` double NOT NULL DEFAULT 0,
  `sp_total_LE` double NOT NULL DEFAULT 0,
  `loss` float NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `infos`
--

INSERT INTO `infos` (`id`, `quantity`, `quantity_unit`, `lower_limit`, `max_limit`, `first_period`, `reorder_limit`, `buy_price`, `sp_unit_percentage`, `sp_total_percentage`, `sell_unit_original`, `sell_total`, `sp_unit_LE`, `sp_total_LE`, `loss`, `created_at`, `updated_at`) VALUES
(1, 172, 2064, 0, 0, 100, 0, 11.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-05-29 19:48:05', '2022-06-08 18:38:56'),
(2, 104, 2280, 0, 0, 100, 0, 3.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-05-29 19:48:05', '2022-06-09 01:58:31'),
(3, 100, 1400, 0, 0, 100, 0, 3.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-05-29 19:48:05', '2022-05-29 19:59:05'),
(4, 100, 1200, 0, 0, 100, 0, 3.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-05-29 19:48:05', '2022-05-29 19:59:05'),
(5, 0, 0, 0, 0, 100, 0, 11.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-05-29 19:48:05', '2022-06-09 02:46:59'),
(6, 10, 10, 1, 4, 10, 2, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-12 00:41:42', '2022-07-20 17:47:43'),
(7, 7, 14, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-12 00:42:44', '2022-08-04 15:42:18'),
(8, 176, 352, 1, 5, 100, 2, 11.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 01:26:32', '2022-08-04 15:37:19'),
(9, 96, 192, 1, 10, 100, 2, 21.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 01:26:32', '2022-08-04 15:37:47'),
(10, 110, 330, 0, 0, 110, 0, 23.73, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 01:26:32', '2022-07-20 17:47:43'),
(11, 100, 100, 0, 0, 100, 0, 11.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 01:26:32', '2022-07-20 17:47:43'),
(12, 10, 20, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 01:26:32', '2022-07-20 17:47:43'),
(13, 10, 20, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 01:34:19', '2022-07-20 17:47:43'),
(14, 10, 20, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 01:34:19', '2022-07-20 17:47:43'),
(15, 15, 30, 0, 0, 15, 0, 67.67, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 01:34:19', '2022-07-20 17:47:43'),
(16, 10, 100, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:05:12', '2022-07-20 17:47:43'),
(17, 10, 20, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:05:12', '2022-07-20 17:47:43'),
(18, 10, 200, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:05:12', '2022-07-20 17:47:43'),
(19, 10, 200, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:05:12', '2022-07-20 17:47:43'),
(20, 15, 30, 0, 0, 15, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:05:12', '2022-07-20 17:47:43'),
(21, 10, 20, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:05:12', '2022-07-20 17:47:43'),
(22, 10, 40, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:05:12', '2022-07-20 17:47:43'),
(23, 10, 40, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:05:12', '2022-07-20 17:47:43'),
(24, 10, 20, 0, 0, 10, 0, 11.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:05:12', '2022-07-20 17:47:43'),
(25, 10, 100, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:50:44', '2022-07-20 17:47:43'),
(26, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:50:44', '2022-07-20 17:47:43'),
(27, 10, 100, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:50:44', '2022-07-20 17:47:43'),
(28, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:50:44', '2022-07-20 17:47:43'),
(29, 10, 40, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:50:44', '2022-07-20 17:47:43'),
(30, 10, 200, 0, 0, 10, 0, 151.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:50:45', '2022-07-20 17:47:43'),
(31, 10, 40, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:50:45', '2022-07-20 17:47:43'),
(32, 10, 40, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:50:45', '2022-07-20 17:47:43'),
(33, 10, 20, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:50:45', '2022-07-20 17:47:43'),
(34, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:50:45', '2022-07-20 17:47:43'),
(35, 10, 20, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:50:45', '2022-07-20 17:47:43'),
(36, 10, 20, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:50:45', '2022-07-20 17:47:43'),
(37, 10, 100, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:50:45', '2022-07-20 17:47:43'),
(38, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:50:45', '2022-07-20 17:47:43'),
(39, 10, 100, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:50:45', '2022-07-20 17:47:43'),
(40, 10, 20, 0, 0, 10, 0, 111.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:50:45', '2022-07-20 17:47:43'),
(41, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:50:45', '2022-07-20 17:47:43'),
(42, 10, 0, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:50:45', '2022-07-20 17:47:43'),
(43, 10, 100, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:50:45', '2022-07-20 17:47:43'),
(44, 10, 200, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:50:45', '2022-07-20 17:47:43'),
(45, 15, 15, 0, 0, 15, 0, 67.67, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:50:45', '2022-07-20 17:47:43'),
(46, 15, 15, 0, 0, 15, 0, 67.67, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:50:45', '2022-07-20 17:47:43'),
(47, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:50:45', '2022-07-20 17:47:43'),
(48, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:50:45', '2022-07-20 17:47:43'),
(49, 10, 50, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:50:45', '2022-07-20 17:47:43'),
(50, 10, 50, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:50:45', '2022-07-20 17:47:43'),
(51, 10, 20, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:50:45', '2022-07-20 17:47:43'),
(52, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:50:45', '2022-07-20 17:47:43'),
(53, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 02:50:45', '2022-07-20 17:47:43'),
(54, 10, 40, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 16:35:19', '2022-07-20 17:47:43'),
(55, 15, 30, 0, 0, 15, 0, 67.67, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 16:42:53', '2022-07-20 17:47:43'),
(56, 10, 40, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(57, 10, 20, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(58, 10, 20, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(59, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(60, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(61, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(62, 10, 40, 0, 0, 10, 0, 111.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(63, 10, 20, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(64, 10, 40, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(65, 10, 20, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(66, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(67, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(68, 10, 20, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(69, 10, 20, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(70, 10, 80, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(71, 10, 40, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(72, 10, 20, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(73, 10, 40, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(74, 10, 50, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(75, 10, 40, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(76, 10, 50, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(77, 10, 50, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(78, 10, 20, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(79, 10, 50, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(80, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(81, 10, 20, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(82, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(83, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(84, 10, 40, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(85, 10, 20, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(86, 10, 40, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(87, 10, 20, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(88, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(89, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(90, 10, 20, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(91, 10, 40, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(92, 10, 40, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(93, 10, 50, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(94, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(95, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(96, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(97, 10, 20, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(98, 10, 20, 0, 0, 10, 0, 11.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(99, 10, 20, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(100, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 20:57:49', '2022-07-20 17:47:43'),
(101, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 21:08:16', '2022-07-20 17:47:43'),
(102, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-14 21:08:16', '2022-07-20 17:47:43'),
(103, 1000, 40000, 0, 0, 1000, 0, 1.01, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:38', '2022-06-23 03:43:42'),
(104, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:38', '2022-06-23 01:20:38'),
(105, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:38', '2022-06-23 01:20:38'),
(106, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:38', '2022-06-23 01:20:38'),
(107, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:38', '2022-06-23 01:20:38'),
(108, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:38', '2022-06-23 01:20:38'),
(109, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:38', '2022-06-23 01:20:38'),
(110, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(111, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(112, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(113, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(114, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(115, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(116, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(117, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(118, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(119, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(120, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(121, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(122, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(123, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(124, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(125, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(126, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(127, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(128, 10, 250, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-07-20 17:47:43'),
(129, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(130, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(131, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(132, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(133, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(134, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(135, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(136, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(137, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(138, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(139, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(140, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(141, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(142, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(143, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(144, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(145, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(146, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(147, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(148, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(149, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(150, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(151, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(152, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(153, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(154, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(155, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(156, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(157, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(158, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(159, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(160, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-23 01:20:39', '2022-06-23 01:20:39'),
(161, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:07', '2022-06-25 20:57:07'),
(162, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:07', '2022-06-25 20:57:07'),
(163, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:07', '2022-06-25 20:57:07'),
(164, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:07', '2022-06-25 20:57:07'),
(165, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:07', '2022-06-25 20:57:07'),
(166, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:07', '2022-06-25 20:57:07'),
(167, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:08', '2022-06-25 20:57:08'),
(168, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:08', '2022-06-25 20:57:08'),
(169, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:08', '2022-06-25 20:57:08'),
(170, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:08', '2022-06-25 20:57:08'),
(171, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:08', '2022-06-25 20:57:08'),
(172, 15, 15, 0, 0, 15, 0, 201.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:08', '2022-07-24 15:09:57'),
(173, 15, 15, 0, 0, 15, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:08', '2022-07-24 15:09:57'),
(174, 15, 15, 0, 0, 15, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:08', '2022-07-24 15:09:57'),
(175, 20, 3000, 0, 0, 20, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:08', '2022-07-24 15:09:57'),
(176, 20, 2000, 0, 0, 20, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:08', '2022-07-24 15:09:57'),
(177, 20, 2000, 0, 0, 20, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:08', '2022-07-24 15:09:57'),
(178, 10, 1000, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:08', '2022-07-24 15:09:57'),
(179, 10, 1000, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:08', '2022-07-24 15:09:57'),
(180, 10, 1000, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:08', '2022-07-24 15:09:57'),
(181, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:08', '2022-06-25 20:57:08'),
(182, 10, 1000, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:08', '2022-07-24 15:09:57'),
(183, 10, 1000, 0, 0, 10, 0, 1001.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:08', '2022-07-24 15:09:57'),
(184, 10, 1000, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:08', '2022-07-24 15:09:57'),
(185, 10, 1000, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:08', '2022-07-24 15:09:57'),
(186, 10, 1000, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:08', '2022-07-24 15:09:57'),
(187, 10, 1000, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:08', '2022-07-24 15:09:57'),
(188, 150, 150000, 0, 0, 150, 0, 17.67, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:08', '2022-07-24 15:09:57'),
(189, 80, 40000, 0, 0, 80, 0, 26.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:08', '2022-07-24 15:09:57'),
(190, 50, 50000, 0, 0, 50, 0, 21.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:08', '2022-07-24 15:09:57'),
(191, 50, 25000, 0, 0, 50, 0, 41.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:08', '2022-07-24 15:09:57'),
(192, 50, 25000, 0, 0, 50, 0, 41.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:08', '2022-07-24 15:09:57'),
(193, 50, 2500, 0, 0, 50, 0, 21.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:08', '2022-07-24 15:09:57'),
(194, 150, 7500, 0, 0, 150, 0, 14.33, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:08', '2022-07-24 15:09:57'),
(195, 80, 8000, 0, 0, 80, 0, 19.75, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:08', '2022-07-24 15:09:57'),
(196, 150, 15000, 0, 0, 150, 0, 11.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-06-25 20:57:08', '2022-07-24 15:09:57'),
(197, 500, 250000, 0, 0, 500, 0, 3.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(198, 1000, 500000, 0, 0, 1000, 0, 1.75, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(199, 2000, 1400000, 0, 0, 2000, 0, 2.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(200, 2000, 1000000, 0, 0, 2000, 0, 2.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(201, 70, 70000, 0, 0, 70, 0, 15.29, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(202, 100, 10000, 0, 0, 100, 0, 11.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(203, 70, 35000, 0, 0, 70, 0, 29.57, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(204, 130, 13000, 0, 0, 130, 0, 8.69, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(205, 110, 110000, 0, 0, 110, 0, 10.09, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(206, 50, 50, 0, 0, 50, 0, 21.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(207, 70, 70, 0, 0, 70, 0, 15.29, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(208, 80, 80, 0, 0, 80, 0, 13.50, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(209, 40, 4000, 0, 0, 40, 0, 126.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(210, 20, 2000, 0, 0, 20, 0, 126.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(211, 20, 2000, 0, 0, 20, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(212, 500, 50000, 0, 0, 500, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(213, 300, 30000, 0, 0, 300, 0, 11.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(214, 1500, 51000, 0, 0, 1500, 0, 2.33, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(215, 200, 16000, 0, 0, 200, 0, 6.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(216, 250, 250, 0, 0, 250, 0, 11.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(217, 80, 1600, 0, 0, 80, 0, 2.25, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(218, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(219, 180, 90000, 0, 0, 180, 0, 12.11, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(220, 180, 90000, 0, 0, 180, 0, 12.11, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(221, 190, 95000, 0, 0, 190, 0, 6.26, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(222, 20, 5000, 0, 0, 20, 0, 76.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(223, 100, 25000, 0, 0, 100, 0, 11.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(224, 100, 25000, 0, 0, 100, 0, 11.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(225, 10, 1000, 0, 0, 10, 0, 11.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(226, 100, 2500, 0, 0, 100, 0, 16.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(227, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(228, 100, 100, 0, 0, 100, 0, 2.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(229, 100, 10000, 0, 0, 100, 0, 16.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(230, 1000, 10000, 0, 0, 1000, 0, 2.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(231, 1000, 10000, 0, 0, 1000, 0, 2.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(232, 500, 5000, 0, 0, 500, 0, 2.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(233, 50, 50, 0, 0, 50, 0, 11.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(234, 15, 1500, 0, 0, 15, 0, 67.67, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(235, 15, 1500, 0, 0, 15, 0, 67.67, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(236, 10, 10000, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(237, 10, 5000, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(238, 10, 5000, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(239, 10, 10000, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(240, 50, 2500, 0, 0, 50, 0, 21.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(241, 10, 10, 0, 0, 10, 0, 11.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(242, 40, 40, 0, 0, 40, 0, 3.50, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(243, 100, 10000, 0, 0, 100, 0, 11.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(244, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-20 16:28:25', '2022-07-24 15:09:57'),
(245, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-23 16:08:22', '2022-07-24 15:09:57'),
(246, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-23 16:08:22', '2022-07-23 16:08:22'),
(247, 200, -400, 0, 0, 200, 0, 6.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-23 16:08:22', '2022-07-24 15:09:57'),
(248, 100, 2500, 0, 0, 100, 0, 11.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-23 16:21:52', '2022-07-24 15:09:57'),
(249, 20, 20, 0, 0, 20, 0, 51.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 15:09:57'),
(250, 10, 2500, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 15:09:57'),
(251, 10, 5000, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 15:09:57'),
(252, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 15:09:57'),
(253, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 15:09:57'),
(254, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 15:09:57'),
(255, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 15:09:57'),
(256, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 15:09:57'),
(257, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 15:09:57'),
(258, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 15:09:57'),
(259, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 15:09:57'),
(260, 100, 100, 0, 0, 100, 0, 11.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 15:09:57'),
(261, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 15:09:57'),
(262, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 15:09:57'),
(263, 10, 10, 0, 0, 10, 0, 11.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 15:09:57'),
(264, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 15:09:57'),
(265, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 15:09:57'),
(266, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 15:09:57'),
(267, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 15:09:57'),
(268, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 15:09:57'),
(269, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 15:09:57'),
(270, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 15:09:57'),
(271, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 15:09:57'),
(272, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 15:09:57'),
(273, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 15:09:57'),
(274, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 15:09:57'),
(275, 10, 10, 0, 0, 10, 0, 101.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 15:09:57'),
(276, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 00:42:43'),
(277, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 00:42:43'),
(278, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 00:42:43'),
(279, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 00:42:43'),
(280, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 00:42:43'),
(281, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, '2022-07-24 00:42:43', '2022-07-24 00:42:43');

-- --------------------------------------------------------

--
-- Table structure for table `info_product`
--

CREATE TABLE `info_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `info_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `info_product`
--

INSERT INTO `info_product` (`id`, `created_at`, `updated_at`, `product_id`, `info_id`, `store_id`) VALUES
(6, NULL, NULL, 6, 6, 1),
(7, NULL, NULL, 7, 7, 1),
(8, NULL, NULL, 1, 8, 1),
(9, NULL, NULL, 2, 9, 1),
(10, NULL, NULL, 3, 10, 1),
(11, NULL, NULL, 4, 11, 1),
(12, NULL, NULL, 5, 12, 1),
(13, NULL, NULL, 8, 13, 1),
(14, NULL, NULL, 9, 14, 1),
(15, NULL, NULL, 10, 15, 1),
(16, NULL, NULL, 11, 16, 1),
(17, NULL, NULL, 12, 17, 1),
(18, NULL, NULL, 13, 18, 1),
(19, NULL, NULL, 14, 19, 1),
(20, NULL, NULL, 15, 20, 1),
(21, NULL, NULL, 16, 21, 1),
(22, NULL, NULL, 17, 22, 1),
(23, NULL, NULL, 18, 23, 1),
(24, NULL, NULL, 19, 24, 1),
(25, NULL, NULL, 20, 25, 1),
(26, NULL, NULL, 21, 26, 1),
(27, NULL, NULL, 22, 27, 1),
(28, NULL, NULL, 23, 28, 1),
(29, NULL, NULL, 24, 29, 1),
(30, NULL, NULL, 25, 30, 1),
(31, NULL, NULL, 26, 31, 1),
(32, NULL, NULL, 27, 32, 1),
(33, NULL, NULL, 28, 33, 1),
(34, NULL, NULL, 29, 34, 1),
(35, NULL, NULL, 30, 35, 1),
(36, NULL, NULL, 31, 36, 1),
(37, NULL, NULL, 32, 37, 1),
(38, NULL, NULL, 33, 38, 1),
(39, NULL, NULL, 34, 39, 1),
(40, NULL, NULL, 35, 40, 1),
(41, NULL, NULL, 36, 41, 1),
(42, NULL, NULL, 37, 42, 1),
(43, NULL, NULL, 38, 43, 1),
(44, NULL, NULL, 39, 44, 1),
(45, NULL, NULL, 40, 45, 1),
(46, NULL, NULL, 41, 46, 1),
(47, NULL, NULL, 42, 47, 1),
(48, NULL, NULL, 43, 48, 1),
(49, NULL, NULL, 44, 49, 1),
(50, NULL, NULL, 45, 50, 1),
(51, NULL, NULL, 46, 51, 1),
(52, NULL, NULL, 47, 52, 1),
(53, NULL, NULL, 48, 53, 1),
(54, NULL, NULL, 49, 54, 1),
(55, NULL, NULL, 50, 55, 1),
(56, NULL, NULL, 51, 56, 1),
(57, NULL, NULL, 52, 57, 1),
(58, NULL, NULL, 53, 58, 1),
(59, NULL, NULL, 54, 59, 1),
(60, NULL, NULL, 55, 60, 1),
(61, NULL, NULL, 56, 61, 1),
(62, NULL, NULL, 57, 62, 1),
(63, NULL, NULL, 58, 63, 1),
(64, NULL, NULL, 59, 64, 1),
(65, NULL, NULL, 60, 65, 1),
(66, NULL, NULL, 61, 66, 1),
(67, NULL, NULL, 62, 67, 1),
(68, NULL, NULL, 63, 68, 1),
(69, NULL, NULL, 64, 69, 1),
(70, NULL, NULL, 65, 70, 1),
(71, NULL, NULL, 66, 71, 1),
(72, NULL, NULL, 67, 72, 1),
(73, NULL, NULL, 68, 73, 1),
(74, NULL, NULL, 69, 74, 1),
(75, NULL, NULL, 70, 75, 1),
(76, NULL, NULL, 71, 76, 1),
(77, NULL, NULL, 72, 77, 1),
(78, NULL, NULL, 73, 78, 1),
(79, NULL, NULL, 74, 79, 1),
(80, NULL, NULL, 75, 80, 1),
(81, NULL, NULL, 76, 81, 1),
(82, NULL, NULL, 77, 82, 1),
(83, NULL, NULL, 78, 83, 1),
(84, NULL, NULL, 79, 84, 1),
(85, NULL, NULL, 80, 85, 1),
(86, NULL, NULL, 81, 86, 1),
(87, NULL, NULL, 82, 87, 1),
(88, NULL, NULL, 83, 88, 1),
(89, NULL, NULL, 84, 89, 1),
(90, NULL, NULL, 85, 90, 1),
(91, NULL, NULL, 86, 91, 1),
(92, NULL, NULL, 87, 92, 1),
(93, NULL, NULL, 88, 93, 1),
(94, NULL, NULL, 89, 94, 1),
(95, NULL, NULL, 90, 95, 1),
(96, NULL, NULL, 91, 96, 1),
(97, NULL, NULL, 92, 97, 1),
(98, NULL, NULL, 93, 98, 1),
(99, NULL, NULL, 94, 99, 1),
(100, NULL, NULL, 95, 100, 1),
(101, NULL, NULL, 96, 101, 1),
(102, NULL, NULL, 97, 102, 1),
(103, NULL, NULL, 98, 103, 1),
(104, NULL, NULL, 99, 104, 1),
(105, NULL, NULL, 100, 105, 1),
(106, NULL, NULL, 101, 106, 1),
(107, NULL, NULL, 102, 107, 1),
(108, NULL, NULL, 103, 108, 1),
(109, NULL, NULL, 104, 109, 1),
(110, NULL, NULL, 105, 110, 1),
(111, NULL, NULL, 106, 111, 1),
(112, NULL, NULL, 107, 112, 1),
(113, NULL, NULL, 108, 113, 1),
(114, NULL, NULL, 109, 114, 1),
(115, NULL, NULL, 110, 115, 1),
(116, NULL, NULL, 111, 116, 1),
(117, NULL, NULL, 112, 117, 1),
(118, NULL, NULL, 113, 118, 1),
(119, NULL, NULL, 114, 119, 1),
(120, NULL, NULL, 115, 120, 1),
(121, NULL, NULL, 116, 121, 1),
(122, NULL, NULL, 117, 122, 1),
(123, NULL, NULL, 118, 123, 1),
(124, NULL, NULL, 119, 124, 1),
(125, NULL, NULL, 120, 125, 1),
(126, NULL, NULL, 121, 126, 1),
(127, NULL, NULL, 122, 127, 1),
(128, NULL, NULL, 123, 128, 1),
(129, NULL, NULL, 124, 129, 1),
(130, NULL, NULL, 125, 130, 1),
(131, NULL, NULL, 126, 131, 1),
(132, NULL, NULL, 127, 132, 1),
(133, NULL, NULL, 128, 133, 1),
(134, NULL, NULL, 129, 134, 1),
(135, NULL, NULL, 130, 135, 1),
(136, NULL, NULL, 131, 136, 1),
(137, NULL, NULL, 132, 137, 1),
(138, NULL, NULL, 133, 138, 1),
(139, NULL, NULL, 134, 139, 1),
(140, NULL, NULL, 135, 140, 1),
(141, NULL, NULL, 136, 141, 1),
(142, NULL, NULL, 137, 142, 1),
(143, NULL, NULL, 138, 143, 1),
(144, NULL, NULL, 139, 144, 1),
(145, NULL, NULL, 140, 145, 1),
(146, NULL, NULL, 141, 146, 1),
(147, NULL, NULL, 142, 147, 1),
(148, NULL, NULL, 143, 148, 1),
(149, NULL, NULL, 144, 149, 1),
(150, NULL, NULL, 145, 150, 1),
(151, NULL, NULL, 146, 151, 1),
(152, NULL, NULL, 147, 152, 1),
(153, NULL, NULL, 148, 153, 1),
(154, NULL, NULL, 149, 154, 1),
(155, NULL, NULL, 150, 155, 1),
(156, NULL, NULL, 151, 156, 1),
(157, NULL, NULL, 152, 157, 1),
(158, NULL, NULL, 153, 158, 1),
(159, NULL, NULL, 154, 159, 1),
(160, NULL, NULL, 155, 160, 1),
(161, NULL, NULL, 156, 161, 1),
(162, NULL, NULL, 157, 162, 1),
(163, NULL, NULL, 158, 163, 1),
(164, NULL, NULL, 159, 164, 1),
(165, NULL, NULL, 160, 165, 1),
(166, NULL, NULL, 161, 166, 1),
(167, NULL, NULL, 162, 167, 1),
(168, NULL, NULL, 163, 168, 1),
(169, NULL, NULL, 164, 169, 1),
(170, NULL, NULL, 165, 170, 1),
(171, NULL, NULL, 166, 171, 1),
(172, NULL, NULL, 167, 172, 1),
(173, NULL, NULL, 168, 173, 1),
(174, NULL, NULL, 169, 174, 1),
(175, NULL, NULL, 170, 175, 1),
(176, NULL, NULL, 171, 176, 1),
(177, NULL, NULL, 172, 177, 1),
(178, NULL, NULL, 173, 178, 1),
(179, NULL, NULL, 174, 179, 1),
(180, NULL, NULL, 175, 180, 1),
(181, NULL, NULL, 176, 181, 1),
(182, NULL, NULL, 177, 182, 1),
(183, NULL, NULL, 178, 183, 1),
(184, NULL, NULL, 179, 184, 1),
(185, NULL, NULL, 180, 185, 1),
(186, NULL, NULL, 181, 186, 1),
(187, NULL, NULL, 182, 187, 1),
(188, NULL, NULL, 183, 188, 1),
(189, NULL, NULL, 184, 189, 1),
(190, NULL, NULL, 185, 190, 1),
(191, NULL, NULL, 186, 191, 1),
(192, NULL, NULL, 187, 192, 1),
(193, NULL, NULL, 188, 193, 1),
(194, NULL, NULL, 189, 194, 1),
(195, NULL, NULL, 190, 195, 1),
(196, NULL, NULL, 191, 196, 1),
(197, NULL, NULL, 192, 197, 1),
(198, NULL, NULL, 193, 198, 1),
(199, NULL, NULL, 194, 199, 1),
(200, NULL, NULL, 195, 200, 1),
(201, NULL, NULL, 196, 201, 1),
(202, NULL, NULL, 197, 202, 1),
(203, NULL, NULL, 198, 203, 1),
(204, NULL, NULL, 199, 204, 1),
(205, NULL, NULL, 200, 205, 1),
(206, NULL, NULL, 201, 206, 1),
(207, NULL, NULL, 202, 207, 1),
(208, NULL, NULL, 203, 208, 1),
(209, NULL, NULL, 204, 209, 1),
(210, NULL, NULL, 205, 210, 1),
(211, NULL, NULL, 206, 211, 1),
(212, NULL, NULL, 207, 212, 1),
(213, NULL, NULL, 208, 213, 1),
(214, NULL, NULL, 209, 214, 1),
(215, NULL, NULL, 210, 215, 1),
(216, NULL, NULL, 211, 216, 1),
(217, NULL, NULL, 212, 217, 1),
(218, NULL, NULL, 213, 218, 1),
(219, NULL, NULL, 214, 219, 1),
(220, NULL, NULL, 215, 220, 1),
(221, NULL, NULL, 216, 221, 1),
(222, NULL, NULL, 217, 222, 1),
(223, NULL, NULL, 218, 223, 1),
(224, NULL, NULL, 219, 224, 1),
(225, NULL, NULL, 220, 225, 1),
(226, NULL, NULL, 221, 226, 1),
(227, NULL, NULL, 222, 227, 1),
(228, NULL, NULL, 223, 228, 1),
(229, NULL, NULL, 224, 229, 1),
(230, NULL, NULL, 225, 230, 1),
(231, NULL, NULL, 226, 231, 1),
(232, NULL, NULL, 227, 232, 1),
(233, NULL, NULL, 228, 233, 1),
(234, NULL, NULL, 229, 234, 1),
(235, NULL, NULL, 230, 235, 1),
(236, NULL, NULL, 231, 236, 1),
(237, NULL, NULL, 232, 237, 1),
(238, NULL, NULL, 233, 238, 1),
(239, NULL, NULL, 234, 239, 1),
(240, NULL, NULL, 235, 240, 1),
(241, NULL, NULL, 236, 241, 1),
(242, NULL, NULL, 237, 242, 1),
(243, NULL, NULL, 238, 243, 1),
(244, NULL, NULL, 239, 244, 1),
(245, NULL, NULL, 240, 245, 1),
(246, NULL, NULL, 241, 246, 1),
(247, NULL, NULL, 242, 247, 1),
(248, NULL, NULL, 243, 248, 1),
(249, NULL, NULL, 244, 249, 1),
(250, NULL, NULL, 245, 250, 1),
(251, NULL, NULL, 246, 251, 1),
(252, NULL, NULL, 247, 252, 1),
(253, NULL, NULL, 248, 253, 1),
(254, NULL, NULL, 249, 254, 1),
(255, NULL, NULL, 250, 255, 1),
(256, NULL, NULL, 251, 256, 1),
(257, NULL, NULL, 252, 257, 1),
(258, NULL, NULL, 253, 258, 1),
(259, NULL, NULL, 254, 259, 1),
(260, NULL, NULL, 255, 260, 1),
(261, NULL, NULL, 256, 261, 1),
(262, NULL, NULL, 257, 262, 1),
(263, NULL, NULL, 258, 263, 1),
(264, NULL, NULL, 259, 264, 1),
(265, NULL, NULL, 260, 265, 1),
(266, NULL, NULL, 261, 266, 1),
(267, NULL, NULL, 262, 267, 1),
(268, NULL, NULL, 263, 268, 1),
(269, NULL, NULL, 264, 269, 1),
(270, NULL, NULL, 265, 270, 1),
(271, NULL, NULL, 266, 271, 1),
(272, NULL, NULL, 267, 272, 1),
(273, NULL, NULL, 268, 273, 1),
(274, NULL, NULL, 269, 274, 1),
(275, NULL, NULL, 270, 275, 1),
(276, NULL, NULL, 271, 276, 1),
(277, NULL, NULL, 272, 277, 1),
(278, NULL, NULL, 273, 278, 1),
(279, NULL, NULL, 274, 279, 1),
(280, NULL, NULL, 275, 280, 1),
(281, NULL, NULL, 276, 281, 1);

-- --------------------------------------------------------

--
-- Table structure for table `info__expirations`
--

CREATE TABLE `info__expirations` (
  `id` bigint(20) NOT NULL,
  `info_id` bigint(20) NOT NULL,
  `store_id` bigint(20) NOT NULL,
  `quantity_total` int(11) NOT NULL,
  `quantity_unit` int(11) NOT NULL,
  `production_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `info__expirations`
--

INSERT INTO `info__expirations` (`id`, `info_id`, `store_id`, `quantity_total`, `quantity_unit`, `production_date`, `expiry_date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 84, 1008, '2022-05-03', '2022-07-09', '2022-05-29 19:59:05', '2022-06-08 17:49:50'),
(2, 2, 1, 97, 1940, '2022-05-01', '2022-08-31', '2022-05-29 19:59:05', '2022-06-08 17:49:50'),
(3, 3, 1, 100, 1400, '2022-05-01', '2022-11-30', '2022-05-29 19:59:05', '2022-05-29 19:59:05'),
(4, 4, 1, 100, 1200, '2022-05-22', '2023-01-31', '2022-05-29 19:59:05', '2022-05-29 19:59:05'),
(5, 5, 1, 100, 1000, '2022-05-08', '2022-12-27', '2022-05-29 19:59:05', '2022-05-29 19:59:05'),
(6, 5, 1, 100, 1000, '2022-05-01', '2022-07-30', '2022-06-08 04:12:59', '2022-06-08 04:12:59'),
(7, 1, 1, 100, 1200, '2022-02-08', '2022-10-29', '2022-06-08 17:52:14', '2022-06-08 17:52:14'),
(8, 8, 1, 100, 200, '2022-12-11', '2023-12-11', '2022-06-14 22:49:49', '2022-06-14 22:49:49'),
(9, 103, 1, 1000, 40000, '2023-10-10', '2021-10-10', '2022-06-23 03:43:42', '2022-06-23 03:43:42'),
(10, 8, 1, 100, 200, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(11, 9, 1, 100, 200, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(12, 10, 1, 110, 330, '2021-10-10', '2022-10-10', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(13, 11, 1, 100, 100, '2021-10-10', '2022-10-10', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(14, 12, 1, 10, 20, '2021-10-10', '2022-10-10', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(15, 6, 1, 10, 10, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(16, 7, 1, 10, 20, '2021-10-10', '2022-10-10', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(17, 13, 1, 10, 20, '2021-10-10', '2022-10-01', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(18, 14, 1, 10, 20, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(19, 15, 1, 15, 30, '2021-10-10', '2022-10-10', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(20, 16, 1, 10, 100, '2021-10-10', '2022-10-10', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(21, 17, 1, 10, 20, '2021-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(22, 18, 1, 10, 200, '2021-10-10', '2022-10-10', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(23, 19, 1, 10, 200, '2021-10-10', '2022-10-10', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(24, 20, 1, 15, 30, '2021-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(25, 21, 1, 10, 20, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(26, 22, 1, 10, 40, '2021-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(27, 23, 1, 10, 40, '2020-10-10', '2022-10-10', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(28, 24, 1, 10, 20, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(29, 25, 1, 10, 100, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(30, 26, 1, 10, 10, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(31, 27, 1, 10, 100, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(32, 28, 1, 10, 10, '2020-11-11', '2020-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(33, 29, 1, 10, 40, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(34, 30, 1, 10, 200, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(35, 31, 1, 10, 40, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(36, 32, 1, 10, 40, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(37, 33, 1, 10, 20, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(38, 34, 1, 10, 10, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(39, 35, 1, 10, 20, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(40, 36, 1, 10, 20, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(41, 37, 1, 10, 100, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(42, 38, 1, 10, 10, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(43, 39, 1, 10, 100, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(44, 40, 1, 10, 20, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(45, 41, 1, 10, 10, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(46, 42, 1, 10, 0, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(47, 43, 1, 10, 100, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(48, 44, 1, 10, 200, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(49, 45, 1, 15, 15, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(50, 46, 1, 15, 15, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(51, 47, 1, 10, 10, '2020-10-10', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(52, 48, 1, 10, 10, '2020-10-10', '2022-10-10', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(53, 49, 1, 10, 50, '2020-10-10', '2022-10-10', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(54, 50, 1, 10, 50, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(55, 51, 1, 10, 20, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(56, 52, 1, 10, 10, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(57, 53, 1, 10, 10, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(58, 54, 1, 10, 40, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(59, 55, 1, 15, 30, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(60, 56, 1, 10, 40, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(61, 57, 1, 10, 20, '2020-10-11', '2022-10-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(62, 58, 1, 10, 20, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(63, 59, 1, 10, 10, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(64, 60, 1, 10, 10, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(65, 61, 1, 10, 10, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(66, 62, 1, 10, 40, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(67, 63, 1, 10, 20, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(68, 64, 1, 10, 40, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(69, 65, 1, 10, 20, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(70, 66, 1, 10, 10, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(71, 67, 1, 10, 10, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(72, 68, 1, 10, 20, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(73, 69, 1, 10, 20, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(74, 70, 1, 10, 80, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(75, 71, 1, 10, 40, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(76, 72, 1, 10, 20, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(77, 73, 1, 10, 40, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(78, 74, 1, 10, 50, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(79, 75, 1, 10, 40, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(80, 76, 1, 10, 50, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(81, 77, 1, 10, 50, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(82, 78, 1, 10, 20, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(83, 79, 1, 10, 50, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(84, 80, 1, 10, 10, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(85, 81, 1, 10, 20, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(86, 82, 1, 10, 10, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(87, 83, 1, 10, 10, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(88, 84, 1, 10, 40, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(89, 85, 1, 10, 20, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(90, 86, 1, 10, 40, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(91, 87, 1, 10, 20, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(92, 88, 1, 10, 10, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(93, 89, 1, 10, 10, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(94, 90, 1, 10, 20, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(95, 91, 1, 10, 40, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(96, 92, 1, 10, 40, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(97, 93, 1, 10, 50, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(98, 94, 1, 10, 10, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(99, 95, 1, 10, 10, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(100, 96, 1, 10, 10, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(101, 97, 1, 10, 20, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(102, 98, 1, 10, 20, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(103, 99, 1, 10, 20, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(104, 100, 1, 10, 10, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(105, 101, 1, 10, 10, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(106, 102, 1, 10, 10, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(107, 128, 1, 10, 250, '2020-11-11', '2022-11-11', '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(108, 172, 1, 15, 15, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(109, 173, 1, 15, 15, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(110, 174, 1, 15, 15, '2023-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(111, 175, 1, 20, 3000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(112, 176, 1, 20, 2000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(113, 177, 1, 20, 2000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(114, 178, 1, 10, 1000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(115, 179, 1, 10, 1000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(116, 180, 1, 10, 1000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(117, 182, 1, 10, 1000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(118, 183, 1, 10, 1000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(119, 184, 1, 10, 1000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(120, 185, 1, 10, 1000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(121, 186, 1, 10, 1000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(122, 187, 1, 10, 1000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(123, 188, 1, 150, 150000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(124, 189, 1, 80, 40000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(125, 190, 1, 50, 50000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(126, 191, 1, 50, 25000, '2021-11-11', '2023-11-12', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(127, 192, 1, 50, 25000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(128, 193, 1, 50, 2500, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(129, 194, 1, 150, 7500, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(130, 195, 1, 80, 8000, '2021-11-12', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(131, 196, 1, 150, 15000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(132, 197, 1, 500, 250000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(133, 198, 1, 1000, 500000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(134, 199, 1, 2000, 1400000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(135, 200, 1, 2000, 1000000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(136, 201, 1, 70, 70000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(137, 202, 1, 100, 10000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(138, 203, 1, 70, 35000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(139, 204, 1, 130, 13000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(140, 205, 1, 110, 110000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(141, 206, 1, 50, 50, '2021-11-12', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(142, 207, 1, 70, 70, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(143, 208, 1, 80, 80, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(144, 209, 1, 40, 4000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(145, 210, 1, 20, 2000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(146, 211, 1, 20, 2000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(147, 212, 1, 500, 50000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(148, 213, 1, 300, 30000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(149, 214, 1, 1500, 51000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(150, 215, 1, 200, 16000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(151, 216, 1, 250, 250, '2021-11-12', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(152, 217, 1, 80, 1600, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(153, 218, 1, 10, 10, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(154, 219, 1, 180, 90000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(155, 220, 1, 180, 90000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(156, 221, 1, 190, 95000, '0201-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(157, 222, 1, 20, 5000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(158, 223, 1, 100, 25000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(159, 224, 1, 100, 25000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(160, 225, 1, 10, 1000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(161, 226, 1, 100, 2500, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(162, 227, 1, 10, 10, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(163, 228, 1, 100, 100, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(164, 229, 1, 100, 10000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(165, 230, 1, 1000, 10000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(166, 231, 1, 1000, 10000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(167, 232, 1, 500, 5000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(168, 233, 1, 50, 50, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(169, 234, 1, 15, 1500, '2021-11-11', '2023-11-12', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(170, 235, 1, 15, 1500, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(171, 236, 1, 10, 10000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(172, 237, 1, 10, 5000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(173, 238, 1, 10, 5000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(174, 239, 1, 10, 10000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(175, 240, 1, 50, 2500, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(176, 241, 1, 10, 10, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(177, 242, 1, 40, 40, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(178, 243, 1, 100, 10000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(179, 244, 1, 10, 10, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(180, 245, 1, 10, 10, '2023-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(181, 247, 1, 200, -400, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(182, 248, 1, 100, 2500, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(183, 249, 1, 20, 20, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(184, 250, 1, 10, 2500, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(185, 251, 1, 10, 5000, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(186, 252, 1, 10, 10, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(187, 253, 1, 10, 10, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(188, 254, 1, 10, 10, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(189, 255, 1, 10, 10, '2021-11-12', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(190, 256, 1, 10, 10, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(191, 257, 1, 10, 10, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(192, 258, 1, 10, 10, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(193, 259, 1, 10, 10, '2021-11-12', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(194, 260, 1, 100, 100, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(195, 261, 1, 10, 10, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(196, 262, 1, 10, 10, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(197, 263, 1, 10, 10, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(198, 264, 1, 10, 10, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(199, 265, 1, 10, 10, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(200, 266, 1, 10, 10, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(201, 267, 1, 10, 10, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(202, 268, 1, 10, 10, '0201-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(203, 269, 1, 10, 10, '2021-11-11', '2023-11-12', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(204, 270, 1, 10, 10, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(205, 271, 1, 10, 10, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(206, 272, 1, 10, 10, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(207, 273, 1, 10, 10, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(208, 274, 1, 10, 10, '2021-11-11', '2023-11-12', '2022-07-24 15:09:57', '2022-07-24 15:09:57'),
(209, 275, 1, 10, 10, '2021-11-11', '2023-11-11', '2022-07-24 15:09:57', '2022-07-24 15:09:57');

-- --------------------------------------------------------

--
-- Table structure for table `ingoings`
--

CREATE TABLE `ingoings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) NOT NULL,
  `is_daily` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ins`
--

CREATE TABLE `ins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `in_items`
--

CREATE TABLE `in_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `price` double(8,2) NOT NULL,
  `is_confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `store_id` int(11) UNSIGNED DEFAULT NULL,
  `finance_manager_id` int(11) UNSIGNED DEFAULT NULL,
  `ingoing_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `price` double(8,2) NOT NULL,
  `is_confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `store_id` int(11) UNSIGNED DEFAULT NULL,
  `finance_manager_id` int(11) UNSIGNED DEFAULT NULL,
  `outgoing_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lockers`
--

CREATE TABLE `lockers` (
  `id` bigint(20) NOT NULL,
  `number` float NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `foreign_id` bigint(20) NOT NULL,
  `store_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lockers`
--

INSERT INTO `lockers` (`id`, `number`, `type`, `category`, `foreign_id`, `store_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1000, 1, 'direct', 1, 1, 1, '2022-05-29 19:59:05', '2022-05-29 19:59:05'),
(2, 1000, 1, 'direct', 2, 1, 1, '2022-06-08 04:12:59', '2022-06-08 04:12:59'),
(3, 1000, 1, 'direct', 3, 1, 1, '2022-06-08 17:52:14', '2022-06-08 17:52:14'),
(4, 1000, 1, 'direct', 4, 1, 1, '2022-06-14 22:49:49', '2022-06-14 22:49:49'),
(5, 6000, 1, 'direct', 5, 1, 1, '2022-06-23 03:43:42', '2022-06-23 03:43:42'),
(6, 11011, 1, 'direct', 6, 1, 1, '2022-07-20 17:47:43', '2022-07-20 17:47:43'),
(7, 1, 1, 'direct', 7, 1, 1, '2022-07-24 15:09:57', '2022-07-24 15:09:57');

-- --------------------------------------------------------

--
-- Table structure for table `loses`
--

CREATE TABLE `loses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loss` double NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mandobs`
--

CREATE TABLE `mandobs` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `section` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wallet` decimal(10,0) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mandobs`
--

INSERT INTO `mandobs` (`id`, `status`, `name`, `phone`, `password`, `address`, `section`, `wallet`, `created_at`, `updated_at`) VALUES
(1, 0, 'Ali Khalifa', '01122897651', '$2y$10$T9Bsj7rzAkxaGypo4FZiS.Hr5SbD8d3rYeh846oNFaZOHnd0KQfLW', 'giza', NULL, '1049', '2022-06-08 17:11:33', '2022-06-08 18:49:11'),
(2, 0, 'test', '01234567891', '$2y$10$MqekCXMmVCPWsARNW0C9pukqMPaZH1Z1hb1hmb/s8h8T/Cv9SxWJS', 'cairo', NULL, '0', '2022-07-17 18:31:29', '2022-07-17 18:31:29');

-- --------------------------------------------------------

--
-- Table structure for table `mandob_place`
--

CREATE TABLE `mandob_place` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `place_id` bigint(20) UNSIGNED NOT NULL,
  `mandob_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mandob_place`
--

INSERT INTO `mandob_place` (`id`, `place_id`, `mandob_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mandob_stages`
--

CREATE TABLE `mandob_stages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mandob_stages`
--

INSERT INTO `mandob_stages` (`id`, `stage`, `created_at`, `updated_at`) VALUES
(1, 'استلام الطلب', NULL, NULL),
(2, 'يتم تسليم الطلب للعميل', NULL, NULL),
(3, 'فام بتسليم الطلب', NULL, NULL),
(4, 'لم يقم بتسليم الطلب', NULL, NULL),
(5, 'تم التسليم يوجد مرتجع', NULL, NULL),
(6, 'يتم تسليم المرتجع للمخزن', NULL, NULL),
(7, 'تم تسليم المرتجع', NULL, NULL);

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
(0, '2021_03_08_123505_create_places_table', 2),
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `min_prices`
--

CREATE TABLE `min_prices` (
  `id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `min_prices`
--

INSERT INTO `min_prices` (`id`, `price`, `created_at`, `updated_at`) VALUES
(1, 1000, '2021-06-15 18:44:16', '2022-06-26 01:35:10');

-- --------------------------------------------------------

--
-- Table structure for table `mondob_rates`
--

CREATE TABLE `mondob_rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rate` int(11) NOT NULL,
  `mandob_id` int(10) UNSIGNED DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mondob_rates`
--

INSERT INTO `mondob_rates` (`id`, `rate`, `mandob_id`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 5, '2022-06-08 18:49:22', '2022-06-08 18:49:22');

-- --------------------------------------------------------

--
-- Table structure for table `mongez`
--

CREATE TABLE `mongez` (
  `id` int(11) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `time` int(11) NOT NULL DEFAULT 0,
  `from` int(11) NOT NULL DEFAULT 0,
  `to` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mongez`
--

INSERT INTO `mongez` (`id`, `price`, `time`, `from`, `to`, `created_at`, `updated_at`) VALUES
(1, '1.50', 20, 1, 100, '2022-05-10 22:39:20', '2022-05-10 22:39:20'),
(2, '2.00', 24, 101, 200, '2022-05-10 23:25:45', '2022-05-10 23:26:57'),
(3, '2.40', 30, 201, 300, '2022-05-10 23:26:45', '2022-06-08 03:08:47');

-- --------------------------------------------------------

--
-- Table structure for table `mostproducts`
--

CREATE TABLE `mostproducts` (
  `id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notifies`
--

CREATE TABLE `notifies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `min_total` double(8,2) NOT NULL,
  `min_unit` double(8,2) NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notify_totals`
--

CREATE TABLE `notify_totals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `min_total` double(8,2) NOT NULL,
  `min_unit` double(8,2) NOT NULL,
  `percentage_total` float NOT NULL DEFAULT 0,
  `percentage_unit` float NOT NULL DEFAULT 0,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notify_total_product`
--

CREATE TABLE `notify_total_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `notify_total_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notify_units`
--

CREATE TABLE `notify_units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `discount_total` int(11) NOT NULL DEFAULT 0,
  `discount_unit` int(11) NOT NULL DEFAULT 0,
  `now_total` int(11) NOT NULL DEFAULT 0,
  `now_unit` int(11) NOT NULL DEFAULT 0,
  `later_total` int(11) NOT NULL DEFAULT 0,
  `later_unit` int(11) NOT NULL DEFAULT 0,
  `product_id` int(10) UNSIGNED NOT NULL,
  `notify_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notify_users`
--

CREATE TABLE `notify_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `notify_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notify_user_units`
--

CREATE TABLE `notify_user_units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `discount_total` int(11) NOT NULL DEFAULT 0,
  `discount_unit` int(11) NOT NULL DEFAULT 0,
  `now_total` int(11) NOT NULL DEFAULT 0,
  `now_unit` int(11) NOT NULL DEFAULT 0,
  `later_total` int(11) NOT NULL DEFAULT 0,
  `later_unit` int(11) NOT NULL DEFAULT 0,
  `product_id` int(10) UNSIGNED NOT NULL,
  `notify_user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offer_points`
--

CREATE TABLE `offer_points` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `total` double(8,2) NOT NULL,
  `points` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `option` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `option`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'عدم السماح للعميل بالطلب الا اذا كان هناك كميه', 0, NULL, '2022-05-09 15:54:35'),
(2, 'تعين المخزن للطلبات القادمه يدويا', 1, NULL, '2022-07-20 20:02:47'),
(3, 'دمج كميات المنتج في جميع المخازن اثناء شراء العميل', 0, NULL, '2022-03-08 17:00:52'),
(4, 'تحويل الخصومات الاجله بنظام كاش باك يتم تحصيل العميل المبلغ اوتوماتيكيا عند الطلب مره اخرى', 0, NULL, '2022-04-09 17:39:02'),
(5, 'غلق الابلكيشن', 0, NULL, '2022-06-17 06:01:06'),
(6, 'اخفاء الخصومات', 1, NULL, '2022-03-08 17:01:02'),
(7, 'اظهار الشريط الاخضر الخاص بالخصم', 1, NULL, '2022-03-19 23:26:11');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_type` int(11) NOT NULL DEFAULT 1,
  `price_total_sum` double(8,2) NOT NULL,
  `price_unit_sum` double(8,2) NOT NULL,
  `delivery_amount` float NOT NULL DEFAULT 0,
  `visa_amount` float NOT NULL DEFAULT 0,
  `qema_modafa` float NOT NULL DEFAULT 0,
  `payment_type` float NOT NULL DEFAULT 0,
  `recall_total_price` float NOT NULL DEFAULT 0,
  `recall_unit_price` float NOT NULL DEFAULT 0,
  `is_complete` tinyint(1) NOT NULL DEFAULT 0,
  `is_canceled` tinyint(1) NOT NULL DEFAULT 0,
  `is_direct_sell` tinyint(1) NOT NULL DEFAULT 0,
  `date_of_order` date NOT NULL,
  `date_of_receipt` date DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_value` double(8,2) DEFAULT NULL,
  `rest_value` double(8,2) DEFAULT NULL,
  `received_money` float NOT NULL DEFAULT 0,
  `minus_notify` float NOT NULL DEFAULT 0,
  `cash_back` float NOT NULL DEFAULT 0,
  `future_cash_back` float NOT NULL DEFAULT 0,
  `total_minus_paid` float NOT NULL DEFAULT 0,
  `total_minus` float NOT NULL DEFAULT 0,
  `min_total` int(11) NOT NULL DEFAULT 0,
  `min_unit` int(11) NOT NULL DEFAULT 0,
  `unit_minus` float NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL,
  `store_id` int(11) UNSIGNED DEFAULT NULL,
  `mandob_id` int(11) UNSIGNED DEFAULT NULL,
  `mondob_stage_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transfer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `direction_id` bigint(20) UNSIGNED NOT NULL,
  `order_stage_id` bigint(20) UNSIGNED DEFAULT NULL,
  `has_recall` tinyint(1) NOT NULL DEFAULT 0,
  `confirm_received_money` float NOT NULL DEFAULT 0,
  `received_money_from_f_m` float NOT NULL DEFAULT 0,
  `finance_manager_id` bigint(20) DEFAULT NULL,
  `seller_id` bigint(20) DEFAULT NULL,
  `received_direct_sell_money_from_f_m` float NOT NULL,
  `direct_sell_finance_manager_id` bigint(20) NOT NULL,
  `confirm_delivery_receipt` tinyint(1) NOT NULL DEFAULT 0,
  `keeper_id` bigint(20) DEFAULT NULL,
  `direct_selle_keeper_id` bigint(20) DEFAULT NULL,
  `direct_selle_confirm_delivery_receipt` tinyint(1) NOT NULL DEFAULT 0,
  `fatora_dripa` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `type`, `invoice_type`, `price_total_sum`, `price_unit_sum`, `delivery_amount`, `visa_amount`, `qema_modafa`, `payment_type`, `recall_total_price`, `recall_unit_price`, `is_complete`, `is_canceled`, `is_direct_sell`, `date_of_order`, `date_of_receipt`, `comment`, `paid_value`, `rest_value`, `received_money`, `minus_notify`, `cash_back`, `future_cash_back`, `total_minus_paid`, `total_minus`, `min_total`, `min_unit`, `unit_minus`, `user_id`, `store_id`, `mandob_id`, `mondob_stage_id`, `transfer_id`, `direction_id`, `order_stage_id`, `has_recall`, `confirm_received_money`, `received_money_from_f_m`, `finance_manager_id`, `seller_id`, `received_direct_sell_money_from_f_m`, `direct_sell_finance_manager_id`, `confirm_delivery_receipt`, `keeper_id`, `direct_selle_keeper_id`, `direct_selle_confirm_delivery_receipt`, `fatora_dripa`, `created_at`, `updated_at`) VALUES
(2, NULL, 1, 3000.00, 0.00, 0, 0, 0, 0, 0, 0, 1, 0, 0, '2022-05-29', NULL, '30.0337327,31.2126497', NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1277364554, 1, NULL, NULL, NULL, 0, 1, 0, 0, 0, NULL, 1, 0, 0, 0, NULL, NULL, 0, 0, '2022-05-30 00:42:09', '2022-06-13 14:41:07'),
(4, 'total', 2, 180.20, 0.00, 0, 0, 0, 0, 0, 0, 1, 0, 1, '2022-06-07', NULL, NULL, NULL, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1004974049, 1, NULL, NULL, NULL, 0, 5, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, 0, 1, '2022-06-08 04:10:44', '2022-06-08 04:10:45'),
(5, NULL, 1, 1049.36, 0.00, 0, 0, 0, 0, 0, 0, 1, 0, 0, '2022-06-08', NULL, '30.0335896,31.2126422', 1049.36, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1119684897, 1, 1, 3, NULL, 0, 5, 0, 0, 0, NULL, 1, 0, 0, 0, NULL, NULL, 0, 0, '2022-06-08 16:52:41', '2022-06-08 18:49:11'),
(6, 'total', 2, 432.15, 0.00, 0, 0, 0, 0, 0, 0, 1, 0, 1, '2022-06-08', NULL, NULL, NULL, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1119684897, 1, NULL, NULL, NULL, 0, 5, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, 0, 0, '2022-06-08 17:49:50', '2022-06-08 17:49:50'),
(7, NULL, 1, 2229.56, 0.00, 0, 0, 0, 0, 0, 0, 1, 0, 0, '2022-06-08', NULL, '30.0336041,31.2126461', NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1119684897, 1, NULL, NULL, NULL, 0, NULL, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, 0, 0, '2022-06-08 18:34:53', '2022-06-08 18:34:53'),
(10, NULL, 1, 1271.47, 0.00, 0, 0, 0, 0, 0, 0, 1, 0, 0, '2022-07-20', NULL, '30.0267896,31.2327076', NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1004974049, 1, NULL, NULL, NULL, 0, NULL, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, 0, 0, '2022-07-20 18:01:39', '2022-07-20 18:01:39'),
(11, NULL, 1, 2051.37, 0.00, 0, 0, 0, 0, 0, 0, 1, 0, 0, '2022-07-20', NULL, '30.0267561,31.2326898', NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1119684897, 1, NULL, NULL, NULL, 0, NULL, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, 0, 0, '2022-07-20 18:07:15', '2022-07-20 18:07:15');

-- --------------------------------------------------------

--
-- Table structure for table `order_stages`
--

CREATE TABLE `order_stages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_stages`
--

INSERT INTO `order_stages` (`id`, `stage`, `created_at`, `updated_at`) VALUES
(1, ' جاري المعالجه', NULL, NULL),
(2, ' تم التأكيد\r\n', NULL, NULL),
(3, ' جاري التحضير', NULL, NULL),
(4, ' في الطريق', NULL, NULL),
(5, ' تم التسليم', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_units`
--

CREATE TABLE `order_units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quantity_total` int(11) NOT NULL,
  `quantity_unit` int(11) NOT NULL,
  `price` float DEFAULT 0,
  `price_unit` float DEFAULT 0,
  `buy_price` float NOT NULL DEFAULT 0,
  `additional_discount_price` float NOT NULL DEFAULT 0,
  `additional_discount_percentage` float NOT NULL DEFAULT 0,
  `qema_modafa` float NOT NULL DEFAULT 0,
  `return_status` bigint(20) DEFAULT NULL,
  `receive_total` int(11) NOT NULL DEFAULT 0,
  `recall_total` int(11) NOT NULL DEFAULT 0,
  `receive_unit` int(11) NOT NULL DEFAULT 0,
  `recall_unit` int(11) NOT NULL DEFAULT 0,
  `product_id` int(10) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_units`
--

INSERT INTO `order_units` (`id`, `quantity_total`, `quantity_unit`, `price`, `price_unit`, `buy_price`, `additional_discount_price`, `additional_discount_percentage`, `qema_modafa`, `return_status`, `receive_total`, `recall_total`, `receive_unit`, `recall_unit`, `product_id`, `order_id`, `created_at`, `updated_at`) VALUES
(3, 100, 0, 30, 0, 0, 0, 0, 0, NULL, 100, 0, 0, 0, 5, 2, '2022-05-30 00:42:09', '2022-05-30 00:42:09'),
(5, 10, 0, 18.02, 0, 3, 0, 0, 0, NULL, 0, 0, 0, 0, 1, 4, '2022-06-08 04:10:45', '2022-06-08 04:10:45'),
(6, 14, 0, 18.02, 0, 0, 0, 0, 0, NULL, 14, 0, 0, 0, 1, 5, '2022-06-08 16:52:41', '2022-06-08 16:52:41'),
(7, 7, 0, 120, 0, 0, 0, 0, 0, NULL, 7, 0, 0, 0, 2, 5, '2022-06-08 16:52:41', '2022-06-08 16:52:41'),
(8, 6, 0, 18.02, 0, 3, 0, 0, 0, NULL, 0, 0, 0, 0, 1, 6, '2022-06-08 17:49:50', '2022-06-08 17:49:50'),
(9, 3, 0, 120, 0, 3, 0, 0, 0, NULL, 0, 0, 0, 0, 2, 6, '2022-06-08 17:49:50', '2022-06-08 17:49:50'),
(10, 0, 0, 30, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 5, 7, '2022-06-08 18:34:53', '2022-06-08 18:34:53'),
(11, 26, 0, 18.02, 0, 0, 0, 0, 0, NULL, 26, 0, 0, 0, 1, 7, '2022-06-08 18:34:53', '2022-06-08 18:34:53'),
(12, 6, 0, 120, 0, 0, 0, 0, 0, NULL, 6, 0, 0, 0, 2, 7, '2022-06-08 18:34:53', '2022-06-08 18:34:53'),
(15, 4, 0, 120, 0, 0, 0, 0, 0, NULL, 4, 0, 0, 0, 2, 10, '2022-07-20 18:01:39', '2022-07-20 18:01:39'),
(16, 4, 0, 100, 0, 0, 0, 0, 0, NULL, 4, 0, 0, 0, 1, 10, '2022-07-20 18:01:39', '2022-07-20 18:01:39'),
(17, 3, 0, 120, 0, 0, 0, 0, 0, NULL, 3, 0, 0, 0, 7, 10, '2022-07-20 18:01:39', '2022-07-20 18:01:39'),
(18, 20, 0, 100, 0, 0, 0, 0, 0, NULL, 20, 0, 0, 0, 1, 11, '2022-07-20 18:07:15', '2022-07-20 18:07:15'),
(19, 0, 0, 5, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 138, 11, '2022-07-20 18:07:15', '2022-07-20 18:07:15');

-- --------------------------------------------------------

--
-- Table structure for table `outgoings`
--

CREATE TABLE `outgoings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) NOT NULL,
  `is_daily` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `outs`
--

CREATE TABLE `outs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `outs`
--

INSERT INTO `outs` (`id`, `date`, `order_id`, `created_at`, `updated_at`) VALUES
(1, '2022-06-07', 4, '2022-06-08 04:11:02', '2022-06-08 04:11:02'),
(2, '2022-06-08', 6, '2022-06-08 17:50:05', '2022-06-08 17:50:05'),
(3, '2022-06-08', 5, '2022-06-08 18:38:56', '2022-06-08 18:38:56');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `name` text NOT NULL,
  `id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `package_products`
--

CREATE TABLE `package_products` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'create-users', 'Create Users', 'Create Users', '2021-03-28 14:49:04', '2021-03-28 14:49:04'),
(2, 'read-users', 'Read Users', 'Read Users', '2021-03-28 14:49:04', '2021-03-28 14:49:04'),
(3, 'update-users', 'Update Users', 'Update Users', '2021-03-28 14:49:04', '2021-03-28 14:49:04'),
(4, 'delete-users', 'Delete Users', 'Delete Users', '2021-03-28 14:49:04', '2021-03-28 14:49:04'),
(5, 'create-categories', 'Create Categories', 'Create Categories', '2021-03-28 14:49:04', '2021-03-28 14:49:04'),
(6, 'read-categories', 'Read Categories', 'Read Categories', '2021-03-28 14:49:04', '2021-03-28 14:49:04'),
(7, 'update-categories', 'Update Categories', 'Update Categories', '2021-03-28 14:49:04', '2021-03-28 14:49:04'),
(8, 'delete-categories', 'Delete Categories', 'Delete Categories', '2021-03-28 14:49:04', '2021-03-28 14:49:04'),
(9, 'create-companies', 'Create Companies', 'Create Companies', '2021-03-28 14:49:04', '2021-03-28 14:49:04'),
(10, 'read-companies', 'Read Companies', 'Read Companies', '2021-03-28 14:49:04', '2021-03-28 14:49:04'),
(11, 'update-companies', 'Update Companies', 'Update Companies', '2021-03-28 14:49:04', '2021-03-28 14:49:04'),
(12, 'delete-companies', 'Delete Companies', 'Delete Companies', '2021-03-28 14:49:04', '2021-03-28 14:49:04'),
(13, 'create-complaint_products', 'Create Complaint_products', 'Create Complaint_products', '2021-03-28 14:49:04', '2021-03-28 14:49:04'),
(14, 'read-complaint_products', 'Read Complaint_products', 'Read Complaint_products', '2021-03-28 14:49:04', '2021-03-28 14:49:04'),
(15, 'update-complaint_products', 'Update Complaint_products', 'Update Complaint_products', '2021-03-28 14:49:04', '2021-03-28 14:49:04'),
(16, 'delete-complaint_products', 'Delete Complaint_products', 'Delete Complaint_products', '2021-03-28 14:49:04', '2021-03-28 14:49:04'),
(17, 'create-complaints', 'Create Complaints', 'Create Complaints', '2021-03-28 14:49:04', '2021-03-28 14:49:04'),
(18, 'read-complaints', 'Read Complaints', 'Read Complaints', '2021-03-28 14:49:04', '2021-03-28 14:49:04'),
(19, 'update-complaints', 'Update Complaints', 'Update Complaints', '2021-03-28 14:49:04', '2021-03-28 14:49:04'),
(20, 'delete-complaints', 'Delete Complaints', 'Delete Complaints', '2021-03-28 14:49:04', '2021-03-28 14:49:04'),
(21, 'create-depts', 'Create Depts', 'Create Depts', '2021-03-28 14:49:04', '2021-03-28 14:49:04'),
(22, 'read-depts', 'Read Depts', 'Read Depts', '2021-03-28 14:49:04', '2021-03-28 14:49:04'),
(23, 'update-depts', 'Update Depts', 'Update Depts', '2021-03-28 14:49:04', '2021-03-28 14:49:04'),
(24, 'delete-depts', 'Delete Depts', 'Delete Depts', '2021-03-28 14:49:04', '2021-03-28 14:49:04'),
(25, 'create-examinations', 'Create Examinations', 'Create Examinations', '2021-03-28 14:49:04', '2021-03-28 14:49:04'),
(26, 'read-examinations', 'Read Examinations', 'Read Examinations', '2021-03-28 14:49:04', '2021-03-28 14:49:04'),
(27, 'update-examinations', 'Update Examinations', 'Update Examinations', '2021-03-28 14:49:04', '2021-03-28 14:49:04'),
(28, 'delete-examinations', 'Delete Examinations', 'Delete Examinations', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(29, 'create-infos', 'Create Infos', 'Create Infos', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(30, 'read-infos', 'Read Infos', 'Read Infos', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(31, 'update-infos', 'Update Infos', 'Update Infos', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(32, 'delete-infos', 'Delete Infos', 'Delete Infos', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(33, 'create-mandobs', 'Create Mandobs', 'Create Mandobs', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(34, 'read-mandobs', 'Read Mandobs', 'Read Mandobs', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(35, 'update-mandobs', 'Update Mandobs', 'Update Mandobs', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(36, 'delete-mandobs', 'Delete Mandobs', 'Delete Mandobs', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(37, 'create-mandob_stages', 'Create Mandob_stages', 'Create Mandob_stages', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(38, 'read-mandob_stages', 'Read Mandob_stages', 'Read Mandob_stages', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(39, 'update-mandob_stages', 'Update Mandob_stages', 'Update Mandob_stages', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(40, 'delete-mandob_stages', 'Delete Mandob_stages', 'Delete Mandob_stages', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(41, 'create-mandob_rates', 'Create Mandob_rates', 'Create Mandob_rates', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(42, 'read-mandob_rates', 'Read Mandob_rates', 'Read Mandob_rates', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(43, 'update-mandob_rates', 'Update Mandob_rates', 'Update Mandob_rates', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(44, 'delete-mandob_rates', 'Delete Mandob_rates', 'Delete Mandob_rates', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(45, 'create-user_rates', 'Create User_rates', 'Create User_rates', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(46, 'read-user_rates', 'Read User_rates', 'Read User_rates', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(47, 'update-user_rates', 'Update User_rates', 'Update User_rates', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(48, 'delete-user_rates', 'Delete User_rates', 'Delete User_rates', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(49, 'create-most_products', 'Create Most_products', 'Create Most_products', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(50, 'read-most_products', 'Read Most_products', 'Read Most_products', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(51, 'update-most_products', 'Update Most_products', 'Update Most_products', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(52, 'delete-most_products', 'Delete Most_products', 'Delete Most_products', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(53, 'create-notifies', 'Create Notifies', 'Create Notifies', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(54, 'read-notifies', 'Read Notifies', 'Read Notifies', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(55, 'update-notifies', 'Update Notifies', 'Update Notifies', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(56, 'delete-notifies', 'Delete Notifies', 'Delete Notifies', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(57, 'create-notify_users', 'Create Notify_users', 'Create Notify_users', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(58, 'read-notify_users', 'Read Notify_users', 'Read Notify_users', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(59, 'update-notify_users', 'Update Notify_users', 'Update Notify_users', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(60, 'delete-notify_users', 'Delete Notify_users', 'Delete Notify_users', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(61, 'create-orders', 'Create Orders', 'Create Orders', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(62, 'read-orders', 'Read Orders', 'Read Orders', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(63, 'update-orders', 'Update Orders', 'Update Orders', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(64, 'delete-orders', 'Delete Orders', 'Delete Orders', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(65, 'create-order_stages', 'Create Order_stages', 'Create Order_stages', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(66, 'read-order_stages', 'Read Order_stages', 'Read Order_stages', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(67, 'update-order_stages', 'Update Order_stages', 'Update Order_stages', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(68, 'delete-order_stages', 'Delete Order_stages', 'Delete Order_stages', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(69, 'create-places', 'Create Places', 'Create Places', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(70, 'read-places', 'Read Places', 'Read Places', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(71, 'update-places', 'Update Places', 'Update Places', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(72, 'delete-places', 'Delete Places', 'Delete Places', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(73, 'create-products', 'Create Products', 'Create Products', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(74, 'read-products', 'Read Products', 'Read Products', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(75, 'update-products', 'Update Products', 'Update Products', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(76, 'delete-products', 'Delete Products', 'Delete Products', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(78, 'create-receipt_status', 'Create Receipt_status', 'Create Receipt_status', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(79, 'read-receipt_status', 'Read Receipt_status', 'Read Receipt_status', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(80, 'update-receipt_status', 'Update Receipt_status', 'Update Receipt_status', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(81, 'delete-receipt_status', 'Delete Receipt_status', 'Delete Receipt_status', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(82, 'create-return_reasons', 'Create Return_reasons', 'Create Return_reasons', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(83, 'read-return_reasons', 'Read Return_reasons', 'Read Return_reasons', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(84, 'update-return_reasons', 'Update Return_reasons', 'Update Return_reasons', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(85, 'delete-return_reasons', 'Delete Return_reasons', 'Delete Return_reasons', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(86, 'create-sliders', 'Create Sliders', 'Create Sliders', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(87, 'read-sliders', 'Read Sliders', 'Read Sliders', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(88, 'update-sliders', 'Update Sliders', 'Update Sliders', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(89, 'delete-sliders', 'Delete Sliders', 'Delete Sliders', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(90, 'create-stores', 'Create Stores', 'Create Stores', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(91, 'read-stores', 'Read Stores', 'Read Stores', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(92, 'update-stores', 'Update Stores', 'Update Stores', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(93, 'delete-stores', 'Delete Stores', 'Delete Stores', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(94, 'create-subcategories', 'Create Subcategories', 'Create Subcategories', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(95, 'read-subcategories', 'Read Subcategories', 'Read Subcategories', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(96, 'update-subcategories', 'Update Subcategories', 'Update Subcategories', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(97, 'delete-subcategories', 'Delete Subcategories', 'Delete Subcategories', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(98, 'create-clients', 'Create Clients', 'Create Clients', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(99, 'read-clients', 'Read Clients', 'Read Clients', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(100, 'update-clients', 'Update Clients', 'Update Clients', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(101, 'delete-clients', 'Delete Clients', 'Delete Clients', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(102, 'create-statistics', 'Create Statistics', 'Create Statistics', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(103, 'read-statistics', 'Read Statistics', 'Read Statistics', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(104, 'update-statistics', 'Update Statistics', 'Update Statistics', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(105, 'delete-statistics', 'Delete Statistics', 'Delete Statistics', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(106, 'read-store', 'Read Store', 'Read Store', '2021-03-28 14:49:05', '2021-03-28 14:49:05'),
(107, 'create-direct_sells', 'Create Direct Sell', 'Create Direct Sell', NULL, NULL),
(108, 'read-direct_sells', 'Read Direct Sells', 'Read Direct Sells', NULL, NULL),
(109, 'update-direct_sells', 'Update Direct Sells', 'Update Direct Sells', NULL, NULL),
(110, 'delete-direct_sells', 'Delete Direct Sells', 'Delete Direct Sells', NULL, NULL),
(111, 'read-transfers', 'Read Transfers', 'Read Transfers', NULL, NULL),
(112, 'create-transfers', 'Create Transfers', 'Create Transfers', NULL, NULL),
(113, 'update-transfers', 'Update Transfers', 'Update Transfers', NULL, NULL),
(114, 'delete-transfers', 'Delete Transfers', 'Delete Transfers', NULL, NULL),
(115, 'create-suppliers', 'create-suppliers', 'create-suppliers', NULL, NULL),
(116, 'read-suppliers', 'read-suppliers', 'read-suppliers', NULL, NULL),
(117, 'update-suppliers', 'update-suppliers', 'update-suppliers', NULL, NULL),
(118, 'delete-suppliers', 'delete-suppliers', 'delete-suppliers', NULL, NULL),
(119, 'read-offer_points', 'read-offer_points', 'read-offer_points', NULL, NULL),
(120, 'create-offer_points', 'create-offer_points', 'create-offer_points', NULL, NULL),
(121, 'update-offer_points', 'update-offer_points', 'update-offer_points', NULL, NULL),
(122, 'delete-offer_points', 'delete-offer_points', 'delete-offer_points', NULL, NULL),
(123, 'create-options', 'create-options', 'create-options', '2021-08-09 01:23:17', '2021-08-09 01:23:32'),
(124, 'update-options', 'update-options', 'update-options', '2021-08-09 01:23:39', '2021-08-09 01:23:45'),
(125, 'delete-options', 'delete-options', 'delete-options', '2021-08-09 01:23:53', '2021-08-09 01:23:59'),
(126, 'create-directions', 'create-directions', 'create-directions', NULL, NULL),
(127, 'update-directions', 'update-directions', 'update-directions', NULL, NULL),
(128, 'delete-directions', 'delete-directions', 'delete-directions', NULL, NULL),
(129, 'create-add_notifications', 'create-add_notifications', 'create-add_notifications', NULL, NULL),
(130, 'update-add_notifications', 'update-add_notifications', 'update-add_notifications', NULL, NULL),
(131, 'delete-add_notifications', 'delete-add_notifications', 'delete-add_notifications', NULL, NULL),
(132, 'create-kinds_of_shops', 'create-kinds_of_shops', 'create-kinds_of_shops', NULL, NULL),
(133, 'update-kinds_of_shops', 'update-kinds_of_shops', 'update-kinds_of_shops', NULL, NULL),
(134, 'delete-kinds_of_shops', 'delete-kinds_of_shops', 'delete-kinds_of_shops', NULL, NULL),
(135, 'create-expenses', 'create-expenses', 'create-expenses', NULL, NULL),
(136, 'update-expenses', 'update-expenses', 'update-expenses', NULL, NULL),
(137, 'delete-expenses', 'delete-expenses', 'delete-expenses', NULL, NULL),
(138, 'create-slider', 'create-slider', 'create-slider', NULL, NULL),
(139, 'update-slider', 'update-slider', 'update-slider', NULL, NULL),
(140, 'delete-slider', 'delete-slider', 'delete-slider', NULL, NULL),
(141, 'create-best_selling_products', 'create-best_selling_products', 'create-best_selling_products', NULL, NULL),
(142, 'update-best_selling_products', 'update-best_selling_products', 'update-best_selling_products', NULL, NULL),
(143, 'delete-best_selling_products', 'delete-best_selling_products', 'delete-best_selling_products', NULL, NULL),
(144, 'create-total_demand_for_products', 'create-total_demand_for_products', 'create-total_demand_for_products', NULL, NULL),
(145, 'update-total_demand_for_products', 'update-total_demand_for_products', 'update-total_demand_for_products', NULL, NULL),
(146, 'delete-total_demand_for_products', 'delete-total_demand_for_products', 'delete-total_demand_for_products', NULL, NULL),
(147, 'create-income_generated_from_the_sale_of_products', 'create-income_generated_from_the_sale_of_products', 'create-income_generated_from_the_sale_of_products', NULL, NULL),
(148, 'update-income_generated_from_the_sale_of_products', 'update-income_generated_from_the_sale_of_products', 'update-income_generated_from_the_sale_of_products', NULL, NULL),
(149, 'delete-income_generated_from_the_sale_of_products', 'delete-income_generated_from_the_sale_of_products', 'delete-income_generated_from_the_sale_of_products', NULL, NULL),
(150, 'create-revenues', 'create-revenues', 'create-revenues', NULL, NULL),
(151, 'update-revenues', 'update-revenues', 'update-revenues', NULL, NULL),
(152, 'delete-revenues', 'delete-revenues', 'delete-revenues', NULL, NULL),
(153, 'create-the_credit_strenght_of_each_customer', 'create-the_credit_strenght_of_each_customer', 'create-the_credit_strenght_of_each_customer', NULL, NULL),
(154, 'update-the_credit_strenght_of_each_customer', 'update-the_credit_strenght_of_each_customer', 'update-the_credit_strenght_of_each_customer', NULL, NULL),
(155, 'delete-the_credit_strenght_of_each_customer', 'delete-the_credit_strenght_of_each_customer', 'delete-the_credit_strenght_of_each_customer', NULL, NULL),
(156, 'read-options', 'read-options', 'read-options', NULL, NULL),
(157, 'read-directions', 'read-directions', 'read-directions', NULL, NULL),
(158, 'read-add_notifications', 'read-add_notifications', 'read-add_notifications', NULL, NULL),
(159, 'read-kinds_of_shops', 'read-kinds_of_shops', 'read-kinds_of_shops', NULL, NULL),
(160, 'read-expenses', 'read-expenses', 'read-expenses', NULL, NULL),
(161, 'read-slider', 'read-slider', 'read-slider', NULL, NULL),
(162, 'read-best_selling_products', 'read-best_selling_products', 'read-best_selling_products', NULL, NULL),
(163, 'read-total_demand_for_products', 'read-total_demand_for_products', 'read-total_demand_for_products', NULL, NULL),
(164, 'read-income_generated_from_the_sale_of_products', 'read-income_generated_from_the_sale_of_products', 'read-income_generated_from_the_sale_of_products', NULL, NULL),
(165, 'read-revenues', 'read-revenues', 'read-revenues', NULL, NULL),
(166, 'read-the_credit_strenght_of_each_customer', 'read-the_credit_strenght_of_each_customer', 'read-the_credit_strenght_of_each_customer', NULL, NULL),
(167, 'read-contacts', 'read-contacts', 'read-contacts', NULL, NULL),
(168, 'create-contacts', 'create-contacts', 'create-contacts', NULL, NULL),
(169, 'update-contacts', 'update-contacts', 'update-contacts', NULL, NULL),
(170, 'delete-contacts', 'delete-contacts', 'delete-contacts', NULL, NULL),
(171, 'read-reports', 'read-reports', 'read-reports', NULL, NULL),
(172, 'create-reports', 'create-reports', 'create-reports', NULL, NULL),
(173, 'update-reports', 'update-reports', 'update-reports', NULL, NULL),
(174, 'delete-reports', 'delete-reports', 'delete-reports', NULL, NULL),
(175, 'create-edited_orders', 'create-edited_orders', 'create-edited_orders', NULL, NULL),
(176, 'read-edited_orders', 'read-edited_orders', 'read-edited_orders', NULL, NULL),
(177, 'update-edited_orders', 'update-edited_orders', 'update-edited_orders', NULL, NULL),
(178, 'delete-edited_orders', 'delete-edited_orders', 'delete-edited_orders', NULL, NULL),
(179, 'read-min_prices', 'read-min_prices', 'read-min_prices', NULL, NULL),
(180, 'create-min_prices', 'create-min_prices', 'create-min_prices', NULL, NULL),
(181, 'update-min_prices', 'update-min_prices', 'update-min_prices', NULL, NULL),
(182, 'delete-min_prices', 'delete-min_prices', 'delete-min_prices', NULL, NULL),
(183, 'read-activity_type', 'read-activity_type', 'read-activity_type', NULL, NULL),
(184, 'create-activity_type', 'create-activity_type', 'create-activity_type', NULL, NULL),
(185, 'update-activity_type', 'update-activity_type', 'update-activity_type', NULL, NULL),
(186, 'delete-activity_type', 'delete-activity_type', 'delete-activity_type', NULL, NULL),
(187, 'read-complaint_type', 'read-complaint_type', 'read-complaint_type', NULL, NULL),
(188, 'create-complaint_type', 'create-complaint_type', 'create-complaint_type', NULL, NULL),
(189, 'update-complaint_type', 'update-complaint_type', 'update-complaint_type', NULL, NULL),
(190, 'delete-complaint_type', 'delete-complaint_type', 'delete-complaint_type', NULL, NULL),
(191, 'read-discount_type', 'read-discount_type', 'read-discount_type', NULL, NULL),
(192, 'create-discount_type', 'create-discount_type', 'create-discount_type', NULL, NULL),
(193, 'update-discount_type', 'update-discount_type', 'update-discount_type', NULL, NULL),
(194, 'delete-discount_type', 'delete-discount_type', 'delete-discount_type', NULL, NULL),
(195, 'read-ads', 'read-ads', 'read-ads', NULL, NULL),
(196, 'create-ads', 'create-ads', 'create-ads', NULL, NULL),
(197, 'update-ads', 'update-ads', 'update-ads', NULL, NULL),
(198, 'delete-ads', 'delete-ads', 'delete-ads', NULL, NULL),
(199, 'read-coupons', 'read-coupons', 'read-coupons', NULL, NULL),
(200, 'create-coupons', 'create-coupons', 'create-coupons', NULL, NULL),
(201, 'update-coupons', 'update-coupons', 'update-coupons', NULL, NULL),
(202, 'delete-coupons', 'delete-coupons', 'delete-coupons', NULL, NULL),
(203, 'read-mongez', 'read-mongez', 'read-mongez', NULL, NULL),
(204, 'create-mongez', 'create-mongez', 'create-mongez', NULL, NULL),
(205, 'update-mongez', 'update-mongez', 'update-mongez', NULL, NULL),
(206, 'delete-mongez', 'delete-mongez', 'delete-mongez', NULL, NULL),
(207, 'read-defult_mongez', 'read-defult_mongez', 'read-defult_mongez', NULL, NULL),
(208, 'create-defult_mongez', 'create-defult_mongez', 'create-defult_mongez', NULL, NULL),
(209, 'update-defult_mongez', 'update-defult_mongez', 'update-defult_mongez', NULL, NULL),
(210, 'delete-defult_mongez', 'delete-defult_mongez', 'delete-defult_mongez', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(22, 2),
(23, 1),
(24, 1),
(25, 1),
(25, 3),
(26, 1),
(26, 3),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(42, 2),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(46, 2),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(53, 4),
(54, 1),
(54, 4),
(55, 1),
(55, 4),
(56, 1),
(56, 4),
(57, 1),
(57, 4),
(58, 1),
(58, 4),
(59, 1),
(59, 4),
(60, 1),
(60, 4),
(61, 1),
(62, 1),
(62, 2),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(77, 4),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(91, 2),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(98, 3),
(98, 4),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(103, 2),
(103, 4),
(104, 1),
(105, 1),
(106, 3),
(106, 4);

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_user`
--

INSERT INTO `permission_user` (`permission_id`, `user_id`, `user_type`) VALUES
(1, 2, 'App\\User'),
(2, 2, 'App\\User'),
(3, 2, 'App\\User'),
(4, 2, 'App\\User'),
(5, 2, 'App\\User'),
(6, 2, 'App\\User'),
(7, 2, 'App\\User'),
(8, 2, 'App\\User'),
(9, 2, 'App\\User'),
(10, 2, 'App\\User'),
(11, 2, 'App\\User'),
(12, 2, 'App\\User'),
(13, 2, 'App\\User'),
(14, 2, 'App\\User'),
(15, 2, 'App\\User'),
(16, 2, 'App\\User'),
(17, 2, 'App\\User'),
(18, 2, 'App\\User'),
(19, 2, 'App\\User'),
(20, 2, 'App\\User'),
(21, 2, 'App\\User'),
(22, 2, 'App\\User'),
(23, 2, 'App\\User'),
(24, 2, 'App\\User'),
(42, 2, 'App\\User'),
(46, 2, 'App\\User'),
(62, 2, 'App\\User'),
(91, 2, 'App\\User'),
(103, 2, 'App\\User'),
(1, 1, 'App\\User'),
(2, 1, 'App\\User'),
(3, 1, 'App\\User'),
(4, 1, 'App\\User'),
(5, 1, 'App\\User'),
(6, 1, 'App\\User'),
(7, 1, 'App\\User'),
(8, 1, 'App\\User'),
(9, 1, 'App\\User'),
(10, 1, 'App\\User'),
(11, 1, 'App\\User'),
(12, 1, 'App\\User'),
(13, 1, 'App\\User'),
(14, 1, 'App\\User'),
(15, 1, 'App\\User'),
(16, 1, 'App\\User'),
(17, 1, 'App\\User'),
(18, 1, 'App\\User'),
(19, 1, 'App\\User'),
(20, 1, 'App\\User'),
(21, 1, 'App\\User'),
(22, 1, 'App\\User'),
(23, 1, 'App\\User'),
(24, 1, 'App\\User'),
(25, 1, 'App\\User'),
(26, 1, 'App\\User'),
(27, 1, 'App\\User'),
(28, 1, 'App\\User'),
(29, 1, 'App\\User'),
(30, 1, 'App\\User'),
(31, 1, 'App\\User'),
(32, 1, 'App\\User'),
(33, 1, 'App\\User'),
(34, 1, 'App\\User'),
(35, 1, 'App\\User'),
(36, 1, 'App\\User'),
(41, 1, 'App\\User'),
(42, 1, 'App\\User'),
(43, 1, 'App\\User'),
(44, 1, 'App\\User'),
(45, 1, 'App\\User'),
(46, 1, 'App\\User'),
(47, 1, 'App\\User'),
(48, 1, 'App\\User'),
(53, 1, 'App\\User'),
(54, 1, 'App\\User'),
(55, 1, 'App\\User'),
(56, 1, 'App\\User'),
(57, 1, 'App\\User'),
(58, 1, 'App\\User'),
(59, 1, 'App\\User'),
(60, 1, 'App\\User'),
(61, 1, 'App\\User'),
(62, 1, 'App\\User'),
(63, 1, 'App\\User'),
(64, 1, 'App\\User'),
(107, 1, 'App\\User'),
(108, 1, 'App\\User'),
(109, 1, 'App\\User'),
(110, 1, 'App\\User'),
(69, 1, 'App\\User'),
(70, 1, 'App\\User'),
(71, 1, 'App\\User'),
(72, 1, 'App\\User'),
(73, 1, 'App\\User'),
(74, 1, 'App\\User'),
(75, 1, 'App\\User'),
(76, 1, 'App\\User'),
(78, 1, 'App\\User'),
(79, 1, 'App\\User'),
(80, 1, 'App\\User'),
(81, 1, 'App\\User'),
(82, 1, 'App\\User'),
(83, 1, 'App\\User'),
(84, 1, 'App\\User'),
(85, 1, 'App\\User'),
(86, 1, 'App\\User'),
(87, 1, 'App\\User'),
(88, 1, 'App\\User'),
(89, 1, 'App\\User'),
(90, 1, 'App\\User'),
(91, 1, 'App\\User'),
(92, 1, 'App\\User'),
(93, 1, 'App\\User'),
(94, 1, 'App\\User'),
(95, 1, 'App\\User'),
(96, 1, 'App\\User'),
(97, 1, 'App\\User'),
(98, 1, 'App\\User'),
(99, 1, 'App\\User'),
(100, 1, 'App\\User'),
(101, 1, 'App\\User'),
(102, 1, 'App\\User'),
(103, 1, 'App\\User'),
(104, 1, 'App\\User'),
(105, 1, 'App\\User'),
(112, 1, 'App\\User'),
(111, 1, 'App\\User'),
(113, 1, 'App\\User'),
(114, 1, 'App\\User'),
(115, 1, 'App\\User'),
(116, 1, 'App\\User'),
(117, 1, 'App\\User'),
(118, 1, 'App\\User'),
(120, 1, 'App\\User'),
(119, 1, 'App\\User'),
(121, 1, 'App\\User'),
(122, 1, 'App\\User'),
(25, 2, 'App\\User'),
(26, 2, 'App\\User'),
(27, 2, 'App\\User'),
(28, 2, 'App\\User'),
(61, 2, 'App\\User'),
(63, 2, 'App\\User'),
(64, 2, 'App\\User'),
(107, 2, 'App\\User'),
(108, 2, 'App\\User'),
(109, 2, 'App\\User'),
(110, 2, 'App\\User'),
(123, 1, 'App\\User'),
(124, 1, 'App\\User'),
(156, 1, 'App\\User'),
(125, 1, 'App\\User'),
(126, 1, 'App\\User'),
(157, 1, 'App\\User'),
(127, 1, 'App\\User'),
(128, 1, 'App\\User'),
(129, 1, 'App\\User'),
(158, 1, 'App\\User'),
(130, 1, 'App\\User'),
(131, 1, 'App\\User'),
(132, 1, 'App\\User'),
(159, 1, 'App\\User'),
(133, 1, 'App\\User'),
(134, 1, 'App\\User'),
(135, 1, 'App\\User'),
(160, 1, 'App\\User'),
(136, 1, 'App\\User'),
(137, 1, 'App\\User'),
(138, 1, 'App\\User'),
(161, 1, 'App\\User'),
(139, 1, 'App\\User'),
(140, 1, 'App\\User'),
(141, 1, 'App\\User'),
(162, 1, 'App\\User'),
(142, 1, 'App\\User'),
(143, 1, 'App\\User'),
(144, 1, 'App\\User'),
(163, 1, 'App\\User'),
(145, 1, 'App\\User'),
(146, 1, 'App\\User'),
(147, 1, 'App\\User'),
(164, 1, 'App\\User'),
(148, 1, 'App\\User'),
(149, 1, 'App\\User'),
(150, 1, 'App\\User'),
(165, 1, 'App\\User'),
(151, 1, 'App\\User'),
(152, 1, 'App\\User'),
(153, 1, 'App\\User'),
(166, 1, 'App\\User'),
(154, 1, 'App\\User'),
(155, 1, 'App\\User'),
(171, 2, 'App\\User'),
(171, 1, 'App\\User'),
(168, 2, 'App\\User'),
(167, 2, 'App\\User'),
(169, 2, 'App\\User'),
(170, 2, 'App\\User'),
(168, 1, 'App\\User'),
(167, 1, 'App\\User'),
(169, 1, 'App\\User'),
(170, 1, 'App\\User'),
(180, 2, 'App\\User'),
(179, 2, 'App\\User'),
(181, 2, 'App\\User'),
(176, 2, 'App\\User'),
(176, 1, 'App\\User'),
(1, 1029242314, 'App\\User'),
(2, 1029242314, 'App\\User'),
(3, 1029242314, 'App\\User'),
(4, 1029242314, 'App\\User'),
(5, 1029242314, 'App\\User'),
(6, 1029242314, 'App\\User'),
(7, 1029242314, 'App\\User'),
(8, 1029242314, 'App\\User'),
(172, 1029242314, 'App\\User'),
(171, 1029242314, 'App\\User'),
(173, 1029242314, 'App\\User'),
(174, 1029242314, 'App\\User'),
(9, 1029242314, 'App\\User'),
(10, 1029242314, 'App\\User'),
(11, 1029242314, 'App\\User'),
(12, 1029242314, 'App\\User'),
(13, 1029242314, 'App\\User'),
(14, 1029242314, 'App\\User'),
(15, 1029242314, 'App\\User'),
(16, 1029242314, 'App\\User'),
(17, 1029242314, 'App\\User'),
(18, 1029242314, 'App\\User'),
(19, 1029242314, 'App\\User'),
(20, 1029242314, 'App\\User'),
(21, 1029242314, 'App\\User'),
(22, 1029242314, 'App\\User'),
(23, 1029242314, 'App\\User'),
(24, 1029242314, 'App\\User'),
(25, 1029242314, 'App\\User'),
(26, 1029242314, 'App\\User'),
(27, 1029242314, 'App\\User'),
(28, 1029242314, 'App\\User'),
(29, 1029242314, 'App\\User'),
(30, 1029242314, 'App\\User'),
(31, 1029242314, 'App\\User'),
(32, 1029242314, 'App\\User'),
(33, 1029242314, 'App\\User'),
(34, 1029242314, 'App\\User'),
(35, 1029242314, 'App\\User'),
(36, 1029242314, 'App\\User'),
(41, 1029242314, 'App\\User'),
(42, 1029242314, 'App\\User'),
(43, 1029242314, 'App\\User'),
(44, 1029242314, 'App\\User'),
(45, 1029242314, 'App\\User'),
(46, 1029242314, 'App\\User'),
(47, 1029242314, 'App\\User'),
(48, 1029242314, 'App\\User'),
(53, 1029242314, 'App\\User'),
(54, 1029242314, 'App\\User'),
(55, 1029242314, 'App\\User'),
(56, 1029242314, 'App\\User'),
(57, 1029242314, 'App\\User'),
(58, 1029242314, 'App\\User'),
(59, 1029242314, 'App\\User'),
(60, 1029242314, 'App\\User'),
(61, 1029242314, 'App\\User'),
(62, 1029242314, 'App\\User'),
(63, 1029242314, 'App\\User'),
(64, 1029242314, 'App\\User'),
(107, 1029242314, 'App\\User'),
(108, 1029242314, 'App\\User'),
(109, 1029242314, 'App\\User'),
(110, 1029242314, 'App\\User'),
(69, 1029242314, 'App\\User'),
(70, 1029242314, 'App\\User'),
(71, 1029242314, 'App\\User'),
(72, 1029242314, 'App\\User'),
(73, 1029242314, 'App\\User'),
(74, 1029242314, 'App\\User'),
(75, 1029242314, 'App\\User'),
(76, 1029242314, 'App\\User'),
(78, 1029242314, 'App\\User'),
(79, 1029242314, 'App\\User'),
(80, 1029242314, 'App\\User'),
(81, 1029242314, 'App\\User'),
(82, 1029242314, 'App\\User'),
(83, 1029242314, 'App\\User'),
(84, 1029242314, 'App\\User'),
(85, 1029242314, 'App\\User'),
(86, 1029242314, 'App\\User'),
(87, 1029242314, 'App\\User'),
(88, 1029242314, 'App\\User'),
(89, 1029242314, 'App\\User'),
(90, 1029242314, 'App\\User'),
(91, 1029242314, 'App\\User'),
(92, 1029242314, 'App\\User'),
(93, 1029242314, 'App\\User'),
(94, 1029242314, 'App\\User'),
(95, 1029242314, 'App\\User'),
(96, 1029242314, 'App\\User'),
(97, 1029242314, 'App\\User'),
(98, 1029242314, 'App\\User'),
(99, 1029242314, 'App\\User'),
(100, 1029242314, 'App\\User'),
(101, 1029242314, 'App\\User'),
(102, 1029242314, 'App\\User'),
(103, 1029242314, 'App\\User'),
(104, 1029242314, 'App\\User'),
(105, 1029242314, 'App\\User'),
(112, 1029242314, 'App\\User'),
(111, 1029242314, 'App\\User'),
(113, 1029242314, 'App\\User'),
(114, 1029242314, 'App\\User'),
(168, 1029242314, 'App\\User'),
(167, 1029242314, 'App\\User'),
(169, 1029242314, 'App\\User'),
(170, 1029242314, 'App\\User'),
(115, 1029242314, 'App\\User'),
(116, 1029242314, 'App\\User'),
(117, 1029242314, 'App\\User'),
(118, 1029242314, 'App\\User'),
(120, 1029242314, 'App\\User'),
(119, 1029242314, 'App\\User'),
(121, 1029242314, 'App\\User'),
(122, 1029242314, 'App\\User'),
(123, 1029242314, 'App\\User'),
(156, 1029242314, 'App\\User'),
(124, 1029242314, 'App\\User'),
(125, 1029242314, 'App\\User'),
(126, 1029242314, 'App\\User'),
(157, 1029242314, 'App\\User'),
(127, 1029242314, 'App\\User'),
(128, 1029242314, 'App\\User'),
(129, 1029242314, 'App\\User'),
(158, 1029242314, 'App\\User'),
(130, 1029242314, 'App\\User'),
(131, 1029242314, 'App\\User'),
(132, 1029242314, 'App\\User'),
(159, 1029242314, 'App\\User'),
(133, 1029242314, 'App\\User'),
(134, 1029242314, 'App\\User'),
(135, 1029242314, 'App\\User'),
(160, 1029242314, 'App\\User'),
(136, 1029242314, 'App\\User'),
(137, 1029242314, 'App\\User'),
(138, 1029242314, 'App\\User'),
(161, 1029242314, 'App\\User'),
(139, 1029242314, 'App\\User'),
(140, 1029242314, 'App\\User'),
(141, 1029242314, 'App\\User'),
(162, 1029242314, 'App\\User'),
(142, 1029242314, 'App\\User'),
(143, 1029242314, 'App\\User'),
(144, 1029242314, 'App\\User'),
(163, 1029242314, 'App\\User'),
(145, 1029242314, 'App\\User'),
(146, 1029242314, 'App\\User'),
(147, 1029242314, 'App\\User'),
(164, 1029242314, 'App\\User'),
(148, 1029242314, 'App\\User'),
(149, 1029242314, 'App\\User'),
(150, 1029242314, 'App\\User'),
(165, 1029242314, 'App\\User'),
(151, 1029242314, 'App\\User'),
(152, 1029242314, 'App\\User'),
(153, 1029242314, 'App\\User'),
(166, 1029242314, 'App\\User'),
(154, 1029242314, 'App\\User'),
(155, 1029242314, 'App\\User'),
(175, 1029242314, 'App\\User'),
(176, 1029242314, 'App\\User'),
(177, 1029242314, 'App\\User'),
(178, 1029242314, 'App\\User'),
(180, 1029242314, 'App\\User'),
(179, 1029242314, 'App\\User'),
(181, 1029242314, 'App\\User'),
(182, 1029242314, 'App\\User'),
(61, 45464, 'App\\User'),
(62, 45464, 'App\\User'),
(63, 45464, 'App\\User'),
(64, 45464, 'App\\User'),
(172, 1, 'App\\User'),
(173, 1, 'App\\User'),
(174, 1, 'App\\User'),
(175, 1, 'App\\User'),
(177, 1, 'App\\User'),
(178, 1, 'App\\User'),
(180, 1, 'App\\User'),
(179, 1, 'App\\User'),
(181, 1, 'App\\User'),
(182, 1, 'App\\User'),
(135, 45464, 'App\\User'),
(160, 45464, 'App\\User'),
(136, 45464, 'App\\User'),
(137, 45464, 'App\\User'),
(150, 45464, 'App\\User'),
(165, 45464, 'App\\User'),
(151, 45464, 'App\\User'),
(152, 45464, 'App\\User'),
(10, 1097879657, 'App\\User'),
(34, 1097879657, 'App\\User'),
(61, 1097879657, 'App\\User'),
(62, 1097879657, 'App\\User'),
(63, 1097879657, 'App\\User'),
(64, 1097879657, 'App\\User'),
(107, 1097879657, 'App\\User'),
(108, 1097879657, 'App\\User'),
(109, 1097879657, 'App\\User'),
(110, 1097879657, 'App\\User'),
(74, 1097879657, 'App\\User'),
(91, 1097879657, 'App\\User'),
(98, 1097879657, 'App\\User'),
(99, 1097879657, 'App\\User'),
(100, 1097879657, 'App\\User'),
(175, 1097879657, 'App\\User'),
(176, 1097879657, 'App\\User'),
(177, 1097879657, 'App\\User'),
(108, 1062717084, 'App\\User'),
(109, 1062717084, 'App\\User'),
(175, 1062717084, 'App\\User'),
(176, 1062717084, 'App\\User'),
(177, 1062717084, 'App\\User'),
(99, 1062717084, 'App\\User'),
(30, 1100942694, 'App\\User'),
(34, 1100942694, 'App\\User'),
(61, 1100942694, 'App\\User'),
(62, 1100942694, 'App\\User'),
(63, 1100942694, 'App\\User'),
(107, 1100942694, 'App\\User'),
(108, 1100942694, 'App\\User'),
(109, 1100942694, 'App\\User'),
(110, 1100942694, 'App\\User'),
(91, 1100942694, 'App\\User'),
(175, 1100942694, 'App\\User'),
(176, 1100942694, 'App\\User'),
(177, 1100942694, 'App\\User'),
(25, 1006104417, 'App\\User'),
(26, 1006104417, 'App\\User'),
(27, 1006104417, 'App\\User'),
(28, 1006104417, 'App\\User'),
(30, 1006104417, 'App\\User'),
(33, 1006104417, 'App\\User'),
(34, 1006104417, 'App\\User'),
(35, 1006104417, 'App\\User'),
(36, 1006104417, 'App\\User'),
(61, 1006104417, 'App\\User'),
(62, 1006104417, 'App\\User'),
(63, 1006104417, 'App\\User'),
(64, 1006104417, 'App\\User'),
(107, 1006104417, 'App\\User'),
(108, 1006104417, 'App\\User'),
(109, 1006104417, 'App\\User'),
(110, 1006104417, 'App\\User'),
(91, 1006104417, 'App\\User'),
(98, 1006104417, 'App\\User'),
(99, 1006104417, 'App\\User'),
(115, 1006104417, 'App\\User'),
(116, 1006104417, 'App\\User'),
(117, 1006104417, 'App\\User'),
(118, 1006104417, 'App\\User'),
(175, 1006104417, 'App\\User'),
(176, 1006104417, 'App\\User'),
(177, 1006104417, 'App\\User'),
(178, 1006104417, 'App\\User'),
(26, 1009250963, 'App\\User'),
(27, 1009250963, 'App\\User'),
(62, 1009250963, 'App\\User'),
(63, 1009250963, 'App\\User'),
(108, 1009250963, 'App\\User'),
(109, 1009250963, 'App\\User'),
(91, 1009250963, 'App\\User'),
(176, 1009250963, 'App\\User'),
(26, 1022010080, 'App\\User'),
(27, 1022010080, 'App\\User'),
(62, 1022010080, 'App\\User'),
(63, 1022010080, 'App\\User'),
(108, 1022010080, 'App\\User'),
(109, 1022010080, 'App\\User'),
(91, 1022010080, 'App\\User'),
(176, 1022010080, 'App\\User'),
(177, 1022010080, 'App\\User'),
(26, 1016025696, 'App\\User'),
(27, 1016025696, 'App\\User'),
(62, 1016025696, 'App\\User'),
(63, 1016025696, 'App\\User'),
(108, 1016025696, 'App\\User'),
(109, 1016025696, 'App\\User'),
(91, 1016025696, 'App\\User'),
(176, 1016025696, 'App\\User'),
(177, 1016025696, 'App\\User'),
(25, 45464, 'App\\User'),
(26, 45464, 'App\\User'),
(27, 45464, 'App\\User'),
(28, 45464, 'App\\User'),
(91, 45464, 'App\\User'),
(26, 10943494, 'App\\User'),
(27, 10943494, 'App\\User'),
(62, 10943494, 'App\\User'),
(63, 10943494, 'App\\User'),
(108, 10943494, 'App\\User'),
(109, 10943494, 'App\\User'),
(91, 10943494, 'App\\User'),
(176, 10943494, 'App\\User'),
(177, 10943494, 'App\\User'),
(26, 454594, 'App\\User'),
(27, 454594, 'App\\User'),
(62, 454594, 'App\\User'),
(63, 454594, 'App\\User'),
(108, 454594, 'App\\User'),
(109, 454594, 'App\\User'),
(91, 454594, 'App\\User'),
(176, 454594, 'App\\User'),
(177, 454594, 'App\\User'),
(62, 1062717084, 'App\\User'),
(63, 1062717084, 'App\\User'),
(107, 1062717084, 'App\\User'),
(110, 1062717084, 'App\\User'),
(98, 1062717084, 'App\\User'),
(100, 1062717084, 'App\\User'),
(101, 1062717084, 'App\\User'),
(61, 1062717084, 'App\\User'),
(64, 1062717084, 'App\\User'),
(91, 1062717084, 'App\\User'),
(26, 2147483647, 'App\\User'),
(27, 2147483647, 'App\\User'),
(62, 2147483647, 'App\\User'),
(63, 2147483647, 'App\\User'),
(107, 2147483647, 'App\\User'),
(108, 2147483647, 'App\\User'),
(109, 2147483647, 'App\\User'),
(110, 2147483647, 'App\\User'),
(91, 2147483647, 'App\\User'),
(175, 2147483647, 'App\\User'),
(176, 2147483647, 'App\\User'),
(177, 2147483647, 'App\\User'),
(98, 2147483647, 'App\\User'),
(99, 2147483647, 'App\\User'),
(100, 2147483647, 'App\\User'),
(101, 2147483647, 'App\\User'),
(61, 2147483647, 'App\\User'),
(123, 45464, 'App\\User'),
(156, 45464, 'App\\User'),
(124, 45464, 'App\\User'),
(125, 45464, 'App\\User'),
(1, 1876452349, 'App\\User'),
(2, 1876452349, 'App\\User'),
(3, 1876452349, 'App\\User'),
(4, 1876452349, 'App\\User'),
(5, 1876452349, 'App\\User'),
(6, 1876452349, 'App\\User'),
(7, 1876452349, 'App\\User'),
(8, 1876452349, 'App\\User'),
(172, 1876452349, 'App\\User'),
(171, 1876452349, 'App\\User'),
(173, 1876452349, 'App\\User'),
(174, 1876452349, 'App\\User'),
(9, 1876452349, 'App\\User'),
(10, 1876452349, 'App\\User'),
(11, 1876452349, 'App\\User'),
(12, 1876452349, 'App\\User'),
(13, 1876452349, 'App\\User'),
(14, 1876452349, 'App\\User'),
(15, 1876452349, 'App\\User'),
(16, 1876452349, 'App\\User'),
(17, 1876452349, 'App\\User'),
(18, 1876452349, 'App\\User'),
(19, 1876452349, 'App\\User'),
(20, 1876452349, 'App\\User'),
(21, 1876452349, 'App\\User'),
(22, 1876452349, 'App\\User'),
(23, 1876452349, 'App\\User'),
(24, 1876452349, 'App\\User'),
(25, 1876452349, 'App\\User'),
(26, 1876452349, 'App\\User'),
(27, 1876452349, 'App\\User'),
(28, 1876452349, 'App\\User'),
(29, 1876452349, 'App\\User'),
(30, 1876452349, 'App\\User'),
(31, 1876452349, 'App\\User'),
(32, 1876452349, 'App\\User'),
(33, 1876452349, 'App\\User'),
(34, 1876452349, 'App\\User'),
(35, 1876452349, 'App\\User'),
(36, 1876452349, 'App\\User'),
(41, 1876452349, 'App\\User'),
(42, 1876452349, 'App\\User'),
(43, 1876452349, 'App\\User'),
(44, 1876452349, 'App\\User'),
(45, 1876452349, 'App\\User'),
(46, 1876452349, 'App\\User'),
(47, 1876452349, 'App\\User'),
(48, 1876452349, 'App\\User'),
(53, 1876452349, 'App\\User'),
(54, 1876452349, 'App\\User'),
(55, 1876452349, 'App\\User'),
(56, 1876452349, 'App\\User'),
(57, 1876452349, 'App\\User'),
(58, 1876452349, 'App\\User'),
(59, 1876452349, 'App\\User'),
(60, 1876452349, 'App\\User'),
(61, 1876452349, 'App\\User'),
(62, 1876452349, 'App\\User'),
(63, 1876452349, 'App\\User'),
(64, 1876452349, 'App\\User'),
(107, 1876452349, 'App\\User'),
(108, 1876452349, 'App\\User'),
(109, 1876452349, 'App\\User'),
(110, 1876452349, 'App\\User'),
(69, 1876452349, 'App\\User'),
(70, 1876452349, 'App\\User'),
(71, 1876452349, 'App\\User'),
(72, 1876452349, 'App\\User'),
(73, 1876452349, 'App\\User'),
(74, 1876452349, 'App\\User'),
(75, 1876452349, 'App\\User'),
(76, 1876452349, 'App\\User'),
(78, 1876452349, 'App\\User'),
(79, 1876452349, 'App\\User'),
(80, 1876452349, 'App\\User'),
(81, 1876452349, 'App\\User'),
(82, 1876452349, 'App\\User'),
(83, 1876452349, 'App\\User'),
(84, 1876452349, 'App\\User'),
(85, 1876452349, 'App\\User'),
(86, 1876452349, 'App\\User'),
(87, 1876452349, 'App\\User'),
(88, 1876452349, 'App\\User'),
(89, 1876452349, 'App\\User'),
(90, 1876452349, 'App\\User'),
(91, 1876452349, 'App\\User'),
(92, 1876452349, 'App\\User'),
(93, 1876452349, 'App\\User'),
(94, 1876452349, 'App\\User'),
(95, 1876452349, 'App\\User'),
(96, 1876452349, 'App\\User'),
(97, 1876452349, 'App\\User'),
(98, 1876452349, 'App\\User'),
(99, 1876452349, 'App\\User'),
(100, 1876452349, 'App\\User'),
(101, 1876452349, 'App\\User'),
(102, 1876452349, 'App\\User'),
(103, 1876452349, 'App\\User'),
(104, 1876452349, 'App\\User'),
(105, 1876452349, 'App\\User'),
(112, 1876452349, 'App\\User'),
(111, 1876452349, 'App\\User'),
(113, 1876452349, 'App\\User'),
(114, 1876452349, 'App\\User'),
(168, 1876452349, 'App\\User'),
(167, 1876452349, 'App\\User'),
(169, 1876452349, 'App\\User'),
(170, 1876452349, 'App\\User'),
(115, 1876452349, 'App\\User'),
(116, 1876452349, 'App\\User'),
(117, 1876452349, 'App\\User'),
(118, 1876452349, 'App\\User'),
(120, 1876452349, 'App\\User'),
(119, 1876452349, 'App\\User'),
(121, 1876452349, 'App\\User'),
(122, 1876452349, 'App\\User'),
(123, 1876452349, 'App\\User'),
(156, 1876452349, 'App\\User'),
(124, 1876452349, 'App\\User'),
(125, 1876452349, 'App\\User'),
(126, 1876452349, 'App\\User'),
(157, 1876452349, 'App\\User'),
(127, 1876452349, 'App\\User'),
(128, 1876452349, 'App\\User'),
(129, 1876452349, 'App\\User'),
(158, 1876452349, 'App\\User'),
(130, 1876452349, 'App\\User'),
(131, 1876452349, 'App\\User'),
(132, 1876452349, 'App\\User'),
(159, 1876452349, 'App\\User'),
(133, 1876452349, 'App\\User'),
(134, 1876452349, 'App\\User'),
(135, 1876452349, 'App\\User'),
(160, 1876452349, 'App\\User'),
(136, 1876452349, 'App\\User'),
(137, 1876452349, 'App\\User'),
(138, 1876452349, 'App\\User'),
(161, 1876452349, 'App\\User'),
(139, 1876452349, 'App\\User'),
(140, 1876452349, 'App\\User'),
(141, 1876452349, 'App\\User'),
(162, 1876452349, 'App\\User'),
(142, 1876452349, 'App\\User'),
(143, 1876452349, 'App\\User'),
(144, 1876452349, 'App\\User'),
(163, 1876452349, 'App\\User'),
(145, 1876452349, 'App\\User'),
(146, 1876452349, 'App\\User'),
(147, 1876452349, 'App\\User'),
(164, 1876452349, 'App\\User'),
(148, 1876452349, 'App\\User'),
(149, 1876452349, 'App\\User'),
(150, 1876452349, 'App\\User'),
(165, 1876452349, 'App\\User'),
(151, 1876452349, 'App\\User'),
(152, 1876452349, 'App\\User'),
(153, 1876452349, 'App\\User'),
(166, 1876452349, 'App\\User'),
(154, 1876452349, 'App\\User'),
(155, 1876452349, 'App\\User'),
(175, 1876452349, 'App\\User'),
(176, 1876452349, 'App\\User'),
(177, 1876452349, 'App\\User'),
(178, 1876452349, 'App\\User'),
(180, 1876452349, 'App\\User'),
(179, 1876452349, 'App\\User'),
(181, 1876452349, 'App\\User'),
(182, 1876452349, 'App\\User'),
(107, 45464, 'App\\User'),
(108, 45464, 'App\\User'),
(109, 45464, 'App\\User'),
(110, 45464, 'App\\User'),
(98, 45464, 'App\\User'),
(99, 45464, 'App\\User'),
(100, 45464, 'App\\User'),
(101, 45464, 'App\\User'),
(29, 2, 'App\\User'),
(30, 2, 'App\\User'),
(31, 2, 'App\\User'),
(32, 2, 'App\\User'),
(33, 2, 'App\\User'),
(34, 2, 'App\\User'),
(35, 2, 'App\\User'),
(36, 2, 'App\\User'),
(41, 2, 'App\\User'),
(43, 2, 'App\\User'),
(44, 2, 'App\\User'),
(45, 2, 'App\\User'),
(47, 2, 'App\\User'),
(48, 2, 'App\\User'),
(53, 2, 'App\\User'),
(54, 2, 'App\\User'),
(55, 2, 'App\\User'),
(56, 2, 'App\\User'),
(57, 2, 'App\\User'),
(58, 2, 'App\\User'),
(59, 2, 'App\\User'),
(60, 2, 'App\\User'),
(69, 2, 'App\\User'),
(70, 2, 'App\\User'),
(71, 2, 'App\\User'),
(72, 2, 'App\\User'),
(73, 2, 'App\\User'),
(74, 2, 'App\\User'),
(75, 2, 'App\\User'),
(76, 2, 'App\\User'),
(78, 2, 'App\\User'),
(79, 2, 'App\\User'),
(80, 2, 'App\\User'),
(81, 2, 'App\\User'),
(82, 2, 'App\\User'),
(83, 2, 'App\\User'),
(84, 2, 'App\\User'),
(85, 2, 'App\\User'),
(86, 2, 'App\\User'),
(87, 2, 'App\\User'),
(88, 2, 'App\\User'),
(89, 2, 'App\\User'),
(90, 2, 'App\\User'),
(92, 2, 'App\\User'),
(93, 2, 'App\\User'),
(94, 2, 'App\\User'),
(95, 2, 'App\\User'),
(96, 2, 'App\\User'),
(97, 2, 'App\\User'),
(98, 2, 'App\\User'),
(99, 2, 'App\\User'),
(100, 2, 'App\\User'),
(101, 2, 'App\\User'),
(102, 2, 'App\\User'),
(104, 2, 'App\\User'),
(105, 2, 'App\\User'),
(112, 2, 'App\\User'),
(111, 2, 'App\\User'),
(113, 2, 'App\\User'),
(114, 2, 'App\\User'),
(115, 2, 'App\\User'),
(116, 2, 'App\\User'),
(117, 2, 'App\\User'),
(118, 2, 'App\\User'),
(120, 2, 'App\\User'),
(119, 2, 'App\\User'),
(121, 2, 'App\\User'),
(122, 2, 'App\\User'),
(123, 2, 'App\\User'),
(156, 2, 'App\\User'),
(124, 2, 'App\\User'),
(125, 2, 'App\\User'),
(126, 2, 'App\\User'),
(157, 2, 'App\\User'),
(127, 2, 'App\\User'),
(128, 2, 'App\\User'),
(129, 2, 'App\\User'),
(158, 2, 'App\\User'),
(130, 2, 'App\\User'),
(131, 2, 'App\\User'),
(132, 2, 'App\\User'),
(159, 2, 'App\\User'),
(133, 2, 'App\\User'),
(134, 2, 'App\\User'),
(135, 2, 'App\\User'),
(160, 2, 'App\\User'),
(136, 2, 'App\\User'),
(137, 2, 'App\\User'),
(138, 2, 'App\\User'),
(161, 2, 'App\\User'),
(139, 2, 'App\\User'),
(140, 2, 'App\\User'),
(141, 2, 'App\\User'),
(162, 2, 'App\\User'),
(142, 2, 'App\\User'),
(143, 2, 'App\\User'),
(144, 2, 'App\\User'),
(163, 2, 'App\\User'),
(145, 2, 'App\\User'),
(146, 2, 'App\\User'),
(147, 2, 'App\\User'),
(164, 2, 'App\\User'),
(148, 2, 'App\\User'),
(149, 2, 'App\\User'),
(150, 2, 'App\\User'),
(165, 2, 'App\\User'),
(151, 2, 'App\\User'),
(152, 2, 'App\\User'),
(153, 2, 'App\\User'),
(166, 2, 'App\\User'),
(154, 2, 'App\\User'),
(155, 2, 'App\\User'),
(175, 2, 'App\\User'),
(177, 2, 'App\\User'),
(178, 2, 'App\\User'),
(182, 2, 'App\\User'),
(25, 123456, 'App\\User'),
(26, 123456, 'App\\User'),
(27, 123456, 'App\\User'),
(28, 123456, 'App\\User'),
(61, 123456, 'App\\User'),
(62, 123456, 'App\\User'),
(63, 123456, 'App\\User'),
(64, 123456, 'App\\User'),
(107, 123456, 'App\\User'),
(108, 123456, 'App\\User'),
(109, 123456, 'App\\User'),
(110, 123456, 'App\\User'),
(73, 123456, 'App\\User'),
(74, 123456, 'App\\User'),
(75, 123456, 'App\\User'),
(76, 123456, 'App\\User'),
(25, 654321, 'App\\User'),
(26, 654321, 'App\\User'),
(27, 654321, 'App\\User'),
(28, 654321, 'App\\User'),
(61, 654321, 'App\\User'),
(62, 654321, 'App\\User'),
(63, 654321, 'App\\User'),
(64, 654321, 'App\\User'),
(107, 654321, 'App\\User'),
(108, 654321, 'App\\User'),
(109, 654321, 'App\\User'),
(110, 654321, 'App\\User'),
(25, 852963, 'App\\User'),
(26, 852963, 'App\\User'),
(27, 852963, 'App\\User'),
(28, 852963, 'App\\User'),
(61, 852963, 'App\\User'),
(62, 852963, 'App\\User'),
(63, 852963, 'App\\User'),
(64, 852963, 'App\\User'),
(107, 852963, 'App\\User'),
(108, 852963, 'App\\User'),
(109, 852963, 'App\\User'),
(110, 852963, 'App\\User'),
(25, 741852, 'App\\User'),
(26, 741852, 'App\\User'),
(27, 741852, 'App\\User'),
(28, 741852, 'App\\User'),
(61, 741852, 'App\\User'),
(62, 741852, 'App\\User'),
(63, 741852, 'App\\User'),
(64, 741852, 'App\\User'),
(107, 741852, 'App\\User'),
(108, 741852, 'App\\User'),
(109, 741852, 'App\\User'),
(110, 741852, 'App\\User'),
(1, 1155557511, 'App\\User'),
(2, 1155557511, 'App\\User'),
(3, 1155557511, 'App\\User'),
(4, 1155557511, 'App\\User'),
(5, 1155557511, 'App\\User'),
(6, 1155557511, 'App\\User'),
(7, 1155557511, 'App\\User'),
(8, 1155557511, 'App\\User'),
(171, 1155557511, 'App\\User'),
(9, 1155557511, 'App\\User'),
(10, 1155557511, 'App\\User'),
(11, 1155557511, 'App\\User'),
(12, 1155557511, 'App\\User'),
(13, 1155557511, 'App\\User'),
(14, 1155557511, 'App\\User'),
(15, 1155557511, 'App\\User'),
(16, 1155557511, 'App\\User'),
(17, 1155557511, 'App\\User'),
(18, 1155557511, 'App\\User'),
(19, 1155557511, 'App\\User'),
(20, 1155557511, 'App\\User'),
(21, 1155557511, 'App\\User'),
(22, 1155557511, 'App\\User'),
(23, 1155557511, 'App\\User'),
(24, 1155557511, 'App\\User'),
(25, 1155557511, 'App\\User'),
(26, 1155557511, 'App\\User'),
(27, 1155557511, 'App\\User'),
(28, 1155557511, 'App\\User'),
(29, 1155557511, 'App\\User'),
(30, 1155557511, 'App\\User'),
(31, 1155557511, 'App\\User'),
(32, 1155557511, 'App\\User'),
(33, 1155557511, 'App\\User'),
(34, 1155557511, 'App\\User'),
(35, 1155557511, 'App\\User'),
(36, 1155557511, 'App\\User'),
(41, 1155557511, 'App\\User'),
(42, 1155557511, 'App\\User'),
(43, 1155557511, 'App\\User'),
(44, 1155557511, 'App\\User'),
(45, 1155557511, 'App\\User'),
(46, 1155557511, 'App\\User'),
(47, 1155557511, 'App\\User'),
(48, 1155557511, 'App\\User'),
(53, 1155557511, 'App\\User'),
(54, 1155557511, 'App\\User'),
(55, 1155557511, 'App\\User'),
(56, 1155557511, 'App\\User'),
(57, 1155557511, 'App\\User'),
(58, 1155557511, 'App\\User'),
(59, 1155557511, 'App\\User'),
(60, 1155557511, 'App\\User'),
(61, 1155557511, 'App\\User'),
(62, 1155557511, 'App\\User'),
(63, 1155557511, 'App\\User'),
(64, 1155557511, 'App\\User'),
(107, 1155557511, 'App\\User'),
(108, 1155557511, 'App\\User'),
(109, 1155557511, 'App\\User'),
(110, 1155557511, 'App\\User'),
(69, 1155557511, 'App\\User'),
(70, 1155557511, 'App\\User'),
(71, 1155557511, 'App\\User'),
(72, 1155557511, 'App\\User'),
(73, 1155557511, 'App\\User'),
(74, 1155557511, 'App\\User'),
(75, 1155557511, 'App\\User'),
(76, 1155557511, 'App\\User'),
(78, 1155557511, 'App\\User'),
(79, 1155557511, 'App\\User'),
(80, 1155557511, 'App\\User'),
(81, 1155557511, 'App\\User'),
(82, 1155557511, 'App\\User'),
(83, 1155557511, 'App\\User'),
(84, 1155557511, 'App\\User'),
(85, 1155557511, 'App\\User'),
(86, 1155557511, 'App\\User'),
(87, 1155557511, 'App\\User'),
(88, 1155557511, 'App\\User'),
(89, 1155557511, 'App\\User'),
(90, 1155557511, 'App\\User'),
(91, 1155557511, 'App\\User'),
(92, 1155557511, 'App\\User'),
(93, 1155557511, 'App\\User'),
(94, 1155557511, 'App\\User'),
(95, 1155557511, 'App\\User'),
(96, 1155557511, 'App\\User'),
(97, 1155557511, 'App\\User'),
(98, 1155557511, 'App\\User'),
(99, 1155557511, 'App\\User'),
(100, 1155557511, 'App\\User'),
(101, 1155557511, 'App\\User'),
(102, 1155557511, 'App\\User'),
(103, 1155557511, 'App\\User'),
(104, 1155557511, 'App\\User'),
(105, 1155557511, 'App\\User'),
(112, 1155557511, 'App\\User'),
(111, 1155557511, 'App\\User'),
(113, 1155557511, 'App\\User'),
(114, 1155557511, 'App\\User'),
(168, 1155557511, 'App\\User'),
(167, 1155557511, 'App\\User'),
(169, 1155557511, 'App\\User'),
(170, 1155557511, 'App\\User'),
(115, 1155557511, 'App\\User'),
(116, 1155557511, 'App\\User'),
(117, 1155557511, 'App\\User'),
(118, 1155557511, 'App\\User'),
(120, 1155557511, 'App\\User'),
(119, 1155557511, 'App\\User'),
(121, 1155557511, 'App\\User'),
(122, 1155557511, 'App\\User'),
(123, 1155557511, 'App\\User'),
(156, 1155557511, 'App\\User'),
(124, 1155557511, 'App\\User'),
(125, 1155557511, 'App\\User'),
(126, 1155557511, 'App\\User'),
(157, 1155557511, 'App\\User'),
(127, 1155557511, 'App\\User'),
(128, 1155557511, 'App\\User'),
(129, 1155557511, 'App\\User'),
(158, 1155557511, 'App\\User'),
(130, 1155557511, 'App\\User'),
(131, 1155557511, 'App\\User'),
(132, 1155557511, 'App\\User'),
(159, 1155557511, 'App\\User'),
(133, 1155557511, 'App\\User'),
(134, 1155557511, 'App\\User'),
(135, 1155557511, 'App\\User'),
(160, 1155557511, 'App\\User'),
(136, 1155557511, 'App\\User'),
(137, 1155557511, 'App\\User'),
(138, 1155557511, 'App\\User'),
(161, 1155557511, 'App\\User'),
(139, 1155557511, 'App\\User'),
(140, 1155557511, 'App\\User'),
(141, 1155557511, 'App\\User'),
(162, 1155557511, 'App\\User'),
(142, 1155557511, 'App\\User'),
(143, 1155557511, 'App\\User'),
(144, 1155557511, 'App\\User'),
(163, 1155557511, 'App\\User'),
(145, 1155557511, 'App\\User'),
(146, 1155557511, 'App\\User'),
(147, 1155557511, 'App\\User'),
(164, 1155557511, 'App\\User'),
(148, 1155557511, 'App\\User'),
(149, 1155557511, 'App\\User'),
(150, 1155557511, 'App\\User'),
(165, 1155557511, 'App\\User'),
(151, 1155557511, 'App\\User'),
(152, 1155557511, 'App\\User'),
(153, 1155557511, 'App\\User'),
(166, 1155557511, 'App\\User'),
(154, 1155557511, 'App\\User'),
(155, 1155557511, 'App\\User'),
(175, 1155557511, 'App\\User'),
(176, 1155557511, 'App\\User'),
(177, 1155557511, 'App\\User'),
(178, 1155557511, 'App\\User'),
(180, 1155557511, 'App\\User'),
(179, 1155557511, 'App\\User'),
(181, 1155557511, 'App\\User'),
(182, 1155557511, 'App\\User'),
(5, 12345, 'App\\User'),
(6, 12345, 'App\\User'),
(7, 12345, 'App\\User'),
(94, 12345, 'App\\User'),
(95, 12345, 'App\\User'),
(96, 12345, 'App\\User'),
(1, 123466, 'App\\User'),
(2, 123466, 'App\\User'),
(3, 123466, 'App\\User'),
(5, 123466, 'App\\User'),
(6, 123466, 'App\\User'),
(7, 123466, 'App\\User'),
(107, 123466, 'App\\User'),
(108, 123466, 'App\\User'),
(109, 123466, 'App\\User'),
(90, 123466, 'App\\User'),
(91, 123466, 'App\\User'),
(92, 123466, 'App\\User'),
(5, 1234, 'App\\User'),
(6, 1234, 'App\\User'),
(7, 1234, 'App\\User'),
(61, 1234, 'App\\User'),
(62, 1234, 'App\\User'),
(17, 125455354, 'App\\User'),
(18, 125455354, 'App\\User'),
(19, 125455354, 'App\\User'),
(29, 125455354, 'App\\User'),
(30, 125455354, 'App\\User'),
(31, 125455354, 'App\\User'),
(61, 125455354, 'App\\User'),
(62, 125455354, 'App\\User'),
(63, 125455354, 'App\\User'),
(107, 125455354, 'App\\User'),
(108, 125455354, 'App\\User'),
(109, 125455354, 'App\\User'),
(73, 125455354, 'App\\User'),
(74, 125455354, 'App\\User'),
(75, 125455354, 'App\\User'),
(78, 125455354, 'App\\User'),
(79, 125455354, 'App\\User'),
(80, 125455354, 'App\\User'),
(82, 125455354, 'App\\User'),
(83, 125455354, 'App\\User'),
(84, 125455354, 'App\\User'),
(94, 125455354, 'App\\User'),
(95, 125455354, 'App\\User'),
(96, 125455354, 'App\\User'),
(98, 125455354, 'App\\User'),
(99, 125455354, 'App\\User'),
(100, 125455354, 'App\\User'),
(112, 125455354, 'App\\User'),
(111, 125455354, 'App\\User'),
(113, 125455354, 'App\\User'),
(168, 125455354, 'App\\User'),
(167, 125455354, 'App\\User'),
(169, 125455354, 'App\\User'),
(183, 1, 'App\\User'),
(184, 1, 'App\\User'),
(185, 1, 'App\\User'),
(186, 1, 'App\\User'),
(1, 1066066365, 'App\\User'),
(2, 1066066365, 'App\\User'),
(3, 1066066365, 'App\\User'),
(4, 1066066365, 'App\\User'),
(5, 1066066365, 'App\\User'),
(6, 1066066365, 'App\\User'),
(7, 1066066365, 'App\\User'),
(8, 1066066365, 'App\\User'),
(172, 1066066365, 'App\\User'),
(171, 1066066365, 'App\\User'),
(173, 1066066365, 'App\\User'),
(174, 1066066365, 'App\\User'),
(9, 1066066365, 'App\\User'),
(10, 1066066365, 'App\\User'),
(11, 1066066365, 'App\\User'),
(13, 1066066365, 'App\\User'),
(14, 1066066365, 'App\\User'),
(15, 1066066365, 'App\\User'),
(17, 1066066365, 'App\\User'),
(18, 1066066365, 'App\\User'),
(19, 1066066365, 'App\\User'),
(21, 1066066365, 'App\\User'),
(22, 1066066365, 'App\\User'),
(25, 1066066365, 'App\\User'),
(26, 1066066365, 'App\\User'),
(29, 1066066365, 'App\\User'),
(30, 1066066365, 'App\\User'),
(33, 1066066365, 'App\\User'),
(34, 1066066365, 'App\\User'),
(41, 1066066365, 'App\\User'),
(42, 1066066365, 'App\\User'),
(45, 1066066365, 'App\\User'),
(53, 1066066365, 'App\\User'),
(57, 1066066365, 'App\\User'),
(13, 14458657, 'App\\User'),
(14, 14458657, 'App\\User'),
(13, 1111111111, 'App\\User'),
(14, 1111111111, 'App\\User'),
(15, 1111111111, 'App\\User'),
(16, 1111111111, 'App\\User'),
(141, 1111111111, 'App\\User'),
(162, 1111111111, 'App\\User'),
(142, 1111111111, 'App\\User'),
(143, 1111111111, 'App\\User'),
(13, 11111111, 'App\\User'),
(14, 11111111, 'App\\User'),
(15, 11111111, 'App\\User'),
(16, 11111111, 'App\\User'),
(141, 11111111, 'App\\User'),
(162, 11111111, 'App\\User'),
(142, 11111111, 'App\\User'),
(143, 11111111, 'App\\User'),
(12, 1066066365, 'App\\User'),
(16, 1066066365, 'App\\User'),
(20, 1066066365, 'App\\User'),
(23, 1066066365, 'App\\User'),
(24, 1066066365, 'App\\User'),
(27, 1066066365, 'App\\User'),
(28, 1066066365, 'App\\User'),
(31, 1066066365, 'App\\User'),
(32, 1066066365, 'App\\User'),
(35, 1066066365, 'App\\User'),
(36, 1066066365, 'App\\User'),
(43, 1066066365, 'App\\User'),
(44, 1066066365, 'App\\User'),
(46, 1066066365, 'App\\User'),
(47, 1066066365, 'App\\User'),
(48, 1066066365, 'App\\User'),
(54, 1066066365, 'App\\User'),
(55, 1066066365, 'App\\User'),
(56, 1066066365, 'App\\User'),
(58, 1066066365, 'App\\User'),
(59, 1066066365, 'App\\User'),
(60, 1066066365, 'App\\User'),
(61, 1066066365, 'App\\User'),
(62, 1066066365, 'App\\User'),
(63, 1066066365, 'App\\User'),
(64, 1066066365, 'App\\User'),
(107, 1066066365, 'App\\User'),
(108, 1066066365, 'App\\User'),
(109, 1066066365, 'App\\User'),
(110, 1066066365, 'App\\User'),
(69, 1066066365, 'App\\User'),
(70, 1066066365, 'App\\User'),
(71, 1066066365, 'App\\User'),
(72, 1066066365, 'App\\User'),
(73, 1066066365, 'App\\User'),
(74, 1066066365, 'App\\User'),
(75, 1066066365, 'App\\User'),
(76, 1066066365, 'App\\User'),
(78, 1066066365, 'App\\User'),
(79, 1066066365, 'App\\User'),
(80, 1066066365, 'App\\User'),
(81, 1066066365, 'App\\User'),
(82, 1066066365, 'App\\User'),
(83, 1066066365, 'App\\User'),
(84, 1066066365, 'App\\User'),
(85, 1066066365, 'App\\User'),
(86, 1066066365, 'App\\User'),
(87, 1066066365, 'App\\User'),
(88, 1066066365, 'App\\User'),
(89, 1066066365, 'App\\User'),
(90, 1066066365, 'App\\User'),
(91, 1066066365, 'App\\User'),
(92, 1066066365, 'App\\User'),
(93, 1066066365, 'App\\User'),
(94, 1066066365, 'App\\User'),
(95, 1066066365, 'App\\User'),
(96, 1066066365, 'App\\User'),
(97, 1066066365, 'App\\User'),
(98, 1066066365, 'App\\User'),
(99, 1066066365, 'App\\User'),
(100, 1066066365, 'App\\User'),
(101, 1066066365, 'App\\User'),
(102, 1066066365, 'App\\User'),
(103, 1066066365, 'App\\User'),
(104, 1066066365, 'App\\User'),
(105, 1066066365, 'App\\User'),
(112, 1066066365, 'App\\User'),
(111, 1066066365, 'App\\User'),
(113, 1066066365, 'App\\User'),
(114, 1066066365, 'App\\User'),
(168, 1066066365, 'App\\User'),
(167, 1066066365, 'App\\User'),
(169, 1066066365, 'App\\User'),
(170, 1066066365, 'App\\User'),
(115, 1066066365, 'App\\User'),
(116, 1066066365, 'App\\User'),
(117, 1066066365, 'App\\User'),
(118, 1066066365, 'App\\User'),
(120, 1066066365, 'App\\User'),
(119, 1066066365, 'App\\User'),
(121, 1066066365, 'App\\User'),
(122, 1066066365, 'App\\User'),
(123, 1066066365, 'App\\User'),
(156, 1066066365, 'App\\User'),
(124, 1066066365, 'App\\User'),
(125, 1066066365, 'App\\User'),
(126, 1066066365, 'App\\User'),
(157, 1066066365, 'App\\User'),
(127, 1066066365, 'App\\User'),
(128, 1066066365, 'App\\User'),
(129, 1066066365, 'App\\User'),
(158, 1066066365, 'App\\User'),
(130, 1066066365, 'App\\User'),
(131, 1066066365, 'App\\User'),
(132, 1066066365, 'App\\User'),
(159, 1066066365, 'App\\User'),
(133, 1066066365, 'App\\User'),
(134, 1066066365, 'App\\User'),
(135, 1066066365, 'App\\User'),
(160, 1066066365, 'App\\User'),
(136, 1066066365, 'App\\User'),
(137, 1066066365, 'App\\User'),
(138, 1066066365, 'App\\User'),
(161, 1066066365, 'App\\User'),
(139, 1066066365, 'App\\User'),
(140, 1066066365, 'App\\User'),
(141, 1066066365, 'App\\User'),
(162, 1066066365, 'App\\User'),
(142, 1066066365, 'App\\User'),
(143, 1066066365, 'App\\User'),
(144, 1066066365, 'App\\User'),
(163, 1066066365, 'App\\User'),
(145, 1066066365, 'App\\User'),
(146, 1066066365, 'App\\User'),
(147, 1066066365, 'App\\User'),
(164, 1066066365, 'App\\User'),
(148, 1066066365, 'App\\User'),
(149, 1066066365, 'App\\User'),
(150, 1066066365, 'App\\User'),
(165, 1066066365, 'App\\User'),
(151, 1066066365, 'App\\User'),
(152, 1066066365, 'App\\User'),
(153, 1066066365, 'App\\User'),
(166, 1066066365, 'App\\User'),
(154, 1066066365, 'App\\User'),
(155, 1066066365, 'App\\User'),
(175, 1066066365, 'App\\User'),
(176, 1066066365, 'App\\User'),
(177, 1066066365, 'App\\User'),
(178, 1066066365, 'App\\User'),
(180, 1066066365, 'App\\User'),
(179, 1066066365, 'App\\User'),
(181, 1066066365, 'App\\User'),
(182, 1066066365, 'App\\User'),
(184, 1066066365, 'App\\User'),
(183, 1066066365, 'App\\User'),
(185, 1066066365, 'App\\User'),
(186, 1066066365, 'App\\User'),
(1, 1256565666, 'App\\User'),
(2, 1256565666, 'App\\User'),
(3, 1256565666, 'App\\User'),
(4, 1256565666, 'App\\User'),
(21, 1254698743, 'App\\User'),
(22, 1254698743, 'App\\User'),
(23, 1254698743, 'App\\User'),
(24, 1254698743, 'App\\User'),
(25, 1254698743, 'App\\User'),
(26, 1254698743, 'App\\User'),
(27, 1254698743, 'App\\User'),
(28, 1254698743, 'App\\User'),
(1, 1066559989, 'App\\User'),
(2, 1066559989, 'App\\User'),
(3, 1066559989, 'App\\User'),
(4, 1066559989, 'App\\User'),
(5, 1066559989, 'App\\User'),
(6, 1066559989, 'App\\User'),
(7, 1066559989, 'App\\User'),
(8, 1066559989, 'App\\User'),
(172, 1066559989, 'App\\User'),
(171, 1066559989, 'App\\User'),
(173, 1066559989, 'App\\User'),
(174, 1066559989, 'App\\User'),
(9, 1066559989, 'App\\User'),
(10, 1066559989, 'App\\User'),
(11, 1066559989, 'App\\User'),
(12, 1066559989, 'App\\User'),
(1, 1236547892, 'App\\User'),
(2, 1236547892, 'App\\User'),
(3, 1236547892, 'App\\User'),
(4, 1236547892, 'App\\User'),
(5, 1236547892, 'App\\User'),
(6, 1236547892, 'App\\User'),
(7, 1236547892, 'App\\User'),
(8, 1236547892, 'App\\User'),
(172, 1236547892, 'App\\User'),
(171, 1236547892, 'App\\User'),
(173, 1236547892, 'App\\User'),
(174, 1236547892, 'App\\User'),
(1, 1649785253, 'App\\User'),
(2, 1649785253, 'App\\User'),
(3, 1649785253, 'App\\User'),
(4, 1649785253, 'App\\User'),
(5, 1649785253, 'App\\User'),
(6, 1649785253, 'App\\User'),
(7, 1649785253, 'App\\User'),
(8, 1649785253, 'App\\User'),
(57, 1649785253, 'App\\User'),
(58, 1649785253, 'App\\User'),
(59, 1649785253, 'App\\User'),
(60, 1649785253, 'App\\User'),
(13, 12368852, 'App\\User'),
(14, 12368852, 'App\\User'),
(15, 12368852, 'App\\User'),
(16, 12368852, 'App\\User'),
(141, 12368852, 'App\\User'),
(162, 12368852, 'App\\User'),
(142, 12368852, 'App\\User'),
(143, 12368852, 'App\\User'),
(61, 0, 'App\\User'),
(62, 0, 'App\\User'),
(63, 0, 'App\\User'),
(64, 0, 'App\\User'),
(1, 12698746, 'App\\User'),
(2, 12698746, 'App\\User'),
(3, 12698746, 'App\\User'),
(4, 12698746, 'App\\User'),
(5, 12698746, 'App\\User'),
(6, 12698746, 'App\\User'),
(7, 12698746, 'App\\User'),
(8, 12698746, 'App\\User'),
(9, 12698746, 'App\\User'),
(10, 12698746, 'App\\User'),
(11, 12698746, 'App\\User'),
(12, 12698746, 'App\\User'),
(13, 12698746, 'App\\User'),
(14, 12698746, 'App\\User'),
(15, 12698746, 'App\\User'),
(16, 12698746, 'App\\User'),
(17, 12698746, 'App\\User'),
(18, 12698746, 'App\\User'),
(19, 12698746, 'App\\User'),
(20, 12698746, 'App\\User'),
(21, 12698746, 'App\\User'),
(22, 12698746, 'App\\User'),
(23, 12698746, 'App\\User'),
(24, 12698746, 'App\\User'),
(25, 12698746, 'App\\User'),
(26, 12698746, 'App\\User'),
(27, 12698746, 'App\\User'),
(28, 12698746, 'App\\User'),
(29, 12698746, 'App\\User'),
(30, 12698746, 'App\\User'),
(31, 12698746, 'App\\User'),
(32, 12698746, 'App\\User'),
(33, 12698746, 'App\\User'),
(34, 12698746, 'App\\User'),
(35, 12698746, 'App\\User'),
(36, 12698746, 'App\\User'),
(37, 12698746, 'App\\User'),
(38, 12698746, 'App\\User'),
(39, 12698746, 'App\\User'),
(40, 12698746, 'App\\User'),
(41, 12698746, 'App\\User'),
(42, 12698746, 'App\\User'),
(43, 12698746, 'App\\User'),
(44, 12698746, 'App\\User'),
(45, 12698746, 'App\\User'),
(46, 12698746, 'App\\User'),
(47, 12698746, 'App\\User'),
(48, 12698746, 'App\\User'),
(49, 12698746, 'App\\User'),
(50, 12698746, 'App\\User'),
(51, 12698746, 'App\\User'),
(52, 12698746, 'App\\User'),
(53, 12698746, 'App\\User'),
(54, 12698746, 'App\\User'),
(55, 12698746, 'App\\User'),
(56, 12698746, 'App\\User'),
(57, 12698746, 'App\\User'),
(58, 12698746, 'App\\User'),
(59, 12698746, 'App\\User'),
(60, 12698746, 'App\\User'),
(61, 12698746, 'App\\User'),
(62, 12698746, 'App\\User'),
(63, 12698746, 'App\\User'),
(64, 12698746, 'App\\User'),
(65, 12698746, 'App\\User'),
(66, 12698746, 'App\\User'),
(67, 12698746, 'App\\User'),
(68, 12698746, 'App\\User'),
(69, 12698746, 'App\\User'),
(70, 12698746, 'App\\User'),
(71, 12698746, 'App\\User'),
(72, 12698746, 'App\\User'),
(73, 12698746, 'App\\User'),
(74, 12698746, 'App\\User'),
(75, 12698746, 'App\\User'),
(76, 12698746, 'App\\User'),
(78, 12698746, 'App\\User'),
(79, 12698746, 'App\\User'),
(80, 12698746, 'App\\User'),
(81, 12698746, 'App\\User'),
(82, 12698746, 'App\\User'),
(83, 12698746, 'App\\User'),
(84, 12698746, 'App\\User'),
(85, 12698746, 'App\\User'),
(86, 12698746, 'App\\User'),
(87, 12698746, 'App\\User'),
(88, 12698746, 'App\\User'),
(89, 12698746, 'App\\User'),
(90, 12698746, 'App\\User'),
(91, 12698746, 'App\\User'),
(92, 12698746, 'App\\User'),
(93, 12698746, 'App\\User'),
(94, 12698746, 'App\\User'),
(95, 12698746, 'App\\User'),
(96, 12698746, 'App\\User'),
(97, 12698746, 'App\\User'),
(98, 12698746, 'App\\User'),
(99, 12698746, 'App\\User'),
(100, 12698746, 'App\\User'),
(101, 12698746, 'App\\User'),
(102, 12698746, 'App\\User'),
(103, 12698746, 'App\\User'),
(104, 12698746, 'App\\User'),
(105, 12698746, 'App\\User'),
(106, 12698746, 'App\\User'),
(107, 12698746, 'App\\User'),
(108, 12698746, 'App\\User'),
(109, 12698746, 'App\\User'),
(110, 12698746, 'App\\User'),
(111, 12698746, 'App\\User'),
(112, 12698746, 'App\\User'),
(113, 12698746, 'App\\User'),
(114, 12698746, 'App\\User'),
(115, 12698746, 'App\\User'),
(116, 12698746, 'App\\User'),
(117, 12698746, 'App\\User'),
(118, 12698746, 'App\\User'),
(119, 12698746, 'App\\User'),
(120, 12698746, 'App\\User'),
(121, 12698746, 'App\\User'),
(122, 12698746, 'App\\User'),
(123, 12698746, 'App\\User'),
(124, 12698746, 'App\\User'),
(125, 12698746, 'App\\User'),
(126, 12698746, 'App\\User'),
(127, 12698746, 'App\\User'),
(128, 12698746, 'App\\User'),
(129, 12698746, 'App\\User'),
(130, 12698746, 'App\\User'),
(131, 12698746, 'App\\User'),
(132, 12698746, 'App\\User'),
(133, 12698746, 'App\\User'),
(134, 12698746, 'App\\User'),
(135, 12698746, 'App\\User'),
(136, 12698746, 'App\\User'),
(137, 12698746, 'App\\User'),
(138, 12698746, 'App\\User'),
(139, 12698746, 'App\\User'),
(140, 12698746, 'App\\User'),
(141, 12698746, 'App\\User'),
(142, 12698746, 'App\\User'),
(143, 12698746, 'App\\User'),
(144, 12698746, 'App\\User'),
(145, 12698746, 'App\\User'),
(146, 12698746, 'App\\User'),
(147, 12698746, 'App\\User'),
(148, 12698746, 'App\\User'),
(149, 12698746, 'App\\User'),
(150, 12698746, 'App\\User'),
(151, 12698746, 'App\\User'),
(152, 12698746, 'App\\User'),
(153, 12698746, 'App\\User'),
(154, 12698746, 'App\\User'),
(155, 12698746, 'App\\User'),
(156, 12698746, 'App\\User'),
(157, 12698746, 'App\\User'),
(158, 12698746, 'App\\User'),
(159, 12698746, 'App\\User'),
(160, 12698746, 'App\\User'),
(161, 12698746, 'App\\User'),
(162, 12698746, 'App\\User'),
(163, 12698746, 'App\\User'),
(164, 12698746, 'App\\User'),
(165, 12698746, 'App\\User'),
(166, 12698746, 'App\\User'),
(167, 12698746, 'App\\User'),
(168, 12698746, 'App\\User'),
(169, 12698746, 'App\\User'),
(170, 12698746, 'App\\User'),
(171, 12698746, 'App\\User'),
(172, 12698746, 'App\\User'),
(173, 12698746, 'App\\User'),
(174, 12698746, 'App\\User'),
(175, 12698746, 'App\\User'),
(176, 12698746, 'App\\User'),
(177, 12698746, 'App\\User'),
(178, 12698746, 'App\\User'),
(179, 12698746, 'App\\User'),
(180, 12698746, 'App\\User'),
(181, 12698746, 'App\\User'),
(182, 12698746, 'App\\User'),
(183, 12698746, 'App\\User'),
(184, 12698746, 'App\\User'),
(185, 12698746, 'App\\User'),
(186, 12698746, 'App\\User'),
(1, 552, 'App\\User'),
(2, 552, 'App\\User'),
(3, 552, 'App\\User'),
(4, 552, 'App\\User'),
(5, 552, 'App\\User'),
(6, 552, 'App\\User'),
(7, 552, 'App\\User'),
(8, 552, 'App\\User'),
(9, 552, 'App\\User'),
(10, 552, 'App\\User'),
(11, 552, 'App\\User'),
(12, 552, 'App\\User'),
(13, 552, 'App\\User'),
(14, 552, 'App\\User'),
(15, 552, 'App\\User'),
(16, 552, 'App\\User'),
(17, 552, 'App\\User'),
(18, 552, 'App\\User'),
(19, 552, 'App\\User'),
(20, 552, 'App\\User'),
(21, 552, 'App\\User'),
(22, 552, 'App\\User'),
(23, 552, 'App\\User'),
(24, 552, 'App\\User'),
(25, 552, 'App\\User'),
(26, 552, 'App\\User'),
(27, 552, 'App\\User'),
(28, 552, 'App\\User'),
(29, 552, 'App\\User'),
(30, 552, 'App\\User'),
(31, 552, 'App\\User'),
(32, 552, 'App\\User'),
(33, 552, 'App\\User'),
(34, 552, 'App\\User'),
(35, 552, 'App\\User'),
(36, 552, 'App\\User'),
(41, 552, 'App\\User'),
(42, 552, 'App\\User'),
(43, 552, 'App\\User'),
(44, 552, 'App\\User'),
(45, 552, 'App\\User'),
(46, 552, 'App\\User'),
(47, 552, 'App\\User'),
(48, 552, 'App\\User'),
(53, 552, 'App\\User'),
(54, 552, 'App\\User'),
(55, 552, 'App\\User'),
(56, 552, 'App\\User'),
(57, 552, 'App\\User'),
(58, 552, 'App\\User'),
(59, 552, 'App\\User'),
(60, 552, 'App\\User'),
(61, 552, 'App\\User'),
(62, 552, 'App\\User'),
(63, 552, 'App\\User'),
(64, 552, 'App\\User'),
(69, 552, 'App\\User'),
(70, 552, 'App\\User'),
(71, 552, 'App\\User'),
(72, 552, 'App\\User'),
(73, 552, 'App\\User'),
(74, 552, 'App\\User'),
(75, 552, 'App\\User'),
(76, 552, 'App\\User'),
(78, 552, 'App\\User'),
(79, 552, 'App\\User'),
(80, 552, 'App\\User'),
(81, 552, 'App\\User'),
(82, 552, 'App\\User'),
(83, 552, 'App\\User'),
(84, 552, 'App\\User'),
(85, 552, 'App\\User'),
(86, 552, 'App\\User'),
(87, 552, 'App\\User'),
(88, 552, 'App\\User'),
(89, 552, 'App\\User'),
(90, 552, 'App\\User'),
(91, 552, 'App\\User'),
(92, 552, 'App\\User'),
(93, 552, 'App\\User'),
(94, 552, 'App\\User'),
(95, 552, 'App\\User'),
(96, 552, 'App\\User'),
(97, 552, 'App\\User'),
(98, 552, 'App\\User'),
(99, 552, 'App\\User'),
(100, 552, 'App\\User'),
(101, 552, 'App\\User'),
(102, 552, 'App\\User'),
(103, 552, 'App\\User'),
(104, 552, 'App\\User'),
(105, 552, 'App\\User'),
(107, 552, 'App\\User'),
(108, 552, 'App\\User'),
(109, 552, 'App\\User'),
(110, 552, 'App\\User'),
(111, 552, 'App\\User'),
(112, 552, 'App\\User'),
(113, 552, 'App\\User'),
(114, 552, 'App\\User'),
(115, 552, 'App\\User'),
(116, 552, 'App\\User'),
(117, 552, 'App\\User'),
(118, 552, 'App\\User'),
(119, 552, 'App\\User'),
(120, 552, 'App\\User'),
(121, 552, 'App\\User'),
(122, 552, 'App\\User'),
(123, 552, 'App\\User'),
(124, 552, 'App\\User'),
(125, 552, 'App\\User'),
(126, 552, 'App\\User'),
(127, 552, 'App\\User'),
(128, 552, 'App\\User'),
(129, 552, 'App\\User'),
(130, 552, 'App\\User'),
(131, 552, 'App\\User'),
(132, 552, 'App\\User'),
(133, 552, 'App\\User'),
(134, 552, 'App\\User'),
(135, 552, 'App\\User'),
(136, 552, 'App\\User'),
(137, 552, 'App\\User'),
(138, 552, 'App\\User'),
(139, 552, 'App\\User'),
(140, 552, 'App\\User'),
(141, 552, 'App\\User'),
(142, 552, 'App\\User'),
(143, 552, 'App\\User'),
(144, 552, 'App\\User'),
(145, 552, 'App\\User'),
(146, 552, 'App\\User'),
(147, 552, 'App\\User'),
(148, 552, 'App\\User'),
(149, 552, 'App\\User'),
(150, 552, 'App\\User'),
(151, 552, 'App\\User'),
(152, 552, 'App\\User'),
(153, 552, 'App\\User'),
(154, 552, 'App\\User'),
(155, 552, 'App\\User'),
(156, 552, 'App\\User'),
(157, 552, 'App\\User'),
(158, 552, 'App\\User'),
(159, 552, 'App\\User'),
(160, 552, 'App\\User'),
(161, 552, 'App\\User'),
(162, 552, 'App\\User'),
(163, 552, 'App\\User'),
(164, 552, 'App\\User'),
(165, 552, 'App\\User'),
(166, 552, 'App\\User'),
(167, 552, 'App\\User'),
(168, 552, 'App\\User'),
(169, 552, 'App\\User'),
(170, 552, 'App\\User'),
(171, 552, 'App\\User'),
(172, 552, 'App\\User'),
(173, 552, 'App\\User'),
(174, 552, 'App\\User'),
(175, 552, 'App\\User'),
(176, 552, 'App\\User'),
(177, 552, 'App\\User'),
(178, 552, 'App\\User'),
(179, 552, 'App\\User'),
(180, 552, 'App\\User'),
(181, 552, 'App\\User'),
(182, 552, 'App\\User'),
(183, 552, 'App\\User'),
(184, 552, 'App\\User'),
(185, 552, 'App\\User'),
(186, 552, 'App\\User'),
(1, 76856, 'App\\User'),
(2, 76856, 'App\\User'),
(3, 76856, 'App\\User'),
(4, 76856, 'App\\User'),
(5, 76856, 'App\\User'),
(6, 76856, 'App\\User'),
(7, 76856, 'App\\User'),
(8, 76856, 'App\\User'),
(9, 76856, 'App\\User'),
(10, 76856, 'App\\User'),
(11, 76856, 'App\\User'),
(12, 76856, 'App\\User'),
(13, 76856, 'App\\User'),
(14, 76856, 'App\\User'),
(15, 76856, 'App\\User'),
(16, 76856, 'App\\User'),
(17, 76856, 'App\\User'),
(18, 76856, 'App\\User'),
(19, 76856, 'App\\User'),
(20, 76856, 'App\\User'),
(21, 76856, 'App\\User'),
(22, 76856, 'App\\User'),
(23, 76856, 'App\\User'),
(24, 76856, 'App\\User'),
(25, 76856, 'App\\User'),
(26, 76856, 'App\\User'),
(27, 76856, 'App\\User'),
(28, 76856, 'App\\User'),
(29, 76856, 'App\\User'),
(30, 76856, 'App\\User'),
(31, 76856, 'App\\User'),
(32, 76856, 'App\\User'),
(33, 76856, 'App\\User'),
(34, 76856, 'App\\User'),
(35, 76856, 'App\\User'),
(36, 76856, 'App\\User'),
(37, 76856, 'App\\User'),
(38, 76856, 'App\\User'),
(39, 76856, 'App\\User'),
(40, 76856, 'App\\User'),
(41, 76856, 'App\\User'),
(42, 76856, 'App\\User'),
(43, 76856, 'App\\User'),
(44, 76856, 'App\\User'),
(45, 76856, 'App\\User'),
(46, 76856, 'App\\User'),
(47, 76856, 'App\\User'),
(48, 76856, 'App\\User'),
(49, 76856, 'App\\User'),
(50, 76856, 'App\\User'),
(51, 76856, 'App\\User'),
(52, 76856, 'App\\User'),
(53, 76856, 'App\\User'),
(54, 76856, 'App\\User'),
(55, 76856, 'App\\User'),
(56, 76856, 'App\\User'),
(57, 76856, 'App\\User'),
(58, 76856, 'App\\User'),
(59, 76856, 'App\\User'),
(60, 76856, 'App\\User'),
(61, 76856, 'App\\User'),
(62, 76856, 'App\\User'),
(63, 76856, 'App\\User'),
(64, 76856, 'App\\User'),
(65, 76856, 'App\\User'),
(66, 76856, 'App\\User'),
(67, 76856, 'App\\User'),
(68, 76856, 'App\\User'),
(69, 76856, 'App\\User'),
(70, 76856, 'App\\User'),
(71, 76856, 'App\\User'),
(72, 76856, 'App\\User'),
(73, 76856, 'App\\User'),
(74, 76856, 'App\\User'),
(75, 76856, 'App\\User'),
(76, 76856, 'App\\User'),
(78, 76856, 'App\\User'),
(79, 76856, 'App\\User'),
(80, 76856, 'App\\User'),
(81, 76856, 'App\\User'),
(82, 76856, 'App\\User'),
(83, 76856, 'App\\User'),
(84, 76856, 'App\\User'),
(85, 76856, 'App\\User'),
(86, 76856, 'App\\User'),
(87, 76856, 'App\\User'),
(88, 76856, 'App\\User'),
(89, 76856, 'App\\User'),
(90, 76856, 'App\\User'),
(91, 76856, 'App\\User'),
(92, 76856, 'App\\User'),
(93, 76856, 'App\\User'),
(94, 76856, 'App\\User'),
(95, 76856, 'App\\User'),
(96, 76856, 'App\\User'),
(97, 76856, 'App\\User'),
(98, 76856, 'App\\User'),
(99, 76856, 'App\\User'),
(100, 76856, 'App\\User'),
(101, 76856, 'App\\User'),
(102, 76856, 'App\\User'),
(103, 76856, 'App\\User'),
(104, 76856, 'App\\User'),
(105, 76856, 'App\\User'),
(106, 76856, 'App\\User'),
(107, 76856, 'App\\User'),
(108, 76856, 'App\\User'),
(109, 76856, 'App\\User'),
(110, 76856, 'App\\User'),
(111, 76856, 'App\\User'),
(112, 76856, 'App\\User'),
(113, 76856, 'App\\User'),
(114, 76856, 'App\\User'),
(115, 76856, 'App\\User'),
(116, 76856, 'App\\User'),
(117, 76856, 'App\\User'),
(118, 76856, 'App\\User'),
(119, 76856, 'App\\User'),
(120, 76856, 'App\\User'),
(121, 76856, 'App\\User'),
(122, 76856, 'App\\User'),
(123, 76856, 'App\\User'),
(124, 76856, 'App\\User'),
(125, 76856, 'App\\User'),
(126, 76856, 'App\\User'),
(127, 76856, 'App\\User'),
(128, 76856, 'App\\User'),
(129, 76856, 'App\\User'),
(130, 76856, 'App\\User'),
(131, 76856, 'App\\User'),
(132, 76856, 'App\\User'),
(133, 76856, 'App\\User'),
(134, 76856, 'App\\User'),
(135, 76856, 'App\\User'),
(136, 76856, 'App\\User'),
(137, 76856, 'App\\User'),
(138, 76856, 'App\\User'),
(139, 76856, 'App\\User'),
(140, 76856, 'App\\User'),
(141, 76856, 'App\\User'),
(142, 76856, 'App\\User'),
(143, 76856, 'App\\User'),
(144, 76856, 'App\\User'),
(145, 76856, 'App\\User'),
(146, 76856, 'App\\User'),
(147, 76856, 'App\\User'),
(148, 76856, 'App\\User'),
(149, 76856, 'App\\User'),
(150, 76856, 'App\\User'),
(151, 76856, 'App\\User'),
(152, 76856, 'App\\User'),
(153, 76856, 'App\\User'),
(154, 76856, 'App\\User'),
(155, 76856, 'App\\User'),
(156, 76856, 'App\\User'),
(157, 76856, 'App\\User'),
(158, 76856, 'App\\User'),
(159, 76856, 'App\\User'),
(160, 76856, 'App\\User'),
(161, 76856, 'App\\User'),
(162, 76856, 'App\\User'),
(163, 76856, 'App\\User'),
(164, 76856, 'App\\User'),
(165, 76856, 'App\\User'),
(166, 76856, 'App\\User'),
(167, 76856, 'App\\User'),
(168, 76856, 'App\\User'),
(169, 76856, 'App\\User'),
(170, 76856, 'App\\User'),
(171, 76856, 'App\\User'),
(172, 76856, 'App\\User'),
(173, 76856, 'App\\User'),
(174, 76856, 'App\\User'),
(175, 76856, 'App\\User'),
(176, 76856, 'App\\User'),
(177, 76856, 'App\\User'),
(178, 76856, 'App\\User'),
(179, 76856, 'App\\User'),
(180, 76856, 'App\\User'),
(181, 76856, 'App\\User'),
(182, 76856, 'App\\User'),
(183, 76856, 'App\\User'),
(184, 76856, 'App\\User'),
(185, 76856, 'App\\User'),
(186, 76856, 'App\\User');
INSERT INTO `permission_user` (`permission_id`, `user_id`, `user_type`) VALUES
(187, 1, 'App\\User'),
(188, 1, 'App\\User'),
(189, 1, 'App\\User'),
(190, 1, 'App\\User'),
(1, 1234568852, 'App\\User'),
(2, 1234568852, 'App\\User'),
(3, 1234568852, 'App\\User'),
(4, 1234568852, 'App\\User'),
(5, 1234568852, 'App\\User'),
(6, 1234568852, 'App\\User'),
(7, 1234568852, 'App\\User'),
(8, 1234568852, 'App\\User'),
(172, 1234568852, 'App\\User'),
(171, 1234568852, 'App\\User'),
(173, 1234568852, 'App\\User'),
(174, 1234568852, 'App\\User'),
(9, 1234568852, 'App\\User'),
(10, 1234568852, 'App\\User'),
(11, 1234568852, 'App\\User'),
(12, 1234568852, 'App\\User'),
(13, 1234568852, 'App\\User'),
(14, 1234568852, 'App\\User'),
(15, 1234568852, 'App\\User'),
(16, 1234568852, 'App\\User'),
(17, 1234568852, 'App\\User'),
(18, 1234568852, 'App\\User'),
(19, 1234568852, 'App\\User'),
(20, 1234568852, 'App\\User'),
(21, 1234568852, 'App\\User'),
(22, 1234568852, 'App\\User'),
(23, 1234568852, 'App\\User'),
(24, 1234568852, 'App\\User'),
(25, 1234568852, 'App\\User'),
(26, 1234568852, 'App\\User'),
(27, 1234568852, 'App\\User'),
(28, 1234568852, 'App\\User'),
(29, 1234568852, 'App\\User'),
(30, 1234568852, 'App\\User'),
(31, 1234568852, 'App\\User'),
(32, 1234568852, 'App\\User'),
(33, 1234568852, 'App\\User'),
(34, 1234568852, 'App\\User'),
(35, 1234568852, 'App\\User'),
(36, 1234568852, 'App\\User'),
(41, 1234568852, 'App\\User'),
(42, 1234568852, 'App\\User'),
(43, 1234568852, 'App\\User'),
(44, 1234568852, 'App\\User'),
(45, 1234568852, 'App\\User'),
(46, 1234568852, 'App\\User'),
(47, 1234568852, 'App\\User'),
(48, 1234568852, 'App\\User'),
(53, 1234568852, 'App\\User'),
(54, 1234568852, 'App\\User'),
(55, 1234568852, 'App\\User'),
(56, 1234568852, 'App\\User'),
(57, 1234568852, 'App\\User'),
(58, 1234568852, 'App\\User'),
(59, 1234568852, 'App\\User'),
(60, 1234568852, 'App\\User'),
(61, 1234568852, 'App\\User'),
(62, 1234568852, 'App\\User'),
(63, 1234568852, 'App\\User'),
(64, 1234568852, 'App\\User'),
(107, 1234568852, 'App\\User'),
(108, 1234568852, 'App\\User'),
(109, 1234568852, 'App\\User'),
(110, 1234568852, 'App\\User'),
(69, 1234568852, 'App\\User'),
(70, 1234568852, 'App\\User'),
(71, 1234568852, 'App\\User'),
(72, 1234568852, 'App\\User'),
(73, 1234568852, 'App\\User'),
(74, 1234568852, 'App\\User'),
(75, 1234568852, 'App\\User'),
(76, 1234568852, 'App\\User'),
(78, 1234568852, 'App\\User'),
(79, 1234568852, 'App\\User'),
(80, 1234568852, 'App\\User'),
(81, 1234568852, 'App\\User'),
(82, 1234568852, 'App\\User'),
(83, 1234568852, 'App\\User'),
(84, 1234568852, 'App\\User'),
(85, 1234568852, 'App\\User'),
(86, 1234568852, 'App\\User'),
(87, 1234568852, 'App\\User'),
(88, 1234568852, 'App\\User'),
(89, 1234568852, 'App\\User'),
(90, 1234568852, 'App\\User'),
(91, 1234568852, 'App\\User'),
(92, 1234568852, 'App\\User'),
(93, 1234568852, 'App\\User'),
(94, 1234568852, 'App\\User'),
(95, 1234568852, 'App\\User'),
(96, 1234568852, 'App\\User'),
(97, 1234568852, 'App\\User'),
(98, 1234568852, 'App\\User'),
(99, 1234568852, 'App\\User'),
(100, 1234568852, 'App\\User'),
(101, 1234568852, 'App\\User'),
(102, 1234568852, 'App\\User'),
(103, 1234568852, 'App\\User'),
(104, 1234568852, 'App\\User'),
(105, 1234568852, 'App\\User'),
(112, 1234568852, 'App\\User'),
(111, 1234568852, 'App\\User'),
(113, 1234568852, 'App\\User'),
(114, 1234568852, 'App\\User'),
(168, 1234568852, 'App\\User'),
(167, 1234568852, 'App\\User'),
(169, 1234568852, 'App\\User'),
(170, 1234568852, 'App\\User'),
(115, 1234568852, 'App\\User'),
(116, 1234568852, 'App\\User'),
(117, 1234568852, 'App\\User'),
(118, 1234568852, 'App\\User'),
(120, 1234568852, 'App\\User'),
(119, 1234568852, 'App\\User'),
(121, 1234568852, 'App\\User'),
(122, 1234568852, 'App\\User'),
(123, 1234568852, 'App\\User'),
(156, 1234568852, 'App\\User'),
(124, 1234568852, 'App\\User'),
(125, 1234568852, 'App\\User'),
(126, 1234568852, 'App\\User'),
(157, 1234568852, 'App\\User'),
(127, 1234568852, 'App\\User'),
(128, 1234568852, 'App\\User'),
(129, 1234568852, 'App\\User'),
(158, 1234568852, 'App\\User'),
(130, 1234568852, 'App\\User'),
(131, 1234568852, 'App\\User'),
(132, 1234568852, 'App\\User'),
(159, 1234568852, 'App\\User'),
(133, 1234568852, 'App\\User'),
(134, 1234568852, 'App\\User'),
(135, 1234568852, 'App\\User'),
(160, 1234568852, 'App\\User'),
(136, 1234568852, 'App\\User'),
(137, 1234568852, 'App\\User'),
(138, 1234568852, 'App\\User'),
(161, 1234568852, 'App\\User'),
(139, 1234568852, 'App\\User'),
(140, 1234568852, 'App\\User'),
(141, 1234568852, 'App\\User'),
(162, 1234568852, 'App\\User'),
(142, 1234568852, 'App\\User'),
(143, 1234568852, 'App\\User'),
(144, 1234568852, 'App\\User'),
(163, 1234568852, 'App\\User'),
(145, 1234568852, 'App\\User'),
(146, 1234568852, 'App\\User'),
(147, 1234568852, 'App\\User'),
(164, 1234568852, 'App\\User'),
(148, 1234568852, 'App\\User'),
(149, 1234568852, 'App\\User'),
(150, 1234568852, 'App\\User'),
(165, 1234568852, 'App\\User'),
(151, 1234568852, 'App\\User'),
(152, 1234568852, 'App\\User'),
(153, 1234568852, 'App\\User'),
(166, 1234568852, 'App\\User'),
(154, 1234568852, 'App\\User'),
(155, 1234568852, 'App\\User'),
(175, 1234568852, 'App\\User'),
(176, 1234568852, 'App\\User'),
(177, 1234568852, 'App\\User'),
(178, 1234568852, 'App\\User'),
(180, 1234568852, 'App\\User'),
(179, 1234568852, 'App\\User'),
(181, 1234568852, 'App\\User'),
(182, 1234568852, 'App\\User'),
(184, 1234568852, 'App\\User'),
(183, 1234568852, 'App\\User'),
(185, 1234568852, 'App\\User'),
(186, 1234568852, 'App\\User'),
(191, 1, 'App\\User'),
(192, 1, 'App\\User'),
(193, 1, 'App\\User'),
(194, 1, 'App\\User'),
(195, 1, 'App\\User'),
(196, 1, 'App\\User'),
(197, 1, 'App\\User'),
(198, 1, 'App\\User'),
(199, 1, 'App\\User'),
(200, 1, 'App\\User'),
(201, 1, 'App\\User'),
(202, 1, 'App\\User'),
(61, 231564156, 'App\\User'),
(62, 231564156, 'App\\User'),
(63, 231564156, 'App\\User'),
(64, 231564156, 'App\\User'),
(107, 231564156, 'App\\User'),
(108, 231564156, 'App\\User'),
(109, 231564156, 'App\\User'),
(110, 231564156, 'App\\User'),
(1, 2326, 'App\\User'),
(2, 2326, 'App\\User'),
(3, 2326, 'App\\User'),
(4, 2326, 'App\\User'),
(5, 2326, 'App\\User'),
(6, 2326, 'App\\User'),
(7, 2326, 'App\\User'),
(8, 2326, 'App\\User'),
(9, 2326, 'App\\User'),
(10, 2326, 'App\\User'),
(11, 2326, 'App\\User'),
(12, 2326, 'App\\User'),
(13, 2326, 'App\\User'),
(14, 2326, 'App\\User'),
(15, 2326, 'App\\User'),
(16, 2326, 'App\\User'),
(17, 2326, 'App\\User'),
(18, 2326, 'App\\User'),
(19, 2326, 'App\\User'),
(20, 2326, 'App\\User'),
(21, 2326, 'App\\User'),
(22, 2326, 'App\\User'),
(23, 2326, 'App\\User'),
(24, 2326, 'App\\User'),
(25, 2326, 'App\\User'),
(26, 2326, 'App\\User'),
(27, 2326, 'App\\User'),
(28, 2326, 'App\\User'),
(29, 2326, 'App\\User'),
(30, 2326, 'App\\User'),
(31, 2326, 'App\\User'),
(32, 2326, 'App\\User'),
(33, 2326, 'App\\User'),
(34, 2326, 'App\\User'),
(35, 2326, 'App\\User'),
(36, 2326, 'App\\User'),
(37, 2326, 'App\\User'),
(38, 2326, 'App\\User'),
(39, 2326, 'App\\User'),
(40, 2326, 'App\\User'),
(41, 2326, 'App\\User'),
(42, 2326, 'App\\User'),
(43, 2326, 'App\\User'),
(44, 2326, 'App\\User'),
(45, 2326, 'App\\User'),
(46, 2326, 'App\\User'),
(47, 2326, 'App\\User'),
(48, 2326, 'App\\User'),
(49, 2326, 'App\\User'),
(50, 2326, 'App\\User'),
(51, 2326, 'App\\User'),
(52, 2326, 'App\\User'),
(53, 2326, 'App\\User'),
(54, 2326, 'App\\User'),
(55, 2326, 'App\\User'),
(56, 2326, 'App\\User'),
(57, 2326, 'App\\User'),
(58, 2326, 'App\\User'),
(59, 2326, 'App\\User'),
(60, 2326, 'App\\User'),
(61, 2326, 'App\\User'),
(62, 2326, 'App\\User'),
(63, 2326, 'App\\User'),
(64, 2326, 'App\\User'),
(65, 2326, 'App\\User'),
(66, 2326, 'App\\User'),
(67, 2326, 'App\\User'),
(68, 2326, 'App\\User'),
(69, 2326, 'App\\User'),
(70, 2326, 'App\\User'),
(71, 2326, 'App\\User'),
(72, 2326, 'App\\User'),
(73, 2326, 'App\\User'),
(74, 2326, 'App\\User'),
(75, 2326, 'App\\User'),
(76, 2326, 'App\\User'),
(78, 2326, 'App\\User'),
(79, 2326, 'App\\User'),
(80, 2326, 'App\\User'),
(81, 2326, 'App\\User'),
(82, 2326, 'App\\User'),
(83, 2326, 'App\\User'),
(84, 2326, 'App\\User'),
(85, 2326, 'App\\User'),
(86, 2326, 'App\\User'),
(87, 2326, 'App\\User'),
(88, 2326, 'App\\User'),
(89, 2326, 'App\\User'),
(90, 2326, 'App\\User'),
(91, 2326, 'App\\User'),
(92, 2326, 'App\\User'),
(93, 2326, 'App\\User'),
(94, 2326, 'App\\User'),
(95, 2326, 'App\\User'),
(96, 2326, 'App\\User'),
(97, 2326, 'App\\User'),
(98, 2326, 'App\\User'),
(99, 2326, 'App\\User'),
(100, 2326, 'App\\User'),
(101, 2326, 'App\\User'),
(102, 2326, 'App\\User'),
(103, 2326, 'App\\User'),
(104, 2326, 'App\\User'),
(105, 2326, 'App\\User'),
(106, 2326, 'App\\User'),
(107, 2326, 'App\\User'),
(108, 2326, 'App\\User'),
(109, 2326, 'App\\User'),
(110, 2326, 'App\\User'),
(111, 2326, 'App\\User'),
(112, 2326, 'App\\User'),
(113, 2326, 'App\\User'),
(114, 2326, 'App\\User'),
(115, 2326, 'App\\User'),
(116, 2326, 'App\\User'),
(117, 2326, 'App\\User'),
(118, 2326, 'App\\User'),
(119, 2326, 'App\\User'),
(120, 2326, 'App\\User'),
(121, 2326, 'App\\User'),
(122, 2326, 'App\\User'),
(123, 2326, 'App\\User'),
(124, 2326, 'App\\User'),
(125, 2326, 'App\\User'),
(126, 2326, 'App\\User'),
(127, 2326, 'App\\User'),
(128, 2326, 'App\\User'),
(129, 2326, 'App\\User'),
(130, 2326, 'App\\User'),
(131, 2326, 'App\\User'),
(132, 2326, 'App\\User'),
(133, 2326, 'App\\User'),
(134, 2326, 'App\\User'),
(135, 2326, 'App\\User'),
(136, 2326, 'App\\User'),
(137, 2326, 'App\\User'),
(138, 2326, 'App\\User'),
(139, 2326, 'App\\User'),
(140, 2326, 'App\\User'),
(141, 2326, 'App\\User'),
(142, 2326, 'App\\User'),
(143, 2326, 'App\\User'),
(144, 2326, 'App\\User'),
(145, 2326, 'App\\User'),
(146, 2326, 'App\\User'),
(147, 2326, 'App\\User'),
(148, 2326, 'App\\User'),
(149, 2326, 'App\\User'),
(150, 2326, 'App\\User'),
(151, 2326, 'App\\User'),
(152, 2326, 'App\\User'),
(153, 2326, 'App\\User'),
(154, 2326, 'App\\User'),
(155, 2326, 'App\\User'),
(156, 2326, 'App\\User'),
(157, 2326, 'App\\User'),
(158, 2326, 'App\\User'),
(159, 2326, 'App\\User'),
(160, 2326, 'App\\User'),
(161, 2326, 'App\\User'),
(162, 2326, 'App\\User'),
(163, 2326, 'App\\User'),
(164, 2326, 'App\\User'),
(165, 2326, 'App\\User'),
(166, 2326, 'App\\User'),
(167, 2326, 'App\\User'),
(168, 2326, 'App\\User'),
(169, 2326, 'App\\User'),
(170, 2326, 'App\\User'),
(171, 2326, 'App\\User'),
(172, 2326, 'App\\User'),
(173, 2326, 'App\\User'),
(174, 2326, 'App\\User'),
(175, 2326, 'App\\User'),
(176, 2326, 'App\\User'),
(177, 2326, 'App\\User'),
(178, 2326, 'App\\User'),
(179, 2326, 'App\\User'),
(180, 2326, 'App\\User'),
(181, 2326, 'App\\User'),
(182, 2326, 'App\\User'),
(183, 2326, 'App\\User'),
(184, 2326, 'App\\User'),
(185, 2326, 'App\\User'),
(186, 2326, 'App\\User'),
(187, 2326, 'App\\User'),
(188, 2326, 'App\\User'),
(189, 2326, 'App\\User'),
(190, 2326, 'App\\User'),
(191, 2326, 'App\\User'),
(192, 2326, 'App\\User'),
(193, 2326, 'App\\User'),
(194, 2326, 'App\\User'),
(195, 2326, 'App\\User'),
(196, 2326, 'App\\User'),
(197, 2326, 'App\\User'),
(198, 2326, 'App\\User'),
(199, 2326, 'App\\User'),
(200, 2326, 'App\\User'),
(201, 2326, 'App\\User'),
(202, 2326, 'App\\User'),
(203, 1, 'App\\User'),
(204, 1, 'App\\User'),
(205, 1, 'App\\User'),
(206, 1, 'App\\User'),
(207, 1, 'App\\User'),
(208, 1, 'App\\User'),
(209, 1, 'App\\User'),
(210, 1, 'App\\User'),
(90, 1369958856, 'App\\User'),
(91, 1369958856, 'App\\User'),
(92, 1369958856, 'App\\User'),
(93, 1369958856, 'App\\User'),
(61, 1369958856, 'App\\User'),
(62, 1369958856, 'App\\User'),
(63, 1369958856, 'App\\User'),
(64, 1369958856, 'App\\User'),
(1, 1101001960, 'App\\User'),
(2, 1101001960, 'App\\User'),
(3, 1101001960, 'App\\User'),
(4, 1101001960, 'App\\User'),
(5, 1101001960, 'App\\User'),
(6, 1101001960, 'App\\User'),
(7, 1101001960, 'App\\User'),
(8, 1101001960, 'App\\User'),
(9, 1101001960, 'App\\User'),
(10, 1101001960, 'App\\User'),
(11, 1101001960, 'App\\User'),
(12, 1101001960, 'App\\User'),
(13, 1101001960, 'App\\User'),
(14, 1101001960, 'App\\User'),
(15, 1101001960, 'App\\User'),
(16, 1101001960, 'App\\User'),
(17, 1101001960, 'App\\User'),
(18, 1101001960, 'App\\User'),
(19, 1101001960, 'App\\User'),
(20, 1101001960, 'App\\User'),
(21, 1101001960, 'App\\User'),
(22, 1101001960, 'App\\User'),
(23, 1101001960, 'App\\User'),
(24, 1101001960, 'App\\User'),
(25, 1101001960, 'App\\User'),
(26, 1101001960, 'App\\User'),
(27, 1101001960, 'App\\User'),
(28, 1101001960, 'App\\User'),
(29, 1101001960, 'App\\User'),
(30, 1101001960, 'App\\User'),
(31, 1101001960, 'App\\User'),
(32, 1101001960, 'App\\User'),
(33, 1101001960, 'App\\User'),
(34, 1101001960, 'App\\User'),
(35, 1101001960, 'App\\User'),
(36, 1101001960, 'App\\User'),
(37, 1101001960, 'App\\User'),
(38, 1101001960, 'App\\User'),
(39, 1101001960, 'App\\User'),
(40, 1101001960, 'App\\User'),
(41, 1101001960, 'App\\User'),
(42, 1101001960, 'App\\User'),
(43, 1101001960, 'App\\User'),
(44, 1101001960, 'App\\User'),
(45, 1101001960, 'App\\User'),
(46, 1101001960, 'App\\User'),
(47, 1101001960, 'App\\User'),
(48, 1101001960, 'App\\User'),
(49, 1101001960, 'App\\User'),
(50, 1101001960, 'App\\User'),
(51, 1101001960, 'App\\User'),
(52, 1101001960, 'App\\User'),
(53, 1101001960, 'App\\User'),
(54, 1101001960, 'App\\User'),
(55, 1101001960, 'App\\User'),
(56, 1101001960, 'App\\User'),
(57, 1101001960, 'App\\User'),
(58, 1101001960, 'App\\User'),
(59, 1101001960, 'App\\User'),
(60, 1101001960, 'App\\User'),
(61, 1101001960, 'App\\User'),
(62, 1101001960, 'App\\User'),
(63, 1101001960, 'App\\User'),
(64, 1101001960, 'App\\User'),
(65, 1101001960, 'App\\User'),
(66, 1101001960, 'App\\User'),
(67, 1101001960, 'App\\User'),
(68, 1101001960, 'App\\User'),
(69, 1101001960, 'App\\User'),
(70, 1101001960, 'App\\User'),
(71, 1101001960, 'App\\User'),
(72, 1101001960, 'App\\User'),
(73, 1101001960, 'App\\User'),
(74, 1101001960, 'App\\User'),
(75, 1101001960, 'App\\User'),
(76, 1101001960, 'App\\User'),
(78, 1101001960, 'App\\User'),
(79, 1101001960, 'App\\User'),
(80, 1101001960, 'App\\User'),
(81, 1101001960, 'App\\User'),
(82, 1101001960, 'App\\User'),
(83, 1101001960, 'App\\User'),
(84, 1101001960, 'App\\User'),
(85, 1101001960, 'App\\User'),
(86, 1101001960, 'App\\User'),
(87, 1101001960, 'App\\User'),
(88, 1101001960, 'App\\User'),
(89, 1101001960, 'App\\User'),
(90, 1101001960, 'App\\User'),
(91, 1101001960, 'App\\User'),
(92, 1101001960, 'App\\User'),
(93, 1101001960, 'App\\User'),
(94, 1101001960, 'App\\User'),
(95, 1101001960, 'App\\User'),
(96, 1101001960, 'App\\User'),
(97, 1101001960, 'App\\User'),
(98, 1101001960, 'App\\User'),
(99, 1101001960, 'App\\User'),
(100, 1101001960, 'App\\User'),
(101, 1101001960, 'App\\User'),
(102, 1101001960, 'App\\User'),
(103, 1101001960, 'App\\User'),
(104, 1101001960, 'App\\User'),
(105, 1101001960, 'App\\User'),
(106, 1101001960, 'App\\User'),
(107, 1101001960, 'App\\User'),
(108, 1101001960, 'App\\User'),
(109, 1101001960, 'App\\User'),
(110, 1101001960, 'App\\User'),
(111, 1101001960, 'App\\User'),
(112, 1101001960, 'App\\User'),
(113, 1101001960, 'App\\User'),
(114, 1101001960, 'App\\User'),
(115, 1101001960, 'App\\User'),
(116, 1101001960, 'App\\User'),
(117, 1101001960, 'App\\User'),
(118, 1101001960, 'App\\User'),
(119, 1101001960, 'App\\User'),
(120, 1101001960, 'App\\User'),
(121, 1101001960, 'App\\User'),
(122, 1101001960, 'App\\User'),
(123, 1101001960, 'App\\User'),
(124, 1101001960, 'App\\User'),
(125, 1101001960, 'App\\User'),
(126, 1101001960, 'App\\User'),
(127, 1101001960, 'App\\User'),
(128, 1101001960, 'App\\User'),
(129, 1101001960, 'App\\User'),
(130, 1101001960, 'App\\User'),
(131, 1101001960, 'App\\User'),
(132, 1101001960, 'App\\User'),
(133, 1101001960, 'App\\User'),
(134, 1101001960, 'App\\User'),
(135, 1101001960, 'App\\User'),
(136, 1101001960, 'App\\User'),
(137, 1101001960, 'App\\User'),
(138, 1101001960, 'App\\User'),
(139, 1101001960, 'App\\User'),
(140, 1101001960, 'App\\User'),
(141, 1101001960, 'App\\User'),
(142, 1101001960, 'App\\User'),
(143, 1101001960, 'App\\User'),
(144, 1101001960, 'App\\User'),
(145, 1101001960, 'App\\User'),
(146, 1101001960, 'App\\User'),
(147, 1101001960, 'App\\User'),
(148, 1101001960, 'App\\User'),
(149, 1101001960, 'App\\User'),
(150, 1101001960, 'App\\User'),
(151, 1101001960, 'App\\User'),
(152, 1101001960, 'App\\User'),
(153, 1101001960, 'App\\User'),
(154, 1101001960, 'App\\User'),
(155, 1101001960, 'App\\User'),
(156, 1101001960, 'App\\User'),
(157, 1101001960, 'App\\User'),
(158, 1101001960, 'App\\User'),
(159, 1101001960, 'App\\User'),
(160, 1101001960, 'App\\User'),
(161, 1101001960, 'App\\User'),
(162, 1101001960, 'App\\User'),
(163, 1101001960, 'App\\User'),
(164, 1101001960, 'App\\User'),
(165, 1101001960, 'App\\User'),
(166, 1101001960, 'App\\User'),
(167, 1101001960, 'App\\User'),
(168, 1101001960, 'App\\User'),
(169, 1101001960, 'App\\User'),
(170, 1101001960, 'App\\User'),
(171, 1101001960, 'App\\User'),
(172, 1101001960, 'App\\User'),
(173, 1101001960, 'App\\User'),
(174, 1101001960, 'App\\User'),
(175, 1101001960, 'App\\User'),
(176, 1101001960, 'App\\User'),
(177, 1101001960, 'App\\User'),
(178, 1101001960, 'App\\User'),
(179, 1101001960, 'App\\User'),
(180, 1101001960, 'App\\User'),
(181, 1101001960, 'App\\User'),
(182, 1101001960, 'App\\User'),
(183, 1101001960, 'App\\User'),
(184, 1101001960, 'App\\User'),
(185, 1101001960, 'App\\User'),
(186, 1101001960, 'App\\User'),
(187, 1101001960, 'App\\User'),
(188, 1101001960, 'App\\User'),
(189, 1101001960, 'App\\User'),
(190, 1101001960, 'App\\User'),
(191, 1101001960, 'App\\User'),
(192, 1101001960, 'App\\User'),
(193, 1101001960, 'App\\User'),
(194, 1101001960, 'App\\User'),
(195, 1101001960, 'App\\User'),
(196, 1101001960, 'App\\User'),
(197, 1101001960, 'App\\User'),
(198, 1101001960, 'App\\User'),
(199, 1101001960, 'App\\User'),
(200, 1101001960, 'App\\User'),
(201, 1101001960, 'App\\User'),
(202, 1101001960, 'App\\User'),
(203, 1101001960, 'App\\User'),
(204, 1101001960, 'App\\User'),
(205, 1101001960, 'App\\User'),
(206, 1101001960, 'App\\User'),
(207, 1101001960, 'App\\User'),
(208, 1101001960, 'App\\User'),
(209, 1101001960, 'App\\User'),
(210, 1101001960, 'App\\User');

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `place`, `place_en`, `store_id`, `created_at`, `updated_at`) VALUES
(1, 'القاهرة', 'cairo', 0, '2022-05-29 19:47:00', '2022-05-29 19:47:00');

-- --------------------------------------------------------

--
-- Table structure for table `previousorders`
--

CREATE TABLE `previousorders` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `rank_code` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `name_en` varchar(150) NOT NULL,
  `category_id` varchar(255) DEFAULT NULL,
  `company_id` varchar(255) DEFAULT NULL,
  `subcategory_id` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `price_total` float NOT NULL DEFAULT 0,
  `discount_total` float NOT NULL DEFAULT 0,
  `price_unit` float NOT NULL DEFAULT 0,
  `discount_unit` float NOT NULL DEFAULT 0,
  `discount` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `description_en` text NOT NULL,
  `unit_type` varchar(255) NOT NULL,
  `unit_type_en` varchar(150) NOT NULL,
  `quantity_unit` int(11) NOT NULL DEFAULT 1,
  `quantity_status` int(11) NOT NULL,
  `max_quantity` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `is_hidden` tinyint(1) NOT NULL DEFAULT 0,
  `is_unit` tinyint(1) NOT NULL DEFAULT 0,
  `waiting_status` int(11) NOT NULL DEFAULT 0,
  `subunit_type` varchar(255) NOT NULL,
  `subunit_type_en` varchar(150) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `recently_arrived` tinyint(1) NOT NULL DEFAULT 0,
  `discount_type` int(1) NOT NULL DEFAULT 0,
  `date_end` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `rank_code`, `name`, `name_en`, `category_id`, `company_id`, `subcategory_id`, `code`, `price_total`, `discount_total`, `price_unit`, `discount_unit`, `discount`, `description`, `description_en`, `unit_type`, `unit_type_en`, `quantity_unit`, `quantity_status`, `max_quantity`, `status`, `is_hidden`, `is_unit`, `waiting_status`, `subunit_type`, `subunit_type_en`, `image`, `recently_arrived`, `discount_type`, `date_end`, `created_at`, `updated_at`) VALUES
(1, 4, 'Albumin SPEN  2*250 ML', 'Albumin SPEN  2*250 ML', '1', '2', NULL, '6000', 345, 10, 0, 0, NULL, 'Albumin SPEN', 'Albumin SPEN', 'فايل', 'vile', 2, 1, 98, 1, 0, 0, 0, 'علبة', 'box', '1_image.jpeg', 1, 1, '2022-09-06', '2022-05-29 19:27:47', '2022-08-07 08:51:48'),
(2, 3, 'Albumin SPEN  2*50 ML', 'Albumin SPEN  2*50 ML', '1', '2', NULL, '6001', 95, 11.99, 0, 0, NULL, 'Albumin SPEN', 'Albumin SPEN', 'فايل', 'vile', 2, 1, 10, 1, 0, 0, 0, 'علبة', 'box', '2_image.jpeg', 0, 2, '2022-06-05', '2022-05-29 19:34:36', '2022-08-07 08:51:52'),
(3, 2, 'ALKALINE PHOSPHATASE  SPEN 20*3 ML', 'ALKALINE PHOSPHATASE  SPEN 20*3 ML', '1', '2', NULL, '6004', 510, 0, 0, 0, NULL, 'ALKALINE PHOSPHATASE  SPEN', 'ALKALINE PHOSPHATASE  SPEN', 'فايل', 'vile', 3, 1, 50, 1, 0, 0, 0, 'علبة', 'box', '3_image.jpeg', 0, 0, NULL, '2022-05-29 19:37:29', '2022-08-07 08:51:54'),
(4, 1, 'ALKALINE PHOSPHATASE  SPEN 1*60 ML', 'ALKALINE PHOSPHATASE  SPEN 1*60 ML', '1', '2', NULL, '6005', 288, 0, 0, 0, NULL, 'ALKALINE PHOSPHATASE  SPEN', 'ALKALINE PHOSPHATASE  SPEN', 'فايل', 'vile', 1, 1, 58, 1, 0, 0, 0, 'علبة', 'box', '4_image.jpeg', 0, 0, NULL, '2022-05-29 19:40:43', '2022-08-07 08:51:57'),
(5, 0, 'Amylase SPEN  20*2 ML', 'Amylase SPEN  20*2 ML', '1', '2', NULL, '6008', 1233, 0, 0, 0, NULL, 'Amylase SPEN', 'Amylase SPEN', 'فايل', 'vile', 2, 1, 100, 1, 0, 0, 0, 'علبة', 'box', '5_image.jpeg', 0, 0, NULL, '2022-05-29 19:45:59', '2022-08-04 15:39:22'),
(6, 0, 'LIPASE SPEN 2-25 ML', 'LIPASE SPEN 2-25 ML', '1', '2', NULL, '6010', 3840, 0, 0, 0, NULL, 'LIPASE SPEN', 'LIPASE SPEN', 'فايل', 'VIEL', 1, 1, 100, 1, 0, 0, 0, 'علبه', 'BOX', '6_image.jpeg', 0, 0, NULL, '2022-06-09 02:35:37', '2022-08-04 15:39:47'),
(7, 0, 'Bilirubin  TOTEL  SPEN   2*150ML', 'Bilirubin  TOTEL  SPEN   2*150ML', '1', '2', NULL, '6012', 448, 0, 0, 0, NULL, 'Bilirubin  TOTEL  SPEN', 'Bilirubin  TOTEL  SPEN', 'فايل', 'FILE', 2, 0, 10, 1, 0, 0, 0, 'علبه', 'BOX', '7_image.jpeg', 1, 0, NULL, '2022-06-09 02:58:42', '2022-08-04 15:42:18'),
(8, 0, 'Bilirubin  DIRECT SPEN  2*150ML', 'Bilirubin  DIRECT SPEN  2*150ML', '1', '2', NULL, '6013', 448, 0, 0, 0, NULL, 'Bilirubin  DIRECT SPEN', 'Bilirubin  DIRECT SPEN', 'فايل', 'vile', 2, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '8_image.jpeg', 1, 0, NULL, '2022-06-14 01:30:04', '2022-08-04 15:42:32'),
(9, 0, 'Calcium SPEN  2*150 ML', 'Calcium SPEN  2*150 ML', '1', '2', NULL, '6016', 385, 0, 0, 0, NULL, 'Calcium SPEN', 'Calcium SPEN', 'فايل', 'vile', 2, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '9_image.jpeg', 0, 0, NULL, '2022-06-14 01:31:46', '2022-08-04 15:46:50'),
(10, 0, 'Calcium SPEN  2*50 ML', 'Calcium SPEN  2*50 ML', '1', '2', NULL, '6017', 115, 0, 0, 0, NULL, 'Calcium SPEN', 'Calcium SPEN', 'فايل', 'vile', 2, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '10_image.jpeg', 0, 0, NULL, '2022-06-14 01:33:54', '2022-08-04 15:47:37'),
(11, 0, 'Cholesterol SPEN 10*20  ML', 'Cholesterol SPEN 10*20  ML', '1', '2', NULL, '6020', 470, 2, 0, 0, NULL, 'Cholesterol SPEN', 'Cholesterol SPEN', 'فايل', 'vile', 10, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '11_image.jpeg', 0, 1, '2022-07-13', '2022-06-14 01:51:13', '2022-08-04 15:48:15'),
(12, 0, 'Cholesterol SPEN  2*50  ML', 'Cholesterol SPEN  2*50  ML', '1', '2', NULL, '6021', 170, 0, 0, 0, NULL, 'Cholesterol SPEN', 'Cholesterol SPEN', 'فايل', 'vile', 2, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '12_image.jpeg', 0, 0, NULL, '2022-06-14 01:52:26', '2022-08-04 15:48:34'),
(13, 0, 'CK-NAS  SPEN   20*2.5  ML', 'CK-NAS  SPEN   20*2.5  ML', '1', '2', NULL, '6025', 778, 0, 0, 0, NULL, 'CK-NAS  SPEN   20*2.5  ML', 'CK-NAS  SPEN   20*2.5  ML', 'فايل', 'vile', 20, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '13_image.jpeg', 0, 0, NULL, '2022-06-14 01:53:58', '2022-08-04 15:50:50'),
(14, 0, 'CK-MB   SPEN   19*20.5ML', 'CK-MB   SPEN   19*20.5ML', '1', '2', NULL, '6026', 1088, 0, 0, 0, NULL, 'CK-MB   SPEN   19*20.5ML', 'CK-MB   SPEN   19*20.5ML', 'فايل', 'vile', 20, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '14_image.jpeg', 0, 0, NULL, '2022-06-14 01:55:17', '2022-08-04 15:50:08'),
(15, 0, 'Creatinin SPEN  2*150 ML', 'Creatinin SPEN  2*150 ML', '1', '2', NULL, '6029', 340, 0, 0, 0, NULL, 'Creatinin SPEN  2*150 ML', 'Creatinin SPEN  2*150 ML', 'فايل', 'vile', 2, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '15_image.jpeg', 0, 0, NULL, '2022-06-14 01:56:26', '2022-08-04 15:51:58'),
(16, 0, 'Creatinin SPEN  2*50 ML', 'Creatinin SPEN  2*50 ML', '1', '2', NULL, '6030', 95, 0, 0, 0, NULL, 'Creatinin SPEN  2*50 ML', 'Creatinin SPEN  2*50 ML', 'فايل', 'vile', 2, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '16_image.jpeg', 0, 0, NULL, '2022-06-14 01:57:48', '2022-08-04 15:52:19'),
(17, 0, 'Glucose   SPEN  4*250  ML', 'Glucose   SPEN  4*250  ML', '1', '2', NULL, '6033', 320, 0, 0, 0, NULL, 'Glucose   SPEN  4*250  ML', 'Glucose   SPEN  4*250  ML', 'فايل', 'vile', 4, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '17_image.jpeg', 0, 0, NULL, '2022-06-14 01:58:43', '2022-08-04 15:52:45'),
(18, 0, 'Glucose SPEN 4*125 ML', 'Glucose SPEN 4*125 ML', '1', '2', NULL, '6034', 260, 0, 0, 0, NULL, 'Glucose SPEN 4*125 ML', 'Glucose SPEN 4*125 ML', 'فايل', 'vile', 4, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '18_image.jpeg', 0, 0, NULL, '2022-06-14 01:59:37', '2022-08-04 15:53:20'),
(19, 0, 'Glucose SPEN 2*50 ML', 'Glucose SPEN 2*50 ML', '1', '2', NULL, '6035', 80, 0, 0, 0, NULL, 'Glucose SPEN 2*50 ML', 'Glucose SPEN 2*50 ML', 'فايل', 'vile', 2, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '19_image.jpeg', 0, 0, NULL, '2022-06-14 02:00:37', '2022-08-04 15:53:42'),
(20, 0, 'GOT SPEN  10*15 ML', 'GOT SPEN  10*15 ML', '1', '2', NULL, '6039', 510, 0, 0, 0, NULL, 'GOT SPEN  10*15 ML', 'GOT SPEN  10*15 ML', 'فايل', 'vile', 10, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '20_image.jpeg', 0, 0, NULL, '2022-06-14 02:13:52', '2022-08-04 15:54:04'),
(21, 0, 'GOT SPEN  1*60 ML', 'GOT SPEN  1*60 ML', '1', '2', NULL, '6040', 255, 0, 0, 0, NULL, 'GOT SPEN  1*60 ML', 'GOT SPEN  1*60 ML', 'فايل', 'vile', 1, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '21_image.jpeg', 0, 0, NULL, '2022-06-14 02:14:57', '2022-08-04 15:54:20'),
(22, 0, 'GPT SPEN  10*15 ML', 'GPT SPEN  10*15 ML', '1', '2', NULL, '6044', 510, 0, 0, 0, NULL, 'GPT SPEN  10*15 ML', 'GPT SPEN  10*15 ML', 'فايل', 'vile', 10, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '22_image.jpeg', 0, 0, NULL, '2022-06-14 02:15:54', '2022-08-04 15:54:33'),
(23, 0, 'GPT SPEN  1*60 ML', 'GPT SPEN  1*60 ML', '1', '2', NULL, '6045', 255, 0, 0, 0, NULL, 'GPT SPEN  1*60 ML', 'GPT SPEN  1*60 ML', 'فايل', 'vile', 1, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '23_image.jpeg', 0, 0, NULL, '2022-06-14 02:16:55', '2022-08-04 15:54:53'),
(24, 0, 'Hemoglobin SPEN  4*5 ML', 'Hemoglobin SPEN  4*5 ML', '1', '2', NULL, '6048', 275, 0, 0, 0, NULL, 'Hemoglobin SPEN  4*5 ML', 'Hemoglobin SPEN  4*5 ML', 'فايل', 'vile', 4, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '24_image.jpeg', 0, 0, NULL, '2022-06-14 02:17:52', '2022-08-04 15:58:41'),
(25, 0, 'LDH  SPEN  20*3 ML', 'LDH  SPEN  20*3 ML', '1', '2', NULL, '6051', 600, 0, 0, 0, NULL, 'LDH  SPEN  20*3 ML', 'LDH  SPEN  20*3 ML', 'فايل', 'vile', 20, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '25_image.jpeg', 0, 0, NULL, '2022-06-14 02:18:54', '2022-08-04 15:59:07'),
(26, 0, 'HDL SPEN   4*5 ML', 'HDL SPEN   4*5 ML', '1', '2', NULL, '6054', 375, 0, 0, 0, NULL, 'HDL SPEN   4*5 ML', 'HDL SPEN   4*5 ML', 'فايل', 'vile', 4, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '26_image.jpeg', 0, 0, NULL, '2022-06-14 02:19:59', '2022-08-04 15:59:25'),
(27, 0, 'Iron   SPEN  4*50 ML', 'Iron   SPEN  4*50 ML', '1', '2', NULL, '6056', 1090, 0, 0, 0, NULL, 'Iron   SPEN  4*50 ML', 'Iron   SPEN  4*50 ML', 'فايل', 'vile', 4, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '27_image.jpeg', 0, 0, NULL, '2022-06-14 02:21:00', '2022-08-04 15:59:44'),
(28, 0, 'Phosphorus SPEN 2*150ML', 'Phosphorus SPEN 2*150ML', '1', '2', NULL, '6058', 448, 0, 0, 0, NULL, 'Phosphorus SPEN 2*150ML', 'Phosphorus SPEN 2*150ML', 'فايل', 'vile', 2, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '28_image.jpeg', 0, 0, NULL, '2022-06-14 02:21:57', '2022-08-04 16:00:19'),
(29, 0, 'T.I.P.C  SPEN 100T', 'T.I.P.C  SPEN 100T', '1', '2', NULL, '6060', 356, 0, 0, 0, NULL, 'T.I.P.C  SPEN 100T', 'T.I.P.C  SPEN 100T', 'فايل', 'vile', 1, 1, 10, 1, 0, 0, 0, 'T.I.P.C  SPEN 100T', 'T.I.P.C  SPEN 100T', '29_image.jpeg', 0, 0, NULL, '2022-06-14 02:23:04', '2022-08-04 16:00:50'),
(30, 0, 'Total Protein  SPEN  2*150 ML', 'Total Protein  SPEN  2*150 ML', '1', '2', NULL, '6062', 410, 0, 0, 0, NULL, 'Total Protein  SPEN  2*150 ML', 'Total Protein  SPEN  2*150 ML', 'فايل', 'vile', 2, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '30_image.jpeg', 0, 0, NULL, '2022-06-14 02:24:12', '2022-08-04 16:01:04'),
(31, 0, 'Total Protein  SPEN  2*50  ML', 'Total Protein  SPEN  2*50  ML', '1', '2', NULL, '6063', 97, 0, 0, 0, NULL, 'Total Protein  SPEN  2*50  ML', 'Total Protein  SPEN  2*50  ML', 'فايل', 'vile', 2, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '31_image.jpeg', 0, 0, NULL, '2022-06-14 02:25:17', '2022-08-04 16:01:17'),
(32, 0, 'Triglyceride SPEN  10*20 ML', 'Triglyceride SPEN  10*20 ML', '1', '2', NULL, '6066', 874, 0, 0, 0, NULL, 'Triglyceride SPEN  10*20 ML', 'Triglyceride SPEN  10*20 ML', 'فايل', 'vile', 10, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '32_image.jpeg', 0, 0, NULL, '2022-06-14 02:26:30', '2022-08-04 16:01:32'),
(33, 0, 'Triglyceride SPEN 1*50 ML', 'Triglyceride SPEN 1*50 ML', '1', '2', NULL, '6067', 170, 0, 0, 0, NULL, 'Triglyceride SPEN 1*50 ML', 'Triglyceride SPEN 1*50 ML', 'فايل', 'vile', 1, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '33_image.jpeg', 0, 0, NULL, '2022-06-14 02:27:28', '2022-08-04 16:02:02'),
(34, 0, 'Urea SPEN  10*20 ML', 'Urea SPEN  10*20 ML', '1', '2', NULL, '6071', 560, 0, 0, 0, NULL, 'Urea SPEN  10*20 ML', 'Urea SPEN  10*20 ML', 'فايل', 'vile', 10, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '34_image.jpeg', 0, 0, NULL, '2022-06-14 02:28:29', '2022-08-04 16:02:20'),
(35, 0, 'Urea SPEN   2*50 ML', 'Urea SPEN   2*50 ML', '1', '2', NULL, '6072', 117, 0, 0, 0, NULL, 'Urea SPEN   2*50 ML', 'Urea SPEN   2*50 ML', 'فايل', 'vile', 2, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '35_image.jpeg', 0, 0, NULL, '2022-06-14 02:29:33', '2022-08-04 16:02:40'),
(36, 0, 'Urea SPEN', 'Urea SPEN', '1', '2', NULL, '6073', 100, 0, 0, 0, NULL, 'Urea SPEN', 'Urea SPEN', 'فايل', 'vile', 1, 1, 10, 1, 1, 0, 0, 'علبه', 'box', '36_image.jpeg', 0, 0, NULL, '2022-06-14 02:30:40', '2022-08-04 16:03:17'),
(37, 0, 'Uric Acid SPEN 2X50ML', 'Uric Acid SPEN 2X50ML', '1', '2', NULL, '6075', 170, 0, 0, 0, NULL, 'Uric Acid SPEN', 'Uric Acid SPEN', 'فايل', 'vile', 0, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '37_image.jpeg', 0, 0, NULL, '2022-06-14 02:31:38', '2022-08-04 16:04:09'),
(38, 0, 'Uric Acid SPEN  10*20', 'Uric Acid SPEN  10*20', '1', '2', NULL, '6076', 443, 0, 0, 0, NULL, 'Uric Acid SPEN  10*20', 'Uric Acid SPEN  10*20', 'فايل', 'vile', 10, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '38_image.jpeg', 0, 0, NULL, '2022-06-14 02:32:58', '2022-08-04 16:04:31'),
(39, 0, 'GT   SPEN 20*2 ML', 'GT   SPEN 20*2 ML', '1', '2', NULL, '6078', 710, 0, 0, 0, NULL, 'GT   SPEN 20*2 ML', 'GT   SPEN 20*2 ML', 'فايل', 'vile', 20, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '39_image.jpeg', 0, 0, NULL, '2022-06-14 02:36:40', '2022-08-04 16:04:49'),
(40, 0, 'ASO  LATEX SPEN  100T', 'ASO  LATEX SPEN  100T', '1', '2', NULL, '6083', 159, 0, 0, 0, NULL, 'ASO  LATEX SPEN  100T', 'ASO  LATEX SPEN  100T', 'فايل', 'vile', 1, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '40_image.jpeg', 0, 0, NULL, '2022-06-14 02:37:55', '2022-08-04 16:05:11'),
(41, 0, 'CRP  LATEX SPEN  100T', 'CRP  LATEX SPEN  100T', '1', '2', NULL, '6084', 159, 0, 0, 0, NULL, 'CRP  LATEX SPEN  100T', 'CRP  LATEX SPEN  100T', 'فايل', 'vile', 1, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '41_image.jpeg', 0, 0, NULL, '2022-06-14 02:41:09', '2022-08-04 16:05:36'),
(42, 0, 'ASO TURPI SPEN 45+5+1 ML', 'ASO TURPI SPEN 45+5+1 ML', '1', '2', NULL, '6088', 150, 0, 0, 0, NULL, 'ASO TURPI SPEN 45+5+1 ML', 'ASO TURPI SPEN 45+5+1 ML', 'فايل', 'vile', 1, 1, 10, 1, 1, 0, 0, 'علبه', 'box', '42_image.jpeg', 0, 0, NULL, '2022-06-14 02:43:32', '2022-08-04 16:08:25'),
(43, 0, 'RF  LATEX SPEN  100T', 'RF  LATEX SPEN  100T', '1', '2', NULL, '6085', 150, 0, 0, 0, NULL, 'RF  LATEX SPEN  100T', 'RF  LATEX SPEN  100T', 'فايل', 'vile', 1, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '43_image.jpeg', 0, 0, NULL, '2022-06-14 02:44:33', '2022-06-14 02:44:33'),
(44, 0, 'CRP TURPI SPEN 45+5+1 ML', 'CRP TURPI SPEN 45+5+1 ML', '1', '2', NULL, '6089', 450, 0, 0, 0, NULL, 'CRP TURPI SPEN 45+5+1 ML', 'CRP TURPI SPEN 45+5+1 ML', 'فايل', 'vile', 5, 1, 10, 1, 1, 0, 0, 'علبه', 'box', '44_image.jpeg', 0, 0, NULL, '2022-06-14 02:46:07', '2022-08-04 16:08:13'),
(45, 0, 'RF  TURPI SPEN 45+5+1 ML', 'RF  TURPI SPEN 45+5+1 ML', '1', '2', NULL, '6090', 450, 0, 0, 0, NULL, 'RF  TURPI SPEN 45+5+1 ML', 'RF  TURPI SPEN 45+5+1 ML', 'فايل', 'vile', 5, 1, 10, 1, 1, 0, 0, 'علبه', 'box', '45_image.jpeg', 0, 0, NULL, '2022-06-14 02:47:21', '2022-08-04 16:08:01'),
(46, 0, 'MAGNSIUM SPEN  2*50ML', 'MAGNSIUM SPEN  2*50ML', '1', '2', NULL, '6093', 183, 0, 0, 0, NULL, 'MAGNSIUM SPEN  2*50ML', 'MAGNSIUM SPEN  2*50ML', 'فايل', 'vile', 2, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '46_image.jpeg', 0, 0, NULL, '2022-06-14 02:48:39', '2022-08-04 16:07:12'),
(47, 0, 'SODUME SPEN', 'SODUME SPEN', '1', '2', NULL, '6094', 100, 0, 0, 0, NULL, 'SODUME SPEN', 'SODUME SPEN', 'فايل', 'vile', 1, 1, 10, 1, 1, 0, 0, 'علبه', 'box', '47_image.jpeg', 0, 0, NULL, '2022-06-14 02:49:32', '2022-08-04 16:07:42'),
(48, 0, 'POTassume SPEN', 'POTassume SPEN', '1', '2', NULL, '6095', 100, 0, 0, 0, NULL, 'POTassume SPEN', 'POTassume SPEN', 'فايل', 'vile', 1, 1, 10, 1, 1, 0, 0, 'علبه', 'box', '48_image.jpeg', 0, 0, NULL, '2022-06-14 02:50:23', '2022-08-04 16:07:31'),
(49, 0, 'Albumin SPECTRUM  4*100 L (400T)', 'Albumin SPECTRUM  4*100 L (400T)', '1', '3', NULL, '6100', 100, 0, 0, 0, NULL, 'Albumin SPECTRUM  4*100 L (400T)', 'Albumin SPECTRUM  4*100 L (400T)', 'علبه', 'box', 4, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '49_image.jpeg', 1, 0, NULL, '2022-06-14 16:34:30', '2022-06-14 16:37:40'),
(50, 0, 'Albumin SPECTRUM  2*100 L (200T)', 'Albumin SPECTRUM  2*100 L (200T)', '1', '3', NULL, '6101', 100, 0, 0, 0, NULL, 'Albumin SPECTRUM  2*100 L (200T)', 'Albumin SPECTRUM  2*100 L (200T)', 'علبه', 'box', 2, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '50_image.jpeg', 1, 0, NULL, '2022-06-14 16:41:55', '2022-06-14 16:47:16'),
(51, 0, 'ALKALINE PHOSPHATASE  SPECTRUM 4*25 ML', 'ALKALINE PHOSPHATASE  SPECTRUM 4*25 ML', '1', '3', NULL, '6104', 100, 0, 0, 0, NULL, 'ALKALINE PHOSPHATASE  SPECTRUM 4*25 ML', 'ALKALINE PHOSPHATASE  SPECTRUM 4*25 ML', 'علبه', 'box', 4, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '51_image.jpeg', 0, 0, NULL, '2022-06-14 16:50:49', '2022-06-14 16:50:49'),
(52, 0, 'ALKALINE PHOSPHATASE  SPECTRUM 2*25 ML', 'ALKALINE PHOSPHATASE  SPECTRUM 2*25 ML', '1', '3', NULL, '6105', 100, 0, 0, 0, NULL, 'ALKALINE PHOSPHATASE  SPECTRUM 2*25 ML', 'ALKALINE PHOSPHATASE  SPECTRUM 2*25 ML', 'علبه', 'box', 2, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '52_image.jpeg', 0, 0, NULL, '2022-06-14 16:52:30', '2022-06-14 16:52:30'),
(53, 0, 'Amylase SPECTRUM  2*25 ML', 'Amylase SPECTRUM  2*25 ML', '1', '3', NULL, '6108', 100, 0, 0, 0, NULL, 'Amylase SPECTRUM  2*25 ML', 'Amylase SPECTRUM  2*25 ML', 'علبه', 'box', 2, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '53_image.jpeg', 0, 0, NULL, '2022-06-14 16:53:37', '2022-06-14 16:53:37'),
(54, 0, 'LIPASE SPECTRUM  1*20 ML', 'LIPASE SPECTRUM  1*20 ML', '1', '3', NULL, '6110', 100, 0, 0, 0, NULL, 'LIPASE SPECTRUM  1*20 ML', 'LIPASE SPECTRUM  1*20 ML', 'علبه', 'box', 1, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '54_image.jpeg', 0, 0, NULL, '2022-06-14 16:55:13', '2022-06-14 16:55:13'),
(55, 0, 'Bilirubin  TOTEL  SPECTRUM  750ML', 'Bilirubin  TOTEL  SPECTRUM  750ML', '1', '3', NULL, '6112', 100, 0, 0, 0, NULL, 'Bilirubin  TOTEL  SPECTRUM  750ML', 'Bilirubin  TOTEL  SPECTRUM  750ML', 'علبه', 'box', 1, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '55_image.jpeg', 0, 0, NULL, '2022-06-14 16:56:18', '2022-06-14 16:56:18'),
(56, 0, 'Bilirubin  DIRECT SPECTRUM  255ML', 'Bilirubin  DIRECT SPECTRUM  255ML', '1', '3', NULL, '6113', 100, 0, 0, 0, NULL, 'Bilirubin  DIRECT SPECTRUM  255ML', 'Bilirubin  DIRECT SPECTRUM  255ML', 'علبه', 'box', 1, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '56_image.jpeg', 0, 0, NULL, '2022-06-14 16:57:25', '2022-06-14 16:57:25'),
(57, 0, 'Calcium SPECTRUM  4*100 ML', 'Calcium SPECTRUM  4*100 ML', '1', '3', NULL, '6116', 100, 0, 0, 0, NULL, 'Calcium SPECTRUM  4*100 ML', 'Calcium SPECTRUM  4*100 ML', 'علبه', 'box', 4, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '57_image.jpeg', 0, 0, NULL, '2022-06-14 16:58:38', '2022-06-14 16:58:38'),
(58, 0, 'Calcium SPECTRUM  2*30 ML', 'Calcium SPECTRUM  2*30 ML', '1', '3', NULL, '6117', 100, 0, 0, 0, NULL, 'Calcium SPECTRUM  2*30 ML', 'Calcium SPECTRUM  2*30 ML', 'علبه', 'box', 2, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '58_image.jpeg', 0, 0, NULL, '2022-06-14 16:59:44', '2022-06-14 16:59:44'),
(59, 0, 'Cholesterol SPECTRUM 4*25 ML', 'Cholesterol SPECTRUM 4*25 ML', '1', '3', NULL, '6120', 100, 0, 0, 0, NULL, 'Cholesterol SPECTRUM 4*25 ML', 'Cholesterol SPECTRUM 4*25 ML', 'علبه', 'box', 4, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '59_image.jpeg', 0, 0, NULL, '2022-06-14 17:00:50', '2022-06-14 17:00:50'),
(60, 0, 'Cholesterol SPECTRUM  2*25 ML', 'Cholesterol SPECTRUM  2*25 ML', '1', '3', NULL, '6121', 100, 0, 0, 0, NULL, 'Cholesterol SPECTRUM  2*25 ML', 'Cholesterol SPECTRUM  2*25 ML', 'علبه', 'box', 2, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '60_image.jpeg', 0, 0, NULL, '2022-06-14 17:02:02', '2022-06-14 17:02:02'),
(61, 0, 'CK-NAS  SPECTRUM   6*5  ML (60T)', 'CK-NAS  SPECTRUM   6*5  ML (60T)', '1', '3', NULL, '6125', 100, 0, 0, 0, NULL, 'CK-NAS  SPECTRUM   6*5  ML (60T)', 'CK-NAS  SPECTRUM   6*5  ML (60T)', 'علبه', 'box', 1, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '61_image.jpeg', 0, 0, NULL, '2022-06-14 17:03:23', '2022-06-14 17:03:23'),
(62, 0, 'CK-MB   SPECTRUM   6*5  ML (60T)', 'CK-MB   SPECTRUM   6*5  ML (60T)', '1', '3', NULL, '6126', 100, 0, 0, 0, NULL, 'CK-MB   SPECTRUM   6*5  ML (60T)', 'CK-MB   SPECTRUM   6*5  ML (60T)', 'علبه', 'box', 1, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '62_image.jpeg', 0, 0, NULL, '2022-06-14 17:04:18', '2022-06-14 17:04:18'),
(63, 0, 'Creatinin SPECTRUM  2*100 ML', 'Creatinin SPECTRUM  2*100 ML', '1', '3', NULL, '6129', 100, 0, 0, 0, NULL, 'Creatinin SPECTRUM  2*100 ML', 'Creatinin SPECTRUM  2*100 ML', 'علبه', 'box', 2, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '63_image.jpeg', 0, 0, NULL, '2022-06-14 17:05:18', '2022-06-14 17:05:18'),
(64, 0, 'Creatinin SPECTRUM  2*30 ML', 'Creatinin SPECTRUM  2*30 ML', '1', '3', NULL, '6130', 100, 0, 0, 0, NULL, 'Creatinin SPECTRUM  2*30 ML', 'Creatinin SPECTRUM  2*30 ML', 'علبه', 'box', 2, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '64_image.jpeg', 0, 0, NULL, '2022-06-14 17:06:21', '2022-06-14 17:06:21'),
(65, 0, 'Glucose   SPECTRUM  8*100  ML', 'Glucose   SPECTRUM  8*100  ML', '1', '3', NULL, '6133', 100, 0, 0, 0, NULL, 'Glucose   SPECTRUM  8*100  ML', 'Glucose   SPECTRUM  8*100  ML', 'علبه', 'box', 8, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '65_image.jpeg', 0, 0, NULL, '2022-06-14 17:07:17', '2022-06-14 17:07:17'),
(66, 0, 'Glucose   SPECTRUM  4*100  ML', 'Glucose   SPECTRUM  4*100  ML', '1', '3', NULL, '6134', 100, 0, 0, 0, NULL, 'Glucose   SPECTRUM  4*100  ML', 'Glucose   SPECTRUM  4*100  ML', 'علبه', 'box', 4, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '66_image.jpeg', 0, 0, NULL, '2022-06-14 17:08:20', '2022-06-14 17:08:20'),
(67, 0, 'Glucose   SPECTRUM  2*100  ML', 'Glucose   SPECTRUM  2*100  ML', '1', '3', NULL, '6135', 100, 0, 0, 0, NULL, 'Glucose   SPECTRUM  2*100  ML', 'Glucose   SPECTRUM  2*100  ML', 'علبه', 'box', 2, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '67_image.jpeg', 0, 0, NULL, '2022-06-14 17:09:17', '2022-06-14 17:09:17'),
(68, 0, 'GOT SPECTRUM  4*50 ML', 'GOT SPECTRUM  4*50 ML', '1', '3', NULL, '6139', 100, 0, 0, 0, NULL, 'GOT SPECTRUM  4*50 ML', 'GOT SPECTRUM  4*50 ML', 'علبه', 'box', 4, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '68_image.jpeg', 0, 0, NULL, '2022-06-14 17:10:51', '2022-06-14 17:10:51'),
(69, 0, 'GOT SPECTRUM  5*20 ML', 'GOT SPECTRUM  5*20 ML', '1', '3', NULL, '6140', 100, 0, 0, 0, NULL, 'GOT SPECTRUM  5*20 ML', 'GOT SPECTRUM  5*20 ML', 'علبه', 'box', 5, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '69_image.jpeg', 0, 0, NULL, '2022-06-14 17:11:53', '2022-06-14 17:11:53'),
(70, 0, 'GPT SPECTRUM  4*50 ML', 'GPT SPECTRUM  4*50 ML', '1', '3', NULL, '6144', 100, 0, 0, 0, NULL, 'GPT SPECTRUM  4*50 ML', 'GPT SPECTRUM  4*50 ML', 'علبه', 'box', 4, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '70_image.jpeg', 0, 0, NULL, '2022-06-14 17:13:13', '2022-06-14 17:13:13'),
(71, 0, 'GPT SPECTRUM  5*20 ML', 'GPT SPECTRUM  5*20 ML', '1', '3', NULL, '6145', 100, 0, 0, 0, NULL, 'GPT SPECTRUM  5*20 ML', 'GPT SPECTRUM  5*20 ML', 'علبه', 'box', 5, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '71_image.jpeg', 0, 0, NULL, '2022-06-14 17:14:35', '2022-06-14 17:14:35'),
(72, 0, 'Hemoglobin SPECTRUM  5*20 ML', 'Hemoglobin SPECTRUM  5*20 ML', '1', '3', NULL, '6148', 100, 0, 0, 0, NULL, 'Hemoglobin SPECTRUM  5*20 ML', 'Hemoglobin SPECTRUM  5*20 ML', 'علبه', 'box', 5, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '72_image.jpeg', 0, 0, NULL, '2022-06-14 17:15:29', '2022-06-14 17:15:29'),
(73, 0, 'Hemoglobin SPECTRUM  2*20 ML', 'Hemoglobin SPECTRUM  2*20 ML', '1', '3', NULL, '6149', 100, 0, 0, 0, NULL, 'Hemoglobin SPECTRUM  2*20 ML', 'Hemoglobin SPECTRUM  2*20 ML', 'علبه', 'box', 2, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '73_image.jpeg', 0, 0, NULL, '2022-06-14 17:16:56', '2022-06-14 17:16:56'),
(74, 0, 'LDH  SPECTRUM  5*20 ML', 'LDH  SPECTRUM  5*20 ML', '1', '3', NULL, '6151', 100, 0, 0, 0, NULL, 'LDH  SPECTRUM  5*20 ML', 'LDH  SPECTRUM  5*20 ML', 'علبه', 'box', 5, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '74_image.jpeg', 0, 0, NULL, '2022-06-14 17:17:48', '2022-06-14 17:17:48'),
(75, 0, 'HDL SPECTRUM    1*50 ML', 'HDL SPECTRUM    1*50 ML', '1', '3', NULL, '6154', 100, 0, 0, 0, NULL, 'HDL SPECTRUM    1*50 ML', 'HDL SPECTRUM    1*50 ML', 'علبه', 'box', 1, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '75_image.jpeg', 0, 0, NULL, '2022-06-14 17:18:50', '2022-06-14 17:18:50'),
(76, 0, 'Iron   SPECTRUM  2*25 ML', 'Iron   SPECTRUM  2*25 ML', '1', '3', NULL, '6156', 100, 0, 0, 0, NULL, 'Iron   SPECTRUM  2*25 ML', 'Iron   SPECTRUM  2*25 ML', 'علبه', 'box', 2, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '76_image.jpeg', 0, 0, NULL, '2022-06-14 17:20:04', '2022-06-14 17:20:04'),
(77, 0, 'Phosphorus SPECTRUM  100T', 'Phosphorus SPECTRUM  100T', '1', '3', NULL, '6158', 100, 0, 0, 0, NULL, 'Phosphorus SPECTRUM  100T', 'Phosphorus SPECTRUM  100T', 'علبه', 'box', 1, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '77_image.jpeg', 0, 0, NULL, '2022-06-14 17:21:08', '2022-06-14 17:21:08'),
(78, 0, 'T.I.P.C  SPECTRUM 1*50 ML 100T', 'T.I.P.C  SPECTRUM 1*50 ML 100T', '1', '3', NULL, '6160', 100, 0, 0, 0, NULL, 'T.I.P.C  SPECTRUM 1*50 ML 100T', 'T.I.P.C  SPECTRUM 1*50 ML 100T', 'علبه', 'box', 1, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '78_image.jpeg', 0, 0, NULL, '2022-06-14 17:22:02', '2022-06-14 17:22:02'),
(79, 0, 'Total Protein  SPECTRUM  4*100 ML', 'Total Protein  SPECTRUM  4*100 ML', '1', '3', NULL, '6162', 100, 0, 0, 0, NULL, 'Total Protein  SPECTRUM  4*100 ML', 'Total Protein  SPECTRUM  4*100 ML', 'علبه', 'box', 4, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '79_image.jpeg', 0, 0, NULL, '2022-06-14 17:22:56', '2022-06-14 17:22:56'),
(80, 0, 'Total Protein  SPECTRUM  2*100 ML', 'Total Protein  SPECTRUM  2*100 ML', '1', '3', NULL, '6163', 100, 0, 0, 0, NULL, 'Total Protein  SPECTRUM  2*100 ML', 'Total Protein  SPECTRUM  2*100 ML', 'علبه', 'vile', 2, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '80_image.jpeg', 0, 0, NULL, '2022-06-14 17:24:04', '2022-06-14 17:24:04'),
(81, 0, 'Triglyceride SPECTRUM  4*25ML', 'Triglyceride SPECTRUM  4*25ML', '1', '3', NULL, '6166', 100, 0, 0, 0, NULL, 'Triglyceride SPECTRUM  4*25ML', 'Triglyceride SPECTRUM  4*25ML', 'علبه', 'box', 4, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '81_image.jpeg', 0, 0, NULL, '2022-06-14 17:24:51', '2022-06-14 17:24:51'),
(82, 0, 'Triglyceride SPECTRUM  2*25ML', 'Triglyceride SPECTRUM  2*25ML', '1', '3', NULL, '6167', 100, 0, 0, 0, NULL, 'Triglyceride SPECTRUM  2*25ML', 'Triglyceride SPECTRUM  2*25ML', 'علبه', 'box', 2, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '82_image.jpeg', 0, 0, NULL, '2022-06-14 17:25:40', '2022-06-14 17:25:40'),
(83, 0, 'Urea SPECTRUM  200T', 'Urea SPECTRUM  200T', '1', '3', NULL, '6171', 100, 0, 0, 0, NULL, 'Urea SPECTRUM  200T', 'Urea SPECTRUM  200T', 'علبه', 'box', 1, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '83_image.jpeg', 0, 0, NULL, '2022-06-14 17:26:21', '2022-06-14 17:26:21'),
(84, 0, 'Urea SPECTRUM  100T', 'Urea SPECTRUM  100T', '1', '3', NULL, '6172', 100, 0, 0, 0, NULL, 'Urea SPECTRUM  100T', 'Urea SPECTRUM  100T', 'علبه', 'box', 1, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '84_image.jpeg', 0, 0, NULL, '2022-06-14 17:27:18', '2022-06-14 17:27:18'),
(85, 0, 'Urea  UV SPECTRUM  2*20 ML', 'Urea  UV SPECTRUM  2*20 ML', '1', '3', NULL, '6173', 100, 0, 0, 0, NULL, 'Urea  UV SPECTRUM  2*20 ML', 'Urea  UV SPECTRUM  2*20 ML', 'علبه', 'box', 2, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '85_image.jpeg', 0, 0, NULL, '2022-06-14 17:28:01', '2022-06-14 17:28:01'),
(86, 0, 'Uric Acid SPECTRUM 4*50 ML', 'Uric Acid SPECTRUM 4*50 ML', '1', '3', NULL, '6175', 100, 0, 0, 0, NULL, 'Uric Acid SPECTRUM 4*50 ML', 'Uric Acid SPECTRUM 4*50 ML', 'علبه', 'box', 4, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '86_image.jpeg', 0, 0, NULL, '2022-06-14 17:28:43', '2022-06-14 17:28:43'),
(87, 0, 'Uric Acid SPECTRUM 4*30 ML', 'Uric Acid SPECTRUM 4*30 ML', '1', '3', NULL, '6176', 100, 0, 0, 0, NULL, 'Uric Acid SPECTRUM 4*30 ML', 'Uric Acid SPECTRUM 4*30 ML', 'علبه', 'box', 4, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '87_image.jpeg', 0, 0, NULL, '2022-06-14 17:30:13', '2022-06-14 17:30:13'),
(88, 0, 'GT   SPECTRUM 5*20ML', 'GT   SPECTRUM 5*20ML', '1', '3', NULL, '6178', 100, 0, 0, 0, NULL, 'GT   SPECTRUM 5*20ML', 'GT   SPECTRUM 5*20ML', 'علبه', 'box', 5, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '88_image.jpeg', 0, 0, NULL, '2022-06-14 17:32:04', '2022-06-14 17:32:04'),
(89, 0, 'ASO  LATEX SPECTRUM  100T', 'ASO  LATEX SPECTRUM  100T', '1', '3', NULL, '6183', 100, 0, 0, 0, NULL, 'ASO  LATEX SPECTRUM  100T', 'ASO  LATEX SPECTRUM  100T', 'علبه', 'box', 1, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '89_image.jpeg', 0, 0, NULL, '2022-06-14 17:32:45', '2022-06-14 17:32:45'),
(90, 0, 'CRP  LATEX SPECTRUM  100T', 'CRP  LATEX SPECTRUM  100T', '1', '3', NULL, '6184', 100, 0, 0, 0, NULL, 'CRP  LATEX SPECTRUM  100T', 'CRP  LATEX SPECTRUM  100T', 'علبه', 'box', 1, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '90_image.jpeg', 0, 0, NULL, '2022-06-14 17:33:29', '2022-06-14 17:33:29'),
(91, 0, 'RF  LATEX SPECTRUM  100T', 'RF  LATEX SPECTRUM  100T', '1', '3', NULL, '6185', 100, 0, 0, 0, NULL, 'RF  LATEX SPECTRUM  100T', 'RF  LATEX SPECTRUM  100T', 'علبه', 'box', 1, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '91_image.jpeg', 0, 0, NULL, '2022-06-14 17:34:12', '2022-06-14 17:34:12'),
(92, 0, 'MAGNSIUM SPECTRUM  2*25ML', 'MAGNSIUM SPECTRUM  2*25ML', '1', '3', NULL, '6190', 100, 0, 0, 0, NULL, 'MAGNSIUM SPECTRUM  2*25ML', 'MAGNSIUM SPECTRUM  2*25ML', 'علبه', 'box', 2, 1, 10, 1, 0, 0, 0, 'علبه', 'box', '92_image.jpeg', 0, 0, NULL, '2022-06-14 17:35:09', '2022-06-14 17:35:09'),
(93, 0, 'SODUME SPECTRUM  2*25 ML', 'SODUME SPECTRUM  2*25 ML', '1', '3', NULL, '6191', 100, 0, 0, 0, NULL, 'SODUME SPECTRUM  2*25 ML', 'SODUME SPECTRUM  2*25 ML', 'علبه', 'box', 2, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '93_image.jpeg', 0, 0, NULL, '2022-06-14 17:36:08', '2022-06-14 17:36:08'),
(94, 0, 'POTassume SPECTRUM  2*25 ML', 'POTassume SPECTRUM  2*25 ML', '1', '3', NULL, '6192', 100, 0, 0, 0, NULL, 'POTassume SPECTRUM  2*25 ML', 'POTassume SPECTRUM  2*25 ML', 'علبه', 'box', 2, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '94_image.jpeg', 0, 0, NULL, '2022-06-14 17:37:26', '2022-06-14 17:37:26'),
(95, 0, 'VIT  D  SPECTRUM  25 T', 'VIT  D  SPECTRUM  25 T', '1', '3', NULL, '6195', 100, 0, 0, 0, NULL, 'VIT  D  SPECTRUM  25 T', 'VIT  D  SPECTRUM  25 T', 'علبه', 'box', 1, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '95_image.jpeg', 0, 0, NULL, '2022-06-14 17:38:13', '2022-06-14 17:38:13'),
(96, 0, 'D- DIMER   SPECTRUM  100 T', 'D- DIMER   SPECTRUM  100 T', '1', '3', NULL, '6196', 100, 0, 0, 0, NULL, 'D- DIMER   SPECTRUM  100 T', 'D- DIMER   SPECTRUM  100 T', 'علبه', 'box', 1, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '96_image.jpeg', 0, 0, NULL, '2022-06-14 21:06:51', '2022-06-14 21:06:51'),
(97, 0, 'HBA1C  SPECTRUM 50T', 'HBA1C  SPECTRUM 50T', '1', '3', NULL, '6197', 100, 0, 0, 0, NULL, 'HBA1C  SPECTRUM 50T', 'HBA1C  SPECTRUM 50T', 'علبه', 'box', 1, 1, 10, 1, 0, 0, 0, 'فايل', 'vile', '97_image.jpeg', 0, 0, NULL, '2022-06-14 21:07:39', '2022-06-14 21:07:39'),
(98, 0, 'HCV ABON', 'HCV ABON', '4', '8', NULL, '7001', 7.5, 0, 0, 0, NULL, 'يستخدم لتحليل فيرس سى', 'يستخدم لتحليل فيرس سى', 'علبه', 'box', 40, 1, 1000, 1, 0, 0, 0, 'كارت', 'card', '98_image.jpeg', 1, 0, NULL, '2022-06-22 15:53:27', '2022-06-23 03:48:06'),
(99, 0, 'HBSAG ABON', 'HBSAG ABON', '4', '8', NULL, '7002', 5, 0, 0, 0, NULL, 'يستخدم لتحليل فيرس بى', 'يستخدم لتحليل فيرس بى', 'علبه', 'box', 40, 1, 1000, 1, 0, 0, 0, 'كارت', 'card', '99_image.jpeg', 0, 0, NULL, '2022-06-22 15:54:35', '2022-06-22 15:54:35'),
(100, 0, 'HCG ABON', 'HCG ABON', '4', '8', NULL, '7003', 5, 0, 0, 0, NULL, 'يستخدم لتحليل  حمل', 'يستخدم لتحليل  حمل', 'علبه', 'box', 40, 1, 1000, 1, 0, 0, 0, 'كارت', 'card', '100_image.jpeg', 0, 0, NULL, '2022-06-22 15:55:36', '2022-06-22 15:55:36'),
(101, 0, 'HIV ABON', 'HIV ABON', '4', '8', NULL, '7004', 10, 0, 0, 0, NULL, 'يستخدم لتحليل فيرس الايدز', 'يستخدم لتحليل فيرس الايدز', 'علبه', 'box', 40, 1, 1000, 1, 0, 0, 0, 'كارت', 'card', '101_image.jpeg', 0, 0, NULL, '2022-06-22 15:56:54', '2022-06-22 15:56:54'),
(102, 0, 'H PYLORI AG ABON', 'H PYLORI AG ABON', '4', '8', NULL, '7005', 30, 0, 0, 0, NULL, 'تستخدم لتحليل  جرثومه المعده عن طريق البراز', 'تستخدم لتحليل  جرثومه المعده عن طريق البراز', 'علبه', 'box', 25, 1, 1000, 1, 0, 0, 0, 'كارت', 'card', '102_image.jpeg', 0, 0, NULL, '2022-06-22 15:58:19', '2022-06-22 15:58:19'),
(103, 0, 'H PYLORI AB ABON', 'H PYLORI AB ABON', '4', '8', NULL, '7006', 12, 0, 0, 0, NULL, 'تستخدم لتحليل  جرثومه المعده عن طريق الدم', 'تستخدم لتحليل  جرثومه المعده عن طريق الدم', 'علبه', 'box', 40, 1, 1000, 1, 0, 0, 0, 'كارت', 'card', '103_image.jpeg', 0, 0, NULL, '2022-06-22 15:59:43', '2022-06-22 15:59:43'),
(104, 0, 'MULTI DRUG 7 ABON', 'MULTI DRUG 7 ABON', '4', '8', NULL, '7007', 35, 0, 0, 0, NULL, 'تحليل المخدرات', 'تحليل المخدرات', 'علبه', 'box', 40, 1, 1000, 1, 0, 0, 0, 'كارت', 'card', '104_image.jpeg', 0, 0, NULL, '2022-06-22 16:01:00', '2022-06-22 16:01:00'),
(105, 0, 'MULTI DRUG 4 ABON', 'MULTI DRUG 4 ABON', '4', '8', NULL, '7008', 25, 0, 0, 0, NULL, 'تحليل المخدرات', 'تحليل المخدرات', 'علبه', 'box', 25, 1, 1000, 1, 0, 0, 0, 'كارت', 'card', '105_image.jpeg', 0, 0, NULL, '2022-06-22 16:02:45', '2022-06-22 16:02:45'),
(106, 0, 'TRAMADOL ABON', 'TRAMADOL ABON', '4', '8', NULL, '7009', 10, 0, 0, 0, NULL, 'تستخدم لتحليل مخدر الترامادول', 'تستخدم لتحليل مخدر الترامادول', 'علبه', 'box', 40, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '106_image.jpeg', 0, 0, NULL, '2022-06-22 16:04:07', '2022-06-22 16:04:07'),
(107, 0, 'THC ABON', 'THC ABON', '4', '8', NULL, '7010', 10, 0, 0, 0, NULL, 'تستخدم لتحليل مخدر الحشيش', 'تستخدم لتحليل مخدر الحشيش', 'علبه', 'box', 40, 1, 1000, 1, 0, 0, 0, 'كارت', 'card', '107_image.jpeg', 0, 0, NULL, '2022-06-22 16:06:30', '2022-06-22 16:06:30'),
(108, 0, 'FOB ABON', 'FOB ABON', '4', '8', NULL, '7011', 18, 0, 0, 0, NULL, 'تستخدم لتحليل الدم المخفى فو الاستول', 'تستخدم لتحليل الدم المخفى في الاستول', 'علبه', 'box', 25, 1, 1000, 1, 0, 0, 0, 'كارت', 'card', '108_image.jpeg', 0, 0, NULL, '2022-06-22 16:10:55', '2022-06-22 16:10:55'),
(109, 0, 'TROPONIN ABON', 'TROPONIN ABON', '4', '8', NULL, '7012', 25, 0, 0, 0, NULL, 'تستخدم لتحليل خاص بالقلب', 'تستخدم لتحليل خاص بالقلب', 'علبه', 'box', 40, 1, 1000, 1, 0, 0, 0, 'كارت', 'card', '109_image.jpeg', 0, 0, NULL, '2022-06-22 16:14:14', '2022-06-22 16:14:14'),
(110, 0, 'TOXO IGM ABON', 'TOXO IGM ABON', '4', '8', NULL, '7013', 25, 0, 0, 0, NULL, 'تستخدم لتحليل خاص بمرض القطط', 'تستخدم لتحليل خاص بمرض القطط', 'علبه', 'box', 25, 1, 1000, 1, 0, 0, 0, 'كارت', 'card', '110_image.jpeg', 0, 0, NULL, '2022-06-22 16:16:43', '2022-06-22 16:16:43'),
(111, 0, 'CMV ABON', 'CMV ABON', '4', '8', NULL, '7014', 25, 0, 0, 0, NULL, 'تستخدم لتحليل خاص بالجهاض', 'تستخدم لتحليل خاص بالجهاض', 'علبه', 'box', 40, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '111_image.jpeg', 0, 0, NULL, '2022-06-22 16:18:43', '2022-06-22 16:18:43'),
(112, 0, 'MOP ABON', 'MOP ABON', '4', '8', NULL, '7015', 25, 0, 0, 0, NULL, 'تستخدم لتحليل مخدر المورفين', 'تستخدم لتحليل مخدر المورفين', 'علبه', 'box', 40, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '112_image.jpeg', 0, 0, NULL, '2022-06-22 16:19:51', '2022-06-22 16:19:51'),
(113, 0, 'RPR ABON', 'RPR ABON', '4', '8', NULL, '7016', 25, 0, 0, 0, NULL, 'تستخدم لتحليل مرض الزهرى', 'تستخدم لتحليل مرض الزهرى', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '113_image.jpeg', 0, 0, NULL, '2022-06-22 16:21:04', '2022-06-22 16:21:04'),
(114, 0, 'STROX ABON', 'STROX ABON', '4', '8', NULL, '7017', 25, 0, 0, 0, NULL, 'تستخدم لتحليل مخدر الاستروكس', 'تستخدم لتحليل مخدر الاستروكس', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '114_image.jpeg', 0, 0, NULL, '2022-06-22 16:22:10', '2022-06-22 16:22:10'),
(115, 0, 'HCV INTEC', 'HCV INTEC', '4', '9', NULL, '7031', 7.5, 0, 0, 0, NULL, 'يستخدم لتحليل فيرس سى', 'يستخدم لتحليل فيرس سى', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '115_image.jpeg', 0, 0, NULL, '2022-06-22 16:35:49', '2022-06-22 16:35:49'),
(116, 0, 'HBSAG  INTEC', 'HBSAG  INTEC', '4', '9', NULL, '7032', 5, 0, 0, 0, NULL, 'يستخدم لتحليل فيرس بى', 'يستخدم لتحليل فيرس بى', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '116_image.jpeg', 0, 0, NULL, '2022-06-22 16:36:51', '2022-06-22 16:36:51'),
(117, 0, 'HCG  INTEC', 'HCG  INTEC', '4', '9', NULL, '7033', 5, 0, 0, 0, NULL, 'يستخدم لتحليل  حمل', 'يستخدم لتحليل  حمل', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '117_image.jpeg', 0, 0, NULL, '2022-06-22 16:38:15', '2022-06-22 16:38:15'),
(118, 0, 'HIV  INTEC', 'HIV  INTEC', '4', '9', NULL, '7034', 9, 0, 0, 0, NULL, 'يستخدم لتحليل فيرس الايدز', 'يستخدم لتحليل فيرس الايدز', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '118_image.jpeg', 0, 0, NULL, '2022-06-22 16:39:44', '2022-06-22 16:39:44'),
(119, 0, 'H PYLORI AG  INTEC', 'H PYLORI AG  INTEC', '4', '9', NULL, '7035', 22, 0, 0, 0, NULL, 'تستخدم لتحليل  جرثومه المعده عن طريق البراز', 'تستخدم لتحليل  جرثومه المعده عن طريق البراز', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '119_image.jpeg', 0, 0, NULL, '2022-06-22 16:40:47', '2022-06-22 16:40:47'),
(120, 0, 'H PYLORI AB  INTEC', 'H PYLORI AB  INTEC', '4', '9', NULL, '7036', 10, 0, 0, 0, NULL, 'تستخدم لتحليل  جرثومه المعده عن طريق الدم', 'تستخدم لتحليل  جرثومه المعده عن طريق الدم', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '120_image.jpeg', 0, 0, NULL, '2022-06-22 16:42:13', '2022-06-22 16:42:13'),
(121, 0, 'تستخدم لتحليل  جرثومه المعده عن طريق الدم', 'تستخدم لتحليل  جرثومه المعده عن طريق الدم', '4', '9', NULL, '7037', 28, 0, 0, 0, NULL, 'تحليل المخدرات', 'تحليل المخدرات', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '121_image.jpeg', 0, 0, NULL, '2022-06-22 16:43:16', '2022-06-22 16:43:16'),
(122, 0, 'MULTI DRUG 4 INTEC', 'MULTI DRUG 4 INTEC', '4', '9', NULL, '7038', 22, 0, 0, 0, NULL, 'تحليل المخدرات', 'تحليل المخدرات', 'تحليل المخدرات', 'تحليل المخدرات', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '122_image.jpeg', 0, 0, NULL, '2022-06-22 16:44:58', '2022-06-22 16:44:58'),
(123, 0, 'TRAMADOL  INTEC', 'TRAMADOL  INTEC', '1', '1', NULL, '7039', 20, 0, 0, 0, NULL, 'تستخدم لتحليل مخدر الترامادول', 'تستخدم لتحليل مخدر الترامادول', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '123_image.jpeg', 0, 0, NULL, '2022-06-22 16:45:58', '2022-06-22 16:45:58'),
(124, 0, 'THC  INTEC', 'THC  INTEC', '4', '9', NULL, '7040', 15, 0, 0, 0, NULL, 'تستخدم لتحليل مخدر الحشيش', 'تستخدم لتحليل مخدر الحشيش', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '124_image.jpeg', 0, 0, NULL, '2022-06-22 16:47:16', '2022-06-22 16:47:16'),
(125, 0, 'HCV ACURATE', 'HCV ACURATE', '4', '10', NULL, '7051', 7, 0, 0, 0, NULL, 'يستخدم لتحليل فيرس سى', 'يستخدم لتحليل فيرس سى', 'علبه', 'box', 40, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '125_image.jpeg', 0, 0, NULL, '2022-06-22 17:12:24', '2022-06-22 17:12:24'),
(126, 0, 'HBSAG  ACURATE', 'HBSAG  ACURATE', '4', '10', NULL, '7052', 4.5, 0, 0, 0, NULL, 'يستخدم لتحليل فيرس بى', 'يستخدم لتحليل فيرس بى', 'علبه', 'box', 40, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '126_image.jpeg', 0, 0, NULL, '2022-06-22 17:27:38', '2022-06-22 17:27:38'),
(127, 0, 'HCG  ACURATE', 'HCG  ACURATE', '4', '10', NULL, '7053', 4.5, 0, 0, 0, NULL, 'يستخدم لتحليل  حمل', 'يستخدم لتحليل  حمل', 'علبه', 'box', 7053, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '127_image.jpeg', 0, 0, NULL, '2022-06-22 17:28:52', '2022-06-22 17:28:52'),
(128, 0, 'HIV  ACURATE', 'HIV  ACURATE', '4', '10', NULL, '7054', 7.5, 0, 0, 0, NULL, 'يستخدم لتحليل فيرس الايدز', 'يستخدم لتحليل فيرس الايدز', 'علبه', 'box', 40, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '128_image.jpeg', 0, 0, NULL, '2022-06-22 17:30:01', '2022-06-22 17:30:01'),
(129, 0, 'H PYLORI AG  ACURATE`', 'H PYLORI AG  ACURATE', '4', '10', NULL, '7055', 22, 0, 0, 0, NULL, 'تستخدم لتحليل  جرثومه المعده عن طريق البراز', 'تستخدم لتحليل  جرثومه المعده عن طريق البراز', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '129_image.jpeg', 0, 0, NULL, '2022-06-22 17:37:44', '2022-06-22 17:37:44'),
(130, 0, 'H PYLORI AB  ACURATE', 'H PYLORI AB  ACURATE', '4', '10', NULL, '7056', 10, 0, 0, 0, NULL, 'تستخدم لتحليل  جرثومه المعده عن طريق الدم', 'تستخدم لتحليل  جرثومه المعده عن طريق الدم', 'علبه', 'box', 40, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '130_image.jpeg', 0, 0, NULL, '2022-06-22 17:38:42', '2022-06-22 17:38:42'),
(131, 0, 'MULTI DRUG 7  ACURATE', 'MULTI DRUG 7  ACURATE', '4', '10', NULL, '7057', 28, 1, 0, 0, NULL, 'تحليل المخدرات', 'تحليل المخدرات', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '131_image.jpeg', 0, 1, '2022-07-22', '2022-06-22 17:40:38', '2022-06-22 17:40:38'),
(132, 0, 'MULTI DRUG 4  ACURATE', 'MULTI DRUG 4  ACURATE', '4', '10', NULL, '7058', 20, 0, 0, 0, NULL, 'تحليل المخدرات', 'تحليل المخدرات', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '132_image.jpeg', 0, 0, NULL, '2022-06-22 23:52:55', '2022-06-22 23:52:55'),
(133, 0, 'TRAMADOL  ACURATE', 'TRAMADOL  ACURATE', '4', '10', NULL, '7059', 10, 0, 0, 0, NULL, 'تستخدم لتحليل مخدر الترامادول', 'تستخدم لتحليل مخدر الترامادول', 'علبه', 'box', 40, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '133_image.jpeg', 0, 0, NULL, '2022-06-22 23:53:49', '2022-06-22 23:53:49'),
(134, 0, 'FOP  ACURATE', 'FOP  ACURATE', '4', '10', NULL, '7060', 20, 0, 0, 0, NULL, 'تستخدم لتحليل الدم المخفى في الاستول\r\n`', 'تستخدم لتحليل الدم المخفى في الاستول', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '134_image.jpeg', 0, 0, NULL, '2022-06-22 23:55:14', '2022-06-22 23:55:14'),
(135, 0, 'THC  ACURATE', 'THC  ACURATE', '4', '10', NULL, '7061', 9, 0, 0, 0, NULL, 'تستخدم لتحليل مخدر الحشيش', 'تستخدم لتحليل مخدر الحشيش', 'علبه', 'box', 40, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '135_image.jpeg', 0, 0, NULL, '2022-06-22 23:56:34', '2022-06-22 23:56:34'),
(136, 0, 'HCV  R.S', 'HCV  R.S', '4', '11', NULL, '7091', 7.5, 0, 0, 0, NULL, 'يستخدم لتحليل فيرس سى', 'يستخدم لتحليل فيرس سى', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '136_image.jpeg', 0, 0, NULL, '2022-06-23 00:21:06', '2022-06-23 00:21:06'),
(137, 0, 'HBSAG   R.S', 'HBSAG   R.S', '4', '11', NULL, '7092', 5, 0, 0, 0, NULL, 'يستخدم لتحليل فيرس بى', 'يستخدم لتحليل فيرس بى', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '137_image.jpeg', 0, 0, NULL, '2022-06-23 00:22:20', '2022-06-23 00:22:20'),
(138, 0, 'HCG    R.S', 'HCG    R.S', '4', '11', NULL, '7093', 5, 0, 0, 0, NULL, 'يستخدم لتحليل  حمل', 'يستخدم لتحليل  حمل', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '138_image.jpeg', 0, 0, NULL, '2022-06-23 00:23:17', '2022-06-23 00:23:17'),
(139, 0, 'HIV    R.S', 'HIV    R.S', '4', '11', NULL, '7094', 8, 0, 0, 0, NULL, 'يستخدم لتحليل فيرس الايدز', 'يستخدم لتحليل فيرس الايدز', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '139_image.jpeg', 0, 0, NULL, '2022-06-23 00:25:14', '2022-06-23 00:25:14'),
(140, 0, 'H PYLORI AG   R.S', 'H PYLORI AG   R.S', '4', '11', NULL, '7095', 26, 0, 0, 0, NULL, 'تستخدم لتحليل  جرثومه المعده عن طريق البراز', 'تستخدم لتحليل  جرثومه المعده عن طريق البراز', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '140_image.jpeg', 0, 0, NULL, '2022-06-23 00:26:20', '2022-06-23 00:26:20'),
(141, 0, 'H PYLORI AB  R.S', 'H PYLORI AB  R.S', '4', '11', NULL, '7096', 12, 0, 0, 0, NULL, 'تستخدم لتحليل  جرثومه المعده عن طريق الدم', 'تستخدم لتحليل  جرثومه المعده عن طريق الدم', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '141_image.jpeg', 0, 0, NULL, '2022-06-23 00:27:24', '2022-06-23 00:27:24'),
(142, 0, 'FOP   RITSINE', 'FOP   RITSINE', '4', '11', NULL, '7097', 20, 0, 0, 0, NULL, 'تستخدم لتحليل الدم المخفى فو الاستول', 'تستخدم لتحليل الدم المخفى فو الاستول', 'علبه', 'box', 10, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '142_image.jpeg', 0, 0, NULL, '2022-06-23 00:28:33', '2022-06-23 00:28:33'),
(143, 0, 'CMV    R.S', 'CMV    R.S', '4', '11', NULL, '7098', 25, 0, 0, 0, NULL, 'تستخدم لتحليل خاص بالجهاض', 'تستخدم لتحليل خاص بالجهاض', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '143_image.jpeg', 0, 0, NULL, '2022-06-23 00:29:40', '2022-06-23 00:29:40'),
(144, 0, 'TOXO  R.S', 'TOXO  R.S', '4', '11', NULL, '7099', 25, 0, 0, 0, NULL, 'تستخدم لتحليل خاص بمرض القطط', 'تستخدم لتحليل خاص بمرض القطط', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '144_image.jpeg', 0, 0, NULL, '2022-06-23 00:30:35', '2022-06-23 00:30:35'),
(145, 0, 'HSV1   RS', 'HSV1   RS', '4', '11', NULL, '7100', 25, 0, 0, 0, NULL, 'تستخدم لتحليل  امراض المناعه', 'تستخدم لتحليل  امراض المناعه', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '145_image.jpeg', 0, 0, NULL, '2022-06-23 00:31:32', '2022-06-23 00:31:32'),
(146, 0, 'HSV2   RS', 'HSV2   RS', '4', '11', NULL, '7101', 25, 0, 0, 0, NULL, 'تستخدم لتحليل  امراض المناعه', 'تستخدم لتحليل  امراض المناعه', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '146_image.jpeg', 0, 0, NULL, '2022-06-23 00:32:29', '2022-06-23 00:32:29'),
(147, 0, 'H PYLORI AG CTK', 'H PYLORI AG CTK', '4', '12', NULL, '7111', 30, 0, 0, 0, NULL, 'تستخدم لتحليل  جرثومه المعده عن طريق البراز', 'تستخدم لتحليل  جرثومه المعده عن طريق البراز', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '147_image.jpeg', 0, 0, NULL, '2022-06-23 00:33:48', '2022-06-23 00:33:48'),
(148, 0, 'CMV  ctk', 'CMV  ctk', '4', '12', NULL, '7112', 25, 0, 0, 0, NULL, 'تستخدم لتحليل خاص بالجهاض', 'تستخدم لتحليل خاص بالجهاض', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '148_image.jpeg', 0, 0, NULL, '2022-06-23 00:34:42', '2022-06-23 00:34:42'),
(149, 0, 'كارت كحول', 'كارت كحول', '4', '12', NULL, '7115', 22, 0, 0, 0, NULL, 'تستخدم لتحليل شراب مواد كحوليه', 'تستخدم لتحليل شراب مواد كحوليه', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '149_image.jpeg', 0, 0, NULL, '2022-06-23 00:36:06', '2022-06-23 00:36:06'),
(150, 0, 'كارت نيكوتين', 'كارت نيكوتين', '4', '12', NULL, '7116', 22, 0, 0, 0, NULL, 'تستخدم لتحليل  السجائر', 'تستخدم لتحليل  السجائر', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '150_image.jpeg', 0, 0, NULL, '2022-06-23 00:37:02', '2022-06-23 00:37:02'),
(151, 0, 'SHIPO TEST CART', 'SHIPO TEST CART', '4', '12', NULL, '7120', 750, 0, 0, 0, NULL, 'يستخدم لتحليل سراطان القولون', 'يستخدم لتحليل سراطان القولون', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'يستخدم لتحليل سراطان القولون', 'يستخدم لتحليل سراطان القولون', '151_image.jpeg', 0, 0, NULL, '2022-06-23 00:38:37', '2022-06-23 00:38:37'),
(152, 0, 'CAL PROTACTION', 'CAL PROTACTION', '4', '12', NULL, '7121', 120, 0, 0, 0, NULL, 'يستخدم لتحليل  المعده والقولون', 'يستخدم لتحليل  المعده والقولون', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '152_image.jpeg', 0, 0, NULL, '2022-06-23 00:39:46', '2022-06-23 00:39:46'),
(153, 0, 'COV  19   ag  roch', 'COV  19   ag  roch', '5', '13', NULL, '7124', 140, 0, 0, 0, NULL, 'يستخدم لتحليل كورونا عن طريق الانف', 'يستخدم لتحليل كورونا عن طريق الانف', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '153_image.jpeg', 0, 0, NULL, '2022-06-23 00:43:31', '2022-06-23 00:43:31'),
(154, 0, 'COV  19   ag', 'COV  19   ag', '4', '13', NULL, '7125', 65, 0, 0, 0, NULL, 'يستخدم لتحليل كورونا عن طريق الانف', 'يستخدم لتحليل كورونا عن طريق الانف', 'علبه', 'box', 20, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '154_image.jpeg', 0, 0, NULL, '2022-06-23 01:16:07', '2022-06-23 01:16:07'),
(155, 0, 'COV  19   AB', 'COV  19   AB', '5', '13', NULL, '7126', 50, 0, 0, 0, NULL, 'يستخدم لتحليل كورونا عن طريق  الدم', 'يستخدم لتحليل كورونا عن طريق  الدم', 'علبه', 'box', 20, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '155_image.jpeg', 0, 0, NULL, '2022-06-23 01:17:51', '2022-06-23 01:17:51'),
(156, 0, 'HCV         MTBI', 'HCV         MTBI', '4', '14', NULL, '7071', 6.5, 0.5, 0, 0, NULL, 'يستخدم لتحليل فيرس سى', 'يستخدم لتحليل فيرس سى', 'علبه', 'box', 40, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '156_image.jpeg', 0, 1, '2022-07-24', '2022-06-25 01:30:11', '2022-06-25 01:30:11'),
(157, 0, 'HBSAG     MTBI', 'HBSAG     MTBI', '4', '14', NULL, '7072', 4, 0, 0, 0, NULL, 'يستخدم لتحليل فيرس بى', 'يستخدم لتحليل فيرس بى', 'علبه', 'box', 40, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '157_image.jpeg', 0, 0, NULL, '2022-06-25 01:31:30', '2022-06-25 01:31:30'),
(158, 0, 'HCG        MTBI', 'HCG        MTBI', '4', '14', NULL, '7073', 4, 0, 0, 0, NULL, 'يستخدم لتحليل  حمل', 'يستخدم لتحليل  حمل', 'علبه', 'box', 40, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '158_image.jpeg', 0, 0, NULL, '2022-06-25 01:37:46', '2022-06-25 01:37:46'),
(159, 0, 'HIV          MTBI', 'HIV          MTBI', '4', '14', NULL, '7074', 7, 0, 0, 0, NULL, 'يستخدم لتحليل فيرس الايدز', 'يستخدم لتحليل فيرس الايدز', 'علبه', 'box', 40, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '159_image.jpeg', 0, 0, NULL, '2022-06-25 01:41:20', '2022-06-25 01:41:20'),
(160, 0, 'H PYLORI AG   MTBI', 'H PYLORI AG   MTBI', '4', '14', NULL, '7075', 18, 0, 0, 0, NULL, 'تستخدم لتحليل  جرثومه المعده عن طريق البراز', 'v', 'علبه', 'box', 20, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '160_image.jpeg', 0, 0, NULL, '2022-06-25 01:42:27', '2022-06-25 01:42:27'),
(161, 0, 'H PYLORI AB  MTBI', 'H PYLORI AB  MTBI', '4', '14', NULL, '7076', 10, 0, 0, 0, NULL, 'تستخدم لتحليل  جرثومه المعده عن طريق الدم', 'تستخدم لتحليل  جرثومه المعده عن طريق الدم', 'علبه', 'box', 10, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '161_image.jpeg', 0, 0, NULL, '2022-06-25 01:46:05', '2022-06-25 01:46:05'),
(162, 0, 'MULTI DRUG 7  MTBI', 'MULTI DRUG 7  MTBI', '4', '14', NULL, '7077', 20, 0, 0, 0, NULL, 'تحليل المخدرات', 'تحليل المخدرات', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '162_image.jpeg', 0, 0, NULL, '2022-06-25 01:47:27', '2022-06-25 01:47:27'),
(163, 0, 'MULTI DRUG 4  MTBI', 'MULTI DRUG 4  MTBI', '4', '14', NULL, '7078', 17, 0, 0, 0, NULL, 'تحليل المخدرات', 'تحليل المخدرات', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '163_image.jpeg', 0, 0, NULL, '2022-06-25 01:48:24', '2022-06-25 01:48:24'),
(164, 0, 'TRAMADOL  MTBI', 'TRAMADOL  MTBI', '4', '14', NULL, '7079', 9, 0, 0, 0, NULL, 'تستخدم لتحليل مخدر الترامادول', 'تستخدم لتحليل مخدر الترامادول', 'علبه', 'box', 40, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '164_image.jpeg', 0, 0, NULL, '2022-06-25 02:31:52', '2022-06-25 02:31:52'),
(165, 0, 'FOP  MTBI', 'FOP  MTBI', '4', '14', NULL, '7080', 18, 0, 0, 0, NULL, 'تستخدم لتحليل الدم المخفى فو الاستول', 'تستخدم لتحليل الدم المخفى فو الاستول', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '165_image.jpeg', 0, 0, NULL, '2022-06-25 02:32:48', '2022-06-25 02:32:48'),
(166, 0, 'THC       MTBI', 'THC       MTBI', '4', '14', NULL, '7081', 9, 0, 0, 0, NULL, 'تستخدم لتحليل مخدر الحشيش', 'تستخدم لتحليل مخدر الحشيش', 'علبه', 'box', 40, 1, 100, 1, 0, 0, 0, 'كارت', 'card', '166_image.jpeg', 0, 0, NULL, '2022-06-25 02:35:13', '2022-06-25 02:35:13'),
(167, 0, 'Combi 10 medi test', 'Combi 10 medi test', '3', '15', NULL, '7200', 210, 0, 0, 0, NULL, 'يستخدم فى تحليل اليورن', 'يستخدم فى تحليل اليورن', 'علبه', 'box', 1, 1, 100, 1, 0, 0, 0, 'فايل', 'vile', '167_image.jpeg', 0, 0, NULL, '2022-06-25 16:24:10', '2022-06-25 16:24:10'),
(168, 0, 'Combi 3 medi test', 'Combi 3 medi test', '3', '15', NULL, '7201', 90, 0, 0, 0, NULL, 'يستخدم فى تحليل اليورن', 'يستخدم فى تحليل اليورن', 'علبه', 'box', 1, 1, 100, 1, 0, 0, 0, 'فايل', 'vile', '168_image.jpeg', 0, 0, NULL, '2022-06-25 16:25:59', '2022-06-25 16:25:59'),
(169, 0, 'Combi 2 medi test', 'Combi 2 medi test', '3', '15', NULL, '7202', 90, 0, 0, 0, NULL, 'يستخدم فى تحليل اليورن', 'يستخدم فى تحليل اليورن', 'علبه', 'box', 1, 1, 100, 1, 0, 0, 0, 'فايل', 'vile', '169_image.jpeg', 0, 0, NULL, '2022-06-25 16:28:26', '2022-06-25 16:28:26'),
(170, 0, 'COMBI 10 SCREEN', 'COMBI 10 SCREEN', '3', '15', NULL, '7206', 270, 0, 0, 0, NULL, 'يستخدم فى تحليل اليورن', 'يستخدم فى تحليل اليورن', 'علبه', 'box', 150, 1, 10, 1, 0, 0, 0, 'تيست', 'TEST', '170_image.jpeg', 0, 0, NULL, '2022-06-25 16:59:47', '2022-06-25 16:59:47'),
(171, 0, 'COMBI 3 SCREEN', 'COMBI 3 SCREEN', '3', '15', NULL, '7207', 140, 0, 0, 0, NULL, 'يستخدم فى تحليل اليورن', 'يستخدم فى تحليل اليورن', 'علبه', 'box', 100, 1, 100, 1, 0, 0, 0, 'تيست', 'TEST', '171_image.jpeg', 0, 0, NULL, '2022-06-25 17:02:15', '2022-06-25 17:02:15'),
(172, 0, 'COMBI 2 SCREEN', 'COMBI 2 SCREEN', '3', '15', NULL, '7208', 140, 0, 0, 0, NULL, 'يستخدم فى تحليل اليورن', 'يستخدم فى تحليل اليورن', 'علبه', 'box', 100, 1, 10, 1, 0, 0, 0, 'تيست', 'TEST', '172_image.jpeg', 0, 0, NULL, '2022-06-25 17:03:44', '2022-06-25 17:03:44'),
(173, 0, 'COMBI STEK 10', 'COMBI STEK 10', '3', '15', NULL, '7212', 130, 0, 0, 0, NULL, 'يستخدم فى تحليل اليورن', 'يستخدم فى تحليل اليورن', 'علبه', 'box', 100, 1, 100, 1, 0, 0, 0, 'تيست', 'TEST', '173_image.jpeg', 0, 0, NULL, '2022-06-25 17:10:53', '2022-06-25 17:10:53');
INSERT INTO `products` (`id`, `rank_code`, `name`, `name_en`, `category_id`, `company_id`, `subcategory_id`, `code`, `price_total`, `discount_total`, `price_unit`, `discount_unit`, `discount`, `description`, `description_en`, `unit_type`, `unit_type_en`, `quantity_unit`, `quantity_status`, `max_quantity`, `status`, `is_hidden`, `is_unit`, `waiting_status`, `subunit_type`, `subunit_type_en`, `image`, `recently_arrived`, `discount_type`, `date_end`, `created_at`, `updated_at`) VALUES
(174, 0, 'COMBI STEK 3', 'COMBI STEK 3', '3', '15', NULL, '7213', 90, 0, 0, 0, NULL, 'يستخدم فى تحليل اليورن', 'يستخدم فى تحليل اليورن', 'علبه', 'box', 100, 1, 10, 1, 0, 0, 0, 'تيست', 'TEST', '174_image.jpeg', 0, 0, NULL, '2022-06-25 17:11:48', '2022-06-25 17:11:48'),
(175, 0, 'COMBI STEK 2', 'COMBI STEK 2', '3', '15', NULL, '7214', 90, 0, 0, 0, NULL, 'يستخدم فى تحليل اليورن', 'يستخدم فى تحليل اليورن', 'علبه', 'box', 100, 1, 100, 1, 0, 0, 0, 'تيست', 'TEST', '175_image.jpeg', 0, 0, NULL, '2022-06-25 17:14:12', '2022-06-25 17:14:12'),
(176, 0, 'Combi 10 Acon', 'Combi 10 Acon', '4', '15', NULL, '7217', 170, 0, 0, 0, NULL, 'يستخدم فى تحليل اليورن', 'يستخدم فى تحليل اليورن', 'علبه', 'box', 100, 1, 10, 1, 0, 0, 0, 'تيست', 'TEST', '176_image.jpeg', 0, 0, NULL, '2022-06-25 17:15:54', '2022-06-25 17:15:54'),
(177, 0, 'Combi 3 Acon', 'Combi 3 Acon', '3', '15', NULL, '7218', 80, 0, 0, 0, NULL, 'يستخدم فى تحليل اليورن', 'يستخدم فى تحليل اليورن', 'علبه', 'box', 100, 1, 100, 1, 0, 0, 0, 'تيست', 'TEST', '177_image.jpeg', 0, 0, NULL, '2022-06-25 17:17:02', '2022-06-25 17:17:02'),
(178, 0, 'Combi 2 Acon', 'Combi 2 Acon', '3', '15', NULL, '7219', 80, 0, 0, 0, NULL, 'يستخدم فى تحليل اليورن', 'يستخدم فى تحليل اليورن', 'علبه', 'box', 100, 1, 100, 1, 0, 0, 0, 'تيست', 'TEST', '178_image.jpeg', 0, 0, NULL, '2022-06-25 17:18:50', '2022-06-25 17:18:50'),
(179, 0, 'FILTER  TIPS  10', 'FILTER  TIPS  10', '3', '16', NULL, '7300', 150, 0, 0, 0, NULL, 'فلتر تبس 10', 'فلتر تبس 10', 'علبه', 'box', 100, 1, 10, 1, 0, 0, 0, 'وحده', 'UNIT', '179_image.jpeg', 0, 0, NULL, '2022-06-25 19:35:40', '2022-06-25 19:35:40'),
(180, 0, 'فلتر تبس 100', 'FILTER  TIPS  100', '3', '16', NULL, '7301', 150, 0, 0, 0, NULL, 'فلتر تبس معقم لنقل العينات', 'فلتر تبس معقم لنقل العينات', 'علبه', 'box', 100, 1, 10, 1, 0, 0, 0, 'وحده', 'UNIT', '180_image.jpeg', 0, 0, NULL, '2022-06-25 19:37:50', '2022-06-25 19:37:50'),
(181, 0, 'فلتر تبس 200', 'FILTER  TIPS  200', '3', '16', NULL, '7302', 180, 0, 0, 0, NULL, 'فلتر تبس معقم لنقل العينات', 'فلتر تبس معقم لنقل العينات', 'علبه', 'box', 100, 1, 10, 1, 0, 0, 0, 'وحده', 'UNIT', '181_image.jpeg', 0, 0, NULL, '2022-06-25 19:38:49', '2022-06-25 19:38:49'),
(182, 0, 'فلتر تبس 1000', 'FILTER  TIPS  1000', '3', '16', NULL, '7303', 180, 0, 0, 0, NULL, 'فلتر تبس معقم لنقل العينات', 'V', 'علبه', 'box', 100, 1, 10, 1, 0, 0, 0, 'وحده', 'UNIT', '182_image.jpeg', 0, 0, NULL, '2022-06-25 19:39:38', '2022-06-25 19:42:26'),
(183, 0, 'تبس اصفر صينى', 'YELLOW TIPS', '3', '16', NULL, '7310', 30, 0, 0, 0, NULL, 'تبس نقل العيات', 'تبس نقل العيات', 'كيس', 'bag', 1000, 1, 80, 1, 0, 0, 0, 'وحده', 'UNIT', '183_image.jpeg', 0, 0, NULL, '2022-06-25 19:58:00', '2022-06-25 19:58:00'),
(184, 0, 'تبس ازرق صينى', 'BLUE TIPS', '3', '16', NULL, '7311', 50, 0, 0, 0, NULL, 'تبس نقل العيات', 'تبس نقل العيات', 'كيس', 'bag', 500, 1, 50, 1, 0, 0, 0, 'وحده', 'UNIT', '184_image.jpeg', 0, 0, NULL, '2022-06-25 20:03:56', '2022-06-25 20:03:56'),
(185, 0, 'تبس ابيض 10 ميكرو', 'WHITE  TIPS', '3', '16', NULL, '7312', 30, 0, 0, 0, NULL, 'تبس نقل العيات', 'تبس نقل العيات', 'كيس', 'bag', 1000, 1, 50, 1, 0, 0, 0, 'وحده', 'UNIT', '185_image.jpeg', 0, 0, NULL, '2022-06-25 20:05:48', '2022-06-25 20:05:48'),
(186, 0, 'ابندورف 1.5 مل صينى', 'EPINDORF  1.5', '3', '16', NULL, '7320', 60, 0, 0, 0, NULL, 'حافظ لنقل العيات', 'حافظ لنقل العيات', 'كيس', 'bag', 500, 1, 60, 1, 0, 0, 0, 'وحده', 'UNIT', '186_image.jpeg', 0, 0, NULL, '2022-06-25 20:07:27', '2022-06-25 20:07:27'),
(187, 0, 'ابندورف 1.5 مل  مصري', 'EPINDORF  1.5', '3', '16', NULL, '7321', 55, 0, 0, 0, NULL, 'حافظ لنقل العيات', 'حافظ لنقل العيات', 'كيس', 'bag', 500, 1, 60, 1, 0, 0, 0, 'وحده', 'UNIT', '187_image.jpeg', 0, 0, NULL, '2022-06-25 20:08:53', '2022-06-25 20:08:53'),
(188, 0, 'شرائح زجاجيه مسنفره', 'SLIDE مسنفره', '3', '16', NULL, '7325', 25, 0, 0, 0, NULL, 'شرائح لفحص العيات الدقيقه  بالميكروسكوب', 'شرائح لفحص العيات الدقيقه  بالميكروسكوب', 'كيس', 'bag', 50, 1, 50, 1, 0, 0, 0, 'وحده', 'UNIT', '188_image.jpeg', 0, 0, NULL, '2022-06-25 20:31:08', '2022-06-25 20:31:08'),
(189, 0, 'شرائح زجاجيه', 'SLIDE', '3', '16', NULL, '7326', 15, 0, 0, 0, NULL, 'شرائح لفحص العيات بالميكروسكوب', 'شرائح لفحص العيات بالميكروسكوب', 'كيس', 'bag', 50, 1, 150, 1, 0, 0, 0, 'وحده', 'TEST', '189_image.jpeg', 0, 0, NULL, '2022-06-25 20:32:58', '2022-06-25 20:32:58'),
(190, 0, 'كفر كبير  2*5', 'COVER SLIDE 2X5', '3', '16', NULL, '7329', 60, 0, 0, 0, NULL, 'كفر  لفحص العيات بالميكروسكوب', 'كفر  لفحص العيات بالميكروسكوب', 'علبه', 'box', 100, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '190_image.jpeg', 0, 0, NULL, '2022-06-25 20:37:30', '2022-06-25 20:37:30'),
(191, 0, 'كفر سيلفر صغير', 'COVER SLIDE SELVER', '3', '16', NULL, '7330', 16, 0, 0, 0, NULL, 'كفر  لفحص العيات بالميكروسكوب', 'كفر  لفحص العيات بالميكروسكوب', 'علبه', 'box', 100, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '191_image.jpeg', 0, 0, NULL, '2022-06-25 20:39:27', '2022-06-25 20:39:27'),
(192, 0, 'اكواب ايطالى FL', 'اكواب ايطالى FL', '3', '16', NULL, '7336', 3, 0, 0, 0, NULL, 'اكواب معقمه لاخذ العيات', 'اكواب معقمه لاخذ العيات', 'كيس', 'bag', 500, 1, 10000, 1, 0, 0, 0, 'كوب', 'CUP', '192_image.jpg', 0, 0, NULL, '2022-06-29 17:44:56', '2022-06-29 17:44:56'),
(193, 0, 'اكواب زبادى', 'اكواب زبادى', '3', '16', NULL, '7337', 0.75, 0, 0, 0, NULL, 'اكواب معقمه لاخذ العيات', 'اكواب معقمه لاخذ العيات', 'كيس', 'bag', 500, 1, 10000, 1, 0, 0, 0, 'كوب', 'CUP', '193_image.jpg', 0, 0, NULL, '2022-06-29 17:47:35', '2022-06-29 17:47:35'),
(194, 0, 'كوب معقم  فسفورى', 'كوب معقم  فسفورى', '3', '16', NULL, '7338', 1, 0, 0, 0, NULL, 'اكواب معقمه لاخذ العيات', 'اكواب معقمه لاخذ العيات', 'كيس', 'bag', 700, 1, 10000, 1, 0, 0, 0, 'كوب', 'CUP', '194_image.jpg', 0, 0, NULL, '2022-06-29 17:48:32', '2022-06-29 17:48:32'),
(195, 0, 'كوب معقم 120 مل', 'كوب معقم 120 مل', '3', '16', NULL, '7339', 1, 0, 0, 0, NULL, 'اكواب معقمه لاخذ العيات', 'اكواب معقمه لاخذ العيات', 'كيس', 'bag', 500, 1, 10000, 1, 0, 0, 0, 'كوب', 'CUP', '195_image.jpg', 0, 0, NULL, '2022-06-29 17:49:40', '2022-06-29 17:49:40'),
(196, 0, 'غطاء انابيب', 'غطاء انابيب', '3', '16', NULL, '7347', 50, 0, 0, 0, NULL, 'غطاء وزرمان لحفظ ونقل العيانت', 'غطاء وزرمان لحفظ ونقل العيانت', 'كيس', 'bag', 1000, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '196_image.jpg', 0, 0, NULL, '2022-06-29 17:52:55', '2022-06-29 17:52:55'),
(197, 0, 'مسحه كحوليه', 'ALCOHOL SWAB', '3', '16', NULL, '7350', 9.5, 0, 0, 0, NULL, 'مسحه كحوليه للتعقيم قبل اخذ العيات بالسرنجه', 'مسحه كحوليه للتعقيم قبل اخذ العيات بالسرنجه', 'علبه', 'BOX', 100, 0, 200, 1, 0, 0, 1, 'مسحه', 'مسحه', '197_image.jpg', 0, 0, NULL, '2022-06-29 17:54:45', '2022-06-29 17:54:45'),
(198, 0, 'بلاستر مدور 500 قطعه', 'SHEER SPOTS PLAST 500', '3', '16', NULL, '7351', 38, 0, 0, 0, NULL, 'بلاستر طبى مدور', 'بلاستر طبى مدور', 'علبه', 'BOX', 500, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '198_image.jpeg', 0, 0, NULL, '2022-07-05 15:38:40', '2022-07-05 15:38:40'),
(199, 0, 'بلاستر مدور 100 قطعه', 'SHEER SPOTS PLAST 100', '3', '16', NULL, '7352', 8, 0, 0, 0, NULL, 'بلاستر طبى مدور', 'بلاستر طبى مدور', 'علبه', 'BOX', 100, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '199_image.jpeg', 0, 0, NULL, '2022-07-05 15:41:31', '2022-07-05 15:41:31'),
(200, 0, 'بلاستر طويل 1000 قطعه', 'SHEER SPOTS PLAST 1000', '3', '16', NULL, '7353', 90, 0, 0, 0, NULL, 'بلاستر طبى  طويل', 'بلاستر طبى  طويل', 'علبه', 'bag', 1000, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '200_image.jpeg', 0, 0, NULL, '2022-07-05 15:43:06', '2022-07-05 15:43:06'),
(201, 0, 'بلاستر جروح 10 سم', 'SILK PLAST 10 CM', '3', '16', NULL, '7358', 26, 0, 0, 0, NULL, 'بلاستر للجروج', 'بلاستر للجروج', 'علبه', 'bag', 1, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '201_image.jpeg', 0, 0, NULL, '2022-07-05 15:46:45', '2022-07-05 15:46:45'),
(202, 0, 'بلاستر جروح 5 سم', 'SILK PLAST 5 CM', '3', '16', NULL, '7359', 22, 0, 0, 0, NULL, 'بلاستر للجروج', 'بلاستر للجروج', 'علبه', 'bag', 1, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '202_image.jpeg', 0, 0, NULL, '2022-07-05 15:48:31', '2022-07-05 15:48:31'),
(203, 0, 'بلاستر جروح 2.5 سم', 'SILK PLAST 2.5 CM', '3', '16', NULL, '9360', 15, 0, 0, 0, NULL, 'بلاستر للجروج', 'بلاستر للجروج', 'علبه', 'bag', 1, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '203_image.jpeg', 0, 0, NULL, '2022-07-05 15:50:04', '2022-07-05 15:50:04'),
(204, 0, 'سواب فى انبوبه صينى', 'SWAB  IN TUBES', '3', '16', NULL, '7365', 200, 0, 0, 0, NULL, 'سواب اخذ العينه وحفظها', 'سواب اخذ العينه وحفظها', 'علبه', 'bag', 100, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '204_image.jpeg', 0, 0, NULL, '2022-07-05 15:53:03', '2022-07-05 15:53:03'),
(205, 0, 'سواب فى انبوبه مصرى', 'SWAB  IN TUBES', '3', '16', NULL, '7366', 190, 0, 0, 0, NULL, 'سواب اخذ العينه وحفظها', 'سواب اخذ العينه وحفظها', 'علبه', 'BOX', 100, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '205_image.jpeg', 0, 0, NULL, '2022-07-05 15:54:28', '2022-07-05 15:54:28'),
(206, 0, 'سواب فى علبه', 'SWAB  IN BOX', '3', '16', NULL, '7367', 100, 0, 0, 0, NULL, 'سواب اخذ العينه وحفظها', 'سواب اخذ العينه وحفظها', 'علبه', 'BOX', 100, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '206_image.jpeg', 0, 0, NULL, '2022-07-05 15:57:55', '2022-07-05 15:57:55'),
(207, 0, 'جونتى لاتكس بدون بدره', 'LATEX FREE BWDER', '3', '16', NULL, '7376', 100, 5, 0, 0, NULL, 'جونتى لاتكس مطاطى للتعقيم', 'جونتى لاتكس مطاطى للتعقيم', 'علبه', 'BOX', 100, 1, 1000, 1, 0, 0, 0, 'وحده', 'UNIT', '207_image.jpg', 0, 2, '2022-07-12', '2022-07-05 16:02:15', '2022-07-05 16:02:15'),
(208, 0, 'جونتى نيتريل', 'LATEX NITRILE', '3', '16', NULL, '7378', 100, 0, 0, 0, NULL, 'جونتى لاتكس مطاطى للتعقيم', 'جونتى لاتكس مطاطى للتعقيم', 'علبه', 'BOX', 100, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '208_image.jpg', 0, 0, NULL, '2022-07-05 16:05:13', '2022-07-05 16:05:13'),
(209, 0, 'جوانتى فحص بلاستك', 'PLASTIC INSPECTION  GLOVES', '3', '16', NULL, '7383', 1.5, 0, 0, 0, NULL, 'جونتى بلاستك للتعقيم', 'جونتى بلاستك للتعقيم', 'كيس', 'bag', 34, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '209_image.jpg', 0, 0, NULL, '2022-07-05 16:35:58', '2022-07-05 16:35:58'),
(210, 0, 'جوانتى فحص ثقيل  بلاستك', 'HEAVY  PLASTIC INSPECTION  GLOVES', '3', '16', NULL, '7384', 5, 0, 0, 0, NULL, 'جونتى بلاستك للتعقيم', 'جونتى بلاستك للتعقيم', 'كيس', 'bag', 80, 1, 1000, 1, 0, 0, 0, 'وحده', 'UNIT', '210_image.jpg', 0, 0, NULL, '2022-07-05 16:37:39', '2022-07-05 16:37:39'),
(211, 0, 'قطن', 'COTTON', '3', '16', NULL, '7388', 25, 0, 0, 0, NULL, 'قطن طبى عالى الجوده نص كيلو', 'قطن طبى عالى الجوده نص كيلو', 'كيس', 'bag', 1, 1, 200, 1, 0, 0, 0, 'وحده', 'UNIT', '211_image.jpeg', 0, 0, NULL, '2022-07-05 16:45:09', '2022-07-05 16:45:09'),
(212, 0, 'شاش', 'GAUZE', '3', '16', NULL, '7393', 3, 0, 0, 0, NULL, 'شاش طبى عالى الجوده', 'شاش طبى عالى الجوده', 'كيس', 'bag', 20, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '212_image.jpeg', 0, 0, NULL, '2022-07-05 16:48:49', '2022-07-05 16:48:49'),
(213, 0, 'حافظه قطن', 'COTTON  MEMORY', '3', '16', NULL, '7399', 200, 0, 0, 0, NULL, 'حافظه للقطن', 'حافظه للقطن', 'علبه', 'BOX', 1, 1, 10, 1, 0, 0, 0, 'وحده', 'UNIT', '213_image.jpeg', 0, 0, NULL, '2022-07-05 16:50:51', '2022-07-05 16:50:51'),
(214, 0, 'وزرمان شفاف صينى', 'PLASTIC TUBE  CHINA', '3', '16', NULL, '7403', 95, 0, 0, 0, NULL, 'انابيب لنقل العينات بلاستك', 'انابيب لنقل العينات بلاستك', 'كيس', 'bag', 500, 1, 50, 1, 0, 0, 0, 'وحده', 'UNIT', '214_image.jpeg', 0, 0, NULL, '2022-07-05 16:56:00', '2022-07-05 16:56:00'),
(215, 0, 'انابيب شفافه مدرجه مصرى', 'PLASTIC TUBE  EGYPT', '3', '16', NULL, '7405', 85, 0, 0, 0, NULL, 'انابيب لنقل العينات بلاستك', 'انابيب لنقل العينات بلاستك', 'كيس', 'bag', 500, 1, 10, 1, 0, 0, 0, 'وحده', 'UNIT', '215_image.jpeg', 0, 0, NULL, '2022-07-05 17:31:40', '2022-07-05 17:31:40'),
(216, 0, 'انابيت معتمه بلاستك', 'انابيت معتمه بلاستك', '3', '16', NULL, '7408', 60, 0, 0, 0, NULL, 'انابيب لنقل العينات بلاستك', 'انابيب لنقل العينات بلاستك', 'كيس', 'bag', 500, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '216_image.jpeg', 0, 0, NULL, '2022-07-05 17:33:25', '2022-07-05 17:33:25'),
(217, 0, 'وزرمان شفاف زجاج', 'وزرمان شفاف زجاج', '3', '16', NULL, '7410', 70, 0, 0, 0, NULL, 'انابيب لنقل العينات زجاج', 'انابيب لنقل العينات زجاج', 'علبه', 'BOX', 250, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '217_image.jpg', 0, 0, NULL, '2022-07-05 17:38:13', '2022-07-05 17:38:13'),
(218, 0, 'انابيب سنتر فيوج زجاج 10 سم', 'انابيب سنتر فيوج زجاج 10 سم', '3', '16', NULL, '7411', 1.25, 0, 0, 0, NULL, 'انابيب لنقل العينات زجاج', 'انابيب لنقل العينات زجاج', 'علبه', 'box', 250, 1, 1000, 1, 0, 0, 0, 'وحده', 'UNIT', '218_image.jpeg', 0, 0, NULL, '2022-07-20 15:10:31', '2022-07-20 15:10:31'),
(219, 0, 'انابيب اختبار 15 سم', 'انابيب اختبار 15 سم', '3', '16', NULL, '7412', 1.5, 0, 0, 0, NULL, 'انابيب لنقل العينات زجاج', 'انابيب لنقل العينات زجاج', 'علبه', 'box', 250, 1, 1000, 1, 0, 0, 0, 'وحده', 'UNIT', '219_image.jpeg', 0, 0, NULL, '2022-07-20 15:11:44', '2022-07-20 15:11:44'),
(220, 0, 'انابيب شعريه', 'HEMATOCRIT TUBES', '3', '16', NULL, '7413', 20, 0, 0, 0, NULL, 'انابيب شعريه', 'انابيب شعريه', 'علبه', 'box', 100, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '220_image.jpeg', 0, 0, NULL, '2022-07-20 15:13:02', '2022-07-20 15:13:02'),
(221, 0, 'تورنيكيه صينى', 'تورنيكيه صينى', '3', '16', NULL, '7423', 16, 0, 0, 0, NULL, 'تستخدم لاخذ عينات نقل الدم من المريض', 'تستخدم لاخذ عينات نقل الدم من المريض', 'علبه', 'box', 25, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '221_image.jpeg', 0, 0, NULL, '2022-07-20 15:14:21', '2022-07-20 15:14:21'),
(222, 0, 'تورنيكيه المانى', 'تورنيكيه المانى', '3', '16', NULL, '7424', 110, 0, 0, 0, NULL, 'تستخدم لاخذ عينات نقل الدم من المريض', 'تستخدم لاخذ عينات نقل الدم من المريض', 'كيس', 'bag', 1, 1, 10, 1, 0, 0, 0, 'وحده', 'UNIT', '222_image.jpeg', 0, 0, NULL, '2022-07-20 15:16:23', '2022-07-20 15:16:23'),
(223, 0, 'تورنيكيه استعمال واحد', 'تورنيكيه استعمال واحد', '3', '16', NULL, '7425', 2, 0, 0, 0, NULL, 'تستخدم لاخذ عينات نقل الدم من المريض', 'تستخدم لاخذ عينات نقل الدم من المريض', 'كيس', 'bag', 1, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '223_image.jpeg', 0, 0, NULL, '2022-07-20 15:17:16', '2022-07-20 15:17:16'),
(224, 0, 'شكاكات', 'STRILE LANCETS', '3', '16', NULL, '7431', 20, 0, 0, 0, NULL, 'شكاكات لعمل الاختبارات السريعه', 'شكاكات لعمل الاختبارات السريعه', 'علبه', 'box', 100, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '224_image.jpeg', 0, 0, NULL, '2022-07-20 15:18:24', '2022-07-20 15:18:24'),
(225, 0, 'بترى دش  9 سم عادى', 'PETRI DISHES 9CM', '3', '16', NULL, '7435', 1.5, 0, 0, 0, NULL, 'تستخدم لعمل المزارع', 'تستخدم لعمل المزارع', 'كيس', 'bag', 10, 1, 1000, 1, 0, 0, 0, 'وحده', 'UNIT', '225_image.jpeg', 0, 0, NULL, '2022-07-20 15:40:52', '2022-07-20 15:40:52'),
(226, 0, 'بترى دش  9 سم مقسم', 'PETRI DISHES 9CM  DIVIDED', '3', '16', NULL, '7436', 1.75, 0, 0, 0, NULL, 'تستخدم لعمل المزارع', 'تستخدم لعمل المزارع', 'كيس', 'bag', 10, 1, 1000, 1, 0, 0, 0, 'وحده', 'UNIT', '226_image.jpeg', 0, 0, NULL, '2022-07-20 15:42:09', '2022-07-20 15:42:09'),
(227, 0, 'بترى دش 6 سم', 'PETRI DISHES 6CM', '3', '16', NULL, '7437', 1.25, 0, 0, 0, NULL, 'تستخدم لعمل المزارع', 'تستخدم لعمل المزارع', 'كيس', 'bag', 10, 1, 1000, 1, 0, 0, 0, 'وحده', 'UNIT', '227_image.jpeg', 0, 0, NULL, '2022-07-20 15:43:33', '2022-07-20 15:43:33'),
(228, 0, 'بترى دش زجاج 12 سم', 'PETRI DISHES 12CM  GLASS', '3', '16', NULL, '7449', 15, 0, 0, 0, NULL, 'تستخدم لعمل المزارع', 'تستخدم لعمل المزارع', 'وحده', 'UNIT', 1, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '228_image.jpeg', 0, 0, NULL, '2022-07-20 15:52:29', '2022-07-20 15:52:29'),
(229, 0, 'رولز', 'رولز', '3', '16', NULL, '7453', 100, 0, 0, 0, NULL, 'تستخدم فى اجهزه الكمياء للتحاليل', 'تستخدم فى اجهزه الكمياء للتحاليل', 'علبه', 'box', 100, 1, 50, 1, 0, 0, 0, 'وحده', 'UNIT', '229_image.jpeg', 0, 0, NULL, '2022-07-20 15:53:43', '2022-07-20 15:53:43'),
(230, 0, 'بولز', 'بولز', '3', '16', NULL, '7454', 100, 0, 0, 0, NULL, 'تستخدم فى اجهزه الكمياء للتحاليل', 'تستخدم فى اجهزه الكمياء للتحاليل', 'علبه', 'box', 100, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '230_image.jpeg', 0, 0, NULL, '2022-07-20 15:54:43', '2022-07-20 15:54:43'),
(231, 0, 'كوفيتات  تيكو  1000', 'كوفيتات  تيكو  1000', '3', '16', NULL, '7457', 140, 0, 0, 0, NULL, 'تستخدم فى اجهزه الكمياء للتحاليل', 'تستخدم فى اجهزه الكمياء للتحاليل', 'كيس', 'bag', 1000, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '231_image.jpeg', 0, 0, NULL, '2022-07-20 15:57:27', '2022-07-20 15:57:27'),
(232, 0, 'كوفتات BM', 'كوفتات BM', '3', '16', NULL, '7458', 150, 0, 0, 0, NULL, 'تستخدم فى اجهزه الكمياء للتحاليل', 'تستخدم فى اجهزه الكمياء للتحاليل', 'كيس', 'bag', 500, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '232_image.jpeg', 0, 0, NULL, '2022-07-20 15:58:56', '2022-07-20 15:58:56'),
(233, 0, 'كوفتات هيتاشى', 'CUPS  HITTCH  500', '3', '16', NULL, '7459', 100, 0, 0, 0, NULL, 'تستخدم فى اجهزه الكمياء للتحاليل', 'تستخدم فى اجهزه الكمياء للتحاليل', 'كيس', 'bag', 500, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '233_image.jpeg', 0, 0, NULL, '2022-07-20 16:00:04', '2022-07-20 16:00:04'),
(234, 0, 'كيوفتات بهرنج', 'كيوفتات بهرنج', '3', '16', NULL, '7460', 200, 0, 0, 0, NULL, 'تستخدم فى اجهزه الكمياء للتحاليل', 'تستخدم فى اجهزه الكمياء للتحاليل', 'كيس', 'bag', 1000, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '234_image.jpeg', 0, 0, NULL, '2022-07-20 16:01:02', '2022-07-20 16:01:02'),
(235, 0, 'مضادات حيوية', 'مضادات حيوية', '3', '16', NULL, '7473', 30, 0, 0, 0, NULL, 'تستخدم لعمل مزارع البكتريا والمضدات الحيويه', 'تستخدم لعمل مزارع البكتريا والمضدات الحيويه', 'فايل', 'vile', 50, 1, 100, 1, 0, 0, 0, 'تيست', 'TEST', '235_image.jpeg', 0, 0, NULL, '2022-07-20 16:02:31', '2022-07-20 16:02:31'),
(236, 0, 'تايمر', 'TIMER', '3', '16', NULL, '7480', 80, 0, 0, 0, NULL, 'تستخدم لمعرفه الوقت الدقيق', 'تستخدم لمعرفه الوقت الدقيق', 'علبه', 'box', 1, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '236_image.jpeg', 0, 0, NULL, '2022-07-20 16:03:31', '2022-07-20 16:03:31'),
(237, 0, 'ماسك نيبولايزر اطفال', 'ماسك نيبولايزر اطفال', '3', '16', NULL, '7481', 6, 0, 0, 0, NULL, 'تستخد فى حالات النتفس', 'تستخد فى حالات النتفس', 'كيس', 'bag', 1, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '237_image.jpeg', 0, 0, NULL, '2022-07-20 16:05:05', '2022-07-20 16:05:05'),
(238, 0, 'خافض لسان', 'خافض لسان', '3', '16', NULL, '7482', 15, 0, 0, 0, NULL, 'تستخدم فى الفحص', 'تستخدم فى الفحص', 'علبه', 'box', 100, 1, 100, 1, 0, 0, 0, 'تيست', 'TEST', '238_image.jpeg', 0, 0, NULL, '2022-07-20 16:18:15', '2022-07-20 16:18:15'),
(239, 0, 'ملقاط', 'FORCEPS', '3', '16', NULL, '7483', 40, 0, 0, 0, NULL, 'تستخدم فى الفحص', 'تستخدم فى الفحص', 'وحده', 'UNIT', 1, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '239_image.jpeg', 0, 0, NULL, '2022-07-20 16:20:32', '2022-07-20 16:20:32'),
(240, 0, 'بالطو', 'بالطو', '3', '16', NULL, '7485', 100, 0, 0, 0, NULL, 'بالطو طبيب', 'بالطو طبيب', 'وحده', 'UNIT', 1, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '240_image.jpg', 0, 0, NULL, '2022-07-23 15:58:48', '2022-07-23 15:58:48'),
(241, 0, 'سفتى بوكس بلاستك', 'SAFTY BOX   PLASTIC', '3', '16', NULL, '7489', 10, 0, 0, 0, NULL, 'يستخدم فى نقل النفايات', 'يستخدم فى نقل النفايات', 'علبه', 'box', 1, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '241_image.jpg', 0, 0, NULL, '2022-07-23 16:03:57', '2022-07-23 16:03:57'),
(242, 0, 'سفتى بوكس كرتون', 'SAFTY BOX', '3', '16', NULL, '7490', 8, 0, 0, 0, NULL, 'يستخدم فى نقل النفايات', 'يستخدم فى نقل النفايات', 'وحده', 'UNIT', -2, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '242_image.png', 1, 0, NULL, '2022-07-23 16:05:33', '2022-07-23 16:14:41'),
(243, 0, 'سفتى بوكس كرتون  تقيل', 'SAFTY BOX ثقيل', '3', '16', NULL, '7491', 13, 1, 0, 0, NULL, 'يستخدم فى نقل النفايات', 'يستخدم فى نقل النفايات', 'وحده', 'UNIT', 25, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '243_image.png', 0, 2, '2022-07-30', '2022-07-23 16:17:11', '2022-07-23 16:17:11'),
(244, 0, 'اكياس نفايات', 'اكياس نفايات', '3', '16', NULL, '7494', 47, 2, 0, 0, NULL, 'يستخدم فى نقل النفايات', 'يستخدم فى نقل النفايات', 'كيس', 'bag', 1, 1, 100, 1, 0, 0, 0, 'كيلو', 'KILO', '244_image.jpg', 0, 1, '2022-08-23', '2022-07-23 16:35:15', '2022-07-23 16:41:05'),
(245, 0, 'باستير', 'PASSTER PAPIT', '3', '16', NULL, '7497', 150, 0, 0, 0, NULL, 'يستخدم لسحب العينات', 'يستخدم لسحب العينات', 'كيس', 'bag', 250, 1, 1000, 1, 0, 0, 0, 'وحده', 'UNIT', '245_image.jpg', 0, 0, NULL, '2022-07-23 16:40:35', '2022-07-23 16:40:35'),
(246, 0, 'لوب بلاستيك', 'STERILE  LOOP', '3', '16', NULL, '7501', 500, 0, 0, 0, NULL, 'يستخدم لفحص العينات', 'يستخدم لفحص العينات', 'كيس', 'bag', 500, 1, 1000, 1, 0, 0, 0, 'وحده', 'UNIT', '246_image.jpeg', 0, 0, NULL, '2022-07-23 16:45:48', '2022-07-23 16:45:48'),
(247, 0, 'لوب معدن', 'LRON   LOOP', '3', '16', NULL, '7502', 10, 0, 0, 0, NULL, 'يستخدم لفحص العينات', 'يستخدم لفحص العينات', 'وحده', 'UNIT', 1, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '247_image.jpeg', 0, 0, NULL, '2022-07-23 16:53:16', '2022-07-23 16:53:16'),
(248, 0, 'راك  ESR', 'ESR    RACK', '3', '16', NULL, '7507', 80, 5, 0, 0, NULL, 'يستخدم لترتيب   الانابيب', 'يستخدم لترتيب   الانابيب', 'راك', 'RACK', 1, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '248_image.jpeg', 0, 1, '2022-08-23', '2022-07-23 17:02:44', '2022-07-23 17:02:44'),
(249, 0, 'راك وزرمان', 'TEST TUBE  RACK', '3', '16', NULL, '7508', 55, 5, 0, 0, NULL, 'يستخدم لترتيب   الانابيب', 'يستخدم لترتيب   الانابيب', 'راك', 'RACK', 1, 1, 50, 1, 0, 0, 0, 'وحده', 'UNIT', '249_image.jpeg', 0, 1, '2022-08-23', '2022-07-23 17:06:37', '2022-07-23 17:06:37'),
(250, 0, 'راك بابتات', 'PIPETTE RACK', '3', '16', NULL, '7509', 105, 5, 0, 0, NULL, 'يستخدم لترتيب   الانابيب', 'يستخدم لترتيب   الانابيب', 'راك', 'RACK', 1, 1, 50, 1, 0, 0, 0, 'وحده', 'UNIT', '250_image.jpeg', 0, 1, '2022-08-23', '2022-07-23 17:13:56', '2022-07-23 17:13:56'),
(251, 0, 'راك تبس اصفر', 'TIPS   RAC YELLOW', '3', '16', NULL, '7510', 55, 5, 0, 0, NULL, 'يستخدم لترتيب   الانابيب', 'يستخدم لترتيب   الانابيب', 'راك', 'RACK', 1, 1, 50, 1, 0, 0, 0, 'وحده', 'UNIT', '251_image.jpeg', 0, 1, '2022-08-23', '2022-07-23 17:18:08', '2022-07-23 17:18:08'),
(252, 0, 'راك تبس ازرق', 'TIPS   RACK BLUE', '3', '16', NULL, '7511', 55, 5, 0, 0, NULL, 'يستخدم لترتيب   الانابيب', 'يستخدم لترتيب   الانابيب', 'راك', 'RACK', 1, 1, 50, 1, 0, 0, 0, 'وحده', 'UNIT', '252_image.jpeg', 0, 1, '2022-08-23', '2022-07-23 17:19:23', '2022-07-23 17:19:23'),
(253, 0, 'راك ابندورف', 'EPINDORF    RACK', '3', '16', NULL, '7512', 55, 5, 0, 0, NULL, 'يستخدم لترتيب   الانابيب', 'يستخدم لترتيب   الانابيب', 'راك', 'RACK', 1, 1, 50, 1, 0, 0, 0, 'وحده', 'UNIT', '253_image.jpeg', 0, 1, '2022-08-23', '2022-07-23 17:20:43', '2022-07-23 17:20:43'),
(254, 0, 'بابتة  دراجون متغيره 12 قناه', 'VARIABLE PIPETTE  DRAGON  12', '3', '16', NULL, '7526', 3550, 50, 0, 0, NULL, 'يستخدم لسحب العينات', 'يستخدم لسحب العينات', 'علبه', 'box', 1, 1, 10, 1, 0, 0, 0, 'وحده', 'UNIT', '254_image.jpeg', 0, 1, '2022-08-23', '2022-07-23 17:28:19', '2022-07-23 17:28:19'),
(255, 0, 'بابتة  دراجون متغيره 8 قناه', 'VARIABLE PIPETTE  DRAGON  8', '3', '16', NULL, '7527', 3450, 50, 0, 0, NULL, 'يستخدم لسحب العينات', 'يستخدم لسحب العينات', 'علبه', 'box', 1, 1, 10, 1, 0, 0, 0, 'وحده', 'UNIT', '255_image.jpeg', 0, 1, '2022-08-23', '2022-07-23 17:30:00', '2022-07-23 17:30:00'),
(256, 0, 'بابتة ثابتة دراجون', 'FIXED  PIPETTE  DRAGON', '3', '16', NULL, '7535', 520, 20, 0, 0, NULL, 'يستخدم لسحب العينات', 'يستخدم لسحب العينات', 'علبه', 'box', 1, 1, 20, 1, 0, 0, 0, 'وحده', 'UNIT', '256_image.jpeg', 0, 1, '2022-08-23', '2022-07-23 17:41:47', '2022-07-23 17:41:47'),
(257, 0, 'بابتة متغيرة دراجون', 'VARIABLE PIPETTE   DRAGON', '3', '16', NULL, '7536', 570, 20, 0, 0, NULL, 'يستخدم لسحب العينات', 'يستخدم لسحب العينات', 'علبه', 'box', 1, 1, 50, 1, 0, 0, 0, 'وحده', 'UNIT', '257_image.jpeg', 0, 1, '2022-08-23', '2022-07-23 17:43:08', '2022-07-23 17:43:08'),
(258, 0, 'بابتة ثابتة اكواماكس', 'FIXED  PIPETTE  AQUAMAX', '3', '16', NULL, '7542', 470, 20, 0, 0, NULL, 'يستخدم لسحب العينات', 'يستخدم لسحب العينات', 'علبه', 'box', 1, 1, 50, 1, 0, 0, 0, 'وحده', 'UNIT', '258_image.jpeg', 0, 1, '2022-08-23', '2022-07-23 17:46:03', '2022-07-23 17:46:03'),
(259, 0, 'بابتة متغيرة اكواماكس', 'VARIABLE PIPETTE   AQUAMAX', '3', '16', NULL, '7543', 520, 20, 0, 0, NULL, 'يستخدم لسحب العينات', 'يستخدم لسحب العينات', 'علبه', 'box', 1, 1, 50, 1, 0, 0, 0, 'وحده', 'UNIT', '259_image.jpeg', 0, 1, '2022-08-23', '2022-07-23 17:47:17', '2022-07-23 17:47:17'),
(260, 0, 'بابته توب ثابته', 'FIXED  PIPETTE   TOP', '3', '16', NULL, '7549', 470, 20, 0, 0, NULL, 'يستخدم لسحب العينات', 'يستخدم لسحب العينات', 'علبه', 'box', 1, 1, 50, 1, 0, 0, 0, 'وحده', 'UNIT', '260_image.jpeg', 0, 1, '2022-08-23', '2022-07-23 17:48:33', '2022-07-23 17:48:33'),
(261, 0, 'بابته توب متغيره', 'VARIABLE PIPETTE   TOP	بابته توب متغيره', '3', '16', NULL, '7550', 520, 20, 0, 0, NULL, 'يستخدم لسحب العينات', 'يستخدم لسحب العينات', 'علبه', 'box', 1, 1, 50, 1, 0, 0, 0, 'وحده', 'UNIT', '261_image.jpeg', 0, 1, '2022-08-23', '2022-07-23 17:49:32', '2022-07-23 17:49:32'),
(262, 0, 'ماصه سوائل', 'PIPETTE   LIQUIDS', '3', '16', NULL, '7556', 60, 5, 0, 0, NULL, 'يستخدم لسحب العينات', 'يستخدم لسحب العينات', 'علبه', 'box', 1, 1, 20, 1, 0, 0, 0, 'وحده', 'UNIT', '262_image.jpeg', 0, 1, '2022-08-23', '2022-07-23 17:51:22', '2022-07-23 17:51:22'),
(263, 0, 'عدسه  ميكروسكوب  40', 'MICROSCOPE  EADASUH  40', '3', '16', NULL, '7561', 310, 10, 0, 0, NULL, 'عدسه ميكروسكوب', 'عدسه ميكروسكوب', 'علبه', 'box', 1, 1, 20, 1, 0, 0, 0, 'وحده', 'UNIT', '263_image.jpeg', 0, 1, '2022-08-23', '2022-07-23 17:53:39', '2022-07-23 17:53:39'),
(264, 0, 'لمبة شوكة بسلك', 'MICROSCOPE  LIGHT BULB', '3', '16', NULL, '7562', 105, 5, 0, 0, NULL, 'لمبه ميكروسكوب', 'لمبه ميكروسكوب', 'علبه', 'box', 1, 1, 20, 1, 0, 0, 0, 'وحده', 'UNIT', '264_image.jpeg', 0, 1, '2022-08-23', '2022-07-23 17:55:04', '2022-07-23 17:55:04'),
(265, 0, 'بندكت', 'بندكت', '3', '16', NULL, '7569', 95, 5, 0, 0, NULL, 'تستخدم في تحليل عينات المعمل', 'تستخدم في تحليل عينات المعمل', 'زجاجه', 'BOTTLE', 1, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '265_image.jpeg', 0, 1, '2022-08-23', '2022-07-23 18:00:35', '2022-07-23 18:00:35'),
(266, 0, 'قسطرة حقن مجهرى', 'قسطرة حقن مجهرى', '3', '16', NULL, '7570', 95, 5, 0, 0, NULL, 'يستخدم قسطرة حقن مجهرى', 'يستخدم قسطرة حقن مجهرى', 'كيس', 'bag', 1, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '266_image.jpeg', 0, 1, '2022-08-23', '2022-07-23 18:01:53', '2022-07-23 18:01:53'),
(267, 0, 'ترمومتر قياس الحراره', 'ترمومتر قياس الحراره', '3', '16', NULL, '7573', 80, 5, 0, 0, NULL, 'يستخدم  لقياس نسبه  الحراره', 'يستخدم  لقياس نسبه  الحراره', 'علبه', 'box', 1, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '267_image.jpeg', 0, 1, '2022-08-23', '2022-07-23 18:05:39', '2022-07-23 18:05:39'),
(268, 0, 'ورق حرارى  كبير', 'ورق حرارى  كبير', '3', '16', NULL, '7577', 16, 1, 0, 0, NULL, 'يستخدم لكتابه  التقارير', 'يستخدم لكتابه  التقارير', 'وحده', 'UNIT', 1, 1, 1000, 1, 0, 0, 0, 'وحده', 'UNIT', '268_image.jpeg', 0, 1, '2022-08-23', '2022-07-23 18:07:21', '2022-07-23 18:07:21'),
(269, 0, 'ورق حرارى  صغير', 'ورق حرارى  صغير', '3', '16', NULL, '7578', 11, 1, 0, 0, NULL, 'يستخدم لكتابه  التقارير', 'يستخدم لكتابه  التقارير', 'وحده', 'UNIT', 1, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '269_image.jpeg', 0, 1, '2022-08-23', '2022-07-23 18:08:20', '2022-07-23 18:08:20'),
(270, 0, 'بكر لصق باركود', 'بكر لصق باركود', '3', '16', NULL, '7581', 26, 1, 0, 0, NULL, 'يستخدم لكتابه  التقارير', 'يستخدم لكتابه  التقارير', 'وحده', 'UNIT', 1, 1, 100, 1, 0, 0, 0, 'وحده', 'UNIT', '270_image.jpeg', 0, 1, '2022-08-23', '2022-07-23 18:10:22', '2022-07-23 18:10:22'),
(271, 0, 'نيوترنت اجار  سالكس', 'N.Agar      SALEX', '6', '17', NULL, '7900', 100, 5, 0, 0, NULL, 'اجار مغذى  للاستخدام الشائع فى المزارع واختبارات الحساسيه', 'اجار مغذى  للاستخدام الشائع فى المزارع واختبارات الحساسيه', 'علبه', 'box', 4, 1, 20, 1, 0, 0, 0, 'فايل', 'vile', '271_image.jpeg', 0, 1, '2022-08-23', '2022-07-23 18:40:41', '2022-08-04 01:22:38'),
(272, 0, 'ماكونكى اجار سالكس', 'Mac.agar  SALEX', '6', '17', NULL, '7901', 100, 5, 0, 0, NULL, 'ماكونكى اجلر للاستخدام فى التشخيص الدقيق لبعض انواع المزارع', 'ماكونكى اجلر للاستخدام فى التشخيص الدقيق لبعض انواع المزارع', 'علبه', 'box', 4, 1, 50, 1, 0, 0, 0, 'فايل', 'vile', '272_image.jpeg', 0, 1, '2022-08-23', '2022-07-24 00:28:31', '2022-07-24 00:28:31'),
(273, 0, 'جرام استين  سالكس', 'Gram STAIN SALEX', '6', '17', NULL, '7902', 100, 5, 0, 0, NULL, 'للاستخدام  البيكتريولوجى', 'للاستخدام  البيكتريولوجى', 'علبه', 'box', 4, 1, 50, 1, 0, 0, 0, 'فايل', 'vile', '273_image.jpeg', 0, 1, '2022-08-23', '2022-07-24 00:30:25', '2022-07-24 00:30:25'),
(274, 0, 'زيل نيلسن    سالكس', 'Ziehl-Neelsen stain  SALEX', '6', '17', NULL, '7903', 100, 5, 0, 0, NULL, 'لتشخيص الدرن ( السل) ومرض الجزام', 'لتشخيص الدرن ( السل) ومرض الجزام', 'علبه', 'box', 4, 1, 50, 1, 0, 0, 0, 'فايل', 'vile', '274_image.jpeg', 0, 1, '2022-08-23', '2022-07-24 00:31:36', '2022-07-24 00:31:36'),
(275, 0, 'صابروه   اجار  سالكس', 'SABARO  MEDIA  SALEX', '6', '17', NULL, '7904', 100, 5, 0, 0, NULL, 'يستخدم لزراعه الفطريات', 'يستخدم لزراعه الفطريات', 'علبه', 'box', 4, 1, 50, 1, 0, 0, 0, 'فايل', 'vile', '275_image.jpeg', 0, 1, '2022-08-23', '2022-07-24 00:32:47', '2022-07-24 00:32:47'),
(276, 0, 'شبكيه      سالكس', 'BRILLIANT CRESYL BLUE  SALEX', '6', '17', NULL, '7905', 160, 5, 0, 0, NULL, 'صبغه لعد الخلايا الشبكيه   وامراض الدم', 'صبغه لعد الخلايا الشبكيه   وامراض الدم', 'علبه', 'box', 2, 1, 50, 1, 0, 0, 0, 'فايل', 'vile', '276_image.jpeg', 0, 1, '2022-08-23', '2022-07-24 00:33:48', '2022-07-24 00:33:48'),
(277, 0, 'كيليد   اجار   سالكس', 'CLED   AGAR  SALEX', '6', '17', NULL, '7906', 100, 5, 0, 0, NULL, 'يستخدم فى عمل مزارع البول', 'يستخدم فى عمل مزارع البول', 'علبه', 'box', 4, 1, 50, 1, 0, 0, 0, 'فايل', 'vile', '277_image.jpeg', 0, 1, '2022-08-24', '2022-07-24 14:35:23', '2022-07-24 14:35:23'),
(278, 0, 'Bilirubin  T&D  2*150', 'Bilirubin  T&D  2*150', '1', '2', NULL, '6014', 405, 0, 0, 0, NULL, 'Bilirubin  T&D  2*150', 'Bilirubin  T&D  2*150', 'علبه', 'box', 2, 1, 20, 1, 0, 0, 0, 'فايل', 'vile', '278_image.jpg', 0, 0, NULL, '2022-08-04 15:46:30', '2022-08-04 15:46:30');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `img` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `img`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 'product-629374d3cb458.jpg', 1, NULL, NULL),
(2, 'product-629374d3cbe1c.jpg', 1, NULL, NULL),
(3, 'product-6293766ca2965.jpg', 2, NULL, NULL),
(4, 'product-6293766ca320f.jpg', 2, NULL, NULL),
(5, 'product-6293771901bc0.jpeg', 3, NULL, NULL),
(6, 'product-62937719024e6.jpg', 3, NULL, NULL),
(7, 'product-629377db6f0ae.jpg', 4, NULL, NULL),
(8, 'product-629377db6f73b.jpg', 4, NULL, NULL),
(9, 'product-629377db70994.jpg', 4, NULL, NULL),
(10, 'product-62937917cdb8d.jpg', 5, NULL, NULL),
(11, 'product-62937917ce378.jpg', 5, NULL, NULL),
(12, 'product-62a796255a4a4.jpeg', 14, NULL, NULL),
(13, 'product-62b362d321346.jpeg', 153, NULL, NULL),
(16, 'product-62b6d6cd85f24.jpeg', 1, '2022-06-25 15:35:09', '2022-06-25 15:35:09'),
(17, 'product-62b71468cac51.jpeg', 183, NULL, NULL),
(18, 'product-62b71468cb49c.jpeg', 183, NULL, NULL),
(19, 'product-62b71c2c22a96.jpeg', 188, NULL, NULL),
(20, 'product-62b71c2c235d0.jpeg', 188, NULL, NULL),
(21, 'product-62b71c9ab74ed.jpeg', 189, NULL, NULL),
(22, 'product-62b71c9ab7ac3.jpeg', 189, NULL, NULL),
(23, 'product-62c40c2744dff.jpg', 207, NULL, NULL),
(24, 'product-62c41711152e2.jpeg', 212, NULL, NULL),
(25, 'product-62c4171115f12.jpeg', 212, NULL, NULL),
(26, 'product-62c418c068ad3.jpeg', 214, NULL, NULL),
(27, 'product-62c418c0690e4.jpeg', 214, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_store`
--

CREATE TABLE `product_store` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_store`
--

INSERT INTO `product_store` (`id`, `created_at`, `updated_at`, `store_id`, `product_id`) VALUES
(6, NULL, NULL, 1, 6),
(7, NULL, NULL, 1, 7),
(8, NULL, NULL, 1, 1),
(9, NULL, NULL, 1, 2),
(10, NULL, NULL, 1, 3),
(11, NULL, NULL, 1, 4),
(12, NULL, NULL, 1, 5),
(13, NULL, NULL, 1, 8),
(14, NULL, NULL, 1, 9),
(15, NULL, NULL, 1, 10),
(16, NULL, NULL, 1, 11),
(17, NULL, NULL, 1, 12),
(18, NULL, NULL, 1, 13),
(19, NULL, NULL, 1, 14),
(20, NULL, NULL, 1, 15),
(21, NULL, NULL, 1, 16),
(22, NULL, NULL, 1, 17),
(23, NULL, NULL, 1, 18),
(24, NULL, NULL, 1, 19),
(25, NULL, NULL, 1, 20),
(26, NULL, NULL, 1, 21),
(27, NULL, NULL, 1, 22),
(28, NULL, NULL, 1, 23),
(29, NULL, NULL, 1, 24),
(30, NULL, NULL, 1, 25),
(31, NULL, NULL, 1, 26),
(32, NULL, NULL, 1, 27),
(33, NULL, NULL, 1, 28),
(34, NULL, NULL, 1, 29),
(35, NULL, NULL, 1, 30),
(36, NULL, NULL, 1, 31),
(37, NULL, NULL, 1, 32),
(38, NULL, NULL, 1, 33),
(39, NULL, NULL, 1, 34),
(40, NULL, NULL, 1, 35),
(41, NULL, NULL, 1, 36),
(42, NULL, NULL, 1, 37),
(43, NULL, NULL, 1, 38),
(44, NULL, NULL, 1, 39),
(45, NULL, NULL, 1, 40),
(46, NULL, NULL, 1, 41),
(47, NULL, NULL, 1, 42),
(48, NULL, NULL, 1, 43),
(49, NULL, NULL, 1, 44),
(50, NULL, NULL, 1, 45),
(51, NULL, NULL, 1, 46),
(52, NULL, NULL, 1, 47),
(53, NULL, NULL, 1, 48),
(54, NULL, NULL, 1, 49),
(55, NULL, NULL, 1, 50),
(56, NULL, NULL, 1, 51),
(57, NULL, NULL, 1, 52),
(58, NULL, NULL, 1, 53),
(59, NULL, NULL, 1, 54),
(60, NULL, NULL, 1, 55),
(61, NULL, NULL, 1, 56),
(62, NULL, NULL, 1, 57),
(63, NULL, NULL, 1, 58),
(64, NULL, NULL, 1, 59),
(65, NULL, NULL, 1, 60),
(66, NULL, NULL, 1, 61),
(67, NULL, NULL, 1, 62),
(68, NULL, NULL, 1, 63),
(69, NULL, NULL, 1, 64),
(70, NULL, NULL, 1, 65),
(71, NULL, NULL, 1, 66),
(72, NULL, NULL, 1, 67),
(73, NULL, NULL, 1, 68),
(74, NULL, NULL, 1, 69),
(75, NULL, NULL, 1, 70),
(76, NULL, NULL, 1, 71),
(77, NULL, NULL, 1, 72),
(78, NULL, NULL, 1, 73),
(79, NULL, NULL, 1, 74),
(80, NULL, NULL, 1, 75),
(81, NULL, NULL, 1, 76),
(82, NULL, NULL, 1, 77),
(83, NULL, NULL, 1, 78),
(84, NULL, NULL, 1, 79),
(85, NULL, NULL, 1, 80),
(86, NULL, NULL, 1, 81),
(87, NULL, NULL, 1, 82),
(88, NULL, NULL, 1, 83),
(89, NULL, NULL, 1, 84),
(90, NULL, NULL, 1, 85),
(91, NULL, NULL, 1, 86),
(92, NULL, NULL, 1, 87),
(93, NULL, NULL, 1, 88),
(94, NULL, NULL, 1, 89),
(95, NULL, NULL, 1, 90),
(96, NULL, NULL, 1, 91),
(97, NULL, NULL, 1, 92),
(98, NULL, NULL, 1, 93),
(99, NULL, NULL, 1, 94),
(100, NULL, NULL, 1, 95),
(101, NULL, NULL, 1, 96),
(102, NULL, NULL, 1, 97),
(103, NULL, NULL, 1, 98),
(104, NULL, NULL, 1, 99),
(105, NULL, NULL, 1, 100),
(106, NULL, NULL, 1, 101),
(107, NULL, NULL, 1, 102),
(108, NULL, NULL, 1, 103),
(109, NULL, NULL, 1, 104),
(110, NULL, NULL, 1, 105),
(111, NULL, NULL, 1, 106),
(112, NULL, NULL, 1, 107),
(113, NULL, NULL, 1, 108),
(114, NULL, NULL, 1, 109),
(115, NULL, NULL, 1, 110),
(116, NULL, NULL, 1, 111),
(117, NULL, NULL, 1, 112),
(118, NULL, NULL, 1, 113),
(119, NULL, NULL, 1, 114),
(120, NULL, NULL, 1, 115),
(121, NULL, NULL, 1, 116),
(122, NULL, NULL, 1, 117),
(123, NULL, NULL, 1, 118),
(124, NULL, NULL, 1, 119),
(125, NULL, NULL, 1, 120),
(126, NULL, NULL, 1, 121),
(127, NULL, NULL, 1, 122),
(128, NULL, NULL, 1, 123),
(129, NULL, NULL, 1, 124),
(130, NULL, NULL, 1, 125),
(131, NULL, NULL, 1, 126),
(132, NULL, NULL, 1, 127),
(133, NULL, NULL, 1, 128),
(134, NULL, NULL, 1, 129),
(135, NULL, NULL, 1, 130),
(136, NULL, NULL, 1, 131),
(137, NULL, NULL, 1, 132),
(138, NULL, NULL, 1, 133),
(139, NULL, NULL, 1, 134),
(140, NULL, NULL, 1, 135),
(141, NULL, NULL, 1, 136),
(142, NULL, NULL, 1, 137),
(143, NULL, NULL, 1, 138),
(144, NULL, NULL, 1, 139),
(145, NULL, NULL, 1, 140),
(146, NULL, NULL, 1, 141),
(147, NULL, NULL, 1, 142),
(148, NULL, NULL, 1, 143),
(149, NULL, NULL, 1, 144),
(150, NULL, NULL, 1, 145),
(151, NULL, NULL, 1, 146),
(152, NULL, NULL, 1, 147),
(153, NULL, NULL, 1, 148),
(154, NULL, NULL, 1, 149),
(155, NULL, NULL, 1, 150),
(156, NULL, NULL, 1, 151),
(157, NULL, NULL, 1, 152),
(158, NULL, NULL, 1, 153),
(159, NULL, NULL, 1, 154),
(160, NULL, NULL, 1, 155),
(161, NULL, NULL, 1, 156),
(162, NULL, NULL, 1, 157),
(163, NULL, NULL, 1, 158),
(164, NULL, NULL, 1, 159),
(165, NULL, NULL, 1, 160),
(166, NULL, NULL, 1, 161),
(167, NULL, NULL, 1, 162),
(168, NULL, NULL, 1, 163),
(169, NULL, NULL, 1, 164),
(170, NULL, NULL, 1, 165),
(171, NULL, NULL, 1, 166),
(172, NULL, NULL, 1, 167),
(173, NULL, NULL, 1, 168),
(174, NULL, NULL, 1, 169),
(175, NULL, NULL, 1, 170),
(176, NULL, NULL, 1, 171),
(177, NULL, NULL, 1, 172),
(178, NULL, NULL, 1, 173),
(179, NULL, NULL, 1, 174),
(180, NULL, NULL, 1, 175),
(181, NULL, NULL, 1, 176),
(182, NULL, NULL, 1, 177),
(183, NULL, NULL, 1, 178),
(184, NULL, NULL, 1, 179),
(185, NULL, NULL, 1, 180),
(186, NULL, NULL, 1, 181),
(187, NULL, NULL, 1, 182),
(188, NULL, NULL, 1, 183),
(189, NULL, NULL, 1, 184),
(190, NULL, NULL, 1, 185),
(191, NULL, NULL, 1, 186),
(192, NULL, NULL, 1, 187),
(193, NULL, NULL, 1, 188),
(194, NULL, NULL, 1, 189),
(195, NULL, NULL, 1, 190),
(196, NULL, NULL, 1, 191),
(197, NULL, NULL, 1, 192),
(198, NULL, NULL, 1, 193),
(199, NULL, NULL, 1, 194),
(200, NULL, NULL, 1, 195),
(201, NULL, NULL, 1, 196),
(202, NULL, NULL, 1, 197),
(203, NULL, NULL, 1, 198),
(204, NULL, NULL, 1, 199),
(205, NULL, NULL, 1, 200),
(206, NULL, NULL, 1, 201),
(207, NULL, NULL, 1, 202),
(208, NULL, NULL, 1, 203),
(209, NULL, NULL, 1, 204),
(210, NULL, NULL, 1, 205),
(211, NULL, NULL, 1, 206),
(212, NULL, NULL, 1, 207),
(213, NULL, NULL, 1, 208),
(214, NULL, NULL, 1, 209),
(215, NULL, NULL, 1, 210),
(216, NULL, NULL, 1, 211),
(217, NULL, NULL, 1, 212),
(218, NULL, NULL, 1, 213),
(219, NULL, NULL, 1, 214),
(220, NULL, NULL, 1, 215),
(221, NULL, NULL, 1, 216),
(222, NULL, NULL, 1, 217),
(223, NULL, NULL, 1, 218),
(224, NULL, NULL, 1, 219),
(225, NULL, NULL, 1, 220),
(226, NULL, NULL, 1, 221),
(227, NULL, NULL, 1, 222),
(228, NULL, NULL, 1, 223),
(229, NULL, NULL, 1, 224),
(230, NULL, NULL, 1, 225),
(231, NULL, NULL, 1, 226),
(232, NULL, NULL, 1, 227),
(233, NULL, NULL, 1, 228),
(234, NULL, NULL, 1, 229),
(235, NULL, NULL, 1, 230),
(236, NULL, NULL, 1, 231),
(237, NULL, NULL, 1, 232),
(238, NULL, NULL, 1, 233),
(239, NULL, NULL, 1, 234),
(240, NULL, NULL, 1, 235),
(241, NULL, NULL, 1, 236),
(242, NULL, NULL, 1, 237),
(243, NULL, NULL, 1, 238),
(244, NULL, NULL, 1, 239),
(245, NULL, NULL, 1, 240),
(246, NULL, NULL, 1, 241),
(247, NULL, NULL, 1, 242),
(248, NULL, NULL, 1, 243),
(249, NULL, NULL, 1, 244),
(250, NULL, NULL, 1, 245),
(251, NULL, NULL, 1, 246),
(252, NULL, NULL, 1, 247),
(253, NULL, NULL, 1, 248),
(254, NULL, NULL, 1, 249),
(255, NULL, NULL, 1, 250),
(256, NULL, NULL, 1, 251),
(257, NULL, NULL, 1, 252),
(258, NULL, NULL, 1, 253),
(259, NULL, NULL, 1, 254),
(260, NULL, NULL, 1, 255),
(261, NULL, NULL, 1, 256),
(262, NULL, NULL, 1, 257),
(263, NULL, NULL, 1, 258),
(264, NULL, NULL, 1, 259),
(265, NULL, NULL, 1, 260),
(266, NULL, NULL, 1, 261),
(267, NULL, NULL, 1, 262),
(268, NULL, NULL, 1, 263),
(269, NULL, NULL, 1, 264),
(270, NULL, NULL, 1, 265),
(271, NULL, NULL, 1, 266),
(272, NULL, NULL, 1, 267),
(273, NULL, NULL, 1, 268),
(274, NULL, NULL, 1, 269),
(275, NULL, NULL, 1, 270),
(276, NULL, NULL, 1, 271),
(277, NULL, NULL, 1, 272),
(278, NULL, NULL, 1, 273),
(279, NULL, NULL, 1, 274),
(280, NULL, NULL, 1, 275),
(281, NULL, NULL, 1, 276);

-- --------------------------------------------------------

--
-- Table structure for table `product_user`
--

CREATE TABLE `product_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_user`
--

INSERT INTO `product_user` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, NULL),
(2, 1, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `promo_code`
--

CREATE TABLE `promo_code` (
  `id` int(11) NOT NULL,
  `title` varchar(191) NOT NULL,
  `title_en` varchar(191) DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  `discount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `discount_percent` decimal(8,2) NOT NULL DEFAULT 0.00,
  `end_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `promo_code`
--

INSERT INTO `promo_code` (`id`, `title`, `title_en`, `order_id`, `discount`, `discount_percent`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 'عيد', '3eed', 5, '10.92', '1.00', '2022-06-30', '2022-06-08 16:52:41', '2022-06-08 16:52:41'),
(2, 'عيد', '3eed', 8, '12.00', '1.00', '2022-06-30', '2022-06-09 01:38:51', '2022-06-09 01:38:51');

-- --------------------------------------------------------

--
-- Table structure for table `receipt_statuses`
--

CREATE TABLE `receipt_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `receipt_statuses`
--

INSERT INTO `receipt_statuses` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ممتازه', '2021-03-08 13:10:27', '2022-05-09 19:11:40'),
(3, 'جيدة جدا', '2021-03-10 08:30:07', '2021-03-10 08:30:07'),
(4, 'جيدة', '2021-03-10 08:30:15', '2021-03-10 08:30:15'),
(5, 'رديئة', '2021-03-10 08:30:23', '2021-03-10 08:30:23'),
(6, 'رديئة جدا جدا', '2021-04-04 21:46:19', '2022-03-23 20:16:07'),
(7, 'متوسطه', '2022-03-08 20:21:42', '2022-03-08 20:21:42'),
(8, 'رديئة جدا', '2022-03-23 20:16:26', '2022-03-23 20:16:26'),
(9, 'سيئه', '2022-05-09 19:12:05', '2022-05-09 19:12:05'),
(10, 'الطلب اتاخر', '2022-05-09 19:14:17', '2022-05-09 19:14:17');

-- --------------------------------------------------------

--
-- Table structure for table `return_reasons`
--

CREATE TABLE `return_reasons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `return_reasons`
--

INSERT INTO `return_reasons` (`id`, `status`, `created_at`, `updated_at`) VALUES
(2, 'تالفة', '2021-03-10 10:53:52', '2021-03-10 10:53:52'),
(3, 'منتهية الصلاحية', '2021-03-10 10:54:07', '2021-03-10 10:54:07'),
(4, 'مكسورة', '2021-03-10 10:54:17', '2021-03-10 10:54:17'),
(5, 'تالفة | منتهية الصلاحية', '2021-03-10 10:54:33', '2021-03-10 10:54:33'),
(6, 'تالفة | مكسورة', '2021-03-10 10:54:46', '2021-03-10 10:54:46'),
(7, 'منتهية الصلاحية | مكسورة', '2021-03-10 10:55:14', '2021-03-10 10:55:14'),
(8, 'تالفة | منتهية الصلاحية | مكسورة', '2021-03-10 10:55:35', '2021-03-10 10:55:35'),
(9, 'لا يوجد نقديه', '2021-04-04 21:46:41', '2022-03-23 20:17:53'),
(10, 'مش نفس الاوردر', '2022-03-08 20:22:45', '2022-03-08 20:22:45'),
(11, 'الطلب اتاخر', '2022-03-23 20:18:58', '2022-03-23 20:18:58'),
(12, 'منتهي الصلاحيه', '2022-05-09 19:14:54', '2022-05-09 19:14:54');

-- --------------------------------------------------------

--
-- Table structure for table `revenues`
--

CREATE TABLE `revenues` (
  `id` bigint(20) NOT NULL,
  `foreign_id` bigint(20) NOT NULL,
  `price` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'super_administrator', 'Super Administrator', 'Super Administrator', '2021-03-08 16:17:04', '2021-03-08 16:17:04'),
(2, 'supervisor', 'Supervisor', 'Supervisor', '2021-03-08 16:17:05', '2021-03-08 16:17:05'),
(3, 'store_keeper', 'Store Keeper', 'Store Keeper', '2021-03-08 16:17:06', '2021-03-08 16:17:06'),
(5, 'accountant', 'Accountant', 'Accountant', '2021-03-08 16:17:07', '2021-03-08 16:17:07'),
(6, 'user', 'User', 'User', '2021-03-08 16:17:08', '2021-03-08 16:17:08');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`) VALUES
(1, 1, 'App\\User'),
(2, 2, 'App\\User'),
(3, 3, 'App\\User'),
(4, 4, 'App\\User'),
(5, 5, 'App\\User'),
(6, 6, 'App\\User'),
(6, 1115300802, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 1211127014, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 1007904700, 'App\\User'),
(6, 1013331707, 'App\\User'),
(6, 1029242314, 'App\\User'),
(6, 1155069459, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 449864, 'App\\User'),
(6, 0, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 1029242314, 'App\\User'),
(6, 1149468240, 'App\\User'),
(6, 1120007042, 'App\\User'),
(6, 1029797285, 'App\\User'),
(6, 1127370943, 'App\\User'),
(6, 1126043650, 'App\\User'),
(6, 1013331707, 'App\\User'),
(6, 1144949749, 'App\\User'),
(6, 1118391790, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 1148920246, 'App\\User'),
(6, 1274299257, 'App\\User'),
(6, 1029242314, 'App\\User'),
(6, 1029242314, 'App\\User'),
(6, 1118474766, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 1013331707, 'App\\User'),
(6, 1282333898, 'App\\User'),
(6, 1229298500, 'App\\User'),
(6, 1001351761, 'App\\User'),
(6, 1223526165, 'App\\User'),
(6, 2147483647, 'App\\User'),
(6, 123456789, 'App\\User'),
(6, 1223318334, 'App\\User'),
(6, 1201708807, 'App\\User'),
(6, 1100074101, 'App\\User'),
(6, 1158054332, 'App\\User'),
(6, 1117217719, 'App\\User'),
(6, 1026253348, 'App\\User'),
(6, 1002720774, 'App\\User'),
(6, 1289208999, 'App\\User'),
(6, 1002947447, 'App\\User'),
(6, 1208440287, 'App\\User'),
(6, 1110097715, 'App\\User'),
(6, 1148001126, 'App\\User'),
(6, 1025282477, 'App\\User'),
(6, 1155069459, 'App\\User'),
(6, 1025178546, 'App\\User'),
(6, 1012784783, 'App\\User'),
(6, 1113115312, 'App\\User'),
(6, 1006845961, 'App\\User'),
(6, 1112414604, 'App\\User'),
(6, 1004449599, 'App\\User'),
(6, 1029001011, 'App\\User'),
(6, 1113168892, 'App\\User'),
(6, 1091778126, 'App\\User'),
(6, 1023197441, 'App\\User'),
(6, 1009250963, 'App\\User'),
(6, 1022010080, 'App\\User'),
(6, 1010210147, 'App\\User'),
(6, 1221359098, 'App\\User'),
(6, 1273223011, 'App\\User'),
(6, 1282925557, 'App\\User'),
(6, 1003936986, 'App\\User'),
(6, 1128010881, 'App\\User'),
(6, 1092438929, 'App\\User'),
(6, 1273001170, 'App\\User'),
(6, 1150413302, 'App\\User'),
(6, 1011441988, 'App\\User'),
(6, 1096400007, 'App\\User'),
(6, 1228469420, 'App\\User'),
(6, 1158000365, 'App\\User'),
(6, 1110844994, 'App\\User'),
(6, 1222685852, 'App\\User'),
(6, 1143659418, 'App\\User'),
(6, 1123035937, 'App\\User'),
(6, 1116343120, 'App\\User'),
(6, 1283256661, 'App\\User'),
(6, 1113092658, 'App\\User'),
(6, 1067447275, 'App\\User'),
(6, 1229281256, 'App\\User'),
(6, 1270692023, 'App\\User'),
(6, 1006868560, 'App\\User'),
(6, 1001241138, 'App\\User'),
(6, 1093864095, 'App\\User'),
(6, 1005119620, 'App\\User'),
(6, 1142996576, 'App\\User'),
(6, 1018165485, 'App\\User'),
(6, 1116770671, 'App\\User'),
(6, 1287997617, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 1050004672, 'App\\User'),
(6, 1006903125, 'App\\User'),
(6, 1206960725, 'App\\User'),
(6, 1141511101, 'App\\User'),
(6, 1126133188, 'App\\User'),
(6, 1013331708, 'App\\User'),
(6, 1022554848, 'App\\User'),
(6, 1145628542, 'App\\User'),
(6, 1013331707, 'App\\User'),
(6, 1007961488, 'App\\User'),
(6, 1225144094, 'App\\User'),
(6, 1002776677, 'App\\User'),
(6, 1024938445, 'App\\User'),
(6, 1003059914, 'App\\User'),
(6, 1157008839, 'App\\User'),
(6, 1018454658, 'App\\User'),
(6, 1015103116, 'App\\User'),
(6, 1223014720, 'App\\User'),
(6, 1212499757, 'App\\User'),
(6, 1147964310, 'App\\User'),
(6, 1020638340, 'App\\User'),
(6, 1123636808, 'App\\User'),
(6, 1116810436, 'App\\User'),
(6, 1016922005, 'App\\User'),
(6, 1029242314, 'App\\User'),
(6, 1001288489, 'App\\User'),
(6, 1114484504, 'App\\User'),
(6, 1140598086, 'App\\User'),
(6, 1222499111, 'App\\User'),
(6, 1116948647, 'App\\User'),
(6, 1003669388, 'App\\User'),
(6, 1061295189, 'App\\User'),
(6, 1068842290, 'App\\User'),
(6, 1116609770, 'App\\User'),
(6, 1099534127, 'App\\User'),
(6, 1128110740, 'App\\User'),
(6, 1155792512, 'App\\User'),
(6, 1010301144, 'App\\User'),
(6, 1110097715, 'App\\User'),
(6, 1285861010, 'App\\User'),
(6, 1015630832, 'App\\User'),
(6, 1008446598, 'App\\User'),
(6, 1017420722, 'App\\User'),
(6, 1006401046, 'App\\User'),
(6, 1270692023, 'App\\User'),
(6, 1003067234, 'App\\User'),
(6, 1273223011, 'App\\User'),
(6, 1150413302, 'App\\User'),
(6, 1116599558, 'App\\User'),
(6, 1142660010, 'App\\User'),
(6, 1096694415, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 1140868549, 'App\\User'),
(6, 1099162857, 'App\\User'),
(6, 1033886181, 'App\\User'),
(6, 1202122490, 'App\\User'),
(0, 1278189308, 'App\\User'),
(7, 1278189308, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 1148920246, 'App\\User'),
(6, 1096150877, 'App\\User'),
(6, 1069721694, 'App\\User'),
(6, 1030011780, 'App\\User'),
(6, 1009803482, 'App\\User'),
(6, 1211089242, 'App\\User'),
(6, 1111948462, 'App\\User'),
(6, 1273925930, 'App\\User'),
(6, 1061193111, 'App\\User'),
(6, 1029242314, 'App\\User'),
(6, 1270642407, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 1029242314, 'App\\User'),
(6, 1144949749, 'App\\User'),
(6, 1128000695, 'App\\User'),
(6, 1011053866, 'App\\User'),
(6, 1026885754, 'App\\User'),
(6, 1124633750, 'App\\User'),
(6, 1066905329, 'App\\User'),
(6, 1125483660, 'App\\User'),
(6, 1111158734, 'App\\User'),
(6, 1146827000, 'App\\User'),
(6, 1273007114, 'App\\User'),
(6, 1220373483, 'App\\User'),
(6, 1002345179, 'App\\User'),
(6, 1124232003, 'App\\User'),
(6, 1010168608, 'App\\User'),
(6, 1273001170, 'App\\User'),
(6, 1111505817, 'App\\User'),
(6, 1156808648, 'App\\User'),
(6, 1123891291, 'App\\User'),
(6, 1202365793, 'App\\User'),
(6, 1065228065, 'App\\User'),
(6, 1013331707, 'App\\User'),
(6, 1111172997, 'App\\User'),
(6, 1211130264, 'App\\User'),
(6, 1004848860, 'App\\User'),
(6, 1112022575, 'App\\User'),
(6, 1123038202, 'App\\User'),
(6, 1146073632, 'App\\User'),
(6, 1159399992, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 1030999308, 'App\\User'),
(6, 1158724236, 'App\\User'),
(6, 1117217719, 'App\\User'),
(6, 1029283919, 'App\\User'),
(6, 1128200928, 'App\\User'),
(6, 1000366167, 'App\\User'),
(6, 1001351761, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 1146073632, 'App\\User'),
(6, 1013331707, 'App\\User'),
(6, 1110203795, 'App\\User'),
(6, 1112282073, 'App\\User'),
(6, 1065065081, 'App\\User'),
(6, 1062706389, 'App\\User'),
(6, 1156291374, 'App\\User'),
(6, 1093909366, 'App\\User'),
(6, 1062894944, 'App\\User'),
(6, 1012129351, 'App\\User'),
(6, 1094801815, 'App\\User'),
(6, 1026253348, 'App\\User'),
(6, 1150057611, 'App\\User'),
(6, 1003936986, 'App\\User'),
(6, 1270332171, 'App\\User'),
(6, 1025282477, 'App\\User'),
(6, 1112621634, 'App\\User'),
(6, 1090218846, 'App\\User'),
(6, 1200014627, 'App\\User'),
(6, 1011611323, 'App\\User'),
(6, 1113115312, 'App\\User'),
(6, 1112414604, 'App\\User'),
(6, 1127181892, 'App\\User'),
(6, 1201708807, 'App\\User'),
(6, 1284827472, 'App\\User'),
(6, 1159493433, 'App\\User'),
(6, 1020034330, 'App\\User'),
(6, 1090924298, 'App\\User'),
(6, 1015505036, 'App\\User'),
(6, 1158730288, 'App\\User'),
(6, 1099275856, 'App\\User'),
(6, 1140525199, 'App\\User'),
(6, 1065614626, 'App\\User'),
(6, 1226380814, 'App\\User'),
(6, 1117870485, 'App\\User'),
(6, 1066989662, 'App\\User'),
(6, 1004656960, 'App\\User'),
(6, 1281467666, 'App\\User'),
(6, 1224208619, 'App\\User'),
(6, 1102157622, 'App\\User'),
(6, 1119906417, 'App\\User'),
(6, 1099736674, 'App\\User'),
(6, 1120836686, 'App\\User'),
(6, 1062703074, 'App\\User'),
(6, 1210023934, 'App\\User'),
(6, 1126488665, 'App\\User'),
(6, 1066005461, 'App\\User'),
(6, 1003013264, 'App\\User'),
(6, 1008921391, 'App\\User'),
(6, 1004959376, 'App\\User'),
(6, 1100116828, 'App\\User'),
(6, 1145678491, 'App\\User'),
(6, 1017411001, 'App\\User'),
(6, 1010746685, 'App\\User'),
(6, 1017751661, 'App\\User'),
(6, 1289007508, 'App\\User'),
(6, 1064977668, 'App\\User'),
(6, 1004996821, 'App\\User'),
(6, 1098661993, 'App\\User'),
(6, 1281319218, 'App\\User'),
(6, 1153264674, 'App\\User'),
(6, 1094695587, 'App\\User'),
(6, 1096673091, 'App\\User'),
(6, 1023233700, 'App\\User'),
(6, 1002708378, 'App\\User'),
(6, 1104625750, 'App\\User'),
(6, 1010110550, 'App\\User'),
(6, 1063455581, 'App\\User'),
(6, 1227080100, 'App\\User'),
(6, 1116863870, 'App\\User'),
(6, 1122218845, 'App\\User'),
(6, 1069710508, 'App\\User'),
(6, 1120424259, 'App\\User'),
(6, 1069899939, 'App\\User'),
(6, 1151110989, 'App\\User'),
(6, 1012299877, 'App\\User'),
(6, 1141383681, 'App\\User'),
(6, 1277739661, 'App\\User'),
(6, 1143277407, 'App\\User'),
(6, 1222441049, 'App\\User'),
(6, 1116548966, 'App\\User'),
(6, 1113368314, 'App\\User'),
(6, 1002277733, 'App\\User'),
(6, 1148678291, 'App\\User'),
(6, 1228154850, 'App\\User'),
(6, 1157111867, 'App\\User'),
(6, 1093858844, 'App\\User'),
(6, 1221724364, 'App\\User'),
(6, 1033032820, 'App\\User'),
(6, 1094551899, 'App\\User'),
(6, 1220540009, 'App\\User'),
(6, 1112272874, 'App\\User'),
(6, 1286520005, 'App\\User'),
(6, 1018569292, 'App\\User'),
(6, 1092313109, 'App\\User'),
(6, 1153851440, 'App\\User'),
(6, 1007527754, 'App\\User'),
(6, 1007019271, 'App\\User'),
(6, 1002960182, 'App\\User'),
(6, 1001193021, 'App\\User'),
(6, 1025178546, 'App\\User'),
(6, 1112326387, 'App\\User'),
(6, 1149526709, 'App\\User'),
(6, 1111196977, 'App\\User'),
(6, 1271422883, 'App\\User'),
(6, 1091587010, 'App\\User'),
(6, 1117642750, 'App\\User'),
(6, 1112040600, 'App\\User'),
(6, 1152393258, 'App\\User'),
(6, 1282008198, 'App\\User'),
(6, 1024124844, 'App\\User'),
(6, 1066637185, 'App\\User'),
(6, 1158070907, 'App\\User'),
(6, 1005354750, 'App\\User'),
(6, 1140811102, 'App\\User'),
(6, 1141313689, 'App\\User'),
(6, 1068526051, 'App\\User'),
(6, 1117324293, 'App\\User'),
(6, 1117689864, 'App\\User'),
(6, 1159664477, 'App\\User'),
(6, 1274380259, 'App\\User'),
(6, 1229234328, 'App\\User'),
(6, 1144162289, 'App\\User'),
(6, 1001776181, 'App\\User'),
(6, 1000939269, 'App\\User'),
(6, 1005517678, 'App\\User'),
(6, 1124597105, 'App\\User'),
(6, 1151131434, 'App\\User'),
(6, 1145697733, 'App\\User'),
(6, 1229720770, 'App\\User'),
(6, 1120636344, 'App\\User'),
(6, 1030081717, 'App\\User'),
(6, 1008062237, 'App\\User'),
(6, 1204119026, 'App\\User'),
(6, 1123035937, 'App\\User'),
(6, 1027078615, 'App\\User'),
(6, 1114195844, 'App\\User'),
(6, 1119413073, 'App\\User'),
(6, 1156512692, 'App\\User'),
(6, 1143061278, 'App\\User'),
(6, 1010668396, 'App\\User'),
(6, 1097008103, 'App\\User'),
(6, 1100210839, 'App\\User'),
(6, 1208514005, 'App\\User'),
(6, 1144357136, 'App\\User'),
(6, 1157390182, 'App\\User'),
(6, 1094641794, 'App\\User'),
(6, 1211604430, 'App\\User'),
(6, 1282449233, 'App\\User'),
(6, 1141894182, 'App\\User'),
(6, 1091235223, 'App\\User'),
(6, 1117330090, 'App\\User'),
(6, 1228010927, 'App\\User'),
(6, 1002058362, 'App\\User'),
(6, 1111011258, 'App\\User'),
(6, 1114375837, 'App\\User'),
(6, 1117436610, 'App\\User'),
(6, 1225862839, 'App\\User'),
(6, 1120092773, 'App\\User'),
(6, 1030315130, 'App\\User'),
(6, 1002222560, 'App\\User'),
(6, 1093260278, 'App\\User'),
(6, 1152218199, 'App\\User'),
(6, 1018066521, 'App\\User'),
(6, 1141477850, 'App\\User'),
(6, 1066016073, 'App\\User'),
(6, 1061615793, 'App\\User'),
(6, 1029242314, 'App\\User'),
(6, 1229701446, 'App\\User'),
(6, 1116278526, 'App\\User'),
(6, 1068999393, 'App\\User'),
(6, 1099744129, 'App\\User'),
(6, 1146120011, 'App\\User'),
(6, 1113100080, 'App\\User'),
(6, 2147483647, 'App\\User'),
(6, 1097386655, 'App\\User'),
(6, 1032741312, 'App\\User'),
(6, 1007566667, 'App\\User'),
(6, 1128354333, 'App\\User'),
(6, 1002538075, 'App\\User'),
(6, 1019293821, 'App\\User'),
(6, 1050108072, 'App\\User'),
(6, 1101001209, 'App\\User'),
(6, 1208440287, 'App\\User'),
(6, 1275496593, 'App\\User'),
(6, 1145713373, 'App\\User'),
(6, 1090801145, 'App\\User'),
(6, 1220481674, 'App\\User'),
(6, 1090841080, 'App\\User'),
(6, 1008462681, 'App\\User'),
(6, 1123011439, 'App\\User'),
(6, 1009479568, 'App\\User'),
(6, 1025104347, 'App\\User'),
(6, 1116386294, 'App\\User'),
(6, 1061369499, 'App\\User'),
(6, 1050103019, 'App\\User'),
(6, 1003125167, 'App\\User'),
(6, 1141283775, 'App\\User'),
(6, 1200006484, 'App\\User'),
(6, 1014551617, 'App\\User'),
(6, 1010441022, 'App\\User'),
(6, 1115291168, 'App\\User'),
(6, 1121674447, 'App\\User'),
(6, 1118052959, 'App\\User'),
(6, 1280429992, 'App\\User'),
(6, 1066099779, 'App\\User'),
(6, 1103885512, 'App\\User'),
(6, 1033224321, 'App\\User'),
(6, 1229281256, 'App\\User'),
(6, 1100128174, 'App\\User'),
(6, 1141434561, 'App\\User'),
(6, 1140224322, 'App\\User'),
(6, 1156102194, 'App\\User'),
(6, 1115572175, 'App\\User'),
(6, 1223102236, 'App\\User'),
(6, 1282387715, 'App\\User'),
(6, 1144209306, 'App\\User'),
(6, 1097931085, 'App\\User'),
(6, 1095202093, 'App\\User'),
(6, 1010700778, 'App\\User'),
(6, 1280365139, 'App\\User'),
(6, 1225657911, 'App\\User'),
(6, 1001722516, 'App\\User'),
(6, 1091367617, 'App\\User'),
(6, 1094695587, 'App\\User'),
(6, 1146073632, 'App\\User'),
(6, 1006582598, 'App\\User'),
(6, 1101133360, 'App\\User'),
(6, 1228072199, 'App\\User'),
(6, 1200391628, 'App\\User'),
(6, 1096538454, 'App\\User'),
(6, 1148612026, 'App\\User'),
(6, 1111582626, 'App\\User'),
(6, 1150486710, 'App\\User'),
(6, 1129148782, 'App\\User'),
(6, 1000880421, 'App\\User'),
(6, 1112414604, 'App\\User'),
(6, 1280429992, 'App\\User'),
(6, 1013331708, 'App\\User'),
(6, 1004965330, 'App\\User'),
(6, 1096075111, 'App\\User'),
(6, 1157008839, 'App\\User'),
(6, 1115779556, 'App\\User'),
(6, 1016131308, 'App\\User'),
(6, 1022325627, 'App\\User'),
(6, 1120060020, 'App\\User'),
(6, 1024914091, 'App\\User'),
(6, 1000754404, 'App\\User'),
(6, 1002720774, 'App\\User'),
(6, 1150332611, 'App\\User'),
(6, 1005119170, 'App\\User'),
(6, 1278921609, 'App\\User'),
(6, 1223484086, 'App\\User'),
(6, 754, 'App\\User'),
(6, 1026253348, 'App\\User'),
(6, 1115799101, 'App\\User'),
(6, 1099659972, 'App\\User'),
(6, 1068513882, 'App\\User'),
(6, 1123088876, 'App\\User'),
(6, 1200377790, 'App\\User'),
(6, 1100930494, 'App\\User'),
(6, 1063736882, 'App\\User'),
(6, 1117578018, 'App\\User'),
(6, 1065859200, 'App\\User'),
(6, 1010746685, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 1140313810, 'App\\User'),
(6, 1019255646, 'App\\User'),
(6, 1098387712, 'App\\User'),
(6, 1208440287, 'App\\User'),
(6, 1113084403, 'App\\User'),
(6, 1141434561, 'App\\User'),
(6, 1013331707, 'App\\User'),
(6, 1069027960, 'App\\User'),
(6, 1033553141, 'App\\User'),
(6, 1146073632, 'App\\User'),
(6, 1201998499, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 1067198711, 'App\\User'),
(6, 1009105188, 'App\\User'),
(6, 1119950950, 'App\\User'),
(6, 1093577065, 'App\\User'),
(6, 1156102194, 'App\\User'),
(6, 1009558910, 'App\\User'),
(6, 1110244288, 'App\\User'),
(6, 1002002313, 'App\\User'),
(6, 1024147921, 'App\\User'),
(6, 1116972411, 'App\\User'),
(6, 1140139731, 'App\\User'),
(6, 1203577541, 'App\\User'),
(6, 1022853289, 'App\\User'),
(6, 1205602556, 'App\\User'),
(6, 1118827411, 'App\\User'),
(6, 1124863467, 'App\\User'),
(6, 1113747539, 'App\\User'),
(6, 1143800721, 'App\\User'),
(6, 1128354333, 'App\\User'),
(6, 1091778126, 'App\\User'),
(6, 1150800458, 'App\\User'),
(6, 1282387715, 'App\\User'),
(6, 1028822378, 'App\\User'),
(6, 1120374221, 'App\\User'),
(6, 1125643415, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 987654, 'App\\User'),
(6, 1001481711, 'App\\User'),
(6, 1278189308, 'App\\User'),
(6, 1278189309, 'App\\User'),
(6, 2147483647, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 1023774267, 'App\\User'),
(6, 1155557511, 'App\\User'),
(6, 1277364554, 'App\\User'),
(6, 1277364545, 'App\\User'),
(6, 1025897450, 'App\\User'),
(6, 1254896314, 'App\\User'),
(6, 1456982307, 'App\\User'),
(6, 1277364548, 'App\\User'),
(6, 1277364549, 'App\\User'),
(6, 1277364552, 'App\\User'),
(6, 1277364558, 'App\\User'),
(6, 1277364557, 'App\\User'),
(6, 1277364551, 'App\\User'),
(6, 1277364555, 'App\\User'),
(6, 1255123647, 'App\\User'),
(6, 1277364559, 'App\\User'),
(6, 1277364540, 'App\\User'),
(6, 1277964540, 'App\\User'),
(6, 1558246, 'App\\User'),
(6, 652642, 'App\\User'),
(6, 1277964543, 'App\\User'),
(6, 2589, 'App\\User'),
(6, 25895413, 'App\\User'),
(6, 1025525, 'App\\User'),
(6, 543120, 'App\\User'),
(6, 564564654, 'App\\User'),
(6, 58595959, 'App\\User'),
(6, 5623, 'App\\User'),
(6, 1023774260, 'App\\User'),
(6, 1066066368, 'App\\User'),
(6, 1100013532, 'App\\User'),
(6, 1148920246, 'App\\User'),
(6, 1008466753, 'App\\User'),
(6, 1277364554, 'App\\User'),
(6, 1060493844, 'App\\User'),
(6, 1098201329, 'App\\User'),
(6, 1119684897, 'App\\User'),
(6, 1004974049, 'App\\User'),
(6, 1068453969, 'App\\User'),
(6, 1000095985, 'App\\User'),
(6, 1000689717, 'App\\User'),
(6, 1008826440, 'App\\User'),
(6, 1060692267, 'App\\User'),
(6, 1550789918, 'App\\User'),
(6, 1122897651, 'App\\User'),
(6, 1023774260, 'App\\User');

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `is_confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `from_user_id` int(10) UNSIGNED NOT NULL,
  `to_user_id` int(10) UNSIGNED NOT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`id`, `start_date`, `end_date`, `is_confirmed`, `from_user_id`, `to_user_id`, `store_id`, `created_at`, `updated_at`) VALUES
(1, '2022-05-29 13:48:05', NULL, 1, 1, 1, 1, '2022-05-29 19:48:05', '2022-05-29 19:48:05');

-- --------------------------------------------------------

--
-- Table structure for table `shop__types`
--

CREATE TABLE `shop__types` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shop__types`
--

INSERT INTO `shop__types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'صيدليه', '2022-02-05 05:26:44', '2022-03-26 19:09:09'),
(2, 'عيادة', '2022-03-08 21:30:17', '2022-03-08 21:30:17'),
(3, 'مركز طبي', '2022-03-08 21:30:31', '2022-03-08 21:30:31'),
(4, 'مركز تجميل', '2022-03-08 21:30:47', '2022-03-08 21:30:47'),
(6, 'تجميلي', '2022-03-26 19:09:33', '2022-03-26 19:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `product_id` int(11) UNSIGNED DEFAULT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `product_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, '1_image.png', 1, 1, '2022-02-02 18:56:14', '2022-05-29 14:02:45'),
(4, '4_image.png', 2, 1, '2022-03-09 19:53:32', '2022-05-29 14:02:49'),
(5, '5_image.jpg', 3, 1, '2022-03-09 19:54:22', '2022-07-20 17:56:23'),
(8, '8_image.jpeg', 4, 1, '2022-03-28 19:17:09', '2022-07-20 20:04:06'),
(11, '11_image.jpg', 5, 1, '2022-05-10 19:28:38', '2022-05-29 14:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `sms__messages`
--

CREATE TABLE `sms__messages` (
  `id` bigint(20) NOT NULL,
  `sender_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sms__messages`
--

INSERT INTO `sms__messages` (`id`, `sender_id`, `user_name`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Go Lab', 'GoLab', 'GoLab123', '2022-04-25 08:59:52', '2022-04-25 08:59:52');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `finance` decimal(65,30) NOT NULL DEFAULT 0.000000000000000000000000000000,
  `place_id` bigint(20) UNSIGNED NOT NULL,
  `store_keeper_id` bigint(20) UNSIGNED NOT NULL,
  `store_finance_manager_id` int(11) UNSIGNED DEFAULT NULL,
  `accountant_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `address`, `finance`, `place_id`, `store_keeper_id`, `store_finance_manager_id`, `accountant_id`, `created_at`, `updated_at`) VALUES
(1, 'المخزن الرئيسي', 'Dora Cairo Compound - First Settlement - New Cairo, Egypt', '0.000000000000000000000000000000', 1, 1, 1, 0, '2022-05-29 19:48:05', '2022-06-14 20:59:22');

-- --------------------------------------------------------

--
-- Table structure for table `store_categories`
--

CREATE TABLE `store_categories` (
  `store_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `store_subcategory`
--

CREATE TABLE `store_subcategory` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `store_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `company_id` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_hidden` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_togary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `phone`, `address`, `s_togary`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'نقدى', '011128976513', 'القصر العينى', '111111', 1, '2022-05-29 19:19:13', '2022-06-13 21:03:48'),
(2, 'ايجبت لاب  عبد االحليم', '01004603519', 'بستان الفاضل  القصر العينى', '111111', 1, '2022-06-13 20:35:55', '2022-06-13 20:35:55'),
(3, 'كير لاب الفجر', '01123060736', 'القصر العينى', '121212', 1, '2022-06-13 20:36:50', '2022-06-13 20:36:50'),
(4, 'بيتا لاب', '01020628790', 'القصر العينى', '1111111', 1, '2022-06-13 20:42:03', '2022-06-13 20:42:03'),
(5, 'مونديال   حسام', '01062651611', 'القصر العينى', '1111111', 1, '2022-06-13 20:44:03', '2022-06-13 20:44:03'),
(6, 'جين لاب  اكيوريت', '01282809771', 'المنيل', '121221', 1, '2022-06-13 20:55:11', '2022-06-13 20:55:11'),
(7, 'امريكانا تريد', '01000449131', 'القصر العينى', '1234566', 1, '2022-06-13 20:55:55', '2022-06-13 20:55:55'),
(8, 'اسبين راكت', '01227441911', 'مدينه نصر', '123455', 1, '2022-06-13 20:56:44', '2022-06-13 20:56:44'),
(9, 'ماسكو ميد', '01115602380', 'طنطا', '145551', 1, '2022-06-13 20:58:42', '2022-06-13 20:58:42'),
(10, 'مكتب الشرق', '01009075063', 'القصر العينى', '1566654', 1, '2022-06-13 20:59:20', '2022-06-13 20:59:20'),
(11, 'بيوسيستم', '01141654242', 'مصر الجديده', '123556', 1, '2022-06-13 20:59:57', '2022-06-13 20:59:57'),
(12, 'الفا لاب', '01274466424', 'القصر العينى', '1225646', 1, '2022-06-13 21:00:37', '2022-06-13 21:00:37'),
(13, 'الحياه   محمد صديق', '01066941660', 'القصر العينى', '1655454', 1, '2022-06-13 21:01:36', '2022-06-13 21:01:36'),
(14, 'دلتا ميديكال  مصطفى', '01027661686', 'القصر العينى', '1665422', 1, '2022-06-13 21:02:19', '2022-06-13 21:02:19'),
(15, 'سبيكترام', '01007072369', 'القصر العينى', '11254765', 1, '2022-06-13 21:05:54', '2022-06-13 21:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_depts`
--

CREATE TABLE `supplier_depts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` double(8,2) NOT NULL,
  `is_settlement` tinyint(1) NOT NULL DEFAULT 0,
  `examination_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier_depts`
--

INSERT INTO `supplier_depts` (`id`, `amount`, `is_settlement`, `examination_id`, `supplier_id`, `store_id`, `created_at`, `updated_at`) VALUES
(1, 1000.00, 0, 4, 8, 1, '2022-06-14 22:49:40', '2022-06-14 22:49:40'),
(2, 6000.00, 0, 5, 1, 1, '2022-06-23 03:43:40', '2022-06-23 03:43:40'),
(3, 11011.00, 0, 6, 1, 1, '2022-07-20 17:47:40', '2022-07-20 17:47:40'),
(4, 1.00, 0, 7, 1, 1, '2022-07-24 15:09:57', '2022-07-24 15:09:57');

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_id` int(10) UNSIGNED NOT NULL,
  `to_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `secound_phone` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place_id` int(20) UNSIGNED DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `keeper_id` int(11) DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `manager_id` int(11) UNSIGNED DEFAULT NULL,
  `finance_manager` int(11) UNSIGNED DEFAULT NULL,
  `work_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `car_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `points` int(11) NOT NULL DEFAULT 0,
  `adder_id` int(11) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT NULL,
  `active_type_id` bigint(20) DEFAULT NULL,
  `contact_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `secound_phone`, `name`, `email`, `email_verified_at`, `password`, `role`, `image`, `shop_name`, `shop_type`, `area`, `place_id`, `address`, `location`, `status`, `token`, `type`, `keeper_id`, `seller_id`, `manager_id`, `finance_manager`, `work_time`, `car_type`, `points`, `adder_id`, `remember_token`, `created_at`, `updated_at`, `last_update`, `active_type_id`, `contact_time`) VALUES
(0, NULL, 'seles', 'seles@testing.com', NULL, '$2y$10$RvPUYRv9jrdrZ0hP624aPuRpn.eSijCbS1/iZlDyEqUn91oN8e04.', '', '', '', '', '', NULL, '', '', 1, '', 'employee', NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 'E8z8ygkMqiA5v9UWsgMSqL0JydCOx2lZWWINTShR2XIZwk3BRkqXaSTaPsHR', '2022-05-11 19:53:55', '2022-07-24 00:42:43', NULL, NULL, NULL),
(1, NULL, 'Super Administrator', 'super_administrator@app.com', NULL, '$2y$10$1SugckoKdK/UtHCzNIIlMuUMBVr91vsMiDS.ZjJ0924d5D1KFKFGC', '', '', '', '', '', NULL, '', '', 0, '', 'employee', 1, NULL, 1, 1, NULL, NULL, 0, 1, 'bcFCM8SNmuo3fP7eQ41kR3gv688hWnP6iyycqhXqVRQ8qFWMFNR7tbDUugKJ', '2021-03-08 16:17:05', '2022-07-24 00:42:43', NULL, 0, NULL),
(1000095985, NULL, 'احمد', 'ahmedtharwat3988@gmail.com', NULL, '$2y$10$/FMAA7gPA2bkzSnOcSvuU.U9K6zUgee/8xptFXfOH8/cscectpASO', 'user', '1655423420.jpg', 'المتحده', 'معامل تحاليل', '', 1, 'القاهره', '30.6958007,31.7403805', 1, 'ejPNRgr_Rl6nMkUKzTjJF-:APA91bGBsuvyiJ261uGxSm_ov6GP5GKTekkJ4QhEUbx1wlJmRZTB7OjiGAATvxQvOoIhBs1-matqs7OHqev13B0Bcq7i9GGiIqPPvdv54OhSewE3qCe0--2nuccZ_-18fUDbBD9MMdq1', 'user', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-06-17 05:50:20', '2022-06-17 05:54:49', NULL, NULL, NULL),
(1000689717, NULL, 'ايه السيد حسن', 'aya.yoyo556@gmail.com', NULL, '$2y$10$0bEh3QYUnK9WZlgMyq4W1OUfSfRDyrm/o6ANl0521zMJB7jubnjo.', 'user', '1656178839.jpg', 'آيه', 'معامل تحاليل', '', 1, 'مصر الجديده', '30.7347124,31.7902865', 1, 'dfZllN3YQSi37pS0ZiI7qQ:APA91bEjPluJ-55l-MoaW0zURIkT2aAPnYQPhdgLeuh4POQtR9iwiU3adMLIHOU4dNppu-IKkrySXfVq6T0MKQ3mZy0MxBYyBOQvefDkJK5rkRXns408Cvj-NH47d3EuLnVIIxhsBZvN', 'user', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-06-25 23:40:39', '2022-06-26 00:50:29', NULL, NULL, NULL),
(1004974049, NULL, 'محمد ثروت', 'm_tharwat2010@yahoo.comm', NULL, '$2y$10$ly6Axp04jzjcztLvnolVDOrkP7Ko1Ta6KYaRBBGHrgMOtFRsG3wz6', 'user', '1654423702.jpg', 'معامل محمد ثروت', 'معامل تحاليل', '', 1, 'القصر العيني', '30.0267732,31.2325602', 1, 'frIrMor_QnqrkRsND84uiQ:APA91bGSwjWPhEzZL6oJpKRTPRlSDb2oWuutSqHPMuIAnp3pxztRFkPzwgIgBN98hdjViO2_DgspYBqCET8NL3Q6j33upPIsbCzdd5-WcW5dKj5axQfTvOUk270GgpLVouP-rU3EGT5t', 'user', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-06-05 16:08:22', '2022-06-08 16:32:34', NULL, NULL, NULL),
(1008826440, NULL, 'Amr', 'amrdiaa86@yahoo.com', NULL, '$2y$10$b7jB5IzFebcWFwGOxpLoye6BNUiyDVdACW4oqnK9Lq3WyVuNPTRZK', 'user', '1658200735.jpg', 'Amr', 'Pharmacies', '', 1, 'Cairo', '30.0673498,31.0183928', 0, 'feKfhKAcTH-SWeS9SPO5Ow:APA91bH3FQfF_LY8RLynmiGYq_CII9P31lzpmXKxbHOglVy1hOLSUH4AgyZMN1hfbdrza_JYT7vKqseO4-zdBRHutyn3QzYNw3IHHNOG8-SaFOSyq7Bejgk_WeKHQ9Pq8-QlT9i9lO8-', 'user', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-07-19 09:18:55', '2022-07-19 09:18:55', NULL, NULL, NULL),
(1023774260, NULL, 'mohamed adel', 'xsl@mail.com', NULL, '$2y$10$r8nrDcQXG/4.ZpkoyUurduvYipwsp3jrfJq5x89L6d9OYRzqLL.GO', 'user', '1659779119.png', 'ay haga', 'market', '', 37, '24 3amer eldokki', 'jyfbhdvr asxjmf jd hrdbklg yuwf jf', 0, 'jyfbhdvr asxjmf jd hrdbklg yuwf jf', 'user', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-08-06 19:45:17', '2022-08-06 19:45:19', NULL, NULL, NULL),
(1060493844, NULL, 'Mohamed Yousri', 'elarabmo2019@gmail.com', NULL, '$2y$10$7oiuYQbIlzYcNPB8S2OZyukugXqstOBrnZiOKVwSafnsZ1/AKN7aa', 'user', '1654328891.jpg', 'elkwuity', 'Pharmacies', '', 1, 'abo hammad', '30.033739,31.2126508', 0, 'foqfN4_USYOcWBCvss-3ey:APA91bGlo9h3rne3GbiTimcZ-P2bMk_ft8j7S8wW_h7RTfqX-SJG8YW1HnIn-46wEqFyaYb0tzgcbz4uaWQeYWMQEBgYbd9zLuaUF5GsqiDJBWv63DqymeYlYdSGaYeaksrSc1Kk5BXT', 'user', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-06-04 13:48:11', '2022-06-04 13:48:11', NULL, NULL, NULL),
(1060692267, NULL, 'somaya', 'somayamahmoud30@gmail.com', NULL, '$2y$10$aBcwuHUqb0XqTuut1DGeKuV83WYBIJKYiM5I9lnfNTxVaJviWEHCG', 'user', 'user-62ebbb7be7e7e.png', 'patient', 'Clinics', '', 6, 'nasr city', '37.4220936,-122.083922', 1, 'fGKMMrJXRtanuphCbG562d:APA91bGirMxJ_ctaAfVfbAQGCS6R0dqDIy_FY0O5KS7heqz9R9lGake9LZicPHMQwKWuYWg0smbQb0pEQcOZSdJZ_9n6c7ajJzOROZiQHuJKlTTtJ9_tmECZebFp8AVTe5HG63gwrgSq', 'user', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-07-24 21:57:35', '2022-08-04 18:28:43', NULL, NULL, NULL),
(1068453969, NULL, 'عبدالحميد علي عبدالحميد', 'mido.alaa123546@gmail.com', NULL, '$2y$10$r9CUF4i9MLKC62oRSsXFi.jXaRum.Zlql/RZ33m1wfMsuFeV709yu', 'user', '1654870736.jpg', 'معمل تحاليل', ' Laboratories', '', 1, 'فاقوس.الشرقية', '30.695755,31.7365378', 1, 'eJf6z7CmTEWEvZxLdyntbV:APA91bFe_5wrDNLhMKgwBf3lZVNEjGPe1Bpw6qqWldcaWQPtNPccHhenWEqYAu9Xky2n71OJajDNOdGzfYBrAWzIooV0vMaZ5Y6iRoBt6IU4WMHjffiRnopWsH0SirU81VW69pl8AANm', 'user', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-06-10 20:18:55', '2022-06-11 15:43:16', NULL, NULL, NULL),
(1098201329, NULL, 'محمد', 'mohamed@gmail.com', NULL, '$2y$10$Z0Wc2SCg3upWqKx6qNFVcOkL4proQvOpUXrBfnexYqbO3u7RuuQyu', 'user', '1654330548.png', 'السعيد', 'Pharmacies', '', 1, 'الجيزة', '30.0339269,31.2124171', 0, 'fmK3APFygUj1moBI3cuGLD:APA91bF3zCPaXOdw5t_6b3j_qv60EB5iB3ymuwvlrzGW07kQCd0T_lDiwUlCDuJyA7dQ49TBSsB2dW0OawGKNneBmWeF-PHdWEQ2gtmbxzUB7gaA-MqIQknwfL1gzFckTxrlQqexozJx', 'user', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-06-04 14:15:48', '2022-06-05 16:42:53', NULL, NULL, NULL),
(1101001960, NULL, 'محمد ثروت', 'M_THARWAT2010@YAHOO.COM', NULL, '$2y$10$0EZuYTwIBnqrizjqkenGYuuppw8Yy16O1tVN18cDCGimCAn8IwEd2', '', '', '', '', '', NULL, '', '', 0, '', 'employee', 1, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, '2022-06-09 01:31:44', '2022-07-24 00:42:43', NULL, NULL, NULL),
(1119684897, NULL, 'محمود', 'tito2007517@yahoo.com', NULL, '$2y$10$zPKv.vfO1EpkOMbgvSAVf.TmL1AeK0dCJ1Ulk0yVGAMv0uArVluiK', 'user', '1654337351.jpg', 'معمل', 'معامل تحاليل', '', 1, 'القاهرة', '30.0263296,31.232499', 1, 'eabaPNWzQMSAEfCUU0Pk1q:APA91bF5XKxev1-L5FRirHy5vdVX_n7Bvs5sunjh3oI0Z1wsm2XLBZG7VqA6kzHWZBDhSckouLiH73XxghTRW1Ot20b-JmfxsGSBp-HVBJ7sMttvbEwEmSDRBzqkEjw3THSIj0o8Kcj4', 'user', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-06-04 16:09:11', '2022-07-17 17:43:10', NULL, NULL, NULL),
(1122897651, NULL, 'ali khalifa', 'ali689.kh@gmail.com', NULL, '$2y$10$/.1yNon86ntpcg42hzUJjut/FE8y/opsN4AQ2BJ7FPpnxenzxfY/2', 'user', '1659346419.jpg', 'test', 'صيدليات', '', 1, 'cairo', '30.0335565,31.2126158', 1, 'fJoKK-dyQmmAUuoTA2QxPr:APA91bH5uft_BfESeyw-ooiZhIGnJF_yYqseVJvxYDH9PaQhW44dMDWh07StuN8aIMakVgWMp1cvOObRS4vh5OOy1b4PhKz9SOhK9zjxWX9L_jcm90N-23TIXXL2CsUgRu4zCYlUwsD3', 'user', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-08-01 15:33:39', '2022-08-01 15:34:51', NULL, NULL, NULL),
(1277364554, NULL, 'محمد سعيد', 'm.saeed.fci@gmail.com', NULL, '$2y$10$o8GNi6Mkpb7UaTd3mxjKWOBQDqHuc5f6a6IbUZmcF0zdgdIUt23S6', 'user', '1653833839.jpg', 'الشفاء', ' Laboratories', '', 1, 'الجيزة', '30.0335827,31.2126331', 1, 'fBQ_TywsTT-m3ySfeLq_am:APA91bElrfmloHT5Hxc0EgtMzJ4B5TVPQ4p3i6RlGMKnNjQL4ieegreu6ndsB8a83d6IYuzGFn8awshH6wMDyJuYjCE6_RZiZ-B4oM-o2JSxcijBcvnvkOXr081dqX7Y6L5Y_HnY6AMi', 'user', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-05-29 20:17:19', '2022-07-24 18:55:14', NULL, NULL, NULL),
(1550789918, NULL, 'somaya', 'yomna_mahmoud81@yahoo.com', NULL, '$2y$10$GzBz9OG5VxMZ1FnUJZGbhuNC/bUZ7iYDqFn9cvCv0ZGHmCbiBRGoi', 'user', '1658936428.jpg', 'doctor', 'عيادات', '', 6, 'cairo', '30.0335887,31.2126372', 0, 'e2ogB9ZASYGrtEULvFMkTA:APA91bHD_TsRs58kwhp7i6fyT_hSJepLK9RspQep4Ht1bA-MjnS_QFuHOnmTV8PXJ01c3QyAEiDuQylbZQF8qXxJR4txXC8d3DU1ysqHNG-be2p9y95DUp749xc7Az5qs_7oA8HAwSUS', 'user', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-07-27 21:40:28', '2022-07-27 21:40:28', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_mongez`
--

CREATE TABLE `user_mongez` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `km` decimal(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_mongez`
--

INSERT INTO `user_mongez` (`id`, `order_id`, `user_id`, `price`, `km`, `created_at`, `updated_at`) VALUES
(1, 1, 1277364554, '3131.88', '2087.92', '2022-05-29 20:34:02', '2022-05-29 20:34:02'),
(2, 7, 1119684897, '1041.04', '2082.09', '2022-06-08 18:34:53', '2022-06-08 18:34:53'),
(3, 8, 1004974049, '45216.44', '90432.88', '2022-07-14 04:22:02', '2022-07-14 04:22:02'),
(4, 9, 1004974049, '45216.46', '90432.93', '2022-07-14 04:22:51', '2022-07-14 04:22:51'),
(5, 10, 1004974049, '57.41', '38.28', '2022-07-20 18:01:39', '2022-07-20 18:01:39'),
(6, 11, 1119684897, '51.37', '34.25', '2022-07-20 18:07:15', '2022-07-20 18:07:15');

-- --------------------------------------------------------

--
-- Table structure for table `user_points`
--

CREATE TABLE `user_points` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `offer_point_id` bigint(20) NOT NULL,
  `points` float NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_rates`
--

CREATE TABLE `user_rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rate` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_types`
--
ALTER TABLE `activity_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_subcategory`
--
ALTER TABLE `company_subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaintproducts`
--
ALTER TABLE `complaintproducts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaint_types`
--
ALTER TABLE `complaint_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupones`
--
ALTER TABLE `coupones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_user`
--
ALTER TABLE `coupon_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `defult_mongez`
--
ALTER TABLE `defult_mongez`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `depts`
--
ALTER TABLE `depts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `directions`
--
ALTER TABLE `directions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `directions_place_id_foreign` (`place_id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount_types`
--
ALTER TABLE `discount_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edited__order__units`
--
ALTER TABLE `edited__order__units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `examinations`
--
ALTER TABLE `examinations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `examination_units`
--
ALTER TABLE `examination_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finance_shifts`
--
ALTER TABLE `finance_shifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `infos`
--
ALTER TABLE `infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info_product`
--
ALTER TABLE `info_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info__expirations`
--
ALTER TABLE `info__expirations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingoings`
--
ALTER TABLE `ingoings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ins`
--
ALTER TABLE `ins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `in_items`
--
ALTER TABLE `in_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `in_items_ingoing_id_foreign` (`ingoing_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_outgoing_id_foreign` (`outgoing_id`);

--
-- Indexes for table `lockers`
--
ALTER TABLE `lockers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loses`
--
ALTER TABLE `loses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loses_order_id_foreign` (`order_id`);

--
-- Indexes for table `mandobs`
--
ALTER TABLE `mandobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mandob_place`
--
ALTER TABLE `mandob_place`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mandob_place_place_id_foreign` (`place_id`);

--
-- Indexes for table `mandob_stages`
--
ALTER TABLE `mandob_stages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `min_prices`
--
ALTER TABLE `min_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mondob_rates`
--
ALTER TABLE `mondob_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mongez`
--
ALTER TABLE `mongez`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mostproducts`
--
ALTER TABLE `mostproducts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifies`
--
ALTER TABLE `notifies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notify_totals`
--
ALTER TABLE `notify_totals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notify_total_product`
--
ALTER TABLE `notify_total_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notify_total_product_notify_total_id_foreign` (`notify_total_id`);

--
-- Indexes for table `notify_units`
--
ALTER TABLE `notify_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notify_users`
--
ALTER TABLE `notify_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notify_user_units`
--
ALTER TABLE `notify_user_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer_points`
--
ALTER TABLE `offer_points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_stages`
--
ALTER TABLE `order_stages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_units`
--
ALTER TABLE `order_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outgoings`
--
ALTER TABLE `outgoings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outs`
--
ALTER TABLE `outs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_products`
--
ALTER TABLE `package_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `previousorders`
--
ALTER TABLE `previousorders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_store`
--
ALTER TABLE `product_store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_user`
--
ALTER TABLE `product_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo_code`
--
ALTER TABLE `promo_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipt_statuses`
--
ALTER TABLE `receipt_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_reasons`
--
ALTER TABLE `return_reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `revenues`
--
ALTER TABLE `revenues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop__types`
--
ALTER TABLE `shop__types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms__messages`
--
ALTER TABLE `sms__messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_categories`
--
ALTER TABLE `store_categories`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `store_subcategory`
--
ALTER TABLE `store_subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_depts`
--
ALTER TABLE `supplier_depts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_depts_examination_id_foreign` (`examination_id`),
  ADD KEY `supplier_depts_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_mongez`
--
ALTER TABLE `user_mongez`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_points`
--
ALTER TABLE `user_points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_rates`
--
ALTER TABLE `user_rates`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_types`
--
ALTER TABLE `activity_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `company_subcategory`
--
ALTER TABLE `company_subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complaintproducts`
--
ALTER TABLE `complaintproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complaint_types`
--
ALTER TABLE `complaint_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupones`
--
ALTER TABLE `coupones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coupon_user`
--
ALTER TABLE `coupon_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `defult_mongez`
--
ALTER TABLE `defult_mongez`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `depts`
--
ALTER TABLE `depts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `directions`
--
ALTER TABLE `directions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `discount_types`
--
ALTER TABLE `discount_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `edited__order__units`
--
ALTER TABLE `edited__order__units`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `examinations`
--
ALTER TABLE `examinations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `examination_units`
--
ALTER TABLE `examination_units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `finance_shifts`
--
ALTER TABLE `finance_shifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `infos`
--
ALTER TABLE `infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=282;

--
-- AUTO_INCREMENT for table `info_product`
--
ALTER TABLE `info_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=282;

--
-- AUTO_INCREMENT for table `info__expirations`
--
ALTER TABLE `info__expirations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT for table `ingoings`
--
ALTER TABLE `ingoings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ins`
--
ALTER TABLE `ins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `in_items`
--
ALTER TABLE `in_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lockers`
--
ALTER TABLE `lockers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `loses`
--
ALTER TABLE `loses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mandobs`
--
ALTER TABLE `mandobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mandob_place`
--
ALTER TABLE `mandob_place`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mandob_stages`
--
ALTER TABLE `mandob_stages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `min_prices`
--
ALTER TABLE `min_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mondob_rates`
--
ALTER TABLE `mondob_rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mongez`
--
ALTER TABLE `mongez`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mostproducts`
--
ALTER TABLE `mostproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifies`
--
ALTER TABLE `notifies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notify_totals`
--
ALTER TABLE `notify_totals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notify_total_product`
--
ALTER TABLE `notify_total_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notify_units`
--
ALTER TABLE `notify_units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notify_users`
--
ALTER TABLE `notify_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notify_user_units`
--
ALTER TABLE `notify_user_units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offer_points`
--
ALTER TABLE `offer_points`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_stages`
--
ALTER TABLE `order_stages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_units`
--
ALTER TABLE `order_units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `outgoings`
--
ALTER TABLE `outgoings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `outs`
--
ALTER TABLE `outs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `package_products`
--
ALTER TABLE `package_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `previousorders`
--
ALTER TABLE `previousorders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=279;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `product_store`
--
ALTER TABLE `product_store`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=282;

--
-- AUTO_INCREMENT for table `product_user`
--
ALTER TABLE `product_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `promo_code`
--
ALTER TABLE `promo_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `receipt_statuses`
--
ALTER TABLE `receipt_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `return_reasons`
--
ALTER TABLE `return_reasons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `revenues`
--
ALTER TABLE `revenues`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shop__types`
--
ALTER TABLE `shop__types`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sms__messages`
--
ALTER TABLE `sms__messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `store_categories`
--
ALTER TABLE `store_categories`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_subcategory`
--
ALTER TABLE `store_subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `supplier_depts`
--
ALTER TABLE `supplier_depts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1550789919;

--
-- AUTO_INCREMENT for table `user_mongez`
--
ALTER TABLE `user_mongez`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_points`
--
ALTER TABLE `user_points`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_rates`
--
ALTER TABLE `user_rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `directions`
--
ALTER TABLE `directions`
  ADD CONSTRAINT `directions_place_id_foreign` FOREIGN KEY (`place_id`) REFERENCES `places` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `in_items`
--
ALTER TABLE `in_items`
  ADD CONSTRAINT `in_items_ingoing_id_foreign` FOREIGN KEY (`ingoing_id`) REFERENCES `ingoings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_outgoing_id_foreign` FOREIGN KEY (`outgoing_id`) REFERENCES `outgoings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `loses`
--
ALTER TABLE `loses`
  ADD CONSTRAINT `loses_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notify_total_product`
--
ALTER TABLE `notify_total_product`
  ADD CONSTRAINT `notify_total_product_notify_total_id_foreign` FOREIGN KEY (`notify_total_id`) REFERENCES `notify_totals` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 20, 2021 at 05:43 PM
-- Server version: 5.7.33-0ubuntu0.18.04.1
-- PHP Version: 7.3.24-3+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kroykari`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `price` double(11,2) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `brand` text CHARACTER SET utf8 COLLATE utf8_bin,
  `sub_category_id` int(10) UNSIGNED NOT NULL,
  `city_id` int(10) UNSIGNED NOT NULL,
  `city_area_id` int(10) UNSIGNED NOT NULL,
  `is_featured` tinyint(4) NOT NULL DEFAULT '1',
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `is_approved` tinyint(4) NOT NULL DEFAULT '0',
  `condition` enum('0','1') NOT NULL DEFAULT '0',
  `is_publish` tinyint(4) NOT NULL DEFAULT '1',
  `is_sold` enum('0','1') DEFAULT '0',
  `sold_date` datetime DEFAULT NULL,
  `buyer_id` int(11) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `reject_reason` text CHARACTER SET utf8 COLLATE utf8_bin,
  `rejected_date` datetime DEFAULT NULL,
  `deleted_reason` text CHARACTER SET utf8 COLLATE utf8_bin,
  `is_deliver_to_buyer` enum('0','1') NOT NULL DEFAULT '0',
  `is_negotiable` enum('0','1') DEFAULT '0',
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `map_address` varchar(255) DEFAULT NULL,
  `is_hide_phone_number` enum('0','1') DEFAULT NULL,
  `phone_numbers` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `user_id`, `title`, `description`, `price`, `category_id`, `brand`, `sub_category_id`, `city_id`, `city_area_id`, `is_featured`, `is_active`, `is_approved`, `condition`, `is_publish`, `is_sold`, `sold_date`, `buyer_id`, `country`, `reject_reason`, `rejected_date`, `deleted_reason`, `is_deliver_to_buyer`, `is_negotiable`, `lat`, `lng`, `map_address`, `is_hide_phone_number`, `phone_numbers`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 106, 'Tata Tigor XZ plush', 'Tigor is a very worthy car for the price tag. Had got it for 8lk for top-end petrol. Now also it\'s almost the same even with more features and improved design. Less maintenance for sure. Almost half the maintenance compare to Hyundai or VW. Mileage is a bit of concern because the car itself is 130-150 kg heavier than the tin cans. But if you drive always below 90 kmph then, a highway mileage of 18kmpl is guaranteed with eco mode In Bangalore city traffic. I get 12kmpl in Mysore traffic 14 km with eco mode, not city mode. For two years, I have driven 38000, maintenance has been around 13000 with 5 services. I highly recommend this car to family people.', 999999.99, 5, NULL, 17, 17, 20, 1, 1, 1, '0', 1, '0', NULL, NULL, NULL, 'Lorem ipsum', NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, '2021-02-06 14:06:21', '2021-02-08 07:09:19', NULL),
(2, 71, 'Mobile for sale', 'A51', 10000.00, 3, NULL, 15, 2, 42, 1, 1, 2, '0', 1, '0', NULL, NULL, NULL, 'test delet', NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, '2021-02-06 15:15:30', '2021-02-06 14:18:09', '2021-02-06 14:18:09'),
(3, 71, 'Mobile for sale', 'Test', 99988566.00, 3, NULL, 15, 5, 39, 1, 1, 2, '0', 1, '0', NULL, NULL, NULL, 'test', NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, '2021-02-06 19:36:46', '2021-02-06 18:40:51', '2021-02-06 18:40:51'),
(4, 1, 'Mi 4A 100 cm (40 inch) Full HD LED Smart Android TV with With Google Data Saver', 'For products requiring installation, returns are valid only when they are installed by Flipkart-authorized personnel.', 12500.00, 3, NULL, 15, 17, 19, 1, 1, 1, '0', 1, '0', NULL, NULL, 'France', NULL, NULL, 'test', '0', '0', NULL, NULL, NULL, NULL, NULL, '2021-02-08 11:32:41', '2021-02-20 21:10:08', '2021-02-20 21:10:08'),
(9, 1, 'Sandisk Cruzer Blade 32 GB  (Black, Red)', 'USB 2.0|32 GB\r\nPlastic\r\nFor Laptop, Desktop Computer\r\nColor:Black, Red', 253.00, 3, NULL, 16, 17, 19, 1, 1, 1, '0', 1, '0', NULL, NULL, 'France', 'This product is not in good condition, so i want to delete it.', NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, '2021-02-08 11:38:00', '2021-02-09 05:12:31', '2021-02-09 05:12:31'),
(11, 107, 'Plastic Bottle', 'Fit for regular use: with each bottle weighing 106 gms, made of thick material tested thoroughly for the purpose\r\nSafe storage: as the material used is PET, Grade 1 high-quality food grade plastic which is 100% BPA free\r\nColourful appearance: A set of 6 multi-coloured bottles of 1L each\r\nFirmer grip and attractive design: with a pattern of squared checks on the body\r\nEase of use: ensured by smoothly opening lid and neck diameter of 3.2 cm which allows only appropriate quantity of water to come out\r\nSpill-proof water storage: with snugly fitting lid\r\nIdeal for storing cold water or water at room temperature. Not meant for storing hot water', 250.00, 42, NULL, 43, 17, 19, 1, 1, 0, '0', 1, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, '2021-02-09 06:46:35', NULL, '2021-02-09 05:47:15'),
(12, 107, 'Plastic Bottle', 'Fit for regular use: with each bottle weighing 106 gms, made of thick material tested thoroughly for the purpose\r\nSafe storage: as the material used is PET, Grade 1 high-quality food grade plastic which is 100% BPA free\r\nColourful appearance: A set of 6 multi-coloured bottles of 1L each\r\nFirmer grip and attractive design: with a pattern of squared checks on the body\r\nEase of use: ensured by smoothly opening lid and neck diameter of 3.2 cm which allows only appropriate quantity of water to come out\r\nSpill-proof water storage: with snugly fitting lid\r\nIdeal for storing cold water or water at room temperature. Not meant for storing hot water', 250.00, 42, NULL, 43, 17, 19, 1, 1, 0, '0', 1, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, '2021-02-09 06:46:36', NULL, '2021-02-09 05:47:13'),
(13, 98, 'Honda 220', 'Brand new', 290000.00, 5, NULL, 18, 10, 34, 1, 1, 1, '0', 1, '0', NULL, NULL, NULL, NULL, NULL, 'test', '0', '0', NULL, NULL, NULL, NULL, NULL, '2021-02-10 07:18:21', '2021-02-20 13:12:45', '2021-02-20 13:12:45'),
(14, 106, 'Pen Drive 32 GB', 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for use in a type specimen book.', 526.00, 3, NULL, 16, 17, 20, 1, 1, 1, '0', 1, '0', NULL, NULL, NULL, NULL, NULL, 'test', '0', '0', NULL, NULL, NULL, NULL, NULL, '2021-02-10 08:45:25', '2021-02-20 21:12:45', '2021-02-20 21:12:45'),
(16, 109, 'Bottle', 'Bottle', 12.00, 42, NULL, 43, 1, 22, 1, 1, 2, '0', 1, '0', NULL, NULL, NULL, 'TEST', '2021-02-20 12:53:23', 'TEST', '0', '0', NULL, NULL, NULL, NULL, NULL, '2021-02-10 15:39:45', '2021-02-20 12:53:36', '2021-02-20 12:53:36'),
(19, 113, 'Test Product', 'Benelux Plastic Button Bag  (Set Of 20, Multicolor)', 260.00, 42, NULL, 43, 11, 37, 1, 1, 1, '0', 1, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, '2021-02-19 05:43:28', '2021-02-19 12:44:28', NULL),
(20, 114, 'shart', 'mlkxfcmvgpfdjkgpo', 2000.00, 3, NULL, 15, 2, 45, 1, 1, 1, '0', 1, '0', NULL, NULL, NULL, NULL, NULL, 'test', '0', '0', NULL, NULL, NULL, NULL, NULL, '2021-02-19 12:33:23', '2021-02-20 21:12:17', '2021-02-20 21:12:17'),
(21, 71, 'Mobile for sale', 'Mobile for sale', 1235866.00, 3, NULL, 15, 10, 34, 1, 1, 1, '0', 1, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, '2021-02-20 11:10:11', '2021-02-20 18:11:06', '2021-02-24 20:43:59'),
(22, 1, 'সৌন্দর্য', 'test', 55596.00, 33, NULL, 44, 2, 45, 1, 1, 1, '0', 1, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, '2021-02-22 08:03:11', '2021-02-22 15:04:12', NULL),
(24, 71, 'Edubook', 'testbook', 990123.00, 31, NULL, 46, 12, 33, 1, 1, 1, '0', 1, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, '2021-02-22 13:11:42', '2021-02-22 20:14:07', '2021-02-24 20:32:50'),
(25, 111, 'Light', 'testmoe', 223355.00, 26, NULL, 47, 3, 41, 1, 1, 1, '0', 1, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, '2021-02-22 13:31:17', '2021-02-22 20:31:58', NULL),
(26, 75, 'ফ্যাশন', 'test mode', 223355.00, 28, NULL, 48, 8, 35, 1, 1, 1, '0', 1, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, '2021-02-22 13:44:14', '2021-02-22 20:45:45', '2021-02-22 20:49:24'),
(27, 75, 'ফ্যাশন', 'test mde', 2222.00, 28, NULL, 48, 16, 29, 1, 1, 1, '0', 1, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, '2021-02-22 13:50:16', '2021-02-22 20:51:08', NULL),
(28, 112, 'furn', 'testmode', 3659.00, 29, NULL, 50, 12, 33, 1, 1, 1, '0', 1, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, '2021-02-22 13:58:43', '2021-02-22 20:59:20', NULL),
(29, 103, 'household', 'testmoe', 22222.00, 30, NULL, 51, 14, 30, 1, 1, 1, '0', 1, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, '2021-02-22 14:16:53', '2021-02-22 21:17:29', NULL),
(30, 108, 'Apple 12 pro', 'This product is good condition like new', 50000.00, 3, NULL, 15, 5, 39, 1, 1, 1, '0', 1, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, '2021-02-22 22:29:27', '2021-02-23 05:30:29', NULL),
(31, 108, 'Skoda', 'This is best mini SUV in word', 2000000.00, 5, NULL, 17, 5, 39, 1, 1, 1, '0', 1, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, '2021-02-22 22:54:58', '2021-02-23 05:55:37', NULL),
(39, 120, 'Lamborghini', 'This car only use in 1 yr some months and approx 2500 km', 15000000.00, 5, NULL, 17, 4, 40, 1, 1, 1, '0', 1, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, '2021-02-25 02:49:35', '2021-02-25 09:50:57', NULL),
(52, 125, 'Mobile test add', 'Test', 22556.00, 3, NULL, 15, 5, 39, 1, 1, 1, '0', 1, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, '2021-02-25 15:32:14', '2021-02-25 22:32:42', NULL),
(56, 122, 'ফ্যাশন', 'test', 44444.00, 28, NULL, 48, 25, 53, 1, 1, 1, '0', 1, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, '2021-02-27 03:38:58', '2021-03-17 07:23:43', NULL),
(57, 122, 'Apartment for sale', 'test', 444433.00, 26, NULL, 47, 25, 53, 1, 1, 1, '0', 1, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, '2021-02-27 03:39:45', '2021-03-17 13:18:23', NULL),
(60, 121, 'TechHark 12 Pcs New Born Baby Chu Chu Bath Toys', 'TechHark 12 Pcs New Born Baby Chu Chu Bath Toys With BPA Free Non-Toxic Bath Toy  (Multicolor)', 100.00, 33, NULL, 44, 25, 53, 1, 1, 1, '0', 1, '0', NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', 22.6899366, 75.8485499, 'Fakhri Manzil, Badri Baug Colony, Lokmanya Nagar, Indore, Madhya Pradesh 452009, India', NULL, NULL, '2021-03-10 05:14:27', NULL, NULL),
(61, 121, 'Printed Men Hooded Neck Orange, White, Black T-Shirt', 'Printed Men Hooded Neck Orange, White, Black T-Shirt', 100.00, 5, NULL, 21, 25, 53, 1, 1, 1, '0', 1, '0', NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', 22.6899366, 75.8485499, 'Fakhri Manzil, Badri Baug Colony, Lokmanya Nagar, Indore, Madhya Pradesh 452009, India', NULL, NULL, '2021-03-10 05:18:57', NULL, NULL),
(63, 71, 'test', 'helloooo', 269879.00, 33, NULL, 44, 36, 61, 1, 1, 1, '0', 1, '0', NULL, NULL, NULL, NULL, NULL, NULL, '', '', 24.4920094, 54.3795267, '18 ???????????? - Al ZahiyahE16-01 - Abu Dhabi - United Arab Emirates', '', 'a:0:{}', '2021-03-18 05:08:29', '2021-03-18 12:09:20', NULL),
(64, 71, 'tests', 'mobile for sale', 25690.00, 3, NULL, 15, 24, 63, 1, 1, 1, '0', 1, '0', NULL, NULL, NULL, NULL, NULL, NULL, '', '', 24.4920094, 54.3795267, '18 ???????????? - Al ZahiyahE16-01 - Abu Dhabi - United Arab Emirates', '', 'a:1:{i:0;s:10:\"0569901799\";}', '2021-03-19 13:09:12', '2021-03-19 20:09:53', NULL),
(65, 71, 'Mobile for Sellss', 'Mobile for Sales', 15897.00, 3, NULL, 15, 24, 70, 1, 1, 1, '0', 1, '0', NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', 24.4920094, 54.3795267, '18 ???????????? - Al ZahiyahE16-01 - Abu Dhabi - United Arab Emirates', '', 'a:1:{i:0;s:10:\"0527104084\";}', '2021-03-19 13:21:36', '2021-03-19 20:22:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ad_images`
--

CREATE TABLE `ad_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `ad_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `is_watermark` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ad_images`
--

INSERT INTO `ad_images` (`id`, `ad_id`, `name`, `is_watermark`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'hNecHFkE1K.1612616781.jpeg', '0', '2021-02-06 14:06:21', NULL, NULL),
(2, 1, 'NC96dB1DKD.1612616781.jpeg', '0', '2021-02-06 14:06:21', NULL, NULL),
(3, 1, 'yOs1K7Npv3.1612616781.jpeg', '0', '2021-02-06 14:06:21', NULL, NULL),
(4, 1, 'u5EC6rQIZk.1612616781.jpg', '0', '2021-02-06 14:06:21', NULL, NULL),
(5, 2, 'cYa02ZjOok.1612620904.jpg', '1', '2021-02-06 15:15:30', NULL, NULL),
(6, 3, '5LkqVyk1cd.1612636516.jpg', '0', '2021-02-06 19:36:46', NULL, NULL),
(7, 3, 'YLP5QfenYS.1612636579.jpg', '0', '2021-02-06 19:36:46', NULL, NULL),
(8, 3, 'f72SWeCz6J.1612636587.jpg', '0', '2021-02-06 19:36:46', NULL, NULL),
(9, 3, 'OBkupAotqC.1612636601.jpg', '0', '2021-02-06 19:36:46', NULL, NULL),
(10, 4, 'CMyXFjFP5P.1612780361.jpeg', '1', '2021-02-08 11:32:41', NULL, NULL),
(11, 4, 'Tw6DEbkfur.1612780361.jpeg', '1', '2021-02-08 11:32:41', NULL, NULL),
(12, 4, 'Zq1IlMTb4G.1612780361.jpeg', '1', '2021-02-08 11:32:41', NULL, NULL),
(13, 9, 'M2BWSKxouJ.1612780680.jpeg', '0', '2021-02-08 11:38:00', NULL, NULL),
(14, 9, 'Csr3S1a2KZ.1612780680.jpeg', '0', '2021-02-08 11:38:00', NULL, NULL),
(15, 9, 'lduOYQRoZa.1612780680.jpeg', '0', '2021-02-08 11:38:00', NULL, NULL),
(17, 11, 'PwRN2t5DhZ.1612849595.jpg', '0', '2021-02-09 06:46:35', NULL, NULL),
(18, 12, 'f3ejfSJuB4.1612849596.jpg', '0', '2021-02-09 06:46:36', NULL, NULL),
(19, 13, 'VzweVxedwS.1612937893.jpg', '1', '2021-02-10 07:18:21', NULL, NULL),
(20, 14, 'a30PWo5jYj.1612943125.jpeg', '1', '2021-02-10 08:45:25', NULL, NULL),
(21, 14, 'KHeIo3fpIO.1612943125.jpeg', '1', '2021-02-10 08:45:25', NULL, NULL),
(22, 14, 'zD9qRpcMsd.1612943125.jpeg', '1', '2021-02-10 08:45:25', NULL, NULL),
(25, 16, 'oU2cM13xmU.1612524215.jpg', '0', '2021-02-10 15:39:45', NULL, NULL),
(26, 19, '9B61GFRlhw.1613738608.jpeg', '0', '2021-02-19 05:43:28', NULL, NULL),
(27, 20, 'gEML2LbJqq.1613763203.jpg', '0', '2021-02-19 12:33:23', NULL, NULL),
(28, 21, 'heNXbmpm4o.1613844611.png', '1', '2021-02-20 11:10:11', NULL, NULL),
(29, 22, '4UBkjWQ1NJ.1614006191.png', '1', '2021-02-22 08:03:12', NULL, NULL),
(32, 24, '3QP3w9nhkJ.1614024702.png', '1', '2021-02-22 13:11:42', NULL, NULL),
(33, 24, 'QyfACI4qgb.1614024702.png', '1', '2021-02-22 13:11:42', NULL, NULL),
(34, 24, '8TeO3Ak3FM.1614024702.png', '1', '2021-02-22 13:11:42', NULL, NULL),
(35, 24, 'Tc7NxPVkAI.1614024702.png', '1', '2021-02-22 13:11:42', NULL, NULL),
(36, 25, 'HtuekHB67v.1614025877.jpg', '1', '2021-02-22 13:31:17', NULL, NULL),
(37, 26, 'iAe2ejM4LQ.1614026654.jpg', '1', '2021-02-22 13:44:14', NULL, NULL),
(38, 27, '77VtU4HhR4.1614027016.jpg', '1', '2021-02-22 13:50:16', NULL, NULL),
(39, 28, 'eqaaIlvmEW.1614027523.jpg', '1', '2021-02-22 13:58:43', NULL, NULL),
(40, 29, 'yP8q2OFAHk.1614028613.jpg', '1', '2021-02-22 14:16:53', NULL, NULL),
(41, 30, 'SAwzEyI71B.1614058151.jpg', '0', '2021-02-22 22:29:27', NULL, NULL),
(42, 30, 'T0vt3UsS5A.1614058157.jpg', '0', '2021-02-22 22:29:27', NULL, NULL),
(43, 30, 't1wVBmElGL.1614058164.jpg', '0', '2021-02-22 22:29:27', NULL, NULL),
(44, 31, '75AvtlvLpb.1614059526.jpg', '0', '2021-02-22 22:54:58', NULL, NULL),
(45, 31, 'iasHqkGIYl.1614059535.jpg', '0', '2021-02-22 22:54:58', NULL, NULL),
(46, 31, 'dTWnFxpbHe.1614059541.jpg', '0', '2021-02-22 22:54:58', NULL, NULL),
(47, 39, 'blz5GPCSDR.1614246561.jpg', '1', '2021-02-25 02:49:35', NULL, NULL),
(48, 39, '0gelmBwfRL.1614246568.jpg', '1', '2021-02-25 02:49:35', NULL, NULL),
(49, 39, 'NBnDdcLqjE.1614246573.jpg', '1', '2021-02-25 02:49:35', NULL, NULL),
(68, 52, 'YLfgipYzV5.1614292304.jpg', '1', '2021-02-25 15:32:14', NULL, NULL),
(69, 52, 'BbON1CWI8G.1614292310.jpg', '1', '2021-02-25 15:32:14', NULL, NULL),
(70, 52, 'M0ZOR4ClTL.1614292315.jpg', '1', '2021-02-25 15:32:14', NULL, NULL),
(71, 52, 'spDFTv3XRB.1614292322.jpg', '1', '2021-02-25 15:32:14', NULL, NULL),
(72, 52, 'EFeokIbFIa.1614292330.jpg', '1', '2021-02-25 15:32:14', NULL, NULL),
(76, 56, 'fGuHW6uTl2.1614422338.jpg', '1', '2021-02-27 03:38:58', NULL, NULL),
(77, 57, 'uPKuRStp2X.1614422385.jpg', '1', '2021-02-27 03:39:45', NULL, NULL),
(80, 60, 'XrjrZ3YYvA.1615378467.jpeg', '0', '2021-03-10 05:14:27', NULL, NULL),
(81, 61, 'MGKw4VPdfA.1615378737.jpeg', '0', '2021-03-10 05:18:57', NULL, NULL),
(82, 63, 'Q4NATGTDtn.1616069309.png', '1', '2021-03-18 05:08:29', NULL, NULL),
(83, 63, 'iSc4qRGgWS.1616069309.png', '1', '2021-03-18 05:08:29', NULL, NULL),
(84, 63, 'LU9WAZjwkZ.1616069309.png', '1', '2021-03-18 05:08:29', NULL, NULL),
(85, 63, 'lD7hcR43Iu.1616069309.png', '1', '2021-03-18 05:08:29', NULL, NULL),
(86, 63, 'tpzqB7d6x0.1616069309.png', '1', '2021-03-18 05:08:29', NULL, NULL),
(87, 63, 'aJpeHeNF96.1616069309.png', '1', '2021-03-18 05:08:29', NULL, NULL),
(88, 64, 'cQlO2uusZN.1616184552.png', '1', '2021-03-19 13:09:12', NULL, NULL),
(89, 64, '7E2QEQGuOc.1616184552.png', '1', '2021-03-19 13:09:12', NULL, NULL),
(90, 64, '6ydqks3vng.1616184552.png', '1', '2021-03-19 13:09:12', NULL, NULL),
(91, 64, '9DySR4u26r.1616184552.png', '1', '2021-03-19 13:09:12', NULL, NULL),
(92, 64, 'RTc5I1d3e9.1616184552.png', '1', '2021-03-19 13:09:12', NULL, NULL),
(93, 64, 'M4VLXSX8Pk.1616184552.png', '1', '2021-03-19 13:09:12', NULL, NULL),
(94, 65, 'YE7PnYtgiC.1616185296.png', '1', '2021-03-19 13:21:36', NULL, NULL),
(95, 65, 'brZSqrxscG.1616185296.png', '1', '2021-03-19 13:21:36', NULL, NULL),
(96, 65, 'PjraN7reMa.1616185296.png', '1', '2021-03-19 13:21:36', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ad_values`
--

CREATE TABLE `ad_values` (
  `ad_id` int(10) UNSIGNED NOT NULL,
  `field_id` bigint(20) UNSIGNED NOT NULL,
  `option_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `value` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ad_values`
--

INSERT INTO `ad_values` (`ad_id`, `field_id`, `option_id`, `value`) VALUES
(1, 35, 'Tata', 'Tata'),
(1, 38, 'New', 'New'),
(1, 34, 'Patrol', 'Patrol'),
(1, 36, '2020', '2020'),
(1, 37, NULL, '[\"Automatic\"]'),
(2, 41, 'Samsung', 'Samsung'),
(2, 36, NULL, ''),
(2, 40, '8 GB', '8 GB'),
(3, 41, 'Oppo', 'Oppo'),
(3, 36, NULL, ''),
(3, 40, '6 GB', '6 GB'),
(4, 41, 'Mi xiaomi', 'Mi xiaomi'),
(4, 36, '2020', '2020'),
(4, 40, '64 GB', '64 GB'),
(11, 48, '50', '50'),
(11, 49, '12', '12'),
(12, 48, '50', '50'),
(12, 49, '12', '12'),
(16, 48, NULL, ''),
(16, 49, NULL, ''),
(19, 48, '20 mm', '20 mm'),
(19, 49, '20 mm', '20 mm'),
(20, 41, 'Samsung', 'Samsung'),
(20, 36, 's4', 's4'),
(20, 40, '32 GB', '32 GB'),
(21, 41, 'Apple', 'Apple'),
(21, 36, '2021', '2021'),
(21, 40, '2 GB', '2 GB'),
(24, 54, 'educationbook', 'educationbook'),
(25, 65, 'light', 'light'),
(26, 66, 'makupbox', 'makupbox'),
(27, 66, 'makupbox', 'makupbox'),
(28, 69, 'chir', 'chir'),
(29, 70, 'phillo', 'phillo'),
(30, 41, 'Apple', 'Apple'),
(30, 36, NULL, ''),
(30, 40, '8 GB', '8 GB'),
(31, 35, 'Kia', 'Kia'),
(31, 38, 'Used', 'Used'),
(31, 34, 'Patrol', 'Patrol'),
(31, 36, '2019', '2019'),
(31, 37, NULL, '[\"Automatic\"]'),
(39, 35, 'BMW', 'BMW'),
(39, 38, 'Used', 'Used'),
(39, 34, 'Patrol', 'Patrol'),
(39, 36, '2019', '2019'),
(39, 37, NULL, '[\"Automatic\"]'),
(52, 41, 'Apple', 'Apple'),
(52, 36, NULL, ''),
(52, 40, '6 GB', '6 GB'),
(56, 66, 'ring', 'ring'),
(57, 65, 'light', 'light'),
(60, 0, '1', '1'),
(61, 0, '1', '1'),
(64, 90, 'Jelly Bean', 'Jelly Bean'),
(64, 41, 'Apple', 'Apple'),
(64, 89, '1 GB', '1 GB'),
(64, 40, '2 GB', '2 GB'),
(65, 90, 'KitKat', 'KitKat'),
(65, 41, 'Oppo', 'Oppo'),
(65, 89, '2 GB', '2 GB'),
(65, 40, '4 GB', '4 GB');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `title_bn` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `is_active` enum('0','1') DEFAULT '1',
  `image` varchar(250) DEFAULT NULL,
  `posting_allowance` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `title`, `title_bn`, `is_active`, `image`, `posting_allowance`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, NULL, 'Mobile', 'মুঠোফোন', '1', 'HQdEr9orZp.1602836647.png', 1, '2020-10-14 13:02:54', '2020-10-16 08:24:07', NULL),
(4, NULL, 'Property', 'সম্পত্তি', '1', 'Vt6B81Xuuo.1602836634.png', 1, '2020-10-14 13:02:54', '2020-10-16 08:23:54', NULL),
(5, NULL, 'Vehicle', 'যানবাহন', '1', 'aM4SE2IcJY.1602836618.png', 7, '2020-10-14 13:02:59', '2021-03-17 17:31:12', NULL),
(6, NULL, 'Job', 'চাকরি', '1', 'eoH6VQoCDi.1602836542.png', 1, '2020-10-14 13:02:59', '2021-02-06 19:05:56', NULL),
(15, 3, 'Mobile Phones', 'মোবাইল ফোন গুলো', '1', NULL, 1, '2020-10-15 10:50:01', '2020-10-15 10:50:01', NULL),
(16, 3, 'Mobile Phones Accessories', 'মোবাইল ফোন এক্সেসরিজ', '1', NULL, 1, '2020-10-15 10:51:03', '2020-10-15 10:51:03', NULL),
(17, 5, 'Car', 'গাড়ি', '1', NULL, 1, '2020-10-15 10:51:52', '2020-10-15 10:51:52', NULL),
(18, 5, 'Motorbikes & Scooters', 'মোটরবাইক ও স্কুটার', '1', NULL, 1, '2020-10-15 10:52:14', '2020-10-15 10:52:14', NULL),
(19, 5, 'Bicycles & Three Wheelers', 'বাইসাইকেল ও থ্রি হুইলার', '1', NULL, 1, '2020-10-15 10:52:42', '2020-10-15 10:52:42', NULL),
(20, 5, 'Trucks, Vans & Buses', 'ট্রাক, ভ্যান ও বাস', '1', NULL, 1, '2020-10-15 10:53:09', '2020-10-15 10:53:09', NULL),
(21, 5, 'Auto Parts & Accessories', 'অটো পার্টস এবং আনুষাঙ্গিক', '1', NULL, 1, '2020-10-15 10:53:46', '2020-10-15 10:53:46', NULL),
(22, 3, 'Mobile Phone Services', 'মোবাইল ফোন পরিষেবা', '1', NULL, 1, '2020-10-15 10:54:42', '2020-10-15 10:54:42', NULL),
(23, 4, 'Apartments & Flats', 'অ্যাপার্টমেন্ট ও ফ্ল্যাটস', '1', NULL, 1, '2020-10-15 10:55:11', '2020-10-15 10:55:11', NULL),
(24, 4, 'New Developments', 'নতুন উন্নয়ন', '1', NULL, 1, '2020-10-15 10:55:37', '2020-10-15 10:55:37', NULL),
(25, 4, 'Houses', 'বাড়িগুলি', '1', NULL, 1, '2020-10-15 10:56:03', '2020-10-15 10:56:03', NULL),
(26, NULL, 'Electronic', 'বৈদ্যুতিক', '1', 'XVw9IaTXRW.1602836706.png', 1, '2020-10-16 08:24:55', '2020-10-16 08:25:06', NULL),
(27, NULL, 'Community', 'সম্প্রদায়', '1', '1kr4XsJs69.1602836781.png', 1, '2020-10-16 08:26:21', '2020-10-16 08:26:21', NULL),
(28, NULL, 'Fashion', 'ফ্যাশন', '1', 'v99AvPzdru.1602836800.png', 1, '2020-10-16 08:26:40', '2020-10-16 08:26:40', NULL),
(29, NULL, 'Furniture', 'আসবাবপত্র', '1', 'lLS6MXfFBT.1602836832.png', 1, '2020-10-16 08:27:12', '2020-10-16 08:27:12', NULL),
(30, NULL, 'Household', 'গৃহস্থালীর', '1', 'fCl2lrevwq.1602836855.png', 1, '2020-10-16 08:27:35', '2020-10-16 08:27:35', NULL),
(31, NULL, 'Education', 'শিক্ষা', '1', 'z1LgiE0sHm.1602836886.png', 3, '2020-10-16 08:28:06', '2021-02-22 20:05:59', NULL),
(32, NULL, 'Services', 'সেবা', '1', '0GlT4bwiAp.1602836922.png', 1, '2020-10-16 08:28:42', '2020-10-16 08:28:42', NULL),
(33, NULL, 'Beauty', 'সৌন্দর্য', '1', 'BbNqSherpE.1602836963.png', 7, '2020-10-16 08:29:23', '2020-11-03 11:58:19', NULL),
(34, 33, '1', '1', '1', NULL, 1, '2021-02-02 06:12:56', '2021-02-02 06:13:01', '2021-02-02 06:13:01'),
(35, NULL, 'information of technology', 'তথ্য প্রযুক্তি', '1', 'GWtDh1hTaJ.1612531324.jpg', 1, '2021-02-05 13:22:04', '2021-02-06 15:27:39', '2021-02-06 15:27:39'),
(36, 35, 'technology', 'প্রযুক্তি', '1', NULL, 1, '2021-02-05 13:35:19', '2021-02-05 14:13:30', '2021-02-05 14:13:30'),
(37, 6, 'IT Executive', 'আইটি এক্সিকিউটিভ', '1', NULL, 1, '2021-02-06 18:59:05', '2021-02-06 19:04:25', '2021-02-06 19:04:25'),
(38, 6, 'IT Support', 'আইটি সমর্থন', '1', NULL, 1, '2021-02-06 18:59:44', '2021-02-06 19:04:31', '2021-02-06 19:04:31'),
(39, 6, 'IT Executive', 'আইটি এক্সিকিউটিভ', '1', NULL, 1, '2021-02-06 19:05:07', '2021-02-06 19:06:05', '2021-02-06 19:06:05'),
(40, 6, 'IT Executive', 'আইটি সমর্থন', '1', NULL, 1, '2021-02-06 19:05:22', '2021-02-06 19:06:13', '2021-02-06 19:06:13'),
(41, 6, 'IT Executive', 'আইটি সমর্থন', '1', NULL, 1, '2021-02-06 19:07:27', '2021-02-06 19:08:13', '2021-02-06 19:08:13'),
(42, NULL, 'bottle', 'bottle', '1', 'fJHEY3qtBA.1612847780.jpg', 2, '2021-02-09 05:16:20', '2021-02-23 21:35:08', '2021-02-23 21:35:08'),
(43, 42, 'plastic bottle', 'plastic bottle', '1', NULL, 1, '2021-02-09 05:18:54', '2021-02-09 05:18:54', NULL),
(44, 33, 'beauty', 'সৌন্দর্য', '1', NULL, 1, '2021-02-22 15:02:13', '2021-02-22 15:02:13', NULL),
(45, 31, 'book', 'বই', '1', NULL, 1, '2021-02-22 20:05:16', '2021-02-22 20:05:43', '2021-02-22 20:05:43'),
(46, 31, 'book', 'বই', '1', NULL, 1, '2021-02-22 20:07:18', '2021-02-22 20:07:18', NULL),
(47, 26, 'Elect', 'নির্বাচিত', '1', NULL, 1, '2021-02-22 20:27:50', '2021-02-22 20:27:50', NULL),
(48, 28, 'Fashion', 'ফ্যাশন', '1', NULL, 1, '2021-02-22 20:38:29', '2021-02-22 20:38:29', NULL),
(49, 29, 'Furniture', 'আসবাবপত্র', '1', NULL, 1, '2021-02-22 20:55:21', '2021-02-22 20:57:00', '2021-02-22 20:57:00'),
(50, 29, 'Furniture', 'আসবাবপত্র', '1', NULL, 1, '2021-02-22 20:57:16', '2021-02-22 20:57:16', NULL),
(51, 30, 'household', 'গৃহস্থালীর', '1', NULL, 1, '2021-02-22 21:11:54', '2021-02-22 21:11:54', NULL),
(52, NULL, 'Test', 'test', '1', 'cDKHqXPuKl.1615923256.jpg', 1, '2021-03-16 19:34:16', '2021-03-16 19:34:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_field`
--

CREATE TABLE `category_field` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `field_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_field`
--

INSERT INTO `category_field` (`category_id`, `field_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(17, 35, '2021-02-05 11:44:47', NULL, NULL),
(17, 38, '2021-02-05 11:44:47', NULL, NULL),
(17, 34, '2021-02-05 11:44:47', NULL, NULL),
(17, 36, '2021-02-05 11:44:47', NULL, NULL),
(17, 37, '2021-02-05 11:44:47', NULL, NULL),
(24, 43, '2021-02-05 11:42:42', NULL, NULL),
(24, 42, '2021-02-05 11:42:42', NULL, NULL),
(24, 44, '2021-02-05 11:42:42', NULL, NULL),
(23, 43, '2021-02-05 11:42:58', NULL, NULL),
(23, 42, '2021-02-05 11:42:58', NULL, NULL),
(23, 44, '2021-02-05 11:42:58', NULL, NULL),
(25, 43, '2021-02-05 11:43:13', NULL, NULL),
(25, 42, '2021-02-05 11:43:13', NULL, NULL),
(25, 44, '2021-02-05 11:43:13', NULL, NULL),
(41, 47, '2021-02-06 20:07:27', NULL, NULL),
(43, 48, '2021-02-09 06:18:54', NULL, NULL),
(43, 49, '2021-02-09 06:18:54', NULL, NULL),
(45, 54, '2021-02-22 13:05:16', NULL, NULL),
(46, 54, '2021-02-22 13:07:18', NULL, NULL),
(47, 65, '2021-02-22 13:27:50', NULL, NULL),
(48, 66, '2021-02-22 13:38:29', NULL, NULL),
(50, 69, '2021-02-22 13:57:16', NULL, NULL),
(51, 70, '2021-02-22 14:11:54', NULL, NULL),
(15, 90, '2021-03-11 03:32:19', NULL, NULL),
(15, 41, '2021-03-11 03:32:19', NULL, NULL),
(15, 89, '2021-03-11 03:32:19', NULL, NULL),
(15, 40, '2021-03-11 03:32:19', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `chat_room_id` varchar(255) NOT NULL DEFAULT '',
  `ad_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `is_read` enum('0','1') DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `chat_room_id`, `ad_id`, `sender_id`, `receiver_id`, `message`, `is_read`, `created_at`, `updated_at`, `deleted_at`) VALUES
(154, '61-106-121', 61, 106, 121, 'hello', '1', '2021-03-11 06:01:16', NULL, NULL),
(155, '61-106-121', 61, 121, 106, 'hii\n', '1', '2021-03-11 06:01:25', NULL, NULL),
(156, '61-106-121', 61, 106, 121, 'i what to purchaces this product', '1', '2021-03-11 06:01:46', NULL, NULL),
(157, '61-106-121', 61, 121, 106, 'good\n', '1', '2021-03-11 06:01:52', NULL, NULL),
(158, '61-106-121', 61, 121, 106, 'to kharid lo kis ne mana kar diya\n', '1', '2021-03-11 06:02:09', NULL, NULL),
(159, '61-106-121', 61, 106, 121, 'shi hai yrrr\n', '1', '2021-03-11 06:03:19', NULL, NULL),
(160, '60-65-121', 60, 65, 121, 'Ghjk', '1', '2021-03-11 06:04:46', NULL, NULL),
(161, '60-65-121', 60, 121, 65, 'ha sri boliye\n', '1', '2021-03-11 06:05:48', NULL, NULL),
(162, '60-65-121', 60, 65, 121, 'Hshd', '1', '2021-03-11 06:06:08', NULL, NULL),
(163, '60-65-121', 60, 65, 121, 'Jdhd', '1', '2021-03-11 06:06:21', NULL, NULL),
(164, '60-65-121', 60, 121, 65, 'ha sir\n', '1', '2021-03-11 06:06:26', NULL, NULL),
(165, '60-65-121', 60, 65, 121, 'Bsbd', '1', '2021-03-11 06:06:31', NULL, NULL),
(166, '60-65-121', 60, 121, 65, 'shi hai\n', '1', '2021-03-11 06:06:48', NULL, NULL),
(167, '60-65-121', 60, 121, 65, 'ab kya karu sir\n', '1', '2021-03-11 06:06:58', NULL, NULL),
(168, '60-65-121', 60, 65, 121, 'Shi hai', '1', '2021-03-11 06:06:58', NULL, NULL),
(169, '60-65-121', 60, 121, 65, 'shi hai\n', '1', '2021-03-11 06:07:09', NULL, NULL),
(170, '60-65-121', 60, 121, 65, 'notification\n', '1', '2021-03-11 06:07:23', NULL, NULL),
(171, '61-106-121', 61, 106, 121, 'Hiii sir\n', '1', '2021-03-14 22:50:39', NULL, NULL),
(172, '61-106-121', 61, 106, 121, 'hhh\n', '1', '2021-03-14 22:50:57', NULL, NULL),
(173, '60-65-121', 60, 65, 121, 'Shehj', '1', '2021-03-14 22:51:05', NULL, NULL),
(174, '60-106-121', 60, 106, 121, 'fdgf\n', '1', '2021-03-14 22:51:39', NULL, NULL),
(175, '60-106-121', 60, 106, 121, 'ji\n', '1', '2021-03-14 22:51:48', NULL, NULL),
(176, '61-65-121', 61, 65, 121, 'Dhhdh', '1', '2021-03-14 22:52:08', NULL, NULL),
(177, '61-65-121', 61, 121, 65, 'hiii sir\n', '1', '2021-03-14 22:52:31', NULL, NULL),
(178, '61-65-121', 61, 65, 121, 'Ndhdn', '1', '2021-03-14 22:52:38', NULL, NULL),
(179, '61-65-121', 61, 121, 65, 'nahi aaa\n', '1', '2021-03-14 22:52:40', NULL, NULL),
(180, '61-65-121', 61, 65, 121, 'Hio', '1', '2021-03-14 22:52:45', NULL, NULL),
(181, '61-65-121', 61, 121, 65, 'ab\n', '1', '2021-03-14 22:52:49', NULL, NULL),
(182, '61-65-121', 61, 65, 121, 'Dakho to', '1', '2021-03-14 22:52:57', NULL, NULL),
(183, '61-65-121', 61, 121, 65, 'hello sir\n', '1', '2021-03-14 22:55:02', NULL, NULL),
(184, '61-65-121', 61, 121, 65, 'hii sir\n', '1', '2021-03-14 22:55:23', NULL, NULL),
(185, '60-65-121', 60, 65, 121, 'Vbbj', '1', '2021-03-14 22:55:30', NULL, NULL),
(186, '61-65-121', 61, 121, 65, 'thik hai sir me dekhta hu\n', '1', '2021-03-14 22:56:37', NULL, NULL),
(187, '61-106-121', 61, 121, 106, 'gggg', '1', '2021-03-14 22:56:45', NULL, NULL),
(188, '61-106-121', 61, 121, 106, 'hhhhh', '1', '2021-03-14 22:56:59', NULL, NULL),
(189, '61-106-121', 61, 121, 106, 'koi nhi\n', '1', '2021-03-14 22:57:18', NULL, NULL),
(190, '61-106-121', 61, 121, 106, 'shiv\n', '1', '2021-03-14 22:57:20', NULL, NULL),
(191, '61-65-121', 61, 65, 121, 'Hhj', '1', '2021-03-14 22:58:02', NULL, NULL),
(192, '61-106-121', 61, 121, 106, 'hello sir :)\n', '1', '2021-03-14 22:59:39', NULL, NULL),
(193, '61-106-121', 61, 121, 106, '\n', '1', '2021-03-14 22:59:40', NULL, NULL),
(194, '61-65-121', 61, 65, 121, 'Hshd', '1', '2021-03-14 23:00:05', NULL, NULL),
(195, '61-106-121', 61, 121, 106, 'hiii\n', '1', '2021-03-14 23:00:12', NULL, NULL),
(196, '60-65-121', 60, 65, 121, 'Hehe', '1', '2021-03-14 23:00:21', NULL, NULL),
(197, '61-65-121', 61, 121, 65, 'hiii\n', '1', '2021-03-14 23:00:50', NULL, NULL),
(198, '61-65-121', 61, 65, 121, 'Hello', '1', '2021-03-14 23:01:03', NULL, NULL),
(199, '61-65-121', 61, 121, 65, 'ha bzir bliye\n', '1', '2021-03-14 23:01:10', NULL, NULL),
(200, '61-106-121', 61, 106, 121, 'Hello', '1', '2021-03-16 03:49:06', NULL, NULL),
(201, '61-106-121', 61, 106, 121, 'Hiii', '1', '2021-03-16 03:49:14', NULL, NULL),
(202, '61-106-121', 61, 106, 121, 'Hiiiii', '1', '2021-03-16 03:49:16', NULL, NULL),
(203, '61-106-121', 61, 106, 121, 'Hello sir', '1', '2021-03-16 03:49:28', NULL, NULL),
(204, '61-106-121', 61, 121, 106, 'hug kjhj\n', '1', '2021-03-16 03:49:37', NULL, NULL),
(205, '61-106-121', 61, 121, 106, '\n', '1', '2021-03-16 03:49:37', NULL, NULL),
(206, '61-106-121', 61, 121, 106, 'gfghfghfghfg\n', '1', '2021-03-16 03:49:43', NULL, NULL),
(207, '61-106-121', 61, 121, 106, '\n', '1', '2021-03-16 03:49:49', NULL, NULL),
(208, '61-106-121', 61, 121, 106, 'jihiiojoijopk\n', '1', '2021-03-16 03:49:58', NULL, NULL),
(209, '61-106-121', 61, 121, 106, 'mjjbnjbjk\n', '1', '2021-03-16 03:50:04', NULL, NULL),
(210, '60-106-121', 60, 106, 121, '.', '1', '2021-03-16 03:50:20', NULL, NULL),
(211, '61-106-121', 61, 121, 106, '\n', '1', '2021-03-16 03:50:30', NULL, NULL),
(212, '61-106-121', 61, 121, 106, '\n', '1', '2021-03-16 03:50:31', NULL, NULL),
(213, '61-106-121', 61, 121, 106, '\n', '1', '2021-03-16 03:50:32', NULL, NULL),
(214, '61-106-121', 61, 121, 106, '\n', '1', '2021-03-16 03:50:32', NULL, NULL),
(215, '61-106-121', 61, 121, 106, '\n', '1', '2021-03-16 03:50:32', NULL, NULL),
(216, '61-106-121', 61, 121, 106, '\n', '1', '2021-03-16 03:50:32', NULL, NULL),
(217, '61-106-121', 61, 121, 106, '\n', '1', '2021-03-16 03:50:32', NULL, NULL),
(218, '61-106-121', 61, 121, 106, 'lkorem ipsum\n', '1', '2021-03-16 03:51:02', NULL, NULL),
(219, '61-106-121', 61, 121, 106, 'to kya huya\n', '1', '2021-03-16 03:51:09', NULL, NULL),
(220, '61-106-121', 61, 121, 106, 'mujeh nhi pata uyrrr\n', '1', '2021-03-16 03:51:15', NULL, NULL),
(221, '61-106-121', 61, 121, 106, 'ha shi hai\n', '1', '2021-03-16 03:51:18', NULL, NULL),
(222, '61-106-121', 61, 121, 106, 'to kya ju\n', '1', '2021-03-16 03:51:20', NULL, NULL),
(223, '61-106-121', 61, 121, 106, 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print\n', '1', '2021-03-16 03:53:35', NULL, NULL),
(224, '61-106-121', 61, 121, 106, 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print', '1', '2021-03-16 03:53:37', NULL, NULL),
(225, '61-106-121', 61, 121, 106, 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print', '1', '2021-03-16 03:53:40', NULL, NULL),
(226, '61-106-121', 61, 121, 106, 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print', '1', '2021-03-16 03:54:12', NULL, NULL),
(227, '61-106-121', 61, 121, 106, 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print\n', '1', '2021-03-16 03:54:27', NULL, NULL),
(228, '61-106-121', 61, 106, 121, 'Ha thik hai', '1', '2021-03-16 03:54:46', NULL, NULL),
(229, '60-106-121', 60, 121, 106, 'dsf', '1', '2021-03-16 05:25:38', NULL, NULL),
(230, '61-106-121', 61, 106, 121, 'Hello', '1', '2021-03-16 05:25:52', NULL, NULL),
(231, '39-1-120', 39, 1, 120, 'hi\n', '1', '2021-03-17 01:26:11', NULL, NULL),
(232, '60-98-121', 60, 98, 121, 'hi\n', '1', '2021-03-17 03:38:07', NULL, NULL),
(233, '56-98-122', 56, 98, 122, 'hi\n', '1', '2021-03-17 03:38:26', NULL, NULL),
(234, '56-98-122', 56, 98, 122, 'hello\n', '1', '2021-03-17 03:43:18', NULL, NULL),
(235, '56-98-122', 56, 122, 98, 'Masum\n', '1', '2021-03-17 03:51:29', NULL, NULL),
(236, '56-98-122', 56, 98, 122, 'hmmm paichi\n', '1', '2021-03-17 03:52:20', NULL, NULL),
(237, '56-98-122', 56, 122, 98, 'notification astase \n', '1', '2021-03-17 03:52:28', NULL, NULL),
(238, '56-98-122', 56, 122, 98, 'jokon message im tissi\n', '1', '2021-03-17 03:52:37', NULL, NULL),
(239, '56-98-122', 56, 98, 122, 'abar dan\n', '1', '2021-03-17 03:52:44', NULL, NULL),
(240, '56-98-122', 56, 122, 98, 'home page  a ja \n', '1', '2021-03-17 03:52:59', NULL, NULL),
(241, '56-98-122', 56, 122, 98, 'massage notification \n', '1', '2021-03-17 03:53:08', NULL, NULL),
(242, '56-98-122', 56, 122, 98, 'check now \n', '1', '2021-03-17 03:53:10', NULL, NULL),
(243, '56-98-122', 56, 122, 98, 'hello\n', '1', '2021-03-17 03:53:30', NULL, NULL),
(244, '56-98-122', 56, 122, 98, 'masum\n', '1', '2021-03-17 03:53:32', NULL, NULL),
(245, '56-71-122', 56, 71, 122, 'Hello Mamun\n', '1', '2021-03-17 04:09:43', NULL, NULL),
(246, '56-71-122', 56, 122, 71, 'Hi', '1', '2021-03-17 04:10:01', NULL, NULL),
(247, '56-71-122', 56, 122, 71, 'How are you', '1', '2021-03-17 04:10:18', NULL, NULL),
(248, '56-71-122', 56, 71, 122, 'im ok and you \n', '1', '2021-03-17 04:10:27', NULL, NULL),
(249, '56-71-122', 56, 71, 122, 'hid\n', '1', '2021-03-17 04:14:27', NULL, NULL),
(250, '56-71-122', 56, 71, 122, 'hi\n', '1', '2021-03-17 04:14:31', NULL, NULL),
(251, '56-71-122', 56, 71, 122, 'hello\n', '1', '2021-03-17 04:15:43', NULL, NULL),
(252, '56-98-122', 56, 122, 98, 'Hello masum ', '1', '2021-03-17 04:18:17', NULL, NULL),
(253, '56-71-122', 56, 71, 122, 'test', '1', '2021-03-17 04:18:41', NULL, NULL),
(254, '56-98-122', 56, 98, 122, 'Hi', '1', '2021-03-17 05:04:12', NULL, NULL),
(255, '56-98-122', 56, 122, 98, 'Hello', '1', '2021-03-17 05:04:36', NULL, NULL),
(256, '56-98-122', 56, 98, 122, 'Ji', '1', '2021-03-17 05:05:45', NULL, NULL),
(257, '56-98-122', 56, 122, 98, 'Test', '1', '2021-03-17 05:06:37', NULL, NULL),
(258, '56-98-122', 56, 122, 98, 'Masum', '1', '2021-03-17 05:06:51', NULL, NULL),
(259, '56-98-122', 56, 122, 98, 'Masum u get notification ', '1', '2021-03-17 05:14:47', NULL, NULL),
(260, '56-98-122', 56, 122, 98, 'Hello', '1', '2021-03-17 05:14:51', NULL, NULL),
(261, '56-98-122', 56, 122, 98, 'Masum', '1', '2021-03-17 05:43:40', NULL, NULL),
(262, '61-106-121', 61, 106, 121, 'hello\n', '1', '2021-03-17 06:28:19', NULL, NULL),
(263, '61-106-121', 61, 106, 121, '\n', '1', '2021-03-17 06:28:20', NULL, NULL),
(264, '61-106-121', 61, 106, 121, 'hi\n', '1', '2021-03-17 06:28:23', NULL, NULL),
(265, '60-106-121', 60, 106, 121, 'Hello', '1', '2021-03-17 10:54:30', NULL, NULL),
(266, '61-106-121', 61, 106, 121, 'Kaise ho', '1', '2021-03-17 10:54:38', NULL, NULL),
(267, '56-122-133', 56, 133, 122, 'Hello\n', '1', '2021-03-17 12:08:48', NULL, NULL),
(268, '56-122-133', 56, 122, 133, 'Hi', '1', '2021-03-17 12:09:09', NULL, NULL),
(269, '56-122-133', 56, 133, 122, 'test\n', '1', '2021-03-17 12:09:29', NULL, NULL),
(270, '63-71-78', 63, 78, 71, 'Hi', '1', '2021-03-18 05:13:17', NULL, NULL),
(271, '63-71-78', 63, 71, 78, 'hello\n', '1', '2021-03-18 05:13:45', NULL, NULL),
(272, '63-71-78', 63, 71, 78, 'hi\n', '1', '2021-03-18 05:13:59', NULL, NULL),
(273, '63-71-78', 63, 78, 71, 'There', '1', '2021-03-18 05:14:30', NULL, NULL),
(274, '63-71-126', 63, 126, 71, 'Helloo', '1', '2021-03-18 05:15:10', NULL, NULL),
(275, '63-71-126', 63, 71, 126, 'hi\n', '1', '2021-03-18 05:15:25', NULL, NULL),
(276, '63-71-126', 63, 126, 71, 'Hellk', '1', '2021-03-18 05:16:43', NULL, NULL),
(277, '42-118-119', 42, 118, 119, 'fdsfsf', '1', '2021-03-19 00:42:28', NULL, NULL),
(278, '42-118-119', 42, 118, 119, 'fsdsf', '1', '2021-03-19 00:42:34', NULL, NULL),
(279, '60-106-121', 60, 106, 121, 'sadfsdf', '1', '2021-03-19 03:57:54', NULL, NULL),
(280, '61-106-121', 61, 106, 121, 'sdfsdf', '1', '2021-03-19 03:58:07', NULL, NULL),
(281, '64-71-126', 64, 126, 71, 'Hi', '1', '2021-03-19 13:17:55', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `title_bn` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `type` enum('city','division') NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `title`, `title_bn`, `type`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Adabor', 'আদাবর থানা', 'city', '1', '2020-10-16 15:05:07', '2021-02-20 12:57:30', '2021-02-20 12:57:30'),
(2, 'Chattogram', 'চট্টগ্রাম', 'city', '1', '2020-10-16 15:05:14', '2021-02-26 18:05:21', '2021-02-26 18:05:21'),
(3, 'Sylhet', 'সিলেট', 'city', '1', '2020-10-16 15:05:14', '2021-02-26 18:11:46', '2021-02-26 18:11:46'),
(4, 'Khulna', 'খুলনা', 'city', '1', '2020-10-16 15:05:14', '2021-02-26 18:11:41', '2021-02-26 18:11:41'),
(5, 'Barishal', 'বরিশাল', 'city', '1', '2020-10-16 15:05:14', '2021-02-26 18:11:51', '2021-02-26 18:11:51'),
(6, 'Rajshahi', 'রাজশাহী', 'city', '1', '2020-10-16 15:05:14', '2021-02-26 18:11:56', '2021-02-26 18:11:56'),
(7, 'Rangpur', 'রংপুর', 'city', '1', '2020-10-16 15:05:14', '2021-02-23 21:34:58', '2021-02-23 21:34:58'),
(8, 'Mymensingh Division', 'ময়মনসিংহ বিভাগ', 'division', '1', '2020-10-16 15:08:00', '2021-02-26 18:10:10', NULL),
(9, 'Khulna', 'খুলনা', 'division', '1', '2020-10-16 15:43:21', '2021-02-20 20:10:00', '2021-02-20 20:10:00'),
(10, 'Chattogram Division', 'চট্টগ্রাম বিভাগ', 'division', '1', '2020-10-16 15:43:30', '2020-12-15 04:51:00', NULL),
(11, 'Sylhet Division', 'সিলেট বিভাগ', 'division', '1', '2020-10-16 15:43:30', '2020-12-15 04:53:11', NULL),
(12, 'Khulna Division', 'খুলনা বিভাগ', 'division', '1', '2020-10-16 15:43:30', NULL, NULL),
(13, 'Rajshahi Division', 'রাজশাহী বিভাগ', 'division', '1', '2020-10-16 15:43:30', NULL, NULL),
(14, 'Rangpur Division', 'রংপুর বিভাগ', 'division', '1', '2020-10-16 15:43:30', NULL, NULL),
(15, 'Barishal Division', 'বরিশাল বিভাগ', 'division', '1', '2020-10-16 15:43:30', NULL, NULL),
(16, 'Mymensingh Division', 'ময়মনসিংহ বিভাগ', 'division', '1', '2020-10-16 15:43:30', '2021-02-26 18:07:51', NULL),
(17, 'Indore', 'ইন্দোর', 'division', '1', '2020-10-16 10:50:10', '2021-02-20 12:57:20', '2021-02-20 12:57:20'),
(18, 'Indore', 'ইন্দোর', 'city', '1', '2021-02-09 05:24:10', '2021-02-09 05:27:51', '2021-02-09 05:27:51'),
(19, 'Dhaka Division', 'ঢাকা বিভাগ', 'division', '1', '2021-02-20 20:07:29', '2021-02-26 12:38:21', '2021-02-26 12:38:21'),
(20, 'Dhaka Division', 'ঢাকা বিভাগ', 'division', '1', '2021-02-26 18:06:34', '2021-02-26 18:13:06', '2021-02-26 18:13:06'),
(21, 'Dhaka Division', 'ঢাকা বিভাগ', 'division', '1', '2021-02-26 18:15:11', '2021-02-26 18:19:27', '2021-02-26 18:19:27'),
(22, 'Dhaka', 'ঢাকা', 'city', '1', '2021-02-26 18:17:25', '2021-02-26 18:19:22', '2021-02-26 18:19:22'),
(23, 'Chattogram Division', 'চট্টগ্রাম বিভাগ', 'division', '1', '2021-02-26 18:18:34', '2021-02-26 18:19:18', '2021-02-26 18:19:18'),
(24, 'Dhaka', 'ঢাকা', 'city', '1', '2021-02-26 19:22:35', '2021-02-26 19:22:35', NULL),
(25, 'Chattogram', 'চট্টগ্রাম', 'city', '1', '2021-02-26 19:23:27', '2021-03-18 11:32:02', NULL),
(26, 'Khulna', 'খুলনা', 'city', '1', '2021-02-26 19:24:01', '2021-02-26 19:25:10', NULL),
(27, 'Mymensingh', 'ময়মনসিংহ', 'city', '1', '2021-02-26 19:25:49', '2021-03-13 07:05:13', '2021-03-13 07:05:13'),
(28, 'Rajshahi', 'রাজতন্ত্র', 'city', '1', '2021-02-26 19:26:21', '2021-02-26 19:26:21', NULL),
(29, 'Rangpur', 'রংপুর', 'city', '1', '2021-02-26 19:27:17', '2021-02-26 19:27:17', NULL),
(30, 'Sylhet', 'সিলেট', 'city', '1', '2021-02-26 19:27:44', '2021-02-26 19:27:44', NULL),
(31, 'Barishal', 'বরিশাল', 'city', '1', '2021-02-26 19:29:39', '2021-02-26 19:29:39', NULL),
(32, 'Dhaka Division', 'ঢাকা বিভাগ', 'division', '1', '2021-02-26 19:30:17', '2021-03-17 08:30:23', '2021-03-17 08:30:23'),
(33, 'Dhaka Division', 'Dhaka Division', 'division', '1', '2021-03-17 08:30:04', '2021-03-17 08:30:14', '2021-03-17 08:30:14'),
(34, 'Dhaka Division', 'Dhaka Division', 'division', '1', '2021-03-17 08:30:43', '2021-03-18 21:29:26', '2021-03-18 21:29:26'),
(35, 'Dhaka Division', 'Dhaka Division', 'city', '1', '2021-03-17 09:24:47', '2021-03-17 17:41:59', '2021-03-17 17:41:59'),
(36, 'Mymensingh', 'ময়মনসিংহ', 'city', '1', '2021-03-18 11:33:30', '2021-03-18 11:33:30', NULL),
(37, 'Dhaka Division', 'ঢাকা বিভাগ', 'division', '1', '2021-03-18 21:30:01', '2021-03-18 21:30:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `city_areas`
--

CREATE TABLE `city_areas` (
  `id` int(10) UNSIGNED NOT NULL,
  `city_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `title_bn` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city_areas`
--

INSERT INTO `city_areas` (`id`, `city_id`, `title`, `title_bn`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(16, 17, 'Placiya', 'পলসিয়া', '1', '2020-10-19 10:47:10', '2020-10-23 05:14:49', NULL),
(17, 17, 'Rajwada1', 'রাজওয়াদা', '1', '2020-10-19 10:48:47', '2020-10-28 11:31:40', NULL),
(18, 17, 'Pardeshipura', 'পরদেশীপুর', '1', '2020-10-19 11:25:35', '2020-10-23 05:16:19', NULL),
(19, 17, 'Bhawarkua', 'ভাবারকুয়া', '1', '2020-10-19 11:28:34', '2020-10-23 05:16:55', NULL),
(20, 17, 'Naulakha', 'নওলখা', '1', '2020-10-28 11:32:51', '2020-10-28 11:32:51', NULL),
(21, 17, 'Sudama Nagar', 'সুদামা নগর', '1', '2020-10-28 11:34:38', '2020-10-28 11:36:39', NULL),
(22, 1, 'Adabor', 'আদাবর থানা', '1', '2020-12-15 04:42:09', '2020-12-15 04:42:09', NULL),
(23, 1, 'Badda', 'বাড্ডা থানা', '1', '2020-12-15 04:43:07', '2020-12-15 04:43:07', NULL),
(24, 1, 'Bandar', 'বন্দর উপজেলা', '1', '2020-12-15 04:43:49', '2020-12-15 04:43:49', NULL),
(25, 1, 'Bangshal', 'বংশাল থানা', '1', '2020-12-15 04:44:06', '2020-12-15 04:44:06', NULL),
(26, 9, 'Khulna', 'খুলনা', '1', '2020-12-15 04:45:36', '2020-12-15 04:45:36', NULL),
(27, 9, 'Chittagong', 'চট্টগ্রাম', '1', '2020-12-15 04:46:02', '2020-12-15 04:46:02', NULL),
(28, 9, 'Barisal', 'বরিশাল', '1', '2020-12-15 04:46:22', '2020-12-15 04:46:22', NULL),
(29, 16, 'Mymensingh Division', 'Mymensingh Division', '1', '2020-12-15 04:48:16', '2021-02-26 18:07:27', '2021-02-26 18:07:27'),
(30, 14, 'Rangpur Division', 'রংপুর বিভাগ', '1', '2020-12-15 04:48:36', '2021-02-26 18:08:19', '2021-02-26 18:08:19'),
(31, 15, 'Barishal Division', 'বরিশাল বিভাগ', '1', '2020-12-15 04:49:03', '2021-02-26 18:08:01', '2021-02-26 18:08:01'),
(32, 13, 'Rajshahi Division', 'রাজশাহী বিভাগ', '1', '2020-12-15 04:50:12', '2021-02-26 18:08:56', '2021-02-26 18:08:56'),
(33, 12, 'Khulna Division', 'খুলনা বিভাগ', '1', '2020-12-15 04:50:34', '2021-02-26 18:12:46', '2021-02-26 18:12:46'),
(34, 10, 'Chattogram Division', 'চট্টগ্রাম বিভাগ', '1', '2020-12-15 04:50:56', '2021-02-26 18:09:15', '2021-02-26 18:09:15'),
(35, 8, 'Mymensingh', 'ময়মনসিংহ', '1', '2020-12-15 04:51:23', '2021-02-26 18:10:02', '2021-02-26 18:10:02'),
(36, 7, 'Rangpur', 'রংপুর', '1', '2020-12-15 04:52:42', '2020-12-15 04:52:42', NULL),
(37, 11, 'Sylhet Division', 'সিলেট বিভাগ', '1', '2020-12-15 04:53:06', '2021-02-26 18:11:23', '2021-02-26 18:11:23'),
(38, 6, 'Rajshahi', 'রাজশাহী', '1', '2020-12-15 04:53:45', '2020-12-15 04:53:45', NULL),
(39, 5, 'Barishal', 'বরিশাল', '1', '2020-12-15 04:54:08', '2020-12-15 04:54:08', NULL),
(40, 4, 'Khulna', 'খুলনা', '1', '2020-12-15 04:54:30', '2020-12-15 04:54:30', NULL),
(41, 3, 'Sylhet', 'সিলেট', '1', '2020-12-15 04:54:54', '2020-12-15 04:54:54', NULL),
(42, 2, 'Chattogram', 'চট্টগ্রাম', '1', '2020-12-15 04:55:17', '2021-02-11 22:09:32', '2021-02-11 22:09:32'),
(43, 18, 'navalakha', 'নাভালখা', '1', '2021-02-09 05:25:44', '2021-02-09 05:26:30', '2021-02-09 05:26:30'),
(44, 18, 'navalakha', 'নাভালখা', '1', '2021-02-09 05:26:39', '2021-02-09 05:26:39', NULL),
(45, 2, 'Feni', 'ফেনী', '1', '2021-02-11 22:02:05', '2021-02-11 22:02:05', NULL),
(46, 2, 'Agrabad', 'আগ্রাবাদ', '1', '2021-02-11 22:05:29', '2021-02-11 22:05:29', NULL),
(47, 2, 'Kotwali', 'কোতোয়ালি', '1', '2021-02-11 22:06:16', '2021-02-11 22:06:16', NULL),
(48, 2, 'Chawkbazar', 'চকবাজার', '1', '2021-02-11 22:07:02', '2021-02-11 22:07:02', NULL),
(49, 2, 'Nasirabad', 'নসিরাবাদ', '1', '2021-02-11 22:07:43', '2021-02-11 22:07:43', NULL),
(50, 19, 'Faridpur', 'ফরিদপুর', '1', '2021-02-26 12:34:09', '2021-02-26 12:34:09', NULL),
(51, 19, 'Gazipur', 'গাজীপুর', '1', '2021-02-26 12:34:37', '2021-02-26 12:34:37', NULL),
(52, 19, 'Mirpur', 'মিরপুর', '1', '2021-02-26 12:36:08', '2021-02-26 12:36:08', NULL),
(53, 25, 'Feni', 'ফেনী', '1', '2021-02-26 19:56:28', '2021-03-18 11:31:31', '2021-03-18 11:31:31'),
(54, 32, 'Gazipur', 'গাজীপুর', '1', '2021-03-11 17:36:21', '2021-03-12 20:28:09', '2021-03-12 20:28:09'),
(55, 32, 'Kishoreganj', 'কিশোরগঞ্জ', '1', '2021-03-11 17:37:26', '2021-03-12 20:28:14', '2021-03-12 20:28:14'),
(56, 32, 'Mirpur', 'মিরপুর', '1', '2021-03-12 20:28:58', '2021-03-12 20:28:58', NULL),
(57, 32, 'Uttara', 'উত্তর', '1', '2021-03-12 20:30:04', '2021-03-12 20:30:04', NULL),
(58, 32, 'Mohammadpur', 'মোহাম্মাদপুর', '1', '2021-03-12 20:31:00', '2021-03-12 20:31:00', NULL),
(59, 32, 'Dhanmondi', 'ধানমন্ডি', '1', '2021-03-12 20:31:41', '2021-03-12 20:31:41', NULL),
(60, 34, 'Dhaka Division', 'Dhaka Division', '1', '2021-03-17 08:31:00', '2021-03-17 08:31:00', NULL),
(61, 36, 'test', 'বই', '1', '2021-03-18 11:48:02', '2021-03-18 11:48:02', NULL),
(62, 24, 'Mirpur', 'মিরপুর', '1', '2021-03-18 21:31:38', '2021-03-18 21:31:38', NULL),
(63, 24, 'Uttara', 'উত্তর', '1', '2021-03-18 21:31:59', '2021-03-18 21:31:59', NULL),
(64, 24, 'Mohammadpur', 'মোহাম্মদপুর', '1', '2021-03-18 21:32:25', '2021-03-18 21:32:25', NULL),
(65, 24, 'Dhanmondi', 'ধানমন্ডি', '1', '2021-03-18 21:33:09', '2021-03-18 21:33:09', NULL),
(66, 24, 'Savar', 'সাভার', '1', '2021-03-18 21:34:36', '2021-03-18 21:34:36', NULL),
(67, 24, 'Badda', 'Badda', '1', '2021-03-18 21:35:35', '2021-03-18 21:36:30', NULL),
(68, 24, 'Banni', 'Banni', '1', '2021-03-18 21:36:05', '2021-03-18 21:36:05', NULL),
(69, 24, 'Banglamotor', 'বাংলামোটর', '1', '2021-03-18 21:37:02', '2021-03-18 21:37:02', NULL),
(70, 24, 'Bangshal', 'Bangshal', '1', '2021-03-18 21:37:27', '2021-03-18 21:37:27', NULL),
(71, 24, 'Baridhara', 'বারিধারা', '1', '2021-03-18 21:38:12', '2021-03-18 21:38:12', NULL),
(72, 24, 'Basabo', 'বাসাবো', '1', '2021-03-18 21:38:37', '2021-03-18 21:38:37', NULL),
(73, 24, 'Cantonment', 'সেনানিবাস', '1', '2021-03-18 21:39:15', '2021-03-18 21:39:15', NULL),
(74, 24, 'Basundhara', 'বসুন্ধরা', '1', '2021-03-18 21:39:43', '2021-03-18 21:39:43', NULL),
(75, 24, 'Chaukbazar', 'চৌকবাজার', '1', '2021-03-18 21:40:07', '2021-03-18 21:40:07', NULL),
(76, 24, 'Demra', 'ডেমরা', '1', '2021-03-18 21:40:31', '2021-03-18 21:40:31', NULL),
(77, 24, 'Dhamrai', 'ধামরে', '1', '2021-03-18 21:40:54', '2021-03-18 21:40:54', NULL),
(78, 24, 'Dohar', 'দোহার', '1', '2021-03-18 21:41:27', '2021-03-18 21:41:27', NULL),
(79, 24, 'Elephant Road', 'এলিফ্যান্ট রোড', '1', '2021-03-18 21:41:56', '2021-03-18 21:41:56', NULL),
(80, 24, 'Farmgate', 'ফার্মগেট', '1', '2021-03-18 21:42:24', '2021-03-18 21:42:24', NULL),
(81, 24, 'Gulshan', 'গুলশান', '1', '2021-03-18 21:43:33', '2021-03-18 21:43:33', NULL),
(82, 24, 'Hazaribagh', 'হাজারীবাগ', '1', '2021-03-18 21:43:55', '2021-03-18 21:43:55', NULL),
(83, 24, 'Jatrabari', 'জাতবাড়ী', '1', '2021-03-18 21:44:59', '2021-03-18 21:44:59', NULL),
(84, 24, 'Kafrul', 'কাফরুল', '1', '2021-03-18 21:45:26', '2021-03-18 21:45:26', NULL),
(85, 24, 'Kamrangirchar', 'কামরাঙ্গীরচর', '1', '2021-03-18 21:46:07', '2021-03-18 21:46:07', NULL),
(86, 24, 'Keraniganj', 'কেরানীগঞ্জ', '1', '2021-03-18 21:46:31', '2021-03-18 21:46:31', NULL),
(87, 24, 'Khilgaon', 'Khilgaon', '1', '2021-03-18 21:46:52', '2021-03-18 21:46:52', NULL),
(88, 24, 'Khilkhet', 'খিলক্ষেত', '1', '2021-03-18 21:47:41', '2021-03-18 21:47:41', NULL),
(89, 24, 'Kotwali', 'কোতোয়ালি', '1', '2021-03-18 21:48:03', '2021-03-18 21:48:03', NULL),
(90, 24, 'Lalbag', 'লালবাগ', '1', '2021-03-18 21:48:59', '2021-03-18 21:48:59', NULL),
(91, 24, 'Malibag', 'মালিবাগ', '1', '2021-03-18 21:49:31', '2021-03-18 21:49:31', NULL),
(92, 24, 'Mogbazar', 'মোগবাজার', '1', '2021-03-18 21:50:17', '2021-03-18 21:50:17', NULL),
(93, 24, 'Mohakhali', 'মহাখালী', '1', '2021-03-18 21:51:16', '2021-03-18 21:51:16', NULL),
(94, 24, 'Motijheel', 'মতিঝিল', '1', '2021-03-18 21:51:41', '2021-03-18 21:51:41', NULL),
(95, 24, 'Nawabganj', 'নবাবগঞ্জ', '1', '2021-03-18 21:52:15', '2021-03-18 21:52:15', NULL),
(96, 24, 'New Market', 'নতুন বাজার', '1', '2021-03-18 21:53:25', '2021-03-18 21:53:25', NULL),
(97, 24, 'Paltan', 'পল্টন', '1', '2021-03-18 21:54:21', '2021-03-18 21:54:21', NULL),
(98, 24, 'Purbachal', 'পূর্বাচল', '1', '2021-03-18 21:55:14', '2021-03-18 21:55:14', NULL),
(99, 24, 'Ramna', 'রমনা', '1', '2021-03-18 21:55:45', '2021-03-18 21:55:45', NULL),
(100, 24, 'Rampura', 'রামপুরা', '1', '2021-03-18 21:56:52', '2021-03-18 21:56:52', NULL),
(101, 24, 'Sutrapur', 'সূত্রাপুর', '1', '2021-03-18 21:57:22', '2021-03-18 21:57:22', NULL),
(102, 24, 'Tejgaon', 'তেজগাঁও', '1', '2021-03-18 21:57:51', '2021-03-18 21:57:51', NULL),
(103, 24, 'Tongi', 'টঙ্গী', '1', '2021-03-18 21:58:32', '2021-03-18 21:58:53', NULL),
(104, 24, 'Wari', 'Wari', '1', '2021-03-18 21:59:20', '2021-03-18 21:59:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(250) NOT NULL,
  `value` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `type` enum('string','html') NOT NULL DEFAULT 'string',
  `lang` enum('en','bn') NOT NULL DEFAULT 'en',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `key`, `value`, `type`, `lang`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'postman', 'https://www.getpostman.com/collections/82e7f1ea5d4528081902', 'string', 'en', '2020-10-16 19:00:35', NULL, NULL),
(2, 'currency', '৳', 'string', 'en', '2020-10-27 11:30:28', NULL, NULL),
(3, 'facebook', 'http://www.facebook.com/kroykari', 'string', 'en', '2020-10-28 11:17:13', '2021-02-06 07:32:09', NULL),
(4, 'youtube', 'https://www.youtube.com/channel/UC23XaiUjVYFBzYvqdsuMDZw/', 'string', 'en', '2020-10-28 11:17:13', '2021-02-18 20:35:46', NULL),
(5, 'instagram', 'https://www.instagram.com/kroykari', 'string', 'en', '2020-10-28 11:17:19', '2021-02-06 08:19:08', NULL),
(6, 'twitter', 'https://twitter.com/kroykari', 'string', 'en', '2020-10-28 11:17:19', '2021-02-06 08:23:59', NULL),
(7, 'how-to-sell-fast', 'What is Lorem Ipsum Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book it has?', 'html', 'en', '2020-10-28 11:17:19', NULL, NULL),
(8, 'membership', 'membership\r\nWhat is Lorem Ipsum Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book it has?What is Lorem Ipsum Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book it has?vWhat is Lorem Ipsum Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book it has?What is Lorem Ipsum Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book it has?What is Lorem Ipsum Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book it has?What is Lorem Ipsum Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book it has?', 'html', 'en', '2020-10-28 11:17:19', '2020-10-28 06:02:10', NULL),
(9, 'banner-advertising', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 'html', 'en', '2020-10-28 11:19:18', '2020-10-28 07:02:00', NULL),
(10, 'faq', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 'html', 'en', '2020-10-28 11:19:24', '2020-10-28 07:02:18', NULL),
(11, 'about-us', '<p>kroykari.com is the leading classifieds website for users in the Bangladesh. Since its launch in 2019 by Md. Akramul Hoque, kroykari.com has become the number one platform for users to buy, sell, or find anything in their community. kroykari.com is a website where you can buy and sell almost everything.&nbsp;</p>', 'html', 'en', '2020-10-28 11:19:24', '2021-02-06 07:20:19', NULL),
(12, 'terms-and-conditions', '<p><strong>Welcome to Kroykari.com Limited.</strong></p>\r\n\r\n<p><strong><em>Please read this important legal information that governs your use of the kroykari.com website and the services.</em></strong></p>\r\n\r\n<p><strong>18th of December, 2021</strong></p>\r\n\r\n<p>https://kroykari.com Limited or the Kroykari mobile application of the online platform, you confirm that you have read, understood and accept these terms of use (&ldquo;Terms&rdquo;) as the terms which govern your access to and use of the website and the service and you agree to comply with them, If you do not accept. If you do not accept or agree to comply with these terms, you must not use the website additionally, when using a portion of the service, you agree to conform to any applicable posted guideline for such service, which may change or be updated from time to time at our sole discretion.</p>\r\n\r\n<p>If you do not accept or agree to comply with these Terms, you must not use this Website. Additionally, when using a portion of the Service, you agree to conform to any applicable posted guidelines for such Service, which may change or be updated from time to time at our sole discretion.</p>\r\n\r\n<p>You will be required to enter into additional terms and conditions set out in our advertising agreement.</p>\r\n\r\n<ol>\r\n	<li><strong>Intellectual Property Rights &ndash; </strong>Intellectual All property, trade marks, database rights and rights in data, copyrights and topography right, and including application and the right to apply for registration any such rights and all inventions, rights in know-how, trade secrets and confidential information, customer and supplier lists and other proprietary knowledge and information and all right under licenses and consents in relation to any such rights and all rights and forms of protection of a similar nature.</li>\r\n	<li><strong>Privacy Policy - &nbsp;</strong>The privacy policy of the company from time to time.</li>\r\n	<li><strong>Material - </strong>&nbsp;Material and content published on the website or otherwise provided by the company in connection with the service.</li>\r\n	<li><strong>Product &ndash; </strong>online classifieds advertising platform provided on the website and the free ad services.</li>\r\n	<li><strong>Registration Details - </strong>&nbsp;The User details provide upon registering for the website from time to time (Example : Name, Phone numbers, email address).</li>\r\n	<li><strong>Unacceptable &ndash; </strong>Any Material or information uploaded to or made available on the website which under the low of any jurisdiction from which the website may be accessed maybe considered ;</li>\r\n</ol>\r\n\r\n<ol>\r\n	<li>Illegal, indecent, offensive, pornographic, insulting, false, unreliable, misleading, harmful or potentially harmful to minors, threatening, alleged to be or actually defamatory or in infringement of third party rights, any Intellectual Property Rights.</li>\r\n	<li>In breach of any applicable regulations, standards or codes of practice.</li>\r\n	<li>In contravention of legislation, including without limitation, that relating to weapons, animals or alcohol.</li>\r\n	<li>Harmful to the company&rsquo;s reputation. &nbsp;</li>\r\n</ol>\r\n\r\n<ol>\r\n	<li><strong>General Terms and Conditions Which apply to users</strong></li>\r\n</ol>\r\n\r\n<ol>\r\n	<li>In registering for this website, the user must provide accurate, current and complete registration details. Users must include their full names in the advert and make it clear that they are selling and buying goods or services in the course of business either by the content, format, size or place of the advertisement.</li>\r\n	<li>The users registration details and data relating to its use of the website will be recorded by the kroykari.com limited but information shall not be disclosed to third parties, any purpose unrelated to the website, by agreeing to the terms, you expressly give us permission to verify the authenticity of your details by calling you on the phone number submitted to us, the call may be recorded for quality assurance.</li>\r\n	<li>If the user&rsquo;s does not want the company to use its email address or mobile number to send information concerning the website and relate matters, the users should send email to <strong><a href=\"mailto:legal@kroykari.com\">legal@kroykari.com</a></strong> and unsubscribe as the subject heading of such message.</li>\r\n	<li>User&rsquo;s must keep confidential any identification and password details set-up or given to you as part of our security procedures and must not disclose them to any third party.</li>\r\n	<li>The Kroykari.com Limited reserves the right to suspend or terminate a user&rsquo;s account.</li>\r\n	<li>The Kroykaril.com Limited owns all intellectual property rights and associated with the website and services, including without limitation, any trade marks, trade names, design, text, graphics and the selection and arrangement, nothing contained in the website should be construed as granting by implication, any license or right to use any trademark displayed on the website without our written permission. &nbsp;</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li><strong>No Spam Policy </strong></li>\r\n</ol>\r\n\r\n<ol>\r\n	<li>User&rsquo;s understand and agree that sending unsolicited email advertisement or other unsolicited communication to the company addresses or through the company computer systems are expressly prohibited by the terms. You acknowledge and agree that from time to time the company may monitor email usage using human monitors or automated software to flag certain words associated with spam or scams in emails that are sent between one users to another in the company&rsquo;s email system.</li>\r\n	<li>Any unauthorized use of the company computer systems is a violation of thes terms and certain applicable laws. In particular the BANGLADESH Cybercrimes legislation, such violations may &nbsp;subject the sender and his or her agents to civil and criminal penalties, please not that the BANGLADESH Cybercrime legislation carries significant penalties including imprisonment. In case you intend to solicit or contact our Users by obtaining their email or phone number from our website, we may report this behavior to the relevant authorities, who then may decide to prosecute you under the relevant BANGLADESH Laws.</li>\r\n</ol>\r\n\r\n<p>​​​​​​​<strong>Limitation of Liability&nbsp;&nbsp; </strong></p>\r\n\r\n<ol>\r\n	<li>The Korykari.com Limited shall not be liable for any ;</li>\r\n</ol>\r\n\r\n<p>Special losses or exemplary damages (even if the company has been advised of possibility of such losses or damage);</p>\r\n\r\n<ol>\r\n	<li>Loss product</li>\r\n	<li>Loss of profit.</li>\r\n	<li>Loss of business</li>\r\n	<li>Loss of use</li>\r\n	<li>Loss of revenue</li>\r\n	<li>Loss of contract</li>\r\n	<li>Loss of opportunity</li>\r\n	<li>Harm to reputation or loss of goodwill</li>\r\n</ol>\r\n\r\n<p>(in the cases of clauses i to ix whether direct or indirect, howsoever arising suffered by any user arising in any way in connection with thes terms or for any liability of a user to any third party.</p>\r\n\r\n<ol>\r\n	<li>Kroykari.com limited doesn&rsquo;t not guarantee that the website will always be accessible, uninterrupted, timely, secure, error free or free from computer virus or other invasive or damaging code or that the website will not be affected by force majeure events, including inability to obtain or shortage of necessary materials failure of information technology or telecommunications equipment or facilities. The Kroykari.com limited may suspend or withdraw or restrict the availability of all or any part of the website for business and operational reasons at any time and shall not be liable for any interruption to service. We recommend that you back up any content and data used in connection with the website, to protect yourself in case of problem with website or services. The Kroykari.com Limited is not liable for any failure in respect of its obligations hereunder which result directly or indirectly from failure or interruption software or service proved by third parties. The Kroykari.com limited is not responsible for the direct or indirect consequences of a user linking to any other website from website and has not approved such linked website or the material or information available from them.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Jobs Wanted &nbsp;</strong>The Kroykari.com Limited is not responsible for the information posted by the job seekers in the Jobs wanted section or in their CVs, By placing a job seeking ad in the Jobs wanted section, the recruiter will have to the CV uploaded to the job seeker&rsquo;s profile.</p>', 'html', 'en', '2020-10-28 11:19:24', '2021-02-21 20:43:01', NULL),
(13, 'privacy-policy', '<p><strong>Privacy Policy</strong></p>\r\n\r\n<p>We take your privacy very seriously and are committed to protecting the privacy of all visitor and subscribers to our website and we make available an app store and the corresponding services available through the platform.</p>\r\n\r\n<p>We set out our privacy policy, which we process any personal information that you provide to us. We will notify you if the way in which we process your information is to change at any time.</p>\r\n\r\n<p>Read this privacy policy carefully as it contains important information on who we are and how we collect, store, use and share your information. By accessing the Platform or using our services or otherwise indicating your consent, you agree to, and where required, use and transfer of your information as set out in this policy. If you don&rsquo;t accept the terms of this policy, you must not use the platform or services. This privacy policy supplements other notices and privacy policies and is not intended to override them.</p>\r\n\r\n<p><strong>The Data We Collect About You</strong></p>\r\n\r\n<p>Once you visit our platform or create a login and password to access the services, you may be asked to provide information about yourself. (1) Your name and contact details, including email address and telephone number, (2) email notification you will received (3) location enabled once you allowed (4)such other information as we may from time to time require to provide the services and comply with applicable law. The collection of information about your usage of the platform and the services and information from messages and communications you send to us.</p>\r\n\r\n<p><strong>Who we share your personal information with</strong></p>\r\n\r\n<p>Your personal information (which includes your name, address and any other details you provide to us which concern you as an individual). Our group authorized to process your information will do so in accordance with privacy policy.</p>\r\n\r\n<p>We require all third parties to respect the security of your personal data and to treat it in accordance with the law. We don&rsquo;t allow our third-party services providers to use your personal data for their own purposes and only permit them to process your personal data for specified purpose and in accordance with our instructions.</p>\r\n\r\n<p><strong>Security Measures </strong></p>\r\n\r\n<p>We have implemented security policies, rules and technical measures to protect the personal data that we have under our control from unauthorized access, improper use and disclosure, unauthorized destruction.</p>\r\n\r\n<p>We also have procedures in place to deal with any suspected data breach. You are solely responsible for keeping your password and other account details confidential. If you have concerns about your password, account details or are suspicious about any unauthorized use of your account, you should contact us immediately. We can deactivate or suspend your account at any time.</p>\r\n\r\n<p><strong>Inquiries</strong></p>\r\n\r\n<p>If you have any enquiry or concern about our privacy policy or the way in which we are handling personal data please contact us at using the following email address emailing us at <a href=\"mailto:privacy@kroykari.com\">privacy@kroykari.com</a> if at any time you wish us to cease processing your information please send a message to our admin department and insert &ldquo;unsubscribe&rdquo; as the subject heading.</p>\r\n\r\n<p><strong>Updates to policy </strong></p>\r\n\r\n<p>We reserve the right to vary this from time to time. Our update policy we will displayed on our platform and by continuing to use and access platform, following such changes, you agree to be bound by any variation made by us. It is your responsibility to check this policy form time to time to verify such variations.</p>\r\n\r\n<p>&nbsp;</p>', 'html', 'en', '2020-10-28 11:19:24', '2021-02-06 08:15:05', NULL),
(14, 'sitemap', '<div style=\"text-align:center\">\r\n<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d235527.45498641633!2d75.72341965660992!3d22.723911431346068!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3962fcad1b410ddb%3A0x96ec4da356240f4!2sIndore%2C%20Madhya%20Pradesh!5e0!3m2!1sen!2sin!4v1603868900494!5m2!1sen!2sin\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"></iframe>\r\n</div>', 'html', 'en', '2020-10-28 11:19:24', '2020-10-28 07:10:21', NULL),
(15, 'careers', 'Lorem ipsum', 'string', 'en', '2020-10-28 12:11:45', NULL, NULL),
(16, 'stay-safe-on-kroykari', 'fds', 'string', 'en', '2020-10-28 12:13:47', NULL, NULL),
(17, 'promote-your-ad', 'Promote your ad', 'string', 'en', '2020-10-28 12:15:26', NULL, NULL),
(18, 'banner-advertising', 'Banner Advertising', 'html', 'bn', '2020-10-28 12:16:42', NULL, NULL),
(20, 'help', 'What is Lorem Ipsum Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book it has?', 'string', 'en', '2020-10-28 12:48:22', NULL, NULL),
(21, 'posting_rules', '<h2>&nbsp;</h2>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Make sure you post in the correct category.</p>\r\n	</li>\r\n	<li>\r\n	<p>Do not post the same ad more than once or repost an ad within 7 days.</p>\r\n	</li>\r\n	<li>\r\n	<p>Do not upload pictures with watermarks.</p>\r\n	</li>\r\n	<li>\r\n	<p>Do not post ads containing multiple items unless it&#39;s a package deal.</p>\r\n	</li>\r\n	<li>\r\n	<p>Do not put your email or phone numbers in the title or description.</p>\r\n	</li>\r\n</ul>', 'html', 'en', '2020-11-03 15:21:16', '2020-11-03 11:27:52', NULL),
(22, 'posting_rules', '<p>Kroy.com এ পোস্ট করা সমস্ত বিজ্ঞাপন অবশ্যই আমাদের বিধি অনুসরণ করবে:<br />\nআপনি সঠিক বিভাগে পোস্ট করেছেন তা নিশ্চিত করুন।</p>\n\n<p>একই বিজ্ঞাপনটি একাধিক বার পোস্ট করবেন না বা days দিনের মধ্যে কোনও বিজ্ঞাপন পুনরায় পোস্ট করবেন না।</p>\n\n<p>জলছবি সহ ছবি আপলোড করবেন না।</p>\n\n<p>এটি কোনও প্যাকেজ চুক্তি না করে একাধিক আইটেমযুক্ত বিজ্ঞাপন পোস্ট করবেন না।</p>\n\n<p>আপনার ইমেল বা ফোন নম্বরগুলি শিরোনাম বা বর্ণনায় রাখবেন না।</p>', 'html', 'bn', '2020-11-03 15:32:10', NULL, NULL),
(24, 'email', 'support@kroykari.com', 'string', 'en', '2020-11-03 15:45:17', '2021-02-06 07:29:51', NULL),
(25, 'about-us', '<p>kroykari.com বাংলাদেশের ব্যবহারকারীদের জন্য শীর্ষস্থানীয় শ্রেণিবদ্ধ ওয়েবসাইট। মোঃ আকরামুল হক দ্বারা 2019 সালে চালু হওয়ার পর থেকে ক্রোকারি ডটকম ব্যবহারকারীদের জন্য তাদের সম্প্রদায়ের মধ্যে কেনা বেচা বা কিছু খুঁজে পাওয়ার এক নম্বর প্ল্যাটফর্ম হয়ে উঠেছে। kroykari.com এমন একটি ওয়েবসাইট যেখানে আপনি প্রায় সবকিছু কিনতে এবং বিক্রয় করতে পারেন।</p>', 'html', 'bn', '2021-02-05 14:32:00', '2021-02-06 07:20:57', NULL),
(26, 'help', 'Lorem ipsum english', 'string', 'en', '2021-02-09 11:26:59', NULL, NULL),
(27, 'help', 'Lorem ipsum bangla', 'string', 'bn', '2021-02-09 11:26:59', NULL, NULL),
(28, 'careers', '', 'html', 'bn', '2021-02-12 05:56:55', NULL, NULL),
(29, 'promote-your-ad', 'Promote your ad', 'string', 'bn', '2021-02-12 05:57:58', NULL, NULL),
(30, 'privacy-policy', '', 'html', 'bn', '2021-03-08 06:08:08', NULL, NULL),
(31, 'terms-and-conditions', '', 'html', 'bn', '2021-03-08 06:08:08', NULL, NULL),
(32, 'posting_allowance', '', 'html', 'bn', '2021-03-08 06:08:08', NULL, NULL),
(35, 'safety-notification', '<p>We review all ads to keep everyone on kroykari.com&nbsp;safe and happy</p>\r\n\r\n<p>Your ad will not go live if it is:<br />\r\n1. Prohibited item or activity that violates Bangladesh law.<br />\r\n2. Placed multiple times on same categories.<br />\r\n3. Any items that is located outsite the Bangladesh.<br />\r\n4. Fraudulent or misleading information.<br />\r\n5. Image with watermark.</p>', 'html', 'en', '2021-03-03 17:25:23', '2021-03-03 12:18:39', NULL),
(36, 'safety-notification', '<pre>\r\nআমরা kroykari.comm- তে প্রত্যেককে সুরক্ষিত এবং খুশি রাখতে সমস্ত বিজ্ঞাপন পর্যালোচনা করি\r\nআপনার বিজ্ঞাপনটি এটি লাইভ হবে না:\r\n১. নিষিদ্ধ আইটেম বা ক্রিয়াকলাপ যা বাংলাদেশ আইন লঙ্ঘন করে।\r\n2. একই বিভাগে একাধিকবার স্থাপন।\r\n৩. যে কোনও সময় বাংলাদেশের বাইরে অবস্থিত।\r\n৪. প্রতারণামূলক বা বিভ্রান্তিকর তথ্য\r\n5. জলছবি সহ চিত্র।\r\nআরও তথ্যের জন্য, আমাদের শর্তাদি এবং শর্তাদি প্রস্তুত করুন</pre>', 'html', 'bn', '2021-03-03 17:25:23', '2021-03-03 12:12:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `message`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'test', 'akramulhoque2025@gmail.com', 'test 123', '2021-02-09 08:41:34', NULL, NULL),
(2, 'Akram', 'akramulhoque2016@gmail.com', 'Test', '2021-02-10 17:28:59', NULL, NULL),
(3, 'dsfs', 'ambuj@gmail.com', 'ewrwerw', '2021-02-11 10:27:40', NULL, NULL),
(4, 'ambuj', 'ambuj@gmail.com', 'dsf sddfdsfsd sdfgsdfsd', '2021-02-11 10:28:58', NULL, NULL),
(5, 'reter', 'ert@gmail.com', 'sadsad', '2021-02-11 10:30:17', NULL, NULL),
(6, 'Shivam', 'shivamyadav8959@gmail.com', 'lorem ipsum', '2021-02-11 10:47:28', NULL, NULL),
(7, 'akram', 'akramulhoque2016@gmail.com', 'test', '2021-02-11 22:58:17', NULL, NULL),
(8, 'akram', 'akramulhoque2016@gmail.com', 'testmail', '2021-02-23 14:07:45', NULL, NULL),
(9, 'akram', 'akramulhoque2016@gmail.com', 'testmail', '2021-02-23 14:07:53', NULL, NULL),
(10, 'Hi', 'akramulhoque2016@gmail.com', 'Test', '2021-02-24 10:04:43', NULL, NULL),
(11, 'akram', 'akramulhoque2016@gmail.com', 'test1111', '2021-02-24 13:14:24', NULL, NULL),
(12, 'akram', 'akramulhoque2016@gmail.com', 'test1111', '2021-02-24 13:14:27', NULL, NULL),
(13, 'akram', 'akramulhoque2016@gmail.com', 'test1111', '2021-02-24 13:14:28', NULL, NULL),
(14, 'akram', 'akramulhoque2016@gmail.com', 'test1111', '2021-02-24 13:14:29', NULL, NULL),
(15, 'Ambuj', 'ambuj@gmail.com', 'Test mail', '2021-02-25 03:07:19', NULL, NULL),
(16, 'Shivam Yadav', 'shivamyadav8959@gmail.com', 'Test Mail', '2021-02-25 04:56:02', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `favouriate_ads`
--

CREATE TABLE `favouriate_ads` (
  `id` int(10) UNSIGNED NOT NULL,
  `ad_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `unique_id` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favouriate_ads`
--

INSERT INTO `favouriate_ads` (`id`, `ad_id`, `user_id`, `unique_id`, `created_at`, `update_at`, `deleted_at`) VALUES
(4, 13, 71, NULL, '2021-02-10 07:43:10', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

CREATE TABLE `fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `type` varchar(100) NOT NULL,
  `placeholder` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`id`, `name`, `type`, `placeholder`, `created_at`, `updated_at`, `deleted_at`) VALUES
(34, 'Flue Type', 'select', '', '2021-02-05 10:49:44', NULL, NULL),
(35, 'Brand', 'select', '', '2021-02-05 11:42:18', NULL, NULL),
(36, 'Modal Year', 'text', '', '2021-02-05 11:42:32', NULL, NULL),
(37, 'Transmission', 'checkbox', '', '2021-02-05 11:43:14', NULL, NULL),
(38, 'Car Condition', 'radio', '', '2021-02-05 11:43:44', NULL, NULL),
(40, 'ROM', 'select', '', '2021-02-05 11:33:35', NULL, NULL),
(41, 'Mobile Brand', 'select', '', '2021-02-05 11:34:54', NULL, NULL),
(42, 'Beds', 'select', '', '2021-02-05 11:40:36', NULL, NULL),
(43, 'Baths', 'select', '', '2021-02-05 11:41:48', NULL, NULL),
(44, 'Square feet', 'text', '', '2021-02-05 11:42:01', NULL, NULL),
(45, 'Gendor', 'radio', '', '2021-02-05 13:59:07', NULL, NULL),
(47, 'IT', 'select', '', '2021-02-06 20:01:45', NULL, NULL),
(48, 'bottle height', 'text', '', '2021-02-09 06:14:42', NULL, NULL),
(49, 'bottle width', 'select', '', '2021-02-09 06:18:29', NULL, NULL),
(53, 'beauty', 'select', '', '2021-02-22 08:01:00', NULL, NULL),
(54, 'Daily Book', 'select', '', '2021-02-22 12:59:39', NULL, NULL),
(65, 'Elect', 'select', '', '2021-02-22 13:23:59', NULL, NULL),
(66, 'fashion', 'select', '', '2021-02-22 13:37:09', NULL, NULL),
(69, 'furnitures', 'select', '', '2021-02-22 13:52:10', NULL, NULL),
(70, 'household', 'select', '', '2021-02-22 14:10:46', NULL, NULL),
(89, 'RAM', 'select', '', '2021-03-11 02:58:55', NULL, NULL),
(90, 'Android Version', 'select', '', '2021-03-11 03:31:49', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `field_options`
--

CREATE TABLE `field_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `field_id` bigint(20) UNSIGNED NOT NULL,
  `option` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `field_options`
--

INSERT INTO `field_options` (`id`, `field_id`, `option`, `created_at`, `updated_at`, `deleted_at`) VALUES
(14, 34, 'Patrol', '2021-02-05 11:33:48', NULL, NULL),
(15, 34, 'CNG', '2021-02-05 11:33:48', NULL, NULL),
(16, 35, 'Tata', '2021-02-05 11:42:18', NULL, NULL),
(17, 35, 'MG', '2021-02-05 11:42:18', NULL, NULL),
(18, 35, 'BMW', '2021-02-05 11:42:18', NULL, NULL),
(19, 35, 'hyndai', '2021-02-05 11:42:18', NULL, NULL),
(20, 35, 'Honda', '2021-02-05 11:42:18', NULL, NULL),
(21, 35, 'Maruti', '2021-02-05 11:42:18', NULL, NULL),
(22, 35, 'Ford', '2021-02-05 11:42:18', NULL, NULL),
(23, 35, 'Kia', '2021-02-05 11:42:18', NULL, NULL),
(24, 37, 'Automatic', '2021-02-05 11:43:14', NULL, NULL),
(25, 37, 'Mannual', '2021-02-05 11:43:14', NULL, NULL),
(26, 37, 'Semi-automatic', '2021-02-05 11:43:14', NULL, NULL),
(27, 38, 'New', '2021-02-05 11:43:44', NULL, NULL),
(28, 38, 'Used', '2021-02-05 11:43:44', NULL, NULL),
(37, 40, '2 GB', '2021-02-05 11:33:35', NULL, NULL),
(38, 40, '4 GB', '2021-02-05 11:33:35', NULL, NULL),
(39, 40, '6 GB', '2021-02-05 11:33:35', NULL, NULL),
(40, 40, '8 GB', '2021-02-05 11:33:35', NULL, NULL),
(41, 40, '16 GB', '2021-02-05 11:33:35', NULL, NULL),
(42, 40, '32 GB', '2021-02-05 11:33:35', NULL, NULL),
(43, 40, '64 GB', '2021-02-05 11:33:35', NULL, NULL),
(44, 40, '128 GB', '2021-02-05 11:33:35', NULL, NULL),
(45, 40, '512 GB', '2021-02-05 11:33:35', NULL, NULL),
(46, 40, '1024 GB', '2021-02-05 11:33:35', NULL, NULL),
(47, 41, 'Apple', '2021-02-05 11:34:54', NULL, NULL),
(48, 41, 'Oppo', '2021-02-05 11:34:54', NULL, NULL),
(49, 41, 'Samsung', '2021-02-05 11:34:54', NULL, NULL),
(50, 41, 'Nokia', '2021-02-05 11:34:54', NULL, NULL),
(51, 41, 'One Plush', '2021-02-05 11:34:54', NULL, NULL),
(52, 41, 'Mi xiaomi', '2021-02-05 11:34:54', NULL, NULL),
(86, 43, '1', '2021-02-05 12:43:26', NULL, NULL),
(87, 43, '2', '2021-02-05 12:43:26', NULL, NULL),
(88, 43, '3', '2021-02-05 12:43:26', NULL, NULL),
(89, 43, '4', '2021-02-05 12:43:26', NULL, NULL),
(90, 43, '5', '2021-02-05 12:43:26', NULL, NULL),
(91, 43, '6', '2021-02-05 12:43:26', NULL, NULL),
(92, 43, '7', '2021-02-05 12:43:26', NULL, NULL),
(93, 43, '8', '2021-02-05 12:43:26', NULL, NULL),
(94, 43, '9', '2021-02-05 12:43:26', NULL, NULL),
(95, 43, '10', '2021-02-05 12:43:26', NULL, NULL),
(96, 43, '10+', '2021-02-05 12:43:26', NULL, NULL),
(97, 42, '1', '2021-02-05 12:43:33', NULL, NULL),
(98, 42, '2', '2021-02-05 12:43:33', NULL, NULL),
(99, 42, '3', '2021-02-05 12:43:33', NULL, NULL),
(100, 42, '4', '2021-02-05 12:43:33', NULL, NULL),
(101, 42, '5', '2021-02-05 12:43:33', NULL, NULL),
(102, 42, '6', '2021-02-05 12:43:33', NULL, NULL),
(103, 42, '7', '2021-02-05 12:43:33', NULL, NULL),
(104, 42, '8', '2021-02-05 12:43:33', NULL, NULL),
(105, 42, '9', '2021-02-05 12:43:33', NULL, NULL),
(106, 42, '10', '2021-02-05 12:43:33', NULL, NULL),
(107, 42, '10+', '2021-02-05 12:43:33', NULL, NULL),
(108, 45, 'Male', '2021-02-05 13:59:07', NULL, NULL),
(109, 45, 'Female', '2021-02-05 13:59:07', NULL, NULL),
(112, 47, 'IT Support', '2021-02-06 20:06:44', NULL, NULL),
(113, 47, 'Call Center Agent', '2021-02-06 20:06:44', NULL, NULL),
(114, 47, 'Helpdesk', '2021-02-06 20:06:44', NULL, NULL),
(117, 53, 'beauty', '2021-02-22 08:01:00', NULL, NULL),
(118, 53, 'cute', '2021-02-22 08:01:00', NULL, NULL),
(134, 54, 'Bd book ', '2021-02-22 13:06:34', NULL, NULL),
(135, 54, 'educationbook', '2021-02-22 13:06:34', NULL, NULL),
(136, 54, 'book1', '2021-02-22 13:06:34', NULL, NULL),
(137, 54, 'book2', '2021-02-22 13:06:34', NULL, NULL),
(155, 65, 'light', '2021-02-22 13:24:39', NULL, NULL),
(156, 65, 'blub', '2021-02-22 13:24:39', NULL, NULL),
(157, 65, 'screen', '2021-02-22 13:24:39', NULL, NULL),
(158, 66, 'makupbox', '2021-02-22 13:37:58', NULL, NULL),
(159, 66, 'ring', '2021-02-22 13:37:58', NULL, NULL),
(160, 66, 'finger ring', '2021-02-22 13:37:58', NULL, NULL),
(161, 69, 'furn', '2021-02-22 13:52:41', NULL, NULL),
(162, 69, 'table', '2021-02-22 13:52:41', NULL, NULL),
(163, 69, 'chir', '2021-02-22 13:52:41', NULL, NULL),
(164, 70, 'bad', '2021-02-22 14:11:26', NULL, NULL),
(165, 70, 'phillo', '2021-02-22 14:11:26', NULL, NULL),
(166, 70, 'dublx', '2021-02-22 14:11:26', NULL, NULL),
(171, 49, 'first', '2021-02-24 05:51:36', NULL, NULL),
(221, 90, 'Jelly Bean', '2021-03-11 03:31:49', NULL, NULL),
(222, 90, 'KitKat', '2021-03-11 03:31:49', NULL, NULL),
(223, 90, 'Lollipop', '2021-03-11 03:31:49', NULL, NULL),
(224, 89, '1 GB', '2021-03-16 13:35:32', NULL, NULL),
(225, 89, '2 GB', '2021-03-16 13:35:32', NULL, NULL),
(226, 89, '3 GB', '2021-03-16 13:35:32', NULL, NULL),
(227, 89, '4 GB', '2021-03-16 13:35:32', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `ad_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `ad_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(96, 1, 107, '2021-02-09 06:38:40', NULL, NULL),
(97, 10, 106, '2021-02-09 11:55:28', NULL, NULL),
(98, 19, 106, '2021-02-22 02:17:17', NULL, NULL),
(101, 1, 106, '2021-03-17 06:40:00', NULL, NULL);

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
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `module_name` varchar(100) NOT NULL,
  `is_status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `module_name`, `is_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'User Group', '1', '2019-03-29 12:25:19', '2021-03-04 17:16:46', NULL),
(2, 'User', '1', '2019-03-29 12:25:19', '2021-03-05 10:27:06', NULL),
(3, 'Category', '1', '2019-12-10 14:44:55', '2021-03-05 10:27:12', NULL),
(4, 'Ad', '1', '2019-12-10 14:44:55', '2021-03-05 10:27:27', NULL),
(5, 'City, Division & Area', '1', '2019-12-10 14:44:55', '2021-03-05 13:29:41', NULL),
(6, 'Field', '1', '2019-12-10 14:46:45', '2021-03-05 10:28:17', NULL),
(7, 'Config', '1', '2019-12-10 14:47:41', '2021-03-05 10:28:20', NULL),
(8, 'Translate', '1', '2019-12-11 12:04:56', '2021-03-05 10:28:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(10) UNSIGNED NOT NULL,
  `sender_id` int(10) UNSIGNED NOT NULL,
  `receiver_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `body` varchar(100) NOT NULL,
  `meta_data` text NOT NULL,
  `is_read` enum('0','1') NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `sender_id`, `receiver_id`, `title`, `body`, `meta_data`, `is_read`, `created_at`, `updated_at`, `deleted_at`) VALUES
(21, 71, 65, 'Like', 'Honda 220 liked by Akram', 'a:2:{s:2:\"id\";i:13;s:4:\"type\";s:4:\"like\";}', '1', '2021-02-10 07:43:10', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('shivam.codemegsoft@gmail.com', '$2y$10$k/YyeiDWAe8Awq/NNPa.O.3aVF2hE6jjBSIADLOSyIPv7ck9wJXZ6', '2021-02-25 18:54:09'),
('shivamyadav8959@gmail.com', '$2y$10$BvQJV.5C2HK1o7l8UB2J/.TrVd/7vkdGeimNqZZ6YwUssG1g98n9O', '2021-03-17 13:43:22'),
('akramulhoque2016@gmail.com', '$2y$10$0X8wkJ2gY282L5jtQ.z.iu4iVmXcG36uhVdZ5N9mjVGONPKBSsuv6', '2021-03-20 03:13:13');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `permission_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `permission_name`, `module_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Show', 1, NULL, NULL, NULL),
(2, 'Create', 1, NULL, NULL, NULL),
(3, 'Update', 1, NULL, NULL, NULL),
(4, 'Delete', 1, NULL, NULL, NULL),
(5, 'Show', 2, NULL, NULL, NULL),
(6, 'Active', 2, NULL, NULL, NULL),
(7, 'Reset Password', 2, NULL, NULL, NULL),
(8, 'Delete', 2, NULL, NULL, NULL),
(9, 'Show', 3, NULL, NULL, NULL),
(10, 'Create', 3, NULL, NULL, NULL),
(11, 'Update', 3, NULL, NULL, NULL),
(12, 'Delete', 3, NULL, NULL, NULL),
(13, 'Show', 4, NULL, NULL, NULL),
(14, 'Reject', 4, NULL, NULL, NULL),
(15, 'Approve', 4, NULL, NULL, NULL),
(16, 'Delete', 4, NULL, NULL, NULL),
(17, 'Show', 5, NULL, NULL, NULL),
(18, 'Create', 5, NULL, NULL, NULL),
(19, 'Update', 5, NULL, NULL, NULL),
(20, 'Delete', 5, NULL, NULL, NULL),
(21, 'Show', 6, NULL, NULL, NULL),
(22, 'Create', 6, NULL, NULL, NULL),
(23, 'Update', 6, NULL, NULL, NULL),
(24, 'Delete', 6, NULL, NULL, NULL),
(25, 'Show', 7, NULL, NULL, NULL),
(27, 'Update', 7, NULL, NULL, NULL),
(29, 'Show', 8, NULL, NULL, NULL),
(30, 'Update', 8, NULL, NULL, NULL),
(33, 'Show', 9, NULL, NULL, NULL),
(34, 'Create', 9, NULL, NULL, NULL),
(35, 'Update', 9, NULL, NULL, NULL),
(36, 'Delete', 9, NULL, NULL, NULL),
(37, 'Show', 10, NULL, NULL, NULL),
(38, 'Create', 10, NULL, NULL, NULL),
(39, 'Update', 10, NULL, NULL, NULL),
(40, 'Delete', 10, NULL, NULL, NULL),
(41, 'Show', 11, NULL, NULL, NULL),
(42, 'Create', 11, NULL, NULL, NULL),
(43, 'Update', 11, NULL, NULL, NULL),
(44, 'Delete', 11, NULL, NULL, NULL),
(45, 'Show', 12, NULL, NULL, NULL),
(46, 'Create', 12, NULL, NULL, NULL),
(47, 'Update', 12, NULL, NULL, NULL),
(48, 'Delete', 12, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `role_id` int(11) UNSIGNED NOT NULL,
  `permission_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(5, 13),
(5, 9),
(5, 17),
(5, 25),
(7, 13),
(8, 13);

-- --------------------------------------------------------

--
-- Table structure for table `report_ads`
--

CREATE TABLE `report_ads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ad_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(100) DEFAULT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) UNSIGNED NOT NULL,
  `role_slug` varchar(255) NOT NULL,
  `role_title` varchar(80) NOT NULL,
  `role_level` tinyint(4) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_slug`, `role_title`, `role_level`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '', 'Super User', 1, '', '1', '2019-12-10 09:04:55', '2021-03-04 12:02:23', NULL),
(2, '', 'Manager', 2, '', '1', '2019-12-10 09:05:13', '2021-03-04 13:29:28', NULL),
(3, '', 'Team', 0, NULL, '1', '2021-03-05 05:51:49', '2021-03-05 05:51:49', NULL),
(4, '', 'Ads Team', 0, NULL, '1', '2021-03-11 12:46:48', '2021-03-11 12:46:48', NULL),
(5, '', 'Test', 0, NULL, '1', '2021-03-17 06:46:20', '2021-03-17 06:46:20', NULL),
(6, '', 'Team 1', 0, NULL, '1', '2021-03-17 06:49:48', '2021-03-17 06:51:04', '2021-03-17 06:51:04'),
(7, '', 'Test Team', 0, NULL, '1', '2021-03-17 07:24:44', '2021-03-17 07:24:44', NULL),
(8, '', 'Test Team 1', 0, NULL, '1', '2021-03-17 07:25:39', '2021-03-17 07:25:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '2',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `first_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `is_active` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `device_token` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_type` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `lang` enum('en','bn') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `is_online` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `last_seen` datetime DEFAULT NULL,
  `login_by` enum('manually','facebook','google','') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'manually',
  `social_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_varify_email` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `otp` int(11) DEFAULT NULL,
  `otp_expiry_time` datetime DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_notify` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `delete_reason` text CHARACTER SET utf8 COLLATE utf8_bin,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `first_name`, `last_name`, `email`, `phone`, `address`, `is_active`, `device_token`, `profile_image`, `password`, `device_type`, `lang`, `is_online`, `last_seen`, `login_by`, `social_id`, `is_varify_email`, `otp`, `otp_expiry_time`, `remember_token`, `is_notify`, `delete_reason`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'admin', NULL, NULL, 'admin@gmail.com', '9999999999', NULL, '1', 'f--Te9XWm8H7KEKOT-miSY:APA91bFPN1GP1lr5YIaCe4NUZSIsw8SYzcIxJy3WOdLnXOJhrlWdWmQ1a2M40yqvRi-B3YjkadyWo0Y4278TobjAYT_eaIwNMJyEWLdcIgFMkgO2bWokIUBRp84xm3DtTWiYK0NxXH-K', 'rdogi3iMgP.1602658747.jpeg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'CIRHB61m8SECbgqPrcn50JEFOTNmxJ3onvWQpKd08E39ClwsOb3I5C3S04Mg', '1', NULL, '2020-10-13 18:30:00', '2021-03-12 00:25:15', NULL),
(2, 2, 'Mohammad Naim', NULL, NULL, 'mohammad.naim@malinator.com', '9632587412', NULL, '1', '', 'rdogi3iMgP.1602658747.jpeg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'DuWRqcv9jZMlBBcCZPZZOWLWui23hqqbtnHSzDr8ZHFeCPV85lgNbG8YlKOA', '1', NULL, NULL, '2021-01-02 12:21:57', NULL),
(17, 2, 'Afif Hossain', NULL, NULL, 'afif.hossain@malinator.com', '9632587412', NULL, '1', NULL, 'rdogi3iMgP.1602658747.jpeg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL),
(18, 2, 'Abu Jayed', NULL, NULL, 'abu.jayed@malinator.com', '96325874121', 'Lorem ipsum', '1', '', 'SJgGhHQHcj.1603885705.jpeg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'c3WTMBQD6PvpOlNG6RQk3DxjVVDMuFGzVSIchO5EWN6lzxhR0ruqqc0j6i0F', '1', NULL, NULL, '2021-01-02 09:19:02', NULL),
(19, 2, 'Ariful Haque	', NULL, NULL, 'ariful.haque@malinator.com', '9632587412', NULL, '1', NULL, 'rdogi3iMgP.1602658747.jpeg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL),
(20, 2, 'Fazle Mahmud', NULL, NULL, 'fazle.mahmud@malinator.com', '9632587412', NULL, '1', '', 'rdogi3iMgP.1602658747.jpeg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'atQzK1NxDcsih3DpEakTGHHq3vLPRzPmEB9gxF5TkOb7NmF2gbm1c06q2c8H', '1', NULL, NULL, '2021-01-02 09:18:05', NULL),
(21, 2, '	Nazmul Islam', NULL, NULL, '	nazmul.islam@malinator.com', '9632587412', NULL, '1', NULL, 'rdogi3iMgP.1602658747.jpeg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL),
(22, 2, 'Abu Hider', NULL, NULL, 'abu.hider@malinator.com', '9632587412', NULL, '1', NULL, 'rdogi3iMgP.1602658747.jpeg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL),
(23, 2, 'Mohammad Saifuddin', NULL, NULL, 'mohammad.saifuddin@malinator.com', '9632587412', NULL, '1', NULL, 'rdogi3iMgP.1602658747.jpeg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL),
(24, 2, 'Sunzamul Islam', NULL, NULL, 'sunzamul.islam@malinator.com', '9632587412', NULL, '1', NULL, 'rdogi3iMgP.1602658747.jpeg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL),
(25, 2, 'Mehidy Hasan', NULL, NULL, 'mehidy.hasan@malinator.com', '9632587412', NULL, '1', NULL, 'rdogi3iMgP.1602658747.jpeg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL),
(26, 2, 'Tanbir Hayder', NULL, NULL, 'tanbir.hayder@malinator.com', '9632587412', NULL, '1', NULL, 'rdogi3iMgP.1602658747.jpeg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL),
(27, 2, 'Subashis Roy', NULL, NULL, 'subashis.roy@malinator.com', '9632587412', NULL, '1', NULL, 'rdogi3iMgP.1602658747.jpeg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL),
(28, 2, 'Nurul Hasan	', NULL, NULL, 'nurul.hasan@malinator.com', '9632587412', NULL, '1', NULL, 'rdogi3iMgP.1602658747.jpeg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL),
(29, 8, '	Mosaddek Hossain', NULL, NULL, 'mosaddek. hossain@malinator.com', '9632587412', NULL, '1', NULL, 'rdogi3iMgP.1602658747.jpeg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, NULL, '2020-10-14 01:57:22', NULL),
(30, 2, 'Mustafizur Rahman', NULL, NULL, 'mustafizur.rahman@malinator.com', '9632587412', NULL, '1', NULL, 'rdogi3iMgP.1602658747.jpeg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL),
(31, 2, 'Liton Das	', NULL, NULL, 'liton.das@malinator.com', '9632587412', NULL, '1', NULL, 'rdogi3iMgP.1602658747.jpeg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL),
(32, 2, 'Taijul Islam', NULL, NULL, 'taijul.islam@malinator.com', '9632587412', NULL, '1', NULL, 'rdogi3iMgP.1602658747.jpeg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL),
(33, 2, 'Soumya Sarkar	', NULL, NULL, 'soumya.sarkar@malinator.com', '9632587412', NULL, '1', NULL, 'rdogi3iMgP.1602658747.jpeg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL),
(34, 2, 'Jubair Hossain', NULL, NULL, 'jubair.hossain@malinator.com', '9632587412', NULL, '1', NULL, 'rdogi3iMgP.1602658747.jpeg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL),
(35, 2, 'Sabbir Rahman', NULL, NULL, 'sabbir.rahman@malinator.com', '9632587412', NULL, '1', NULL, 'rdogi3iMgP.1602658747.jpeg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL),
(36, 2, 'Taskin Ahmed', NULL, NULL, 'taskin.ahmed@malinator.com', '9632587412', NULL, '1', NULL, 'rdogi3iMgP.1602658747.jpeg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', 'sdf', NULL, '2021-02-24 19:49:48', '2021-02-24 12:49:48'),
(37, 2, 'Sabbir Rahman	', NULL, NULL, 'sabbir.rahman@malinator.com', '9632587412', NULL, '1', NULL, 'rdogi3iMgP.1602658747.jpeg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', 'jjjj', NULL, '2021-02-24 19:50:48', '2021-02-24 12:50:48'),
(38, 2, 'Taskin Ahmed', NULL, NULL, 'taskin.ahmed@malinator.com', '9632587412', NULL, '1', NULL, 'rdogi3iMgP.1602658747.jpeg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', 'Lorem ipsum', NULL, '2021-02-25 13:17:01', '2021-02-25 06:17:01'),
(39, 2, 'Mohammad Mithun', NULL, NULL, 'mohammad.mithun@malinator.com', '9632587412', NULL, '1', NULL, 'rdogi3iMgP.1602658747.jpeg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL),
(40, 2, 'Shivam Yadav', NULL, NULL, 'shivamyadav@gmail.com', '7974682508', NULL, '1', NULL, NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, '2020-10-16 07:46:57', '2020-10-16 07:46:57', NULL),
(42, 2, 'Shivam Yadav', NULL, NULL, 'rakesh@gmail.com', '9632587410', NULL, '1', NULL, NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, '2020-10-16 07:48:48', '2020-10-16 07:48:48', NULL),
(43, 2, 'Santosh Yadav', 'Santosh', 'Yadav', 'santosh.yadav@gmail.com', '9926442334', NULL, '1', NULL, NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, '2020-10-16 07:49:20', '2020-10-16 07:54:02', NULL),
(45, 2, 'Aakash Tirole', NULL, NULL, 'akash.tirole@gmail.com', NULL, NULL, '1', NULL, NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, '2020-10-21 04:11:44', '2020-10-21 04:11:44', NULL),
(46, 2, 'satish', NULL, NULL, 'satish@gmail.com', NULL, NULL, '1', NULL, NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, '4ayMA0KNISxLX0ioN3qFg6UoNVXZLqLAtdQOOWltODlzYYLYlRQh0CPaFKQj', '1', NULL, '2020-10-29 00:06:16', '2020-10-29 00:06:16', NULL),
(47, 2, 'Kamalesh', NULL, NULL, 'kamakesh@gmail.com', NULL, NULL, '1', NULL, NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'y0vTaE70aIQ0SzcaNpPmTZUU9oEUGxOL7kqyUq6792rC0la82wHSPkdPHJkw', '1', NULL, '2020-10-29 00:08:51', '2020-10-29 00:08:51', NULL),
(48, 2, 'Hardik', NULL, NULL, 'hardik@gmail.com', NULL, NULL, '1', NULL, NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, '4hs7s7V17gT2M10ZVi8sHFWWVVtlNTLY7BwleAuKur66fycUDrBtEMavuQ7G', '1', NULL, '2020-10-29 00:09:40', '2020-10-29 00:09:40', NULL),
(49, 2, 'Shivani', NULL, NULL, 'shivani@gmail.com', NULL, NULL, '1', NULL, NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, '0NU7ZIxRtpPyV7Nsbh3ZVCaUiHgg4dlGn3dmcIcg5FAjZgKVp8SMKlfxg1hS', '1', NULL, '2020-10-29 00:11:09', '2020-10-29 00:11:09', NULL),
(50, 2, 'pankaj', NULL, NULL, 'pankaj@gmail.com', NULL, NULL, '1', NULL, NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, '7mNBkxiPg1fV3JogzKHFiknvPx9nfcoEBdClBzQf2jV87Asn2Y12GR3LCfwQ', '1', NULL, '2020-10-29 00:13:47', '2020-10-29 00:13:47', NULL),
(51, 2, 'Pukharaj Dev', NULL, NULL, 'pukhraj@gmail.com', NULL, NULL, '1', NULL, NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', '', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'ndlcdqMC58FEFsoDOk7Mi8Cke8Gpr9u8gY2hmAI4Pss7b58avAyPjmYFw8uC', '1', NULL, '2020-10-29 00:17:25', '2020-10-29 00:17:25', NULL),
(52, 2, 'Rajiv Pandey', NULL, NULL, 'rajib@gmail.com', NULL, NULL, '1', NULL, NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'fNahIPi5yU4uZguRBzvkiOGHpT5zrZ1PdbWymqOjaVNQqfDz4rosoUaMY0y4', '1', NULL, '2020-10-29 00:37:11', '2020-10-29 00:44:22', NULL),
(53, 2, 'Tahir', NULL, NULL, 'tahir@gmail.com', NULL, NULL, '1', NULL, NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'QMUerOTtUyyfS6zXGk2eIL0ySTKJ01qFAIBWx4RlZnLOAoGmZnwFNyeTneg5', '1', NULL, '2020-10-29 01:01:17', '2020-10-29 01:01:17', NULL),
(54, 2, 'Tipendra Raj', NULL, NULL, 'tipendra@gmail.com', NULL, NULL, '1', NULL, NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'L2cFmH5zles3s7WahWHhwCmZCZLT0RQgZsbPm9lAODHfKvaibsy6kiU8ZsZC', '1', NULL, '2020-10-29 01:02:45', '2020-10-29 01:02:45', NULL),
(55, 2, 'Gajendra Rathor', NULL, NULL, 'gajendra@gmail.com', NULL, NULL, '1', NULL, NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'RhjUJTlqlLj9JhPMe3XKZj5VQ6GrJ615CXF7xpc183X2B6fm3V1UPeG57S0P', '1', 'Lorem ipsum', '2020-10-29 01:11:05', '2021-02-25 18:59:41', '2021-02-25 11:59:41'),
(56, 2, 'Jagdishan Tiwari', NULL, NULL, 'jagdishan@gmail.com', NULL, NULL, '1', NULL, NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'KUvtunrBkyvzYWClSSOHcdxdB6QUTuOS9Vt0Uk1TdfrGTW6diQZPVxeo4sis', '1', NULL, '2020-10-29 01:59:15', '2020-10-29 01:59:15', NULL),
(57, 2, 'Raaman Dev', NULL, NULL, 'raman@gmail.com', NULL, NULL, '1', NULL, NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'g7f1JTnPcCOtvdE5kJP3BkZZ8V3GQ6b4LwKQtsrQwxPvgfWf3AWArvEBMHWl', '1', NULL, '2020-10-29 02:01:21', '2020-10-29 02:01:21', NULL),
(58, 2, 'Vipin Tiwari', 'Vipin Tiwari', 'Vipin Tiwari', 'vipin@gmail.com', '78541269', NULL, '1', NULL, NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'bn', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, '2020-11-05 02:14:03', '2020-11-05 02:14:03', NULL),
(59, 2, 'Ravendra Tiwari', 'Ravendra Tiwari', 'Ravendra Tiwari', 'ravendra@gmail.com', '1593574568', NULL, '1', 'FDJS3493483fDFDK349334', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, '2020-11-05 02:16:23', '2020-11-05 02:16:23', NULL),
(60, 2, 'Satish Patidar', 'Satish Patidar', 'Satish Patidar', NULL, NULL, NULL, '1', 'FDJFKD348DJFD9934', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'facebook', NULL, '1', NULL, NULL, NULL, '1', NULL, '2020-11-05 02:35:59', '2020-11-05 02:35:59', NULL),
(61, 2, 'Satish Patidar', 'Satish Patidar', 'Satish Patidar', NULL, NULL, NULL, '1', 'FDJFKD348DJFD9934', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'facebook', NULL, '1', NULL, NULL, NULL, '1', NULL, '2020-11-05 02:36:03', '2020-11-05 02:36:03', NULL),
(62, 2, 'Satish Patidar', 'Satish Patidar', 'Satish Patidar', NULL, NULL, NULL, '1', 'FDJFKD348DJFD9934', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'facebook', NULL, '1', NULL, NULL, NULL, '1', NULL, '2020-11-05 02:36:05', '2020-11-05 02:36:05', NULL),
(63, 2, 'Satish Patidar', 'Satish Patidar', 'Satish Patidar', NULL, NULL, NULL, '1', 'FDJFKD348DJFD9934', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'facebook', 'FDJFKD348DJFD9934', '1', NULL, NULL, NULL, '1', NULL, '2020-11-05 02:37:16', '2020-11-07 10:54:38', NULL),
(64, 2, 'Pankaj Tiwari', 'Pankaj Tiwari', 'Pankaj Tiwari', 'pankaj.gotam@gmail.com', '15935745468', 'Lorem ipsum', '1', 'FDJS3493483fDFDK349334', 'hLeTHTZXyr.1604571777.jpeg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, '2020-11-05 04:31:50', '2020-11-20 03:15:29', NULL),
(65, 2, 'ambuj tripathi', 'ambuj tripathi', 'ambuj tripathi', 'ambuj@gmail.com', '7566380832', 'undefined', '1', 'null', 'ixI3Mh2dym.1615963825.jpg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '2', 'bn', '0', NULL, 'manually', NULL, '1', 7261, '2021-02-10 07:51:04', '8xjlXWRgtx9YyqSt5HvmDSxpqBXhm8njUbYeMWIuK4SNaEjLVxnZwsEp6TuG', '1', NULL, '2020-11-19 12:04:01', '2021-03-18 11:56:53', NULL),
(66, 2, 'Sajan Singh', 'Sajan Singh', 'Sajan Singh', 'sajan.singh@gmail.com', NULL, NULL, '1', 'null', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'rX1OhJCrHTDAYtVWCgKMyDZfllv6IYEIMVxoqEAPew6sqQh9OTqWVr7g2W4L', '1', NULL, '2020-11-24 14:48:14', '2020-11-24 14:48:14', NULL),
(67, 2, 'Shivani', 'Shivani', 'Shivani', 'shivanijain0604@gmail.com', NULL, NULL, '1', 'null', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'unf54AOhFXUFvkxO1DQsKW7aUHGFQQL9cZD10UpgHSCpLOe1DTqYs2958kUg', '1', NULL, '2020-11-25 03:59:47', '2020-11-25 23:59:01', NULL),
(68, 2, 'ramlal', 'ramlal', 'ramlal', 'ramlal@gmail.com', NULL, NULL, '1', 'null', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'v3hvKSBbKIYf4iPYwBTcQogkdRVTfyklFPlWd03qod7ImiE829gma25puL97', '1', NULL, '2020-11-25 09:07:26', '2020-11-25 09:07:26', NULL),
(69, 2, 'Aakash', 'Aakash', 'Aakash', 'aakash@gmal.com', NULL, NULL, '1', 'null', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, '2020-12-03 12:18:37', '2020-12-03 12:18:37', NULL),
(70, 2, 'Chetan', 'Chetan', 'Chetan', 'chetan@gmail.com', NULL, NULL, '1', 'null', 'wE4bXK7Svw.1607001930.jpg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'oOsoEtUAFYTAnbBEtlNvEYaph6TBrzZk8RPYbbeuf5481PqycI0JlFaoQT4K', '1', NULL, '2020-12-03 12:20:29', '2020-12-03 12:25:30', NULL),
(71, 3, 'Akramul Hoque', 'Akramul Hoque', 'Akramul Hoque', 'akramulhoque2016@gmail.com', '971569901799', 'undefined', '1', 'djWPQDpLdcLCFssqkIJyf7:APA91bHKtRt5PmBPq2ps0UlHNkM6mU3182BdXo2JlUeTC5de_mEhzsiRV1bqTMChQXVthYjjX0yZ41r7z5rJGwFoIMgJ0AT1aj5_PPVM-_UBpzBRghLXY1bdYYDoBxjE-oQKi9QtFbKd', '5bhmwetfy4.1611948154.jpg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '', 'en', '0', NULL, 'manually', NULL, '1', 6754, '2021-02-26 08:26:48', 'MD7j477MoAFQIDofBs42SN9IPSEW9oW2UsUyWKAG0uSo3JPLzp3X2jd1fjhX', '1', NULL, '2020-12-03 14:46:21', '2021-03-20 05:55:30', NULL),
(72, 2, 'MH Masum', 'MH Masum', 'MH Masum', 'masumpride@gmail.com', NULL, NULL, '1', 'null', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, '2HOX325cGVO7EqWiIEf564Z8zIBqjGPUA08codmd0mih4dcMEOjAogN9Am7p', '1', NULL, '2020-12-09 13:38:50', '2020-12-09 13:38:50', NULL),
(73, 2, 'aakash', 'aakash', 'aakash', 'aakash@gmail.com', NULL, NULL, '1', 'null', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'G21HCvOElBkjhk8yKm5126ZXG98NPwPQEVrgGptVhjocjBKwviSEvpQ11CEx', '1', NULL, '2020-12-11 07:02:04', '2020-12-11 07:02:04', NULL),
(74, 2, 'Ravi', 'Ravi', 'Ravi', 'ravi@gmail.com', NULL, NULL, '1', 'null', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'mjXO0bebTEvquD9OkaLTFc0Nr6oHjykCKYvDMa5LPJlIBJmdyR4WZ261Nek0', '1', NULL, '2020-12-23 10:47:57', '2020-12-23 10:47:57', NULL),
(75, 2, 'Akram123', 'Akram123', 'Akram123', 'akramulhoque2025@gmail.com', NULL, NULL, '1', 'f--Te9XWm8H7KEKOT-miSY:APA91bFPN1GP1lr5YIaCe4NUZSIsw8SYzcIxJy3WOdLnXOJhrlWdWmQ1a2M40yqvRi-B3YjkadyWo0Y4278TobjAYT_eaIwNMJyEWLdcIgFMkgO2bWokIUBRp84xm3DtTWiYK0NxXH-K', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'pOVrw6mVZg3Xm2C0yprHl67gpYSQlLflTTDAsPlSrsoRcMnjC15mTHDp9NO2', '1', NULL, '2020-12-24 05:54:09', '2021-02-23 03:46:12', NULL),
(76, 2, 'Aakash Tirole', 'Aakash Tirole', 'Aakash Tirole', 'aakash.tirole@gmail.com', '231232134', NULL, '1', NULL, NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, '2020-12-29 05:32:36', '2020-12-29 05:32:36', NULL),
(77, 2, 'Aakash Tirole', 'Aakash Tirole', 'Aakash Tirole', 'kapil@gmail.com', '2312321345', NULL, '1', NULL, NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, '2020-12-29 05:33:59', '2020-12-29 05:34:13', NULL),
(78, 2, 'Akramul Hoque', 'Akramul Hoque', 'Akramul Hoque', NULL, NULL, NULL, '1', 'efUbm6Qg0-E:APA91bGDDknxZHJE3kHr9atGpUFwi7SiqYFkaExjP8gostrATU_BBq8VVcBavJfR7OQsoyjs77jBGpNHwGx_h7r9p7GHBzXu4f2jxBCwq3B0nm-fzcyEL7JfOOPwn7vFkKiLVAzBsyiw', 'j6Vwh1BEox.1614258658.jpg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '2', 'en', '0', NULL, '', '104505616927530263960', '1', NULL, NULL, NULL, '1', 'test', '2020-12-30 12:45:01', '2021-03-20 03:14:50', '2021-03-19 20:14:50'),
(79, 2, 'Ambuj Tripathi', 'Ambuj Tripathi', 'Ambuj Tripathi', NULL, NULL, NULL, '1', 'crL0pg3o708:APA91bEoceVbNT32VhEWOeL5zRPyZ_E59Ds0OiH55vTT11Bq8vmvvpC4ciYewIL4TqyTOHd4MILVNjUz1SeM6oY0yGctlCGiBjlmvbK2zvGknePe7E2a5c0gn8GOSt4dpOga-fXZdF0i', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, '', '116215471948298793668', '1', NULL, NULL, NULL, '1', NULL, '2020-12-31 04:46:20', '2021-02-25 19:44:22', NULL),
(80, 2, 'ajay', 'ajay', 'ajay', NULL, NULL, NULL, '1', NULL, NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'google', 'fsdf3243223432', '1', NULL, NULL, NULL, '1', NULL, '2020-12-31 05:03:26', '2020-12-31 05:13:24', NULL),
(81, 2, 'Mamun', 'Mamun', 'Mamun', 'mamunfeni@yahoo.com', '1234567890', NULL, '0', 'djVBSVTMZBA:APA91bGgtAOggsVXdshBa0RyL8T9O0GBoJTunISCYmf6EAvs6XoauZVk-lgmUI8L2Bm-AX_1AQN4nQcOrY5gvH3db4mzvtFtYPHKdbMkbqAjNcqTWBpOjGO51VfwgqIJ5-tq5Wnq_eUv', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'KQc9K56senWC5lssdGhx5tvFzrFpgKgR0uejOylhYxI8GPii11FsVwr6ECcd', '1', 'test', '2020-12-31 05:12:23', '2021-02-25 03:55:49', '2021-02-24 20:55:49'),
(82, 2, 'vikash', 'vikash', 'vikash', NULL, NULL, NULL, '1', NULL, NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'google', 'fsdf3243223432rftgertret', '1', NULL, NULL, NULL, '1', NULL, '2020-12-31 05:14:11', '2020-12-31 05:14:11', NULL),
(83, 2, 'akramul hoque', 'akramul hoque', 'akramul hoque', 'null', 'null', 'null', '0', 'eiVWIqbApmU:APA91bHjjYJHa2g433MTootnoZ5wpjJ2VpnURCtaUnWnCRiurl0tunqzDf_1rMPz2UGLZ5pEA9VyAQjf463Yudb7nlPp_07MQ-yTk3YbxI5jhVNNn_Bsw3C9teoYuG_GxzjYpT6HdcdW', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, '', '116595350181198039507', '1', NULL, NULL, NULL, '1', NULL, '2020-12-31 13:49:28', '2021-02-25 03:55:13', NULL),
(89, 2, 'ambuj', 'ambuj', 'ambuj', 'ambuj12@gmail.com', '1234567890', NULL, '1', 'cmmAu106_Gg:APA91bELY1s7x-QFbzDCs8U2nPMzG0fPcDLSd2M_SnQUIyw1BnmqSGGsiT1sJMZOB9RvC7Hr32xWkKHlcw7eDKnkUFZ7mj2JdPqSQSQDAqQjgY6iQQLpVQL5QelaZxxAknCn08iqvEiJ', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'HDYZcjRtfxFVijca9MGUasHW8nbRGFafQ1RZT9E5huwmhaOyUBdYbKTkIxuw', '1', NULL, '2021-01-04 05:00:11', '2021-01-04 10:12:38', NULL),
(90, 2, 'ssimmons', 'ssimmons', 'ssimmons', 'ssimmons1008@gmail.com', '1234567890', NULL, '1', 'null', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, '2021-01-04 05:01:32', '2021-01-04 05:01:32', NULL),
(91, 2, 'Bangla', 'Bangla', 'Bangla', 'prankbangla@gmail.com', '1234567890', NULL, '1', 'dEBlB-9cPJE:APA91bEe7G5_0yE8bAXB3-mBn5P6RCKNkIjTdBy3Bwbo_ZmOCdFl1e-hqPSjFYEo-04ziKMBt-IvGLQBtcW-96hk-4ceC_QBVa59AeSc8Py7dvWHkztaCwTcGSr3ALjnkpoRMxudF-hy', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', 'test', '2021-01-04 19:23:45', '2021-02-25 03:51:10', '2021-02-24 20:51:10'),
(92, 2, 'Ravendra Tiwari', 'Ravendra Tiwari', 'Ravendra Tiwari', NULL, NULL, NULL, '1', 'c7aGasodx9k:APA91bG4h6fUNWYr7hEH72m45BdK7Sl0m-3K5J8M95duGZvQwKEK0FQdGn023qnM0LVq4T3BcgR1lVSzW9b9TaEvLyh0-3qJnQrTCjJ0Ig8PoOakOsWhjb81AG2pkh1ZzSwHNjWrTJ7c', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, '', '104655594174814149492', '1', NULL, NULL, NULL, '1', NULL, '2021-01-05 12:19:59', '2021-01-05 12:19:59', NULL),
(93, 2, 'Shiv', 'Shiv', 'Shiv', 'shifds@mailinator.com', '', NULL, '1', NULL, NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, '2021-01-06 11:36:21', '2021-01-06 11:36:21', NULL),
(94, 2, 'Mahi', 'Mahi', 'Mahi', 'akramul.haque@mab.ae', '1234567890', NULL, '1', 'eiVWIqbApmU:APA91bHjjYJHa2g433MTootnoZ5wpjJ2VpnURCtaUnWnCRiurl0tunqzDf_1rMPz2UGLZ5pEA9VyAQjf463Yudb7nlPp_07MQ-yTk3YbxI5jhVNNn_Bsw3C9teoYuG_GxzjYpT6HdcdW', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', 'test user', '2021-01-09 16:06:08', '2021-02-11 11:36:29', '2021-02-11 12:36:29'),
(95, 2, 'ajju', 'ajju', 'ajju', 'ajju@gmail.com', '1234567890', NULL, '1', 'null', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, '2021-01-18 03:56:45', '2021-01-18 03:56:45', NULL),
(96, 2, 'Hshsbeh', 'Hshsbeh', 'Hshsbeh', 'am@gmail.com', '1234567890', NULL, '1', 'e92da7f76c9cc90d686a278bbed79c813367d70e39390fb10422803af046c07f', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, '2021-01-20 09:34:41', '2021-01-20 09:34:41', NULL),
(97, 2, 'Asda', 'Asda', 'Asda', 'asd@gmail.com', '1234567890', NULL, '1', 'e92da7f76c9cc90d686a278bbed79c813367d70e39390fb10422803af046c07f', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, '2021-01-20 09:35:56', '2021-01-20 09:35:56', NULL),
(98, 2, 'MH Masum', 'MH Masum', 'MH Masum', 'masum_feni@yahoo.com', '1234567890', NULL, '1', 'fhOhhRmV6NI:APA91bEvXaGnkYdRwO7f85T_JgW66gyM1qFOUvdaQ7ArxOurYOl9NUeRGP251cSNqKNTf-c3JYCZm7jyhf2AtEqY6SQA53hNJjSYWxDNc71cLm4_Os0E9WOIhibhlRtO2giCW92YDFvI', 'SGG55Ff0WA.1611161864.jpg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'swPWZEsOgRX5iSwoiAgk5WSsCHnaY6bnsVCgnEMpZmmYI6GVIsbadOYNLo98', '1', NULL, '2021-01-20 15:51:16', '2021-03-17 19:04:04', NULL),
(99, 2, 'Kroy Kari', 'Kroy Kari', 'Kroy Kari', 'kroykari.com@gmail.com', NULL, NULL, '1', 'eblQPdba6vY:APA91bFhByIHqM6AwMVryJ1pmsh0URrFcqOPRbyDUoonkyom1ZW96gQH9AymIrr5ZjfrcVs1oDwwqPGD7cOhS4y9aG7TrDToKYYMjKEjmhbg_JDkr_Sdx3URY3Uc9ZMabZoeXA5DO2Jr', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'bn', '0', NULL, 'facebook', '128219052480734', '1', NULL, NULL, 'PVvggYz3qgUmvnWlcxRyHmczpZBrPEXpNx0YwZdLK7dQ9YTzbOpujYwJdFR2', '1', 'test', '2021-01-25 10:48:11', '2021-02-25 03:54:43', '2021-02-24 20:54:43'),
(100, 2, 'Test', 'Test', 'Test', 'ahoque@louvrebudhabi.ae', '1234567890', NULL, '0', 'null', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', 'Lorem ipsumn', '2021-01-29 12:03:41', '2021-02-11 11:31:23', '2021-02-11 12:31:23'),
(103, 2, 'Kroykari.com', 'Kroykari.com', 'Kroykari.com', 'kroykari.com@gmail.com', '1234567890', NULL, '0', 'f--Te9XWm8H7KEKOT-miSY:APA91bFPN1GP1lr5YIaCe4NUZSIsw8SYzcIxJy3WOdLnXOJhrlWdWmQ1a2M40yqvRi-B3YjkadyWo0Y4278TobjAYT_eaIwNMJyEWLdcIgFMkgO2bWokIUBRp84xm3DtTWiYK0NxXH-K', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'bRg8lqCL8ModfKpYkQiZPCs3DZfmyPsDXcmGHbnZpypOCrvF4Kg46mpaevL9', '1', 'test', '2021-02-01 09:20:09', '2021-02-26 03:06:27', '2021-02-25 20:06:27'),
(104, 2, 'ActionSceneヅ', 'ActionSceneヅ', 'ActionSceneヅ', NULL, NULL, NULL, '0', 'fFE8ANr_ykM:APA91bEcML2HJaUl2JOUfeHQmYFAO_JgIkY56bRWQTLGjAv4e2iS7lAfv7f_DbwupSXfMrFn8uf6lymQAoa6DgHAsDxqK5WRw59JhoQqJkJp7ZHFYCD3_Jbfcnp0gYs9URsFNXJOvh0Z', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, '', '106745504894847247221', '1', NULL, NULL, NULL, '1', 'test', '2021-02-05 13:10:54', '2021-02-25 03:54:15', '2021-02-24 20:54:15'),
(105, 2, 'Mahmudul Hoque', 'Mahmudul Hoque', 'Mahmudul Hoque', NULL, NULL, NULL, '1', 'fsPAIikjJX0:APA91bEEZQ5_b3MVCmLIiJlGBE_wH5tFUyfsJRDZYxWRtGgKOEPbibh0vbV0Bf5qkgJEnibycWN_UEQxMWacmJYz7tpiSZc2wgyYdMe6snzZeGbVjzJ0bSQ9jggAnzOyK5STLxoZBM8p', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, '', '100475413343603800865', '1', NULL, NULL, NULL, '1', 'test', '2021-02-06 05:54:00', '2021-02-24 23:50:41', '2021-02-24 16:50:41'),
(106, 2, 'Shivam Yadav', NULL, NULL, 'shivamyadav8959@gmail.com', '8959070299', 'G-248 kalandi Gold, Indore', '1', NULL, 'Eo3kKPUjt2.1612607622.jpeg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '', 'en', '0', NULL, 'manually', NULL, '1', 1685, '2021-02-10 07:47:11', '0z1JQTcxtPDzKnCMGopKm07QMnOYWv2ktNJHnxRRYD5twWyzPo5d8m3eQMsE', '1', NULL, '2021-02-06 09:32:02', '2021-03-20 00:12:44', NULL),
(107, 2, 'Ismael', NULL, NULL, 'ismael.codemegsoft@gmail.com', '9876543210', 'Indore', '1', 'f1rlDB3WfukD_gcCnbjEMN:APA91bGUazzOp_DmdbAGilX9c-FQ0c_HdkmwDm3XlGZSof0cBXcBcwHV1spS2zdJcWT1jFw36rewgY2zToGQZchk259AcFNTlFHY-bCvIX8cCZkkeVbJnGhf22U4GtGBaiMv8PLuThGu', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, '2021-02-09 04:38:00', '2021-02-25 20:36:27', NULL),
(108, 2, 'Ambuj Tripathi', 'Ambuj Tripathi', 'Ambuj Tripathi', NULL, NULL, NULL, '1', 'dMqblB2Xmo0:APA91bEW3ry6ZzFXQCDibK9CgFJo6H6Ni313quOANwYcsHwOcUe-5T0JdqSA0IyoUCmr4qW9O767xrjNkj_prZkaK6zQ-k6d3BTAbCylvjUzeiNKKIwBnOoxp5kdWFgBMW_UU-mquBYr', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, '', '3831949180235549', '1', NULL, NULL, NULL, '1', NULL, '2021-02-10 04:48:03', '2021-02-25 19:02:00', NULL),
(109, 2, 'Rxplus', 'Rxplus', 'Rxplus', 'boracay.rxplustwo2021@gmail.com', 'undefined', 'undefined', '1', 'e1Gdjvlurr4:APA91bE9EeMEGnGZPK46kqcyuVI0N7qETEWZOsQQz7-5cDSV2sy0jCj7619nfRRUmJTkBDuMFH5-BHVGGWtoqTVCKZLhgee3fS-f9srcIUitR-Gm4KUWQINMt1_xLEBlbohWjcFYi59v', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, '2021-02-10 13:28:53', '2021-02-10 13:31:23', NULL),
(110, 2, 'Mahmud', 'Mahmud', 'Mahmud', 'medicinecornerfeni@gmail.com', '1234567890', NULL, '1', 'foBjxNtrZOc:APA91bE6w28vmMEBPqflZPpqE1tFS27NzDSGgxVixvRovGsvx83u7aPxuPkUesHYRFl-eGwF3cr8O47qfpruzDYK3feTYPN8AaTdAe8BMYtqJ2S_PMmnsDu-0rXaH4tKqdfpIWWgMgDB', 'rQI4fcp7xU.1612975494.jpg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'bn', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, '2021-02-10 15:25:52', '2021-02-10 15:44:54', NULL),
(111, 2, 'Mamun55', 'Mamun55', 'Mamun55', 'akramulhoque@kroykari.com', '1234567890', NULL, '1', 'f--Te9XWm8H7KEKOT-miSY:APA91bFPN1GP1lr5YIaCe4NUZSIsw8SYzcIxJy3WOdLnXOJhrlWdWmQ1a2M40yqvRi-B3YjkadyWo0Y4278TobjAYT_eaIwNMJyEWLdcIgFMkgO2bWokIUBRp84xm3DtTWiYK0NxXH-K', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'a1ch4txRxl6Ksmp4DB23zVxmpdfdkxIvfAfdzP452NdZthsbHlnzhhfpIG72', '1', 'test', '2021-02-10 20:46:12', '2021-02-24 04:33:29', '2021-02-23 21:33:29'),
(112, 2, 'hello', NULL, NULL, 'csn.2014@hotmail.com', '0569901488', NULL, '1', 'f--Te9XWm8H7KEKOT-miSY:APA91bFPN1GP1lr5YIaCe4NUZSIsw8SYzcIxJy3WOdLnXOJhrlWdWmQ1a2M40yqvRi-B3YjkadyWo0Y4278TobjAYT_eaIwNMJyEWLdcIgFMkgO2bWokIUBRp84xm3DtTWiYK0NxXH-K', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'XeBiwFst21nPfvuzAtpkIfooDwZU5E5NIi5lcpt7Cc7oIRLPOcbjmM4gepdm', '1', 'Test', '2021-02-17 02:23:33', '2021-02-24 20:38:47', '2021-02-24 13:38:47'),
(113, 2, 'Shivam Yadav', NULL, NULL, 'shivam.codemegsoft@gmail.com', '7974682508', NULL, '1', NULL, NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'yS7A8PuFG84DA0TxD9gHSICEsk6tEBUG5T6P5zX3pHqD0bTuKIjSiHlNIHtB', '1', NULL, '2021-02-19 19:41:34', '2021-02-19 19:41:34', NULL),
(114, 2, 'saifjoy', NULL, NULL, 'saifjoy2007@yahoo.com', '0581700635', NULL, '1', NULL, NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, '2021-02-20 02:11:19', '2021-02-20 02:11:19', NULL),
(115, 2, 'Accrev', 'Accrev', 'Accrev', 'accrev45@gmail.com', '1234567890', NULL, '1', 'cZql3ICmjMs:APA91bHldER1AhbNnSoIffdiZFsPssWtkO0ZZVjpspaW4XRYf-6fv4B-aNWHml73Lw-7H1zm2qtY80uWuXEGqrb1T422DAtRYtTzGln6zFt6EC3gpajMv_30E8zpd2Plk5zjZ5huYbk3', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, '2021-02-23 18:12:52', '2021-02-23 18:12:52', NULL),
(116, 2, 'Akramul Haque', 'Akramul Haque', 'Akramul Haque', NULL, NULL, NULL, '0', 'deFj0SS--ek:APA91bHMcwOhgahQ8I41GSLLxrWM42PlgUfc4G_C3XmLk4KlbLLCS9JfdE_Q8iIHSt1C0NKC8hxVK76gYJWrnx8P33XQTLnWMsA3v5b5KjhXXguK5JDIXGox1uL_JsAFRmoGnNJd_rln', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, '', '10221780260429301', '1', NULL, NULL, NULL, '1', 'test', '2021-02-23 20:12:56', '2021-02-26 03:05:50', '2021-02-25 20:05:50'),
(117, 2, 'Akrm', 'Akrm', 'Akrm', 'ahoque@louvreabudhabi.ae', '1234567890', NULL, '1', 'esVj12OMTnE:APA91bGq0FpQpw0GLbCy26vZFBZIgYxDNruirxpJrJpKRoRi_u77PY-fWMiWj0JVgUzikqJ4RoCXvBGhrBGA-dYugUhPPDq69kRO49TDRsQg9wArcYkMnzdLURMb5rciv4hdQOGY7x0K', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', 'test', '2021-02-24 04:13:31', '2021-02-24 18:39:38', '2021-02-24 11:39:38'),
(118, 2, 'mamun1', NULL, NULL, 'mamun_feni@yahoo.com', '0569901799', NULL, '0', NULL, NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'Aov29ybeViS67HejNaHyvf12ng4XEascnCCCVGah1LnVHuinWReRcZcLq7xv', '1', 'test', '2021-02-25 03:59:03', '2021-02-26 03:06:03', '2021-02-25 20:06:03'),
(119, 2, 'vikash', 'vikash', 'vikash', 'vikash@gmail.com', '1234567890', NULL, '1', 'null', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'F9XN8Y0FhNsnYxUpZMra5rdliFTfOaA7ieB2TOedDLj7qco4nAr7c6OysIS5', '1', NULL, '2021-02-25 13:37:05', '2021-02-25 13:37:05', NULL),
(120, 2, 'Shibbu', 'Shibbu', 'Shibbu', 'moya.market.sa@gmail.com', '1234567890', 'undefined', '1', 'dMqblB2Xmo0:APA91bEW3ry6ZzFXQCDibK9CgFJo6H6Ni313quOANwYcsHwOcUe-5T0JdqSA0IyoUCmr4qW9O767xrjNkj_prZkaK6zQ-k6d3BTAbCylvjUzeiNKKIwBnOoxp5kdWFgBMW_UU-mquBYr', '12sXzjl3pC.1614246881.jpg', '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', 7840, '2021-02-25 10:19:51', 'udYURXO2loFUMuUemshuD47fGZngXeQeGxoz1044DyByNi0qG28FirVAJx28', '1', NULL, '2021-02-25 16:33:49', '2021-02-25 17:06:29', NULL),
(121, 2, 'Shivam Yadav', NULL, NULL, 'shivamy.codemegsoft@gmail.com', '8959070299', NULL, '1', NULL, NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'u3PL3vt6Q8Kdd8s4vGWW6jZupkKlwcFT6hEPi4ALZI8p7VW3kzePtjArlBKT', '1', NULL, '2021-02-25 18:53:34', '2021-03-20 12:32:18', NULL),
(122, 2, 'mamun', NULL, NULL, 'adstest491@gmail.com', '0527104084', NULL, '1', 'fjC7zXM7lf4:APA91bFeEkE9_7DnYmt4T-cTYJgnXDpHFktdo1G6e_Q5aQIZwXOrJTbjZcLqWOqqhpgBaXsH41-5v8BWYIT3GxvFpAIcCB8WIGv09Qu--rQxsd35qYvI0bQKaVpHHsMR2SJL7L59ovXL', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'RWW7naDu2ZGI0RldQxNMwtM5vh8ALe5qDeWH13ZG6t15aAtenSvZbihREjKC', '1', NULL, '2021-02-26 03:18:50', '2021-03-17 18:06:28', NULL),
(123, 2, 'Akramul Haque', 'Akramul Haque', 'Akramul Haque', 'akramulhoque2025@gmail.com', NULL, NULL, '1', 'efUbm6Qg0-E:APA91bGDDknxZHJE3kHr9atGpUFwi7SiqYFkaExjP8gostrATU_BBq8VVcBavJfR7OQsoyjs77jBGpNHwGx_h7r9p7GHBzXu4f2jxBCwq3B0nm-fzcyEL7JfOOPwn7vFkKiLVAzBsyiw', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '2', 'en', '0', NULL, 'facebook', '10221780260429301', '1', NULL, NULL, 'TxkxHWCQmoKYAzBad4jOQMwfUXP06QLDInw2Ot5twOjwG1S33Fg2KpLSYf0K', '1', NULL, '2021-02-26 04:18:35', '2021-03-20 03:10:26', NULL),
(124, 2, 'ActionSceneヅ', 'ActionSceneヅ', 'ActionSceneヅ', NULL, NULL, NULL, '1', 'fQ8pMch7lvk:APA91bFVy0swlwTpv531oIEkq7Wj6B5u4TgjICaETQ2BBxTzlbil5WGQCitPErCneSdVEqi7pwREWQal7vvx2DivPKvjC25KWD1Ur8RlKblmDbRk8FCOeYL-KI-hTKcHrOw-4guiOdy4', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, '', '106745504894847247221', '1', NULL, NULL, NULL, '1', 'test', '2021-02-26 04:21:32', '2021-03-18 00:30:22', '2021-03-17 17:30:22'),
(125, 2, 'Akram2021', 'Akram2021', 'Akram2021', 'adst45814@gmail.com', '1234567890', 'null', '1', 'fQ8pMch7lvk:APA91bFVy0swlwTpv531oIEkq7Wj6B5u4TgjICaETQ2BBxTzlbil5WGQCitPErCneSdVEqi7pwREWQal7vvx2DivPKvjC25KWD1Ur8RlKblmDbRk8FCOeYL-KI-hTKcHrOw-4guiOdy4', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, 'vlNJwPEJy6lZJbTCxuGXwVLCYYusIpmzGr8CuiW0vpStqmFfnALS1jFgbHwD', '1', NULL, '2021-02-26 05:29:53', '2021-02-26 05:38:45', NULL),
(126, 2, 'ads test1', 'ads test1', 'ads test1', NULL, NULL, NULL, '1', 'efUbm6Qg0-E:APA91bGDDknxZHJE3kHr9atGpUFwi7SiqYFkaExjP8gostrATU_BBq8VVcBavJfR7OQsoyjs77jBGpNHwGx_h7r9p7GHBzXu4f2jxBCwq3B0nm-fzcyEL7JfOOPwn7vFkKiLVAzBsyiw', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '2', 'en', '0', NULL, '', '116521244061741039394', '1', NULL, NULL, NULL, '1', NULL, '2021-02-26 05:58:20', '2021-03-18 19:14:58', NULL),
(127, 2, 'Johndoe', 'Johndoe', 'Johndoe', 'tcdublin2020@gmail.com', '1234567890', NULL, '1', 'fkPUN67076s:APA91bHDl2M24BVBO1HwyxX2x-tht-dLiUoZZL5Q6lwKy9U33zTF3GwIf63M2GC6iSfF9VAF9-AXci4k0qhBSSuhqVrhn335MWLLvy1sZYjF3AU_RUbWfySVHNLovdNfrm783rIbrnS3', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, '2021-03-02 00:50:43', '2021-03-02 00:50:43', NULL),
(128, 2, 'Sarfraz Ahmad', 'Sarfraz Ahmad', 'Sarfraz Ahmad', NULL, NULL, NULL, '1', 'ePx2CG6vuzc:APA91bFfe_GHNZnVQ4yLfjRgq_HTFcBWK2tTXAh29LSeXBZEIvfMSIMtUHUlF5qXgwKqYYftYLwOKvU_reZExfWCW4I1N1INdgGwIecc4VdEARoXPDYGrRplO0Ls0EpB1bZq1LG1sZAj', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, '', '109730741430758993954', '1', NULL, NULL, NULL, '1', NULL, '2021-03-08 18:29:22', '2021-03-08 18:29:22', NULL),
(129, 2, 'sazioa', 'sazioa', 'sazioa', 'saion@gmail.com', '16147689248', 'undefined', '1', 'dbj94VL9UGQ:APA91bFfC9YFM06gxqQ9wL3KOmRUk_aVZAfOrDepKlNcfffdCP4ihAcao9jB3Urrab6hRJ8MuKYTRtSF-MXCOVpg2cspBhbu8nWT8OOhBj5Nhn9UZ0s-6JRXp0BHz0qOeWaUwML0YJ7d', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, 'manually', NULL, '1', NULL, NULL, NULL, '1', NULL, '2021-03-12 04:01:42', '2021-03-12 04:02:00', NULL),
(130, 2, 'DFF Test2', 'DFF Test2', 'DFF Test2', NULL, NULL, NULL, '1', 'dYXOYyyXA1s:APA91bEFF5h4QBY0NMKqMsz0VzTnIC3j3yqPHRJXmTtqV_Ou6OZOtR-0YXHaWbNWf7q939F4_UVzCUnP_TGq7g-eoNpJkeu09uZ4HXw42KvQwcjPedknFL7S0q96crX-Z6jiSlCodPNg', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, '', '112868334182201109646', '1', NULL, NULL, NULL, '1', NULL, '2021-03-12 20:23:08', '2021-03-12 20:23:08', NULL),
(131, 2, 'MD Jahangir', 'MD Jahangir', 'MD Jahangir', NULL, NULL, NULL, '1', 'fDkzwkMcg3A:APA91bFNJo_eogVVa6ypO35nxbpIWGR4no2J-xldheYG8WxlS-ksU6_a3fT6svCXYr7Ai3yXjmHOJRq0cZdXTfjapzIXvU6a8-jE0H5n__Mt1jLFLjprMo6ZMu2UI4727T0JbXjVja4B', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, '', '1111639755998936', '1', NULL, NULL, NULL, '1', NULL, '2021-03-16 09:18:14', '2021-03-16 09:18:14', NULL),
(132, 2, 'Nuage Laboratoire', 'Nuage Laboratoire', 'Nuage Laboratoire', NULL, NULL, NULL, '1', 'null', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', '', '0', NULL, '', '115104508820687947229', '1', NULL, NULL, NULL, '1', NULL, '2021-03-16 18:40:45', '2021-03-16 18:40:45', NULL),
(133, 2, 'ActionSceneヅ', 'ActionSceneヅ', 'ActionSceneヅ', NULL, NULL, NULL, '1', 'eRjp9Fd5hfE:APA91bGhkKLGL1gyfoRfuvGnAe38PzwpeIjg-pasc1cY5DqZtL9g8SpyMafyJz3d8OXUVG_bz_Qqnf4Fr1CpRf21DKQ4g35uRI8fsqif67kHUtF9749HGz8Q-cKBbtUpKYQMPQ4GvLDm', NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '1', 'en', '0', NULL, '', '106745504894847247221', '1', NULL, NULL, NULL, '1', NULL, '2021-03-18 02:08:34', '2021-03-18 18:25:10', NULL),
(134, 2, 'Inspiring Dev', NULL, NULL, 'inspiring.dev1@gmail.com', NULL, NULL, '1', NULL, NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'facebook', '439990387220201', '1', NULL, NULL, 'xo3ee7wskbUyuNuv0t841oskEHOZJh2ZzoggPo7TAb6Szaq8f5F8ozFrGvtI', '1', NULL, '2021-03-19 19:33:37', '2021-03-19 19:33:37', NULL),
(135, 2, 'Shiv Coder', NULL, NULL, 'shivam.codemegsoft@gmail.com', NULL, NULL, '1', NULL, NULL, '$2y$10$ExamjU1FsSKJ.gJBmj.7Pen0jRyg7Y4RrNxQTkkMifAeDY3emahTm', '0', 'en', '0', NULL, 'facebook', '114876077294556', '1', NULL, NULL, NULL, '1', NULL, '2021-03-19 19:36:30', '2021-03-19 19:36:30', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ad_images`
--
ALTER TABLE `ad_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_field`
--
ALTER TABLE `category_field`
  ADD KEY `field_id` (`field_id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city_areas`
--
ALTER TABLE `city_areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favouriate_ads`
--
ALTER TABLE `favouriate_ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fields`
--
ALTER TABLE `fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `field_options`
--
ALTER TABLE `field_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `field_id` (`field_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_ads`
--
ALTER TABLE `report_ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `ad_images`
--
ALTER TABLE `ad_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=282;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `city_areas`
--
ALTER TABLE `city_areas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `favouriate_ads`
--
ALTER TABLE `favouriate_ads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `fields`
--
ALTER TABLE `fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `field_options`
--
ALTER TABLE `field_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;
--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `report_ads`
--
ALTER TABLE `report_ads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_field`
--
ALTER TABLE `category_field`
  ADD CONSTRAINT `category_field_ibfk_1` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `city_areas`
--
ALTER TABLE `city_areas`
  ADD CONSTRAINT `city_areas_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `field_options`
--
ALTER TABLE `field_options`
  ADD CONSTRAINT `field_options_ibfk_1` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

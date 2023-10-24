-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2023 at 12:40 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `confirm_password` text NOT NULL,
  `name` text NOT NULL,
  `gender` text NOT NULL,
  `bank` text NOT NULL,
  `act_no` text NOT NULL,
  `fone_no` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `confirm_password`, `name`, `gender`, `bank`, `act_no`, `fone_no`, `created_at`, `updated_at`, `role`) VALUES
(1, 'trustedward@gmail.com', 'welcome2chuksb', 'welcome2chuksb', 'Admin', 'Male', '', '', 0, '0000-00-00', '0000-00-00', ''),
(2, 'loandrasale@gmail.com', 'Dave112233', 'Dave112233', 'Boss', '', '', '', 0, '2021-12-17', '0000-00-00', 'admin'),
(3, 'support@caixcreditos.com', 'Admin112233', 'Admin112233', 'Admin', '', '', '', 0, '2022-02-06', '0000-00-00', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `all_transfers`
--

CREATE TABLE `all_transfers` (
  `ID` int(10) NOT NULL,
  `bank_name` varchar(256) NOT NULL,
  `b_name` varchar(256) NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `b_acct` varchar(256) NOT NULL,
  `b_country` varchar(256) NOT NULL,
  `swift_code` varchar(256) NOT NULL,
  `routing_numbeR` varchar(256) NOT NULL,
  `acct_type` varchar(256) NOT NULL,
  `code` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `imf` varchar(256) NOT NULL,
  `amount` varchar(256) NOT NULL,
  `address` varchar(256) NOT NULL,
  `last_updated` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `all_transfers`
--

INSERT INTO `all_transfers` (`ID`, `bank_name`, `b_name`, `user_id`, `b_acct`, `b_country`, `swift_code`, `routing_numbeR`, `acct_type`, `code`, `description`, `imf`, `amount`, `address`, `last_updated`) VALUES
(1, 'Bank of UK', 'Emerson', '20', '2456378345', 'Nigeria', 'tfdcvbnklkjU', 'LIUYTRFDFGHJKL', 'poiuytfghjkl', '67647', 'payment', '123456', '20', 'new lagos road', '');

-- --------------------------------------------------------

--
-- Table structure for table `blocked`
--

CREATE TABLE `blocked` (
  `id` int(10) NOT NULL,
  `firstname` varchar(256) NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `blocked`
--

INSERT INTO `blocked` (`id`, `firstname`, `user_id`, `status`) VALUES
(1, 'Blessing Ariyo Adegbola ', '4', 'blocked'),
(2, 'Beta Boy', '265', 'blocked'),
(4, 'Sarah Adagbon', '345', 'Completed'),
(6, 'Harrison Adagbon ', '285', 'Completed'),
(7, 'Chima Amadi', '349', 'Dormancy'),
(8, 'Okwori Friday', '350', 'Dormancy'),
(9, 'Ayodele Victor', '351', 'Dormancy'),
(10, 'Newworld Kingsley', '352', 'Dormancy'),
(11, 'Kuyoro kehinde', '353', 'Dormancy'),
(12, 'Okwori Friday', '355', 'Dormancy'),
(13, 'Mpoetsi Sefako', '367', 'dormant'),
(14, 'Sadijat', '375', 'blocked'),
(16, 'Aneesa Hoosain', '669', 'Dormant'),
(18, 'Aneesa Hoosain', '81', 'cot');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `title` text NOT NULL,
  `body` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(10) NOT NULL,
  `file` varchar(100) NOT NULL,
  `userid` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `time_uploaded` varchar(100) NOT NULL,
  `description` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `file`, `userid`, `username`, `time_uploaded`, `description`) VALUES
(24, 'uploads/tymebank-thumbnail-05-1080x1080-1.jpg', 23, 'Tochukwu Ezike', 'Saturday 4th of December 2021 04:16:32 PM', ''),
(25, 'uploads/download (1).jpg', 23, 'Tochukwu Ezike', 'Saturday 4th of December 2021 04:23:39 PM', 'hello world'),
(26, 'uploads/download (1).jpg', 23, 'Tochukwu Ezike', 'Saturday 4th of December 2021 04:25:21 PM', 'hello world'),
(27, 'uploads/download (1).jpg', 23, 'Tochukwu Ezike', 'Saturday 4th of December 2021 04:27:32 PM', 'hello'),
(28, 'uploads/all-seeing-eye-god-sacred-geometry-triangle-bird-wings-falcon-angel-masonry-illuminati-symbo', 29, 'Barkiel David', 'Tuesday 4th of January 2022 09:07:52 PM', 'Non'),
(29, 'uploads/metranoxx.jpg', 41, 'Del Hab', 'Monday 21st of February 2022 06:33:44 AM', 'Hab Kareem'),
(30, 'uploads/illuminati.jpg', 59, 'Del Hab', 'Tuesday 13th of September 2022 05:15:50 PM', 'id'),
(31, 'uploads/illuminati.jpg', 63, 'Del Hab', 'Monday 31st of October 2022 04:25:37 AM', 'my id');

-- --------------------------------------------------------

--
-- Table structure for table `gh`
--

CREATE TABLE `gh` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `created_at` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `gh`
--

INSERT INTO `gh` (`ID`, `name`, `amount`, `user_id`, `created_at`) VALUES
(19, 'Beta Boy', '0.0003', '265', '2018-07-12 00:06:08.000000'),
(20, 'Dominion danjuma duwe', '0.69', '273', '2018-07-22 23:47:11.000000'),
(21, 'Kehinde Adeshola ', '0.00615', '277', '2018-08-01 21:47:25.000000'),
(23, 'Bosah juliet', '#500', '279', '2018-08-05 19:19:35.000000'),
(24, 'Oluseun Ogunkanmi', '0.08', '280', '2018-08-06 14:55:53.000000'),
(25, 'Ha', '0.01', '286', '2018-09-05 19:30:46.000000'),
(26, 'Ogbori Nwata', '4000', '299', '2018-09-29 14:08:20.000000'),
(27, 'Maryam Bello ', '850', '303', '2018-11-16 07:28:35.000000'),
(28, 'Jonathan Liam', '500', '358', '2018-12-28 15:47:12.000000'),
(29, 'Abdul Bhuiyan', '95000', '378', '2019-04-12 15:17:51.000000'),
(30, 'Brenda', '50000', '660', '2020-11-16 10:26:12.000000'),
(34, 'Adijat Mohammed', '5000', '663', '2021-01-15 16:36:26.000000'),
(35, 'Henry', '7000', '1', '2021-11-25 19:09:30.000000');

-- --------------------------------------------------------

--
-- Table structure for table `guider`
--

CREATE TABLE `guider` (
  `id` int(11) NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `guider`
--

INSERT INTO `guider` (`id`, `email`, `password`) VALUES
(0, 'henry', 'welcome');

-- --------------------------------------------------------

--
-- Table structure for table `int_transfer`
--

CREATE TABLE `int_transfer` (
  `ID` int(10) NOT NULL,
  `bank_name` varchar(256) NOT NULL,
  `b_name` varchar(256) NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `b_acct` int(10) NOT NULL,
  `b_country` varchar(256) NOT NULL,
  `swift_code` varchar(256) NOT NULL,
  `routing_number` varchar(256) NOT NULL,
  `acct_type` varchar(256) NOT NULL,
  `code` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `imf` varchar(256) NOT NULL,
  `amount` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `address` varchar(256) NOT NULL,
  `last_updated` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `int_transfer`
--

INSERT INTO `int_transfer` (`ID`, `bank_name`, `b_name`, `user_id`, `b_acct`, `b_country`, `swift_code`, `routing_number`, `acct_type`, `code`, `description`, `imf`, `amount`, `name`, `address`, `last_updated`) VALUES
(22, 'Hong Kong Hang Seng Bank', 'Leung Man Ying', '80', 2147483647, 'hk', '024', '024', 'saving', 'FCC00851423', 'Business ', 'TCC61084139', '50000', '', '', ''),
(23, 'Wema', 'Ahmed', '', 1234569876, '', '5678', '567', 'non_resident', 'FCC00851423', 'fees', 'TCC61084139', '0', '', '2 Montclear', '2023-10-04 12:31:19'),
(24, 'Union Bank', 'Henry Chuks', '81', 34567890, 'United States', 'Benedith', '3534564', 'saving', 'FCC00851423', 'school fees', 'TCC61084139', '4', 'Aneesa Hoosain', '7 Mountclaire street, Sybrand park, Rondebosch 7700 Cape town South Africa', '2023-10-13 10:38:33');

-- --------------------------------------------------------

--
-- Table structure for table `int_transfers`
--

CREATE TABLE `int_transfers` (
  `ID` int(10) NOT NULL,
  `bank_name` varchar(256) NOT NULL,
  `b_name` varchar(256) NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `b_acct` varchar(256) NOT NULL,
  `b_country` varchar(256) NOT NULL,
  `swift_code` varchar(256) NOT NULL,
  `routing_numbeR` varchar(256) NOT NULL,
  `acct_type` varchar(256) NOT NULL,
  `code` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `imf` varchar(256) NOT NULL,
  `amount` varchar(256) NOT NULL,
  `address` varchar(256) NOT NULL,
  `last_updated` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `id` int(11) NOT NULL,
  `rematch` text NOT NULL,
  `name` text NOT NULL,
  `provider_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `amount` text NOT NULL,
  `image` text NOT NULL,
  `confirm` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`id`, `rematch`, `name`, `provider_id`, `receiver_id`, `amount`, `image`, `confirm`, `created_at`) VALUES
(1, '.', '', 6, 3, '20,000naira', '', 'confirmed', '2017-04-01 17:56:31'),
(2, '.', '', 8, 8, '20,000naira', '', 'confirmed', '2017-04-11 00:29:00'),
(3, '.', '', 8, 8, '20,000naira', '', 'confirmed', '2017-04-11 00:30:31'),
(4, '.', '', 8, 8, '20,000naira', '', 'confirmed', '2017-04-11 00:50:35'),
(5, '.', '', 8, 8, '20,000naira', '', 'confirmed', '2017-04-11 00:55:39'),
(6, '.', '', 8, 8, '20,000naira', '', 'confirmed', '2017-04-11 00:58:55'),
(7, '.', '', 10, 9, '5,000naira', 'pics/help_pics/c61a6564521c8e8d7f113dc74113437127-57.png', 'confirmed', '2017-04-11 10:55:15'),
(8, '.', '', 11, 9, '5,000naira', 'pics/help_pics/ca037411ccb3a446ef25078ae7012d7601-24.png', 'confirmed', '2017-04-11 10:56:04'),
(9, '.', '', 12, 4, '20,000naira', 'pics/help_pics/7cfcc1a09d7465279a4703b3c7f6972432-44.png', 'confirmed', '2017-04-11 10:59:18'),
(10, '.', '', 19, 4, '20,000naira', 'pics/help_pics/a532de8dc6c5e8d05ff3b7e9e10660b641-49.jpg', 'confirmed', '2017-04-11 11:00:13'),
(11, '.', '', 24, 4, '20,000naira', 'pics/help_pics/71bd58bc209dca487abe45000783663724-35.jpg', 'confirmed', '2017-04-11 11:01:22'),
(12, '.', '', 16, 4, '20,000naira', 'pics/help_pics/', 'confirmed', '2017-04-11 11:02:05'),
(13, '.', '', 27, 4, '20,000naira', 'pics/help_pics/', 'confirmed', '2017-04-11 11:02:25'),
(14, '.', '', 38, 4, '20,000naira', 'pics/help_pics/', 'confirmed', '2017-04-11 11:02:51'),
(15, '.', '', 32, 3, '10,000naira', 'pics/help_pics/c187373bed024eafe2a6a13b8e7340ca45-25.png', 'confirmed', '2017-04-11 11:03:58'),
(16, 'Rematched', '', 30, 3, '10,000naira', 'pics/help_pics/8f7f3541769b2fbd61f84503eeb993cf16-09.png', 'confirmed', '2017-04-11 11:04:17'),
(17, '.', '', 28, 3, '10,000naira', 'pics/help_pics/42be4ec38ddad53bc586fda14d24251021-12.png', 'confirmed', '2017-04-11 11:04:44'),
(18, '.', '', 44, 3, '10,000naira', 'pics/help_pics/ba330c868f2aa197de814ebb5e7599c930-50.png', 'confirmed', '2017-04-11 11:05:27'),
(19, 'Rematched', '', 13, 22, '5,000naira', 'pics/help_pics/', 'confirmed', '2017-04-11 11:06:59'),
(20, '.', '', 18, 22, '5,000naira', 'pics/help_pics/20a75cb58e50224ddc0458b9e1d3327935-22.png', 'confirmed', '2017-04-11 11:07:33'),
(21, 'Rematched', '', 14, 22, '5,000naira', 'pics/help_pics/ad60f6c8b81c70c8e2705b86e316316128-27.jpg', 'confirmed', '2017-04-11 11:07:53'),
(22, '.', '', 17, 22, '5,000naira', 'pics/help_pics/c726142144876af4f325c7d0b182d06842-31.png', 'confirmed', '2017-04-11 11:08:09'),
(23, '.', '', 21, 22, '5,000naira', 'pics/help_pics/c860a1fdaf6cbe64d1e20ec1943b14b832-02.png', 'confirmed', '2017-04-11 11:08:25'),
(24, '.', '', 20, 22, '5,000naira', '', 'pending', '2017-04-11 11:08:46'),
(25, '.', '', 25, 22, '5,000naira', 'pics/help_pics/', 'confirmed', '2017-04-11 11:09:00'),
(26, 'Rematched', '', 29, 45, '5,000naira', 'pics/help_pics/', 'confirmed', '2017-04-11 11:10:56'),
(27, '.', '', 31, 41, '5,000naira', 'pics/help_pics/1efa5d341a89828dac540db7faafc5f258-38.png', 'confirmed', '2017-04-11 11:11:16'),
(28, '.', '', 33, 41, '5,000naira', 'pics/help_pics/', 'confirmed', '2017-04-11 11:11:42'),
(29, '.', '', 34, 2, '5,000naira', 'pics/help_pics/ecb3f59a92b9c7bf96482a4801c5a20133-47.png', 'confirmed', '2017-04-11 11:12:37'),
(30, '.', '', 36, 2, '5,000naira', '', 'pending', '2017-04-11 11:12:56'),
(31, '.', '', 26, 2, '5,000naira', 'pics/help_pics/d6d00faa95831ef9ec660e9d887228df48-03.png', 'confirmed', '2017-04-11 11:13:10'),
(32, '.', '', 39, 45, '5,000naira', 'pics/help_pics/881887894baf903a1b821029d5db491a46-10.png', 'confirmed', '2017-04-11 11:13:32'),
(33, '.', '', 41, 5, '5,000naira', 'pics/help_pics/11d78fbbdde714f3558abedb6d5beed454-54.jpg', 'confirmed', '2017-04-11 11:15:10'),
(34, '.', '', 35, 5, '5,000naira', '', 'confirmed', '2017-04-11 11:15:25'),
(35, '.', '', 46, 5, '5,000naira', 'pics/help_pics/', 'pending', '2017-04-11 11:15:41'),
(36, '.', '', 48, 2, '5,000naira', '', 'pending', '2017-04-11 11:16:07'),
(37, '.', '', 50, 5, '5,000naira', 'pics/help_pics/901a1b17637b5e119d000211c2beed4859-25.png', 'confirmed', '2017-04-11 11:22:05'),
(38, '.', '', 40, 5, '5,000naira', 'pics/help_pics/7e1318aaed773e8611ac57dfbd1af1c421-46.png', 'confirmed', '2017-04-11 11:22:50'),
(39, '.', '', 52, 43, '5,000naira', 'pics/help_pics/', 'confirmed', '2017-04-11 11:31:14'),
(40, '.', '', 47, 5, '10,000naira', 'pics/help_pics/2f77929117c9e8e3ad23ce06a4b1140444-53.png', 'confirmed', '2017-04-11 11:33:13'),
(41, '.', '', 51, 53, '10,000naira', 'pics/help_pics/b692f951686a24ea6e2db8755903f53657-06.jpg', 'confirmed', '2017-04-11 11:34:14'),
(43, '.', '', 55, 53, '10,000naira', 'pics/help_pics/', 'confirmed', '2017-04-11 11:37:49'),
(44, '.', '', 54, 43, '5,000naira', 'pics/help_pics/9d9699d425abed426a5ed4eb7e43a55051-29.png', 'confirmed', '2017-04-11 11:39:18'),
(45, '.', '', 58, 4, '20,000naira', 'pics/help_pics/', 'confirmed', '2017-04-11 11:50:28'),
(46, 'Rematched', '', 60, 10, '5,000naira', '', 'pending', '2017-04-11 12:25:15'),
(47, '.', '', 59, 10, '5,000naira', 'pics/help_pics/3189b385d55b3d28a36abb810505351156-27.png', 'confirmed', '2017-04-11 12:28:54'),
(48, '.', '', 50, 11, '5,000naira', 'pics/help_pics/901a1b17637b5e119d000211c2beed4807-12.png', 'confirmed', '2017-04-11 12:32:11'),
(49, '.', '', 41, 11, '5,000naira', 'pics/help_pics/498e00b02c5f71ddc72cebfa2fc21d9e56-09.png', 'confirmed', '2017-04-11 12:35:17'),
(50, '.', '', 61, 34, '5,000naira', 'pics/help_pics/2afcad1509e283f755cf61295cd71eca47-48.jpg', 'confirmed', '2017-04-11 12:38:43'),
(51, '.', '', 62, 34, '5,000naira', 'pics/help_pics/', 'confirmed', '2017-04-11 12:38:59'),
(52, '.', '', 11, 21, '10,000naira', 'pics/help_pics/bbf487501160640668e7a5084f8dc01129-04.png', 'confirmed', '2017-04-11 13:16:29'),
(53, '.', '', 64, 15, '5,000naira', 'pics/help_pics/baeefd56e5d7b87c2196a35a1338577240-27.png', 'confirmed', '2017-04-11 13:26:43'),
(55, '.', '', 68, 18, '10,000naira', 'pics/help_pics/2aad1c6e9d2e5367ee3ff196a72d4b3d36-06.png', 'confirmed', '2017-04-11 13:48:21'),
(56, '.', '', 71, 14, '10,000naira', '', 'pending', '2017-04-11 13:49:10'),
(57, 'Rematched', '', 67, 4, '10,000naira', '', 'pending', '2017-04-11 13:49:30'),
(58, '.', '', 70, 4, '50,000naira', 'pics/help_pics/1f285efa32dd6b389c1324c13a0520e322-39.jpg', 'pending', '2017-04-11 13:50:48'),
(59, '.', '', 65, 26, '5,000naira', 'pics/help_pics/527bd5b5d689e2c32ae974c6229ff78504-50.jpg', 'confirmed', '2017-04-11 13:54:56'),
(60, '.', '', 11, 26, '5,000naira', 'pics/help_pics/e705f5a6f19bec540768f7c27e9151b901-00.png', 'confirmed', '2017-04-11 13:55:17'),
(61, '.', '', 69, 39, '5,000naira', 'pics/help_pics/', 'pending', '2017-04-11 13:55:50'),
(62, '.', '', 63, 39, '5,000naira', 'pics/help_pics/8146005677d13684294b535d6c5e7c9a39-11.jpg', 'confirmed', '2017-04-11 13:56:06'),
(64, '.', '', 73, 41, '5,000naira', 'pics/help_pics/d02217ae50bdf882e3980bf37a4e346433-26.jpg', 'pending', '2017-04-11 13:57:55'),
(65, '.', '', 72, 41, '5,000naira', '', 'pending', '2017-04-11 13:58:10'),
(66, '.', '', 78, 4, '10,000naira', '', 'pending', '2017-04-11 14:01:32'),
(67, '.', '', 75, 35, '5,000naira', '', 'confirmed', '2017-04-11 14:03:16'),
(68, '.', '', 80, 35, '5,000naira', '', 'confirmed', '2017-04-11 14:03:44'),
(69, '.', '', 74, 9, '50,000naira', 'pics/help_pics/70780cdfd7fd5585df9df2d9a3c062a701-20.png', 'pending', '2017-04-11 14:05:17'),
(70, '.', '', 81, 3, '5,000naira', '', 'pending', '2017-04-11 14:07:52'),
(71, '.', '', 82, 3, '5,000naira', '', 'pending', '2017-04-11 14:11:11'),
(72, '.', '', 86, 4, '20,000naira', '', 'pending', '2017-04-11 14:23:54'),
(73, '.', '', 87, 5, '5,000naira', '', 'pending', '2017-04-11 14:28:24'),
(74, '.', '', 88, 2, '5,000naira', 'pics/help_pics/c85feac70c3fd8744147837596056db754-06.jpg', 'pending', '2017-04-11 14:29:07'),
(75, 'Rematched', '', 89, 43, '5,000naira', '', 'pending', '2017-04-11 14:30:54'),
(76, '.', '', 90, 4, '20,000naira', '', 'pending', '2017-04-11 14:38:23'),
(77, '.', '', 91, 43, '50,000naira', 'pics/help_pics/b43f28f73bb9216ee7e27f001ae8a8f952-30.jpg', 'pending', '2017-04-11 14:39:44'),
(78, '.', '', 92, 4, '5,000naira', 'pics/help_pics/e84d8cfbce1b380f79926d73baa8520202-08.png', 'confirmed', '2017-04-11 14:55:30'),
(79, '.', '', 49, 37, '5,000naira', '', 'pending', '2017-04-11 14:56:35'),
(80, 'Rematched', '', 93, 37, '5,000naira', '', 'pending', '2017-04-11 14:57:12'),
(81, '.', '', 95, 41, '5,000naira', 'pics/help_pics/', 'confirmed', '2017-04-11 15:07:08'),
(82, '.', '', 97, 44, '10,000naira', 'pics/help_pics/1a23efb21f9e76312f50561e21b26ca340-58.png', 'confirmed', '2017-04-11 15:43:45'),
(84, '.', '', 34, 4, '5,000naira', 'pics/help_pics/6fd6ec2e8870410b8c73c20548cdac5322-22.png', 'confirmed', '2017-04-11 15:58:53'),
(85, '.', '', 98, 4, '5,000naira', 'pics/help_pics/8c6c7b37dd2ab0f12ec3b3e3b8f60b5e34-03.png', 'confirmed', '2017-04-11 15:59:24'),
(86, '.', '', 99, 3, '5,000naira', '', 'pending', '2017-04-11 17:32:26'),
(87, '.', '', 100, 45, '5,000naira', '', 'pending', '2017-04-11 18:27:35'),
(88, '.', '', 101, 45, '10,000naira', '', 'pending', '2017-04-11 18:41:24'),
(89, '.', '', 102, 5, '5,000naira', 'pics/help_pics/8e248757798f5833d3d6da545cb550db35-51.png', 'confirmed', '2017-04-11 19:54:28'),
(90, '.', '', 106, 4, '5,000naira', 'pics/help_pics/214a6cf8ee9f663a3269e17e7a4fecc026-01.jpg', 'pending', '2017-04-11 20:43:05'),
(91, '.', '', 105, 4, '5,000naira', '', 'pending', '2017-04-11 20:43:25'),
(92, '.', '', 108, 44, '5,000naira', '', 'pending', '2017-04-12 07:06:34'),
(93, '.', '', 110, 44, '5,000naira', '', 'pending', '2017-04-12 07:07:01'),
(94, '.', '', 111, 13, '5,000naira', '', 'pending', '2017-04-12 08:44:17'),
(95, '.', '', 112, 13, '5,000naira', 'pics/help_pics/', 'confirmed', '2017-04-12 08:44:41'),
(96, '.', '', 115, 4, '5,000naira', '', 'pending', '2017-04-12 10:21:03'),
(97, '.', '', 116, 5, '5,000naira', '', 'confirmed', '2017-04-12 10:21:39'),
(98, '.', '', 118, 5, '50,000naira', '', 'pending', '2017-04-12 12:47:57'),
(99, '.', '', 119, 3, '50,000naira', '', 'pending', '2017-04-12 12:50:03'),
(100, '.', '', 120, 4, '5,000naira', 'pics/help_pics/', 'confirmed', '2017-04-12 13:43:42'),
(101, '.', '', 123, 4, '5,000naira', 'pics/help_pics/', 'pending', '2017-04-12 15:24:30'),
(102, '.', '', 124, 3, '5,000naira', 'pics/help_pics/f4c75bb670c7fe562a0f5f9cc412970d10-18.png', 'confirmed', '2017-04-12 16:51:47'),
(103, '.', '', 125, 3, '20,000naira', '', 'pending', '2017-04-12 22:09:31'),
(104, '.', '', 126, 9, '5,000naira', '', 'pending', '2017-04-12 22:21:22'),
(105, '.', '', 114, 3, '50,000naira', 'pics/help_pics/2a708969e67cf3d1ae461e3880f543bb40-53.jpg', 'confirmed', '2017-04-12 22:22:45'),
(107, '.', '', 127, 58, '20,000naira', 'pics/help_pics/471353bd38f0e5752641bffd92fbac2636-58.png', 'confirmed', '2017-04-13 10:41:09'),
(108, '.', '', 128, 22, '5,000naira', 'pics/help_pics/0d91abb694b627ab31cdd5128ccb559554-01.jpeg', 'confirmed', '2017-04-13 10:47:15'),
(109, '.', '', 127, 4, '5,000naira', '', 'pending', '2017-04-13 14:18:40'),
(110, '.', '', 129, 4, '5,000naira', '', 'pending', '2017-04-13 19:38:55'),
(111, '.', '', 130, 19, '40,000naira', '', 'pending', '2017-04-14 13:22:18'),
(112, '.', '', 130, 31, '10,000naira', '', 'pending', '2017-04-14 13:25:11'),
(113, '.', '', 139, 31, '10,000naira', '', 'pending', '2017-04-17 18:22:29'),
(114, '.', '', 136, 19, '10,000naira', '', 'pending', '2017-04-17 18:23:50'),
(115, '.', '', 136, 19, '5,000naira', '', 'pending', '2017-04-17 18:24:23'),
(116, '.', '', 137, 19, '5,000naira', '', 'pending', '2017-04-17 18:26:21'),
(117, '.', '', 138, 19, '5,000naira', 'pics/help_pics/60260493c4fb2718d1c0946edeb14aaf03-07.jpg', 'pending', '2017-04-17 18:26:55'),
(118, '.', '', 141, 61, '10,000naira', 'pics/help_pics/641a7a27a951a3b95e19c412b0e2232504-53.jpg', 'pending', '2017-04-17 18:30:38'),
(119, '.', '', 137, 16, '40,000naira', '', 'pending', '2017-04-18 13:36:00'),
(120, '.', '', 136, 27, '40,000naira', 'pics/help_pics/', 'pending', '2017-04-18 13:37:51'),
(121, '.', '', 141, 12, '40,000naira', '', 'pending', '2017-04-18 13:39:12'),
(122, '.', '', 138, 51, '20,000naira', '', 'pending', '2017-04-18 13:40:58'),
(123, '.', '', 139, 47, '20,000naira', '', 'pending', '2017-04-18 13:42:12'),
(124, '.', '', 140, 24, '40,000naira', '', 'pending', '2017-04-18 13:45:07'),
(125, '.', '', 141, 32, '20,000naira', '', 'pending', '2017-04-18 13:46:38'),
(126, '.', '', 140, 17, '10,000naira', '', 'pending', '2017-04-18 13:47:59'),
(127, '.', '', 139, 14, '10,000naira', '', 'pending', '2017-04-18 13:49:07'),
(128, '.', '', 137, 23, '10,000naira', '', 'pending', '2017-04-18 13:51:29'),
(129, '.', '', 134, 31, '10,000naira', 'pics/help_pics/', 'pending', '2017-04-18 16:11:27'),
(130, '.', '', 140, 24, '40,000naira', '', 'pending', '2017-04-18 16:11:34'),
(131, '.', '', 151, 40, '10,000naira', '', 'pending', '2017-04-18 16:18:10'),
(132, '.', '', 153, 63, '10,000naira', '', 'pending', '2017-04-18 16:19:25'),
(133, '.', '', 153, 31, '10,000naira', '', 'pending', '2017-04-18 22:50:27'),
(135, '.', '', 162, 163, '50,000naira', '', 'pending', '2017-07-01 20:06:08'),
(136, '.', '', 164, 4, '50,000naira', 'pics/help_pics/abb1ee4c9a2aa537cd4fc0e67910d17604-35.jpg', 'confirmed', '2017-07-20 09:39:20'),
(137, '.', '', 165, 4, '50,000naira', 'pics/help_pics/abb1ee4c9a2aa537cd4fc0e67910d17608-58.jpg', 'confirmed', '2017-07-20 09:44:50'),
(138, '.', '', 170, 157, '10,000naira', 'pics/help_pics/', 'confirmed', '2017-07-20 18:50:42'),
(139, '.', '', 166, 157, '20,000naira', 'pics/help_pics/22b878e964b91004eb64bde72a26745f13-13.png', 'pending', '2017-07-24 09:56:42'),
(140, '.', '', 170, 172, '10,000naira', 'pics/help_pics/', 'confirmed', '2017-07-24 10:06:10'),
(141, '.', '', 166, 172, '20,000naira', 'pics/help_pics/22b878e964b91004eb64bde72a26745f40-14.png', 'confirmed', '2017-07-24 10:12:52'),
(142, '.', '', 173, 170, '20,000naira', '', 'pending', '2017-07-24 14:12:55'),
(143, '.', '', 170, 177, '5,000naira', '', 'pending', '2017-07-27 19:26:47'),
(144, '.', '', 176, 178, '5,000naira', '', 'pending', '2017-07-27 19:31:58'),
(145, '.', '', 171, 172, '5,000naira', 'pics/help_pics/', 'confirmed', '2017-08-01 13:47:47'),
(147, '.', '', 180, 178, '50,000naira', '', 'pending', '2017-08-02 16:13:04'),
(148, '.', '', 164, 173, '100,000naira', '', 'confirmed', '2017-08-04 10:44:16'),
(150, '.', '', 163, 173, '50,000naira', '', 'confirmed', '2017-08-04 10:55:41'),
(151, '.', '', 164, 173, '100,000naira', '', 'confirmed', '2017-08-04 11:01:50'),
(152, '.', '', 183, 178, '20,000naira', 'pics/help_pics/486e4f3e58e6fc048a6b5350fc4816f849-05.png', 'confirmed', '2017-08-07 20:22:36'),
(153, '.', '', 185, 178, '5,000naira', 'pics/help_pics/2a24403297329ccc88c481976f8c1a4011-20.png', 'confirmed', '2017-08-09 08:29:01'),
(154, '.', '', 186, 178, '5,000naira', '', 'pending', '2017-08-09 08:29:17'),
(155, '.', '', 190, 178, '5,000naira', 'pics/help_pics/bc1dbc08d7ddd4011bc390779a66c53833-53.jpg', 'confirmed', '2017-08-10 10:08:01'),
(156, '.', '', 191, 178, '5,000naira', 'pics/help_pics/78805a221a988e79ef3f42d7c5bfd41803-44.png', 'confirmed', '2017-08-10 14:16:42'),
(157, '.', '', 193, 178, '5,000naira', 'pics/help_pics/78c174edaec1019d1a2aaacee7a69da513-46.jpg', 'confirmed', '2017-08-10 17:59:02'),
(158, '.', '', 198, 199, '10,000naira', 'pics/help_pics/9a77933bddbf10e3b2e30f654988c5a106-39.jpg', 'confirmed', '2017-08-14 13:11:34'),
(159, '.', '', 200, 2002, '50,000naira', '', 'pending', '2017-08-15 14:41:39'),
(160, '.', '', 200, 202, '50,000naira', 'pics/help_pics/2adf2f36e88e17916892ace180d9307130-41.jpg', 'confirmed', '2017-08-15 14:41:56'),
(161, '.', '', 200, 172, '50,000naira', 'pics/help_pics/0e0fb7403903417b77a21f43e7484e4824-37.jpg', 'confirmed', '2017-08-15 15:32:42'),
(162, '.', '', 200, 177, '50,000naira', 'pics/help_pics/0e0fb7403903417b77a21f43e7484e4842-32.jpg', 'pending', '2017-08-15 16:58:39'),
(163, '.', '', 203, 197, '5,000naira', '', 'pending', '2017-08-15 17:41:15'),
(164, '.', '', 200, 204, '50,000naira', 'pics/help_pics/e5f96ae00443877315fbb64fd3d9000528-22.jpg', 'admin confirmed', '2017-08-15 18:24:44'),
(165, '.', '', 163, 205, '20,000naira', '', 'confirmed', '2017-08-15 20:46:07'),
(166, '.', '', 200, 206, '50,000naira', 'pics/help_pics/fd317cf09647743fdeea298effa02e3a11-27.jpg', 'pending', '2017-08-16 09:20:20'),
(168, '.', '', 209, 202, '50,000naira', 'pics/help_pics/', 'confirmed', '2017-08-16 20:07:24'),
(169, '.', '', 209, 206, '50,000naira', 'pics/help_pics/', 'pending', '2017-08-17 09:53:22'),
(170, '.', '', 210, 211, '10,000naira', '', 'pending', '2017-08-17 14:43:53'),
(171, '.', '', 171, 202, '20,000naira', '', 'pending', '2017-08-18 11:08:57'),
(172, '.', '', 214, 198, '20,000naira', '', 'pending', '2017-08-19 09:52:16'),
(174, '.', '', 218, 197, '10,000naira', 'pics/help_pics/869496108426d922d6e468a970ff415431-36.png', 'confirmed', '2017-08-20 08:05:50'),
(176, '.', '', 218, 206, '10,000naira', 'pics/help_pics/8461896a8c5435d27db70cd494645a2d27-52.png', 'pending', '2017-08-20 09:02:40'),
(178, '.', '', 222, 197, '5,000naira', '', 'pending', '2017-08-20 19:34:43'),
(179, '.', '', 223, 177, '50,000naira', '', 'pending', '2017-08-21 13:21:10'),
(181, '.', '', 215, 225, '50,000naira', 'pics/help_pics/2dfd7d2aa2881233ba82192e5e99091206-14.jpg', 'confirmed', '2017-08-23 07:29:06'),
(182, '.', '', 215, 197, '50,000naira', 'pics/help_pics/cbe04faaa217e79db116fdbf1a3bd1da46-04.jpg', 'confirmed', '2017-08-23 08:51:55'),
(185, '.', '', 228, 197, '200,000naira', 'pics/help_pics/c4333e47bf352e328164ed5fb52e84ed16-38.jpg', 'pending', '2017-08-31 14:00:22'),
(186, '.', '', 215, 172, '20,000naira', 'pics/help_pics/b1c78cf8a8cfe0bc055f5123640cafc920-25.jpg', 'confirmed', '2017-08-31 14:02:05'),
(187, '.', '', 229, 197, '20,000naira', '', 'pending', '2017-08-31 15:09:22'),
(189, '.', '', 236, 197, '10,000naira', '', 'confirmed', '2017-09-01 17:43:19'),
(190, '.', '', 196, 197, '5,000naira', 'pics/help_pics/556f8e25650bd0f7fa70ffe99cdac99231-24.png', 'admin confirmed', '2017-09-02 12:00:16'),
(191, '.', '', 236, 177, '5,000naira', '', 'pending', '2017-09-02 12:03:10'),
(192, '.', '', 237, 177, '200,000naira', 'pics/help_pics/ae5ff061022ee52cf4d732ddcd7d1e0c38-38.jpg', 'pending', '2017-09-02 15:12:11'),
(197, '.', '', 240, 197, '5,000naira', '', 'pending', '2017-09-04 09:00:10'),
(198, '.', '', 239, 215, '5,000naira', '', 'confirmed', '2017-09-06 09:27:07'),
(199, '.', '', 244, 215, '5,000naira', '', 'confirmed', '2017-09-06 09:29:24'),
(201, '.', '', 4, 215, '50,000naira', '', 'pending', '2017-09-06 09:36:36'),
(202, '.', '', 245, 215, '100,000naira', 'pics/help_pics/', 'confirmed', '2017-09-12 09:08:32'),
(205, '.', '', 236, 247, '5,000naira', '', 'confirmed', '2017-09-13 06:22:14'),
(206, '.', '', 245, 246, '50,000naira', 'pics/help_pics/5760583ec2c496538202799e9068b7de58-29.png', 'confirmed', '2017-09-13 15:56:35'),
(207, '.', '', 205, 245, '200,000naira', '', 'pending', '2017-09-13 18:20:02'),
(210, '.', '', 177, 245, '100,000naira', '', 'pending', '2017-09-13 18:24:06'),
(211, '.', '', 248, 197, '50,000naira', 'pics/help_pics/', 'confirmed', '2017-10-16 14:48:57'),
(213, '.', '', 248, 172, '50,000naira', 'pics/help_pics/', 'confirmed', '2017-10-16 15:16:05'),
(214, '.', '', 247, 174, '400,000naira', '', 'pending', '2017-10-23 13:08:26'),
(215, '.', '', 247, 174, '500,000naira', '', 'pending', '2017-10-23 14:29:58'),
(217, '.', '', 249, 250, '50,000naira', 'pics/help_pics/', 'confirmed', '2017-10-24 09:27:03'),
(218, '.', '', 246, 248, '200,000naira', '', 'pending', '2017-10-25 09:36:32'),
(219, '.', '', 3, 248, '50,000naira', '', 'pending', '2017-10-25 09:43:38'),
(222, '.', '', 251, 252, '200,000naira', '', 'pending', '2017-11-13 07:25:36'),
(224, '.', '', 254, 223, '40,000naira', '', 'pending', '2017-11-17 01:32:38'),
(226, '.', '', 245, 254, '20,000naira', '', 'confirmed', '2017-11-25 09:19:50'),
(227, '.', '', 254, 245, '100,000naira', '', 'pending', '2017-11-25 09:20:04'),
(228, '.', '', 265, 256, '20,000naira', '', 'confirmed', '2017-12-08 09:33:21');

-- --------------------------------------------------------

--
-- Table structure for table `mavro`
--

CREATE TABLE `mavro` (
  `ID` int(11) NOT NULL,
  `mavro` varchar(255) NOT NULL,
  `mavro2` varchar(256) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `name` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mavro`
--

INSERT INTO `mavro` (`ID`, `mavro`, `mavro2`, `user_id`, `created_at`, `name`) VALUES
(24, '500,000', '1,250', '1', '2021-11-07 08:28:17', 'Henry');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `receiver` text NOT NULL,
  `sender` text NOT NULL,
  `message` text NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `sent_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `ID` int(100) NOT NULL,
  `name` varchar(256) NOT NULL,
  `userid` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `code` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`ID`, `name`, `userid`, `email`, `code`) VALUES
(33, 'Henry', '1', 'trustedward@gmail.com', '89932'),
(36, 'PEACE LAWANI', '10', 'trustedward12@gmail.com', '11422'),
(37, 'Otoikhila Sharon', '21', 'trustedward03@gmail.com', '40469'),
(38, 'Tochukwu Ezike', '23', 'tochuks1@gmail.com', '26791'),
(39, 'Samantha moore', '24', 'samantha.reversal@gmail.com', '46647'),
(40, 'Blessing', '25', 'clayton03099@gmail.com', '93699'),
(41, 'Aneesa Hoosain', '26', 'trustedward1234@gmail.com', '94365'),
(42, 'Samuel', '28', 'jacobjuddy@gmail.com', '27436'),
(43, 'Barkiel David', '29', 'gwglruth@gmail.com', '44141'),
(44, 'Betty Sale', '31', 'gwglbetty@gmail.com', '72256'),
(45, 'Joanne Neighbout', '32', 'avensis001@hotmail.com', '23555'),
(46, 'Veronica Hawkins', '30', 'vtahawkins@gmail.com', '95502'),
(47, 'Henry', '33', 'samantha.reversal@gmail.com', '71673'),
(48, 'Aneesa Hoosain', '40', 'samantha.reversal@gmail.com', '15062'),
(49, 'Del Hab', '41', 'delhabnigenterprises@gmail.com', '49610'),
(50, 'JURI VAINO HUOPAINEN', '42', 'HUOPAJU2@GMAIL.COM', '42715'),
(51, 'Aneesa Hoosain', '43', 'trustedward12345@gmail.com', '22234'),
(52, 'JARKKO KALEVI NIEMINEN', '44', 'viemarikuvausjn@gmail.com', '57678'),
(53, 'YOUSSOUF DIALLO', '45', 'Youff.1950@Gmail.com', '41287'),
(54, 'samantha moore', '46', 'trustedward@gmail.com', '62871'),
(55, 'Tochukwu Ezike', '47', 'tochi@gmail.com', '57588'),
(56, 'Del Hab', '48', 'delhabnigenterprises@gmail.com', '94930'),
(57, 'samantha moore', '49', 'trustedward01@gmail.com', '83719'),
(58, 'samantha moore', '50', 'testing@gmail.com', '58819'),
(59, 'Ben Foster', '51', 'toc@gmail.com', '65534'),
(60, 'Goodluck', '52', 'trustedward@gmail.com', '32792'),
(61, 'ZUKA MOSAIC', '53', 'priestzukamosaic@gmail.com', '79669'),
(62, 'PYOTR MIKHODUY', '54', 'mercator3@yandex.ru', '70973'),
(63, 'TARAS DZHEVAHA', '55', 'LEMNOTEH@GMAIL.COM', '70105'),
(64, 'WANG YONGHE', '56', 'ZRDZ.CN@163.COM', '54264'),
(65, 'Del Hab', '58', 'delhabnigenterprises@gmail.com', '37202'),
(66, 'Del Hab', '59', 'delhabnigenterprises@gmail.com', '20890'),
(67, 'samantha moore', '60', 'trustedward12345@gmail.com', '39752'),
(68, 'Del Hab', '61', 'delhabnigenterprises@gmail.com', '93886'),
(69, 'MARIA ELSA NUNEZ DE WISZINSKI', '62', 'mariaelsawiszinski@gmail.com', '53877'),
(70, 'Del Hab', '63', 'delhabnigenterprises@gmail.com', '95356'),
(71, 'Aneesa Hoosain', '64', 'trustedward12345@gmail.com', '43657'),
(72, 'DEL HAB', '66', 'delhabnigenterprises@gmail.com', '14574'),
(73, 'DEL HAB', '68', 'delhabnigenterprises@gmail.com', '23287'),
(74, 'ANEESA HOOSAIN', '69', 'trustedward@gmail.com', '38502'),
(75, 'Aneesa Hoosain', '70', 'samantha.reversal@gmail.com', '86557'),
(76, 'ANEESA HOOSAIN', '72', 'trustedward1234@gmail.com', '35912'),
(77, 'DEL HAB', '78', 'delhabnigenterprises@gmail.com', '20725'),
(78, 'LEUNG MAN YING', '80', 'leungmanying21@gmail.com', '83267'),
(79, 'Aneesa Hoosain', '81', 'trustedward@gmail.com', '44405');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `body` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provide`
--

CREATE TABLE `provide` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `amount` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `origin_id` int(11) NOT NULL,
  `ref_id` int(11) NOT NULL,
  `ref_name` text NOT NULL,
  `ip` text NOT NULL,
  `agent` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimony`
--

CREATE TABLE `testimony` (
  `id` int(11) NOT NULL,
  `body` text NOT NULL,
  `name` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `testimony`
--

INSERT INTO `testimony` (`id`, `body`, `name`, `user_id`, `status`, `created_at`) VALUES
(1, 'Woa!!! This is fast! Keep it up guys!!! ', 'Unachukwu C.C', 2, 'approved', '2017-04-11 11:01:45'),
(2, 'The fastest platform ever!!!!! ', 'Obinna ', 5, 'approved', '2017-04-11 11:01:23'),
(3, 'Wow this is great never seen a ponzi scheme like this fast matching n fast payments', 'Ogboi Kingsley', 9, 'approved', '2017-04-11 12:01:13'),
(4, 'Thank God for Neo.  They are Good. God bless neointerest. I really thank God for pocket increase.. ', 'nwakile nnaemeka', 43, 'approved', '2017-04-11 12:01:01'),
(5, 'excellent one, i just got paid not even up to 30 minutes that i registered, we can make this sit work once u are paid pls try n recycle back so that we can move forword. thanks i luv u all.', 'christian uche', 41, 'approved', '2017-04-11 12:01:36'),
(6, 'Oboy this is the best platform ever', 'onojakaromah emmanuel', 11, 'approved', '2017-04-11 01:01:50'),
(7, 'Received my payment within 24hours', 'yahoo boy', 74, 'approved', '2017-04-11 01:01:13'),
(8, 'Neointerest is bae...Alert all the way', 'Ariyo Adegbola', 4, 'approved', '2017-04-11 05:01:46'),
(9, 'Great site', 'Unuame oke donald ', 82, 'approved', '2017-04-12 01:01:19'),
(10, 'Neo interest rocks\r\nGod bless d admins\r\nThis is my third recycle on 50k package. ', 'Adegbite  Mojere Adetomi', 22, 'approved', '2017-04-12 11:01:43'),
(11, 'Waoh! So terrific.\r\nNeo- Interest is the baba. I registered and donated 20k yesterday and today , I have been paid. \r\nThis is the best ponzi site ever. So transperant  and truthful in their dealings. \r\nI love this site', 'Abara Georgina', 58, 'approved', '2017-04-13 12:01:33'),
(12, 'This is the best platform i have seen. My money never delayed in this platform. NoeInterest rocks. Kudos', 'Okonkwo James', 160, 'approved', '2017-06-23 03:01:20'),
(13, 'Best site ever.....just confirmed my ghee. ...', 'Obuh Henry', 157, 'pending', '2017-07-20 07:01:35'),
(14, '', 'Precious', 170, 'pending', '2017-07-26 05:01:01'),
(15, 'Worst scheme ever.\r\n1. No support service\r\n2. No response on the live chat\r\n', 'omoniyi', 166, 'pending', '2017-07-28 03:01:55'),
(16, 'Got paid, Thank you Neointerest.', '', 0, 'approved', '2017-08-05 02:01:07'),
(17, 'Please i have just been paid, how do i confirm the person that paid me?', 'KABIRU ABDULAHI', 164, 'approved', '2017-08-07 03:01:05'),
(18, 'like seriously, am surprised at how effective dis platform has been...kudos to the management', 'Eric Onuoha', 173, 'approved', '2017-08-07 03:01:03'),
(19, 'this site is wonderful, i recommend this site for anyone, i wish i had known this platform b4 nw..just got paid..', 'Anya Ijeoma', 194, 'approved', '2017-08-10 10:01:18'),
(20, 'I donated a sum of N100000 on quillars platform on the 27/8/17, to get GH on 29/8/17, I have not been paid uptill now. Quillars claim that its site has been harked and I was referred to join this platform for payment and continuations of participation. Iam ready to continue to participate if I am paid. Thanks for your urgent response to this.', 'Chukwudi Ihekanandu', 230, 'pending', '2017-08-31 03:01:38'),
(21, 'I donated a sum of N100000 on quillars platform on the 27/8/17, to get GH on 29/8/17, I have not been paid uptill now. Quillars claim that its site has been harked and I was referred to join this platform for payment and continuations of participation. Iam ready to continue to participate if I am paid. Thanks for your urgent response to this.', 'Chukwudi Ihekanandu', 230, 'pending', '2017-08-31 04:01:51'),
(22, 'Please we have not been paid o', 'Eno-obong', 241, 'pending', '2017-09-06 05:01:50'),
(23, 'Neo is outstanding, just got paid less than 1hour after making donation today been September 6th, 2017', 'Akhere I', 215, 'pending', '2017-09-06 02:01:01'),
(24, 'Neointerest plz u guys shuld look into my matter..i made a donation 5 days ago, yet i havnt been peered nt 2 talk of receiving payments..plz u guys shuld help me', 'Enefola precious', 239, 'pending', '2017-09-11 07:01:32'),
(25, 'Good day neointerest. My name is ODENIYI BABATUNDE and my email is globalimpactor@gmail.com. i got to know about neointerest 2 days ago Â and decided to give it a trail. I was merged yesterday morning to one Mr Akhere and i paid the sum of one hundred thousand naira and he has confirmed the reception of the fund on my page only for one Bello Temitope to call about 4 hours after that i have been merged to pay him again. I checked my page and i saw it there and i called him that it must have been an error from your system. Since then, i have been trying the online care assistant and even the email but it was not going. The online was offline. It later went through this morning and the person i chat with was telling me to go and pay the second person which is right now impossible for me. All i was waiting for was to be merged to receive my money after i have fulfillled my own part of the agreement only for all these to happen.kindly look into the situation and help.Â \r\n\r\n\r\n', 'ODENIYI BABATUNDE', 245, 'pending', '2017-09-13 02:01:15'),
(26, 'Good day neointerest. My name is ODENIYI BABATUNDE and my email is globalimpactor@gmail.com. i got to know about neointerest 2 days ago Â and decided to give it a trail. I was merged yesterday morning to one Mr Akhere and i paid the sum of one hundred thousand naira and he has confirmed the reception of the fund on my page only for one Bello Temitope to call about 4 hours after that i have been merged to pay him again. I checked my page and i saw it there and i called him that it must have been an error from your system. Since then, i have been trying the online care assistant and even the email but it was not going. The online was offline. It later went through this morning and the person i chat with was telling me to go and pay the second person which is right now impossible for me. All i was waiting for was to be merged to receive my money after i have fulfillled my own part of the agreement only for all these to happen.kindly look into the situation and help.Â \r\n\r\n\r\n', 'ODENIYI BABATUNDE', 245, 'pending', '2017-09-13 02:01:21'),
(27, 'Good day neointerest. My name is ODENIYI BABATUNDE and my email is globalimpactor@gmail.com. i got to know about neointerest 2 days ago Â and decided to give it a trail. I was merged yesterday morning to one Mr Akhere and i paid the sum of one hundred thousand naira and he has confirmed the reception of the fund on my page only for one Bello Temitope to call about 4 hours after that i have been merged to pay him again. I checked my page and i saw it there and i called him that it must have been an error from your system. Since then, i have been trying the online care assistant and even the email but it was not going. The online was offline. It later went through this morning and the person i chat with was telling me to go and pay the second person which is right now impossible for me. All i was waiting for was to be merged to receive my money after i have fulfillled my own part of the agreement only for all these to happen.kindly look into the situation and help.Â \r\n\r\n\r\n', 'ODENIYI BABATUNDE', 245, 'pending', '2017-09-13 02:01:27'),
(28, 'i saw many good and nice testimony about this site so i decided to register myself and i made a donation of 5000naira  this is more than two weeks now and i have not gotten anything nobody is paired to me for a donation i decided to contact the call support they replied none on my massage....if i dont get my money soon i will create a very bad sponsored post about this site on facebook (with the a link to this site) and report this site in naijaloaded and nairaland  ...but i wont like to do it so make una jejely pay me my money back....or ', 'tensun', 244, 'pending', '2017-09-19 03:01:28'),
(29, 'Pls paired me to get help..... I have provided help for more than two weeks now and nobody is paired to me to receive help', 'tensun', 244, 'pending', '2017-09-20 10:01:57'),
(30, 'Pls paired me to get help..... I have provided help for more than two weeks now and nobody is paired to me to receive help', 'tensun', 244, 'pending', '2017-09-20 10:01:47'),
(31, 'Pls paired me to get help..... I have provided help for more than two weeks now and nobody is paired to me to receive help', 'tensun', 244, 'pending', '2017-09-20 10:01:58'),
(32, 'rfrre', 'Frank', 254, 'pending', '2017-12-01 07:01:26'),
(33, 'rfrre', 'Frank', 254, 'pending', '2017-12-01 07:01:44'),
(34, 'rfrre', 'Frank', 254, 'pending', '2017-12-01 07:01:47'),
(35, 'rfrre', 'Frank', 254, 'pending', '2017-12-01 07:01:43'),
(36, 'rfrre', 'Frank', 254, 'pending', '2017-12-01 07:01:13'),
(37, 'rfrre', 'Frank', 254, 'pending', '2017-12-01 07:01:33'),
(38, 'rfrre', 'Frank', 254, 'pending', '2017-12-01 07:01:14'),
(39, 'rfrre', 'Frank', 254, 'pending', '2017-12-01 07:01:51'),
(40, 'I am sad to transact business with you. I paid N20000 for bitcoin into your UBA account since August 7, 2018 till now you do not fund my wallet.', 'Oluseun Ogunkanmi', 280, 'pending', '2018-09-04 09:01:43'),
(41, 'Fund my wallet. I paid you since August 7. Fear God if  you do not want to see wrath of God', 'Oluseun Ogunkanmi', 280, 'pending', '2018-09-11 08:01:14'),
(42, 'Fund my wallet. I paid you since August 7. Fear God if  you do not want to see wrath of God', 'Oluseun Ogunkanmi', 280, 'pending', '2018-09-11 08:01:02'),
(43, 'Fund my wallet. I paid you since August 7. Fear God if  you do not want to see wrath of God', 'Oluseun Ogunkanmi', 280, 'pending', '2018-09-11 08:01:20'),
(44, 'Fund my wallet. I paid you since August 7. Fear God if  you do not want to see wrath of God', 'Oluseun Ogunkanmi', 280, 'pending', '2018-09-11 08:01:29'),
(45, 'Pls, good morning everyone, how is this platform like, someone should talk to me plssssss', 'Godday Sarah', 330, 'pending', '2018-10-26 05:01:08'),
(46, 'Hello Good day. What happened between me and sureplex was I invested $275 and my interest was allocated after 10 days, I was trying to withdraw but it was showing me I canâ€™t withdraw because the minimum amount for withdrawal is $500 while I was having $411. So I chatted the support and was complaining that they shouldâ€™ve made the minimum amount visible, I showed them I was angry but they apologized. They said I should deposit another $275 and withdraw or allow that $275 to mature. So I asked their support team if there was any other thing and they said No. so I did as they said. After then I was trying to withdraw then it was showing me No referral in my account. Thereâ€™s one of their agent in particular Elizabeth, she told me nothing is left I should just deposit and withdraw. I chatted the support team again, they told me I donâ€™t have a referral on my account. I was very angry then, I asked them why didnâ€™t they make this rules visible so that people can know what they are investing, they couldnâ€™t give me an answer they only\r\nSaid it was a new policy. I introduced my brother he deposited and they refused to\r\nCredit his account. They said the amount was not upto $275 while we even sent $294 so they said they will refund after 2 weeks. On Friday 16th of November was exactly two weeks, they didnâ€™t refund the money rather credited his account. Why havenâ€™t they credit his account since? Isnâ€™t this not fishy? I was able to place withdrawal on my account and I have not been paid up till now. Bitcoin withdrawals take just 24hrs but this is 72 hrs nothing has been paid still pending. Sureplex needs to be transparent, this is people hard earned money that they are investing. I have proof of everything the chats with the support and how everything happened. I am also calling on Sureplex Company to pay me my money if not we will never stop attacking them. I will do whatever it takes to bring them down if they donâ€™t pay me my money. Even if it takes to pay bloggers to publish what they are doing, because I have pictures of chats and everything. I hope they will read this message and adhere by it. This is inhuman, wickedness. I face a lot of financial challenges because of that money. If they donâ€™t pay me as soon as possible am taking the proper and necessary action as stated. Thank you all!!', 'Maryam Bello ', 303, 'pending', '2018-11-18 09:01:58'),
(47, 'Hello', 'Aisha Kaneez', 371, 'pending', '2019-01-30 12:01:51'),
(49, 'My international passport is attached with all my details so that my account can be verified.', 'Adijat Mohammed', 663, 'pending', '2020-11-23 08:01:49'),
(50, 'Please find attached my international passport for my verification ', 'Adijat Mohammed', 663, 'pending', '2020-12-27 09:01:20');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(10) NOT NULL,
  `name` varchar(256) NOT NULL,
  `transaction` varchar(256) NOT NULL,
  `amount` varchar(256) NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `created_at` datetime NOT NULL,
  `Status` varchar(256) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `name`, `transaction`, `amount`, `user_id`, `created_at`, `Status`, `description`) VALUES
(1, 'Frank', 'funding', '2000', '254', '2018-09-23 09:13:29', 'pending', ''),
(2, 'Blessing Ariyo Adegbola ', 'Deposit', '0.000456', '4', '2017-09-23 10:25:14', 'Completed', ''),
(3, 'Blessing Ariyo Adegbola ', 'Withdrawal', '0.50', '4', '2018-09-23 10:42:32', 'Completed', ''),
(4, 'Blessing Ariyo Adegbola ', 'Deposit', '6.06', '4', '2018-09-30 14:31:05', 'Completed', ''),
(5, 'Blessing Ariyo Adegbola ', 'Withdrawal', '0.91', '4', '2018-09-30 14:33:03', 'Completed', ''),
(6, 'Blessing Ariyo Adegbola ', 'Withdrawal', '1.52', '4', '2018-09-30 14:34:18', 'Completed', ''),
(7, 'Blessing Ariyo Adegbola ', 'Withdrawal', '0.45', '4', '2018-09-30 14:35:08', 'Completed', ''),
(8, 'Blessing Ariyo Adegbola ', 'Withdrawal', '0.91', '4', '2018-09-30 14:35:52', 'Completed', ''),
(9, 'Blessing Ariyo Adegbola ', 'Withdrawal', '0.30', '4', '2018-09-30 14:36:46', 'Completed', ''),
(10, 'Blessing Ariyo Adegbola ', 'Deposit', '278', '4', '2018-10-08 13:34:31', 'Completed', ''),
(11, 'Maryam Bello ', 'Deposit', '0.04', '303', '2018-10-08 13:40:53', 'Completed', ''),
(13, 'Maryam Bello ', 'Interest Allocation', '0.021', '303', '2018-10-18 20:04:33', 'Completed', ''),
(14, 'Maryam Bello ', 'Deposit', '0.0415', '303', '2018-10-23 15:43:23', 'Completed', ''),
(15, 'Maryam Bello ', 'Interest Allocation', ' 0.0218', '303', '2018-11-01 07:33:57', 'Completed', ''),
(16, 'Thuso Mphela', 'Deposit', '5000', '364', '2018-10-01 20:06:08', 'Completed', ''),
(17, 'Thuso Mphela', 'Deposit', '5000', '364', '2018-10-02 10:06:09', 'Completed', ''),
(18, 'Thuso Mphela', 'Reward', '15,000', '364', '2018-10-17 14:07:52', 'Completed', ''),
(19, 'Thuso Mphela', 'Reward', '13,000', '364', '2018-10-18 16:08:46', 'Completed', ''),
(20, 'Thuso Mphela', 'Reward', '24,000', '364', '2018-10-19 17:09:26', 'Completed', ''),
(21, 'Thuso Mphela', 'Reward', '12,400', '364', '2018-10-29 15:10:42', 'Completed', ''),
(22, 'Thuso Mphela', 'Withdrawal', '50,000', '364', '2018-11-09 12:12:10', 'Pending', ''),
(23, 'Thuso Mphela', 'Withdrawal', '50,000', '364', '2018-11-20 18:12:34', 'Completed', ''),
(24, 'Thuso Mphela', 'Withdrawal', '40,000', '364', '2018-11-30 18:13:47', 'Completed', ''),
(25, 'Thuso Mphela', 'Withdrawal', '80,000', '364', '2018-12-09 18:14:59', 'Completed', ''),
(26, 'Thuso Mphela', 'Withdrawal', '100,000', '364', '2018-12-20 18:15:41', 'Completed', ''),
(27, 'Thuso Mphela', 'Withdrawal', '115,000', '364', '2019-01-01 20:20:26', 'Completed', ''),
(28, 'Thuso Mphela', 'Deposit', '100,000', '364', '2019-01-02 14:21:45', 'Completed', ''),
(29, 'Thuso Mphela', 'Withdrawal', '210,000', '364', '2019-01-11 18:22:21', 'Completed', ''),
(30, 'Henry', 'Transfer', '32,000', '1', '2021-11-26 22:16:33', 'Successful', ''),
(31, 'Henry', 'Received', '12,200', '1', '2021-11-26 22:33:12', 'Completed', ''),
(32, 'Aneesa Hoosain', 'Debit Alert', '4000', '26', '2022-01-13 21:59:38', 'account mentainnace ', ''),
(33, 'Betty Sale', 'Debit Alert', '5000', '31', '2022-01-13 22:13:21', 'account mentainnace ', ''),
(34, 'Veronica Hawkins', 'Credit', '20000', '30', '2022-01-14 05:30:25', 'Loandra Credit LLC', ''),
(35, 'Joanne Neighbout', 'Credit', '20000', '32', '2022-01-15 03:53:01', 'Loandra Credit LLC', ''),
(36, 'Henry', 'Credit', '6482', '33', '2022-02-04 20:10:38', 'Successful', ''),
(37, 'Henry', 'Credit', '6494', '33', '2022-02-04 20:12:48', 'Successful', ''),
(38, 'Henry', 'Credit', '6537', '33', '2022-02-04 20:24:02', 'Successful', ''),
(39, 'Henry', 'Credit', '6580', '33', '2022-02-04 20:35:17', 'Successful', ''),
(40, 'Henry', 'Credit', 'â‚¬40', '33', '2022-02-04 21:06:18', 'Successful', ''),
(41, 'Henry', 'Credit', 'â‚¬43', '33', '2022-02-04 21:18:31', 'Successful', ''),
(42, 'Henry', 'Credit', 'â‚¬ 14.00', '33', '2022-02-04 21:22:48', 'Successful', ''),
(43, 'Henry', 'Credit', 'â‚¬ 33', '33', '2022-02-04 12:35:20', 'Successful', ''),
(44, 'Henry', 'Credit', 'â‚¬ 12000', '33', '2022-02-04 20:38:09', 'Successful', ''),
(45, 'Henry', 'Credit', 'â‚¬ 22,000', '33', '2022-02-06 11:28:11', 'Successful', ''),
(46, 'Henry', 'Credit', 'â‚¬ 22000', '33', '2022-02-06 11:28:30', 'Successful', ''),
(47, 'Henry', 'Debit', 'â‚¬33200', '33', '2022-02-06 11:29:37', 'Successful', ''),
(48, 'Rebecca Stan', 'Credit', 'â‚¬ 4000', '38', '2022-02-06 19:42:51', 'Successful', ''),
(49, 'Rebecca Stan', 'Credit', 'â‚¬ 39.00', '39', '2022-02-06 19:43:20', 'Successful', ''),
(50, 'Del Hab', 'investment funds', '20000 $', '41', '2022-02-14 20:12:38', 'active', ''),
(51, '', 'Credit', ' 20000', '20000', '2022-02-14 19:16:36', 'Successful', ''),
(52, 'Del Hab', 'Credit', 'Â£ 20000', '41', '2022-02-14 19:16:53', 'Successful', ''),
(53, 'Del Hab', 'INVESTMENT FUNDS', '20000', '41', '2022-02-14 20:25:40', 'ACTIVE', ''),
(54, 'Del Hab', 'Credit', 'Â£ 10', '41', '2022-02-15 19:10:20', 'Successful', ''),
(55, 'Del Hab', 'Credit', 'Â£ 3000', '41', '2022-02-17 11:32:53', 'Successful', ''),
(56, 'JURI VAINO HUOPAINEN', 'Credit', 'Â£ 1000', '42', '2022-03-17 12:53:06', 'Successful', ''),
(57, 'Del Hab', 'Credit', 'Â£ 20000', '41', '2022-03-21 14:18:02', 'Successful', ''),
(58, 'JURI VAINO HUOPAINEN', 'Credit', 'Â£ 3850000', '42', '2022-03-21 14:23:24', 'Successful', ''),
(59, 'JARKKO KALEVI NIEMINEN', 'Credit', 'Â£ 1000', '44', '2022-03-21 15:48:46', 'Successful', ''),
(60, 'YOUSSOUF DIALLO', 'Credit', 'Â£ 1000', '45', '2022-03-23 14:54:37', 'Successful', ''),
(61, 'Del Hab', 'Credit', 'Â£ 3850000', '48', '2022-03-24 12:02:47', 'Successful', ''),
(62, 'YOUSSOUF DIALLO', 'Credit', 'Â£ 3850000', '45', '2022-03-25 14:07:59', 'Successful', ''),
(63, 'JARKKO KALEVI NIEMINEN', 'Credit', 'Â£ 3850000', '44', '2022-03-25 14:08:20', 'Successful', ''),
(64, 'Del Hab', 'Debit', 'Â£3000000', '48', '2022-03-25 14:09:09', 'Successful', ''),
(65, 'Del Hab', 'Credit', 'Â£ 1000', '48', '2022-03-25 14:11:23', 'Successful', ''),
(66, 'Del Hab', 'Debit', 'Â£30075', '48', '2022-03-29 10:19:25', 'Successful', ''),
(67, 'Del Hab', 'Debit', 'Â£10350', '48', '2022-03-29 10:22:02', 'Successful', ''),
(68, 'YOUSSOUF DIALLO', 'Debit', 'Â£30075', '45', '2022-03-29 10:23:12', 'Successful', ''),
(69, 'JARKKO KALEVI NIEMINEN', 'Debit', 'Â£30075', '44', '2022-03-29 10:40:53', 'Successful', ''),
(70, 'JARKKO KALEVI NIEMINEN', 'Credit', 'Â£ 30075', '44', '2022-03-29 15:19:30', 'Successful', ''),
(71, 'YOUSSOUF DIALLO', 'Credit', 'Â£ 30075', '45', '2022-03-29 15:19:50', 'Successful', ''),
(72, 'PYOTR MIKHODUY', 'Credit', 'Â£ 1000', '54', '2022-04-22 17:02:09', 'Successful', ''),
(73, 'PYOTR MIKHODUY', 'INVESTMENT FUNDS', '3850000', '54', '2022-04-25 16:10:33', 'ACTIVE', ''),
(74, 'PYOTR MIKHODUY', 'Credit', 'Â£ 3850000', '54', '2022-04-25 16:11:20', 'Successful', ''),
(75, 'TARAS DZHEVAHA', 'Credit', '$ 1000', '55', '2022-05-12 16:31:50', 'Successful', ''),
(76, 'Del Hab', 'Credit', 'Â£ 100000', '48', '2022-05-17 12:46:35', 'Successful', ''),
(77, 'TARAS DZHEVAHA', 'Credit', '$ 2500000', '55', '2022-05-17 12:53:30', 'Successful', ''),
(78, 'TARAS DZHEVAHA', 'Debit', '$100000', '55', '2022-05-17 13:00:02', 'Successful', ''),
(79, 'WANG YONGHE', 'Credit', 'Â£ 1000', '56', '2022-05-23 17:22:31', 'Successful', ''),
(80, 'WANG YONGHE', 'Credit', 'Â£ 3850000', '56', '2022-05-24 14:00:51', 'Successful', ''),
(81, 'Del Hab', 'Credit', 'Â£ 100000', '48', '2022-05-24 14:01:48', 'Successful', ''),
(82, 'Del Hab', 'Debit', 'Â£1000000', '48', '2022-05-24 14:11:41', 'Successful', ''),
(83, 'Del Hab', 'Credit', 'Â£ 1000000', '48', '2022-05-24 21:21:25', 'Successful', ''),
(84, 'Del Hab', 'Credit', 'Â£ 2000000', '48', '2022-05-25 10:52:02', 'Successful', ''),
(85, 'WANG YONGHE', 'Debit', 'Â£3850000', '56', '2022-05-25 13:22:03', 'Successful', ''),
(86, 'WANG YONGHE', 'Credit', 'Â£ 3850000', '56', '2022-05-25 13:22:31', 'Successful', ''),
(87, 'Del Hab', 'Credit', 'Â£ 50000', '58', '2022-09-08 17:17:21', 'Successful', ''),
(88, 'Del Hab', 'Credit', 'Â£ 90000', '59', '2022-09-13 22:01:06', 'Successful', ''),
(89, 'MARIA ELSA NUNEZ DE WISZINSKI', 'Credit', '$ 2090000', '62', '2022-10-20 15:39:37', 'Successful', ''),
(90, 'Aneesa Hoosain', 'Credit', '$ 100', '64', '2022-10-28 20:21:08', 'Successful', ''),
(91, 'Aneesa Hoosain', 'Debit', '$20', '64', '2022-10-28 20:22:23', 'Successful', ''),
(92, 'Aneesa Hoosain', 'Credit', '$ 12', '64', '2022-10-28 20:23:57', 'Successful', ''),
(93, 'MARIA ELSA NUNEZ DE WISZINSKI', 'Credit', '$ 2090000', '65', '2022-10-31 08:28:41', 'Successful', ''),
(94, 'MARIA ELSA NUNEZ DE WISZINSKI', 'Credit', '$ 2090000', '67', '2022-10-31 10:16:49', 'Successful', ''),
(95, 'DEL HAB', 'Credit', '$ 90000', ' 	66', '2022-10-31 11:26:32', 'Successful', ''),
(96, 'Aneesa Hoosain', 'Credit', '$ 60', '64', '2022-10-31 14:09:41', 'Successful', ''),
(97, 'Aneesa Hoosain', 'Credit', '$ 10', '64', '2022-10-31 14:17:57', 'Successful', ''),
(98, 'Aneesa Hoosain', 'Credit', '$ 3', '64', '2022-10-31 14:22:34', 'Successful', ''),
(99, 'Aneesa Hoosain', 'Credit', '$ 2', '64', '2022-10-31 14:24:21', 'Successful', ''),
(100, 'Aneesa Hoosain', 'Debit', '$3', '64', '2022-10-31 14:25:38', 'Successful', ''),
(101, 'Aneesa Hoosain', 'Credit', '$ 1', '64', '2022-10-31 14:29:23', 'Successful', ''),
(102, 'Aneesa Hoosain', 'Credit', '$ 8', '64', '2022-10-31 19:43:00', 'Successful', ''),
(103, 'Aneesa Hoosain', 'Credit', '$ 9', '64', '2022-10-31 19:47:44', 'Successful', ''),
(104, 'Aneesa Hoosain', 'Credit', '$ 4', '64', '2022-10-31 19:49:09', 'Successful', ''),
(105, 'Aneesa Hoosain', 'Credit', '$ 2', '64', '2022-10-31 20:20:01', 'Successful', ''),
(106, '', 'Credit', ' 10', '4', '2022-10-31 20:20:46', 'Successful', ''),
(107, 'Aneesa Hoosain', 'Credit', '$ 4', '64', '2022-10-31 20:21:01', 'Successful', ''),
(108, 'Aneesa Hoosain', 'Credit', '$ 3', '64', '2022-10-31 20:25:00', 'Successful', ''),
(109, 'DEL HAB', 'Debit', '$20000', '66', '2022-11-02 13:10:05', 'Successful', ''),
(110, 'MARIA ELSA NUNEZ DE WISZINSKI', 'Debit', '$50000', '67', '2022-11-02 13:11:58', 'Successful', ''),
(111, 'Aneesa Hoosain', 'Debit', '$10', '64', '2022-11-02 13:22:42', 'Successful', ''),
(112, 'Aneesa Hoosain', 'Debit', '$2', '64', '2022-11-02 13:36:14', 'Successful', ''),
(113, 'Aneesa Hoosain', 'Credit', '$ 5', '64', '2022-11-02 13:44:24', 'Successful', ''),
(114, 'Aneesa Hoosain', 'Credit', '$ 2', '64', '2022-11-02 13:48:49', 'Successful', ''),
(115, 'Aneesa Hoosain', 'Credit', '$ 1', '64', '2022-11-02 13:53:05', 'Successful', ''),
(116, 'Aneesa Hoosain', 'Credit', '$ 6', '64', '2022-11-02 14:00:43', 'Successful', ''),
(117, 'Aneesa Hoosain', 'Credit', '$ 7', '64', '2022-11-02 14:14:28', 'Successful', ''),
(118, 'Aneesa Hoosain', 'Credit', '$ 3', '64', '2022-11-02 14:19:35', 'Successful', ''),
(119, 'Aneesa Hoosain', 'Credit', '$ 7', '64', '2022-11-02 14:42:01', 'Successful', ''),
(120, 'ANEESA HOOSAIN', 'Credit', 'â‚¬ 10', '69', '2022-12-14 23:23:04', 'Successful', ''),
(121, 'ANEESA HOOSAIN', 'Debit', 'â‚¬2', '69', '2022-12-14 23:23:37', 'Successful', ''),
(122, 'ANEESA HOOSAIN', 'Credit', 'â‚¬ 1', '69', '2022-12-14 23:25:23', 'Successful', ''),
(123, 'ANEESA HOOSAIN', 'Credit', 'â‚¬ 7', '69', '2022-12-14 23:27:03', 'Successful', ''),
(124, 'ANEESA HOOSAIN', 'Credit', 'â‚¬ 2', '69', '2022-12-14 23:27:59', 'Successful', ''),
(125, 'ANEESA HOOSAIN', 'Credit', 'â‚¬ 1', '69', '2022-12-14 23:29:52', 'Successful', ''),
(126, 'ANEESA HOOSAIN', 'Credit', 'â‚¬ 12', '69', '2022-12-14 23:43:37', 'Successful', ''),
(127, 'ANEESA HOOSAIN', 'Credit', 'â‚¬ 1', '69', '2022-12-14 23:50:28', 'Successful', ''),
(128, 'ANEESA HOOSAIN', 'Credit', 'â‚¬ 1', '69', '2022-12-14 23:52:57', 'Successful', ''),
(129, 'ANEESA HOOSAIN', 'Credit', 'â‚¬ 2', '69', '2022-12-14 23:54:41', 'Successful', ''),
(130, 'ANEESA HOOSAIN', 'Credit', 'â‚¬ 2', '69', '2022-12-15 00:04:01', 'Successful', ''),
(131, 'ANEESA HOOSAIN', 'Credit', 'â‚¬ 1', '69', '2022-12-15 00:05:27', 'Successful', ''),
(132, 'ANEESA HOOSAIN', 'Debit', 'â‚¬3', '69', '2022-12-15 00:05:41', 'Successful', ''),
(133, 'Aneesa Hoosain', 'Credit', 'â‚¬ 1', '70', '2022-12-15 08:25:44', 'Successful', ''),
(134, 'Aneesa Hoosain', 'Credit', 'â‚¬ 2', '70', '2022-12-15 08:27:47', 'Successful', ''),
(135, 'Aneesa Hoosain', 'Credit', 'â‚¬ 4', '70', '2022-12-15 08:28:50', 'Successful', ''),
(136, 'Aneesa Hoosain', 'Credit', 'â‚¬ 1', '70', '2022-12-15 08:31:56', 'Successful', ''),
(137, 'Aneesa Hoosain', 'Credit', 'â‚¬ 1', '70', '2022-12-15 08:32:19', 'Successful', ''),
(138, 'Aneesa Hoosain', 'Credit', 'â‚¬ 1', '70', '2022-12-15 08:32:31', 'Successful', ''),
(139, 'Aneesa Hoosain', 'Credit', 'â‚¬ 3', '70', '2022-12-15 08:33:36', 'Successful', ''),
(140, 'Aneesa Hoosain', 'Credit', 'â‚¬ 1', '70', '2022-12-15 08:35:50', 'Successful', ''),
(141, 'Aneesa Hoosain', 'Credit', 'â‚¬ 1', '70', '2022-12-15 08:36:35', 'Successful', ''),
(142, 'Aneesa Hoosain', 'Credit', 'â‚¬ 1', '70', '2022-12-15 08:38:54', 'Successful', ''),
(143, 'Aneesa Hoosain', 'Credit', 'â‚¬ 1', '70', '2022-12-15 08:40:21', 'Successful', ''),
(144, 'Aneesa Hoosain', 'Credit', 'â‚¬ 1', '70', '2022-12-15 08:40:42', 'Successful', ''),
(145, 'Aneesa Hoosain', 'Debit', 'â‚¬1', '70', '2022-12-15 08:41:00', 'Successful', ''),
(146, 'Aneesa Hoosain', 'Credit', 'â‚¬ 9', '70', '2022-12-15 08:41:56', 'Successful', ''),
(147, 'Aneesa Hoosain', 'Credit', 'â‚¬ 2', '70', '2022-12-15 08:43:35', 'Successful', ''),
(148, 'Aneesa Hoosain', 'Credit', 'â‚¬ 1', '70', '2022-12-15 08:48:06', 'Successful', ''),
(149, 'Aneesa Hoosain', 'Credit', 'â‚¬ 12', '70', '2022-12-15 08:50:02', 'Successful', ''),
(150, 'Aneesa Hoosain', 'Credit', 'â‚¬ 2', '70', '2022-12-15 08:50:50', 'Successful', ''),
(151, 'Aneesa Hoosain', 'Credit', 'â‚¬ 2', '70', '2022-12-15 08:51:39', 'Successful', ''),
(152, 'Aneesa Hoosain', 'Credit', 'â‚¬ 4', '70', '2022-12-15 08:52:32', 'Successful', ''),
(153, 'Aneesa Hoosain', 'Credit', 'â‚¬ 1', '70', '2022-12-15 08:53:06', 'Successful', ''),
(154, 'Aneesa Hoosain', 'Credit', 'â‚¬ 4', '70', '2022-12-15 08:53:53', 'Successful', ''),
(155, 'Aneesa Hoosain', 'Credit', 'â‚¬ 2', '70', '2022-12-15 08:55:27', 'Successful', ''),
(156, 'Aneesa Hoosain', 'Credit', 'â‚¬ 1', '70', '2022-12-15 09:00:00', 'Successful', ''),
(157, 'Aneesa Hoosain', 'Credit', 'â‚¬ 1', '70', '2022-12-15 09:03:41', 'Successful', ''),
(158, 'Aneesa Hoosain', 'Credit', 'â‚¬ 1', '70', '2022-12-15 09:05:56', 'Successful', ''),
(159, 'Aneesa Hoosain', 'Credit', 'â‚¬ 1', '70', '2022-12-15 09:07:38', 'Successful', ''),
(160, 'Aneesa Hoosain', 'Credit', 'â‚¬ 1', '70', '2022-12-15 09:08:14', 'Successful', ''),
(161, 'Aneesa Hoosain', 'Credit', 'â‚¬ 2', '70', '2022-12-15 09:09:08', 'Successful', ''),
(162, 'Aneesa Hoosain', 'Credit', 'â‚¬ 10', '70', '2022-12-15 09:17:14', 'Successful', ''),
(163, 'Aneesa Hoosain', 'Credit', 'â‚¬ 1', '70', '2022-12-15 09:19:05', 'Successful', ''),
(164, 'Aneesa Hoosain', 'Credit', 'â‚¬ 12', '70', '2022-12-15 09:19:57', 'Successful', ''),
(165, 'Aneesa Hoosain', 'Debit', 'â‚¬2', '70', '2022-12-15 09:20:20', 'Successful', ''),
(166, 'Aneesa Hoosain', 'Debit', 'â‚¬4', '70', '2022-12-15 09:20:39', 'Successful', ''),
(167, 'Aneesa Hoosain', 'Credit', 'â‚¬ 2', '70', '2022-12-15 09:21:24', 'Successful', ''),
(168, 'Aneesa Hoosain', 'Credit', 'â‚¬ 2', '70', '2022-12-15 09:22:14', 'Successful', ''),
(169, 'ANEESA HOOSAIN', 'Credit', 'â‚¬ 2', '69', '2022-12-15 09:22:45', 'Successful', ''),
(170, 'Aneesa Hoosain', 'Credit', 'â‚¬ 10', '70', '2022-12-15 09:23:49', 'Successful', ''),
(171, 'Aneesa Hoosain', 'Credit', 'â‚¬ 2', '70', '2022-12-15 09:25:02', 'Successful', ''),
(172, 'Aneesa Hoosain', 'Credit', 'â‚¬ 4', '70', '2022-12-15 09:37:25', 'Successful', ''),
(173, 'ANEESA HOOSAIN', 'Credit', 'â‚¬ 2', '72', '2022-12-15 09:43:42', 'Successful', ''),
(174, 'ANEESA HOOSAIN', 'Credit', 'â‚¬ 10', '72', '2022-12-15 09:46:07', 'Successful', ''),
(175, 'Aneesa Hoosain', 'Credit', 'â‚¬ 1', '70', '2022-12-15 10:26:41', 'Successful', ''),
(176, 'Aneesa Hoosain', 'Credit', 'â‚¬ 1', '70', '2022-12-15 10:27:00', 'Successful', ''),
(177, 'ANEESA HOOSAIN', 'Credit', 'â‚¬ 2', '72', '2022-12-15 10:27:58', 'Successful', ''),
(178, 'Aneesa Hoosain', 'Credit', 'â‚¬ 1', '70', '2022-12-15 10:29:50', 'Successful', ''),
(179, 'Aneesa Hoosain', 'Credit', 'â‚¬ 2', '70', '2022-12-15 10:40:15', 'Successful', ''),
(180, 'Aneesa Hoosain', 'Credit', 'â‚¬ 4', '70', '2022-12-15 10:40:33', 'Successful', ''),
(181, 'Aneesa Hoosain', 'Credit', 'â‚¬ 1', '70', '2022-12-15 10:42:01', 'Successful', ''),
(182, 'Aneesa Hoosain', 'Debit', 'â‚¬31', '70', '2022-12-15 10:45:38', 'Successful', ''),
(183, 'DEL HAB', 'Credit', 'â‚¬ 30000', '78', '2022-12-15 12:32:16', 'Successful', ''),
(184, 'MARIA ELSA NUNEZ DE WISZINSKI', 'Credit', '$ 2090000', '79', '2022-12-15 12:50:29', 'Successful', ''),
(185, 'MARIA ELSA NUNEZ DE WISZINSKI', 'Debit', '$50000', '79', '2022-12-15 12:50:51', 'Successful', ''),
(186, 'LEUNG MAN YING', 'Credit', 'Â£ 5800000', '80', '2022-12-15 13:08:28', 'Successful', ''),
(187, 'Aneesa Hoosain', 'Credit', '$ 1000', '81', '2023-10-06 17:52:54', 'Successful', '                                        '),
(188, 'Aneesa Hoosain', 'Debit', '$0', '', '2023-10-06 18:51:29', 'Successful', ''),
(189, 'Aneesa Hoosain', 'Debit', '$0', '81', '2023-10-06 18:54:30', 'Successful', ''),
(190, 'Aneesa Hoosain', 'Debit', '$10', '81', '2023-10-06 18:57:23', 'Successful', ''),
(191, 'Aneesa Hoosain', 'Credit', '$ 2000', '81', '2023-10-07 17:18:42', 'Successful', '                                        credit'),
(192, 'Aneesa Hoosain', 'Credit', '$ 2000', '81', '2023-10-07 17:20:08', 'Successful', '                                        credit'),
(193, 'Aneesa Hoosain', 'Debit', '$2', '81', '2023-10-09 23:19:50', 'Successful', ''),
(194, 'Aneesa Hoosain', 'Debit', '$3', '81', '0000-00-00 00:00:00', 'Successful', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `confirm_password` text NOT NULL,
  `name` text NOT NULL,
  `nickname` text NOT NULL,
  `gender` text NOT NULL,
  `bank` text NOT NULL,
  `act_no` text NOT NULL,
  `fone_no` text NOT NULL,
  `code` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `role` text NOT NULL,
  `state` varchar(254) DEFAULT NULL,
  `hash` varchar(32) NOT NULL,
  `account` varchar(256) NOT NULL,
  `currency` varchar(256) NOT NULL,
  `amount` int(10) NOT NULL,
  `dob` varchar(256) NOT NULL,
  `swift_code` varchar(256) NOT NULL,
  `address` text NOT NULL,
  `am_updated` varchar(100) NOT NULL,
  `image` varchar(256) NOT NULL,
  `limit_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `confirm_password`, `name`, `nickname`, `gender`, `bank`, `act_no`, `fone_no`, `code`, `created_at`, `updated_at`, `role`, `state`, `hash`, `account`, `currency`, `amount`, `dob`, `swift_code`, `address`, `am_updated`, `image`, `limit_status`) VALUES
(81, '', 'trustedward@gmail.com', 'Welcome', 'Welcome', 'Aneesa Hoosain', '', 'Male', '', 'LT345543544433', '17273805560', 0, '2023-04-20', '0000-00-00', 'user', 'nl', '093f65e080a295f8076b1c5722a46aa2', 'Checking account', '$', 4611, '2023-04-20', '8477493', '7 Mountclaire street, Sybrand park, Rondebosch 7700 Cape town South Africa', '', 'female.png', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `all_transfers`
--
ALTER TABLE `all_transfers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `blocked`
--
ALTER TABLE `blocked`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gh`
--
ALTER TABLE `gh`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `guider`
--
ALTER TABLE `guider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `int_transfer`
--
ALTER TABLE `int_transfer`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `int_transfers`
--
ALTER TABLE `int_transfers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mavro`
--
ALTER TABLE `mavro`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provide`
--
ALTER TABLE `provide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimony`
--
ALTER TABLE `testimony`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `all_transfers`
--
ALTER TABLE `all_transfers`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blocked`
--
ALTER TABLE `blocked`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `gh`
--
ALTER TABLE `gh`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `int_transfer`
--
ALTER TABLE `int_transfer`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `int_transfers`
--
ALTER TABLE `int_transfers`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT for table `mavro`
--
ALTER TABLE `mavro`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provide`
--
ALTER TABLE `provide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimony`
--
ALTER TABLE `testimony`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

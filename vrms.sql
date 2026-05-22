-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2026 at 05:00 PM
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
-- Database: `vrms`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `bike_name` varchar(50) DEFAULT NULL,
  `bike_rent` int(11) DEFAULT NULL,
  `license` varchar(50) DEFAULT NULL,
  `book_from` date DEFAULT NULL,
  `book_to` date DEFAULT NULL,
  `booking_status` enum('Pending','Approved','Rejected','NA') DEFAULT 'Pending',
  `book_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `document` varchar(256) DEFAULT NULL,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `user_id`, `bike_name`, `bike_rent`, `license`, `book_from`, `book_to`, `booking_status`, `book_time`, `document`, `remark`) VALUES
(1, 9, 'activa', 150, 'ABC123', '2026-04-25', '2026-04-28', 'Approved', '2026-04-23 05:36:14', NULL, NULL),
(2, 9, 'spledor', 200, 'ABC123', '2026-04-25', '2026-04-28', 'Rejected', '2026-04-23 05:36:14', NULL, NULL),
(3, 9, 'spledor', 200, 'ABC123', '2026-04-25', '2026-04-28', 'NA', '2026-04-23 05:36:14', NULL, NULL),
(4, 9, 'activa', 150, 'ABC123', '2026-04-25', '2026-04-28', 'Approved', '2026-04-23 05:36:14', NULL, NULL),
(5, 3, 'spledor', 200, 'USER2GJ', '2026-04-22', '2026-04-24', 'Approved', '2026-04-23 05:36:14', NULL, ''),
(6, 3, 'activa', 150, 'USER2GJ', '2026-04-22', '2026-04-26', 'Approved', '2026-04-23 05:36:14', NULL, NULL),
(7, 9, 'bullet', 300, 'TEST1GJ', '2026-04-23', '2026-05-02', 'Pending', '2026-04-23 05:36:14', NULL, NULL),
(8, 3, 'DIscover', 100, 'TEST1GJ', '2026-04-23', '2026-05-02', 'Approved', '2026-04-23 05:36:14', NULL, 'Your Request is Approved'),
(9, 3, 'spledor', 200, 'TEST1GJ', '2026-04-23', '2026-05-02', 'Approved', '2026-04-23 05:38:36', NULL, 'Your Request is Approved'),
(10, 3, 'bullet', 300, 'TEST1GJ', '2026-04-23', '2026-05-02', 'Approved', '2026-04-23 16:48:23', NULL, NULL),
(11, 8, 'spledor', 200, '95646865865', '2026-04-25', '2026-04-25', 'Rejected', '2026-04-24 16:22:32', NULL, NULL),
(12, 3, 'bullet', 300, 'TEST1GJ', '2026-04-25', '2026-05-02', 'Pending', '2026-04-25 06:57:21', '', NULL),
(13, 3, 'spledor', 200, 'TEST1GJ', '2026-04-25', '2026-05-02', 'Pending', '2026-04-25 07:09:10', '1777100950_ertiga4.jpg', NULL),
(14, 3, 'spledor', 200, 'TEST1GJ', '2026-04-25', '2026-05-02', 'Pending', '2026-04-25 07:33:46', 'Chetan - Vehicle Rental Management System.pdf', NULL),
(15, 3, 'spledor', 200, 'TEST1GJ', '2026-04-25', '2026-05-02', 'Pending', '2026-04-25 07:34:24', '1777102464_pdf', NULL),
(16, 3, 'bullet', 300, 'TEST1GJ', '2026-04-25', '2026-05-02', 'Approved', '2026-04-25 07:35:50', '1777102550_pdf', NULL),
(17, 6, 'spledor', 150, 'USER6', '2026-04-30', '2026-05-02', 'Approved', '2026-04-30 09:43:36', '1777542216_jpg', 'Your Request is Approved'),
(18, 6, 'bullet', 300, 'USER6', '2026-04-30', '2026-05-02', 'Pending', '2026-04-30 09:50:49', '1777542649_jpg', NULL),
(20, 6, 'bullet', 300, 'USER6', '2026-04-30', '2026-05-02', 'Pending', '2026-04-30 10:11:35', '1777543895_jpg', NULL),
(21, 6, 'spledor', 200, 'USER6', '2026-05-03', '2026-05-06', 'Approved', '2026-05-03 10:58:04', '1777805884_png', ''),
(22, 4, 'spledor', 200, 'USER3', '2026-05-03', '2026-05-06', 'Approved', '2026-05-03 11:07:36', '1777806456_png', 'Your Request is approved\r\n'),
(23, 4, 'bullet', 300, 'USER3', '2026-05-03', '2026-05-06', 'Approved', '2026-05-03 11:12:21', '1777806741_png', 'Your request is approved'),
(24, 4, 'bullet', 300, 'USER3', '2026-05-03', '2026-05-06', 'Approved', '2026-05-03 11:15:50', '1777806950_png', ''),
(25, 3, 'bullet', 300, 'USER2GJ', '2026-05-04', '2026-05-07', 'Approved', '2026-05-04 05:38:21', '1777873101_png', ''),
(26, 4, 'Activa', 150, 'USER3', '2026-05-06', '2026-05-13', 'Approved', '2026-05-05 19:17:06', '1778008626_jpg', 'Your request is approved'),
(27, 3, 'splendor', 200, 'USER2GJ', '2026-05-08', '2026-05-13', 'Pending', '2026-05-08 18:08:34', '1778263714_png', NULL),
(28, 3, 'splendor', 200, 'USER2GJ', '2026-05-08', '2026-05-13', 'Pending', '2026-05-08 18:09:54', '1778263794_jpg', NULL),
(29, 12, 'splendor', 200, 'asfkl', '2026-05-15', '2026-05-17', 'Pending', '2026-05-15 09:37:15', '1778837835_png', NULL),
(30, 3, 'splendor', 200, 'asfkl', '2026-05-16', '2026-05-18', 'Pending', '2026-05-15 18:34:31', '', NULL),
(31, 3, 'splendor', 200, '', '2026-05-16', '2026-05-19', 'Pending', '2026-05-15 18:39:53', '', NULL),
(32, 6, 'Shine', 250, 'ABC123', '2026-05-21', '2026-05-22', 'Approved', '2026-05-21 10:21:21', '1779358881_png', 'enjoy your ride'),
(33, 6, 'Access 125', 300, 'ABC123', '2026-05-21', '2026-05-22', 'Pending', '2026-05-21 10:25:52', '1779359152_png', NULL),
(34, 4, 'Pulsar', 250, 'ABC123', '2026-05-21', '2026-05-22', 'Pending', '2026-05-21 10:35:45', '1779359745_png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(50) DEFAULT NULL,
  `country_name` varchar(50) DEFAULT NULL,
  `brand_logo` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand_name`, `country_name`, `brand_logo`) VALUES
(8, 'Hero ', 'india', '1777635831_download.png'),
(38, 'Maruti Suzuki', 'Germany', '1777638349_download (1).png');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `user_type` enum('guest','registered') DEFAULT 'guest',
  `inquiry_type` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `send_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reply_msg` text DEFAULT NULL,
  `reply_time` timestamp NULL DEFAULT NULL,
  `reply_status` enum('pending','resolved') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `user_type`, `inquiry_type`, `message`, `send_at`, `reply_msg`, `reply_time`, `reply_status`) VALUES
(1, 'chetan', 'rathodchetand9413@gmail.com', 'registered', 'booking', 'need to pay any amount for booking like security amount', '2026-05-09 17:55:03', 'yes need to pay 15% amount of total amount', '2026-05-14 10:15:01', 'resolved'),
(2, 'tester', 'test@gmail.com', 'guest', 'Boooking', 'i have issue when try to logged in your system', '2026-05-10 17:45:10', 'you are problem is solved', '2026-05-11 07:42:54', 'resolved'),
(3, 'nirav', 'niravmaru25@gmail.com', 'guest', 'price', 'booking price is to high could you give discount .', '2026-05-11 06:55:18', 'sure we will try to give discount', '2026-05-14 10:17:02', 'resolved'),
(4, 'gueset', 'guest@user.com', 'guest', 'vehicle booking query', 'to book vehicle using your site is difficult', '2026-05-11 09:43:14', 'okay we make it easy', '2026-05-14 10:06:26', 'resolved'),
(5, 'gueset', 'guest@user.com', 'guest', 'vehicle booking query', 'to book vehicle using your site is difficult', '2026-05-11 09:44:09', NULL, NULL, 'pending'),
(6, 'gueset', 'guest@user.com', 'guest', 'vehicle booking query', 'to book vehicle using your site is difficult', '2026-05-11 09:45:19', NULL, NULL, 'pending'),
(7, 'user3', 'user3@gmail.com', 'registered', 'Boooking', 'need some discount on luxurious cars', '2026-05-11 09:47:35', NULL, NULL, 'pending'),
(8, 'chetan', 'rathodchetand9413@gmail.com', 'registered', 'booking', 'When we get vehicle after booking approved', '2026-05-15 17:09:35', NULL, NULL, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `four_wheeler`
--

CREATE TABLE `four_wheeler` (
  `id` int(11) NOT NULL,
  `car_name` varchar(50) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `vehicle_type` enum('auto','manual') DEFAULT NULL,
  `model_year` int(11) DEFAULT NULL,
  `seat_capacity` int(11) DEFAULT NULL,
  `rent` int(11) DEFAULT NULL,
  `num_cars` int(11) DEFAULT NULL,
  `engine_cc` varchar(10) DEFAULT NULL,
  `mileage` int(11) DEFAULT NULL,
  `speed` int(11) DEFAULT NULL,
  `img1` varchar(256) DEFAULT NULL,
  `img2` varchar(256) DEFAULT NULL,
  `img3` varchar(256) DEFAULT NULL,
  `img4` varchar(256) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `fuel_type` enum('petrol','diesel','gas','hybrid','electric') DEFAULT NULL,
  `vehicle_add_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `four_wheeler`
--

INSERT INTO `four_wheeler` (`id`, `car_name`, `brand`, `vehicle_type`, `model_year`, `seat_capacity`, `rent`, `num_cars`, `engine_cc`, `mileage`, `speed`, `img1`, `img2`, `img3`, `img4`, `description`, `fuel_type`, `vehicle_add_time`) VALUES
(4, 'Ertiga', 'Maruti Suzuki', 'manual', 2025, 7, 2500, 3, '1462', 20, 180, '1778737613_ertiga1.png', '1778739503_ertiga02.jpg', '1778739386_ertiga03.jpg', '1778737613_ertiga4.png', 'for long journey, drive is very comfortable', 'gas', '2026-05-05 18:04:07'),
(6, 'Swift Dzire', 'Maruti Suzuki', 'manual', 2024, 5, 2200, 3, '1200', 20, 180, '1778738174_dzire1.png', '1778739899_dzire2.png', '1778738174_dzire3.png', '1778738174_dzire4.png', 'long distance cut in short time ', 'diesel', '2026-05-05 18:18:43'),
(8, 'Tata Punch', 'Tata', 'auto', 2025, 5, 2100, 3, '1200', 23, 160, '1778739190_punch1.png', '1778739190_punch2.png', '1778739190_punch3.png', '1778739190_punch4.png', 'Tata means trust, high quality material used', 'gas', '2026-05-14 06:13:10'),
(9, 'Aura', 'Hyundai', 'manual', 2023, 5, 2300, 3, '1300', 22, 150, '1778740579_aura1.png', '1778740579_aura2.png', '1778740579_aura3.png', '1778740579_aura4.png', 'for family function and for other tour this will best', 'diesel', '2026-05-14 06:36:19'),
(10, 'Scorpio N', 'Mahindra', 'auto', 2024, 7, 5000, 2, '1600', 19, 200, '1778741411_scorpio1.png', '1778741411_scorpio2.png', '1778741411_scorpio3.png', '1778741411_scorpio4.png', 'speed, status and build quality is impressive', 'diesel', '2026-05-14 06:50:11'),
(11, 'Kia Seltos', 'Western Kia', 'auto', 2026, 7, 4500, 3, '1550', 21, 190, '1778742078_kia1.png', '1778742078_kia2.png', '1778742078_kia3.png', '1778742078_kia4.png', 'Luxury car in low budget', 'hybrid', '2026-05-14 07:01:18');

-- --------------------------------------------------------

--
-- Table structure for table `fw_booking`
--

CREATE TABLE `fw_booking` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `car_name` varchar(50) DEFAULT NULL,
  `car_rent` int(11) DEFAULT NULL,
  `license` varchar(50) DEFAULT NULL,
  `book_from` date DEFAULT NULL,
  `book_to` date DEFAULT NULL,
  `document` varchar(256) DEFAULT NULL,
  `booking_status` enum('Pending','Approved','Rejected','NA') DEFAULT 'Pending',
  `book_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fw_booking`
--

INSERT INTO `fw_booking` (`id`, `user_id`, `car_name`, `car_rent`, `license`, `book_from`, `book_to`, `document`, `booking_status`, `book_time`, `remark`) VALUES
(1, 4, 'Ertiga', 2500, 'USER3GJ', '2026-04-28', '2026-04-30', '1777358508_jpg', 'Approved', '2026-04-28 06:41:48', NULL),
(2, 3, 'Ertiga', 2500, 'ABC123', '2026-04-28', '2026-04-30', '1777360217_pdf', 'Approved', '2026-04-28 07:10:17', ''),
(3, 7, 'Ertiga', 2500, 'ABC123', '2026-04-28', '2026-04-30', '1777367904_pdf', 'Approved', '2026-04-28 09:18:24', NULL),
(4, 6, 'Ertiga', 2500, 'USER6', '2026-04-30', '2026-05-02', '1777542341_jpg', 'Pending', '2026-04-30 09:45:41', NULL),
(5, 3, 'Ertiga', 2500, 'USER2GJ', '2026-05-04', '2026-05-07', '1777873779_png', 'Approved', '2026-05-04 05:49:39', ''),
(6, 3, 'Ertiga', 2500, 'USER2GJ', '2026-05-04', '2026-05-07', '1777873825_png', 'Pending', '2026-05-04 05:50:25', NULL),
(7, 10, 'Ertiga', 2500, 'DARSHANGJ', '2026-05-04', '2026-05-05', '1777875333_png', 'Approved', '2026-05-04 06:15:33', 'Enjoy Your RIde'),
(8, 3, 'Ertiga', 2500, 'USER2GJ', '2026-05-08', '2026-05-13', '1778264706_png', 'Pending', '2026-05-08 18:25:06', NULL),
(9, 3, 'Ertiga', 2500, 'fsdalkfjaldk', '2026-05-09', '2026-05-15', '1778307053_png', 'Approved', '2026-05-09 06:10:53', ''),
(10, 12, 'Aura', 2300, 'gj04 20220001234', '2026-05-23', '2026-07-03', '1778828757_png', 'Pending', '2026-05-15 07:05:57', NULL),
(11, 6, 'Kia Seltos', 4500, 'ABC123', '2026-05-21', '2026-05-22', '1779359308_png', 'Pending', '2026-05-21 10:28:28', NULL),
(12, 4, 'Scorpio N', 5000, 'ABC123', '2026-05-21', '2026-05-22', '1779359500_png', 'Pending', '2026-05-21 10:31:40', NULL),
(13, 4, 'Aura', 2300, 'ABC123', '2026-05-21', '2026-05-22', '1779360316_png', 'Pending', '2026-05-21 10:45:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `is_read`, `created_at`) VALUES
(1, 3, 'Your vehicle request for spledor has been Pending!', 1, '2026-05-02 10:29:22'),
(2, 3, 'Your vehicle request for spledor has been Approved!', 1, '2026-05-02 10:31:26'),
(3, 3, 'Your vehicle request for spledor has been Pending!', 1, '2026-05-02 10:43:07'),
(4, 3, 'Your vehicle request for spledor has been Approved!', 1, '2026-05-02 10:49:34'),
(5, 6, 'Your vehicle request for spledor has been Approved!', 1, '2026-05-02 11:21:43'),
(6, 11, 'Request is received for spledor from user3!', 1, '2026-05-03 11:15:50'),
(7, 4, 'Your vehicle request for spledor has been Approved!', 1, '2026-05-03 11:44:55'),
(8, 4, 'Your vehicle request for bullet has been Approved!', 1, '2026-05-03 11:55:07'),
(9, 11, 'Request is received for spledor from user2for\r\n    Date 2026-04-22to2026-04-24', 1, '2026-05-04 05:38:21'),
(10, 11, 'Request is received for Ertiga from user2 for\r\n    Date 2026-04-28 to 2026-04-30', 1, '2026-05-04 05:50:25'),
(11, 11, 'darshan with email id darshan@gmail.com is registered to VRMS', 1, '2026-05-04 06:04:27'),
(12, 11, 'Request is received for Ertiga from darshan for\r\n    Date 2026-05-04 to 2026-05-05', 1, '2026-05-04 06:15:33'),
(13, 10, 'Your vehicle request for Ertiga has been Approved!', 1, '2026-05-04 06:16:38'),
(14, 3, 'Your vehicle request for bullet has been Approved!', 1, '2026-05-04 10:28:14'),
(15, 4, 'Your vehicle request for bullet has been Approved!', 1, '2026-05-05 15:24:45'),
(16, 6, 'Your vehicle request for spledor has been Approved!', 1, '2026-05-05 15:25:40'),
(17, 3, 'Your vehicle request for Ertiga has been Approved!', 1, '2026-05-05 18:26:00'),
(18, 11, 'Request is received for spledor from user3 for\r\n    Date 2026-05-03 to 2026-05-06', 1, '2026-05-05 19:17:06'),
(19, 3, 'Your vehicle request for bullet has been Approved!', 1, '2026-05-06 07:11:42'),
(20, 4, 'Your vehicle request for Activa has been Approved!', 1, '2026-05-06 07:47:56'),
(21, 11, 'chetan with email id rathodchetand9413@gmail.com is registered to VRMS', 1, '2026-05-08 09:23:03'),
(22, 11, 'Request is received for spledor from user2 for\r\n    Date 2026-04-22 to 2026-04-24', 1, '2026-05-08 18:08:34'),
(23, 11, 'Request is received for spledor from user2 for\r\n    Date 2026-04-22 to 2026-04-24', 1, '2026-05-08 18:09:54'),
(24, 11, 'Request is received for Ertiga from user2 for\r\n    Date 2026-04-28 to 2026-04-30', 1, '2026-05-08 18:25:06'),
(25, 11, 'Request is received for Ertiga from user2 for\r\n    Date 2026-04-28 to 2026-04-30', 1, '2026-05-09 06:10:53'),
(26, 11, 'gueset whose email id is guest@user.com send query ', 1, '2026-05-11 09:45:20'),
(27, 11, ' whose email id is  send query ', 1, '2026-05-11 09:46:12'),
(28, 11, 'user3 whose email id is user3@gmail.com send query ', 1, '2026-05-11 09:47:37'),
(29, 3, 'Your vehicle request for Ertiga has been Approved!', 1, '2026-05-15 05:50:13'),
(30, 11, 'splendor with email id user0@gmail.com is registered to VRMS', 1, '2026-05-15 06:42:20'),
(31, 11, 'Request is received for Aura from splendor for\r\n    Date 2026-05-23 to 2026-07-03', 1, '2026-05-15 07:05:57'),
(32, 11, 'Request is received for splendor from splendor for\r\n    Date 2026-05-15 to 2026-05-17', 1, '2026-05-15 09:37:15'),
(33, 11, ' with email id  is registered to VRMS', 1, '2026-05-15 12:37:08'),
(34, 11, 'abc with email id afds@gmail.com is registered to VRMS', 1, '2026-05-15 12:53:57'),
(35, 11, 'chetan whose email id is rathodchetand9413@gmail.com send query ', 1, '2026-05-15 17:09:35'),
(36, 11, ' whose email id is rathodchetand9413@gmail.com send query ', 1, '2026-05-15 17:11:29'),
(37, 11, ' whose email id is rathodchetand9413@gmail.com send query ', 1, '2026-05-15 17:18:20'),
(38, 11, 'chetan whose email id is  send query ', 1, '2026-05-15 17:20:21'),
(39, 11, 'chetan whose email id is  send query ', 1, '2026-05-15 17:26:44'),
(40, 11, 'chetan whose email id is  send query ', 1, '2026-05-15 17:27:39'),
(41, 11, 'chetan whose email id is  send query ', 1, '2026-05-15 17:33:27'),
(42, 11, 'chetan whose email id is  send query ', 1, '2026-05-15 17:42:45'),
(43, 11, 'chetan whose email id is  send query ', 1, '2026-05-15 17:44:22'),
(44, 11, 'chetan whose email id is  send query ', 1, '2026-05-15 17:48:19'),
(45, 11, 'Request is received for spledor from user2 for\r\n    Date 2026-04-22 to 2026-04-24', 1, '2026-05-15 18:34:31'),
(46, 11, 'Request is received for spledor from user2 for\r\n    Date 2026-04-22 to 2026-04-24', 1, '2026-05-15 18:39:53'),
(47, 11, 'Request is received for spledor from user6 for\r\n    Date 2026-04-30 to 2026-05-02', 1, '2026-05-21 10:21:21'),
(48, 6, 'Your vehicle request for Shine has been Approved!', 1, '2026-05-21 10:22:06'),
(49, 11, 'Request is received for spledor from user6 for\r\n    Date 2026-04-30 to 2026-05-02', 1, '2026-05-21 10:25:52'),
(50, 11, 'Request is received for Ertiga from user6 for\r\n    Date 2026-04-30 to 2026-05-02', 1, '2026-05-21 10:28:28'),
(51, 11, 'Request is received for Ertiga from user3 for\r\n    Date 2026-04-28 to 2026-04-30', 1, '2026-05-21 10:31:40'),
(52, 11, 'Request is received for Pulsar from user3 for Date 2026-05-21 to 2026-05-22', 1, '2026-05-21 10:35:45'),
(53, 11, 'Request is received for Aura from user3 for\r\n    Date 2026-05-21 to 2026-05-22', 1, '2026-05-21 10:45:16');

-- --------------------------------------------------------

--
-- Table structure for table `two_wheeler`
--

CREATE TABLE `two_wheeler` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `vehicle_type` enum('gearless','geared') DEFAULT NULL,
  `model_year` int(11) DEFAULT NULL,
  `seat_capacity` int(11) DEFAULT NULL,
  `rent` int(11) DEFAULT NULL,
  `num_bikes` int(11) DEFAULT NULL,
  `engine_cc` varchar(10) DEFAULT NULL,
  `mileage` int(11) DEFAULT NULL,
  `speed` int(11) DEFAULT NULL,
  `img1` varchar(256) DEFAULT NULL,
  `img2` varchar(256) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `fuel_type` enum('petrol','diesel','gas','electric') DEFAULT NULL,
  `vehicle_add_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `two_wheeler`
--

INSERT INTO `two_wheeler` (`id`, `name`, `brand`, `vehicle_type`, `model_year`, `seat_capacity`, `rent`, `num_bikes`, `engine_cc`, `mileage`, `speed`, `img1`, `img2`, `description`, `fuel_type`, `vehicle_add_time`) VALUES
(21, 'splendor', 'Hero', 'geared', 2026, 2, 200, 5, '100', 70, 90, '1778733151_splendor1.png', '1778733151_splendor02.png', 'it is first choice of indian middle class people', 'petrol', '2026-05-05 14:56:39'),
(22, 'Activa', 'Honda', 'gearless', 2026, 2, 150, 5, '100', 40, 90, '1778733509_activa02.png', '1778692666_activa2.png', 'comfort bike', 'petrol', '2026-05-05 18:11:24'),
(23, 'Bullet', 'Royal Enfield', 'geared', 2025, 2, 400, 3, '350', 30, 180, '1778689819_bullet-350.png', '1778689819_RE-Bullet-silver-1.png', 'Royal ride for royal users', 'petrol', '2026-05-13 16:30:19'),
(24, 'Shine', 'Honda', 'geared', 2025, 2, 250, 5, '125', 55, 135, '1778733787_shine1.png', '1778733787_shine2.png', 'For long root it will be best', 'petrol', '2026-05-14 04:43:07'),
(25, 'Access 125', 'Suzuki', 'gearless', 2025, 2, 300, 3, '125', 40, 120, '1778734075_access1.png', '1778734075_access2.png', 'The boot space is huge so you can put your accessories', 'petrol', '2026-05-14 04:47:55'),
(26, 'Pulsar', 'Bajaj', 'geared', 2024, 2, 250, 3, '125', 50, 140, '1778735486_pulsar1.png', '1778735486_pulsar2.png', 'sporty look and high speed', 'petrol', '2026-05-14 05:11:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `token` varchar(256) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `password`, `role`, `created_at`, `token`, `token_expiry`) VALUES
(1, 'admin', 'admin@vrms.com', '01212121212', '$2y$10$UFs37u0L0avepyeqs/7Q/eoE/dpTPdlNCZz6AiPZqjdRAOVXKfAcS', 'user', '2026-04-09 04:27:06', '46121911a22f748938b7200de30458a50d94ec25222f94a16de3708fe9cde648', '2026-05-15 12:24:11'),
(2, 'user', 'user@gmail.com', '03333333333', '$2y$10$.gvz4aU24jSr9PPm5MbId.7WvJ8dycytEb6FT7o3RrIM8Y6WK8Pn.', 'user', '2026-04-09 04:31:03', NULL, NULL),
(3, 'rambhai', 'user2@gmail.com', '1234567898', '$2y$10$BhzXBZgElPZ2hjiaoLKddufWEXbfXyXsaLpfbBqg7VbbGsRSg4SaG', 'user', '2026-04-09 06:13:02', 'aa42d4b90915bc161d271d85621bd81fef78e1114a837d0fb2b42a641bd3c82b', '2026-05-15 12:23:26'),
(4, 'user3', 'user3@gmail.com', '123456789', '$2y$10$UJU.Vcykfls.XT.sxa52he2x0QdpMx0OQmou8.NfxiKWoFwEXOGBC', 'user', '2026-04-11 11:39:33', NULL, NULL),
(5, 'user1', 'chetanratod@gmail.com', '01212121212', '$2y$10$ANoM22i23OzAsvz0qVH/ne.wULLYcaTNZOk6gAJ4oEqH4oBbQiGfy', 'user', '2026-04-11 11:44:51', NULL, NULL),
(6, 'user6', 'user6@gmail.com', '01234567890', '$2y$10$5C8kuei1fUT68xBpaDrb6.v39fud6g9XumgFNdvLzBXyZpVACaveO', 'user', '2026-04-11 11:46:02', NULL, NULL),
(7, 'use7', 'user7@gmail.com', '01212121212', '', 'user', '2026-04-11 11:51:13', NULL, NULL),
(8, 'Sanjay Rathod', 'rahtodsanjay160@gmail.com', '9512131803', '$2y$10$nT7B9uH6.YMSnJRpLrcRkOhgVNWS6GPISwzANy2bODGdaVku3BHH2', 'user', '2026-04-12 06:22:26', NULL, NULL),
(9, 'test1', 'test1@gmail.com', '03333333333', '$2y$10$hESpnaE./RfSs3CxE9l.suWUVuNUFJ1tdPfsu.MqlWF2cUEzYnBb.', 'user', '2026-04-22 10:15:15', NULL, NULL),
(10, 'darshan', 'darshan@gmail.com', '1234567890', '$2y$10$Xyf1EW/8FgDyVhScfM00YerAjA74JJg5csV3OmvpckqHbyk9y7mL.', 'user', '2026-05-04 06:04:27', 'e0625cb2eee971e1627b81edae7f40f0a1df6b469b3f3e44f4e8fd113f81e75a', '2026-05-08 15:01:10'),
(11, 'chetan', 'rathodchetand9413@gmail.com', '7778028585', '$2y$10$4ILcj/7DHIb1nLBy2/W8aOEgndCoGc77Q85Fltha/UNka3Och8VnG', 'admin', '2026-05-08 09:23:00', NULL, NULL),
(12, 'splendor', 'user0@gmail.com', '1234567890', '$2y$10$1aBqhYBtVCKSwJvY7EJbLOpHaNfkwnkqQZ9kfUislniq2ts0grP3O', 'user', '2026-05-15 06:42:20', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `four_wheeler`
--
ALTER TABLE `four_wheeler`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fw_booking`
--
ALTER TABLE `fw_booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `two_wheeler`
--
ALTER TABLE `two_wheeler`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `four_wheeler`
--
ALTER TABLE `four_wheeler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `fw_booking`
--
ALTER TABLE `fw_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `two_wheeler`
--
ALTER TABLE `two_wheeler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `fw_booking`
--
ALTER TABLE `fw_booking`
  ADD CONSTRAINT `fw_booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

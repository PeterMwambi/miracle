-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2023 at 06:21 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dope_spa`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_account_info`
--

CREATE TABLE `admin_account_info` (
  `id` int(11) NOT NULL,
  `ad_id` varchar(30) NOT NULL,
  `ad_username` varchar(30) NOT NULL,
  `ad_password` varchar(100) NOT NULL,
  `ad_date_created` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`ad_date_created`)),
  `ad_last_login` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`ad_last_login`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_account_info`
--

INSERT INTO `admin_account_info` (`id`, `ad_id`, `ad_username`, `ad_password`, `ad_date_created`, `ad_last_login`) VALUES
(1, 'TPAD6433FE30DFF', 'lamar', '$2y$10$mkKYyvqT552Lkkv0xwqyg.WuXzZs/P8rAvI2ZCdC5Vw.XT2NEydBC', '{\"day\":\"Monday\",\"date\":\"10\\/04\\/2023\",\"time\":\"3:16PM\"}', '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"7:15PM\"}'),
(2, 'TPAD64341A0373E', 'eugy', '$2y$10$XO9o3cBvEF/N2m9XA.aa7.0NnDYFiEsMCeGh7DSQN5pKsFqH3JkHK', '{\"day\":\"Monday\",\"date\":\"10\\/04\\/2023\",\"time\":\"5:15PM\"}', '{\"day\":\"Monday\",\"date\":\"10\\/04\\/2023\",\"time\":\"5:15PM\"}');

-- --------------------------------------------------------

--
-- Table structure for table `admin_personal_info`
--

CREATE TABLE `admin_personal_info` (
  `id` int(11) NOT NULL,
  `ad_id` varchar(30) NOT NULL,
  `ad_firstname` varchar(30) NOT NULL,
  `ad_lastname` varchar(30) NOT NULL,
  `ad_gender` varchar(30) NOT NULL,
  `ad_date_of_birth` varchar(30) NOT NULL,
  `ad_age` int(8) NOT NULL,
  `ad_nationality` varchar(30) NOT NULL,
  `ad_national_id` int(11) NOT NULL,
  `ad_phone_number` varchar(20) NOT NULL,
  `ad_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_personal_info`
--

INSERT INTO `admin_personal_info` (`id`, `ad_id`, `ad_firstname`, `ad_lastname`, `ad_gender`, `ad_date_of_birth`, `ad_age`, `ad_nationality`, `ad_national_id`, `ad_phone_number`, `ad_email`) VALUES
(1, 'TPAD6433FE30DFF', 'Justin', 'Onyancha', 'Male', '12/02/1999', 22, 'Kenyan', 37223467, '+254726564701', 'justinonyancha@gmail.com'),
(2, 'TPAD64341A0373E', 'Eugy', 'Ngugi', 'Male', '01/02/1996', 27, 'Kenyan', 38957122, '+254758954864', 'eugy@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `attendant_account_info`
--

CREATE TABLE `attendant_account_info` (
  `id` int(11) NOT NULL,
  `at_id` varchar(30) NOT NULL,
  `at_username` varchar(30) NOT NULL,
  `at_password` varchar(100) NOT NULL,
  `at_ratings` int(8) NOT NULL,
  `at_reviews` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`at_reviews`)),
  `at_date_created` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`at_date_created`)),
  `at_last_login` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`at_last_login`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendant_account_info`
--

INSERT INTO `attendant_account_info` (`id`, `at_id`, `at_username`, `at_password`, `at_ratings`, `at_reviews`, `at_date_created`, `at_last_login`) VALUES
(1, 'DPAT6434510B15E', 'jnjuguna254', '$2y$10$CEAb8lZKRxdJ89p0MiFkVOfHONCGMeJf5tXnmAs3YxWG121QtyWSS', 2, '[]', '{\"day\":\"Monday\",\"date\":\"10\\/04\\/2023\",\"time\":\"9:10PM\"}', '{\"day\":\"Monday\",\"date\":\"10\\/04\\/2023\",\"time\":\"9:10PM\"}'),
(3, 'DPAT643452B0D1D', 'alicenjeri', '$2y$10$AjZCC6Pzcx7bdPaNnySus.oEkBDW.FjHj5XypLehMSKui/03ejgjG', 2, '[]', '{\"day\":\"Monday\",\"date\":\"10\\/04\\/2023\",\"time\":\"9:17PM\"}', '{\"day\":\"Monday\",\"date\":\"10\\/04\\/2023\",\"time\":\"9:17PM\"}'),
(4, 'DPAT6434A6BD4D9', 'joycelynn', '$2y$10$G.IQgXKsw9I/5DScv8SAk.v5u6VFOpOB9nzEonBnQmWctbR0Ej/Dm', 2, '[]', '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"3:15AM\"}', '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"3:15AM\"}'),
(5, 'DPAT64357A456F741', 'john', '$2y$10$tONGxi4RCAAmffUorG066OQdn8rUTlEmyarbmYY3m/7Os4omhDoLC', 2, '[]', '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"6:18PM\"}', '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"6:18PM\"}');

-- --------------------------------------------------------

--
-- Table structure for table `attendant_personal_info`
--

CREATE TABLE `attendant_personal_info` (
  `id` int(11) NOT NULL,
  `at_id` varchar(30) NOT NULL,
  `at_firstname` varchar(20) NOT NULL,
  `at_lastname` varchar(30) NOT NULL,
  `at_gender` varchar(20) NOT NULL,
  `at_date_of_birth` varchar(20) NOT NULL,
  `at_age` int(8) NOT NULL,
  `at_nationality` varchar(30) NOT NULL,
  `at_national_id` int(11) NOT NULL,
  `at_phone_number` varchar(20) NOT NULL,
  `at_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendant_personal_info`
--

INSERT INTO `attendant_personal_info` (`id`, `at_id`, `at_firstname`, `at_lastname`, `at_gender`, `at_date_of_birth`, `at_age`, `at_nationality`, `at_national_id`, `at_phone_number`, `at_email`) VALUES
(3, 'DPAT6434510B15E', 'Joeseph', 'Njuguna', 'Male', '12/02/1997', 26, 'Kenyan', 37365477, '+254723233417', 'jnjugush@gmail.com'),
(5, 'DPAT643452B0D1D', 'Alice', 'Njeri', 'Female', '12/12/2000', 22, 'Kenyan', 37565237, '+254723454577', 'anjeri@gmail.com'),
(6, 'DPAT6434A6BD4D9', 'Joyce', 'Lynn', 'Female', '12/03/1997', 25, 'Kenyan', 37656477, '+254721775377', 'jlynn254@gmail.com'),
(7, 'DPAT64357A456F741', 'John', 'Kmau', 'Male', '12/08/1980', 42, 'Kenyan', 10067340, '+254724567090', 'john@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `bk_id` varchar(30) NOT NULL,
  `cl_id` varchar(30) NOT NULL,
  `s_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `bk_id`, `cl_id`, `s_id`) VALUES
(13, 'DPCL64356118713A2', 'TPST643455F0889', 'DPAD64347A4D891'),
(14, 'DPCL64356B33C617B', 'DPCL64356AF86FF19', 'DPS643568B33D40D'),
(15, 'DPCL64357081E6356', 'DPCL64357025ACED7', 'DPAD64347A4D891'),
(16, 'DPCL64357971AD0D3', 'DPCL643579222EA2F', 'DPAD6434A2B9D51'),
(17, 'DPCL6435859BD37E4', 'DPCL643579222EA2F', 'DPS643568B33D40D'),
(18, 'DPCL643586F3E9FAB', 'DPCL643579222EA2F', 'DPAD6434A2B9D51');

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `id` int(11) NOT NULL,
  `bk_id` varchar(30) NOT NULL,
  `bkd_expected_checkin_date` varchar(30) NOT NULL,
  `bkd_status` varchar(30) NOT NULL,
  `bkd_checkin_date` varchar(30) NOT NULL,
  `bkd_date_created` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`bkd_date_created`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`id`, `bk_id`, `bkd_expected_checkin_date`, `bkd_status`, `bkd_checkin_date`, `bkd_date_created`) VALUES
(6, 'DPCL64356118713A2', 'Wednesday, 12/04/2023 7:30PM', 'complete', 'Tuesday, 11/04/2023 4:31PM', '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"4:31PM\"}'),
(7, 'DPCL64356B33C617B', 'Wednesday, 12/04/2023 10:30AM', 'complete', 'Tuesday, 11/04/2023 5:14PM', '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"5:14PM\"}'),
(8, 'DPCL64357081E6356', 'Wednesday, 12/04/2023 2:00PM', 'complete', 'Tuesday, 11/04/2023 5:37PM', '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"5:36PM\"}'),
(9, 'DPCL64357971AD0D3', 'Wednesday, 12/04/2023 12:00PM', 'complete', 'Tuesday, 11/04/2023 7:05PM', '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"6:14PM\"}'),
(10, 'DPCL6435859BD37E4', 'Thursday, 20/04/2023 12:30PM', 'complete', 'Tuesday, 11/04/2023 7:08PM', '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"7:06PM\"}'),
(11, 'DPCL643586F3E9FAB', 'Monday, 17/04/2023 12:00PM', 'complete', 'Tuesday, 11/04/2023 7:14PM', '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"7:12PM\"}');

-- --------------------------------------------------------

--
-- Table structure for table `client_account_info`
--

CREATE TABLE `client_account_info` (
  `id` int(11) NOT NULL,
  `cl_id` varchar(30) NOT NULL,
  `cl_username` varchar(30) NOT NULL,
  `cl_password` varchar(100) NOT NULL,
  `cl_date_created` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`cl_date_created`)),
  `cl_last_login` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`cl_last_login`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client_account_info`
--

INSERT INTO `client_account_info` (`id`, `cl_id`, `cl_username`, `cl_password`, `cl_date_created`, `cl_last_login`) VALUES
(1, 'TPST643455F0889', 'bmwaura', '$2y$10$eeq0zZ1nDSREX85hHWYrx.SYLXTVL5JOrwenZk2JV9GZXgNdMKVI6', '{\"day\":\"Monday\",\"date\":\"10\\/04\\/2023\",\"time\":\"9:31PM\"}', '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"4:21PM\"}'),
(2, 'DPCL64356AF86FF19', 'mwairimu', '$2y$10$FfKJNhIyei6Dmo5BYRGaR..hXr7RbrRUJZtwAySyf70KjVXtrSVgS', '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"5:13PM\"}', '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"5:13PM\"}'),
(3, 'DPCL64357025ACED7', 'Justin', '$2y$10$KcuavqqRm.NwmkaVaTcXauj3bzBW7SK.MnmhlpxkhOeLTOfTGz/y6', '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"5:35PM\"}', '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"5:35PM\"}'),
(4, 'DPCL643579222EA2F', 'moses', '$2y$10$Dpo9Iahw8UgJ4EJu.PvFGurWxqSW1ipMQI/EDbO.CqyMRoZRS6Co.', '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"6:13PM\"}', '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"6:13PM\"}');

-- --------------------------------------------------------

--
-- Table structure for table `client_personal_info`
--

CREATE TABLE `client_personal_info` (
  `id` int(11) NOT NULL,
  `cl_id` varchar(30) NOT NULL,
  `cl_firstname` varchar(30) NOT NULL,
  `cl_lastname` varchar(30) NOT NULL,
  `cl_gender` varchar(30) NOT NULL,
  `cl_date_of_birth` varchar(30) NOT NULL,
  `cl_age` int(8) NOT NULL,
  `cl_nationality` varchar(30) NOT NULL,
  `cl_national_id` int(11) NOT NULL,
  `cl_phone_number` varchar(20) NOT NULL,
  `cl_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client_personal_info`
--

INSERT INTO `client_personal_info` (`id`, `cl_id`, `cl_firstname`, `cl_lastname`, `cl_gender`, `cl_date_of_birth`, `cl_age`, `cl_nationality`, `cl_national_id`, `cl_phone_number`, `cl_email`) VALUES
(1, 'TPST643455F0889', 'Brian', 'Mwaura', 'Male', '12/11/2002', 23, 'Kenyan', 38565565, '+254738456377', 'mwaurabrian@gmail.com'),
(2, 'DPCL64356AF86FF19', 'Mercy', 'Wairimu', 'Female', '12/02/2000', 22, 'Kenyan', 37998575, '+254721227345', 'mwairimu@gmail.com'),
(3, 'DPCL64357025ACED7', 'Justin', 'Lamar', 'Male', '24/05/2001', 20, 'Kenyan', 39876901, '+254723551973', 'jlamar@gmail.com'),
(4, 'DPCL643579222EA2F', 'Moses', 'Mwangi', 'Male', '10/04/1999', 23, 'Kenyan', 36754792, '+254700023412', 'moses@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `d_id` varchar(30) NOT NULL COMMENT 'Discount id',
  `cl_id` varchar(30) NOT NULL,
  `d_amount` int(15) NOT NULL,
  `d_status` varchar(15) NOT NULL,
  `d_date_created` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`d_date_created`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `d_id`, `cl_id`, `d_amount`, `d_status`, `d_date_created`) VALUES
(5, 'DPD6435612ECFDAA', 'TPST643455F0889', 8, 'verified', '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"4:31PM\"}'),
(6, 'DPD64356B556D7FC', 'DPCL64356AF86FF19', 25, 'verified', '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"5:14PM\"}'),
(7, 'DPD643570B6106D1', 'DPCL64357025ACED7', 8, 'verified', '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"5:37PM\"}'),
(8, 'DPD64357AE4690FC', 'DPCL643579222EA2F', 50, 'verified', '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"6:21PM\"}');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `pm_id` varchar(30) NOT NULL,
  `cl_id` varchar(30) NOT NULL,
  `at_id` varchar(30) NOT NULL,
  `bk_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `pm_id`, `cl_id`, `at_id`, `bk_id`) VALUES
(6, 'DPCL6435612ECC12E', 'TPST643455F0889', 'DPAT643452B0D1D', 'DPCL64356118713A2'),
(7, 'DPCL64356B5569A1A', 'DPCL64356AF86FF19', 'DPAT6434A6BD4D9', 'DPCL64356B33C617B'),
(8, 'DPCL643570B5DD0E0', 'DPCL64357025ACED7', 'DPAT643452B0D1D', 'DPCL64357081E6356'),
(9, 'DPCL64357AE464FB1', 'DPCL643579222EA2F', 'DPAT643452B0D1D', 'DPCL64357971AD0D3'),
(10, 'DPCL64358542B32C8', 'DPCL643579222EA2F', 'DPAT643452B0D1D', 'DPCL64357971AD0D3'),
(11, 'DPCL64358600C7FA7', 'DPCL643579222EA2F', 'DPAT6434A6BD4D9', 'DPCL6435859BD37E4'),
(12, 'DPCL643587498EB56', 'DPCL643579222EA2F', 'DPAT643452B0D1D', 'DPCL643586F3E9FAB');

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `id` int(11) NOT NULL,
  `pm_id` varchar(30) NOT NULL,
  `pmd_amount` int(30) NOT NULL,
  `pmd_balance` int(11) NOT NULL,
  `pmd_mode` varchar(30) NOT NULL,
  `pmd_transaction_code` varchar(30) NOT NULL,
  `pmd_status` varchar(30) NOT NULL,
  `pmd_discount` int(11) NOT NULL,
  `pmd_date_added` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`pmd_date_added`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`id`, `pm_id`, `pmd_amount`, `pmd_balance`, `pmd_mode`, `pmd_transaction_code`, `pmd_status`, `pmd_discount`, `pmd_date_added`) VALUES
(5, 'DPCL6435612ECC12E', 500, -8, 'Mpesa', 'QC45678RBA', 'verified', 8, '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"4:31PM\"}'),
(6, 'DPCL64356B5569A1A', 1500, -25, 'Mpesa', 'QC45678RDF', 'verified', 25, '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"5:14PM\"}'),
(7, 'DPCL643570B5DD0E0', 500, -8, 'Mpesa', 'QWERTY0617', 'verified', 8, '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"5:37PM\"}'),
(8, 'DPCL64357AE464FB1', 3000, -50, 'Mpesa', 'QWAD2096Y1', 'verified', 50, '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"6:21PM\"}'),
(9, 'DPCL64358542B32C8', 2900, 100, 'Mpesa', 'QC45678RZA', 'pending', 0, '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"7:05PM\"}'),
(10, 'DPCL64358600C7FA7', 1450, 0, 'Mpesa', 'QC45678RBG', 'verified', 0, '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"7:08PM\"}'),
(11, 'DPCL643587498EB56', 2950, 0, 'Mpesa', 'QW56789068', 'verified', 0, '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"7:14PM\"}');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `s_id` varchar(30) NOT NULL,
  `at_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `s_id`, `at_id`) VALUES
(8, 'DPS6435886581230', 'DPAT6434510B15E'),
(4, 'DPAD64347A4D891', 'DPAT643452B0D1D'),
(6, 'DPAD6434A2B9D51', 'DPAT643452B0D1D'),
(7, 'DPS643568B33D40D', 'DPAT6434A6BD4D9');

-- --------------------------------------------------------

--
-- Table structure for table `service_details`
--

CREATE TABLE `service_details` (
  `id` int(11) NOT NULL,
  `s_id` varchar(30) NOT NULL,
  `sd_name` varchar(100) NOT NULL,
  `sd_description` varchar(300) NOT NULL,
  `sd_image` varchar(100) NOT NULL,
  `sd_date_created` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`sd_date_created`)),
  `sd_price` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_details`
--

INSERT INTO `service_details` (`id`, `s_id`, `sd_name`, `sd_description`, `sd_image`, `sd_date_created`, `sd_price`) VALUES
(4, 'DPAD64347A4D891', 'Hair trimming', 'Get yourself a classy haircut', 'barber-gcfffb4083_1280.jpg', '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"12:06AM\"}', 500),
(6, 'DPAD6434A2B9D51', 'Full body massage', 'Consist of deep tissue massage and full body oil treatment. Helps in releasing tension, anxiety and acts as a stress reliever', 'massage-therapy-g686854149_1280.jpg', '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"2:58AM\"}', 3000),
(7, 'DPS643568B33D40D', 'Hair retouch', 'Get your hair toned and retouched to keep it black long and curly. We offer you full hair retouch services', 'hairdresser-geaf21cb5e_1280.jpg', '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"5:03PM\"}', 1500),
(8, 'DPS6435886581230', 'Facial scrubbing', 'We use treatments to adminster the best facial scrubbing services', 'woman-g6696b4455_1280.jpg', '{\"day\":\"Tuesday\",\"date\":\"11\\/04\\/2023\",\"time\":\"7:18PM\"}', 1500);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_account_info`
--
ALTER TABLE `admin_account_info`
  ADD PRIMARY KEY (`id`,`ad_id`),
  ADD UNIQUE KEY `ad_id` (`ad_id`),
  ADD UNIQUE KEY `ad_username` (`ad_username`);

--
-- Indexes for table `admin_personal_info`
--
ALTER TABLE `admin_personal_info`
  ADD PRIMARY KEY (`id`,`ad_id`),
  ADD UNIQUE KEY `ad_id` (`ad_id`),
  ADD UNIQUE KEY `ad_email` (`ad_email`),
  ADD UNIQUE KEY `ad_national_id` (`ad_national_id`),
  ADD UNIQUE KEY `ad_phone_number` (`ad_phone_number`),
  ADD UNIQUE KEY `ad_id_2` (`ad_id`);

--
-- Indexes for table `attendant_account_info`
--
ALTER TABLE `attendant_account_info`
  ADD PRIMARY KEY (`id`,`at_id`),
  ADD UNIQUE KEY `at_id` (`at_id`),
  ADD UNIQUE KEY `at_username` (`at_username`);

--
-- Indexes for table `attendant_personal_info`
--
ALTER TABLE `attendant_personal_info`
  ADD PRIMARY KEY (`id`,`at_id`),
  ADD UNIQUE KEY `at_id` (`at_id`),
  ADD UNIQUE KEY `at_national_id` (`at_national_id`),
  ADD UNIQUE KEY `at_phone_number` (`at_phone_number`),
  ADD UNIQUE KEY `at_email` (`at_email`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`,`bk_id`),
  ADD UNIQUE KEY `bk_id` (`bk_id`),
  ADD KEY `cl_id` (`cl_id`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`id`,`bk_id`),
  ADD UNIQUE KEY `bk_id` (`bk_id`);

--
-- Indexes for table `client_account_info`
--
ALTER TABLE `client_account_info`
  ADD PRIMARY KEY (`id`,`cl_id`),
  ADD UNIQUE KEY `cl_id` (`cl_id`),
  ADD UNIQUE KEY `cl_username` (`cl_username`);

--
-- Indexes for table `client_personal_info`
--
ALTER TABLE `client_personal_info`
  ADD PRIMARY KEY (`id`,`cl_id`),
  ADD UNIQUE KEY `cl_id` (`cl_id`),
  ADD UNIQUE KEY `cl_phone_number` (`cl_phone_number`),
  ADD UNIQUE KEY `cl_email` (`cl_email`),
  ADD UNIQUE KEY `cl_national_id` (`cl_national_id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`,`d_id`),
  ADD UNIQUE KEY `d_id` (`d_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`,`pm_id`),
  ADD UNIQUE KEY `pm_id` (`pm_id`),
  ADD KEY `cl_id` (`cl_id`),
  ADD KEY `at_id` (`at_id`),
  ADD KEY `bk_id` (`bk_id`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`id`,`pm_id`),
  ADD UNIQUE KEY `pm_id` (`pm_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`,`s_id`),
  ADD UNIQUE KEY `s_id` (`s_id`),
  ADD KEY `at_id` (`at_id`);

--
-- Indexes for table `service_details`
--
ALTER TABLE `service_details`
  ADD PRIMARY KEY (`id`,`s_id`),
  ADD UNIQUE KEY `s_id` (`s_id`),
  ADD UNIQUE KEY `sd_name` (`sd_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_account_info`
--
ALTER TABLE `admin_account_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_personal_info`
--
ALTER TABLE `admin_personal_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attendant_account_info`
--
ALTER TABLE `attendant_account_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `attendant_personal_info`
--
ALTER TABLE `attendant_personal_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `client_account_info`
--
ALTER TABLE `client_account_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `client_personal_info`
--
ALTER TABLE `client_personal_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `service_details`
--
ALTER TABLE `service_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_account_info`
--
ALTER TABLE `admin_account_info`
  ADD CONSTRAINT `admin_account_info_ibfk_1` FOREIGN KEY (`ad_id`) REFERENCES `admin_personal_info` (`ad_id`);

--
-- Constraints for table `attendant_account_info`
--
ALTER TABLE `attendant_account_info`
  ADD CONSTRAINT `attendant_account_info_ibfk_1` FOREIGN KEY (`at_id`) REFERENCES `attendant_personal_info` (`at_id`);

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`cl_id`) REFERENCES `client_personal_info` (`cl_id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`s_id`) REFERENCES `services` (`s_id`);

--
-- Constraints for table `client_account_info`
--
ALTER TABLE `client_account_info`
  ADD CONSTRAINT `client_account_info_ibfk_1` FOREIGN KEY (`cl_id`) REFERENCES `client_personal_info` (`cl_id`);

--
-- Constraints for table `discounts`
--
ALTER TABLE `discounts`
  ADD CONSTRAINT `discounts_ibfk_1` FOREIGN KEY (`cl_id`) REFERENCES `client_personal_info` (`cl_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`cl_id`) REFERENCES `client_personal_info` (`cl_id`),
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`at_id`) REFERENCES `attendant_personal_info` (`at_id`),
  ADD CONSTRAINT `payments_ibfk_3` FOREIGN KEY (`bk_id`) REFERENCES `bookings` (`bk_id`);

--
-- Constraints for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD CONSTRAINT `payment_details_ibfk_1` FOREIGN KEY (`pm_id`) REFERENCES `payments` (`pm_id`);

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`at_id`) REFERENCES `attendant_personal_info` (`at_id`);

--
-- Constraints for table `service_details`
--
ALTER TABLE `service_details`
  ADD CONSTRAINT `service_details_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `services` (`s_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

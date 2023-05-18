-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2023 at 10:23 PM
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
-- Database: `tutors_point`
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

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `cl_id` varchar(30) NOT NULL,
  `c_id` varchar(30) NOT NULL,
  `cn_id` varchar(30) NOT NULL,
  `t_id` varchar(30) NOT NULL,
  `cl_students` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`cl_students`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `c_id` varchar(30) NOT NULL,
  `ct_id` varchar(30) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_tutors` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`c_tutors`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_category`
--

CREATE TABLE `course_category` (
  `id` int(11) NOT NULL,
  `ct_id` varchar(30) NOT NULL,
  `ct_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_content`
--

CREATE TABLE `course_content` (
  `id` int(11) NOT NULL,
  `cn_id` varchar(30) NOT NULL,
  `c_id` varchar(30) NOT NULL,
  `t_id` varchar(30) NOT NULL,
  `cn_outline` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`cn_outline`)),
  `cn_description` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `online_classes`
--

CREATE TABLE `online_classes` (
  `id` int(11) NOT NULL,
  `clo_id` varchar(30) NOT NULL,
  `cl_id` varchar(30) NOT NULL,
  `clo_link` varchar(400) NOT NULL,
  `clo_date_created` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`clo_date_created`)),
  `clo_status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `pm_id` varchar(30) NOT NULL,
  `t_id` varchar(30) NOT NULL,
  `st_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `id` int(11) NOT NULL,
  `pm_id` varchar(30) NOT NULL,
  `pmd_amount` int(30) NOT NULL,
  `pmd_status` varchar(30) NOT NULL,
  `pmd_mode` varchar(30) NOT NULL,
  `pmd_transaction_code` varchar(30) NOT NULL,
  `pmd_date` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`pmd_date`)),
  `pmd_balance` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `students_account_info`
--

CREATE TABLE `students_account_info` (
  `id` int(11) NOT NULL,
  `st_id` varchar(30) NOT NULL,
  `st_username` varchar(30) NOT NULL,
  `st_password` varchar(100) NOT NULL,
  `st_date_created` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`st_date_created`)),
  `st_last_login` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`st_last_login`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `students_personal_info`
--

CREATE TABLE `students_personal_info` (
  `id` int(11) NOT NULL,
  `st_id` varchar(30) NOT NULL,
  `st_firstname` varchar(30) NOT NULL,
  `st_lastname` varchar(30) NOT NULL,
  `st_gender` varchar(30) NOT NULL,
  `st_date_of_birth` varchar(30) NOT NULL,
  `st_age` int(8) NOT NULL,
  `st_nationality` varchar(30) NOT NULL,
  `st_national_id` int(11) NOT NULL,
  `st_phone_number` varchar(20) NOT NULL,
  `st_email` varchar(50) NOT NULL,
  `st_profile_pic` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tutors_account_info`
--

CREATE TABLE `tutors_account_info` (
  `id` int(11) NOT NULL,
  `t_id` varchar(30) NOT NULL,
  `t_username` varchar(30) NOT NULL,
  `t_password` varchar(100) NOT NULL,
  `t_date_created` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`t_date_created`)),
  `t_last_login` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`t_last_login`)),
  `t_ratings` int(11) NOT NULL,
  `t_reviews` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`t_reviews`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tutors_personal_info`
--

CREATE TABLE `tutors_personal_info` (
  `id` int(11) NOT NULL,
  `t_id` varchar(30) NOT NULL,
  `t_firstname` varchar(30) NOT NULL,
  `t_lastname` varchar(30) NOT NULL,
  `t_gender` varchar(30) NOT NULL,
  `t_date_of_birth` varchar(30) NOT NULL,
  `t_age` int(8) NOT NULL,
  `t_nationality` varchar(30) NOT NULL,
  `t_national_id` int(11) NOT NULL,
  `t_phone_number` varchar(20) NOT NULL,
  `t_email` varchar(50) NOT NULL,
  `t_profile_pic` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`,`cl_id`),
  ADD UNIQUE KEY `cl_id` (`cl_id`),
  ADD UNIQUE KEY `c_id` (`c_id`),
  ADD UNIQUE KEY `cn_id` (`cn_id`),
  ADD UNIQUE KEY `t_id` (`t_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`,`c_id`),
  ADD UNIQUE KEY `c_id` (`c_id`),
  ADD UNIQUE KEY `ct_id` (`ct_id`),
  ADD UNIQUE KEY `c_name` (`c_name`);

--
-- Indexes for table `course_category`
--
ALTER TABLE `course_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ct_id` (`ct_id`),
  ADD UNIQUE KEY `ct_name` (`ct_name`);

--
-- Indexes for table `course_content`
--
ALTER TABLE `course_content`
  ADD PRIMARY KEY (`id`,`cn_id`),
  ADD UNIQUE KEY `cn_id` (`cn_id`),
  ADD UNIQUE KEY `c_id` (`c_id`),
  ADD UNIQUE KEY `t_id` (`t_id`);

--
-- Indexes for table `online_classes`
--
ALTER TABLE `online_classes`
  ADD PRIMARY KEY (`id`,`clo_id`),
  ADD UNIQUE KEY `clo_id` (`clo_id`),
  ADD UNIQUE KEY `cl_id` (`cl_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`,`pm_id`),
  ADD UNIQUE KEY `pm_id` (`pm_id`),
  ADD UNIQUE KEY `t_id` (`t_id`),
  ADD UNIQUE KEY `st_id` (`st_id`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`id`,`pm_id`),
  ADD UNIQUE KEY `pm_id` (`pm_id`);

--
-- Indexes for table `students_account_info`
--
ALTER TABLE `students_account_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `st_id` (`st_id`),
  ADD UNIQUE KEY `st_username` (`st_username`);

--
-- Indexes for table `students_personal_info`
--
ALTER TABLE `students_personal_info`
  ADD PRIMARY KEY (`id`,`st_id`),
  ADD UNIQUE KEY `st_id` (`st_id`),
  ADD UNIQUE KEY `st_national_id` (`st_national_id`),
  ADD UNIQUE KEY `st_phone_number` (`st_phone_number`),
  ADD UNIQUE KEY `st_email` (`st_email`);

--
-- Indexes for table `tutors_account_info`
--
ALTER TABLE `tutors_account_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `t_id` (`t_id`),
  ADD UNIQUE KEY `t_username` (`t_username`);

--
-- Indexes for table `tutors_personal_info`
--
ALTER TABLE `tutors_personal_info`
  ADD PRIMARY KEY (`id`,`t_id`),
  ADD UNIQUE KEY `t_id` (`t_id`),
  ADD UNIQUE KEY `t_national_id` (`t_national_id`),
  ADD UNIQUE KEY `t_phone_number` (`t_phone_number`),
  ADD UNIQUE KEY `t_email` (`t_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_account_info`
--
ALTER TABLE `admin_account_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_category`
--
ALTER TABLE `course_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_content`
--
ALTER TABLE `course_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `online_classes`
--
ALTER TABLE `online_classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students_account_info`
--
ALTER TABLE `students_account_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students_personal_info`
--
ALTER TABLE `students_personal_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tutors_account_info`
--
ALTER TABLE `tutors_account_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tutors_personal_info`
--
ALTER TABLE `tutors_personal_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `courses` (`c_id`),
  ADD CONSTRAINT `classes_ibfk_2` FOREIGN KEY (`cn_id`) REFERENCES `course_content` (`cn_id`),
  ADD CONSTRAINT `classes_ibfk_3` FOREIGN KEY (`t_id`) REFERENCES `tutors_personal_info` (`t_id`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`ct_id`) REFERENCES `course_category` (`ct_id`);

--
-- Constraints for table `course_content`
--
ALTER TABLE `course_content`
  ADD CONSTRAINT `course_content_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `courses` (`c_id`),
  ADD CONSTRAINT `course_content_ibfk_2` FOREIGN KEY (`t_id`) REFERENCES `tutors_personal_info` (`t_id`);

--
-- Constraints for table `online_classes`
--
ALTER TABLE `online_classes`
  ADD CONSTRAINT `online_classes_ibfk_1` FOREIGN KEY (`cl_id`) REFERENCES `classes` (`cl_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`t_id`) REFERENCES `tutors_personal_info` (`t_id`),
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`st_id`) REFERENCES `students_personal_info` (`st_id`);

--
-- Constraints for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD CONSTRAINT `payment_details_ibfk_1` FOREIGN KEY (`pm_id`) REFERENCES `payments` (`pm_id`);

--
-- Constraints for table `students_account_info`
--
ALTER TABLE `students_account_info`
  ADD CONSTRAINT `students_account_info_ibfk_1` FOREIGN KEY (`st_id`) REFERENCES `students_personal_info` (`st_id`);

--
-- Constraints for table `tutors_account_info`
--
ALTER TABLE `tutors_account_info`
  ADD CONSTRAINT `tutors_account_info_ibfk_1` FOREIGN KEY (`t_id`) REFERENCES `tutors_personal_info` (`t_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

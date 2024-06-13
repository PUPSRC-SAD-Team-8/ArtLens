-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2024 at 08:58 PM
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
-- Database: `artlens`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(255) DEFAULT NULL,
  `admin_password` varchar(128) DEFAULT NULL,
  `admin_pnumber` varchar(15) DEFAULT NULL,
  `admin_img` varchar(255) DEFAULT NULL,
  `admin_first_name` varchar(255) DEFAULT NULL,
  `admin_middle_name` varchar(255) DEFAULT NULL,
  `admin_last_name` varchar(255) DEFAULT NULL,
  `admin_employee_id` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_password`, `admin_pnumber`, `admin_img`, `admin_first_name`, `admin_middle_name`, `admin_last_name`, `admin_employee_id`) VALUES
(1, 'admin@gmail.com', 'admin123', '111111', NULL, 'joshua', 'I', 'test', '1222');

-- --------------------------------------------------------

--
-- Table structure for table `artwork`
--

CREATE TABLE `artwork` (
  `artwork_id` int(11) NOT NULL,
  `artwork_img` varchar(255) DEFAULT NULL,
  `artwork_description` text DEFAULT NULL,
  `artwork_size` varchar(100) DEFAULT NULL,
  `artwork_status` enum('Available','Archived') NOT NULL DEFAULT 'Available',
  `artwork_medium` varchar(100) DEFAULT NULL,
  `artwork_name` varchar(255) DEFAULT NULL,
  `artwork_year` bigint(4) DEFAULT NULL,
  `artwork_artist` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artwork`
--

INSERT INTO `artwork` (`artwork_id`, `artwork_img`, `artwork_description`, `artwork_size`, `artwork_status`, `artwork_medium`, `artwork_name`, `artwork_year`, `artwork_artist`) VALUES
(39, 'images/the starry night.jpg', 'The Starry Night, an abstract landscape painting of an expressive night sky over a small hillside village by Dutch artist Vincent van Gogh in 1889.', NULL, 'Available', 'Oil on canvas', 'The Starry Night', 1889, 'Vincent Van Gogh');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `booking_ref` char(16) NOT NULL,
  `organization_name` varchar(255) NOT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_number` varchar(15) DEFAULT NULL,
  `num_female` smallint(6) NOT NULL,
  `num_male` smallint(6) NOT NULL,
  `book_datetime` datetime NOT NULL,
  `book_status` varchar(255) NOT NULL,
  `sched_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `booking_ref`, `organization_name`, `contact_email`, `contact_number`, `num_female`, `num_male`, `book_datetime`, `book_status`, `sched_datetime`) VALUES
(6, '', 'JPIA', 'jpia@gmail.com', '09486207980', 5, 4, '2024-05-12 10:48:00', '', '0000-00-00 00:00:00'),
(7, '', 'BSIT', 'admin@gmail.com', '09486207989', 4, 2, '2024-05-13 09:49:00', '', '0000-00-00 00:00:00'),
(8, '', 'BSIE', 'joshuacantiller09@gmail.com', '09486207980', 0, 0, '2024-06-13 05:49:00', '', '0000-00-00 00:00:00'),
(9, '', 'BSIE', 'joshuacantiller09@gmail.com', '09486207980', 0, 0, '2024-06-14 14:25:00', '', '0000-00-00 00:00:00'),
(10, '', 'BSIE', 'joshuacantiller09@gmail.com', '09486207980', 0, 0, '2024-06-20 14:28:00', '', '0000-00-00 00:00:00'),
(11, '', 'BSMT', 'MT@gmail.com', '09486207980', 0, 0, '2024-06-14 13:49:00', '', '0000-00-00 00:00:00'),
(12, '', 'BSTL', 'admin12@gmail.com', '09486207980', 0, 0, '2024-06-14 03:12:00', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `userid` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `employee_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`userid`, `username`, `password`, `employee_id`) VALUES
(1, 'admin@gmail.com', '@Helloword', ''),
(5, 'admin1@gmail.com', 'admin1234', '');

-- --------------------------------------------------------

--
-- Table structure for table `log_genders`
--

CREATE TABLE `log_genders` (
  `id` int(11) NOT NULL,
  `log_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `quiz_id` int(11) NOT NULL,
  `quiz_question` text NOT NULL,
  `quiz_img` varchar(255) DEFAULT NULL,
  `quiz_opt` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`quiz_opt`)),
  `quiz_answer` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_table`
--

CREATE TABLE `quiz_table` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `quiz_title` varchar(255) DEFAULT NULL,
  `question` varchar(255) DEFAULT NULL,
  `options` text DEFAULT NULL,
  `image_filenames` text DEFAULT NULL,
  `correct_answer` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_table`
--

INSERT INTO `quiz_table` (`id`, `quiz_id`, `question_id`, `quiz_title`, `question`, `options`, `image_filenames`, `correct_answer`, `created_at`) VALUES
(0, 1, 1, 'Pagong', 'sino', '[\"khkgg\",\"ggg\",\"ddd\",\"aaaa\"]', '', '0', '2024-06-12 17:52:39');

-- --------------------------------------------------------

--
-- Table structure for table `visitor quiz`
--

CREATE TABLE `visitor quiz` (
  `score_id` int(11) NOT NULL,
  `score_name` varchar(255) NOT NULL,
  `quiz_score` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `visitor_log`
--

CREATE TABLE `visitor_log` (
  `log_form` int(11) NOT NULL,
  `log_first_name` varchar(100) NOT NULL,
  `log_mid_name` varchar(100) DEFAULT NULL,
  `log_last_name` varchar(100) NOT NULL,
  `log_name_extns` varchar(10) DEFAULT NULL,
  `log_contact_number` int(12) DEFAULT NULL,
  `log_contact_email` varchar(255) DEFAULT NULL,
  `entry_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `exit_timestamp` timestamp NULL DEFAULT NULL,
  `log_gender` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitor_log`
--

INSERT INTO `visitor_log` (`log_form`, `log_first_name`, `log_mid_name`, `log_last_name`, `log_name_extns`, `log_contact_number`, `log_contact_email`, `entry_timestamp`, `exit_timestamp`, `log_gender`) VALUES
(10, 'Joshua', 'C', 'Arceo', NULL, 2147483647, 'joshuacantiller09@gmail.com', '2024-06-12 09:51:47', NULL, ''),
(11, 'Joshua', 'C', 'Arceo', NULL, 2147483647, 'joshuacantiller09@gmail.com', '2024-06-12 09:52:04', NULL, 'Male'),
(12, 'Joan', 'C', 'Arc', NULL, 2147483647, 'admin@gmail.com', '2024-06-12 17:24:44', NULL, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_org`
--

CREATE TABLE `visitor_org` (
  `visitor_org_id` int(11) NOT NULL,
  `visitor_org_cn_no` varchar(255) DEFAULT NULL,
  `visitor_org_name` varchar(255) DEFAULT NULL,
  `visitor_org_add` varchar(255) DEFAULT NULL,
  `visitor_org_natl` varchar(255) DEFAULT NULL,
  `visitor_org_male` bigint(255) DEFAULT NULL,
  `visitor_org_female` bigint(255) DEFAULT NULL,
  `visitor_org_gschool` bigint(255) DEFAULT NULL,
  `visitor_org_hschool` bigint(255) DEFAULT NULL,
  `visitor_org_college` bigint(255) DEFAULT NULL,
  `visitor_org_pwd` bigint(255) DEFAULT NULL,
  `visitor_org_17blow` bigint(255) DEFAULT NULL,
  `visitor_org_1930old` bigint(255) DEFAULT NULL,
  `visitor_org_3159old` bigint(255) DEFAULT NULL,
  `visitor_org_60old` bigint(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitor_org`
--

INSERT INTO `visitor_org` (`visitor_org_id`, `visitor_org_cn_no`, `visitor_org_name`, `visitor_org_add`, `visitor_org_natl`, `visitor_org_male`, `visitor_org_female`, `visitor_org_gschool`, `visitor_org_hschool`, `visitor_org_college`, `visitor_org_pwd`, `visitor_org_17blow`, `visitor_org_1930old`, `visitor_org_3159old`, `visitor_org_60old`) VALUES
(0, '12', 'Sinai', 'SM', 'filipino', 11, 12, 6, 6, 7, 1, 1, 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `artwork`
--
ALTER TABLE `artwork`
  ADD PRIMARY KEY (`artwork_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `log_genders`
--
ALTER TABLE `log_genders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`quiz_id`);

--
-- Indexes for table `visitor_log`
--
ALTER TABLE `visitor_log`
  ADD PRIMARY KEY (`log_form`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `artwork`
--
ALTER TABLE `artwork`
  MODIFY `artwork_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `log_genders`
--
ALTER TABLE `log_genders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitor_log`
--
ALTER TABLE `visitor_log`
  MODIFY `log_form` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2023 at 03:44 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dtrsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance_tbl`
--

CREATE TABLE `attendance_tbl` (
  `id` int(11) NOT NULL,
  `rfid` int(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `morning_in` time DEFAULT NULL,
  `morning_out` time DEFAULT NULL,
  `afternoon_in` time DEFAULT NULL,
  `afternoon_out` time DEFAULT NULL,
  `log_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance_tbl`
--

INSERT INTO `attendance_tbl` (`id`, `rfid`, `fullname`, `morning_in`, `morning_out`, `afternoon_in`, `afternoon_out`, `log_date`) VALUES
(1, 1, 'john acc malss', '05:12:24', '05:12:27', NULL, NULL, '2023-10-02'),
(2, 5, 'juan dela cruz', '05:12:32', '05:12:34', NULL, NULL, '2023-10-02'),
(3, 1, 'john acc malss', '05:12:58', '05:13:00', NULL, NULL, '2023-10-22'),
(4, 5, 'juan dela cruz', '05:13:06', '05:13:08', NULL, NULL, '2023-10-22');

-- --------------------------------------------------------

--
-- Table structure for table `department_tbl`
--

CREATE TABLE `department_tbl` (
  `id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `department_desc` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_tbl`
--

INSERT INTO `department_tbl` (`id`, `department_name`, `department_desc`, `date`) VALUES
(1, 'englishhh', 'englishhh', '2023-10-07 18:07:46'),
(2, 'mathhh', 'sdigjdlf', '2023-10-07 18:36:49'),
(3, 'qwefrgd', 'dfgnh', '2023-10-07 18:54:34'),
(4, 'qwefrgd', 'dfgnhsdf', '2023-10-07 18:54:41'),
(5, 'das', 'sdcsvsd', '2023-10-17 22:04:06'),
(6, 'cszdad', 'DSCSD', '2023-10-17 23:06:25'),
(7, 'khb', 'HGC', '2023-10-22 04:04:26');

-- --------------------------------------------------------

--
-- Table structure for table `login_tbl`
--

CREATE TABLE `login_tbl` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `usertype` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_tbl`
--

INSERT INTO `login_tbl` (`id`, `username`, `password`, `usertype`, `status`) VALUES
(1, 'john', '1234', 1, 1),
(2, 'juan', '1234', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `schedule_tbl`
--

CREATE TABLE `schedule_tbl` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `morning_in` time DEFAULT NULL,
  `morning_out` time DEFAULT NULL,
  `afternoon_in` time DEFAULT NULL,
  `afternoon_out` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule_tbl`
--

INSERT INTO `schedule_tbl` (`id`, `staff_id`, `fullname`, `morning_in`, `morning_out`, `afternoon_in`, `afternoon_out`) VALUES
(1, 5, 'juan dela cruz', '05:00:00', '05:52:00', '04:00:00', '04:34:00'),
(2, 123, 'dgas asd wer', '10:00:00', '11:00:00', '16:00:00', '17:00:00'),
(3, 7, 'pedro pen duko', '09:00:00', '11:00:00', '17:00:00', '20:00:00'),
(4, 1, 'john acc malss', '05:00:00', '05:05:00', '17:00:00', '17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `staff_tbl`
--

CREATE TABLE `staff_tbl` (
  `id` int(11) NOT NULL,
  `rfid` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `midname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `schedule` int(11) DEFAULT NULL,
  `log_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_tbl`
--

INSERT INTO `staff_tbl` (`id`, `rfid`, `firstname`, `midname`, `lastname`, `department_id`, `dob`, `gender`, `civil_status`, `number`, `email`, `address`, `schedule`, `log_date`) VALUES
(1, 1, 'john', 'acc', 'malss', 3, '2001-02-04', 'Male', 'Single', '4324', 'wef.sdf#@asfd.csd', 'sdfssd', 1, '2023-10-18'),
(2, 5, 'juan', 'delacc', 'cruz', 3, '2001-02-04', 'Male', 'Single', '4324', 'wef.sdf#@asfd.csd', 'sdfssd', 1, '2023-10-18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance_tbl`
--
ALTER TABLE `attendance_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_tbl`
--
ALTER TABLE `department_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_tbl`
--
ALTER TABLE `login_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_tbl`
--
ALTER TABLE `schedule_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_tbl`
--
ALTER TABLE `staff_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance_tbl`
--
ALTER TABLE `attendance_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `department_tbl`
--
ALTER TABLE `department_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `login_tbl`
--
ALTER TABLE `login_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `schedule_tbl`
--
ALTER TABLE `schedule_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff_tbl`
--
ALTER TABLE `staff_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2024 at 09:02 PM
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
-- Database: `church_db`
--
DROP DATABASE IF EXISTS `church_db`;
CREATE DATABASE IF NOT EXISTS `church_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `church_db`;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `service_date` date NOT NULL,
  `males_count` int(11) DEFAULT 0,
  `females_count` int(11) DEFAULT 0,
  `children_count` int(11) DEFAULT 0,
  `service_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `service_date`, `males_count`, `females_count`, `children_count`, `service_name`, `created_at`) VALUES
(4, '2024-08-01', 50, 45, 30, 'Sunday Service', '2024-08-09 05:15:40'),
(5, '2024-08-04', 60, 50, 25, 'Wednesday Service', '2024-08-09 05:15:40'),
(6, '2024-08-07', 55, 48, 27, 'Youth Service', '2024-08-09 05:15:40'),
(7, '2024-08-10', 62, 52, 31, 'Sunday Service', '2024-08-09 05:15:40'),
(8, '2024-08-14', 57, 47, 29, 'Bible Study', '2024-08-09 05:15:40'),
(9, '2024-08-17', 64, 55, 33, 'Sunday Service', '2024-08-09 05:15:40'),
(10, '2024-08-21', 66, 58, 35, 'Prayer Meeting', '2024-08-09 05:15:40'),
(11, '2024-08-24', 59, 50, 40, 'Youth Service', '2024-08-09 05:15:40');

-- --------------------------------------------------------

--
-- Table structure for table `elders`
--

DROP TABLE IF EXISTS `elders`;
CREATE TABLE `elders` (
  `elder_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `elder_position` varchar(50) NOT NULL,
  `elder_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `elders`
--

INSERT INTO `elders` (`elder_id`, `member_id`, `elder_position`, `elder_image`, `created_at`) VALUES
(6, 7, 'Deacon', 'lucas_taylor.jpg', '2024-08-09 18:30:21'),
(7, 31, 'Treasurer', 'gilbert_elikplim_kukah.jpg', '2024-08-09 18:30:52'),
(8, 28, 'President', 'emma_hall.jpg', '2024-08-09 18:31:16');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `member_id` int(11) NOT NULL,
  `member_name` varchar(255) NOT NULL,
  `member_email` varchar(255) DEFAULT NULL,
  `member_contact` varchar(20) DEFAULT NULL,
  `member_address` text DEFAULT NULL,
  `member_position` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `member_name`, `member_email`, `member_contact`, `member_address`, `member_position`, `created_at`) VALUES
(4, 'Olivia Martinez', 'olivia.martinez@example.com', '789-012-3456', '404 Oak Lane', 'Member', '2024-08-09 05:16:03'),
(6, 'Isabella Lee', 'isabella.lee@example.com', '901-234-5678', '606 Pine Lane', 'Member', '2024-08-09 05:16:03'),
(7, 'Lucas Taylor', 'lucas.taylor@example.com', '012-345-6789', '707 Maple Drive', 'Deacon', '2024-08-09 05:16:03'),
(8, 'Mia Anderson', 'mia.anderson@example.com', '123-456-7890', '808 Cedar Avenue', 'Member', '2024-08-09 05:16:03'),
(9, 'Ethan Thomas', 'ethan.thomas@example.com', '234-567-8901', '909 Birch Road', 'Member', '2024-08-09 05:16:03'),
(10, 'Charlotte Jackson', 'charlotte.jackson@example.com', '345-678-9012', '1010 Elm Street', 'Elder', '2024-08-09 05:16:03'),
(21, 'Sophia Green', 'sophia.green@example.com', '234-567-8902', '123 Maple Street', 'Member', '2024-08-09 07:25:54'),
(22, 'Liam Carter', 'liam.carter@example.com', '345-678-9013', '234 Oak Avenue', 'Deacon', '2024-08-09 07:25:54'),
(23, 'Ava Mitchell', 'ava.mitchell@example.com', '456-789-0124', '345 Pine Lane', 'Member', '2024-08-09 07:25:54'),
(24, 'Noah Clark', 'noah.clark@example.com', '567-890-1235', '456 Cedar Drive', 'Member', '2024-08-09 07:25:54'),
(25, 'Mason Walker', 'mason.walker@example.com', '678-901-2346', '567 Birch Road', 'Elder', '2024-08-09 07:25:54'),
(26, 'Isabella Robinson', 'isabella.robinson@example.com', '789-012-3457', '678 Elm Street', 'Member', '2024-08-09 07:25:54'),
(27, 'Oliver Lewis', 'oliver.lewis@example.com', '890-123-4568', '789 Maple Lane', 'Deacon', '2024-08-09 07:25:54'),
(28, 'Emma Hall', 'emma.hall@example.com', '901-234-5679', '890 Oak Avenue', 'Member', '2024-08-09 07:25:54'),
(29, 'Aiden Young', 'aiden.young@example.com', '012-345-6780', '901 Pine Drive', 'Member', '2024-08-09 07:25:54'),
(31, 'Gilbert Elikplim Kukah', 'kwamegilbert1114@gmail.com', '0541436414', 'CI-1785-2738, MZ/J 35. Gomoa Eshiem', 'Member', '2024-08-09 08:05:15');

-- --------------------------------------------------------

--
-- Table structure for table `offertory`
--

DROP TABLE IF EXISTS `offertory`;
CREATE TABLE `offertory` (
  `offertory_id` int(11) NOT NULL,
  `offertory_date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `service_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offertory`
--

INSERT INTO `offertory` (`offertory_id`, `offertory_date`, `amount`, `service_name`, `created_at`) VALUES
(1, '2024-08-01', 150.75, 'Sunday Service', '2024-08-09 05:16:10'),
(2, '2024-08-04', 200.50, 'Wednesday Service', '2024-08-09 05:16:10'),
(3, '2024-08-07', 175.00, 'Youth Service', '2024-08-09 05:16:10'),
(4, '2024-08-10', 220.00, 'Sunday Service', '2024-08-09 05:16:10'),
(5, '2024-08-14', 180.00, 'Bible Study', '2024-08-09 05:16:10'),
(6, '2024-08-17', 250.00, 'Sunday Service', '2024-08-09 05:16:10'),
(7, '2024-08-21', 190.00, 'Prayer Meeting', '2024-08-09 05:16:10'),
(8, '2024-08-24', 210.00, 'Youth Service', '2024-08-09 05:16:10'),
(9, '2024-08-28', 230.00, 'Sunday Service', '2024-08-09 05:16:10'),
(10, '2024-08-31', 240.00, 'Monthly Gathering', '2024-08-09 05:16:10'),
(11, '2024-08-01', 150.75, 'Sunday Service', '2024-08-09 05:26:19'),
(12, '2024-08-04', 200.50, 'Wednesday Service', '2024-08-09 05:26:19'),
(13, '2024-08-07', 175.00, 'Youth Service', '2024-08-09 05:26:19'),
(14, '2024-08-10', 220.00, 'Sunday Service', '2024-08-09 05:26:19'),
(15, '2024-08-14', 180.00, 'Bible Study', '2024-08-09 05:26:19'),
(16, '2024-08-17', 250.00, 'Sunday Service', '2024-08-09 05:26:19'),
(17, '2024-08-21', 190.00, 'Prayer Meeting', '2024-08-09 05:26:19');

-- --------------------------------------------------------

--
-- Table structure for table `pastors`
--

DROP TABLE IF EXISTS `pastors`;
CREATE TABLE `pastors` (
  `pastor_id` int(11) NOT NULL,
  `pastor_name` varchar(255) NOT NULL,
  `pastor_email` varchar(255) DEFAULT NULL,
  `pastor_contact` varchar(20) DEFAULT NULL,
  `pastor_address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pastors`
--

INSERT INTO `pastors` (`pastor_id`, `pastor_name`, `pastor_email`, `pastor_contact`, `pastor_address`, `created_at`) VALUES
(1, 'Gilbert Elikplim Kukah', 'kwamegilbert1114@gmail.com', '0541436414', 'CI-1785-2738, MZ/J 35. Gomoa Eshiem', '2024-08-08 20:08:48');

-- --------------------------------------------------------

--
-- Table structure for table `pastor_credentials`
--

DROP TABLE IF EXISTS `pastor_credentials`;
CREATE TABLE `pastor_credentials` (
  `credential_id` int(11) NOT NULL,
  `pastor_id` int(11) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pastor_credentials`
--

INSERT INTO `pastor_credentials` (`credential_id`, `pastor_id`, `username`, `password_hash`, `created_at`) VALUES
(1, 1, 'admin', '$2y$10$7fDSad8VWdvyAdTcZJYFrOEA6Sye4nHQ/qBdWouDbMqD.lI4JLr/m', '2024-08-08 20:08:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `elders`
--
ALTER TABLE `elders`
  ADD PRIMARY KEY (`elder_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `offertory`
--
ALTER TABLE `offertory`
  ADD PRIMARY KEY (`offertory_id`);

--
-- Indexes for table `pastors`
--
ALTER TABLE `pastors`
  ADD PRIMARY KEY (`pastor_id`),
  ADD UNIQUE KEY `pastor_email` (`pastor_email`);

--
-- Indexes for table `pastor_credentials`
--
ALTER TABLE `pastor_credentials`
  ADD PRIMARY KEY (`credential_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `pastor_id` (`pastor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `elders`
--
ALTER TABLE `elders`
  MODIFY `elder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `offertory`
--
ALTER TABLE `offertory`
  MODIFY `offertory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pastors`
--
ALTER TABLE `pastors`
  MODIFY `pastor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pastor_credentials`
--
ALTER TABLE `pastor_credentials`
  MODIFY `credential_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `elders`
--
ALTER TABLE `elders`
  ADD CONSTRAINT `elders_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`);

--
-- Constraints for table `pastor_credentials`
--
ALTER TABLE `pastor_credentials`
  ADD CONSTRAINT `pastor_credentials_ibfk_1` FOREIGN KEY (`pastor_id`) REFERENCES `pastors` (`pastor_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

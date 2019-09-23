-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 23, 2019 at 06:44 PM
-- Server version: 8.0.17
-- PHP Version: 7.1.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nfq`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `name`) VALUES
(1, 'Lukas'),
(2, 'Lukas'),
(3, 'Lukas 2'),
(4, 'LUKAS 3'),
(5, 'Lukas 4'),
(6, 'Lukas 5'),
(7, 'Lukas 6'),
(8, 'Lukas 7'),
(9, 'Lukas 8'),
(10, 'Lukas 8'),
(11, 'Lukas 4'),
(12, 'Lukas 4'),
(13, 'Lukas'),
(14, 'Lukas 6'),
(15, 'Lukas 6'),
(16, 'Lukas 2'),
(17, 'Lukas 2'),
(18, 'Lukas 0 '),
(19, 'Lukas Hill'),
(20, 'Lukas Hill'),
(21, 'Lukas 17'),
(22, 'Hillie 2'),
(23, 'Lukas 88'),
(24, 'Lukas 11'),
(25, 'Lukas 1919'),
(26, 'Lukas 14'),
(27, 'Lukas 00 '),
(28, 'Lukas 00 '),
(29, 'Anonimoose'),
(30, 'Lukas 6'),
(31, 'Billie G'),
(32, 'Lukas 5'),
(33, 'Lukas 5'),
(34, 'Lukas 5'),
(35, 'Lukas'),
(36, 'Lukas 4'),
(37, 'Hillie'),
(38, 'Lukas 5'),
(47, 'Lukas99');

-- --------------------------------------------------------

--
-- Table structure for table `completion_time`
--

CREATE TABLE `completion_time` (
  `id` int(11) NOT NULL,
  `registration_id` int(11) NOT NULL,
  `time_taken` int(11) NOT NULL COMMENT 'raw number of seconds from registration start to finish'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `completion_time`
--

INSERT INTO `completion_time` (`id`, `registration_id`, `time_taken`) VALUES
(1, 4, 182065),
(2, 9, 182519),
(3, 12, 182512),
(4, 2, 180232),
(5, 19, 5),
(6, 21, 81),
(7, 18, 306425),
(8, 20, 236197),
(9, 22, 547),
(10, 23, 53),
(11, 24, 2680),
(12, 25, 1198),
(13, 29, 2266),
(14, 32, 27787);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`) VALUES
(1, '829232', '$2y$12$T1wIEGIgLbUl0dLYQJMTy.Pw8nXul5m.B3VXWsnOWcxSFWt46rD5G'),
(2, '402657', '$2y$12$.qEAN3GNgSbjKkP5UOKiiOeJOmQ9N0rE8aS18opmXDAoM/70IllWC'),
(3, '945910', '$2y$12$FpdJm10/ttwtpY4sqErjFe0Pdu9CXrCIXMwKKSxLPQLDafLrk.XB6'),
(4, '362791', '$2y$12$KmQyG2q9VY.DKFLT6FR.F.yoNc7uKqNiTyY0mvlOPiQkYW4sruRtO'),
(5, '594509', '$2y$12$wCcf7LGtIeMqWpFuFXRIWuqxjUVrv1gTGMvHcAT7UXZUCHeBmupv2'),
(6, '651765', '$2y$12$VftatPQvplMGkTkpOO7CZ.Fa/R6leKtiWlj0zktuZ2zDzKqcAw1oK'),
(7, '488830', '$2y$12$q7l7ENE2enkJTrB78QydMO5NFo0z2.64kZFj0ltSYci.j4buFO2wa');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `specialist_id` int(11) NOT NULL,
  `is_completed` int(1) NOT NULL DEFAULT '0',
  `info_url` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `registered_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `client_id`, `specialist_id`, `is_completed`, `info_url`, `registered_at`) VALUES
(2, 3, 1, 1, '', '2019-09-17 17:48:00'),
(3, 4, 1, 1, '', '2019-09-17 17:13:00'),
(4, 5, 1, 1, '', '2019-09-17 17:09:32'),
(5, 6, 1, 1, '', '2019-09-17 17:09:49'),
(9, 10, 1, 1, '', '2019-09-17 17:09:51'),
(11, 12, 1, 1, '', '2019-09-17 17:09:34'),
(12, 13, 1, 1, '', '2019-09-17 17:09:59'),
(16, 17, 9, 0, '', '2019-09-17 18:46:53'),
(17, 18, 7, 0, '', '2019-09-17 18:55:18'),
(18, 20, 8, 1, '', '2019-09-19 19:12:05'),
(19, 21, 1, 1, '', '2019-09-19 19:52:33'),
(20, 22, 8, 1, '', '2019-09-20 14:42:34'),
(21, 23, 8, 1, '', '2019-09-23 08:17:39'),
(22, 24, 8, 1, '', '2019-09-23 08:19:21'),
(23, 25, 8, 1, '', '2019-09-23 08:28:21'),
(24, 26, 8, 1, '', '2019-09-23 08:28:59'),
(25, 28, 8, 1, '000806b8', '2019-09-23 09:13:33'),
(26, 29, 9, 0, '0264fda4', '2019-09-23 09:15:19'),
(27, 30, 1, 0, 'ec54ba9c', '2019-09-23 18:33:28'),
(28, 31, 7, 0, 'as22kask', '2019-09-23 09:27:21'),
(29, 34, 8, 1, '2e68e908', '2019-09-23 09:29:59'),
(30, 35, 8, 0, '8d3f0bcb', '2019-09-23 09:30:13'),
(31, 36, 6, 0, '31d31242', '2019-09-23 09:33:58'),
(32, 37, 8, 1, '91c6b823', '2019-09-23 10:15:24'),
(33, 38, 8, 2, '2fe73346', '2019-09-23 10:18:24'),
(42, 47, 1, 0, '4b683c72', '2019-09-23 09:19:46');

-- --------------------------------------------------------

--
-- Table structure for table `specialist`
--

CREATE TABLE `specialist` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `specialist`
--

INSERT INTO `specialist` (`id`, `name`, `login_id`) VALUES
(1, 'Dr. Oneill', 1),
(2, 'Dr. Fill', 2),
(3, 'Dr. Dill', 3),
(6, 'Dr. Mill', 4),
(7, 'Dr. Bill', 5),
(8, 'Dr. Hill', 6),
(9, 'Dr. Will', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `completion_time`
--
ALTER TABLE `completion_time`
  ADD PRIMARY KEY (`id`),
  ADD KEY `registration_id` (`registration_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `specialist_id` (`specialist_id`);

--
-- Indexes for table `specialist`
--
ALTER TABLE `specialist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login_id` (`login_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `completion_time`
--
ALTER TABLE `completion_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `specialist`
--
ALTER TABLE `specialist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `completion_time`
--
ALTER TABLE `completion_time`
  ADD CONSTRAINT `completion_time_ibfk_1` FOREIGN KEY (`registration_id`) REFERENCES `registration` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `registration_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `registration_ibfk_2` FOREIGN KEY (`specialist_id`) REFERENCES `specialist` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `specialist`
--
ALTER TABLE `specialist`
  ADD CONSTRAINT `specialist_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `login` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 19, 2019 at 06:35 PM
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
(18, 'Lukas 0 ');

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
  `registered_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `client_id`, `specialist_id`, `registered_at`) VALUES
(2, 3, 1, '2019-09-17 17:48:00'),
(3, 4, 1, '2019-09-17 17:13:00'),
(4, 5, 1, '2019-09-17 17:09:32'),
(5, 6, 1, '2019-09-17 17:09:49'),
(9, 10, 1, '2019-09-17 17:09:51'),
(11, 12, 1, '2019-09-17 17:09:34'),
(12, 13, 1, '2019-09-17 17:09:59'),
(16, 17, 9, '2019-09-17 18:46:53'),
(17, 18, 7, '2019-09-17 18:55:18');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `specialist`
--
ALTER TABLE `specialist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

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

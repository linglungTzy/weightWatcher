-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2023 at 05:26 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `weight_watcher`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `height` decimal(5,2) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `target_weight` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `weight`, `height`, `age`, `gender`, `profile_picture`, `target_weight`) VALUES
(6, 'test', '$2y$10$djKfURns1BKSsU3n3NSDLu9ICR1ER0onrrzAhz55SyBT6x7727NV6', 82.00, 180.00, 21, 'male', NULL, NULL),
(7, 'daffa', '$2y$10$EhuVXxK7JZ7tkY5AmAEQ7OHYsK7/W3EsgeMoJOh1waxAxF4uvCfBe', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'admin', '$2y$10$vUwjc3mS1Na/8GahaE2FtOzyHpCIq2I11lwK6PUyLqogCLSg/a6f.', NULL, NULL, NULL, NULL, NULL, NULL),
(12, '1234', '$2y$10$1keoElVXKkuJpBJ7u8IxvuQijfbw37Cz/Q16bCu2sSkfEo6/02igW', 21.00, 713.00, 21, 'male', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `weekly_weights`
--

CREATE TABLE `weekly_weights` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `week_start_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `weekly_weights`
--

INSERT INTO `weekly_weights` (`id`, `user_id`, `weight`, `week_start_date`) VALUES
(12, 6, 70.00, '2023-11-22 07:49:24'),
(30, 7, 23.00, '2023-11-22 08:14:04'),
(31, 7, 23.00, '2023-11-22 08:14:13'),
(32, 7, 23.00, '2023-11-22 08:15:07'),
(33, 7, 23.00, '2023-11-22 08:16:10'),
(34, 7, 23.00, '2023-11-22 08:16:42'),
(35, 7, 23.00, '2023-11-22 08:17:09'),
(36, 7, 23.00, '2023-11-22 08:18:24'),
(37, 7, 23.00, '2023-11-22 08:18:37'),
(38, 7, 23.00, '2023-11-22 08:18:52'),
(39, 7, 23.00, '2023-11-22 08:18:54'),
(40, 12, 12.00, '2023-11-22 15:27:42'),
(41, 12, 80.00, '2023-11-22 15:27:44'),
(42, 12, 90.00, '2023-11-22 15:27:48'),
(43, 8, 12.00, '2023-11-22 15:36:39'),
(44, 8, 12.00, '2023-11-22 15:37:12'),
(45, 8, 12.00, '2023-11-22 15:38:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weekly_weights`
--
ALTER TABLE `weekly_weights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `weekly_weights`
--
ALTER TABLE `weekly_weights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `weekly_weights`
--
ALTER TABLE `weekly_weights`
  ADD CONSTRAINT `weekly_weights_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

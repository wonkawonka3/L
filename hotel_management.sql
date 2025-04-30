-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2025 at 09:37 AM
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
-- Database: `hotel_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `room_id` int(11) NOT NULL,
  `booking_date` datetime NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('Pending','Confirmed','Checked-in','Checked-out','Canceled') NOT NULL DEFAULT 'Pending',
  `user_id` int(11) NOT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `name`, `email`, `phone`, `room_id`, `booking_date`, `price`, `status`, `user_id`, `checkin_date`, `checkout_date`) VALUES
(47, 'LIam DAylisan pogi', 'lmstthm@gmail.com', '123123', 40, '2025-03-04 22:10:15', 0.00, 'Pending', 0, '0000-00-00', '0000-00-00'),
(48, 'WILSON Fisk', 'lmstthm@gmail.com', '1231313', 33, '2025-03-13 21:20:40', 0.00, 'Pending', 0, '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `checkout_requests`
--

CREATE TABLE `checkout_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `requested_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `name`, `location`, `description`) VALUES
(1, 'Grand Palace Hotel', 'Paris', NULL),
(2, 'Grand Palace Hotel', 'Paris', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('leeamwonka3@gmail.com', '0001879843861e3e67ded4bc1ee810e3', '2025-02-25 05:48:08'),
('com@gmail.com', '5ec5d7e65f21ab4a34c81090d649719e', '2025-02-25 05:43:03'),
('eewe@gmail.com', '75135cde50ba5a029a859998b1d26c46', '2025-02-25 05:42:51');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `room_number` varchar(10) NOT NULL,
  `room_type` varchar(50) NOT NULL,
  `status` enum('Available','Booked') DEFAULT 'Available',
  `beds` varchar(50) NOT NULL,
  `size` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_path` varchar(255) NOT NULL DEFAULT 'default-room.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `hotel_id`, `room_number`, `room_type`, `status`, `beds`, `size`, `capacity`, `price`, `image_path`) VALUES
(54, 0, '1', 'Suite', 'Available', '2', 0, 2, 100.00, 'uploads/67d4110643049_suite-room.jpg'),
(55, 0, '2', 'Standard', 'Available', '2', 0, 2, 100.00, 'uploads/67d4131e720a0_67d40df921131_1696284472391796.png'),
(56, 0, '9', 'Standard', 'Available', '1', 0, 2, 100.00, 'uploads/67efcf7d4ad0b_Screenshot 2025-03-12 215907.png'),
(57, 0, '10', 'Double', 'Available', '2', 0, 2, 200.00, 'uploads/67efcfe95a9ab_Screenshot 2025-03-25 221856.png'),
(58, 0, '11', 'Family Room', 'Available', '5', 0, 6, 100.00, 'uploads/67efd0aaf1134_machoman.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `status` varchar(50) NOT NULL DEFAULT 'user',
  `phone` varchar(20) NOT NULL,
  `reset_token` varchar(100) DEFAULT NULL,
  `reset_expiry` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `name`, `email`, `role`, `status`, `phone`, `reset_token`, `reset_expiry`) VALUES
(1, 'testuser', '$2y$10$Y.bQIjnhPOThtnVu5y8tEeVj5xBY3gP5rOdTG6BdWBAD.2C8Y.tBa', '2025-01-22 09:56:52', '', '', 'user', 'user', '', NULL, NULL),
(2, 'admin', 'root', '0000-00-00 00:00:00', '', '', 'admin', 'user', '', NULL, NULL),
(5, 'leeamwonka3', '$2y$10$KIUj4BhmeytN2uZyVS4oe.T0RttD7uYkT.pBGgnKrctQD0DGIkAE.', '2025-02-11 17:20:24', 'jukes2', 'leeamwonka3@gmail.com', 'Customer', 'Active', '11111', NULL, NULL),
(7, 'rechelherrera11', '', '2025-02-12 10:36:52', 'testserver', 'rechelherrera11@gmail.com', 'Customer', 'Active', '11111', NULL, NULL),
(10, 'test1111@gmail.com', '$2y$10$T0ZTMr79t4HeP1Tvj6m99ej7gW4yWjSO8RVMYZqVLTUrcWOBKXWR6', '2025-02-12 11:31:36', 'ZEP', 'test1@gmail.com', 'user', 'user', '', NULL, NULL),
(11, 'JUEWE', '$2y$10$ALN2HrcPtOs0/2.96vQ/T.3MriH0wAuoOgfeETAlQBnUii23wcwVu', '2025-02-12 11:33:44', 'ZEP', 'test1111@gmail.com', 'user', 'user', '', NULL, NULL),
(12, 'test0', '$2y$10$QRbPaoOL/0GdQkGmTBFnGu3G6wgdcR2RQP9W/DgmfXseYuqA2a1oq', '2025-02-12 11:36:46', 'faasss', 'eewe@gmail.com', 'user', 'user', '', NULL, NULL),
(13, 'test2', '$2y$10$eG83MnDugPuYdhexDLckjecGvCyYp2whvI0skWveSuEea/tFemnAu', '2025-02-12 11:40:04', 'sdasdad', 'puyatnana1man@gmail.com', 'user', 'user', '', NULL, NULL),
(14, 'WONKATEST', '$2y$10$ATwWgRlFoEgpkD1Gy193J.LOzMqLQ.fXGixFHzXrpsaOh1YBn2BRi', '2025-02-25 04:41:55', 'wonkawonka', 'com@gmail.com', 'user', 'user', '', NULL, NULL),
(15, 'www', '', '2025-02-25 04:50:47', 'JUKESONU1', 'www@gmail.com', 'Customer', 'Active', '222222222', NULL, NULL),
(16, 'A23', '$2y$10$o7oSGrV87i0f5bc5bHIgKeKBCUnvQyOj72PaUNU8lobwZASY6bj/S', '2025-02-26 12:46:12', 'LIAM DAYLISAN1', 'angelinemanuel32@gmail.com', 'user', 'user', '', NULL, NULL),
(17, 'lmstthm', '', '2025-03-04 14:10:15', 'LIam DAylisan pogi', 'lmstthm@gmail.com', 'Customer', 'Active', '123123', NULL, NULL),
(18, 'JukesFrim', '$2y$10$aToUWf5Pcr7G9BqJfwMqke8bPOO4kHmBitApGs.iiOpF6eOwd/TVq', '2025-03-12 02:46:39', 'liam', 'wewe1@gmail.com', 'user', 'user', '', '589036', 1741872308);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `checkout_requests`
--
ALTER TABLE `checkout_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD UNIQUE KEY `token` (`token`),
  ADD UNIQUE KEY `token_2` (`token`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `checkout_requests`
--
ALTER TABLE `checkout_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `checkout_requests`
--
ALTER TABLE `checkout_requests`
  ADD CONSTRAINT `checkout_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `checkout_requests_ibfk_2` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

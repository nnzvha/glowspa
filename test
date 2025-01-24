-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2025 at 05:58 AM
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
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `email`, `password`) VALUES
(1, 'akmal02', 'akmal@gmail.com', '$2y$10$FASh3gmboereUi/VtrcSC.sBXnTPxl3uN27ksgMhFitn7rTZZmYTW'),
(2, 'aisy02', 'sitiaisyah@gmail.com', '$2y$10$5zC8lNgvCUQvzSh.X1kA4eOvw0Cxyq7Cu4EH/A/5n.nfYdy.9h2DS'),
(3, 'dina76', 'deena@gmail.com', '$2y$10$AhSNhCz6emco6vj.tk1nH.zM/s9k59gnCcWGnGC0vLXNGQglwCaL2'),
(4, 'faridah03', 'far0333@gmail.com', '$2y$10$bBF8zptRYTiXpAYK/9w3quHMsfj/eqpSS2mYsvWcfKWi.eqpnQB0C'),
(5, 'sofianlatif', 'sofianL@gmail.com', '$2y$10$17xftH/YBz0ZEza3YhJFUuustnC2KTSQyJcalqdDJIAm2IzZ7aor6');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `user_username` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phoneno` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `services` varchar(255) NOT NULL,
  `packages` varchar(255) NOT NULL,
  `slot` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('active','completed') DEFAULT 'active',
  `updated_by_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_username`, `name`, `phoneno`, `date`, `services`, `packages`, `slot`, `created`, `status`, `updated_by_admin`) VALUES
(1, 'aisyah', 'akmal bin azhar', '0179861094', '2025-01-27', 'Full Body Massage Therapy', 'Not selected', '1', '2025-01-23 20:35:11', 'completed', NULL),
(3, 'akmal02', 'akmal syazwen bin rosidi', '0147894568', '2025-01-27', 'Full Body Massage Therapy', 'Not selected', '5', '2025-01-23 20:48:52', 'active', NULL),
(4, 'suryati', 'suryati', '0175648795', '2025-01-27', 'Not selected', 'Relaxation Package', '5', '2025-01-24 04:42:46', 'active', NULL),
(5, 'syazwan', 'syazwan', '0147894568', '2025-01-27', 'Not selected', 'Glow Essentials Package', '5', '2025-01-24 04:43:46', 'active', NULL),
(6, 'hani99', 'hani', '0125647894', '2025-01-27', 'Not selected', 'Luxury Indulgence Package', '5', '2025-01-24 04:44:48', 'completed', NULL),
(7, 'sabrina', 'sabrina', '0135247851', '2025-01-27', 'Full Body Massage Therapy', 'Not selected', '4', '2025-01-24 04:53:15', 'active', NULL),
(8, 'badrul76', 'badrul ', '01158965472', '2025-01-28', 'Full Body Massage Therapy', 'Not selected', '3', '2025-01-24 04:57:55', 'active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `username`, `message`, `created_at`) VALUES
(1, 'aisyah', 'i like the services', '2025-01-23 20:18:27'),
(2, 'akmal02', 'i like this spa so much', '2025-01-23 20:51:21'),
(3, 'sabrina', 'this spa is very calming. i like it', '2025-01-24 04:54:38'),
(4, 'badrul76', 'i will go here again ', '2025-01-24 04:58:10');

-- --------------------------------------------------------

--
-- Table structure for table `packageslots`
--

CREATE TABLE `packageslots` (
  `package_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `package` varchar(255) DEFAULT NULL,
  `avail_slots` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `packageslots`
--

INSERT INTO `packageslots` (`package_id`, `admin_id`, `date`, `package`, `avail_slots`, `created_at`) VALUES
(5, 1, '2025-01-27', 'Relaxation Package', 5, '2025-01-23 13:45:40'),
(6, 1, '2025-01-27', 'Luxury Indulgence Package', 5, '2025-01-23 13:45:49'),
(7, 1, '2025-01-27', 'Glow Essentials Package', 5, '2025-01-23 13:45:58'),
(8, 1, '2025-01-28', 'Relaxation Package', 5, '2025-01-23 21:56:09'),
(9, 1, '2025-01-28', 'Luxury Indulgence Package', 2, '2025-01-23 21:56:17'),
(10, 1, '2025-01-28', 'Glow Essentials Package', 3, '2025-01-23 21:56:26');

-- --------------------------------------------------------

--
-- Table structure for table `slots`
--

CREATE TABLE `slots` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `service` varchar(255) DEFAULT NULL,
  `avail_slots` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `slots`
--

INSERT INTO `slots` (`id`, `admin_id`, `date`, `service`, `avail_slots`, `created_at`) VALUES
(4, 1, '2025-01-27', 'Full Body Massage Therapy', 5, '2025-01-23 13:01:32'),
(5, 1, '2025-01-27', 'Facial Treatment', 5, '2025-01-23 13:44:53'),
(6, 1, '2025-01-27', 'Head, Neck & Shoulder Massage', 5, '2025-01-23 13:45:23'),
(8, 1, '2025-01-27', 'Full Body Massage Therapy', 4, '2025-01-23 13:57:05'),
(9, 4, '2025-01-28', 'Head, Neck & Shoulder Massage', 3, '2025-01-23 21:55:37'),
(10, 4, '2025-01-28', 'Full Body Massage Therapy', 3, '2025-01-23 21:55:48'),
(11, 4, '2025-01-28', 'Facial Treatment', 1, '2025-01-23 21:55:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `email`, `fullname`) VALUES
('aisyah', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'sitiaisyah.saifulazhar@gmail.com', 'SITI AISYAH BINTI SAIFULAZHAR'),
('akmal02', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'akmal@gmail.com', 'akmal syazwen bin rosidi'),
('badrul76', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'bad@gmail.com', 'badrul hisyam bin nawi'),
('hani99', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'hani@gmail.com', 'hani rafiah binti saadon'),
('sabrina', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'sab04@gmail.com', 'sabrina binti daud'),
('suryati', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'suryati@gmail.com', 'suryati binti sulaiman'),
('syazwan', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'syaz@gmail.com', 'syazwan bin fairus');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_username` (`user_username`),
  ADD KEY `updated_by_admin` (`updated_by_admin`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `packageslots`
--
ALTER TABLE `packageslots`
  ADD PRIMARY KEY (`package_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `slots`
--
ALTER TABLE `slots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `packageslots`
--
ALTER TABLE `packageslots`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `slots`
--
ALTER TABLE `slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_username`) REFERENCES `users` (`username`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`updated_by_admin`) REFERENCES `admin` (`admin_id`) ON DELETE SET NULL;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `packageslots`
--
ALTER TABLE `packageslots`
  ADD CONSTRAINT `packageslots_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE;

--
-- Constraints for table `slots`
--
ALTER TABLE `slots`
  ADD CONSTRAINT `slots_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


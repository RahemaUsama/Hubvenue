-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2024 at 07:31 AM
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
-- Database: `hubvenue`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `b_id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `propertyId` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `check_in` time DEFAULT NULL,
  `check_out` time DEFAULT NULL,
  `paymentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `pay_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_info` varchar(255) DEFAULT NULL,
  `payment_image_url` varchar(255) DEFAULT NULL,
  `payment_status` enum('paid','pending','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `p_id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `property_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `amenities` longtext NOT NULL,
  `price` double NOT NULL,
  `status` enum('approved','pending','rejected') DEFAULT 'pending',
  `area` float DEFAULT NULL,
  `venue_type` varchar(255) DEFAULT NULL,
  `max_capacity` int(11) DEFAULT NULL,
  `pets_allowed` enum('allowed','not allowed') DEFAULT 'not allowed',
  `smoking_allowed` enum('allowed','not allowed') DEFAULT 'not allowed',
  `entrance_fee` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`p_id`, `userId`, `property_name`, `location`, `description`, `image`, `amenities`, `price`, `status`, `area`, `venue_type`, `max_capacity`, `pets_allowed`, `smoking_allowed`, `entrance_fee`) VALUES
(1, 1, 'The Residence', 'Ayala, Zamboanga City', 'A contemporary 2-bedroom, 1-bathroom home featuring Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt expedita molestiae natus ea minima vel, molestias quo architecto veniam autem! lorem ipsum dolor, sit amet.', 'https://i.ibb.co/yh8mqGX/beaach-house-12.jpg', '{\"1\": \"pool\", \"2\": \"basketball court\", \"3\": \"karaoke\"}', 1500, 'pending', 50, 'Resort', 10, '', '', 0.00),
(2, 1, 'The Kubo House', 'Tumaga, Zamboanga City', 'This charming 2-bedroom, 1-bathroom cottage offers Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt expedita molestiae natus ea minima vel, molestias quo architecto veniam autem! lorem ipsum dolor, sit amet.', 'https://i.ibb.co/fvtQfcr/beach-house-11.jpg', '{\"1\": \"pool\", \"2\": \"basketball court\", \"3\": \"karaoke\"}', 2500, 'pending', NULL, NULL, 10, '', '', 0.00),
(3, 1, 'Modern House', 'Tetuan, Zamboanga City', 'A spacious 3-bedroom, 2-bathroom home with an open Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt expedita molestiae natus ea minima vel, molestias quo architecto veniam autem! lorem ipsum dolor, sit amet.', 'https://i.ibb.co/V9zWk2K/beach-house-15.jpg', '{\"1\": \"pool\", \"2\": \"basketball court\", \"3\": \"karaoke\"}', 1500, 'pending', NULL, NULL, 10, 'allowed', 'allowed', 30.00),
(4, 1, 'The Camp', 'Lunzuran, Zamboanga City', 'A luxurious 4-bedroom, 3-bathroom townhouse boasting Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt expedita molestiae natus ea minima vel, molestias quo architecto veniam autem! lorem ipsum dolor, sit amet.', 'https://i.ibb.co/txznhzZ/beach-house-9.jpg', '{\"1\": \"pool\", \"2\": \"basketball court\", \"3\": \"karaoke\"}', 3000, 'pending', NULL, NULL, 10, '', '', 0.00),
(5, 1, 'The Goblin', 'Tugbungan, Zamboanga City', 'A beautifully designed 4-bedroom home with spacious Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt expedita molestiae natus ea minima vel, molestias quo architecto veniam autem! lorem ipsum dolor, sit amet.', 'https://i.ibb.co/CthFt4R/beach-house-2.jpg', '{\"1\": \"pool\", \"2\": \"basketball court\", \"3\": \"karaoke\"}', 2700, 'pending', NULL, NULL, 10, '', '', 0.00),
(6, 1, 'House of The Man', 'Sta.Maria, Zamboanga City', 'This cozy 3-bedroom, 2-bathroom bungalow offers a Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt expedita molestiae natus ea minima vel, molestias quo architecto veniam autem! lorem ipsum dolor, sit amet.', 'https://i.ibb.co/JCbG4Cp/beach-house-3.jpg', '{\"1\": \"pool\", \"2\": \"basketball court\", \"3\": \"karaoke\"}', 2200, 'pending', NULL, NULL, 10, '', '', 0.00),
(7, 1, 'Ang Balay', 'San Roque, Zamboanga City', 'Trendy 1-bedroom, 1-bathroom loft with floor-to-ce Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt expedita molestiae natus ea minima vel, molestias quo architecto veniam autem! lorem ipsum dolor, sit amet.', 'https://i.ibb.co/LkbsxcJ/beach-house-1.jpg', '{\"1\": \"pool\", \"2\": \"basketball court\", \"3\": \"karaoke\"}', 1500, 'pending', NULL, NULL, 10, '', '', 0.00),
(8, 1, 'Home of Menggols', 'Calarian, Zamboanga City', 'A stunning 5-bedroom, 3-bathroom home featuring a Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt expedita molestiae natus ea minima vel, molestias quo architecto veniam autem! lorem ipsum dolor, sit amet.', 'https://i.ibb.co/SsXwXd3/beach-house-13.jpg', '{\"1\": \"pool\", \"2\": \"basketball court\", \"3\": \"karaoke\"}', 4500, 'pending', NULL, NULL, 10, '', '', 0.00),
(9, 1, 'The House of Grey', 'Guiwan, Zamboanga City', 'Modern 2-bedroom, 2-bathroom condo with a sleek ki Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt expedita molestiae natus ea minima vel, molestias quo architecto veniam autem! lorem ipsum dolor, sit amet.', 'https://i.ibb.co/M9CdwLf/beach-house-4.jpg', '{\"1\": \"pool\", \"2\": \"basketball court\", \"3\": \"karaoke\"}', 3520, 'pending', NULL, NULL, 10, '', '', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `property_disabled`
--

CREATE TABLE `property_disabled` (
  `pd_id` int(11) NOT NULL,
  `propertyId` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `host_id` int(11) NOT NULL,
  `reviewer_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saved_properties`
--

CREATE TABLE `saved_properties` (
  `sp_id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `propertyId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `saved_properties`
--

INSERT INTO `saved_properties` (`sp_id`, `userId`, `propertyId`) VALUES
(1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `usertype` enum('client','user') NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic_url` varchar(255) DEFAULT NULL,
  `transaction_method` varchar(255) DEFAULT NULL,
  `transaction_details` varchar(255) DEFAULT NULL,
  `identification_card` varchar(255) DEFAULT NULL,
  `identification_card_image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `token` varchar(255) DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usertype`, `first_name`, `last_name`, `email`, `password`, `profile_pic_url`, `transaction_method`, `transaction_details`, `identification_card`, `identification_card_image_url`, `created_at`, `token`, `expires_at`) VALUES
(1, 'user', 'Rezier', 'Silver', 'ijasifasfhsai@ajsfioas.com', '$2y$10$dX5NI1bnzvefJOUCR4TdkekHMm6fMSuLs68x6lEZWmW50Hrbw4BIG', NULL, NULL, NULL, NULL, NULL, '2024-10-05 07:34:52', NULL, NULL),
(2, 'user', 'Joevin', 'Ansoc', 'joevinansoc870@gmail.com', '$2y$10$VY4MVc.STYMj1QDrW28R6OVzslL7WyHhW8FkNYXp7x13RDeqiixni', NULL, NULL, NULL, NULL, NULL, '2024-10-05 07:35:56', NULL, NULL),
(3, 'client', 'Rezier', 'John', 'JOHNMAGNO332@GMAIL.COM', '$2y$10$kHrhcXBBwC/ljPxDaNfBYOgIA9YBZaX0AP9orGijXu.sH7egO17zK', NULL, NULL, NULL, NULL, NULL, '2024-10-05 09:48:38', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`b_id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `propertyId` (`propertyId`),
  ADD KEY `paymentId` (`paymentId`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `property_disabled`
--
ALTER TABLE `property_disabled`
  ADD PRIMARY KEY (`pd_id`),
  ADD KEY `propertyId` (`propertyId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `host_id` (`host_id`),
  ADD KEY `reviewer_id` (`reviewer_id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `saved_properties`
--
ALTER TABLE `saved_properties`
  ADD PRIMARY KEY (`sp_id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `propertyId` (`propertyId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `property_disabled`
--
ALTER TABLE `property_disabled`
  MODIFY `pd_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `saved_properties`
--
ALTER TABLE `saved_properties`
  MODIFY `sp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`propertyId`) REFERENCES `properties` (`p_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`paymentId`) REFERENCES `payments` (`pay_id`) ON DELETE CASCADE;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `property_disabled`
--
ALTER TABLE `property_disabled`
  ADD CONSTRAINT `property_disabled_ibfk_1` FOREIGN KEY (`propertyId`) REFERENCES `properties` (`p_id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`host_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`reviewer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_3` FOREIGN KEY (`property_id`) REFERENCES `properties` (`p_id`) ON DELETE CASCADE;

--
-- Constraints for table `saved_properties`
--
ALTER TABLE `saved_properties`
  ADD CONSTRAINT `saved_properties_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `saved_properties_ibfk_2` FOREIGN KEY (`propertyId`) REFERENCES `properties` (`p_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

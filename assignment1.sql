-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 16, 2024 at 04:18 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment1`
--

-- --------------------------------------------------------

--
-- Table structure for table `auction`
--

CREATE TABLE `auction` (
  `auction_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `categoryId` int NOT NULL,
  `endDate` date DEFAULT NULL,
  `userId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `auction`
--

-- Insert Auction Data (3 auctions per category, spread across 5 categories)
INSERT INTO `auction` (`auction_id`, `title`, `description`, `image`, `categoryId`, `endDate`, `userId`) VALUES

(1, 'BMW 5 Series', 'A luxury estate car', 'car.png', 1, '2024-12-25', 1),
(2, 'Audi A6 Avant', 'A reliable family car', 'car.png', 1, '2024-12-28', 2),
(3, 'Mercedes-Benz E-Class Estate', 'Elegant and spacious', 'car.png', 1, '2024-12-30', 1),
(4, 'Tesla Model 3', 'The future of driving', 'car.png', 2, '2024-12-27', 2),
(5, 'Nissan Leaf', 'Efficient and eco-friendly', 'car.png', 2, '2024-12-22', 1),
(6, 'BMW i3', 'Compact and sustainable', 'car.png', 2, '2024-12-25', 2),
(7, 'Chevrolet Camaro', 'Classic American muscle', 'car.png', 3, '2024-12-23', 1),
(8, 'Ford Mustang', 'Iconic sports coupe', 'car.png', 3, '2024-12-30', 2),
(9, 'BMW 4 Series', 'Stylish and sporty', 'car.png', 3, '2024-12-28', 1),
(10, 'Toyota Camry', 'A reliable family sedan', 'astonn.png', 4, '2024-12-26', 2),
(11, 'Honda Accord', 'Comfort and performance', 'car.png', 4, '2024-12-23', 1),
(12, 'BMW 3 Series', 'Sporty and elegant', 'car.png', 4, '2024-12-29', 2),
(13, 'Jeep Wrangler', 'Tough and adventurous', 'car.png', 5, '2024-12-30', 1),
(14, 'Toyota Land Cruiser', 'Rugged and reliable', 'car.png', 5, '2024-12-28', 2),
(15, 'Range Rover Sport', 'Luxury meets off-road', 'car.png', 5, '2024-12-29', 1),
(16, 'Porsche 911', 'A true icon in the sports car world', 'car.png', 3, '2024-12-30', 3),
(17, 'Tesla Model X', 'A luxurious electric SUV', 'car.png', 5, '2024-12-29', 3),
(18, 'Jaguar F-Type', 'Elegant and powerful coupe', 'car.png', 3, '2024-12-31', 3);


-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

CREATE TABLE `bid` (
  `bid_id` int NOT NULL,
  `bid` int NOT NULL,
  `auctionId` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------
-- Inserting Bids for Auctions (from Users 1, 2, and 3)
INSERT INTO `bid` (`bid_id`, `bid`, `auctionId`, `user_id`) VALUES
(1, 20000, 1, 1), -- User 1 bids on BMW 5 Series
(2, 25000, 2, 2), -- User 2 bids on Audi A6 Avant
(3, 21000, 3, 1), -- User 1 bids on Mercedes-Benz E-Class Estate
(4, 30000, 4, 2), -- User 2 bids on Tesla Model 3
(5, 22000, 5, 1), -- User 1 bids on Nissan Leaf
(6, 33000, 6, 2), -- User 2 bids on BMW i3
(7, 24000, 7, 3), -- User 3 bids on Chevrolet Camaro
(8, 27000, 8, 1), -- User 1 bids on Ford Mustang
(9, 23000, 9, 2), -- User 2 bids on BMW 4 Series
(10, 35000, 10, 1), -- User 1 bids on Toyota Camry
(11, 28000, 11, 3), -- User 3 bids on Honda Accord
(12, 32000, 12, 2), -- User 2 bids on BMW 3 Series
(13, 33000, 13, 3), -- User 3 bids on Jeep Wrangler
(14, 31000, 14, 1), -- User 1 bids on Toyota Land Cruiser
(15, 34000, 15, 2); -- User 2 bids on Range Rover Sport
--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

-- Insert Category Data
INSERT INTO `category` (`category_id`, `name`) VALUES
(1, 'Estate'),
(2, 'Electric'),
(3, 'Coupe'),
(4, 'Saloon'),
(5, 'SUV');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int NOT NULL,
  `reviewtext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` date NOT NULL,
  `user_id` int NOT NULL,
  `author_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$12$17.iFWArCqBgbODKLzNa0.3gXBmZSuTMDVDZpCFtMAdKcZHirWivq', 'admin'),
(2, 'user', 'user@user.com', '$2y$12$GNlcqGqy7QmR7Q3EkLY/qednup3CGCTJs9UCh5r0pnOHryo0FzLBS', 'user'),
(3, 'sandesh', 'sandesh@user.com', '$2y$10$CQzY/GQlcR9x.AgNl/jXvecp0Fe7pELtO2gqzaZWEdcvzYD/f2JBy', 'user');

--
-- Indexes for dumped tables
--
-- Inserting User Reviews (User reviews about other users' interactions)
INSERT INTO `review` (`review_id`, `reviewtext`, `date`, `user_id`, `author_id`) VALUES
(1, 'Great user! Very reliable and quick to respond.', '2024-12-19', 2, 1),
(2, 'Had a smooth transaction with this user, highly recommended.', '2024-12-19', 1, 2),
(3, 'Very communicative and honest. A pleasure to deal with.', '2024-12-19', 2, 1),
(4, 'The auction was easy to follow, and the user was respectful throughout.', '2024-12-19', 1, 2),
(5, 'A great experience with this user. Quick responses and fair bidding.', '2024-12-19', 2, 1),
(6, 'Smooth process and very easy to deal with. Would bid again!', '2024-12-19', 3, 1),
(7, 'Prompt replies and professional. Would definitely recommend.', '2024-12-19', 1, 3),
(8, 'Very honest and transparent throughout the auction. A trustworthy user.', '2024-12-19', 3, 2),
(9, 'A pleasant experience, fast and efficient. Great interaction!', '2024-12-19', 2, 3),
(10, 'User was very responsive and easy to work with. Great experience.', '2024-12-19', 3, 1);

-- Indexes for table `auction`
--
ALTER TABLE `auction`
  ADD PRIMARY KEY (`auction_id`),
  ADD KEY `auctions_category_id_foreign` (`categoryId`),
  ADD KEY `auctions_user_id_foreign` (`userId`);

--
-- Indexes for table `bid`
--
ALTER TABLE `bid`
  ADD PRIMARY KEY (`bid_id`),
  ADD KEY `bid_auction_id_foreign` (`auctionId`),
  ADD KEY `bid_user_id_foreign` (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `review_user_id_foreign` (`user_id`),
  ADD KEY `review_author_id_foreign` (`author_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auction`
--
ALTER TABLE `auction`
  MODIFY `auction_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bid`
--
ALTER TABLE `bid`
  MODIFY `bid_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auction`
--
ALTER TABLE `auction`
  ADD CONSTRAINT `auctions_category_id_foreign` FOREIGN KEY (`categoryId`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `auctions_user_id_foreign` FOREIGN KEY (`userId`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `bid`
--
ALTER TABLE `bid`
  ADD CONSTRAINT `bid_auction_id_foreign` FOREIGN KEY (`auctionId`) REFERENCES `auction` (`auction_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `bid_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `review_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

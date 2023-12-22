-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 22, 2023 at 05:09 PM
-- Server version: 8.0.35-0ubuntu0.20.04.1
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `age` int NOT NULL,
  `profession` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `age`, `profession`, `address`, `password`, `user_type`) VALUES
(15, 'fasahat', 'khan', 'fasahatkhan52@gmail.com', 24, 'Admin', 'abc lane, abc street, abc road', '12345', 2),
(19, 'Henry', 'Cavil', 'hc@gmail.com', 36, 'Actor', 'abc lane, abc road, street abc', '12345678', 1),
(21, 'Mike', 'Tyson', 'mt@gmail.com', 54, 'Boxer', 'abc lane, abc road, street abc', '12345678', 1),
(24, 'Brad', 'Pitt', 'bp@gmail.com', 55, 'Actor', 'abc lane, abc road, street abc', '12345678', 1),
(35, 'Adam', 'Lambard', 'al@gmail.com', 45, 'Singer', 'abc lane', '12345678', 1),
(36, 'Marshall', 'Law', 'ml@gmail.com', 45, 'Singer', 'abc lane', '12345678', 1),
(37, 'paul', 'rudd', 'parud@gmail.com', 45, 'Singer', 'abc lane', '12345678', 1),
(38, 'fred', 'durst', 'fd@gmail.com', 45, 'Singer', 'abc lane', '12345678', 1),
(39, 'Adam', 'Lambard', 'al@gmail.com', 45, 'Singer', 'abc lane', '12345678', 1),
(40, 'Marshall', 'Law', 'ml@gmail.com', 45, 'Singer', 'abc lane', '12345678', 1),
(41, 'paul', 'rudd', 'parud@gmail.com', 45, 'Singer', 'abc lane', '12345678', 1),
(42, 'fred', 'durst', 'fd@gmail.com', 45, 'Singer', 'abc lane', '12345678', 1),
(43, 'Adam', 'Lambard', 'al@gmail.com', 45, 'Singer', 'abc lane', '12345678', 1),
(47, 'Adam', 'Lambard', 'al@gmail.com', 45, 'Singer', 'abc lane', '12345678', 1),
(48, 'Marshall', 'Law', 'ml@gmail.com', 45, 'Singer', 'abc lane', '12345678', 1),
(49, 'paul', 'rudd', 'parud@gmail.com', 45, 'Singer', 'abc lane', '12345678', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

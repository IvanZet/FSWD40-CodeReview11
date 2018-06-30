-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2018 at 04:58 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cr11_ivan_zykov_php_car_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `car_id` int(11) NOT NULL,
  `brand` varchar(20) DEFAULT NULL,
  `model` varchar(20) DEFAULT NULL,
  `fk_office_id` int(11) DEFAULT NULL,
  `img` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `brand`, `model`, `fk_office_id`, `img`) VALUES
(1, 'Fiat', '500', 1, NULL),
(2, 'Mitsubishi', 'Lancer', 2, NULL),
(3, 'Honda', 'Accord', 3, NULL),
(4, 'Audi', 'A6', 4, NULL),
(5, 'Toyota', 'FJ Cruiser', 1, NULL),
(6, 'Nissan', 'GT-R', 2, NULL),
(7, 'Lada', 'Vesta', NULL, NULL),
(8, 'Renault', 'Laguna', NULL, NULL),
(9, 'BMW', '3', NULL, NULL),
(10, 'Opel', 'Insignia', NULL, NULL),
(11, 'Ford', 'Mondeo', NULL, NULL),
(12, 'Peugeot', '308', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cars_positions`
--

CREATE TABLE `cars_positions` (
  `position_id` int(11) NOT NULL,
  `fk_car_id` int(11) DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cars_positions`
--

INSERT INTO `cars_positions` (`position_id`, `fk_car_id`, `latitude`, `longitude`) VALUES
(1, 1, 48.2191, 16.367),
(2, 2, 48.1968, 16.335),
(3, 3, 48.2023, 16.3623),
(4, 4, 48.2193, 16.3528),
(5, 5, 48.2191, 16.367),
(6, 6, 48.1968, 16.335);

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `office_id` int(11) NOT NULL,
  `street` varchar(30) DEFAULT NULL,
  `house` smallint(5) UNSIGNED DEFAULT NULL,
  `postal_code` mediumint(8) UNSIGNED DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`office_id`, `street`, `house`, `postal_code`, `latitude`, `longitude`) VALUES
(1, 'Oskar-Morgenstern-Pl', 1, 1010, 48.2191, 16.367),
(2, 'Felberstrasse', 3, 1150, 48.1968, 16.335),
(3, 'Getreidemarkt', 18, 1010, 48.2023, 16.3623),
(4, 'Sensengasse', 2, 1090, 48.2193, 16.3528);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `pass`, `is_admin`) VALUES
(1, 'Ivan', 'Zet', 'user@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 0),
(2, 'Ivan', 'Zet', 'admin@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `fk_office_id` (`fk_office_id`);

--
-- Indexes for table `cars_positions`
--
ALTER TABLE `cars_positions`
  ADD PRIMARY KEY (`position_id`),
  ADD KEY `fk_car_id` (`fk_car_id`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`office_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cars_positions`
--
ALTER TABLE `cars_positions`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `office_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`fk_office_id`) REFERENCES `offices` (`office_id`);

--
-- Constraints for table `cars_positions`
--
ALTER TABLE `cars_positions`
  ADD CONSTRAINT `cars_positions_ibfk_1` FOREIGN KEY (`fk_car_id`) REFERENCES `cars` (`car_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

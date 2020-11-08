-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 13, 2020 at 11:13 AM
-- Server version: 5.7.24
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodshala`
--

-- --------------------------------------------------------

--
-- Table structure for table `food_item`
--

DROP TABLE IF EXISTS `food_item`;
CREATE TABLE IF NOT EXISTS `food_item` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `image` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `offer_price` int(10) NOT NULL DEFAULT '0',
  `details` text NOT NULL,
  `food_type` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_item`
--

INSERT INTO `food_item` (`id`, `name`, `image`, `price`, `offer_price`, `details`, `food_type`, `status`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Masala Dosa', '1602572666.png', 120, 110, '', 'veg', 1, '2020-10-13 07:04:26', '2020-10-13 07:04:26', 4),
(2, 'Masala idli', '1602573370.jpg', 70, 0, '', 'veg', 1, '2020-10-13 07:16:10', '2020-10-13 07:16:10', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `food_item_id` int(20) NOT NULL,
  `status` int(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `food_item_id`, `status`, `created_at`, `updated_at`, `price`) VALUES
(1, 1, 1, 1, '2020-10-13 10:56:14', '2020-10-13 10:56:14', 110),
(2, 1, 1, 1, '2020-10-13 10:58:20', '2020-10-13 10:58:20', 110),
(3, 1, 2, 1, '2020-10-13 10:58:35', '2020-10-13 10:58:35', 70);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_type` int(2) NOT NULL DEFAULT '1',
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(2) NOT NULL DEFAULT '1',
  `name` varchar(200) NOT NULL,
  `food_type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `email`, `password`, `created_at`, `updated_at`, `status`, `name`, `food_type`) VALUES
(1, 1, 'partha@gmail.com', '$argon2id$v=19$m=1024,t=2,p=2$dmxONnVvSzVGZVRNL2V5Ug$MC6jwtkINCyPolyc9RKUT0Xv5QDo7S0n+193Z/2t314', '2020-10-12 17:45:24', '2020-10-12 17:45:25', 1, 'partha', 'veg'),
(2, 1, 'partha12@gmail.com', '$argon2id$v=19$m=1024,t=2,p=2$dmxONnVvSzVGZVRNL2V5Ug$MC6jwtkINCyPolyc9RKUT0Xv5QDo7S0n+193Z/2t314', '2020-10-12 17:51:12', '2020-10-12 17:51:12', 1, 'partha biswas', 'nonveg'),
(3, 2, 'panjabini8t@gmail.com', '$argon2id$v=19$m=1024,t=2,p=2$dmxONnVvSzVGZVRNL2V5Ug$MC6jwtkINCyPolyc9RKUT0Xv5QDo7S0n+193Z/2t314', '2020-10-12 18:00:27', '2020-10-12 18:00:27', 1, 'New Panjabi ni8t', ''),
(4, 2, 'paramsfood@gmail.com', '$argon2id$v=19$m=1024,t=2,p=2$dmxONnVvSzVGZVRNL2V5Ug$MC6jwtkINCyPolyc9RKUT0Xv5QDo7S0n+193Z/2t314', '2020-10-12 18:13:18', '2020-10-12 18:13:18', 1, 'Params Food Club', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

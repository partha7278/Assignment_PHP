-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 08, 2020 at 12:54 PM
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
-- Database: `cache_service`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Dr. Royce Anderson', 'ischroeder@hotmail.com', 'd2f894a87c63d4c6c4219159bb6d64c3', '2012-10-29 00:07:13', '2012-10-29 00:07:13'),
(2, 'Lavern Gutmann', 'eva.bergnaum@hotmail.com', '9471781d7177195c344a9764eafe20ab', '1990-06-24 20:29:23', '1990-06-24 20:29:23'),
(3, 'Timmothy Sauer', 'lang.hailie@hotmail.com', '6ca99161d94abb94fff359b912740c89', '2003-04-21 23:31:43', '2003-04-21 23:31:43'),
(4, 'Miss Mozelle Hermiston III', 'weimann.arlo@hotmail.com', 'e661cba76fa2443e67fc2f23cb800a55', '2002-11-18 15:15:29', '2002-11-18 15:15:29'),
(5, 'Claudie Ziemann II', 'rogahn.ludie@yahoo.com', 'f707bec164bc56dbe9d7dade684f5876', '1973-08-12 17:52:03', '1973-08-12 17:52:03'),
(6, 'Jerel Dare', 'brady.tremblay@ankunding.com', '53855a876830a59470b4183382c25030', '1978-04-03 06:20:36', '1978-04-03 06:20:36'),
(7, 'Dr. Newton Will DDS', 'sokeefe@tillman.com', '0541ddb41f9532db0f06e9bc787d88b6', '2005-06-24 09:29:59', '2005-06-24 09:29:59'),
(8, 'Dr. Caden Lehner V', 'molly.bogisich@yahoo.com', 'af15bae1dbab592c7d002324f1b187ab', '2001-09-03 06:01:41', '2001-09-03 06:01:41'),
(9, 'Prof. Tiffany Corwin Jr.', 'desmond.turcotte@hotmail.com', '390793872b7ef0b22edd1226470ac59a', '1971-03-01 14:00:58', '1971-03-01 14:00:58'),
(10, 'Noe Miller', 'kirk.effertz@leffler.biz', '619e4a8930b1103c0b599db65b03cd10', '1991-11-21 00:25:10', '1991-11-21 00:25:10'),
(11, 'Junius Ankunding', 'wilmer44@hotmail.com', '0566700724476c6daf49f0e642e878e8', '2015-02-07 21:32:49', '2015-02-07 21:32:49'),
(12, 'Raegan Windler', 'kessler.wyatt@gmail.com', 'da6d37dab1fd73e8ae75233aef2f96a8', '1993-01-02 23:02:20', '1993-01-02 23:02:20'),
(13, 'Sierra Gorczany', 'ycronin@yahoo.com', '7f1799ba5e7996ef8db09c581a186950', '1988-01-15 12:30:59', '1988-01-15 12:30:59'),
(14, 'Kellen Trantow', 'atorphy@gmail.com', '936083ae4d5a9064d16bb39a64ca5e9b', '2015-04-02 18:35:23', '2015-04-02 18:35:23'),
(15, 'Heaven Blanda', 'eosinski@gmail.com', '369532461745766074dd319143096c59', '1982-11-14 11:40:22', '1982-11-14 11:40:22'),
(16, 'Prof. Aurelio Emmerich', 'hammes.pinkie@nikolaus.net', 'e8ea3c74601f3c4410027f9c8f9ceaca', '2013-12-21 13:19:16', '2013-12-21 13:19:16'),
(17, 'Mr. Jacinto Bins DVM', 'bernier.mohammed@fay.biz', '6d46ea63e450107ebb60a2f075d338e0', '2013-01-18 06:28:28', '2013-01-18 06:28:28'),
(18, 'Emmet Kautzer', 'hwilkinson@conn.com', 'acf232e7a2e51611b94c3b0fde764f21', '1986-11-20 11:18:17', '1986-11-20 11:18:17'),
(19, 'Karlee Pfannerstill', 'carmela15@russel.com', '71586019fe963c27de6b214daebc413b', '2003-04-07 16:17:51', '2003-04-07 16:17:51'),
(20, 'Jillian Maggio', 'billie.lakin@stiedemann.com', '353e77718cabeb4fd80fac94f72727f5', '1979-03-16 10:17:01', '1979-03-16 10:17:01'),
(21, 'Prof. Ansel Marvin V', 'justine12@gleichner.com', '17a5c48d92d79d2571747bf3da9589cd', '1986-12-10 02:34:58', '1986-12-10 02:34:58'),
(22, 'Miss Trycia Lebsack DVM', 'metz.jerome@corkery.info', '92af270cb0bb47c9a622b2e79e8ad37e', '2006-10-06 19:38:18', '2006-10-06 19:38:18'),
(23, 'Viola Beer', 'alexane.kub@yahoo.com', 'b0d19a7f8579dd86fb7c85d9e5cb19bc', '1985-02-15 02:42:32', '1985-02-15 02:42:32'),
(24, 'Daija Sanford', 'tprohaska@gmail.com', 'cb3726e7a88105003b85570170cf251d', '1993-08-05 11:56:18', '1993-08-05 11:56:18'),
(25, 'Raphael Rosenbaum II', 'lilyan87@luettgen.org', '7e23ce7eb9034342eeb93c2d475d1708', '2007-03-18 08:21:50', '2007-03-18 08:21:50'),
(26, 'Ned Bernhard', 'lou.paucek@collier.com', '500b80ad21d929b301af7e95306e1491', '2003-06-17 00:46:14', '2003-06-17 00:46:14'),
(27, 'Ayla Carter', 'hane.antone@gmail.com', '9b9f4a628a713f2ad090dcf055ab9e04', '2017-07-31 10:25:14', '2017-07-31 10:25:14'),
(28, 'Autumn Keeling', 'dan.mohr@hotmail.com', '1821f6a471e4f711428db076e37a58a4', '1995-11-12 16:18:00', '1995-11-12 16:18:00'),
(29, 'Barney Hessel', 'lindgren.robb@thiel.com', '904f64f6d7b1bd8e03fd769ab8548592', '2007-06-02 13:47:49', '2007-06-02 13:47:49'),
(30, 'Ima Runolfsson', 'wilmer22@gmail.com', '1242e5cbd398f5694d5e7bd591da6f1c', '1982-05-23 23:08:24', '1982-05-23 23:08:24'),
(31, 'Ramona Rau', 'deborah95@hotmail.com', '2a90d48e9ca9ade3b93f881e65cf3163', '1991-01-19 08:21:38', '1991-01-19 08:21:38'),
(32, 'Marianne Murazik', 'jboyle@gmail.com', '3d8a3530348156a7a054b4d420651eed', '1982-08-26 10:38:52', '1982-08-26 10:38:52'),
(33, 'Prof. Rodolfo Christiansen', 'jackson.tillman@skiles.org', '8551f513197f6a6a2c786c78959cfe15', '1996-07-23 10:42:02', '1996-07-23 10:42:02'),
(34, 'Mr. Vidal Prohaska IV', 'kub.eunice@yahoo.com', '85208de6adba9d162dc448c754685b91', '1996-04-09 23:11:01', '1996-04-09 23:11:01'),
(35, 'Assunta Abshire DDS', 'avis56@gmail.com', 'e6ecfc60476e269d355dad1f9689d9e6', '1971-10-27 17:38:23', '1971-10-27 17:38:23'),
(36, 'Lorenz Witting', 'lilla.hoppe@yahoo.com', 'de7c727d7ac96b51b950a3951175f927', '2001-12-19 00:56:23', '2001-12-19 00:56:23'),
(37, 'Maritza Beier', 'lehner.ruth@leuschke.com', 'ca3b8d49aea37fd526e07889648cee78', '1996-09-15 08:32:23', '1996-09-15 08:32:23'),
(38, 'Dr. Shane Bartoletti', 'jaylon37@schuppe.com', '6465dad6994beeea3e578204f8627676', '1993-05-28 22:22:42', '1993-05-28 22:22:42'),
(39, 'Kirstin Hodkiewicz', 'larson.emilia@bayer.org', 'd0de1bef6157a7206ddcaa9267bf3274', '1973-10-11 00:10:38', '1973-10-11 00:10:38'),
(40, 'Mrs. Annie Schulist PhD', 'anthony.bechtelar@stamm.info', 'e6c47109c7cfa98af64260ed9617126f', '1972-07-31 06:46:54', '1972-07-31 06:46:54'),
(41, 'Jonathan Rempel I', 'hartmann.cheyenne@balistreri.net', 'f57baa8e5c19a61f4b67bfb676d93191', '1973-01-07 13:04:02', '1973-01-07 13:04:02'),
(42, 'Dr. Jaylon Rau II', 'hector02@hotmail.com', '4b1e5adb318e58f9081c8d4c41b0ba60', '2011-01-09 08:25:12', '2011-01-09 08:25:12'),
(43, 'Dr. Walter Pfeffer DDS', 'hmorar@gmail.com', '6409a43efc084fdd8b2cc87bd0a381ca', '1995-04-02 16:34:38', '1995-04-02 16:34:38'),
(44, 'Brycen King', 'marilyne25@gmail.com', '3f4bc97ffc965183bceac089d5ce4be5', '1991-09-07 22:58:51', '1991-09-07 22:58:51'),
(45, 'Clarabelle Lind', 'hagenes.morton@hudson.org', '44e30dc18bc3b2c99f4d7b380fc42434', '2019-06-09 21:49:25', '2019-06-09 21:49:25'),
(46, 'Prof. Maynard Beer', 'demard@yahoo.com', '984764c2498a4c316d2d508bc6b183f1', '2000-04-05 10:46:49', '2000-04-05 10:46:49'),
(47, 'Hilton Crona I', 'lang.amanda@hotmail.com', 'a4299b4291de52e4d6bd5166173236c7', '2007-03-22 13:42:53', '2007-03-22 13:42:53'),
(48, 'Ruby Durgan DVM', 'birdie42@toy.com', '7b4b9fc4c0eab58319f35d4143fbc238', '2009-04-08 09:59:34', '2009-04-08 09:59:34'),
(49, 'Eli O\'Conner', 'zkozey@yahoo.com', '36618f121aca6ab7eb6e43d1d45e03b1', '2005-06-09 15:54:03', '2005-06-09 15:54:03'),
(50, 'Madison Oberbrunner', 'nicole32@yahoo.com', '3a80398a8cb6cddbde694675d35d1a3c', '2002-11-26 19:08:25', '2002-11-26 19:08:25');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

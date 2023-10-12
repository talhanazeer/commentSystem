-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 12, 2023 at 08:02 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comments_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `start_id` int NOT NULL,
  `parent_id` int NOT NULL,
  `AuthorName` varchar(255) COLLATE utf8mb3_unicode_520_ci DEFAULT NULL,
  `AuthorEmail` varchar(512) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_520_ci DEFAULT NULL,
  `CommentText` text COLLATE utf8mb3_unicode_520_ci,
  `CommentDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_520_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `start_id`, `parent_id`, `AuthorName`, `AuthorEmail`, `CommentText`, `CommentDate`) VALUES
(1, 0, 0, 'Talha', 'talhanazeer91m@gamil.com', 'test', '2023-10-12 23:13:39'),
(2, 0, 0, 'binod', 'binod@gmail.com', 'test2', '2023-10-12 23:13:52'),
(3, 2, 2, 'test2', 'test@gmail.com', 'testinner', '2023-10-12 23:14:40'),
(4, 2, 3, 'test3', 'talhanazeer91m@gamil.com', 'test3', '2023-10-12 23:25:20'),
(5, 2, 4, 'test3rep', 'talhanazeer91m@gamil.com', 'test3rep', '2023-10-12 23:50:24'),
(6, 2, 3, 'test2rep', 'talhanazeer91m@gamil.com', 'test2rep', '2023-10-12 23:51:44'),
(7, 2, 5, 'test4', 'talhanazeer91m@gamil.com', 'test4', '2023-10-13 00:10:33'),
(8, 1, 1, 'test6', 'talhanazeer91m@gamil.com', 'test6', '2023-10-13 00:11:08'),
(9, 1, 1, 'test7', 'talhanazeer91m@gamil.com', 'test7', '2023-10-13 00:11:25'),
(10, 2, 5, 'test8', 'talhanazeer91m@gamil.com', 'test8', '2023-10-13 00:17:51'),
(11, 2, 5, 'test9', 'talhanazeer91m@gamil.com', 'test9', '2023-10-13 00:18:09'),
(12, 1, 1, 'Talha', 'talhanazeer91m@gamil.com', 'replying to talha', '2023-10-13 00:32:10'),
(13, 1, 12, 'Talha', 'talhanazeer91m@gamil.com', 'replying to talha talha', '2023-10-13 00:32:27'),
(14, 1, 12, 'binod', 'binod@gmail.com', 'replying to talha talha', '2023-10-13 00:32:48');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

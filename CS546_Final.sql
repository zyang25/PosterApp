-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Nov 24, 2015 at 09:48 PM
-- Server version: 5.6.24
-- PHP Version: 5.5.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CS546_Final`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `activity_id` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `user_id` bigint(20) NOT NULL COMMENT 'foreign_key',
  `category_id` int(11) NOT NULL COMMENT 'foreign_key',
  `followers` int(11) NOT NULL,
  `max_followers` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `state` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`activity_id`, `start_time`, `location`, `description`, `image`, `user_id`, `category_id`, `followers`, `max_followers`, `title`, `state`) VALUES
(2, '1900-01-01 00:00:00', 'babbio', 'eat', 'upload later', 1, 1, 1, 20, 'for fun', 0),
(3, '1900-01-01 00:00:00', 'babbio center', 'cijjcvj', 'upload later', 1, 1, 0, 20, 'happy to eat', 0),
(4, '1900-01-01 00:00:00', 'babbio center', 'cijcijcncncncncnncncn', 'upload later', 1, 1, 0, 20, 'happy to eat', 0),
(5, '1900-01-01 00:00:00', 'babbio center', '', 'upload later', 1, 1, 0, 20, 'happy to eat', 0),
(6, '1900-01-01 00:00:00', 'babbio center', 'jsdigjioasdjgoiasdjgio', 'upload later', 1, 1, 0, 20, 'happy to eat', 0),
(7, '1900-01-01 00:00:00', 'babbio center', '', 'upload later', 1, 1, 1, 20, 'happy to eat', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(32) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `following`
--

CREATE TABLE `following` (
  `activity_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `follow_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `user_id` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_activated` tinyint(1) NOT NULL DEFAULT '0',
  `post_number` int(11) NOT NULL,
  `salt` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`user_id`, `email`, `password`, `is_admin`, `is_activated`, `post_number`, `salt`) VALUES
(174, 'zyang25@stevens.edu', '$2a$10$fZsJIHB.r0zq/Z5leSlVHeQFkuzXzKjXokfJsAZx28Tl3dkZAOgjG', 0, 0, 0, '$2a$10$fZsJIHB.r0zq/Z5leSlVHg=='),
(175, '123@stevens.edu', '$2a$10$DXnPXxryVhE8PTvt.B5KwOwCn.xspOi7r141kTzKHV25EYp2U0MG.', 0, 0, 0, '$2a$10$DXnPXxryVhE8PTvt.B5KwQ==');

-- --------------------------------------------------------

--
-- Table structure for table `User_activation`
--

CREATE TABLE `User_activation` (
  `user_id` bigint(20) NOT NULL,
  `activation_key` varchar(50) NOT NULL,
  `expire` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `User_Info`
--

CREATE TABLE `User_Info` (
  `user_id` bigint(20) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `register_date` date DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `tel` varchar(15) DEFAULT NULL,
  `zip` varchar(5) DEFAULT NULL,
  `preference` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `following`
--
ALTER TABLE `following`
  ADD PRIMARY KEY (`activity_id`,`user_id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indexes for table `User_activation`
--
ALTER TABLE `User_activation`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `User_Info`
--
ALTER TABLE `User_Info`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `User_activation`
--
ALTER TABLE `User_activation`
  ADD CONSTRAINT `User_activation_User` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `User_Info`
--
ALTER TABLE `User_Info`
  ADD CONSTRAINT `User_Info_User` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

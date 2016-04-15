-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2016 at 10:39 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbstory`
--

-- --------------------------------------------------------

--
-- Table structure for table `schema_migrations`
--

CREATE TABLE IF NOT EXISTS `schema_migrations` (
  `version` varchar(255) NOT NULL,
  UNIQUE KEY `unique_schema_migrations` (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schema_migrations`
--

INSERT INTO `schema_migrations` (`version`) VALUES
('20160330212249');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `ip_registered` varchar(25) NOT NULL,
  `ip_last` varchar(25) NOT NULL,
  `pwd` varchar(25) NOT NULL,
  `date_registered` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `confirmed` tinyint(1) NOT NULL,
  `image` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('m','f','t','u') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `ip_registered`, `ip_last`, `pwd`, `date_registered`, `confirmed`, `image`, `dob`, `gender`) VALUES
(1, 'joe@yahoo.com', 'joe', '', '', 'asdfasfd', '2016-04-15 13:28:41', 0, '', '0000-00-00', 'm'),
(2, 'joe2@yahoo.com', 'joe2', '', '', 'asdfasfd', '2016-04-15 13:30:59', 0, '', '0000-00-00', 'm'),
(3, 'joe4@yahoo.com', 'joe4', '', '', 'asdfasfd', '2016-04-15 13:33:13', 0, '', '0000-00-00', 'm'),
(4, 'joe5@yahoo.com', 'joe5', '', '', 'asdfasfd', '2016-04-15 13:36:32', 0, '', '0000-00-00', 'm'),
(5, 'joe6@yahoo.com', 'joe6', '', '', 'asdfasfd', '2016-04-15 13:44:31', 0, '', '0000-00-00', 'm');

-- --------------------------------------------------------

--
-- Table structure for table `users_email_confirmation`
--

CREATE TABLE IF NOT EXISTS `users_email_confirmation` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(10) NOT NULL,
  `confirmation_code` varchar(100) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

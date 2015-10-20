-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 01, 2014 at 10:03 PM
-- Server version: 5.5.35
-- PHP Version: 5.3.10-1ubuntu3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `linkpreview`
--

-- --------------------------------------------------------

--
-- Table structure for table `linkpreview`
--

CREATE TABLE IF NOT EXISTS `linkpreview` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `image` text NOT NULL,
  `title` text NOT NULL,
  `canonicalUrl` varchar(300) NOT NULL,
  `url` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `iframe` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `linkpreview`
--

INSERT INTO `linkpreview` (`id`, `text`, `image`, `title`, `canonicalUrl`, `url`, `description`, `iframe`) VALUES
(1, 'Visit leocardz.com and buy me a coffee at http://leocardz.com/donate/ if you can afford it! :D', 'http://leocardz.com/util/assets/images/lc.png', 'LeoCardz', 'leocardz.com', 'http://leocardz.com', 'Everything about tech news, tutorials, development, projects, programming. Everything about tech news, tutorials, development, projects, programming.', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

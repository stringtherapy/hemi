-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 27, 2020 at 09:52 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hemi`
--
CREATE DATABASE IF NOT EXISTS `hemi` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hemi`;

-- --------------------------------------------------------

--
-- Table structure for table `chathistory`
--

DROP TABLE IF EXISTS `chathistory`;
CREATE TABLE IF NOT EXISTS `chathistory` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `message` varchar(350) NOT NULL,
  `time` varchar(40) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chathistory`
--

INSERT INTO `chathistory` (`ID`, `name`, `message`, `time`) VALUES
(1, '', 'Test: The quick brown fox jumps over the lazy dog', '<i><font color=yellow>welcome</font></i>');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
CREATE TABLE IF NOT EXISTS `friends` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `private_servers`
--

DROP TABLE IF EXISTS `private_servers`;
CREATE TABLE IF NOT EXISTS `private_servers` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `server_name` varchar(40) NOT NULL,
  `lobby_key` varchar(140) NOT NULL,
  `password` varchar(40) DEFAULT NULL,
  `time` varchar(40) NOT NULL,
  `profanity` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

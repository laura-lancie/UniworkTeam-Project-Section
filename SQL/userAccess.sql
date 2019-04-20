-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 20, 2019 at 03:29 PM
-- Server version: 5.5.58-0+deb7u1-log
-- PHP Version: 5.6.31-1~dotdeb+7.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `unn_w18025112`
--

-- --------------------------------------------------------

--
-- Table structure for table `userAccess`
--

CREATE TABLE IF NOT EXISTS `userAccess` (
  `accessID` tinyint(1) NOT NULL,
  `accessLevel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userAccess`
--

INSERT INTO `userAccess` (`accessID`, `accessLevel`) VALUES
(1, 'User'),
(2, 'Reviewer'),
(3, 'Moderator'),
(4, 'Administrator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `userAccess`
--
ALTER TABLE `userAccess`
 ADD PRIMARY KEY (`accessID`), ADD UNIQUE KEY `accessID` (`accessID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

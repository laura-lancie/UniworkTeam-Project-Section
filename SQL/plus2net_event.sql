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
-- Table structure for table `plus2net_event`
--

CREATE TABLE IF NOT EXISTS `plus2net_event` (
`event_id` int(5) NOT NULL,
  `date` date NOT NULL,
  `detail` varchar(256) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plus2net_event`
--

INSERT INTO `plus2net_event` (`event_id`, `date`, `detail`) VALUES
(26, '2019-04-26', 'Movie Night - 5pm onwards'),
(27, '2019-04-28', 'Writing meet up - 6pm to 9pm'),
(29, '2019-04-30', 'Movie Trivia Game Night - Anyone Welcome! - 8pm'),
(30, '2019-05-01', 'Movie Night - Avengers End Game! 6pm-9pm'),
(32, '2019-05-02', 'Lunch Writing meet up - 12am - 2pm'),
(33, '2019-05-05', 'Writing meet up - Proof Reading Available - 7pm onwards'),
(34, '2019-04-27', 'Movie Trivia Game Night - Anyone Welcome! - 6pm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `plus2net_event`
--
ALTER TABLE `plus2net_event`
 ADD PRIMARY KEY (`event_id`), ADD UNIQUE KEY `event_id` (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `plus2net_event`
--
ALTER TABLE `plus2net_event`
MODIFY `event_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

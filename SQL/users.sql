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
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`userID` mediumint(8) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `imageURL` varchar(255) NOT NULL,
  `bio` text NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `emailConfirm` tinyint(1) NOT NULL DEFAULT '0',
  `access` tinyint(1) DEFAULT '1',
  `display` tinyint(1) DEFAULT '0',
  `joinDate` date NOT NULL,
  `suspensionEnd` date NOT NULL DEFAULT '1970-01-01',
  `tempPassword` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `firstName`, `surname`, `email`, `password`, `username`, `imageURL`, `bio`, `facebook`, `twitter`, `instagram`, `emailConfirm`, `access`, `display`, `joinDate`, `suspensionEnd`, `tempPassword`) VALUES
(1, 'Gary', 'Walker', 'gary@tbc.com', '$2y$12$WDQJmG1NlNMEUT25UU5Q0eGkWzmHs1AC.OmAieoPY2GO3rEUPkDiy', 'Administrator', '', '', '', '', '', 1, 4, 0, '2019-03-20', '1970-01-01', ''),
(2, 'David', 'McDowell', 'davidwmcdowell86@gmail.com', '$2y$12$nB6CZpLa/ZXqIH6Y/D9Q4eEW.FmJR3RjQaGhktuV61dmY.n3Bclxu', 'Macky_5150', 'userImages/F2A34636-AFBE-469F-91D9-81D8029F7A47.jpeg', 'My favourite movie is Jaws and I also like Jurassic Park, Escape From New York, The Shining, The Big Lebowski, Blade Runner and many more. I need to keep writing to test the limits of the bio box but I have completely ran out of things to say.', 'davidmcdowell5150', 'macky_5150', 'macky_5150', 1, 1, 1, '2019-04-05', '1970-01-01', ''),
(3, 'Laura', 'Atkin', 'laurakatkin@gmail.com', '$2y$12$UmN.RvgPgfrSITS8ks7LeuvxkENfVu2OW9NV3hPZK3CSuqkEtyAXS', 'LauraA', '', '', '', '', '', 1, 4, 0, '2019-04-19', '1970-01-01', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`userID`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `userID` (`userID`), ADD UNIQUE KEY `username` (`username`), ADD KEY `access` (`access`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `userID` mediumint(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

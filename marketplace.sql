-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 01:33 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `news-name` varchar(255) NOT NULL,
  `news-description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `news-name`, `news-description`) VALUES
(1, 'name1', 'desc1'),
(2, 'name2', 'desc2'),
(3, 'name3', 'desc3'),
(4, 'name4', 'desc4');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `post-name` varchar(255) NOT NULL,
  `post-content` text NOT NULL,
  `posted-user` varchar(255) NOT NULL,
  `user-id` int(11) NOT NULL,
  `premium` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post-name`, `post-content`, `posted-user`, `user-id`, `premium`) VALUES
(3, 'testfromcr', 'testfromcreate', 'movie', 0, 0),
(4, '1234', '1234', 'movie', 0, 0),
(5, '12345', '12345', 'movie', 0, 1),
(6, '1234', '12345', 'movie', 0, 0),
(7, 'test', 'testttt', 'movie', 0, 0),
(8, '12345', '123445555', 'Nba Youngboy', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `sitename` varchar(255) NOT NULL,
  `siteurl` varchar(255) NOT NULL,
  `sitelogo` varchar(255) NOT NULL,
  `maintenance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `sitename`, `siteurl`, `sitelogo`, `maintenance`) VALUES
(1, 'SITENAME', 'siteurl', 'sitelogo', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `premium` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `site` varchar(255) NOT NULL,
  `discord` text NOT NULL,
  `telegram` text NOT NULL,
  `banned` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `premium`, `status`, `role`, `site`, `discord`, `telegram`, `banned`) VALUES
(1, 'movie', '$2y$10$OCrT62XkKhvRlCugbP12wur81iHZ4F8oowQyfr.t3NfllCyhzKM7W', 1, 'trusted', 'admin', 'intery.wtf', 'Movie#7982', 't.me/movie9100', 0),
(2, 'Nba Youngboy', '$2y$10$Sv5XDlnJfB75fZcIiyWZg.2yE8.br/JPDl7ox1QdUR4flEfFbvCGq', 1, 'trusted', 'user', '', '', '', 0),
(7, 'fednigger', '$2y$10$iDWT0JHVwiGm79DlwjzlwOL/PqQt239kZpADj7M6r1/0uNCOVm1om', 0, 'new', 'user', '', '', '', 0),
(8, 'Movie123', '$2y$10$xMQiedhqDJhhkDJcmryhzuORpp0hJ3NWSnfP0dBYFKrUR2oDd7bBy', 0, 'new', 'user', '', '', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

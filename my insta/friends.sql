-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2021 at 02:44 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `friends`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(250) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_dp` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `comment`, `user_name`, `user_dp`) VALUES
(8, 6, 14, 'hello bro', 'Prince', 'DP/unnamed.jpg'),
(11, 6, 14, 'kya bat h', 'Prince', 'DP/unnamed.jpg'),
(17, 6, 14, 'hello', 'Prince', 'DP/unnamed.jpg'),
(20, 9, 14, 'cool', 'Prince', 'DP/unnamed.jpg'),
(21, 13, 17, 'nice', 'Prince', 'DP/IMG_20191214_131510.jpg'),
(22, 15, 18, 'hello', 'pp', 'DP/unnamed.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `img` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id`, `name`, `password`, `img`) VALUES
(14, 'Prince', '123', 'unnamed.jpg'),
(15, 'Chandan', '123', '2-cutout.png'),
(16, 'Parveen', '123', '2019_bmw_vision_m_next_sports_car_road-wallpaper-1366x768.jpg'),
(17, 'princekumar', '321', '0b271ab0-dd0c-412b-aa54-3d963589a8ed.png'),
(18, 'pp', '123', '2-cutout.png');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `post_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `post_id`, `user_id`) VALUES
(13, 6, 15),
(26, 7, 15),
(28, 8, 15),
(29, 8, 14),
(36, 0, 14),
(42, 7, 14),
(43, 6, 14),
(44, 9, 14),
(45, 10, 14),
(54, 15, 18);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `sender` varchar(50) NOT NULL,
  `receiver` varchar(50) NOT NULL,
  `msg` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`sender_id`, `receiver_id`, `sender`, `receiver`, `msg`) VALUES
(13, 11, 'avinesh', 'Prince', 'hello'),
(14, 15, 'Prince', 'Chandan', 'hh'),
(14, 15, 'Prince', 'Chandan', 'pp'),
(14, 15, 'Prince', 'Chandan', 'kk'),
(14, 15, 'Prince', 'Chandan', 'tt'),
(14, 15, 'Prince', 'Chandan', ''),
(15, 14, 'Chandan', 'Prince', 'hh'),
(17, 15, 'Prince', 'Chandan', 'hello'),
(17, 16, 'Prince', 'Parveen', 'heeo'),
(17, 16, 'Prince', 'Parveen', ''),
(17, 16, 'Prince', 'Parveen', 'hello'),
(17, 16, 'Prince', 'Parveen', ''),
(18, 15, 'pp', 'Chandan', ''),
(18, 15, 'pp', 'Chandan', 'hello'),
(18, 15, 'pp', 'Chandan', 'grr'),
(18, 15, 'pp', 'Chandan', ''),
(18, 16, 'pp', 'Parveen', 'hello'),
(18, 16, 'pp', 'Parveen', ''),
(18, 16, 'pp', 'Parveen', ''),
(18, 16, 'pp', 'Parveen', ''),
(18, 17, 'pp', 'princekumar', 'hello'),
(18, 17, 'pp', 'princekumar', ''),
(18, 17, 'pp', 'princekumar', ''),
(18, 17, 'pp', 'princekumar', ''),
(18, 17, 'pp', 'princekumar', '');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `post_o_n` varchar(50) NOT NULL,
  `post_o_dp` varchar(250) NOT NULL,
  `post` varchar(250) NOT NULL,
  `post_c` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `post_o_n`, `post_o_dp`, `post`, `post_c`) VALUES
(15, 'pp', 'unnamed.jpg', '0b271ab0-dd0c-412b-aa54-3d963589a8ed.png', 'hhh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

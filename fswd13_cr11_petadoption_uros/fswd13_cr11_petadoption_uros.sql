-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2021 at 05:56 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fswd13_cr11_petadoption_uros`
--
CREATE DATABASE IF NOT EXISTS `fswd13_cr11_petadoption_uros` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fswd13_cr11_petadoption_uros`;

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `animal_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `hobbies` varchar(255) NOT NULL,
  `breed` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`animal_id`, `name`, `photo`, `location`, `description`, `size`, `age`, `hobbies`, `breed`) VALUES
(1, 'Lejla', '608bd9ecec570.jpg', 'Wiena', 'Strong and funny', '30kg', 9, 'Running and reading', 'Staffordshire Terrier'),
(2, 'Ajvi', '611fdd179a0db.jpg', 'Salzburg', 'Dog for hunting', 'big', 7, 'Chasing cats', 'Vizsla'),
(6, 'Johny Deep', 'rooster-2774510_1280.jpg', 'Graz', 'Makes a good soup', 'small', 3, 'Singing', 'Rooster'),
(7, 'Sisi', 'cat-3523992_1280.jpg', 'Tuln ', 'Likes children', 'small', 5, 'Fishing', 'Haus cat'),
(8, 'Hulk', 'horse-868971_1280.jpg', 'Wienerberg', 'old but gold', 'big', 12, 'Photography', 'Arabian horse'),
(9, 'Granny', 'owl-377192_1280.jpg', 'Alps', 'I m watching you', 'small', 10, 'Schooting', 'Owl'),
(10, 'Jumanji', 'cat-2528935_1280.jpg', 'Baden', 'Like to steel stuf.', 'small', 3, 'Collecting stamps', 'Rusian blue'),
(11, 'Clooney', 'dog-287420_1280.jpg', 'Linz', 'Best friend', 'big', 9, 'sleeping', 'Bernese Mountain Dog'),
(12, 'Doctor', 'mallard-3609130_1280.jpg', 'Mondsee', 'Wet is good', 'small', 6, 'Diving', 'Cayuga Duck'),
(13, 'Mimi', 'white-2704022_1280.jpg', 'Parndorf', 'Nice and gentle', 'small', 3, 'Shopping', 'Samoyed'),
(14, 'Dollar', 'animal-2116628_1280.jpg', 'Perg', 'Lazy but fast', 'small', 15, 'Solarium', 'Lizard'),
(15, 'Mask', 'dog-2029214_1280.jpg', 'Haag', 'Activ pet', 'small', 9, 'Gambling', 'Jack Russel');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `adress`, `picture`, `status`) VALUES
(3, 'uki', 'ur', 'uros@uros.com', '8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414', 'mickey.jpg', 'Ney york', '6120ee3465d36.jpg', 'adm'),
(4, 'Forest', 'Gump', 'neki@neki.com', '2bba6c17e4337f408e46f29acfb3a5664dd70b267a33e0a3cd5d4d52540dedce', '12345432', 'Boat', 'forest.jpg', 'user'),
(6, 'Tina', 'Turner', 'neki@neki.at', 'f61a20da9eaa68a9f06dbc1710b10ef0a67208b2059b1f576af6deac23c215f5', '1343212222', 'London', 'tina.jpg', 'user'),
(7, 'ana', 'moja', 'ana@ana.at', 'c64a0fbaee020a68288cd158bbd2d711ef7b8c07b592903546e7bc38fc002f02', '123454321', 'neka', 'avatar.png', 'adm'),
(8, 'Michaej', 'Jackson', 'mika@mika.com', 'ccf721ebbbfd4aabfb0c101ae1df46a585c945b75ecf92640807cab55902c858', '2333333333', 'USA', '6120ee6169377.jpg', 'user'),
(12, 'some', 'none', 'some@some.com', 'f61a20da9eaa68a9f06dbc1710b10ef0a67208b2059b1f576af6deac23c215f5', '1212123456', 'sedser', '61211951a7f78.jpg', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`animal_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `animal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2022 at 10:26 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `engy`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `customer` varchar(80) NOT NULL,
  `prod` varchar(80) NOT NULL,
  `traff` varchar(80) NOT NULL,
  `maincomp` varchar(80) NOT NULL,
  `dest` varchar(80) NOT NULL,
  `looking` varchar(80) NOT NULL,
  `pot` varchar(80) NOT NULL,
  `act` varchar(300) NOT NULL,
  `next` varchar(80) NOT NULL,
  `result` varchar(80) NOT NULL,
  `datecomm` varchar(300) NOT NULL,
  `user` int(10) UNSIGNED NOT NULL,
  `data_id` int(10) UNSIGNED NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `archived` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`customer`, `prod`, `traff`, `maincomp`, `dest`, `looking`, `pot`, `act`, `next`, `result`, `datecomm`, `user`, `data_id`, `deleted`, `archived`) VALUES
('', 'eeeeee', 'qewf', 'joi', 'joi', 'eeee', 'ojiwfg', 'asdasd', 'qweqwe', 'qweqwe', '123123123123', 1, 17, 0, 0),
('asd', 'asd', 'weqwe', '', 'qwe', '', '', '', '', '', '', 1, 18, 0, 0),
('', '', '', '', '', '', '', '', '', '', '', 1, 19, 0, 0),
('Nesa nije smrad', '', 'qwe', 'qwe', 'qwe', 'qweqwe', 'eee', '', '', '', '', 1, 20, 0, 0),
('kita muda&nbsp;', 'sise', 'asdasd', 'asdasd', 'ewotrhi', '2', '', '', '', '', '', 1, 21, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id_message` int(10) UNSIGNED NOT NULL,
  `message_text` text NOT NULL,
  `user_from` int(10) UNSIGNED NOT NULL,
  `user_for` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `message_date` datetime NOT NULL,
  `deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id_message`, `message_text`, `user_from`, `user_for`, `message_date`, `deleted`) VALUES
(3, 'TEST TEST', 1, 0, '2022-12-20 09:24:08', 0),
(4, 'asdasdasd', 1, 5, '2022-12-20 09:45:30', 0),
(6, 'Test msg', 1, 5, '2022-12-20 09:51:19', 0),
(7, 'asdasd', 1, 5, '2022-12-20 09:51:44', 0),
(8, 'Jovo sisaj ga', 2, 5, '2022-12-20 10:11:16', 0),
(14, 'Pisemo JOVI', 1, 5, '2022-12-20 10:22:57', 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_role` int(10) UNSIGNED NOT NULL,
  `role_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_role`, `role_name`) VALUES
(1, 'admin'),
(2, 'manager'),
(3, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(80) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `username` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `team` varchar(80) NOT NULL,
  `role` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `first_name`, `last_name`, `username`, `email`, `password`, `team`, `role`) VALUES
(1, 'Nenad', 'Grubenovic', 'grubi', 'grubi@gmail.com', '123', 'CEO', 1),
(2, 'asd', 'asd', 'ceca', 'asdasd', '123', 'Vice President', 2),
(3, 'Joca', 'coca', 'joca', '123', '123', 'Sales Manager', 3),
(4, 'Aleksa', 'Aleksic', 'beban', 'asogfk@gewk9.com', '123', 'Account Manager', 3),
(5, 'Jovan', 'Jovanovic', 'jova', 'aefokj.araerk@gmaog,afe.com', '123', 'Developer', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`data_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_message`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `data_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id_message` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role`) REFERENCES `roles` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2022 at 01:45 PM
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
('test', 'eeeeee', 'qewf', 'joi', 'joi', 'eeee', 'ojiwfg', 'asdasd', 'qweqwe', 'qweqwe', '123123123123', 1, 17, 0, 0),
('asd', 'asd', 'weqwe', '', 'qwe', '', '', '', '', '', '', 1, 18, 0, 0),
('Aaaaaa', '', 'EEEE', '', '', '', '', '', '', '', '', 1, 19, 0, 0),
('Nesa nije smrad', 'testi', 'asdkoaqwe', 'wkropwrgpkqwe', 'gwkopwrqwe', 'fkqweqwe', 'eee', 'Nesto', 'asdasd', 'asd', 'qwqeqwewqeqeqe', 1, 20, 0, 0),
('kita aeae', 'aeise', 'asdasd', 'asdasd', 'ewotrhi', '2', 'test', 'pisemo&nbsp;', 'haha', '', '', 1, 21, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id_message` int(10) UNSIGNED NOT NULL,
  `message_text` text NOT NULL,
  `user_from` int(10) UNSIGNED NOT NULL,
  `user_for` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `message_date` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id_message`, `message_text`, `user_from`, `user_for`, `message_date`, `deleted`) VALUES
(23, 'test test', 1, 0, '2022-12-21 15:23:39', 1),
(24, 'Test sada', 1, 0, '2022-12-21 15:24:01', 1),
(25, 'test sada', 1, 0, '2022-12-21 15:25:43', 0),
(26, 'TEST PRIV', 1, 1, '2022-12-21 20:19:38', 1),
(46, 'Test msg', 2, 4, '2022-12-21 21:02:04', 0),
(47, 'TEST TEST BREEEE', 2, 4, '2022-12-21 21:02:11', 0),
(48, 'ALO', 4, 0, '2022-12-21 21:02:22', 1),
(67, 'ASDASD', 1, 5, '2022-12-22 18:21:03', 1),
(68, '<b>Test bold</b>', 1, 0, '2022-12-22 18:22:09', 0),
(69, 'asd', 1, 5, '2022-12-22 19:33:31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id_report` int(10) UNSIGNED NOT NULL,
  `report_message` text NOT NULL,
  `report_date` datetime DEFAULT current_timestamp(),
  `report_user` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id_report`, `report_message`, `report_date`, `report_user`) VALUES
(47, '<p style=\"text-align: center;\">TEST 1</p>', '2022-12-22 22:37:28', 3),
(48, '<p><strong>Moze li sad ovako?</strong></p>\n<p>&nbsp;</p>\n<p><strong>HAhahahaha</strong></p>', '2022-12-22 22:43:35', 3),
(49, '<p><strong>Moze li sad ovako?</strong></p>\n<p>&nbsp;</p>\n<p style=\"text-align: right;\"><strong>HAhahahaha</strong></p>\n<p style=\"text-align: right;\"><strong>Moze li sad ovako?</strong></p>\n<p>&nbsp;</p>\n<p style=\"text-align: center;\"><strong>HAhahahaha</strong></p>\n<p style=\"text-align: center;\"><strong>Moze li sad ovako?</strong></p>\n<p style=\"text-align: center;\">&nbsp;</p>\n<p style=\"text-align: center;\"><strong>HAhahahaha</strong></p>\n<p style=\"text-align: center;\"><strong>Moze li sad ovako?</strong></p>\n<p>&nbsp;</p>\n<p><strong>HAhahahaha</strong></p>', '2022-12-22 22:44:12', 3),
(50, '<p>tes test testtttt</p>', '2022-12-22 22:45:36', 3),
(51, '<p>bOOOOoooomba</p>', '2022-12-22 22:45:43', 3),
(52, '<p>Test test</p>', '2022-12-22 22:48:18', 3),
(53, '<p>Da li radi sad</p>', '2022-12-22 22:49:52', 3),
(54, '<p>Test report</p>', '2022-12-23 13:19:04', 1);

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
(2, 'Svetlana', 'Grubenovic', 'ceca', 'cecili@gmail.com', '123', 'Vice President', 2),
(3, 'Joca', 'Grubenovic', 'joca', 'cojomaks@yahoo.com', '123', 'Sales Manager', 3),
(4, 'Aleksa', 'Aleksic', 'beban', 'aleksart919@gs.viser.edu.rs', '123', 'Account Manager', 2),
(5, 'Jovan', 'Jovanovic', 'jova', 'aefokj.araerk@sesmail.com', '123', 'Developer', 3),
(7, 'Ivan', 'Ivanovic', 'iva', 'nekimail@test.com', '123', 'Developer', 3),
(8, 'Mirko', 'Aleksic', 'miks', 'blejanje@tebra.com', '123', 'Developer', 3);

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
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id_report`);

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
  MODIFY `id_message` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id_report` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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

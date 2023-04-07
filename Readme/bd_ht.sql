-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2023 at 11:23 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_credentials`
--

CREATE TABLE `admin_credentials` (
  `ID` int(11) NOT NULL,
  `USERNAME` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `PASSWORD` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `CONTACT_NUMBER` int(10) NOT NULL,
  `EMAIL` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_credentials`
--

INSERT INTO `admin_credentials` (`ID`, `USERNAME`, `PASSWORD`, `CONTACT_NUMBER`, `EMAIL`, `created_at`) VALUES
(1, 'admin', 'admin', 1234567890, 'ngogialam@gmail.com', '2023-03-13 07:10:10'),
(2, 'mbfsoft', 'admin', 234567890, 'cocaiconhagm@gmail.com', '2023-03-13 07:10:10');

-- --------------------------------------------------------

--
-- Table structure for table `manager_team_user`
--

CREATE TABLE `manager_team_user` (
  `id_team_user` int(11) NOT NULL,
  `name_team_user` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_status` tinyint(1) NOT NULL,
  `create_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `manager_team_user`
--

INSERT INTO `manager_team_user` (`id_team_user`, `name_team_user`, `user_status`, `create_by`, `created_at`) VALUES
(1, 'GgggsdaS', 0, 3, '2023-03-13 03:51:27'),
(2, 'gjghfjggg', 1, 3, '2023-03-13 03:51:27'),
(3, 'Adef', 1, 0, '2023-04-05 07:36:58'),
(6, '5', 2, 0, '2023-04-05 07:38:53');

-- --------------------------------------------------------

--
-- Table structure for table `manager_user`
--

CREATE TABLE `manager_user` (
  `id_user` int(11) NOT NULL,
  `id_team_user` int(11) DEFAULT NULL,
  `name_user_manager` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sdt` int(10) NOT NULL,
  `gmail` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `room` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `position_manager` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `create_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `manager_user`
--

INSERT INTO `manager_user` (`id_user`, `id_team_user`, `name_user_manager`, `sdt`, `gmail`, `room`, `position_manager`, `create_by`, `created_at`) VALUES
(1, 1, 'Nguyen Quan ', 395607744, 'nagdagdga78@gmail.com', 'P.KTKT', 'chuyen vien', 3, '2023-03-13 04:01:34'),
(2, 1, 'Nguyen gn ', 395655744, 'nagdaga78@gmail.com', 'P.KTKT', 'chuyen vien', 3, '2023-03-13 04:02:53'),
(3, NULL, 'Rtyu', 1456789236, 'K@gmail.conm', 'Ng', 'Fghj', 0, '2023-04-05 08:42:30'),
(4, NULL, 'Hff', 326159171, 'K@gmail.conm', 'Dgdd', 'Dgdg', 0, '2023-04-06 03:30:36');

-- --------------------------------------------------------

--
-- Table structure for table `sys_ql`
--

CREATE TABLE `sys_ql` (
  `id_sys` int(11) NOT NULL,
  `unit_user_id` int(11) DEFAULT NULL,
  `unit_sys_id` int(11) DEFAULT NULL,
  `user_manager_id` int(11) DEFAULT NULL,
  `team_sys_id` int(11) DEFAULT NULL,
   `name_sys` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_number` int(11) DEFAULT NULL,
  `describe_sys` text NOT NULL,
  `document_sys` text DEFAULT NULL,
  `ip_sys` int(10) DEFAULT NULL,
  `server_sys` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `config_sys` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `file_des` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sys_ql`
--

INSERT INTO `sys_ql` (`id_sys`, `unit_user_id`, `unit_sys_id`, `user_manager_id`, `team_sys_id`, `name_sys`, `first_number`, `describe_sys`, `document_sys`, `ip_sys`, `server_sys`, `config_sys`, `create_by`, `file_des`, `created_at`) VALUES
(79, 1, 1, 1, 1, 'sdfg ', 234, 'á gdsagbvas ', 'ádfv sa ăef ádf', 2147483647, '13123', 'sfa fsdg á ', 3, 'Lịch thi đấu và danh sách các vận động viên thi đấu 1.4.2023.docx', '2023-04-04 09:35:25'),
(80, 1, 1, 1, 1, 'fasfd', 0, '', '', 0, '', '', 0, '', '2023-04-04 09:42:17');

-- --------------------------------------------------------

--
-- Table structure for table `team_sys_manager`
--

CREATE TABLE `team_sys_manager` (
  `id_team_sys` int(11) NOT NULL,
  `name_team_sys` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `type_sys` tinyint(1) NOT NULL,
  `describe_sys` text COLLATE utf8_unicode_ci NOT NULL,
  `create_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `file_des` varchar(100) CHARACTER SET utf16 COLLATE utf16_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `team_sys_manager`
--

INSERT INTO `team_sys_manager` (`id_team_sys`, `name_team_sys`, `type_sys`, `describe_sys`, `create_by`, `created_at`, `file_des`) VALUES
(1, 'Gagghdfgh H', 127, 'haad', 3, '2023-03-13 03:40:26', 'tokhaibhxh.pdf'),
(2, 'ffadgdf', 0, 'hashgfasdghfhsak asdhdhshfas dfasefhysf acsfudsahyfs FUIASDFHCS asduifsdfbvgasdfkgjvafasdjk asgj svgfswyf WWasuf sdf', 3, '2023-03-13 03:40:26', ''),
(5, 'Skj', 3, 'à ', 4, '2023-04-04 03:39:07', ''),
(6, 'Sxxx', 2, 'SÁADS', 3, '2023-04-04 03:47:56', '');

-- --------------------------------------------------------

--
-- Table structure for table `unit_sys`
--
CREATE TABLE `unit_sys` (
  `id_unit_sys` int(11) NOT NULL,
  `name_unit_sys` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name_room` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `create_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
--
-- Dumping data for table `unit_sys`
--

INSERT INTO `unit_sys` (`id_unit_sys`, `name_unit_sys`, `name_room`, `create_by`, `created_at`) VALUES
(1, 'P.PTDV', 'P.Ptdv', 3, '2023-03-13 03:25:10'),
(2, 'P.KTKT', 'P.KTKT', 3, '2023-03-13 03:25:10'),
(3, 'P.GG', 'P.GG', 3, '2023-03-13 03:25:10'),
(4, 'P.NDS', 'P.NDS', 3, '2023-03-13 03:25:10'),
(9, '5GFSDF', '5gsdf', 0, '2023-04-05 02:46:46');

-- --------------------------------------------------------

--
-- Table structure for table `unit_user`
--

CREATE TABLE `unit_user` (
  `id_unit_user` int(11) NOT NULL,
  `name_unit_user` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name_room_unit` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `create_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `unit_user`
--

INSERT INTO `unit_user` (`id_unit_user`, `name_unit_user`, `name_room_unit`, `create_by`, `created_at`) VALUES
(1, 'Nguyen Quan', 'Nguyen Quan', 'Lam', '2023-04-04 17:00:00'),
(2, 'P.Pqc', '', 'Hoaoa', '2023-03-13 03:16:31'),
(3, 'P.Ptao', '', '3', '2023-03-13 03:16:31'),
(4, 'P.PKTKT', 'PrKT4.0', '3', '2023-03-13 03:16:31'),
(5, 'T.T noc', 'Pr4.0', '3', '2023-03-13 03:16:31'),
(6, 'P.tctk', 'PTrr4.0', '3', '2023-03-13 03:16:31'),
(7, 'hai ', 'phòng tổng hợp', '3', '2023-03-27 07:44:17'),
(8, 'ba ', 'phòng tổng hợp', '3', '2023-03-27 07:44:17'),
(9, 'bốn', 'phòng tổng hợp', '3', '2023-03-27 07:44:17'),
(10, 'hai ', 'phòng tổng hợp', '3', '2023-03-27 07:57:26'),
(11, 'ba ', 'phòng tổng hợp', '3', '2023-03-27 07:57:26'),
(12, 'bốn', 'phòng tổng hợp', '3', '2023-03-27 07:57:26'),
(13, 'hai ', 'phòng tổng hợp', '3', '2023-03-27 07:57:26'),
(14, 'ba ', 'phòng tổng hợp', '3', '2023-03-27 07:57:26'),
(15, 'bốn', 'phòng tổng hợp', '3', '2023-03-27 07:57:26'),
(16, 'hai ', 'phòng tổng hợp', '3', '2023-03-27 07:58:39'),
(17, 'ba ', 'phòng tổng hợp', '3', '2023-03-27 07:58:39'),
(18, 'bốn', 'phòng tổng hợp', '3', '2023-03-27 07:58:39'),
(19, 'hai ', 'phòng tổng hợp', '3', '2023-03-27 07:58:39'),
(20, 'ba ', 'phòng tổng hợp', '3', '2023-03-27 07:58:39'),
(21, 'bốn', 'phòng tổng hợp', '3', '2023-03-27 07:58:39'),
(22, 'hai ', 'phòng tổng hợp', '3', '2023-03-27 08:01:45'),
(23, 'ba ', 'phòng tổng hợp', '3', '2023-03-27 08:01:45'),
(24, 'bốn', 'phòng tổng hợp', '3', '2023-03-27 08:01:45'),
(25, 'hai ', 'phòng tổng hợp', '3', '2023-03-27 08:20:30'),
(26, 'ba ', 'phòng tổng hợp', '3', '2023-03-27 08:20:30'),
(27, 'bốn', 'phòng tổng hợp', '3', '2023-03-27 08:20:30');


-- --------------------------------------------------------

--
-- Table structure for table `user_manager`
--

CREATE TABLE `user_manager` (
  `id_user_manager` int(11) NOT NULL,
  `name_user_manager` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `sdt` int(10) NOT NULL,
  `gmail` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `room` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `position_manager` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `create_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
--
-- Dumping data for table `user_manager`
--

INSERT INTO `user_manager` (`id_user_manager`, `name_user_manager`, `sdt`, `gmail`, `room`, `position_manager`, `create_by`, `created_at`) VALUES
(1, 'Ngo Lam', 2147483647, 'Inhkhjkhnn@mof.com', 'Ktkt', 'Truong Phong', 'Lam N', '2023-03-13 03:36:46'),
(2, 'Lam', 125556789, 'Inhjhhnn@mof.com', 'PTDV', 'Pho Phong Phong', 'Lam', '2023-03-13 03:36:46'),
(3, '\0s', 125556789, 'inhhgjhfkjnn@mof.com', 'PTDV', '\0chuyen vien', '3', '2023-03-13 03:36:46'),
(4, '\0d', 124456789, 'inhhghjfnn@mof.com', 'PTDV', '\0clc', '3', '2023-03-13 03:36:46'),
(5, 'df', 125456789, '\0ghhinhhnn@mof.com', 'PTDV', 'Truong phong', '3', '2023-03-13 03:36:46'),
(6, 'Lam', 395606644, 'Nghjghg@gmail.com', 'Ptdv', 'Chuyen Vien ', 'Binh', '2023-03-15 12:31:10'),
(7, 'Lamood', 956756656, 'Thuythuvngpt@mail1s.cyou', 'Pktkt', 'Pho Phong', 'Ling Dieu Tran', '2023-03-16 01:21:12'),
(8, 'Hoas', 395606655, 'Khaoc@mobifone.vn', 'Ksds', 'Dsas', 'Sufw', '2023-03-16 07:14:26'),
(9, 'a', 2147483647, 'anhasdasd@gmail.com', 'nds', 'CHIEN VIEN', '3', '2023-03-24 08:04:07'),
(10, 'bcv', 2147483647, 'sdacjhsdgbchjds@edu.vn', 'ptdv', 'CHIEN VIEN', '3', '2023-03-24 08:04:07'),
(11, 'gdf', 1234568790, 'shkcshadbchsdf@media.com', 'ktkt', 'CHIEN VIEN', '3', '2023-03-24 08:04:07'),
(12, 'bdfg', 2147483647, 'dcfqhybg@gmail.com', 'NOC', 'CHIEN VIEN', '3', '2023-03-24 08:04:07'),
(13, 'a', 2147483647, 'anhasdasd@gmail.com', 'nds', 'CHIEN VIEN', '3', '2023-03-24 08:04:14'),
(14, 'bcv', 2147483647, 'sdacjhsdgbchjds@edu.vn', 'ptdv', 'CHIEN VIEN', '3', '2023-03-24 08:04:14'),
(15, 'gdf', 1234568790, 'shkcshadbchsdf@media.com', 'ktkt', 'CHIEN VIEN', '3', '2023-03-24 08:04:14'),
(16, 'bdfg', 2147483647, 'dcfqhybg@gmail.com', 'NOC', 'CHIEN VIEN', '3', '2023-03-24 08:04:14'),
(17, 'Lam NG', 1233365788, 'lamng@hahshda.vn', 'ptdv', 'chien vien', 'lam nG', '2023-03-24 08:45:26'),
(18, 'dsfhsdhfhsf', 974623646, 'lamng@edu.vn', 'pktkt', 'chien vien', 'lam nG', '2023-03-24 08:52:54'),
(19, 'Binh', 999999999, 'lamngsvgs@edu.vn', 'noc', 'chuyen vien', '8', '2023-03-24 08:52:54'),
(20, 'Linh', 898988888, 'ksadjfksjdfv@clip.com', 'p.ptdv', 'pp', '8', '2023-03-24 08:52:54'),
(21, 'dsfhsdhfhsf', 974623646, 'lamng@edu.vn', 'pktkt', 'chien vien', 'lam nG', '2023-03-24 10:31:37'),
(22, 'Binh', 999999999, 'lamngsvgs@edu.vn', 'noc', 'chuyen vien', '8', '2023-03-24 10:31:37'),
(23, 'Linh', 898988888, 'ksadjfksjdfv@clip.com', 'p.ptdv', 'pp', '8', '2023-03-24 10:31:37'),
(24, 'dsfhsdhfhsf', 974623646, 'lamng@edu.vn', 'pktkt', 'chien vien', 'lam nG', '2023-03-24 10:32:01'),
(25, 'Binh', 999999999, 'lamngsvgs@edu.vn', 'noc', 'chuyen vien', '8', '2023-03-24 10:32:01'),
(26, 'Linh', 898988888, 'ksadjfksjdfv@clip.com', 'p.ptdv', 'pp', '8', '2023-03-24 10:32:01'),
(27, 'dsfhsdhfhsf', 974623646, 'lamng@edu.vn', 'pktkt', 'chien vien', 'lam nG', '2023-03-24 10:32:36'),
(28, 'Binh', 999999999, 'lamngsvgs@edu.vn', 'noc', 'chuyen vien', '8', '2023-03-24 10:32:36'),
(29, 'Linh', 898988888, 'ksadjfksjdfv@clip.com', 'p.ptdv', 'pp', '8', '2023-03-24 10:32:36'),
(30, 'dsfhsdhfhsf', 974623646, 'lamng@edu.vn', 'pktkt', 'chien vien', 'lam nG', '2023-03-24 10:32:36'),
(31, 'Binh', 999999999, 'lamngsvgs@edu.vn', 'noc', 'chuyen vien', '8', '2023-03-24 10:32:36'),
(32, 'Linh', 898988888, 'ksadjfksjdfv@clip.com', 'p.ptdv', 'pp', '8', '2023-03-24 10:32:36'),
(33, 'dsfhsdhfhsf', 974623646, 'lamng@edu.vn', 'pktkt', 'chien vien', 'lam nG', '2023-03-24 10:33:23'),
(34, 'Binh', 999999999, 'lamngsvgs@edu.vn', 'noc', 'chuyen vien', '8', '2023-03-24 10:33:23'),
(35, 'Linh', 898988888, 'ksadjfksjdfv@clip.com', 'p.ptdv', 'pp', '8', '2023-03-24 10:33:23'),
(36, 'dsfhsdhfhsf', 974623646, 'lamng@edu.vn', 'pktkt', 'chien vien', 'lam nG', '2023-03-24 10:33:23'),
(37, 'Binh', 999999999, 'lamngsvgs@edu.vn', 'noc', 'chuyen vien', '8', '2023-03-24 10:33:23'),
(38, 'Linh', 898988888, 'ksadjfksjdfv@clip.com', 'p.ptdv', 'pp', '8', '2023-03-24 10:33:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_credentials`
--
ALTER TABLE `admin_credentials`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `manager_team_user`
--
ALTER TABLE `manager_team_user`
  ADD PRIMARY KEY (`id_team_user`);

--
-- Indexes for table `manager_user`
--
ALTER TABLE `manager_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_team_user` (`id_team_user`);

--
-- Indexes for table `sys_ql`
--
ALTER TABLE `sys_ql`
  ADD PRIMARY KEY (`id_sys`),
  ADD KEY `sys_ql_ibfk_1` (`unit_user_id`),
  ADD KEY `sys_ql_ibfk_2` (`unit_sys_id`),
  ADD KEY `sys_ql_ibfk_3` (`user_manager_id`),
  ADD KEY `sys_ql_ibfk_4` (`team_sys_id`);

--
-- Indexes for table `team_sys_manager`
--
ALTER TABLE `team_sys_manager`
  ADD PRIMARY KEY (`id_team_sys`);

--
-- Indexes for table `unit_sys`
--
ALTER TABLE `unit_sys`
  ADD PRIMARY KEY (`id_unit_sys`);

--
-- Indexes for table `unit_user`
--
ALTER TABLE `unit_user`
  ADD PRIMARY KEY (`id_unit_user`);

--
-- Indexes for table `user_manager`
--
ALTER TABLE `user_manager`
  ADD PRIMARY KEY (`id_user_manager`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_credentials`
--
ALTER TABLE `admin_credentials`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `manager_team_user`
--
ALTER TABLE `manager_team_user`
  MODIFY `id_team_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `manager_user`
--
ALTER TABLE `manager_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sys_ql`
--
ALTER TABLE `sys_ql`
  MODIFY `id_sys` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `team_sys_manager`
--
ALTER TABLE `team_sys_manager`
  MODIFY `id_team_sys` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `unit_sys`
--
ALTER TABLE `unit_sys`
  MODIFY `id_unit_sys` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `unit_user`
--
ALTER TABLE `unit_user`
  MODIFY `id_unit_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_manager`
--
ALTER TABLE `user_manager`
  MODIFY `id_user_manager` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `manager_user`
--
ALTER TABLE `manager_user`
  ADD CONSTRAINT `manager_user_ibfk_1` FOREIGN KEY (`id_team_user`) REFERENCES `manager_team_user` (`id_team_user`) ON UPDATE CASCADE;

--
-- Constraints for table `sys_ql`
--
ALTER TABLE `sys_ql`
  ADD CONSTRAINT `sys_ql_ibfk_1` FOREIGN KEY (`unit_user_id`) REFERENCES `unit_user` (`id_unit_user`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sys_ql_ibfk_2` FOREIGN KEY (`unit_sys_id`) REFERENCES `unit_sys` (`id_unit_sys`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sys_ql_ibfk_3` FOREIGN KEY (`user_manager_id`) REFERENCES `user_manager` (`id_user_manager`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sys_ql_ibfk_4` FOREIGN KEY (`team_sys_id`) REFERENCES `team_sys_manager` (`id_team_sys`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

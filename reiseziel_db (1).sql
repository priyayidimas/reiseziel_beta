-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2018 at 02:46 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reiseziel_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(10) NOT NULL,
  `name` varchar(80) NOT NULL,
  `email` varchar(80) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `gender` varchar(10) NOT NULL,
  `users_id` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `address`, `phone`, `gender`, `users_id`, `created_at`) VALUES
(4, 'Agus', '', 'JL. Agus No Agus', '081081081', 'Mr.', 3, '2018-04-10 06:37:32'),
(5, 'Dante Mendoza', 'mendoza@mail.id', 'AAAAAAA', '0101010', 'Mr.', 4, '2018-04-10 06:37:32'),
(7, 'Contoh 2', 'contoh@mail.id', 'Jalanan', '11111111', 'Mr.', 4, '2018-04-10 06:37:32'),
(8, 'Tante', '', 'A', 'aaa', 'Mrs.', 3, '2018-04-10 06:37:32'),
(9, 'Same', NULL, NULL, NULL, 'Mr.', NULL, '2018-04-10 06:37:32'),
(19, 'a', 'a@a.id', NULL, '0101010', 'Mr.', NULL, '2018-04-10 06:37:32'),
(20, 'dada', 'dada@d.id', NULL, NULL, 'Mrs.', NULL, '2018-04-10 06:37:32'),
(21, 'd', 'd@a.id', NULL, NULL, 'Mr.', NULL, '2018-04-10 06:37:32'),
(22, 'Dante', 'da@da.id', NULL, NULL, 'Mr.', NULL, '2018-04-10 06:37:32'),
(23, 'Aaaa', 'Aaa@mail.id', NULL, NULL, 'Mr.', NULL, '2018-04-10 06:37:32'),
(24, 'Siapa', 'siapa@siapa.id', NULL, NULL, 'Mrs.', NULL, '2018-04-10 06:37:32'),
(25, 'Dimas', 'dd@dd.id', NULL, '11111111', 'Mr.', NULL, '2018-04-10 06:37:32'),
(26, 'Dimas', 'priyayidimas@mail.id', NULL, '12123', 'Mr.', NULL, '2018-04-10 06:37:32'),
(27, 'ADA', 'sasas@saas', NULL, '123123', 'Mr.', NULL, '2018-04-10 06:37:32'),
(28, 'DADSA', '12312312', NULL, NULL, 'Mr.', NULL, '2018-04-10 06:37:32'),
(29, 'Administrator', 'priyayidimas@mail.id', NULL, '12312312312', 'Mr.', NULL, '2018-04-10 06:37:32'),
(30, 'Dtttt', 'prrrr', NULL, NULL, 'Mr.', NULL, '2018-04-10 06:37:32'),
(31, 'fffff', '234234', NULL, NULL, 'Ms.', NULL, '2018-04-10 06:37:32'),
(32, 'Dimas Anom Priyayi', 'priyayi@mail.id', 'Jalananaaaaan', '081081081', 'Mr.', NULL, '2018-04-10 06:37:32'),
(33, 'Divaubawang', 'divaaa@mail.id', 'Jlanaaaan', '081081018', 'Mrs.', NULL, '2018-04-10 06:37:32'),
(34, 'Isi', 'ad', 'd', 'd', 'Mrs.', NULL, '2018-04-10 06:37:32'),
(35, 'd', 'd', 'd', 'd', 'Mrs.', NULL, '2018-04-10 06:37:32'),
(37, 'Dimas Anom Priyayi', 'priyayi_dimas@yahoo.com', 'Jalan Sekeloa Timur', '0808080080', 'Mr.', 6, '2018-04-10 11:54:46'),
(38, 'Dimas Anom', 'priyayid@mail.id', 'sadasdsad', '0812222123', 'Mr.', NULL, '2018-04-10 12:11:52'),
(39, 'Agus Supriatna', 'agus@mail.id', 'Jalan Kiara Condong', '081081081', 'Mr.', 7, '2018-04-10 12:21:29');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `sender` varchar(50) NOT NULL,
  `subject` varchar(80) NOT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `sender`, `subject`, `content`) VALUES
(1, 'Me', 'Lost Ticket', '36590481 - IDK'),
(2, 'dd', 'dd', ' - dd'),
(3, 'dd', 'dd', ' - dd'),
(4, 'UNKNOWN CUSTOMER', 'ASK REFUND', ' 67809235'),
(5, 'Dante Mendoza', 'ASK Refund', ' 36590481'),
(6, 'Dante Mendoza', 'ASK Refund', ' 36590481'),
(7, 'priyaydi', 'Lost Ticket', 'XOFQZS1D -  I Lost Because'),
(8, 'Agus Supriatna', 'ASK REFUND', ' XOFQZS1D');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(10) NOT NULL,
  `reservation_code` varchar(8) NOT NULL,
  `reservation_date` timestamp NULL DEFAULT NULL,
  `rute_id` int(3) NOT NULL,
  `return_rute_id` int(3) DEFAULT NULL,
  `contact_id` int(10) DEFAULT NULL,
  `payment_check` tinyint(1) NOT NULL DEFAULT '0',
  `printed` tinyint(1) NOT NULL DEFAULT '0',
  `payment_proof` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `reservation_code`, `reservation_date`, `rute_id`, `return_rute_id`, `contact_id`, `payment_check`, `printed`, `payment_proof`) VALUES
(11, '76013924', '2018-03-18 06:25:48', 4, NULL, 19, 1, 0, ''),
(12, '67809235', '2018-03-18 06:27:10', 4, NULL, 21, 1, 1, ''),
(13, '36590481', '2018-03-18 06:31:06', 4, NULL, 5, 1, 1, ''),
(14, '42801739', '2018-04-08 01:51:15', 16, NULL, 26, 0, 0, ''),
(15, '84159307', '2018-04-08 10:27:16', 17, NULL, 27, 0, 0, ''),
(16, '12836749', '2018-04-10 07:59:22', 16, NULL, 29, 0, 0, ''),
(17, '86029137', '2018-04-10 08:27:45', 16, NULL, 32, 0, 0, '41 - ada.PNG'),
(18, '51406287', '2018-04-10 10:46:11', 16, NULL, 34, 0, 0, ''),
(19, 'I3CTZES5', '2018-04-10 14:26:09', 18, NULL, 35, 0, 0, ''),
(20, '0D73EFN4', '2018-04-10 17:11:52', 18, NULL, 38, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `rute`
--

CREATE TABLE `rute` (
  `id` int(3) NOT NULL,
  `depart_at` timestamp NULL DEFAULT NULL,
  `rute_from` varchar(50) NOT NULL,
  `rute_to` varchar(50) NOT NULL,
  `duration` varchar(5) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `transportation_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rute`
--

INSERT INTO `rute` (`id`, `depart_at`, `rute_from`, `rute_to`, `duration`, `price`, `transportation_id`) VALUES
(4, '2018-03-17 05:00:00', 'BDO - Bandung', 'HLP - Jakarta', '02:00', '-255000', 1),
(5, '2018-03-18 05:00:00', 'HLP - Jakarta', 'BDO - Bandung', '01:00', '250000', 2),
(7, '2018-04-06 05:00:00', 'SUB - Surabaya', 'SRG - Semarang', '01:00', '33333333', 5),
(16, '2018-04-07 05:00:00', 'BDO - Bandung', 'HLP - Jakarta', '11:00', '100000', 8),
(17, '2018-04-07 05:00:00', 'Bandung', 'Jakarta', '13:00', '12121212', 9),
(18, '2018-04-10 10:00:00', 'BDO - Bandung', 'HLP - Jakarta', '02:00', '500000', 10);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(10) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `seat_code` varchar(4) NOT NULL,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `reservation_id`, `customer_id`, `seat_code`, `price`) VALUES
(13, 11, 21, '9817', '255000'),
(14, 11, 20, '8365', '255000'),
(15, 12, 19, '4017', '255000'),
(16, 12, 20, '5381', '255000'),
(17, 13, 22, '1582', '216750'),
(18, 13, 23, '8964', '216750'),
(19, 14, 26, '86', '100000'),
(20, 15, 28, '72', '12121212'),
(21, 16, 30, '46', '100000'),
(22, 16, 31, '25', '100000'),
(23, 17, 32, '98', '100000'),
(24, 17, 33, '91', '100000'),
(25, 18, 35, '19', '100000'),
(26, 19, 35, 'IB', '500000'),
(27, 20, 38, 'BK', '500000');

-- --------------------------------------------------------

--
-- Table structure for table `transportation`
--

CREATE TABLE `transportation` (
  `id` int(3) NOT NULL,
  `code` varchar(6) NOT NULL,
  `description` varchar(100) NOT NULL,
  `seat_qty` int(4) NOT NULL,
  `seat_avail` int(4) NOT NULL,
  `type_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transportation`
--

INSERT INTO `transportation` (`id`, `code`, `description`, `seat_qty`, `seat_avail`, `type_id`) VALUES
(1, 'A-121', 'Air Asia 1212', 5, 5, 2),
(2, 'B-747', 'Boeing 747', 33, 33, 2),
(5, 'C-12', 'Cacan', 5, 5, 2),
(8, 'F-01', 'HERCULES', 10, 10, 2),
(9, 'K-01', 'Kereta Api A', 12, 12, 1),
(10, 'O-1231', 'OLAF', 3, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(2) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `description`) VALUES
(1, 'Train'),
(2, 'Plane');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(62) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(1) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `forgot_pass` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `level`, `remember_token`, `created_at`, `updated_at`, `forgot_pass`) VALUES
(1, 'Administrator', 'admin@mail.id', '$2y$10$HGhoaIm9KwUdyBaTNinnnuQiqGU4eEP6DgRCQfmpSD7pKPs60Lhdq', 3, 'FxQF0NYxvtGUkJHnvtqOjqaS1aZrrTcJagdaoMD6FltVEQx1GUBiToYQrB4p', NULL, NULL, ''),
(2, 'Dimas Anom Priyayi', 'priyayidimas@mail.id', '$2y$10$/w.uDw1mtK/yrLoB2QzlneoP76vGWfdmb01tQBYLzyO0K9isaBGv2', 1, 'nb5UkphKiuUWoL504IJfyC4YK7IuJdNVcsJqdzLr8qzt3ZV8YhAYTeGT37ga', '2018-03-08 02:27:19', '2018-03-12 09:28:12', '120ebf261d09366b9323b7d93344cf564c26e397a935894657fac33f3f6a6d9a'),
(4, 'Dante Mendoza', 'mendoza@mail.id', '$2y$10$N6NuwQoZznypanJJBCFajuZdaf4/ATivmZPEMWXJMbzk0zyMGhmSq', 1, 'D5tn6y1VubK7VoAj0ixNJjbBHlike2kFdwae7pMiuIYqSzfxXVoKq5rmro3j', '2018-03-17 06:36:40', NULL, ''),
(6, 'Dimas Anom Priyayi', 'priyayi_dimas@yahoo.com', '$2y$10$pqOEyyRzC.VZ4cKcyqQIH.Yl//ZzJjZUE3QT4XN7XgBt87mHEkvii', 1, '9MwqhHzFlgQp7fG1DG1b1811zENsByWBw0ULiVfH9ldnDY5FzKwl14iQSgx0', '2018-04-10 11:54:46', NULL, 'ef3e5010bc3100a24a8e40fda775eed0106774bc1de3776b5d4250bbd08b9006'),
(7, 'Agus Supriatna', 'agus@mail.id', '$2y$10$CLzstQIrfRDi0EBIINLSo.0zegOTtMpSmHGuQ/F9UKEEK88i8.meq', 1, NULL, '2018-04-10 12:21:28', NULL, 'a7bb6b70c508c5d3be49cbd33e269b4b14717bdda4134773c4d0b4d55f300d70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`users_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rute_id` (`rute_id`),
  ADD KEY `return_rute_id` (`return_rute_id`),
  ADD KEY `contact_id` (`contact_id`);

--
-- Indexes for table `rute`
--
ALTER TABLE `rute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transportation_id` (`transportation_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_id` (`reservation_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `transportation`
--
ALTER TABLE `transportation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transportation_type_id` (`type_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
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
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `rute`
--
ALTER TABLE `rute`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `transportation`
--
ALTER TABLE `transportation`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`rute_id`) REFERENCES `rute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`return_rute_id`) REFERENCES `rute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_4` FOREIGN KEY (`contact_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rute`
--
ALTER TABLE `rute`
  ADD CONSTRAINT `rute_ibfk_1` FOREIGN KEY (`transportation_id`) REFERENCES `transportation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transportation`
--
ALTER TABLE `transportation`
  ADD CONSTRAINT `transportation_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

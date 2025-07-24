-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2025 at 07:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `k-nect`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `user_id` int(11) NOT NULL,
  `address_type` tinyint(1) NOT NULL,
  `house_number` int(20) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `subdivision` varchar(100) DEFAULT NULL,
  `barangay` int(10) NOT NULL,
  `municipality` int(10) NOT NULL,
  `province` int(10) NOT NULL,
  `region` int(10) NOT NULL,
  `zone_purok` int(10) DEFAULT NULL,
  `zip_code` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`user_id`, `address_type`, `house_number`, `street`, `subdivision`, `barangay`, `municipality`, `province`, `region`, `zone_purok`, `zip_code`, `created_at`, `updated_at`) VALUES
(1, 0, NULL, NULL, NULL, 28, 0, 0, 0, 9, NULL, '2025-07-22 18:18:50', '2025-07-22 10:18:50'),
(2, 0, NULL, NULL, NULL, 16, 1, 1, 1, 5, NULL, '2025-07-23 15:46:53', '2025-07-23 07:46:53'),
(3, 0, NULL, NULL, NULL, 35, 1, 1, 1, 6, NULL, '2025-07-23 15:27:17', '2025-07-23 07:27:17'),
(4, 0, NULL, NULL, NULL, 33, 1, 1, 1, 2, NULL, '2025-07-23 17:55:20', '2025-07-23 09:55:20'),
(5, 0, NULL, NULL, NULL, 7, 0, 0, 0, 1, NULL, '2025-07-22 06:50:23', '2025-07-22 06:50:23'),
(6, 0, NULL, NULL, NULL, 28, 0, 0, 0, 3, NULL, '2025-07-22 07:05:56', '2025-07-22 07:05:56'),
(7, 0, NULL, NULL, NULL, 19, 1, 1, 1, 2, NULL, '2025-07-23 07:29:12', '2025-07-23 07:29:12');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `rfid_code` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `suffix` varchar(5) DEFAULT NULL,
  `sex` tinyint(1) NOT NULL,
  `birthdate` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `sk_username` varchar(50) DEFAULT NULL,
  `sk_password` varchar(255) DEFAULT NULL,
  `ped_username` varchar(50) DEFAULT NULL,
  `ped_password` varchar(255) DEFAULT NULL,
  `phone_number` varchar(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `position` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `user_type` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `rfid_code`, `user_id`, `last_name`, `first_name`, `middle_name`, `suffix`, `sex`, `birthdate`, `email`, `sk_username`, `sk_password`, `ped_username`, `ped_password`, `phone_number`, `username`, `password`, `position`, `status`, `user_type`, `is_active`, `last_login`, `created_at`, `updated_at`) VALUES
(1, NULL, 860241, 'Luzano', 'Christian Nico', 'Brizuela', '', 1, '2004-01-22', 'christiannicoluzano15@gmail.com', 'SK_ChristianNicoLuzano', '$2y$10$O9OTgMuWtQ00LAgv52fgPu9WD7dEgrvhhOGjQCUPn.nOsRFi9BEcS', 'PED_ChristianNicoLuzano', '630abeb4', '09451971854', 'christiannico', '$2y$10$8EbwOkG.cwfAN0ggsb7nHuLSImvgz0YfG/YeaAxL.VEGfNgFJa9xm', 1, 2, 3, 1, NULL, '2025-07-23 17:55:50', '2025-07-22 10:18:49'),
(2, NULL, 893902, 'Lontayao', 'Jon Mare Edric', 'Parma', '', 1, '2003-05-29', 'jolontayao@gmail.com', NULL, NULL, NULL, NULL, '12344656789', 'jonmare', '$2y$10$PuHEUqHkiDBpW3ZCWC.dcO/GWRvJbG4EMXRcrI6nyTmAKf00lCWpa', NULL, 1, 1, 1, NULL, '2025-07-23 15:53:11', '2025-07-23 07:53:11'),
(3, NULL, NULL, 'Landong', 'Ike Renson', '', '', 1, '2003-05-23', 'ikelandong@gmail.com', NULL, NULL, NULL, NULL, '091234567892', 'ikelandong', '$2y$10$Ll8gp7AFUKM0dfz2n2ezXegQYXaWnHiQdkly6zTOmctb/P2porGpO', 1, 1, 1, 1, NULL, '2025-07-23 15:27:17', '2025-07-23 07:27:17'),
(4, NULL, NULL, 'Valera', 'Reymelene', 'espirito', '', 2, '2003-06-09', 'reyvalera@gmail.com', NULL, NULL, NULL, NULL, '12344656789', 'reyvalera', '$2y$10$qSkxlKpMzZKsvnNLXDA7veAZTr5TxV25qoN9RN2jrLxGxOyAYn/fC', NULL, 3, 1, 1, NULL, '2025-07-23 17:55:00', '2025-07-23 09:54:24'),
(5, NULL, 432106, 'Bayos', 'Dominic', 'Barandon', '', 1, '2003-07-17', 'dobayos@my.cspc.edu.ph', 'SEC_DominicBayos', 'b1b12e68', NULL, NULL, '091321323', 'dobayos', '$2y$10$l2SfOuFCSe9xhFajkziHFuxae5pCJMlGSKTfibYVDpdN4k3uK8OSe', 3, 2, 2, 1, NULL, '2025-07-22 17:02:18', '2025-07-22 09:02:18'),
(6, NULL, NULL, 'Barte', 'Jan Andrew', 'Rivera', '', 1, '2003-11-05', 'janbarte@gmail.com', NULL, NULL, NULL, NULL, '092342343', 'janbarte', '$2y$10$X8i.3WJEEi4jZ2OT6mKyGeUVHyG8GXXzJ0qFaP6B9hRzrm811YV06', NULL, 1, 1, 1, NULL, '2025-07-22 07:05:56', '2025-07-22 07:05:56'),
(7, NULL, NULL, 'Tipanero', 'Ian Jay', '', '', 1, '2004-05-04', 'iantipanero@gmail.com', NULL, NULL, NULL, NULL, '0891321312', 'iantipanero', '$2y$10$Ep78N9Ib/mATYiJPomBeDu38QOouEdQKWB601hMLUknvprH2blO7W', NULL, 1, 1, 1, NULL, '2025-07-23 16:22:39', '2025-07-23 08:22:39');

-- --------------------------------------------------------

--
-- Table structure for table `user_ext_info`
--

CREATE TABLE `user_ext_info` (
  `user_id` int(11) NOT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `civil_status` tinyint(1) NOT NULL,
  `youth_classification` tinyint(1) NOT NULL,
  `age_group` tinyint(1) NOT NULL,
  `work_status` tinyint(1) NOT NULL,
  `educational_background` tinyint(1) NOT NULL,
  `sk_voter` tinyint(1) NOT NULL,
  `sk_election` tinyint(1) NOT NULL,
  `national_voter` tinyint(1) NOT NULL,
  `kk_assembly` tinyint(1) NOT NULL,
  `how_many_times` tinyint(1) DEFAULT NULL,
  `no_why` tinyint(1) DEFAULT NULL,
  `birth_certificate` varchar(255) DEFAULT NULL,
  `upload_id` varchar(255) DEFAULT NULL,
  `profession` varchar(100) DEFAULT NULL,
  `birth_city` varchar(50) DEFAULT NULL,
  `birth_province` varchar(50) DEFAULT NULL,
  `spounce_name` varchar(50) DEFAULT NULL,
  `resident_years_ph` tinyint(4) DEFAULT NULL,
  `resident_months_ph` tinyint(4) DEFAULT NULL,
  `resident_year_brgy` tinyint(4) DEFAULT NULL,
  `resident_month_brgy` tinyint(4) DEFAULT NULL,
  `precinct` varchar(20) DEFAULT NULL,
  `register_voter_brgy` varchar(45) DEFAULT NULL,
  `register_voter_city` varchar(45) DEFAULT NULL,
  `register_voter_province` varchar(45) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `reason` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_ext_info`
--

INSERT INTO `user_ext_info` (`user_id`, `nickname`, `civil_status`, `youth_classification`, `age_group`, `work_status`, `educational_background`, `sk_voter`, `sk_election`, `national_voter`, `kk_assembly`, `how_many_times`, `no_why`, `birth_certificate`, `upload_id`, `profession`, `birth_city`, `birth_province`, `spounce_name`, `resident_years_ph`, `resident_months_ph`, `resident_year_brgy`, `resident_month_brgy`, `precinct`, `register_voter_brgy`, `register_voter_city`, `register_voter_province`, `profile_picture`, `reason`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 1, 2, 2, 6, 1, 1, 0, 1, 1, NULL, 'birthcert_687f54d2eb4e7.pdf', 'idpic_687f54d2ec94a.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'profilepic_687f56ee80c58.jpg', 'need to reupload the documents', '2025-07-22 01:16:32', '2025-07-22 10:18:50'),
(2, NULL, 1, 1, 2, 1, 6, 1, 1, 1, 1, 1, NULL, 'birthcert_687f5c22dc087.jpg', 'idpic_687f5c22dce20.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'profilepic_6880ffdfdfa17.jpg', '', '2025-07-22 01:44:34', '2025-07-23 07:29:37'),
(3, NULL, 1, 1, 2, 1, 6, 1, 1, 1, 1, 1, NULL, 'birthcert_6880ff1f49b99.jpg', 'idpic_6880ff1f4ab3f.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'profilepic_6880ff52e65ba.jpg', 'dededeedea', '2025-07-22 06:37:48', '2025-07-23 07:27:17'),
(4, NULL, 1, 1, 2, 2, 6, 1, 1, 1, 1, 1, NULL, 'birthcert_687fa48238482.pdf', 'idpic_687fa48239bac.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'profilepic_687fa4ac5892f.jpg', '', '2025-07-22 06:48:15', '2025-07-23 09:55:20'),
(5, NULL, 1, 1, 2, 1, 4, 1, 1, 1, 1, 1, NULL, '', 'idpic_687fa5196d557.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'profilepic_687fa52cece44.jpg', '', '2025-07-22 06:50:23', '2025-07-22 06:50:23'),
(6, NULL, 1, 1, 2, 2, 6, 0, 1, 0, 0, NULL, 0, 'birthcert_687fa8547f7d6.pdf', 'idpic_687fa854805da.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'profilepic_687fa8d29bd43.png', '', '2025-07-22 07:05:56', '2025-07-22 07:05:56'),
(7, NULL, 1, 1, 2, 1, 6, 1, 1, 1, 1, 2, NULL, 'birthcert_6880ffa515d04.pdf', 'idpic_6880ffa516674.pdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'profilepic_6880ffc6b3c12.png', '', '2025-07-23 07:29:12', '2025-07-23 07:29:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD KEY `fk_address_user` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rfid_code` (`rfid_code`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `user_ext_info`
--
ALTER TABLE `user_ext_info`
  ADD KEY `fk_user_ext_info_user` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `fk_address_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_ext_info`
--
ALTER TABLE `user_ext_info`
  ADD CONSTRAINT `fk_user_ext_info_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2024 at 08:18 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `patient_info_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$ci21pyf8O6m0O9PotOysjebgq08E3TPuUkFF5OOYkmMZ7YMyT92vW'),
(2, 'Frank Ngetich', 'Frank254'),
(3, 'admin', '$2y$10$VmRddCyjdjG8uc58WFW17.Ux8H1q5CZ99DBOEsfKEr5pTav7L2Er6'),
(4, 'admin', '$2y$10$SKyvOyv1R5CfsUnt.50NzuH/vAYoaT9QQohc5nl1vdIdPqRjPWfLO'),
(5, 'frank', '$2y$10$ayw6vSXZJrdnnLpn8/SiIuc2gCDOvz20iNDgUarh08L9DRa.51NTi');

-- --------------------------------------------------------

--
-- Table structure for table `healthcare_providers`
--

CREATE TABLE `healthcare_providers` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('civilian','healthcare_provider','admin') NOT NULL,
  `approved` tinyint(1) DEFAULT 0,
  `medical_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `healthcare_providers`
--

INSERT INTO `healthcare_providers` (`id`, `username`, `password`, `role`, `approved`, `medical_no`) VALUES
(8, 'Frank Ngetich', '$2y$10$UCEV8f0tFfDG0boeH31KKuvHbGIe.DiFxZkXIa8urbxWsZ14HS5QC', 'civilian', 1, 'DOC123'),
(9, 'frank', '$2y$10$ARagpgqmgzRE/MEDjh5FYuMJnTt/k0v5tpYONg.pv8XH9qgc.X8v.', 'civilian', 1, 'DOC124');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `fingerprint_data` blob NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `residence` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `allergies` text DEFAULT NULL,
  `medical_history` text DEFAULT NULL,
  `current_medication` text DEFAULT NULL,
  `emergency_contact_name` varchar(255) NOT NULL,
  `emergency_contact_relation` varchar(255) NOT NULL,
  `emergency_contact_phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `fingerprint_data`, `name`, `date_of_birth`, `gender`, `first_name`, `last_name`, `age`, `nationality`, `residence`, `contact`, `allergies`, `medical_history`, `current_medication`, `emergency_contact_name`, `emergency_contact_relation`, `emergency_contact_phone`) VALUES
(1, 0x46494e4745525052494e545f44415441, 'Frank Ngetich', '1998-12-26', 'male', '', '', 0, '', '', '', NULL, NULL, NULL, '', '', ''),
(2, 0x46494e4745525052494e545f44415441, 'Frank Ngetich', '1998-12-26', 'male', '', '', 0, '', '', '', NULL, NULL, NULL, '', '', ''),
(3, 0x46494e4745525052494e545f44415441, 'Frank ', '2024-07-10', 'male', '', '', 0, '', '', '', NULL, NULL, NULL, '', '', ''),
(4, 0x46494e4745525052494e545f44415441, 'Frank ', '1998-12-26', 'Male', '', '', 0, '', '', '', NULL, NULL, NULL, '', '', ''),
(5, '', NULL, '1994-12-25', NULL, 'Jackson', 'Omondi', 30, 'Kenyan', 'Kisumu', '0722473292', '', '', '', 'Jackline Omondi', 'wife', '0715272473'),
(6, '', NULL, '1998-12-25', NULL, 'Jackson', 'Omondi', 30, 'Kenyan', 'Kisumu', '0722473292', '', '', '', 'Jackline Omondi', 'wife', '0715272473');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('civilian','healthcare_provider','admin') NOT NULL,
  `approved` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `healthcare_providers`
--
ALTER TABLE `healthcare_providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `healthcare_providers`
--
ALTER TABLE `healthcare_providers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

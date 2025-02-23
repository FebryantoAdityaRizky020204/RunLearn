-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 18, 2025 at 03:22 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sahabat_satwa`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_clinic`
--

CREATE TABLE `tb_clinic` (
  `clinic_id` varchar(10) NOT NULL,
  `clinic_name` varchar(255) NOT NULL,
  `clinic_address` varchar(255) NOT NULL,
  `clinic_num_telp` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_follow_up_visit`
--

CREATE TABLE `tb_follow_up_visit` (
  `fu_visit_id` varchar(10) NOT NULL,
  `visit_previous` varchar(255) DEFAULT NULL,
  `fu_visit_action` text NOT NULL,
  `visit_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_medicine`
--

CREATE TABLE `tb_medicine` (
  `med_id` varchar(10) NOT NULL,
  `med_name` varchar(255) NOT NULL,
  `med_direction` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pawrent`
--

CREATE TABLE `tb_pawrent` (
  `paw_id` varchar(10) NOT NULL,
  `paw_fullname` varchar(255) NOT NULL,
  `pawr_num_telp` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pet`
--

CREATE TABLE `tb_pet` (
  `pet_id` varchar(10) NOT NULL,
  `pet_name` varchar(255) NOT NULL,
  `pet_year_of_birth` varchar(255) NOT NULL,
  `pet_type` varchar(255) NOT NULL,
  `paw_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_recipe`
--

CREATE TABLE `tb_recipe` (
  `recipe_id` varchar(10) NOT NULL,
  `med_id` varchar(10) DEFAULT NULL,
  `visit_id` varchar(10) DEFAULT NULL,
  `med_dose` varchar(50) NOT NULL,
  `med_frekuensi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_veterinarian`
--

CREATE TABLE `tb_veterinarian` (
  `vet_id` varchar(10) NOT NULL,
  `vet_fullname` varchar(255) NOT NULL,
  `vet_num_telp` varchar(15) NOT NULL,
  `vet_start_date` date NOT NULL,
  `vet_contract_status` varchar(50) NOT NULL,
  `clinic_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_veterinarian_specialist`
--

CREATE TABLE `tb_veterinarian_specialist` (
  `vet_sp_id` varchar(10) NOT NULL,
  `vet_id` varchar(10) DEFAULT NULL,
  `specialist_field` varchar(255) NOT NULL,
  `vet_sp_contract_status` varchar(50) NOT NULL,
  `clinic_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_visit`
--

CREATE TABLE `tb_visit` (
  `visit_id` varchar(10) NOT NULL,
  `visit_date` date NOT NULL,
  `pet_id` varchar(10) DEFAULT NULL,
  `vet_id` varchar(10) DEFAULT NULL,
  `clinic_id` varchar(10) DEFAULT NULL,
  `visit_diaknosa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_clinic`
--
ALTER TABLE `tb_clinic`
  ADD PRIMARY KEY (`clinic_id`);

--
-- Indexes for table `tb_follow_up_visit`
--
ALTER TABLE `tb_follow_up_visit`
  ADD PRIMARY KEY (`fu_visit_id`),
  ADD KEY `visit_id` (`visit_id`);

--
-- Indexes for table `tb_medicine`
--
ALTER TABLE `tb_medicine`
  ADD PRIMARY KEY (`med_id`);

--
-- Indexes for table `tb_pawrent`
--
ALTER TABLE `tb_pawrent`
  ADD PRIMARY KEY (`paw_id`);

--
-- Indexes for table `tb_pet`
--
ALTER TABLE `tb_pet`
  ADD PRIMARY KEY (`pet_id`),
  ADD KEY `fk_paw_id` (`paw_id`);

--
-- Indexes for table `tb_recipe`
--
ALTER TABLE `tb_recipe`
  ADD PRIMARY KEY (`recipe_id`),
  ADD KEY `med_id` (`med_id`),
  ADD KEY `visit_id` (`visit_id`);

--
-- Indexes for table `tb_veterinarian`
--
ALTER TABLE `tb_veterinarian`
  ADD PRIMARY KEY (`vet_id`),
  ADD KEY `clinic_id` (`clinic_id`);

--
-- Indexes for table `tb_veterinarian_specialist`
--
ALTER TABLE `tb_veterinarian_specialist`
  ADD PRIMARY KEY (`vet_sp_id`),
  ADD KEY `vet_id` (`vet_id`),
  ADD KEY `clinic_id` (`clinic_id`);

--
-- Indexes for table `tb_visit`
--
ALTER TABLE `tb_visit`
  ADD PRIMARY KEY (`visit_id`),
  ADD KEY `pet_id` (`pet_id`),
  ADD KEY `vet_id` (`vet_id`),
  ADD KEY `clinic_id` (`clinic_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_follow_up_visit`
--
ALTER TABLE `tb_follow_up_visit`
  ADD CONSTRAINT `tb_follow_up_visit_ibfk_1` FOREIGN KEY (`visit_id`) REFERENCES `tb_visit` (`visit_id`);

--
-- Constraints for table `tb_pet`
--
ALTER TABLE `tb_pet`
  ADD CONSTRAINT `fk_paw_id` FOREIGN KEY (`paw_id`) REFERENCES `tb_pawrent` (`paw_id`);

--
-- Constraints for table `tb_recipe`
--
ALTER TABLE `tb_recipe`
  ADD CONSTRAINT `tb_recipe_ibfk_1` FOREIGN KEY (`med_id`) REFERENCES `tb_medicine` (`med_id`),
  ADD CONSTRAINT `tb_recipe_ibfk_2` FOREIGN KEY (`visit_id`) REFERENCES `tb_visit` (`visit_id`);

--
-- Constraints for table `tb_veterinarian`
--
ALTER TABLE `tb_veterinarian`
  ADD CONSTRAINT `tb_veterinarian_ibfk_1` FOREIGN KEY (`clinic_id`) REFERENCES `tb_clinic` (`clinic_id`);

--
-- Constraints for table `tb_veterinarian_specialist`
--
ALTER TABLE `tb_veterinarian_specialist`
  ADD CONSTRAINT `clinic_id` FOREIGN KEY (`clinic_id`) REFERENCES `tb_clinic` (`clinic_id`),
  ADD CONSTRAINT `vet_id` FOREIGN KEY (`vet_id`) REFERENCES `tb_veterinarian` (`vet_id`);

--
-- Constraints for table `tb_visit`
--
ALTER TABLE `tb_visit`
  ADD CONSTRAINT `tb_visit_ibfk_1` FOREIGN KEY (`pet_id`) REFERENCES `tb_pet` (`pet_id`),
  ADD CONSTRAINT `tb_visit_ibfk_2` FOREIGN KEY (`vet_id`) REFERENCES `tb_veterinarian` (`vet_id`),
  ADD CONSTRAINT `tb_visit_ibfk_3` FOREIGN KEY (`clinic_id`) REFERENCES `tb_clinic` (`clinic_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 21, 2025 at 03:36 PM
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
-- Database: `sahabat_satwa`
--

-- --------------------------------------------------------

--
-- Table structure for table `animal`
--

CREATE TABLE `animal` (
  `animal_id` int NOT NULL,
  `animal_name` varchar(40) NOT NULL,
  `animal_born` date NOT NULL,
  `owner_id` int NOT NULL,
  `at_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `animal`
--

INSERT INTO `animal` (`animal_id`, `animal_name`, `animal_born`, `owner_id`, `at_id`) VALUES
(1, 'Cast', '2022-12-12', 3, 1),
(3, 'Gukk', '2020-02-12', 3, 2),
(4, 'Mint', '2020-06-01', 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `animal_type`
--

CREATE TABLE `animal_type` (
  `at_id` int NOT NULL,
  `at_description` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `animal_type`
--

INSERT INTO `animal_type` (`at_id`, `at_description`) VALUES
(1, 'Kucing'),
(2, 'Anjing');

-- --------------------------------------------------------

--
-- Table structure for table `clinic`
--

CREATE TABLE `clinic` (
  `clinic_id` int NOT NULL,
  `clinic_name` varchar(50) NOT NULL,
  `clinic_address` varchar(80) NOT NULL,
  `clinic_phone` varchar(14) NOT NULL,
  `clinic_start_day` varchar(15) NOT NULL,
  `clinic_end_day` varchar(15) NOT NULL,
  `clinic_start_time` time NOT NULL,
  `clinic_end_time` time NOT NULL,
  `clinic_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `clinic`
--

INSERT INTO `clinic` (`clinic_id`, `clinic_name`, `clinic_address`, `clinic_phone`, `clinic_start_day`, `clinic_end_day`, `clinic_start_time`, `clinic_end_time`, `clinic_status`) VALUES
(1, 'Sahabat Satwa Center', 'Jl. Yos Sudarso No.311', '987654', 'Senin', 'Jumat', '08:00:00', '16:00:00', 'Normal'),
(3, 'Sahabat Satwa Cab. Meranti', 'Jl. Meranti No.26', '8984293', 'Senin', 'Jumat', '08:00:00', '16:00:00', 'Normal');

-- --------------------------------------------------------

--
-- Table structure for table `drug`
--

CREATE TABLE `drug` (
  `drug_id` int NOT NULL,
  `drug_name` varchar(50) NOT NULL,
  `drug_usage` varchar(100) NOT NULL,
  `stock` int NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `drug`
--

INSERT INTO `drug` (`drug_id`, `drug_name`, `drug_usage`, `stock`, `price`) VALUES
(2, 'Amoxicillin', 'Antibiotic for infections', 20, 5000),
(3, 'Metacam', 'Pain relief', 20, 10000),
(4, 'Doxycycline', 'Antibiotic for bacterial infections', 20, 15000);

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `owner_id` int NOT NULL,
  `owner_givenname` varchar(30) DEFAULT NULL,
  `owner_familyname` varchar(30) DEFAULT NULL,
  `owner_address` varchar(100) NOT NULL,
  `owner_phone` int DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`owner_id`, `owner_givenname`, `owner_familyname`, `owner_address`, `owner_phone`, `username`, `password`) VALUES
(3, 'adit', 'rizky', 'adadeh', 1234, '1234', '$2y$10$neG8y6YZdr.qblV3hNIKzu6/.Cy4.Wm/C9Sg5Z/Sokqiuk1C.0hTy'),
(5, 'Meylia', 'Wijayanti', 'Jl. Coba', 987, '0987', '$2y$10$xwW80m5U0mGnHtquwScOIetT.5m3YPvqaVLYGiZNwQJge0A.kzdIe');

-- --------------------------------------------------------

--
-- Table structure for table `petugas_administrasi`
--

CREATE TABLE `petugas_administrasi` (
  `petugasadmin_id` int NOT NULL,
  `petugasadmin_nama` varchar(30) DEFAULT NULL,
  `petugasadmin_nohp` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `clinic_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `petugas_administrasi`
--

INSERT INTO `petugas_administrasi` (`petugasadmin_id`, `petugasadmin_nama`, `petugasadmin_nohp`, `username`, `password`, `clinic_id`) VALUES
(3, 'Adit', 56789, 'coba', '$2y$10$7g1piUSivrooGjkt0CeC0eurXNBN2uJi5W8aNQVNLdPRWLOguu7TW', 1);

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE `queue` (
  `queue_id` int NOT NULL,
  `clinic_id` int NOT NULL,
  `owner_id` int NOT NULL,
  `animal_id` int NOT NULL,
  `queue_number` int NOT NULL,
  `queue_date` date NOT NULL,
  `queue_status` varchar(20) NOT NULL,
  `vet_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `queue`
--

INSERT INTO `queue` (`queue_id`, `clinic_id`, `owner_id`, `animal_id`, `queue_number`, `queue_date`, `queue_status`, `vet_id`) VALUES
(1, 1, 1, 1, 1, '2025-05-19', 'cancel', 1),
(2, 1, 3, 3, 1, '2025-05-20', 'finish', 1),
(4, 1, 3, 1, 1, '2025-05-20', 'finish', 1),
(5, 1, 3, 1, 1, '2025-05-21', 'doktercheck', 1);

-- --------------------------------------------------------

--
-- Table structure for table `specialisation`
--

CREATE TABLE `specialisation` (
  `spec_id` int NOT NULL,
  `spec_description` varchar(30) NOT NULL,
  `medical_cost` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `specialisation`
--

INSERT INTO `specialisation` (`spec_id`, `spec_description`, `medical_cost`) VALUES
(1, 'General', 120000);

-- --------------------------------------------------------

--
-- Table structure for table `spec_visit`
--

CREATE TABLE `spec_visit` (
  `clinic_id` int NOT NULL,
  `vet_id` int NOT NULL,
  `sv_count` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `superadmin`
--

CREATE TABLE `superadmin` (
  `admin_id` int NOT NULL,
  `nama_admin` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `superadmin`
--

INSERT INTO `superadmin` (`admin_id`, `nama_admin`, `username`, `password`) VALUES
(1, 'Ahmad Iqbal', 'admin', '$2y$10$a5fGP4gIUtaSX6UMdkSFSu63FLLWrBKvmDJ7OB.tLMdxS84E6HMRC');

-- --------------------------------------------------------

--
-- Table structure for table `vet`
--

CREATE TABLE `vet` (
  `vet_id` int NOT NULL,
  `vet_title` char(4) NOT NULL,
  `vet_givenname` varchar(30) DEFAULT NULL,
  `vet_familyname` varchar(30) DEFAULT NULL,
  `vet_phone` varchar(14) NOT NULL,
  `vet_employed` date NOT NULL,
  `spec_id` int DEFAULT NULL,
  `clinic_id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vet`
--

INSERT INTO `vet` (`vet_id`, `vet_title`, `vet_givenname`, `vet_familyname`, `vet_phone`, `vet_employed`, `spec_id`, `clinic_id`, `username`, `password`) VALUES
(1, 'Dr.', 'Aditya', 'Rizky', '1234', '2004-02-02', 1, 1, '1234', '$2y$10$2KIu4tlq2Y680J63uwwsHeyo3zta4K0oo/TDrfWVHsXXBzhzyhGzW');

-- --------------------------------------------------------

--
-- Table structure for table `visit`
--

CREATE TABLE `visit` (
  `visit_id` int NOT NULL,
  `visit_date_time` date NOT NULL,
  `visit_notes` varchar(200) NOT NULL,
  `animal_id` int NOT NULL,
  `vet_id` int NOT NULL,
  `from_visit_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `visit`
--

INSERT INTO `visit` (`visit_id`, `visit_date_time`, `visit_notes`, `animal_id`, `vet_id`, `from_visit_id`) VALUES
(10, '2025-05-20', 'Sakit Baru', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visit_drug`
--

CREATE TABLE `visit_drug` (
  `visit_drug_dose` varchar(20) NOT NULL,
  `visit_drug_frequency` varchar(20) DEFAULT NULL,
  `visit_drug_qtysupplied` int NOT NULL,
  `drug_id` int NOT NULL,
  `visit_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `visit_drug`
--

INSERT INTO `visit_drug` (`visit_drug_dose`, `visit_drug_frequency`, `visit_drug_qtysupplied`, `drug_id`, `visit_id`) VALUES
('1 pil', '2 kali sehari', 2, 2, 10),
('1 pil', '3 kali sehari', 1, 3, 10);

--
-- Triggers `visit_drug`
--
DELIMITER $$
CREATE TRIGGER `cek_stok_obat_sebelum_pembelian` BEFORE INSERT ON `visit_drug` FOR EACH ROW BEGIN
  DECLARE stok_saat_ini INT;

  -- Ambil stok saat ini dari tabel drug
  SELECT `stock` INTO stok_saat_ini
  FROM `drug`
  WHERE `drug_id` = NEW.`drug_id`;

  -- Cek apakah stok mencukupi
  IF stok_saat_ini < NEW.`visit_drug_qtysupplied` THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Stock Obat tidak Mencukupi';
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `kurangi_stok_obat_setelah_pembelian` AFTER INSERT ON `visit_drug` FOR EACH ROW BEGIN
  UPDATE `drug`
  SET `stock` = `stock` - NEW.`visit_drug_qtysupplied`
  WHERE `drug`.`drug_id` = NEW.`drug_id`;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`animal_id`),
  ADD KEY `owner_id` (`owner_id`),
  ADD KEY `at_id` (`at_id`);

--
-- Indexes for table `animal_type`
--
ALTER TABLE `animal_type`
  ADD PRIMARY KEY (`at_id`);

--
-- Indexes for table `clinic`
--
ALTER TABLE `clinic`
  ADD PRIMARY KEY (`clinic_id`);

--
-- Indexes for table `drug`
--
ALTER TABLE `drug`
  ADD PRIMARY KEY (`drug_id`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `petugas_administrasi`
--
ALTER TABLE `petugas_administrasi`
  ADD PRIMARY KEY (`petugasadmin_id`),
  ADD KEY `clinic_id` (`clinic_id`);

--
-- Indexes for table `queue`
--
ALTER TABLE `queue`
  ADD PRIMARY KEY (`queue_id`),
  ADD KEY `clinic_id` (`clinic_id`),
  ADD KEY `animal_id` (`animal_id`);

--
-- Indexes for table `specialisation`
--
ALTER TABLE `specialisation`
  ADD PRIMARY KEY (`spec_id`);

--
-- Indexes for table `spec_visit`
--
ALTER TABLE `spec_visit`
  ADD PRIMARY KEY (`clinic_id`,`vet_id`),
  ADD KEY `vet_id` (`vet_id`);

--
-- Indexes for table `superadmin`
--
ALTER TABLE `superadmin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `vet`
--
ALTER TABLE `vet`
  ADD PRIMARY KEY (`vet_id`),
  ADD KEY `spec_id` (`spec_id`),
  ADD KEY `clinic_id` (`clinic_id`);

--
-- Indexes for table `visit`
--
ALTER TABLE `visit`
  ADD PRIMARY KEY (`visit_id`),
  ADD KEY `vet_id` (`vet_id`),
  ADD KEY `animal_id` (`animal_id`),
  ADD KEY `from_visit_id` (`from_visit_id`);

--
-- Indexes for table `visit_drug`
--
ALTER TABLE `visit_drug`
  ADD PRIMARY KEY (`visit_id`,`drug_id`),
  ADD KEY `drug_id` (`drug_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animal`
--
ALTER TABLE `animal`
  MODIFY `animal_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `animal_type`
--
ALTER TABLE `animal_type`
  MODIFY `at_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clinic`
--
ALTER TABLE `clinic`
  MODIFY `clinic_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `drug`
--
ALTER TABLE `drug`
  MODIFY `drug_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `owner_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `petugas_administrasi`
--
ALTER TABLE `petugas_administrasi`
  MODIFY `petugasadmin_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `queue`
--
ALTER TABLE `queue`
  MODIFY `queue_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `specialisation`
--
ALTER TABLE `specialisation`
  MODIFY `spec_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `spec_visit`
--
ALTER TABLE `spec_visit`
  MODIFY `clinic_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `superadmin`
--
ALTER TABLE `superadmin`
  MODIFY `admin_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vet`
--
ALTER TABLE `vet`
  MODIFY `vet_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `visit`
--
ALTER TABLE `visit`
  MODIFY `visit_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `animal_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `owners` (`owner_id`),
  ADD CONSTRAINT `animal_ibfk_2` FOREIGN KEY (`at_id`) REFERENCES `animal_type` (`at_id`);

--
-- Constraints for table `petugas_administrasi`
--
ALTER TABLE `petugas_administrasi`
  ADD CONSTRAINT `petugas_administrasi_ibfk_1` FOREIGN KEY (`clinic_id`) REFERENCES `clinic` (`clinic_id`);

--
-- Constraints for table `queue`
--
ALTER TABLE `queue`
  ADD CONSTRAINT `queue_ibfk_1` FOREIGN KEY (`clinic_id`) REFERENCES `clinic` (`clinic_id`),
  ADD CONSTRAINT `queue_ibfk_2` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`animal_id`);

--
-- Constraints for table `spec_visit`
--
ALTER TABLE `spec_visit`
  ADD CONSTRAINT `spec_visit_ibfk_1` FOREIGN KEY (`vet_id`) REFERENCES `vet` (`vet_id`),
  ADD CONSTRAINT `spec_visit_ibfk_2` FOREIGN KEY (`clinic_id`) REFERENCES `clinic` (`clinic_id`);

--
-- Constraints for table `vet`
--
ALTER TABLE `vet`
  ADD CONSTRAINT `vet_ibfk_1` FOREIGN KEY (`spec_id`) REFERENCES `specialisation` (`spec_id`),
  ADD CONSTRAINT `vet_ibfk_2` FOREIGN KEY (`clinic_id`) REFERENCES `clinic` (`clinic_id`);

--
-- Constraints for table `visit`
--
ALTER TABLE `visit`
  ADD CONSTRAINT `visit_ibfk_1` FOREIGN KEY (`vet_id`) REFERENCES `vet` (`vet_id`),
  ADD CONSTRAINT `visit_ibfk_2` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`animal_id`),
  ADD CONSTRAINT `visit_ibfk_3` FOREIGN KEY (`from_visit_id`) REFERENCES `visit` (`visit_id`);

--
-- Constraints for table `visit_drug`
--
ALTER TABLE `visit_drug`
  ADD CONSTRAINT `visit_drug_ibfk_1` FOREIGN KEY (`visit_id`) REFERENCES `visit` (`visit_id`),
  ADD CONSTRAINT `visit_drug_ibfk_2` FOREIGN KEY (`drug_id`) REFERENCES `drug` (`drug_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

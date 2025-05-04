-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 23 Apr 2025 pada 02.09
-- Versi server: 8.0.30
-- Versi PHP: 8.3.12

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
-- Struktur dari tabel `animal`
--

CREATE TABLE `animal` (
  `animal_id` int NOT NULL,
  `animal_name` varchar(40) NOT NULL,
  `animal_born` date NOT NULL,
  `owner_id` int NOT NULL,
  `at_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `animal`
--

INSERT INTO `animal` (`animal_id`, `animal_name`, `animal_born`, `owner_id`, `at_id`) VALUES
(1, 'Dony', '2022-12-12', 3, 1),
(3, 'Dogy', '2020-02-12', 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `animal_type`
--

CREATE TABLE `animal_type` (
  `at_id` int NOT NULL,
  `at_description` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `animal_type`
--

INSERT INTO `animal_type` (`at_id`, `at_description`) VALUES
(1, 'Kucing'),
(2, 'Anjing');

-- --------------------------------------------------------

--
-- Struktur dari tabel `clinic`
--

CREATE TABLE `clinic` (
  `clinic_id` int NOT NULL,
  `clinic_name` varchar(50) NOT NULL,
  `clinic_address` varchar(80) NOT NULL,
  `clinic_phone` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `clinic`
--

INSERT INTO `clinic` (`clinic_id`, `clinic_name`, `clinic_address`, `clinic_phone`) VALUES
(1, 'Sahabat Satwa Center', 'Jl. Ndak Tau', '987654');

-- --------------------------------------------------------

--
-- Struktur dari tabel `drug`
--

CREATE TABLE `drug` (
  `drug_id` int NOT NULL,
  `drug_name` varchar(50) NOT NULL,
  `drug_usage` varchar(100) NOT NULL,
  `stock` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `owners`
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
-- Dumping data untuk tabel `owners`
--

INSERT INTO `owners` (`owner_id`, `owner_givenname`, `owner_familyname`, `owner_address`, `owner_phone`, `username`, `password`) VALUES
(3, 'adit', 'rizky', 'adadeh', 1234, 'adit', '$2y$10$7beQaNlxn5g3qpuQWLixXee5ACe9BBmqi6rytZltwBzbpz6Wdo8T.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas_administrasi`
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
-- Dumping data untuk tabel `petugas_administrasi`
--

INSERT INTO `petugas_administrasi` (`petugasadmin_id`, `petugasadmin_nama`, `petugasadmin_nohp`, `username`, `password`, `clinic_id`) VALUES
(1, 'adit', 987654321, '1234', '$2y$10$PhDP8uY1WCUOiO1lOhyfYunuxcjvr6H3ms3sRXiIcMe8q6Q7.0miS', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `specialisation`
--

CREATE TABLE `specialisation` (
  `spec_id` int NOT NULL,
  `spec_description` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `specialisation`
--

INSERT INTO `specialisation` (`spec_id`, `spec_description`) VALUES
(1, 'Surgery');

-- --------------------------------------------------------

--
-- Struktur dari tabel `spec_visit`
--

CREATE TABLE `spec_visit` (
  `clinic_id` int NOT NULL,
  `vet_id` int NOT NULL,
  `sv_count` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `superadmin`
--

CREATE TABLE `superadmin` (
  `admin_id` int NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `superadmin`
--

INSERT INTO `superadmin` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$AorFrxlGw9Vcp1qaWckwROH6tWZFGb7ty0gBqh6MiA75s9d6XB.ri');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vet`
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
-- Dumping data untuk tabel `vet`
--

INSERT INTO `vet` (`vet_id`, `vet_title`, `vet_givenname`, `vet_familyname`, `vet_phone`, `vet_employed`, `spec_id`, `clinic_id`, `username`, `password`) VALUES
(1, 'Dr.', 'Aditya', 'Rizky', '1234', '2004-02-02', 1, 1, '1234', '$2y$10$UqB8TpCXyv1LISqbhfr3iuaUlUFqfZt.apgwYHIAoL3BNSzTlF9u2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `visit`
--

CREATE TABLE `visit` (
  `visit_id` int NOT NULL,
  `visit_date_time` date NOT NULL,
  `visit_notes` varchar(200) NOT NULL,
  `animal_id` int NOT NULL,
  `vet_id` int NOT NULL,
  `from_visit_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `visit_drug`
--

CREATE TABLE `visit_drug` (
  `visit_drug_dose` varchar(20) NOT NULL,
  `visit_drug_frequency` varchar(20) DEFAULT NULL,
  `visit_drug_qtysupplied` int NOT NULL,
  `drug_id` int NOT NULL,
  `visit_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`animal_id`),
  ADD KEY `owner_id` (`owner_id`),
  ADD KEY `at_id` (`at_id`);

--
-- Indeks untuk tabel `animal_type`
--
ALTER TABLE `animal_type`
  ADD PRIMARY KEY (`at_id`);

--
-- Indeks untuk tabel `clinic`
--
ALTER TABLE `clinic`
  ADD PRIMARY KEY (`clinic_id`);

--
-- Indeks untuk tabel `drug`
--
ALTER TABLE `drug`
  ADD PRIMARY KEY (`drug_id`);

--
-- Indeks untuk tabel `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indeks untuk tabel `petugas_administrasi`
--
ALTER TABLE `petugas_administrasi`
  ADD PRIMARY KEY (`petugasadmin_id`),
  ADD KEY `clinic_id` (`clinic_id`);

--
-- Indeks untuk tabel `specialisation`
--
ALTER TABLE `specialisation`
  ADD PRIMARY KEY (`spec_id`);

--
-- Indeks untuk tabel `spec_visit`
--
ALTER TABLE `spec_visit`
  ADD PRIMARY KEY (`clinic_id`,`vet_id`),
  ADD KEY `vet_id` (`vet_id`);

--
-- Indeks untuk tabel `superadmin`
--
ALTER TABLE `superadmin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indeks untuk tabel `vet`
--
ALTER TABLE `vet`
  ADD PRIMARY KEY (`vet_id`),
  ADD KEY `spec_id` (`spec_id`),
  ADD KEY `clinic_id` (`clinic_id`);

--
-- Indeks untuk tabel `visit`
--
ALTER TABLE `visit`
  ADD PRIMARY KEY (`visit_id`),
  ADD KEY `vet_id` (`vet_id`),
  ADD KEY `animal_id` (`animal_id`),
  ADD KEY `from_visit_id` (`from_visit_id`);

--
-- Indeks untuk tabel `visit_drug`
--
ALTER TABLE `visit_drug`
  ADD PRIMARY KEY (`visit_id`,`drug_id`),
  ADD KEY `drug_id` (`drug_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `animal`
--
ALTER TABLE `animal`
  MODIFY `animal_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `animal_type`
--
ALTER TABLE `animal_type`
  MODIFY `at_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `clinic`
--
ALTER TABLE `clinic`
  MODIFY `clinic_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `drug`
--
ALTER TABLE `drug`
  MODIFY `drug_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `owners`
--
ALTER TABLE `owners`
  MODIFY `owner_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `petugas_administrasi`
--
ALTER TABLE `petugas_administrasi`
  MODIFY `petugasadmin_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `specialisation`
--
ALTER TABLE `specialisation`
  MODIFY `spec_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `spec_visit`
--
ALTER TABLE `spec_visit`
  MODIFY `clinic_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `superadmin`
--
ALTER TABLE `superadmin`
  MODIFY `admin_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `vet`
--
ALTER TABLE `vet`
  MODIFY `vet_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `visit`
--
ALTER TABLE `visit`
  MODIFY `visit_id` int NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `animal_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `owners` (`owner_id`),
  ADD CONSTRAINT `animal_ibfk_2` FOREIGN KEY (`at_id`) REFERENCES `animal_type` (`at_id`);

--
-- Ketidakleluasaan untuk tabel `petugas_administrasi`
--
ALTER TABLE `petugas_administrasi`
  ADD CONSTRAINT `petugas_administrasi_ibfk_1` FOREIGN KEY (`clinic_id`) REFERENCES `clinic` (`clinic_id`);

--
-- Ketidakleluasaan untuk tabel `spec_visit`
--
ALTER TABLE `spec_visit`
  ADD CONSTRAINT `spec_visit_ibfk_1` FOREIGN KEY (`vet_id`) REFERENCES `vet` (`vet_id`),
  ADD CONSTRAINT `spec_visit_ibfk_2` FOREIGN KEY (`clinic_id`) REFERENCES `clinic` (`clinic_id`);

--
-- Ketidakleluasaan untuk tabel `vet`
--
ALTER TABLE `vet`
  ADD CONSTRAINT `vet_ibfk_1` FOREIGN KEY (`spec_id`) REFERENCES `specialisation` (`spec_id`),
  ADD CONSTRAINT `vet_ibfk_2` FOREIGN KEY (`clinic_id`) REFERENCES `clinic` (`clinic_id`);

--
-- Ketidakleluasaan untuk tabel `visit`
--
ALTER TABLE `visit`
  ADD CONSTRAINT `visit_ibfk_1` FOREIGN KEY (`vet_id`) REFERENCES `vet` (`vet_id`),
  ADD CONSTRAINT `visit_ibfk_2` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`animal_id`),
  ADD CONSTRAINT `visit_ibfk_3` FOREIGN KEY (`from_visit_id`) REFERENCES `visit` (`visit_id`);

--
-- Ketidakleluasaan untuk tabel `visit_drug`
--
ALTER TABLE `visit_drug`
  ADD CONSTRAINT `visit_drug_ibfk_1` FOREIGN KEY (`visit_id`) REFERENCES `visit` (`visit_id`),
  ADD CONSTRAINT `visit_drug_ibfk_2` FOREIGN KEY (`drug_id`) REFERENCES `drug` (`drug_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

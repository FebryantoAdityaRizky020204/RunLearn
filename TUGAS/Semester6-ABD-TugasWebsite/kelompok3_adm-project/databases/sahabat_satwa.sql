-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 16 Apr 2025 pada 06.09
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

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_animals_by_type` (IN `at_id` INT)   BEGIN
    SELECT
        a.animal_name AS nama_hewan,
        CONCAT(o.owner_givenname, ' ', o.owner_familyname) AS nama_pemilik
    FROM animal a JOIN owners o ON a.owner_id = o.owner_id WHERE a.at_id = at_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_animal_visit_history` (IN `id_animal` INT)   BEGIN
    SELECT
        v.visit_date_time AS tanggal_kunjungan,
        CONCAT(ve.vet_givenname, ' ', ve.vet_familyname) AS nama_dokter,
        v.visit_notes AS diagnosa
    FROM visit v JOIN vet ve ON v.vet_id = ve.vet_id WHERE v.animal_id = id_animal
    ORDER BY v.visit_date_time DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_visits_by_date_range` (IN `start_date` DATE, IN `end_date` DATE)   BEGIN
    SELECT
        v.visit_id AS id_visit,
        v.visit_date_time AS tanggal_kunjungan,
        a.animal_name AS nama_hewan,
        CONCAT(o.owner_givenname, ' ', o.owner_familyname) AS nama_pemilik,
        CONCAT(ve.vet_givenname, ' ', ve.vet_familyname) AS nama_dokter
    FROM visit v 
    JOIN animal a ON v.animal_id = a.animal_id 
    JOIN owners o ON a.owner_id = o.owner_id
    JOIN vet ve ON v.vet_id = ve.vet_id 
    WHERE v.visit_date_time BETWEEN start_date AND end_date
    ORDER BY v.visit_date_time;
END$$

DELIMITER ;

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
(1, 'Buddy', '2020-03-10', 1, 1),
(2, 'Mittens', '2018-05-20', 2, 2),
(3, 'Charlie', '2019-11-15', 3, 1),
(4, 'Coco', '2021-07-22', 4, 3),
(5, 'Luna', '2022-01-18', 5, 2),
(6, 'Rocky', '2017-09-25', 6, 1),
(7, 'Bella', '2015-06-30', 1, 2),
(8, 'Max', '2016-12-05', 2, 1),
(9, 'Zazu', '2023-04-10', 3, 3),
(10, 'Thumper edit', '2020-08-14', 4, 4),
(11, 'Kick', '2025-02-01', 7, 2);

--
-- Trigger `animal`
--
DELIMITER $$
CREATE TRIGGER `log_delete_animal` AFTER DELETE ON `animal` FOR EACH ROW BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Deleted animal: ', OLD.animal_name), 'animal', OLD.animal_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_insert_animal` AFTER INSERT ON `animal` FOR EACH ROW BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Inserted new animal: ', NEW.animal_name), 'animal', NEW.animal_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_animal` AFTER UPDATE ON `animal` FOR EACH ROW BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Updated animal: ', NEW.animal_name), 'animal', NEW.animal_id);
END
$$
DELIMITER ;

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
(1, 'Dog'),
(2, 'Cat'),
(3, 'Bird'),
(4, 'Rabbit');

--
-- Trigger `animal_type`
--
DELIMITER $$
CREATE TRIGGER `log_delete_animal_type` AFTER DELETE ON `animal_type` FOR EACH ROW BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Deleted animal type: ', OLD.at_id), 'animal_type', OLD.at_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_insert_animal_type` AFTER INSERT ON `animal_type` FOR EACH ROW BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Inserted new animal type: ', NEW.at_id), 'animal_type', NEW.at_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_animal_type` AFTER UPDATE ON `animal_type` FOR EACH ROW BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Updated animal type: ', NEW.at_id), 'animal_type', NEW.at_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `audit_log`
--

CREATE TABLE `audit_log` (
  `log_id` int NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `action` varchar(200) DEFAULT NULL,
  `table_name` varchar(50) DEFAULT NULL,
  `record_id` int DEFAULT NULL,
  `action_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `audit_log`
--

INSERT INTO `audit_log` (`log_id`, `username`, `action`, `table_name`, `record_id`, `action_time`) VALUES
(1, 'root@localhost', 'Inserted new owner: 1', 'owners', 1, '2025-04-15 10:25:08'),
(2, 'root@localhost', 'Inserted new owner: 2', 'owners', 2, '2025-04-15 10:25:08'),
(3, 'root@localhost', 'Inserted new owner: 3', 'owners', 3, '2025-04-15 10:25:08'),
(4, 'root@localhost', 'Inserted new owner: 4', 'owners', 4, '2025-04-15 10:25:08'),
(5, 'root@localhost', 'Inserted new owner: 5', 'owners', 5, '2025-04-15 10:25:08'),
(6, 'root@localhost', 'Inserted new owner: 6', 'owners', 6, '2025-04-15 10:25:08'),
(7, 'root@localhost', 'Inserted new clinic: 1', 'clinic', 1, '2025-04-15 10:25:09'),
(8, 'root@localhost', 'Inserted new clinic: 2', 'clinic', 2, '2025-04-15 10:25:09'),
(9, 'root@localhost', 'Inserted new animal type: 1', 'animal_type', 1, '2025-04-15 10:25:09'),
(10, 'root@localhost', 'Inserted new animal type: 2', 'animal_type', 2, '2025-04-15 10:25:09'),
(11, 'root@localhost', 'Inserted new animal type: 3', 'animal_type', 3, '2025-04-15 10:25:09'),
(12, 'root@localhost', 'Inserted new animal type: 4', 'animal_type', 4, '2025-04-15 10:25:09'),
(13, 'root@localhost', 'Inserted new specialisation: 1', 'specialisation', 1, '2025-04-15 10:25:09'),
(14, 'root@localhost', 'Inserted new specialisation: 2', 'specialisation', 2, '2025-04-15 10:25:09'),
(15, 'root@localhost', 'Inserted new vet: 1', 'vet', 1, '2025-04-15 10:25:09'),
(16, 'root@localhost', 'Inserted new vet: 2', 'vet', 2, '2025-04-15 10:25:09'),
(17, 'root@localhost', 'Inserted new vet: 3', 'vet', 3, '2025-04-15 10:25:09'),
(18, 'root@localhost', 'Inserted new vet: 4', 'vet', 4, '2025-04-15 10:25:09'),
(19, 'root@localhost', 'Inserted new vet: 5', 'vet', 5, '2025-04-15 10:25:09'),
(20, 'root@localhost', 'Inserted new animal: Buddy', 'animal', 1, '2025-04-15 10:25:09'),
(21, 'root@localhost', 'Inserted new animal: Mittens', 'animal', 2, '2025-04-15 10:25:09'),
(22, 'root@localhost', 'Inserted new animal: Charlie', 'animal', 3, '2025-04-15 10:25:09'),
(23, 'root@localhost', 'Inserted new animal: Coco', 'animal', 4, '2025-04-15 10:25:09'),
(24, 'root@localhost', 'Inserted new animal: Luna', 'animal', 5, '2025-04-15 10:25:09'),
(25, 'root@localhost', 'Inserted new animal: Rocky', 'animal', 6, '2025-04-15 10:25:09'),
(26, 'root@localhost', 'Inserted new animal: Bella', 'animal', 7, '2025-04-15 10:25:09'),
(27, 'root@localhost', 'Inserted new animal: Max', 'animal', 8, '2025-04-15 10:25:09'),
(28, 'root@localhost', 'Inserted new animal: Zazu', 'animal', 9, '2025-04-15 10:25:09'),
(29, 'root@localhost', 'Inserted new animal: Thumper', 'animal', 10, '2025-04-15 10:25:09'),
(30, 'root@localhost', 'Inserted new visit: 1', 'visit', 1, '2025-04-15 10:25:09'),
(31, 'root@localhost', 'Inserted new visit: 2', 'visit', 2, '2025-04-15 10:25:09'),
(32, 'root@localhost', 'Inserted new visit: 3', 'visit', 3, '2025-04-15 10:25:09'),
(33, 'root@localhost', 'Inserted new visit: 4', 'visit', 4, '2025-04-15 10:25:09'),
(34, 'root@localhost', 'Inserted new visit: 5', 'visit', 5, '2025-04-15 10:25:09'),
(35, 'root@localhost', 'Inserted new visit: 6', 'visit', 6, '2025-04-15 10:25:09'),
(36, 'root@localhost', 'Inserted new visit: 7', 'visit', 7, '2025-04-15 10:25:09'),
(37, 'root@localhost', 'Inserted new visit: 8', 'visit', 8, '2025-04-15 10:25:09'),
(38, 'root@localhost', 'Inserted new drug: 1', 'drug', 1, '2025-04-15 10:25:09'),
(39, 'root@localhost', 'Inserted new drug: 2', 'drug', 2, '2025-04-15 10:25:09'),
(40, 'root@localhost', 'Inserted new drug: 3', 'drug', 3, '2025-04-15 10:25:09'),
(41, 'root@localhost', 'Inserted new drug: 4', 'drug', 4, '2025-04-15 10:25:09'),
(42, 'root@localhost', 'Inserted new drug: 5', 'drug', 5, '2025-04-15 10:25:09'),
(43, 'root@localhost', 'Inserted new drug: 6', 'drug', 6, '2025-04-15 10:25:09'),
(44, 'root@localhost', 'Inserted new drug: 7', 'drug', 7, '2025-04-15 10:25:09'),
(45, 'root@localhost', 'Inserted new drug: 8', 'drug', 8, '2025-04-15 10:25:09'),
(46, 'root@localhost', 'Inserted new drug: 9', 'drug', 9, '2025-04-15 10:25:09'),
(47, 'root@localhost', 'Inserted new drug: 10', 'drug', 10, '2025-04-15 10:25:09'),
(48, 'root@localhost', 'Inserted new drug: 11', 'drug', 11, '2025-04-15 10:25:09'),
(49, 'root@localhost', 'Inserted new drug: 12', 'drug', 12, '2025-04-15 10:25:09'),
(50, 'root@localhost', 'Inserted new drug: 13', 'drug', 13, '2025-04-15 10:25:09'),
(51, 'root@localhost', 'Inserted new drug: 14', 'drug', 14, '2025-04-15 10:25:09'),
(52, 'root@localhost', 'Inserted new visit drug: 1 - 1', 'visit_drug', 1, '2025-04-15 10:25:09'),
(53, 'root@localhost', 'Inserted new visit drug: 2 - 2', 'visit_drug', 2, '2025-04-15 10:25:09'),
(54, 'root@localhost', 'Inserted new visit drug: 3 - 3', 'visit_drug', 3, '2025-04-15 10:25:09'),
(55, 'root@localhost', 'Inserted new visit drug: 3 - 9', 'visit_drug', 3, '2025-04-15 10:25:09'),
(56, 'root@localhost', 'Inserted new visit drug: 4 - 4', 'visit_drug', 4, '2025-04-15 10:25:09'),
(57, 'root@localhost', 'Inserted new visit drug: 4 - 10', 'visit_drug', 4, '2025-04-15 10:25:09'),
(58, 'root@localhost', 'Inserted new visit drug: 5 - 5', 'visit_drug', 5, '2025-04-15 10:25:09'),
(59, 'root@localhost', 'Inserted new visit drug: 6 - 6', 'visit_drug', 6, '2025-04-15 10:25:09'),
(60, 'root@localhost', 'Inserted new visit drug: 7 - 7', 'visit_drug', 7, '2025-04-15 10:25:09'),
(61, 'root@localhost', 'Inserted new visit drug: 8 - 8', 'visit_drug', 8, '2025-04-15 10:25:09'),
(62, 'admin_user@localhost', 'Inserted new clinic: 3', 'clinic', 3, '2025-04-15 13:59:41'),
(63, 'admin_user@localhost', 'Updated clinic: 3', 'clinic', 3, '2025-04-15 13:59:44'),
(64, 'admin_user@localhost', 'Deleted clinic: 3', 'clinic', 3, '2025-04-15 13:59:47'),
(65, 'admin_user@localhost', 'Updated owner: 2', 'owners', 2, '2025-04-15 16:40:35'),
(66, 'admin_user@localhost', 'Updated animal: Thumper edit', 'animal', 10, '2025-04-15 16:41:06'),
(67, 'admin_user@localhost', 'Updated animal type: 2', 'animal_type', 2, '2025-04-15 16:41:58'),
(68, 'admin_user@localhost', 'Updated owner: 1', 'owners', 1, '2025-04-15 16:43:49'),
(69, 'admin_user@localhost', 'Updated owner: 6', 'owners', 6, '2025-04-15 16:49:34'),
(70, 'admin_user@localhost', 'Updated animal: Thumper edit', 'animal', 10, '2025-04-15 16:49:43'),
(71, 'admin_user@localhost', 'Updated animal: Zazu', 'animal', 9, '2025-04-15 16:50:08'),
(72, 'admin_user@localhost', 'Updated animal: Max', 'animal', 8, '2025-04-15 16:50:18'),
(73, 'admin_user@localhost', 'Updated animal: Thumper edit', 'animal', 10, '2025-04-15 16:53:56'),
(74, 'admin_user@localhost', 'Updated animal: Thumper edit', 'animal', 10, '2025-04-15 16:56:56'),
(75, 'admin_user@localhost', 'Updated animal type: 1', 'animal_type', 1, '2025-04-15 17:05:42'),
(76, 'vet_user@localhost', 'Updated vet: 5', 'vet', 5, '2025-04-15 17:14:06'),
(77, 'pet_owner_user@localhost', 'Updated owner: 6', 'owners', 6, '2025-04-16 05:24:41'),
(78, 'pet_owner_user@localhost', 'Updated owner: 6', 'owners', 6, '2025-04-16 05:24:47'),
(79, 'admin_user@localhost', 'Inserted new owner: 7', 'owners', 7, '2025-04-16 05:28:10'),
(80, 'admin_user@localhost', 'Updated owner: 7', 'owners', 7, '2025-04-16 05:28:18'),
(81, 'admin_user@localhost', 'Inserted new animal: Kick', 'animal', 11, '2025-04-16 05:28:40'),
(82, 'admin_user@localhost', 'Updated animal: Kick', 'animal', 11, '2025-04-16 05:28:48'),
(83, 'admin_user@localhost', 'Inserted new visit: 9', 'visit', 9, '2025-04-16 05:29:24'),
(84, 'admin_user@localhost', 'Updated visit: 9', 'visit', 9, '2025-04-16 05:29:54');

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
(1, 'Happy Paws Vet', '123 Pet Street', '1234567890'),
(2, 'Animal Care Center', '456 Animal Ave', '0987654321');

--
-- Trigger `clinic`
--
DELIMITER $$
CREATE TRIGGER `log_delete_clinic` AFTER DELETE ON `clinic` FOR EACH ROW BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Deleted clinic: ', OLD.clinic_id), 'clinic', OLD.clinic_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_insert_clinic` AFTER INSERT ON `clinic` FOR EACH ROW BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Inserted new clinic: ', NEW.clinic_id), 'clinic', NEW.clinic_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_clinic` AFTER UPDATE ON `clinic` FOR EACH ROW BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Updated clinic: ', NEW.clinic_id), 'clinic', NEW.clinic_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `drug`
--

CREATE TABLE `drug` (
  `drug_id` int NOT NULL,
  `drug_name` varchar(50) NOT NULL,
  `drug_usage` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `drug`
--

INSERT INTO `drug` (`drug_id`, `drug_name`, `drug_usage`) VALUES
(1, 'Amoxicillin', 'Antibiotic for infections'),
(2, 'Metacam', 'Pain relief'),
(3, 'Prednisone', 'Anti-inflammatory'),
(4, 'Carprofen', 'Pain relief for dogs'),
(5, 'Doxycycline', 'Antibiotic for bacterial infections'),
(6, 'Gabapentin', 'Nerve pain treatment'),
(7, 'Cefpodoxime', 'Broad-spectrum antibiotic'),
(8, 'Ivermectin', 'Parasite treatment'),
(9, 'Furosemide', 'Diuretic for heart conditions'),
(10, 'Enrofloxacin', 'Antibiotic for severe infections'),
(11, 'Ketoconazole', 'Anti-fungal medication'),
(12, 'Hydrocortisone', 'Steroid for skin conditions'),
(13, 'Meloxicam', 'Pain relief for cats'),
(14, 'Famotidine', 'Acid reflux treatment');

--
-- Trigger `drug`
--
DELIMITER $$
CREATE TRIGGER `log_delete_drug` AFTER DELETE ON `drug` FOR EACH ROW BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Deleted drug: ', OLD.drug_id), 'drug', OLD.drug_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_insert_drug` AFTER INSERT ON `drug` FOR EACH ROW BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Inserted new drug: ', NEW.drug_id), 'drug', NEW.drug_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_drug` AFTER UPDATE ON `drug` FOR EACH ROW BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Updated drug: ', NEW.drug_id), 'drug', NEW.drug_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `owners`
--

CREATE TABLE `owners` (
  `owner_id` int NOT NULL,
  `owner_givenname` varchar(30) DEFAULT NULL,
  `owner_familyname` varchar(30) DEFAULT NULL,
  `owner_address` varchar(100) NOT NULL,
  `owner_phone` varbinary(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `owners`
--

INSERT INTO `owners` (`owner_id`, `owner_givenname`, `owner_familyname`, `owner_address`, `owner_phone`) VALUES
(1, 'John', 'Doe', '789 Pet Lane', 0x312a32084edd8a2e347f0546fd6a2846),
(2, 'Jane', 'Deo', '456 Furry St', 0xb0f197c97215f15056ff05b4e5edd011),
(3, 'Mike', 'Tyson', '159 Animal Rd', 0xf5e921a4d626d9aa2e74d63289f5c7a7),
(4, 'Lucy', 'Heart', '753 Vet Blvd', 0xd3c9bc4f5e9df033abf278197d1447e3),
(5, 'George', 'King', '357 Pet Alley', 0x66a30725efff6bdfe1a4089c55ec7473),
(6, 'Nancy', 'Drew', '951 Paw Way', 0xfa4b784352b8c042b07892dfa478053f),
(7, 'Aditya', 'Rizky Febryanto', 'Borneo 13', 0x577aa7d93e45a431c340c6b576cf8421);

--
-- Trigger `owners`
--
DELIMITER $$
CREATE TRIGGER `log_delete_owner` AFTER DELETE ON `owners` FOR EACH ROW BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Deleted owner: ', OLD.owner_id), 'owners', OLD.owner_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_insert_owner` AFTER INSERT ON `owners` FOR EACH ROW BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Inserted new owner: ', NEW.owner_id), 'owners', NEW.owner_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_owner` AFTER UPDATE ON `owners` FOR EACH ROW BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Updated owner: ', NEW.owner_id), 'owners', NEW.owner_id);
END
$$
DELIMITER ;

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
(1, 'Surgery'),
(2, 'Dermatology');

--
-- Trigger `specialisation`
--
DELIMITER $$
CREATE TRIGGER `log_delete_specialisation` AFTER DELETE ON `specialisation` FOR EACH ROW BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Deleted specialisation: ', OLD.spec_id), 'specialisation', OLD.spec_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_insert_specialisation` AFTER INSERT ON `specialisation` FOR EACH ROW BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Inserted new specialisation: ', NEW.spec_id), 'specialisation', NEW.spec_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_specialisation` AFTER UPDATE ON `specialisation` FOR EACH ROW BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Updated specialisation: ', NEW.spec_id), 'specialisation', NEW.spec_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `spec_visit`
--

CREATE TABLE `spec_visit` (
  `clinic_id` int NOT NULL,
  `vet_id` int NOT NULL,
  `sv_count` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Trigger `spec_visit`
--
DELIMITER $$
CREATE TRIGGER `log_delete_spec_visit` AFTER DELETE ON `spec_visit` FOR EACH ROW BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Deleted spec visit: ', OLD.clinic_id, ' - ', OLD.vet_id), 'spec_visit', OLD.clinic_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_insert_spec_visit` AFTER INSERT ON `spec_visit` FOR EACH ROW BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Inserted new spec visit: ', NEW.clinic_id, ' - ', NEW.vet_id), 'spec_visit', NEW.clinic_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_spec_visit` AFTER UPDATE ON `spec_visit` FOR EACH ROW BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Updated spec visit: ', NEW.clinic_id, ' - ', NEW.vet_id), 'spec_visit', NEW.clinic_id);
END
$$
DELIMITER ;

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
  `clinic_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `vet`
--

INSERT INTO `vet` (`vet_id`, `vet_title`, `vet_givenname`, `vet_familyname`, `vet_phone`, `vet_employed`, `spec_id`, `clinic_id`) VALUES
(1, 'Dr.', 'Alice', 'Smith', '1112223333', '2022-06-15', 1, 1),
(2, 'Dr.', 'Bob', 'Jones', '2223334444', '2021-05-10', 2, 1),
(3, 'Dr.', 'Charlie', 'Brown', '3334445555', '2023-07-20', 1, 2),
(4, 'Dr.', 'Diana', 'Wilson', '4445556666', '2020-09-30', 2, 2),
(5, 'Dr.', 'Evan', 'Taylor', '5556667777', '2019-01-25', 1, 1);

--
-- Trigger `vet`
--
DELIMITER $$
CREATE TRIGGER `log_delete_vet` AFTER DELETE ON `vet` FOR EACH ROW BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Deleted vet: ', OLD.vet_id), 'vet', OLD.vet_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_insert_vet` AFTER INSERT ON `vet` FOR EACH ROW BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Inserted new vet: ', NEW.vet_id), 'vet', NEW.vet_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_vet` AFTER UPDATE ON `vet` FOR EACH ROW BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Updated vet: ', NEW.vet_id), 'vet', NEW.vet_id);
END
$$
DELIMITER ;

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

--
-- Dumping data untuk tabel `visit`
--

INSERT INTO `visit` (`visit_id`, `visit_date_time`, `visit_notes`, `animal_id`, `vet_id`, `from_visit_id`) VALUES
(1, '2024-08-05', 'Routine checkup', 1, 1, NULL),
(2, '2024-09-10', 'Vaccination', 2, 2, NULL),
(3, '2024-10-15', 'Skin infection treatment', 3, 3, NULL),
(4, '2024-11-20', 'Ear infection check', 4, 4, NULL),
(5, '2024-12-25', 'Follow-up for infection', 3, 3, 3),
(6, '2025-01-05', 'Leg injury treatment', 5, 5, NULL),
(7, '2025-01-15', 'Dental cleaning', 6, 1, NULL),
(8, '2025-01-20', 'Referral for surgery', 5, 1, 6),
(9, '2025-04-04', 'Sick', 11, 2, NULL);

--
-- Trigger `visit`
--
DELIMITER $$
CREATE TRIGGER `log_delete_visit` AFTER DELETE ON `visit` FOR EACH ROW BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Deleted visit: ', OLD.visit_id), 'visit', OLD.visit_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_insert_visit` AFTER INSERT ON `visit` FOR EACH ROW BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Inserted new visit: ', NEW.visit_id), 'visit', NEW.visit_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_visit` AFTER UPDATE ON `visit` FOR EACH ROW BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Updated visit: ', NEW.visit_id), 'visit', NEW.visit_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `validate_visit_date` BEFORE INSERT ON `visit` FOR EACH ROW BEGIN
    IF NEW.visit_date_time > CURDATE() THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Tanggal kunjungan tidak boleh lebih dari tanggal saat ini';
    END IF;
END
$$
DELIMITER ;

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
-- Dumping data untuk tabel `visit_drug`
--

INSERT INTO `visit_drug` (`visit_drug_dose`, `visit_drug_frequency`, `visit_drug_qtysupplied`, `drug_id`, `visit_id`) VALUES
('10mg', 'Once a day', 5, 1, 1),
('5mg', 'Twice a day', 10, 2, 2),
('20mg', 'Once a day', 7, 3, 3),
('20mg', 'Once a day', 5, 9, 3),
('15mg', 'Twice a day', 5, 4, 4),
('15mg', 'Twice a day', 7, 10, 4),
('30mg', 'Once a day', 3, 5, 5),
('25mg', 'Twice a day', 8, 6, 6),
('10mg', 'Once a day', 4, 7, 7),
('5mg', 'Once a day', 6, 8, 8);

--
-- Trigger `visit_drug`
--
DELIMITER $$
CREATE TRIGGER `log_delete_visit_drug` AFTER DELETE ON `visit_drug` FOR EACH ROW BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Deleted visit drug: ', OLD.visit_id, ' - ', OLD.drug_id), 'visit_drug', OLD.visit_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_insert_visit_drug` AFTER INSERT ON `visit_drug` FOR EACH ROW BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Inserted new visit drug: ', NEW.visit_id, ' - ', NEW.drug_id), 'visit_drug', NEW.visit_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_visit_drug` AFTER UPDATE ON `visit_drug` FOR EACH ROW BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Updated visit drug: ', NEW.visit_id, ' - ', NEW.drug_id), 'visit_drug', NEW.visit_id);
END
$$
DELIMITER ;

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
-- Indeks untuk tabel `audit_log`
--
ALTER TABLE `audit_log`
  ADD PRIMARY KEY (`log_id`);

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
  MODIFY `animal_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `animal_type`
--
ALTER TABLE `animal_type`
  MODIFY `at_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `audit_log`
--
ALTER TABLE `audit_log`
  MODIFY `log_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT untuk tabel `clinic`
--
ALTER TABLE `clinic`
  MODIFY `clinic_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `drug`
--
ALTER TABLE `drug`
  MODIFY `drug_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `owners`
--
ALTER TABLE `owners`
  MODIFY `owner_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `specialisation`
--
ALTER TABLE `specialisation`
  MODIFY `spec_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `spec_visit`
--
ALTER TABLE `spec_visit`
  MODIFY `clinic_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `vet`
--
ALTER TABLE `vet`
  MODIFY `vet_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `visit`
--
ALTER TABLE `visit`
  MODIFY `visit_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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

-- membuat tabel `sahabat_satwa`
DROP DATABASE IF EXISTS `sahabat_satwa`;
CREATE DATABASE `sahabat_satwa`;
USE `sahabat_satwa`;

-- Membuat Tabel `owners`
DROP TABLE IF EXISTS `owners`;
CREATE TABLE `owners` (
  `owner_id` int NOT NULL AUTO_INCREMENT,
  `owner_givenname` varchar(30) DEFAULT NULL,
  `owner_familyname` varchar(30) DEFAULT NULL,
  `owner_address` varchar(100) NOT NULL,
  `owner_phone` varbinary(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`owner_id`)
);

-- Membuat Tabel `clinic`
DROP TABLE IF EXISTS `clinic`;
CREATE TABLE `clinic` (
  `clinic_id` int NOT NULL AUTO_INCREMENT,
  `clinic_name` varchar(50) NOT NULL,
  `clinic_address` varchar(80) NOT NULL,
  `clinic_phone` varchar(14) NOT NULL,
  `clinic_start_day` varchar(15) NOT NULL,
  `clinic_end_day` varchar(15) NOT NULL,
  `clinic_start_time` TIME NOT NULL,
  `clinic_end_time` TIME NOT NULL,
  `clinic_status` varchar(20) NOT NULL,
  PRIMARY KEY (`clinic_id`)
);

-- Membuat Tabel `animal_type`
DROP TABLE IF EXISTS `animal_type`;
CREATE TABLE `animal_type` (
  `at_id` int NOT NULL AUTO_INCREMENT,
  `at_description` varchar(40) NOT NULL,
  PRIMARY KEY (`at_id`)
);

-- Membuat Tabel `specialisation`
DROP TABLE IF EXISTS `specialisation`;
CREATE TABLE `specialisation` (
  `spec_id` int NOT NULL AUTO_INCREMENT,
  `spec_description` varchar(30) NOT NULL,
  `medical_cost` int NOT NULL,
  PRIMARY KEY (`spec_id`)
);

-- Membuat Tabel `animal_type`
DROP TABLE IF EXISTS `vet`;
CREATE TABLE `vet` (
  `vet_id` int NOT NULL AUTO_INCREMENT,
  `vet_title` char(10) NOT NULL,
  `vet_givenname` varchar(30) DEFAULT NULL,
  `vet_familyname` varchar(30) DEFAULT NULL,
  `vet_phone` varchar(14) NOT NULL,
  `vet_employed` date NOT NULL,
  `spec_id` int DEFAULT NULL,
  `clinic_id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`vet_id`),
  FOREIGN KEY (`spec_id`) REFERENCES `specialisation` (`spec_id`),
  FOREIGN KEY (`clinic_id`) REFERENCES `clinic` (`clinic_id`)
);

-- Membuat Tabel animal
DROP TABLE IF EXISTS `animal` ;
CREATE TABLE `animal` (
  `animal_id` int NOT NULL AUTO_INCREMENT,
  `animal_name` varchar(40) NOT NULL,
  `animal_born` date NOT NULL,
  `owner_id` int NOT NULL,
  `at_id` int NOT NULL,
  PRIMARY KEY (`animal_id`),
  FOREIGN KEY (`owner_id`) REFERENCES `owners` (`owner_id`),
  FOREIGN KEY (`at_id`) REFERENCES `animal_type` (`at_id`)
);


-- Membuat Tabel `drug`
DROP TABLE IF EXISTS `drug`;
CREATE TABLE `drug` (
  `drug_id` int NOT NULL AUTO_INCREMENT,
  `drug_name` varchar(50) NOT NULL,
  `drug_usage` varchar(100) NOT NULL,
  `stock` int NOT NULL,
  `price` int NOT NULL,
  PRIMARY KEY (`drug_id`)
);


-- Membuat Tabel `visit`
DROP TABLE IF EXISTS `visit`;
CREATE TABLE `visit` (
  `visit_id` int NOT NULL AUTO_INCREMENT,
  `visit_date_time` date NOT NULL,
  `visit_notes` varchar(200) NOT NULL,
  `animal_id` int NOT NULL,
  `vet_id` int NOT NULL,
  `from_visit_id` int DEFAULT NULL,
  PRIMARY KEY (`visit_id`),
  FOREIGN KEY (`vet_id`) REFERENCES `vet` (`vet_id`),
  FOREIGN KEY (`animal_id`) REFERENCES `animal` (`animal_id`),
  FOREIGN KEY (`from_visit_id`) REFERENCES `visit` (`visit_id`)
);

-- Membuat Tabel `visit_drug`
DROP TABLE IF EXISTS `visit_drug`;
CREATE TABLE `visit_drug` (
  `visit_drug_dose` varchar(20) NOT NULL,
  `visit_drug_frequency` varchar(20) DEFAULT NULL,
  `visit_drug_qtysupplied` int NOT NULL,
  `drug_id` int NOT NULL,
  `visit_id` int NOT NULL,
  PRIMARY KEY (`visit_id`,`drug_id`),
  FOREIGN KEY (`visit_id`) REFERENCES `visit` (`visit_id`),
  FOREIGN KEY (`drug_id`) REFERENCES `drug` (`drug_id`)
);

-- Membuat Tabel `superadmin`
DROP TABLE IF EXISTS `superadmin`;
CREATE TABLE `superadmin` (
  `superadmin_id` int NOT NULL AUTO_INCREMENT,
  `superadmin_username` varchar(255) NOT NULL,
  `superadmin_password` varchar(255) NOT NULL,
  PRIMARY KEY (`superadmin_id`)
);


CREATE TABLE `sahabat_satwa`.`queue` (
  `queue_id` INT NOT NULL AUTO_INCREMENT , 
  `clinic_id` INT NOT NULL, 
  `animal_id` INT NOT NULL, 
  `owner_id` INT NOT NULL, 
  `queue_number` INT NOT NULL, 
  `queue_date` DATE NOT NULL, 
  `queue_status` VARCHAR(20) NOT NULL, 
  `vet_id` INT, 
  PRIMARY KEY (`queue_id`), 
  FOREIGN KEY (`clinic_id`) REFERENCES `clinic` (`clinic_id`),
  FOREIGN KEY (`animal_id`) REFERENCES `animal` (`animal_id`)
);
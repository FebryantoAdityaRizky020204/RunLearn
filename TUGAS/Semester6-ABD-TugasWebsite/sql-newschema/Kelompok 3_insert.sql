USE `sahabat_satwa`;
-- insert 6 data owners
INSERT INTO `owners` (`owner_id`, `owner_givenname`, `owner_familyname`, `owner_address`, `owner_phone`) VALUES
(1, 'John', 'Doe', '789 Pet Lane', AES_ENCRYPT('1112233445', 'adit')),
(2, 'Jane', 'Doe', '456 Furry St', AES_ENCRYPT('2223344556', 'adit')),
(3, 'Mike', 'Tyson', '159 Animal Rd', AES_ENCRYPT('3334455667', 'adit')),
(4, 'Lucy', 'Heart', '753 Vet Blvd', AES_ENCRYPT('4445566778', 'adit')),
(5, 'George', 'King', '357 Pet Alley', AES_ENCRYPT('5556677889', 'adit')),
(6, 'Nancy', 'Drew', '951 Paw Way', AES_ENCRYPT('6667788990', 'adit'));

-- insert 2 data clinic
INSERT INTO `clinic` (`clinic_id`, `clinic_name`, `clinic_address`, `clinic_phone`) VALUES
(1, 'Happy Paws Vet', '123 Pet Street', '1234567890'),
(2, 'Animal Care Center', '456 Animal Ave', '0987654321');

-- insert 4 data animal_type
INSERT INTO `animal_type` (`at_id`, `at_description`) VALUES
(1, 'Dog'),
(2, 'Cat'),
(3, 'Bird'),
(4, 'Rabbit');

-- insert 2 data specialisation
INSERT INTO `specialisation` (`spec_id`, `spec_description`) VALUES
(1, 'Surgery'),
(2, 'Dermatology');

-- insert 5 data vet
INSERT INTO `vet` (`vet_id`, `vet_title`, `vet_givenname`, `vet_familyname`, `vet_phone`, `vet_employed`, `spec_id`, `clinic_id`) VALUES
(1, 'Dr.', 'Alice', 'Smith', '1112223333', '2022-06-15', 1, 1),
(2, 'Dr.', 'Bob', 'Jones', '2223334444', '2021-05-10', 2, 1),
(3, 'Dr.', 'Charlie', 'Brown', '3334445555', '2023-07-20', 1, 2),
(4, 'Dr.', 'Diana', 'Wilson', '4445556666', '2020-09-30', 2, 2),
(5, 'Dr.', 'Evan', 'Taylor', '5556667777', '2019-01-25', 1, 1);

-- insert 10 data animal
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
(10, 'Thumper', '2020-08-14', 4, 4);

-- insert 8 data visit
INSERT INTO `visit` (`visit_id`, `visit_date_time`, `visit_notes`, `animal_id`, `vet_id`, `from_visit_id`) VALUES
(1, '2024-08-05', 'Routine checkup', 1, 1, NULL),
(2, '2024-09-10', 'Vaccination', 2, 2, NULL),
(3, '2024-10-15', 'Skin infection treatment', 3, 3, NULL),
(4, '2024-11-20', 'Ear infection check', 4, 4, NULL),
(5, '2024-12-25', 'Follow-up for infection', 3, 3, 3),
(6, '2025-01-05', 'Leg injury treatment', 5, 5, NULL),
(7, '2025-01-15', 'Dental cleaning', 6, 1, NULL),
(8, '2025-01-20', 'Referral for surgery', 5, 1, 6);

-- insert 14 data drug
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


-- insert 10 data visit_drug
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


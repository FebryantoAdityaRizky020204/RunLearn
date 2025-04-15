CREATE TABLE audit_log (
  log_id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50), -- Ubah dari user_id menjadi username
  action VARCHAR(200),  -- Tingkatkan panjang kolom action
  table_name VARCHAR(50),
  record_id INT,
  action_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

# Buat trigger untuk setiap operasi INSERT, UPDATE, dan DELETE pada semua tabel
-- 1) Trigger: log insert data hewan
DELIMITER $$
CREATE TRIGGER log_insert_animal
AFTER INSERT ON animal
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Inserted new animal: ', NEW.animal_name), 'animal', NEW.animal_id);
END $$
DELIMITER ;

-- 2) Trigger: log update data hewan
DELIMITER $$
CREATE TRIGGER log_update_animal
AFTER UPDATE ON animal
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Updated animal: ', NEW.animal_name), 'animal', NEW.animal_id);
END $$
DELIMITER ;

-- 3) Trigger: log delete data hewan
DELIMITER $$
CREATE TRIGGER log_delete_animal
AFTER DELETE ON animal
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Deleted animal: ', OLD.animal_name), 'animal', OLD.animal_id);
END $$
DELIMITER ;

-- 4) Trigger: log insert data kunjungan
DELIMITER $$
CREATE TRIGGER log_insert_visit
AFTER INSERT ON visit
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Inserted new visit: ', NEW.visit_id), 'visit', NEW.visit_id);
END $$
DELIMITER ;

-- 5) Trigger: log update data kunjungan
DELIMITER $$
CREATE TRIGGER log_update_visit
AFTER UPDATE ON visit
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Updated visit: ', NEW.visit_id), 'visit', NEW.visit_id);
END $$
DELIMITER ;

-- 6) Trigger: log delete data kunjungan
DELIMITER $$
CREATE TRIGGER log_delete_visit
AFTER DELETE ON visit
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Deleted visit: ', OLD.visit_id), 'visit', OLD.visit_id);
END $$
DELIMITER ;

-- 7) Trigger: log insert data kunjungan obat
DELIMITER $$
CREATE TRIGGER log_insert_visit_drug
AFTER INSERT ON visit_drug
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Inserted new visit drug: ', NEW.visit_id, ' - ', NEW.drug_id), 'visit_drug', NEW.visit_id);
END $$
DELIMITER ;

-- 8) Trigger: log update data kunjungan obat
DELIMITER $$
CREATE TRIGGER log_update_visit_drug
AFTER UPDATE ON visit_drug
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Updated visit drug: ', NEW.visit_id, ' - ', NEW.drug_id), 'visit_drug', NEW.visit_id);
END $$
DELIMITER ;

-- 9) Trigger: log delete data kunjungan obat
DELIMITER $$
CREATE TRIGGER log_delete_visit_drug
AFTER DELETE ON visit_drug
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Deleted visit drug: ', OLD.visit_id, ' - ', OLD.drug_id), 'visit_drug', OLD.visit_id);
END $$
DELIMITER ;

-- 10) Trigger: log insert data pemilik hewan
DELIMITER $$
CREATE TRIGGER log_insert_owner
AFTER INSERT ON owners
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Inserted new owner: ', NEW.owner_id), 'owners', NEW.owner_id);
END $$
DELIMITER ;

-- 11) Trigger: log update data pemilik hewan
DELIMITER $$
CREATE TRIGGER log_update_owner
AFTER UPDATE ON owners
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Updated owner: ', NEW.owner_id), 'owners', NEW.owner_id);
END $$
DELIMITER ;

-- 12) Trigger: log delete data pemilik hewan
DELIMITER $$
CREATE TRIGGER log_delete_owner
AFTER DELETE ON owners
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Deleted owner: ', OLD.owner_id), 'owners', OLD.owner_id);
END $$
DELIMITER ;

-- 13) Trigger: log insert data klinik
DELIMITER $$
CREATE TRIGGER log_insert_clinic
AFTER INSERT ON clinic
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Inserted new clinic: ', NEW.clinic_id), 'clinic', NEW.clinic_id);
END $$
DELIMITER ;

-- 14) Trigger: log update data klinik
DELIMITER $$
CREATE TRIGGER log_update_clinic
AFTER UPDATE ON clinic
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Updated clinic: ', NEW.clinic_id), 'clinic', NEW.clinic_id);
END $$
DELIMITER ;

-- 15) Trigger: log delete data klinik
DELIMITER $$
CREATE TRIGGER log_delete_clinic
AFTER DELETE ON clinic
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Deleted clinic: ', OLD.clinic_id), 'clinic', OLD.clinic_id);
END $$
DELIMITER ;

-- 16) Trigger: log insert data jenis hewan
DELIMITER $$
CREATE TRIGGER log_insert_animal_type
AFTER INSERT ON animal_type
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Inserted new animal type: ', NEW.at_id), 'animal_type', NEW.at_id);
END $$
DELIMITER ;

-- 17) Trigger: log update data jenis hewan
DELIMITER $$
CREATE TRIGGER log_update_animal_type
AFTER UPDATE ON animal_type
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Updated animal type: ', NEW.at_id), 'animal_type', NEW.at_id);
END $$
DELIMITER ;

-- 18) Trigger: log delete data jenis hewan
DELIMITER $$
CREATE TRIGGER log_delete_animal_type
AFTER DELETE ON animal_type
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Deleted animal type: ', OLD.at_id), 'animal_type', OLD.at_id);
END $$
DELIMITER ;

-- 19) Trigger: log insert data obat
DELIMITER $$
CREATE TRIGGER log_insert_drug
AFTER INSERT ON drug
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Inserted new drug: ', NEW.drug_id), 'drug', NEW.drug_id);
END $$
DELIMITER ;

-- 20) Trigger: log update data obat
DELIMITER $$
CREATE TRIGGER log_update_drug
AFTER UPDATE ON drug
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Updated drug: ', NEW.drug_id), 'drug', NEW.drug_id);
END $$
DELIMITER ;

-- 21) Trigger: log delete data obat
DELIMITER $$
CREATE TRIGGER log_delete_drug
AFTER DELETE ON drug
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Deleted drug: ', OLD.drug_id), 'drug', OLD.drug_id);
END $$
DELIMITER ;

-- 22) Trigger: log insert data kunjungan spesialisasi
DELIMITER $$
CREATE TRIGGER log_insert_spec_visit
AFTER INSERT ON spec_visit
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Inserted new spec visit: ', NEW.clinic_id, ' - ', NEW.vet_id), 'spec_visit', NEW.clinic_id);
END $$
DELIMITER ;

-- 23) Trigger: log update data kunjungan spesialisasi
DELIMITER $$
CREATE TRIGGER log_update_spec_visit
AFTER UPDATE ON spec_visit
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Updated spec visit: ', NEW.clinic_id, ' - ', NEW.vet_id), 'spec_visit', NEW.clinic_id);
END $$
DELIMITER ;

-- 24) Trigger: log delete data kunjungan spesialisasi
DELIMITER $$
CREATE TRIGGER log_delete_spec_visit
AFTER DELETE ON spec_visit
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Deleted spec visit: ', OLD.clinic_id, ' - ', OLD.vet_id), 'spec_visit', OLD.clinic_id);
END $$
DELIMITER ;

-- 25) Trigger: log insert data dokter hewan
DELIMITER $$
CREATE TRIGGER log_insert_vet
AFTER INSERT ON vet
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Inserted new vet: ', NEW.vet_id), 'vet', NEW.vet_id);
END $$
DELIMITER ;

-- 26) Trigger: log update data dokter hewan
DELIMITER $$
CREATE TRIGGER log_update_vet
AFTER UPDATE ON vet
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Updated vet: ', NEW.vet_id), 'vet', NEW.vet_id);
END $$
DELIMITER ;

-- 27) Trigger: log delete data dokter hewan
DELIMITER $$
CREATE TRIGGER log_delete_vet
AFTER DELETE ON vet
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Deleted vet: ', OLD.vet_id), 'vet', OLD.vet_id);
END $$
DELIMITER ;

-- 28) Trigger: log insert data spesialisasi
DELIMITER $$
CREATE TRIGGER log_insert_specialisation
AFTER INSERT ON specialisation
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Inserted new specialisation: ', NEW.spec_id), 'specialisation', NEW.spec_id);
END $$
DELIMITER ;

-- 29) Trigger: log update data spesialisasi
DELIMITER $$
CREATE TRIGGER log_update_specialisation
AFTER UPDATE ON specialisation
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Updated specialisation: ', NEW.spec_id), 'specialisation', NEW.spec_id);
END $$
DELIMITER ;

-- 30) Trigger: log delete data spesialisasi
DELIMITER $$
CREATE TRIGGER log_delete_specialisation
AFTER DELETE ON specialisation
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (username, action, table_name, record_id)
    VALUES (USER(), CONCAT('Deleted specialisation: ', OLD.spec_id), 'specialisation', OLD.spec_id);
END $$
DELIMITER ;
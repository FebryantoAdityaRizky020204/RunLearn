# KELOMPOK 3 - TRIGGER
# ==============================================================================================
-- test insert sebelum trigger dibuat, tanggal di masa depan
INSERT INTO `visit` (`visit_id`, `visit_date_time`, `visit_notes`, `animal_id`, `vet_id`, `from_visit_id`) VALUES
(9, '2025-03-25', 'Leg injury treatment', 1, 1, NULL);

-- panggil data visit
SELECT * FROM sahabat_satwa.visit;

-- Trigger
DELIMITER $$
CREATE TRIGGER validate_visit_date
BEFORE INSERT ON `visit`
FOR EACH ROW
BEGIN
    IF NEW.visit_date_time > CURDATE() THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Tanggal kunjungan tidak boleh lebih dari tanggal saat ini';
    END IF;
END$$
DELIMITER ;


-- test insert tanggal di masa depan, setelah trigger dibuat
INSERT INTO `visit` (`visit_id`, `visit_date_time`, `visit_notes`, `animal_id`, `vet_id`, `from_visit_id`) VALUES
(10, '2025-03-25', 'Routine checkup', 1, 1, NULL);

-- test insert tanggal hari ini
INSERT INTO `visit` (`visit_id`, `visit_date_time`, `visit_notes`, `animal_id`, `vet_id`, `from_visit_id`) VALUES
(11, '2025-03-15', 'Vaccination', 1, 1, NULL);

-- panggil data visit
SELECT * FROM sahabat_satwa.visit;

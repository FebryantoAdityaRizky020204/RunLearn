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

-- Untuk mengurangi stock obat setelah pembelian
DELIMITER $$
CREATE TRIGGER `kurangi_stok_obat_setelah_pembelian`
AFTER INSERT ON `visit_drug`
FOR EACH ROW
BEGIN
  UPDATE `drug`
  SET `stock` = `stock` - NEW.`visit_drug_qtysupplied`
  WHERE `drug`.`drug_id` = NEW.`drug_id`;
END$$
DELIMITER ;


-- Untuk mengecek apakah stock obat mencukupi sebelum dilakukan pembelian obat 
DELIMITER $$
CREATE TRIGGER `cek_stok_obat_sebelum_pembelian`
BEFORE INSERT ON `visit_drug`
FOR EACH ROW
BEGIN
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
END$$
DELIMITER ;

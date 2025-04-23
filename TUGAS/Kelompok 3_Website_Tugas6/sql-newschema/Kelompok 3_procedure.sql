# KELOMPOK 3 - PROCEDURE
# ==============================================================================================
--  Stored Procedure untuk Riwayat Kunjungan Hewan Berdasarkan id_animal

DELIMITER $$
CREATE PROCEDURE get_animal_visit_history(IN id_animal INT)
BEGIN
    SELECT
        v.visit_date_time AS tanggal_kunjungan,
        CONCAT(ve.vet_givenname, ' ', ve.vet_familyname) AS nama_dokter,
        v.visit_notes AS diagnosa
    FROM visit v JOIN vet ve ON v.vet_id = ve.vet_id WHERE v.animal_id = id_animal
    ORDER BY v.visit_date_time DESC;
END$$
DELIMITER ;

-- test panggil procedure  get_animal_visit_history(id_animal)
CALL get_animal_visit_history(1); # animal: Buddy


# ==============================================================================================
-- Stored Procedure untuk Daftar Hewan Berdasarkan at_id (Jenis Hewan)

DELIMITER $$
CREATE PROCEDURE get_animals_by_type(IN at_id INT) 
BEGIN
    SELECT
        a.animal_name AS nama_hewan,
        CONCAT(o.owner_givenname, ' ', o.owner_familyname) AS nama_pemilik
    FROM animal a JOIN owners o ON a.owner_id = o.owner_id WHERE a.at_id = at_id;
END$$
DELIMITER ;

-- test panggil get_animals_by_type
CALL get_animals_by_type(1); #animal type: dog


# ==============================================================================================
-- Stored Procedure untuk Riwayat Kunjungan dalam Rentang Tanggal

DELIMITER $$
CREATE PROCEDURE get_visits_by_date_range(IN start_date DATE, IN end_date DATE)
BEGIN
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

-- test panggil get_visits_by_date_range
CALL get_visits_by_date_range('2025-01-01', '2025-05-01');
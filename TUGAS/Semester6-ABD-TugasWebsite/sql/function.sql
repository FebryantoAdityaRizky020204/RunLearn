DELIMITER $$

CREATE FUNCTION CekKetersediaanKamar(id_room_option VARCHAR(20)) 
    RETURNS VARCHAR(50)
BEGIN
    DECLARE ketersediaan VARCHAR(50);
    DECLARE jumlah_kamar INT;

    SELECT kamar_tersedia INTO jumlah_kamar
    FROM room_option
    WHERE id_room_option = id_room_option LIMIT 1;

    IF jumlah_kamar > 0 THEN
        SET ketersediaan = 'Kamar Tersedia';
    ELSE
        SET ketersediaan = 'Kamar Tidak Tersedia';
    END IF;

    RETURN ketersediaan;
END$$
DELIMITER ;

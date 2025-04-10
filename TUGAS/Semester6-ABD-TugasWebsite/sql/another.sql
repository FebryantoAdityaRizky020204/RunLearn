-- TRIGGER
DELIMITER $$
CREATE TRIGGER `UpdateKamarTersedia` AFTER INSERT ON `pemesanan` FOR EACH ROW
BEGIN
    IF NEW.status = 'ACTIVE' THEN
        UPDATE `room_option` 
        SET `kamar_tersedia` = `kamar_tersedia` - 1 
        WHERE `id_room_option` = NEW.id_room_option;
    END IF;
END$$
DELIMITER ;


DELIMITER $$
CREATE TRIGGER `UpdateKamarTersediaTwo` AFTER UPDATE ON `pemesanan` FOR EACH ROW
BEGIN
    IF NEW.status = 'ACTIVE' AND OLD.status = 'FINISH' THEN
        UPDATE `room_option` 
        SET `kamar_tersedia` = `kamar_tersedia` - 1 
        WHERE `id_room_option` = NEW.id_room_option;
    ELSEIF NEW.status = 'FINISH' AND OLD.status = 'ACTIVE' THEN
        UPDATE `room_option` 
        SET `kamar_tersedia` = `kamar_tersedia` + 1 
        WHERE `id_room_option` = NEW.id_room_option;
    END IF;
END$$
DELIMITER ;




-- ?DELETE 
DELIMITER $$
CREATE
    PROCEDURE `chotel`.`Delete_Role`(
        IN i_id_role VARCHAR(20)
    )
    BEGIN
        DELETE FROM `role` WHERE `id_role` = i_id_role;
    END$$
DELIMITER ;


DELIMITER $$
CREATE
    PROCEDURE `chotel`.`Delete_Pegawai`(
        IN i_id_pegawai VARCHAR(20)
    )
    BEGIN
        DELETE FROM `pegawai` WHERE `id_pegawai` = i_id_pegawai;
    END$$
DELIMITER ;

DELIMITER $$
CREATE
    PROCEDURE `chotel`.`Delete_User`(
        IN i_id_pelanggan VARCHAR(20)
    )
    BEGIN
        DELETE FROM `user` WHERE `id_pelanggan` = i_id_pelanggan;
    END$$
DELIMITER ;

DELIMITER $$
CREATE
    PROCEDURE `chotel`.`Delete_Room`(
        IN i_id_room VARCHAR(20)
    )
    BEGIN
        DELETE FROM `room` WHERE `id_room` = i_id_room;
    END$$
DELIMITER ;

DELIMITER $$
CREATE
    PROCEDURE `chotel`.`Delete_Room_Option`(
        IN i_id_room_option VARCHAR(20)
    )
    BEGIN
        DELETE FROM `room_option` WHERE `id_room_option` = i_id_room_option;
    END$$
DELIMITER ;


DELIMITER $$
CREATE
    PROCEDURE `chotel`.`Delete_Pemesanan`(
        IN i_id_pemesanan VARCHAR(20)
    )
    BEGIN
        DELETE FROM `pemesanan` WHERE `id_pemesanan` = i_id_pemesanan;
    END$$
DELIMITER ;

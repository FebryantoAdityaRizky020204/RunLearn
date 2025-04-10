-- ?PROCEDURE INSERT DATA
DELIMITER $$
CREATE
    PROCEDURE `chotel`.`Update_User`(
        IN i_id_pelanggan VARCHAR(20),
        IN i_nama_pl VARCHAR(100),
        IN i_alamat_pl TEXT,
        IN i_tgl_lahir_pl DATE
    )
    BEGIN
        UPDATE `user` SET 
            `nama_pl`= i_nama_pl,
            `alamat_pl`=i_alamat_pl,
            `tgl_lahir_pl`=i_tgl_lahir_pl
        WHERE `id_pelanggan`= i_id_pelanggan;
    END$$
DELIMITER ;


DELIMITER $$
CREATE
    PROCEDURE `chotel`.`Update_Pegawai`(
        IN i_id_pegawai VARCHAR(20),
        IN i_id_role VARCHAR(20),
        IN i_nama_pg VARCHAR(100),
        IN i_alamat_pg TEXT,
        IN i_username_pg VARCHAR(255),
        IN i_password_pg VARCHAR(255)
    )
    BEGIN
        UPDATE `pegawai` SET 
            `id_role` = i_id_role,
            `nama_pg` = i_nama_pg,
            `alamat_pg` = i_alamat_pg,
            `username_pg` = i_username_pg,
            `password_pg` = i_password_pg 
        WHERE `id_pegawai` = i_id_pegawai;
    END$$
DELIMITER ;


DELIMITER $$
CREATE
    PROCEDURE `chotel`.`Update_Role`(
        IN i_id_role VARCHAR(20),
        IN i_nama_role VARCHAR(50)
    )
    BEGIN
        UPDATE `role` SET 
            `nama_role` = i_nama_role 
        WHERE `id_role` = i_id_role;
    END$$
DELIMITER ;


DELIMITER $$
CREATE
    PROCEDURE `chotel`.`Update_Room`(
        IN i_id_room VARCHAR(20),
        IN i_id_pegawai VARCHAR(20),
        IN i_nama_kamar VARCHAR(200),
        IN i_jumlah_kamar VARCHAR(50)
    )
    BEGIN
        UPDATE `room` SET 
            `id_pegawai` = i_id_pegawai,
            `nama_kamar` = i_nama_kamar,
            `jumlah_kamar` = i_jumlah_kamar 
        WHERE `id_room` = i_id_room;
    END$$
DELIMITER ;

DELIMITER $$
CREATE
    PROCEDURE `chotel`.`Update_Room_Option`(
        IN i_id_room_option VARCHAR(20),
        IN i_id_room VARCHAR(20),
        IN i_id_pegawai VARCHAR(20),
        IN i_nama_opsi VARCHAR(200),
        IN i_jumlah_kasur INT(11),
        IN i_tipe_kasur VARCHAR(100),
        IN i_jumlah_tamu INT(11),
        IN i_sarapan INT(1),
        IN i_kamar_tersedia INT(11),
        IN i_harga_kamar INT(11),
        IN i_no_kamar_start INT(11),
        IN i_no_kamar_end INT(11)
    )
    BEGIN
        UPDATE `room_option` SET 
            `id_room` = i_id_room,
            `id_pegawai` = i_id_pegawai,
            `nama_opsi` = i_nama_opsi,
            `jumlah_kasur` = i_jumlah_kasur,
            `tipe_kasur` = i_tipe_kasur,
            `jumlah_tamu` = i_jumlah_tamu,
            `sarapan` = i_sarapan,
            `kamar_tersedia` = i_kamar_tersedia,
            `harga_kamar` = i_harga_kamar,
            `no_kamar_start` = i_no_kamar_start,
            `no_kamar_end` = i_no_kamar_end 
        WHERE `id_room_option` = i_id_room_option;
    END$$
DELIMITER ;


DELIMITER $$
CREATE
    PROCEDURE `chotel`.`Update_Pemesanan`(
        IN i_id_pemesanan VARCHAR(20),
        IN i_id_pegawai VARCHAR(20),
        IN i_id_pelanggan VARCHAR(20),
        IN i_id_room_option VARCHAR(20),
        IN i_no_kamar INT(11),
        IN i_tgl_start DATE,
        IN i_tgl_end DATE,
        IN i_total_harga INT(11),
        IN i_status VARCHAR(50)
    )
    BEGIN
        UPDATE `pemesanan` SET 
            `id_pegawai` = i_id_pegawai,
            `id_pelanggan` = i_id_pelanggan,
            `id_room_option` = i_id_room_option,
            `no_kamar` = i_no_kamar,
            `tgl_start` = i_tgl_start,
            `tgl_end` = i_tgl_end,
            `total_harga` = i_total_harga,
            `status` = i_status 
        WHERE `id_pemesanan` = i_id_pemesanan;
    END$$
DELIMITER ;

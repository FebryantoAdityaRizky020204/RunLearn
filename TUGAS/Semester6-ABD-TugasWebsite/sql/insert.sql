-- ?PROCEDURE INSERT DATA
DELIMITER $$
CREATE
    PROCEDURE `chotel`.`Insert_User`(
        IN i_id_pelanggan VARCHAR(20),
        IN i_nama_pl VARCHAR(100),
        IN i_alamat_pl TEXT,
        IN i_tgl_lahir_pl DATE
    )
    BEGIN
        INSERT INTO `user`(`id_pelanggan`, `nama_pl`, `alamat_pl`, `tgl_lahir_pl`) 
        VALUES (i_id_pelanggan, i_nama_pl, i_alamat_pl, i_tgl_lahir_pl);
    END$$
DELIMITER ;


DELIMITER $$
CREATE
    PROCEDURE `chotel`.`Insert_Pegawai`(
        IN i_id_pegawai VARCHAR(20),
        IN i_id_role VARCHAR(20),
        IN i_nama_pg VARCHAR(100),
        IN i_alamat_pg TEXT,
        IN i_username_pg VARCHAR(255),
        IN i_password_pg VARCHAR(255)
    )
    BEGIN
        INSERT INTO `pegawai`(`id_pegawai`, `id_role`, `nama_pg`, `alamat_pg`, `username_pg`, `password_pg`) 
        VALUES (i_id_pegawai, i_id_role, i_nama_pg, i_alamat_pg, i_username_pg, i_password_pg);
    END$$
DELIMITER ;


DELIMITER $$
CREATE
    PROCEDURE `chotel`.`Insert_Role`(
        IN i_id_role VARCHAR(20),
        IN i_nama_role VARCHAR(50)
    )
    BEGIN
        INSERT INTO `role`(`id_role`, `nama_role`) 
        VALUES (i_id_role, i_nama_role);
    END$$
DELIMITER ;


DELIMITER $$
CREATE
    PROCEDURE `chotel`.`Insert_Room`(
        IN i_id_room VARCHAR(20),
        IN i_id_pegawai VARCHAR(20),
        IN i_nama_kamar VARCHAR(200),
        IN i_jumlah_kamar VARCHAR(50)
    )
    BEGIN
        INSERT INTO `room`(`id_room`, `id_pegawai`, `nama_kamar`, `jumlah_kamar`) 
        VALUES (i_id_room, i_id_pegawai, i_nama_kamar, i_jumlah_kamar);
    END$$
DELIMITER ;

DELIMITER $$
CREATE
    PROCEDURE `chotel`.`Insert_Room_Option`(
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
        INSERT INTO `room_option`(`id_room_option`, `id_room`, `id_pegawai`, `nama_opsi`, `jumlah_kasur`, `tipe_kasur`, `jumlah_tamu`, `sarapan`, `kamar_tersedia`, `harga_kamar`, `no_kamar_start`, `no_kamar_end`) 
        VALUES (i_id_room_option, i_id_room, i_id_pegawai, i_nama_opsi, i_jumlah_kasur, i_tipe_kasur, i_jumlah_tamu, i_sarapan, i_kamar_tersedia, i_harga_kamar, i_no_kamar_start, i_no_kamar_end);
    END$$
DELIMITER ;


DELIMITER $$
CREATE
    PROCEDURE `chotel`.`Insert_Pemesanan`(
        IN i_id_pemesanan VARCHAR(20),
        IN i_id_pegawai VARCHAR(20),
        IN i_id_pelanggan VARCHAR(20),
        IN i_no_kamar INT(11),
        IN i_id_room_option VARCHAR(20),
        IN i_tgl_start DATE,
        IN i_tgl_end DATE,
        IN i_total_harga INT(11),
        IN i_status VARCHAR(50)
    )
    BEGIN
        INSERT INTO `pemesanan`(`id_pemesanan`, `id_pegawai`, `id_pelanggan`, `id_room_option`, `no_kamar`, `tgl_start`, `tgl_end`, `total_harga`, `status`) 
        VALUES (i_id_pemesanan, i_id_pegawai, i_id_pelanggan, i_id_room_option, i_no_kamar, i_tgl_start, i_tgl_end, i_total_harga, i_status);
    END$$
DELIMITER ;

CREATE VIEW v_pegawai_with_role AS
    SELECT `id_pegawai`, `role`.`id_role`, `nama_pg`, `alamat_pg`, `username_pg`, `password_pg`, `nama_role`
    FROM `pegawai` INNER JOIN `role` 
    ON `pegawai`.`id_role` = `role`.`id_role`;

CREATE VIEW v_room_with_pegawai AS
    SELECT `id_room`, `pegawai`.`id_pegawai`, `nama_kamar`, `jumlah_kamar`, `pegawai`.`nama_pg` 
    FROM `room` INNER JOIN `pegawai`
    ON `room`.`id_pegawai` = `pegawai`.`id_pegawai`;

CREATE VIEW v_optionroom_with_room_with_pegawai AS
    SELECT `id_room_option`, `room`.`id_room`, `pegawai`.`id_pegawai`, `nama_opsi`, `jumlah_kasur`, `tipe_kasur`, 
    `jumlah_tamu`, `sarapan`, `kamar_tersedia`, `harga_kamar`, `no_kamar_start`, `no_kamar_end`, `pegawai`.`nama_pg`, 
    `room`.`nama_kamar` 
    FROM `room_option` 
    INNER JOIN `pegawai` ON `room_option`.`id_pegawai` = `pegawai`.`id_pegawai`
    INNER JOIN `room` ON `room_option`.`id_room` = `room`.`id_room`;

CREATE VIEW v_pemesanan AS
    SELECT `id_pemesanan`, `pegawai`.`id_pegawai`, `user`.`id_pelanggan`, `room_option`.`id_room_option`, 
    `no_kamar`, `tgl_start`, `tgl_end`, `total_harga`, `status`, `user`.`nama_pl`, 
    `room_option`.`nama_opsi`, `pegawai`.`nama_pg`, `room`.`nama_kamar` FROM `pemesanan`
    INNER JOIN `pegawai` ON `pemesanan`.`id_pegawai` = `pegawai`.`id_pegawai`
    INNER JOIN `user` ON `pemesanan`.`id_pelanggan` = `user`.`id_pelanggan`
    INNER JOIN `room_option` ON `pemesanan`.`id_room_option` = `room_option`.`id_room_option`
    INNER JOIN `room` ON `room_option`.`id_room` = `room`.`id_room`;

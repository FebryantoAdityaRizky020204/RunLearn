<?php
require_once './../../Connection/SuperAdminConnection.php';
$conn = new Connection();

header('Location: ./../../../index.php');
exit;

$password = password_hash('1234', PASSWORD_DEFAULT);
$query = "INSERT INTO `petugas_administrasi`(`petugasadmin_nama`, `petugasadmin_nohp`, `username`, `password`, `clinic_id`) 
        VALUES ('adit','987654321','1234','$password',1)";
$conn->runSql($query);
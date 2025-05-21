<?php
header('Content-Type: application/json');
require_once './../Connection/DokterConnection.php';

$conn = new Connection();

// Tangkap data dari POST
$type = $_POST["type"] ?? null;
$vet_id = $_POST["vet_id"];
$username = $_POST["username"];
$password = $_POST["password"];
$vet_givenname = $_POST["vet_givenname"];
$vet_familyname = $_POST["vet_familyname"];
$vet_phone = $_POST["vet_phone"];
$vet_title = $_POST["vet_title"];

if (! empty($type)) {
    if ($type == 'update-dokter' && ! empty($vet_id)
        && ! empty($username)
        && ! empty($vet_givenname)
        && ! empty($vet_phone)
        && ! empty($vet_title)) {
        $visit_date_time = date('Y-m-d');

        if ($password == "") {
            $query = "UPDATE `vet` SET `username`='$username', `vet_title`='$vet_title', `vet_givenname`='$vet_givenname', `vet_familyname`='$vet_familyname', `vet_phone`=$vet_phone WHERE `vet_id`=$vet_id";
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE `vet` SET `username`='$username', `password`='$password', `vet_title`='$vet_title', `vet_givenname`='$vet_givenname', `vet_familyname`='$vet_familyname', `vet_phone`=$vet_phone WHERE `vet_id`=$vet_id";
        }
        if ($conn->runSql($query)) {
            echo json_encode(['status' => 'success', 'message' => 'Update Profil Berhasil']);
            exit();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Update Profil Gagal']);
            exit();

        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Data tidak lengkap untuk',
        ]);
        exit;
    }

} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Ada Data kosong',
    ]);
}
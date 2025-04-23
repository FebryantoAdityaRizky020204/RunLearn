<?php
require_once './../../Connection/OwnerConnection.php';
header('Content-Type: application/json');

$conn = new Connection();

// Tangkap data dari POST
$owner_givenname = $_POST['owner_givenname'] ?? '';
$owner_familyname = $_POST['owner_familyname'] ?? '';
$owner_address = $_POST['owner_address'] ?? '';
$owner_phone = $_POST['owner_phone'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';


// Simulasi validasi login
if (! empty($username) && ! empty($password) && ! empty($owner_givenname) && ! empty($owner_familyname)
    && ! empty($owner_address) && ! empty($owner_phone)) {

    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO `owners`(`owner_givenname`, `owner_familyname`, `owner_address`, `owner_phone`, `username`, `password`) 
    VALUES ('$owner_givenname','$owner_familyname','$owner_address','$owner_phone','$username','$password')";

    if ($conn->runSql($query)) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Registrasi Berhasil, Silahkan Login',
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Gagal mendaftar, silahkan coba lagi',
        ]);
        exit;
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Ada Data kosong',
    ]);
}
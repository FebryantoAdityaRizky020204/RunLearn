<?php
header('Content-Type: application/json');
require_once './../Connection/OwnerConnection.php';

$conn = new Connection();

// Tangkap data dari POST
$owner_givenname = $_POST['owner_givenname'] ?? '';
$owner_familyname = $_POST['owner_familyname'] ?? '';
$owner_address = $_POST['owner_address'] ?? '';
$owner_phone = $_POST['owner_phone'] ?? '';
$username = $_POST['username'] ?? '';
$owner_id = $_POST['owner_id'] ?? '';

// Simulasi validasi login
if (! empty($username) &&
    ! empty($owner_givenname) &&
    ! empty($owner_familyname) &&
    ! empty($owner_address) &&
    ! empty($owner_phone)) {
    $query = "UPDATE `owners` SET 
                `owner_givenname` = '$owner_givenname',
                `owner_familyname` = '$owner_familyname',
                `owner_address` = '$owner_address',
                `owner_phone` = $owner_phone 
                WHERE `owner_id` = $owner_id";

    if ($conn->runSql($query)) {
        $user = $conn->singleFetch("SELECT * FROM owners WHERE owner_id = $owner_id");
        $_SESSION['dataLogin'] = $user;
        echo json_encode([
            'status' => 'success',
            'message' => 'Edit Profile BErhasil',
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Edit Profile Gagal!',
        ]);
        exit;
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Ada Data kosong',
    ]);
}
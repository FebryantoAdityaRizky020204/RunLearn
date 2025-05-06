<?php

header('Content-Type: application/json');
require_once './../../Connection/OwnerConnection.php';

$conn = new Connection();

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (! empty($username) && ! empty($password)) {
    $query = "SELECT * FROM `superadmin` WHERE `username` = '$username'";
    $user = $conn->singleFetch($query);

    if (! $user) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Username atau Password Salah',
        ]);
        exit;
    }

    if (! password_verify($password, $user['password'])) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Username atau Password Salah',
        ]);
        exit;
    }

    $_SESSION['loginAs'] = 'superadmin';
    $_SESSION['dataLogin'] = $user;
    echo json_encode([
        'status' => 'success',
        'message' => 'Login berhasil',
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Username atau password kosong',
    ]);
}
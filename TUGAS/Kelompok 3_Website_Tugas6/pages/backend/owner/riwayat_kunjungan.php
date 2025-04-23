<?php
header('Content-Type: application/json');
require_once './../Connection/OwnerConnection.php';

$conn = new Connection();

// Tangkap data dari POST
$animal_name = $_POST["animal_name"] ?? null;
$animal_born = $_POST["animal_born"] ?? null;
$animal_id = $_POST["animal_id"] ?? null;
$owner_id = $_POST["owner_id"] ?? null;
$at_id = $_POST["at_id"] ?? null;
$type = $_POST["type"] ?? null;

if (! empty($type)) {
    if ($type == 'insert' && ! empty($animal_name)
        && ! empty($animal_born)
        && ! empty($owner_id)
        && ! empty($at_id)) {
        $query = "INSERT INTO `animal` (`animal_name`, `animal_born`, `owner_id`, `at_id`) VALUES
                            ('$animal_name', '$animal_born', $owner_id, $at_id);";
        if ($conn->runSql($query)) {
            echo json_encode(['status' => 'success', 'message' => 'Tambah Data Berhasil']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Tambah Data Gagal!']);
            exit;
        }
    } else if ($type == 'edit' && ! empty($animal_name)
        && ! empty($animal_born)
        && ! empty($at_id)) {
        $query = "UPDATE `animal` SET
                    `animal_name` = '$animal_name',
                    `animal_born` = '$animal_born',
                    `at_id` = $at_id
                WHERE animal_id = $animal_id;";
        if ($conn->runSql($query)) {
            echo json_encode(['status' => 'success', 'message' => 'Edit Data Berhasil']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Edit Data Gagal!']);
            exit;
        }
    } else if ($type == 'delete' && ! empty($animal_id)) {
        $query = "DELETE FROM `animal` WHERE `animal_id` = $animal_id";
        if ($conn->runSql($query)) {
            echo json_encode(['status' => 'success', 'message' => 'Hapus Data Berhasil']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Hapus Data Gagal!']);
            exit;
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid type',
        ]);
        exit;
    }

} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Ada Data kosong',
    ]);
}
<?php
header('Content-Type: application/json');
require_once './../Connection/OwnerConnection.php';

$conn = new Connection();

// Tangkap data dari POST
$animal_id = $_POST["animal_id"] ?? null;
$clinic_id = $_POST["clinic_id"] ?? null;
$queue_date = $_POST["queue_date"] ?? null;
$owner_id = $_POST["owner_id"] ?? null;
$type = $_POST["type"] ?? null;
if ($type != 'cancel') {
    $number = $conn->singleFetch("SELECT MAX(`queue_number`) FROM `queue` 
            WHERE `animal_id` = $animal_id AND `clinic_id` = $clinic_id AND `queue_date` = '$queue_date';");
    $queue_number = $number ? 1 : $number + 1;
}

$queue_id = $_POST["queue_id"] ?? null;

if (! empty($type)) {
    if ($type == 'insert' && ! empty($animal_id)
        && ! empty($clinic_id)
        && ! empty($owner_id)
        && ! empty($queue_number)
        && ! empty($queue_date)) {
        $query = "INSERT INTO `queue`(`clinic_id`, `owner_id`, `animal_id`, `queue_number`, `queue_date`, `queue_status`) 
            VALUES ($clinic_id,$owner_id,$animal_id,$queue_number,'$queue_date','queued')";
        if ($conn->runSql($query)) {
            echo json_encode(['status' => 'success', 'message' => 'Tambah Antrian Berhasil']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Tambah Antrian Gagal!']);
            exit;
        }
    } else if ($type == 'cancel' && ! empty($queue_id)) {
        $query = "UPDATE `queue` SET
                    `queue_status` = 'cancel' 
                WHERE `queue`.`queue_id` = $queue_id;";
        if ($conn->runSql($query)) {
            echo json_encode(['status' => 'success', 'message' => 'Batalkan Antrian Berhasil']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal Membatalkan Antrian!']);
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
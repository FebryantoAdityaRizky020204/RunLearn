<?php
header('Content-Type: application/json');
require_once './../Connection/DokterConnection.php';

$conn = new Connection();

// Tangkap data dari POST
$queue_id = $_POST["queue_id"] ?? null;
$type = $_POST["type"] ?? null;
// Tangkap data dari POST
$animal_id = $_POST["animal_id"] ?? null;
$vet_id = $_POST["vet_id"] ?? null;
$visit_notes = $_POST["visit_notes"] ?? null;
$from_visit_id = $_POST["from_visit_id"] ?? NULL;
$dataDrug = $_POST["dataDrugVisit"] ?? null;

if (! empty($type)) {
    if ($type == 'insert' && ! empty($queue_id)
        && ! empty($animal_id)
        && ! empty($vet_id)
        && ! empty($visit_notes)) {
        $visit_date_time = date('Y-m-d');

        if ($from_visit_id == "") {
            $query = "INSERT INTO `visit`(`visit_date_time`, `visit_notes`, `animal_id`, `vet_id`) 
                VALUES ('$visit_date_time','$visit_notes', $animal_id, $vet_id)";
        } else {
            $query = "INSERT INTO `visit`(`visit_date_time`, `visit_notes`, `animal_id`, `vet_id`, `from_visit_id`) 
                VALUES ('$visit_date_time','$visit_notes', $animal_id, $vet_id, $from_visit_id)";
        }

        if ($conn->runSql($query)) {
            $visit_id = mysqli_insert_id($conn->conn);
            $conn->runSql("UPDATE `queue` SET `queue_status` = 'finish' WHERE `queue`.`queue_id` = $queue_id;");

            foreach ($dataDrug as $drugv) {
                $dose = $drugv["visit_drug_dose"];
                $drug_id = $drugv["drug_id"];
                $freq = $drugv["visit_drug_frequency"];
                $qty = $drugv["visit_drug_qtysupplied"];
                $queryVD = "INSERT INTO `visit_drug`(`visit_drug_dose`, `visit_drug_frequency`, `visit_drug_qtysupplied`, `drug_id`, `visit_id`) 
                VALUES ('$dose','$freq',$qty,$drug_id,$visit_id)";
                $conn->runSql($queryVD);
            }

            echo json_encode(['status' => 'success', 'message' => 'Tambah Kunjungan Berhasil']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Tambah Kunjungan Gagal!']);
            exit;
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Data tidak lengkap untuk insert',
        ]);
        exit;
    }

} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Ada Data kosong',
    ]);
}
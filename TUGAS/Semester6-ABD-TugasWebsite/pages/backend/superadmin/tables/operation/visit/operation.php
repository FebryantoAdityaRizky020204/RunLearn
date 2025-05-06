<?php
require_once dirname(__FILE__) . '/../../Connection.php';

class Operation
{
    public $conn;

    public function __construct() {
        $this->conn = new Connection();
    }

    public function checkOperation($data)
    {
        $type = $data['type'];
        $result = false;

        if ($type == 'insert') {
            $result = $this->insert($data);
        } else if ($type == 'edit') {
            $result = $this->update($data);
        } else if ($type == 'delete') {
            $result = $this->delete($data);
        }

        return $result;
    }

    public function insert($data) {
        $result = ['status' => false, 'type' => 'insert', 'msg' => 'Gagal Ditambahkan'];
        try {
            if (!empty($data)) {
                $visit_date_time = $data["visit_date_time"];
                $visit_notes = $data["visit_notes"];
                $animal_id = $data["animal_id"];
                $vet_id = $data["vet_id"];
                $from_visit_id = isset($data["from_visit_id"]) && $data["from_visit_id"] !== '' ? $data["from_visit_id"] : 'NULL';

                $query = "INSERT INTO `visit` (`visit_date_time`, `visit_notes`, `animal_id`, `vet_id`, `from_visit_id`) VALUES
                            ('$visit_date_time', '$visit_notes', $animal_id, $vet_id, $from_visit_id)";

                if ($this->conn->runSql($query)) {
                    $result = ['status' => true, 'type' => 'insert', 'msg' => 'Berhasil Ditambahkan'];
                }
            }
        } catch (Throwable $e) {
            $result['msg'] = 'Error Insert: ' . $e->getMessage();
        }
        return $result;
    }

    public function update($data) {
        $result = ['status' => false, 'type' => 'update', 'msg' => 'Gagal Diupdate'];
        try {
            if (!empty($data)) {
                $visit_id = $data["visit_id"];
                $visit_date_time = $data["visit_date_time"];
                $visit_notes = $data["visit_notes"];
                $animal_id = $data["animal_id"];
                $vet_id = $data["vet_id"];
                $from_visit_id = isset($data["from_visit_id"]) && $data["from_visit_id"] !== '' ? $data["from_visit_id"] : 'NULL';

                $query = "UPDATE `visit` SET
                            `visit_date_time` = '$visit_date_time',
                            `visit_notes` = '$visit_notes',
                            `animal_id` = $animal_id,
                            `vet_id` = $vet_id,
                            `from_visit_id` = $from_visit_id 
                        WHERE `visit_id` = $visit_id;";

                if ($this->conn->runSql($query)) {
                    $result = ['status' => true, 'type' => 'update', 'msg' => 'Berhasil Diupdate'];
                }
            }
        } catch (Throwable $e) {
            $result['msg'] = 'Error Update: ' . $e->getMessage();
        }
        return $result;
    }

    public function delete($data) {
        $result = ['status' => false, 'type' => 'delete', 'msg' => 'Gagal Dihapus'];
        try {
            $visit_id = $data["visit_id"];
            $query = "DELETE FROM `visit` WHERE `visit_id` = $visit_id";

            if ($this->conn->runSql($query)) {
                $result = ['status' => true, 'type' => 'delete', 'msg' => 'Berhasil Dihapus'];
            }
        } catch (Throwable $e) {
            $result['msg'] = 'Error Delete: ' . $e->getMessage();
        }
        return $result;
    }
}

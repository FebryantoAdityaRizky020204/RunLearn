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
                $clinic_id = $data["clinic_id"];
                $vet_id = $data["vet_id"];
                $sv_count = $data["sv_count"];

                $query = "INSERT INTO `spec_visit`(`clinic_id`, `vet_id`, `sv_count`) 
                            VALUES ($clinic_id, $vet_id, $sv_count)";

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
                $clinic_id = $data["clinic_id"];
                $vet_id = $data["vet_id"];
                $sv_count = $data["sv_count"];

                $query = "UPDATE `spec_visit` SET
                            `sv_count`= $sv_count
                            WHERE `clinic_id` = $clinic_id AND `vet_id` = $vet_id";

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
            $clinic_id = $data["clinic_id"];
            $vet_id = $data["vet_id"];
            $query = "DELETE FROM `spec_visit` WHERE `clinic_id` = $clinic_id AND `vet_id` = $vet_id";

            if ($this->conn->runSql($query)) {
                $result = ['status' => true, 'type' => 'delete', 'msg' => 'Berhasil Dihapus'];
            }
        } catch (Throwable $e) {
            $result['msg'] = 'Error Delete: ' . $e->getMessage();
        }
        return $result;
    }
}

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
                $vet_title = $data['vet_title'];
                $vet_givenname = $data['vet_givenname'];
                $vet_familyname = $data['vet_familyname'];
                $vet_phone = $data['vet_phone'];
                $vet_employed = $data['vet_employed'];
                $spec_id = $data['spec_id'];
                $clinic_id = $data['clinic_id'];

                $query = "INSERT INTO `vet` (`vet_title`, `vet_givenname`, `vet_familyname`, `vet_phone`, `vet_employed`, `spec_id`, `clinic_id`) 
                    VALUES ('$vet_title', '$vet_givenname', '$vet_familyname', '$vet_phone', '$vet_employed', $spec_id, $clinic_id);";

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
                $vet_id = $data['vet_id'];
                $vet_title = $data['vet_title'];
                $vet_givenname = $data['vet_givenname'];
                $vet_familyname = $data['vet_familyname'];
                $vet_phone = $data['vet_phone'];
                $vet_employed = $data['vet_employed'];
                $spec_id = $data['spec_id'];
                $clinic_id = $data['clinic_id'];

                $query = "UPDATE `vet` SET
                            `vet_title` = '$vet_title', 
                            `vet_givenname` = '$vet_givenname', 
                            `vet_familyname` = '$vet_familyname', 
                            `vet_phone` = '$vet_phone', 
                            `vet_employed` = '$vet_employed', 
                            `spec_id` = $spec_id, 
                            `clinic_id` = $clinic_id 
                            WHERE `vet_id` = $vet_id;";

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
            $vet_id = $data["vet_id"];
            $query = "DELETE FROM `vet` WHERE `vet_id` = $vet_id;";

            if ($this->conn->runSql($query)) {
                $result = ['status' => true, 'type' => 'delete', 'msg' => 'Berhasil Dihapus'];
            }
        } catch (Throwable $e) {
            $result['msg'] = 'Error Delete: ' . $e->getMessage();
        }
        return $result;
    }
}

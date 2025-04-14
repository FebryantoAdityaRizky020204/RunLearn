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
                $at_description = $data["at_description"];

                $query = "INSERT INTO `animal_type` (`at_description`) VALUES ('$at_description');";

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
                $at_id = $data["at_id"];
                $at_description = $data["at_description"];

                $query = "UPDATE `animal_type` SET
                            `at_description` = '$at_description'
                        WHERE `at_id` = $at_id;";

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
            $at_id = $data["at_id"];
            $query = "DELETE FROM `animal_type` WHERE `at_id` = $at_id";

            if ($this->conn->runSql($query)) {
                $result = ['status' => true, 'type' => 'delete', 'msg' => 'Berhasil Dihapus'];
            }
        } catch (Throwable $e) {
            $result['msg'] = 'Error Delete: ' . $e->getMessage();
        }
        return $result;
    }
}

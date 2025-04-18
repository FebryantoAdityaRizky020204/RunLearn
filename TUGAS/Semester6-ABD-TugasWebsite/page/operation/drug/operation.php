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
                $drug_name = $data["drug_name"];
                $drug_usage = $data["drug_usage"];

                $query = "INSERT INTO `drug` (`drug_name`, `drug_usage`) VALUES
                                ('$drug_name', '$drug_usage');";

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
                $drug_id = $data["drug_id"];
                $drug_name = $data["drug_name"];
                $drug_usage = $data["drug_usage"];

                $query = "UPDATE `drug` SET
                            `drug_name` = '$drug_name',
                            `drug_usage` = '$drug_usage'
                        WHERE drug_id = $drug_id;";

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
            $drug_id = $data["drug_id"];
            $query = "DELETE FROM `drug` WHERE `drug_id` = $drug_id";

            if ($this->conn->runSql($query)) {
                $result = ['status' => true, 'type' => 'delete', 'msg' => 'Berhasil Dihapus'];
            }
        } catch (Throwable $e) {
            $result['msg'] = 'Error Delete: ' . $e->getMessage();
        }
        return $result;
    }
}

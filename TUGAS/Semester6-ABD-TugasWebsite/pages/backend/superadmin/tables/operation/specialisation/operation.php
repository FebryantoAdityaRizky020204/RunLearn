<?php
require_once dirname(__FILE__).'/../../Connection.php';

class Operation
{
    public $conn;

    public function __construct()
    {
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

    public function insert($data)
    {
        $result = ['status' => false, 'type' => 'insert', 'msg' => 'Gagal Ditambahkan'];
        try {
            if (! empty($data)) {
                $spec_description = $data["spec_description"];
                $medical_cost = $data["medical_cost"];

                $query = "INSERT INTO `specialisation` (`spec_description`, `medical_cost`) VALUES
                    ('$spec_description', $medical_cost);";

                if ($this->conn->runSql($query)) {
                    $result = ['status' => true, 'type' => 'insert', 'msg' => 'Berhasil Ditambahkan'];
                }
            }
        } catch (Throwable $e) {
            $result['msg'] = 'Error Insert: '.$e->getMessage();
        }
        return $result;
    }

    public function update($data)
    {
        $result = ['status' => false, 'type' => 'update', 'msg' => 'Gagal Diupdate'];
        try {
            if (! empty($data)) {
                $spec_id = $data["spec_id"];
                $spec_description = $data["spec_description"];
                $medical_cost = $data["medical_cost"];

                $query = "UPDATE `specialisation` SET
                            `spec_description` = '$spec_description',
                            `medical_cost` = '$medical_cost' 
                        WHERE `spec_id` = $spec_id;";

                if ($this->conn->runSql($query)) {
                    $result = ['status' => true, 'type' => 'update', 'msg' => 'Berhasil Diupdate'];
                }
            }
        } catch (Throwable $e) {
            $result['msg'] = 'Error Update: '.$e->getMessage();
        }
        return $result;
    }

    public function delete($data)
    {
        $result = ['status' => false, 'type' => 'delete', 'msg' => 'Gagal Dihapus'];
        try {
            $spec_id = $data["spec_id"];
            $query = "DELETE FROM `specialisation` WHERE `spec_id` = $spec_id";

            if ($this->conn->runSql($query)) {
                $result = ['status' => true, 'type' => 'delete', 'msg' => 'Berhasil Dihapus'];
            }
        } catch (Throwable $e) {
            $result['msg'] = 'Error Delete: '.$e->getMessage();
        }
        return $result;
    }
}
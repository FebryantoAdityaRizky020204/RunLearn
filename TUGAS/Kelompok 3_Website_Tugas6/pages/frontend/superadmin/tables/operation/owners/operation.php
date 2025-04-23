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
                $owner_givenname = $data["owner_givenname"];
                $owner_familyname = $data["owner_familyname"];
                $owner_address = $data["owner_address"];
                $owner_phone = $data["owner_phone"];

                $query = "INSERT INTO `owners` (`owner_givenname`, `owner_familyname`, `owner_address`, `owner_phone`) 
                    VALUES ('$owner_givenname', '$owner_familyname', '$owner_address', AES_ENCRYPT('$owner_phone', 'adit'))";

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
                $owner_id = $data["owner_id"];
                $owner_givenname = $data["owner_givenname"];
                $owner_familyname = $data["owner_familyname"];
                $owner_address = $data["owner_address"];
                $owner_phone = $data["owner_phone"];

                $query = "UPDATE `owners` SET 
                            `owner_givenname` = '$owner_givenname',
                            `owner_familyname` = '$owner_familyname',
                            `owner_address` = '$owner_address',
                            `owner_phone` = AES_ENCRYPT('$owner_phone', 'adit') 
                          WHERE `owner_id` = $owner_id";

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
            $owner_id = $data["owner_id"];
            $query = "DELETE FROM `owners` WHERE `owner_id` = $owner_id";

            if ($this->conn->runSql($query)) {
                $result = ['status' => true, 'type' => 'delete', 'msg' => 'Berhasil Dihapus'];
            }
        } catch (Throwable $e) {
            $result['msg'] = 'Error Delete: ' . $e->getMessage();
        }

        return $result;
    }
}

<?php
require_once './../../backend/Connection/PetugasAdministrasiConnection.php';

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
        } else if ($type == 'reset-password') {
            $result = $this->resetPassword($data);
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
                $owner_givenname = $data["owner_givenname"];
                $owner_familyname = $data["owner_familyname"];
                $owner_address = $data["owner_address"];
                $owner_phone = $data["owner_phone"];
                $username = $data["owner_phone"];
                $password = password_hash($data["owner_phone"], PASSWORD_DEFAULT);

                $query = "INSERT INTO `owners` (`owner_givenname`, `owner_familyname`, `owner_address`, `owner_phone`, `username`, `password`) 
                    VALUES ('$owner_givenname', '$owner_familyname', '$owner_address', $owner_phone, '$username', '$password')";

                if ($this->conn->runSql($query)) {
                    $result = ['status' => true, 'type' => 'insert', 'msg' => 'Berhasil Ditambahkan'];
                }
            }
        } catch (Throwable $e) {
            $result['msg'] = 'Error Insert: '.$e->getMessage();
        }

        return $result;
    }

    public function resetPassword($data)
    {
        $result = ['status' => false, 'type' => 'update', 'msg' => 'Gagal Reset Password'];

        try {
            if (! empty($data)) {
                $owner_id = $data['owner_id'];
                $username = $data["owner_phone"];
                $password = password_hash($data["owner_phone"], PASSWORD_DEFAULT);

                $query = "UPDATE `owners` SET 
                            `username` = '$username',
                            `password` = '$password' 
                          WHERE `owner_id` = $owner_id";

                if ($this->conn->runSql($query)) {
                    $result = ['status' => true, 'type' => 'update', 'msg' => 'Reset Password Berhasil'];
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
            $owner_id = $data["owner_id"];
            $query = "DELETE FROM `owners` WHERE `owner_id` = $owner_id";

            if ($this->conn->runSql($query)) {
                $result = ['status' => true, 'type' => 'delete', 'msg' => 'Berhasil Dihapus'];
            }
        } catch (Throwable $e) {
            $result['msg'] = 'Error Delete: '.$e->getMessage();
        }

        return $result;
    }
}
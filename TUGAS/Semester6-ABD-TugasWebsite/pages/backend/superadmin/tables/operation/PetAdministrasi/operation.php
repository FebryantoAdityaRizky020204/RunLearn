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
                $petugasadmin_nama = $data["petugasadmin_nama"];
                $petugasadmin_nohp = $data["petugasadmin_nohp"];
                $clinic_id = $data["clinic_id"];
                $username = $data["petugasadmin_nohp"];
                $password = password_hash($data["petugasadmin_nohp"], PASSWORD_DEFAULT);

                $query = "INSERT INTO `petugas_administrasi` (`petugasadmin_nama`, `petugasadmin_nohp`, `username`, `password`, `clinic_id`) 
                    VALUES ('$petugasadmin_nama', $petugasadmin_nohp, '$username', '$password', $clinic_id)";

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
                $petugasadmin_id = $data['petugasadmin_id'];
                $username = $data["petugasadmin_nohp"];
                $password = password_hash($data["petugasadmin_nohp"], PASSWORD_DEFAULT);

                $query = "UPDATE `petugas_administrasi` SET 
                            `username` = '$username',
                            `password` = '$password' 
                          WHERE `petugasadmin_id` = $petugasadmin_id";

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
            $petugasadmin_id = $data["petugasadmin_id"];
            $query = "DELETE FROM `petugas_administrasi` WHERE `petugasadmin_id` = $petugasadmin_id";

            if ($this->conn->runSql($query)) {
                $result = ['status' => true, 'type' => 'delete', 'msg' => 'Berhasil Dihapus'];
            }
        } catch (Throwable $e) {
            $result['msg'] = 'Error Delete: '.$e->getMessage();
        }

        return $result;
    }
}
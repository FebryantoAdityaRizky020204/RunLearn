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
                $clinic_name = $data["clinic_name"];
                $clinic_address = $data["clinic_address"];
                $clinic_phone = $data["clinic_phone"];
                $clinic_start_day = $data['clinic_start_day'];
                $clinic_end_day = $data['clinic_end_day'];
                $clinic_start_time = $data['clinic_start_time'];
                $clinic_end_time = $data['clinic_end_time'];
                $clinic_status = $data['clinic_status'];

                $query = "INSERT INTO `clinic` (`clinic_name`, `clinic_address`, `clinic_phone`, `clinic_start_day`, `clinic_end_day`, `clinic_start_time`, `clinic_end_time`, `clinic_status`) VALUES
                                ('$clinic_name', '$clinic_address', '$clinic_phone', '$clinic_start_day', '$clinic_end_day', '$clinic_start_time', '$clinic_end_time', '$clinic_status');";
                // var_dump($query);
                // die;
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
                $clinic_id = (int) $data["clinic_id"];
                $clinic_name = $data["clinic_name"];
                $clinic_address = $data["clinic_address"];
                $clinic_phone = $data["clinic_phone"];
                $clinic_start_day = $data['clinic_start_day'];
                $clinic_end_day = $data['clinic_end_day'];
                $clinic_start_time = $data['clinic_start_time'];
                $clinic_end_time = $data['clinic_end_time'];
                $clinic_status = $data['clinic_status'];

                $query = "UPDATE `clinic` SET 
                            `clinic_name` = '$clinic_name',
                            `clinic_address` = '$clinic_address',
                            `clinic_phone` = '$clinic_phone',
                            `clinic_start_day` = '$clinic_start_day',
                            `clinic_end_day` = '$clinic_end_day',
                            `clinic_start_time` = '$clinic_start_time',
                            `clinic_end_time` = '$clinic_end_time',
                            `clinic_status` = '$clinic_status' 
                        WHERE `clinic_id` = $clinic_id";


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
            $clinic_id = $data["clinic_id"];
            $query = "DELETE FROM `clinic` WHERE `clinic_id` = $clinic_id";

            if ($this->conn->runSql($query)) {
                $result = ['status' => true, 'type' => 'delete', 'msg' => 'Berhasil Dihapus'];
            }
        } catch (Throwable $e) {
            $result['msg'] = 'Error Delete: '.$e->getMessage();
        }
        return $result;
    }
}
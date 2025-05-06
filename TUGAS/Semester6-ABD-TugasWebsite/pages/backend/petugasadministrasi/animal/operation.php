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
                $animal_name = $data["animal_name"];
                $animal_born = $data["animal_born"];
                $owner_id = $data["owner_id"];
                $at_id = $data["at_id"];

                $query = "INSERT INTO `animal` (`animal_name`, `animal_born`, `owner_id`, `at_id`) VALUES
                            ('$animal_name', '$animal_born', $owner_id, $at_id);";

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
                $animal_id = $data["animal_id"];
                $animal_name = $data["animal_name"];
                $animal_born = $data["animal_born"];
                $owner_id = $data["owner_id"];
                $at_id = $data["at_id"];

                $query = "UPDATE `animal` SET
                            `animal_name` = '$animal_name',
                            `animal_born` = '$animal_born',
                            `owner_id` = $owner_id,
                            `at_id` = $at_id
                        WHERE animal_id = $animal_id;";

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
            $animal_id = $data["animal_id"];
            $query = "DELETE FROM `animal` WHERE `animal_id` = $animal_id";

            if ($this->conn->runSql($query)) {
                $result = ['status' => true, 'type' => 'delete', 'msg' => 'Berhasil Dihapus'];
            }
        } catch (Throwable $e) {
            $result['msg'] = 'Error Delete: '.$e->getMessage();
        }
        return $result;
    }
}
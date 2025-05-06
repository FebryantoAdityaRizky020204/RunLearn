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
                $visit_drug_dose = $data['visit_drug_dose'];
                $visit_drug_frequency = $data['visit_drug_frequency'];
                $visit_drug_qtysupplied = $data['visit_drug_qtysupplied'];
                $drug_id = $data['drug_id'];
                $visit_id = $data['visit_id'];

                $query = "INSERT INTO `visit_drug` (`visit_drug_dose`, `visit_drug_frequency`, `visit_drug_qtysupplied`, `drug_id`, `visit_id`) VALUES
                            ('$visit_drug_dose', '$visit_drug_frequency', $visit_drug_qtysupplied, $drug_id, $visit_id);";
                            // die($query);
                
                            

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
                $visit_drug_dose = $data['visit_drug_dose'];
                $visit_drug_frequency = $data['visit_drug_frequency'];
                $visit_drug_qtysupplied = $data['visit_drug_qtysupplied'];
                $drug_id = $data['drug_id'];
                $visit_id = $data['visit_id'];

                $query = "UPDATE `visit_drug` SET
                            `visit_drug_dose` = '$visit_drug_dose',
                            `visit_drug_frequency` = '$visit_drug_frequency',
                            `visit_drug_qtysupplied` = $visit_drug_qtysupplied 
                        WHERE `drug_id` = $drug_id AND `visit_id` = $visit_id;";

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
            $visit_id = $data["visit_id"];
            $drug_id = $data["drug_id"];
            $query = "DELETE FROM `visit_drug` WHERE `visit_id` = $visit_id AND `drug_id` = $drug_id;";

            if ($this->conn->runSql($query)) {
                $result = ['status' => true, 'type' => 'delete', 'msg' => 'Berhasil Dihapus'];
            }
        } catch (Throwable $e) {
            $result['msg'] = 'Error Delete: ' . $e->getMessage();
        }
        return $result;
    }
}

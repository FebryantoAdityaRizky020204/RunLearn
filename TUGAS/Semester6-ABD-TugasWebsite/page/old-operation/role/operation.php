<?php

    require_once dirname(__FILE__) . '/../../Connection.php';
    class Operation {
        public $conn;

        public function __construct() {
            $this->conn = new Connection();
        }

        public function checkOperation($data) {
            $type = $data['type'];
            $result = false;
    
            if($type == 'insert') $result = $this->insert($data);
            else if($type == 'edit') $result = $this->update($data);
            else if($type == 'delete') $result = $this->delete($data);
    
            return $result;
        }

        public  function insert($data) {
            $result = ['status' => false, 'msg' => 'GAGAL'];
            $id_role = $data['id_role'];
            $nama_role = $data['nama_role'];
            $query = "CALL Insert_Role('$id_role', '$nama_role')";
            if($this->conn->runSql($query)){
                $result = true;
            }
            return $result;
        }

        
        public  function update($data) {
            $result = ['status' => false, 'msg' => 'GAGAL'];
            $id_role = $data['id_role'];
            $nama_role = $data['nama_role'];
            $query = "CALL Update_Role('$id_role', '$nama_role')";
            if($this->conn->runSql($query)){
                $result = true;
            }
            return $result;
        }

        public  function delete($data) {
            $result = ['status' => false, 'msg' => 'GAGAL'];
            $id_role = $data['id_role'];
            $query = "CALL Delete_Role('$id_role')";
            if($this->conn->runSql($query)){
                $result = true;
            }
            return $result;
        }
    }
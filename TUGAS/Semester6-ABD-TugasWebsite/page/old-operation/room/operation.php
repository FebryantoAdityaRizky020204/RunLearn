<?php

    require_once dirname(__FILE__) . '/../../Connection.php';
    class Operation {
        public $conn;

        public function __construct() {
            
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
            $id_room = $data["id_room"];
            $id_pegawai = $data["id_pegawai"];
            $nama_kamar = $data["nama_kamar"];
            $jumlah_kamar = $data["jumlah_kamar"];
            $query = "CALL Insert_Room('$id_room', '$id_pegawai', '$nama_kamar', $jumlah_kamar)";
            if($this->conn->runSql($query)){
                $result = true;
            }
            return $result;
        }

        
        public  function update($data) {
            $result = ['status' => false, 'msg' => 'GAGAL'];
            $id_room = $data["id_room"];
            $id_pegawai = $data["id_pegawai"];
            $nama_kamar = $data["nama_kamar"];
            $jumlah_kamar = $data["jumlah_kamar"];
            $query = "CALL Update_Room('$id_room', '$id_pegawai', '$nama_kamar', $jumlah_kamar)";
            if($this->conn->runSql($query)){
                $result = true;
            }
            return $result;
        }

        public  function delete($data) {
            $result = ['status' => false, 'msg' => 'GAGAL'];
            $id_room = $data["id_room"];
            $query = "CALL Delete_Room('$id_room')";
            if($this->conn->runSql($query)){
                $result = true;
            }
            return $result;
        }
    }
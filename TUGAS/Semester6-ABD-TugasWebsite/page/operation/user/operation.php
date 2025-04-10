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
            $i_id_pelanggan = $data["id_Pelanggan"];
            $i_nama_pl = $data["nama_pl"];
            $i_alamat_pl = $data["alamat_pl"];
            $i_tgl_lahir_pl = $data["tgl_lahir_pl"];

            $query = "CALL Insert_User('$i_id_pelanggan', '$i_nama_pl', '$i_alamat_pl', '$i_tgl_lahir_pl')";
            if($this->conn->runSql($query)){
                $result = true;
            }
            return $result;
        }


        public  function update($data) {
            $result = ['status' => false, 'msg' => 'GAGAL'];
            $i_id_pelanggan = $data["id_Pelanggan"];
            $i_nama_pl = $data["nama_pl"];
            $i_alamat_pl = $data["alamat_pl"];
            $i_tgl_lahir_pl = $data["tgl_lahir_pl"];
            $query = "CALL Update_User('$i_id_pelanggan', '$i_nama_pl', '$i_alamat_pl', '$i_tgl_lahir_pl')";
            if($this->conn->runSql($query)){
                $result = true;
            }
            return $result;
        }

        public  function delete($data) {
            $result = ['status' => false, 'msg' => 'GAGAL'];
            $i_id_pelanggan = $data["id_Pelanggan"];
            $query = "CALL Delete_User('$i_id_pelanggan')";
            if($this->conn->runSql($query)){
                $result = true;
            }
            return $result;
        }
    }
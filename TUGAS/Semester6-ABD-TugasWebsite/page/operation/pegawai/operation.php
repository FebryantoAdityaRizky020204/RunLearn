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
            $id_pegawai =$data["id_pegawai"];
            $id_role =$data["id_role"];
            $nama_pg =$data["nama_pg"];
            $alamat =$data["alamat_pg"];
            $username_pg =$data["username_pg"];
            $password_pg =$data["password_pg"];
            $query = "CALL Insert_Pegawai('$id_pegawai', '$id_role', '$nama_pg', '$alamat', '$username_pg', '$password_pg')";
            die($query);
            if($this->conn->runSql($query)){
                $result = true;
            }
            return $result;
        }

        
        public  function update($data) {
            $result = ['status' => false, 'msg' => 'GAGAL'];
            $id_pegawai =$data["id_pegawai"];
            $id_role =$data["id_role"];
            $nama_pg =$data["nama_pg"];
            $alamat =$data["alamat_pg"];
            $username_pg =$data["username_pg"];
            $password_pg =$data["password_pg"];
            $query = "CALL Update_Pegawai('$id_pegawai', '$id_role', '$nama_pg', '$alamat', '$username_pg', '$password_pg')";
            if($this->conn->runSql($query)){
                $result = true;
            }
            return $result;
        }

        public  function delete($data) {
            $result = ['status' => false, 'msg' => 'GAGAL'];
            $id_pegawai =$data["id_pegawai"];
            $query = "CALL Delete_Pegawai('$id_pegawai')";
            if($this->conn->runSql($query)){
                $result = true;
            }
            return $result;
        }
    }
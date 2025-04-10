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
            $id_room_option = $data["id_room_option"];
            $id_room = $data["id_room"];
            $id_pegawai = $data["id_pegawai"];
            $nama_opsi = $data["nama_opsi"];
            $jumlah_kasur = $data["jumlah_kasur"];
            $tipe_kasur = $data["tipe_kasur"];
            $jumlah_tamu = $data["jumlah_tamu"];
            $sarapan = $data["sarapan"];
            $kamar_tersedia = $data["kamar_tersedia"];
            $harga_kamar = $data["harga_kamar"];
            $no_kamar_start = $data["no_kamar_start"];
            $no_kamar_end = $data["no_kamar_end"];
            
            $query = "CALL Insert_Room_Option('$id_room_option', '$id_room', '$id_pegawai', '$nama_opsi', 
                        $jumlah_kasur, '$tipe_kasur', $jumlah_tamu, $sarapan, $kamar_tersedia, 
                        $harga_kamar, $no_kamar_start, $no_kamar_end)";
            if($this->conn->runSql($query)){
                $result = true;
            }
            return $result;
        }

        
        public  function update($data) {
            $result = ['status' => false, 'msg' => 'GAGAL'];
            $id_room_option = $data["id_room_option"];
            $id_room = $data["id_room"];
            $id_pegawai = $data["id_pegawai"];
            $nama_opsi = $data["nama_opsi"];
            $jumlah_kasur = $data["jumlah_kasur"];
            $tipe_kasur = $data["tipe_kasur"];
            $jumlah_tamu = $data["jumlah_tamu"];
            $sarapan = $data["sarapan"];
            $kamar_tersedia = $data["kamar_tersedia"];
            $harga_kamar = $data["harga_kamar"];
            $no_kamar_start = $data["no_kamar_start"];
            $no_kamar_end = $data["no_kamar_end"];
            
            $query = "CALL Update_Room_Option('$id_room_option', '$id_room', '$id_pegawai', '$nama_opsi', 
                        $jumlah_kasur, '$tipe_kasur', $jumlah_tamu, $sarapan, $kamar_tersedia, 
                        $harga_kamar, $no_kamar_start, $no_kamar_end)";
            if($this->conn->runSql($query)){
                $result = true;
            }
            return $result;
        }

        public  function delete($data) {
            $result = ['status' => false, 'msg' => 'GAGAL'];
            $id_room_option = $data["id_room_option"];
            $query = "CALL Delete_Room_Option('$id_room_option')";
            if($this->conn->runSql($query)){
                $result = true;
            }
            return $result;
        }
    }
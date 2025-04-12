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
            $id_pemesanan = $data["id_pemesanan"];
            $id_pegawai = $data["id_pegawai"];
            $id_pelanggan = $data["id_pelanggan"];
            $ROPT_HK = explode(" - ", $data["id_room_option"]);
            $id_room_option = $ROPT_HK[0];
            $no_kamar = $data["no_kamar"];
            $tgl_start = $data["tgl_start"];
            $tgl_end = $data["tgl_end"];
            $status = $data["status"];

            $selisih_hari = strtotime($tgl_end) - strtotime($tgl_start);
            $jumlah_hari = $selisih_hari / (60 * 60 * 24);

            $total_harga = ($jumlah_hari + 1) * $ROPT_HK[1];
            $query = "CALL Insert_Pemesanan('$id_pemesanan', '$id_pegawai', '$id_pelanggan', '$id_room_option', 
            '$no_kamar', '$tgl_start', '$tgl_end', '$status', $total_harga)";
            if($this->conn->runSql($query)){
                $result = true;
            }
            return $result;
        }
        
        public  function update($data) {
            $result = ['status' => false, 'msg' => 'GAGAL'];
            $id_pemesanan = $data["id_pemesanan"];
            $id_pegawai = $data["id_pegawai"];
            $id_pelanggan = $data["id_pelanggan"];
            $ROPT_HK = explode(" - ", $data["id_room_option"]);
            $id_room_option = $ROPT_HK[0];
            $no_kamar = $data["no_kamar"];
            $tgl_start = $data["tgl_start"];
            $tgl_end = $data["tgl_end"];
            $status = $data["status"];

            $selisih_hari = strtotime($tgl_end) - strtotime($tgl_start);
            $jumlah_hari = $selisih_hari / (60 * 60 * 24);

            $total_harga = ($jumlah_hari + 1) * $ROPT_HK[1];

            $query = "CALL Update_Pemesanan('$id_pemesanan', '$id_pegawai', '$id_pelanggan', '$id_room_option', 
            $no_kamar, '$tgl_start', '$tgl_end', $total_harga, '$status')";
            if($this->conn->runSql($query)){
                $result = true;
            }
            return $result;
        }

        public  function delete($data) {
            $result = ['status' => false, 'msg' => 'GAGAL'];
            $id_pemesanan = $data["id_pemesanan"];
            $query = "CALL Delete_Pemesanan('$id_pemesanan')";
            if($this->conn->runSql($query)){
                $result = true;
            }
            return $result;
        }
    }
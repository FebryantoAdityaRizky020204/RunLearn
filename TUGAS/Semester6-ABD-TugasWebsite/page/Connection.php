<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    class Connection {
        public $host = 'localhost';
        public $dbname = 'chotel';
        public $conn;

        public function __construct() {
            $connectAs = 
                (isset($_SESSION['connectAs']) && ! empty($_SESSION['connectAs']))
                ? $_SESSION['connectAs']
                : 'root';
            switch ($connectAs) {
                case 'Administrator':
                    $username = 'root';
                    $password = '';
                    break;
                case 'Pemilik':
                    $username = 'root';
                    $password = '';
                    break;
                case 'dokter':
                    $username = 'root';
                    $password = '';
                    break;
                default:
                    $username = 'root';
                    $password = '';
            }

            $this->conn = mysqli_connect(
                $this->host,
                $username,
                $password,
                $this->dbname
            );
        }

        public function singleFetch($query){
            $data = NULL;
            if ($sql = $this->conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data = $row;
				}
			}
            $this->conn->next_result();
            return $data;
        }

        // fungsi untuk mengambil banyak data
        public function fetchAll($query){
            $data = [];
            if ($sql = $this->conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
                    $data[] = $row;
				}
			}
            $this->conn->next_result();
            return $data;
        }

        // Fungsi untuk menjalankan sql
        public function runSql($query){
            $data = false;
            if ($sql = $this->conn->query($query)) {
                    $data = $sql;
			}
            return $data;
        }
    }
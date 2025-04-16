<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class Connection {
    public $host = 'localhost';
    public $dbname = 'sahabat_satwa';
    public $conn;

    public function __construct() {
        $connectAs = 
            (isset($_SESSION['connectAs']) && !empty($_SESSION['connectAs']))
            ? $_SESSION['connectAs']
            : 'root';

        switch ($connectAs) {
            case 'Administrator':
                $username = 'admin_user';
                $password = 'admin_password';
                break;
            case 'PetOwner':
                $username = 'pet_owner_user';
                $password = 'pet_owner_password';
                break;
            case 'Dokter':
                $username = 'vet_user';
                $password = 'vet_password';
                break;
            default:
                $username = 'root';
                $password = '';
        }

        // Koneksi ke database
        $this->conn = mysqli_connect(
            $this->host,
            $username,
            $password,
            $this->dbname
        );

        // Cek koneksi
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    // Fungsi untuk mengambil satu data
    public function singleFetch($query){
        $data = null;
        if ($sql = $this->conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data = $row;
            }
        }
        $this->conn->next_result();
        return $data;
    }

    // Fungsi untuk mengambil banyak data
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

    // Fungsi untuk menjalankan query
    public function runSql($query){
        $data = false;
        if ($sql = $this->conn->query($query)) {
            $data = $sql;
        }
        return $data;
    }
}
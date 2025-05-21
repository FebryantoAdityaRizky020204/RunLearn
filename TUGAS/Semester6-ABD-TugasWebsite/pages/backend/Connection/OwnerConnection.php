<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
date_default_timezone_set('Asia/Jakarta');
class Connection
{
    public $host = 'localhost';
    public $dbname = 'sahabat_satwa';
    public $username = 'root';
    public $password = '';
    public $conn;

    public function __construct()
    {
        // Koneksi ke database
        $this->conn = mysqli_connect(
            $this->host,
            $this->username,
            $this->password,
            $this->dbname
        );

        // Cek koneksi
        if (! $this->conn) {
            die("Connection failed: ".mysqli_connect_error());
        }
    }

    // Fungsi untuk mengambil satu data
    public function singleFetch($query)
    {
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
    public function fetchAll($query)
    {
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
    public function runSql($query)
    {
        $data = false;
        if ($sql = $this->conn->query($query)) {
            $data = $sql;
        }
        return $data;
    }
}
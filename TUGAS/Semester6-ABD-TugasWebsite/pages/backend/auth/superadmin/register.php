<?php
require_once './../../Connection/SuperAdminConnection.php';
$conn = new Connection();
header('Location: ./../../../index.php');
exit;

$password = password_hash('admin', PASSWORD_DEFAULT);
$query = "INSERT INTO `superadmin`(`admin_username`, `admin_password`) 
            VALUES ('admin','$password')";
$conn->runSql($query);
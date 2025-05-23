<?php
if (! session_id()) {
    session_start();
}

include_once './tables/Connection.php';
$conn = new Connection();

$loginAs = $_SESSION['loginAs'] ?? null;
if ($loginAs !== 'superadmin') {
    header('Location: ./../../index.php');
    exit;
}

$admin_id = $_SESSION["dataLogin"]["admin_id"] ?? null;
$adminQuery = "SELECT * FROM `superadmin` WHERE `admin_id` = $admin_id";
$admin = $conn->singleFetch($adminQuery);

if (isset($_POST["submit"])) {
    if ($_POST["type"] == "update-admin") {
        $admin_id = $_POST["admin_id"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $nama_admin = $_POST["nama_admin"];

        if ($password == "") {
            $query = "UPDATE `superadmin` SET `username`='$username', `nama_admin`='$nama_admin' WHERE `admin_id`=$admin_id";
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE `superadmin` SET `username`='$username', `password`='$password', `nama_admin`='$nama_admin' WHERE `admin_id`=$admin_id";
        }
        $conn->runSql($query);
        header("Location: ./dashboard.php");
        exit();
    }
}


$titlePage = 'Dashboard - SuperAdmin Sahabat Satwa';
?>


<?php require_once './../templates/header.php'; ?>
<link rel="stylesheet" href="./../owners/css/dashboard.css">

<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="../../index.php">
            <img src="../../assets/image/paw_logo.png" alt="Logo" width="30" height="24"
                class="d-inline-block align-text-top">
            Sahabat Satwa
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="./dashboard.php">
                        <i class="fa-solid fa-house"></i>
                        Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./tables.php?page=owners">
                        <i class="fa-solid fa-table"></i>
                        Tables
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./logout.php">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container justify-content-start mt-3">
    <div class="row align-items-center">
        <div class="col-md-12">
            <h3>SUPER ADMIN</h3>

            <hr class="border border-3 opacity-75" style="border-color: #ff9900 !important;">

            <div class="row my-2">
                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-header fw-bold">
                            My Profile
                        </div>
                        <form action="" method="POST">
                            <input type="hidden" name="type" value="update-admin">
                            <input type="hidden" name="admin_id" value="<?= $admin_id ?>">
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <label for="staticEmail" class="col-4 col-form-label">Nama</label>
                                    <div class="col-8">
                                        <input type="text" name="nama_admin" id="nama_admin" class="form-control"
                                            value="<?= $admin['nama_admin'] ?>" readonly autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="staticEmail" class="col-4 col-form-label">Username</label>
                                    <div class="col-8">
                                        <input type="text" name="username" id="username" class="form-control"
                                            value="<?= $admin['username'] ?>" readonly autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-4 col-form-label">Password</label>
                                    <div class="col-8">
                                        <input type="password" name="password" id="password" class="form-control"
                                            id="inputPassword" value="----------" readonly>
                                        <p class="small text-danger" id="password-warning" hidden>
                                            *kosongkan jika tidak ingin mengubah password
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-body-secondary">
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" type="button">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    EDIT
                                </button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" hidden type="button">
                                    <i class="fa-solid fa-xmark"></i>
                                    BATAL
                                </button>
                                <button name="submit" class="btn btn-primary btn-sm" data-bs-toggle="modal" hidden
                                    type="submit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    SIMPAN
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

<footer>
    <div class="d-flex justify-content-between align-items-end">
        <div class="footer-left">
            <h5>Sahabat Satwa </h5>
        </div>
        <div class="footer-right d-flex align-items-center">
            <h5 class="mb-0 me-2">Kontak Kami:</h5>
            <p class="mb-0">+62 812-3456-7890</p>
        </div>
    </div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const editButton = document.querySelector('.btn-warning');
    const saveButton = document.querySelector('.btn-primary');
    const cancelButton = document.querySelector('.btn-danger');
    const passwordInput = document.getElementById('password');
    const usernameInput = document.getElementById('username');
    const namaInput = document.getElementById('nama_admin');

    editButton.addEventListener('click', function() {
        namaInput.removeAttribute('readonly');
        usernameInput.removeAttribute('readonly');
        passwordInput.removeAttribute('readonly');
        passwordInput.focus();
        editButton.setAttribute('hidden', true);
        cancelButton.removeAttribute('hidden');
        saveButton.removeAttribute('hidden');
        document.getElementById('password').value = '';
        document.getElementById('password-warning').removeAttribute('hidden');
    });

    cancelButton.addEventListener('click', function() {
        namaInput.setAttribute('readonly', true);
        usernameInput.setAttribute('readonly', true);
        passwordInput.setAttribute('readonly', true);
        editButton.removeAttribute('hidden');
        saveButton.setAttribute('hidden', true);
        cancelButton.setAttribute('hidden', true);
        document.getElementById('password').value = '----------';
        document.getElementById('password-warning').setAttribute('hidden', true);
    });
});
</script>

<?php require_once './../templates/footer.php'; ?>
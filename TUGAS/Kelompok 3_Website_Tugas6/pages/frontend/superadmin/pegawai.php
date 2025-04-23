<?php
if (! session_id()) {
    session_start();
}

$loginAs = $_SESSION['loginAs'] ?? null;
if ($loginAs !== 'superadmin') {
    header('Location: ./../../index.php');
    exit;
}

$titlePage = 'Pegawai - SuperAdmin Sahabat Satwa';
?>


<?php require_once './../templates/header.php'; ?>
<!-- <link rel="stylesheet" href="./../owners/css/dashboard.css"> -->
<link rel="stylesheet" href="./css/dashboard.css">

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
                    <a class="nav-link" href="./dashboard.php">
                        <i class="fa-solid fa-house"></i>
                        Beranda
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

<main class="container my-5">
    <h1 class="table-title text-center position-header">DAFTAR AKUN DOKTER</h1>

    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center">
            <thead class="table-warning">
                <tr>
                    <th scope="col">Username</th>
                    <th scope="col">Password</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Contoh data sementara -->
                <tr>
                    <td>Dr.</td>
                    <td>Ahmad Iqbal</td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <button class="btn btn-primary btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm">Hapus</button>
                            <button class="btn btn-success btn-sm">Detail</button>
                        </div>
                    </td>
                </tr>
                <!-- Tambahkan data lain di sini -->
            </tbody>
        </table>
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

<?php require_once './../templates/footer.php'; ?>
<?php
if (! session_id()) {
    session_start();
}

$loginAs = $_SESSION['loginAs'] ?? null;
if ($loginAs !== 'superadmin') {
    header('Location: ./../../index.php');
    exit;
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
                    <a class="nav-link" href="./logout.php">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1>SUPER ADMIN</h1>
            <table class="table table-hover table-bordered border-dark text-center table-sm">
                <thead class="table-dark">
                    <th>Info</th>
                    <th>Count</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Owner</td>
                        <td>10</td>
                    </tr>
                    <tr>
                        <td>Dokter</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>Hewan Peliharaan</td>
                        <td>20</td>
                    </tr>
                    <tr>
                        <td>Kunjungan</td>
                        <td>20</td>
                    </tr>
                </tbody>
            </table>
            <div class="d-grid g-3 d-md-block">
                <!-- <a class="btn" style="background-color: #ff9900; color: white; border-color: #ff9900;"
                    href="./pegawai.php">
                    <i class="fa-solid fa-user-tie"></i>
                    Pegawai
                </a> -->
                <a class="btn" style="background-color: #ff9900; color: white; border-color: #ff9900;"
                    href="./tables/home">
                    <i class="fa-solid fa-table"></i>
                    Tables
                </a>
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

<?php require_once './../templates/footer.php'; ?>
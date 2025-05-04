<?php
if (! session_id()) {
    session_start();
}

$loginAs = $_SESSION['loginAs'] ?? null;
if ($loginAs !== 'petugasadministrasi') {
    header('Location: ./../../index.php');
    exit;
}

$titlePage = 'Dashboard - Petugas Administrasi';
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
            <h1 class="mb-5">Petugas Administrasi</h1>

            <div class="d-grid g-3 d-md-block">
                <a class="btn" style="background-color: #ff9900; color: white; border-color: #ff9900;" href="./"
                    role="Lihat Hewan Saya">
                    <i class="fa-solid fa-pills"></i>
                    Obat
                </a>
                <a class="btn" style="background-color: #ff9900; color: white; border-color: #ff9900;" href="./"
                    role="Lihat Hewan Saya">
                    <i class="fa-solid fa-notes-medical"></i>
                    Kunjungan
                </a>
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
            <img src="../../assets/image/kucing_hitam.png" alt="Kucing Hitam" width="200">
            <img src="../../assets/image/kucing_loreng.gif" alt="Kucing Abu-abu" width="180" class="ms-3">
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
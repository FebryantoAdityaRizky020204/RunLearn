<?php

include_once './backend/Connection/OwnerConnection.php';
$conn = new Connection();
date_default_timezone_set('Asia/Jakarta');

if (! session_id())
    session_start();

if (isset($_SESSION['loginAs'])) {
    $loginAs = $_SESSION['loginAs'];
    switch ($loginAs) {
        case 'owner':
            header('Location: ./frontend/owners/dashboard.php');
            break;
        case 'dokter':
            header('Location: ./frontend/dokter/dashboard.php');
            break;
        case 'superadmin':
            header('Location: ./frontend/superadmin/dashboard.php');
            break;
        case 'petugasadministrasi':
            header('Location: ./frontend/petugasadministrasi/dashboard.php');
            break;
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Sahabat Satwa</title>
    <link rel="stylesheet" href="./style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="./assets/image/paw_logo.png" alt="Logo" width="30" height="24"
                    class="d-inline-block align-text-top">
                Sahabat Satwa
            </a>
        </div>
    </nav>
    <main class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mt-5">
                <h1>Memastikan Perawatan dan Dukungan untuk Hewan Peliharaan Kesayangan Anda</h1>
                <p>Klinik hewan kami menyediakan perawatan yang komprehensif dan penuh kasih sayang untuk hewan
                    peliharaan
                    kesayangan Anda.</p>

                <div class="d-grid gap-2 d-md-block">
                    <a class="btn" style="background-color: #ff9900; color: white; border-color: #ff9900;"
                        href="./frontend/owners/login.php" role="Pemilik Hewan">Pemilik Hewan</a>
                    <a class="btn" style="background-color: #ff9900; color: white; border-color: #ff9900;"
                        href="./frontend/dokter/login.php" role="Dokter Hewan">Dokter Hewan</a>
                    <a class="btn" style="background-color: #ff9900; color: white; border-color: #ff9900;"
                        href="./frontend/petugasadministrasi/login.php" role="Admin">Petugas Administrasi</a>
                    <a class="btn" style="background-color: #ff9900; color: white; border-color: #ff9900;"
                        href="./frontend/superadmin/login.php" role="Admin">Admin</a>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <img src="./assets/image/kucing_hitam.png" alt="Kucing Hitam" width="200">
                <img src="./assets/image/kucing_loreng.gif" alt="Kucing Abu-abu" width="180" class="ms-3">
            </div>
        </div>
        <div class="row mt-3 mb-5">
            <div class="col-12 text-center mt-4 mb-3 fw-bold">
                <h4 style="color: #ff9900;">CLINICS</h4>
                <hr>
            </div>
            <?php
            $clinics = $conn->fetchAll("SELECT * FROM `clinic`");
            foreach ($clinics as $clinic) :
                ?>
            <div class="col-md-5 col-12">
                <div class="card m-2">
                    <div class="card-body border rounded" style="border-color: #ff9900 !important;">
                        <h5 class="card-title fw-bold"><?= $clinic["clinic_name"] ?>
                            <span
                                class="badge text-bg-<?= ($clinic["clinic_status"] == 'Closed') ? 'danger' : 'success'; ?>"
                                style="font-size: 9px;">
                                <?= ($clinic["clinic_status"] == "Normal") ? " " : 'Closed' ?>
                            </span>
                        </h5>
                        <p class="card-text my-1"><?= $clinic["clinic_address"] ?> - <?= $clinic["clinic_phone"] ?></p>
                        <p class="my-0" style="font-size: 13px; font-style:italic;">
                            <?= $clinic["clinic_start_day"] ?>-<?= $clinic["clinic_end_day"] ?>
                            <?= date("H:i", strtotime($clinic["clinic_start_time"])) ?>-<?= date("H:i", strtotime($clinic["clinic_end_time"])) ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="row mt-3 mb-5">
            <div class="col-12 text-center mt-4 mb-3 fw-bold">
                <h4 style="color: #ff9900;">Specialist Cost</h4>
                <hr>
            </div>
            <?php
            $specialist = $conn->fetchAll("SELECT * FROM `specialisation`");
            foreach ($specialist as $spec) :
                ?>
            <div class="col-md-5 col-12">
                <div class="card m-2">
                    <div class="card-body border rounded" style="border-color: #ff9900 !important;">
                        <h5 class="card-title fw-bold"><?= $spec["spec_description"] ?></h5>
                        <p class="my-0 fw-bold" style="font-size: 15px; font-style:italic;">
                            Rp. <?= number_format($spec["medical_cost"], 0, ',', '.'); ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
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
</body>

</html>
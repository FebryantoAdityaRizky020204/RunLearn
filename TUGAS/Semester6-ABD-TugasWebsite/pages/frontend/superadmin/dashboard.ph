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
                    <a class="nav-link" href="./tables.php">
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
                <div class="col-12">
                    <button class="btn btn-primary mb-2 btn-sm " style="font-size: .7rem;" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <i class="fa-solid fa-plus"></i>
                        TAMBAH Klinik
                    </button>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header fw-bold">
                            KLINIK 1
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Sahabat Satwa Pusat</h5>
                            <p class="card-text">
                                Jl. Rendah Hati - Phone: <em>+62 812-3456-7890</em>
                            </p>
                        </div>
                        <div class="card-footer text-body-secondary">
                            <button onclick="setFormEdit('<?= base64_encode(json_encode($data)) ?>')"
                                class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal">
                                <i class="fa-solid fa-pen-to-square"></i>
                                EDIT
                            </button>
                            <button onclick="setFormDelete('<?= $data['owner_id'] ?>')" class="btn btn-danger btn-sm"
                                data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="fa-solid fa-trash"></i>
                                DELETE
                            </button>
                        </div>
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

<?php require_once './../templates/footer.php'; ?>
<?php
if (! session_id()) {
    session_start();
}

require_once './../../backend/Connection/OwnerConnection.php';
$conn = new Connection();

$animalIds = $conn->fetchAll("SELECT `animal_id` FROM `animal` WHERE `owner_id` = {$_SESSION['dataLogin']['owner_id']}");


// Ambil hanya nilai animal_id dari array 2 dimensi
$ids = array_map(fn ($item) => $item['animal_id'], $animalIds);

// Gabungkan jadi string untuk query
$idsString = implode(',', $ids);

// Buat query
$query = "SELECT 
    `visit`.*,
    `animal`.`animal_id` AS `a_animal_id`, 
    `animal`.`animal_name`,
    `vet`.`vet_id` AS `v_vet_id`, 
    `vet`.`vet_title`, 
    `vet`.`vet_givenname`, 
    `vet`.`vet_familyname`
FROM `visit`
INNER JOIN `animal` ON `visit`.`animal_id` = `animal`.`animal_id`
INNER JOIN `vet` ON `visit`.`vet_id` = `vet`.`vet_id`
WHERE `animal`.`animal_id` IN ($idsString)
ORDER BY `visit`.`visit_id` ASC";

$riwayatKunjungan = $conn->fetchAll($query);

$loginAs = $_SESSION['loginAs'] ?? null;
if ($loginAs !== 'owner') {
    header('Location: ./../../index.php');
    exit;
}

$titlePage = 'Kunjungan - Owner Sahabat Satwa';
?>


<?php require_once './../templates/header.php'; ?>


<link rel="stylesheet" href="./css/riwayat_kunjungan.css">
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
                    <a class="nav-link" href="./profil.php">
                        <i class="fa-solid fa-user"></i>
                        Profil
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
    <h1 class="table-title text-center position-header">DAFTAR RIWAYAT KUNJUNGAN</h1>

    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center">
            <thead class="table-warning">
                <tr>
                    <th scope="col">Waktu Kunjungan</th>
                    <th scope="col">Keterangan Kunjungan</th>
                    <th scope="col">Nama Hewan</th>
                    <th scope="col">Nama Dokter</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($riwayatKunjungan)) : ?>
                <tr>
                    <td colspan="5" class="text-center">Tidak ada riwayat kunjungan</td>
                </tr>
                <?php endif ?>
                <?php foreach ($riwayatKunjungan as $riwayat) : ?>
                <tr>
                    <td><?= $riwayat['visit_date_time'] ?></td>
                    <td><?= $riwayat['visit_notes'] ?></td>
                    <td><?= $riwayat['animal_name'] ?></td>
                    <td><?= $riwayat['vet_title'].' '.$riwayat['vet_givenname'].' '.$riwayat['vet_familyname'] ?></td>
                </tr>
                <?php endforeach ?>
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
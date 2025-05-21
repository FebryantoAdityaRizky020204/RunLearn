<?php
if (! session_id()) {
    session_start();
}

include_once './../../backend/Connection/DokterConnection.php';
$conn = new Connection();

$loginAs = $_SESSION['loginAs'] ?? null;
if ($loginAs !== 'dokter') {
    header('Location: ./../../index.php');
    exit;
}

$vet_id = $_SESSION["dataLogin"]["vet_id"] ?? null;
$visitQuery = "SELECT * 
FROM `visit`
INNER JOIN `animal` ON `animal`.`animal_id` = `visit`.`animal_id`
INNER JOIN `owners` ON `owners`.`owner_id` = `animal`.`owner_id`
WHERE `vet_id` = $vet_id;
";

$visit = $conn->fetchAll($visitQuery);

$today = date("Y-m-d");
$queue = $conn->fetchAll("SELECT * FROM `queue` 
        WHERE `queue`.`queue_date` = '$today' AND `queue_status` = 'doktercheck' AND `vet_id` = $vet_id ORDER BY `queue_number` ASC LIMIT 1;");

$titlePage = 'Kunjungan - Dokter Sahabat Satwa';
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
                    <a class="nav-link" href="./dashboard.php">
                        <i class="fa-solid fa-house"></i>
                        Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="./kunjungan.php">
                        <i class="fa-solid fa-table"></i>
                        Kunjungan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="./logout.php">
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
            <h3>KUNJUNGAN</h3>

            <hr class="border border-3 opacity-75" style="border-color: #ff9900 !important;">

            <div class="row">
                <div class="col-12 col-md-7">
                    <div class="row my-2">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header fw-bold">
                                    KUNJUNGAN
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-3" style="font-size: .9rem;">
                            <div class="card mb-1">
                                <div class="card-body px-0 pt-0 pb-2">
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                        NO
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                        Owner Name
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                        Pet Name
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                        Tgl. Kunjungan
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-center text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                        OPTION
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($visit == []) :
                                                    ?>
                                                <tr>
                                                    <td colspan="5"
                                                        class="text-center text-sm fw-bold text-danger py-3">
                                                        DATA KOSONG
                                                    </td>
                                                </tr>
                                                <?php else : ?>
                                                <?php
                                                    $no = 1;
                                                    foreach ($visit as $vst) :
                                                        ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $vst["owner_givenname"] ?> <?php $vst["owner_familyname"] ?>
                                                    </td>
                                                    <td><?= $vst["animal_name"] ?></td>
                                                    <td><?= $vst["visit_date_time"] ?></td>
                                                    <td class="text-center">
                                                        <a href="./detail-kunjungan.php?id=<?= base64_encode($vst['visit_id']) ?>"
                                                            class="btn btn-primary btn-sm">
                                                            <i class="fa-solid fa-circle-info"></i>
                                                            DETAIL
                                                        </a>
                                                        <!-- <button onclick="setFormDelete('1')" class="btn btn-danger btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                    <i class="fa-solid fa-trash"></i>
                                                    DELETE
                                                </button> -->
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header fw-bold">
                                <span>DOKTER CHECK</span>
                            </div>
                        </div>
                    </div>
                    <?php if (! empty($queue)) : ?>
                    <?php foreach ($queue as $q) : ?>
                    <div class="col-12 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    No Antrian: <?= $q["queue_number"] ?>
                                </h5>
                                <a href="./kunjungan-baru.php?queueid=<?= $q['queue_id'] ?>"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-plus"></i>
                                    Kunjungan Baru
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
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
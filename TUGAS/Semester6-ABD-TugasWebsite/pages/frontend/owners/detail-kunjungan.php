<?php
if (! session_id()) {
    session_start();
}

include_once './../../backend/Connection/OwnerConnection.php';
$conn = new Connection();

$loginAs = $_SESSION['loginAs'] ?? null;
if ($loginAs !== 'owner') {
    header('Location: ./../../index.php');
    exit;
}

$visit_id = (int) $_GET["visitid"];
if (! is_numeric($visit_id)) {
    header("Location: ./riwayat_kunjungan.php");
}

$visitQuery = "SELECT * 
FROM `visit`
INNER JOIN `animal` ON `animal`.`animal_id` = `visit`.`animal_id`
INNER JOIN `owners` ON `owners`.`owner_id` = `animal`.`owner_id` 
WHERE `visit`.`visit_id` = $visit_id;";

$visit = $conn->singleFetch($visitQuery);

if ($visit == null) {
    header("Location: ./riwayat_kunjungan.php");
}

$titlePage = 'Detail Kunjungan - SuperAdmin Sahabat Satwa';

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

<main class="container justify-content-start mt-3">
    <div class="row align-items-center">
        <div class="col-md-12">
            <h3>DETAIL KUNJUNGAN</h3>

            <hr class="border border-3 opacity-75" style="border-color: #ff9900 !important;">

            <div class="row my-2">
                <div class="col-12 col-md-8 mt-3">
                    <form action="" method="POST">
                        <div class="card mb-3">
                            <div class="card-header fw-bold bg-primary text-light">
                                OWNER - PET
                            </div>
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="">
                                        <input class="form-control" type="text" readonly disabled
                                            value="<?= $visit['owner_givenname'] ?> <?= $visit['owner_familyname'] ?> - <?= $visit['animal_name'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-1">
                            <div class="card-header fw-bold bg-primary text-light">
                                KUNJUNGAN
                            </div>
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="visit_notes" class="form-label fw-bold">Tgl. Kunjungan</label>
                                        <input class="form-control" type="date" name="visit_date_time"
                                            value="<?= $visit["visit_date_time"] ?>" readonly disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="visit_notes" class="form-label fw-bold">NOTES</label>
                                        <textarea class="form-control" name="visit_notes" id="visit_notes" rows="3"
                                            readonly><?= $visit["visit_notes"] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        $obats = $conn->fetchAll("SELECT * FROM `visit_drug` 
                                INNER JOIN `drug` ON `drug`.`drug_id` = `visit_drug`.`drug_id` 
                                WHERE `visit_id` = $visit_id");
                        ?>

                        <?php if ($obats) : ?>

                        <div class="card mb-1 mt-2">
                            <div class="card-header fw-bold bg-primary text-light">
                                OBAT
                            </div>
                            <div class="card-body">

                                <div id="drugFormsContainer">
                                    <?php foreach ($obats as $obat) : ?>
                                    <div class="drug-form-item row border my-2 border-2 rounded p-2"
                                        style="font-size: .7rem;">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="drug_name_0" class="form-label">Obat</label>
                                                <input class="form-control" type="text" name="visit_date_time"
                                                    value="<?= $obat["drug_name"] ?>" readonly disabled>
                                            </div>
                                        </div>
                                        <div class=" col-6">
                                            <div class="mb-3">
                                                <label for="drug_dose_0" class="form-label">Dosis</label>
                                                <input class="form-control" type="text" name="visit_date_time"
                                                    value="<?= $obat["visit_drug_dose"] ?>" readonly disabled>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="drug_frequency_0" class="form-label">Frekuensi</label>
                                                <input class="form-control" type="text" name="visit_date_time"
                                                    value="<?= $obat["visit_drug_frequency"] ?>" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="drug_quantity_0" class="form-label">Jumlah</label>
                                                <input class="form-control" type="text" name="visit_date_time"
                                                    value="<?= $obat["visit_drug_qtysupplied"] ?>" readonly disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>

                            </div>
                        </div>
                        <?php endif; ?>
                    </form>
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
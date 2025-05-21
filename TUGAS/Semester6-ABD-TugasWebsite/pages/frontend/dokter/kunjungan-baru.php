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
$owrPetQuery = "SELECT * FROM `owners` INNER JOIN `animal` ON `animal`.`owner_id` = `owners`.`owner_id`";
$owrPet = $conn->fetchAll($owrPetQuery);

$titlePage = 'Tambah Kunjungan - SuperAdmin Sahabat Satwa';

$queue_id = $_GET["queueid"] ?? NULL;
$queue = $conn->singleFetch("SELECT * FROM `queue` WHERE `queue_id` = $queue_id");

$animal_id = $queue["animal_id"];
$reference = $conn->fetchAll("SELECT * FROM `visit` WHERE `visit`.`animal_id` = $animal_id");
$obats = $conn->fetchAll("SELECT * FROM `drug`")

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
            <h3>KUNJUNGAN BARU</h3>

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
                                        <select class="form-select" style="font-size: .9rem" name="animal_id"
                                            id="animal_id" readonly>
                                            <option disabled selected hidden>OWNER - PET</option>
                                            <?php foreach ($owrPet as $op) : ?>
                                            <option value="<?= $op['animal_id'] ?>"
                                                <?= ($op["animal_id"] == $queue["animal_id"]) ? 'selected' : '' ?>>
                                                <?= $op["owner_givenname"] ?> <?= $op["owner_familyname"] ?> -
                                                <?= $op["animal_name"] ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" card mb-1">
                            <div class="card-header fw-bold bg-primary text-light">
                                KUNJUNGAN
                            </div>
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="visit_notes" class="form-label fw-bold">Kunjugan Sebelumnya</label>
                                        <select name="from_visit_id" id="from_visit_id" class="form-select">
                                            <option value="">Tidak</option>
                                            <?php if (! empty($reference)) : ?>
                                            <?php foreach ($reference as $ref) : ?>
                                            <option value="<?= $ref["visit_id"] ?>"><?= $ref["visit_notes"] ?>
                                            </option>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="visit_notes" class="form-label fw-bold">NOTES</label>
                                        <textarea class="form-control" name="visit_notes" id="visit_notes"
                                            rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-1 mt-2">
                            <div class="card-header fw-bold bg-primary text-light">
                                OBAT
                            </div>
                            <div class="card-body">
                                <button type="button" class="btn btn-sm btn-primary" style="font-size: .7rem;"
                                    id="addDrugButton">
                                    <i class="fa-solid fa-plus"></i>
                                    Tambah Obat
                                </button>

                                <div id="drugFormsContainer">
                                    <div class="drug-form-item row border my-2 border-2 rounded p-2"
                                        style="font-size: .7rem;">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="drug_name_0" class="form-label">Obat</label>
                                                <select name="drugs[0][name]" id="drug_name_0" class="form-select">
                                                    <?php foreach ($obats as $obat) : ?>
                                                    <option value="<?= $obat['drug_id'] ?>"><?= $obat['drug_name'] ?> -
                                                        Rp. <?= number_format($obat['price'], 0, ',', '.'); ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class=" col-6">
                                            <div class="mb-3">
                                                <label for="drug_dose_0" class="form-label">Dosis</label>
                                                <input type="text" class="form-control" id="drug_dose_0"
                                                    name="drugs[0][dose]">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="drug_frequency_0" class="form-label">Frekuensi</label>
                                                <input type="text" class="form-control" id="drug_frequency_0"
                                                    name="drugs[0][frequency]">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="drug_quantity_0" class="form-label">Jumlah</label>
                                                <input type="text" class="form-control" id="drug_quantity_0"
                                                    name="drugs[0][quantity]">
                                            </div>
                                        </div>
                                        <div class="col-12 text-end">
                                            <button type="button" class="btn btn-sm btn-danger remove-drug-form"
                                                style="font-size: .7rem;">Hapus</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <button type="button" class="btn btn-primary btn-sm w-100 mt-2" id="tambahKunjungan">
                                TAMBAH
                            </button>
                        </div>
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

<script>
const drugOptionsHtml = `
        <?php foreach ($obats as $obat) : ?>
            <option value="<?= $obat['drug_id'] ?>"><?= $obat['drug_name'] ?> - Rp. <?= number_format($obat['price'], 0, ',', '.'); ?></option>
        <?php endforeach; ?>`

$(document).ready(function() {
    let drugFormCounter = 0; // Mulai dari 0 karena sudah ada satu form di HTML

    // Fungsi untuk mendapatkan HTML form obat yang baru
    function getNewDrugFormHtml(index, optionsHtml) { // Tambahkan parameter optionsHtml
        return `
            <div class="drug-form-item row border my-2 border-2 rounded p-2" style="font-size: .7rem;">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="drug_name_${index}" class="form-label">Obat</label>
                        <select name="drugs[${index}][name]" id="drug_name_${index}" class="form-select">
                            ${optionsHtml}
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="drug_dose_${index}" class="form-label">Dosis</label>
                        <input type="text" class="form-control" id="drug_dose_${index}" name="drugs[${index}][dose]">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="drug_frequency_${index}" class="form-label">Frekuensi</label>
                        <input type="text" class="form-control" id="drug_frequency_${index}" name="drugs[${index}][frequency]">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="drug_quantity_${index}" class="form-label">Jumlah</label>
                        <input type="text" class="form-control" id="drug_quantity_${index}" name="drugs[${index}][quantity]">
                    </div>
                </div>
                <div class="col-12 text-end">
                    <button type="button" class="btn btn-sm btn-danger remove-drug-form" style="font-size: .7rem;">Hapus</button>
                </div>
            </div>
        `;
    }

    // Event listener untuk tombol "Tambah Obat"
    $("#addDrugButton").on("click", function() {
        drugFormCounter++; // Naikkan counter
        // Panggil getNewDrugFormHtml dengan counter dan drugOptionsHtml
        const newFormHtml = getNewDrugFormHtml(drugFormCounter, drugOptionsHtml);
        $("#drugFormsContainer").append(newFormHtml);
    });

    // Event listener untuk tombol "Hapus" (menggunakan delegasi event)
    $("#drugFormsContainer").on("click", ".remove-drug-form", function() {
        if ($(".drug-form-item").length > 1) { // Pastikan setidaknya ada satu form tersisa
            $(this).closest(".drug-form-item").remove();
        } else {
            alert("Setidaknya harus ada satu form obat.");
        }
    });
});

$("#tambahKunjungan").click(function() {
    let dataDrugVisit = []
    $(".drug-form-item").each(function() {
        let drugName = $(this).find('select[name$="[name]"]').val(); // Ini adalah drug_id
        let drugDose = $(this).find('input[name$="[dose]"]').val();
        let drugFrequency = $(this).find('input[name$="[frequency]"]').val();
        let drugQuantity = $(this).find('input[name$="[quantity]"]').val();

        if (drugName && drugDose && drugFrequency && drugQuantity) {
            dataDrugVisit.push({
                drug_id: drugName,
                visit_drug_dose: drugDose,
                visit_drug_frequency: drugFrequency,
                visit_drug_qtysupplied: drugQuantity
            });
        }
    })

    let data = {
        vet_id: <?= $_SESSION["dataLogin"]["vet_id"] ?>,
        animal_id: $("#animal_id").val(),
        visit_notes: $("#visit_notes").val(),
        from_visit_id: $("#from_visit_id").val(),
        dataDrugVisit: dataDrugVisit,
        type: 'insert',
        queue_id: <?= $queue_id ?>
    }

    $.post('./../../backend/dokter/kunjungan.php', data, function(response) {
        if (response.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Tambah Kunjungan Berhasil',
                text: response.message,
                timer: 2000,
                showConfirmButton: false
            });
            setTimeout(function() {
                window.location.href = './kunjungan.php';
            }, 2000);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Tambah Kunjungan Gagal!',
            });
        }
    })
})
</script>

<?php require_once './../templates/footer.php'; ?>
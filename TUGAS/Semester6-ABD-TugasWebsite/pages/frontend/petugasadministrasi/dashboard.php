<?php if (! session_id()) {
    session_start();
}

include_once './../../backend/Connection/PetugasAdministrasiConnection.php';
$conn = new Connection();
$loginAs = $_SESSION['loginAs'] ?? null;
if ($loginAs !== 'petugasadministrasi') {
    header('Location:
    ./../../index.php');
    exit;
}
$petugasadmin_id = $_SESSION["dataLogin"]["petugasadmin_id"] ?? null;
$petugasQuery = "SELECT * FROM `petugas_administrasi` WHERE `petugasadmin_id` = $petugasadmin_id";
$petugas = $conn->singleFetch($petugasQuery);
$clinic_id = $_SESSION["dataLogin"]["clinic_id"] ?? null;
$vets = $conn->fetchAll("SELECT * FROM `vet` INNER JOIN `specialisation` ON `vet`.`spec_id` = `specialisation`.`spec_id` WHERE `vet`.`clinic_id` = $clinic_id");


$titlePage = 'Dashboard - Petugas Administrasi Sahabat Satwa';
$today = date("Y-m-d");
$queryQueue = "SELECT * FROM `queue`
    INNER JOIN `owners` ON `owners`.`owner_id` = `queue`.`owner_id`
    INNER JOIN `animal` ON `animal`.`animal_id` = `queue`.`animal_id`
    WHERE `queue`.`queue_date` = '$today' AND `queue_status` = 'queued' AND `clinic_id` = $clinic_id ORDER BY `queue_date` ASC;";

$queues = $conn->fetchAll($queryQueue);
$animals = $conn->fetchAll("SELECT * FROM `animal` INNER JOIN `owners` ON `animal`.`owner_id` = `owners`.`owner_id`");
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
            <h4>PETUGAS ADMINISTRASI</h4>

            <hr class="border border-2 opacity-75" style="border-color: #ff9900 !important;">
            <div class="d-grid gap-2 d-md-block mb-3">
                <button class="btn btn-primary btn-sm " style="font-size: .8rem;" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Antrian
                </button>
                <a class="btn" style="background-color: #ff9900; color: white; border-color: #ff9900; font-size: .8rem;"
                    href="./profile.php">
                    <i class="fa-solid fa-user"></i>
                    PROFILE
                </a>
                <a class="btn" style="background-color: #ff9900; color: white; border-color: #ff9900; font-size: .8rem;"
                    href="./tables.php?page=owners">
                    <i class="fa-solid fa-table"></i>
                    TABLES
                </a>
            </div>

            <div class="row my-2">
                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-header fw-bold">
                            ANTRIAN
                            <span class="badge badge-sm text-bg-secondary"><?= date("D, d-m-Y") ?></span>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Antrian</th>
                                        <th scope="col">Owner</th>
                                        <th scope="col">Animal</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (! empty($queues)) : ?>
                                    <?php foreach ($queues as $queue) : ?>
                                    <tr>
                                        <th scope="row">
                                            <?= $queue["queue_number"] ?>
                                        </th>
                                        <td>
                                            <?= $queue["owner_givenname"] ?> <?= $queue["owner_familyname"] ?>
                                        </td>
                                        <td><?= $queue["animal_name"] ?></td>
                                        <td>
                                            <button onclick="setFormPeriksa(<?= $queue['queue_id'] ?>)"
                                                class="btn btn-primary btn-sm " style="font-size: .8rem;"
                                                data-bs-toggle="modal" data-bs-target="#periksaModal">
                                                DIPERIKSA
                                            </button>
                                            <button class="btn btn-sm btn-danger" style="font-size: .8rem;"
                                                id="buttonBatalkan" -get-id="<?= $queue['queue_id'] ?>">
                                                BATALKAN
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else : ?>
                                    <tr>
                                        <th colspan="4" class="p-3 text-center fw-bold">DATA KOSONG</th>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
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

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-primary">
                                        <span id="title-form" style="font-size: 1rem;">TAMBAH PEMERIKSAAN</span>
                                    </h3>
                                </div>
                                <div class="card-body smd-form">
                                    <form>
                                        <input type="hidden" name="clinic_id" id="clinic_id"
                                            value="<?= $_SESSION["dataLogin"]["clinic_id"] ?>">
                                        <div class="mb-3">
                                            <select name="owner_animal_id" id="owner_animal_id" class="form-control"
                                                required>
                                                <option value="" selected disabled hidden>Owner - Peliharaan</option>
                                                <?php foreach ($animals as $animal) : ?>
                                                <option value="<?= $animal['owner_id'] ?>-<?= $animal['animal_id'] ?>">
                                                    <?= $animal['owner_givenname'] ?> <?= $animal['owner_familyname'] ?>
                                                    - <?= $animal["animal_name"] ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <input type="date" class="form-control" id="queue_date"
                                                placeholder="Tanggal Pemeriksaan" name="queue_date" required>
                                        </div>

                                        <input type="hidden" name="type" value="insert">
                                        <div class="text-center row">
                                            <div class="col-md-6">
                                                <button type="button"
                                                    class="btn btn-danger col-md-5 bg-gradient-info w-100 mt-4 mb-0"
                                                    data-bs-dismiss="modal" aria-label="Close">BATAL</button>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="button" id="tambahData"
                                                    class="btn btn-primary col-md-5 bg-gradient-info w-100 mt-4 mb-0"
                                                    data-bs-dismiss="modal" aria-label="Close">Tambah</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambah DataModal -->
<div class="modal fade" id="periksaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-primary">
                                        <span id="title-form" style="font-size: 1rem;">AJUKAN PEMERIKSAAN</span>
                                    </h3>
                                </div>
                                <div class="card-body smd-form">
                                    <form role="form" method="post" action="">
                                        <input type="hidden" name="queue_id" id="queue_id">
                                        <select name="vet_id" id="vet_id" class="form-control" required>
                                            <option value="" selected disabled hidden>Vet - Specialisation - Cost
                                            </option>
                                            <?php foreach ($vets as $vet) : ?>
                                            <option value="<?= $vet['vet_id'] ?>">
                                                <?= $vet["vet_title"] ?> <?= $vet["vet_givenname"] ?>
                                                <?= $vet["vet_familyname"] ?> - <?= $vet["spec_description"] ?> -
                                                Rp. <?= number_format($vet["medical_cost"], 0, ',', '.'); ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <input type="hidden" name="type" value="insert">
                                        <div class="text-center row">
                                            <div class="col-md-6">
                                                <button type="button"
                                                    class="btn btn-danger col-md-5 bg-gradient-info w-100 mt-4 mb-0"
                                                    data-bs-dismiss="modal" aria-label="Close">BATAL</button>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="button" id="periksaPet" type="button"
                                                    class="btn btn-primary col-md-5 bg-gradient-info w-100 mt-4 mb-0"
                                                    data-bs-dismiss="modal">
                                                    AJUKAN
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function setFormPeriksa(id) {
    let periksaForm = document.getElementById("periksaModal");
    let queueInput = periksaForm.querySelector("#queue_id");
    queueInput.value = id;
}

$("#periksaPet").click(function() {
    let data = {
        queue_id: $("#queue_id").val(),
        vet_id: $("#vet_id").val(),
        type: 'periksa'
    }

    $.post('./../../backend/petugasadministrasi/queue.php', data, function(response) {
        if (response.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Pet Diperiksa',
                text: response.message,
                timer: 2000,
                showConfirmButton: false
            });
            setTimeout(function() {
                location.reload();
            }, 2000);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
            });
        }
    })

})

$("#buttonBatalkan").click(function() {
    let queueId = $(this).attr("-get-id");
    let data = {
        queue_id: queueId,
        type: 'cancel'
    }
    $.post('./../../backend/petugasadministrasi/queue.php', data, function(response) {
        if (response.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Antrian Dibatalkan',
                text: response.message,
                timer: 2000,
                showConfirmButton: false
            });
            setTimeout(function() {
                location.reload();
            }, 2000);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal Membatalkan Antrian',
            });
        }
    })

})

$("#tambahData").click(function() {
    let owner_animal_id = $("#owner_animal_id").val()
    let parts = owner_animal_id.split('-')
    let data = {
        animal_id: parts[1],
        clinic_id: $("#clinic_id").val(),
        queue_date: $("#queue_date").val(),
        owner_id: parts[0],
        type: "insert",
    }

    $.post('./../../backend/petugasadministrasi/queue.php', data, function(response) {
        if (response.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Tambah Antrian Berhasil',
                text: response.message,
                timer: 2000,
                showConfirmButton: false
            });
            setTimeout(function() {
                location.reload();
            }, 2000);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Tambah Antrian Gagal!',
            });
        }
    })
});
</script>

<?php require_once './../templates/footer.php'; ?>
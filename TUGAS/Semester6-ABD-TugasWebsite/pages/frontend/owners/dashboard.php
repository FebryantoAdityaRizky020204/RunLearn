<?php
if (! session_id()) {
    session_start();
}

require_once './../../backend/Connection/OwnerConnection.php';
$conn = new Connection();

$loginAs = $_SESSION['loginAs'] ?? null;
if ($loginAs !== 'owner') {
    header('Location: ./../../index.php');
    exit;
}

$titlePage = 'Dashboard - Owner Sahabat Satwa';

$clinics = $conn->fetchAll("SELECT * FROM `clinic`");
$animals = $conn->fetchAll("SELECT * FROM `animal` WHERE `owner_id` = {$_SESSION['dataLogin']['owner_id']}");
$owner_id = $_SESSION['dataLogin']['owner_id'];
$queue = $conn->singleFetch("SELECT * FROM `queue`
    INNER JOIN `animal` ON `animal`.`animal_id` = `queue`.`animal_id`
    INNER JOIN `clinic` ON `clinic`.`clinic_id` = `queue`.`clinic_id`
    WHERE `queue`.`owner_id` = $owner_id AND `queue_status` = 'queued'
");
?>


<?php require_once './../templates/header.php'; ?>
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

<main class="container justify-content-start mt-5">
    <div class="row align-items-center">
        <div class="col-md-7 col-12">
            <h3>Pet Owner</h3>
            <hr>

            <div class="d-grid g-3 d-md-block">
                <a class="btn" style="background-color: #ff9900; color: white; border-color: #ff9900;"
                    href="./profil.php" role="Lihat Hewan Saya">
                    <i class="fa-solid fa-user"></i>
                    Profil
                </a>
                <a class="btn" style="background-color: #ff9900; color: white; border-color: #ff9900;"
                    href="./daftar_hewan.php" role="Lihat Hewan Saya">
                    <i class="fa-solid fa-paw"></i>
                    Peliharaan Saya
                </a>
                <a class="btn" style="background-color: #ff9900; color: white; border-color: #ff9900;"
                    href="./riwayat_kunjungan.php" role="Lihat Hewan Saya">
                    <i class="fa-solid fa-notes-medical"></i>
                    History Kunjungan
                </a>
            </div>
            <?php if ($queue == null) : ?>
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header fw-bold text-light" style="background-color: #ff9900;">
                        PEMERIKSAAN
                    </div>
                    <div class="card-body">
                        <p class="fw-bold">Tidak Ada Pemeriksaan</p>
                        <button class="btn btn-primary m-2 mt-0 btn-sm " style="font-size: .7rem;"
                            data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa-solid fa-plus"></i>
                            Tambah Pemeriksaan
                        </button>
                    </div>
                </div>
            </div>
            <?php else : ?>
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header fw-bold text-light" style="background-color: #ff9900;">
                        PEMERIKSAAN
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-4 text-center">
                                <p class="m-0 fw-bold" style="font-size: 12px;">No Antrian</p>
                                <h1 class="m-0">
                                    <?= $queue["queue_number"] ?>
                                </h1>
                                <p class="m-0" style="font-size: 12px; font-weight: 500; font-style: italic;">
                                    Peliharaan: <?= $queue["animal_name"] ?>
                                </p>
                            </div>
                            <div class="col-7">
                                <h5 class="m-0">
                                    <?= $queue["clinic_name"] ?>
                                </h5>
                                <p class="m-0" style="font-size:12px">
                                    <?= $queue["clinic_address"] ?> -
                                    <?= $queue["clinic_phone"] ?>
                                </p>
                                <?php
                                    $today = date("Y-m-d");
                                    $doktercheck_now = $conn->singleFetch("SELECT MAX(`queue_number`) as `dcm` FROM `queue` WHERE `queue_date` = '$today' AND `queue_status` = 'doktercheck'");
                                    $num_now = $doktercheck_now["dcm"] ?? '-';
                                    ?>

                                <p class="m-0 mt-3 badge badge-sm text-bg-info">Diperiksa saat ini: <?= $num_now ?></p>
                                <p class="m-0" style="font-size:12px; font-weight: 500; font-style:italic;">
                                    Tgl Pemeriksaae: <?= date("D, d-m-Y", strtotime($queue["queue_date"])) ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-12">
                            <!-- <button class="btn btn-sm btn-danger fw-bold" style="font-size: .8rem;">
                                BATAL
                            </button> -->
                            <button onclick="setFormCancel(<?= $queue['queue_id'] ?>)" class="btn btn-danger btn-sm"
                                data-bs-toggle="modal" data-bs-target="#cancelModal">
                                <i class="fa-solid fa-x"></i>
                                BATAL
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <!-- <div class="col-md-6 d-flex justify-content-end">
            <img src="../../assets/image/kucing_hitam.png" alt="Kucing Hitam" width="200">
            <img src="../../assets/image/kucing_loreng.gif" alt="Kucing Abu-abu" width="180" class="ms-3">
        </div> -->
    </div>
</main>

<footer class="mt-5">
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
                                        <input type="text" class="form-control" id="owner_id" placeholder="Animal Name"
                                            name="owner_id" value="<?= $_SESSION['dataLogin']['owner_id']; ?>" hidden>
                                        <div class="mb-3">
                                            <select name="animal_id" id="animal_id" class="form-control" required>
                                                <option value="" selected disabled hidden>Hewan Peliharaan</option>
                                                <?php foreach ($animals as $animal) : ?>
                                                <option value="<?= $animal['animal_id'] ?>">
                                                    <?= $animal["animal_name"] ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <select name="clinic_id" id="clinic_id" class="form-control" required>
                                                <option value="" selected disabled hidden>Klinik</option>
                                                <?php foreach ($clinics as $clinic) : ?>
                                                <option value="<?= $clinic['clinic_id'] ?>">
                                                    <?= $clinic["clinic_name"] ?>
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


<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header text-left bg-transparent">
                                    <!-- <h3 class="font-weight-bolder text-danger text-gradient text-center ">
                                        <span id="title-form" style="font-size: 1.5rem;">DELETE DATA</span>
                                    </h3> -->
                                </div>
                                <div class="display-1 text-center text-danger py-2">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    <p class="h6 mt-2 text-dark">
                                        YAKIN INGIN MEMBATALKAN ANTRIAN
                                    </p>
                                </div>
                                <div class="card-body smd-form">
                                    <form role="form" method="post" action="">
                                        <input type="hidden" class="form-control" id="queue_id" name="queue_id">
                                        <input type="hidden" name="type" value="delete">
                                        <div class="text-center row">
                                            <div class="col-md-12 align-items-center">
                                                <button type="button" id="cancelQueue"
                                                    class="btn btn-danger col-md-5 bg-gradient-info w-100 mt-1 mb-0"
                                                    data-bs-dismiss="modal" aria-label="Close">BATALKAN</button>
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
$("#tambahData").click(function() {
    let data = {
        animal_id: $("#animal_id").val(),
        clinic_id: $("#clinic_id").val(),
        queue_date: $("#queue_date").val(),
        owner_id: $("#owner_id").val(),
        type: "insert",
    }

    $.post('./../../backend/owner/queue.php', data, function(response) {
        if (response.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Tambah Pemeriksaan Berhasil',
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
                title: 'Tambah Pemeriksaan Gagal!',
            });
        }
    })
});

function setFormCancel(id) {
    let deleteForm = document.getElementById("cancelModal");
    deleteForm.querySelector("#queue_id").value = id;
}

$('#cancelQueue').click(function() {
    let data_cancel = {
        queue_id: $("#queue_id").val(),
        type: 'cancel'
    }

    $.post('./../../backend/owner/queue.php', data_cancel, function(response) {
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
</script>
<?php require_once './../templates/footer.php'; ?>
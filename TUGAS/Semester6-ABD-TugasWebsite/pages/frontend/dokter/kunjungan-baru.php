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

if (isset($_POST["submit"])) {
    var_dump($_POST);
    $visit_date_time = date("Y-m-d");
    $vet_id = $_SESSION["dataLogin"]["vet_id"];
    $animal_id = $_POST["animal_id"];
    $visit_notes = $_POST["visit_notes"];


    $query = "INSERT INTO `visit`(`visit_date_time`, `visit_notes`, `animal_id`, `vet_id`) 
                VALUES ('$visit_date_time','$visit_notes',$animal_id,$animal_id)";
    if ($conn->runSql($query)) {
        header("Location: ./kunjungan.php");
    }
}

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
                                        <select class="form-select" style="font-size: .9rem" name="animal_id">
                                            <option disabled selected hidden>OWNER - PET</option>
                                            <?php foreach ($owrPet as $op) : ?>
                                            <option value="<?= $op['animal_id'] ?>"><?= $op["owner_givenname"] ?>
                                                <?= $op["owner_familyname"] ?> - <?= $op["animal_name"] ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
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
                                        <label for="visit_notes" class="form-label fw-bold">NOTES</label>
                                        <textarea class="form-control" name="visit_notes" id="visit_notes"
                                            rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-sm w-100 mt-2" name="submit">
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
document.addEventListener('DOMContentLoaded', function() {
    const editButton = document.querySelector('.btn-warning');
    const saveButton = document.querySelector('.btn-primary');
    const cancelButton = document.querySelector('.btn-danger');
    const passwordInput = document.getElementById('password');
    const usernameInput = document.getElementById('username');
    const vetGivenname = document.getElementById('vet_givenname');
    const vetFamilyname = document.getElementById('vet_familyname');
    const vetPhone = document.getElementById('vet_phone');
    const vetTitle = document.getElementById('vet_title');

    editButton.addEventListener('click', function() {
        usernameInput.removeAttribute('readonly');
        passwordInput.removeAttribute('readonly');
        passwordInput.focus();
        editButton.setAttribute('hidden', true);
        cancelButton.removeAttribute('hidden');
        saveButton.removeAttribute('hidden');
        document.getElementById('password').value = '';
        document.getElementById('password-warning').removeAttribute('hidden');

        vetGivenname.removeAttribute('readonly');
        vetFamilyname.removeAttribute('readonly');
        vetPhone.removeAttribute('readonly');
        vetTitle.removeAttribute('readonly');
    });

    cancelButton.addEventListener('click', function() {
        usernameInput.setAttribute('readonly', true);
        passwordInput.setAttribute('readonly', true);
        editButton.removeAttribute('hidden');
        saveButton.setAttribute('hidden', true);
        cancelButton.setAttribute('hidden', true);
        document.getElementById('password').value = '----------';
        document.getElementById('password-warning').setAttribute('hidden', true);

        vetGivenname.setAttribute('readonly', true);
        vetFamilyname.setAttribute('readonly', true);
        vetPhone.setAttribute('readonly', true);
        vetTitle.setAttribute('readonly', true);
    });
});
</script>

<?php require_once './../templates/footer.php'; ?>
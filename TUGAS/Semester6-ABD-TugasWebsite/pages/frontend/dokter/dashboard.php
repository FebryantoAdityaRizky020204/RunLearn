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
$vetQuery = "SELECT * FROM `vet` WHERE `vet_id` = $vet_id";
$vet = $conn->singleFetch($vetQuery);

$clinic_id = $vet["clinic_id"];
$clinic = $conn->singleFetch("SELECT * FROM `clinic` WHERE `clinic_id` = $clinic_id");

$spec_id = $vet["spec_id"];
$spec = $conn->singleFetch("SELECT * FROM `specialisation` WHERE `spec_id` = $spec_id");

if (isset($_POST["submit"])) {
    if ($_POST["type"] == "update-dokter") {
        $vet_id = $_POST["vet_id"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $vet_givenname = $_POST["vet_givenname"];
        $vet_familyname = $_POST["vet_familyname"];
        $vet_phone = $_POST["vet_phone"];
        $vet_title = $_POST["vet_title"];

        if ($password == "") {
            $query = "UPDATE `vet` SET `username`='$username', `vet_title`='$vet_title', `vet_givenname`='$vet_givenname', `vet_familyname`='$vet_familyname', `vet_phone`=$vet_phone WHERE `vet_id`=$vet_id";
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE `vet` SET `username`='$username', `password`='$password', `vet_title`='$vet_title', `vet_givenname`='$vet_givenname', `vet_familyname`='$vet_familyname', `vet_phone`=$vet_phone WHERE `vet_id`=$vet_id";
        }
        $conn->runSql($query);
        header("Location: ./dashboard.php");
        exit();
    }
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
                    <a class="nav-link" href="./kunjungan.php">
                        <i class="fa-solid fa-table"></i>
                        Kunjungan
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
                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-header fw-bold">
                            My Profile | <span class="badge text-bg-primary"><?= $clinic["clinic_name"] ?></span>
                            <span class="badge text-bg-secondary"><?= $spec["spec_description"] ?></span>
                        </div>
                        <form action="" method="POST">
                            <input type="hidden" name="type" value="update-dokter">
                            <input type="hidden" name="vet_id" value="<?= $vet_id ?>">
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <label for="staticEmail" class="col-4 col-form-label">Title</label>
                                    <div class="col-8">
                                        <input type="text" name="vet_title" id="vet_title" class="form-control"
                                            value="<?= $vet['vet_title'] ?>" readonly autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="staticEmail" class="col-4 col-form-label">Givenname</label>
                                    <div class="col-8">
                                        <input type="text" name="vet_givenname" id="vet_givenname" class="form-control"
                                            value="<?= $vet['vet_givenname'] ?>" readonly autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="staticEmail" class="col-4 col-form-label">Familyname</label>
                                    <div class="col-8">
                                        <input type="text" name="vet_familyname" id="vet_familyname"
                                            class="form-control" value="<?= $vet['vet_familyname'] ?>" readonly
                                            autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="staticEmail" class="col-4 col-form-label">No.Hp</label>
                                    <div class="col-8">
                                        <input type="text" name="vet_phone" id="vet_phone" class="form-control"
                                            value="<?= $vet['vet_phone'] ?>" readonly autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="staticEmail" class="col-4 col-form-label">Username</label>
                                    <div class="col-8">
                                        <input type="text" name="username" id="username" class="form-control"
                                            value="<?= $vet['username'] ?>" readonly autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-4 col-form-label">Password</label>
                                    <div class="col-8">
                                        <input type="password" name="password" id="password" class="form-control"
                                            id="inputPassword" value="----------" readonly>
                                        <p class="small text-danger" id="password-warning" hidden>
                                            *kosongkan jika tidak ingin mengubah password
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-body-secondary">
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" type="button">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    EDIT
                                </button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" hidden type="button">
                                    <i class="fa-solid fa-xmark"></i>
                                    BATAL
                                </button>
                                <button name="submit" class="btn btn-primary btn-sm" data-bs-toggle="modal" hidden
                                    type="submit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    SIMPAN
                                </button>
                            </div>
                        </form>
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
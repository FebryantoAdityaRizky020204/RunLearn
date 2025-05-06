<?php
if (! session_id()) {
    session_start();
}

$loginAs = $_SESSION['loginAs'] ?? null;
if ($loginAs !== 'petugasadministrasi') {
    header('Location: ./../../../index.php');
    exit;
}

$titlePage = 'Tables - Petugas Admin Sahabat Satwa';
$procedure = null;

include_once './../../backend/Connection/PetugasAdministrasiConnection.php';
$conn = new Connection();

// Ambil nilai dari POST (AJAX) atau GET (fallback manual)
$theGet = $_GET['page'] ?? 'home';

$operationPath = "./../../backend/petugasadministrasi/$theGet/operation.php";
if (file_exists($operationPath)) {
    require_once $operationPath;
    $opr = new Operation();
}


if (isset($_POST['submit']) && isset($opr)) {
    $result = $opr->checkOperation($_POST);
    if ($result['status'] === 'PROCEDURE') {
        $procedure = $result['result'];
        unset($_POST);
    } else {
        unset($_POST);
        $_SESSION['flash_status'] = $result['status'];
        $_SESSION['flash_msg'] = $result['msg'];
        header("Location: ./tables.php?page=$theGet");
        exit();
    }
}
?>

<?php require_once './../templates/header.php'; ?>
<link rel="stylesheet" href="./../owners/css/dashboard.css">

<?php if (isset($_SESSION['flash_status'])) : ?>
<div class="row position-absolute top-0 start-0 p-3 px-4" style="z-index: 9999;" id="flash-message">
    <div class="card border-<?= $_SESSION['flash_status'] ? 'success' : 'danger' ?> border-2" style="width: 20rem;">
        <div class="card-body">
            <?php if ($_SESSION['flash_status']) : ?>
            <h6 class="card-subtitle mb-1 text-success">SUCCESS</h6>
            <?php else : ?>
            <h6 class="card-subtitle mb-1 text-danger">FAILED</h6>
            <?php endif; ?>

            <p class="card-text text-dark">
                <?= $_SESSION['flash_msg']; ?>
            </p>
        </div>
    </div>
</div>
<?php
    unset($_SESSION['flash_status']);
    unset($_SESSION['flash_msg']);
?>
<?php endif; ?>

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
                    <a class="nav-link active" href="./tables.php?page=owners">
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
    <div class="row">
        <div class="col-12 rounded mb-3" style="background-color: #ff9900;">
            <div class="row p-2 align-items-center">
                <div class="col-md-1 col-12 text-white">
                    <span class="fw-bold">TABLES</span>
                </div>
                <div class="col-5 p-2 align-items-center">
                    <select name="tables-name" id="tables-name" class="form-select fw-bold" style="font-size: 12px;">
                        <option value="owners">Owners</option>
                        <option value="animal">Animal</option>
                        <option value="drug">Drug</option>
                        <option value="visit">Visit</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-12 p-0 m-0 border rounded p-2" id="main-tables" class="mt-1"></div>
    </div>
</main>

<footer class="mt-4 p-3 bg-light">
    <div class="d-flex justify-content-between align-items-end">
        <div class="footer-left">
            <h5>Sahabat Satwa</h5>
        </div>
        <div class="footer-right d-flex align-items-center">
            <h5 class="mb-0 me-2">Kontak Kami:</h5>
            <p class="mb-0">+62 812-3456-7890</p>
        </div>
    </div>
</footer>

<script type="text/javascript">
let dataFromPHP = <?= json_encode($procedure); ?>;
const mainTables = $('#main-tables');

function getQueryParam(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}

let thePage = "<?= $_GET['page'] ?>";
let tableName = $('#tables-name').val(thePage);

function loadTable() {
    if (thePage === "procedure") {
        $.post(`./tables/${thePage}/index.php`, {
            resultProcedure: dataFromPHP,
            page: thePage
        }, function(response) {
            mainTables.html(response);
            dataFromPHP = null;
        }).fail(function() {
            mainTables.html("<h4 class='text-danger'>Halaman tidak ditemukan.</h4>");
        });
    } else {
        $.post(`./tables/${thePage}/index.php`, {
            page: thePage
        }, function(response) {
            mainTables.html(response);
        }).fail(function() {
            mainTables.html("<h4 class='text-danger'>Halaman tidak ditemukan.</h4>");
        });
    }

    console.log("Load table for:", thePage);
}

$(document).ready(function() {
    // Load default table saat halaman pertama kali dimuat
    loadTable();

    $('#tables-name').on('change', function() {
        const selectedValue = $(this).val();
        window.location.href = `?page=${selectedValue}`;
    });


    // Auto fade flash message
    setTimeout(() => {
        const flashCard = document.getElementById('flash-message');
        if (flashCard) {
            flashCard.style.transition = "opacity 0.5s ease";
            flashCard.style.opacity = 0;
            setTimeout(() => flashCard.remove(), 500);
        }
    }, 4000);
});
</script>

<?php require_once './../templates/footer.php'; ?>
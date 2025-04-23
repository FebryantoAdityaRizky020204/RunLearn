<?php
if (! session_id()) {
    session_start();
}

$loginAs = $_SESSION['loginAs'] ?? null;
if ($loginAs !== 'dokter') {
    header('Location: ./../../index.php');
    exit;
}

$titlePage = 'Dashboard - Dokter Sahabat Satwa';

$con = mysqli_connect('localhost', 'root', '', 'sahabat_satwa');

$query = "SELECT * FROM visit v
          INNER JOIN animal a on v.animal_id = a.animal_id";

$result = mysqli_query($con, $query);
?>


<?php require_once './../templates/header.php'; ?>
<link rel="stylesheet" href="./css/dashboard.css">
<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
    <div class="container">
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
                    <a class="nav-link active" href="./dashboard.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./kelola_kunjungan.php">Kelola Kunjungan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./resep_obat.php">Resep Obat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./data_pet_owner.php">Data Pet Owner</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">
            <h1 class="mb-3">Daftar Hewan</h1>
            <input type="text" class="p-2 mb-3">

            <table class="table table-bordered table-hover text-center">
                <thead class="table-warning">
                    <tr>
                        <th>Nama Hewan</th>
                        <th>Tanggal Kunjungan</th>
                        <th>Catatan Kunjungan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $row['animal_name'] ?></td>
                        <td><?= $row['visit_date_time'] ?></td>
                        <td><?= $row['visit_notes'] ?></td>
                        <td>
                            <button class="btn text-primary">Riwayat</button>
                            <button class="btn text-primary">Edit</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row justify-content-end mt-4">
        <div class="col-md-3">
            <img src="../../assets/image/paw_bg.png" alt="Jejak Kaki" width="300">
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
</body>

</html>
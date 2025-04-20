<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sahabat_satwa | Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/profil.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="../../index.php">
            <img src="../../assets/image/paw_logo.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
            Sahabat Satwa
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="./dashboard.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./riwayat_kunjungan.php">Riwayat Kunjungan</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="./profil.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4Z"/>
                        </svg>
                        Profil
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header text-center" style="background-color: #ff9900; color: white;">
                <h2>Profil Saya</h2>
                <p class="mb-0">Perbarui informasi profil Anda di sini</p>
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="firstName" class="form-label">Nama Depan</label>
                        <input type="text" class="form-control" id="firstName" value="Ahmad" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Nama Belakang</label>
                        <input type="text" class="form-control" id="lastName" value="Iqbal" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea class="form-control" id="address" rows="3" readonly>Palangka Raya, Kalimantan Tengah</textarea>
                    </div>
                    <button type="button" class="btn btn-edit w-100">Edit Profil</button>
                </form>
            </div>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

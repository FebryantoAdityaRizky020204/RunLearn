<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sahabat_satwa | Riwayat_kunjungan</title>
    <link rel="stylesheet" href="./css/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
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
                    <a class="nav-link active " href="./dashboard.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="./daftar_tabel.php">Daftar Tabel</a>
                </li>
                <li class="nav-item">
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

<main class="container my-5">
  <h1 class="table-title text-center position-header">DAFTAR AKUN DOKTER</h1>

  <div class="table-responsive">
    <table class="table table-bordered table-hover text-center">
      <thead class="table-warning">
        <tr>
          <th scope="col">Username</th>
          <th scope="col">Password</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <!-- Contoh data sementara -->
        <tr>
          <td>Dr.</td>
          <td>Ahmad Iqbal</td>
          <td>
            <div class="d-flex justify-content-center gap-2">
              <button class="btn btn-primary btn-sm">Edit</button>
              <button class="btn btn-danger btn-sm">Hapus</button>
              <button class="btn btn-success btn-sm">Detail</button>
            </div>
          </td>
        </tr>
        <!-- Tambahkan data lain di sini -->
      </tbody>
    </table>
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
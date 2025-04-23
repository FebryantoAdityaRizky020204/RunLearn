<?php

$con = mysqli_connect('localhost', 'root', '', 'sahabat_satwa');

$query = "SELECT * FROM owners";

$result = mysqli_query($con, $query);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sahabat_satwa | Beranda</title>
    <link rel="stylesheet" href="./css/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
    <div class="container">
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
                    <a class="nav-link" href="./kelola_kunjungan.php">Kelola Kunjungan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./resep_obat.php">Resep Obat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="./data_pet_owner.php">Data Pet Owner</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 mt-4">
                <h1 class="mb-3">Data Pemilik Hewan</h1>
                <input type="text" class="p-2 mb-3" placeholder="cari data pemilik...">
        
                <table class="table table-bordered table-hover text-center">
                    <thead class="table-warning">
                        <tr>
                            <th>Nama Pemilik</th>
                            <th>No. Telp</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?=$row['owner_familyname']." ".$row['owner_givenname']?></td>
                            <td><?=$row['owner_phone']?></td>
                            <td><?=$row['owner_address']?></td>
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
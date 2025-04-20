<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sahabat Satwa | Daftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../owners/css/register.css">
</head>
<body>

<div class="container-fluid d-flex align-items-center min-vh-100">
<a href="../../index.php" class="back-arrow">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="15 18 9 12 15 6"></polyline>
    </svg>
    Kembali
</a>
    <div class="row w-100">
        <!-- Left Panel -->
        <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center left-panel">
            <div class="animal-images">
                <img src="../../assets/image/kucing-grub.svg" alt="Cat">
            </div>
        </div>

        <!-- Login Form -->
        <div class="col-md-6 d-flex align-items-center justify-content-center">
            <div class="login-container">
                <div class="login-header">
                    <div class="login-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4Z"/>
                        </svg>
                    </div>
                    <h4>Daftar Akun Sahabat Satwa</h4>
                </div>
                <form>
                    <div class="form-group">
                        <label for="givenname" class="form-label">Nama Depan </label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="givenname" placeholder="Nama Depan">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M12 4a4 4 0 1 1 0 8a4 4 0 0 1 0-8m0 10c-4.42 0-8 1.79-8 4v2h16v-2c0-2.21-3.58-4-8-4Z" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="familyname" class="form-label">Nama Belakang</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="familyname" placeholder="Nama Belakang">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M12 4a4 4 0 1 1 0 8a4 4 0 0 1 0-8m0 10c-4.42 0-8 1.79-8 4v2h16v-2c0-2.21-3.58-4-8-4Z" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="form-label">Alamat Pengguna</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="address" placeholder="Alamat Pengguna">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M12 2a7 7 0 0 1 7 7c0 5.25-7 13-7 13s-7-7.75-7-13a7 7 0 0 1 7-7m0 9a2 2 0 1 0 0-4a2 2 0 0 0 0 4Z" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="nomor_telepon" placeholder="Nomor Telepon">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M6.62 10.79a15.464 15.464 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.09-.23 11.05 11.05 0 0 0 3.45.58a1 1 0 0 1 1 1v3.55a1 1 0 0 1-.91 1 19.26 19.26 0 0 1-8.49-2.81A19.3 19.3 0 0 1 3.61 6.91a19.17 19.17 0 0 1-2.8-8.49A1 1 0 0 1 1.8 1h3.55a1 1 0 0 1 1 1 11.05 11.05 0 0 0 .58 3.45 1 1 0 0 1-.23 1.09L4.5 8.41a15.464 15.464 0 0 0 2.12 2.38Z" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <button type="button" class="btn btn-login" onclick="window.location.href='./dashboard.php';">DAFTAR SEKARANG</button>

                </form>
                <div class="signup-link">
                    Sudah punya akun? <a href="./login.php">Masuk</a>
                </div>
                <div class="row justify-content-around mt-2">
                           <div class="col-md-3">
                               <img src="../../assets/image/paw_bg.png" alt="Jejak Kaki" width="200">
                          </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

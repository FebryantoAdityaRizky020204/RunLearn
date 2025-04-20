<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sahabat Satwa | Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../owners/css/login.css">
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
                    <h4>Masuk Super Admin</h4>
                </div>
                <form>
                    <div class="form-group">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="username" placeholder="Masukkan Username">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4Z"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" placeholder="Masukkan kata sandi">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M12 17a2 2 0 0 0 2-2a2 2 0 0 0-2-2a2 2 0 0 0-2 2a2 2 0 0 0 2 2m6-9a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V10a2 2 0 0 1 2-2h1V6a5 5 0 0 1 5-5a5 5 0 0 1 5 5v2h1m-6 9v-1a4 4 0 0 0-4-4v-1a3 3 0 0 1 3-3h2a3 3 0 0 1 3 3v1a4 4 0 0 0-4 4v1Z"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                    <button type="button" class="btn btn-login" onclick="window.location.href='./dashboard.php';">MASUK</button>
                </form>
                <div class="signup-link">
                    Belum punya akun? <a href="./register.php">Daftar</a>
                </div>
                <div class="row justify-content-around mt-2">
                           <div class="col-md-3">
                               <img src="../../assets/image/paw_bg.png" alt="Jejak Kaki" width="300">
                          </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $titlePage = "Login Admin"; ?>
<?php require_once './../templates/header.php' ?>
<link rel="stylesheet" href="./css/login.css">

<div class="container-fluid d-flex align-items-center min-vh-100">
    <a href="../../index.php" class="back-arrow">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"></polyline>
        </svg>
        Kembali
    </a>
    <div class="container-fluid d-flex align-items-center min-vh-100">
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
                                <path fill="currentColor"
                                    d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4Z" />
                            </svg>
                        </div>
                        <h4>Masuk Admin</h4>
                    </div>
                    <form>
                        <div class="form-group">
                            <label for="username" class="form-label">Username</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="username" placeholder="Masukkan Username">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-user"></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password"
                                    placeholder="Masukkan kata sandi">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-key"></i>
                                </span>
                            </div>
                        </div>
                        <button type="button" class="btn btn-login btn-primary" id="loginAdmin">MASUK</button>
                    </form>
                    <div class="signup-link">
                        Tidak punya akun? <a href="./../../index.php">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script>
    $("#loginAdmin").on("click", function() {
        let data = {
            username: $('#username').val(),
            password: $('#password').val()
        }

        $.post("./../../backend/auth/superadmin/login.php", data, function(response) {
            if (response.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Login Berhasil!',
                    text: response.message,
                    timer: 2000,
                    showConfirmButton: false
                });
                setTimeout(function() {
                    window.location.href = './dashboard.php';
                }, 2000);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Login',
                    text: response.message,
                });
            }
        }, 'json');
    });
    </script>


    <?php require_once './../templates/footer.php' ?>
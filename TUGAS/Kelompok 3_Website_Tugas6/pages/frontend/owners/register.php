<?php $titlePage = "Register Owner"; ?>
<?php require_once './../templates/header.php' ?>
<link rel="stylesheet" href="../owners/css/register.css">



<div class="container-fluid d-flex align-items-center min-vh-100 my-4">
    <a href="../../index.php" class="back-arrow">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                            <path fill="currentColor"
                                d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4Z" />
                        </svg>
                    </div>
                    <h4>Daftar Akun Sahabat Satwa</h4>
                </div>
                <form>
                    <div class="form-group">
                        <label for="owner_givenname" class="form-label">Given Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="owner_givenname" placeholder="Nama Depan">
                            <span class="input-group-text">
                                <i class="fa-solid fa-user"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="owner_familyname" class="form-label">Family Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="owner_familyname" placeholder="Nama Belakang">
                            <span class="input-group-text">
                                <i class="fa-solid fa-user"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="owner_address" class="form-label">Alamat Pengguna</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="owner_address" placeholder="Alamat Pengguna">
                            <span class="input-group-text">
                                <i class="fa-solid fa-location-dot"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="owner_phone" class="form-label">Nomor Telepon</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="owner_phone" placeholder="Nomor Telepon">
                            <span class="input-group-text">
                                <i class="fa-solid fa-phone"></i>
                            </span>
                        </div>
                    </div>
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
                            <input type="password" class="form-control" id="password" placeholder="Masukkan kata sandi">
                            <span class="input-group-text">
                                <i class="fa-solid fa-key"></i>
                            </span>
                        </div>
                    </div>
                    <button type="button" id="registerOwner" class="btn btn-login">DAFTAR SEKARANG</button>

                </form>
                <div class="signup-link">
                    Sudah punya akun? <a href="./login.php">Masuk</a>,
                    atau <a href="./../../index.php">Kembali</a>
                </div>
                <!-- <div class="row justify-content-around mt-2">
                    <div class="col-md-3">
                        <img src="../../assets/image/paw_bg.png" alt="Jejak Kaki" width="200">
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>

<script>
$("#registerOwner").on("click", function() {
    let data = {
        owner_givenname: $('#owner_givenname').val(),
        owner_familyname: $('#owner_familyname').val(),
        owner_address: $('#owner_address').val(),
        owner_phone: $('#owner_phone').val(),
        username: $('#username').val(),
        password: $('#password').val()
    }

    $.post("./../../backend/auth/owner/register.php", data, function(response) {
        if (response.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Pendaftaran Berhasil!',
                text: response.message,
                timer: 2000,
                showConfirmButton: false
            });
            setTimeout(function() {
                window.location.href = './login.php';
            }, 2000);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal Mendaftar',
                text: response.message || 'Terjadi kesalahan saat mendaftar.',
            });

            $('#username').val('');
            $('#password').val('');
            $('#owner_givenname').val('');
            $('#owner_familyname').val('');
            $('#owner_address').val('');
            $('#owner_phone').val('');

        }
    }, 'json');


})
</script>


<?php require_once './../templates/footer.php' ?>
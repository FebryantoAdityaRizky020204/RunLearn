<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_POST['connectAs']) && !empty($_POST['connectAs'])) {
        $_SESSION['connectAs'] = $_POST['connectAs'];
    }
    
    if (!isset($_SESSION['connectAs'])) { $_SESSION['connectAs'] = 'root'; }

    include_once './Connection.php';
    $conn = new Connection();

    $theGet = isset($_GET['page']) && ! empty($_GET['page']) ? $_GET['page'] : 'home';

    $operationPath = "./operation/$theGet/operation.php";
    if (file_exists($operationPath)) {
        require_once $operationPath;
        $opr = new Operation();
    }

    if (isset($_POST['submit']) && isset($opr)) {
        $result = $opr->checkOperation($_POST);
        unset($_POST);
        $_SESSION['flash_status'] = $result['status'];
        $_SESSION['flash_msg'] = $result['msg'];
        header("Location: ./$theGet");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="ID-id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <title>Sahabat Satwa</title>

    <!-- Bootstrap core CSS -->
    <!-- <link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"
        integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-cyborg-gaming.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
</head>

<body>
    <?php if (isset($_SESSION['flash_status'])): ?>
    <div class="row position-absolute top-0 start-0 p-3 px-4" style="z-index: 9999;" id="flash-message">
        <div class="card border-<?= $_SESSION['flash_status'] ? 'success' : 'danger' ?> border-2" style="width: 20rem;">
            <div class="card-body">
                <?php if($_SESSION['flash_status']) :?>
                <h6 class="card-subtitle mb-1 text-success">SUCCESS</h6>
                <?php else:?>
                <h6 class="card-subtitle mb-1 text-danger">FAILED</h6>
                <?php endif; ?>

                <p class="card-text text-dark">
                    Data <?= $_SESSION['flash_msg']; ?>
                </p>
            </div>
        </div>
    </div>
    <?php 
        unset($_SESSION['flash_status']);
        unset($_SESSION['flash_msg']);
     ?>
    <?php endif; ?>
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="home" class="logo" class="me-1">
                            SahabatSatwa
                        </a>

                        <div class="bg-primary text-white p-2 rounded m-1 p-1 me-2"
                            style="font-size: .7rem !important; height: fit-content;">
                            <label for="connect">Connect Sebagai</label>
                            <select name="connect" id="connect" class="form-control"
                                style="font-size: .7rem !important;">
                                <option value="root" selected disabled>--Pilih--</option>
                                <option value="Administrator"
                                    <?php echo ($_SESSION['connectAs'] ?? '') == 'Administrator' ? 'selected' : ''?>>
                                    Administrator
                                </option>
                                <option value="Pemilik"
                                    <?php echo ($_SESSION['connectAs'] ?? '') == 'Pemilik' ? 'selected' : ''?>>
                                    Pemilik
                                </option>
                                <option value="Dokter"
                                    <?php echo ($_SESSION['connectAs'] ?? '') == 'Dokter' ? 'selected' : ''?>>
                                    Dokter
                                </option>
                            </select>
                        </div>
                        <!-- ***** Logo End ***** -->


                        <!-- ***** Menu Start ***** -->
                        <ul class="nav" style="font-size: .7rem !important;">
                            <li><a id="link-home" href="home">Home</a></li>
                            <li><a id="link-owners" href="owners">Owners</a></li>


                            <!-- <li><a id="link-user" href="user">User</a></li>
                            <li><a id="link-role" href="role">Role</a></li>
                            <li><a id="link-pegawai" href="pegawai">Pegawai</a></li>
                            <li><a id="link-room" href="room">Room</a></li>
                            <li><a id="link-room-option" href="room-option">Room Option</a></li>
                            <li><a id="link-pemesanan" href="pemesanan">Pemesanan</a></li>
                            <li><a id="link-function" href="function">Function</a></li> -->
                            <li><a id="reset" href="./reset.php">RESET</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <div class="container" id="container">

    </div>


    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- <script src="vendor/bootstrap/js/bootstrap.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/popup.js"></script>
    <script src="assets/js/custom.js"></script>

    <!-- LOAD PAGES -->
    <script>
        const container = document.getElementById('container');

        // Ambil path terakhir dari URL
        const pathSegments = window.location.pathname.split("/").filter(Boolean);
        const thePage = pathSegments[pathSegments.length - 1] || "home";

        $(container).load(`views/${thePage}/index.php`, function (response, status, xhr) {
            if (status == "error") {
                container.innerHTML = "<h4 class='text-danger'>Halaman tidak ditemukan.</h4>";
            }
        });

        // Highlight menu aktif
        $('.nav').find("a.active").removeClass('active');
        $(`#link-${thePage}`).addClass('active');

        // set previlege
        $("#connect").on("change", function () {
            const selectedValue = $(this).val();

            $.post("", {
                connectAs: selectedValue
            }, function () {
                location.reload();
            });
        });

        setTimeout(() => {
        const flashCard = document.getElementById('flash-message');
        if (flashCard) {
            flashCard.style.transition = "opacity 0.5s ease";
            flashCard.style.opacity = 0;
            setTimeout(() => flashCard.remove(), 500); // hapus setelah transisi selesai
        }
    }, 4000);
    </script>
</body>

</html>
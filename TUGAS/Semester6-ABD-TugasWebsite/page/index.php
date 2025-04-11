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
        header("Location: ./$theGet");
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <title>CHotel</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

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
                            <li><a id="link-user" href="user">User</a></li>
                            <li><a id="link-role" href="role">Role</a></li>
                            <li><a id="link-pegawai" href="pegawai">Pegawai</a></li>
                            <li><a id="link-room" href="room">Room</a></li>
                            <li><a id="link-room-option" href="room-option">Room Option</a></li>
                            <li><a id="link-pemesanan" href="pemesanan">Pemesanan</a></li>
                            <li><a id="link-function" href="function">Function</a></li>
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


    <!-- LOAD PAGES -->
    <script>
        const container = document.getElementById('container');

        // Ambil path terakhir dari URL
        const pathSegments = window.location.pathname.split("/").filter(Boolean);
        const thePage = pathSegments[pathSegments.length - 1] || "home";

        $(container).load(`view/${thePage}/index.php`, function (response, status, xhr) {
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
    </script>


    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/popup.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>
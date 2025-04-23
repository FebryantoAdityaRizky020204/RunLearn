<?php
if (! session_id()) {
    session_start();
}

require_once './../../backend/Connection/OwnerConnection.php';
$conn = new Connection();

$queryHewan = "SELECT * FROM `animal` 
    INNER JOIN `animal_type` ON `animal`.`at_id` = `animal_type`.`at_id`
    WHERE `owner_id` = {$_SESSION['dataLogin']['owner_id']}";
$daftarHewan = $conn->fetchAll($queryHewan);

$animalTypes = $conn->fetchAll("SELECT * FROM `animal_type`");

$loginAs = $_SESSION['loginAs'] ?? null;
if ($loginAs !== 'owner') {
    header('Location: ./../../index.php');
    exit;
}

$titlePage = 'Hewan Peliharaan - Owner Sahabat Satwa';
?>

<?php require_once './../templates/header.php'; ?>


<link rel="stylesheet" href="./css/riwayat_kunjungan.css">
<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
    <div class="container-fluid">
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
                    <a class="nav-link" href="./dashboard.php">
                        <i class="fa-solid fa-house"></i>
                        Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./profil.php">
                        <i class="fa-solid fa-user"></i>
                        Profil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./logout.php">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container my-5">
    <h1 class="table-title text-center position-header mb-0">DAFTAR HEWAN SAYA</h1>
    <button class="btn btn-primary m-2 btn-sm " style="font-size: .7rem;" data-bs-toggle="modal"
        data-bs-target="#exampleModal">
        <i class="fa-solid fa-plus"></i>
        Tambah
    </button>
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center">
            <thead class="table-warning">
                <tr>
                    <th scope="col">Nama Hewan</th>
                    <th scope="col">Kelahiran Hewan</th>
                    <th scope="col">Tipe Hewan</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($daftarHewan)) : ?>
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data hewan</td>
                </tr>
                <?php else : ?>
                <?php foreach ($daftarHewan as $animal) : ?>
                <tr>
                    <td><?= $animal['animal_name'] ?></td>
                    <td><?= $animal['animal_born'] ?></td>
                    <td><?= $animal['at_description'] ?></td>
                    <td>
                        <?php
                                $giveData = [
                                    'animal_id' => $animal['animal_id'],
                                    'animal_name' => $animal['animal_name'],
                                    'animal_born' => $animal['animal_born'],
                                    'owner_id' => $animal['owner_id'],
                                    'at_id' => $animal['at_id']
                                ]
                                    ?>
                        <div class="d-flex justify-content-center gap-2">
                            <button onclick="setFormEdit('<?= base64_encode(json_encode($giveData)) ?>')"
                                class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal">
                                <i class="fa-solid fa-pen-to-square"></i>
                                EDIT
                            </button>
                            <!-- <button class="btn btn-danger btn-sm">Hapus</button> -->
                            <button
                                onclick="setFormDelete('<?= $animal['animal_id'] ?>', '<?= $animal['animal_name'] ?>')"
                                class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="fa-solid fa-trash"></i>
                                DELETE
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
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


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-info text-primary">
                                        <span id="title-form" style="font-size: 1rem;">TAMBAH DATA</span>
                                    </h3>
                                </div>
                                <div class="card-body smd-form">
                                    <form>
                                        <input type="text" class="form-control" id="owner_id" placeholder="Animal Name"
                                            name="owner_id" value="<?= $_SESSION['dataLogin']['owner_id']; ?>" hidden>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="animal_name"
                                                placeholder="Animal Name" name="animal_name">
                                        </div>
                                        <div class="mb-3">
                                            <input type="date" class="form-control" id="animal_born" placeholder="Born"
                                                name="animal_born">
                                        </div>
                                        <div class="mb-3">
                                            <select name="at_id" id="at_id" class="form-control">
                                                <?php foreach ($animalTypes as $antp) : ?>
                                                <option value="<?= $antp['at_id'] ?>">
                                                    <?= $antp['at_id'].'-'.$antp['at_description']; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <input type="hidden" name="type" value="insert">
                                        <div class="text-center row">
                                            <div class="col-md-6">
                                                <button type="button"
                                                    class="btn btn-danger col-md-5 bg-gradient-info w-100 mt-4 mb-0"
                                                    data-bs-dismiss="modal" aria-label="Close">BATAL</button>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="button" id="tambahData"
                                                    class="btn btn-primary col-md-5 bg-gradient-info w-100 mt-4 mb-0"
                                                    data-bs-dismiss="modal" aria-label="Close">Tambah Data</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit DataModal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-warning text-gradient">
                                        <span id="title-form" style="font-size: 1.5rem;">EDIT DATA</span>
                                    </h3>
                                </div>
                                <div class="card-body smd-form">
                                    <form role="form" method="post" action="">
                                        <input type="text" class="form-control" id="owner_id" placeholder="Animal Name"
                                            name="owner_id" value="<?= $_SESSION['dataLogin']['owner_id']; ?>" hidden>
                                        <input type="hidden" class="form-control" id="animal_id" name="animal_id">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="animal_name"
                                                placeholder="Animal Name" name="animal_name">
                                        </div>
                                        <div class="mb-3">
                                            <input type="date" class="form-control" id="animal_born" placeholder="Born"
                                                name="animal_born">
                                        </div>
                                        <div class="mb-3">
                                            <select name="at_id" id="at_id" class="form-control">
                                                <?php foreach ($animalTypes as $antp) : ?>
                                                <option value="<?= $antp['at_id'] ?>">
                                                    <?= $antp['at_id'].'-'.$antp['at_description']; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <input type="hidden" name="type" value="edit">
                                        <div class="text-center row">
                                            <div class="col-md-6">
                                                <button type="button"
                                                    class="btn btn-danger col-md-5 bg-gradient-info w-100 mt-4 mb-0"
                                                    data-bs-dismiss="modal" aria-label="Close">BATAL</button>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="button" id="updateData"
                                                    class="btn btn-primary col-md-5 bg-gradient-info w-100 mt-4 mb-0"
                                                    data-bs-dismiss="modal" aria-label="Close">Update Data</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete DataModal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-danger text-gradient text-center ">
                                        <span id="title-form" style="font-size: 1.5rem;">DELETE DATA</span>
                                    </h3>
                                </div>
                                <div class="display-1 text-center text-danger py-2">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    <p class="h6 mt-2 text-dark">
                                        YAKIN INGIN MENGHAPUS DATA - <span id="delete-id">##</span>
                                    </p>
                                </div>
                                <div class="card-body smd-form">
                                    <form role="form" method="post" action="">
                                        <input type="hidden" class="form-control" id="animal_id"
                                            placeholder="Given Name" name="animal_id">
                                        <input type="hidden" name="type" value="delete">
                                        <div class="text-center row">
                                            <div class="col-md-6">
                                                <button type="button"
                                                    class="btn btn-danger col-md-5 bg-gradient-info w-100 mt-1 mb-0"
                                                    data-bs-dismiss="modal" aria-label="Close">BATAL</button>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="button" id="deleteData"
                                                    class="btn btn-primary col-md-5 bg-gradient-info w-100 mt-1 mb-0"
                                                    data-bs-dismiss="modal" aria-label="Close">Delete Data</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$("#tambahData").click(function() {
    let data = {
        animal_name: $("#animal_name").val(),
        animal_born: $("#animal_born").val(),
        at_id: $("#at_id").val(),
        owner_id: $("#owner_id").val(),
        type: "insert",
    }

    $.post('./../../backend/owner/daftar_hewan.php', data, function(response) {
        if (response.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Tambah Data Berhasil',
                text: response.message,
                timer: 2000,
                showConfirmButton: false
            });
            setTimeout(function() {
                location.reload();
            }, 2000);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Tambah Data Gagal!',
            });
        }
    })
});

$("#updateData").click(function() {
    let data = {
        animal_id: $("#editModal").find("#animal_id").val(),
        animal_name: $("#editModal").find("#animal_name").val(),
        animal_born: $("#editModal").find("#animal_born").val(),
        at_id: $("#editModal").find("#at_id").val(),
        type: "edit",
    }


    console.log(data);

    $.post('./../../backend/owner/daftar_hewan.php', data, function(response) {
        if (response.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Update Data Berhasil',
                text: response.message,
                timer: 2000,
                showConfirmButton: false
            });
            setTimeout(function() {
                location.reload();
            }, 2000);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Update Data Gagal!',
            });
        }
    })
})

$("#deleteData").click(function() {
    let data = {
        animal_id: $("#deleteModal").find("#animal_id").val(),
        type: "delete",
    }

    $.post('./../../backend/owner/daftar_hewan.php', data, function(response) {
        if (response.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Delete Data Berhasil',
                text: response.message,
                timer: 2000,
                showConfirmButton: false
            });
            setTimeout(function() {
                location.reload();
            }, 2000);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Delete Data Gagal!',
            });
        }
    })
})

function setFormEdit(encodedData) {
    try {
        let decoded = atob(encodedData);
        let data = JSON.parse(decoded);

        let form = document.getElementById('editModal');

        form.querySelector('#animal_id').value = data.animal_id;
        form.querySelector('#animal_name').value = data.animal_name;
        form.querySelector('#animal_born').value = data.animal_born;
        form.querySelector('#owner_id').value = data.owner_id;
        form.querySelector('#at_id').value = data.at_id;

    } catch (err) {
        console.error("Gagal set data form:", err);
    }
}


function setFormDelete(id, name) {
    let deleteForm = document.getElementById("deleteModal");
    deleteForm.querySelector("#animal_id").value = id;
    deleteForm.querySelector("#delete-id").innerText = name;
}
</script>

<?php require_once './../templates/footer.php'; ?>
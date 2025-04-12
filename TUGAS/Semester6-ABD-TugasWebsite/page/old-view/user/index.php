<?php
include_once '../../Connection.php';
$conn = new Connection();

$loc = dirname(__FILE__);

$queryUsr = "SELECT * FROM `user`";
$user = $conn->fetchAll($queryUsr);
?>
<div class="row">
    <div class="col-lg-12">
        <div class="page-content">
            <!-- ***** Banner Start ***** -->
            <div class="main-banner">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="header-text">
                            <h4>TABEL <em>USER</em></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ***** Banner End ***** -->

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-content small">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="featured-games header-text">
                                    <div class="heading-section">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-12 p-0">
                                                    <button class="btn btn-primary mb-2 btn-sm " style="font-size: .7rem;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                        <i class="fa-solid fa-plus"></i>
                                                        TAMBAH DATA
                                                    </button>
                                                    <div class="card mb-1">
                                                        <div class="card-body px-0 pt-0 pb-2">
                                                            <div class="table-responsive p-0">
                                                                <table class="table align-items-center mb-0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                                                USER ID
                                                                            </th>
                                                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                NAMA USER
                                                                            </th>
                                                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                ALAMAT
                                                                            </th>
                                                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                TGL LAHIR
                                                                            </th>
                                                                            <th class="text-uppercase text-center text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                OPTION
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php foreach ($user as $usr) : ?>
                                                                            <tr>
                                                                                <td>
                                                                                    <?= $usr['id_pelanggan'] ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?= $usr['nama_pl'] ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?= $usr['alamat_pl'] ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?= $usr['tgl_lahir_pl'] ?>
                                                                                </td>
                                                                                <td class="text-center">
                                                                                    <button onclick="setFormEdit(this)" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal">
                                                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                                                        EDIT
                                                                                    </button>
                                                                                    <button onclick="setFormDelete('<?= $usr['id_pelanggan'] ?>')" class="btn btn-danger btn-sm"  data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                                                        <i class="fa-solid fa-trash"></i>
                                                                                        DELETE
                                                                                    </button>
                                                                                    <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div> -->
                                                                                </td>
                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambah DataModal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-info text-gradient">
                                        <span id="title-form" style="font-size: 1.5rem;">TAMBAH DATA</span>
                                    </h3>
                                </div>
                                <div class="card-body smd-form">
                                    <form role="form" method="post" action="">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="id_user" placeholder="ID User" name="id_Pelanggan">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="nama_user" placeholder="Nama User" name="nama_pl">
                                        </div>
                                        <div class="mb-3">
                                            <textarea name="alamat_pl" class="form-control" id="alamat" rows="3" placeholder="Alamat"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <input type="date" class="form-control" id="tgl_lahir" placeholder="Tanggal Lahir" name="tgl_lahir_pl">
                                        </div>
                                        <input type="hidden" name="type" value="insert">
                                        <div class="text-center row">
                                            <div class="col-md-6">
                                                <button type="button" class="btn btn-danger col-md-5 bg-gradient-info w-100 mt-4 mb-0" data-bs-dismiss="modal" aria-label="Close">BATAL</button>
                                            </div>
                                            <div class="col-md-6">
                                                <button name="submit" value="submit" type="submit" id="button-form" type="button" class="btn btn-primary col-md-5 bg-gradient-info w-100 mt-4 mb-0">
                                                    Tambah Data
                                                </button>
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
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="id_pelanggan" placeholder="ID User" name="id_Pelanggan">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="nama_user" placeholder="Nama User" name="nama_pl">
                                        </div>
                                        <div class="mb-3">
                                            <textarea name="alamat_pl" class="form-control" id="alamat" rows="3" placeholder="Alamat"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <input type="date" class="form-control" id="tgl_lahir" placeholder="Tanggal Lahir" name="tgl_lahir_pl">
                                        </div>
                                        <input type="hidden" name="type" value="edit">
                                        <div class="text-center row">
                                            <div class="col-md-6">
                                                <button type="button" class="btn btn-danger col-md-5 bg-gradient-info w-100 mt-4 mb-0" data-bs-dismiss="modal" aria-label="Close">BATAL</button>
                                            </div>
                                            <div class="col-md-6">
                                                <button name="submit" value="submit" type="submit" id="button-form" type="button" class="btn btn-primary col-md-5 bg-gradient-info w-100 mt-4 mb-0">
                                                    Update Data
                                                </button>
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
                                    <p class="h6 mt-2 text-dark" >
                                        YAKIN INGIN MENGHAPUS DATA <span id="delete-id">##</span>
                                    </p>
                                </div>
                                <div class="card-body smd-form">
                                    <form role="form" method="post" action="">
                                        <input type="hidden" class="form-control" id="id_pelanggan" placeholder="ID User" name="id_Pelanggan">
                                        <input type="hidden" name="type" value="delete">
                                        <div class="text-center row">
                                            <div class="col-md-6">
                                                <button type="button" class="btn btn-danger col-md-5 bg-gradient-info w-100 mt-1 mb-0" data-bs-dismiss="modal" aria-label="Close">BATAL</button>
                                            </div>
                                            <div class="col-md-6">
                                                <button name="submit" value="submit" type="submit" id="button-form" type="button" class="btn btn-primary col-md-5 bg-gradient-info w-100 mt-1 mb-0">
                                                    Delete Data
                                                </button>
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
    function setFormEdit(elm) {
        let theTR = elm.parentElement.parentElement;
        let theTD = theTR.querySelectorAll('td');
        let editForm = document.getElementById('editModal');

        let id_pelanggan = editForm.querySelector('#id_pelanggan');
        let nama_user = editForm.querySelector('#nama_user');
        let alamat = editForm.querySelector('#alamat');
        let tgl_lahir = editForm.querySelector('#tgl_lahir');

        id_pelanggan.value = theTD[0].innerText;
        nama_user.value = theTD[1].innerText;
        alamat.value = theTD[2].innerText;
        tgl_lahir.value = theTD[3].innerText;
    }

    function setFormDelete(id) {
        let deleteForm = document.getElementById("deleteModal");
        let id_pelanggan = deleteForm.querySelector("#id_pelanggan");
        let textId =deleteForm.querySelector("#delete-id");

        id_pelanggan.value = id;
        textId.innerHTML = id;
    }


    let inputs = document.querySelectorAll("input");
    inputs.forEach((inp) => {
        inp.setAttribute("autocomplete", "off");
    });

</script>
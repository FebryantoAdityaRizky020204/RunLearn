<?php
include_once '../../Connection.php';
$conn = new Connection();

$loc = dirname(__FILE__);

$queryOptionRoom = "SELECT * FROM v_optionroom_with_room_with_pegawai";
$optionRooms = $conn->fetchAll($queryOptionRoom);

$queryRoom = "SELECT `id_room`, `nama_kamar` FROM `room`";
$room = $conn->fetchAll($queryRoom);

$queryPg = "SELECT `id_pegawai`, `nama_pg` FROM `pegawai`";
$pegawai = $conn->fetchAll($queryPg);
?>
<div class="row">
    <div class="col-lg-12">
        <div class="page-content">
            <!-- ***** Banner Start ***** -->
            <div class="main-banner">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="header-text">
                            <h4>TABEL <em>ROOM OPTION</em></h4>
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
                                                                <table class="table align-items-center mb-0" style="font-size: .8rem !important;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                                                ID
                                                                            </th>
                                                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                KAMAR
                                                                            </th>
                                                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                OPSI
                                                                            </th>
                                                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                PEGAWAI
                                                                            </th>
                                                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                KASUR
                                                                            </th>
                                                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                TAMU
                                                                            </th>
                                                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                SARAPAN
                                                                            </th>
                                                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                KMR TERSEDIA
                                                                            </th>
                                                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                HARGA
                                                                            </th>
                                                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                NO KAMAR
                                                                            </th>

                                                                            <th class="text-uppercase text-center text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                OPTION
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php foreach ($optionRooms as $orm) : ?>
                                                                            <tr>
                                                                                <td>
                                                                                    <?= $orm['id_room_option'] ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?= $orm['nama_kamar'] ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?= $orm['nama_opsi'] ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?= $orm['nama_pg'] ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?= $orm['jumlah_kasur'] ?> - <?= $orm['tipe_kasur'] ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?= $orm['jumlah_tamu'] ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?= ($orm['sarapan'] == 1) ? 'TERSEDIA' : 'TIDAK'; ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?= $orm['kamar_tersedia'] ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?= $orm['harga_kamar'] ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?= $orm['no_kamar_start'] ?> - <?= $orm['no_kamar_end'] ?>
                                                                                </td>
                                                                                <td class="text-center">
                                                                                    <button onclick="setFormEdit(this)" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal">
                                                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                                                        EDIT
                                                                                    </button>
                                                                                    <button onclick="setFormDelete('<?= $orm['id_room_option'] ?>')" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                                                        <i class="fa-solid fa-trash"></i>
                                                                                        DELETE
                                                                                    </button>
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
                                            <input type="text" class="form-control" id="id_room_option" placeholder="ID Room Option" name="id_room_option">
                                        </div>
                                        <div class="mb-3">
                                            <select name="id_room" id="id_room" class="form-control">
                                                <?php foreach ($room as $rm) : ?>
                                                    <option value="<?= $rm['id_room'] ?>"><?= $rm['id_room'] . '-' . $rm['nama_kamar']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <select name="id_pegawai" id="id_pegawai" class="form-control">
                                                <?php foreach ($pegawai as $pg) : ?>
                                                    <option value="<?= $pg['id_pegawai'] ?>"><?= $pg['id_pegawai'] . '-' . $pg['nama_pg']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="nama_opsi" placeholder="Nama Opsi" name="nama_opsi">
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" class="form-control" id="jumlah_kasur" placeholder="Jumlah Kasur" name="jumlah_kasur">
                                        </div>
                                        <div class="mb-3">
                                            <select name="tipe_kasur" id="tipe_kasur" class="form-control">
                                                <option value="SINGLE">SINGLE SIZE</option>
                                                <option value="DOUBLE">DOUBLE SIZE</option>
                                                <option value="KING">KING SIZE</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" class="form-control" id="jumlah_tamu" placeholder="Jumlah Tamu" name="jumlah_tamu">
                                        </div>
                                        <div class="mb-3">
                                            <select name="sarapan" id="sarapan" class="form-control">
                                                <option value="1">SARAPAN TERSEDIA</option>
                                                <option value="0">SARAPAN TIDAK TERSEDIA</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" class="form-control" id="kamar_tersedia" placeholder="Kamar Tersedia" name="kamar_tersedia">
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" class="form-control" id="harga_kamar" placeholder="Harga Kamar" name="harga_kamar">
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" class="form-control" id="no_kamar_start" placeholder="No Kamar (START)" name="no_kamar_start">
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" class="form-control" id="no_kamar_end" placeholder="No Kamar (END)" name="no_kamar_end">
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
                                            <input type="text" class="form-control" id="id_room_option" placeholder="ID Room Option" name="id_room_option">
                                        </div>
                                        <div class="mb-3">
                                            <select name="id_room" id="id_room" class="form-control">
                                                <?php foreach ($room as $rm) : ?>
                                                    <option value="<?= $rm['id_room'] ?>"><?= $rm['id_room'] . '-' . $rm['nama_kamar']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <select name="id_pegawai" id="id_pegawai" class="form-control">
                                                <?php foreach ($pegawai as $pg) : ?>
                                                    <option value="<?= $pg['id_pegawai'] ?>"><?= $pg['id_pegawai'] . '-' . $pg['nama_pg']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="nama_opsi" placeholder="Nama Opsi" name="nama_opsi">
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" class="form-control" id="jumlah_kasur" placeholder="Jumlah Kasur" name="jumlah_kasur">
                                        </div>
                                        <div class="mb-3">
                                            <select name="tipe_kasur" id="tipe_kasur" class="form-control">
                                                <option value="SINGLE">SINGLE SIZE</option>
                                                <option value="DOUBLE">DOUBLE SIZE</option>
                                                <option value="KING">KING SIZE</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" class="form-control" id="jumlah_tamu" placeholder="Jumlah Tamu" name="jumlah_tamu">
                                        </div>
                                        <div class="mb-3">
                                            <select name="sarapan" id="sarapan" class="form-control">
                                                <option value="1">SARAPAN TERSEDIA</option>
                                                <option value="0">SARAPAN TIDAK TERSEDIA</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" class="form-control" id="kamar_tersedia" placeholder="Kamar Tersedia" name="kamar_tersedia">
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" class="form-control" id="harga_kamar" placeholder="Harga Kamar" name="harga_kamar">
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" class="form-control" id="no_kamar_start" placeholder="No Kamar (START)" name="no_kamar_start">
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" class="form-control" id="no_kamar_end" placeholder="No Kamar (END)" name="no_kamar_end">
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
                                    <p class="h6 mt-2 text-dark">
                                        YAKIN INGIN MENGHAPUS DATA <span id="delete-id">##</span>
                                    </p>
                                </div>
                                <div class="card-body smd-form">
                                    <form role="form" method="post" action="">
                                        <input type="hidden" id="id_room_option" name="id_room_option">
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

        let id_room_option = editForm.querySelector("#id_room_option");
        let id_room = editForm.querySelector("#id_room");
        let id_pegawai = editForm.querySelector("#id_pegawai");
        let nama_opsi = editForm.querySelector("#nama_opsi");
        let jumlah_kasur = editForm.querySelector("#jumlah_kasur");
        let tipe_kasur = editForm.querySelector("#tipe_kasur");
        let jumlah_tamu = editForm.querySelector("#jumlah_tamu");
        let sarapan = editForm.querySelector("#sarapan");
        let kamar_tersedia = editForm.querySelector("#kamar_tersedia");
        let harga_kamar = editForm.querySelector("#harga_kamar");
        let no_kamar_start = editForm.querySelector("#no_kamar_start");
        let no_kamar_end = editForm.querySelector("#no_kamar_end");
        console.log(id_room_option);


        id_room_option.value = theTD[0].innerText;
        id_room.querySelectorAll("option").forEach((opt) => {
            if (opt.innerHTML.includes(`${theTD[1].innerText}`)) {
                opt.setAttribute("selected", "selected");
            } else {
                opt.removeAttribute("selected");
            }
        });

        id_pegawai.querySelectorAll("option").forEach((opt) => {
            if (opt.innerHTML.includes(`${theTD[3].innerText}`)) {
                opt.setAttribute("selected", "selected");
            } else {
                opt.removeAttribute("selected");
            }
        });
        nama_opsi.value = theTD[2].innerText;

        let jmlAndTipe = theTD[4].innerText.split(' - ');
        console.log(jmlAndTipe);
        jumlah_kasur.value = jmlAndTipe[0];
        tipe_kasur.querySelectorAll("option").forEach((opt) => {
            if (opt.innerHTML.includes(`${jmlAndTipe[1]}`)) {
                opt.setAttribute("selected", "selected");
            } else {
                opt.removeAttribute("selected");
            }
        });
        jumlah_tamu.value = theTD[5].innerText;
        let change = false;
        sarapan.querySelectorAll("option").forEach((opt) => {
            if (opt.innerHTML.includes(`${theTD[6].innerText}`) && !change) {
                opt.setAttribute("selected", "selected");
                change = true;
            } else {
                opt.removeAttribute("selected");
            }
        });
        kamar_tersedia.value = theTD[7].innerText;
        harga_kamar.value = theTD[8].innerText;
        let startEnd = theTD[9].innerText.split(' - ');
        no_kamar_start.value = startEnd[0];
        no_kamar_end.value = startEnd[1];
    }

    function setFormDelete(id) {
        let deleteForm = document.getElementById("deleteModal");
        let id_room_option = deleteForm.querySelector('#id_room_option');
        let textId = deleteForm.querySelector("#delete-id");

        id_room_option.value = id;
        textId.innerHTML = id;
    }


    let inputs = document.querySelectorAll("input");
    inputs.forEach((inp) => {
        inp.setAttribute("autocomplete", "off");
    });
</script>
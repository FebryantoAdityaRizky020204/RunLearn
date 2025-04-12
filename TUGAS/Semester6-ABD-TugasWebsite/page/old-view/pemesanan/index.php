<?php
include_once '../../Connection.php';
$conn = new Connection();

$loc = dirname(__FILE__);

$queryPm = "SELECT * FROM v_pemesanan";
$pemesanan = $conn->fetchAll($queryPm);

$queryRO = "SELECT * FROM `room_option`";
$roomOP = $conn->fetchAll($queryRO);

$queryPg = "SELECT `id_pegawai`, `nama_pg` FROM `pegawai`";
$pegawai = $conn->fetchAll($queryPg);

$queryPl = "SELECT * FROM `user`";
$pelanggan = $conn->fetchAll($queryPl);
?>
<div class="row">
    <div class="col-lg-12">
        <div class="page-content">
            <!-- ***** Banner Start ***** -->
            <div class="main-banner">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="header-text">
                            <h4>TABEL <em>PEMESANAN</em></h4>
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
                                                                                ID
                                                                            </th>
                                                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                PELANGGAN
                                                                            </th>
                                                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                PEGAWAI
                                                                            </th>
                                                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                KAMAR - NO
                                                                            </th>
                                                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                TGL MENGINAP
                                                                            </th>
                                                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                TOTAL HARGA
                                                                            </th>
                                                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                STATUS
                                                                            </th>
                                                                            <th class="text-uppercase text-center text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                OPTION
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php foreach ($pemesanan as $pm) : ?>
                                                                            <tr>
                                                                                <td>
                                                                                    <?= $pm['id_pemesanan'] ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?= $pm['nama_pl'] ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?= $pm['nama_pg'] ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?= $pm['nama_kamar'] ?> <?= $pm['nama_opsi'] ?> - <?= $pm['no_kamar'] ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?= $pm['tgl_start'] ?> s/d <?= $pm['tgl_end'] ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?= $pm['total_harga'] ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?= $pm['status'] ?>
                                                                                </td>
                                                                                <td class="text-center">
                                                                                    <button onclick="setFormEdit(this)" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal">
                                                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                                                        EDIT
                                                                                    </button>
                                                                                    <button onclick="setFormDelete('<?= $pm['id_pemesanan'] ?>')" class="btn btn-danger btn-sm"  data-bs-toggle="modal" data-bs-target="#deleteModal">
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
                                            <input type="text" class="form-control" id="id_pemesanan" placeholder="ID PEMESANAN" name="id_pemesanan">
                                        </div>
                                        <div class="mb-3">
                                            <select name="id_pegawai" id="id_pegawai" class="form-control" >
                                                <?php foreach($pegawai as $pg): ?>
                                                    <option value="<?= $pg['id_pegawai'] ?>"><?= $pg['id_pegawai'] . '-' . $pg['nama_pg']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <select name="id_pelanggan" id="id_pelanggan" class="form-control" >
                                                <?php foreach($pelanggan as $pl): ?>
                                                    <option value="<?= $pl['id_pelanggan'] ?>"><?= $pl['id_pelanggan'] . '-' . $pl['nama_pl']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <select name="id_room_option" id="id_room_option" class="form-control" >
                                                <?php foreach($roomOP as $rop): ?>
                                                    <option value="<?= $rop['id_room_option'] ?> - <?= $rop['harga_kamar'] ?>">
                                                        <?= $rop['id_room_option'] . '-' . $rop['nama_opsi'] . '[' . $rop['no_kamar_start'] . '-' . $rop['no_kamar_end'] .']' ; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" class="form-control" id="no_kamar" placeholder="Nomor Kamar" name="no_kamar">
                                        </div>
                                        <div class="mb-3">
                                            <input type="date" class="form-control" id="tgl_start" placeholder="Tanggal Start" name="tgl_start">
                                        </div>
                                        <div class="mb-3">
                                            <input type="date" class="form-control" id="tgl_end" placeholder="Tanggal End" name="tgl_end">
                                        </div>
                                        <div class="mb-3">
                                            <select name="status" id="status" class="form-control" >
                                                <option value="ACTIVE">ACTIVE</option>
                                                <option value="FINISH">FINISH</option>
                                            </select>
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
                                            <input type="text" class="form-control" id="id_pemesanan" placeholder="ID PEMESANAN" name="id_pemesanan">
                                        </div>
                                        <div class="mb-3">
                                            <select name="id_pegawai" id="id_pegawai" class="form-control" >
                                                <?php foreach($pegawai as $pg): ?>
                                                    <option value="<?= $pg['id_pegawai'] ?>"><?= $pg['id_pegawai'] . '-' . $pg['nama_pg']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <select name="id_pelanggan" id="id_pelanggan" class="form-control" >
                                                <?php foreach($pelanggan as $pl): ?>
                                                    <option value="<?= $pl['id_pelanggan'] ?>"><?= $pl['id_pelanggan'] . '-' . $pl['nama_pl']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <select name="id_room_option" id="id_room_option" class="form-control" >
                                                <?php foreach($roomOP as $rop): ?>
                                                    <option value="<?= $rop['id_room_option'] ?> - <?= $rop['harga_kamar'] ?>">
                                                        <?= $rop['id_room_option'] . '-' . $rop['nama_opsi'] . '[' . $rop['no_kamar_start'] . '-' . $rop['no_kamar_end'] .']' ; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" class="form-control" id="no_kamar" placeholder="Nomor Kamar" name="no_kamar">
                                        </div>
                                        <div class="mb-3">
                                            <input type="date" class="form-control" id="tgl_start" placeholder="Tanggal Start" name="tgl_start">
                                        </div>
                                        <div class="mb-3">
                                            <input type="date" class="form-control" id="tgl_end" placeholder="Tanggal End" name="tgl_end">
                                        </div>
                                        <div class="mb-3">
                                            <select name="status" id="status" class="form-control" >
                                                <option value="ACTIVE">ACTIVE</option>
                                                <option value="FINISH">FINISH</option>
                                            </select>
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
                                        <input type="hidden" id="id_pemesanan" name="id_pemesanan">
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

        let id_pemesanan = editForm.querySelector("#id_pemesanan");
        let id_pegawai = editForm.querySelector("#id_pegawai");
        let id_pelanggan = editForm.querySelector("#id_pelanggan");
        let id_room_option = editForm.querySelector("#id_room_option");
        let no_kamar = editForm.querySelector("#no_kamar");
        let tgl_start = editForm.querySelector("#tgl_start");
        let tgl_end = editForm.querySelector("#tgl_end");
        let status = editForm.querySelector("#status");

        id_pemesanan.value = theTD[0].innerText;
        id_pelanggan.querySelectorAll("option").forEach((opt) => {
            if(opt.innerHTML.includes(`${theTD[1].innerText}`)){ opt.setAttribute("selected", "selected"); } 
            else { opt.removeAttribute("selected"); }
        });
        id_pegawai.querySelectorAll("option").forEach((opt) => {
            if(opt.innerHTML.includes(`${theTD[2].innerText}`)){ opt.setAttribute("selected", "selected"); } 
            else { opt.removeAttribute("selected"); }
        });

        var kmrNoKmr = theTD[3].innerText.split(" - ");
        console.log(kmrNoKmr);
        id_room_option.querySelectorAll("option").forEach((opt) => {
            if(opt.innerHTML.includes(`${kmrNoKmr[0]}`)){ opt.setAttribute("selected", "selected"); } 
            else { opt.removeAttribute("selected"); }
        });
        no_kamar.value = kmrNoKmr[1];
        var tglStartEnd  = theTD[4].innerText.split(" s/d ")
        tgl_start.value = tglStartEnd[0];
        tgl_end.value = tglStartEnd[1]
        status.querySelectorAll("option").forEach((opt) => {
            if(opt.innerHTML.includes(`${theTD[6].innerText}`)){ opt.setAttribute("selected", "selected"); } 
            else { opt.removeAttribute("selected"); }
        });
    }

    function setFormDelete(id) {
        let deleteForm = document.getElementById("deleteModal");
        let id_pemesanan = deleteForm.querySelector('#id_pemesanan');
        let textId =deleteForm.querySelector("#delete-id");

        id_pemesanan.value = id;
        textId.innerHTML = id;
    }


    let inputs = document.querySelectorAll("input");
    inputs.forEach((inp) => {
        inp.setAttribute("autocomplete", "off");
    });

</script>
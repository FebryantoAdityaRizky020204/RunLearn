<?php
include_once '../../Connection.php';
$conn = new Connection();

$loc = dirname(__FILE__);

$queryRole = "SELECT * FROM `role`";
$roles = $conn->fetchAll($queryRole);
?>
<div class="row">
    <div class="col-lg-12">
        <div class="page-content">
            <!-- ***** Banner Start ***** -->
            <div class="main-banner">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="header-text">
                            <h4>TABEL <em>ROLE</em></h4>
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
                                                                                ID ROLE
                                                                            </th>
                                                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                NAMA ROLE
                                                                            </th>
                                                                            <th class="text-uppercase text-center text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                OPTION
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php foreach ($roles as $rl) : ?>
                                                                            <tr>
                                                                                <td>
                                                                                    <?= $rl['id_role'] ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?= $rl['nama_role'] ?>
                                                                                </td>
                                                                                <td class="text-center">
                                                                                    <button onclick="setFormEdit(this)" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal">
                                                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                                                        EDIT
                                                                                    </button>
                                                                                    <button onclick="setFormDelete('<?= $rl['id_role'] ?>')" class="btn btn-danger btn-sm"  data-bs-toggle="modal" data-bs-target="#deleteModal">
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
                                            <input type="text" class="form-control" id="id_role" placeholder="ID Role" name="id_role">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="nama_role" placeholder="Nama Role" name="nama_role">
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
                                            <input type="text" class="form-control" id="id_role" placeholder="ID Role" name="id_role">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="nama_role" placeholder="Nama Role" name="nama_role">
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
                                        YAKIN INGIN MENGHAPUS ROLE <span id="delete-id">##</span>
                                    </p>
                                </div>
                                <div class="card-body smd-form">
                                    <form role="form" method="post" action="">
                                        <input type="hidden" class="form-control" id="id_role" placeholder="ID User" name="id_role">
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

        let id_role = editForm.querySelector('#id_role');
        let nama_role = editForm.querySelector('#nama_role');

        id_role.value = theTD[0].innerText;
        nama_role.value = theTD[1].innerText;
    }

    function setFormDelete(id) {
        let deleteForm = document.getElementById("deleteModal");
        let id_role = deleteForm.querySelector("#id_role");
        let textId =deleteForm.querySelector("#delete-id");

        id_role.value = id;
        textId.innerHTML = id;
    }


    let inputs = document.querySelectorAll("input");
    inputs.forEach((inp) => {
        inp.setAttribute("autocomplete", "off");
    });

</script>
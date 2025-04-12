<?php
include_once '../../Connection.php';
$conn = new Connection();

$loc = dirname(__FILE__);

$queryUsr = "SELECT `owner_id`, `owner_givenname`, `owner_familyname`, `owner_address`, 
                CAST(AES_DECRYPT(`owner_phone`, 'adit') AS CHAR) AS `owner_phone_decrypted`
                FROM `owners`";
$datas = $conn->fetchAll($queryUsr);
?>

<div class="row">
    <div class="col-lg-12">
        <div class="page-content">
            <!-- ***** Banner Start ***** -->
            <div class="main-banner">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="header-text">
                            <h4>TABEL <em>OWNERS</em></h4>
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
                                                    <button class="btn btn-primary mb-2 btn-sm "
                                                        style="font-size: .7rem;" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal">
                                                        <i class="fa-solid fa-plus"></i>
                                                        TAMBAH DATA
                                                    </button>
                                                    <div class="card mb-1">
                                                        <div class="card-body px-0 pt-0 pb-2">
                                                            <div class="table-responsive p-0">
                                                                <table class="table align-items-center mb-0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                                                NO
                                                                            </th>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                Owner Name
                                                                            </th>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                Address
                                                                            </th>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                Num. Phone
                                                                            </th>
                                                                            <th
                                                                                class="text-uppercase text-center text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                OPTION
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php 
                                                                        $num = 1;
                                                                        foreach ($datas as $data) : ?>
                                                                        <tr>
                                                                            <td>
                                                                                <!-- <?= $data['owner_id'] ?> -->
                                                                                <?= $num++ ?>
                                                                            </td>
                                                                            <td>
                                                                                <?= $data['owner_givenname'] ?>
                                                                                <?= $data['owner_familyname'] ?>
                                                                            </td>
                                                                            <td>
                                                                                <?= $data['owner_address'] ?>
                                                                            </td>
                                                                            <td>
                                                                                <!-- <?= $data['owner_phone'] ?> -->
                                                                                <?= $data['owner_phone_decrypted'] ?>
                                                                                <!-- Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laudantium in harum temporibus sequi reiciendis eum eos, magni delectus magnam corporis vitae exercitationem aliquid consequuntur quae facere ut iusto vero quam! -->
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <button onclick="setFormEdit(this)"
                                                                                    class="btn btn-warning btn-sm"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#editModal">
                                                                                    <i
                                                                                        class="fa-solid fa-pen-to-square"></i>
                                                                                    EDIT
                                                                                </button>
                                                                                <button
                                                                                    onclick="setFormDelete('<?= $data['owner_id'] ?>')"
                                                                                    class="btn btn-danger btn-sm"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#deleteModal">
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
                                    <h3 class="font-weight-bolder text-info text-primary">
                                        <span id="title-form" style="font-size: 1rem;">TAMBAH DATA</span>
                                    </h3>
                                </div>
                                <div class="card-body smd-form">
                                    <form role="form" method="post" action="">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="owner_givenname" placeholder="Given Name" name="owner_givenname">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="	owner_familyname" placeholder="Family Name" name="	owner_familyname">
                                        </div>
                                        <div class="mb-3">
                                            <textarea name="owner_address" class="form-control" id="owner_address" rows="3" placeholder="Address"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" class="form-control" id="owner_phone" placeholder="Num. Phone" name="owner_phone">
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
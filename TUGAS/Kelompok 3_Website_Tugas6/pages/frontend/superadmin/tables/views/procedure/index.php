<?php
include_once '../../Connection.php';
$conn = new Connection();

$loc = dirname(__FILE__);

$tableHeaders = [];
$tableRows = [];

$procedureResult = $_POST['resultProcedure'];
$pResult = $procedureResult["status"] ?? "0";

$aType = $conn->fetchAll("SELECT * FROM `animal_type`");
$animals = $conn->fetchAll("SELECT * FROM `animal`");
?>

<!-- Form untuk memilih prosedur -->
<div class="row">
    <div class="col-lg-12">
        <div class="page-content">
            <div class="main-banner">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="header-text">
                            <h4>PROCEDURE</em></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                                                    <!-- <div class="card mb-1 p-2">
                                                        <?php //var_dump($procedureResult); ?>
                                                    </div> -->
                                                    <div class="card mb-1 p-2">
                                                        <form action="" method="post">
                                                            <input type="hidden" name="run_procedure"
                                                                value="get_animal_visit_history">
                                                            <h4 class="mb-1">Procedure get_animal_visit_history</h4>
                                                            <div class="mb-1 mt-1" style="max-width: 18rem;">
                                                                <!-- <input type="number"
                                                                    class="form-control text-sm form-control-sm"
                                                                    id="animal_id" placeholder="ID Animal"
                                                                    name="animal_id" autocomplete="off"> -->
                                                                <select name="animal_id" id="animal_id"
                                                                    class="form-control">
                                                                    <?php foreach($animals as $animal): ?>
                                                                    <option value="<?= $animal['animal_id'] ?>">
                                                                        <?= $animal['animal_id'] . '-' . $animal['animal_name']; ?>
                                                                    </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md">
                                                                <button name="submit" value="submit" type="submit"
                                                                    id="button-form"
                                                                    class="btn btn-primary btn-sm bg-gradient-info mt-2 mb-0">
                                                                    <small>RUN PROCEDURE</small>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                                <div class="card mb-1 p-2">
                                                    <form action="" method="post">
                                                        <input type="hidden" name="run_procedure"
                                                            value="get_animals_by_type">
                                                        <h4 class="mb-1">Procedure get_animals_by_type</h4>
                                                        <div class="mb-1 mt-1" style="max-width: 18rem;">
                                                            <!-- <input type="number"
                                                                class="form-control text-sm form-control-sm" id="at_id"
                                                                placeholder="ID Animal Type" name="at_id"
                                                                autocomplete="off"> -->
                                                            <select name="at_id" id="at_id" class="form-control">
                                                                <?php foreach($aType as $antp): ?>
                                                                <option value="<?= $antp['at_id'] ?>">
                                                                    <?= $antp['at_id'] . '-' . $antp['at_description']; ?>
                                                                </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md">
                                                            <button name="submit" value="submit" type="submit"
                                                                id="button-form"
                                                                class="btn btn-primary btn-sm bg-gradient-info mt-2 mb-0">
                                                                <small>RUN PROCEDURE</small>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>

                                                <div class="card mb-1 p-2">
                                                    <form action="" method="post">
                                                        <input type="hidden" name="run_procedure"
                                                            value="get_visits_by_date_range">
                                                        <h4 class="mb-1">Procedure get_visits_by_date_range</h4>
                                                        <div class="mb-1 mt-1" style="max-width: 18rem;">
                                                            <input type="date" class="form-control form-control-sm"
                                                                id="start_date" placeholder="Start Date"
                                                                name="start_date">
                                                        </div>
                                                        <div class="mb-1 mt-1" style="max-width: 18rem;">
                                                            <input type="date" class="form-control form-control-sm"
                                                                id="end_date" placeholder="End Date" name="end_date">
                                                        </div>
                                                        <div class="col-md">
                                                            <button name="submit" value="submit" type="submit"
                                                                id="button-form"
                                                                class="btn btn-primary btn-sm bg-gradient-info mt-2 mb-0">
                                                                <small>RUN PROCEDURE</small>
                                                            </button>
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
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk menampilkan hasil prosedur -->
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
                                        <span id="title-form" style="font-size: 1rem;">PROCEDURE RESULT</span>
                                    </h3>
                                </div>
                                <div class="card-body" style="font-size: .8rem !important;">
                                    <?php if ($pResult == "OK"): ?>
                                    <?php
                                        $type = $procedureResult["type"] ?? "";
                                        $data = $procedureResult["data"] ?? [];
                                    ?>
                                    <table class="table table-bordered table-hover">
                                        <?php if ($type == "get_animal_visit_history"): ?>
                                        <thead>
                                            <tr>
                                                <th>Tgl. Kunjungan</th>
                                                <th>Dokter</th>
                                                <th>Diagnosa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data as $row): ?>
                                            <tr>
                                                <td><?= $row['tanggal_kunjungan'] ?></td>
                                                <td><?= $row['nama_dokter'] ?></td>
                                                <td><?= $row['diagnosa'] ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <?php elseif ($type == "get_animals_by_type"): ?>
                                        <thead>
                                            <tr>
                                                <th>Hewan</th>
                                                <th>Pemilik</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data as $row): ?>
                                            <tr>
                                                <td><?= $row['nama_hewan'] ?></td>
                                                <td><?= $row['nama_pemilik'] ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <?php elseif ($type == "get_visits_by_date_range"): ?>
                                        <thead>
                                            <tr>
                                                <th>Tgl. Kunjungan</th>
                                                <th>Hewan</th>
                                                <th>Pemilik</th>
                                                <th>Dokter</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data as $row): ?>
                                            <tr>
                                                <td><?= $row['tanggal_kunjungan'] ?></td>
                                                <td><?= $row['nama_hewan'] ?></td>
                                                <td><?= $row['nama_pemilik'] ?></td>
                                                <td><?= $row['nama_dokter'] ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <?php endif; ?>
                                    </table>
                                    <?php elseif($pResult == "ERROR"): ?>
                                    <div class="card mb-1">
                                        <div class="alert alert-danger mb-0" role="alert">
                                            <strong>Something Wrong!</strong>
                                            <?= $procedureResult["msg"] ?>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                    <p class="text-muted">Tidak ada data ditemukan atau belum menjalankan prosedur.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk menampilkan modal setelah POST -->
<?php if ($pResult != "0"): ?>
<script>
    $(document).ready(function () {
        $('#exampleModal').modal('show'); // Menampilkan modal setelah POST dan data berhasil diambil
    });
</script>
<?php endif; ?>
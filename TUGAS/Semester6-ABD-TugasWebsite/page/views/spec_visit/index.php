<?php
include_once '../../Connection.php';
$conn = new Connection();

$loc = dirname(__FILE__);

$queryUsr = "SELECT  `spec_visit`.`clinic_id`, `spec_visit`.`vet_id`, `spec_visit`.`sv_count`, 
    `clinic`.`clinic_name`, `vet`.`vet_title`, `vet`.`vet_givenname`, `vet`.`vet_familyname`
    FROM `spec_visit` 
    INNER JOIN `clinic` ON `spec_visit`.`clinic_id` = `clinic`.`clinic_id`
    INNER JOIN `vet` ON  `spec_visit`.`vet_id` = `vet`.`vet_id`
    ORDER BY `clinic`.`clinic_id` ASC";

$datas = $conn->fetchAll($queryUsr);


$queryClinic = "SELECT `clinic_id`, `clinic_name` FROM `clinic`";
$queryVet = "SELECT `vet_id`, `vet_title`, `vet_givenname`, 'vet_familyname' FROM `vet`";

$clinics = $conn->fetchAll($queryClinic);
$vets = $conn->fetchAll($queryVet);
?>

<div class="row">
    <div class="col-lg-12">
        <div class="page-content">
            <!-- ***** Banner Start ***** -->
            <div class="main-banner">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="header-text">
                            <h4>TABEL <em>SPEC. VISIT</em></h4>
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
                                                                                Clinic Name
                                                                            </th>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                Vet
                                                                            </th>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                Count
                                                                            </th>
                                                                            <th
                                                                                class="text-uppercase text-center text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                Action
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php 
                                                                        $num = 1;
                                                                        foreach ($datas as $data) : ?>
                                                                        <tr>
                                                                            <td>
                                                                                <?= $num++ ?>
                                                                            </td>
                                                                            <td>
                                                                                <?= $data['clinic_name'] ?>
                                                                            </td>
                                                                            <td>
                                                                                <?= $data['vet_title'] ?> 
                                                                                <?= $data['vet_givenname'] ?>
                                                                                <?= $data['vet_familyname'] ?>
                                                                            </td>
                                                                            <td>
                                                                                <?= $data['sv_count'] ?>
                                                                            </td>
                                                                            <?php 
                                                                            $giveData = [
                                                                                'clinic_id' => $data['clinic_id'],
                                                                                'vet_id' => $data['vet_id'],
                                                                                'sv_count' => $data['sv_count']
                                                                            ]
                                                                            ?>
                                                                            <td class="text-center">
                                                                                <button
                                                                                    onclick="setFormEdit('<?= base64_encode(json_encode($giveData)) ?>')"
                                                                                    class="btn btn-warning btn-sm"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#editModal">
                                                                                    <i
                                                                                        class="fa-solid fa-pen-to-square"></i>
                                                                                    EDIT
                                                                                </button>
                                                                                <button
                                                                                    onclick="setFormDelete('<?= $data['clinic_id'] ?>', '<?= $data['vet_id'] ?>')"
                                                                                    class="btn btn-danger btn-sm"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#deleteModal">
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
                                    <h3 class="font-weight-bolder text-info text-primary">
                                        <span id="title-form" style="font-size: 1rem;">TAMBAH DATA</span>
                                    </h3>
                                </div>
                                <div class="card-body smd-form">
                                    <form role="form" method="post" action="">
                                        <div class="mb-3">
                                            <select name="clinic_id" id="clinic_id" class="form-control">
                                                <?php foreach($clinics as $clinic): ?>
                                                <option value="<?= $clinic['clinic_id'] ?>">
                                                    <?= $clinic['clinic_id'] . '-' . $clinic['clinic_name']; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <select name="vet_id" id="vet_id" class="form-control">
                                                <?php foreach($vets as $vet): ?>
                                                <option value="<?= $vet['vet_id'] ?>">
                                                    <?= $vet['vet_id'] . '-' . $vet['vet_title'] . ' ' . $vet['vet_givenname'] . ' ' . $vet['vet_familyname']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" class="form-control" id="sv_count"
                                                placeholder="Spec. Count" name="sv_count">
                                        </div>
                                        <input type="hidden" name="type" value="insert">
                                        <div class="text-center row">
                                            <div class="col-md-6">
                                                <button type="button"
                                                    class="btn btn-danger col-md-5 bg-gradient-info w-100 mt-4 mb-0"
                                                    data-bs-dismiss="modal" aria-label="Close">BATAL</button>
                                            </div>
                                            <div class="col-md-6">
                                                <button name="submit" value="submit" type="submit" id="button-form"
                                                    type="button"
                                                    class="btn btn-primary col-md-5 bg-gradient-info w-100 mt-4 mb-0">
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
                                        <input type="hidden" class="form-control" id="clinic_id" name="clinic_id">
                                        <input type="hidden" class="form-control" id="vet_id" name="vet_id">
                                        <div class="mb-3">
                                            <input type="number" class="form-control" id="sv_count"
                                                placeholder="Spec. Count" name="sv_count">
                                        </div>
                                        <input type="hidden" name="type" value="edit">
                                        <div class="text-center row">
                                            <div class="col-md-6">
                                                <button type="button"
                                                    class="btn btn-danger col-md-5 bg-gradient-info w-100 mt-4 mb-0"
                                                    data-bs-dismiss="modal" aria-label="Close">BATAL</button>
                                            </div>
                                            <div class="col-md-6">
                                                <button name="submit" value="submit" type="submit" id="button-form"
                                                    type="button"
                                                    class="btn btn-primary col-md-5 bg-gradient-info w-100 mt-4 mb-0">
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
                                        YAKIN INGIN MENGHAPUS DATA - <span id="delete-id">##</span>
                                    </p>
                                </div>
                                <div class="card-body smd-form">
                                    <form role="form" method="post" action="">
                                        <input type="hidden" class="form-control" id="clinic_id" name="clinic_id">
                                        <input type="hidden" class="form-control" id="vet_id" name="vet_id">
                                        <input type="hidden" name="type" value="delete">
                                        <div class="text-center row">
                                            <div class="col-md-6">
                                                <button type="button"
                                                    class="btn btn-danger col-md-5 bg-gradient-info w-100 mt-1 mb-0"
                                                    data-bs-dismiss="modal" aria-label="Close">BATAL</button>
                                            </div>
                                            <div class="col-md-6">
                                                <button name="submit" value="submit" type="submit" id="button-form"
                                                    type="button"
                                                    class="btn btn-primary col-md-5 bg-gradient-info w-100 mt-1 mb-0">
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
    function setFormEdit(encodedData) {
        try {
            let decoded = atob(encodedData);
            let data = JSON.parse(decoded);

            let form = document.getElementById('editModal');

            form.querySelector('#clinic_id').value = data.clinic_id;
            form.querySelector('#vet_id').value = data.vet_id;
            form.querySelector('#sv_count').value = data.sv_count;

        } catch (err) {
            console.error("Gagal set data form:", err);
        }
    }


    function setFormDelete(clinic_id, vet_id) {
        let deleteForm = document.getElementById("deleteModal");
        deleteForm.querySelector("#clinic_id").value = clinic_id;
        deleteForm.querySelector("#vet_id").value = vet_id;
        deleteForm.querySelector("#delete-id").innerText = `c:${clinic_id} v:${vet_id}`;
    }


    let inputs = document.querySelectorAll("input");
    inputs.forEach((inp) => {
        inp.setAttribute("autocomplete", "off");
    });
</script>
<?php
include_once './../../../../backend/Connection/PetugasAdministrasiConnection.php';
$conn = new Connection();

$loc = dirname(__FILE__);

$queryUsr = "SELECT 
                `visit`.*,
                `animal`.`animal_id` AS `a_animal_id`, 
                `animal`.`animal_name`,
                `vet`.`vet_id` AS `v_vet_id`, 
                `vet`.`vet_title`, `vet`.`vet_givenname`, `vet`.`vet_familyname` 
            FROM `visit`
            INNER JOIN `animal` ON `visit`.`animal_id` = `animal`.`animal_id`
            INNER JOIN `vet` ON `visit`.`vet_id` = `vet`.`vet_id`
            ORDER BY `visit`.`visit_id` ASC;";

try {
    $datas = $conn->fetchAll($queryUsr);

    $queryAnimal = "SELECT * FROM `animal`";
    $queryVet = "SELECT `vet_id`, `vet_title`, `vet_givenname`, `vet_familyname` FROM `vet`";
    $queryVisit = "SELECT * FROM `visit`";

    $animals = $conn->fetchAll($queryAnimal);
    $vets = $conn->fetchAll($queryVet);
    $visits = $conn->fetchAll($queryVisit);
} catch (Exception $e) {
    $datas = [
        'status' => false,
        'msg' => $e->getMessage()
    ];
}
?>

<div class="row">
    <div class="col-lg-12">
        <div class="page-content">
            <!-- ***** Banner Start ***** -->
            <div class="main-banner">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="header-text">
                            <h4>TABEL <em>ANIMAL</em></h4>
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
                                                    <?php
                                                    if (isset($datas['status'])) {
                                                        if ($datas['status'] == false) {
                                                            echo '<div class="card mb-1">
                                                                        <div class="alert alert-danger mb-0" role="alert">
                                                                            <strong>Something Wrong!</strong> </br>'.$datas['msg'].'
                                                                        </div>
                                                                    </div>';
                                                        }
                                                    } else {
                                                        ?>
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
                                                                                Visit Date
                                                                            </th>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                Notes
                                                                            </th>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                Animal Name
                                                                            </th>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                Vet
                                                                            </th>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                Visit Ref.
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
                                                                                <?= $data['visit_date_time'] ?>
                                                                            </td>
                                                                            <td>
                                                                                (id: <?= $data['visit_id'] ?>)
                                                                                <?= $data['visit_notes'] ?>
                                                                            </td>
                                                                            <td>
                                                                                <?= $data['animal_name'] ?>
                                                                            </td>
                                                                            <td>
                                                                                <?= $data['vet_title'] ?>
                                                                                <?= $data['vet_givenname'] ?>
                                                                                <?= $data['vet_familyname'] ?>
                                                                            </td>
                                                                            <td>
                                                                                id:
                                                                                <?= ($data['from_visit_id']) ? $data['from_visit_id'] : '-' ?>
                                                                            </td>
                                                                            <?php
                                                                                    $giveData = [
                                                                                        'visit_id' => $data['visit_id'],
                                                                                        'visit_date_time' => $data['visit_date_time'],
                                                                                        'visit_notes' => $data['visit_notes'],
                                                                                        'animal_id' => $data['a_animal_id'],
                                                                                        'vet_id' => $data['v_vet_id'],
                                                                                        'from_visit_id' => $data['from_visit_id']
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
                                                                                    onclick="setFormDelete('<?= $data['visit_id'] ?>')"
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
                                                    <?php } ?>
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
                                            <input type="date" class="form-control" id="visit_date_time"
                                                placeholder="Date" name="visit_date_time">
                                        </div>
                                        <div class="mb-3">
                                            <textarea name="visit_notes" class="form-control" id="visit_notes" rows="3"
                                                placeholder="Notes"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <select name="animal_id" id="animal_id" class="form-control">
                                                <?php foreach ($animals as $animal) : ?>
                                                <option value="<?= $animal['animal_id'] ?>">
                                                    <?= $animal['animal_id'].'-'.$animal['animal_name']; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <select name="vet_id" id="vet_id" class="form-control">
                                                <?php foreach ($vets as $vet) : ?>
                                                <option value="<?= $vet['vet_id'] ?>">
                                                    <?= $vet['vet_id'].'-'.$vet['vet_title'].' '.$vet['vet_givenname'].' '.$vet['vet_familyname']; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <select name="from_visit_id" id="from_visit_id" class="form-control">
                                                <option value="">none</option>
                                                <?php foreach ($visits as $visit) : ?>
                                                <option value="<?= $visit['visit_id'] ?>">
                                                    <?= 'id: '.$visit['visit_id']; ?>
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
                                        <input type="hidden" class="form-control" id="visit_id" name="visit_id">
                                        <div class="mb-3">
                                            <input type="date" class="form-control" id="visit_date_time"
                                                placeholder="Date" name="visit_date_time">
                                        </div>
                                        <div class="mb-3">
                                            <textarea name="visit_notes" class="form-control" id="visit_notes" rows="3"
                                                placeholder="Notes"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <select name="animal_id" id="animal_id" class="form-control">
                                                <?php foreach ($animals as $animal) : ?>
                                                <option value="<?= $animal['animal_id'] ?>">
                                                    <?= $animal['animal_id'].'-'.$animal['animal_name']; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <select name="vet_id" id="vet_id" class="form-control">
                                                <?php foreach ($vets as $vet) : ?>
                                                <option value="<?= $vet['vet_id'] ?>">
                                                    <?= $vet['vet_id'].'-'.$vet['vet_title'].' '.$vet['vet_givenname'].' '.$vet['vet_familyname']; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <select name="from_visit_id" id="from_visit_id" class="form-control">
                                                <option value="">none</option>
                                                <?php foreach ($visits as $visit) : ?>
                                                <option value="<?= $visit['visit_id'] ?>">
                                                    <?= 'id: '.$visit['visit_id']; ?>
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
                                        <input type="hidden" class="form-control" id="visit_id" placeholder="Given Name"
                                            name="visit_id">
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

        form.querySelector('#visit_id').value = data.visit_id;
        form.querySelector('#visit_date_time').value = data.visit_date_time;
        form.querySelector('#visit_notes').value = data.visit_notes;
        form.querySelector('#animal_id').value = data.animal_id;
        form.querySelector('#vet_id').value = data.vet_id;
        if (data.from_visit_id != null) {
            form.querySelector('#from_visit_id').value = data.from_visit_id;
        }

    } catch (err) {
        console.error("Gagal set data form:", err);
    }
}


function setFormDelete(id) {
    let deleteForm = document.getElementById("deleteModal");
    deleteForm.querySelector("#visit_id").value = id;
    deleteForm.querySelector("#delete-id").innerText = `id: ${id}`;
}


let inputs = document.querySelectorAll("input");
inputs.forEach((inp) => {
    inp.setAttribute("autocomplete", "off");
});
</script>
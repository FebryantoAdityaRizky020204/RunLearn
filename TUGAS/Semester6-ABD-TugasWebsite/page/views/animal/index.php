<?php
include_once '../../Connection.php';
$conn = new Connection();

$loc = dirname(__FILE__);

try {
    $queryUsr = "SELECT * FROM `animal` 
        INNER JOIN `owners` ON animal.owner_id = owners.owner_id
        INNER JOIN `animal_type` ON animal.at_id = animal_type.at_id
        ORDER BY `animal`.`animal_id` ASC";
    
    $datas = $conn->fetchAll($queryUsr);

    $queryOwner = "SELECT `owner_id`, `owner_givenname`, `owner_familyname` FROM `owners`";
    $queryAnimalType = "SELECT `at_id`, `at_description` FROM `animal_type`";

    $owners = $conn->fetchAll($queryOwner);
    $animalTypes = $conn->fetchAll($queryAnimalType);
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
                                                        if(isset($datas['status'])) {
                                                            if($datas['status'] == false) {
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
                                                                                Animal Name
                                                                            </th>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                Born
                                                                            </th>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                Owner
                                                                            </th>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                Type
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
                                                                                <?= $data['animal_name'] ?>
                                                                            </td>
                                                                            <td>
                                                                                <?= $data['animal_born'] ?>
                                                                            </td>
                                                                            <td>
                                                                                <?= $data['owner_givenname'] ?>
                                                                                <?= $data['owner_familyname'] ?>
                                                                            </td>
                                                                            <td>
                                                                                <?= $data['at_description'] ?>
                                                                            </td>
                                                                            <?php 
                                                                            $giveData = [
                                                                                'animal_id' => $data['animal_id'],
                                                                                'animal_name' => $data['animal_name'],
                                                                                'animal_born' => $data['animal_born'],
                                                                                'owner_id' => $data['owner_id'],
                                                                                'at_id' => $data['at_id']
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
                                                                                    onclick="setFormDelete('<?= $data['animal_id'] ?>', '<?= $data['animal_name'] ?>')"
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
                                            <input type="text" class="form-control" id="animal_name"
                                                placeholder="Animal Name" name="animal_name">
                                        </div>
                                        <div class="mb-3">
                                            <input type="date" class="form-control" id="animal_born" placeholder="Born"
                                                name="animal_born">
                                        </div>
                                        <div class="mb-3">
                                            <select name="owner_id" id="owner_id" class="form-control">
                                                <?php foreach($owners as $owr): ?>
                                                <option value="<?= $owr['owner_id'] ?>">
                                                    <?= $owr['owner_id'] . '-' . $owr['owner_givenname'] . ' ' . $owr['owner_familyname']; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <select name="at_id" id="at_id" class="form-control">
                                                <?php foreach($animalTypes as $antp): ?>
                                                <option value="<?= $antp['at_id'] ?>">
                                                    <?= $antp['at_id'] . '-' . $antp['at_description']; ?></option>
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
                                            <select name="owner_id" id="owner_id" class="form-control">
                                                <?php foreach($owners as $owr): ?>
                                                <option value="<?= $owr['owner_id'] ?>">
                                                    <?= $owr['owner_id'] . '-' . $owr['owner_givenname'] . ' ' . $owr['owner_familyname']; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <select name="at_id" id="at_id" class="form-control">
                                                <?php foreach($animalTypes as $antp): ?>
                                                <option value="<?= $antp['at_id'] ?>">
                                                    <?= $antp['at_id'] . '-' . $antp['at_description']; ?></option>
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
                                        <input type="hidden" class="form-control" id="animal_id" placeholder="Given Name"
                                            name="animal_id">
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


    let inputs = document.querySelectorAll("input");
    inputs.forEach((inp) => {
        inp.setAttribute("autocomplete", "off");
    });
</script>
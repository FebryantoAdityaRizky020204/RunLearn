<?php
include_once '../../Connection.php';
$conn = new Connection();

$loc = dirname(__FILE__);

$queryUsr = "SELECT 
                `visit_drug`.*,
                `drug`.`drug_id` AS `d_drug_id`, 
                `drug`.`drug_name`,
                `visit`.`visit_id` AS `v_visit_id`
            FROM `visit_drug`
            INNER JOIN `drug` ON `visit_drug`.`drug_id` = `drug`.`drug_id`
            INNER JOIN `visit` ON `visit_drug`.`visit_id` = `visit`.`visit_id`
            ORDER BY `visit_drug`.`visit_id` ASC;";

try {
    $datas = $conn->fetchAll($queryUsr);
    
    $queryDrug = "SELECT * FROM `drug`";
    $drugs = $conn->fetchAll($queryDrug);
    
    $queryVisit = "SELECT * FROM `visit`";
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
                            <h4>TABEL <em>VISIT DRUG</em></h4>
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
                                                                                Num
                                                                            </th>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                                                Drug Dose
                                                                            </th>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                Frequency
                                                                            </th>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                Qty. Supplied
                                                                            </th>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                Drug
                                                                            </th>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                Visit
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
                                                                                <?= $data['visit_drug_dose'] ?>
                                                                            </td>
                                                                            <td>
                                                                                <?= $data['visit_drug_frequency'] ?>
                                                                            </td>
                                                                            <td>
                                                                                <?= $data['visit_drug_qtysupplied'] ?>
                                                                            </td>
                                                                            <td>
                                                                                <?= $data['d_drug_id'] ?> - <?= $data['drug_name'] ?>
                                                                            </td>
                                                                            <td>
                                                                                id: <?= $data['v_visit_id'] ?>
                                                                            </td>
                                                                            <?php 
                                                                            $giveData = [
                                                                                'visit_drug_dose' => $data['visit_drug_dose'],
                                                                                'visit_drug_frequency' => $data['visit_drug_frequency'],
                                                                                'visit_drug_qtysupplied' => $data['visit_drug_qtysupplied'],
                                                                                'drug_id' => $data['d_drug_id'],
                                                                                'visit_id' => $data['v_visit_id']
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
                                                                                    onclick="setFormDelete('<?= $data['d_drug_id'] ?>', '<?= $data['v_visit_id'] ?>')"
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
                                            <input type="text" class="form-control" id="visit_drug_dose"
                                                placeholder="Drug Dose" name="visit_drug_dose">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="visit_drug_frequency"
                                                placeholder="Drug Frequency" name="visit_drug_frequency">
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" class="form-control" id="visit_drug_qtysupplied"
                                                placeholder="Qty. Supplied" name="visit_drug_qtysupplied">
                                        </div>
                                        <div class="mb-3">
                                            <select name="drug_id" id="drug_id" class="form-control">
                                                <?php foreach($drugs as $drug): ?>
                                                <option value="<?= $drug['drug_id'] ?>">
                                                    <?= $drug['drug_id'] . '-' . $drug['drug_name']; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <select name="visit_id" id="visit_id" class="form-control">
                                                <?php foreach($visits as $visit): ?>
                                                <option value="<?= $visit['visit_id'] ?>">
                                                    <?= 'id: ' . $visit['visit_id']; ?></option>
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
                                        <input type="hidden" class="form-control" id="drug_id" name="drug_id">
                                        <input type="hidden" class="form-control" id="visit_id" name="visit_id">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="visit_drug_dose"
                                                placeholder="Drug Dose" name="visit_drug_dose">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="visit_drug_frequency"
                                                placeholder="Drug Frequency" name="visit_drug_frequency">
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" class="form-control" id="visit_drug_qtysupplied"
                                                placeholder="Qty. Supplied" name="visit_drug_qtysupplied">
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
                                        <input type="hidden" class="form-control" id="drug_id" name="drug_id">
                                        <input type="hidden" class="form-control" id="visit_id" name="visit_id">
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

            form.querySelector('#visit_drug_dose').value = data.visit_drug_dose;
            form.querySelector('#visit_drug_frequency').value = data.visit_drug_frequency;
            form.querySelector('#visit_drug_qtysupplied').value = data.visit_drug_qtysupplied;
            form.querySelector('#drug_id').value = data.drug_id;
            form.querySelector('#visit_id').value = data.visit_id;

        } catch (err) {
            console.error("Gagal set data form:", err);
        }
    }


    function setFormDelete(idDrug, idVisit) {
        let deleteForm = document.getElementById("deleteModal");
        deleteForm.querySelector("#visit_id").value = idVisit;
        deleteForm.querySelector("#drug_id").value = idDrug;
        deleteForm.querySelector("#delete-id").innerText = `${idDrug} - ${idVisit}`;
    }


    let inputs = document.querySelectorAll("input");
    inputs.forEach((inp) => {
        inp.setAttribute("autocomplete", "off");
    });
</script>
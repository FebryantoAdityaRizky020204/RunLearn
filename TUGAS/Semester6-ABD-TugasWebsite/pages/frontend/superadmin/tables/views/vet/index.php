<?php
include_once '../../Connection.php';
$conn = new Connection();

$loc = dirname(__FILE__);

$queryUsr = "SELECT 
                `vet`.*,
                `specialisation`.`spec_id` AS `s_spec_id`, 
                `specialisation`.`spec_description`,
                `clinic`.`clinic_id` AS `c_clinic_id`, 
                `clinic`.`clinic_name`
            FROM `vet`
            INNER JOIN `specialisation` ON `vet`.`spec_id` = `specialisation`.`spec_id`
            INNER JOIN `clinic` ON `vet`.`clinic_id` = `clinic`.`clinic_id`;";

try {
    $datas = $conn->fetchAll($queryUsr);

    $querySpec = "SELECT * from `specialisation`";
    $queryClinic = "SELECT * FROM `clinic`";

    $specs = $conn->fetchAll($querySpec);
    $clinics = $conn->fetchAll($queryClinic);
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
                            <h4>TABEL <em>VETERINARIAN</em></h4>
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
                                                                                Vet Name
                                                                            </th>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                Phone
                                                                            </th>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                Employed
                                                                            </th>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                Spec.
                                                                            </th>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                Clinic
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
                                                                                <?= $data['vet_title'] ?>
                                                                                <?= $data['vet_familyname'] ?>
                                                                                <?= $data['vet_givenname'] ?>
                                                                            </td>
                                                                            <td>
                                                                                <?= $data['vet_phone'] ?>
                                                                            </td>
                                                                            <td>
                                                                                <?= $data['vet_employed'] ?>
                                                                            </td>
                                                                            <td>
                                                                                <?= $data['spec_description'] ?>
                                                                            </td>
                                                                            <td>
                                                                                <?= $data['clinic_name'] ?>
                                                                            </td>
                                                                            <?php
                                                                                    $giveData = [
                                                                                        'vet_id' => $data['vet_id'],
                                                                                        'vet_title' => $data['vet_title'],
                                                                                        'vet_givenname' => $data['vet_givenname'],
                                                                                        'vet_familyname' => $data['vet_familyname'],
                                                                                        'vet_phone' => $data['vet_phone'],
                                                                                    ]
                                                                                        ?>
                                                                            <td class="text-center">
                                                                                <button
                                                                                    onclick="setFormResetPassword('<?= base64_encode(json_encode($giveData)) ?>')"
                                                                                    class="btn btn-warning btn-sm"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#resetPasswordModal">
                                                                                    <i
                                                                                        class="fa-solid fa-rotate-left"></i>
                                                                                    Reset Password
                                                                                </button>
                                                                                <button
                                                                                    onclick="setFormDelete('<?= $data['vet_id'] ?>', '<?= $data['vet_title'].' '.$data['vet_familyname'].' '.$data['vet_givenname'] ?>')"
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
                                            <input type="text" class="form-control" id="vet_title" placeholder="Title"
                                                name="vet_title">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="vet_givenname"
                                                placeholder="Given Name" name="vet_givenname">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="vet_familyname"
                                                placeholder="Family Name" name="vet_familyname">
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" class="form-control" id="vet_phone"
                                                placeholder="Num. Phone" name="vet_phone">
                                        </div>
                                        <div class="mb-3">
                                            <input type="date" class="form-control" id="vet_employed"
                                                placeholder="Vet Employed" name="vet_employed">
                                        </div>

                                        <div class="mb-3">
                                            <select name="spec_id" id="spec_id" class="form-control">
                                                <?php foreach ($specs as $spec) : ?>
                                                <option value="<?= $spec['spec_id'] ?>">
                                                    <?= $spec['spec_id'].'-'.$spec['spec_description']; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <select name="clinic_id" id="clinic_id" class="form-control">
                                                <?php foreach ($clinics as $clinic) : ?>
                                                <option value="<?= $clinic['clinic_id'] ?>">
                                                    <?= $clinic['clinic_id'].'-'.$clinic['clinic_name']; ?>
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
<div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-warning text-gradient text-center ">
                                        <span id="title-form" style="font-size: 1.5rem;">RESET PASSWORD</span>
                                    </h3>
                                </div>
                                <div class="display-1 text-center text-warning py-2">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    <p class="h6 mt-2 text-dark">
                                        YAKIN INGIN MERESET PASSWORD - <span id="reset-name">##</span>
                                    </p>
                                </div>
                                <div class="card-body smd-form">
                                    <form role="form" method="post" action="">
                                        <input type="hidden" class="form-control" id="vet_id" name="vet_id">
                                        <input type="hidden" name="type" value="reset-password">
                                        <input type="hidden" name="vet_phone" id="vet_phone">
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
                                                    RESET
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
                                        <input type="hidden" class="form-control" id="vet_id" placeholder="Given Name"
                                            name="vet_id">
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
function setFormResetPassword(encodedData) {
    try {
        let decoded = atob(encodedData);
        let data = JSON.parse(decoded);

        let form = document.getElementById('resetPasswordModal');
        console.log(data)

        form.querySelector('#vet_id').value = data.vet_id;
        form.querySelector('#reset-name').innerHTML = `${data.vet_title} ${data.vet_familyname} ${data.vet_givenname}`;
        form.querySelector('#vet_phone').value = data.vet_phone;
    } catch (err) {
        console.error("Gagal set data form:", err);
    }
}


function setFormDelete(id, name) {
    let deleteForm = document.getElementById("deleteModal");
    deleteForm.querySelector("#vet_id").value = id;
    deleteForm.querySelector("#delete-id").innerText = name;
}


let inputs = document.querySelectorAll("input");
inputs.forEach((inp) => {
    inp.setAttribute("autocomplete", "off");
});
</script>
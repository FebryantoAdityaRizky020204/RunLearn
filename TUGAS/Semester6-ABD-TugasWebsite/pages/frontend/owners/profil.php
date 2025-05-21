<?php

if (! session_id()) {
    session_start();
}

require_once './../../backend/Connection/OwnerConnection.php';
$conn = new Connection();

$user = $_SESSION['dataLogin'] ?? null;

$loginAs = $_SESSION['loginAs'] ?? null;
if ($loginAs !== 'owner') {
    header('Location: ./../../index.php');
    exit;
}

$titlePage = 'Profile - Owner Sahabat Satwa';
?>

<?php require_once './../templates/header.php'; ?>




<link rel="stylesheet" href="./css/profil.css">
<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="../../index.php">
            <img src="../../assets/image/paw_logo.png" alt="Logo" width="30" height="24"
                class="d-inline-block align-text-top">
            Sahabat Satwa
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="./dashboard.php">
                        <i class="fa-solid fa-house"></i>
                        Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./logout.php">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header text-center" style="background-color: #ff9900; color: white;">
                <h2>Profil Saya</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form>
                            <input type="text" class="form-control" id="owner_id" value="<?= $user['owner_id']; ?>"
                                hidden>
                            <div class="mb-3">
                                <label for="owner_givenname" class="form-label">Given Name</label>
                                <input type="text" class="form-control" id="owner_givenname"
                                    value="<?= $user['owner_givenname']; ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="owner_familyname" class="form-label">Family Name</label>
                                <input type="text" class="form-control" id="owner_familyname"
                                    value="<?= $user['owner_familyname']; ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="owner_address" class="form-label">Alamat</label>
                                <textarea class="form-control" id="owner_address" rows="3"
                                    disabled><?= $user['owner_address']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="owner_phone" class="form-label">No. Phone</label>
                                <input type="number" class="form-control" id="owner_phone"
                                    value="<?= $user['owner_phone']; ?>" disabled>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-5">
                        <div class="row">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" value="<?= $user['username']; ?>"
                                    disabled>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" value="adadehrahasia"
                                    disabled>
                                <span class="text-danger" style="font-size: .8rem;" id="password-warning" hidden>
                                    *Kosongkan jika tidak ingin mengganti password
                                </span>
                            </div>
                            <button type="button" id="editButton" class="btn btn-small btn-warning">
                                Edit Profil
                            </button>
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" id="cancelButton" class="btn btn-small btn-danger w-100"
                                        hidden>
                                        Batal
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button type="button" id="saveButton" class="btn btn-small btn-primary w-100"
                                        hidden>
                                        Save Profile
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
let history = {
    owner_givenname: $('#owner_givenname').val(),
    owner_familyname: $('#owner_familyname').val(),
    owner_address: $('#owner_address').val(),
    owner_phone: $('#owner_phone').val(),
    username: $('#username').val(),
}

$('#editButton').click(function() {
    $('#owner_givenname').prop('disabled', false);
    $('#owner_familyname').prop('disabled', false);
    $('#owner_address').prop('disabled', false);
    $('#owner_phone').prop('disabled', false);
    $('#username').prop('disabled', false);
    $("#password").prop('disabled', false);
    $("#password").val("");
    $("#password-warning").prop('hidden', false);

    $(this).hide();
    $('#saveButton').removeAttr('hidden').fadeIn(300);
    $('#cancelButton').removeAttr('hidden').fadeIn(300);
});

$('#cancelButton').click(function() {
    $('#owner_givenname').val(history.owner_givenname).prop('disabled', true);
    $('#owner_familyname').val(history.owner_familyname).prop('disabled', true);
    $('#owner_address').val(history.owner_address).prop('disabled', true);
    $('#owner_phone').val(history.owner_phone).prop('disabled', true);
    $('#username').val(history.username).prop('disabled', true);
    $("#password-warning").prop('hidden', true);
    $("#password").prop('disabled', true);
    $("#password").val("adadeh");

    $(this).hide();
    $('#saveButton').hide();
    $('#editButton').removeAttr('hidden').fadeIn(300);
})

$('#saveButton').click(function() {
    let data = {
        owner_givenname: $('#owner_givenname').val(),
        owner_familyname: $('#owner_familyname').val(),
        owner_address: $('#owner_address').val(),
        owner_phone: $('#owner_phone').val(),
        username: $('#username').val(),
        password: $('#password').val(),
        owner_id: $('#owner_id').val()
    }

    $.post('./../../backend/owner/profile.php', data, function(response) {
        console.log(response);
        if (response.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Edit Profile Berhasil',
                text: response.message,
                timer: 2000,
                showConfirmButton: false
            });
            setTimeout(function() {
                location.reload();
            }, 2000);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Edit Profile Gagal!',
            });

            $('#owner_givenname').val(history.owner_givenname).prop('disabled', true);
            $('#owner_familyname').val(history.owner_familyname).prop('disabled', true);
            $('#owner_address').val(history.owner_address).prop('disabled', true);
            $('#owner_phone').val(history.owner_phone).prop('disabled', true);
            $('#username').val(history.username).prop('disabled', true);
            $('#password').val(history.username).prop('disabled', true);
            $("#password").val("adadeh");
            $("#password-warning").prop('hidden', true);

            $("#saveButton").hide();
            $('#cancelButton').hide();
            $('#editButton').removeAttr('hidden').fadeIn(300);
        }
    }, 'json')
})
</script>
<?php require_once './../templates/footer.php'; ?>
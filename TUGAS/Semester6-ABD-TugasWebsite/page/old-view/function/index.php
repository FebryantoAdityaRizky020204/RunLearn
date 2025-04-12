<?php
include_once '../../Connection.php';
$conn = new Connection();

$loc = dirname(__FILE__);

$queryRoomOPT = "SELECT `id_room_option`, `nama_opsi`, `room`.`nama_kamar` FROM `room_option` 
                INNER JOIN `room` ON `room`.`id_room` = `room_option`.`id_room`";
$roomOPT = $conn->fetchAll($queryRoomOPT);
?>

<div class="row">
    <div class="col-lg-12">
        <div class="page-content">
            <!-- ***** Banner Start ***** -->
            <div class="main-banner">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="header-text">
                            <h4>FUNC<em>TION</em></h4>
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
                            <div class="col-lg-6">
                                <div class="featured-games header-text">
                                    <div class="heading-section">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-12 p-0">
                                                    <div class="card mb-1">
                                                        <div class="card-body px-0 pt-0 pb-2">
                                                            <div class="table-responsive p-0">
                                                                <table class="table align-items-center mb-0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                                                ROOM OPTION
                                                                            </th>
                                                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                KETERSEDIAAN KAMAR
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php foreach ($roomOPT as $ropt) : ?>
                                                                            <tr>
                                                                                <td>
                                                                                    <?= $ropt['nama_kamar'] ?> <?= $ropt['nama_opsi'] ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?php
                                                                                        $id = $ropt['id_room_option'];
                                                                                        $queryCheck = "SELECT CekKetersediaanKamar('$id') AS ketersediaan_kamar";
                                                                                        $result = $conn->singleFetch($queryCheck);
                                                                                    ?>
                                                                                    <?= $result['ketersediaan_kamar'] ?>
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
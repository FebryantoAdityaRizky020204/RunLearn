<?php
include_once '../../Connection.php';
$conn = new Connection();

$loc = dirname(__FILE__);

$queryVisit = "SELECT `specialisation`.`spec_id`, `specialisation`.`spec_description`, 
            COUNT(`visit`.`visit_id`) AS total_visits, SUM(`specialisation`.`medical_cost`) AS total_cost 
            FROM specialisation 
            INNER JOIN `vet` ON `specialisation`.`spec_id` = `vet`.`spec_id` 
            INNER JOIN `visit` ON `visit`.`vet_id` = `vet`.`vet_id` 
            GROUP BY `specialisation`.`spec_id`, `specialisation`.`spec_description`;";

$queryClinic = "SELECT * FROM `clinic`";


$queryDrug = "SELECT 
  `drug`.`drug_id`,
  `drug`.`drug_name`,
  SUM(`visit_drug`.`visit_drug_qtysupplied`) AS `total_qty`,
  SUM(`drug`.`price` * `visit_drug`.`visit_drug_qtysupplied`) AS `total_price`
FROM `drug` 
JOIN `visit_drug` ON `drug`.`drug_id` = `visit_drug`.`drug_id` 
GROUP BY `drug`.`drug_id`, `drug`.`drug_name`;";

$TotalPemasukan = $conn->singleFetch("SELECT SUM(total) AS total_pemasukan_keseluruhan FROM (
  -- Total dari jasa medis
  SELECT SUM(`specialisation`.`medical_cost`) AS total
  FROM `specialisation`
  INNER JOIN `vet` ON `specialisation`.`spec_id` = `vet`.`spec_id` 
  INNER JOIN `visit` ON `visit`.`vet_id` = `vet`.`vet_id`
  UNION ALL
  -- Total dari penjualan obat
  SELECT SUM(`drug`.`price` * `visit_drug`.`visit_drug_qtysupplied`) AS total
  FROM `drug`
  JOIN `visit_drug` ON `drug`.`drug_id` = `visit_drug`.`drug_id`) AS pemasukan;");

try {
    $datas = $conn->fetchAll($queryVisit);
    $clinics = $conn->fetchAll($queryClinic);
    $drug = $conn->fetchAll($queryDrug);
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
                        <div class="header-text mb-3">
                            <h5>TABEL Pemasukan</h5>
                            <span class="badge text-bg-primary">
                                Total Pemasukan : Rp.
                                <?= number_format($TotalPemasukan['total_pemasukan_keseluruhan'], 0, ',', '.'); ?></span>
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
                                                <div class="col-md-5 p-0">
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

                                                    <div class="card mb-1">
                                                        <div class="card-body px-0 pt-0 pb-2">
                                                            <div class="table-responsive p-0">
                                                                <table class="table align-items-center mb-0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                                                No
                                                                            </th>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                Spec. Description
                                                                            </th>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                Count
                                                                            </th>

                                                                            <th
                                                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                Total Income
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
                                                                                <?= $data['spec_description'] ?>
                                                                            </td>
                                                                            <td>
                                                                                <?= $data['total_visits'] ?>
                                                                            </td>
                                                                            <td>
                                                                                Rp.
                                                                                <?= number_format($data["total_cost"], 0, ',', '.'); ?>
                                                                            </td>
                                                                            <td>
                                                                        </tr>
                                                                        <?php endforeach; ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                </div>


                                                <div class="col-md-5 mx-2 p-0">
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

                                                    <div class="card mb-1">
                                                        <div class="card-body px-0 pt-0 pb-2">
                                                            <div class="table-responsive p-0">
                                                                <table class="table align-items-center mb-0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                                                No
                                                                            </th>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                Drug Name
                                                                            </th>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                Count
                                                                            </th>

                                                                            <th
                                                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1">
                                                                                Total Drug Income
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                            $num = 1;
                                                                            foreach ($drug as $dr) : ?>
                                                                        <tr>
                                                                            <td>
                                                                                <?= $num++ ?>
                                                                            </td>
                                                                            <td>
                                                                                <?= $dr['drug_name'] ?>
                                                                            </td>
                                                                            <td>
                                                                                <?= $dr['total_qty'] ?>
                                                                            </td>
                                                                            <td>
                                                                                Rp.
                                                                                <?= number_format($dr["total_price"], 0, ',', '.'); ?>
                                                                            </td>
                                                                            <td>
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
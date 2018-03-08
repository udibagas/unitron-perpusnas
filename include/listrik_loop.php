<?php

$sql1 = $konek->query("
    SELECT
        DISTINCT sensor.POSISIDETAIL,
        sensor.NAMALOKASI
    FROM sensor
    WHERE
        left(sensor.PARAMETER,6)='Active'
        AND POSISIDETAIL='$id'
");

?>

<?php while ($data1 = $sql1->fetch_array()) : ?>

<?php
$c      = 0;
$posisi = $data1['POSISIDETAIL'];
$nl     = $data1['NAMALOKASI'];
$sql    = $konek->query("
    SELECT
        sensor.ID_SENSOR,
        sensor.NAMALOKASI,
        sensor.PARAMETER,
        sensor.POSISIDETAIL
    FROM sensor
    WHERE
        left(sensor.PARAMETER,6)='Active'
        AND sensor.POSISIDETAIL='$posisi'
    GROUP BY sensor.ID_SENSOR,sensor.PARAMETER
    LIMIT 3
");
?>

<div class="col-md-6 col-sm-12 col-xs-12">
    <div class="alert alert-success">
        <h3 class="text-center panel-title">DAYA <?= strtoupper($posisi); ?> - <?= strtoupper($nl) ?></h3>
    </div>
    <div class="row">
        <?php while ($data = $sql->fetch_array()) : $c++; $a++; ?>
        <div class="col-md-4 col-sm-6 col-xs-6">
            <div class="panel panel-success">
                <div class="panel-heading" align="center">
                    <a href="?page=detail_gauge_daya&id=<?= $data['ID_SENSOR']; ?>" class="btn btn-warning" >
                        <i class="fa fa-dashboard"></i> <span id="daya_sensor<?= $a; ?>"><?= " Phase ". $c; ?> </span>
                    </a>
                </div>
                <div class="panel-body">
                    <script type="text/javascript">var timeTicket<?= $a; ?>;</script>
                    <div id="daya<?= $a; ?>" style="height:200px;"></div>
                </div>
            </div>
        </div>
        <?php endwhile ?>
    </div>
</div>
<?php endwhile ?>

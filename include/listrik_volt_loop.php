<?php
$sql1 = $konek->query("
    SELECT
        DISTINCT sensor.POSISIDETAIL,
        sensor.NAMALOKASI
    FROM sensor
    WHERE
        left(sensor.PARAMETER,7)='Voltage'
        AND POSISIDETAIL='$id'
");

$c_list = ['', '1_2', '2_3', '3_1', '1_N', '2_N', '3_N'];
?>

<?php while($data1=$sql1->fetch_array()) : ?>

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
        left(sensor.PARAMETER,7)='Voltage'
        AND sensor.POSISIDETAIL='$posisi'
    GROUP BY
        sensor.ID_SENSOR,
        sensor.PARAMETER
");
?>

<div class="col-md-12">
    <div class="alert alert-success">
        <h3 class="text-center panel-title">VOLTAGE <?= strtoupper($posisi); ?> - <?= strtoupper($nl) ?></h3>
    </div>
    <div class="row">
        <?php while($data=$sql->fetch_array()) : $c++; $a++; ?>
        <div class="col-md-2 col-sm-6 col-xs-6">
            <div class="panel panel-success">
                <div class="panel-heading text-center">
                     <a href="?page=detail_gauge_volt&id=<?= $data['ID_SENSOR']; ?>" class="btn btn-warning">
                         <i class="fa fa-tachometer"></i> <?= "Voltage  ". $c_list[$c]; ?>
                     </a>
                </div>
                <div class="panel-body">
                    <script type="text/javascript">var timeTicket<?= $a; ?>;</script>
                    <div id="voltage<?= $a; ?>" style="height:200px;"></div>
                </div>
            </div>
        </div>
        <?php endwhile ?>
    </div>
</div>
<?php endwhile ?>

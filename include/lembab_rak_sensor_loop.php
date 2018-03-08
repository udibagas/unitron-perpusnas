<?php

$jumlah = 12;

$sql = $konek->query("
    SELECT
        sensor.ID_SENSOR,
        sensor.KODEALAT,
        AVG(trans5.nilai) rata
    FROM sensor
    INNER JOIN
        trans5 ON trans5.ID_SENSOR = sensor.ID_SENSOR
    WHERE
        sensor.PARAMETER='Lembab'
        AND LEFT(sensor.POSISIDETAIL,3)='RAK'
        AND sensor.NAMALOKASI='$id'
    GROUP BY sensor.ID_SENSOR
");

?>

<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="alert alert-success">
        <h3 class="text-center panel-title">LEMBAB RAK</h3>
    </div>
    <div class="row">
        <?php while ($data = $sql->fetch_array()) : $a++; ?>
        <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="panel panel-success">
                <div class="panel-heading text-center">
                    <a href="?page=detail_gauge_sensor&id=<?= $data['ID_SENSOR']; ?>">
                        <p id="lembab_sensor_rak<?= $a; ?>"><?= $data['KODEALAT']; ?></p>
                    </a>
                </div>
                <div class="panel-body">
                    <script type="text/javascript">var timeTicket<?= $a; ?>;</script>
                    <div id="lembab<?= $a; ?>" style="height:180px;"></div>
                </div>
            </div>
        </div>
        <?php endwhile ?>
    </div>
</div>

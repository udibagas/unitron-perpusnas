<?php

// $jumlah = 12;

$sql = $konek->query("
    SELECT
        trans5.id,
        trans5.ID_SENSOR,
        sensor.NAMALOKASI,
        sensor.KODEALAT,
        sensor.NILAIMIN,
        sensor.NILAIMAX,
        trans5.nilai
    FROM  trans5
    INNER JOIN sensor  ON trans5.ID_SENSOR = sensor.ID_SENSOR
    WHERE
        sensor.PARAMETER='Lembab'
        AND sensor.POSISIDETAIL='Dalam Ruang'
        AND sensor.NAMALOKASI='$id'
        AND  trans5.id IN (SELECT MAX(id) AS id FROM trans5  GROUP BY ID_SENSOR)
    GROUP BY trans5.ID_SENSOR
");

?>

<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="alert alert-success">
        <h3 class="text-center panel-title">Lembab Sensor <?= $id; ?></h3>
    </div>

    <div class="row">
        <?php $a = 12; while ($data = $sql->fetch_array()) : $a++; ?>
        <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="panel panel-success">
                <div class="panel-heading text-center">
                    <a href="?page=detail_gauge_sensor&id=<?= $data['ID_SENSOR']; ?>" class="btn btn-warning">
                        <i class="fa fa-dashboard"></i>
                        <span id="lembab_sensor<?= $a; ?>">
                            <?= $data['KODEALAT']; ?>
                        </span>
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

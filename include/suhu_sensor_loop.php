<?php

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
        sensor.PARAMETER = 'Suhu'
        AND sensor.POSISIDETAIL = 'Dalam Ruang'
        AND sensor.NAMALOKASI = '$id'
        AND  trans5.id IN (SELECT MAX(id)AS id FROM trans5  GROUP BY ID_SENSOR)
    GROUP BY trans5.ID_SENSOR
");

?>

<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="alert alert-success">
        <h3 class="text-center panel-title">Suhu Sensor <?= $id; ?></h3>
    </div>

    <div class="row">
        <?php $b = 11; while ($data = $sql->fetch_array()) : $b++; ?>
        <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="panel panel-success">
                <div class="panel-heading text-center">
                    <a href="?page=detail_gauge_sensor&id=<?= $data['ID_SENSOR']; ?>" class="btn btn-warning">
                        <i class="fa fa-dashboard"></i>
                        <span id="suhu_sensor<?= $b; ?>">
                            <?= $data['KODEALAT']; ?>
                        </span>
                    </a>
                </div>
                <div class="panel-body">
                    <script type="text/javascript">var timeTicket<?= $b; ?>;</script>
                    <div id="suhu<?= $b; ?>" style="height:180px;"></div>
                </div>
            </div>
        </div>
        <?php endwhile ?>
    </div>
</div>

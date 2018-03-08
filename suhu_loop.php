<?php
$jumlah = 12;

$sql = $konek->query("
    SELECT
        sensor.NAMALOKASI,
        AVG(trans5.nilai) rata
    FROM sensor
    INNER JOIN trans5 ON trans5.ID_SENSOR = sensor.ID_SENSOR
    WHERE sensor.PARAMETER='Suhu'
    GROUP BY sensor.NAMALOKASI
");

?>

<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="text-center panel-title">SUHU RUANGAN</h3>
    </div>

    <?php $a = 0; while($data=$sql->fetch_array()) : $a++; ?>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="panel panel-success">
                    <div class="panel-heading" align="center">
                        <a href="detail_gauge.php" class="btn btn-success btn-sm" ><i class="fa fa-tachometer"></i> <?php echo $data['NAMALOKASI']; ?></a>
                        <div class="clearfix"></div>
                    </div>
                    <script type="text/javascript">var timeTicket<?php echo $a; ?>;</script>
                    <div id="suhu<?php echo $a; ?>" style="height:200px;border:1px solid #ccc;"></div>
                </div>
            </div>
        </div>
    </div>
    <?php endwhile ?>
</div>

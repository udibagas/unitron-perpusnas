<?php

$jumlah=12;

$sql = $konek->query("SELECT sensor.ID_SENSOR,sensor.KODEALAT,AVG(trans5.nilai) rata FROM sensor INNER JOIN trans5 ON trans5.ID_SENSOR = sensor.ID_SENSOR WHERE sensor.PARAMETER='Suhu' AND LEFT(sensor.POSISIDETAIL,3)='RAK' AND sensor.NAMALOKASI='$id' GROUP BY sensor.ID_SENSOR");

?>

<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="alert alert-success">
        <h3 class="text-center panel-title">SUHU RAK</h3>
    </div>
    <div class="row">
        <?php while ($data = $sql->fetch_array()) : $a++; ?>
        <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="panel panel-success">
                <div class="panel-heading" align="center">
                    <a href="?page=detail_gauge&id=<?php echo $data['ID_SENSOR']; ?>">
                        <p id="suhu_sensor_rak<?php echo $a; ?>"><?php echo $data['KODEALAT']; ?>
                    </a>
                </div>
                <div class="panel-body">
                    <script type="text/javascript">var timeTicket<?php echo $a; ?>;</script>
                    <div id="suhu<?php echo $a; ?>" style="height:180px;"></div>
                </div>
            </div>
        </div>
        <?php endwhile ?>
    </div>
</div>

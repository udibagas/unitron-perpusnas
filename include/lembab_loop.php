<?php
$jumlah=12;
$sql = $konek->query("
    SELECT
        sensor.NAMALOKASI,
        AVG(sensor.NILAIMIN) as NILAIMIN,
        AVG(sensor.NILAIMAX) as NILAIMAX
    FROM sensor
    WHERE
        sensor.PARAMETER='Lembab'
        AND (sensor.POSISIDETAIL='Dalam Ruang' OR sensor.POSISIDETAIL='BAWAHCEILING')
    GROUP BY sensor.NAMALOKASI
");
?>

<div class="alert alert-success">
    <div class="text-center" style="font-size:20px;">LEMBAB RATA-RATA RUANGAN</div>
</div>
<div class="row">
    <?php while ($data=$sql->fetch_array()) : $a++; ?>
    <div class="col-md-4 col-sm-6 col-xs-6">
        <div class="panel panel-success">
            <div class="panel-heading text-center">
                <a href="?page=lingkungan&id=<?php echo $data['NAMALOKASI']; ?>" class="btn btn-warning">
                    <i class="fa fa-dashboard"></i> 
                    <span id="lembab_lok<?php echo $a; ?>" class="">
                        <?php echo $data['NAMALOKASI']; ?>
                    </span>
                </a>
            </div>
            <div class="panel-body">
                <script type="text/javascript">var timeTicket<?php echo $a; ?>;</script>
                <div id="lembab<?php echo $a; ?>" style="height:180px;"></div>
            </div>
        </div>
    </div>
    <?php endwhile ?>
</div>

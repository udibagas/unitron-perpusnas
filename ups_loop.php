<div class="clearfix"> </div>
<div class="row">
<?php

$sql2 = $konek->query("SELECT DISTINCT STATUSALAT FROM sensor WHERE STATUSALAT<>'' ORDER BY STATUSALAT ASC");
while($data2=$sql2->fetch_array()){
$stat=$data2['STATUSALAT'];
?>

<div class="col-md-6 col-sm-12 col-xs-12">


<?php

$sql1 = $konek->query("SELECT DISTINCT sensor.POSISIDETAIL,sensor.NAMALOKASI FROM sensor WHERE left(sensor.PARAMETER,7)='UPS_Cur' AND sensor.STATUSALAT='$stat'");
while($data1=$sql1->fetch_array()){
$posisi = $data1['POSISIDETAIL'];
$nl = $data1['NAMALOKASI'];
?>

<div class="abcdefg">
<div class="panel panel-success">
<div class="panel-heading bg-blue">
<h4 align="center">Percent Load <?php echo $posisi; ?> - <?php echo $nl ?></h4>
<div class="clearfix"></div>
</div>


<div class="col-md-12 col-sm-6 col-xs-12">
<div class="panel panel-success">
<div class="ui-progress-bar" id="progress_bar_ups<?php echo $data1['POSISIDETAIL']; ?>">
<div class="ui-progress" id='bar_ups<?php echo $data1['POSISIDETAIL']; ?>' style="width: 100%;color:white;text-align: center;height: 30px;font-size: 20px;">

<p align="center">
<b class="value">0 A</b>
</p>

</div>
</div>
</div>
</div>

<?php
;
$sql = $konek->query("SELECT sensor.ID_SENSOR, sensor.NAMALOKASI,sensor.PARAMETER,sensor.POSISIDETAIL FROM sensor
WHERE left(sensor.PARAMETER,7)='UPS_Cur' AND sensor.POSISIDETAIL='$posisi' AND sensor.STATUSALAT='$stat'
GROUP BY sensor.ID_SENSOR,sensor.PARAMETER LIMIT 3");

//for($a=1;$a<=$jumlah;$a++){
$c = 0;
while($data=$sql->fetch_array()){
$c++;
$a++;
?>

<div class="col-md-4 col-sm-6 col-xs-6">
<div class="panel panel-success">
<div class="panel-heading" align="center">
<a href="?page=detail_gauge&id=<?php echo $data['ID_SENSOR']; ?>" ><p id="daya_sensor_cur<?php echo $a; ?>" class=""><i class="fa fa-tachometer"></i><?php echo " Phase ". $c; ?> </p></a>

<div class="clearfix"></div>

</div>



<script type="text/javascript">var timeTicket<?php echo $a; ?>;</script>
<div id="current<?php echo $a; ?>" style="height:200px;border:1px solid #ccc;"></div>



</div>
</div>

<?php } ?>



</div>
</div>
<?php } ?>

</div>
<?php } ?>
</div>

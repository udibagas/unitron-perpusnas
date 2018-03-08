    <?php

    $sql1 = $konek->query("SELECT DISTINCT sensor.POSISIDETAIL,sensor.NAMALOKASI FROM sensor WHERE left(sensor.PARAMETER,6)='Active'");
    while($data1=$sql1->fetch_array()){
        $posisi = $data1['POSISIDETAIL'];
        $nl = $data1['NAMALOKASI'];
?>

<div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="panel panel-success">
                                <div class="panel-heading bg-blue">
                                    <h4 align="center">DAYA PANEL <?php echo $posisi; ?>  <?php echo $nl ?></h4>
                                    <div class="clearfix"></div>
                                </div>

    <?php
    ;
    $sql = $konek->query("SELECT sensor.ID_SENSOR,
sensor.NAMALOKASI,
sensor.PARAMETER,
sensor.POSISIDETAIL
FROM
sensor
WHERE left(sensor.PARAMETER,6)='Active' AND sensor.POSISIDETAIL='$posisi'
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
                                     <a href="?page=detail_gauge_daya&id=<?php echo $data['ID_SENSOR']; ?>" ><p id="daya_lok<?php echo $a; ?>" class=""><i class="fa fa-tachometer"></i> <?php echo " Phase ". $c; ?> </p></a>

                                    <div class="clearfix"></div>

                                </div>



                                   <script type="text/javascript">var timeTicket<?php echo $a; ?>;</script>
<div id="daya<?php echo $a; ?>" style="height:180px;border:1px solid #ccc;"></div>



                            </div>
                        </div>

                        <?php } ?>



            </div>
        </div>
         <?php } ?>

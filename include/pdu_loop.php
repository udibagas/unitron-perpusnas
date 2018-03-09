    <?php

    $sql1 = $konek->query("SELECT sensor.ID_SENSOR,sensor.NAMALOKASI,sensor.POSISIDETAIL,COUNT(sensor.POSISIDETAIL) as jum FROM sensor
 WHERE sensor.PARAMETER='Arus' GROUP BY sensor.POSISIDETAIL ");
    while($data1=$sql1->fetch_array()){
        $posisi = $data1['POSISIDETAIL'];
        $nl = $data1['NAMALOKASI'];
?>

<div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h4 align="center">DAYA PANEL <?php echo $posisi; ?>  <?php echo $nl ?></h4>
                                    <div class="clearfix"></div>
                                </div>


<div class="col-md-12 col-sm-6 col-xs-12">
                            <div class="panel panel-success">
                                    <div class="ui-progress-bar" id="progress_bar_pdu<?php echo $data1['POSISIDETAIL']; ?>">
                                    <div class="ui-progress" id='bar_pdu<?php echo $data1['POSISIDETAIL']; ?>' style="width: 100%;color:white;text-align: center;height: 30px;font-size: 20px;">

                                       <p align="center">
                                        <b class="value">0 W</b>
                                        </p>

                                    </div>
                                  </div>
                                </div>
</div>

    <?php
    ;
    $sql = $konek->query("SELECT sensor.ID_SENSOR,
sensor.NAMALOKASI,
sensor.PARAMETER,
sensor.POSISIDETAIL
FROM
sensor
WHERE sensor.PARAMETER='Arus' AND sensor.POSISIDETAIL='$posisi'
GROUP BY sensor.ID_SENSOR,sensor.PARAMETER LIMIT 3");

    //for($a=1;$a<=$jumlah;$a++){
    $c = 0;
    while($data=$sql->fetch_array()){
        $c++;
        $a++;
        ?>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="panel panel-success">
                                <div class="panel-heading" align="center">
                                     <a href="?page=detail_gauge_pdu&id=<?php echo $data['ID_SENSOR']; ?>" ><p id="pdu_lok<?php echo $a; ?>" class=""><i class="fa fa-tachometer"></i> <?php echo " Sensor ". $c; ?> </p></a>

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

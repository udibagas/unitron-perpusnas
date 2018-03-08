<div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h3 align="center">LEMBAB RAK</h3>

                                    <div class="clearfix"></div>

                                </div>

    <?php

$sql = $konek->query("SELECT sensor.ID_SENSOR,
sensor.POSISIDETAIL
FROM
sensor
WHERE sensor.PARAMETER='Lembab' AND LEFT(sensor.POSISIDETAIL,3)='RAK'
GROUP BY sensor.POSISIDETAIL");

    //for($a=1;$a<=$jumlah;$a++){

    while($data=$sql->fetch_array()){
        $a++;

?>

                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="panel panel-success">
                                <div class="panel-heading" align="center">
                                     <a href="?page=detail_gauge_rak&id=<?php echo $data['POSISIDETAIL']; ?>&tipe=lembab"><p id="lembab_rak<?php echo $a; ?>" class=""><i class="fa fa-tachometer"></i> <?php echo $data['POSISIDETAIL']; ?></p></a>
                                    <div class="clearfix"></div>
                                </div>
                         <script type="text/javascript">var timeTicket<?php echo $a; ?>;</script>
                                   <div id="lembab<?php echo $a; ?>" style="height:180px;border:1px solid #ccc;"></div>
                      </div>
                        </div>

 <?php } ?>

            </div>
        </div>

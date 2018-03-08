
    <!--
    #####################################################################
    #   Author : Andri Kurnia Putra                                     #
    #   Release: 20-3-2016                                              #
    #   Judul  : Ajax Grafik with Echart                                #
    #   Powered: Echart                                                 #
    #####################################################################
     -->

<div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h3 align="center">SUHU PAC</h3>

                                    <div class="clearfix"></div>

                                </div>

    <?php
    $jumlah=12;
    $sql = $konek->query("SELECT sensor.ID_SENSOR,
sensor.POSISIDETAIL,AVG(sensor.NILAIMIN) as NILAIMIN,AVG(sensor.NILAIMAX) as NILAIMAX FROM
sensor
WHERE sensor.PARAMETER='PAC_suhu' GROUP BY sensor.ID_SENSOR ");

    while($data=$sql->fetch_array()){
        $a++;

?>

                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="panel panel-success">
                                <div class="panel-heading" align="center">
                                     <a href="?page=detail_gauge_pac&id=<?php echo $data['ID_SENSOR']; ?>&tipe=PAC_Suhu" ><p id="suhu_rak<?php echo $a; ?>" class=""><i class="fa fa-tachometer"></i> <?php echo $data['POSISIDETAIL']; ?></p></a>

                                    <div class="clearfix"></div>

                                </div>



                                   <script type="text/javascript">var timeTicket<?php echo $a; ?>;</script>
                                <div id="suhu_PAC<?php echo $a; ?>" style="height:180px;border:1px solid #ccc;">NO DATA</div>



                            </div>
                        </div>

 <?php } ?>

            </div>
        </div>

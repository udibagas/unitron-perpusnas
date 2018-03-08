<?php $sql2 = $konek->query("SELECT DISTINCT STATUSALAT FROM sensor WHERE STATUSALAT <> '' ORDER BY STATUSALAT ASC"); ?>
<?php while ($data2=$sql2->fetch_array()) : $stat = $data2['STATUSALAT']; ?>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <?php
        $sql1 = $konek->query("SELECT DISTINCT sensor.POSISIDETAIL,sensor.NAMALOKASI FROM sensor WHERE left(sensor.PARAMETER,6) = 'Active' AND sensor.STATUSALAT='$stat'");
        ?>

        <?php while ($data1=$sql1->fetch_array()) : $posisi = $data1['POSISIDETAIL']; $nl = $data1['NAMALOKASI']; ?>
            <div class="alert alert-success">
                <div class="text-center" style="font-size:20px;">DAYA PANEL <?php echo $posisi; ?>  <?php echo $nl ?></div>
            </div>

            <div class="panel panel-success">
                <div class="panel-body">
                    <p style="font-size: 25px;" class="text-center">
                        <b  class="value" id="value<?php echo $data1['POSISIDETAIL']; ?>">0 KW</b>
                    </p>
                    <div class="ui-progress-bar" id="progress_bar<?php echo $data1['POSISIDETAIL']; ?>">
                        <div class="ui-progress" id='bar<?php echo $data1['POSISIDETAIL']; ?>' style="width: 0%;color:white;">
                        </div>
                    </div>
                </div>
            </div>

            <?php
            $sql = $konek->query("
                SELECT sensor.ID_SENSOR,
                    sensor.NAMALOKASI,
                    sensor.PARAMETER,
                    sensor.POSISIDETAIL
                FROM sensor
                WHERE
                    left(sensor.PARAMETER,6)='Active'
                    AND sensor.POSISIDETAIL='$posisi'
                    AND sensor.STATUSALAT='$stat'
                GROUP BY
                    sensor.ID_SENSOR,
                    sensor.PARAMETER
                LIMIT 3
            ");
            ?>
            <div class="row">
                <?php $c = 0; while ($data=$sql->fetch_array()) : $c++; $a++; ?>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                        <div class="panel panel-success">
                            <div class="panel-heading text-center">
                                <a href="?page=detail_gauge_daya&id=<?php echo $data['ID_SENSOR']; ?>" class="btn btn-warning">
                                    <i class="fa fa-dashboard"></i>
                                    <span id="daya_lok<?php echo $a; ?>">
                                        <?php echo " Phase ". $c; ?>
                                    </span>
                                </a>
                            </div>
                            <div class="panel-body">
                                <script type="text/javascript">var timeTicket<?php echo $a; ?>;</script>
                                <div id="daya<?php echo $a; ?>" style="height:180px;"></div>
                            </div>
                        </div>
                    </div>
                <?php endwhile ?>
            </div>
        <?php endwhile ?>
    </div>
<?php endwhile ?>

<?php

    @session_start();
    if(isset($_SESSION['username'])==false)
    {
        echo "<meta http-equiv='refresh' content='0;URL=menu_login.php' />";
    }

?>
<?php
 $id = mysqli_real_escape_string($konek, $_GET['id']);

 $tipe = mysqli_real_escape_string($konek, $_GET['tipe']);

 $sql=$konek->query("SELECT sensor.ID_SENSOR,sensor.PETA,sensor.SOP, AVG(sensor.NILAIMIN) as NILAIMIN,AVG(sensor.NILAIMAX) as NILAIMAX,sensor.NAMALOKASI,sensor.PARAMETER,sensor.POSISIDETAIL,AVG(trans5.nilai) as nilai,MIN(trans5.nilai) as min,MAX(trans5.nilai) as max,sensor.NILAIMIN,sensor.NILAIMAX,sensor.NAMALOKASI,sensor.KODEALAT FROM
trans5
INNER JOIN sensor ON sensor.ID_SENSOR = trans5.ID_SENSOR WHERE sensor.NAMALOKASI='$id' AND sensor.PARAMETER='Lembab'  group by sensor.NAMALOKASI");

 $data = $sql->fetch_array();

  $nilai = $data['nilai'];
  $nilai = ($nilai/40)*100;

  $nilai_max = $data['max'];
  $nilai_max = ($nilai_max/40)*100;

  $nilai_min = $data['min'];
  $nilai_min = ($nilai_min/40)*100;

  $max = $data['NILAIMAX'];
  $min = $data['NILAIMIN'];

 $nilai_bawah = $min/40;
        $nilai_atas = ($max+1)/40;
        $nilai_bawah2 = ($min+5)/40;
        $nilai_atas2 = ($max-5)/40;


        $nilai_bawah = substr($nilai_bawah,0,4);
         $nilai_atas = substr($nilai_atas,0,4);
          $nilai_bawah2 = substr($nilai_bawah2,0,4);
           $nilai_atas2 = substr($nilai_atas2,0,4);

?>
            <!-- page content -->


                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Ikhtisar
                    <small>
                        Menu
                    </small>
                </h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">



                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h2><?php echo $data['NAMALOKASI']; ?></h2>

                                    <div class="clearfix"></div>
                                </div>

 <div class="panel-body">
 <script type="text/javascript">var timeTicket<?php echo $data['ID_SENSOR']; ?>;</script>
<div id="main<?php echo $data['ID_SENSOR']; ?>" style="height:400px;border:1px solid #ccc;">
</div>
 </div>
                            </div>
                        </div>



 <div class="col-md-4 col-sm-6 col-xs-12 bg-white">
                                <div class="panel-heading">
                                    <h2>Detail Sensor</h2>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-6">
                                    <div>

                                        <p>Posisi : <b><?php echo $data['NAMALOKASI']; ?></b></p>
                                        <p>Detail : <b><?php echo $data['POSISIDETAIL']; ?></b></p>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-6">
                                    <div>
                                        <p>Suhu Terakhir : <b id="nilai_utama"><?php echo $data['nilai']; ?></b> <?php
                    if ($data['PARAMETER']=='Suhu'){
                        echo "C";
                    }elseif($data['PARAMETER']=='Lembab'){
                        echo "%";
                    }

                 ?></p>
                                        <div class="">
                                            <div class="progress progress_sm" style="width: 76%;">
                                                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $nilai; ?>"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <p>MAX : <b><?php echo $data['max']; ?></b> <?php
                    if ($data['PARAMETER']=='Suhu'){
                        echo "C";
                    }elseif($data['PARAMETER']=='Lembab'){
                        echo "%";
                    }

                 ?> </p>
                                        <div class="">
                                            <div class="progress progress_sm" style="width: 76%;">
                                                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $nilai_max; ?>"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-6">
                                    <div>
                                        <p>MIN : <b><?php echo $data['min']; ?></b> <?php
                    if ($data['PARAMETER']=='Suhu'){
                        echo "C";
                    }elseif($data['PARAMETER']=='Lembab'){
                        echo "%";
                    }

                 ?></p>
                                        <div class="">
                                            <div class="progress progress_sm" style="width: 76%;">
                                                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $nilai_min;?>"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-6">
                                    <div>
                                        <h3 id="kondisi1">Kondisi   : Normal </h3>

                                          <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target=".bs-example-modal-sm">CCTV Tampil</button> -->

                                    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">CCTV</h4>
                                            </div>


                                            <div class="modal-body">

                                                <h4><?php echo $data['NAMALOKASI']; ?>
                                                </h4>

                                                 <img class="marker-cctv modal-cctv-img" src="http://114.110.17.6:8923/JpegStream.cgi?username=bit&password=guest&channel=1image.jpg?">

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                    </div>



                                </div>

                            </div>



                <div class="col-md-4">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h2>Penjelasan Notifikasi <small></small></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>

                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">

                                <div class="alert alert-info alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Normal </strong> Status.
                                </div>

                                <div class="alert alert-warning alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Warning </strong> Status.
                                </div>
                                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                   <strong>Alarm </strong> Status.
                                </div>

                            </div>
                             <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Tampilkan SOP</button>

                             <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">SOP</h4>
                                            </div>


                                            <div class="modal-body">

                                                <h4>Standart Prosedur Operasional</h4>
                                              <?php
                                                echo $data['SOP'];
                                                    ?>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>

                                            </div>

                                        </div>
                                    </div>
                                </div>


                    </div>

                    </div>
                    <div class="clearfix"></div>

                       <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="panel panel-success">
                                <div align="center" class="panel-heading">

                                   <img src="images/peta/<?php echo $data['PETA'] ?>" width="550" height="350" />

                                    </div></div>
                                    </div>

                    <div class="col-md-8 col-sm-6 col-xs-12">
                            <div class="panel panel-success">
                                <div class="panel-heading">

                                    <div id="tren1" style="height:350px;"></div>


                                    </div></div>
                                    </div>





<!--
<div class="abcdefg">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h2>Rekaman <small>Sensor Suhu #1</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Settings 1</a>
                                                </li>
                                                <li><a href="#">Settings 2</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th>No</th>
                                                <th>Tanggal & Jam</th>
                                                <th>Rekaman Peringatan</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th><button type="button" class="btn btn-warning">Alarm</button></th>
                                                <th scope="row">1</th>
                                                <td>22-01-2016 12:11:05</td>
                                                <td>Alarm di Ruang Server 1 -> Rak 1</td>
                                                <td>Suhu Melebihi Batas Maksimal</td>
                                            </tr>
                                            <tr>
                                                <th><button type="button" class="btn btn-warning">Alarm</button></th>
                                                <th scope="row">2</th>
                                                <td>14-01-2016 08:31:08</td>
                                                <td>Alarm di Ruang Server 2 -> Rak 2</td>
                                                <td>Suhu Melebihi Batas Minimal</td>
                                            </tr>
                                             <tr>
                                                <th><button type="button" class="btn btn-warning">Alarm</button></th>
                                                <th scope="row">3</th>
                                                <td>01-01-2016 13:41:05</td>
                                                <td>Alarm di Ruang Network</td>
                                                <td>Suhu Melebihi Batas Maksimal</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        -->
                </div>

            </div>
            <!-- /page content -->
        </div>

    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>




    <!-- echart -->
    <script src="js/echart/echarts-all.js"></script>
    <script src="js/echart/green.js"></script>





    <script type="text/javascript">
    var myChart<?php echo $data['ID_SENSOR']; ?> = echarts.init(document.getElementById('main<?php echo $data['ID_SENSOR']; ?>'));
       option<?php echo $data['ID_SENSOR']; ?> = {
    tooltip : {
        formatter: "{a} <br/>{b} : {c} C"
    },
    series : [
        {
            name:'Meteran',
            type:'gauge',
            min:0,
            max:40,
            splitNumber:4,
            axisLine: {
                lineStyle: {
                    color: [[<?php echo $nilai_bawah; ?>, '#ff4500'],[<?php echo $nilai_bawah2; ?>,'#f9f614'],[<?php echo $nilai_atas2; ?>, '#48b'],[<?php echo $nilai_atas; ?>, '#f9f614'],[1, '#ff4500']],
                    width: 4
                }
            },
            axisTick: {
                splitNumber: 10,
                length :12,
                lineStyle: {
                    color: 'auto'
                }
            },
            axisLabel: {
                textStyle: {
                    color: 'auto'
                }
            },
            splitLine: {
                show: true,
                length :15,
                lineStyle: {
                    color: 'auto'
                }
            },
            pointer : {
                width : 5
            },
            title : {
                show : true,
                offsetCenter: [0, '-50%'],
                textStyle: {
                    fontWeight: 'bolder'
                }
            },
            detail : {
                formatter:'{value} C',
                textStyle: {
                    color: 'auto',
                    fontSize:'20'
                }
            },
            data:[{value: 50, name: ''}]
        }
    ]
};


          clearInterval(timeTicket<?php echo $data['ID_SENSOR']; ?>);
            timeTicket<?php echo $data['ID_SENSOR']; ?> = setIntervalAndExecute(function (){
              $.getJSON("less/jsensor_lembab_sensor.php?id=<?php echo $data['ID_SENSOR']; ?>", function(json) {
                 if(json===null){
                      var nilai = 0;

                  }else{
                  var nilai = json['nilai'];
                  var min = json['NILAIMIN'];
                  var max = json['NILAIMAX'];
                  min = parseFloat(min.substr(0,4));
                  max = parseFloat(max.substr(0,4));
                  nilai = parseFloat(nilai.substr(0,4));

                  document.getElementById("nilai_utama").innerHTML=nilai;



                   if(nilai>max || nilai<min){
                        document.getElementById("kondisi1").innerHTML="Kondisi   : Alarm";
                  }else{
                        document.getElementById("kondisi1").innerHTML="Kondisi   : Normal";
                  }
              }


                    if(nilai!=0){
                  option<?php echo $data['ID_SENSOR'];; ?>.series[0].data[0].value = nilai;
                  }else{
                  option<?php echo $data['ID_SENSOR'];; ?>.series[0].data[0].value = nilai;
                  option<?php echo $data['ID_SENSOR'];; ?>.series[0].data[0].name = "NO Data ";

                  }

                  myChart<?php echo $data['ID_SENSOR']; ?>.setOption(option<?php echo $data['ID_SENSOR']; ?>,true);
              });

              //option<?php //echo $b; ?>.series[0].data[0].value = nilai;

},5000);





    </script>

    <?php
$k=$konek->query("SELECT
trans1hari.tanggal,
AVG(trans1hari.rata) as rata,
sensor.PARAMETER
FROM
trans1hari
INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
WHERE sensor.PARAMETER='Suhu' AND sensor.NAMALOKASI='$id' GROUP BY tanggal");

$k1=$konek->query("SELECT
trans1hari.tanggal,
AVG(trans1hari.rata) as rata,
sensor.PARAMETER
FROM
trans1hari
INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
WHERE sensor.PARAMETER='Lembab' AND sensor.NAMALOKASI='$id' GROUP BY tanggal");

$k2=$konek->query("SELECT
trans1hari.tanggal,
AVG((trans1hari.rata)/1000) as rata,
sensor.PARAMETER
FROM
trans1hari
INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
WHERE LEFT(sensor.KODEALAT,7)='Listrik' AND sensor.NAMALOKASI='$id' AND LEFT(sensor.PARAMETER,6)='Active' GROUP BY tanggal");


$q=$konek->query("SELECT * FROM trans1hari GROUP BY tanggal");
    ?>

    <script>
        var trenChart1 = echarts.init(document.getElementById('tren1'), theme);
        trenChart1.setOption({
            title: {
                text: 'Trend',
                subtext: 'Trend Mode'
            },
            //theme : theme,
    tooltip : {
        trigger: 'axis'
    },
       tooltip: {
       trigger: "item",
       formatter: "{a} <br/>{b} : {c}"
   },
   legend: {
       x: 'center',
       data: ["SUHU (C)","LEMBAB (%)","LISTRIK (KW)"]
   },
       dataZoom: {
        show: true,
        start : 70
    },
   xAxis: [
       {
           type: "category",
           name: "x",
           splitLine: {show: true},
           data: [<?php while($r=$q->fetch_array()){ echo "'".$r["tanggal"]."',";}?>]
       }
   ],
   yAxis: [
       {
           type: "log",
           name: "y"
       }
   ],
    toolbox: {
        show : true,
        feature : {
            dataZoom : {show: true},
            magicType : {show: true, type: ['line', 'bar']},
            saveAsImage : {show: true}
        }
    },
   calculable: true,
   series: [
       {
           name: "SUHU (C)",
           type: "line",
           data: [<?php while($t=$k->fetch_array()){ echo substr($t["rata"],0,4).",";}?>]

       },
       {
           name: "LEMBAB (%)",
           type: "line",
           data: [<?php while($t1=$k1->fetch_array()){ echo substr($t1["rata"],0,4).",";}?>]

       },
        {
           name: "LISTRIK (KW)",
           type: "line",
           data: [<?php while($t2=$k2->fetch_array()){ echo substr($t2["rata"],0,4).",";}?>]

       }

   ]
});
</script>


</body>

</html>

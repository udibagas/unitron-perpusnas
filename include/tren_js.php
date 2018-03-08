  
        <script type="text/javascript" src="js/moment.min2.js"></script>
    <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>

    <?php
if(isset($_POST['submit'])==false){
  $k=$konek->query("SELECT
  trans1hari.tanggal,
  AVG(trans1hari.rata) as rata,
  sensor.PARAMETER
  FROM
  trans1hari
  INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
  WHERE sensor.PARAMETER='Suhu' GROUP BY tanggal ");

  $k1=$konek->query("SELECT
  trans1hari.tanggal,
  AVG(trans1hari.rata) as rata,
  sensor.PARAMETER
  FROM
  trans1hari
  INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
  WHERE sensor.PARAMETER='Lembab' GROUP BY tanggal ");

  $k2=$konek->query("SELECT
  trans1hari.tanggal,
  AVG((trans1hari.rata)) as rata,
  sensor.PARAMETER
  FROM
  trans1hari
  INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
  WHERE LEFT(sensor.KODEALAT,7)='Listrik' AND LEFT(sensor.PARAMETER,6)='Active' GROUP BY tanggal ");

  $q=$konek->query("SELECT * FROM trans1hari GROUP BY tanggal");
}

else{

     $tgl1 = mysqli_real_escape_string($konek, $_POST['tgl_awal']);
     $tgl2 = mysqli_real_escape_string($konek, $_POST['tgl_akhir']);
                                if($tgl1 != null && $tgl2!= null){
                                  
                                  $tgl1 = date("Y-m-d",strtotime($tgl1));   
                                  $tgl2 = date("Y-m-d",strtotime($tgl2)); 
                                }

  $k=$konek->query("SELECT
  trans1hari.tanggal,
  AVG(trans1hari.rata) as rata,
  sensor.PARAMETER
  FROM
  trans1hari
  INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
  WHERE sensor.PARAMETER='Suhu' AND sensor.NAMALOKASI='$_POST[filter1]' AND trans1hari.tanggal BETWEEN '$tgl1' AND '$tgl2' GROUP BY tanggal ");

  $k1=$konek->query("SELECT
  trans1hari.tanggal,
  AVG(trans1hari.rata) as rata,
  sensor.PARAMETER
  FROM
  trans1hari
  INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
  WHERE sensor.PARAMETER='Lembab' AND sensor.NAMALOKASI='$_POST[filter1]'  AND trans1hari.tanggal BETWEEN '$tgl1' AND '$tgl2' GROUP BY tanggal ");

  $k2=$konek->query("SELECT
  trans1hari.tanggal,
  AVG((trans1hari.rata)) as rata,
  sensor.PARAMETER
  FROM
  trans1hari
  INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
  WHERE LEFT(sensor.KODEALAT,7)='Listrik' AND sensor.NAMALOKASI='$_POST[filter1]'  AND trans1hari.tanggal BETWEEN '$tgl1' AND '$tgl2' AND LEFT(sensor.PARAMETER,6)='Active' GROUP BY tanggal ");

  $q=$konek->query("SELECT tanggal FROM trans1hari WHERE tanggal BETWEEN '$tgl1' AND '$tgl2' GROUP BY tanggal");
  
}


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
        start : 0
    },
   xAxis: [
       {
           type: "category",
           name: "x",
           splitLine: {show: true},
           data: [<?php while($r=$q->fetch_assoc()){ echo "'".$r["tanggal"]."',";}?>]
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

<?php
if(isset($_POST['submit'])==false){
  $k=$konek->query("SELECT
  trans1hari.tanggal,
  AVG(trans1hari.min) as min,
  sensor.PARAMETER
  FROM
  trans1hari
  INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
  WHERE sensor.PARAMETER='Suhu'  GROUP BY tanggal ");

  $k1=$konek->query("SELECT
  trans1hari.tanggal,
  AVG(trans1hari.rata) as rata,
  sensor.PARAMETER
  FROM
  trans1hari
  INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
  WHERE sensor.PARAMETER='Suhu' GROUP BY tanggal ");

  $k2=$konek->query("SELECT
  trans1hari.tanggal,
  AVG(trans1hari.max) as max,
  sensor.PARAMETER
  FROM
  trans1hari
  INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
  WHERE sensor.PARAMETER='Suhu' GROUP BY tanggal");

  $q=$konek->query("SELECT * FROM trans1hari GROUP BY tanggal");
}else{


 $tgl1 = mysqli_real_escape_string($konek, $_POST['tgl_awal']);
     $tgl2 = mysqli_real_escape_string($konek, $_POST['tgl_akhir']);

                                if($tgl1 != null && $tgl2!= null){
                                  
                                  $tgl1 = date("Y-m-d",strtotime($tgl1));   
                                  $tgl2 = date("Y-m-d",strtotime($tgl2)); 
                                }

  $k=$konek->query("SELECT
  trans1hari.tanggal,
  AVG(trans1hari.min) as min,
  sensor.PARAMETER
  FROM
  trans1hari
  INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
  WHERE sensor.PARAMETER='Suhu' AND sensor.NAMALOKASI='$_POST[filter1]' AND trans1hari.tanggal BETWEEN '$tgl1' AND '$tgl2' GROUP BY tanggal ");

  $k1=$konek->query("SELECT
  trans1hari.tanggal,
  AVG(trans1hari.rata) as rata,
  sensor.PARAMETER
  FROM
  trans1hari
  INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
  WHERE sensor.PARAMETER='Suhu' AND sensor.NAMALOKASI='$_POST[filter1]' AND trans1hari.tanggal BETWEEN '$tgl1' AND '$tgl2' GROUP BY tanggal ");

  $k2=$konek->query("SELECT
  trans1hari.tanggal,
  AVG(trans1hari.max) as max,
  sensor.PARAMETER
  FROM
  trans1hari
  INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
  WHERE sensor.PARAMETER='Suhu' AND sensor.NAMALOKASI='$_POST[filter1]' AND trans1hari.tanggal BETWEEN '$tgl1' AND '$tgl2' GROUP BY tanggal ");

   $q=$konek->query("SELECT tanggal FROM trans1hari WHERE tanggal BETWEEN '$tgl1' AND '$tgl2' GROUP BY tanggal");
}
    ?>

      var trenChart2 = echarts.init(document.getElementById('tren2'), theme);
        trenChart2.setOption({
            title: {
                text: 'SUHU',
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
       data: ["MIN","AVG","MAX"]
   },
       dataZoom: {
        show: true,
        start : 0
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
           name: "C"
       }
   ],
    toolbox: {
        show : true,
        feature : {
           
            magicType : {show: true, type: ['line', 'bar']},
            saveAsImage : {show: true}
        }
    },
   calculable: true,
   series: [
       {
           name: "MIN",
           type: "line",
           data: [<?php while($t=$k->fetch_array()){ echo $t["min"].",";}?>]

       },
       {
           name: "AVG",
           type: "line",
           data: [<?php while($t1=$k1->fetch_array()){ echo $t1["rata"].",";}?>]

       },
       {
           name: "MAX",
           type: "line",
           data: [<?php while($t2=$k2->fetch_array()){ echo $t2["max"].",";}?>]

       }

   ]
});

  <?php
if(isset($_POST['submit'])==false){
  $k=$konek->query("SELECT
  trans1hari.tanggal,
  AVG(trans1hari.min) as min,
  sensor.PARAMETER
  FROM
  trans1hari
  INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
  WHERE sensor.PARAMETER='Lembab'  GROUP BY tanggal ");

  $k1=$konek->query("SELECT
  trans1hari.tanggal,
  AVG(trans1hari.rata) as rata,
  sensor.PARAMETER
  FROM
  trans1hari
  INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
  WHERE sensor.PARAMETER='Lembab' GROUP BY tanggal ");

  $k2=$konek->query("SELECT
  trans1hari.tanggal,
  AVG(trans1hari.max) as max,
  sensor.PARAMETER
  FROM
  trans1hari
  INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
  WHERE sensor.PARAMETER='Lembab' GROUP BY tanggal ");

  $q=$konek->query("SELECT * FROM trans1hari GROUP BY tanggal");
}else{


 $tgl1 = mysqli_real_escape_string($konek, $_POST['tgl_awal']);
     $tgl2 = mysqli_real_escape_string($konek, $_POST['tgl_akhir']);
                                if($tgl1 != null && $tgl2!= null){
                                  
                                  $tgl1 = date("Y-m-d",strtotime($tgl1));   
                                  $tgl2 = date("Y-m-d",strtotime($tgl2)); 
                                }

  $k=$konek->query("SELECT
  trans1hari.tanggal,
  AVG(trans1hari.min) as min,
  sensor.PARAMETER
  FROM
  trans1hari
  INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
  WHERE sensor.PARAMETER='Lembab' AND sensor.NAMALOKASI='$_POST[filter1]' AND trans1hari.tanggal BETWEEN '$tgl1' AND '$tgl2' GROUP BY tanggal ");

  $k1=$konek->query("SELECT
  trans1hari.tanggal,
  AVG(trans1hari.rata) as rata,
  sensor.PARAMETER
  FROM
  trans1hari
  INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
  WHERE sensor.PARAMETER='Lembab' AND sensor.NAMALOKASI='$_POST[filter1]' AND trans1hari.tanggal BETWEEN '$tgl1' AND '$tgl2' GROUP BY tanggal ");

  $k2=$konek->query("SELECT
  trans1hari.tanggal,
  AVG(trans1hari.max) as max,
  sensor.PARAMETER
  FROM
  trans1hari
  INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
  WHERE sensor.PARAMETER='Lembab' AND sensor.NAMALOKASI='$_POST[filter1]' AND trans1hari.tanggal BETWEEN '$tgl1' AND '$tgl2' GROUP BY tanggal ");

   $q=$konek->query("SELECT tanggal FROM trans1hari WHERE tanggal BETWEEN '$tgl1' AND '$tgl2' GROUP BY tanggal");
}
    ?>

        var trenChart3 = echarts.init(document.getElementById('tren3'), theme);
        trenChart3.setOption({
            title: {
                text: 'LEMBAB',
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
       data: ["MIN","AVG","MAX"]
   },
       dataZoom: {
        show: true,
        start : 0
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
           name: "%"
       }
   ],
    toolbox: {
        show : true,
        feature : {
          
            magicType : {show: true, type: ['line', 'bar']},
            saveAsImage : {show: true}
        }
    },
   calculable: true,
   series: [
       {
           name: "MIN",
           type: "line",
           data: [<?php while($t=$k->fetch_array()){ echo $t["min"].",";}?>]

       },
       {
           name: "AVG",
           type: "line",
           data: [<?php while($t1=$k1->fetch_array()){ echo $t1["rata"].",";}?>]

       },
       {
           name: "MAX",
           type: "line",
           data: [<?php while($t2=$k2->fetch_array()){ echo $t2["max"].",";}?>]

       }

   ]
});

    <?php
    if(isset($_POST['submit'])==false){
  $k=$konek->query("SELECT
  trans1hari.tanggal,
  AVG(trans1hari.min) as min,
  sensor.PARAMETER
  FROM
  trans1hari
  INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
  WHERE LEFT(sensor.KODEALAT,7)='Listrik' AND LEFT(sensor.PARAMETER,6)='Active' GROUP BY tanggal ");

  $k1=$konek->query("SELECT
  trans1hari.tanggal,
  AVG(trans1hari.rata) as rata,
  sensor.PARAMETER
  FROM
  trans1hari
  INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
  WHERE LEFT(sensor.KODEALAT,7)='Listrik' AND LEFT(sensor.PARAMETER,6)='Active' GROUP BY tanggal ");

  $k2=$konek->query("SELECT
  trans1hari.tanggal,
  AVG(trans1hari.max) as max,
  sensor.PARAMETER
  FROM
  trans1hari
  INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
  WHERE LEFT(sensor.KODEALAT,7)='Listrik' AND LEFT(sensor.PARAMETER,6)='Active' GROUP BY tanggal ");

  $q=$konek->query("SELECT * FROM trans1hari GROUP BY tanggal");

  }else{




 $tgl1 = mysqli_real_escape_string($konek, $_POST['tgl_awal']);
     $tgl2 = mysqli_real_escape_string($konek, $_POST['tgl_akhir']);
                                if($tgl1 != null && $tgl2!= null){
                                  
                                  $tgl1 = date("Y-m-d",strtotime($tgl1));   
                                  $tgl2 = date("Y-m-d",strtotime($tgl2)); 
                                }
 $k=$konek->query("SELECT
  trans1hari.tanggal,
  AVG(trans1hari.min) as min,
  sensor.PARAMETER
  FROM
  trans1hari
  INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
  WHERE LEFT(sensor.KODEALAT,7)='Listrik' AND LEFT(sensor.PARAMETER,6)='Active' AND sensor.NAMALOKASI='$_POST[filter1]' AND trans1hari.tanggal BETWEEN '$tgl1' AND '$tgl2' GROUP BY tanggal ");

  $k1=$konek->query("SELECT
  trans1hari.tanggal,
  AVG(trans1hari.rata) as rata,
  sensor.PARAMETER
  FROM
  trans1hari
  INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
  WHERE LEFT(sensor.KODEALAT,7)='Listrik' AND LEFT(sensor.PARAMETER,6)='Active' AND sensor.NAMALOKASI='$_POST[filter1]' AND trans1hari.tanggal BETWEEN '$tgl1' AND '$tgl2' GROUP BY tanggal ");

  $k2=$konek->query("SELECT
  trans1hari.tanggal,
  AVG(trans1hari.max) as max,
  sensor.PARAMETER
  FROM
  trans1hari
  INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
  WHERE LEFT(sensor.KODEALAT,7)='Listrik' AND LEFT(sensor.PARAMETER,6)='Active' AND sensor.NAMALOKASI='$_POST[filter1]' AND trans1hari.tanggal BETWEEN '$tgl1' AND '$tgl2' GROUP BY tanggal ");

  $q=$konek->query("SELECT tanggal FROM trans1hari WHERE tanggal BETWEEN '$tgl1' AND '$tgl2' GROUP BY tanggal");
}


    ?>


        var trenChart4 = echarts.init(document.getElementById('tren4'), theme);
        trenChart4.setOption({
            title: {
                text: 'DAYA',
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
       data: ["MIN","AVG","MAX"]
   },
       dataZoom: {
        show: true,
        start : 0
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
           name: "W"
       }
   ],
    toolbox: {
        show : true,
        feature : {
           
            magicType : {show: true, type: ['line', 'bar']},
            saveAsImage : {show: true}
        }
    },
   calculable: true,
   series: [
       {
           name: "MIN",
           type: "line",
           data: [<?php while($t=$k->fetch_array()){ echo $t["min"].",";}?>]

       },
       {
           name: "AVG",
           type: "line",
           data: [<?php while($t1=$k1->fetch_array()){ echo $t1["rata"].",";}?>]

       },
       {
           name: "MAX",
           type: "line",
           data: [<?php while($t2=$k2->fetch_array()){ echo $t2["max"].",";}?>]

       }

   ]
});

    </script>

    <script type="text/javascript">

$(document).ready(function() {



         $('#single_cal1').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_2"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });

            $('#single_cal2').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_2"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
} );

        
</script>


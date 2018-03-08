<?php
// $id = mysqli_real_escape_string($konek, $_GET['id']);
$sql = $konek->query("SELECT
trans5.id,trans5.ID_SENSOR,sensor.NAMALOKASI,sensor.KODEALAT,sensor.NILAIMIN,sensor.NILAIMAX,
trans5.nilai FROM  trans5 INNER JOIN sensor  ON trans5.ID_SENSOR = sensor.ID_SENSOR
WHERE sensor.PARAMETER='Suhu' AND sensor.POSISIDETAIL='Dalam Ruang' AND sensor.NAMALOKASI='$id' AND trans5.id IN
( SELECT MAX(id)AS id FROM trans5  GROUP BY ID_SENSOR ) GROUP BY trans5.ID_SENSOR");

    //for($a=1;$a<=$jumlah;$a++){
    $b = 11;
    while ($data=$sql->fetch_array()) {
        $b++;
        $max = $data['NILAIMAX'];
        $min = $data['NILAIMIN'];

         $batas=40;
        if($max>=36){
            $batas=50;
        }if($max>=50){
            $batas=60;
        }if($max>=60){
            $batas=$max+5;
        }if($max<36){
            $batas=40;
        }

        $nilai_bawah = $min/$batas;
        $nilai_atas = ($max+1)/$batas;
        $nilai_bawah2 = ($min+5)/$batas;
        $nilai_atas2 = ($max-5)/$batas;

        $nilai_bawah = substr($nilai_bawah,0,4);
         $nilai_atas = substr($nilai_atas,0,4);
          $nilai_bawah2 = substr($nilai_bawah2,0,4);
           $nilai_atas2 = substr($nilai_atas2,0,4);

?>

    <script type="text/javascript">
    var myChart<?= $b; ?> = echarts.init(document.getElementById('suhu<?= $b; ?>'));
       option<?= $b; ?> = {
    tooltip : {
        formatter: "{a} <br/>{b} : {c} C"
    },
    series : [
        {
            name:'Meteran',
            type:'gauge',
            min:0,
            max:<?= $batas; ?>,
            splitNumber:4,
            axisLine: {
                lineStyle: {
                    color: [[<?= $nilai_bawah; ?>, '#ff4500'],[<?= $nilai_bawah2; ?>,'#f9f614'],[<?= $nilai_atas2; ?>, '#48b'],[<?= $nilai_atas; ?>, '#f9f614'],[1, '#ff4500']],
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

clearInterval(timeTicket<?= $b; ?>);
timeTicket<?= $b; ?> = setIntervalAndExecute(function (){
              $.getJSON("less/jsensor_suhu_sensor.php?id=<?= $data['ID_SENSOR']; ?>", function(json) {

                  if(json===null){
                      var nilai = 0;

                  }else{

                  var nilai = json['nilai'];
                  var min = json['NILAIMIN'];
                  var max = json['NILAIMAX'];
                  min = parseFloat(min.substr(0,4));
                  max = parseFloat(max.substr(0,4));
                  nilai = parseFloat(nilai.substr(0,4));

                  if(nilai>max || nilai<min){
                        document.getElementById("suhu_sensor<?= $b; ?>").className="btn btn-danger btn-xs blink_me";
                  }else{
                        document.getElementById("suhu_sensor<?= $b; ?>").className="";
                  }
                }

                  if(nilai!=0){
                    option<?= $b; ?>.series[0].data[0].value = nilai;
                    option<?= $b; ?>.series[0].data[0].name = "";
                  }else{
                    option<?= $b; ?>.series[0].data[0].value = nilai;
                    option<?= $b; ?>.series[0].data[0].name = "NO Data ";
                  }
                  myChart<?= $b; ?>.setOption(option<?= $b; ?>,true);
                  document.getElementById("suhu_sensor<?= $b; ?>").className="";
              });

},5000);


    </script>

    <?php } ?>

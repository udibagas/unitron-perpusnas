    <?php

    $sql1 = $konek->query("SELECT sensor.ID_SENSOR,sensor.NAMALOKASI,sensor.POSISIDETAIL,COUNT(sensor.POSISIDETAIL) as jum FROM sensor
 WHERE sensor.PARAMETER='Arus' GROUP BY sensor.POSISIDETAIL ");
    while($data1=$sql1->fetch_array()){
        $posisi = $data1['POSISIDETAIL'];
        $nl = $data1['NAMALOKASI'];

$sql = $konek->query("SELECT
sensor.POSISIDETAIL,sensor.ID_SENSOR,
sensor.PARAMETER,
sensor.POSISIDETAIL,AVG(sensor.NILAIMIN) as NILAIMIN,AVG(sensor.NILAIMAX) as NILAIMAX

FROM
sensor WHERE sensor.PARAMETER='Arus' AND sensor.POSISIDETAIL='$posisi'
GROUP BY sensor.ID_SENSOR,sensor.PARAMETER");

    //for($a=1;$a<=$jumlah;$a++){

    while($data=$sql->fetch_array()){
        $b++;
         $max = $data['NILAIMAX'];
        $min = $data['NILAIMIN'];

       $batas=70;

        if($max>=40){
            $batas=55;
        }
        if($max>=50){
            $batas=65;
        }
        if($max>=60){
            $batas=$max+5;
        }
        if($max<=40){
            $batas=50;
        }
        if($max<=25){
            $batas=30;
        }
        if($max<=15){
            $batas=20;
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
    var myChart<?php echo $b; ?> = echarts.init(document.getElementById('daya<?php echo $b; ?>'));
       option<?php echo $b; ?> = {
    tooltip : {
        formatter: "{a} <br/>{b} : {c} W"
    },

    series : [
        {
            name:'Listrik',
            type:'gauge',
            center : ['50%', '50%'],
            radius : [0, '75%'],
            startAngle: 30,
            endAngle : -110,
            min: 0,
            max: <?php echo $batas; ?>,
            precision: 0,
            splitNumber: 2,
            axisLine: {
                show: true,
                lineStyle: {
                     color: [[<?php echo $nilai_atas2; ?>, '#48b'],[<?php echo $nilai_atas; ?>, '#fcb54f'],[1, '#ff4500']],
                    width: 15
                }
            },
            axisTick: {
                show: true,
                splitNumber: 4,
                length :8,
                lineStyle: {
                    color: '#eee',
                    width: 1,
                    type: 'solid'
                }
            },
            axisLabel: {
                show: true,
                offsetCenter: ['-30%', -80],
                textStyle: {
                    color: '#333'
                }
            },
            splitLine: {
                show: true,
                length :10,
                lineStyle: {
                    color: '#eee',
                    width: 2,
                    type: 'solid'
                }
            },
            pointer : {
                length : '80%',
                width : 8,
                color : 'auto'
            },
            title : {
                show : true,
                offsetCenter: ['-25%', -10],
                textStyle: {
                    color: '#333',
                    fontSize : 15
                }
            },
            detail : {
                show : true,
                backgroundColor: 'rgba(0,0,0,0)',
                borderWidth: 0,
                borderColor: '#ccc',
                width: 100,
                height: 40,
                offsetCenter: ['-30%', -80],
                formatter:'{value} KW',
                textStyle: {
                    color: 'black',
                    fontSize : 24
                }
            },
            data:[{value: 50, name: ''}]
        }
    ]
};

clearInterval(timeTicket<?php echo $b; ?>);
timeTicket<?php echo $b; ?> = setIntervalAndExecute(function (){
              $.getJSON("less/jsensor_pdu.php?id=<?php echo $data['ID_SENSOR']; ?>", function(json) {
                 if(json===null){
                      var nilai = 0;

                  }else{
                  var nilai = json['nilai'];
                  var min = json['NILAIMIN'];
                  var max = json['NILAIMAX'];
                  min = parseFloat(min.substr(0,4));
                  max = parseFloat(max.substr(0,4));
                  nilai = parseFloat(nilai.substr(0,4)) * 1000;

                  if(nilai>max || nilai<min){
                        document.getElementById("pdu_lok<?php echo $b; ?>").className="btn btn-danger btn-xs blink_me";
                  }else{
                        document.getElementById("pdu_lok<?php echo $b; ?>").className="";
                  }
                }

                  if(nilai!=0){
                  option<?php echo $b; ?>.series[0].data[0].value = nilai;
                  option<?php echo $b; ?>.series[0].data[0].name = "";
                  }else{
                  option<?php echo $b; ?>.series[0].data[0].value = nilai;
                  option<?php echo $b; ?>.series[0].data[0].name = "NO Data ";
                  document.getElementById("pdu_lok<?php echo $b; ?>").className="";
                  }
                  myChart<?php echo $b; ?>.setOption(option<?php echo $b; ?>,true);
              });

              //option<?php //echo $b; ?>.series[0].data[0].value = nilai;


               $.getJSON("less/jsensor_pdu_total.php?id=<?php echo $data['POSISIDETAIL']; ?>", function(json) {
                 if(json===null){
                      var sum = 0;

                  }else{

                    var sum = json['sum'];
                    var persen = sum/30*100;
                    sum = parseFloat(sum.substr(0,4)) * 1000;


                  document.getElementById("progress_bar_pdu<?php echo $data['POSISIDETAIL']; ?>").className="ui-progress-bar";
                  document.getElementById("bar_pdu<?php echo $data['POSISIDETAIL']; ?>").innerHTML = sum + 'W';
                  //document.getElementById("progress_bar<?php echo $data['POSISIDETAIL']; ?>").style.width=persen+'%';
                }
              });
},5000);


    </script>

    <?php }
    } ?>

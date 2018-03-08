<?php

    $sql = $konek->query("SELECT
sensor.NAMALOKASI,AVG(sensor.NILAIMIN) as NILAIMIN,AVG(sensor.NILAIMAX) as NILAIMAX FROM
sensor
WHERE sensor.PARAMETER='Lembab' AND (sensor.POSISIDETAIL='Dalam Ruang' OR sensor.POSISIDETAIL='BAWAHCEILING')
GROUP BY sensor.NAMALOKASI ");

     while($data=$sql->fetch_array()){
        $b++;
         $max = $data['NILAIMAX'];
        $min = $data['NILAIMIN'];

        $nilai_bawah = $min/100;
        $nilai_atas = ($max+1)/100;
        $nilai_bawah2 = ($min+5)/100;
        $nilai_atas2 = ($max-5)/100;

        $nilai_bawah = substr($nilai_bawah,0,4);
         $nilai_atas = substr($nilai_atas,0,4);
          $nilai_bawah2 = substr($nilai_bawah2,0,4);
           $nilai_atas2 = substr($nilai_atas2,0,4);

?>

    <script type="text/javascript">
    var myChart<?php echo $b; ?> = echarts.init(document.getElementById('lembab<?php echo $b; ?>'));
       option<?php echo $b; ?> = {
    tooltip : {
        formatter: "{a} <br/>{b} : {c} %"
    },
    series : [
        {
            name:'Meteran',
            type:'gauge',
            min:0,
            max:100,
            splitNumber:5,
            axisLine: {
                lineStyle: {
                    color: [[<?php echo $nilai_bawah; ?>, 'red'],[<?php echo $nilai_bawah2; ?>,'orange'],[<?php echo $nilai_atas2; ?>, 'green'],[<?php echo $nilai_atas; ?>, 'orange'],[1, 'red']],
                    width: 10
                }
            },
            axisTick: {
                splitNumber: 10,
                length :15,
                lineStyle: {
                    color: 'auto'
                }
            },
            axisLabel: {
                textStyle: {
                    // color: '#2A3F54'
                    color: 'auto'
                }
            },
            splitLine: {
                show: true,
                length :15,
                lineStyle: {
                    color: '#2A3F54'
                }
            },
            pointer : {
                width : 5,
                color: 'auto'
                // color: '#2A3F54'

            },
            title : {
                show : false,
                offsetCenter: [0, '-50%'],
                textStyle: {
                    fontWeight: 'bolder'
                }
            },
            detail : {
                formatter:'{value} %',
                textStyle: {
                    color: 'auto',
                    fontSize:'20'
                }
            },
            data:[{value: 50, name: ''}]
        }
    ]
};

clearInterval(timeTicket<?php echo $b; ?>);
timeTicket<?php echo $b; ?> = setIntervalAndExecute(function (){
              $.getJSON("less/jsensor_lembab_ruang.php?id=<?php echo $data['NAMALOKASI']; ?>", function(json) {
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
                        document.getElementById("lembab_lok<?php echo $b; ?>").className="btn btn-danger btn-xs blink_me";
                  }else{
                        document.getElementById("lembab_lok<?php echo $b; ?>").className="";
                  }
                }

                  if(nilai!=0){
                  option<?php echo $b; ?>.series[0].data[0].value = nilai;
                  option<?php echo $b; ?>.series[0].data[0].name = "";
                  }else{
                  option<?php echo $b; ?>.series[0].data[0].value = nilai;
                  option<?php echo $b; ?>.series[0].data[0].name = "NO Data ";
                  document.getElementById("lembab_lok<?php echo $b; ?>").className="";
                  }
                  myChart<?php echo $b; ?>.setOption(option<?php echo $b; ?>,true);
              });

              //option<?php //echo $b; ?>.series[0].data[0].value = nilai;

},5000);

    </script>

    <?php


    } ?>

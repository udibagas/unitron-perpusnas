     <?php
$sql = $konek->query("SELECT sensor.ID_SENSOR,
sensor.POSISIDETAIL,AVG(sensor.NILAIMIN) as NILAIMIN,AVG(sensor.NILAIMAX) as NILAIMAX FROM
sensor
WHERE sensor.PARAMETER='PAC_suhu' GROUP BY sensor.ID_SENSOR ");

    //for($a=1;$a<=$jumlah;$a++){

    while($data=$sql->fetch_array()){
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
    
    var myChart<?php echo $b; ?> = echarts.init(document.getElementById('suhu_PAC<?php echo $b; ?>'));
       option<?php echo $b; ?> = {
    tooltip : {
        formatter: "{a} <br/>{b} : {c} C"
    },
    series : [
        {
            name:'Meteran',
            type:'gauge',
            min:0,
            max:<?php echo $batas; ?>,
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
                    color: 'black'
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
                width : 5,
                 color: 'black'
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
                    color: 'black',
                    fontSize:'20'
                }
            },
            data:[{value: 50, name: ''}]
        }
    ]
};

clearInterval(timeTicket<?php echo $b; ?>);
timeTicket<?php echo $b; ?> = setIntervalAndExecute(function (){
              $.getJSON("less/jsensor_suhu_PAC.php?id=<?php echo $data['ID_SENSOR']; ?>", function(json) {

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
                        document.getElementById("suhu_PAC<?php echo $b; ?>").className="btn btn-danger btn-xs blink_me";
                  }else{
                        document.getElementById("suhu_PAC<?php echo $b; ?>").className="";
                  }
                }

                  if(nilai!=0){
                    option<?php echo $b; ?>.series[0].data[0].value = nilai;
                    option<?php echo $b; ?>.series[0].data[0].name = "";
                  }else{
                    option<?php echo $b; ?>.series[0].data[0].value = nilai;
                    option<?php echo $b; ?>.series[0].data[0].name = "NO Data ";   
                    document.getElementById("suhu_PAC<?php echo $b; ?>").className="";
                  }
                  myChart<?php echo $b; ?>.setOption(option<?php echo $b; ?>,true);
              });

              //option<?php //echo $b; ?>.series[0].data[0].value = nilai;

},5000);



    </script>

    <?php } ?>

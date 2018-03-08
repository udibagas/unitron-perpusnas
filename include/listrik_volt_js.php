     <?php

$sql = $konek->query("SELECT
sensor.POSISIDETAIL,sensor.ID_SENSOR,
sensor.PARAMETER,
sensor.POSISIDETAIL
FROM
sensor
WHERE left(sensor.PARAMETER,7)='Voltage' AND POSISIDETAIL='$id'
GROUP BY sensor.ID_SENSOR,sensor.PARAMETER");

    //for($a=1;$a<=$jumlah;$a++){
    
    while($data=$sql->fetch_array()){
        $b++;

?>

    <script type="text/javascript">
    var myChart<?php echo $b; ?> = echarts.init(document.getElementById('voltage<?php echo $b; ?>'));
       option<?php echo $b; ?> = {
    tooltip : {
        formatter: "{a} <br/>{b} : {c}"
    },
   
    series : [
        {
            name:'SUHU #1',
            type:'gauge',
            min:0,
            max:500,
            center : ['50%', '35%'], 
            radius : [10, '100%'],
            startAngle: -90,
            endAngle : -180,
            splitNumber:4,     
            axisLine: {            
                lineStyle: {       
                    color: [[0.2, '#228b22'],[0.9, '#48b'],[1, '#ff4500']], 
                    width: 15
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
                length :20,         
                lineStyle: {       
                    color: 'auto'
                }
            },
            pointer : {
                width : 5
            },
            title : {
                show : true,
                textStyle: {       
                fontWeight: 'bolder',
            
                }
            },
            detail : {
                formatter:'{value} V',
                 show : true,
                backgroundColor: 'rgba(0,0,0,0)',
                offsetCenter: ['60%',10],
                textStyle: {       
                color: 'auto',
                fontWeight: 'bolder',
                fontSize : 30,
             
                }
            },
            data:[{value: 500}]
        }
    ]
};

clearInterval(timeTicket<?php echo $b; ?>);
timeTicket<?php echo $b; ?> = setIntervalAndExecute(function (){
              $.getJSON("less/jsensor_voltage.php?id=<?php echo $data['ID_SENSOR']; ?>", function(json) {
                  

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
                        document.getElementById("voltage<?php echo $b; ?>").className="btn btn-danger btn-xs blink_me";
                  }else{
                        document.getElementById("voltage<?php echo $b; ?>").className="";
                  }
                }

                  if(nilai!=0){
                  option<?php echo $b; ?>.series[0].data[0].value = nilai;
                  option<?php echo $b; ?>.series[0].data[0].name = "";
                  }else{
                  option<?php echo $b; ?>.series[0].data[0].value = nilai;
                  option<?php echo $b; ?>.series[0].data[0].name = " ";  
                  document.getElementById("voltage<?php echo $b; ?>").className="";
                  }
                  myChart<?php echo $b; ?>.setOption(option<?php echo $b; ?>,true);
              });

              //option<?php //echo $b; ?>.series[0].data[0].value = nilai;

              

},5000);


    </script>

    <?php } ?>
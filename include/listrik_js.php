    <?php

    $sql1 = $konek->query("SELECT DISTINCT sensor.POSISIDETAIL,sensor.NAMALOKASI FROM sensor WHERE left(sensor.PARAMETER,6)='Active' AND POSISIDETAIL='$id'");
    while($data1=$sql1->fetch_array()){
        $posisi = $data1['POSISIDETAIL'];
        $nl = $data1['NAMALOKASI'];
?>

<?php

$sql = $konek->query("SELECT sensor.ID_SENSOR,
sensor.NAMALOKASI, sensor.PARAMETER,sensor.POSISIDETAIL,AVG(sensor.NILAIMIN) as NILAIMIN,AVG(sensor.NILAIMAX) as NILAIMAX FROM sensor
WHERE left(sensor.PARAMETER,6)='Active' AND sensor.POSISIDETAIL='$posisi'
GROUP BY sensor.ID_SENSOR,sensor.PARAMETER LIMIT 3");

    //for($a=1;$a<=$jumlah;$a++){
    
    while($data=$sql->fetch_array()){
        $b++;
         $max = $data['NILAIMAX'];
        $min = $data['NILAIMIN'];

       $batas=70;

        if($max>=40){
            $batas=55;
        }if($max>=50){
            $batas=65;
        }if($max>=60){
            $batas=$max+5;    
        }if($max<40){
            $batas=45; 
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
        formatter: "{a} <br/>{b} : {c}%"
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
            splitNumber: 1,            
            axisLine: {            
                show: true,       
                lineStyle: {       
                    color: [[<?php echo $nilai_atas2; ?>, '#48b'],[<?php echo $nilai_atas; ?>, '#f9f614'],[1, '#ff4500']],
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
                
                textStyle: {      
                    color: '#333'
                }
            },
            splitLine: {           
                show: true,      
                length :30,        
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
                    color: 'auto',
                    fontSize : 24
                }
            },
            data:[{value: 50, name: ''}]
        }
    ]
};

clearInterval(timeTicket<?php echo $b; ?>);
timeTicket<?php echo $b; ?> = setIntervalAndExecute(function (){
              $.getJSON("less/jsensor_daya.php?id=<?php echo $data['ID_SENSOR']; ?>", function(json) {
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
                        document.getElementById("daya_sensor<?php echo $b; ?>").className="btn btn-danger btn-xs blink_me";
                  }else{
                        document.getElementById("daya_sensor<?php echo $b; ?>").className="";
                  }
                }

                  if(nilai!=0){
                  option<?php echo $b; ?>.series[0].data[0].value = nilai;
                  option<?php echo $b; ?>.series[0].data[0].name = "";
                  }else{
                  option<?php echo $b; ?>.series[0].data[0].value = nilai;
                  option<?php echo $b; ?>.series[0].data[0].name = " ";  
                  document.getElementById("daya_sensor<?php echo $b; ?>").className="";
                  }
                  myChart<?php echo $b; ?>.setOption(option<?php echo $b; ?>,true);
              });

              //option<?php //echo $b; ?>.series[0].data[0].value = nilai;

},5000);


    </script>

    <?php } }?>
    <script src="js/justgauge/raphael-2.1.4.min.js"></script>
    <script src="js/justgauge/justgage.js"></script>

        <?php

    $sql1 = $konek->query("SELECT DISTINCT sensor.POSISIDETAIL,sensor.NAMALOKASI FROM sensor WHERE left(sensor.PARAMETER,7)='tangki_'");
    while($data1=$sql1->fetch_array()){
        $posisi = $data1['POSISIDETAIL'];
        $nl = $data1['NAMALOKASI'];
?>

     <?php

$sql = $konek->query("SELECT sensor.POSISIDETAIL,sensor.ID_SENSOR, sensor.PARAMETER,sensor.POSISIDETAIL,AVG(sensor.NILAIMIN) as NILAIMIN,AVG(sensor.NILAIMAX) as NILAIMAX FROM sensor
WHERE left(sensor.PARAMETER,7)='tangki_' AND POSISIDETAIL='$posisi'
GROUP BY sensor.ID_SENSOR,sensor.PARAMETER");

    //for($a=1;$a<=$jumlah;$a++){
    
    while($data=$sql->fetch_array()){
        $b++;

         $max = $data['NILAIMAX'];
        $min = $data['NILAIMIN'];

       $batas=130;

        if($max>=400){
            $batas=450;
        }if($max>=450){
            $batas=465;
        }if($max>=465){
            $batas=$max+25;    
        }if($max<400){
            $batas=400; 
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

document.addEventListener("DOMContentLoaded", function(event) {

        var g1<?php echo $b; ?> = new JustGage({
            id: "g1<?php echo $b; ?>",
            title: "Liter",
            value: 50,
            min: 0,
            max: <?php echo $max; ?>,
            decimals: 0,
            gaugeWidthScale: 0.7
        });

      


    
clearInterval(timeTicket<?php echo $b; ?>);
timeTicket<?php echo $b; ?> = setIntervalAndExecute(function (){
              $.getJSON("less/jsensor_tangki.php?id=<?php echo $data['ID_SENSOR']; ?>", function(json) {
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
                        document.getElementById("tangki_sensor_cur<?php echo $b; ?>").className="btn btn-danger btn-xs blink_me";
                  }else{
                        document.getElementById("tangki_sensor_cur<?php echo $b; ?>").className="";
                  }
                }

                  if(nilai!=0){
                  g1<?php echo $b; ?>.refresh(nilai);
                  }else{
                  g1<?php echo $b; ?>.refresh(0);
                  document.getElementById("tangki_sensor_cur<?php echo $b; ?>").className="";
                  document.getElementById("g1<?php echo $b; ?>").value="21";
                  }
                  
              });

              //option<?php //echo $b; ?>.series[0].data[0].value = nilai;

},5000);

    });


    </script>

    <?php } }?>
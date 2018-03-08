    <?php

$k=$konek->query("SELECT * FROM pue WHERE pue<>'' GROUP BY tanggal");


$q=$konek->query("SELECT * FROM pue WHERE pue<>'' GROUP BY tanggal");
    ?>

    <script>
        var trenChart1 = echarts.init(document.getElementById('tren1'), theme);
        trenChart1.setOption({
            title: {
                text: 'Efisiensi(PUE)'
               
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
       data: ["PUE"]
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
            magicType : {show: true, type: ['line', 'bar']},
            saveAsImage : {show: true}
        }
    },
   calculable: true,
   series: [
       {
           name: "PUE",
           type: "line",
           data: [<?php while($t=$k->fetch_array()){ echo substr($t["pue"],0,4).",";}?>]

       }

   ]
});

    </script>

        <?php

$k=$konek->query("SELECT ((1/pue)*100) as pue FROM pue WHERE pue<>'' GROUP BY tanggal");


$q=$konek->query("SELECT * FROM pue WHERE pue<>'' GROUP BY tanggal");
    ?>

    <script>
        var trenChart2 = echarts.init(document.getElementById('tren2'), theme);
        trenChart2.setOption({
            title: {
                text: 'Efisiensi(DCIE)'
               
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
       data: ["DCIE"]
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
           name: "DCIE",
           type: "line",
           data: [<?php while($t=$k->fetch_array()){ echo substr($t["pue"],0,4).",";}?>]

       }

   ]
});
</script>

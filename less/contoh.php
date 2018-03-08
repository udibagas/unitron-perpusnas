<?php

header("Content-type: text/json");


 include_once '../koneksi.php';
 $id = mysqli_real_escape_string($konek, $_GET['id']);
          $sql=$konek->query("SELECT AVG(trans5.nilai) as nilai,AVG(sensor.NILAIMIN) as NILAIMIN,AVG(sensor.NILAIMAX) as NILAIMAX, COUNT(trans5.ID_SENSOR) as jumlah FROM  trans5 INNER JOIN sensor ON sensor.ID_SENSOR = trans5.ID_SENSOR WHERE sensor.PARAMETER='Suhu' AND (sensor.POSISIDETAIL='Dalam Ruang' OR sensor.POSISIDETAIL='BAWAHCEILING' )  AND trans5.id IN (SELECT MAX(id)AS id FROM trans5  GROUP BY ID_SENSOR )   group by sensor.NAMALOKASI AND sensor.ID_SENSOR");
          $data=$sql->fetch_assoc();

$ret = $data;

$konek->close();
echo json_encode($ret);
?>

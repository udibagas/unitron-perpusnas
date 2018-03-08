<?php

header("Content-type: text/json");


 include_once '../koneksi.php';
 $id = mysqli_real_escape_string($konek, $_GET['id']);
          $sql=$konek->query("SELECT sensor.POSISIDETAIL,AVG(trans5.nilai) as nilai,sensor.NILAIMIN,sensor.NILAIMAX, COUNT(trans5.ID_SENSOR) as jumlah FROM
  trans5 INNER JOIN sensor ON sensor.ID_SENSOR = trans5.ID_SENSOR WHERE sensor.PARAMETER='Lembab' AND LEFT(sensor.POSISIDETAIL,3)='RAK' AND sensor.POSISIDETAIL='$id' AND trans5.id IN (SELECT MAX(id)AS id FROM trans5   GROUP BY ID_SENSOR ) AND HOUR(trans5.tgljam)=HOUR(NOW()) AND DAY(tgljam)=DAY(NOW()) AND MONTH(tgljam)=MONTH(NOW()) AND YEAR(tgljam)=YEAR(NOW()) group by sensor.POSISIDETAIL ");
          $data=$sql->fetch_assoc();

$ret = $data;

$konek->close();
echo json_encode($ret);
?>

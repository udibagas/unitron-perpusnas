<?php

header("Content-type: text/json");


 include_once '../koneksi.php';
 $id = mysqli_real_escape_string($konek, $_GET['id']);
          $sql=$konek->query("SELECT sensor.ID_SENSOR, (sum(nilai)*0.0022) as sum FROM
trans5 INNER JOIN sensor ON sensor.ID_SENSOR = trans5.ID_SENSOR WHERE sensor.PARAMETER='Arus' AND trans5.id IN (SELECT MAX(id)AS id FROM trans5  GROUP BY ID_SENSOR ) AND sensor.POSISIDETAIL='$id' AND HOUR(trans5.tgljam)=HOUR(NOW()) AND DAY(tgljam)=DAY(NOW()) AND MONTH(tgljam)=MONTH(NOW()) AND YEAR(tgljam)=YEAR(NOW()) group by sensor.POSISIDETAIL");
          $data=$sql->fetch_assoc();

$ret = $data;
$konek->close();
echo json_encode($ret);
?>

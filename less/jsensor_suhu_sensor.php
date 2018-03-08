<?php

header("Content-type: text/json");


 include_once '../koneksi.php';
 $id = mysqli_real_escape_string($konek, $_GET['id']);
          $sql=$konek->query("SELECT
trans5.id,sensor.NAMALOKASI,sensor.KODEALAT,sensor.NILAIMIN,sensor.NILAIMAX,
trans5.nilai FROM  trans5 INNER JOIN sensor  ON trans5.ID_SENSOR = sensor.ID_SENSOR
WHERE trans5.ID_SENSOR='$id' AND trans5.id IN
(SELECT MAX(id)AS id FROM trans5  GROUP BY ID_SENSOR ) AND HOUR(trans5.tgljam)=HOUR(NOW()) AND DAY(tgljam)=DAY(NOW()) AND MONTH(tgljam)=MONTH(NOW()) AND YEAR(tgljam)=YEAR(NOW()) GROUP BY trans5.ID_SENSOR");
          $data=$sql->fetch_assoc();

$ret = $data;

$konek->close();
echo json_encode($ret);
?>

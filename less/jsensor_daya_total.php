<?php

header("Content-type: text/json");


include_once '../koneksi.php';
$id = mysqli_real_escape_string($konek, $_GET['id']);
$sql = $konek->query("SELECT sensor.ID_SENSOR, sensor.MAX_LOAD, sum(nilai) as sum FROM
trans5 INNER JOIN sensor ON sensor.ID_SENSOR = trans5.ID_SENSOR WHERE LEFT(sensor.PARAMETER,6)='Active' AND trans5.id IN (SELECT MAX(id)AS id FROM trans5  GROUP BY ID_SENSOR ) AND sensor.POSISIDETAIL='$id'   group by sensor.POSISIDETAIL");
$data=$sql->fetch_assoc();
$ret = $data;
$konek->close();
echo json_encode($ret);
?>

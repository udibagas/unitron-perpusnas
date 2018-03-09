<?php
header("Content-type: text/json");
include_once '../koneksi.php';

$sql=$konek->query("SELECT (SELECT COUNT(sensor.ID_SENSOR) FROM trans5 INNER JOIN sensor ON trans5.ID_SENSOR = sensor.ID_SENSOR WHERE sensor.PARAMETER='gas' AND pesan<>'' AND trans5.id IN (SELECT MAX(id)AS id FROM trans5  GROUP BY ID_SENSOR ) ) as k_gas,
(SELECT COUNT(sensor.ID_SENSOR) FROM trans5 INNER JOIN sensor ON trans5.ID_SENSOR = sensor.ID_SENSOR WHERE sensor.PARAMETER='suhu' AND pesan<>'' AND trans5.id IN (SELECT MAX(id)AS id FROM trans5  GROUP BY ID_SENSOR ) ) as k_suhu,
(SELECT COUNT(sensor.ID_SENSOR) FROM trans5 INNER JOIN sensor ON trans5.ID_SENSOR = sensor.ID_SENSOR WHERE sensor.PARAMETER='air' AND pesan<>'' AND trans5.id IN (SELECT MAX(id)AS id FROM trans5  GROUP BY ID_SENSOR ) ) as k_air,
(SELECT COUNT(sensor.ID_SENSOR) FROM trans5 INNER JOIN sensor ON trans5.ID_SENSOR = sensor.ID_SENSOR WHERE sensor.PARAMETER='lembab' AND pesan<>'' AND trans5.id IN (SELECT MAX(id)AS id FROM trans5  GROUP BY ID_SENSOR )) as k_lembab,
(SELECT SUM(trans5.nilai) as jumlah FROM trans5 INNER JOIN sensor ON trans5.ID_SENSOR = sensor.ID_SENSOR WHERE LEFT(sensor.PARAMETER,6)='Active' AND sensor.POSISIDETAIL like '%MSB%'  AND trans5.id IN (SELECT MAX(id)AS id FROM trans5  GROUP BY ID_SENSOR )) as k_daya
,(((SELECT AVG((trans5.nilai)) as nilai FROM
trans5 INNER JOIN sensor ON sensor.ID_SENSOR = trans5.ID_SENSOR WHERE sensor.ID_SENSOR='34'  AND trans5.id IN (SELECT MAX(id)AS id FROM trans5  GROUP BY ID_SENSOR )  group by sensor.ID_SENSOR)
+
(SELECT AVG((trans5.nilai)) as nilai FROM
trans5 INNER JOIN sensor ON sensor.ID_SENSOR = trans5.ID_SENSOR WHERE sensor.ID_SENSOR='35'  AND trans5.id IN (SELECT MAX(id)AS id FROM trans5  GROUP BY ID_SENSOR )  group by sensor.ID_SENSOR)
+
(SELECT AVG((trans5.nilai)) as nilai FROM
trans5 INNER JOIN sensor ON sensor.ID_SENSOR = trans5.ID_SENSOR WHERE sensor.ID_SENSOR='36'  AND trans5.id IN (SELECT MAX(id)AS id FROM trans5  GROUP BY ID_SENSOR )  group by sensor.ID_SENSOR)
)


/

(
(SELECT AVG((trans5.nilai)) as nilai FROM
trans5 INNER JOIN sensor ON sensor.ID_SENSOR = trans5.ID_SENSOR WHERE sensor.ID_SENSOR='51'  AND trans5.id IN (SELECT MAX(id)AS id FROM trans5  GROUP BY ID_SENSOR )  group by sensor.ID_SENSOR)
+
(SELECT AVG((trans5.nilai)) as nilai FROM
trans5 INNER JOIN sensor ON sensor.ID_SENSOR = trans5.ID_SENSOR WHERE sensor.ID_SENSOR='52'  AND trans5.id IN (SELECT MAX(id)AS id FROM trans5  GROUP BY ID_SENSOR )  group by sensor.ID_SENSOR)
+
(SELECT AVG((trans5.nilai)) as nilai FROM
trans5 INNER JOIN sensor ON sensor.ID_SENSOR = trans5.ID_SENSOR WHERE sensor.ID_SENSOR='53'  AND trans5.id IN (SELECT MAX(id)AS id FROM trans5  GROUP BY ID_SENSOR )  group by sensor.ID_SENSOR)
+
(SELECT AVG((trans5.nilai)) as nilai FROM
trans5 INNER JOIN sensor ON sensor.ID_SENSOR = trans5.ID_SENSOR WHERE sensor.ID_SENSOR='67'  AND trans5.id IN (SELECT MAX(id)AS id FROM trans5  GROUP BY ID_SENSOR )  group by sensor.ID_SENSOR)
+
(SELECT AVG((trans5.nilai)) as nilai FROM
trans5 INNER JOIN sensor ON sensor.ID_SENSOR = trans5.ID_SENSOR WHERE sensor.ID_SENSOR='68'  AND trans5.id IN (SELECT MAX(id)AS id FROM trans5  GROUP BY ID_SENSOR )  group by sensor.ID_SENSOR)
+
(SELECT AVG((trans5.nilai)) as nilai FROM
trans5 INNER JOIN sensor ON sensor.ID_SENSOR = trans5.ID_SENSOR WHERE sensor.ID_SENSOR='82'  AND trans5.id IN (SELECT MAX(id)AS id FROM trans5  GROUP BY ID_SENSOR )  group by sensor.ID_SENSOR)
+
(SELECT AVG((trans5.nilai)) as nilai FROM
trans5 INNER JOIN sensor ON sensor.ID_SENSOR = trans5.ID_SENSOR WHERE sensor.ID_SENSOR='83'  AND trans5.id IN (SELECT MAX(id)AS id FROM trans5  GROUP BY ID_SENSOR )  group by sensor.ID_SENSOR)
+
(SELECT AVG((trans5.nilai)) as nilai FROM
trans5 INNER JOIN sensor ON sensor.ID_SENSOR = trans5.ID_SENSOR WHERE sensor.ID_SENSOR='97'  AND trans5.id IN (SELECT MAX(id)AS id FROM trans5  GROUP BY ID_SENSOR )  group by sensor.ID_SENSOR)
+
(SELECT AVG((trans5.nilai)) as nilai FROM
trans5 INNER JOIN sensor ON sensor.ID_SENSOR = trans5.ID_SENSOR WHERE sensor.ID_SENSOR='98'  AND trans5.id IN (SELECT MAX(id)AS id FROM trans5  GROUP BY ID_SENSOR )  group by sensor.ID_SENSOR)
+
(SELECT AVG((trans5.nilai)) as nilai FROM
trans5 INNER JOIN sensor ON sensor.ID_SENSOR = trans5.ID_SENSOR WHERE sensor.ID_SENSOR='112'  AND trans5.id IN (SELECT MAX(id)AS id FROM trans5  GROUP BY ID_SENSOR )  group by sensor.ID_SENSOR)
+
(SELECT AVG((trans5.nilai)) as nilai FROM
trans5 INNER JOIN sensor ON sensor.ID_SENSOR = trans5.ID_SENSOR WHERE sensor.ID_SENSOR='113'  AND trans5.id IN (SELECT MAX(id)AS id FROM trans5  GROUP BY ID_SENSOR )  group by sensor.ID_SENSOR)
+
(SELECT AVG((trans5.nilai)) as nilai FROM
trans5 INNER JOIN sensor ON sensor.ID_SENSOR = trans5.ID_SENSOR WHERE sensor.ID_SENSOR='114'  AND trans5.id IN (SELECT MAX(id)AS id FROM trans5  GROUP BY ID_SENSOR )  group by sensor.ID_SENSOR)
)
) as PUE FROM trans5 LIMIT 1");

$data=$sql->fetch_assoc();

$ret = $data;
$konek->close();
echo json_encode($ret);
?>

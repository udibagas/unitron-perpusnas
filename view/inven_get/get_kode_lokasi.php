<?php
ob_start();
session_start();
session_regenerate_id();
include '../../koneksi.php';
$sub_ruang_id = $konek->real_escape_string(trim($_GET['id']));
$data = array();
$sql = "
SELECT
	CONCAT(
		IF (
			lokasi.lokasi_no < 10,
			CONCAT('0', lokasi.lokasi_no),
			lokasi.lokasi_no
		),
		'.',
		IF (
			ruang.ruang_no < 10,
			CONCAT('0', ruang.ruang_no),
			ruang.ruang_no
		),
		'.',
		IF (
			sub_ruang.sub_ruang_no < 10,
			CONCAT('0', sub_ruang.sub_ruang_no),
			sub_ruang.sub_ruang_no
		),
		' - ',
		lokasi.lokasi_name,
		' | ',
		ruang.ruang_name,
		' | ',
		sub_ruang.sub_ruang_name
	) AS kode
FROM
	sub_ruang
INNER JOIN ruang ON sub_ruang.ruang_id = ruang.ruang_id
INNER JOIN lokasi ON lokasi.lokasi_id = ruang.lokasi_id
WHERE 
	sub_ruang_id = '{$sub_ruang_id}'
ORDER BY
	lokasi.lokasi_no ASC,
	ruang.ruang_no ASC,
	sub_ruang.sub_ruang_no ASC
;";
if ($result = $konek->query($sql)) {
	while ($row = $result->fetch_object()) {
		$data[] = $row;
	}
}
echo json_encode($data);
?>
<?php
ob_start();
session_start();
session_regenerate_id();
include '../../koneksi.php';
$kelompok_perangkat_biaya_id = $konek->real_escape_string(trim($_GET['id']));
$data = array();
$sql = "
SELECT
	CONCAT(
		IF (
			golongan_perangkat.golongan_perangkat_no < 10,
			CONCAT('0', golongan_perangkat.golongan_perangkat_no),
			golongan_perangkat.golongan_perangkat_no
		),
		'.',
		IF (
			kelompok_perangkat.kelompok_perangkat_no < 10,
			CONCAT('0', kelompok_perangkat.kelompok_perangkat_no),
			kelompok_perangkat.kelompok_perangkat_no
		),
		'.',
		jenis_biaya.jenis_biaya_no,
		' - ',
		golongan_perangkat.golongan_perangkat_name,
		' | ',
		kelompok_perangkat.kelompok_perangkat_name,
		' | ',
		jenis_biaya.jenis_biaya_name
	) AS kode
FROM
	kelompok_perangkat_biaya
INNER JOIN jenis_biaya ON jenis_biaya.jenis_biaya_id = kelompok_perangkat_biaya.jenis_biaya_id
INNER JOIN kelompok_perangkat ON kelompok_perangkat_biaya.kelompok_perangkat_id = kelompok_perangkat.kelompok_perangkat_id
INNER JOIN golongan_perangkat ON golongan_perangkat.golongan_perangkat_id = kelompok_perangkat.golongan_perangkat_id
WHERE 
	kelompok_perangkat_biaya_id = '{$kelompok_perangkat_biaya_id}'
ORDER BY
	golongan_perangkat.golongan_perangkat_no ASC,
	kelompok_perangkat.kelompok_perangkat_no ASC,
	jenis_biaya.jenis_biaya_no ASC
;";
if ($result = $konek->query($sql)) {
	while ($row = $result->fetch_object()) {
		$data[] = $row;
	}
}
echo json_encode($data);
?>
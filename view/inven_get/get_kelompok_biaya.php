<?php
ob_start();
session_start();
session_regenerate_id();
include '../../koneksi.php';
$kelompok_perangkat_id = $konek->real_escape_string(trim($_GET['id']));
$data = array();
$sql = "SELECT kelompok_perangkat_biaya.kelompok_perangkat_biaya_id AS `key`, jenis_biaya.jenis_biaya_name AS `value` FROM kelompok_perangkat_biaya INNER JOIN jenis_biaya ON jenis_biaya.jenis_biaya_id = kelompok_perangkat_biaya.jenis_biaya_id WHERE kelompok_perangkat_biaya.kelompok_perangkat_id = '{$kelompok_perangkat_id}';";
if ($result = $konek->query($sql)) {
	while ($row = $result->fetch_object()) {
		$data[] = $row;
	}
}
echo json_encode($data);
?>
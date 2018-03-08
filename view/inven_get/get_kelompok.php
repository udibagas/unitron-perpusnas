<?php
ob_start();
session_start();
session_regenerate_id();
include '../../koneksi.php';
$golongan_perangkat_id = $konek->real_escape_string(trim($_GET['id']));
$data = array();
$sql = "SELECT kelompok_perangkat_id AS `key`, kelompok_perangkat_name AS `value` FROM kelompok_perangkat WHERE golongan_perangkat_id = '{$golongan_perangkat_id}';";
if ($result = $konek->query($sql)) {
	while ($row = $result->fetch_object()) {
		$data[] = $row;
	}
}
echo json_encode($data);
?>
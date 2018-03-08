<?php
ob_start();
session_start();
session_regenerate_id();
include '../../koneksi.php';
$lokasi_id = $konek->real_escape_string(trim($_GET['id']));
$data = array();
$sql = "SELECT ruang_id AS `key`, ruang_name AS `value` FROM ruang WHERE lokasi_id = '{$lokasi_id}';";
if ($result = $konek->query($sql)) {
	while ($row = $result->fetch_object()) {
		$data[] = $row;
	}
}
echo json_encode($data);
?>
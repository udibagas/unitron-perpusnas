<?php
ob_start();
session_start();
session_regenerate_id();
include '../../koneksi.php';
$ruang_id = $konek->real_escape_string(trim($_GET['id']));
$data = array();
$sql = "SELECT sub_ruang_id AS `key`, sub_ruang_name AS `value` FROM sub_ruang WHERE ruang_id = '{$ruang_id}';";
if ($result = $konek->query($sql)) {
	while ($row = $result->fetch_object()) {
		$data[] = $row;
	}
}
echo json_encode($data);
?>
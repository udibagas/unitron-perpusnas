<?php
ob_start();
session_start();
session_regenerate_id();
include '../../koneksi.php';
$unit_id = $konek->real_escape_string(trim($_GET['id']));
$data = array();
$sql = "SELECT kojab AS `key`, najabl AS `value` FROM ref_kojab_tbl WHERE kolok = '{$unit_id}' ";
if($_SESSION['level']!='admin'){
    $kojab = substr($_SESSION['kojab'],0,3);
    $sql= $sql. " AND LEFT(kojab,3)='$kojab'";
}
if ($result = $konek->query($sql)) {
	while ($row = $result->fetch_object()) {
		$data[] = $row;
	}
}


//echo $data;
echo json_encode($data);
?>
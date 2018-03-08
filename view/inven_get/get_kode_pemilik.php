<?php
ob_start();
session_start();
session_regenerate_id();
include '../../koneksi.php';
$sub_unit_id = $konek->real_escape_string(trim($_GET['id']));
$unit_id = $konek->real_escape_string(trim($_GET['id2']));
$data = array();
$sql = "
SELECT
	CONCAT(
			ref_lokasi_tbl.kolok
		,
		'.',
			ref_kojab_tbl.kojab
		,
		' - ',
		ref_lokasi_tbl.nalokl,
		' | ',
		ref_kojab_tbl.najabl
	) AS kode
FROM
	ref_kojab_tbl
INNER JOIN ref_lokasi_tbl ON ref_lokasi_tbl.kolok = ref_kojab_tbl.kolok
WHERE 
	ref_kojab_tbl.kojab = '{$sub_unit_id}' AND ref_kojab_tbl.kolok = '{$unit_id}'
ORDER BY
	ref_lokasi_tbl.kolok_id ASC,
	ref_kojab_tbl.kojab_id ASC
;";
if ($result = $konek->query($sql)) {
	while ($row = $result->fetch_object()) {
		$data[] = $row;
	}
}
echo json_encode($data);
?>
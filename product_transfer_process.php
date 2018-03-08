<?php
include 'koneksi.php';
?>


<?php
if (!isset($_POST['id'],$_POST['sub_ruang_id'],$_POST['sub_unit_id'],$_POST['product_receive_date'],$_POST['product_history_note'])) {
	header('Location:index.php');
	exit();
}
$product_id = $konek->real_escape_string(trim($_POST['id']));
$sub_ruang_id = $konek->real_escape_string(trim($_POST['sub_ruang_id']));
$sub_unit_id = $konek->real_escape_string(trim($_POST['sub_unit_id']));
$product_receive_date = $konek->real_escape_string(trim($_POST['product_receive_date']));
$product_history_note = $konek->real_escape_string(trim($_POST['product_history_note']));
$errors = array();
if (empty($sub_ruang_id)) {
	$errors[] = "Tentukan kode lokasi.";
}
if (empty($sub_unit_id)) {
	$errors[] = "Tentukan kode pemilik.";
}
if (empty($product_receive_date)) {
	$errors[] = "Tentukan tanggal penempatan.";
}
if (!empty($errors)) {
	include 'product_transfer.php';
} else {
	$activity_note = '';
	// generate product registration code
	// get kode_lokasi
	$old_location_note = '';
	$sql = "
	SELECT
		CONCAT(
			lokasi.lokasi_name,
			' | ',
			ruang.ruang_name,
			' | ',
			sub_ruang.sub_ruang_name
		) AS old_location_note
	FROM
		product
	INNER JOIN sub_ruang ON sub_ruang.sub_ruang_id = product.sub_ruang_id
	INNER JOIN ruang ON sub_ruang.ruang_id = ruang.ruang_id
	INNER JOIN lokasi ON lokasi.lokasi_id = ruang.lokasi_id
	WHERE 
		product.product_id = '{$product_id}'
	ORDER BY
		lokasi.lokasi_no ASC,
		ruang.ruang_no ASC,
		sub_ruang.sub_ruang_no ASC
	;";
	if ($result = $konek->query($sql)) {
		$row = $result->fetch_object();
		$old_location_note = $row->old_location_note;
	}
	$kode = "";
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
			'-'
		) AS kode,
		CONCAT(
			lokasi.lokasi_name,
			' | ',
			ruang.ruang_name,
			' | ',
			sub_ruang.sub_ruang_name
		) AS new_location_note
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
		$row = $result->fetch_object();
		$kode .= $row->kode;
		if ($old_location_note != $row->new_location_note) {
			$activity_note .= (empty($activity_note))?'Pemindahan<br>':'';
			$activity_note .= 'dari '.$old_location_note.' ke '.$row->new_location_note.',<br>';
		}
	}
	// get kode_perangkat
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
			'-'
		) AS kode
	FROM
		product
	INNER JOIN kelompok_perangkat_biaya ON kelompok_perangkat_biaya.kelompok_perangkat_biaya_id = product.kelompok_perangkat_biaya_id
	INNER JOIN jenis_biaya ON jenis_biaya.jenis_biaya_id = kelompok_perangkat_biaya.jenis_biaya_id
	INNER JOIN kelompok_perangkat ON kelompok_perangkat_biaya.kelompok_perangkat_id = kelompok_perangkat.kelompok_perangkat_id
	INNER JOIN golongan_perangkat ON golongan_perangkat.golongan_perangkat_id = kelompok_perangkat.golongan_perangkat_id
	WHERE 
		product.product_id = '{$product_id}'
	ORDER BY
		golongan_perangkat.golongan_perangkat_no ASC,
		kelompok_perangkat.kelompok_perangkat_no ASC,
		jenis_biaya.jenis_biaya_no ASC
	;";
	if ($result = $konek->query($sql)) {
		$row = $result->fetch_object();
		$kode .= $row->kode;
	}
	// get kode_pemilik
	$old_owner_note = '';
	$sql = "
	SELECT
		CONCAT(
			unit.unit_name,
			' | ',
			sub_unit.sub_unit_name
		) AS old_owner_note
	FROM
		product
	INNER JOIN sub_unit ON sub_unit.sub_unit_id = product.sub_unit_id
	INNER JOIN unit ON unit.unit_id = sub_unit.unit_id
	WHERE 
		product.product_id = '{$product_id}'
	ORDER BY
		unit.unit_no ASC,
		sub_unit.sub_unit_no ASC
	;";
	if ($result = $konek->query($sql)) {
		$row = $result->fetch_object();
		$old_owner_note = $row->old_owner_note;
	}
	$sql = "
	SELECT
		CONCAT(
			IF (
				unit.unit_no < 10,
				CONCAT('0', unit.unit_no),
				unit.unit_no
			),
			'.',
			IF (
				sub_unit.sub_unit_no < 10,
				CONCAT('0', sub_unit.sub_unit_no),
				sub_unit.sub_unit_no
			),
			'-'
		) AS kode,
		CONCAT(
			unit.unit_name,
			' | ',
			sub_unit.sub_unit_name
		) AS new_owner_note
	FROM
		sub_unit
	INNER JOIN unit ON sub_unit.unit_id = unit.unit_id
	WHERE 
		sub_unit_id = '{$sub_unit_id}'
	ORDER BY
		unit.unit_no ASC,
		sub_unit.sub_unit_no ASC
	;";
	if ($result = $konek->query($sql)) {
		$row = $result->fetch_object();
		$kode .= $row->kode;
		if ($old_owner_note != $row->new_owner_note) {
			$activity_note .= (empty($activity_note))?'Pemindahan<br>':'';
			$activity_note .= 'dari '.$old_owner_note.' ke '.$row->new_owner_note.',<br>';
		}
	}
	if (!empty($activity_note)) {
		$activity_note .= 'pada '.$product_receive_date.'.<br>';
		$product_registration_code = $kode.$product_id;
		// Update Product Profile
		$sql = "UPDATE product SET
			product_registration_code = '{$product_registration_code}',
			sub_ruang_id = '{$sub_ruang_id}',
			sub_unit_id = '{$sub_unit_id}',
			product_receive_date = '{$product_receive_date}',
			updated_at = NOW()
		WHERE 
			product_id = '{$product_id}';
		";
		if (!$konek->query($sql)) {
			
	echo "<meta http-equiv='refresh' content='0;URL=media.php?page=inventory' />";
			exit();
		}
		// Add History
		$activity_note .= 'Kode registrasi produk berubah menjadi '.$product_registration_code.'.';
		$sql = "INSERT INTO product_history (product_id, product_history_date, user_id, product_history_activity, product_history_note, created_at) VALUES ('{$product_id}','{$product_receive_date}','".$_SESSION['id_req']."','{$activity_note}','{$product_history_note}', NOW());";
		$konek->query($sql);
		
	echo "<meta http-equiv='refresh' content='0;URL=media.php?page=inventory' />";
		exit();
	} else {
		
	echo "<meta http-equiv='refresh' content='0;URL=media.php?page=inventory' />";
		exit();
	}
}
?>
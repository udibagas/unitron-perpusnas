<?php
include '../../koneksi.php';
@session_start();

if (!isset($_POST['sub_ruang_id'],$_POST['kelompok_biaya_id'],$_POST['sub_unit_id'],$_POST['country_id'],$_POST['brand_id'],$_POST['brand_name'],$_POST['product_model'],$_POST['product_sn'],$_POST['product_receive_date'],$_POST['product_contract_num'],$_POST['product_contract_date'],$_POST['product_price'],$_POST['product_condition_id'],$_POST['product_ownership_id'],$_POST['product_warranty_exp_date'],$_POST['product_rent_exp_date'],$_POST['product_note'])) {
	echo "<meta http-equiv='refresh' content='0;URL=../../media.php?page=pbk9inventory&tipe=produk&id=$_SESSION[id]' />";
	exit();
}
$sub_ruang_id = $konek->real_escape_string(trim($_POST['sub_ruang_id']));
$kelompok_biaya_id = $konek->real_escape_string(trim($_POST['kelompok_biaya_id']));
$sub_unit_id = $konek->real_escape_string(trim($_POST['sub_unit_id']));
$country_id = $konek->real_escape_string(trim($_POST['country_id']));
$brand_id = $konek->real_escape_string(trim($_POST['brand_id']));
$brand_name = $konek->real_escape_string(trim($_POST['brand_name']));
$product_model = $konek->real_escape_string(trim($_POST['product_model']));
$product_sn = $konek->real_escape_string(trim($_POST['product_sn']));
$product_receive_date = $konek->real_escape_string(trim($_POST['product_receive_date']));
$product_contract_num = $konek->real_escape_string(trim($_POST['product_contract_num']));
$product_contract_date = $konek->real_escape_string(trim($_POST['product_contract_date']));
$product_price = $konek->real_escape_string(trim($_POST['product_price']));
$product_condition_id = $konek->real_escape_string(trim($_POST['product_condition_id']));
$product_ownership_id = $konek->real_escape_string(trim($_POST['product_ownership_id']));
$product_warranty_exp_date = $konek->real_escape_string(trim($_POST['product_warranty_exp_date']));
$product_rent_exp_date = $konek->real_escape_string(trim($_POST['product_rent_exp_date']));
$product_note = $konek->real_escape_string(trim($_POST['product_note']));
$errors = array();
if (empty($sub_ruang_id)) {
	$errors[] = "Tentukan kode lokasi.";
}
if (empty($kelompok_biaya_id)) {
	$errors[] = "Tentukan kode perangkat.";
}
if (empty($sub_unit_id)) {
	$errors[] = "Tentukan kode pemilik.";
}
if (empty($country_id)) {
	$errors[] = "Pilih negara pembuat.";
}
if (empty($brand_id) && empty($brand_name)) {
	$errors[] = "Pilih merek, isi nama merek pada kolom isian nama merek jika merek yang dicari belum terdaftar.";
}
if (!empty($brand_id) && !empty($brand_name)) {
	$errors[] = "Pilih \"Lainnya\"  jika ingin mendaftarkan merek baru.";
}
if (empty($product_model)) {
	$errors[] = "Isi model / tipe.";
}
if (empty($product_sn)) {
	$errors[] = "Isi serial number.";
}
if (empty($product_receive_date)) {
	$errors[] = "Tentukan tanggal penempatan.";
}
if (empty($product_contract_num)) {
	$errors[] = "Isi nomor ikatan pengadaan.";
}
if (empty($product_contract_date)) {
	$errors[] = "Tentukan tanggal ikatan pengadaan.";
}
if (empty($product_price)) {
	$errors[] = "Isi harga.";
}
if (!empty($product_price) && !is_numeric($product_price)) {
	$errors[] = "Harga harus berisi angka.";
}
if (empty($product_condition_id)) {
	$errors[] = "Pilih kondisi perangkat.";
}
if (empty($product_ownership_id)) {
	$errors[] = "Pilih status kepemilikan.";
}
// if (empty($product_warranty_exp_date)) {
// 	$errors[] = "Tentukan tanggal berakhir garansi.";
// }
// if (empty($product_rent_exp_date)) {
// 	$errors[] = "Tentukan tanggal berakhir sewa.";
// }
if (!empty($errors)) {
	echo "<meta http-equiv='refresh' content='0;URL=../../media.php?page=pbk9inventory&tipe=produk&id=$_SESSION[id]&ok=gagal' />";
	exit;
} else {
	if (empty($brand_id)) {
		$exist = TRUE;
		$sql = "SELECT brand_id,COUNT(*) AS counter FROM brands WHERE brand_name = '{$brand_name}';";
		if ($result = $konek->query($sql)) {
			$row = $result->fetch_object();
			$exist = ($row->counter == 1)?TRUE:FALSE;
		}
		if ($exist) {
			$brand_id = $row->brand_id;
		} else {
			$sql = "INSERT INTO brands (brand_name) VALUES ('{$brand_name}');";
			$konek->query($sql);
			$brand_id = $konek->insert_id;
		}
	}
	// generate product registration code
	// get kode_lokasi
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
		$row = $result->fetch_object();
		$kode .= $row->kode;
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
		kelompok_perangkat_biaya
	INNER JOIN jenis_biaya ON jenis_biaya.jenis_biaya_id = kelompok_perangkat_biaya.jenis_biaya_id
	INNER JOIN kelompok_perangkat ON kelompok_perangkat_biaya.kelompok_perangkat_id = kelompok_perangkat.kelompok_perangkat_id
	INNER JOIN golongan_perangkat ON golongan_perangkat.golongan_perangkat_id = kelompok_perangkat.golongan_perangkat_id
	WHERE 
		kelompok_perangkat_biaya_id = '{$kelompok_biaya_id}'
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
	$product_warranty_exp_date = (empty($product_warranty_exp_date))?"NULL":"'{$product_warranty_exp_date}'";
	$product_rent_exp_date = (empty($product_rent_exp_date))?"NULL":"'{$product_rent_exp_date}'";
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
		) AS kode
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
	}
	$sql = "INSERT INTO product (
		sub_ruang_id,
		kelompok_perangkat_biaya_id,
		sub_unit_id,
		country_code,
		brand_id,
		product_model,
		product_sn,
		product_receive_date,
		product_contract_num,
		product_contract_date,
		product_price,
		product_condition_id,
		product_ownership_id,
		product_warranty_exp_date,
		product_rent_exp_date,
		product_note,
		created_at
	) VALUES (
		'{$sub_ruang_id}',
		'{$kelompok_biaya_id}',
		'{$sub_unit_id}',
		'{$country_id}',
		'{$brand_id}',
		'{$product_model}',
		'{$product_sn}',
		'{$product_receive_date}',
		'{$product_contract_num}',
		'{$product_contract_date}',
		'{$product_price}',
		'{$product_condition_id}',
		'{$product_ownership_id}',
		{$product_warranty_exp_date},
		{$product_rent_exp_date},
		'{$product_note}',
		NOW()
	);
	";
	if (!$konek->query($sql)) {
		echo "<meta http-equiv='refresh' content='0;URL=../../media.php?page=pbk9inventory&tipe=produk&id=$_SESSION[id]&ok=gagal1' /> />";
		exit();
	}
	$product_id = $konek->insert_id;
	$product_registration_code = $kode.$product_id;
	$sql = "UPDATE product SET product_registration_code = '{$product_registration_code}' WHERE product_id = '{$product_id}';";
	$konek->query($sql);
	// Add History
	$product_history_activity = 'Penambahan produk dengan kode registrasi '.$product_registration_code.'';
	$sql = "INSERT INTO product_history (product_id, product_history_date, user_id, product_history_activity, product_history_note, created_at) VALUES ('{$product_id}','{$product_receive_date}','".$_SESSION['id_req']."','{$product_history_activity}','{$product_note}',NOW());";
	$konek->query($sql);
	@session_start();
	echo "<meta http-equiv='refresh' content='0;URL=../../media.php?page=pbk9inventory&tipe=produk&id=$_SESSION[id]&ok=sukses' />";
	exit();
}
?>
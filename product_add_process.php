<?php
include 'koneksi.php';

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if (!isset($_POST['sub_ruang_id'],$_POST['kelompok_biaya_id'],$_POST['sub_unit_id'],$_POST['country_id'])) {
	echo "<meta http-equiv='refresh' content='0;URL=media.php?page=product_add' />";
	exit();
}

// $sub_ruang_id = $konek->real_escape_string(trim($_POST['sub_ruang_id']));
// $kelompok_biaya_id = $konek->real_escape_string(trim($_POST['kelompok_biaya_id']));
// $sub_unit_id = $konek->real_escape_string(trim($_POST['sub_unit_id']));
//$product_id = $konek->real_escape_string(trim($_POST['id']));
$ruang_id = $konek->real_escape_string(trim($_POST['ruang_id']));
$sub_ruang_id = $konek->real_escape_string(trim($_POST['sub_ruang_id']));
$kelompok_biaya_id = $konek->real_escape_string(trim($_POST['kelompok_biaya_id']));
$sub_unit_id = $konek->real_escape_string(trim($_POST['sub_unit_id']));
$unit = $konek->real_escape_string(trim($_POST['unit']));
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

$ip_address = $konek->real_escape_string(trim($_POST['ip_address']));
$kon_power = $konek->real_escape_string(trim($_POST['kon_power']));
$koneksi_lan = $konek->real_escape_string(trim($_POST['koneksi_lan']));
$no_kontak = $konek->real_escape_string(trim($_POST['no_kontak']));
$nama_kontak = $konek->real_escape_string(trim($_POST['nama_kontak']));
$fungsi_alat = $konek->real_escape_string(trim($_POST['fungsi_alat']));
$pos_rak = $konek->real_escape_string(trim($_POST['pos_rak']));


$qmerek = "SELECT brand_name FROM brands WHERE brand_id='$brand_id'";
$merek = $konek->query($qmerek);
$dmerek = $merek->fetch_object();

$seri_tipe = $dmerek->brand_name. ' '. $brand_name.' '.$product_model;

$errors = array();

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

// if (empty($product_warranty_exp_date)) {
// 	$errors[] = "Tentukan tanggal berakhir garansi.";
// }
// if (empty($product_rent_exp_date)) {
// 	$errors[] = "Tentukan tanggal berakhir sewa.";
// }
if (!empty($errors)) {
	include 'product_add.php';
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
		$row = $result->fetch_assoc();
		$kode .= $row['kode'];
	}
	// get kode_pemilik
	$product_warranty_exp_date = (empty($product_warranty_exp_date))?"NULL":"'{$product_warranty_exp_date}'";
	$product_rent_exp_date = (empty($product_rent_exp_date))?"NULL":"'{$product_rent_exp_date}'";

			$target_dir = "upload/";
		$file = $_FILES["file"]["name"];
		$number = generateRandomString();
		//$cek_file=mysqli_real_escape_string($konek, $_POST['file']);


		if($file!=''){
		$pesan = "";
		$nama_file = $number."fileprod.jpg";
		$target_file = $target_dir . $nama_file;
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$mimetype = mime_content_type($_FILES['file']['tmp_name']);
		// Check if image file is a actual image or fake image


		// Check if file already exists
		if (file_exists($target_file)) {
		    $pesan = $pesan."File Sudah Ada !. ";
		    $uploadOk = 0;
		    $nama_file='';
		}
		// Check file size
		// 
		    $sizeee = 1024*1024;
		if ($_FILES["file"]["size"] > $sizeee) {
		    $pesan = $pesan." File Terlalu Besar !. ";
		    $uploadOk = 0;
		    $nama_file='';
		}

		if($mimetype!="image/jpeg"){
		    $pesan = $pesan." File Harus Berupa Gambar  .  ". $mimetype;
		    $uploadOk = 0;
		    $nama_file='';
		}

		// Allow certain file formats

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    $pesan = $pesan." File Tidak bisa Di Upload ";
		// if everything is ok, try to upload file
		} elseif($uploadOk == 1){
		    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
		        //echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
		    } else {

		    $pesan = $pesan." Upload Error ! ";
		    $nama_file='';
		    }
		}}else{
		   $uploadOk="2"; 
		   //$nama_file=''; 
		}


	
	$sql = "INSERT INTO product (
		ruang_id,
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
		Merek_Seri_Tipe,
		Model,
		Posisi,
		Nama_kontak,
		Notelp_kontak,
		Fungsi,
		IP_Address,
		LAN_Connect,
		Power_Connect,
		kolok,kojab,foto,
		created_at
	) VALUES (
		'{$ruang_id}',
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
		'{$seri_tipe}',
		'{$product_model}',
		'{$pos_rak}',
		'{$nama_kontak}',
		'{$no_kontak}',
		'{$fungsi_alat}',
		'{$ip_address}',
		'{$koneksi_lan}',
		'{$kon_power}',
		'{$unit}','{$sub_unit_id}','{$nama_file}',
		NOW()
	);
	";
	//echo "$sql";
	//echo "<br> $pesan";
	if (!$konek->query($sql)) {
		echo "<meta http-equiv='refresh' content='0;URL=media.php?page=inventory' />";
		
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
	if ($uploadOk==0){
		echo "<script>alert('$pesan, data tetap di simpan, silahkan edit kembali jika ingin menambahkan gambar.')</script>";
	}
	echo "<meta http-equiv='refresh' content='0;URL=media.php?page=inventory'/>";
	echo "<h2 align='center'>Proses Data..</h2>";
	exit();
}
?>
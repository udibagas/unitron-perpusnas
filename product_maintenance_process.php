<?php
include 'koneksi.php';

if (!isset($_POST['id'],$_POST['product_maintenance_price'],$_POST['product_maintenance_tax'],$_POST['maintenance_type_id'],$_POST['product_maintenance_contract_num'],$_POST['product_maintenance_start_date'],$_POST['product_maintenance_finish_date'],$_POST['product_maintenance_next_date'],$_POST['condition_id'],$_POST['product_maintenance_post_warranty_exp_date'],$_POST['product_maintenance_note'])) {
	
	echo "<meta http-equiv='refresh' content='0;URL=media.php?page=inventory' />";
	exit();
}
$product_id = $konek->real_escape_string(trim($_POST['id']));
$product_maintenance_price = $konek->real_escape_string(trim($_POST['product_maintenance_price']));
$product_maintenance_tax = $konek->real_escape_string(trim($_POST['product_maintenance_tax']));
$maintenance_type_id = $konek->real_escape_string(trim($_POST['maintenance_type_id']));
$product_maintenance_contract_num = $konek->real_escape_string(trim($_POST['product_maintenance_contract_num']));
$product_maintenance_start_date = $konek->real_escape_string(trim($_POST['product_maintenance_start_date']));
$product_maintenance_finish_date = $konek->real_escape_string(trim($_POST['product_maintenance_finish_date']));
$product_maintenance_next_date = $konek->real_escape_string(trim($_POST['product_maintenance_next_date']));
$condition_id = $konek->real_escape_string(trim($_POST['condition_id']));
$product_maintenance_post_warranty_exp_date = $konek->real_escape_string(trim($_POST['product_maintenance_post_warranty_exp_date']));
$product_maintenance_note = $konek->real_escape_string(trim($_POST['product_maintenance_note']));
$errors = array();
/*
if (empty($product_maintenance_price)) {
	$errors[] = "Masukkan biaya pemeliharaan.";
}
if (!empty($product_maintenance_price) && !is_numeric($product_maintenance_price)) {
	$errors[] = "Biaya pemeliharaan harus berisi angka.";
}
if (empty($product_maintenance_tax)) {
	$errors[] = "Masukkan pajak biaya pemeliharaan.";
}
if (!empty($product_maintenance_tax) && !is_numeric($product_maintenance_tax)) {
	$errors[] = "Pajak biaya pemeliharaan harus berisi angka.";
}
if (empty($maintenance_type_id)) {
	$errors[] = "Pilih tipe pemeliharaan.";
}
*/
if (!empty($maintenance_type_id)) {
	$exist = FALSE;
	$sql = "SELECT COUNT(*) AS `counter` FROM maintenance_type WHERE maintenance_type_id = '{$maintenance_type_id}';";
	if ($result = $konek->query($sql)) {
		$row = $result->fetch_object();
		$exist = ($row->counter == 1)?TRUE:FALSE;
	}
	if (!$exist) {
		$errors[] = "Pilih tipe pemeliharaan.";
	}
}
if (empty($product_maintenance_contract_num)) {
	$errors[] = "Masukkan nomor ikatan perjanjian pemeliharaan.";
}
if (empty($product_maintenance_start_date)) {
	$errors[] = "Masukkan tanggal mulai pemeliharaan.";
}
if (empty($product_maintenance_finish_date)) {
	$errors[] = "Masukkan tanggal selesai pemeliharaan.";
}
if (empty($condition_id)) {
	$errors[] = "Pilih kondisi perangkat setelah pemeliharaan.";
}
if (!empty($errors)) {
	include 'product_maintenance.php';
} else {
	$activity_note = '';
	$pre_condition_id = "";
	$product_maintenance_pre_warranty_exp_date = "";
	$sql = "SELECT product_condition_id, product_warranty_exp_date FROM product WHERE product_id = '{$product_id}';";
	if ($result = $konek->query($sql)) {
		$row = $result->fetch_object();
		$pre_condition_id = $row->product_condition_id;
		$product_maintenance_pre_warranty_exp_date = $row->product_warranty_exp_date;
	}
	$post_condition_id = $condition_id;
	$product_maintenance_post_warranty_exp_date = (empty($product_maintenance_post_warranty_exp_date))?$product_maintenance_pre_warranty_exp_date:$product_maintenance_post_warranty_exp_date;
	$product_maintenance_next_date = (empty($product_maintenance_next_date))?"NULL":"'".$product_maintenance_next_date."'";
	// Add product maintenance
	$sql = "INSERT INTO product_maintenance (product_id, product_maintenance_price, product_maintenance_tax, maintenance_type_id, product_maintenance_contract_num, product_maintenance_start_date, product_maintenance_finish_date, product_maintenance_next_date, pre_condition_id, post_condition_id, product_maintenance_pre_warranty_exp_date, product_maintenance_post_warranty_exp_date, product_maintenance_note, created_at) VALUES ('{$product_id}', '{$product_maintenance_price}', '{$product_maintenance_tax}', '{$maintenance_type_id}', '{$product_maintenance_contract_num}', '{$product_maintenance_start_date}', '{$product_maintenance_finish_date}', {$product_maintenance_next_date}, '{$pre_condition_id}', '{$post_condition_id}', '{$product_maintenance_pre_warranty_exp_date}', '{$product_maintenance_post_warranty_exp_date}', '{$product_maintenance_note}', NOW());";
	if (!$konek->query($sql)) {
		
	echo "<meta http-equiv='refresh' content='0;URL=media.php?page=inventory' />";
		exit();
	}
	// Update Product Condition
	if ($pre_condition_id != $post_condition_id) {
		$sql = "UPDATE product SET product_condition_id = '{$post_condition_id}' WHERE product_id = '{$product_id}';";
		$konek->query($sql);
	}
	// Update Product Warranty Date
	if ($product_maintenance_pre_warranty_exp_date != $product_maintenance_post_warranty_exp_date) {
		$sql = "UPDATE product SET product_warranty_exp_date = '{$product_maintenance_post_warranty_exp_date}' WHERE product_id = '{$product_id}';";
		$konek->query($sql);
	}
	// Add History
	$activity_note .= 'Maintenance';
	$sql = "INSERT INTO product_history (product_id, product_history_date, user_id, product_history_activity, product_history_note, created_at) VALUES ('{$product_id}','{$product_maintenance_start_date}','".$_SESSION['id_req']."','{$activity_note}','{$product_maintenance_note}', NOW());";
	$konek->query($sql);
	$konek->query("UPDATE product_maintenance SET product_maintenance_pre_warranty_exp_date = NULL WHERE product_maintenance_pre_warranty_exp_date = '0000-00-00';");
	$konek->query("UPDATE product_maintenance SET product_maintenance_post_warranty_exp_date = NULL WHERE product_maintenance_post_warranty_exp_date = '0000-00-00';");
	
	echo "<meta http-equiv='refresh' content='0;URL=media.php?page=inventory' />";
	exit();
}
?>
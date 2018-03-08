<?php

include 'koneksi.php';
?>


<?php
if (!isset($_POST['id'],$_POST['product_deletion_note'])) {
	
	echo "<meta http-equiv='refresh' content='0;URL=media.php?page=inventory' />";
	exit();
}
$product_id = $konek->real_escape_string(trim($_POST['id']));
$product_deletion_note = $konek->real_escape_string(trim($_POST['product_deletion_note']));
$errors = array();
if (empty($product_deletion_note)) {
	$errors[] = "Masukkan alasan penghapusan.";
}
if (!empty($errors)) {
	include 'product_deletion.php';
} else {
	$activity_note = '';
	// Add product audit
	$sql = "UPDATE product SET product_deleted = '1', product_deletion_note = '{$product_deletion_note}', deleted_at = NOW() WHERE product_id = '{$product_id}';";
	if (!$konek->query($sql)) {
		
	echo "<meta http-equiv='refresh' content='0;URL=media.php?page=inventory' />";
		exit();
	}
	// Add History
	$activity_note .= 'Penghapusan';
	$sql = "INSERT INTO product_history (product_id, product_history_date, user_id, product_history_activity, product_history_note, created_at) VALUES ('{$product_id}',CURDATE(),'".$_SESSION['id_req']."','{$activity_note}','{$product_deletion_note}', NOW());";
	$konek->query($sql);
	
	echo "<meta http-equiv='refresh' content='0;URL=media.php?page=inventory' />";
	exit();
}
?>
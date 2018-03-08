
<?php
include 'koneksi.php';
?>

<?php
if (!isset($_POST['id'],$_POST['product_audit_date'],$_POST['product_audit_note'],$_POST['product_history_note'])) {
	header('Location:index.php');
	exit();
}
$product_id = $konek->real_escape_string(trim($_POST['id']));
$product_audit_date = $konek->real_escape_string(trim($_POST['product_audit_date']));
$product_audit_note = $konek->real_escape_string(trim($_POST['product_audit_note']));
$product_history_note = $konek->real_escape_string(trim($_POST['product_history_note']));
$errors = array();
if (empty($product_audit_date)) {
	$errors[] = "Masukkan tanggal audit.";
}
if (empty($product_audit_note)) {
	$errors[] = "Masukkan catatan audit.";
}
if (!empty($errors)) {
	include 'product_audit.php';
} else {
	$activity_note = '';
	// Add product audit
	$sql = "INSERT INTO product_audit (product_id, product_audit_date, product_audit_note, product_audit_add_note, created_at) VALUES ('{$product_id}','{$product_audit_date}','{$product_audit_note}','{$product_history_note}',NOW());";
	if (!$konek->query($sql)) {
		echo "<meta http-equiv='refresh' content='0;URL=product_audit_failed.php' />";
		exit();
	}
	// Add History
	$activity_note .= 'Audit';
	$sql = "INSERT INTO product_history (product_id, product_history_date, user_id, product_history_activity, product_history_note, created_at) VALUES ('{$product_id}','{$product_audit_date}','".$_SESSION['id_req']."','{$activity_note}','{$product_audit_note}', NOW());";
	$konek->query($sql);
	echo "<meta http-equiv='refresh' content='0;URL=media.php?page=inventory' />";
		
	exit();
}
?>
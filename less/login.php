<?php

include "../koneksi.php";
@session_start();

 $username = mysqli_real_escape_string($konek, $_POST['username']);
 $password = mysqli_real_escape_string($konek, $_POST['password']);
 $password = md5($password);


$sql = "SELECT * FROM register WHERE email='$username' AND password='$password' AND status='Y'";
$result = $konek->query($sql);
$num_row = $result->num_rows;
if( $num_row > 0 ) {
	$row=$result->fetch_assoc();
	$_SESSION['username']=$row['nama'];
	$_SESSION['level']=$row['level'];
	$_SESSION['id_req']=$row['id_register'];
	echo 'true';
} else {
	echo 'false';
}
$konek->close();
?>

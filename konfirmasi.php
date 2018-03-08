<?php 

    @session_start();
    if(isset($_SESSION['username'])==false)
    {
        echo "<meta http-equiv='refresh' content='0;URL=menu_login.php' />";
    }

?>

<?php 

include "koneksi.php";
 $id = mysqli_real_escape_string($konek, $_GET['id']);

$sql = $konek->query("UPDATE register SET status='Y',tgl_konfirmasi=NOW() WHERE konfirmasi='$id'");

 echo "<script>
 		alert('Konfirmasi Berhasil , silahkan Login  !');
 		</script>";
 	echo "<meta http-equiv='refresh' content='0;URL=menu_login.php' />";
	

 ?>
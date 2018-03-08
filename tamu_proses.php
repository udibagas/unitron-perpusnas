
<?php 

	include "koneksi.php";

	$tipe = mysqli_real_escape_string($konek, $_GET['tipe']);


	if($tipe=="input"){
         $nama = mysqli_real_escape_string($konek, $_POST['nama']);
         $jabatan = mysqli_real_escape_string($konek, $_POST['jabatan']);
         $instansi = mysqli_real_escape_string($konek, $_POST['instansi']);
         $tujuan = mysqli_real_escape_string($konek, $_POST['tujuan']);

         $konek->query("INSERT INTO tamu(tanggal_masuk,waktu_masuk,nama,jabatan,instansi,tujuan) 
            VALUES (CURDATE(),current_time(),'$nama','$jabatan','$instansi','$tujuan')");
     	$konek->close();
     }elseif($tipe=="konfir"){
     		$id=mysqli_real_escape_string($konek, $_GET['id']);
     	  $konek->query("UPDATE tamu SET tanggal_keluar=current_date(), waktu_keluar=current_time WHERE id='$id'");
         $konek->close();
     }

?>

<meta http-equiv="refresh" content="0;url=media.php?page=inputtamu" />
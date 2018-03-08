<?php
	//Connection Database
include "../koneksi.php";

	switch ($_POST['type']) {

		//Tampilkan Data
		case "get":

			$SQL = $konek->query( "SELECT ruang.ruang_no,ruang.ruang_id,ruang.ruang_name,lokasi.lokasi_name,lokasi.lokasi_id FROM ruang
INNER JOIN lokasi ON ruang.lokasi_id = lokasi.lokasi_id
  WHERE ruang.ruang_id='".$_POST['id']."'");
			$return = $SQL->fetch_array();;
			echo json_encode($return);
			break;

		//Tambah Data
		case "new":

			$SQL = $konek->query(
									"INSERT INTO ruang SET
										lokasi_id='".$_POST['no_lokasi']."',
										ruang_no='".$_POST['no_ruang']."',
										ruang_name='".$_POST['nama_ruang']."'");
			if($SQL){
				echo json_encode("OK");
			}
			break;

		//Edit Data
		case "edit":

			$SQL = $konek->query(
									"UPDATE ruang SET
										lokasi_id='".$_POST['no_lokasi']."',
										ruang_no='".$_POST['no_ruang']."',
										ruang_name='".$_POST['nama_ruang']."' WHERE ruang_id='".$_POST['id']."'
								");
							
			if($SQL){
				echo json_encode("OK");
			}
			break;

		//Hapus Data
		case "delete":

			$SQL = $konek->query( "DELETE FROM ruang WHERE ruang_id='".$_POST['id']."'");
			if($SQL){
				echo json_encode("OK");
			}
			break;
	}

?>

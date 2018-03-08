<?php
	//Connection Database
include "../koneksi.php";

	switch ($_POST['type']) {

		//Tampilkan Data
		case "get":

			$SQL = $konek->query( "SELECT * FROM lokasi WHERE lokasi_id='".$_POST['id']."'");
			$return = $SQL->fetch_array();;
			echo json_encode($return);
			break;

		//Tambah Data
		case "new":

			$SQL = $konek->query(
									"INSERT INTO lokasi SET
										lokasi_no='".$_POST['no_lokasi']."',
										lokasi_name='".$_POST['nama_lokasi']."'");
			if($SQL){
				echo json_encode("OK");
			}
			break;

		//Edit Data
		case "edit":

			$SQL = $konek->query(
									"UPDATE lokasi SET
										lokasi_no='".$_POST['no_lokasi']."',
										lokasi_name='".$_POST['nama_lokasi']."'
									 WHERE lokasi_id='".$_POST['id']."'
								");
							
			if($SQL){
				echo json_encode("OK");
			}
			break;

		//Hapus Data
		case "delete":

			$SQL = $konek->query( "DELETE FROM  lokasi WHERE lokasi_id='".$_POST['id']."'");
			if($SQL){
				echo json_encode("OK");
			}
			break;
	}

?>

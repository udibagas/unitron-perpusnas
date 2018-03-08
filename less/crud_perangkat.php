<?php
	//Connection Database
include "../koneksi.php";

	switch ($_POST['type']) {

		//Tampilkan Data
		case "get":

			$SQL = $konek->query( "SELECT * FROM golongan_perangkat WHERE golongan_perangkat_id='".$_POST['id']."'");
			$return = $SQL->fetch_array();;
			echo json_encode($return);
			break;

		//Tambah Data
		case "new":

			$SQL = $konek->query(
									"INSERT INTO golongan_perangkat SET
										golongan_perangkat_no='".$_POST['no_perangkat']."',
										golongan_perangkat_name='".$_POST['gol_perangkat']."'");
			if($SQL){
				echo json_encode("OK");
			}
			break;

		//Edit Data
		case "edit":

			$SQL = $konek->query(
									"UPDATE golongan_perangkat SET
										golongan_perangkat_no='".$_POST['no_perangkat']."',
										golongan_perangkat_name='".$_POST['gol_perangkat']."'
									 WHERE golongan_perangkat_id='".$_POST['id']."'
								");
							
			if($SQL){
				echo json_encode("OK");
			}
			break;

		//Hapus Data
		case "delete":

			$SQL = $konek->query( "DELETE FROM  golongan_perangkat WHERE golongan_perangkat_id='".$_POST['id']."'");
			if($SQL){
				echo json_encode("OK");
			}
			break;
	}

?>

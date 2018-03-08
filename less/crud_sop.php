<?php
	//Connection Database
include "../koneksi.php";

	switch ($_POST['type']) {

		//Tampilkan Data
		case "get":

			$SQL = $konek->query( "SELECT * FROM sop WHERE id_sop='".$_POST['id']."'");
			$return = $SQL->fetch_array();;
			echo json_encode($return);
			break;

		//Tambah Data
		case "new":

			$SQL = $konek->query(
									"INSERT INTO sop SET
										nama_sop='".$_POST['nama_sop']."',
										sop='".$_POST['sop']."'");
			if($SQL){
				echo json_encode("OK".$_POST['nama_sop'].$_POST['sop']);
			}
			break;

		//Edit Data
		case "edit":

			$SQL = $konek->query(
									"UPDATE sop SET
										nama_sop='".$_POST['nama_sop']."',
										sop='".$_POST['sop']."'
									 WHERE id_sop='".$_POST['id']."'
								");
							
			if($SQL){
				echo json_encode("OK");
			}
			break;

		//Hapus Data
		case "delete":

			$SQL = $konek->query( "DELETE FROM  sop WHERE id_sop='".$_POST['id']."'");
			if($SQL){
				echo json_encode("OK");
			}
			break;
	}

?>

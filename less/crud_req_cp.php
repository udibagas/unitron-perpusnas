<?php
	//Connection Database
include "../koneksi.php";

	switch ($_POST['type']) {

		//Tampilkan Data
		case "get":

			$SQL = $konek->query( "SELECT * FROM rencana WHERE id_rencana='".$_POST['id']."'");
			$return = $SQL->fetch_array();;
			echo json_encode($return);
			break;

		//Tambah Data
		case "new":


			$ss = $konek->query("SELECT MAX(id_rencana) as up FROM rencana");
			$dd = $ss->fetch_assoc();

			$kode_req=$dd['up'];


			@session_start();
			$req = $_SESSION['id_req'];
			$userid = date("ymdhis")."_".rand(0,10);
		
			
			$SQL = $konek->query(
									"INSERT INTO rencana SET
										id_register='$req',
										judul_rencana='".$_POST['judul_rencana']."',
										detail_rencana='".$_POST['detail_rencana']."',
										keterangan='".$_POST['keterangan']."'
								");

			
			if($SQL){
				echo json_encode("OK");
			}
			break;

		//Edit Data
		case "edit":

			$SQL = $konek->query(
									"UPDATE rencana SET
										judul_rencana='".$_POST['judul_rencana']."',
										detail_rencana='".$_POST['detail_rencana']."',
										keterangan='".$_POST['keterangan']."'
									WHERE id_rencana='".$_POST['userid']."'
								");
							
			if($SQL){
				echo json_encode("OK");
			}
			break;

		//Hapus Data
		case "delete":

			$SQL = $konek->query( "DELETE FROM rencana WHERE id_rencana='".$_POST['id']."'");
			if($SQL){
				echo json_encode("OK");
			}
			break;
	}

?>

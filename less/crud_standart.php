<?php
	//Connection Database
include "../koneksi.php";

	switch ($_POST['type']) {

		//Tampilkan Data
		case "get":

			$SQL = $konek->query( "SELECT * FROM standart_perangkat WHERE id_std='".$_POST['id']."'");
			$return = $SQL->fetch_array();;
			echo json_encode($return);
			break;

		//Tambah Data
		case "new":

			$SQL = $konek->query(
									"INSERT INTO standart_perangkat SET
										kategori='".$_POST['kategori']."',
										kadaluarsa='".$_POST['kadaluarsa']."',
										kini='".$_POST['kini']."'
										derajat_kepatuhan='".$_POST['derajat_kepatuhan']."'");
			if($SQL){
				echo json_encode("OK");
			}
			break;

		//Edit Data
		case "edit":

			$SQL = $konek->query(
									"UPDATE standart_perangkat SET
										kategori='".$_POST['kategori']."',
										kadaluarsa='".$_POST['kadaluarsa']."',
										kini='".$_POST['kini'].",
										derajat_kepatuhan='".$_POST['derajat_kepatuhan']."''
									 WHERE id_std='".$_POST['id']."'
								");
							
			if($SQL){
				echo json_encode("OK");
			}
			break;

		//Hapus Data
		case "delete":

			$SQL = $konek->query( "DELETE FROM  standart_perangkat WHERE id_std='".$_POST['id']."'");
			if($SQL){
				echo json_encode("OK");
			}
			break;
	}

?>

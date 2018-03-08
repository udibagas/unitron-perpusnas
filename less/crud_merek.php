<?php
	//Connection Database
include "../koneksi.php";

	switch ($_POST['type']) {

		//Tampilkan Data
		case "get":

			$SQL = $konek->query( "SELECT * FROM brands WHERE brand_id='".$_POST['id']."'");
			$return = $SQL->fetch_array();;
			echo json_encode($return);
			break;

		//Tambah Data
		case "new":

			$SQL = $konek->query(
									"INSERT INTO brands SET
										brand_name='".$_POST['brand_name']."'");
			if($SQL){
				echo json_encode("OK");
			}
			break;

		//Edit Data
		case "edit":

			$SQL = $konek->query(
									"UPDATE brands SET
										brand_name='".$_POST['brand_name']."'
									 WHERE brand_id='".$_POST['id']."'
								");
							
			if($SQL){
				echo json_encode("OK");
			}
			break;

		//Hapus Data
		case "delete":

			$SQL = $konek->query( "DELETE FROM  brands WHERE brand_id='".$_POST['id']."'");
			if($SQL){
				echo json_encode("OK");
			}
			break;
	}

?>

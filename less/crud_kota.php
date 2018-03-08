<?php
	//Connection Database
include "../koneksi.php";

	switch ($_POST['type']) {

		//Tampilkan Data
		case "get":

			$SQL = $konek->query( "SELECT * FROM countries WHERE country_code='".$_POST['id']."'");
			$return = $SQL->fetch_array();;
			echo json_encode($return);
			break;

		//Tambah Data
		case "new":

			$SQL = $konek->query(
									"INSERT INTO countries SET
										country_code='".$_POST['kode_kota']."',
										country_name='".$_POST['nama_kota']."'");
			echo json_encode("OK");
			
			break;

		//Edit Data
		case "edit":

			$SQL = $konek->query(
									"UPDATE countries SET
										country_name='".$_POST['nama_kota']."'
									 WHERE country_code='".$_POST['id']."'
								");
							
			if($SQL){
				echo json_encode("OK");
			}
			break;

		//Hapus Data
		case "delete":

			$SQL = $konek->query( "DELETE FROM  countries WHERE country_code='".$_POST['id']."'");
			if($SQL){
				echo json_encode("OK");
			}
			break;
	}

?>

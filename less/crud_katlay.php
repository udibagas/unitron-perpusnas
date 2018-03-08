<?php
	//Connection Database
include "../koneksi.php";

	switch ($_POST['type']) {

		//Tampilkan Data
		case "get":

			$SQL = $konek->query( "SELECT * FROM kategori_layanan WHERE id_kategori_layanan='".$_POST['id']."'");
			$return = $SQL->fetch_array();;
			echo json_encode($return);
			break;

		//Tambah Data
		case "new":

			$SQL = $konek->query(
									"INSERT INTO kategori_layanan SET
										kategori_layanan='".$_POST['katlay']."',
										nama_layanan='".$_POST['nalay']."'");
			if($SQL){
				echo json_encode("OK");
			}
			break;

		//Edit Data
		case "edit":

			$SQL = $konek->query(
									"UPDATE kategori_layanan SET
										kategori_layanan='".$_POST['katlay']."',
										nama_layanan='".$_POST['nalay']."' WHERE id_kategori_layanan='".$_POST['id']."'
								");
							
			if($SQL){
				echo json_encode("OK");
			}
			break;

		//Hapus Data
		case "delete":

			$SQL = $konek->query( "DELETE FROM kategori_layanan WHERE id_kategori_layanan='".$_POST['id']."'");
			if($SQL){
				echo json_encode("OK");
			}
			break;
	}

?>

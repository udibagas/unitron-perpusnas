<?php
	//Connection Database
include "../koneksi.php";

	switch ($_POST['type']) {

		//Tampilkan Data
		case "get":

			$SQL = $konek->query( "SELECT * FROM register WHERE id_register='".$_POST['id']."'");
			$return = $SQL->fetch_array();;
			echo json_encode($return);
			break;

		//Tambah Data
		case "new":

			$SQL = $konek->query(
									"INSERT INTO register SET
										nama='".$_POST['nama']."',
										alamat='".$_POST['alamat']."',
										instansi='".$_POST['instansi']."',
										email='".$_POST['email']."',
										password='".md5($_POST['password'])."',
										level='".$_POST['level']."'
								");
			if($SQL){
				echo json_encode("OK");
			}
			break;

		//Edit Data
		case "edit":

			$SQL = $konek->query(
									"UPDATE register SET
										nama='".$_POST['nama']."',
										alamat='".$_POST['alamat']."',
										instansi='".$_POST['instansi']."',
										password='".md5($_POST['password'])."',
										level='".$_POST['level']."' 
									WHERE id_register='".$_POST['id']."'
								");
							
			if($SQL){
				echo json_encode("OK");
			}
			break;

		//Hapus Data
		case "delete":

			$SQL = $konek->query( "UPDATE register SET status='B' WHERE id_register='".$_POST['id']."'");
			if($SQL){
				echo json_encode("OK");
			}
			break;
	}

?>

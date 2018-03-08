<?php
	//Connection Database
include "../koneksi.php";

	switch ($_POST['type']) {

		//Tampilkan Data
		case "get":

			$SQL = $konek->query( "SELECT sub_ruang.sub_ruang_id,ruang.ruang_id,ruang.ruang_no,ruang.ruang_name,sub_ruang.sub_ruang_no,sub_ruang.sub_ruang_name FROM ruang
			 INNER JOIN sub_ruang ON ruang.ruang_id = sub_ruang.ruang_id  WHERE sub_ruang.sub_ruang_id='".$_POST['id']."'");
			$return = $SQL->fetch_array();;
			echo json_encode($return);
			break;

		//Tambah Data
		case "new":

			$SQL = $konek->query(
									"INSERT INTO sub_ruang SET
										ruang_id='".$_POST['no_ruang']."',
										sub_ruang_no='".$_POST['no_sub_ruang']."',
										sub_ruang_name='".$_POST['nama_sub_ruang']."'");
			if($SQL){
				echo json_encode("OK");
			}
			break;

		//Edit Data
		case "edit":

			$SQL = $konek->query(
									"UPDATE sub_ruang SET
										ruang_id='".$_POST['no_ruang']."',
										sub_ruang_no='".$_POST['no_sub_ruang']."',
										sub_ruang_name='".$_POST['nama_sub_ruang']."' WHERE sub_ruang_id='".$_POST['id']."'
								");
							
			if($SQL){
				echo json_encode("OK");
			}
			break;

		//Hapus Data
		case "delete":

			$SQL = $konek->query( "DELETE FROM  sub_ruang WHERE sub_ruang_id='".$_POST['id']."'");
			if($SQL){
				echo json_encode("OK");
			}
			break;
	}

?>

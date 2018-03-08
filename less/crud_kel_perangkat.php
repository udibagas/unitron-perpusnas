<?php
	//Connection Database
include "../koneksi.php";

	switch ($_POST['type']) {

		//Tampilkan Data
		case "get":

			$SQL = $konek->query( "SELECT kelompok_perangkat.kelompok_perangkat_no,kelompok_perangkat.kelompok_perangkat_id,kelompok_perangkat.kelompok_perangkat_name,golongan_perangkat.golongan_perangkat_name,golongan_perangkat.golongan_perangkat_id FROM kelompok_perangkat
INNER JOIN golongan_perangkat ON kelompok_perangkat.golongan_perangkat_id = golongan_perangkat.golongan_perangkat_id
  WHERE kelompok_perangkat.kelompok_perangkat_id='".$_POST['id']."'");
			$return = $SQL->fetch_array();;
			echo json_encode($return);
			break;

		//Tambah Data
		case "new":

			$SQL = $konek->query(
									"INSERT INTO kelompok_perangkat SET
										golongan_perangkat_id='".$_POST['no_gol_perangkat']."',
										kelompok_perangkat_no='".$_POST['no_kel_perangkat']."',
										kelompok_perangkat_name='".$_POST['nama_kel_perangkat']."'");
			if($SQL){
				echo json_encode("OK");
			}
			break;

		//Edit Data
		case "edit":

			$SQL = $konek->query(
									"UPDATE kelompok_perangkat SET
										golongan_perangkat_id='".$_POST['no_gol_perangkat']."',
										kelompok_perangkat_no='".$_POST['no_kel_perangkat']."',
										kelompok_perangkat_name='".$_POST['nama_kel_perangkat']."' WHERE kelompok_perangkat_id='".$_POST['id']."'
								");
							
			if($SQL){
				echo json_encode("OK");
			}
			break;

		//Hapus Data
		case "delete":

			$SQL = $konek->query( "DELETE FROM kelompok_perangkat WHERE kelompok_perangkat_id='".$_POST['id']."'");
			if($SQL){
				echo json_encode("OK");
			}
			break;
	}

?>

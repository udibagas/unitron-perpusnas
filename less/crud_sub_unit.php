<?php
	//Connection Database
include "../koneksi.php";

	switch ($_POST['type']) {

		//Tampilkan Data
		case "get":

			$SQL = $konek->query( "SELECT sub_unit.sub_unit_no,sub_unit.sub_unit_id,sub_unit.sub_unit_name,unit.unit_name,unit.unit_id FROM sub_unit
INNER JOIN unit ON sub_unit.unit_id = unit.unit_id
  WHERE sub_unit.sub_unit_id='".$_POST['id']."'");
			$return = $SQL->fetch_array();;
			echo json_encode($return);
			break;

		//Tambah Data
		case "new":

			$SQL = $konek->query(
									"INSERT INTO sub_unit SET
										unit_id='".$_POST['no_unit']."',
										sub_unit_no='".$_POST['no_sub_unit']."',
										sub_unit_name='".$_POST['nama_sub_unit']."'");
			if($SQL){
				echo json_encode("OK");
			}
			break;

		//Edit Data
		case "edit":

			$SQL = $konek->query(
									"UPDATE sub_unit SET
										unit_id='".$_POST['no_unit']."',
										sub_unit_no='".$_POST['no_sub_unit']."',
										sub_unit_name='".$_POST['nama_sub_unit']."' WHERE sub_unit_id='".$_POST['id']."'
								");
							
			if($SQL){
				echo json_encode("OK");
			}
			break;

		//Hapus Data
		case "delete":

			$SQL = $konek->query( "DELETE FROM sub_unit WHERE sub_unit_id='".$_POST['id']."'");
			if($SQL){
				echo json_encode("OK");
			}
			break;
	}

?>

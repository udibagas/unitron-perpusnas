<?php
	//Connection Database
include "../koneksi.php";

	switch ($_POST['type']) {

		//Tampilkan Data
		case "get":

			$SQL = $konek->query( "SELECT * FROM tim_req WHERE id_tim='".$_POST['id']."'");
			$return = $SQL->fetch_array();;
			echo json_encode($return);
			break;

		//Tambah Data
		case "new":


			$ss = $konek->query("SELECT MAX(id_req) as up FROM request");
			$dd = $ss->fetch_assoc();

			$kode_req=$dd['up'];



			


			@session_start();
			$req = $_SESSION['id_req'];
			$userid = date("ymdhis")."_".rand(0,10);

			

			if(isset($_POST['tt'])==false){
			$SQL = $konek->query(
									"INSERT INTO tim_req SET
										id_register='$req',
										nama='".$_POST['nama']."',
										jabatan='".$_POST['jabatan']."',
										instansi='".$_POST['instansi']."'
								");

			}else{

				$ee = $konek->query("SELECT COUNT(id_perpanjang) as up FROM pp_kunjungan WHERE id_req='$req'");
			$tt = $ee->fetch_assoc();

			$tt2=$tt['up']+1;

			$req1 = $req.$tt2;

			$SQL = $konek->query(
									"INSERT INTO tim_req SET
										id_register='$req',
										nama='".$_POST['nama']."',
										jabatan='".$_POST['jabatan']."',
										instansi='".$_POST['instansi']."',	
										id_perpanjang='$req1'
								");
			}
			if($SQL){
				echo json_encode("OK");
			}
			break;

		//Edit Data
		case "edit":

			$SQL = $konek->query(
									"UPDATE tim_req SET
										nama='".$_POST['nama']."',
										jabatan='".$_POST['jabatan']."',
										instansi='".$_POST['instansi']."'
									WHERE id_tim='".$_POST['userid']."'
								");
							
			if($SQL){
				echo json_encode("OK");
			}
			break;

		//Hapus Data
		case "delete":

			$SQL = $konek->query( "DELETE FROM tim_req WHERE id_tim='".$_POST['id']."'");
			if($SQL){
				echo json_encode("OK");
			}
			break;
	}

?>

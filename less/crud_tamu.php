<?php
	//Connection Database
include "../koneksi.php";

	switch ($_POST['type']) {

		//Tampilkan Data
		case "get":

			$SQL = $konek->query("SELECT request.id_req,request.surat_jawaban,request.status_hadir,request.nota_dinas,register.nama,request.alasan_perpanjang,request.perpanjang,register.alamat,register.email,register.instansi,request.tujuan,request.status,request.pendamping,request.akses_ruang,request.file,request.tanggal_masuk,request.tanggal_keluar,request.status_review FROM request INNER JOIN register ON request.id_regis = register.id_register WHERE request.id_req='$_POST[id]'");

  $num_row = $SQL->num_rows;
  if($num_row<1) {
    $SQL = $konek->query("SELECT request.id_req,request.surat_jawaban,request.status_hadir,request.nota_dinas,request.alasan_perpanjang,request.perpanjang,request.tujuan,request.`status`,request.pendamping,request.akses_ruang,request.file,request.tanggal_masuk,request.tanggal_keluar,users.username,users.no_indentitas,(users.nama_lengkap) as nama,users.kolok,(ref_lokasi_tbl.naloks) as alamat,(ref_lokasi_tbl.nalokl) as instansi,users.email,users.`level`,request.status_review FROM request 
INNER JOIN users ON request.id_regis = users.username INNER JOIN ref_lokasi_tbl ON ref_lokasi_tbl.kolok = users.kolok  WHERE request.id_req='$_POST[id]'");
    $num_row = $SQL->num_rows;
}

			//$SQL = $konek->query( "SELECT * FROM request WHERE id_req='".$_POST['id']."'");
			$return = $SQL->fetch_array();;
			echo json_encode($return);
			break;

		//Tambah Data
		
		case "edit":

			//$SQL = $konek->query(
									//"UPDATE request SET
									///	country_name='".$_POST['nama_kota']."'
									// WHERE country_code='".$_POST['id']."'
								//");
			$konek->query("UPDATE request SET status_hadir='Y' WHERE id_req='$_POST[id]'");
            $SQL = $konek->query("UPDATE enroll SET aktif='Y',status='Y' WHERE id_req='$_POST[id]'");
            //echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=p6buku&tipe=detail&id=$id_req' />";
							
			if($SQL){
				echo json_encode("OK");
			}
			break;

		//Hapus Data
		case "delete":

			$SQL = $konek->query( "DELETE FROM  request WHERE id_req='".$_POST['id']."'");
			if($SQL){
				echo json_encode("OK");
			}
			break;
	}

?>

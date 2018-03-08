<?php 
	$arr = array();
	date_default_timezone_set("Asia/Jakarta");
	include "../koneksi.php";
	$pesan = "";
	// $sql = $konek->query("INSERT INTO log(log) value('test')");
	$sql = $konek->query("SELECT trans5.pesan,sensor.NAMALOKASI,sensor.POSISIDETAIL FROM trans5 INNER JOIN sensor ON trans5.ID_SENSOR = sensor.ID_SENSOR WHERE  trans5.pesan<>'' AND trans5.id IN (SELECT MAX(id)AS id FROM trans5  GROUP BY ID_SENSOR ) group by sensor.ID_SENSOR");
	$cek = $sql->num_rows;

	while($data = $sql->fetch_assoc()){
	$arr[]=$data;
	$pesan = $pesan.$data['pesan']." | ";
	}
	//echo $cek;
	if($cek>0){
	$sql2 = $konek->query("SELECT waktu,pesan FROM histori_alert ORDER BY id_alert DESC LIMIT 1");
	$dwaktu = $sql2->fetch_assoc();
	$tgl_awal = $dwaktu['waktu'];
	$tgl_skrg = date("Y-m-d H:i:s");
	$pes = $dwaktu['pesan'];


	$selisih= strtotime($tgl_skrg)-strtotime($tgl_awal);

	if($selisih>5800 || $pes!=$pesan){
		$konek->query("INSERT INTO histori_alert(waktu,pesan,baru) VALUES(NOW(),'$pesan','Y')");
	}

	//echo $tgl_awal. " - ". $tgl_skrg. " = ". $selisih ."<br>";
	}

$konek->close();
	echo json_encode($arr);
	
?>
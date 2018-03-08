<?php 
include "../koneksi.php";

if(isset($_GET['action']) && $_GET['action'] == "get_pegawai") {

    $username = trim($_GET['nama']);
    $query = "SELECT users.username, users.`password`, users.nama_lengkap,users.email,users.nalokl,ref_kojab_tbl.najabs FROM users INNER JOIN ref_kojab_tbl ON users.kojab = ref_kojab_tbl.kojab WHERE users.nama_lengkap='$username'";
    
   
    $sql = $konek->query($query);

    $csql = $sql->num_rows;

    if($csql<1){

    	 $query = "SELECT nama as nama_lengkap, instansi as nalokl ,jabatan as najabs FROM tim_req WHERE nama='$username'";
    
    	$sql = $konek->query($query);
    }

    $step = array();
    while ($row = $sql->fetch_assoc()) {
        array_push($step, $row);
    }
    echo json_encode($step);
    exit;
}
?>
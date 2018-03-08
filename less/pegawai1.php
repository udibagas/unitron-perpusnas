<?php 
include "../koneksi.php";

if(isset($_GET['action']) && $_GET['action'] == "get_pegawai") {

    $username = $_GET['username'];
    $query = "SELECT username,password,nama_lengkap,email,nalokl FROM users WHERE username='$username'";
    
   
    $sql = $konek->query($query);
    $step = array();
    while ($row = $sql->fetch_assoc()) {
        array_push($step, $row);
    }
    echo json_encode($step);
    exit;
}
?>
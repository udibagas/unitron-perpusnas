<?php 
include "../koneksi.php";

if(isset($_GET['action']) && $_GET['action'] == "getruang") {
    $kode = $_GET['kode_ruang'];
    
    //ambil data kabupaten
    $query = "SELECT DISTINCT PARAMETER FROM sensor WHERE PARAMETER<>'Gas' AND NAMALOKASI='$kode'";
    $sql = $konek->query($query);
    $param = array();
    while ($row = $sql->fetch_assoc()) {
        array_push($param, $row);
    }
    $konek->close();
    echo json_encode($param);
    exit;
}
?>
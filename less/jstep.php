<?php 
include "../koneksi.php";

if(isset($_GET['action']) && $_GET['action'] == "get_step") {
    $kategori = $_GET['kategori'];
    
    if($kategori=="ALL"){
    $query = "SELECT id_step,nama_bpp,'' as no_bpp, 'ALL' as kode FROM step GROUP BY nama_bpp ORDER BY id_step";
    }else{
    $query = "SELECT id_step,nama_bpp,no_bpp, 'bagi' as kode FROM step WHERE nama_bpp='$kategori' GROUP BY nama_bpp,no_bpp ORDER BY id_step";
    }
    $sql = $konek->query($query);
    $step = array();
    while ($row = $sql->fetch_assoc()) {
        array_push($step, $row);
    }
    echo json_encode($step);
    exit;
}
?>


<?php 
include "../koneksi.php";
if (isset($_REQUEST['query'])) {
    $query = $_REQUEST['query'];
    $sql = $konek->query("SELECT DISTINCT nama as nama_lengkap FROM tim_req WHERE nama LIKE '%{$query}%' OR instansi LIKE '%{$query}%'
UNION ALL
SELECT nama_lengkap FROM users WHERE username LIKE '%{$query}%' OR nama_lengkap LIKE '%{$query}%' LIMIT 15");
    $array = array();
    while ($row = $sql->fetch_assoc()) {
        $array[] = array (
            'label' => $row['nama_lengkap'].', '.$row['nama_lengkap'],
            'value' => $row['nama_lengkap'],
        );
    }
    //RETURN JSON ARRAY
    echo json_encode ($array);
}


?>
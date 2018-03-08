

<?php 
include "../koneksi.php";
if (isset($_REQUEST['query'])) {
    $query = $_REQUEST['query'];
    $sql = $konek->query("SELECT username,nama_lengkap FROM users WHERE username LIKE '%{$query}%' OR nama_lengkap LIKE '%{$query}%' LIMIT 10");
    $array = array();
    while ($row = $sql->fetch_assoc()) {
        $array[] = array (
            'label' => $row['username'].', '.$row['nama_lengkap'],
            'value' => $row['username'],
        );
    }
    //RETURN JSON ARRAY
    echo json_encode ($array);
}


?>
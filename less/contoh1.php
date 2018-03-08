<?php
$value = json_decode($_POST['json']);

$query=$value->query;

include "../koneksi.php";
//$query="SELECT * FROM sensor";
$query = $query.'';
$sql = $konek->query($query);
$arr=array();


while($data=$sql->fetch_assoc()){
	$arr[]=$data;
}

echo json_encode($arr);

?>
<?php
$url = "./jsensor.php";
$jsonUrl = file_get_contents($url, False);
$json_idr = json_decode($jsonUrl, true);
print_r($json_idr);
?>

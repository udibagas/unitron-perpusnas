<?php
$page=htmlentities($_GET['page']);
$halaman="$page.php";

if(!file_exists($halaman) || empty($page)){
	include "page_404.php";
}else{
	include "$halaman";
}
?>

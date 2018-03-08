<?php 
@session_start();

 $level = $_SESSION['level'];

 if($level=="admin" || $level=="SA"){
 	echo "<meta http-equiv='refresh' content='0;url=media.php?page=ikhtisar' />";
 } elseif($level=="user"){
 	echo "<meta http-equiv='refresh' content='0;url=media.php?page=ikhtisar' />";
  } elseif($level=="skpd"){
 	echo "<meta http-equiv='refresh' content='0;url=media.php?page=ikhtisar' />";
 } elseif($level=="operator"){
 	echo "<meta http-equiv='refresh' content='0;url=media.php?page=status_tamu' />";
 } elseif($level=="pj"){
 	echo "<meta http-equiv='refresh' content='0;url=media.php?page=ikhtisar' />";
 } elseif($level=="atasan"){
 	echo "<meta http-equiv='refresh' content='0;url=media.php?page=ikhtisar' />";
 } else{
 	echo "<meta http-equiv='refresh' content='0;url=media.php?page=ikhtisar' />";
 }

?>
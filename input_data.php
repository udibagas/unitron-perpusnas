
<?php require_once('koneksi.php'); 
include 'plugin/PHPExcel/IOFactory.php'; ?>

<?php


if ( isset($_POST["submit"]) ) {

if ( isset($_FILES["file"])) {

//if there was an error uploading the file
if ($_FILES["file"]["error"] > 0) {
echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
}
else {
if (file_exists($_FILES["file"]["name"])) {
unlink($_FILES["file"]["name"]);
}
$storagename = "data.xlsx";
move_uploaded_file($_FILES["file"]["tmp_name"],  $storagename);

$inputFileName = 'data.xlsx'; 
$uploadedStatus = 0;

try {
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
} catch(Exception $e) {
	die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}

$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
$arrayCount = count($allDataInSheet); 

//$konek->query("TRUNCATE TABLE sensor");

for($i=2;$i<=$arrayCount;$i++){

  $ruang = trim($allDataInSheet[$i]["B"]);
  $no_rak = trim($allDataInSheet[$i]["C"]);
  $merek_rak = trim($allDataInSheet[$i]["D"]);
  $posisi = trim($allDataInSheet[$i]["E"]);
  $merek_tipe = trim($allDataInSheet[$i]["F"]);
  $file_gambar = trim($allDataInSheet[$i]["G"]);
  $nama_pemilik = trim($allDataInSheet[$i]["H"]);
  $lan_konek = trim($allDataInSheet[$i]["I"]);
  $power_konek = trim($allDataInSheet[$i]["J"]);
  $info = trim($allDataInSheet[$i]["K"]);
  

 $sql = $konek->query("UPDATE product SET ruang='$ruang',kojab='$kojab',nrk_atasan='$nrk_atasan' WHERE username='$nrk'");
	

$msg = 'Data Berhasil Di Import. <div style="Padding:20px 0 0 0;"></div>';
echo "$sql";

}
echo "<div style='font: bold 18px arial,verdana;padding: 45px 0 0 500px;'>".$msg."</div>";
 



$uploadedStatus = 1;
}
} else {
echo "No file selected <br />";
}
}


if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

?>
<div class="art-layout-wrapper">
                <div class="art-content-layout">
                    <div class="art-content-layout-row">
                        <div class="art-layout-cell art-content">
                          <p>&nbsp;</p>
                         

<form name="import" method="post" action="?page=input_data" enctype="multipart/form-data">

<div class="abcdefg">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h2>Form Update Data User</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        
                                       
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
      <div class="panel-body">
     <input class="btn btn-default btn-file" type="file" name="file" /> File Harus Berupa .xlsx, silahkan download contoh dokumen update dibawah ini.<br /><br />
        <input class="btn btn-info" type="submit" name="submit" value="Update Data" />
        <a href="contoh.xlsx" class="btn btn-success">Download Contoh File Update..</a>

    </div>
</div>        
</form>
                            </p>
                            <p>&nbsp;</p>
                          </form>
                          
                          <p>&nbsp;</p>

                        </div>
                    </div>
                </div>
            </div>


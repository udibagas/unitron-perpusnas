
<?php 
      include "less/cek_bpp.php"; ?>
      <?php 
      include "less/cek_bpp.php"; ?><div class="row">
                        <div class="abcdefg">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h2>Langkah</h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">

<ul class="progress-indicator">
            <?php include "view/step_permohonan.php"; ?>
        </ul>
       </div>
     </div>
  </div>
</div>

<?php 
$kode = "rekomendasi";

if(isset($_GET['tipe'])==true){
	$tipe=mysqli_real_escape_string($konek, $_GET['tipe']);
}else{
	$tipe="aktif";
}

	if($tipe=="aktif"){
		include "view/bppdc41/inrekom_mon.php";
	}
?>
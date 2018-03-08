<div class="row">
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
 <?php include_once "view/bpp21/nextback.php"; ?>
<?php 
$kode = "buku";
$t = "ra";
if(isset($_GET['tipe'])==true){
	$tipe=mysqli_real_escape_string($konek, $_GET['tipe']);
}else{
	$tipe="aktif";
}

	if($tipe=="aktif"){
		include "view/bpp21/manage_req.php";

	}elseif($tipe=="detail"){
        include "view/bpp21/detail_req.php";
    }

    elseif($tipe=="manage"){
     include "view/bpp21/manage_req.php";
    }
    elseif($tipe=="itinerary"){
        include "view/bpp21/itinerary.php";
    }
    
    
?>
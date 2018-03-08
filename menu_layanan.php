 <?php
 @session_start();
 include "koneksi.php";
 if($_SESSION['level']=="admin" || $_SESSION['level']=="pj"){
 	$banyak = $konek->query("SELECT (SELECT COUNT(id_kategori_layanan) FROM layanan) as layanan, (SELECT COUNT(id_req) FROM request WHERE `status`='N' OR `status`='P' OR `status`='Y') as p_izin");
 }elseif($_SESSION['level']=="user"){
 	$banyak = $konek->query("SELECT (SELECT COUNT(id_kategori_layanan) FROM layanan) as layanan, (SELECT COUNT(id_req) FROM request WHERE (`status`='N' OR `status`='P' OR `status`='Y') AND id_regis='$_SESSION[id_req]') as p_izin");
 }elseif($_SESSION['level']=="atasan"){
 	$banyak = $konek->query("SELECT (SELECT COUNT(id_kategori_layanan) FROM layanan) as layanan, (SELECT COUNT(id_req) FROM request WHERE `atasan`='Y') as p_izin");
 	} else{
 		$banyak = $konek->query("SELECT (SELECT COUNT(id_kategori_layanan) FROM layanan) as layanan, (SELECT COUNT(id_req) FROM request) as p_izin");
 	}

 	$dbanyak = $banyak->fetch_assoc();

  ?>


<!--
 <div class="  col-lg-12 col-md-12 col-sm-21 col-xs-12">
    <div class="tile-stats">
    	<p align="center"><img src="images/menu/head.png" width="100%" /></p>

    </div>
</div>
-->
<div class="row">&nbsp;</div>
<div class="row" >
	
		 <div class="animated flipInY col-lg-3 col-md-3 col-sm-4 col-xs-6">
		 <a href="?page=tabel_layanan" class="tile-stats">
		    	<p align="center"><img src="images/menu/daftar layanan.jpg" width="50%" height="50%"/></p>
		        <h2 align="center" id="t_air">Daftar Layanan <span class="badge"><?php echo $dbanyak['layanan']; ?></span></h2>
		 </a>
		</div>
	</a>

		 <div class="animated flipInY col-lg-3 col-md-3 col-sm-4 col-xs-6">
		   <a href="?page=ikhtisar" class="tile-stats">
		    	<p align="center"><img src="images/menu/summary monitorring.jpg" width="50%" height="50%"/></p>
		        <h2 align="center" id="t_air">Sumarry Monitoring</h2>
		    </a>
		</div>

		 <div class="animated flipInY col-lg-3 col-md-3 col-sm-4 col-xs-6">
		    <a href="?page=inventory" class="tile-stats">
		    	<p align="center"><img src="images/menu/asset.jpg" width="50%" height="50%"/></p>
		        <h2 align="center" id="t_air">Manajemen Aset</h2>
		    </a>
		</div>

		 <div class="animated flipInY col-lg-3 col-md-3 col-sm-4 col-xs-6">
		   <a href="?page=standart_perangkat" class="tile-stats">
		    	<p align="center"><img src="images/menu/standarisasi perangkat.jpg" width="50%" height="50%"/></p>
		        <h2 align="center" id="t_air">Standarisasi Perangkat</h2>
		   </a>
		</div>
</div>

<div class="row">
		 <div class="animated flipInY col-lg-3 col-md-3 col-sm-4 col-xs-6">
		    
		    <?php if($_SESSION['level']=="pj" || $_SESSION['level']=="admin" || $_SESSION['level']=="atasan"){ ?>
		        <a href="?page=status_pending" class="tile-stats">
		    	<p align="center"><img src="images/menu/Pending izin.jpg" width="50%" height="50%"/></p>
		        <h2 align="center" id="t_air">Pending Izin <span class="badge"><?php echo $dbanyak['p_izin']; ?></span></h2> 
		    </a>
		    <?php }
		    elseif($_SESSION['level']=="user"){
		     ?>
		      <a href="?page=status_pending" class="tile-stats">
		    	<p align="center"><img src="images/menu/Pending izin.jpg" width="50%" height="50%"/></p>
		      <h2 align="center" id="t_air">Pending Izin <span class="badge"><?php echo $dbanyak['p_izin']; ?></span></h2> 
		    </a>
		    <?php } 
		    elseif($_SESSION['pengelola']=="Y"){
		     ?>
		      <a href="?page=buka_finger" class="tile-stats">
		    	<p align="center"><img src="images/menu/Pending izin.jpg" width="50%" height="50%"/></p>
		      <h2 align="center" id="t_air">Buka Ruang <span class="badge"></span></h2> 
		    </a>
		    <?php } ?>

		</div>

		 <div class="animated flipInY col-lg-3 col-md-3 col-sm-4 col-xs-6">
		   <a href="#" class="tile-stats">
		    	<p align="center"><img src="images/menu/Pending pekerjaan.jpg" width="50%" height="50%"/></p>
		        <h2 align="center" id="t_air">Pending Pekerjaan</h2>
		    </a>
		</div>

		 <div class="animated flipInY col-lg-3 col-md-3 col-sm-4 col-xs-6">
		   <a href="?page=sdm_summery" class="tile-stats">
		    	<p align="center"><img src="images/menu/manajemen.jpg" width="50%" height="50%"/></p>
		        <h2 align="center" id="t_air">Manajemen Sumber Daya Manusia</h2>
		    </a>
		</div>

		 <div class="animated flipInY col-lg-3 col-md-3 col-sm-4 col-xs-6">
		   <a href="?page=input_sop" class="tile-stats">
		    	<p align="center"><img src="images/menu/peraturan sop dan bpp.jpg" width="50%" height="50%"/></p>
		        <h2 align="center" id="t_air">Peraturan BPP dan SOP</h2>
		   </a>
		</div>
</div>
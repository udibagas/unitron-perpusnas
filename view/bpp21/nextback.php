<?php 
	$cekcek='BL';
	$link1 = mysqli_real_escape_string($konek, $_GET['page']);

    $hak_akses = $_SESSION['level'];
    $idd = $_SESSION['id_req'];


	if(isset($_GET['id'])==true){
		@session_start();
		$req1 = mysqli_real_escape_string($konek, $_GET['id']);
		$_SESSION['id']=mysqli_real_escape_string($konek, $_GET['id']);
		$qcs_user = "SELECT step_user,step_pj,status FROM request WHERE id_req='$req1'";
		$cs_user = $konek->query($qcs_user);
		$ncs_user = $cs_user->num_rows;
		$dcs_user = $cs_user->fetch_assoc();

		

		if(isset($_GET['cekcek'])==true){

		if($dcs_user['status']=='S'){
				echo "<meta http-equiv='refresh' content='0;URL=media.php?page=p12selesai&tipe=detail&id=$_SESSION[id]' />";
				exit;
		}

		if($dcs_user['status']=='P'){
				echo "<meta http-equiv='refresh' content='0;URL=media.php?page=ppk11pperpanjang&tipe=detail&id=$_SESSION[id]' />";
			exit;
		}

			
		
		if($hak_akses=='user'){

			if($dcs_user['step_user']!='' || $dcs_user['step_user']!=null){
			echo "<meta http-equiv='refresh' content='0;URL=media.php?page=$dcs_user[step_user]&tipe=detail&id=$_SESSION[id]' />";

		}

		}elseif($hak_akses=='pj'){

			if($dcs_user['step_pj']!='' || $dcs_user['step_pj']!=null){
			echo "<meta http-equiv='refresh' content='0;URL=media.php?page=$dcs_user[step_pj]&tipe=detail&id=$_SESSION[id]' />";
			
		}
		}
	}

	}

	$next = $konek->query("SELECT step,hak_akses,tabel_step,nama_bpp,no_bpp,field_harus_diisi,isi_field from step WHERE link='$link1' LIMIT 1");
	$dnext = $next->fetch_assoc();

	$qcek_next = "SELECT * from step WHERE no_bpp='$dnext[no_bpp]' AND nama_bpp='$dnext[nama_bpp]' AND step>$dnext[step] ";
	if($hak_akses!="admin"){
		$qcek_next=$qcek_next." AND (hak_akses='$dnext[hak_akses]' OR hak_akses='all')";
	}
	//echo "$qcek_next";
	$cek_next = $konek->query($qcek_next);
	$ncek_next = $cek_next->num_rows;
	$dcek_next = $cek_next->fetch_assoc();

	$qcek_back = "SELECT * from step WHERE no_bpp='$dnext[no_bpp]' AND nama_bpp='$dnext[nama_bpp]' AND step<$dnext[step] ";
	if($hak_akses!="admin"){
		$qcek_back=$qcek_back." AND (hak_akses='$dnext[hak_akses]' OR hak_akses='all')";
	}
	$qcek_back=$qcek_back." ORDER BY step DESC LIMIT 1";
	
	$cek_back = $konek->query($qcek_back);
	$ncek_back = $cek_back->num_rows;
	$dcek_back = $cek_back->fetch_assoc();

	if($dnext['field_harus_diisi']!=''  && $dnext['isi_field']!='') {
		$field = $dnext['field_harus_diisi'];
		$tabel = $dnext['tabel_step'];
		$query = "SELECT * FROM $tabel WHERE $field='$dnext[isi_field]' AND tiket='Y' ";
	
		$query = $query." AND id_req='$_SESSION[id]'";

		if($hak_akses=="user" ){
			$query = $query." AND id_regis='$idd'";	
		}
		$cek_field = $konek->query($query);
		//echo "$query";
		$ncek_field = $cek_field->num_rows;
		if($ncek_field>0){
			$cekcek = 'Y';
		}

		
	}elseif($dnext['field_harus_diisi']!=''  && ($dnext['isi_field']=='' || $dnext['isi_field']==null)){
		$tabel = $dnext['tabel_step'];
		$field = $dnext['field_harus_diisi'];
		//$query();
		$query = "SELECT * FROM $tabel WHERE $field <>'' AND tiket='Y' ";

		if(isset($_GET['id'])==true){
			$query = $query." AND id_req='$_SESSION[id]'";
		}
		if($_SESSION['level']=='user'){
		$query = $query." AND id_regis='$idd'";	
		}
		$cek_field = $konek->query($query);
		//echo "$query";
		$ncek_field = $cek_field->num_rows;
		if($ncek_field>0){
			$cekcek = 'Y';
		}
	
		
	}
	elseif($dnext['field_harus_diisi']==''  && $dnext['isi_field']==''){
		$cekcek = 'Y';
	}	

	if($hak_akses == "admin"){
		$cekcek = 'Y';
	}

	  if(isset($_GET['p'])==false){	
?>

<div class="row">
	<div class="abcdefg">	
		<div class="col-md-6 col-sm-6 col-xs-6">
		<?php if($ncek_back>0){	?>
		<a href="?page=<?php echo $dcek_back['link']; ?>&tipe=detail&id=<?php echo $_SESSION['id']; ?>" class="btn btn-info">&nbsp;&nbsp;&nbsp; <i class="fa fa-backward"></i> Kembali &nbsp;&nbsp;&nbsp;</a>
				<?php } ?>
		</div>

		<?php if($cekcek=='Y') {
			if($hak_akses == "user" || $hak_akses == "pj"){
				//header("Location: media.php?page=$dcek_next[link]");
			if(isset($_GET['tipe'])==false){
				
				 echo "<meta http-equiv='refresh' content='0;URL=media.php?page=$dcek_next[link]&id=$_SESSION[id]&tipe=detail' />";
			
			}
			}

		 ?>
		<div class="col-md-6 col-sm-6 col-xs-6" align="right">	
		<?php if($ncek_next>0){ ?>	
		<a href="?page=<?php echo $dcek_next['link']; ?>&tipe=detail&id=<?php echo $_SESSION['id'] ?>" class="btn btn-info">&nbsp;&nbsp;&nbsp; Lanjut <i class="fa fa-forward"></i> &nbsp;&nbsp;&nbsp;</a>
		<?php } ?>
		</div>
		<?php } ?>
	</div>
</div>
<?php } ?>
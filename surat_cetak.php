
<body onload="javascript:print()">
<?php

	include "koneksi.php";
  @session_start();
	$id_req=mysqli_real_escape_string($konek, $_GET['id']);
	$sql = $konek->query("SELECT request.id_req,register.nama,register.alamat,register.email,register.instansi,request.tujuan,request.status,request.pendamping,request.akses_ruang,request.file,request.tanggal_masuk,request.tanggal_keluar FROM request INNER JOIN register ON request.id_regis = register.id_register WHERE request.id_req='$id_req'");

	$data = $sql->fetch_assoc();
 ?>


	<div class="page-title">
                        <div class="title_left">
                            <h3>
                    Detail Izin
                    <small>
                      <!-- Some examples to get you started -->
                    </small>
                </h3>
                        </div>

                      </div>

                      <div class="clearfix"></div>

                      <div class="row">

                 <div class="abcdefg">	
                      <table border="1" class="table table-striped responsive-utilities jambo_table">	
                      <tr>
                     	<th>Id Permohonan</th>
                     	<td>: REQ<?php echo $data['id_req']; ?></td>
                      </tr>
                      <tr>
                     	<th>Nama</th>
                     	<td>: <?php echo $data['nama']; ?></td>
                      </tr>

                      <tr>
                     	<th>Alamat</th>
                     	<td>: <?php echo $data['alamat']; ?></td>
                      </tr>

                       <tr>
                     	<th>Email</th>
                     	<td>: <?php echo $data['email']; ?></td>
                      </tr>

                       <tr>
                     	<th>Instansi</th>
                     	<td>: <?php echo $data['instansi']; ?></td>
                      </tr>

                       <tr>
                     	<th>Tanggal Masuk</th>
                     	<td>: <?php echo $data['tanggal_masuk']; ?></td>
                      </tr>

                      <tr>
                     	<th>Tanggal Keluar</th>
                     	<td>: <?php echo $data['tanggal_keluar']; ?></td>
                      </tr>

                      <?php 
                      
                      if($_SESSION['level']=="admin"){
                      ?>
                      <tr>
                     	<th>Pendamping</th>
                     	<form method="POST" action="less/aksi.php?tipe=pendamping&module=ganti">
                     	<input type="hidden" name="id_req" value="<?php echo $data['id_req']; ?>" />
                     	<td>: <input type="text" name="pendamping" value="<?php echo $data['pendamping']; ?>" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="submit" class="btn btn-info btn-sm" value="Ganti Pendamping" /></td>
                     	</form>
                      </tr>
                      <?php } else { ?>
                        <tr>
                      <th>Pendamping</th>
                      <form method="POST" action="less/aksi.php?tipe=pendamping&module=ganti">
                     
                      <td>: <?php echo $data['pendamping']; ?> </td>
                      </form>
                      </tr>
                      <?php } ?>

                      <tr>
                     	<th>Akses Ruang</th>
                     	<td>: <?php echo $data['akses_ruang']; ?></td>
                      </tr>

                      <tr>
                     	<th>Status</th>
                     	<td>: <?php 


                     	$stat = $data['status'];

                     	if($stat=="N"){
                     		echo "<i class='fa fa-exclamation'></i> Belum Di Konfirmasi</a>";
                     	}elseif($stat=="Y"){
                     		echo "<i class='fa fa-check'> Sudah Di Konfirmasi";
                     	}elseif($stat=="B"){
                     		echo "<i class='fa fa-times-circle'> Dibatalkan Pemohon";
                     	}elseif($stat=="R"){
                     		echo "<i class='fa fa-close'> Ditolak";
                     	}elseif($stat=="S"){
                     		echo "<i class='fa fa-check-square'> Sudah Selesai";
                     	}

                     	 ?></td>
                      </tr>

                      <tr>
                      <?php 
                      
                      if($_SESSION['level']=="admin"){
                      ?>

                     	<th>Aksi</th>
                     	<td>:                   

                     	<?php
                     		if($stat=="N"){ ?>

                     		<a href="less/aksi.php?tipe=request&module=terima&id=<?php echo $data['id_req']; ?>" class="btn btn-success" onclick="return confirm ('Apakah Permohonan ini akan diterima ?')"><i class="fa fa-check"></i> Diterima</a>
                     		  <a href="less/aksi.php?tipe=request&module=tolak&id=<?php echo $data['id_req']; ?>" class="btn btn-danger" onclick="return confirm ('Apakah Permohonan ini akan ditolak ?')"><i class="fa fa-close"></i> Ditolak</a>	

                     	<?php 
                     	}elseif($stat=="Y"){ ?>
                     		<a href="less/aksi.php?tipe=request&module=batal&id=<?php echo $data['id_req']; ?>" class="btn btn-danger" onclick="return confirm ('Apakah Permohonan ini akan ditolak ?')"><i class="fa fa-close"></i> Batal Konfirmasi</a>	
                     	<?php }elseif($stat=="R"){ ?>
                          <a href="less/aksi.php?tipe=request&module=batal&id=<?php echo $data['id_req']; ?>" class="btn btn-danger" onclick="return confirm ('Apakah Permohonan ini akan ditolak ?')"><i class="fa fa-close"></i> Batal Konfirmasi</a> 
                      <?php
                     	  } }
                     	 ?>	
                     	
                     </td>
                      </tr>

                      </table>
                      <h2>Anggota Tim</h2>

                      <table class="table table-striped responsive-utilities jambo_table">  
                        <thead>
                        <tr class="headings">
                        <th>No</th>
                        <th>Nama Tim</th>
                        <th>Jabatan</th>
                        <th>Instansi</th>
                      </tr>
                      </thead>

                      <?php 
                      $no=1;
                      $sql1 = $konek->query("SELECT * FROM tim_req WHERE id_req='$id_req' ");
                      while($data1=$sql1->fetch_assoc()){
                       ?>
                       

                      <tr>
                        <th><?php echo $no++; ?></th>
                        <th><?php echo $data1['nama']; ?></th>
                        <th><?php echo $data1['jabatan']; ?></th>
                        <th><?php echo $data1['instansi']; ?></th>
                      </tr>

                      <?php } ?>

            </thead>
                      </table>

                 </div>

                 

                </div>

</div>
</body>

<meta http-equiv="refresh" content="0;url=media.php?page=detail_req&id=<?php echo $id_req; ?>">

<?php 

    @session_start();
    if(isset($_SESSION['username'])==false)
    {
        echo "<meta http-equiv='refresh' content='0;URL=menu_login.php' />";
    }


	include "koneksi.php";
  @session_start();

	$id_req=mysqli_real_escape_string($konek, $_GET['id']);
	$sql = $konek->query("SELECT request.id_req,request.pengumuman,request.surat_jawaban,request.status_hadir,request.nota_dinas,register.nama,request.alasan_perpanjang,request.perpanjang,register.alamat,register.email,register.instansi,request.tujuan,request.status,request.pendamping,request.akses_ruang,request.file,request.tanggal_masuk,request.tanggal_keluar,request.status_review FROM request INNER JOIN register ON request.id_regis = register.id_register WHERE request.id_req='$id_req'");

  $num_row = $sql->num_rows;
  if($num_row<1) {
    $sql = $konek->query("SELECT request.id_req,request.pengumuman,request.surat_jawaban,request.status_hadir,request.nota_dinas,request.alasan_perpanjang,request.perpanjang,request.tujuan,request.`status`,request.pendamping,request.akses_ruang,request.file,request.tanggal_masuk,request.tanggal_keluar,users.username,users.no_indentitas,(users.nama_lengkap) as nama,users.kolok,(ref_lokasi_tbl.naloks) as alamat,(ref_lokasi_tbl.nalokl) as instansi,users.email,users.`level`,request.status_review FROM request 
INNER JOIN users ON request.id_regis = users.username INNER JOIN ref_lokasi_tbl ON ref_lokasi_tbl.kolok = users.kolok  WHERE request.id_req='$id_req'");

  }


	$data = $sql->fetch_assoc();


  if(($data['pendamping']!='' || $data['pendamping']!=null) && $_SESSION['level']=='pj' && $kode=='pemandu'){
   
  ?>

    <div align="center" class="alert alert-success alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Tugas Anda Sudah Selesai, Langkah Berikutnya dilanjutkan Oleh Pihak Lain</strong>
                                </div>

  <?php }  
  if($data['status_hadir']=='Y' && $_SESSION['level']=='user' && $kode=='buku') {
   
  ?>

    <div align="center" class="alert alert-success alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Buku Tamu Telah Terisi, silahkan berkunjung kedalam DataCenter </strong>
                                </div>

  <?php }

   if(isset($_GET['selesai'])==true){
   
  ?>

    <div align="center" class="alert alert-success alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Tugas Anda Sudah Selesai, Langkah Berikutnya dilanjutkan Oleh Pihak Lain</strong>
                                </div>

  <?php }

  $id_req=$data['id_req'];
if($_SESSION['level']=='user'){
 $cs_user = $konek->query("UPDATE request SET step_user='$_GET[page]' WHERE id_req='$id_req'");
}else{
 $cs_user = $konek->query("UPDATE request SET step_pj='$_GET[page]' WHERE id_req='$id_req'");
}
 ?>


	<div class="page-title">
                        <div class="title_left">
                            <h3>
                    Formulir Permohonan Online
                    <small>
                      <!-- Some examples to get you started -->
                    </small>
                </h3>
                        </div>

                      </div>

                      <div class="clearfix"></div>

                      <div class="row">

                 <div class="abcdefg">	
                      <table class="table table-striped responsive-utilities jambo_table">	
                      <tr>
                     	<th>No Tiket</th>
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
                     	<th>SKPD</th>
                     	<td>: <?php echo $data['instansi']; ?></td>
                      </tr

                      <tr>
                      <th>Tujuan</th>
                      <td>: <?php echo $data['tujuan']; ?></td>
                      </tr>
                       <tr>
                     	<th>Waktu Masuk</th>
                     	<td>: <?php echo date("d-m-Y h:m",strtotime($data['tanggal_masuk'])); ?></td>
                      </tr>

                      <tr>
                     	<th>Waktu Keluar</th>
                     	<td>: <?php echo date("d-m-Y h:m",strtotime($data['tanggal_keluar'])); ?></td>
                      </tr>

                      <tr>
                      <th>Surat Permohonan</th>
                      <td>:  <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Lihat Surat Permohonan</button>

                             <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <div class="col-md-6 col-sm-12 col-xs-12">  
                      <a class="media" href="upload/<?php echo $data['file']; ?>"></a> 
                  </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                                              
                                            </div>

                                        </div>
                                    </div>
                                </div></td>
                      </tr>

                      <?php 
                        if($kode=="setuju"){
                          if($data['surat_jawaban']==''){
                      ?>
                      
                      <form method="POST" action="less/aksi_pbk.php?tipe=sujaw&module=input&id=<?php echo $data['id_req']; ?>" enctype="multipart/form-data">
                      <tr>
                      <th bgcolor="#ffcc00">Upload Surat Jawaban</th>
                       <td bgcolor="#ffcc00">: <input type="file" name="file" accept=".pdf"/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; *<i>File Harus Berupa PDF dan ukuran file tidak boleh lebih dari 1 Mb.</i> <input class="btn btn-info" type="submit" value="Upload" /></td>
                      </tr>
                      </form>
                      <?php }}
                      if($data['surat_jawaban']!=''){
                        ?>

                        <form method="POST" action="less/aksi_pbk.php?tipe=sujaw&module=input&id=<?php echo $data['id_req']; ?>" enctype="multipart/form-data">
                      <tr>
                      <th>Upload Surat Jawaban</th>
                       <td>:File Sudah Di Upload  <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg2">Lihat Surat Jawaban</button>

                             <div class="modal fade bs-example-modal-lg2" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <div class="col-md-6 col-sm-12 col-xs-12">  
                      <a class="media" href="upload/<?php echo $data['surat_jawaban']; ?>"></a> 
                  </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                                              
                                            </div>

                                        </div>
                                    </div>
                                </div></td>
                      </tr>
                      </form>

                        <?php

                        } ?>

                      <?php 
                      if($kode=='itinerary'){
                        ?>
                        <tr>
                     

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                                              
                                            </div>

                                        </div>
                                    </div>
                                </div></td>
                      </tr>
                        <?php
                      }


                        if($kode=="realita"){
                      ?>
                       <tr>
                       <th>Lihat Pengumuman</th>
                       <td>: <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg1">Lihat Pengumuman</button>

                             <div class="modal fade bs-example-modal-lg1" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <div class="col-md-6 col-sm-12 col-xs-12">  
                                  <h2> Pengumuman</h2>
                                  <hr>
                                                <?php 
                                                  echo $data['pengumuman'];
                                                ?>


                  </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                                              
                                            </div>

                                        </div>
                                    </div>
                                </div></td>
                       </tr>


                      <?php } ?>
                       <?php if($kode=="perpanjang"){ ?>
                       <tr>
                       <th>Alasan Perpanjang</th>
                       <td>: <?php echo $data['alasan_perpanjang']; ?></td>
                       </tr>

                       <tr>
                       <th>Perpanjang Ke</th>
                       <td>: <?php echo $data['perpanjang']; ?></td>
                       </tr>
                       <?php } ?>

                      <?php 
                        $stat = $data['status'];
                     if($_SESSION['level']=="admin"|| $_SESSION['level']=="pj"){
                      ?>
                        <?php if($kode=="pemandu"){ ?>
                       
                      <tr>
                     	<th bgcolor="#ffcc00">Pemandu</th>
                      <?php
                      $sql = $konek->query("SELECT nama_lengkap FROM users WHERE username='$data[pendamping]' ORDER BY username LIMIT 10");
                      $pendamping = $sql->fetch_assoc();
                       ?>
                     	<form method="POST" action="less/aksi_pbk.php?tipe=pendamping&module=ganti">
                     	<input type="hidden" name="id_req" value="<?php echo $data['id_req']; ?>" />
                     	<td bgcolor="#ffcc00">: <?php echo $pendamping['nama_lengkap']; ?> &nbsp;&nbsp;&nbsp;   
                      <select name="pendamping">

                      
                      <option><?php echo $pendamping['nama_lengkap']; ?></option>

                      <?php
                       $sql = $konek->query("SELECT * FROM users WHERE level='user' AND pemandu='Y' ORDER BY username LIMIT 10");
                       while($data3=$sql->fetch_assoc()){
                        echo "<option class='form-control' value='$data3[username]'>$data3[nama_lengkap]</option>";
                       }

                       ?>

                      </select> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                      <input type="submit" class="btn btn-info btn-sm" value="Pilih Pemandu" /></td>
                     	</form>
                      </tr>
                      <?php } } else { ?>
 <form method="POST" action="less/aksi_pbk.php?tipe=pendamping&module=ganti">
                        <tr>

                      <th>Pemandu</th>
                     
                      
                      <td>:  <?php

                        $sql = $konek->query("SELECT nama_lengkap FROM users WHERE username='$data[pendamping]' ORDER BY username LIMIT 10");
                        $pendamping = $sql->fetch_assoc();
                       echo $pendamping['nama_lengkap']; ?> </td>
                      
                      </form>
                      </tr>
                      <?php } ?>

                      <tr>
                     	<th>Akses Ruang</th>
                     	<td>: <?php echo $data['akses_ruang']; ?></td>
                      </tr>

                       <?php if($kode=='perpanjang'){ ?>
                       <tr>
                       <th>Alasan Perpanjang</th>
                       <td>: <?php echo $data['alasan_perpanjang']; ?></td>
                       </tr>

                       <tr>
                       <th>Perpanjang Ke</th>
                       <td>: <?php echo $data['perpanjang']; ?></td>
                       </tr>
                       <?php } ?>

                      <tr>
                     	<th>Status Permohonan</th>
                     	<td>: <?php 

                     	if($stat=="N"){
                     		echo "<i class='fa fa-exclamation'></i> Belum Ada Jawaban</a>";
                     	}elseif($stat=="Y"){
                     		echo "<i class='fa fa-check'> Sudah Di Konfirmasi";
                     	}elseif($stat=="B"){
                     		echo "<i class='fa fa-times-circle'> Dibatalkan Pemohon";
                     	}elseif($stat=="R"){
                     		echo "<i class='fa fa-close'> Ditolak";
                     	}elseif($stat=="S"){
                     		echo "<i class='fa fa-check-square'> Sudah Selesai";
                     	}elseif($stat=="P"){
                        echo "<i class='fa fa-check-square'> Minta Perpanjang";
                      }

                     	 ?></td>

                      </tr>

                       <tr>
                      <th>Status Tiket</th>
                      <td>: <?php 

                      if($stat=="N"){
                        echo "Terbuka";
                      }elseif($stat=="Y"){
                        echo "<i class='fa fa-check'> Terbuka";
                      }elseif($stat=="B"){
                        echo "<i class='fa fa-times-circle'> Tertutup";
                      }elseif($stat=="R"){
                        echo "<i class='fa fa-close'> Tertutup";
                      }elseif($stat=="S"){
                        echo "<i class='fa fa-check-square'> Tertutup";
                      }elseif($stat=="P"){
                        echo "<i class='fa fa-check-square'> Perpanjang";
                      }

                       ?></td>
 
                      </tr>

                      <tr>

                     	<?php
                     		if($stat=="N" AND ($_SESSION['level']=='pj' || $_SESSION['level']=='admin')){ ?>
                        <th bgcolor="#ffcc00">Konfirmasi Persetujuan</th>
                      <td bgcolor="#ffcc00">:      
                     		<a href="less/aksi_pbk.php?tipe=request_pbk&module=terima&id=<?php echo $id_req; ?>" class="btn btn-success" onclick="return confirm ('Apakah Anda Menyetujui Permohonan ini ?')"><i class="fa fa-check"></i> Diterima</a>
                     		  <a href="less/aksi_pbk.php?tipe=request&module=tolak&id=<?php echo $id_req; ?>" class="btn btn-danger" onclick="return confirm ('Apakah Anda Yakin Menolak Permohonan ini ?')"><i class="fa fa-close"></i> Ditolak</a>	

                     	<?php 
                     	}elseif($stat=="Y"){ ?>
  

                         <?php if($kode=="selesai"){ ?>
                      <th bgcolor="#ffcc00">Aksi</th>
                      <td bgcolor="#ffcc00" >:  
                        <a href="less/aksi_pbk.php?tipe=request&module=selesai&id=<?php echo $id_req; ?>" class="btn btn-success" onclick="return confirm ('Apakah Permohonan ini akan ditolak ?')"><i class="fa fa-check"></i> Selesai</a> 
                         <?php } if($kode=="itinerary"){ ?>
                        <th bgcolor="#ffcc00">Mengisi Detail Aktifitas</th>
                        <td bgcolor="#ffcc00" >:  
                        <a class="btn btn-info" href="?page=pbk3itinerary&tipe=itinerary&id=<?php echo $data['id_req']; ?>&t=rn">Isi Detail Aktifitas</a> 
                        <?php } if($kode=="perpanjang"){ ?>
                         <th bgcolor="#ffcc00">Konfirmasi Perpanjangan</th>
                         <td bgcolor="#ffcc00" >:  
                        <a class="btn btn-info" href="?page=pbk10perpanjang&tipe=perpanjang&id=<?php echo $data['id_req']; ?>">Perpanjang Izin</a> 

                         <a onclick="return confirm ('Apakah Permohonan ini Sudah Selesai ?')" class="btn btn-warning" href="less/aksi_pbk.php?tipe=request&module=selesai&id=<?php echo $id_req; ?>">Selesai</a> 
                         <?php } 
                         if($kode=="realita"){ 
                          ?>

                          <?php
                          if($data['status_hadir']=='N'){
                          ?>
                      <th bgcolor="#ffcc00">Mengisi Buku Tamu</th>
                      <td bgcolor="#ffcc00" >:  
                         <a class="btn btn-info" href="less/aksi_pbk.php?tipe=buku&module=hadir&id=<?php echo $data['id_req']; ?>">Isi Buku Tamu</a> 

                         <?php }else{ ?>

                         <th bgcolor="#ffcc00">Berita Acara Kunjungan</th>
                      <td bgcolor="#ffcc00" >: 
                        <a class="btn btn-info" href="?page=pbk8realita&tipe=itinerary&id=<?php echo $data['id_req']; ?>&t=ra">Update Detail Aktifitas</a> 

                      <?php }}} echo "</td>";
                      if($stat=="P"){ 
                      if($kode=="pperpanjang"){ ?>
                        ?>

                      <th bgcolor="#ffcc00">Perpanjang</th>
                      <td bgcolor="#ffcc00" >:    

                        <a href="less/aksi_pbk.php?tipe=ppanjang&module=terima&id=<?php echo $id_req; ?>" class="btn btn-success" onclick="return confirm ('Apakah Permohonan ini akan diterima ?')"><i class="fa fa-check"></i> Terima Perpanjang</a>
                          <a href="less/aksi_pbk.php?tipe=ppanjang&module=tolak&id=<?php echo $id_req; ?>" class="btn btn-danger" onclick="return confirm ('Apakah Permohonan ini akan ditolak ?')"><i class="fa fa-close"></i> Tolak Perpanjang</a>  
                          
                      <?php
                     	  }}else{

                          if($stat=="Y"){ ?>
    
                      <?php }
                        
                      }

                        
                        if($kode=="pp"){

                          $sql = $konek->query("SELECT status FROM pemandu WHERE id_req='$id_req'");
                          $data = $sql->fetch_assoc();
                          $stat = $data['status'];

                          if($stat=="N"){
                            ?>
                            <a href="less/aksi_pbk.php?tipe=pemandu&module=terima&id=<?php echo $id_req; ?>" class="btn btn-success" onclick="return confirm ('Apakah Permohonan ini akan diterima ?')"><i class="fa fa-check"></i> Terima Sebagai Pemandu</a>

                            <a href="less/aksi_pbk.php?tipe=pemandu&module=tolak&id=<?php echo $id_req; ?>" class="btn btn-danger" onclick="return confirm ('Apakah Permohonan ini akan ditolak ?')"><i class="fa fa-close"></i> Tolak Sebagai Pemandu</a> 
                            <?php }
                          }
                     	 ?>	

                       <?php if($kode=="pengumuman"){

                          $sql = $konek->query("SELECT status FROM pemandu WHERE id_req='$id_req'");
                          $data = $sql->fetch_assoc();
                          $stat = $data['status'];

                          
                            ?>
                            <th bgcolor="#ffcc00">Mengisi Pengumuman</th>
                             <td bgcolor="#ffcc00"><a href="?page=pbk7pengumuman&tipe=pengumuman&id=<?php echo $id_req; ?>" class="btn btn-success"><i class="fa fa-check"></i> Isi Pengumuman </a></td>

                            
                            <?php
                          }
                       ?> 


                       <?php if($kode=="review"){
                        if($data['status_review']=='N' || $data['status_review']==null){

                            ?>
                            <th bgcolor="#ffcc00">Review Dampak</th>
                            <td bgcolor="#ffcc00">:      
                        <a href="less/aksi_pbk.php?tipe=review_pbk&module=terima&id=<?php echo $id_req; ?>" class="btn btn-success" onclick="return confirm ('Apakah Anda Menyetujui Permohonan ini ?')"><i class="fa fa-check"></i> Diterima</a>
                          <a href="less/aksi_pbk.php?tipe=review_pbk&module=tolak&id=<?php echo $id_req; ?>" class="btn btn-danger" onclick="return confirm ('Apakah Anda Yakin Menolak Permohonan ini ?')"><i class="fa fa-close"></i> Ditolak</a>  

                            <?php
                          }}
                       ?> 
                     	
                     </td>
                      </tr>

                      </table>

                      <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h3><i class="fa fa-bars"></i> Kunjungan 1<small></small></h3>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                      <h2>Daftar Pengunjung</h2>
                      <table class="table table-striped responsive-utilities jambo_table">  
                        <thead>
                        <tr class="headings">
                        <th>No</th>
                        <th>Nama Pengunjung</th>
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

                      </table> 
                      

                      <div class="col-md-6 col-sm-12 col-xs-12">
                      <br>
                      <h2>Detail Aktifitas Rencana</h2>

                        <table id="tabel1" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">

                                                <th width="5%" class="column-title">Nomor </th>
                                                <th width="20%" class="column-title">Waktu </th>
                                                <th width="15%" class="column-title">Lokasi </th>
                                                <th width="65%" class="column-title">Detail Kegiatan </th>
                                            </tr>
                            </thead>

                            <tbody>
                            <?php 
                                $no = 1;
                                $id2 = $id_req.'0';
                                $sql=$konek->query("SELECT * FROM itinerary WHERE status='Y' AND id_perpanjang='$id2' AND id_req='$id_req' AND tipe='rn' ORDER BY waktu DESC");
   
                                while($data=$sql->fetch_assoc()){
                            ?>
                                           <tr class="odd pointer">
                                                <td ><?php echo $no++; ?></td>
                                                <td ><?php echo $data['waktu']; ?></td>
                                                <td ><?php echo $data['lokasi']; ?></td>
                                                <td ><?php echo $data['detail_aktifitas']; ?></td>
                                                <?php } ?>
                                            </tr>

                                            </tbody>
                                    </table>
                                    </div>

                                    <br>
                                    <?php 
                                     $sql=$konek->query("SELECT * FROM itinerary WHERE status='Y' AND id_perpanjang='$id2' AND id_req='$id_req' AND tipe='ra' ORDER BY waktu DESC");
                                     $nr = $sql->num_rows;

                                     if($nr>0){
                                    ?>
   
                      <div class="col-md-6 col-sm-12 col-xs-12">
                              <h2>Detail Aktifitas Realita</h2>
                                    <table id="tabel1" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th width="5%" class="column-title">Nomor </th>
                                                <th width="20%" class="column-title">Waktu </th>
                                                <th width="15%" class="column-title">Lokasi </th>
                                                <th width="65%" class="column-title">Detail Kegiatan </th>
                                            </tr>
                            </thead>

                            <tbody>
                            <?php 
                                $no = 1;
     
                                while($data=$sql->fetch_assoc()){
                            ?>
                                           <tr class="odd pointer">
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $data['waktu']; ?></td>
                                                <td><?php echo $data['lokasi']; ?></td>
                                                <td><?php echo $data['detail_aktifitas']; ?></td>
                                                
                                                    <?php } ?>
                                            </tr>

                                            </tbody>

                                    </table>
                                    </div></div>

                                    <?php } ?>

                      </div>
  <!--################################################################################### -->
                      <?php 
                      $no=1;
                      $sql2 = $konek->query("SELECT * FROM pp_kunjungan WHERE id_req='$id_req' ");
                      while($data2=$sql2->fetch_assoc())
                      {
                       ?>
                      <hr>
                      <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h3><i class="fa fa-bars"></i> Perpanjangan Kunjungan <?php echo $no++; ?><small></small></h3>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">

                      <table class="table table-striped responsive-utilities jambo_table">  
                        <tr>
                      <th>Tanggal Perpanjang</th>
                      <td>: <?php echo $data2['tanggal_perpanjang']; ?></td>
                      </tr>
                      <tr>
                      <th>Alasan Perpanjang</th>
                      <td>: <?php echo $data2['alasan_perpanjang']; ?></td>
                      </tr>
                      <tr>
                      <th>Ruang Akses</th>
                      <td>: <?php echo $data2['ruang_masuk']; ?></td>
                      </tr>
                    </table>

                    <h2>Daftar Pengunjung</h2>
                      <table class="table table-striped responsive-utilities jambo_table">  
                        <thead>
                        <tr class="headings">
                        <th>No</th>
                        <th>Nama Pengunjung</th>
                        <th>Jabatan</th>
                        <th>Instansi</th>
                      </tr>
                      </thead>
                      <?php 
                      $no=1;
                      $sql1 = $konek->query("SELECT * FROM tim_req WHERE id_perpanjang='$data2[id_perpanjang]' AND id_req='$id_req' ");
                      while($data1=$sql1->fetch_assoc()){
                       ?>
                      <tr>
                        <th><?php echo $no++; ?></th>
                        <th><?php echo $data2['nama']; ?></th>
                        <th><?php echo $data2['jabatan']; ?></th>
                        <th><?php echo $data2['instansi']; ?></th>
                      </tr>

                      <?php } ?>

                      </table> 

<div class="col-md-6 col-sm-12 col-xs-12">
                      <h2>Detail Rencana</h2>


                        <table id="tabel1" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th width="5%" class="column-title">Nomor </th>
                                                <th width="20%" class="column-title">Waktu </th>
                                                <th width="15%" class="column-title">Lokasi </th>
                                                <th width="65%" class="column-title">Detail Kegiatan </th>
                                            </tr>
                            </thead>


                            <tbody>
                            <?php 
                                $no = 1;
                               
                                $sql=$konek->query("SELECT * FROM itinerary WHERE status='Y' AND id_req='$id_req' AND tipe='rn' AND id_perpanjang='$data2[id_perpanjang]' ORDER BY waktu DESC");

   
                                while($data=$sql->fetch_assoc()){
                            ?>
                                           <tr class="odd pointer">
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $data['waktu']; ?></td>
                                                <td><?php echo $data['lokasi']; ?></td>
                                                <td><?php echo $data['detail_aktifitas']; ?></td>
                                                
                                                    <?php } ?>
                                            </tr>

                                            </tbody>

                                    </table>

                                    </div>

                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                    <?php 
                                     $sql=$konek->query("SELECT * FROM itinerary WHERE status='Y' AND id_req='$id_req' AND tipe='ra' AND id_perpanjang='$data2[id_perpanjang]' ORDER BY waktu DESC");
                                     $nr = $sql->num_rows;

                                     if($nr>0){
                                    ?>

                      <h2>Detail Aktifitas Realita</h2>

                                    <table id="tabel1" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th width="5%" class="column-title">Nomor </th>
                                                <th width="20%" class="column-title">Waktu </th>
                                                <th width="15%" class="column-title">Lokasi </th>
                                                <th width="65%" class="column-title">Detail Kegiatan </th>
                                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $no = 1;
                                while($data=$sql->fetch_assoc()){
                            ?>
                                           <tr class="odd pointer">
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $data['waktu']; ?></td>
                                                <td><?php echo $data['lokasi']; ?></td>
                                                <td><?php echo $data['detail_aktifitas']; ?></td>
                                                
                                                    <?php } ?>
                                            </tr>

                                            </tbody>

                                    </table>
                                    </div>
                                    <hr>
                                    <?php } ?>
                    </div>
                  <?php } ?>
                 </div>
  
                </div>

</div>


  <script type="text/javascript" src="js/jquery.media.js"></script> 
  <script type="text/javascript" src="jquery.metadata.js"></script> 
  <script>
  $(document).ready(function() {
  	$('a.media').media({width:700, height:700});
  });
  </script>
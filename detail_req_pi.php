<?php 

    @session_start();
    if(isset($_SESSION['username'])==false)
    {
        echo "<meta http-equiv='refresh' content='0;URL=menu_login.php' />";
    }


?>
<?php

	include "koneksi.php";
  @session_start();

	$id_req=mysqli_real_escape_string($konek, $_GET['id']);
	$sql = $konek->query("SELECT req_pi.id_req,req_pi.surat_jawaban,register.nama,register.alamat,register.email,register.instansi,req_pi.tanggal_masuk,req_pi.tujuan,req_pi.`status`,req_pi.rekomendasi,req_pi.akses_ruang,req_pi.nota_dinas,req_pi.dokumen_usulan,req_pi.dokumen_evaluasi,req_pi.dokumen_gap,req_pi.dokumen_pendukung FROM register
INNER JOIN req_pi ON req_pi.id_regis = register.id_register WHERE req_pi.id_req='$id_req'");

  $num_row = $sql->num_rows;
  if($num_row<1) {
    $sql = $konek->query("SELECT users.username,users.no_indentitas,req_pi.surat_jawaban,users.nama_lengkap AS nama,users.kolok,ref_lokasi_tbl.naloks AS alamat,ref_lokasi_tbl.nalokl AS instansi,users.email,users.`level`,req_pi.tanggal_masuk,req_pi.tujuan,req_pi.`status`,req_pi.rekomendasi,req_pi.akses_ruang,req_pi.nota_dinas,req_pi.dokumen_usulan,req_pi.dokumen_evaluasi,req_pi.dokumen_gap,req_pi.dokumen_pendukung,req_pi.id_req FROM users
INNER JOIN ref_lokasi_tbl ON ref_lokasi_tbl.kolok = users.kolok
INNER JOIN req_pi ON req_pi.id_regis = users.username
  WHERE req_pi.id_req='$id_req'");

  }


	$data = $sql->fetch_assoc();

  $id_req=$data['id_req'];
 ?>


	<div class="page-title">
                        <div class="title_left">
                            <h3>
                    Formulir Capacity Planning
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
                     	<td>: CPQ<?php echo $data['id_req']; ?></td>
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
                     	
                      <?php
                      if($data['dokumen_usulan']!=''){
                       ?>
                      <tr>
                      <th>Dokumen Usulan</th>
                      <td>:  <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Lihat Surat Usulan</button>

                             <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <div class="col-md-6 col-sm-12 col-xs-12">  
                      <a class="media" href="upload/<?php echo $data['dokumen_usulan']; ?>"></a> 
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
                    }
                      if($data['dokumen_evaluasi']!=''){
                       ?>

                        <tr>
                      <th>Dokumen Evaluasi</th>
                      <td>:  <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg1">Lihat Surat Evaluasi</button>

                             <div class="modal fade bs-example-modal-lg1" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <div class="col-md-6 col-sm-12 col-xs-12">  
                      <a class="media1" href="upload/<?php echo $data['dokumen_evaluasi']; ?>"></a> 
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

                      <?php 
                        if($kode=="eval"){
                          if($data['dokumen_evaluasi']==''){
                      ?>
                      
                      <form method="POST" action="less/aksi.php?tipe=doeval&module=input&id=<?php echo $data['id_req']; ?>" enctype="multipart/form-data">
                      <tr>
                      <th>Upload Dokumen Evaluasi</th>
                       <td>: <input type="file" name="file" accept=".pdf"/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; *<i>File Harus Berupa PDF dan ukuran file tidak boleh lebih dari 1 Mb.</i> <input class="btn btn-info" type="submit" value="Upload" /></td>
                      </tr>
                      </form>
                      <?php }else
                      {
                        ?>

                        <form method="POST" action="less/aksi.php?tipe=doeval&module=input&id=<?php echo $data['id_req']; ?>" enctype="multipart/form-data">
                      <tr>
                      <th>Upload Surat Evaluasi</th>
                       <td>:File Sudah Di Upload </td>
                      </tr>
                      </form>

                        <?php

                        }} ?>

                         <?php 
                        if($kode=="rencana"){
                          if($data['surat_jawaban']==''){
                      ?>
                      
                      <form method="POST" action="less/aksi.php?tipe=doeval&module=input&id=<?php echo $data['id_req']; ?>" enctype="multipart/form-data">
                      <tr>
                      <th>Upload Surat Jawaban</th>
                       <td>: <input type="file" name="file" accept=".pdf"/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; *<i>File Harus Berupa PDF dan ukuran file tidak boleh lebih dari 1 Mb.</i> <input class="btn btn-info" type="submit" value="Upload" /></td>
                      </tr>
                      </form>
                      <?php }else
                      {
                        ?>

                        <form method="POST" action="less/aksi.php?tipe=doeval&module=input&id=<?php echo $data['id_req']; ?>" enctype="multipart/form-data">
                      <tr>
                      <th>Upload Surat Evaluasi</th>
                       <td>:File Sudah Di Upload </td>
                      </tr>
                      </form>
                        <?php
                        }} ?>
                        <?php 
                        if($kode=="analisa"){
                      ?>
                  

                      <?php    
                          if($data['dokumen_gap']==''){
                      ?>
                      
                      <form method="POST" action="less/aksi.php?tipe=dogap&module=input&id=<?php echo $data['id_req']; ?>" enctype="multipart/form-data">
                      <tr>
                      <th>Upload Dokumen GAP</th>
                       <td>: <input type="file" name="file" accept=".pdf"/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; *<i>File Harus Berupa PDF dan ukuran file tidak boleh lebih dari 1 Mb.</i> <input class="btn btn-info" type="submit" value="Upload" /></td>
                      </tr>
                      </form>
                      <?php }else
                      {
                        ?>

                        <form method="POST" action="less/aksi.php?tipe=sujaw&module=input&id=<?php echo $data['id_req']; ?>" enctype="multipart/form-data">
                      <tr>
                      <th>Upload Dokumen GAP</th>
                       <td>:File Sudah Di Upload  <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg2">Lihat Surat Jawaban</button>

                             <div class="modal fade bs-example-modal-lg2" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <div class="col-md-6 col-sm-12 col-xs-12">  
                      <a class="media" href="upload/<?php echo $data['dokumen_gap']; ?>"></a> 
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

                        }} ?>

                      <?php 
                      if($kode=='itinerary'){
                        ?>
                        <tr>
                      <th>Upload Surat Jawaban</th>
                       <td>: <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg2">Lihat Surat Jawaban</button>

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
                        <?php
                      }


                        if($kode=="pp"){
                      ?>
                       <tr>
                       <th>Nota Dinas</th>
                       <td>: <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg1">Lihat Nota Dinas</button>

                             <div class="modal fade bs-example-modal-lg1" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <div class="col-md-6 col-sm-12 col-xs-12">  
                                  <h2> Nota Dinas</h2>
                                  <hr>
                                                <?php 
                                                  echo $data['nota_dinas'];
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
                       

                      <?php 
                        $stat = $data['status'];
                      if($_SESSION['level']=="admin"){
                      ?>
                        <?php if($kode=="pemandu"){ ?>
                        <tr>
                       <th>Nota Dinas</th>
                       <td>: <a class="btn btn-info" href="?page=p4pemandu&tipe=nota&id=<?php echo $data['id_req']; ?>">Input Nota Dinas</a></td>
                       </tr>

                      <tr>
                     	<th>Pemandu</th>
                      <?php
                      $sql = $konek->query("SELECT nama_lengkap FROM users WHERE username='$data[pendamping]' ORDER BY username LIMIT 10");
                      $pendamping = $sql->fetch_assoc();
                       ?>
                     	<form method="POST" action="less/aksi.php?tipe=pendamping&module=ganti">
                     	<input type="hidden" name="id_req" value="<?php echo $data['id_req']; ?>" />
                     	<td>: <?php echo $pendamping['nama_lengkap']; ?> &nbsp;&nbsp;&nbsp;   
                      <select name="pendamping">

                      
                      <option><?php echo $pendamping['nama_lengkap']; ?></option>

                      <?php
                       $sql = $konek->query("SELECT * FROM users WHERE level='user' ORDER BY username LIMIT 10");
                       while($data3=$sql->fetch_assoc()){
                        echo "<option class='form-control' value='$data3[username]'>$data3[nama_lengkap]</option>";
                       }

                       ?>

                      </select> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                      <input type="submit" class="btn btn-info btn-sm" value="Pilih Pemandu" /></td>
                     	</form>
                      </tr>
                      <?php } } else { ?>

                        <tr>
                      <th>Pemandu</th>
                      <form method="POST" action="less/aksi.php?tipe=pendamping&module=ganti">
                      
                      <td>:  <?php echo $data['pendamping']; ?> </td>
                      
                      </form>
                      </tr>
                      <?php } ?>

                      

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
                      
                      if($_SESSION['level']=="admin"){
                      
                        if($stat=="Y"){ ?>
                      <th>Aksi</th>
                      <td>:    
                     		
                         <?php if($kode=="selesai"){ ?>
                        <a href="less/aksi.php?tipe=request&module=selesai&id=<?php echo $id_req; ?>" class="btn btn-success" onclick="return confirm ('Apakah Permohonan ini akan ditolak ?')"><i class="fa fa-check"></i> Selesai</a> 
                         <?php } if($kode=="itinerary"){ ?>
                        <a class="btn btn-info" href="?page=p3itinerary&tipe=itinerary&id=<?php echo $data['id_req']; ?>&t=rn">Isi Detail Aktifitas</a> 
                        <?php } if($kode=="perpanjang"){ ?>
                        <a class="btn btn-info" href="?page=p7perpanjang&tipe=perpanjang&id=<?php echo $data['id_req']; ?>">Perpanjang Izin</a> 

                         <a onclick="return confirm ('Apakah Permohonan ini Sudah Selesai ?')" class="btn btn-warning" href="less/aksi.php?tipe=request&module=selesai&id=<?php echo $id_req; ?>">Selesai</a> 
                         <?php } if($kode=="buku"){ 

                          if($data['status_hadir']=='N'){
                          ?>
                         <a class="btn btn-info" href="less/aksi.php?tipe=buku&module=hadir&id=<?php echo $data['id_req']; ?>">Hadir</a> 

                         <?php }else{ ?>
                        <a class="btn btn-info" href="?page=p6buku&tipe=itinerary&id=<?php echo $data['id_req']; ?>&t=ra">Update Detail Aktifitas</a> 

                      <?php }}}
 }else{

                          if($stat=="Y"){ ?>
                          <th>Aksi</th>
                      <td>:    
                        <a href="?page=surat_cetak&id=<?php echo $data['id_req']; ?>" class="btn btn-info" onclick="return confirm ('Apakah Permohonan ini akan Dicetak ?')"><i class="fa fa-check"></i> Print Surat Izin</a> 
                      <?php }
                        
                      }

                    if($kode=='rekomendasi'){ ?>
                    <th>Aksi</th>
                      <td>:   


               <a class="btn btn-info" href="?page=cp4rekomendasi&tipe=rekomendasi&id=<?php echo $data['id_req']; ?>">Isi Rekomendasi</a> 
                        
                        <?php } 


                     if($kode=='rencana'){ ?>
                    <th>Aksi</th>
                      <td>:   
                       <a class="btn btn-info" href="less/aksi.php?tipe=cp&module=setuju&id=<?php echo $id_req; ?>">Setuju</a> 

                       <a class="btn btn-info" href="less/aksi.php?tipe=cp&module=tolak&id=<?php echo $id_req; ?>">Tolak</a>
                        
                        <?php } ?>
                       </td>
                      </tr>
                      </table>
                      <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h3><i class="fa fa-bars"></i> Planning<small></small></h3>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                      <h2>Planning Awal</h2>
                      <table class="table table-striped responsive-utilities jambo_table">  
                        <thead>
                        <tr class="headings">
                        <th>No</th>
                        <th>Judul Planning</th>
                        <th>Detail Planning</th>
                        <th>Keterangan</th>
                      </tr>
                      </thead>

                      <?php 
                      $no=1;
                      $sql1 = $konek->query("SELECT * FROM rencana WHERE id_req='$id_req' ");
                      while($data1=$sql1->fetch_assoc()){
                       ?>
                      <tr>
                        <th><?php echo $no++; ?></th>
                        <th><?php echo $data1['judul_rencana']; ?></th>
                        <th><?php echo $data1['detail_rencana']; ?></th>
                        <th><?php echo $data1['keterangan']; ?></th>
                      </tr>

                      <?php } ?>

                      </table> 
   
                      <div class="abcdefg">
                              <h2>Rekomendasi Kajian</h2>
                                    <table id="tabel1" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th width="5%" class="column-title">Nomor </th>
                                                <th width="20%" class="column-title">Rekomendasi </th>
                                                <th width="15%" class="column-title">Detail Rekomendasi </th>
                                                <th width="65%" class="column-title">keterangan </th>
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


                      </div>
  <!--################################################################################### -->
                      <?php 
                      $no=1;
                      $sql2 = $konek->query("SELECT * FROM rekom_cp WHERE id_req='$id_req' ");
                      while($data2=$sql2->fetch_assoc())
                      {
                       ?>
                      <hr>
                      <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h3><i class="fa fa-bars"></i> Rekomendasi <?php echo $no++; ?><small></small></h3>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">

                      <table class="table table-striped responsive-utilities jambo_table">  
                        <tr>
                      <th>Rekomendasi</th>
                      <td>: <?php echo $data2['rekomendasi']; ?></td>
                      </tr>
                      <tr>
                      <th>Detail Rekomendasi</th>
                      <td>: <?php echo $data2['detail_rekomendasi']; ?></td>
                      </tr>
                      <tr>
                      
                    </table>
                    <?php } ?>
                   
  
                </div>

</div>


  <script type="text/javascript" src="js/jquery.media.js"></script> 
  <script type="text/javascript" src="jquery.metadata.js"></script> 
  <script>
  $(document).ready(function() {
  	$('a.media').media({width:700, height:700});
  });
  $(document).ready(function() {
    $('a.media1').media({width:700, height:700});
  });
  </script>


            <!-- page content -->
           
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                
                            </div>
                        </div>
                    </div>
				
               
					
                    <div class="clearfix"></div>
                        <div class="clearfix"></div>
                        <div class="clearfix"></div>

                        <div class="abcdefg">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h2>Rekap Permohonan Izin Yang Masih Pending Sebagai Pemandu</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                       
                                        
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <h2>Saring Berdasarkan Tanggal</small></h2>
                                <div class="panel-body">

                        <form method="POST">
   <div class="col-md-2 col-sm-6 col-xs-12">
                                            


                                            <fieldset>
                                                <div class="control-group">
                                                    <div class="controls">
                                                        <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                                            <input type="text" class="form-control has-feedback-left" id="single_cal1" placeholder="Tanggal Awal" aria-describedby="inputSuccess2Status" name="tgl_awal" data-toggle="tooltip" data-placement="bottom" title="<h2>Inputkan Tanggal Awal</h2>" >
                                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                            <span id="inputSuccess2Status" class="sr-only">(success)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>

                                        </div>

   

    <div class="col-md-2 col-sm-6 col-xs-12">                                
                                            <fieldset>
                                                <div class="control-group">
                                                    <div class="controls">
                                                        <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                                            <input type="text" class="form-control has-feedback-left" id="single_cal2" placeholder="Tanggal Akhir" aria-describedby="inputSuccess2Status" name="tgl_akhir" data-toggle="tooltip" data-placement="bottom" title="<h2>Inputkan Tanggal Akhir</h2>">
                                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                            <span id="inputSuccess2Status" class="sr-only">(success)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
</div>

 <div class="col-md-1 col-sm-6 col-xs-12">   
 <input type="submit" class="btn btn-info" name="t1" value="Filter"/>

 </div>


</form>

                                    <table id="tabel2" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th  class="column-title">Nomor </th>
                                                <th  class="column-title">No Tiket </th> 
                                                <th  align="Center" class="column-title"> Waktu Masuk</th>
												<th  align="Center" class="column-title"> Waktu Keluar</th>
                                                <th align="Center" class="column-title">Status</span></th>

                                                
                                                <th class="column-title no-link last"><span class="nobr">Aksi</span>
                                                </th>
                                                <th class="column-title"><span class="nobr">Detail</span>
                                            </tr>
								
                            </thead>

                            <tbody>
                            <?php 
                            @session_start();
                            $_SESSION['id']="1"; 
                                $no = 1;

                                if(isset($_POST['tgl_awal'])==false){
                                    $idd = $_SESSION['id_req'];
                                $sql=$konek->query("SELECT * FROM request WHERE pendamping='$idd' AND status<>'S' AND status_hadir='N'  ORDER BY tanggal_masuk DESC");
                               
                                }else{
                                    $tgl1 = mysqli_real_escape_string($konek, $_POST['tgl_awal']);
                                    $tgl2 = mysqli_real_escape_string($konek, $_POST['tgl_akhir']);
                                if($tgl1 != null && $tgl2!= null){
                                  
                                  $tgl1 = date("Y-m-d",strtotime($tgl1));   
                                  $tgl2 = date("Y-m-d",strtotime($tgl2)); 

                                  $sql=$konek->query("SELECT * FROM request WHERE pendamping='$idd' AND tanggal_masuk BETWEEN '$tgl1' AND '$tgl2' AND (status<>'S') AND status_hadir='N' ORDER BY tanggal_masuk DESC");   
                              }else{
                                $sql=$konek->query("SELECT * FROM request WHERE pendamping='$idd' AND (status<>'S') AND status_hadir='N' ORDER BY tanggal_masuk DESC");   
                                echo "SELECT * FROM request WHERE pendamping='$idd' AND (status<>'S')  ORDER BY tanggal_masuk DESC";
                              }

                                  echo "<h2>Tampilkan Dari Tanggal $tgl1 -> $tgl2</h2>";
                                }
                                while($data=$sql->fetch_assoc()){
                            
                            ?>

                                           <tr class="odd pointer">
                                                <td><?php echo $no++; ?></td>
                                                <td>REQ<?php echo $data['id_req']; ?></td>
                                                <td><?php echo $data['tanggal_masuk']; ?></td>
                                                <td><?php echo $data['tanggal_keluar']; ?></td>


                                                 <?php if($data['status']=="N"){ ?>
												<td class=" last"><p>Belum DiKonfirmasi</p></td>
                                                <td><a class="btn btn-info" onclick="return confirm ('Apakah Permohonan ini akan dibatalkan ?')"  href="less/aksi.php?tipe=request&module=batalkan&id=<?php echo $data['id_req']; ?>">Batalkan</a></td>

                                                 <?php }elseif($data['status']=="S"){ ?>
                                                <td class=" last"><p>Konfirmasi Diterima</p></td>
                                                <td>
                                                <h2><span class="fa fa-check"> Selesai</span></h2></td>

                                                <?php }elseif($data['status']=="Y"){ ?>
                                                <td class=" last"><p>Konfirmasi Diterima</p></td>
                                           <td><a onclick="return confirm ('Apakah Permohonan ini akan Dibatalkan ?')" class="btn btn-danger"  href="#">Batalkan</a>
                                           
                                           </td>

                                                  <?php }elseif($data['status']=="R"){ ?>
                                                <td class=" last"><p class="btn btn-danger">Ditolak</p></td>
                                              <td class=" last"><h2><span class="fa fa-close"> Ditolak</span></h2></td>

                                              <?php }elseif($data['status']=="P"){ ?>
                                                <td class=" last"><p class="btn btn-warning">Diperpanjang</p></td>
                                              <td class=" last"><h2><span class="fa fa-check"> Menunggu Konfirmasi</span></h2></td>

                                                    <?php }else{ ?>
                                                         <td class=" last"><p>DiBatalkan</p></td>
                                                <td>
                                                <h2><span class="fa fa-times"> Batal</span></h2></td>

                                                    <?php } ?>
                                                    <?php if($_SESSION['level']=='pj'){?>
                                                      <td><a class="btn btn-info" href="?page=p1permohonan&tipe=detail&id=<?php echo $data['id_req']; ?>&cekcek=on">Detail</a></td>
                                                      <?php }else{
                                                      if($_SESSION['pemandu']=='N'){ ?>
                                                        <td><a class="btn btn-info" href="?page=p1permohonan&id=<?php echo $data['id_req']; ?>&cekcek=on">Detail</a></td>

                                                      <?php }else{ ?>

                                                       <td><a class="btn btn-info" href="?page=p6buku&p=y&tipe=detail&id=<?php echo $data['id_req']; ?>">Detail</a></td>

                                                       <?php } ?>
                                            </tr>

                            <?php }} ?>
                                            
                                            </tbody>

                                    </table>
                                </div></div>
                <!-- footer content -->
                

    

    
    <!-- form validation -->




</div>
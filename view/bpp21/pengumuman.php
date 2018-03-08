<?php
	$id_req = mysqli_real_escape_string($konek, $_GET['id']);


    $qcek_pengumuman = "SELECT pengumuman,stat_pengumuman from request WHERE id_req='$id_req'";
    $cek_pengumuman = $konek->query($qcek_pengumuman);
    $dcek_pengumuman = $cek_pengumuman->fetch_assoc();
    $pengumuman = $dcek_pengumuman['pengumuman'];
    $sp = $dcek_pengumuman['stat_pengumuman'];
?>

<h2>Pengumuman</h2>

<div class="row">
                        <div class="abcdefg">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h2>Form Pengumuman</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        
                                       
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                <?php if($pengumuman=='' || $pengumuman==null){ ?>
                                    <form method="POST" action="less/aksi_ppk.php?tipe=pengumuman_ppk&module=input" class="form-horizontal form-label-left" enctype="multipart/form-data">
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Pengumuman <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input name="id" type="hidden" value="<?php echo $id_req; ?>" /> 
                                               <input type="file" name="file" accept=".pdf"/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; *<i>File Harus Berupa PDF dan ukuran file tidak boleh lebih dari 1 Mb.</i> <input class="btn btn-info" type="submit" value="Upload" />
                                            </div>
                                        </div>
										
                                        <div class="ln_solid"></div>
                                       
                                    </form>
                                    <?php }else{ 

                                         if($sp=="" || $sp==null || $sp == "N"){?>

                                    <h2 align="center">Apakah Pengumuman Sudah Di Umumkan ?</h2>

                                     <h2 align="center"> <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg2">Lihat Pengumuman</button></h2>

                             <div class="modal fade bs-example-modal-lg2" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <div class="col-md-6 col-sm-12 col-xs-12">  
                                                 <a class="media" href="upload/<?php echo $pengumuman; ?>"></a> 
                                                 </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                                              
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="row" align="center">

                                <a href="less/aksi_ppk.php?tipe=pengumuman&module=terima&id=<?php echo $id_req; ?>" class="btn btn-success" onclick="return confirm ('Apakah Anda Menyetujui Permohonan ini ?')"><i class="fa fa-check"></i> Sudah</a>
                              

                                </div>


                                    <?php }

                                    else{ ?>


                    <h2 align="center">Langkah ini sudah selesai, akan dilanjutkan oleh pihak lain</h2>

                    <?php

                                                                        }

                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>


      <script src="js/ckeditor/ckeditor.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/jquery.media.js"></script> 
  <script type="text/javascript" src="js/jquery.metadata.js"></script> 
  <script>
  $(document).ready(function() {
    $('a.media').media({width:700, height:700});
  });
  </script>
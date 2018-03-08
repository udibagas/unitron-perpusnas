<?php
	$id_req = mysqli_real_escape_string($konek, $_GET['id']);


    $qcek_pengumuman = "SELECT pengumuman from request WHERE id_req='$id_req'";
    $cek_pengumuman = $konek->query($qcek_pengumuman);
    $dcek_pengumuman = $cek_pengumuman->fetch_assoc();
    $pengumuman = $dcek_pengumuman['pengumuman'];
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
                                    <form method="POST" action="less/aksi_pbk.php?tipe=pengumuman_pbk&module=input" class="form-horizontal form-label-left" novalidate>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Pengumuman <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input name="id" type="hidden" value="<?php echo $id_req; ?>" /> 
                                               <textarea name="nota" class="ckeditor">


                                                </textarea>
                                            </div>
                                        </div>
										
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <button id="send" type="submit" name="submit1" class="btn btn-success btn-lg">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                    <?php }else{ ?>

                                    <h2 align="center">Pengumuman Sudah Dikirim, Langkah selanjutnya akan di lanjutkan oleh pihak lain</h2>

                                     <h3 align="center">Isi Pengumuman :<br> <?php echo $pengumuman; ?></h3>


                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>


      <script src="js/ckeditor/ckeditor.js" type="text/javascript"></script>
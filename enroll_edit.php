  <?php 
  $id = mysqli_real_escape_string($konek, $_GET['id']);
  $qsql="SELECT * FROM enroll_master WHERE kode_enroll='$id'";
  $sql = $konek->query($qsql);
  $dsql = $sql->fetch_assoc();

  ?>


   <form method="POST" action="less/aksi.php?tipe=finger&module=edit" class="form-horizontal form-label-left" enctype="multipart/form-data">
            <div class="abcdefg">
                                    <form method="POST" action="less/aksi.php?tipe=request&module=input" class="form-horizontal form-label-left" enctype="multipart/form-data">

            <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="nama">Kode Enroll <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input id="kode_enroll" type="text" name="kode_enroll" data-validate-length-range="4,20" class="optional form-control col-md-7 col-xs-12" 
                                                 value="<?php echo $dsql['kode_enroll']; ?>" readonly>
                                            </div>
                                        </div>

                 <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="nama">Nama <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input id="username" type="text" name="username" data-validate-length-range="4,20" class="optional form-control col-md-7 col-xs-12" 
                                                 value="<?php echo $dsql['username']; ?>" >
                                            </div>
                                        </div>

                  <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="nama">Password <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input id="password" type="text" name="password" data-validate-length-range="4,20" class="optional form-control col-md-7 col-xs-12" 
                                                 value="<?php echo $dsql['password']; ?>" >
                                            </div>
                                        </div>

                  <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="nama">Card <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input id="card" type="text" name="card" data-validate-length-range="4,20" class="optional form-control col-md-7 col-xs-12" 
                                                 value="<?php echo $dsql['card_id']; ?>" >
                                            </div>
                                        </div>

                  <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="nama">Hak Akses <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                               <select name="hak_akses" class="form-control">
                                               <option value="<?php echo $dsql['hak_akses']; ?>"><?php echo $dsql['hak_akses']; ?></option>
                                                  <option value="<?php echo $dsql['hak_akses']; ?>">Pilih Hak Akses</option>
                                                  <option value="0">User</option>
                                                  <option value="2">Admin</option>
                                               </select>
                                            </div>
                                        </div>                      

									<div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="tujuan">Sidik Jari <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <textarea id="sidik_jari" name="sidik_jari" class="form-control col-md-7 col-xs-12" data-toggle="tooltip" data-placement="bottom" title="Inputkan Sidik Jari" readonly><?php echo $dsql['temp_sidik_jari']; ?></textarea>
                                                </div>
                                            </div>

                  <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="tujuan">Data Wajah <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <textarea id="wajah" name="wajah" class="form-control col-md-7 col-xs-12" data-toggle="tooltip" data-placement="bottom" title="Inputkan Tujuan" readonly><?php echo $dsql['temp_wajah']; ?></textarea>
                                                </div>
                                            </div>

                  <div class="item form-group">

                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="tujuan">Exception 
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                  <?php 	
                                                  	$n=1;
                                                  	$qq = $konek->query("SELECT ruang_name FROM ruang ORDER by ruang_id");
                                                  	while($data=$qq->fetch_assoc()){
                                                      //echo $dsql['exception'];
                                                      $ss = 'N';
                                                      $pecah = explode(",", $dsql['exception']);
                                                      $jumlah = count($pecah);
                                                      for($a=1;$a<=$jumlah-1;$a++){
                                                        
                                                        if(trim($data['ruang_name'])==trim($pecah[$a])){
                                                          $ss = 'Y';
                                                        }
                                                      } 
                                                   ?>
                                                  <label>
                                                        <input type="checkbox" name="ch<?php echo $n; ?>" class="flat" value="<?php echo $data['ruang_name']; ?>" 
                                                        <?php 
                                                          if($ss=='Y'){
                                                            echo "checked";
                                                          }
                                                        ?>

                                                         /> <?php echo $data['ruang_name']; ?>  &nbsp;&nbsp;
                                                   </label>
                                                   <?php $n++;

                                                   } ?>
                                            </div>
                                            </div>


                                            <div class="item form-group">
                                            <div align="center" class="col-md-8 col-sm-8 col-xs-12">
                                              <input name='submit' type="submit" name="submit" value="Simpan" class="btn btn-info" />
                                            </div>
                                            
                                            </div>

  </form>
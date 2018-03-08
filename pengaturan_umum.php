<?php 

    @session_start();
    if(isset($_SESSION['username'])==false)
    {
        echo "<meta http-equiv='refresh' content='0;URL=menu_login.php' />";
    }

    $sql = $konek->query("SELECT `set` FROM pengaturan WHERE pengaturan='ikhtisar' ");
    $data = $sql->fetch_assoc();
    $tipe = $data['set'];
    
    $nomor = array();
    $sql1 = $konek->query("SELECT `set` FROM pengaturan WHERE LEFT(pengaturan,5)='no_hp' ");
    while($data1=$sql1->fetch_assoc())
    {
        $nomor[]=$data1['set'];
    }
?>

            <!-- page content -->
           
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Pengaturan
                    <small>
                      <!-- Some examples to get you started -->
                    </small>
                </h3>
                        </div>


                    </div>
					   <div class="row">
                        <div class="col-md-9 col-sm-12 col-xs-12">

                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h2>Pengaturan Notifikasi SMS</h2>
                                  
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">

                        <form method="post" action="less/aksi.php?tipe=nohp">
                            <div class="row">
                             <div class="col-md-1 col-sm-12 col-xs-12"></div>

                            <div class="col-md-2 col-sm-6 col-xs-6">
                             
                                     <p><label> Nomor HP 1 </label></p>
                                     <br />

                                     <p><label>Nomor HP 2 </label></p>
                            </div>

                             <div class="col-md-2 col-sm-6 col-xs-6">
                             
                                     <p><label><input type="text" name="no1" class="form-control" value="<?php echo $nomor[0] ?>"  /> </label> </p>

                                     <p><label><input type="text" name="no2" class="form-control" value="<?php echo $nomor[1] ?>"  /> </label> </p>
                            </div>
                            <div class="col-md-1 col-sm-12 col-xs-12"></div>


                                <div class="col-md-2 col-sm-6 col-xs-6">
                             
                                     <p><label> Nomor HP 3 </label></p>
                                     <br />

                                     <p><label>Nomor HP 4 </label></p>
                            </div>



                             <div class="col-md-2 col-sm-6 col-xs-6">
                             
                                     <p><label><input type="text" name="no3" class="form-control" value="<?php echo $nomor[2] ?>"  /> </label> </p>

                                     <p><label><input type="text" name="no4" class="form-control" value="<?php echo $nomor[3] ?>"  /> </label> </p>
                            </div>

                        
                         </div>

                         <div class="row">
                          <div class="col-md-1 col-sm-12 col-xs-12"></div>
                                <div class="col-md-2 col-sm-6 col-xs-6">
                             
                                     <p><label> Nomor HP 5 </label></p>
                                     <br />

                                     <p><label>Nomor HP 6 </label></p>
                            </div>

                             <div class="col-md-2 col-sm-6 col-xs-6">
                             
                                     <p><label><input type="text" name="no5" class="form-control" value="<?php echo $nomor[4] ?>"  /> </label> </p>

                                     <p><label><input type="text" name="no6" class="form-control"  value="<?php echo $nomor[5] ?>" /> </label> </p>
                            </div>
                            <div class="col-md-1 col-sm-12 col-xs-12"></div>


                                <div class="col-md-2 col-sm-6 col-xs-6">
                             
                                     <p><label> Nomor HP 7 </label></p>
                                     <br />

                                     <p><label>Nomor HP 8 </label></p>
                            </div>



                             <div class="col-md-2 col-sm-6 col-xs-6">
                             
                                     <p><label><input type="text" name="no7" class="form-control"  value="<?php echo $nomor[6] ?>" /> </label> </p>

                                     <p><label><input type="text" name="no8" class="form-control" value="<?php echo $nomor[7] ?>"  /> </label> </p>
                            </div>
                    <div class="col-md-6 col-sm-12 col-xs-12"></div>
                        <div class="col-md-1 col-sm-12 col-xs-12">
                         <input type="submit" name="submit" class="btn btn-success" value="&nbsp;&nbsp;&nbsp;&nbsp;Simpan&nbsp;&nbsp;&nbsp;&nbsp;">
                         </div>
                         </div>
                          </form>
                                </div>
                            </div>
                        </div>
                      
                     
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h2>Pengaturan Tampilan Ikhtisar</h2>
                                  
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                          <form method="post" action="less/aksi.php?tipe=tampilan">
                            <div class="col-md-8 col-sm-12 col-xs-12">
                             
                                     <p><input type="radio" name="p_ikhtisar" class="flat" value="tab" <?php if($tipe=="tab"){echo "checked";} ?> /> Tampilkan Dalam Tab</p>

                                     <p><input type="radio" name="p_ikhtisar" class="flat" value="semua" <?php if($tipe=="semua"){echo "checked";} ?> /> Tampilkan Semua </p>
                            </div>
                         <div class="col-md-4 col-sm-12 col-xs-12">
                         <input type="submit" name="submit" class="btn btn-success" value="Simpan">
                         </div>
                                </div>
                               
                            </div>
                            </form>
                        </div>
                        

                       

                    </div>
               
					
                    <div class="clearfix"></div>
                        

</div>
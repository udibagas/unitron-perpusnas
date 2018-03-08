

<?php

    @session_start();
    if(isset($_SESSION['username'])==false)
    {
        echo "<meta http-equiv='refresh' content='0;URL=menu_login.php' />";
    }

    $link2=mysqli_real_escape_string($konek, $_GET['page']);

    $qcek_link = "SELECT step,nama_bpp,no_bpp FROM step WHERE link='$link2'";
    $cek_link = $konek->query($qcek_link);
    $ncek_link = $cek_link->num_rows;
    $dcek_link = $cek_link->fetch_assoc();

    $qcek_link1 = "SELECT step,nama_bpp,no_bpp,link FROM step WHERE step<$dcek_link[step] AND nama_bpp='$dcek_link[nama_bpp]' AND no_bpp='$dcek_link[no_bpp]'  ORDER BY step DESC LIMIT 1";

    //echo $qcek_link1;

    $cek_link1 = $konek->query($qcek_link1);
    $ncek_link1 = $cek_link1->num_rows;
    $dcek_link1 = $cek_link1->fetch_assoc();

    $cek_step = $dcek_link1['link'];

?>

            <!-- page content -->

                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Status Permohonan Pengunjung
                    <small>
                      <!-- Some examples to get you started -->
                    </small>
                </h3>
                        </div>


                    </div>



                    <div class="clearfix"></div>
                        <div class="clearfix"></div>
                        <div class="clearfix"></div>

                        <div class="abcdefg">

                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h2>Saring Berdasarkan Tanggal</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>


                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>

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



<?php if(isset($_GET['tampil'])==false){ ?>
 <div class="col-md-2 col-sm-6 col-xs-12">
 <!-- <a href="?page=p2persetujuan&tampil=all" class="btn btn-info">Tampilkan Semua</a>-->
 </div>
<?php }else{ ?>
<div class="col-md-2 col-sm-6 col-xs-12">
 <a href="?page=p2persetujuan" class="btn btn-info">Tampilkan Pending</a>
 </div>

<?php } ?>

<?php if($_SESSION['level']=="admin"|| $_SESSION['level']=="pj"){ ?>
<div align="right" class="col-md-5 col-sm-6 col-xs-12">
 <a href="?page=p8pperpanjang&tipe=aktif" class="btn btn-info">Tampilkan Izin Perpanjangan</a>
 </div>
<?php } ?>

</form>



</div></div></div>
                                    <table id="tabel1" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th  class="column-title">Nomor </th>
                                                <th  class="column-title">Nomor Tiket </th>
                                                <th  class="column-title">Tujuan </th>
                                                <th  class="column-title">Pendamping </th>
                                                <th  align="Center" class="column-title"> Waktu Masuk</th>
                                                <th  align="Center" class="column-title"> Waktu Keluar</th>
                                                <th align="Center" class="column-title">Status Permohonan</span></th>
                                                <th align="Center" class="column-title">Status Tiket</span></th>
                                                <th class="column-title no-link last"><span class="nobr">Aksi</span>
                                                </th>
                                            </tr>

                            </thead>

                            <tbody>
                            <?php
                                $no = 1;
                            if($_SESSION['level']!='user'){
                                //echo "nonn";
                                if(isset($_GET['tampil'])==false){
                                if(isset($_POST['tgl_awal'])==false){
                                   $idd = $_SESSION['id_req'];
                                $sql=$konek->query("SELECT * FROM request WHERE (status='Y' OR status='N' OR status='P')  ORDER BY tanggal_masuk DESC");
                                }else{
                                    $tgl1 = mysqli_real_escape_string($konek, $_POST['tgl_awal']);
                                    $tgl2 = mysqli_real_escape_string($konek, $_POST['tgl_akhir']);
                                if($tgl1 != null && $tgl2!= null){

                                  $tgl1 = date("Y-m-d",strtotime($tgl1));
                                  $tgl2 = date("Y-m-d",strtotime($tgl2));

                                  $sql=$konek->query("SELECT * FROM request WHERE status='Y' OR status='N' OR status='P' AND tanggal_masuk BETWEEN '$tgl1' AND '$tgl2' AND  ORDER BY tanggal_masuk DESC");
                              }else{
                                $sql=$konek->query("SELECT * FROM request WHERE (status='Y' OR status='N' OR status='P')  ORDER BY tanggal_masuk DESC");
                              }

                                  echo "<h2>Tampilkan Dari Tanggal $tgl1 -> $tgl2</h2>";

                                }
                            }else{
                                if(isset($_POST['tgl_awal'])==false){
                                    $idd = $_SESSION['id_req'];
                                $sql=$konek->query("SELECT * FROM request WHERE step_$hak_akses='$cek_step' ORDER BY tanggal_masuk DESC");
                                }else{
                                    $tgl1 = mysqli_real_escape_string($konek, $_POST['tgl_awal']);
                                    $tgl2 = mysqli_real_escape_string($konek, $_POST['tgl_akhir']);
                                if($tgl1 != null && $tgl2!= null){

                                  $tgl1 = date("Y-m-d",strtotime($tgl1));
                                  $tgl2 = date("Y-m-d",strtotime($tgl2));

                                  $sql=$konek->query("SELECT * FROM request WHERE tanggal_masuk BETWEEN '$tgl1' AND '$tgl2' AND step_$hak_akses='$cek_step' ORDER BY tanggal_masuk DESC");
                              }else{
                                $sql=$konek->query("SELECT * FROM request WHERE step_$hak_akses='$cek_step' ORDER BY tanggal_masuk DESC");
                              }

                                  echo "<h2>Tampilkan Dari Tanggal $tgl1 -> $tgl2</h2>";

                                }

                            }
                        }else{
                            //echo "user";
                              if(isset($_GET['tampil'])==false){
                                if(isset($_POST['tgl_awal'])==false){
                                    $idd = $_SESSION['id_req'];
                                $sql=$konek->query("SELECT * FROM request WHERE (status='Y' OR status='N' OR status='P') AND id_regis='$idd' ORDER BY tanggal_masuk DESC");
                                }else{
                                    $tgl1 = mysqli_real_escape_string($konek, $_POST['tgl_awal']);
                                    $tgl2 = mysqli_real_escape_string($konek, $_POST['tgl_akhir']);
                                if($tgl1 != null && $tgl2!= null){

                                  $tgl1 = date("Y-m-d",strtotime($tgl1));
                                  $tgl2 = date("Y-m-d",strtotime($tgl2));

                                  $sql=$konek->query("SELECT * FROM request WHERE status='Y' OR status='N' OR status='P' AND tanggal_masuk BETWEEN '$tgl1' AND '$tgl2' AND id_regis='$idd' ORDER BY tanggal_masuk DESC");
                              }else{
                                $sql=$konek->query("SELECT * FROM request WHERE status='Y' OR status='N' OR status='P' ORDER BY tanggal_masuk DESC");
                              }

                                  echo "<h2>Tampilkan Dari Tanggal $tgl1 -> $tgl2</h2>";

                                }
                            }else{
                                if(isset($_POST['tgl_awal'])==false){
                                    $idd = $_SESSION['id_req'];
                                $sql=$konek->query("SELECT * FROM request WHERE id_regis='$idd' ORDER BY tanggal_masuk DESC");
                                }else{
                                    $tgl1 = mysqli_real_escape_string($konek, $_POST['tgl_awal']);
                                    $tgl2 = mysqli_real_escape_string($konek, $_POST['tgl_akhir']);
                                if($tgl1 != null && $tgl2!= null){

                                  $tgl1 = date("Y-m-d",strtotime($tgl1));
                                  $tgl2 = date("Y-m-d",strtotime($tgl2));

                                  $sql=$konek->query("SELECT * FROM request WHERE tanggal_masuk BETWEEN '$tgl1' AND '$tgl2' AND id_regis='$idd' ORDER BY tanggal_masuk DESC");
                              }else{
                                $sql=$konek->query("SELECT * FROM request WHERE id_regis='$idd' ORDER BY tanggal_masuk DESC");
                              }

                                  echo "<h2>Tampilkan Dari Tanggal $tgl1 -> $tgl2</h2>";

                                }
                            }
                        }

                        if($kode=="pperpanjang"){


                             if(isset($_GET['tampil'])==false){
                                if(isset($_POST['tgl_awal'])==false){
                                   $idd = $_SESSION['id_req'];
                                $sql=$konek->query("SELECT * FROM request WHERE status='P' ORDER BY tanggal_masuk DESC");
                                }else{
                                    $tgl1 = mysqli_real_escape_string($konek, $_POST['tgl_awal']);
                                    $tgl2 = mysqli_real_escape_string($konek, $_POST['tgl_akhir']);
                                if($tgl1 != null && $tgl2!= null){

                                  $tgl1 = date("Y-m-d",strtotime($tgl1));
                                  $tgl2 = date("Y-m-d",strtotime($tgl2));

                                  $sql=$konek->query("SELECT * FROM request WHERE status='P' AND tanggal_masuk BETWEEN '$tgl1' AND '$tgl2' ORDER BY tanggal_masuk DESC");
                              }else{
                                $sql=$konek->query("SELECT * FROM request WHERE status='P'ORDER BY tanggal_masuk DESC");
                              }

                                  echo "<h2>Tampilkan Dari Tanggal $tgl1 -> $tgl2</h2>";

                                }
                            }else{
                                if(isset($_POST['tgl_awal'])==false){
                                    $idd = $_SESSION['id_req'];
                                $sql=$konek->query("SELECT * FROM request ORDER BY tanggal_masuk DESC");
                                }else{
                                    $tgl1 = mysqli_real_escape_string($konek, $_POST['tgl_awal']);
                                    $tgl2 = mysqli_real_escape_string($konek, $_POST['tgl_akhir']);
                                if($tgl1 != null && $tgl2!= null){

                                  $tgl1 = date("Y-m-d",strtotime($tgl1));
                                  $tgl2 = date("Y-m-d",strtotime($tgl2));

                                  $sql=$konek->query("SELECT * FROM request WHERE tanggal_masuk BETWEEN '$tgl1' AND '$tgl2' ORDER BY tanggal_masuk DESC");
                              }else{
                                $sql=$konek->query("SELECT * FROM request ORDER BY tanggal_masuk DESC");
                              }

                                  echo "<h2>Tampilkan Dari Tanggal $tgl1 -> $tgl2</h2>";

                                }

                            }

                        }

                                   if($kode=="itinerary"){
                                        $link="?page=p3itinerary";
                                   }elseif($kode=="setuju"){
                                        $link="?page=p2persetujuan";
                                   }elseif($kode=="pemandu"){
                                        $link="?page=p4pemandu";
                                   }elseif($kode=="buku"){
                                        $link="?page=p6buku";
                                   }elseif($kode=="perpanjang"){
                                        $link="?page=p7perpanjang";
                                   }elseif($kode=="pperpanjang"){
                                        $link="?page=p8pperpanjang";
                                   }





                                while($data=$sql->fetch_assoc()){
                            ?>
                                           <tr class="odd pointer">
                                                <td><?php echo $no++; ?></td>
                                                <td>REQ<?php echo $data['id_req']; ?></td>
                                                <td><?php echo $data['tujuan']; ?></td>
                                                <td><?php echo $data['pendamping']; ?></td>
                                                <td><?php echo date("d-m-Y h:m",strtotime($data['tanggal_masuk'])); ?></td>
                                                <td><?php echo date("d-m-Y h:m",strtotime($data['tanggal_keluar'])); ?></td>

                                                 <?php if($data['status']=="N"){ ?>
                                                <td class=" last"><p>Belum DiKonfirmasi</p></td>

                                                <td class=" last"><p>Terbuka</p></td>

                                                <td><a class="btn btn-info"  href="<?php echo $link; ?>&tipe=detail&id=<?php echo $data['id_req']; ?>">Detail</a></td>

                                                 <?php }elseif($data['status']=="S"){ ?>
                                               <td><h2><span class="fa fa-check"> Selesai</span></h2></td>

                                                <td class=" last"><p class="btn btn-warning">Tertutup</p></td>

                                                <td><a class="btn btn-info"  href="<?php echo $link; ?>&tipe=detail&id=<?php echo $data['id_req']; ?>">Detail</a></td>

                                                <?php }elseif($data['status']=="Y"){ ?>
                                                <td class=" last"><p>Konfirmasi Diterima</p></td>

                                                <td class=" last"><p>Terbuka</p></td>

                                               <td><a class="btn btn-info" href="<?php echo $link; ?>&tipe=detail&id=<?php echo $data['id_req']; ?>">Detail</a>


                                               </td>

                                                    <?php }elseif($data['status']=="B"){ ?>
                                                         <td class=" last"><p class="btn btn-warning">Dibatalkan</p></td>

                                                          <td class=" last"><p class="btn btn-warning">Tertutup</p></td>

                                                 <td><a class="btn btn-info" href="<?php echo $link; ?>&tipe=detail&id=<?php echo $data['id_req']; ?>">Detail</a></td>

                                                  <?php }elseif($data['status']=="P"){ ?>
                                                         <td class=" last"><p class="btn btn-warning"> Minta Perpanjang</p></td>

                                                          <td class=" last"><p class="btn btn-warning">Terbuka</p></td>



                                                 <td><a class="btn btn-info" href="<?php echo $link; ?>&tipe=detail&id=<?php echo $data['id_req']; ?>">Detail</a>

                                                 </td>

                                                  <?php }elseif($data['status']=="R"){ ?>
                                                         <td class=" last"><p class="btn btn-danger">Ditolak</p></td>

                                                          <td class=" last"><p class="btn btn-warning">Tertutup</p></td>

                                                 <td><a class="btn btn-info" href="?page=p2persetujuan&tipe=detail&id=<?php echo $data['id_req']; ?>">Detail</a></td>
                                                    <?php } ?>
                                            </tr>

                            <?php } ?>

                                            </tbody>

                                    </table>
                                </div>
            </div>
            <!-- /page content -->
        </div>

    </div>


<div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>



    <!-- form validation -->
    <script src="js/validator/validator.js"></script>
    <script>
        // initialize the validator function
        validator.message['date'] = 'not a real date';

        // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
        $('form')
            .on('blur', 'input[required], input.optional, select.required', validator.checkField)
            .on('change', 'select.required', validator.checkField)
            .on('keypress', 'input[required][pattern]', validator.keypress);

        $('.multi.required')
            .on('keyup blur', 'input', function () {
                validator.checkField.apply($(this).siblings().last()[0]);
            });

        // bind the validation to the form submit event
        //$('#send').click('submit');//.prop('disabled', true);

        $('form').submit(function (e) {
            e.preventDefault();
            var submit = true;
            // evaluate the form using generic validaing
            if (!validator.checkAll($(this))) {
                submit = false;
            }

            if (submit)
                this.submit();
            return false;
        });

        $('#vfields').change(function () {
            $('form').toggleClass('mode2');
        }).prop('checked', false);

        $('#alerts').change(function () {
            validator.defaults.alerts = (this.checked) ? false : true;
            if (this.checked)
                $('form .alert').remove();
        }).prop('checked', false);


    </script>

    <script src="js/datatables/js/jquery.dataTables.js"></script>
    <script src="js/datatables/tools/js/dataTables.tableTools.js"></script>
        <script type="text/javascript" src="js/moment.min2.js"></script>
    <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>

<script type="text/javascript">

$(document).ready(function() {

    $('#tabel1').DataTable( {
        "sPaginationType": "full_numbers",
        "oLanguage": {
    "sSearch": "Filter No Tiket: ",
    className: 'form-control'
        },
        columnDefs: [
            {
                targets: [ 0, 1, 2 ],

            }
        ]
    });

         $('#single_cal1').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_2"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });

            $('#single_cal2').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_2"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
} );

</script>

</div>

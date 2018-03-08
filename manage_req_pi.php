

<?php

    @session_start();
    if(isset($_SESSION['username'])==false)
    {
        echo "<meta http-equiv='refresh' content='0;URL=menu_login.php' />";
    }

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
 <div class="col-md-1 col-sm-6 col-xs-12">
 <a href="?page=p2persetujuan&tampil=all" class="btn btn-info">Tampilkan Semua</a>
 </div>
<?php }else{ ?>
<div class="col-md-1 col-sm-6 col-xs-12">
 <a href="?page=p2persetujuan" class="btn btn-info">Tampilkan Pending</a>
 </div>

<?php } ?>

</form>



</div></div></div>
                                    <table id="tabel1" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th  class="column-title">Nomor </th>
                                                <th  class="column-title">Nomor Tiket </th>
                                                <th  class="column-title">Planning </th>

                                                <th align="Center" class="column-title">Status Permohonan</span></th>
                                                <th align="Center" class="column-title">Status Tiket</span></th>
                                                <th class="column-title no-link last"><span class="nobr">Aksi</span>
                                                </th>
                                            </tr>

                            </thead>

                            <tbody>
                            <?php
                                $no = 1;
                                if(isset($_GET['tampil'])==false){

                                    $idd = $_SESSION['id_req'];
                                $sql=$konek->query("SELECT * FROM req_capacity WHERE status='Y' OR status='N' OR status='P' ORDER BY id_req DESC");

                            }else{

                                    $idd = $_SESSION['id_req'];
                                $sql=$konek->query("SELECT * FROM req_capacity ORDER BY id_req DESC");

                            }

                                   if($kode=="eval"){
                                        $link="?page=rpk2evaluasi";
                                   }elseif($kode=="review"){
                                        $link="?page=rpk3review";
                                   }elseif($kode=="rencana"){
                                        $link="?page=rpk4lengkapi";
                                   }


                                while($data=$sql->fetch_assoc()){
                            ?>
                                           <tr class="odd pointer">
                                                <td><?php echo $no++; ?></td>
                                                <td>RPK<?php echo $data['id_req']; ?></td>
                                                <td><?php echo $data['tujuan']; ?></td>


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

                                                 <td><a class="btn btn-info" href="?page=cp2eval&tipe=detail&id=<?php echo $data['id_req']; ?>">Detail</a></td>
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

    <script src="js/bootstrap.min.js"></script>

    <!-- chart js -->
    <script src="js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="js/icheck/icheck.min.js"></script>


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

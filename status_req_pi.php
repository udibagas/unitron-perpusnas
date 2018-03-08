

            <!-- page content -->

                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Status Izin
                    <small>
                      <!-- Some examples to get you started -->
                    </small>
                </h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                                </div>
                            </div>
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


</form>

</div></div></div>
                                    <table id="tabel1" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th  class="column-title">Nomor </th>
                                                <th  class="column-title">No Tiket </th>

                                                <th align="Center" class="column-title">Status</span></th>


                                                <th class="column-title no-link last"><span class="nobr">Aksi</span>
                                                </th>
                                                <th class="column-title"><span class="nobr">Detail</span>
                                            </tr>

                            </thead>

                            <tbody>
                            <?php
                                $no = 1;
                                if(isset($_POST['tgl_awal'])==false){
                                    $idd = $_SESSION['id_req'];
                                $sql=$konek->query("SELECT * FROM request WHERE id_regis='$idd'  ORDER BY tanggal_masuk DESC");
                                }else{
                                    $tgl1 = mysqli_real_escape_string($konek, $_POST['tgl_awal']);
                                    $tgl2 = mysqli_real_escape_string($konek, $_POST['tgl_akhir']);
                                if($tgl1 != null && $tgl2!= null){

                                  $tgl1 = date("Y-m-d",strtotime($tgl1));
                                  $tgl2 = date("Y-m-d",strtotime($tgl2));

                                  $sql=$konek->query("SELECT * FROM request WHERE id_regis='$idd' AND tanggal_masuk BETWEEN '$tgl1' AND '$tgl2' ORDER BY tanggal_masuk DESC");
                              }else{
                                $sql=$konek->query("SELECT * FROM request WHERE id_regis='$idd'  ORDER BY tanggal_masuk DESC");
                              }

                                  echo "<h2>Tampilkan Dari Tanggal $tgl1 -> $tgl2</h2>";

                                }
                                while($data=$sql->fetch_assoc()){
                            ?>
                                           <tr class="odd pointer">
                                                <td><?php echo $no++; ?></td>
                                                <td>CPQ<?php echo $data['id_req']; ?></td>



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
                                           <a onclick="return confirm ('Apakah Permohonan ini akan Diperpanjang ?')" class="btn btn-info"  href="?page=perpanjang&id=<?php echo $data['id_req']; ?>">Perpanjang</a>
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

                                                      <td><a class="btn btn-info" href="?page=p1permohonan&tipe=detail&id=<?php echo $data['id_req']; ?>">Detail</a></td>


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
        "sScrollX": "100%",
        "sPaginationType": "full_numbers",
         "language": {
                            "lengthMenu": "Tampilkan _MENU_ data perhalaman",
                            "zeroRecords": "Data tidak Ada",
                            "info": "",
                            "infoEmpty": "Tidak ada data tersimpan",
                            "infoFiltered": "(Saring dari _MAX_ total data)",
                            "sSearch": "Saring : ",
                            "paginate": {
                                  "previous": "Kembali",
                                  "next": "Lanjut",
                                  "first": "Awal",
                                  "last": "Akhir"
                                }
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

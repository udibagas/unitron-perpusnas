<?php
@session_start();
if(isset($_SESSION['username'])==false) {
    echo "<meta http-equiv='refresh' content='0;URL=menu_login.php' />";
}
?>
            <!-- page content -->

                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Buku Tamu => <a href="?page=p6buku&tipe=manage"> Update Itirary </a>
                    <small>
                      <!-- Some examples to get you started -->
                    </small>
                </h3>
                        </div>

                        <div class="title_right">

                        </div>
                    </div>
					     <div class="row">
                        <div class="abcdefg">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h2>Form Input Tamu</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>


                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">

                                    <form method="POST" action="tamu_proses.php?tipe=input" class="form-horizontal form-label-left" novalidate>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="nama" type="text" name="nama" data-validate-length-range="4,20" class="optional form-control col-md-7 col-xs-12" data-toggle="tooltip" data-placement="bottom" title="<h2>Inputkan Nama Lengkap</h2>
                                                <img src='images/tooltip/bt_nama.png' width='150' height='40' />">
                                            </div>
                                        </div>
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jabatan">Jabatan <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="jabatan" type="text" name="jabatan" data-validate-length-range="4,20" class="optional form-control col-md-7 col-xs-12" data-toggle="tooltip" data-placement="bottom" title="<h2>Inputkan Jabatan (ex : IT Engginer)</h2>">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="instansi">Instansi <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="instansi" type="text" name="instansi" data-validate-length-range="4,20" class="optional form-control col-md-7 col-xs-12" data-toggle="tooltip" data-placement="bottom" title="<h2>Inputkan Instansi (ex : PT. YANDU)</h2>">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tujuan">Tujuan <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea id="tujuan" required="required" name="tujuan" class="form-control col-md-7 col-xs-12" data-toggle="tooltip" data-placement="bottom" title="<h2>Inputkan Tujuan</h2>"></textarea>
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <button id="send" type="submit" name="submit1" class="btn btn-success btn-lg">Simpan</button>
                                            </div>
                                        </div>
                                    </form>

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
                                    <h2>Tabel Tamu</small></h2>
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
                                                <th ROWSPAN="2" class="column-title">Nomor </th>
                                                <th ROWSPAN="2" class="column-title">Nama </th>
                                                <th ROWSPAN="2" class="column-title">Jabatan </th>
                                                <th ROWSPAN="2" class="column-title">Instansi </th>
                                                <th ROWSPAN="2" class="column-title">Tujuan </th>
                                                <th COLSPAN="2" align="Center" class="column-title"> Waktu Masuk</th>
												<th COLSPAN="2" align="Center" class="column-title"> Waktu Keluar</th>
                                                <th ROWSPAN="2"class="column-title no-link last"><span class="nobr">Action</span>
                                                </th>

                                            </tr>
								<tr class="headings">

                                                <th class="column-title">Tanggal  </th>
                                                <th class="column-title">Jam </th>
                                                <th class="column-title">Tanggal  </th>
                                                <th class="column-title">Jam </th>
                                                <th class="bulk-actions" colspan="7">
                                                    <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                            </th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php
                                $no = 1;
                                if(isset($_POST['tgl_awal'])==false){
                                $sql=$konek->query("SELECT * FROM tamu  ORDER BY tanggal_masuk DESC");
                                }else{
                                    $tgl1 = mysqli_real_escape_string($konek, $_POST['tgl_awal']);
                                    $tgl2 = mysqli_real_escape_string($konek, $_POST['tgl_akhir']);
                                if($tgl1 != null && $tgl2!= null){

                                  $tgl1 = date("Y-m-d",strtotime($tgl1));

                                  $tgl2 = date("Y-m-d",strtotime($tgl2));


                                  $sql=$konek->query("SELECT * FROM tamu WHERE tanggal_masuk BETWEEN '$tgl1' AND '$tgl2' ORDER BY tanggal_masuk DESC");
                              }else{
                                $sql=$konek->query("SELECT * FROM tamu  ORDER BY tanggal_masuk DESC");
                              }

                                  echo "<h2>Tampilkan Dari Tanggal $tgl1 -> $tgl2</h2>";

                                }
                                while($data=$sql->fetch_assoc()){
                            ?>
                                           <tr class="odd pointer">
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $data['nama']; ?></td>
                                                <td><?php echo $data['jabatan']; ?></td>
                                                <td><?php echo $data['instansi']; ?></td>
                                                <td><?php echo $data['tujuan']; ?></td>
                                                <td><?php echo $data['tanggal_masuk']; ?></td>
                                                <td><?php echo $data['waktu_masuk']; ?></td>
                                                <td><?php echo $data['tanggal_keluar']; ?></td>
                                                <td><?php echo $data['waktu_keluar']; ?></td>

                                                 <?php if($data['tanggal_keluar']=="0000-00-00"){ ?>
												<td class=" last"><a class="btn btn-warning" href="tamu_proses.php?tipe=konfir&id=<?php echo $data['id']; ?>" onclick="return confirm('Apakah anda yakin akan Konfirmasi Keluar <?php echo $data['nama']; ?> pada jam <?php echo date("h:i:sa"); ?> ??')">Konfirmasi Keluar</a>  <a class="btn btn-danger" href="#">Belum</a></td>
                                                <?php }else{ ?>
                                                <td class=" last"><a class="btn btn-info" href="tamu_proses.php?tipe=konfir&id=<?php echo $data['id']; ?>" onclick="return confirm('Apakah anda yakin akan Konfirmasi Ulang <?php echo $data['nama']; ?> pada jam <?php echo date("h:i:sa"); ?> ??')">Konfirmasi Ulang</a>
                                                <a class="btn btn-success"  href="#">Sudah</a></td>


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
        "sScrollX": "100%",
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

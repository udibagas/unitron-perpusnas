  <link href="css/bootstrap-datetimepicker.css" rel="stylesheet">
      <script src="js/datetimepicker/moment-with-locales.js"></script>
    <script src="js/datetimepicker/bootstrap-datetimepicker.js"></script>
<?php

    @session_start();
    if(isset($_SESSION['username'])==false)
    {
        echo "<meta http-equiv='refresh' content='0;URL=menu_login.php' />";
    }

    $id_req = mysqli_real_escape_string($konek, $_GET['id']);


?>
   <!-- page content -->

                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Input/Update Detail Rekomendasi Capacity Planning
                    <small>
                      <!-- Some examples to get you started -->
                    </small>
                </h3>
                        </div>

                    </div>

					<div class="row">
                        <div class="abcdefg">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h2>Form Input</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>


                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">

                                    <form method="POST" action="less/aksi.php?tipe=rekomendasi&module=input" class="form-horizontal form-label-left" novalidate>

                                        <input type="hidden" name="tipe" value="<?php echo $t; ?>"/>
                                       <div class="item form-group">
                                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Tanggal <span class="required">*</span>
                                            </label>
                                           <div class='col-md-6 col-sm-6 col-xs-12'>
                                            <div class="form-group">
                                                <div class='input-group date' id='datetimepicker1'>
                                                    <input type='text' class="form-control"  name="tgl" required/>
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                </div>
                        <script type="text/javascript">
                            $(function () {
                                $('#datetimepicker1').datetimepicker();
                            });
                        </script>


                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Judul Rekomendasi <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="hidden" name="id_req" value="<?php echo $id_req; ?>" />
                                                <input id="lokasi" type="text" name="judul" data-validate-length-range="4,20" class="optional form-control col-md-7 col-xs-12" data-toggle="tooltip" data-placement="bottom" title="<h2>Inputkan Judul</h2>
                                                ">
                                            </div>
                                        </div>


                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tujuan">Detail Rekomendasi <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea id="detail" required="required" name="detail" class="form-control col-md-7 col-xs-12 ckeditor" data-toggle="tooltip" data-placement="bottom" title="<h2>Inputkan Detail Rekomendasi</h2>"></textarea>
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


					</div>
                    <div class="clearfix"></div>
                        <div class="clearfix"></div>
                        <div class="clearfix"></div>
                        <div class="row">
                        <div class="abcdefg">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h2>Tabel Detail Rekomendasi</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>


                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                  <div class="panel-body">
                                    <table id="tabel1" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">

                                               <th width="5%" class="column-title">Nomor </th>
                                                <th width="20%" class="column-title">Waktu </th>
                                                <th width="15%" class="column-title">Judul </th>
                                                <th width="65%" class="column-title">Detail Rekomendasi </th>

                                            </tr>

                            </thead>

                            <tbody>
                            <?php
                                $no = 1;

                                $sql=$konek->query("SELECT * FROM rekom_cp WHERE status='Y' AND id_req='$id_req' ORDER BY waktu DESC");


                                while($data=$sql->fetch_assoc()){
                            ?>
                                           <tr class="odd pointer">
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $data['waktu']; ?></td>
                                                <td><?php echo $data['rekomendasi']; ?></td>
                                                <td><?php echo $data['detail_rekomendasi']; ?></td>

                                                    <?php } ?>
                                            </tr>

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
      <script src="js/ckeditor/ckeditor.js" type="text/javascript"></script>

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

    $('#tabel2').DataTable( {
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

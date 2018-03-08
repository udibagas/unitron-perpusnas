<?php

    @session_start();
    if(isset($_SESSION['username'])==false)
    {
        echo "<meta http-equiv='refresh' content='0;URL=menu_login.php' />";
    }

    $id=mysqli_real_escape_string($konek, $_GET['id']);
    $sql=$konek->query("SELECT * FROM sop WHERE id_sop='$id'");
    $data = $sql->fetch_assoc();


?>
            <!-- page content -->

                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Detail SOP
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
                                    <h2>Nama SOP : <?php echo $data['nama_sop']; ?></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>


                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">

                                    <?php echo $data['sop']; ?>

                                </div>
                            </div>
                        </div>
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

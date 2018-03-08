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
                   Log Finger
                    <small>
                      <!-- Some examples to get you started -->
                    </small>
                </h3>
                        </div>


                        <div class="clearfix"></div>
                        <div class="clearfix"></div>

                        <div class="abcdefg">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h2>Dasar Saringan Pertama (Manual)</small></h2>
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
                                                            <input type="text" class="form-control has-feedback-left" id="single_cal1" placeholder="Tanggal Awal" aria-describedby="inputSuccess2Status" name="tgl_awal">
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
                                                            <input type="text" class="form-control has-feedback-left" id="single_cal2" placeholder="Tanggal Akhir" aria-describedby="inputSuccess2Status" name="tgl_akhir">
                                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                            <span id="inputSuccess2Status" class="sr-only">(success)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
</div>

 <div class="col-md-1 col-sm-6 col-xs-12">
 <input type="submit" class="btn btn-info" name="t1" value="Tampilkan"/>

 </div>


</form>

</div></div>
                                    <table id="tabel2" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                                                                       <tr class="headings">
                                                <th  class="column-title">Nomor </th>
                                                <th  class="column-title">Tanggal </th>
                                                <th  class="column-title">Kode Enroll </th>
                                                <th  class="column-title">Nama </th>

                                                <th  class="column-title">Ruang</th>
                                                <th  class="column-title">Nama Lokasi</th>
                                                <th  class="column-title">Nama Jabatan</th>
                                                <th  class="column-title">Verifikasi </th>
                                            </tr>
                                      </thead>
                            <tbody>
                            <?php
                                $no = 1;
                                if(isset($_POST['tgl_awal'])==true){
                                     $tgl1 = mysqli_real_escape_string($konek, $_POST['tgl_awal']);
                                    $tgl2 = mysqli_real_escape_string($konek, $_POST['tgl_akhir']);
                                    $tgl1 = date("Y-m-d",strtotime($tgl1));
                                    $tgl2 = date("Y-m-d",strtotime($tgl2));
                                if($tgl1 != '' && $tgl2!= ''){

                                  $sql=$konek->query("SELECT
                                    enroll_log.id_log_finger,
                                    enroll_log.kode_enroll,
                                    enroll_log.tanggal,
                                    enroll_log.verifikasi,
                                    enroll_log.`inout`,
                                    enroll_log.`work`,
                                    users.username,
                                    users.nama_lengkap,
                                    users.username,
                                    ref_kojab_tbl.najabl,
                                    ref_lokasi_tbl.nalokl,
                                    ruang.ruang_name
                                    FROM
                                    enroll_log
                                    LEFT OUTER JOIN users ON users.username = enroll_log.kode_enroll
                                    LEFT OUTER JOIN ref_lokasi_tbl ON ref_lokasi_tbl.kolok = users.kolok
                                    LEFT OUTER JOIN ref_kojab_tbl ON ref_kojab_tbl.kojab = users.kojab AND ref_kojab_tbl.kolok = ref_lokasi_tbl.kolok
                                    LEFT JOIN ruang ON ruang.ruang_id = enroll_log.ruang_id WHERE date(enroll_log.tanggal) BETWEEN '$tgl1' AND '$tgl2' ORDER BY enroll_log.tanggal DESC");

                                  echo "<h2>Tampilkan Dari Tanggal $tgl1 -> $tgl2</h2>";


                                while($data=$sql->fetch_assoc()){
                            ?>
                                           <tr class="odd pointer">
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo date("d-M-Y H:i:s",strtotime($data['tanggal']));  ?></td>
                                                <td><p><?php echo $data['username']; ?></p></td>
                                                <td><p><?php echo $data['nama_lengkap']; ?></p></td>
                                                <td><p><?php echo $data['ruang_name']; ?></p></td>
                                                <td><p><?php echo $data['nalokl']; ?></p></td>
                                                <td><p><?php echo $data['najabl']; ?></p></td>
                                                <td><p><?php echo $data['verifikasi']; ?></p></td>
                                            </tr>

                            <?php } }
                            } ?>
                                            </tbody>

                                    </table>
                                </div>
            </div>
            <!-- /page content -->
        </div>

    </div>


    <script src="js/datatables/js/jquery.dataTables.js"></script>
    <script src="js/datatables/tools/js/dataTables.tableTools.js"></script>
    <script type="text/javascript" src="js/moment.min2.js"></script>
    <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>

<script type="text/javascript">

$(document).ready(function() {


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

    $('#tabel2').DataTable( {
        "sPaginationType": "full_numbers",
        "sScrollX": "100%",
        "oLanguage": {
    "sSearch": "Filter : ",
    className: 'form-control'
        },
        columnDefs: [
            {
                targets: [ 0, 1, 2 ],

            }
        ]
    });

} );


</script>

</div>

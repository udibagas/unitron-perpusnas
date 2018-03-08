

            <!-- page content -->

                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Buku Tamu
                    <small>
                      <!-- Some examples to get you started -->
                    </small>
                </h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                            </div>
                        </div>
                    </div>



                    <div class="clearfix"></div>
                        <div class="clearfix"></div>
                        <div class="clearfix"></div>

                        <div class="abcdefg">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h2>Tabel Buku Tamu</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>


                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>


                                    <table id="tabel1" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th  class="column-title">Nomor </th>
                                                <th  class="column-title">No Tiket </th>
                                                <th  align="Center" class="column-title"> Waktu Masuk</th>
												<th  align="Center" class="column-title"> Waktu Keluar</th>
                                                <th align="Center" class="column-title">Status</span></th>


                                                <th class="column-title"><span class="nobr">Detail</span> </th>
                                            </tr>

                            </thead>

                            <tbody>
                            <?php
                                $no = 1;
                                if(isset($_POST['tgl_awal'])==false){
                                    $idd = $_SESSION['id_req'];
                                $sql=$konek->query("SELECT * FROM request WHERE DAY(tanggal_masuk)=DAY(NOW()) AND MONTH(tanggal_masuk)=MONTH(NOW()) AND YEAR(tanggal_masuk)=YEAR(NOW()) AND tanggal_keluar >= NOW() AND tanggal_masuk <= NOW()  ORDER BY tanggal_masuk DESC");
                                }else{
                                    $tgl1 = mysqli_real_escape_string($konek, $_POST['tgl_awal']);
                                    $tgl2 = mysqli_real_escape_string($konek, $_POST['tgl_akhir']);
                                if($tgl1 != null && $tgl2!= null){

                                  $tgl1 = date("Y-m-d",strtotime($tgl1));
                                  $tgl2 = date("Y-m-d",strtotime($tgl2));

                                  $sql=$konek->query("SELECT * FROM request WHERE DAY(tanggal_masuk)=DAY(NOW()) AND MONTH(tanggal_masuk)=MONTH(NOW()) AND YEAR(tanggal_masuk)=YEAR(NOW()) AND tanggal_masuk BETWEEN '$tgl1' AND '$tgl2' AND tanggal_keluar >= NOW() AND tanggal_masuk <= NOW() ORDER BY tanggal_masuk DESC");
                              }else{
                                $sql=$konek->query("SELECT * FROM request WHERE DAY(tanggal_masuk)=DAY(NOW()) AND MONTH(tanggal_masuk)=MONTH(NOW()) AND YEAR(tanggal_masuk)=YEAR(NOW()) AND tanggal_keluar >= NOW() AND tanggal_masuk <= NOW()  ORDER BY tanggal_masuk DESC");
                              }

                                  echo "<h2>Tampilkan Dari Tanggal $tgl1 -> $tgl2</h2>";

                                }
                                while($data=$sql->fetch_assoc()){
                            ?>
                                           <tr class="odd pointer">
                                                <td><?php echo $no++; ?></td>
                                                <td>REQ<?php echo $data['id_req']; ?></td>
                                                <td><?php echo $data['tanggal_masuk']; ?></td>
                                                <td><?php echo $data['tanggal_keluar']; ?></td>


                                                 <?php if($data['status_hadir']=="N"){ ?>
												<td class=" last"><p>Belum Mengisi Buku Tamu</p></td>



                                                <?php }elseif($data['status_hadir']=="Y"){ ?>
                                                <td class=" last"><p>Sudah Mengisi Buku Tamu</p></td>



                                                    <?php } ?>

                                                      <td>

                                                      <?php
                                                      if($data['status_hadir']!='Y'){
                                                       echo '<a href="#" onClick="showModals(\''.$data['id_req'].'\')" class="btn btn-info btn-lg">Detail</a> ' ; }?>

                                                      </td>


                                            </tr>

                            <?php } ?>

                                            </tbody>

                                    </table>
                                </div>
            </div>
            <!-- /page content -->
        </div>

    </div>

    <div class="modal fade" id="myModals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Detail Tamu</h4>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" role="alert" id="removeWarning">
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <span class="sr-only">Error:</span>
                            Anda yakin ingin menghapus Lokasi ini
                        </div>
                        <br>
                        <form class="form-horizontal" id="formtim">

                            <input type="hidden" class="form-control" id="id" name="id">
                            <input type="hidden" class="form-control" id="userid" name="userid">
                            <input type="hidden" class="form-control" id="type" name="type">

                            <div class="form-group">
                                <label for="real_name" class="col-sm-2 control-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama" name="nama" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="npm" class="col-sm-2 control-label">Instansi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="instansi" name="instansi" readonly>
                                </div>
                            </div>

                             <div class="form-group">
                                <label for="npm" class="col-sm-2 control-label">Tujuan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="tujuan" name="tujuan" readonly> </textarea>
                                </div>
                            </div>


                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" onClick="submitUser()" class="btn btn-success btn-lg" data-dismiss="modal">Isi Buku Tamu</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                    </div>
                </div>
            </div>


<div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>


    <script type="text/javascript" src="js/common.js"></script>

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

<script>

            //Tampilkan Modal
            function showModals( id )
            {
                waitingDialog.show();
                clearModals();

                // Untuk Eksekusi Data Yang Ingin di Edit atau Di Hapus
                if( id )
                {
                    $.ajax({
                        type: "POST",
                        url: "less/crud_tamu.php",
                        dataType: 'json',
                        data: {id:id,type:"get"},
                        success: function(res) {
                            waitingDialog.hide();
                            setModalData( res );
                        }
                    });
                }
                // Untuk Tambahkan Data
                else
                {
                    $("#myModals").modal("show");
                    $("#myModalLabel").html("Lokasi Baru");
                    $("#type").val("new");
                    waitingDialog.hide();
                }
            }

            //Data Yang Ingin Di Tampilkan Pada Modal Ketika Di Edit
            function setModalData( data )
            {

                $("#id").val(data.id_req);
                $("#type").val("edit");
                $("#userid").val(data.id_req);

                $("#nama").val(data.nama).attr("disabled","true");;
                $("#instansi").val(data.instansi);
                $("#tujuan").val(data.tujuan);
                $("#myModals").modal("show");
            }

            //Submit Untuk Eksekusi Tambah/Edit/Hapus Data
            function submitUser()
            {
                var formData = $("#formtim").serialize();
                waitingDialog.show();
                $.ajax({
                    type: "POST",
                    url: "less/crud_tamu.php",
                    dataType: 'json',
                    data: formData,
                    success: function(data) {
                        //dTable.ajax.reload(); // Untuk Reload Tables secara otomatis
                        waitingDialog.hide();
                        window.location.reload();
                    }
                });
            }

            //Hapus Data
            function deleteUser( id )
            {
                clearModals();
                $.ajax({
                    type: "POST",
                    url: "less/crud_tamu.php",
                    dataType: 'json',
                    data: {id:id,type:"get"},
                    success: function(data) {
                        $("#removeWarning").show();
                        $("#myModalLabel").html("Hapus Anggota");
                        $("#id").val(data.country_code);
                        $("#userid").val(data.userid);
                        $("#type").val("delete");

                        $("#kode_kota").val(data.country_code).attr("disabled","true");
                        $("#nama_kota").val(data.country_name).attr("disabled","true");

                        $("#myModals").modal("show");
                        waitingDialog.hide();
                    }
                });
            }

            //Clear Modal atau menutup modal supaya tidak terjadi duplikat modal
            function clearModals()
            {
                $("#removeWarning").hide();
                $("#id").val("").removeAttr( "disabled" );
                $("#userid").val("").removeAttr( "disabled" );
                $("#kode_kota").val("").removeAttr( "disabled" );
                $("#nama_kota").val("").removeAttr( "disabled" );

            }

        </script>

</div>

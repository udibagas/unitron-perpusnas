	<?php 
		@session_start();
		$idd = $_SESSION['id_req'];
		$qq = $konek->query("SELECT * FROM register WHERE id_register='$idd'");
		$num_rows = $qq->num_rows;

		if($num_rows<1){
		$qq = $konek->query("SELECT nama_lengkap as nama,nalokl as instansi FROM users WHERE username='$idd'");	
		}

		$did = $qq->fetch_assoc();

		$nama_req = $did['nama'];
		$instansi_req = $did['instansi'];

		$ss = $konek->query("SELECT MAX(id_req) as up FROM request");
		$dd = $ss->fetch_assoc();

		$id_req = mysqli_real_escape_string($konek, $_GET['id']);
		$kode_req="REQ".$dd['up'];
		
	 ?>


    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.js"></script>
    <script src="js/datatables/tools/js/dataTables.tableTools.js"></script>
    <script type="text/javascript" src="js/common.js"></script>

    <link href="css/bootstrap-datetimepicker.css" rel="stylesheet">
    
    <script src="js/datetimepicker/moment-with-locales.js"></script>
    <script src="js/datetimepicker/bootstrap-datetimepicker.js"></script>


		<script type="text/javascript" language="javascript" >

			var dTable;
			// #Example adalah id pada table
			$(document).ready(function() {
				dTable = $('#example').DataTable( {
					"sScrollX": "100%",
					"bProcessing": true,
					"language": {
				            "lengthMenu": "Tampilkan _MENU_ data perhalaman",
				            "zeroRecords": "Data tidak Ada",
				            "info": "Tampil data _PAGE_ dari _PAGES_",
				            "infoEmpty": "Tidak ada data tersimpan",
				            "infoFiltered": "(Saring dari _MAX_ total data)",
				            "paginate": {
							      "previous": "Kembali",
							      "next": "Lanjut"
							    }
				        },
					"bServerSide": true,
					"bJQueryUI": false,
					"responsive": true,
					"sAjaxSource": "less/server_req.php?tipe=pp", // Load Data
					"sServerMethod": "POST",
					"columnDefs": [
					{ "orderable": false, "targets": 0, "searchable": false },
					{ "orderable": true, "targets": 1, "searchable": true },
					{ "orderable": true, "targets": 2, "searchable": true },
					{ "orderable": true, "targets": 3, "searchable": true },
					{ "orderable": true, "targets": 4, "searchable": true }
					]
				} );

				$('#example').removeClass( 'display' ).addClass('table table-striped responsive-utilities jambo_table');
				$('#example tfoot th').each( function () {

					//Agar kolom Action Tidak Ada Tombol Pencarian
					if( $(this).text() != "Action" ){
						var title = $('#example thead th').eq( $(this).index() ).text();
						$(this).html( '<input type="text" placeholder="Cari Berdasarkan '+title+'" class="form-control" />' );
					}
				} );

				// Untuk Pencarian, di kolom paling bawah
				dTable.columns().every( function () {
					var that = this;

					$('input', this.footer() ).on( 'keyup change', function () {
						that
						.search( this.value )
						.draw();
					} );
				} );
			} );


		</script>

		

		 		<div class="row">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Permohonan Perpanjangan Izin 
                    <small>
                      <!-- Some examples to get you started -->
                    </small>
                </h3>
                        </div>
                        
                    </div>


                    <?php 
                    	$sql = $konek->query("SELECT id_req FROM request WHERE status='N' AND id_regis='$idd'");
                    	$num = $sql->num_rows;
                    	if($num==0){
                     ?>

					  <div class="row">
                        <div class="abcdefg">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                   
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        
                                       
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">

					<form class="form-horizontal form-label-left" novalidate>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="nama_req" type="text" name="nama_req" data-validate-length-range="4,20" class="optional form-control col-md-7 col-xs-12" 
                                                 value="<?php echo $nama_req; ?>" readonly>
                                            </div>
                                        </div>
										
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="instansi">SKPD <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="instansi_req" type="text" name="instansi_req" data-validate-length-range="4,20" class="optional form-control col-md-7 col-xs-12" value="<?php echo $instansi_req; ?>" readonly>
                                            </div>
                                        </div>
                              
                                        

                                </div>
                            </div>
                        </div>
                    </div>
                    </form>

                    <div class="clearfix"></div>

               
					<hr>

					<div class="row">
			<div class="col-md-1 col-sm-12 col-xs-12"></div>
				<div class="col-md-10 col-sm-12 col-xs-12">
					<button onClick="showModals()" class="btn btn-primary">Tambah Pengunjung</button>
					
					<hr>
					
					<table id="example"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
						<thead>
							<tr>
								<th>Action</th>
								<th>No</th>
								<th>Nama Pengunjung</th>
								<th>Jabatan</th>
								<th>Instansi</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
						<tfoot>
							<th>Action</th>
							<th>No</th>
							<th>Nama Pengunjung</th>
							<th>Jabatan</th>
							<th>Instansi</th>
						</tfoot>
					</table>

				</div>

                        <div class="clearfix"></div>
                        <div class="clearfix"></div>
                        <hr>


						<div class="abcdefg">
                                    <form method="POST" action="less/aksi_pbk.php?tipe=perpanjang&module=input" class="form-horizontal form-label-left" enctype="multipart/form-data">
                                    <input name="id_req" type="hidden" value="<?php echo $id_req; ?>"/>
									<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tujuan">Alasan Perpanjang <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea id="tujuan" required="required" name="tujuan" class="form-control col-md-7 col-xs-12" data-toggle="tooltip" data-placement="bottom" title="Inputkan Tujuan"></textarea>
                                                </div>
                                            </div>

                                            <div class="item form-group">

                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tujuan">Ruang <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                  <?php 	
                                                  	$n=1;
                                                  	$qq = $konek->query("SELECT ruang_name FROM ruang ORDER by ruang_id");
                                                  	while($data=$qq->fetch_assoc()){
                                                   ?>
                                                  <label>
                                                        <input type="checkbox" name="ch<?php echo $n; ?>" class="flat" value="<?php echo $data['ruang_name']; ?>" /> <?php echo $data['ruang_name']; ?> &nbsp;&nbsp;
                                                   </label>
                                                   <?php $n++; } ?>
                                            </div>
                                            </div>

                                             

                                             

 											<div class="item form-group">
 											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tujuan">Tanggal Perpanjangan<span class="required">*</span>
                                            </label>
                                             

<div class='col-sm-8'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control"  name="tgl1" required/>
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


		<!-- Modal Popup -->
		<div class="modal fade" id="myModals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Add User</h4>
					</div>
					<div class="modal-body">

						<div class="alert alert-danger" role="alert" id="removeWarning">
							<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
							<span class="sr-only">Error:</span>
							Anda yakin ingin menghapus user ini
						</div>
						<br>
						<form class="form-horizontal" id="formtim">

							<input type="hidden" class="form-control" id="tt" name="tt" value="<?php echo $id_req; ?>">

							<input type="hidden" class="form-control" id="id" name="id">
							<input type="hidden" class="form-control" id="userid" name="userid">
							<input type="hidden" class="form-control" id="type" name="type">

							<div class="form-group">
								<label for="real_name" class="col-sm-2 control-label">Nama</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="nama" name="nama" >
								</div>
							</div>
							<div class="form-group">
								<label for="npm" class="col-sm-2 control-label">Jabatan</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="jabatan" name="jabatan" >
								</div>
							</div>
							<div class="form-group">
								<label for="kelas" class="col-sm-2 control-label">Instansi</label>
								<div class="col-sm-10">
									<textarea type="text" class="form-control" id="instansi" name="instansi" ></textarea>
								</div>
							</div>
						</form>

					</div>
					<div class="modal-footer">
						<button type="button" onClick="submitUser()" class="btn btn-default" data-dismiss="modal">Lakukan</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
					</div>
				</div>
			</div>
		</div>

		<?php } else{
			echo "

			<div class='row'>
			<div class='abcdefg'>
            <div class='panel panel-success'>
			<h2 align='center'>Menunggu Respon permohonan, <a href='?page=status_req'>Lihat Status</a></h2>

			";

			echo "
			</div></div></div>";

			} ?>

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
						url: "less/crud_req.php",
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
					$("#myModalLabel").html("Anggota Tim Baru");
					$("#type").val("new");
					waitingDialog.hide();
				}
			}

			//Data Yang Ingin Di Tampilkan Pada Modal Ketika Di Edit
			function setModalData( data )
			{
				$("#myModalLabel").html(data.real_name);
				$("#id").val(data.id);
				$("#type").val("edit");
				$("#userid").val(data.id_tim);
				$("#nama").val(data.nama);
				$("#jabatan").val(data.jabatan);
				$("#instansi").val(data.instansi);
				$("#myModals").modal("show");
			}

			//Submit Untuk Eksekusi Tambah/Edit/Hapus Data
			function submitUser()
			{
				var formData = $("#formtim").serialize();
				waitingDialog.show();
				$.ajax({
					type: "POST",
					url: "less/crud_req.php",
					dataType: 'json',
					data: formData,
					success: function(data) {
						dTable.ajax.reload(); // Untuk Reload Tables secara otomatis
						waitingDialog.hide();
					}
				});
			}

			//Hapus Data
			function deleteUser( id )
			{
				clearModals();
				$.ajax({
					type: "POST",
					url: "less/crud_req.php",
					dataType: 'json',
					data: {id:id,type:"get"},
					success: function(data) {
						$("#removeWarning").show();
						$("#myModalLabel").html("Hapus Anggota");
						$("#id").val(data.id_tim);
						$("#userid").val(data.userid);
						$("#type").val("delete");
						$("#nama").val(data.nama).attr("disabled","true");
						$("#jabatan").val(data.jabatan).attr("disabled","true");
						$("#instansi").val(data.instansi).attr("disabled","true");
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
				$("#nama").val("").removeAttr( "disabled" );
				$("#jabatan").val("").removeAttr( "disabled" );
				$("#type").val("");
				$("#instansi").val("").removeAttr( "disabled" );
			}

		</script>

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
} );

        
</script>

	<!--
	#####################################################################
	#	Author : Andri Kurnia Putra										#
	#	Release: 4-4-2016												#
	#	Judul  : Ajax CRUD 												#
	#	Powered: JQUERY 												#
	#####################################################################
     -->

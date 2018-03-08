	<?php 
		@session_start();
		$idd = $_SESSION['id_req'];
		$qq = $konek->query("SELECT * FROM register WHERE id_register='$idd'");
		$did = $qq->fetch_assoc();
		$nama_req = $did['nama'];
		$instansi_req = $did['instansi'];
		$ss = $konek->query("SELECT MAX(id_req) as up FROM request");
		$dd = $ss->fetch_assoc();
		$kode_req="REQ".$dd['up'];
		$level = $_SESSION['level'];
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
					"sAjaxSource": "less/server_ruang.php", // Load Data
					"sServerMethod": "POST",
					"columnDefs": [
					{ "orderable": false, "targets": 0, "searchable": false },
					{ "orderable": true, "targets": 1, "searchable": true },
					{ "orderable": true, "targets": 2, "searchable": true },
					{ "orderable": true, "targets": 3, "searchable": true }
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

		

		 		
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Input Ruang
                    <small>
                      <!-- Some examples to get you started -->
                    </small>
                </h3>
                        </div>
                        
                    </div>


                  

					  <div class="row">
                        <div class="abcdefg">
                            <div class="panel panel-success">


			<div class="row">
			<div class="col-md-1 col-sm-12 col-xs-12"></div>
				<div class="col-md-10 col-sm-12 col-xs-12">
					<button onClick="showModals()" class="btn btn-primary">Tambah Ruang</button>
					
					<hr>
					
					<table id="example"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
						<thead>
							<tr>
								<th width="20%">Action</th>
								<th>No</th>
								<th>Lokasi</th>
								<th>No Ruang</th>
								<th>Nama Ruang</th>
							</tr>
						</thead>
						<tfoot>
							<th width="20%">Action</th>
								<th>No</th>
								<th>Lokasi</th>
								<th>No Ruang</th>
								<th>Nama Ruang</th>
						</tfoot>
						<tbody>
						</tbody>
						
					</table>

				</div>

			<div class="col-md-1 col-sm-12 col-xs-12"></div>
				<br></div>

                      <br>
					<hr>
					<br>
						                                    </div>
			</div>

		</div>


		<!-- Modal Popup -->
		<div class="modal fade" id="myModals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Add Ruang</h4>
					</div>
					<div class="modal-body">

						<div class="alert alert-danger" role="alert" id="removeWarning">
							<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
							<span class="sr-only">Error:</span>
							Anda yakin ingin menghapus Ruang ini
						</div>
						<br>
						<form class="form-horizontal" id="formtim">

							<input type="hidden" class="form-control" id="id" name="id">
							<input type="hidden" class="form-control" id="userid" name="userid">
							<input type="hidden" class="form-control" id="type" name="type">

							<div class="form-group">
								<label for="real_name" class="col-sm-2 control-label">Lokasi</label>
								<div class="col-sm-10">
									<select class="form-control" id="no_lokasi" name="no_lokasi">
										
									<option>Pilih Lokasi</option>

									<?php
										$lokasi = $konek->query('SELECT * FROM lokasi');
										while($data=$lokasi->fetch_assoc()){
											echo "<option value='$data[lokasi_id]'>$data[lokasi_name] </option>";
										}

									 ?>

									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="real_name" class="col-sm-2 control-label">No Ruang</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="no_ruang" name="no_ruang" >
								</div>
							</div>
							<div class="form-group">
								<label for="npm" class="col-sm-2 control-label">Nama Ruang</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="nama_ruang" name="nama_ruang" >
								</div>
							</div>
							
							

							
						</form>

					</div>
					<div class="modal-footer">
						<button type="button" onClick="submitUser()" class="btn btn-default" data-dismiss="modal">Proses</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
					</div>
				</div>
			</div>



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
						url: "less/crud_ruang.php",
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
					$("#myModalLabel").html("Ruang Baru");
					$("#type").val("new");
					waitingDialog.hide();
				}
			}

			//Data Yang Ingin Di Tampilkan Pada Modal Ketika Di Edit
			function setModalData( data )
			{
				$("#myModalLabel").html(data.real_name);
				$("#id").val(data.ruang_id);
				$("#type").val("edit");
				$("#userid").val(data.ruang_id);

				$("#no_lokasi").val(data.lokasi_id);
				$("#no_ruang").val(data.ruang_no);
				$("#nama_ruang").val(data.ruang_name);
				$("#myModals").modal("show");
			}

			//Submit Untuk Eksekusi Tambah/Edit/Hapus Data
			function submitUser()
			{
				var formData = $("#formtim").serialize();
				waitingDialog.show();
				$.ajax({
					type: "POST",
					url: "less/crud_ruang.php",
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
					url: "less/crud_ruang.php",
					dataType: 'json',
					data: {id:id,type:"get"},
					success: function(data) {
						$("#removeWarning").show();
						$("#myModalLabel").html("Hapus Anggota");
						$("#id").val(data.ruang_id);
						$("#userid").val(data.userid);
						$("#type").val("delete");

						$("#no_lokasi").val(data.lokasi_id).attr("disabled","true");
						$("#no_ruang").val(data.ruang_no).attr("disabled","true");
						$("#nama_ruang").val(data.ruang_name).attr("disabled","true");
					
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
				$("#no_ruang").val("").removeAttr( "disabled" );
				$("#nama_ruang").val("").removeAttr( "disabled" );

			}

		</script>


	<!--
	#####################################################################
	#	Author : Andri Kurnia Putra										#
	#	Release: 4-4-2016												#
	#	Judul  : Ajax CRUD 												#
	#	Powered: JQUERY 												#
	#####################################################################
     -->

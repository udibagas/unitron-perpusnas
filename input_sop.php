
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

<script src="js/datatables/tools/js/dataTables.tableTools.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script src="js/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="js/jquery.dataTables.js"></script>
<script src="js/datatables/tools/js/dataTables.tableTools.js"></script>
<link href="css/bootstrap-datetimepicker.css" rel="stylesheet">

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
			"sAjaxSource": "less/server_sop.php", // Load Data
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

<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title">SOP</h3>
    </div>
    <div class="panel-body">
        <button onclick="showModals(0)" class="btn btn-success">TAMBAH SOP</button>
        <br>
        <br>

        <table id="example" class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No SOP</th>
                    <th>SOP</th>
                    <th width="15%">Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>No SOP</th>
                    <th>SOP</th>
                    <th width="15%">Action</th>
                </tr>
            </tfoot>
            <tbody> </tbody>
        </table>
    </div>
</div>

<!-- Modal Popup -->
<div class="modal fade" id="myModals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog"  style="width: 85%;">
    	<div class="modal-content">
    		<div class="modal-header">
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    			<h4 class="modal-title" id="myModalLabel">Add SOP</h4>
    		</div>
    		<div class="modal-body">

    			<div class="alert alert-danger" role="alert" id="removeWarning">
    				<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    				<span class="sr-only">Error:</span>
    				Anda yakin ingin menghapus SOP ini
    			</div>
    			<br>
    			<form class="form-horizontal" id="formtim">

    				<input type="hidden" class="form-control" id="id" name="id">
    				<input type="hidden" class="form-control" id="userid" name="userid">
    				<input type="hidden" class="form-control" id="type" name="type">

    				<div class="form-group">
    					<label for="real_name" class="col-sm-2 control-label">No SOP</label>
    					<div class="col-sm-10">
    						<input type="text" class="form-control" id="nama_sop" name="nama_sop" >
    					</div>
    				</div>
    				<div class="form-group">
    					<label for="npm" class="col-sm-2 control-label">Nama SOP</label>
    					<div class="col-sm-10">
    						<textarea class="form-control" id="sop" name="sop" > </textarea>
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
</div>

<script type="text/javascript" language="javascript">
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
				url: "less/crud_sop.php",
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
			$("#myModalLabel").html("SOP Baru");
			$("#type").val("new");
			waitingDialog.hide();
		}
	}

	//Data Yang Ingin Di Tampilkan Pada Modal Ketika Di Edit
	function setModalData( data )
	{
		$("#myModalLabel").html(data.real_name);
		$("#id").val(data.id_sop);
		$("#sop").val(data.sop);
		CKEDITOR.instances['sop'].setData(data.sop);
		CKEDITOR.instances['sop'].setData(data.sop);
		CKEDITOR.instances['sop'].setData(data.sop);
		CKEDITOR.instances['sop'].setData(data.sop);
		CKEDITOR.instances['sop'].setData(data.sop);
		CKEDITOR.instances['sop'].setData(data.sop);
		CKEDITOR.instances['sop'].setData(data.sop);
		CKEDITOR.instances['sop'].setData(data.sop);
		CKEDITOR.instances['sop'].setData(data.sop);
		CKEDITOR.instances['sop'].setData(data.sop);
		CKEDITOR.instances['sop'].setData(data.sop);
		CKEDITOR.instances['sop'].setData(data.sop);
		$("#type").val("edit");
		$("#userid").val(data.id_sop);
		$("#nama_sop").val(data.nama_sop);
		$("#myModals").modal("show");
	}

	//Submit Untuk Eksekusi Tambah/Edit/Hapus Data
	function submitUser()
	{
		for ( instance in CKEDITOR.instances ){
	        CKEDITOR.instances[instance].updateElement();
		}
		var formData = $("#formtim").serialize();
		waitingDialog.show();
		$.ajax({
			type: "POST",
			url: "less/crud_sop.php",
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
			url: "less/crud_sop.php",
			dataType: 'json',
			data: {id:id,type:"get"},
			success: function(data) {
				$("#removeWarning").show();
				$("#myModalLabel").html("Hapus Anggota");
				$("#id").val(data.id_sop);
				$("#userid").val(data.userid);
				$("#type").val("delete");

				$("#nama_sop").val(data.nama_sop).attr("disabled","true");
				$("#sop").val(data.sop).attr("disabled","true");
				CKEDITOR.instances['sop'].setData(data.sop);
		CKEDITOR.instances['sop'].setData(data.sop);
		CKEDITOR.instances['sop'].setData(data.sop);
		CKEDITOR.instances['sop'].setData(data.sop);
		CKEDITOR.instances['sop'].setData(data.sop);
		CKEDITOR.instances['sop'].setData(data.sop);
		CKEDITOR.instances['sop'].setData(data.sop);
		CKEDITOR.instances['sop'].setData(data.sop);

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
		$("#nama_sop").val("").removeAttr( "disabled" );
		$("#sop").val("").removeAttr( "disabled" );
		CKEDITOR.instances['sop'].setData("");

	}


    CKEDITOR.replace( 'sop', {
    	extraPlugins: 'imageuploader'
    });

</script>

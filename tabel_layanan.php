
   

<?php

include 'koneksi.php';
  if(isset($_POST['submit'])==true){
        $id_kategori_layanan = mysqli_real_escape_string($konek, $_POST['kategori']);
      }
?>
<form method="POST">
     <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-3 col-xs-12" for="tujuan">Filter Berdasarkan kategori <span class="required">*</span>
                      </label>
                       <div class="col-md-3 col-sm-6 col-xs-12">
                          <select name="kategori" class="form-control">
                          <option>Pilih </option>
                          <?php $sql = $konek->query("SELECT * FROM kategori_layanan ORDER BY id_kategori_layanan");
                          while($data11=$sql->fetch_assoc()){
                           ?>
                          <option value="<?php echo $data11['id_kategori_layanan']; ?>"><?php echo $data11['kategori_layanan']; ?></option>
                          <?php } ?>
                          </select>
                       </div>
                       <div align="left" class="col-md-1 col-sm-6 col-xs-12">
                       <input class="btn btn-info" type="submit" name="submit" value="Filter" /> 
                       </div> 
                       <div align="left" class="col-md-1 col-sm-6 col-xs-12">
                        <a class="btn btn-info" href="media.php?page=tabel_layanan">Tampilkan Seluruh </a>
                       </div>
  <?php
    if($_SESSION['level']=='admin'){
   ?>
    <div align="right" class="col-md-2 col-sm-6 col-xs-12">
    <a href="?page=input_layanan" class="btn btn-danger"> Tambah Data </a>
    </div>
<?php } ?>
                    </div>
</form>
         <br>   
            <div class="table-responsive">
            <!--<table  border="1" id="tabel1" class="table table-hover table-striped jambo_table" cellspacing="0" width="150%">-->
				<table class="table table-striped table-bordered table-hover" id="editable" >
      
        <thead>
        <tr>
			<th>No</th>
			<th>Kategori / Pemilik Layanan</th>
			<th>Nama Layanan</th>
			<th>Defenisi Layanan</th>
			<th>Level Layanan</th>
			<th>Tdk termasuk Layanan</th>
			<th>Pedoman</th>
			<th>Jam Layanan</th>
			<th>Aksi</th>
        </tr>
        </thead>
        
        <tbody>

        <?php 
if(isset($_POST['submit'])==false){
$sql = "SELECT layanan.id_layanan,layanan.pemilik_layanan,layanan.link,layanan.nama_layanan,layanan.defenisi_layanan,layanan.level_layanan,layanan.tidak_layanan,layanan.ketersediaan_layanan,layanan.BPP,layanan.SOP,layanan.`status`,kategori_layanan.kategori_layanan,kategori_layanan.nama_layanan as deskripsi FROM layanan INNER JOIN kategori_layanan ON kategori_layanan.id_kategori_layanan = layanan.id_kategori_layanan";
}else{
$sql = "SELECT layanan.id_layanan,layanan.pemilik_layanan,layanan.nama_layanan,layanan.link,layanan.defenisi_layanan,layanan.level_layanan,layanan.tidak_layanan,layanan.ketersediaan_layanan,layanan.BPP,layanan.SOP,layanan.`status`,kategori_layanan.kategori_layanan,kategori_layanan.nama_layanan as deskripsi FROM layanan INNER JOIN kategori_layanan ON kategori_layanan.id_kategori_layanan = layanan.id_kategori_layanan WHERE layanan.id_kategori_layanan='$id_kategori_layanan'";
}
$exec = $konek->query($sql);
$no=1;
$data2='';
while($data=$exec->fetch_assoc())
    {
    
        ?>
            <tr>
            <td><?php echo $no++; ?></td>
			<td><?php echo $data['kategori_layanan']; ?><br>
			<strong><?php echo $data['pemilik_layanan']; ?></strong></td>
			<td><a href='<?php echo $data['link']; ?>'><?php echo $data['nama_layanan']; ?></a></td>
			<td><a href='<?php echo $data['link']; ?>'><?php echo $data['defenisi_layanan']; ?></a></td>
			<td><?php echo $data['level_layanan']; ?></td>
			<td><?php echo $data['tidak_layanan']; ?></td>
			<td><?php echo $data['BPP']; ?><br>
			<?php echo $data['SOP']; ?></td>
			<td><?php echo $data['ketersediaan_layanan']; ?></td>
            <td>
            <?php if($_SESSION['level']=='admin'){ ?>
            <a class="btn btn-sm btn-default" href="?page=input_layanan&id=<?php echo $data['id_layanan']; ?>">Edit</a> 
            <?php } ?>
            <a class="btn btn-sm btn-default" href="?page=detail_layanan&id=<?php echo $data['id_layanan']; ?>">Detail</a>
            </td>
            </tr>
    <?php } ?>
        </tbody>
    </table>
</div>
 <br>  <br>

</div>
</div>
        <script src="js/datatables/js/jquery.dataTables.js"></script>
        <script src="js/datatables/tools/js/dataTables.tableTools.js"></script>

<script type="text/javascript">
   
$(document).ready(function() {
    $('#tabel1').DataTable( {
        "pageLength": 10,
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
                className: 'mdl-data-table__cell--non-numeric'
            }
        ]
    } );
	
            /* Init DataTables */
            var oTable = $('#editable').dataTable();

            /* Apply the jEditable handlers to the table */
            oTable.$('td').editable( '../example_ajax.php', {
                "callback": function( sValue, y ) {
                    var aPos = oTable.fnGetPosition( this );
                    oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                },
                "submitdata": function ( value, settings ) {
                    return {
                        "row_id": this.parentNode.getAttribute('id'),
                        "column": oTable.fnGetPosition( this )[2]
                    };
                },

                "width": "90%",
                "height": "100%"
            } );
} );




</script>

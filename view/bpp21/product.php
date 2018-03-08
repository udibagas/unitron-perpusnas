<?php

include 'koneksi.php';

?>

<?php
$ruang_name = "";
$id = mysqli_real_escape_string($konek, $_GET['id']);

?>
<form method="POST" action="media.php?page=inventory">
   <div class="form-group">
    <label class="control-label col-md-1 col-sm-1 col-xs-12">Saring Berdasarkan</label>
    <div class="col-md-2 col-sm-2 col-xs-12">
	<select name="filter" class="select2_single form-control" tabindex="-1">
	
	<option value="#">Pilih Rak (Tampilkan Semua)</option>
	
	<?php $sql = $konek->query("SELECT DISTINCT
    sub_ruang.sub_ruang_name,sub_ruang.sub_ruang_id
FROM 
    product
INNER JOIN brands ON brands.brand_id = product.brand_id
INNER JOIN kelompok_perangkat_biaya ON kelompok_perangkat_biaya.kelompok_perangkat_biaya_id = product.kelompok_perangkat_biaya_id
INNER JOIN jenis_biaya ON jenis_biaya.jenis_biaya_id = kelompok_perangkat_biaya.jenis_biaya_id
INNER JOIN sub_unit ON sub_unit.sub_unit_id = product.sub_unit_id
INNER JOIN product_ownership ON product_ownership.product_ownership_id = product.product_ownership_id
INNER JOIN product_condition ON product_condition.product_condition_id = product.product_condition_id
INNER JOIN sub_ruang ON sub_ruang.sub_ruang_id = product.sub_ruang_id
WHERE 
    product.product_deleted = '0'");

	while($data=$sql->fetch_array()){
	?>
		
	<option value="<?php echo $data['sub_ruang_id']; ?>"><?php echo $data['sub_ruang_name']; ?></option>
	
	<?php } ?>
    </select>		
	</td>
	</div>
	<div class="col-md-1 col-sm-2 col-xs-12">
	<td><input class="btn btn-default" type="submit" name="submit" value="Cari" /></td>
	
    </div>

    <div align="right" class="col-md-8 col-sm-2 col-xs-12">
    <a href="?page=ppk9inventory&tipe=produk&id=<?php echo $_SESSION['id']; ?>&pg=pd_tb" class="btn btn-info"> Tambah Data </a>
    </div>
</form>
<div class="col-md-1 col-sm-2 col-xs-12">

</div>

    <?php 
    if(isset($_POST['filter'])==true){
    echo "Saring Berdasarkan $_POST[filter];"; 
    }?>
         <br>     
            <table id="tabel1" class="table table-striped responsive-utilities jambo_table" cellspacing="0" width="100%">
      
        <thead>
        <tr>
            <td>No</td>
            <td>Merk</td>
            <td>Model / Tipe</td>
            <td>Pemilik</td>
            <td>Tempat</td>
            <td>Status</td>
            <td>Kondisi</td>
            <td>Aksi</td>
        </tr>
        </thead>
        <tfoot>
            <tr>
            <td>No</td>
            <td>Merk</td>
            <td>Model / Tipe</td>
            <td>Pemilik</td>
            <td>Tempat</td>
            <td>Status</td>
            <td>Kondisi</td>
            <td>Aksi</td>
            </tr>
        </tfoot>
        <tbody>

        <?php 
if(isset($_POST['filter'])==false){

$sql = "SELECT 
    product.product_id,
    product.product_registration_code,
    brands.brand_name,
    product.product_model,
    jenis_biaya.jenis_biaya_name,
    sub_unit.sub_unit_name,
    product_ownership.product_ownership_name,
    product_condition.product_condition_name,
    product.product_note,
    sub_ruang.sub_ruang_name
FROM 
    product
INNER JOIN brands ON brands.brand_id = product.brand_id
INNER JOIN kelompok_perangkat_biaya ON kelompok_perangkat_biaya.kelompok_perangkat_biaya_id = product.kelompok_perangkat_biaya_id
INNER JOIN jenis_biaya ON jenis_biaya.jenis_biaya_id = kelompok_perangkat_biaya.jenis_biaya_id
INNER JOIN sub_unit ON sub_unit.sub_unit_id = product.sub_unit_id
INNER JOIN product_ownership ON product_ownership.product_ownership_id = product.product_ownership_id
INNER JOIN product_condition ON product_condition.product_condition_id = product.product_condition_id
INNER JOIN sub_ruang ON sub_ruang.sub_ruang_id = product.sub_ruang_id
WHERE 
    product.product_deleted = '0' AND id_req='$id'";
}
else{
$sql = "SELECT 
    product.product_id,
    product.product_registration_code,
    brands.brand_name,
    product.product_model,
    jenis_biaya.jenis_biaya_name,
    sub_unit.sub_unit_name,
    product_ownership.product_ownership_name,
    product_condition.product_condition_name,
    product.product_note,
    sub_ruang.sub_ruang_name
FROM 
    product
INNER JOIN brands ON brands.brand_id = product.brand_id
INNER JOIN kelompok_perangkat_biaya ON kelompok_perangkat_biaya.kelompok_perangkat_biaya_id = product.kelompok_perangkat_biaya_id
INNER JOIN jenis_biaya ON jenis_biaya.jenis_biaya_id = kelompok_perangkat_biaya.jenis_biaya_id
INNER JOIN sub_unit ON sub_unit.sub_unit_id = product.sub_unit_id
INNER JOIN product_ownership ON product_ownership.product_ownership_id = product.product_ownership_id
INNER JOIN product_condition ON product_condition.product_condition_id = product.product_condition_id
INNER JOIN sub_ruang ON sub_ruang.sub_ruang_id = product.sub_ruang_id
WHERE 
    product.product_deleted = '0' AND id_req='$id'";

if($_POST['filter']!="#"){
    $sql = $sql. " AND sub_ruang.sub_ruang_id='$_POST[filter]'";
}
}
$exec = $konek->query($sql);
$no=1;
while($data=$exec->fetch_assoc())
    {
        ?>
            <tr></h2>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data['brand_name']; ?></td>
            <td><?php echo $data['product_model']; ?></td>
            <td><?php echo $data['sub_unit_name']; ?></td>
            <td><?php echo $data['sub_ruang_name']; ?></td>
            <td><?php echo $data['product_ownership_name']; ?></td>
            <td><?php echo $data['product_condition_name']; ?></td>
            <td><a class="btn btn-sm btn-success" href="?page=ppk9inventory&tipe=detailb&id=<?php echo $_SESSION['id']; ?>&pg=pd_dt&idb=<?php echo $data['product_id']; ?>">Detail</td>
            </tr>

    <?php } ?>
            
        </tbody>
    </table>
 <br>  <br>

</div>
</div>

        <script src="js/datatables/js/jquery.dataTables.js"></script>
        <script src="js/datatables/tools/js/dataTables.tableTools.js"></script>

<script type="text/javascript">
   
 
$(document).ready(function() {
    $('#tabel1').DataTable( {
        "sScrollX": "100%",
        "pageLength": 10,
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
                className: 'mdl-data-table__cell--non-numeric'
            }
        ]
    } );
} );




</script>

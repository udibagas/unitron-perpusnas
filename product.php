  <link rel="stylesheet" href="js/chosen/chosen.css">

  <script src="js/chosen/chosen.jquery.js" type="text/javascript"></script>
  <script src="js/chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>

<?php
@session_start();
include 'koneksi.php';

?>

<?php
$ruang_name = "";

?>
<form method="POST" action="media.php?page=inventory">
   <div class="form-group">
    <label class="control-label col-md-1 col-sm-1 col-xs-12">Saring Berdasarkan</label>
    <div class="col-md-2 col-sm-2 col-xs-12">
	<select name="filter" class="select2_single form-control" tabindex="-1">
	
	<option value="#">Pilih Rak (Tampilkan Semua)</option>
	
	<?php $sql = $konek->query("SELECT DISTINCT
    ruang.ruang_name,ruang.ruang_id
FROM 
    product
LEFT OUTER JOIN brands ON brands.brand_id = product.brand_id
LEFT OUTER JOIN kelompok_perangkat_biaya ON kelompok_perangkat_biaya.kelompok_perangkat_biaya_id = product.kelompok_perangkat_biaya_id
LEFT OUTER JOIN jenis_biaya ON jenis_biaya.jenis_biaya_id = kelompok_perangkat_biaya.jenis_biaya_id
LEFT OUTER JOIN sub_unit ON sub_unit.sub_unit_id = product.sub_unit_id
LEFT OUTER JOIN product_ownership ON product_ownership.product_ownership_id = product.product_ownership_id
LEFT OUTER JOIN product_condition ON product_condition.product_condition_id = product.product_condition_id
LEFT OUTER JOIN ruang ON ruang.ruang_id = product.ruang_id
WHERE 
    product.product_deleted = '0'");

	while($data=$sql->fetch_array()){
	?>
		
	<option value="<?php echo $data['ruang_id']; ?>"><?php echo $data['ruang_name']; ?></option>
	
	<?php } ?>
    </select>		
	</td>
	</div>
	<div class="col-md-1 col-sm-2 col-xs-12">
	<td><input class="btn btn-info" type="submit" name="submit" value="Cari" /></td>
	
    </div>

    <div align="right" class="col-md-8 col-sm-2 col-xs-12">
    <a href="?page=inventory&pg=pd_tb" class="btn btn-danger"> Tambah Data </a>
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
            <td>SKPD/UKPD</td>
            <td>Pemilik/Penanggung Jawab</td>
            <td>Ruang</td>
            <td>Sub Ruang</td>
            <td>Posisi</td>
            <td>Koneksi Listrik</td>
            <td>Merk</td>
            <td>Model / Tipe</td>
            <td>Kontak</td>
            <td>Fungsi</td>
            <td>Status</td>
            <td>Kondisi</td>
            <td>Aksi</td>
        </tr>
        </thead>
        
        <tbody>

        <?php 
if(isset($_POST['filter'])==false){

$sql = "SELECT
product.product_id,
product.product_registration_code,
brands.brand_name,
product.product_model,
jenis_biaya.jenis_biaya_name,
product_ownership.product_ownership_name,
product_condition.product_condition_name,
product.product_note,
product.Merek_Seri_Tipe,
product.ruang,
product.Power_Connect,
product.Model,
product.Posisi,
product.Nama_kontak,
product.Fungsi,
product.IP_Address,
product.LAN_Connect,
ref_lokasi_tbl.nalokl,
ref_kojab_tbl.najabl,
ruang.ruang_name,
sub_ruang.sub_ruang_name
FROM
product
LEFT OUTER JOIN brands ON brands.brand_id = product.brand_id
LEFT OUTER JOIN kelompok_perangkat_biaya ON kelompok_perangkat_biaya.kelompok_perangkat_biaya_id = product.kelompok_perangkat_biaya_id
LEFT OUTER JOIN jenis_biaya ON jenis_biaya.jenis_biaya_id = kelompok_perangkat_biaya.jenis_biaya_id
LEFT OUTER JOIN product_ownership ON product_ownership.product_ownership_id = product.product_ownership_id
LEFT OUTER JOIN product_condition ON product_condition.product_condition_id = product.product_condition_id
LEFT OUTER JOIN ref_lokasi_tbl ON product.kolok = ref_lokasi_tbl.kolok
LEFT OUTER JOIN ref_kojab_tbl ON product.kolok = ref_kojab_tbl.kolok AND product.kojab = ref_kojab_tbl.kojab
LEFT OUTER JOIN ruang ON ruang.ruang_id = product.ruang_id
LEFT OUTER JOIN sub_ruang ON sub_ruang.sub_ruang_id = product.sub_ruang_id AND sub_ruang.ruang_id = product.ruang_id
WHERE 
    product.product_deleted = '0' ";
}
else{
$sql = "SELECT
product.product_id,
product.product_registration_code,
brands.brand_name,
product.product_model,
jenis_biaya.jenis_biaya_name,
product_ownership.product_ownership_name,
product_condition.product_condition_name,
product.product_note,
product.Merek_Seri_Tipe,
product.ruang,
product.Power_Connect,
product.Model,
product.Posisi,
product.Nama_kontak,
product.Fungsi,
product.IP_Address,
product.LAN_Connect,
ref_lokasi_tbl.nalokl,
ref_kojab_tbl.najabl,
ruang.ruang_name,
sub_ruang.sub_ruang_name
FROM
product
LEFT OUTER JOIN brands ON brands.brand_id = product.brand_id
LEFT OUTER JOIN kelompok_perangkat_biaya ON kelompok_perangkat_biaya.kelompok_perangkat_biaya_id = product.kelompok_perangkat_biaya_id
LEFT OUTER JOIN jenis_biaya ON jenis_biaya.jenis_biaya_id = kelompok_perangkat_biaya.jenis_biaya_id
LEFT OUTER JOIN product_ownership ON product_ownership.product_ownership_id = product.product_ownership_id
LEFT OUTER JOIN product_condition ON product_condition.product_condition_id = product.product_condition_id
LEFT OUTER JOIN ref_lokasi_tbl ON product.kolok = ref_lokasi_tbl.kolok
LEFT OUTER JOIN ref_kojab_tbl ON product.kolok = ref_kojab_tbl.kolok AND product.kojab = ref_kojab_tbl.kojab
LEFT OUTER JOIN ruang ON ruang.ruang_id = product.ruang_id
LEFT OUTER JOIN sub_ruang ON sub_ruang.sub_ruang_id = product.sub_ruang_id AND sub_ruang.ruang_id = product.ruang_id

WHERE 
    product.product_deleted = '0' ";

if($_POST['filter']!="#"){
    $sql = $sql. " AND ruang.ruang_id='$_POST[filter]'";
}
}

if($_SESSION['level']!='admin'){

    if($_SESSION['level']=='manager'){


    $kolok = $_SESSION['kolok'];
    $sql= $sql. " AND product.kolok='$kolok'";

    }elseif($_SESSION['level']=='super'){

    $kolok = $_SESSION['kolok'];
    $kojab = substr($_SESSION['kojab'],0,3);
    $sql= $sql. " AND product.kolok='$kolok' AND LEFT(product.kojab,3)='$kojab'";

    }else{

    $kolok = $_SESSION['kolok'];
    $kojab = $_SESSION['kojab'];
    $sql= $sql. " AND product.kolok='$kolok' AND product.kojab='$kojab'";

    }
}

$sql = $sql. " ORDER BY product.product_id DESC";

//echo "$sql";
$exec = $konek->query($sql);
$no=1;
while($data=$exec->fetch_assoc())
    {
        ?>
            <tr></h2>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data['nalokl']; ?></td>
            <td><?php echo $data['najabl']; ?></td>
            <td><?php echo $data['ruang_name']; ?></td>
            <td><?php echo $data['sub_ruang_name']; ?></td>
            <td><?php echo $data['Posisi']; ?></td>
            <td><?php echo $data['Power_Connect']; ?></td>
            <td><?php echo $data['brand_name']; ?></td>
            <td><?php echo $data['product_model']; ?><br>
            <?php echo $data['Merek_Seri_Tipe']; ?></td>
            <td><?php echo $data['Nama_kontak']; ?></td>
            <td><?php echo $data['Fungsi']; ?></td>
            <td><?php echo $data['product_ownership_name']; ?></td>
            <td><?php echo $data['product_condition_name']; ?></td>
            
            <td><a class="btn btn-sm btn-success" href="?page=inventory&pg=pd_dt&id=<?php echo $data['product_id']; ?>">Detail</a></td>
            </tr>

    <?php } ?>
            
        </tbody>
    </table>
 <br>  <br>
</div>
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

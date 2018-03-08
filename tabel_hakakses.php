<?php

include 'koneksi.php';

?>

    <div align="right" class="abcdefg">
    <a href="?page=input_hakakses" class="btn btn-info"> Tambah Data </a>
    </div>

         <br>     
            <table id="tabel1" class="table table-striped responsive-utilities jambo_table" cellspacing="0" width="100%">
      
        <thead>
        <tr>
            <td>No</td>
            <td>Username</td>
            <td>Nama Lengkap</td>
            <td>Step</td>
            <td>Level</td>
            <td>Status</td>
            <td>Aksi</td>
        </tr>
        </thead>
        <tfoot>
            <tr>
            <td>No</td>
            <td>Username</td>
            <td>Nama Lengkap</td>
            <td>Hak Akses</td>
            <td>Level</td>
            <td>Status</td>
            <td>Aksi</td>
            </tr>
        </tfoot>
        <tbody>

        <?php 

$sql = "SELECT users.username,users.nama_lengkap,users.`level`,pelaksana_bpp.pelaksana_warna,pelaksana_bpp.step,users.nip,users.nalokl,pelaksana_bpp.aktif FROM pelaksana_bpp INNER JOIN users ON users.username = pelaksana_bpp.id_register";

$exec = $konek->query($sql);
$no=1;
$data2='';
while($data=$exec->fetch_assoc())
    {

    $step = $data['step'];
      $pecah = explode(',',$step);

      if($pecah[0]=="ALL"){
        $data2='ALL';
        $cnt = count($pecah)-1;

        for($a=1;$a<=$cnt;$a++){
             $pecahan = $pecah[$a];
             $query = $konek->query("SELECT step,no_bpp,nama_bpp FROM step WHERE id_step='$pecahan'");
             $dd = $query->fetch_assoc();
             $data2=$data2.",".$dd['nama_bpp']."-".$dd['no_bpp'];
        }

      }elseif($pecah[0]=="bagi"){
         $cnt = count($pecah)-1;
         $data2='Pembagian';
        for($a=0;$a<=$cnt;$a++){
             $pecahan = $pecah[$a];
             $query = $konek->query("SELECT step,no_bpp,nama_bpp FROM step WHERE id_step='$pecahan'");
             $dd = $query->fetch_assoc();
            
             $data2=$data2.",".$dd['nama_bpp']."-".$dd['no_bpp'];
      }
    }
        ?>
            <tr></h2>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data['username']; ?></td>
            <td><?php echo $data['nama_lengkap']; ?></td>
            <td><?php echo $data2; ?></td>
            <td><?php echo $data['level']; ?></td>
            <td><?php echo $data['aktif']; ?></td>
            <td><a class="btn btn-sm btn-success" href="?page=input_hakakses&id=<?php echo $data['username']; ?>">Edit</td>
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

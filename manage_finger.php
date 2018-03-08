
  <div class="row">
                        <div class="abcdefg">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h2>Perintah</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        
                                       
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
 <div align="Left" class="abcdefg">

    <form method="POST" action="less/aksi.php?tipe=finger&module=ambil_semua" class="form-horizontal form-label-left" novalidate>
    <div class="col-md-3 col-sm-12 col-xs-12">
    <select name="ruang" class="form-control">
    <option>Pilih Ruang</option>
    <?php
    	$qruang = "SELECT * FROM ruang";
     	$ruang = $konek->query($qruang);
     	while($druang=$ruang->fetch_assoc()){
     ?>
    <option value="<?php echo $druang['ruang_id']; ?>"><?php echo $druang['ruang_name']; ?></option>
    <?php } ?>
    </select>
    </div>

    <div class="col-md-3 col-sm-12 col-xs-12">
    <input type="submit" name="submit" class="btn btn-info" value="Ambil Data Finger" />
    </div>
    </form>
    <div align="right" class="abcdefg">
     <a href='less/aksi.php?tipe=finger&module=transfer' class="btn btn-info">Proses Data Finger </a>
    
     </div>
    </div>


 <table id="tabel1" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th class="column-title">Nomor </th>
                                                <th class="column-title">Kode Enroll </th>
                                                <th class="column-title">Nama </th>
                                                <th class="column-title">Id Card </th>
                                                <th class="column-title">Sidik Jari </th>
                                                <th class="column-title">Face </th>

                                                </th>

                                </tr>
                            </thead>

                            <tbody>
                            <?php 
                                $no = 1;
                                $sql = $konek->query("SELECT * FROM enroll_master_sementara");
                                while($data=$sql->fetch_assoc()){

                                if($data['temp_sidik_jari']!='' || $data['temp_sidik_jari']!=null){
                                	$temp = "Y";
                                }else{
                                	$temp = "T";
                                }

                                if($data['temp_wajah']!='' || $data['temp_wajah']!=null){
                                	$tempW = "Y";
                                }else{
                                	$tempW = "T";
                                }
                            ?>
                                           <tr class="odd pointer">
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $data['kode_enroll']; ?></td>
                                                <td><?php echo $data['username']; ?></td>
                                                <td><?php echo $data['card_id']; ?></td>
                                                <td><?php echo $temp; ?></td>
                                                <td><?php echo $tempW; ?></td>
                                               
                                            </tr>

                            <?php } ?>

 
    </div>


<script src="js/datatables/js/jquery.dataTables.js"></script>
        <script src="js/datatables/tools/js/dataTables.tableTools.js"></script>

<script type="text/javascript">
   
$(document).ready(function() {
    $('#tabel1').DataTable( {
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

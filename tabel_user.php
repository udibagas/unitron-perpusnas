  <link rel="stylesheet" href="js/chosen/chosen.css">

  <script src="js/chosen/chosen.jquery.js" type="text/javascript"></script>
  <script src="js/chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
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

<form method="POST" class="form-horizontal form-label-left" novalidate>
<div align="left" class="abcdefg">
<div class="col-md-2"> 
<p>Filter Berdasarkan SKPD/UKPD</p>
</div>
    <div class="col-md-4">  
    <select class="form-control" name="skpd" id="skpd" data-placeholder="Choose a skpd/ukpd..." class="chosen-select"  tabindex="2">
    <?php 
        if(isset($_POST['submit'])==true){
            $skpd = mysqli_real_escape_string($konek, $_POST['skpd']);
             $sql = $konek->query("SELECT kolok,nalokl FROM ref_lokasi_tbl WHERE kolok='$skpd'");
             $dr=$sql->fetch_assoc();
             echo "<option value='$dr[kolok]'>$dr[nalok]</option>";
        }
    ?>
    <option value="">Pilih SKPD/UKPD</option>
    <?php 

                    if ($_SESSION['level'] == 'admin') {
                                    $querym="SELECT kolok,nalokl FROM `ref_lokasi_tbl` WHERE `aktif` = 'Y' order by nalokl";
                                } else {
                                    $querym="SELECT kolok,nalokl FROM `ref_lokasi_tbl` WHERE kolok = $_SESSION[kolok] AND `aktif` = 'Y' order by nalokl";
                                }
                                $tampilm = $konek->query($querym);  
                                while ($rm=$tampilm->fetch_assoc()){  
                                    if(!empty($skpd) && $skpd == $rm['kolok']){
                                        echo "<option value='$rm[kolok]' selected>$rm[nalokl]</option>";
                                    }else{
                                        echo "<option value='$rm[kolok]'>$rm[nalokl]</option>";
                                    }
                                }
                        ?>                                       
                            </select>
                </div>

                <div class="col-md-1"> 
                <input class="btn btn-info" type="submit" name="submit" value="Filter" />
                </div>

</div>
</form>

<br>

 <table id="tabel1" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th class="column-title">Nomor </th>
                                                <th class="column-title">Username</th>
                                                <th class="column-title">Password </th>
                                                <th class="column-title">Identitas </th>
                                                <th class="column-title">Nama Lengkap </th>
                                                <th class="column-title">Level </th>
                                                <th class="column-title">Blokir </th>
                                                <th class="column-title">Pemandu </th>
                                                <th class="column-title">Pengelola </th>
                                                <th class="column-title">Temp Admin </th>
                                                <th class="column-title">Aksi </th>
                                                </th>

                                </tr>
                            </thead>

                            <tbody>
                            <?php 
                            if(isset($_POST['submit'])==true){
                                $no = 1;
                                $skpd = mysqli_real_escape_string($konek, $_POST['skpd']);
                                $sql = $konek->query("SELECT username,password,no_indentitas,nama_lengkap,level,blokir,pemandu,atasan,pengelola,temp_admin FROM users WHERE kolok='$skpd' ORDER BY kolok,kojab,status DESC");
                                while($data=$sql->fetch_assoc()){
                            ?>
                                           <tr class="odd pointer">
                                                <td><?php echo $no++; ?></td>
                                                <th class="column-title"><?php echo $data['username']; ?></th>
                                                <th class="column-title"><?php echo $data['password']; ?> </th>
                                                <th class="column-title"><?php echo $data['no_indentitas']; ?> </th>
                                                <th class="column-title"><?php echo $data['nama_lengkap']; ?> </th>
                                                <th class="column-title"><?php echo $data['level']; ?> </th>
                                                <th class="column-title"><?php echo $data['blokir']; ?></th>
                                                <th class="column-title"><?php echo $data['pemandu']; ?> </th>
                                                <th class="column-title"><?php echo $data['pengelola']; ?> </th>
                                                <th class="column-title"><?php echo $data['temp_admin']; ?></th>
                                                <th class="column-title">

                                                <?php
                                                if($data['level']!='admin'){
                                                 if($data['temp_admin']=='Y'){ ?>
                                                
                                                <a href="less/aksi.php?tipe=users&module=batal_admin&id=<?php echo $data['username']; ?>" class="btn btn-danger">Hapus Admin</a>
                                                <?php }else{ ?>
                                                <a href="less/aksi.php?tipe=users&module=set_admin&id=<?php echo $data['username']; ?>" class="btn btn-success">Set Admin</a>
                                                <?php }} ?>
                                                <a href="" class="btn btn-info">Edit</a><a href="" class="btn btn-warning">Delete</a></th>
                                               
                                            </tr>
                            <?php  }
                            } ?>
    </div>

<script src="js/datatables/js/jquery.dataTables.js"></script>
        <script src="js/datatables/tools/js/dataTables.tableTools.js"></script>

<script type="text/javascript">
$("#skpd").chosen({no_results_text: "Oops, Data Tidak ditemukan !"});
   
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
} );




</script>

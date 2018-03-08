<?php

    @session_start();
    if(isset($_SESSION['username'])==false)
    {
        echo "<meta http-equiv='refresh' content='0;URL=menu_login.php' />";
    }

 $user = $_SESSION['id_req'];
 $level = $_SESSION['level'];

 $qcek = "SELECT temp_admin FROM users WHERE username='$user'";
 $cek = $konek->query($qcek);
 $dcek = $cek->fetch_assoc();

 if($level!="admin"){
    if($dcek['temp_admin']!='Y'){
       echo "<meta http-equiv='refresh' content='0;URL=?page=menu_layanan' />";
    }
 }

?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>Manajemen Room</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="redirect.php">Home</a>
                        </li>
                        <li class="active">
                            <strong>Open Door</strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row">

            <!-- page content -->
                            <?php

                                    $sql=$konek->query("SELECT * FROM ruang WHERE (ip<>'' || ip<>null) ORDER by ruang_id");
                                while($data=$sql->fetch_assoc()){
                            ?>
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-content">
                            <a class="btn btn-primary btn-rounded btn-block" href="less/aksi.php?tipe=finger&module=buka&id=<?php echo $data['ruang_id']; ?>"><i class="fa fa-home"></i> <?php echo $data['ruang_name'];  ?></a>
                        </div>
                    </div>
                </div>
                            <?php } ?>
            </div>

            </div>
            <!-- /page content -->
        </div>

    </div>


    <script src="js/datatables/js/jquery.dataTables.js"></script>
    <script src="js/datatables/tools/js/dataTables.tableTools.js"></script>
    <script type="text/javascript" src="js/moment.min2.js"></script>
    <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>

<script type="text/javascript">

$(document).ready(function() {

    $('#tabel2').DataTable( {
        "sPaginationType": "full_numbers",
        "sScrollX": "100%",
        "oLanguage": {
    "sSearch": "Filter : ",
    className: 'form-control'
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

</div>

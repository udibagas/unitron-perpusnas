<?php

    @session_start();
    if(isset($_SESSION['username'])==false)
    {
        echo "<meta http-equiv='refresh' content='0;URL=menu_login.php' />";
    }

?>

            <!-- page content -->

                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                   Buka Pintu
                    <small>
                      <!-- Some examples to get you started -->
                    </small>
                </h3>
                        </div>


                        <div class="clearfix"></div>
                        <div class="clearfix"></div>

                        <div class="abcdefg">
                            <div class="panel panel-success">


                                <div class="panel-body">



                                    <table id="tabel2" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">

                                                <th  class="column-title">No </th>
                                                <th  class="column-title">Ruang </th>
                                                <th  class="column-title">Aksi </th>
                                            </tr>
                                      </thead>
                            <tbody>
                            <?php
                                $no = 1;

                                    $sql=$konek->query("SELECT * FROM ruang WHERE (ip<>'' || ip<>null) ORDER by ruang_id");

                                while($data=$sql->fetch_assoc()){
                            ?>
                                           <tr class="odd pointer">
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $data['ruang_name'];  ?></td>
                                                <td><p><a class="btn btn-success" href="less/aksi.php?tipe=finger&module=buka&id=<?php echo $data['ruang_id']; ?>">Buka Pintu</a></p></td>
                                            </tr>

                            <?php } ?>
                                            </tbody>

                                    </table>
                                </div></div></div>
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

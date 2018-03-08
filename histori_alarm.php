<?php
@session_start();
if(isset($_SESSION['username'])==false) {
    echo "<meta http-equiv='refresh' content='0;URL=menu_login.php' />";
}
?>

<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title">RIWAYAT ALARM</h3>
    </div>
    <div class="panel-body">
        <form method="POST">
            <div class="col-md-2 col-sm-6 col-xs-12">
                <fieldset>
                    <div class="control-group">
                        <div class="controls">
                            <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="single_cal1" placeholder="Tanggal Awal" aria-describedby="inputSuccess2Status" name="tgl_awal">
                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                <span id="inputSuccess2Status" class="sr-only">(success)</span>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="col-md-2 col-sm-6 col-xs-12">
                <fieldset>
                    <div class="control-group">
                        <div class="controls">
                            <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="single_cal2" placeholder="Tanggal Akhir" aria-describedby="inputSuccess2Status" name="tgl_akhir">
                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                <span id="inputSuccess2Status" class="sr-only">(success)</span>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="col-md-1 col-sm-6 col-xs-12">
                <input type="submit" class="btn btn-success" name="t1" value="TAMPILKAN"/>
            </div>
        </form>

<table id="tabel2" class="table table-striped responsive-utilities jambo_table">
    <thead>
        <tr class="headings">
            <th  class="column-title">Nomor </th>
            <th  class="column-title">Waktu </th>
            <th  class="column-title">Pesan </th>
        </tr>
  </thead>
  <tbody>
  <?php
      $no = 1;
      if(isset($_POST['tgl_awal'])==false){
      $sql=$konek->query("SELECT histori_alert.waktu,histori_alert.pesan,histori_alert.baru FROM histori_alert ORDER BY id_alert DESC");
      }else{
           $tgl1 = mysqli_real_escape_string($konek, $_POST['tgl_awal']);
          $tgl2 = mysqli_real_escape_string($konek, $_POST['tgl_akhir']);
      if($tgl1 != null && $tgl2!= null){

        $sql=$konek->query("SELECT histori_alert.waktu,histori_alert.pesan,histori_alert.baru FROM histori_alert WHERE date(waktu) BETWEEN '$tgl1' AND '$tgl2' ORDER BY waktu DESC");

        echo "<h2>Tampilkan Dari Tanggal $tgl1 -> $tgl2</h2>";

      } else {
          $sql=$konek->query("SELECT histori_alert.waktu,histori_alert.pesan,histori_alert.baru FROM histori_alert ORDER BY id_alert DESC");
      }
  }
      while($data=$sql->fetch_assoc()){
  ?>
                 <tr class="odd pointer">
                      <td><?php echo $no++; ?></td>
                      <td><?php echo date("d-M-Y H:i:s",strtotime($data['waktu']));  ?></td>
                      <td><p><?php echo $data['pesan']; ?></p></td>
                  </tr>

  <?php } ?>
            </tbody>
        </table>
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

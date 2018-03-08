<?php

include "koneksi.php";


if(isset($_POST['submit1'])==true){

    $ruang = $_POST['ruang1'];
    $par = $_POST['param1'];

    $sql=$konek->query("SELECT ID_SENSOR FROM sensor WHERE NAMALOKASI='$ruang' AND PARAMETER='$par' ORDER BY ID_SENSOR ASC");
    $no=2;
    while($sql->fetch_array()){

        $min = "nilaimin".$no;
        $min= $_POST[$min];

        $max = "nilaimax".$no;
        $max = $_POST[$max];

        $id = "id_sen".$no;
        $id = $_POST[$id];
        $konek->query("UPDATE sensor SET NILAIMIN='$min',NILAIMAX='$max' WHERE ID_SENSOR='$id'");
        $no++;

    }

}

?>
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Ikhtisar
                    <small>
                        Menu
                    </small>
                </h3>
                        </div>

                    </div>
                    <div class="clearfix"></div>

                        <div class="panel-body">


                                        <div class="row">



<table bgcolor="white" align="center" width="100%">


<tr align="center">
    <td bgcolor="skyblue" height="30"><h1><font color="white">Pengaturan Batas Minimum dan Maksimum Sensor</font></h1></td>
    </tr>


<tr>
<td colspan="4" align="center">
<?php
 if(isset($_POST['submit1'])==true){
    echo "<div class='alert alert-success alert-dismissible fade in role='alert'>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                                    </button>
                                    <strong>Data Berhasil Disimpan</strong>
                                </div>";
 }  ?>
 </td>
</tr>
</table>
<br>


<div class="col abcdefg" align="center" valign="center" style="height:50px;">
<form method="POST">
    <div class="col col-md-1 col-sm-12 col-xs-12" align="center">
 Ruangan :
 </div>
        <div align="left" class="col col-md-3 col-sm-12 col-xs-6" align="center">

            <select class="select2_single form-control" name="ruangan" id="ruangan">

    <?php
        if(isset($_POST['submit'])==true){

        echo "<option>$_POST[ruangan]</option>";

    }elseif(isset($_POST['submit1'])==true){
        echo "<option>$_POST[ruang1]</option>";
    }

    ?>
                <option>Pilih Ruangan</option>
                <?php
                    $sql=$konek->query("SELECT DISTINCT NAMALOKASI FROM sensor");
                    while($data=$sql->fetch_array()){

                        echo "<option>$data[NAMALOKASI]</option>";
                    }
                ?>
            </select>
</div>
</div>
<div>
<div class="col col-md-1 col-sm-12 col-xs-12" align="center">
Paramater :
</div>
    <div class="col col-md-2 col-sm-12 col-xs-12" align="center">

    <select class="select2_single form-control" id="param" name="param" >


    <?php
    /*  if(isset($_POST['submit'])==true){

        echo "<option>$_POST[param]</option>";

    }elseif(isset($_POST['submit1'])==true){
        echo "<option>$_POST[param1]</option>";
    }

    ?>

                <option>Pilih Parameter</option>


                <?php
                    $sql=$konek->query("SELECT DISTINCT PARAMETER FROM sensor WHERE PARAMETER<>'Gas'");
                    while($data=$sql->fetch_array()){

                        echo "<option>$data[PARAMETER]</option>";
                    } */
                ?>

            </select>
            </div>

<div class="col col-md-2 col-sm-12 col-xs-12" align="center">

    <input class="btn btn-info" type="submit" name="submit" value="Filter"/>
</div>
</div></div>

</form>

<?php
    if((isset($_POST['submit'])==true) OR (isset($_POST['submit1'])==true) ){
?>
<div class="col abcdefg" align="center">

<table class="table table-striped responsive-utilities jambo_table" align="center">
    <tr>

        <th> Nomor</th>
        <th> Product</th>
        <th> Kode Alat</th>
        <th> Posisi</th>
        <th> Nilai Minimum</th>
        <th> Nilai Maximum</th>
    </tr>
<form method="POST">
<?php
 $no=1;
 if(isset($_POST['submit1'])==false){
 $sql=$konek->query("SELECT ID_SENSOR,PRODUCT,POSISIDETAIL,KODEALAT,NILAIMIN,NILAIMAX,LEFT(KODEALAT,7) as cek,LEFT(PARAMETER,4) as cek_param FROM sensor WHERE NAMALOKASI='$_POST[ruangan]' AND PARAMETER='$_POST[param]' ORDER BY ID_SENSOR ASC");
 }else{
     $sql=$konek->query("SELECT ID_SENSOR,PRODUCT,POSISIDETAIL,KODEALAT,NILAIMIN,NILAIMAX,LEFT(KODEALAT,7) as cek,LEFT(PARAMETER,4) as cek_param  FROM sensor WHERE NAMALOKASI='$_POST[ruang1]' AND PARAMETER='$_POST[param1]' ORDER BY ID_SENSOR ASC");
 }
 while($data=$sql->fetch_array()){

?>
    <tr>
        <td> <?php echo $no++;

        if(isset($_POST['submit1'])==false){
        ?>

            <input type="hidden" name="ruang1" value="<?php echo $_POST['ruangan']; ?>" />
            <input type="hidden" name="param1" value="<?php echo $_POST['param']; ?>" />

        <?php }else{ ?>

            <input type="hidden" name="ruang1" value="<?php echo $_POST['ruang1']; ?>" />
            <input type="hidden" name="param1" value="<?php echo $_POST['param1']; ?>" />

        <?php } ?>

        </td>
        <td> <?php echo $data['PRODUCT']; ?> </td>
        <td> <?php echo $data['KODEALAT']; ?> </td>
        <td> <?php echo $data['POSISIDETAIL']; ?> </td>
        <td> <input onkeypress="return isNumber(event)" maxlength="<?php if($data['cek_param']=='Curr' || $data['cek_param']=='Volt'){ echo '3'; }else{ echo '2';} ?>" style="width:100px;text-align:center;" type="text" name="nilaimin<?php echo $no; ?>" value=<?php echo $data['NILAIMIN']; ?> <?php if($data['cek']=="Listrik" || $data['cek_param']=='Arus' || $data['cek_param']=='Daya'){ echo "disabled" ;} ?>/>
         <input type="hidden" name="id_sen<?php echo $no; ?>" value="<?php echo $data['ID_SENSOR']; ?>"
         /> </td>
        <td> <input onkeypress="return isNumber(event)" maxlength="<?php if($data['cek_param']=='Curr' || $data['cek_param']=='Volt' || $data['cek_param']=='Arus'){ echo '3'; }else{ echo '2';} ?>" style="width:100px;text-align:center;" type="text" name="nilaimax<?php echo $no; ?>" value=<?php echo $data['NILAIMAX']; ?> /> <?php if($data['cek_param']=='Curr'){ echo 'A'; }elseif($data['cek_param']=='Acti'){ echo 'KW';}elseif($data['cek_param']=='Volt'){ echo 'Volt';}elseif($data['cek_param']=='Freq'){ echo 'Hz';}elseif($data['cek_param']=='Suhu'){ echo 'C';}elseif($data['cek_param']=='Lemb'){ echo '%';} ?> </td>
    </tr>

<?php }  ?>

</table>
</div>

<div class="col abcdefg" align="center">
 <input style="width:100px;" class="btn btn-success btn-lg" type="submit" name="submit1" value="Simpan"/>
</div>
</form>




<?php } ?>

</td>
</tr>



<tr>
<td height="30">    </td>
</tr>

</table>

<script type="text/javascript">

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

</script>


                                        </div>


                <div class="clearfix">
                     </div>

            </div>
            <!-- /page content -->
        </div>

    </div>
    <script src="js/bootstrap.min.js"></script>

    <script src="js/nicescroll/jquery.nicescroll.min.js"></script>



    <script src="js/echart/green.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#ruangan').change(function(){
            $.getJSON('less/jmin.php',{action:'getruang', kode_ruang:$(this).val()}, function(json){
                $('#param').html('');
                $.each(json, function(index, row) {
                    $('#param').append('<option>'+row.PARAMETER+'</option>');
                });
            });
        });
    });
</script>

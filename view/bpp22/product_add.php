
<?php
$locations = array();
$sql = "SELECT lokasi_id AS `id`, lokasi_name AS `name` FROM lokasi;";
if ($result = $konek->query($sql)) {
    while ($row = $result->fetch_object()) {
        $locations[] = $row;
    }
}
$groups = array();
$sql = "SELECT golongan_perangkat_id AS `id`, golongan_perangkat_name AS `name` FROM golongan_perangkat;";
if ($result = $konek->query($sql)) {
    while ($row = $result->fetch_object()) {
        $groups[] = $row;
    }
}
$units = array();
$sql = "SELECT unit_id AS `id`, unit_name AS `name` FROM unit;";
if ($result = $konek->query($sql)) {
    while ($row = $result->fetch_object()) {
        $units[] = $row;
    }
}
$countries = array();
$sql = "SELECT country_code AS `id`, country_name AS `name` FROM countries;";
if ($result = $konek->query($sql)) {
    while ($row = $result->fetch_object()) {
        $countries[] = $row;
    }
}
$brands = array();
$sql = "SELECT brand_id AS `id`, brand_name AS `name` FROM brands;";
if ($result = $konek->query($sql)) {
    while ($row = $result->fetch_object()) {
        $brands[] = $row;
    }
}
$ownerships = array();
$sql = "SELECT product_ownership_id AS `id`, product_ownership_name AS `name` FROM product_ownership;";
if ($result = $konek->query($sql)) {
    while ($row = $result->fetch_object()) {
        $ownerships[] = $row;
    }
}
$conditions = array();
$sql = "SELECT product_condition_id AS `id`, product_condition_name AS `name` FROM product_condition;";
if ($result = $konek->query($sql)) {
    while ($row = $result->fetch_object()) {
        $conditions[] = $row;
    }
}

if(isset($_GET['ok'])==true){
$ok = mysqli_real_escape_string($konek, $_GET['ok']);
}else{
    $ok="hahahaha";
}
if($ok=='sukses'){
?>

<div align="center" class="alert alert-success alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Berhasil Disimpan</strong>
                                </div>

<?php
}elseif($ok=='gagal' || $ok=='gagal1'){ 
?>
<div align="center" class="alert alert-danger alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Data Gagal Disimpan !</strong>
                                </div>

<?php
}

?>


        <tr>
            <td background="content_bg.jpg">
            <table border="0"  width="100%" cellspacing="10" cellpadding="10">
                <tr>
                    <td><font face="Arial" color="#000">FORMULIR PENAMBAHAN DATA </font></td>
                </tr>
                <tr>
                    <td>
                    
 <?php
if (isset($errors) && !empty($errors)) {
    echo "<font color='#CC3300'face='Arial' style='font-size: 9pt'>";
    echo "Harap lengkapi data berikut<BR>";
    foreach ($errors as $error) {
        
        echo '- '.$error.'<br>';
    }
    echo "</font>";
}
?>                   
<form action="view/bpp21/product_add_process.php" method="POST" enctype="multipart/form-data">
    <table width="100%" class="table table-striped responsive-utilities jambo_table" border="0" bgcolor="#CCCCFF">
        <thead>
            <tr>
                <td colspan="4" height="33" bgcolor="skyblue">
                    <font face="Arial" color="#000">
                    <strong style="font-weight: 400">
                        &nbsp;Silahkan melengkapi formulir berikut</strong></font></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td align="right" width="20%">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Kode Lokasi
                    </strong>
                    </font>
                </td>
                <td align="center" width="2%" colspan="2">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td width="77%">
                    <select id="lokasi">
                        <option value="">-</option>
                        <?php
                        if (!empty($locations)) {
                            foreach ($locations as $location) {
                                ?>
                            <option value="<?php echo $location->id; ?>"><?php echo $location->name; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <select id="ruang"><option value="">-</option></select>
                    <select name="sub_ruang_id" id="sub_ruang"><option value="">-</option></select>
                    <input type="text" id="kode_lokasi" placeholder="Kode Lokasi" disabled>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Kode Perangkat
                    </strong>
                    </font>
                </td>
                <td align="center" colspan="2">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td width="77%">
                    <select id="golongan">
                        <option value="">-</option>
                        <?php
                        if (!empty($groups)) {
                            foreach ($groups as $group) {
                                ?>
                            <option value="<?php echo $group->id; ?>"><?php echo $group->name; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <select id="kelompok"><option value="">-</option></select>
                    <select name="kelompok_biaya_id" id="kelompok_biaya"><option value="">-</option></select>
                    <input type="text" id="kode_perangkat" placeholder="Kode Perangkat" disabled>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Kode Pemilik
                    </strong>
                    </font>
                </td>
                <td align="center" colspan="2">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td width="77%">
                    <select id="unit">
                        <option value="">-</option>
                        <?php
                        if (!empty($units)) {
                            foreach ($units as $unit) {
                                ?>
                            <option value="<?php echo $unit->id; ?>"><?php echo $unit->name; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <select name="sub_unit_id" id="sub_unit"><option value="">-</option></select>
                    <input type="text" id="kode_pemilik" placeholder="Kode Pemilik" disabled>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Negara Pembuat
                    </strong>
                    </font>
                </td>
                <td align="center" colspan="2">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td width="77%">
                    <select name="country_id">
                        <option value="" <?php if (isset($country_id) && empty($country_id)) { echo "selected"; } ?>>-</option>
                        <?php
                        if (!empty($countries)) {
                            foreach ($countries as $country) {
                                ?>
                            <option value="<?php echo $country->id; ?>" <?php if (isset($country_id) && $country_id == $country->id) { echo "selected"; } ?>><?php echo $country->name; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right" valign="top">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Merek
                    </strong>
                    </font>
                </td>
                <td align="center" colspan="2" valign="top">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td width="77%">
                    <select name="brand_id">
                        <option value="" <?php if (isset($brand_id) && empty($brand_id)) { echo "selected"; } ?>>Lainnya</option>
                        <?php
                        if (!empty($brands)) {
                            foreach ($brands as $brand) {
                                ?>
                            <option value="<?php echo $brand->id; ?>" <?php if (isset($brand_id) && $brand_id == $brand->id) { echo "selected"; } ?>><?php echo $brand->name; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <font face="Arial" style="font-size: 9pt"><br>
                    jika merek tidak tersedia, silahkan pilih &quot;Lainnya&quot; dan 
                    masukkan nama merek :</font> 
                    <input type="text" name="brand_name" placeholder="Merek" value="<?php if (isset($brand_name)) { echo $brand_name; } ?>" size="25">
                </td>
            </tr>
            <tr>
                <td align="right">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Model / Tipe
                    </strong>
                    </font>
                </td>
                <td align="center" colspan="2">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td width="77%">
                    <input type="text" name="product_model" placeholder="Model / Tipe" value="<?php if (isset($product_model)) { echo $product_model; } ?>">
                </td>
            </tr>
            <tr>
                <td align="right">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Serial Number
                    </strong>
                    </font>
                </td>
                <td align="center" colspan="2">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td width="77%">
                    <input type="text" name="product_sn" placeholder="Serial Number" value="<?php if (isset($product_sn)) { echo $product_sn; } ?>">
                </td>
            </tr>
            <tr>
                <td align="right">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Tanggal Penempatan
                    </strong>
                    </font>
                </td>
                <td align="center" colspan="2">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td width="77%">
                    <input type="text" class="datepicker" name="product_receive_date" placeholder="Tanggal Penempatan" value="<?php if (isset($product_receive_date)) { echo $product_receive_date; } ?>">
                </td>
            </tr>
            <tr>
                <td align="right">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Nomor Ikatan Pengadaan
                    </strong>
                    </font>
                </td>
                <td align="center" colspan="2">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td width="77%">
                    <input type="text" name="product_contract_num" placeholder="Nomor Ikatan Pengadaan" value="<?php if (isset($product_contract_num)) { echo $product_contract_num; } ?>">
                </td>
            </tr>
            <tr>
                <td align="right">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Tanggal Ikatan Pengadaan
                    </strong>
                    </font>
                </td>
                <td align="center" colspan="2">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td width="77%">
                    <input type="text" class="datepicker" name="product_contract_date" placeholder="Tanggal Ikatan Pengadaan" value="<?php if (isset($product_contract_date)) { echo $product_contract_date; } ?>">
                </td>
            </tr>
            <tr>
                <td align="right">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Harga Pengadaan
                    </strong>
                    </font>
                </td>
                <td align="center" colspan="2">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td width="77%">
                    <font face="Arial" style="font-size: 9pt">Rp </font> <input type="text" name="product_price" placeholder="Harga Pengadaan" value="<?php if (isset($product_price)) { echo $product_price; } ?>">&nbsp;
                    <font face="Arial" style="font-size: 9pt">contoh 900000 
                    (jangan gunakan koma atau titik)</font></td>
            </tr>
            <tr>
                <td align="right">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Kondisi Perangkat
                    </strong>
                    </font>
                </td>
                <td align="center" colspan="2">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td width="77%">
                    <select name="product_condition_id">
                        <?php
                        if (!empty($conditions)) {
                            foreach ($conditions as $condition) {
                                ?>
                            <option value="<?php echo $condition->id; ?>" <?php if (isset($product_condition_id) && $product_condition_id == $condition->id) { echo "selected"; } ?>><?php echo $condition->name; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Status Kepemilikan
                    </strong>
                    </font>
                </td>
                <td align="center" colspan="2">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td width="77%">
                    <select name="product_ownership_id">
                        <?php
                        if (!empty($ownerships)) {
                            foreach ($ownerships as $ownership) {
                                ?>
                            <option value="<?php echo $ownership->id; ?>" <?php if (isset($product_ownership_id) && $product_ownership_id == $ownership->id) { echo "selected"; } ?>><?php echo $ownership->name; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Tanggal Berakhir Garansi
                    </strong>
                    </font>
                </td>
                <td align="center" colspan="2">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td width="77%">
                    <input type="text" class="datepicker" name="product_warranty_exp_date" placeholder="Tanggal Berakhir Garansi" value="<?php if (isset($product_warranty_exp_date)) { echo $product_warranty_exp_date; } ?>"><font face="Arial" style="font-size: 9pt"> (optional)
                    </font>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Tanggal Berakhir Sewa
                    </strong>
                    </font>
                </td>
                <td align="center" colspan="2">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td width="77%">
                    <input type="text" class="datepicker" name="product_rent_exp_date" placeholder="Tanggal Berakhir Sewa" value="<?php if (isset($product_rent_exp_date)) { echo $product_rent_exp_date; } ?>"> 
                    <font face="Arial" style="font-size: 9pt">&nbsp;(optional)
                    </font>
                </td>
            </tr>
            <tr>
                <td align="right" height="25" valign="top">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Keterangan Tambahan
                    <br>
                    (optional)</strong></font></td>
                <td align="center" height="25" colspan="2" valign="top">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td width="77%" height="25">
                    <font face="Arial">
                    <textarea rows="6" name="product_note" placeholder="Keterangan Tambahan" cols="74" style="font-family: Arial; font-size: 9pt"><?php if (isset($product_note)) { echo $product_note; } ?></textarea></font></td>
            </tr>
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                <td colspan="2">
                    <input type="submit" value="   Simpan Data Baru    "></td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="2">&nbsp;
                    </td>
            </tr>

</form>                    
                    
                    
                    
                    
                    
                    
                    </td>
                </tr>
                </table>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            </td>
        </tr>
    </table>
</div>

    
    <script src="js/jquery-ui.min.js"></script>
    <script>
    $( ".datepicker" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
    $("#lokasi").change(function(){
        var html = '<option value="">-</option>';
        var refId = $(this).val();
        var    target = $("#ruang"),
            request = $.ajax({
            method:'GET',
            url:'view/inven_get/get_ruang.php',
            data:{id : refId},
            dataType:'json'
        });
        request.done(function(data){
            $.each(data, function(key, item){
                html += '<option value="'+item.key+'">'+item.value+'</option>';
            })
            target.html(html);
        });
    });
    $("#ruang").change(function(){
        var html = '<option value="">-</option>';
        var refId = $(this).val();
        var    target = $("#sub_ruang"),
            request = $.ajax({
            method:'GET',
            url:'view/inven_get/get_sub_ruang.php',
            data:{id : refId},
            dataType:'json'
        });
        request.done(function(data){
            $.each(data, function(key, item){
                html += '<option value="'+item.key+'">'+item.value+'</option>';
            })
            target.html(html);
        });
    });
    $("#sub_ruang").change(function(){
        var refId = $(this).val();
        var    target = $("#kode_lokasi"),
            request = $.ajax({
            method:'GET',
            url:'view/inven_get/get_kode_lokasi.php',
            data:{id : refId},
            dataType:'json'
        });
        request.done(function(data){
            target.val(data[0].kode);
        });
    });
    $("#golongan").change(function(){
        var html = '<option value="">-</option>';
        var refId = $(this).val();
        var    target = $("#kelompok"),
            request = $.ajax({
            method:'GET',
            url:'view/inven_get/get_kelompok.php',
            data:{id : refId},
            dataType:'json'
        });
        request.done(function(data){
            $.each(data, function(key, item){
                html += '<option value="'+item.key+'">'+item.value+'</option>';
            })
            target.html(html);
        });
    });
    $("#kelompok").change(function(){
        var html = '<option value="">-</option>';
        var refId = $(this).val();
        var    target = $("#kelompok_biaya"),
            request = $.ajax({
            method:'GET',
            url:'view/inven_get/get_kelompok_biaya.php',
            data:{id : refId},
            dataType:'json'
        });
        request.done(function(data){
            $.each(data, function(key, item){
                html += '<option value="'+item.key+'">'+item.value+'</option>';
            })
            target.html(html);
        });
    });
    $("#kelompok_biaya").change(function(){
        var refId = $(this).val();
        var    target = $("#kode_perangkat"),
            request = $.ajax({
            method:'GET',
            url:'view/inven_get/get_kode_perangkat.php',
            data:{id : refId},
            dataType:'json'
        });
        request.done(function(data){
            target.val(data[0].kode);
        });
    });
    $("#unit").change(function(){
        var html = '<option value="">-</option>';
        var refId = $(this).val();
        var    target = $("#sub_unit"),
            request = $.ajax({
            method:'GET',
            url:'view/inven_get/get_sub_unit.php',
            data:{id : refId},
            dataType:'json'
        });
        request.done(function(data){
            $.each(data, function(key, item){
                html += '<option value="'+item.key+'">'+item.value+'</option>';
            })
            target.html(html);
        });
    });
    $("#sub_unit").change(function(){
        var refId = $(this).val();
        var    target = $("#kode_pemilik"),
            request = $.ajax({
            method:'GET',
            url:'view/inven_get/get_kode_pemilik.php',
            data:{id : refId},
            dataType:'json'
        });
        request.done(function(data){
            target.val(data[0].kode);
        });
    });
    </script>
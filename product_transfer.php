
<head>
<meta http-equiv="Content-Language" content="id">
</head>

<?php

include 'koneksi.php';
?>
<!-- Query Section -->
<?php
if (!isset($_REQUEST['id'])) {
    
    echo "<meta http-equiv='refresh' content='0;URL=media.php?page=inventory' />";
    exit();
}
$product_id = $konek->real_escape_string(trim($_REQUEST['id']));
$exist = FALSE;
$sql = "SELECT COUNT(*) AS counter FROM product WHERE product_id = '{$product_id}';";
if ($result = $konek->query($sql)) {
    $row = $result->fetch_object();
    $exist = ($row->counter == 1)?TRUE:FALSE;
}
if (!$exist) {
    
    echo "<meta http-equiv='refresh' content='0;URL=media.php?page=inventory' />";
    exit();
}
$product = array();
$sql = "SELECT 
    product.*,
    countries.country_name,
    brands.brand_name,
    product_ownership.product_ownership_name,
    product_condition.product_condition_name
FROM 
    product
INNER JOIN countries ON countries.country_code = product.country_code
INNER JOIN brands ON brands.brand_id = product.brand_id
INNER JOIN product_ownership ON product_ownership.product_ownership_id = product.product_ownership_id
INNER JOIN product_condition ON product_condition.product_condition_id = product.product_condition_id
WHERE 
    product.product_id = '{$product_id}'
;";
if ($result = $konek->query($sql)) {
    $product = $result->fetch_object();
}
// get kode lokasi
$sub_ruang_id = $product->sub_ruang_id;
$sql = "
SELECT
    CONCAT(
        IF (
            lokasi.lokasi_no < 10,
            CONCAT('0', lokasi.lokasi_no),
            lokasi.lokasi_no
        ),
        '.',
        IF (
            ruang.ruang_no < 10,
            CONCAT('0', ruang.ruang_no),
            ruang.ruang_no
        ),
        '.',
        IF (
            sub_ruang.sub_ruang_no < 10,
            CONCAT('0', sub_ruang.sub_ruang_no),
            sub_ruang.sub_ruang_no
        ),
        ' - ',
        lokasi.lokasi_name,
        ' > ',
        ruang.ruang_name,
        ' > ',
        sub_ruang.sub_ruang_name
    ) AS kode
FROM
    sub_ruang
INNER JOIN ruang ON sub_ruang.ruang_id = ruang.ruang_id
INNER JOIN lokasi ON lokasi.lokasi_id = ruang.lokasi_id
WHERE 
    sub_ruang_id = '{$sub_ruang_id}'
ORDER BY
    lokasi.lokasi_no ASC,
    ruang.ruang_no ASC,
    sub_ruang.sub_ruang_no ASC
;";
if ($result = $konek->query($sql)) {
    $row = $result->fetch_object();
    $kode_lokasi = $row->kode;
}
// get kode perangkat
$kelompok_perangkat_biaya_id = $product->kelompok_perangkat_biaya_id;
$sql = "
SELECT
    CONCAT(
        IF (
            golongan_perangkat.golongan_perangkat_no < 10,
            CONCAT('0', golongan_perangkat.golongan_perangkat_no),
            golongan_perangkat.golongan_perangkat_no
        ),
        '.',
        IF (
            kelompok_perangkat.kelompok_perangkat_no < 10,
            CONCAT('0', kelompok_perangkat.kelompok_perangkat_no),
            kelompok_perangkat.kelompok_perangkat_no
        ),
        '.',
        jenis_biaya.jenis_biaya_no,
        ' - ',
        golongan_perangkat.golongan_perangkat_name,
        ' > ',
        kelompok_perangkat.kelompok_perangkat_name,
        ' > ',
        jenis_biaya.jenis_biaya_name
    ) AS kode
FROM
    kelompok_perangkat_biaya
INNER JOIN jenis_biaya ON jenis_biaya.jenis_biaya_id = kelompok_perangkat_biaya.jenis_biaya_id
INNER JOIN kelompok_perangkat ON kelompok_perangkat_biaya.kelompok_perangkat_id = kelompok_perangkat.kelompok_perangkat_id
INNER JOIN golongan_perangkat ON golongan_perangkat.golongan_perangkat_id = kelompok_perangkat.golongan_perangkat_id
WHERE 
    kelompok_perangkat_biaya_id = '{$kelompok_perangkat_biaya_id}'
ORDER BY
    golongan_perangkat.golongan_perangkat_no ASC,
    kelompok_perangkat.kelompok_perangkat_no ASC,
    jenis_biaya.jenis_biaya_no ASC
;";
if ($result = $konek->query($sql)) {
    $row = $result->fetch_object();
    $kode_perangkat = $row->kode;
}
// get kode pemilik
$sub_unit_id = $product->sub_unit_id;
$sql = "
SELECT
    CONCAT(
        IF (
            unit.unit_no < 10,
            CONCAT('0', unit.unit_no),
            unit.unit_no
        ),
        '.',
        IF (
            sub_unit.sub_unit_no < 10,
            CONCAT('0', sub_unit.sub_unit_no),
            sub_unit.sub_unit_no
        ),
        ' - ',
        unit.unit_name,
        ' > ',
        sub_unit.sub_unit_name
    ) AS kode
FROM
    sub_unit
INNER JOIN unit ON sub_unit.unit_id = unit.unit_id
WHERE 
    sub_unit_id = '{$sub_unit_id}'
ORDER BY
    unit.unit_no ASC,
    sub_unit.sub_unit_no ASC
;";
if ($result = $konek->query($sql)) {
    $row = $result->fetch_object();
    $kode_pemilik = $row->kode;
}
$locations = array();
$sql = "SELECT lokasi_id AS `id`, lokasi_name AS `name` FROM lokasi;";
if ($result = $konek->query($sql)) {
    while ($row = $result->fetch_object()) {
        $locations[] = $row;
    }
}
$units = array();
$sql = "SELECT unit_id AS `id`, unit_name AS `name` FROM unit;";
if ($result = $konek->query($sql)) {
    while ($row = $result->fetch_object()) {
        $units[] = $row;
    }
}
?>



<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" bgcolor="#333333">

<div align="center">
    <table border="0" width="1000" cellspacing="0" cellpadding="0">
        <tr>
            <td background="content_bg.jpg">
            <table border="0" width="100%" cellspacing="10" cellpadding="10">
                <tr>
                    <td>

 <font color="#fff" face="Arial" style="font-size: 14pt">

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

    FORMULIR PEMINDAHAN PERANGKAT<br>
    </font> 

<br>
<form action="?page=product_transfer_process" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $product_id; ?>" readonly>
    <table width="100%" border="0" bgcolor="#CCCCFF">
        <thead>
            <tr>
                <td colspan="3" height="33" bgcolor="#003366">
                    <font face="Arial" style="font-size: 14pt" color="#FFFFFF">
                    <strong style="font-weight: 400">&nbsp;
                        PROFIL PERANGKAT</strong></font></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td align="right" width="19%" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Kode Registrasi
                    </strong>
                    </font>
                </td>
                <td align="center" width="2%" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td height="23" width="77%">
                    <font face="Arial" style="font-size: 9pt">
                    <?php echo $product->product_registration_code; ?>
                </font>
                </td>
            </tr>
            <tr>
                <td align="right" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Kode Lokasi
                    </strong>
                    </font>
                </td>
                <td align="center" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td height="23" width="77%">
                    <font face="Arial" style="font-size: 9pt">
                    <?php echo $kode_lokasi; ?>
                </font>
                </td>
            </tr>
            <tr>
                <td align="right" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Kode Perangkat
                    </strong>
                    </font>
                </td>
                <td align="center" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td height="23" width="77%">
                    <font face="Arial" style="font-size: 9pt">
                    <?php echo $kode_perangkat; ?>
                </font>
                </td>
            </tr>
            <tr>
                <td align="right" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Kode Pemilik
                    </strong>
                    </font>
                </td>
                <td align="center" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td height="23" width="77%">
                    <font face="Arial" style="font-size: 9pt">
                    <?php echo $kode_pemilik; ?>
                </font>
                </td>
            </tr>
            <tr>
                <td align="right" width="19%" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Kode Lokasi Baru
                    </strong>
                    </font>
                </td>
                <td align="center" width="2%" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td height="23" width="77%">
                    <font face="Arial"><span style="font-size: 9pt">
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
                    </span></font>
                </td>
            </tr>
            <tr>
                <td align="right" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Kode Pemilik Baru
                    </strong>
                    </font>
                </td>
                <td align="center" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td height="23" width="77%">
                    <font face="Arial"><span style="font-size: 9pt">
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
                    </span></font>
                </td>
            </tr>
            <tr>
                <td align="right" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Negara Pembuat
                    </strong>
                    </font>
                </td>
                <td align="center" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td height="23" width="77%">
                    <font face="Arial" style="font-size: 9pt">
                    <?php echo $product->country_name; ?>
                </font>
                </td>
            </tr>
            <tr>
                <td align="right" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Merek
                    </strong>
                    </font>
                </td>
                <td align="center" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td height="23" width="77%">
                    <font face="Arial" style="font-size: 9pt">
                    <?php echo $product->brand_name; ?>
                </font>
                </td>
            </tr>
            <tr>
                <td align="right" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Model / Tipe
                    </strong>
                    </font>
                </td>
                <td align="center" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td height="23" width="77%">
                    <font face="Arial" style="font-size: 9pt">
                    <?php echo $product->product_model; ?>
                </font>
                </td>
            </tr>
            <tr>
                <td align="right" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Serial Number
                    </strong>
                    </font>
                </td>
                <td align="center" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td height="23" width="77%">
                    <font face="Arial" style="font-size: 9pt">
                    <?php echo $product->product_sn; ?>
                </font>
                </td>
            </tr>
            <tr>
                <td align="right" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Tanggal Penempatan
                    </strong>
                    </font>
                </td>
                <td align="center" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td height="23" width="77%">
                    <font face="Arial"><span style="font-size: 9pt">
                    <input type="text" class="datepicker" name="product_receive_date" placeholder="Tanggal Penempatan" value="<?php if (isset($product_receive_date)) { echo $product_receive_date; } ?>">
                    <?php //echo $product->product_receive_date; ?>
                </span></font>
                </td>
            </tr>
            <tr>
                <td align="right" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Nomor Ikatan Pengadaan
                    </strong>
                    </font>
                </td>
                <td align="center" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td height="23" width="77%">
                    <font face="Arial" style="font-size: 9pt">
                    <?php echo $product->product_contract_num; ?>
                </font>
                </td>
            </tr>
            <tr>
                <td align="right" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Tanggal Ikatan Pengadaan
                    </strong>
                    </font>
                </td>
                <td align="center" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td height="23" width="77%">
                    <font face="Arial" style="font-size: 9pt">
                    <?php echo $product->product_contract_date; ?>
                </font>
                </td>
            </tr>
            <tr>
                <td align="right" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Harga Pengadaan
                    </strong>
                    </font>
                </td>
                <td align="center" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td height="23" width="77%">
                    <font face="Arial" style="font-size: 9pt">Rp <?php echo number_format($product->product_price); ?>
                    </font>
                </td>
            </tr>
            <tr>
                <td align="right" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Kondisi Perangkat
                    </strong>
                    </font>
                </td>
                <td align="center" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td height="23" width="77%">
                    <font face="Arial" style="font-size: 9pt">
                    <?php echo $product->product_condition_name; ?>
                </font>
                </td>
            </tr>
            <tr>
                <td align="right" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Status Kepemilikan
                    </strong>
                    </font>
                </td>
                <td align="center" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td height="23" width="77%">
                    <font face="Arial" style="font-size: 9pt">
                    <?php echo $product->product_ownership_name; ?>
                </font>
                </td>
            </tr>
            <tr>
                <td align="right" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Tanggal Berakhir Garansi
                    </strong>
                    </font>
                </td>
                <td align="center" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td height="23" width="77%">
                    <font face="Arial" style="font-size: 9pt">
                    <?php echo $product->product_warranty_exp_date; ?>
                </font>
                </td>
            </tr>
            <tr>
                <td align="right" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Tanggal Berakhir Sewa
                    </strong>
                    </font>
                </td>
                <td align="center" height="23">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td height="23" width="77%">
                    <font face="Arial" style="font-size: 9pt">
                    <?php echo $product->product_rent_exp_date; ?>
                </font>
                </td>
            </tr>
            <tr>
                <td align="right" height="23" valign="top">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Keterangan Tambahan
                    <br>
                    (optional)</strong></font></td>
                <td align="center" height="23" valign="top">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td height="23" width="77%">
                    <textarea rows="6" name="product_history_note" cols="110" style="font-family: Arial; font-size: 9pt"><?php if (isset($product_history_note)) { echo $product_history_note; } ?></textarea></td>
            </tr>
            <tr>
                <td height="23">&nbsp;</td>
                <td height="23">&nbsp;</td>
                <td height="23" width="77%">
                    <font face="Arial"><span style="font-size: 9pt">&nbsp;</span></font></td>
            </tr>
            <tr>
                <td height="23">&nbsp;</td>
                <td height="23">&nbsp;</td>
                <td height="23" width="77%">
                    <font face="Arial"><span style="font-size: 9pt">
                    <input type="submit" value="Simpan Pemindahan"></span></font></td>
            </tr>
            <tr>
                <td height="23">&nbsp;</td>
                <td height="23">&nbsp;</td>
                <td height="23" width="77%">&nbsp;
                    </td>
            </tr>
        </tbody>
    </table>
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
    <script src="js/jquery.min.js"></script>
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
            url:'get_ruang.php',
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
            url:'get_sub_ruang.php',
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
            url:'get_kode_lokasi.php',
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
            url:'get_kelompok.php',
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
            url:'get_kelompok_biaya.php',
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
            url:'get_kode_perangkat.php',
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
            url:'get_sub_unit.php',
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
            url:'get_kode_pemilik.php',
            data:{id : refId},
            dataType:'json'
        });
        request.done(function(data){
            target.val(data[0].kode);
        });
    });
    </script>
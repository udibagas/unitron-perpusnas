
<head>
<meta http-equiv="Content-Language" content="id">

</head>

<?php

include 'koneksi.php';
?>
<?php
if (!isset($_REQUEST['idb'])) {
    
    echo "<meta http-equiv='refresh' content='0;URL=media.php?page=inventory' />";
    exit();
}
$product_id = $konek->real_escape_string(trim($_REQUEST['idb']));
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
    product.*
FROM 
    product
WHERE 
    product.product_id = '{$product_id}'
;";
if ($result = $konek->query($sql)) {
    $product = $result->fetch_object();
}
$country_id = (isset($_REQUEST['country_id']))?$_REQUEST['country_id']:$product->country_code;
$brand_id = (isset($_REQUEST['brand_id']))?$_REQUEST['brand_id']:$product->brand_id;
$brand_name = (isset($_REQUEST['brand_name']))?$_REQUEST['brand_name']:'';
$product_model = (isset($_REQUEST['product_model']))?$_REQUEST['product_model']:$product->product_model;
$product_sn = (isset($_REQUEST['product_sn']))?$_REQUEST['product_sn']:$product->product_sn;
$product_receive_date = (isset($_REQUEST['product_receive_date']))?$_REQUEST['product_receive_date']:$product->product_receive_date;
$product_contract_num = (isset($_REQUEST['product_contract_num']))?$_REQUEST['product_contract_num']:$product->product_contract_num;
$product_contract_date = (isset($_REQUEST['product_contract_date']))?$_REQUEST['product_contract_date']:$product->product_contract_date;
$product_price = (isset($_REQUEST['product_price']))?$_REQUEST['product_price']:$product->product_price;
$product_condition_id = (isset($_REQUEST['product_condition_id']))?$_REQUEST['product_condition_id']:$product->product_condition_id;
$product_ownership_id = (isset($_REQUEST['product_ownership_id']))?$_REQUEST['product_ownership_id']:$product->product_ownership_id;
$product_warranty_exp_date = (isset($_REQUEST['product_warranty_exp_date']))?$_REQUEST['product_warranty_exp_date']:$product->product_warranty_exp_date;
$product_rent_exp_date = (isset($_REQUEST['product_rent_exp_date']))?$_REQUEST['product_rent_exp_date']:$product->product_rent_exp_date;
$product_note = (isset($_REQUEST['product_note']))?$_REQUEST['product_note']:$product->product_note;
// $locations = array();
// $sql = "SELECT lokasi_id AS `id`, lokasi_name AS `name` FROM lokasi;";
// if ($result = $konek->query($sql)) {
//     while ($row = $result->fetch_object()) {
//         $locations[] = $row;
//     }
// }
// $groups = array();
// $sql = "SELECT golongan_perangkat_id AS `id`, golongan_perangkat_name AS `name` FROM golongan_perangkat;";
// if ($result = $konek->query($sql)) {
//     while ($row = $result->fetch_object()) {
//         $groups[] = $row;
//     }
// }
// $units = array();
// $sql = "SELECT unit_id AS `id`, unit_name AS `name` FROM unit;";
// if ($result = $konek->query($sql)) {
//     while ($row = $result->fetch_object()) {
//         $units[] = $row;
//     }
// }
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
?>


            <table border="0" width="100%" cellspacing="10" cellpadding="10">
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

<font face="Arial" color="#000"><span style="font-size: 14pt" >FORMULIR PERUBAHAN DATA PERANGKAT

    </span></font>

<br><br>
&nbsp;<form action="view/bpp21/product_edit_process.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $product_id; ?>" readonly>
    <table width="100%" border="0" bgcolor="#CCCCFF" class="table table-striped responsive-utilities jambo_table">
        <thead>
            <tr>
                <td colspan="3" height="33" bgcolor="skyblue">
                    <font face="Arial" style="font-size: 14pt" color="#000">
                    <strong style="font-weight: 400">
                        &nbsp;
                        PROFIL PERANGKAT</strong></font></td>
            </tr>
        </thead>
        <tbody>
            <!-- <tr>
                <td align="right" width="15%">
                    <strong>
                        Kode Lokasi
                    </strong>
                </td>
                <td align="center" width="1%">
                    <strong>
                        :
                    </strong>
                </td>
                <td>
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
                    <strong>
                        Kode Perangkat
                    </strong>
                </td>
                <td align="center">
                    <strong>
                        :
                    </strong>
                </td>
                <td>
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
                    <strong>
                        Kode Pemilik
                    </strong>
                </td>
                <td align="center">
                    <strong>
                        :
                    </strong>
                </td>
                <td>
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
            </tr> -->
            <tr>
                <td align="right" width="20%">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Negara Pembuat
                    </strong>
                    </font>
                </td>
                <td align="center" width="2%">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td width="76%">
                    <font face="Arial"><span style="font-size: 9pt">
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
                </span></font>
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
                <td align="center" valign="top">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td width="76%">
                    <font face="Arial"><span style="font-size: 9pt">
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
                    <br>
                    </span></font>
                    <font face="Arial" style="font-size: 9pt">jika merek tidak tersedia, silahkan pilih &quot;Lainnya&quot; dan 
                    masukkan nama merek :</font><font face="Arial"><span style="font-size: 9pt">
                    <input type="text" name="brand_name" placeholder="Merek" value="<?php if (isset($brand_name)) { echo $brand_name; } ?>">
                    </span></font>
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
                <td align="center">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td width="76%">
                    <font face="Arial"><span style="font-size: 9pt">
                    <input type="text" name="product_model" placeholder="Model / Tipe" value="<?php if (isset($product_model)) { echo $product_model; } ?>">
                    </span></font>
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
                <td align="center">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td width="76%">
                    <font face="Arial"><span style="font-size: 9pt">
                    <input type="text" name="product_sn" placeholder="Serial Number" value="<?php if (isset($product_sn)) { echo $product_sn; } ?>">
                    </span></font>
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
                <td align="center">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td width="76%">
                    <font face="Arial"><span style="font-size: 9pt">
                    <input type="text" class="datepicker" name="product_receive_date" placeholder="Tanggal Penempatan" value="<?php if (isset($product_receive_date)) { echo $product_receive_date; } ?>">
                    </span></font>
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
                <td align="center">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td width="76%">
                    <font face="Arial"><span style="font-size: 9pt">
                    <input type="text" name="product_contract_num" placeholder="Nomor Ikatan Pengadaan" value="<?php if (isset($product_contract_num)) { echo $product_contract_num; } ?>">
                    </span></font>
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
                <td align="center">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td width="76%">
                    <font face="Arial"><span style="font-size: 9pt">
                    <input type="text" class="datepicker" name="product_contract_date" placeholder="Tanggal Ikatan Pengadaan" value="<?php if (isset($product_contract_date)) { echo $product_contract_date; } ?>">
                    </span></font>
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
                <td align="center">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td width="76%">
                    <font face="Arial"><span style="font-size: 9pt">Rp <input type="text" name="product_price" placeholder="Harga Pengadaan" value="<?php if (isset($product_price)) { echo $product_price; } ?>">
                    </span></font>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Kondisi Perangkat
                    </strong>
                    </font>
                </td>
                <td align="center">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td width="76%">
                    <font face="Arial"><span style="font-size: 9pt">
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
                </span></font>
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
                <td align="center">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td width="76%">
                    <font face="Arial"><span style="font-size: 9pt">
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
                </span></font>
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
                <td align="center">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td width="76%">
                    <font face="Arial"><span style="font-size: 9pt">
                    <input type="text" class="datepicker" name="product_warranty_exp_date" placeholder="Tanggal Berakhir Garansi" value="<?php if (isset($product_warranty_exp_date)) { echo $product_warranty_exp_date; } ?>"> (optional)
                    </span></font>
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
                <td align="center">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td width="76%">
                    <font face="Arial"><span style="font-size: 9pt">
                    <input type="text" class="datepicker" name="product_rent_exp_date" placeholder="Tanggal Berakhir Sewa" value="<?php if (isset($product_rent_exp_date)) { echo $product_rent_exp_date; } ?>"> (optional)
                    </span></font>
                </td>
            </tr>
            <tr>
                <td align="right" valign="top">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Keterangan Tambahan
                    <br>
                    (optional)</strong></font></td>
                <td align="center" valign="top">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td width="76%">
                    <textarea rows="6" name="product_note" placeholder="Keterangan Tambahan" cols="103" style="font-family: Arial; font-size: 9pt"><?php if (isset($product_note)) { echo $product_note; } ?></textarea></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td width="76%">&nbsp;
                    </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td width="76%">
                    <font face="Arial"><span style="font-size: 9pt">
                    <input type="submit" value="Simpan Perubahan">
                </span></font>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td width="76%">&nbsp;
                    </td>
            </tr>
        </tbody>
    </table>
</form>

                    </td>
                </tr>
                </table>
            
<h1>&nbsp;</h1>

<head>
<meta http-equiv="Content-Language" content="id">

</head>

  <link rel="stylesheet" href="js/chosen/chosen.css">

<script src="js/chosen/chosen.jquery.js" type="text/javascript"></script>
  <script src="js/chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>

<?php

include 'koneksi.php';
@session_start();

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
$sql = "SELECT kolok AS `id`, nalokl AS `name` FROM ref_lokasi_tbl";
if($_SESSION['level']!='admin'){
    $kolok = $_SESSION['kolok'];
    $sql= $sql. " WHERE kolok='$kolok'";
}
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



if (!isset($_REQUEST['id'])) {
    
    echo "<meta http-equiv='refresh' content='0;URL=media.php?page=inventory' />";
    exit();
}
$product_id = $konek->real_escape_string(trim($_REQUEST['id']));
$exist = FALSE;


$sql = "SELECT ruang.ruang_id,ruang.ruang_name,lokasi.lokasi_name,lokasi.lokasi_id,sub_ruang.sub_ruang_id,sub_ruang.sub_ruang_name FROM sub_ruang
INNER JOIN ruang ON sub_ruang.ruang_id = ruang.ruang_id
INNER JOIN lokasi ON lokasi.lokasi_id = ruang.lokasi_id
INNER JOIN product ON product.sub_ruang_id = sub_ruang.sub_ruang_id
WHERE 
    product.product_id = '{$product_id}'
ORDER BY
    lokasi.lokasi_no ASC,
    ruang.ruang_no ASC,
    sub_ruang.sub_ruang_no ASC";


if ($result = $konek->query($sql)) {
    $row = $result->fetch_assoc();
        $lokasi_id = $row['lokasi_id'];
        $lokasi_name = $row['lokasi_name'];
        $ruang_id = $row['ruang_id'];
        $ruang_name = $row['ruang_name'];
        $sub_ruang_id = $row['sub_ruang_id'];
        $sub_ruang_name = $row['sub_ruang_name'];

    
}
//echo $sql;

$sql = "SELECT
product.product_id,
kelompok_perangkat.kelompok_perangkat_id,
kelompok_perangkat.kelompok_perangkat_name,
golongan_perangkat.golongan_perangkat_id,
golongan_perangkat.golongan_perangkat_name,
jenis_biaya.jenis_biaya_id,
jenis_biaya.jenis_biaya_name
FROM
product
INNER JOIN kelompok_perangkat_biaya ON kelompok_perangkat_biaya.kelompok_perangkat_biaya_id = product.kelompok_perangkat_biaya_id
INNER JOIN kelompok_perangkat ON kelompok_perangkat_biaya.kelompok_perangkat_id = kelompok_perangkat.kelompok_perangkat_id
INNER JOIN golongan_perangkat ON kelompok_perangkat.golongan_perangkat_id = golongan_perangkat.golongan_perangkat_id
LEFT OUTER JOIN jenis_biaya ON kelompok_perangkat_biaya.jenis_biaya_id = jenis_biaya.jenis_biaya_id

WHERE 
    product.product_id = '{$product_id}'";


if ($result = $konek->query($sql)) {
    $row = $result->fetch_assoc();

        $kelompok_perangkat_id = $row['kelompok_perangkat_id'];
        $kelompok_perangkat_name = $row['kelompok_perangkat_name'];
        $golongan_perangkat_id = $row['golongan_perangkat_id'];
        $golongan_perangkat_name = $row['golongan_perangkat_name'];
        $jenis_biaya_id = $row['jenis_biaya_id'];
        $jenis_biaya_name = $row['jenis_biaya_name'];
   
}

$sql = "SELECT
ref_kojab_tbl.kojab,
ref_kojab_tbl.najabl,
ref_lokasi_tbl.kolok,
ref_lokasi_tbl.nalokl,
ref_lokasi_tbl.kolok,
ref_lokasi_tbl.nalokl,
ref_kojab_tbl.kojab,
ref_kojab_tbl.najabl
FROM
product
INNER JOIN ref_lokasi_tbl ON ref_lokasi_tbl.kolok = product.kolok
INNER JOIN ref_kojab_tbl ON ref_kojab_tbl.kojab = product.kojab AND ref_kojab_tbl.kolok = ref_lokasi_tbl.kolok
WHERE 
    product.product_id = '{$product_id}' LIMIT 1";


if ($result = $konek->query($sql)) {
    $row = $result->fetch_assoc();

        $kojab = $row['kojab'];
        $najabl = $row['najabl'];
        $kolok = $row['kolok'];
        $nalokl = $row['nalokl'];
   
}

$sql = "SELECT * FROM product WHERE product.product_id = '{$product_id}' LIMIT 1";


if ($result = $konek->query($sql)) {
    $row = $result->fetch_assoc();
        $ip_address=$row['IP_Address'];
        $lan_connect=$row['LAN_Connect'];
        $power_connect=$row['Power_Connect'];
        $merek_seri_tipe=$row['Merek_Seri_Tipe'];
        $fungsi_alat=$row['Fungsi'];
        $no_kontak=$row['Notelp_kontak'];
        $nama_kontak=$row['Nama_kontak'];
}


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
$pos_rak = (isset($_REQUEST['Posisi']))?$_REQUEST['Posisi']:$product->Posisi;
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
&nbsp;<form action="?page=product_edit_process" method="POST" enctype="multipart/form-data">
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
           
        <tr>
                <td align="right">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        SKPD/UKPD
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
                <div class="col-md-3">
                    <select id="unit" name="unit" class="form-control">

                        <option value="<?php echo $kolok; ?>"><?php echo $nalokl; ?></option>
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
                </div>
                <div  class="col-md-3">
                    <select class="form-control" name="sub_unit_id" id="sub_unit">
                    <option value="<?php echo $kojab; ?>"><?php echo $najabl; ?></option>
                    <option value="">-</option></select>
                </div>
                <div class="col-md-3">
                    <input class="form-control" type="hidden" id="kode_pemilik" placeholder="Kode Pemilik" disabled>
                </div>
                </td>
            </tr>
            <tr>
                <td align="right" width="20%">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Lokasi Perangkat
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
                <div class="col-md-3">  
                    <select class='form-control' id="lokasi">
                    <option value="<?php echo $lokasi_id; ?>"><?php echo $lokasi_name; ?></option>
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
                </div>
                 <div class="col-md-3">  
                    <select class='form-control' id="ruang" name="ruang_id">
                    <option value="<?php echo $ruang_id; ?>"><?php echo $ruang_name; ?></option>
                    <option value="">-</option></select>
                 </div>
                 <div class="col-md-3">
                    <select class='form-control' name="sub_ruang_id" id="sub_ruang">
                    <option value="<?php echo $sub_ruang_id; ?>"><?php echo $sub_ruang_name; ?></option>
                    <option value="">-</option></select>
                 </div>
                <div class="col-md-3">
                    <input class='form-control' type="hidden" id="kode_lokasi" placeholder="Kode Lokasi" disabled>
                </div>
                <div  class="col-md-3">
                    <input class="form-control" type="text" name="pos_rak" placeholder="Posisi Dalam Rak" value="<?php if (isset($pos_rak)) { echo $pos_rak; } ?>">
                </div>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Jenis Perangkat
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
                <div class="col-md-3">
                    <select id="golongan" class="form-control">


                        
                    <option value="<?php echo $golongan_perangkat_id; ?>"><?php echo $golongan_perangkat_name; ?></option>
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
                </div>
                <div class="col-md-3">
                    <select class="form-control" id="kelompok">
                         <option value="<?php echo $kelompok_perangkat_id; ?>"><?php echo $kelompok_perangkat_name; ?></option>
                    <option value="">-</option></select>
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="kelompok_biaya_id" id="kelompok_biaya"><option value="<?php echo $jenis_biaya_id; ?>"><?php echo $jenis_biaya_name; ?></option><option value="">-</option>
                     <?php

                        $qkel= "SELECT * FROM jenis_biaya";
                        $kel = $konek->query($qkel);
                        while($dkel = $kel->fetch_assoc()){
                            echo "<option value='$dkel[jenis_biaya_id]'>$dkel[jenis_biaya_name]</option>";
                        }

                     ?>
</select>
                </div>
                <div class="col-md-3">
                    <input class="form-control" type="hidden" id="kode_perangkat" placeholder="Kode Perangkat" disabled>
                </div>
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
                 <div  class="col-md-3">
                    <select name="country_id" id="country_id" class="form-control">
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
                </div>
                </td>
            </tr>
            <tr>
                <td align="right" valign="top"> 
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Merk
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
                <div  class="col-md-3">
                    <select name="brand_id" id="brand_id" class="form-control">
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
                </div>
                    <font face="Arial" style="font-size: 9pt">
                    <div  class="col-md-4">
                    jika merek tidak tersedia, silahkan pilih &quot;Lainnya&quot; dan 
                    masukkan nama merek :</font> 
                    </div>
                    <div  class="col-md-3">
                    <input class="form-control" type="text" name="brand_name" placeholder="Merk" value="<?php if (isset($brand_name)) { echo $brand_name; } ?>" size="25">
                    </div>
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
                 <div  class="col-md-3">
                    <input class="form-control" type="text" name="product_model" placeholder="Model / Tipe" value="<?php if (isset($product_model)) { echo $product_model; } ?>">
                </div>
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
                <div  class="col-md-3">
                    <input class='form-control' type="text" name="product_sn" placeholder="Serial Number" value="<?php if (isset($product_sn)) { echo $product_sn; } ?>">
                    </div>
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
                <div  class="col-md-3">
                    <input  type="text" class="datepicker form-control" name="product_receive_date" placeholder="Tanggal Penempatan" value="<?php if (isset($product_receive_date)) { echo $product_receive_date; } ?>">
                </div>
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
                <div  class="col-md-3">
                    <input class="form-control" type="text" name="product_contract_num" placeholder="Nomor Ikatan Pengadaan" value="<?php if (isset($product_contract_num)) { echo $product_contract_num; } ?>">
                </div>
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
                <div  class="col-md-3">
                    <input type="text" class="datepicker form-control" name="product_contract_date" placeholder="Tanggal Ikatan Pengadaan" value="<?php if (isset($product_contract_date)) { echo $product_contract_date; } ?>">
                </div>
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
                
                    <font face="Arial" style="font-size: 9pt">Rp </font><div  class="col-md-3"> <input class="form-control" type="number" name="product_price" placeholder="Harga Pengadaan" value="<?php if (isset($product_price)) { echo $product_price; } ?>">&nbsp;</div>
                    <font face="Arial" style="font-size: 9pt">contoh 900000 
                    (jangan gunakan koma atau titik)</font></td>
                
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
                <td align="center" colspan="2">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        :
                    </strong>
                    </font>
                </td>
                <td width="77%">
                <div  class="col-md-3">
                    <select class="form-control" name="product_condition_id">
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
                </div>
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
                <div  class="col-md-3">
                    <select class="form-control" name="product_ownership_id">
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
                </div>
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
                <div  class="col-md-3">
                    <input  type="text" class="datepicker form-control" name="product_warranty_exp_date" placeholder="Tanggal Berakhir Garansi" value="<?php if (isset($product_warranty_exp_date)) { echo $product_warranty_exp_date; } ?>"><font face="Arial" style="font-size: 9pt"> (optional)
                    </font>
                </td>
                </div>
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
                <div  class="col-md-3">
                    <input type="text" class="datepicker form-control" name="product_rent_exp_date" placeholder="Tanggal Berakhir Sewa" value="<?php if (isset($product_rent_exp_date)) { echo $product_rent_exp_date; } ?>"> 
                    <font face="Arial" style="font-size: 9pt">&nbsp;(optional)
                    </font>
                </div>
                </td>
            </tr>

             <tr>
                <td align="right">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        IP Address
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
                 <div  class="col-md-3">
                    <input class="form-control" type="text" name="ip_address" placeholder="Ip Address" value="<?php if (isset($ip_address)) { echo $ip_address; } ?>">
                </div>
                </td>
            </tr>

            <tr>
                <td align="right">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Koneksi Power
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
                 <div  class="col-md-3">
                    <input class="form-control" type="text" name="kon_power" placeholder="Koneksi Power" value="<?php if (isset($power_connect)) { echo $power_connect; } ?>">
                </div>
                </td>
            </tr>

            

            <tr>
                <td align="right">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Koneksi LAN
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
                 <div  class="col-md-3">
                    <input class="form-control" type="text" name="koneksi_lan" placeholder="Koneksi LAN" value="<?php if (isset($lan_connect)) { echo $lan_connect; } ?>">
                </div>
                </td>
            </tr>

            <tr>
                <td align="right">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Nomor Kontak
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
                <td width="0%">
                 <div  class="col-md-3">
                    <input class="form-control" type="text" name="no_kontak" placeholder="No Kontak" value="<?php if (isset($no_kontak)) { echo $no_kontak; } ?>" required>
                </div>
                </td>
            </tr>

            

            <tr>
                <td align="right">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Nama Kontak
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
                 <div  class="col-md-3">
                    <input class="form-control" type="text" name="nama_kontak" placeholder="Nama Kontak" value="<?php if (isset($nama_kontak)) { echo $nama_kontak; } ?>" required>
                </div>
                </td>
            </tr>

            <tr>
                <td align="right" height="25" valign="top">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Fungsi Alat
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
                    <textarea class="ckeditor" rows="6" name="fungsi_alat" placeholder="Fungsi Alat" style="font-family: Arial; font-size: 9pt"><?php if (isset($fungsi_alat)) { echo $fungsi_alat; } ?></textarea></font></td>
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
                    <textarea class="ckeditor" rows="6" name="product_note" placeholder="Keterangan Tambahan" style="font-family: Arial; font-size: 9pt"><?php if (isset($product_note)) { echo $product_note; } ?></textarea></font></td>
            </tr>

             <tr>
                <td align="right">
                    <font face="Arial" style="font-size: 9pt">
                    <strong>
                        Foto Perangkat
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
                <div  class="col-md-3">
                    <input type="file" class="btn btn-default btn-file" name="file" placeholder="Foto Perangkat" value="<?php if (isset($foto)) { echo $foto; } ?>">
                </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                <td colspan="2">
                    <input class="btn btn-info" type="submit" value="   Simpan Data Baru    "></td>
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
        </tbody>
    </table>
</form>

                    </td>
                </tr>
                </table>
            
<h1>&nbsp;</h1>

<script src="js/jquery-ui.min.js"></script>
    <script src="js/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script>
    $("#unit").chosen({no_results_text: "Oops, Data Tidak ditemukan !"});
     $("#lokasi").chosen({no_results_text: "Oops, Data Tidak ditemukan !"});
     $("#golongan").chosen({no_results_text: "Oops, Data Tidak ditemukan !"});
     $("#country_id").chosen({no_results_text: "Oops, Data Tidak ditemukan !"});
     $("#brand_id").chosen({no_results_text: "Oops, Data Tidak ditemukan !"});
    
    $( ".datepicker" ).datepicker({
        dateFormat: "yy-mm-dd"
    });


    $("#lokasi").change(function(){
        $("#ruang").chosen("destroy");
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
            $("#ruang").chosen({no_results_text: "Oops, Data Tidak ditemukan !"});
        });

    });
    $("#ruang").change(function(){
        $("#sub_ruang").chosen("destroy");
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

           $("#sub_ruang").chosen({no_results_text: "Oops, Data Tidak ditemukan !"});  
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
        $("#kelompok").chosen("destroy");
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
            $("#kelompok").chosen({no_results_text: "Oops, Data Tidak ditemukan !"});  
        });
    });
    $("#kelompok").change(function(){
        $("#kelompok_biaya").chosen("destroy");
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
            $("#kelompok_biaya").chosen({no_results_text: "Oops, Data Tidak ditemukan !"});  
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
         $("#sub_unit").chosen("destroy");
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
             $("#sub_unit").chosen({no_results_text: "Oops, Data Tidak ditemukan !"});  
        });
    });
    $("#sub_unit").change(function(){
        var refId = $(this).val();
        var refId2 = $('#unit').val();
        var    target = $("#kode_pemilik"),
            request = $.ajax({
            method:'GET',
            url:'view/inven_get/get_kode_pemilik.php',
            data:{id : refId, id2 : refId2},
            dataType:'json'
        });
        request.done(function(data){
            target.val(data[0].kode);
        });
    });


    </script>
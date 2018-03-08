


<!-- Query Section -->
<?php
if (!isset($_GET['id'])) {

    echo "<meta http-equiv='refresh' content='0;URL=media.php?page=inventory' />";
    exit();
}
$product_id = $konek->real_escape_string(trim($_GET['id']));
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
LEFT OUTER JOIN countries ON countries.country_code = product.country_code
LEFT OUTER JOIN brands ON brands.brand_id = product.brand_id
LEFT OUTER JOIN product_ownership ON product_ownership.product_ownership_id = product.product_ownership_id
LEFT OUTER JOIN product_condition ON product_condition.product_condition_id = product.product_condition_id
WHERE
    product.product_id = '{$product_id}'
;";
if ($result = $konek->query($sql)) {
    $product = $result->fetch_assoc();
}
// get kode lokasi
$sub_ruang_id = $product['sub_ruang_id'];
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
LEFT OUTER JOIN ruang ON sub_ruang.ruang_id = ruang.ruang_id
LEFT OUTER JOIN lokasi ON lokasi.lokasi_id = ruang.lokasi_id
WHERE
    sub_ruang_id = '{$sub_ruang_id}'
ORDER BY
    lokasi.lokasi_no ASC,
    ruang.ruang_no ASC,
    sub_ruang.sub_ruang_no ASC
;";
if ($result = $konek->query($sql)) {
    $row = $result->fetch_assoc();
    $kode_lokasi = $row['kode'];
}
// get kode perangkat
$kelompok_perangkat_biaya_id = $product['kelompok_perangkat_biaya_id'];
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
LEFT OUTER JOIN jenis_biaya ON jenis_biaya.jenis_biaya_id = kelompok_perangkat_biaya.jenis_biaya_id
LEFT OUTER JOIN kelompok_perangkat ON kelompok_perangkat_biaya.kelompok_perangkat_id = kelompok_perangkat.kelompok_perangkat_id
LEFT OUTER JOIN golongan_perangkat ON golongan_perangkat.golongan_perangkat_id = kelompok_perangkat.golongan_perangkat_id
WHERE
    kelompok_perangkat_biaya_id = '{$kelompok_perangkat_biaya_id}'
ORDER BY
    golongan_perangkat.golongan_perangkat_no ASC,
    kelompok_perangkat.kelompok_perangkat_no ASC,
    jenis_biaya.jenis_biaya_no ASC
;";
if ($result = $konek->query($sql)) {
    $row = $result->fetch_assoc();
    $kode_perangkat = $row['kode'];
}
// get kode pemilik

$unit_id = $product['kolok'];
$sql = "
SELECT
    CONCAT(
            ref_lokasi_tbl.kolok
        ,
        ' - ',
        ref_lokasi_tbl.nalokl
    ) AS kode
FROM
    ref_kojab_tbl
INNER JOIN ref_lokasi_tbl ON ref_lokasi_tbl.kolok = ref_kojab_tbl.kolok
WHERE
    ref_kojab_tbl.kolok = '{$unit_id}'
ORDER BY
    ref_lokasi_tbl.kolok_id ASC,
    ref_kojab_tbl.kojab_id ASC
;";
if ($result = $konek->query($sql)) {
    $row = $result->fetch_assoc();
    $kode_pemilik = $row['kode'];
}

$unit_id = $product['kolok'];
$sub_unit_id = $product['kojab'];

$sql1 = "
SELECT
    CONCAT(
            ref_kojab_tbl.kojab
        ,
        ' - ',
        ref_kojab_tbl.najabl
    ) AS kode1
FROM
    ref_kojab_tbl
INNER JOIN ref_lokasi_tbl ON ref_lokasi_tbl.kolok = ref_kojab_tbl.kolok
WHERE
    ref_kojab_tbl.kolok= '{$unit_id}' AND ref_kojab_tbl.kojab = '{$sub_unit_id}'
ORDER BY
    ref_lokasi_tbl.kolok_id ASC,
    ref_kojab_tbl.kojab_id ASC
;";
if ($result1 = $konek->query($sql1)) {
    $row1 = $result1->fetch_assoc();
    $kode_pemilik1 = $row1['kode1'];
    //echo "$sql1 <br> $sql";
}



$maintenances = array();
$audits = array();
$sql = "SELECT product_maintenance_id AS `id`, product_maintenance_start_date AS `date` FROM product_maintenance WHERE product_id = '{$product_id}';";
if ($result = $konek->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $maintenances[] = $row;
    }
}
$sql = "SELECT product_audit_id AS `id`, product_audit_date AS `date` FROM product_audit WHERE product_id = '{$product_id}';";
if ($result = $konek->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $audits[] = $row;
    }
}
?>

<div class="abcdefg">
<div align="center">

<table width="100%" class="table table-striped responsive-utilities jambo_table" border="0" bgcolor="#CCCCFF">


	<thead>
        <tr>
            <td colspan="3" bgcolor="skyblue" height="33">
                <font face="Arial" style="font-size: 14pt" color="#FFFFFF">
                <strong style="font-weight: 400">
                    &nbsp;
                    Profil&nbsp; Perangkat</strong></font></td>
        </tr>
    </thead>

    <tbody>

    <tr>
            <td align="right" height="23">
                <font face="Arial" style="font-size: 9pt">
                <strong>
                    SKPD/UKPD
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
            <td width="75%" height="23">
                <font face="Arial" style="font-size: 9pt">
                <?php echo $kode_pemilik; ?>
            </font>
            </td>
        </tr>

         <tr>
            <td align="right" height="23">
                <font face="Arial" style="font-size: 9pt">
                <strong>
                     Pemilik/Penanggung Jawab
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
            <td width="75%" height="23">
                <font face="Arial" style="font-size: 9pt">
                <?php echo $kode_pemilik1; ?>
            </font>
            </td>
        </tr>
        <tr>
            <td align="right" width="22%" height="23">
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
            <td width="75%" height="23">
                <font face="Arial" style="font-size: 9pt">
                <?php echo $product['product_registration_code']; ?>
            </font>
            </td>
        </tr>
        <tr>
            <td align="right" height="23">
                <font face="Arial" style="font-size: 9pt">
                <strong>
                    Lokasi Perangkat
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
            <td width="75%" height="23">
                <font face="Arial" style="font-size: 9pt">
                <?php echo $kode_lokasi; ?>
            </font>
            </td>
        </tr>
        <tr>
            <td align="right" height="23">
                <font face="Arial" style="font-size: 9pt">
                <strong>
                    Jenis Perangkat
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
            <td width="75%" height="23">
                <font face="Arial" style="font-size: 9pt">
                <?php echo $kode_perangkat; ?>
            </font>
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
            <td width="75%" height="23">
                <font face="Arial" style="font-size: 9pt">
                <?php echo $product['country_name']; ?>
            </font>
            </td>
        </tr>
        <tr>
            <td align="right" height="23">
                <font face="Arial" style="font-size: 9pt">
                <strong>
                    Merk
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
            <td width="75%" height="23">
                <font face="Arial" style="font-size: 9pt">
                <?php echo $product['brand_name']; ?>
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
            <td width="75%" height="23">
                <font face="Arial" style="font-size: 9pt">
                <?php echo $product['product_model']; ?>
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
            <td width="75%" height="23">
                <font face="Arial" style="font-size: 9pt">
                <?php echo $product['product_sn']; ?>
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
            <td width="75%" height="23">
                <font face="Arial" style="font-size: 9pt">
                <?php echo $product['product_receive_date']; ?>
            </font>
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
            <td width="75%" height="23">
                <font face="Arial" style="font-size: 9pt">
                <?php echo $product['product_contract_num']; ?>
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
            <td width="75%" height="23">
                <font face="Arial" style="font-size: 9pt">
                <?php echo $product['product_contract_date']; ?>
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
            <td width="75%" height="23">
                <font face="Arial" style="font-size: 9pt">Rp <?php echo number_format($product['product_price']); ?>
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
            <td width="75%" height="23">
                <font face="Arial" style="font-size: 9pt">
                <?php echo $product['product_condition_name']; ?>
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
            <td width="75%" height="23">
                <font face="Arial" style="font-size: 9pt">
                <?php echo $product['product_ownership_name']; ?>
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
            <td width="75%" height="23">
                <font face="Arial" style="font-size: 9pt">
                <?php echo $product['product_warranty_exp_date']; ?>
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
            <td width="75%" height="23">
                <font face="Arial" style="font-size: 9pt">
                <?php echo $product['product_rent_exp_date']; ?>
            </font>
            </td>
        </tr>

        <tr>
            <td align="right" height="23">
                <font face="Arial" style="font-size: 9pt">
                <strong>
                    IP Address
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
            <td width="75%" height="23">
                <font face="Arial" style="font-size: 9pt">
                <?php echo $product['IP_Address']; ?>
            </font>
            </td>
        </tr>

        <tr>
            <td align="right" height="23">
                <font face="Arial" style="font-size: 9pt">
                <strong>
                    Koneksi Power
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
            <td width="75%" height="23">
                <font face="Arial" style="font-size: 9pt">
                <?php echo $product['Power_Connect']; ?>
            </font>
            </td>
        </tr>

        <tr>
            <td align="right" height="23">
                <font face="Arial" style="font-size: 9pt">
                <strong>
                    Koneksi LAN
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
            <td width="75%" height="23">
                <font face="Arial" style="font-size: 9pt">
                <?php echo $product['LAN_Connect']; ?>
            </font>
            </td>
        </tr>

        <tr>
            <td align="right" height="23">
                <font face="Arial" style="font-size: 9pt">
                <strong>
                    Nomor Kontak
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
            <td width="75%" height="23">
                <font face="Arial" style="font-size: 9pt">
                <?php echo $product['Notelp_kontak']; ?>
            </font>
            </td>
        </tr>

        <tr>
            <td align="right" height="23">
                <font face="Arial" style="font-size: 9pt">
                <strong>
                    Nama Kontak
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
            <td width="75%" height="23">
                <font face="Arial" style="font-size: 9pt">
                <?php echo $product['Nama_kontak']; ?>
            </font>
            </td>
        </tr>

        <tr>
            <td align="right" height="23">
                <font face="Arial" style="font-size: 9pt">
                <strong>
                    Fungsi
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
            <td width="75%" height="23">
                <font face="Arial" style="font-size: 9pt">
                <?php echo $product['Fungsi']; ?>
            </font>
            </td>
        </tr>

        <tr>
            <td align="right" height="23">
                <font face="Arial" style="font-size: 9pt">
                <strong>
                    Keterangan Tambahan
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
            <td width="75%" height="23">
                <font face="Arial" style="font-size: 9pt">
                <?php echo $product['product_note']; ?>
            </font>
            </td>
        </tr>

        <tr>
            <td align="right" height="23">
                <font face="Arial" style="font-size: 9pt">
                <strong>
                    Foto
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
            <td width="75%" height="23">
                <font face="Arial" style="font-size: 9pt">
                <a  data-toggle="modal" data-target=".bs-example-modal-lg"><img src="upload/<?php echo $product['foto']; ?>" width="230" height="150"></a>

                *Klik Foto untuk Memperbesar !

                             <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                      <img src="upload/<?php echo $product['foto']; ?>" width="750" height="600"></a>
                  </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                            </div>

                                        </div>
                                    </div>
                                </div>
            </font>
            </td>
        </tr>


        <tr>
            <td height="23">&nbsp;</td>
            <td height="23">&nbsp;</td>
            <td width="75%" height="23">
                &nbsp;</td>
        </tr>
        </tbody>
        </table>

        <div class="abcdefg">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h2><i class="fa fa-bars"></i> Aksi <small></small></h2>

                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">

                                <div class="col-md-3 col-sm-12 col-xs-12">
                <a class="btn btn-info" href="?page=product_edit&id=<?php echo $product_id; ?>"> Edit Data
                </a>
                </div>

                                <div class="col-md-3 col-sm-12 col-xs-12">
                <a class="btn btn-success" href="?page=product_maintenance&id=<?php echo $product_id; ?>"> Pemeliharaan
                </a>
                </div>

                                <div class="col-md-3 col-sm-12 col-xs-12">
                <a class="btn btn-danger" href="?page=product_deletion&id=<?php echo $product_id; ?>"> Hapus Data
                </a>
                </div>

                                <div class="col-md-3 col-sm-12 col-xs-12">
                <a class="btn btn-warning" href="?page=product_audit&id=<?php echo $product_id; ?>"> Audit
                </a>
                </div>

                    </div>
                </div>
            </div>
            </div>

            <div class="col-md-6 col-sm-12 col-xs-12">
                       <h2>PEMELIHARAAN</h2>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                       <h2>AUDIT</h2>
            </div>

                    <div class="col-md-6 col-sm-12 col-xs-12">
                    <table class="table table-striped responsive-utilities jambo_table" border="0" width="100%" cellpadding="2" bgcolor="#051a2a">


                        <tr>
                            <td width="16%" bgcolor="#333333" align="center">
                            <font face="Arial" style="font-size: 11pt; font-weight: 700" color="#FFFFFF">
                            No.</font></td>
                            <td width="47%" bgcolor="#333333" align="center">
                            <font face="Arial" style="font-size: 11pt; font-weight: 700" color="#FFFFFF">
                            Tanggal</font></td>
                            <td width="32%" bgcolor="#333333" align="center">&nbsp;</td>
                        </tr>
                        <?php
                        if (empty($maintenances)) {
                            ?>
                        <tr>
                            <td colspan="3" align="center" height="23">
                                <font face="Arial" style="font-size: 9pt" >Data tidak ditemukan.</font></td>
                        </tr>
                            <?php
                        } else {
                            $no = 1;
                            foreach ($maintenances AS $item) {
                                ?>
                        <tr>
                            <td width="16%" align="center" height="23">
                                <font face="Arial" style="font-size: 9pt" ><?php echo $no; ?></font></td>
                            <td width="47%" align="center">
                                <font face="Arial" style="font-size: 9pt" ><?php echo $item['date']; ?></font></td>
                            <td width="32%" align="center">
                                <font face="Arial" style="font-size: 9pt" >
                                    <a href="media.php?page=maintenance_detail&id=<?php echo $item['id']; ?>">Detail &gt;&gt;</a></font></td>
                        </tr>
                                <?php
                                $no++;
                            }
                        }
                        ?>
                    </table>
                    </div>


                     <div class="col-md-6 col-sm-12 col-xs-12">
                    <table class="table table-striped responsive-utilities jambo_table" border="0" width="100%" cellpadding="2" bgcolor="#051a2a">

                        <tr>
                            <td width="16%" bgcolor="#333333" align="center">
                            <font face="Arial" style="font-size: 11pt; font-weight: 700" color="#FFFFFF">
                            No.</font></td>
                            <td width="47%" bgcolor="#333333" align="center">
                            <font face="Arial" style="font-size: 11pt; font-weight: 700" color="#FFFFFF">
                            Tanggal</font></td>
                            <td width="32%" bgcolor="#333333" align="center">&nbsp;</td>
                        </tr>
                        <?php
                        if (empty($audits)) {
                            ?>
                            <tr>
                                <td colspan="3" align="center" height="23">
                                    <font face="Arial" style="font-size: 9pt" >Data tidak ditemukan.</font></td>
                            </tr>
                            <?php
                        } else {
                            $no = 1;
                            foreach ($audits AS $item) {
                                ?>
                                <tr>
                                    <td width="16%" align="center" height="23">
                                        <font face="Arial" style="font-size: 9pt" ><?php echo $no; ?></font></td>
                                    <td width="47%" align="center">
                                        <font face="Arial" style="font-size: 9pt" ><?php echo $item['date']; ?></font></td>
                                    <td width="32%" align="center">
                                        <font face="Arial" style="font-size: 9pt" >
                                            <a href="?page=audit_detail&id=<?php echo $item['id']; ?>">Detail &gt;&gt;</a></font></td>
                                </tr>
                                <?php
                                $no++;
                            }
                        }
                        ?>
                    </table>
                    </div>

</div>
<h1>&nbsp;</h1>
</div>
